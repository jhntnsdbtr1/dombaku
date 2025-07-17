<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class RekomendasiController extends Controller
{
    private $firebaseUrl = 'https://firestore.googleapis.com/v1/projects/dombaku-974fe/databases/(default)/documents/rekomendasikawin';
    private $ngrokBaseUrl = 'https://eb1c-34-57-111-218.ngrok-free.app';

    public function uploadCSV(Request $request)
    {
        session(['processing' => true]);
        ini_set('max_execution_time', 300);

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

            if (!isset($responseData['result']) || !is_array($responseData['result'])) {
                session(['processing' => false]);
                return back()->with('upload_message', '⚠️ Tidak ada rekomendasi yang dikembalikan dari API.');
            }

            foreach ($responseData['result'] as $item) {
                if (!isset($item['Eartag_Jantan'], $item['Eartag_Betina'], $item['Skor'], $item['SkorInbreeding'])) {
                    continue;
                }

                if ($this->checkDuplicateRecommendation($item['Eartag_Jantan'], $item['Eartag_Betina'])) {
                    Log::info('Duplikat ditemukan, dilewati', [
                        'jantan' => $item['Eartag_Jantan'],
                        'betina' => $item['Eartag_Betina']
                    ]);
                    continue;
                }

                $payload = [
                    'fields' => [
                        'id_jantan' => ['stringValue' => (string) $item['Eartag_Jantan']],
                        'id_betina' => ['stringValue' => (string) $item['Eartag_Betina']],
                        'skor_kecocokan' => ['doubleValue' => (float) $item['Skor']],
                        'warna_eartag_jantan' => ['stringValue' => $item['WarnaEartag_Jantan'] ?? 'Unknown'],
                        'warna_eartag_betina' => ['stringValue' => $item['WarnaEartag_Betina'] ?? 'Unknown'],
                        'koefisien_inbreeding' => ['doubleValue' => (float) $item['SkorInbreeding']],
                        'nama_peternak' => ['stringValue' => (string) session('nama_peternak')], // <-- ini tambahan
                    ],
                ];

                $firebaseResponse = Http::withHeaders(['Content-Type' => 'application/json'])
                    ->post($this->firebaseUrl, $payload);

                if ($firebaseResponse->failed()) {
                    Log::error('Gagal menyimpan ke Firestore', [
                        'payload' => $payload,
                        'response' => $firebaseResponse->body()
                    ]);
                } else {
                    Log::info('Berhasil simpan ke Firestore', ['response' => $firebaseResponse->body()]);
                }
            }

            session(['processing' => false]);
            return back()->with('upload_message', '✅ File berhasil diproses & hasil disimpan ke Firestore!');
        } catch (\Exception $e) {
            session(['processing' => false]);
            Log::error('Error saat proses CSV', ['error' => $e->getMessage()]);
            return back()->with('error_message', '🚨 Error: ' . $e->getMessage());
        }
    }

    private function checkDuplicateRecommendation($id_jantan, $id_betina)
    {
        $query = [
            "structuredQuery" => [
                "where" => [
                    "compositeFilter" => [
                        "op" => "AND",
                        "filters" => [
                            [
                                "fieldFilter" => [
                                    "field" => ["fieldPath" => "id_jantan"],
                                    "op" => "EQUAL",
                                    "value" => ["stringValue" => $id_jantan]
                                ]
                            ],
                            [
                                "fieldFilter" => [
                                    "field" => ["fieldPath" => "id_betina"],
                                    "op" => "EQUAL",
                                    "value" => ["stringValue" => $id_betina]
                                ]
                            ]
                        ]
                    ]
                ],
                "from" => [["collectionId" => "rekomendasikawin"]]
            ]
        ];

        $response = Http::withHeaders(['Content-Type' => 'application/json'])
            ->post('https://firestore.googleapis.com/v1/projects/dombaku-974fe/databases/(default)/documents:runQuery', $query);

        if ($response->failed()) {
            Log::error('Gagal melakukan query ke Firestore untuk cek duplikasi', ['response' => $response->body()]);
            return true;
        }

        $dataFirestore = $response->json();

        foreach ($dataFirestore as $doc) {
            if (isset($doc['document']['fields'])) {
                return true;
            }
        }

        return false;
    }

    public function rekomendasiKawinView()
    {
        $rekomendasi = session('rekomendasi', []);
        $idJantan = session('id_jantan', null);

        return view('rekomendasikawin', compact('rekomendasi', 'idJantan'));
    }

    public function rekomendasiKawin(Request $request)
    {
        $idJantan = $request->input('id_jantan');

        if (!$idJantan) {
            return response()->json(['message' => 'ID Jantan harus diisi', 'rekomendasi' => []], 422);
        }

        $response = Http::get($this->firebaseUrl);

        if ($response->failed()) {
            return response()->json(['message' => 'Gagal mengambil data dari server', 'rekomendasi' => []], 500);
        }

        $data = $response->json();
        $rekomendasi = [];

        if (!isset($data['documents'])) {
            return response()->json(['message' => 'Data tidak ditemukan', 'rekomendasi' => []]);
        }

        foreach ($data['documents'] as $doc) {
            $fields = $doc['fields'] ?? [];

            // Cek apakah nama_peternak sesuai dengan session
            $namaPeternak = $fields['nama_peternak']['stringValue'] ?? '';
            if ($namaPeternak !== session('nama_peternak')) {
                continue; // Skip data yang tidak cocok
            }

            if (($fields['id_jantan']['stringValue'] ?? '') === $idJantan) {
                $rekomendasi[] = [
                    'id_jantan' => $fields['id_jantan']['stringValue'],
                    'id_betina' => $fields['id_betina']['stringValue'],
                    'skor_kecocokan' => $fields['skor_kecocokan']['doubleValue'] ?? 0,
                    'warna_eartag_jantan' => $fields['warna_eartag_jantan']['stringValue'] ?? '',
                    'warna_eartag_betina' => $fields['warna_eartag_betina']['stringValue'] ?? '',
                    'koefisien_inbreeding' => $fields['koefisien_inbreeding']['doubleValue'] ?? 0,
                ];
            }
        }

        if (!empty($rekomendasi)) {
            session(['rekomendasi' => $rekomendasi, 'id_jantan' => $idJantan]);
        }

        return response()->json([
            'message' => '✅ Rekomendasi berhasil diproses!',
            'rekomendasi' => $rekomendasi,
            'graph' => $this->generateRandomForestVisualization()
        ]);
    }

    private function generateRandomForestVisualization()
    {
        // Placeholder — nanti bisa isi dengan base64 dari Python jika perlu
        return "";
    }

    public function rekomendasiKawinByFirestore($idJantan)
    {
        try {
            $query = [
                "structuredQuery" => [
                    "where" => [
                        "fieldFilter" => [
                            "field" => ["fieldPath" => "id_jantan"],
                            "op" => "EQUAL",
                            "value" => ["stringValue" => $idJantan]
                        ]
                    ],
                    "from" => [["collectionId" => "rekomendasikawin"]]
                ]
            ];

            $response = Http::withHeaders(['Content-Type' => 'application/json'])
                ->post('https://firestore.googleapis.com/v1/projects/dombaku-974fe/databases/(default)/documents:runQuery', $query);

            if ($response->failed()) {
                return response()->json(['message' => 'Gagal mengambil data rekomendasi dari Firestore'], 500);
            }

            $data = $response->json();
            $rekomendasi = [];

            foreach ($data as $doc) {
                if (isset($doc['document']['fields'])) {
                    $fields = $doc['document']['fields'];

                    // Cek apakah nama_peternak sesuai dengan session
                    $namaPeternak = $fields['nama_peternak']['stringValue'] ?? '';
                    if ($namaPeternak !== session('nama_peternak')) {
                        continue; // Skip data yang tidak cocok
                    }

                    $rekomendasi[] = [
                        'id_jantan' => $fields['id_jantan']['stringValue'],
                        'id_betina' => $fields['id_betina']['stringValue'],
                        'skor_kecocokan' => $fields['skor_kecocokan']['doubleValue'] ?? 0,
                        'warna_eartag_jantan' => $fields['warna_eartag_jantan']['stringValue'] ?? '',
                        'warna_eartag_betina' => $fields['warna_eartag_betina']['stringValue'] ?? '',
                        'koefisien_inbreeding' => $fields['koefisien_inbreeding']['doubleValue'] ?? 0,
                    ];
                }
            }

            return response()->json([
                'message' => '✅ Data berhasil diambil dari Firestore!',
                'rekomendasi' => $rekomendasi
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => '❌ Error: ' . $e->getMessage(),
                'rekomendasi' => []
            ], 500);
        }
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

        // Payload gabungan sesuai Firestore dokument format
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
                ],
                'nama_peternak' => ['stringValue' => (string) session('nama_peternak')],
            ],
        ];

        try {
            $response = Http::withHeaders([
                'Content-Type' => 'application/json'
            ])->post('https://firestore.googleapis.com/v1/projects/dombaku-974fe/databases/(default)/documents/perkawinan', $payload);

            if ($response->successful()) {
                session()->flash('success_message', '✅ Data perkawinan berhasil disimpan!');
                return redirect()->route('perkawinan.index');
            } else {
                Log::error('Gagal mengirim data ke Firestore', [
                    'payload' => $payload,
                    'response' => $response->body()
                ]);
                session()->flash('error_message', '❌ Gagal menyimpan data ke Firestore.');
                return redirect()->back()->withInput();
            }
        } catch (\Exception $e) {
            Log::error('Exception saat mengirim data ke Firestore', [
                'message' => $e->getMessage(),
                'payload' => $payload
            ]);
            session()->flash('error_message', '🚨 Terjadi kesalahan: ' . $e->getMessage());
            return redirect()->back()->withInput();
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
}
