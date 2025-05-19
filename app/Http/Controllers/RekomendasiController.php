<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class RekomendasiController extends Controller
{
    private $firebaseUrl = 'https://firestore.googleapis.com/v1/projects/dombaku-974fe/databases/(default)/documents/rekomendasikawin';
    private $ngrokBaseUrl = 'https://efaa-35-243-151-167.ngrok-free.app'; // Pastikan URL ngrok ini benar

    public function uploadCSV(Request $request)
    {
        session(['processing' => true]);
        ini_set('max_execution_time', 300); // Menambah waktu eksekusi untuk file besar

        $request->validate([
            'csv_file' => 'required|file|mimes:csv,txt|max:2048',
        ]);

        try {
            $file = $request->file('csv_file');
            $filePath = $file->getRealPath();
            $ngrokApiUrl = $this->ngrokBaseUrl . '/api/rekomendasi';

            Log::info('Mengirim file CSV ke API Flask...', ['file_path' => $filePath]);
            $response = Http::timeout(300)
                ->attach('file', file_get_contents($filePath), 'file.csv')
                ->post($ngrokApiUrl);

            if ($response->failed()) {
                session(['processing' => false]);
                Log::error('Gagal mengirim file CSV ke API Flask', ['response' => $response->body()]);
                return back()->with('error_message', '❌ Gagal mengirim file CSV ke API Flask.');
            }

            $responseData = $response->json();
            Log::info('Menerima rekomendasi dari API Flask', ['data' => $responseData]);

            if (!isset($responseData['rekomendasi']) || !is_array($responseData['rekomendasi'])) {
                session(['processing' => false]);
                return back()->with('upload_message', '⚠️ Tidak ada rekomendasi yang dikembalikan dari API.');
            }

            foreach ($responseData['rekomendasi'] as $item) {
                if (!isset($item['ID Domba_jantan'], $item['ID Domba_betina'], $item['skor_kecocokan'])) {
                    continue;
                }

                $inbreedingCoefficient = $this->checkInbreeding($item['ID Domba_jantan'], $item['ID Domba_betina']);
                $duplicateCheck = $this->checkDuplicateRecommendation($item['ID Domba_jantan'], $item['ID Domba_betina']);

                if ($duplicateCheck) {
                    Log::info('Data duplikat ditemukan, melewati proses', ['id_jantan' => $item['ID Domba_jantan'], 'id_betina' => $item['ID Domba_betina']]);
                    continue; // Lewati jika duplikat
                }

                $payload = [
                    'fields' => [
                        'id_jantan' => ['stringValue' => (string) $item['ID Domba_jantan']],
                        'id_betina' => ['stringValue' => (string) $item['ID Domba_betina']],
                        'skor_kecocokan' => ['doubleValue' => (float) $item['skor_kecocokan']],
                        'inbreeding' => ['doubleValue' => $inbreedingCoefficient], // Koefisien inbreeding yang dihitung
                    ]
                ];

                Log::info('Mengirim rekomendasi ke Firestore...', ['payload' => $payload]);
                $firebaseResponse = Http::withHeaders(['Content-Type' => 'application/json'])
                    ->post($this->firebaseUrl, $payload);

                if ($firebaseResponse->failed()) {
                    Log::error('Gagal mengirim data ke Firestore', [
                        'payload' => $payload,
                        'response' => $firebaseResponse->body()
                    ]);
                } else {
                    Log::info('Berhasil mengirim data ke Firestore', ['response' => $firebaseResponse->body()]);
                }
            }

            session(['processing' => false]);

            return back()->with('upload_message', '✅ File berhasil diproses & hasil disimpan ke Firestore!');            
        } catch (\Exception $e) {
            session(['processing' => false]);
            Log::error('Error saat memproses file CSV', ['error' => $e->getMessage()]);
            return back()->with('error_message', '🚨 Error: ' . $e->getMessage());
        }
    }

    private function checkInbreeding($jantan, $betina)
    {
        if (
            isset($jantan['ID Orang Tua']) && isset($betina['ID Orang Tua']) &&
            $jantan['ID Orang Tua'] == $betina['ID Orang Tua']
        ) {
            return 0.5; // Koefisien inbreeding jika orang tua sama
        } elseif (
            isset($jantan['ID Kakek']) && isset($betina['ID Kakek']) &&
            $jantan['ID Kakek'] == $betina['ID Kakek']
        ) {
            return 0.25; // Koefisien inbreeding jika kakek sama
        } elseif (
            isset($jantan['ID Buyut']) && isset($betina['ID Buyut']) &&
            $jantan['ID Buyut'] == $betina['ID Buyut']
        ) {
            return 0.125; // Koefisien inbreeding jika buyut sama
        }

        return 0; // Tidak ada hubungan darah langsung
    }

    private function checkDuplicateRecommendation($id_jantan, $id_betina)
    {
        $query = [
            "structuredQuery" => [
                "where" => [
                    "fieldFilter" => [
                        "field" => [
                            "fieldPath" => "id_jantan"
                        ],
                        "op" => "EQUAL",
                        "value" => [
                            "stringValue" => $id_jantan
                        ]
                    ]
                ],
                "from" => [
                    ["collectionId" => "rekomendasikawin"]
                ]
            ]
        ];

        $response = Http::withHeaders(['Content-Type' => 'application/json'])
            ->post('https://firestore.googleapis.com/v1/projects/dombaku-974fe/databases/(default)/documents:runQuery', $query);

        if ($response->failed()) {
            Log::error('Gagal melakukan query ke Firestore untuk pemeriksaan duplikasi', ['response' => $response->body()]);
            return true; // Kembalikan true jika gagal, untuk menghindari duplikasi
        }

        $dataFirestore = $response->json();
        foreach ($dataFirestore as $doc) {
            // Memeriksa apakah 'document' ada dalam $doc sebelum mengaksesnya
            if (isset($doc['document']['fields'])) {
                $fields = $doc['document']['fields'];
                if (
                    isset($fields['id_jantan']['stringValue']) && isset($fields['id_betina']['stringValue']) &&
                    $fields['id_jantan']['stringValue'] == $id_jantan && $fields['id_betina']['stringValue'] == $id_betina
                ) {
                    return true; // Jika pasangan sudah ada, return true untuk duplikasi
                }
            } else {
                Log::warning('Dokumen tidak ditemukan dalam hasil query Firestore', ['doc' => $doc]);
            }
        }

        return false; // Tidak ada duplikasi
    }


    public function rekomendasiKawinView()
    {
        // Ambil rekomendasi yang sudah ada atau kirim data awal
        $rekomendasi = []; // Ganti dengan data yang sesuai

        return view('rekomendasikawin', compact('rekomendasi'));
    }

    public function rekomendasiKawin(Request $request)
    {
        $idJantan = $request->input('id_jantan'); // Ambil ID jantan dari request

        // Panggil Firestore API untuk ambil semua dokumen rekomendasi
        $response = Http::get($this->firebaseUrl);

        if ($response->failed()) {
            return response()->json(['rekomendasi' => []], 500);
        }

        $data = $response->json();

        $rekomendasi = [];

        if (!isset($data['documents'])) {
            return response()->json(['rekomendasi' => []]);
        }

        // Ambil rekomendasi dari Firestore yang sesuai dengan ID jantan
        foreach ($data['documents'] as $doc) {
            if (isset($doc['fields'])) {
                $fields = $doc['fields'];

                if (isset($fields['id_jantan']['stringValue']) && $fields['id_jantan']['stringValue'] == $idJantan) {
                    $rekomendasi[] = [
                        'id_jantan' => $fields['id_jantan']['stringValue'],
                        'id_betina' => $fields['id_betina']['stringValue'],
                        'skor_kecocokan' => $fields['skor_kecocokan']['doubleValue'],
                        'inbreeding' => $fields['inbreeding']['booleanValue'] ?? false,
                    ];
                }
            }
        }

        // Jika ada rekomendasi, simpan ke session
        if (!empty($rekomendasi)) {
            session(['rekomendasi' => $rekomendasi, 'id_jantan' => $idJantan]);
        }

        // Mengirimkan gambar visualisasi Random Forest (base64)
        $img_base64 = $this->generateRandomForestVisualization();

        return response()->json([
            'message' => '✅ Rekomendasi berhasil diproses!',
            'rekomendasi' => $rekomendasi,
            'graph' => $img_base64
        ]);
    }

    // Fungsi untuk menghasilkan visualisasi Random Forest ke base64
    private function generateRandomForestVisualization()
    {
        // Proses pembuatan visualisasi Random Forest dan konversi ke base64 (sama seperti kode di Python)
        // Pastikan Anda menggunakan library yang dapat menghasilkan gambar, misalnya menggunakan Matplotlib untuk menghasilkan PNG dan mengonversinya ke base64.
        $img_base64 = ""; // Gantilah dengan hasil base64 yang dihasilkan dari proses tersebut
        return $img_base64;
    }

    public function rekomendasiKawinByFirestore($idJantan)
    {
        try {
            // Format query yang benar untuk Firestore
            $query = [
                "structuredQuery" => [
                    "where" => [
                        "fieldFilter" => [
                            "field" => [
                                "fieldPath" => "id_jantan"
                            ],
                            "op" => "EQUAL",
                            "value" => [
                                "stringValue" => $idJantan
                            ]
                        ]
                    ],
                    "from" => [
                        ["collectionId" => "rekomendasikawin"]
                    ]
                ]
            ];

            Log::info('Mengirim permintaan ke Firestore untuk rekomendasi', ['query' => $query]);

            // Mengirimkan query ke Firestore
            $response = Http::withHeaders(['Content-Type' => 'application/json'])
                ->post('https://firestore.googleapis.com/v1/projects/dombaku-974fe/databases/(default)/documents:runQuery', $query);

            if ($response->failed()) {
                Log::error('Gagal mendapatkan data dari Firestore', ['response' => $response->body()]);
                return response()->json(['message' => 'Gagal mendapatkan data rekomendasi'], 500);
            }

            $documents = $response->json();

            $rekomendasi = [];

            foreach ($documents as $document) {
                if (isset($document['document']['fields'])) {
                    $fields = $document['document']['fields'];
                    $rekomendasi[] = [
                        'id_jantan' => $fields['id_jantan']['stringValue'],
                        'id_betina' => $fields['id_betina']['stringValue'],
                        'skor_kecocokan' => $fields['skor_kecocokan']['doubleValue'],
                    ];
                }
            }

            return response()->json($rekomendasi);
        } catch (\Exception $e) {
            Log::error('Terjadi kesalahan saat memproses rekomendasi', ['error' => $e->getMessage()]);
            return response()->json(['message' => 'Terjadi kesalahan pada server.'], 500);
        }
    }

    public function showRekomendasiKawin()
    {
        $rekomendasi = session('rekomendasi', []);
        $idJantan = session('id_jantan', null);

        if (empty($rekomendasi) || is_null($idJantan)) {
            return redirect()->route('perkawinan.index')->with('error_message', 'Data rekomendasi tidak ditemukan.');
        }

        return view('rekomendasikawin', compact('rekomendasi', 'idJantan'));
    }


    public function lanjutkanManajemenPerkawinan(Request $request)
    {
        // Validasi input
        $request->validate([
            'id_jantan' => 'required|string',
            'betina' => 'required|array',
            'betina.*' => 'required|string',
            'kandang' => 'required|string',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
        ]);

        // Bangun array betina dalam format Firestore
        $betinaArray = array_map(function ($id_betina) {
            return ['stringValue' => $id_betina];
        }, $request->betina);

        // Payload gabungan
        $payload = [
            'fields' => [
                'eartag_pejantan' => ['stringValue' => (string) $request->id_jantan],
                'kandang' => ['stringValue' => (string) $request->kandang],
                'tanggal_mulai' => ['stringValue' => date('Y-m-d', strtotime($request->tanggal_mulai))],
                'tanggal_selesai' => ['stringValue' => date('Y-m-d', strtotime($request->tanggal_selesai))],
                'status' => ['stringValue' => 'Proses'],
                'betina' => [
                    'arrayValue' => [
                        'values' => $betinaArray
                    ]
                ]
            ],
        ];

        try {
            $response = Http::withHeaders([
                'Content-Type' => 'application/json'
            ])->post('https://firestore.googleapis.com/v1/projects/dombaku-974fe/databases/(default)/documents/perkawinan', $payload);

            if ($response->successful()) {
                session()->flash('success_message', '✅ Data perkawinan berhasil disimpan!');
            } else {
                Log::error('Gagal mengirim data ke Firestore', [
                    'payload' => $payload,
                    'response' => $response->body()
                ]);
                session()->flash('error_message', '❌ Gagal menyimpan data ke Firestore.');
            }
        } catch (\Exception $e) {
            Log::error('Exception saat mengirim data ke Firestore', [
                'message' => $e->getMessage(),
                'payload' => $payload
            ]);
            session()->flash('error_message', '❌ Terjadi kesalahan saat menyimpan data.');
        }

        // Menunggu 5 detik sebelum redirect
        sleep(5);

        return redirect()->route('perkawinan.index');
    }
}
