<?php

namespace App\Http\Controllers;

use Carbon\Carbon; // Import Carbon di bagian atas controller
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PerkawinanController extends Controller
{
    private $firebaseUrl = 'https://firestore.googleapis.com/v1/projects/dombaku-974fe/databases/(default)/documents/perkawinan';
    private $firebaseUrlGetData = 'https://firestore.googleapis.com/v1/projects/dombaku-974fe/databases/(default)/documents/manajemendomba';

    public function index()
    {
        // Ambil semua data domba untuk dapatkan warna_eartag
        $responseDomba = Http::get($this->firebaseUrlGetData);
        $documents = $responseDomba->json()['documents'] ?? [];

        $eartagJantan = [];
        $eartagBetina = [];

        $warnaEartagMap = []; // Map eartag => warna_eartag

        foreach ($documents as $doc) {
            if (isset($doc['fields']) && is_array($doc['fields'])) {
                $fields = $doc['fields'];

                $eartag = $fields['eartag']['stringValue'] ?? null;
                $warna = $fields['warna_eartag']['stringValue'] ?? null;

                if ($eartag && $warna) {
                    $warnaEartagMap[$eartag] = $warna;
                }

                // Cek kelamin dan proses eartag jantan atau betina
                $kelamin = strtolower($fields['kelamin']['stringValue'] ?? '');
                if ($kelamin === 'jantan') {
                    $eartagJantan[] = ['eartag' => $eartag, 'warna' => $warna];
                } elseif ($kelamin === 'betina') {
                    $eartagBetina[] = ['eartag' => $eartag, 'warna' => $warna];
                }
            } else {
                continue;
            }
        }

        // Ambil semua data perkawinan
        $response = Http::get($this->firebaseUrl);
        $data = $response->json();

        $perkawinan = [];

        if (isset($data['documents'])) {
            foreach ($data['documents'] as $doc) {
                if (isset($doc['fields']) && is_array($doc['fields'])) {
                    $fields = $doc['fields'];
                    $id = basename($doc['name']);
                    $eartag_pejantan = $fields['eartag_pejantan']['stringValue'] ?? '';

                    $perkawinan[] = [
                        'id' => $id,
                        'eartag_pejantan' => $eartag_pejantan,
                        'tanggal_mulai' => $fields['tanggal_mulai']['stringValue'] ?? '',
                        'tanggal_selesai' => $fields['tanggal_selesai']['stringValue'] ?? '',
                        'kandang' => $fields['kandang']['stringValue'] ?? '',
                        'betina' => $fields['betina']['arrayValue']['values'] ?? [],
                        'warna_eartag' => $warnaEartagMap[$eartag_pejantan] ?? 'Tidak Diketahui',
                    ];
                } else {
                    continue;
                }
            }
        }

        return view('perkawinan', compact('perkawinan', 'eartagJantan', 'eartagBetina'));
    }

    public function store(Request $request)
    {
        // Ambil semua data domba dari Firebase
        $response = Http::get($this->firebaseUrlGetData);
        $documents = $response->json()['documents'] ?? [];

        $eartagJantan = [];
        $eartagBetina = [];

        foreach ($documents as $doc) {
            if (isset($doc['fields']) && is_array($doc['fields'])) {
                $fields = $doc['fields'];

                $eartag = $fields['eartag']['stringValue'] ?? null;
                $kelamin = strtolower($fields['kelamin']['stringValue'] ?? '');
                $warna = $fields['warna_eartag']['stringValue'] ?? 'Tidak Diketahui';

                if ($eartag && $kelamin) {
                    if ($kelamin === 'jantan') {
                        $eartagJantan[] = ['eartag' => $eartag, 'warna' => $warna];
                    } elseif ($kelamin === 'betina') {
                        $eartagBetina[] = ['eartag' => $eartag, 'warna' => $warna];
                    }
                }
            } else {
                continue;
            }
        }

        // Ambil array eartag valid untuk validasi
        $validEartagJantan = array_column($eartagJantan, 'eartag');
        $validEartagBetina = array_column($eartagBetina, 'eartag');

        $request->validate([
            'eartag_pejantan' => 'required|in:' . implode(',', $validEartagJantan),
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date',
            'kandang' => 'required',
            'eartag_betina' => 'required|array|max:20',
        ]);

        foreach ($request->eartag_betina as $betina) {
            if (!in_array($betina, $validEartagBetina)) {
                return back()->withErrors(['eartag_betina' => 'Terdapat eartag betina yang tidak valid.']);
            }
        }

        $data = [
            'fields' => [
                'eartag_pejantan' => ['stringValue' => $request->eartag_pejantan],
                'tanggal_mulai' => ['stringValue' => $request->tanggal_mulai],
                'tanggal_selesai' => ['stringValue' => $request->tanggal_selesai],
                'kandang' => ['stringValue' => $request->kandang],
                'betina' => [
                    'arrayValue' => [
                        'values' => array_map(function ($val) {
                            return ['stringValue' => $val];
                        }, $request->eartag_betina)
                    ]
                ],
            ]
        ];

        Http::post($this->firebaseUrl, $data);

        return redirect()->route('perkawinan.index')->with('success', 'Data berhasil ditambahkan.');
    }


    // Update data berdasarkan ID Firestore
    public function update(Request $request, $id)
    {
        $request->validate([
            'eartag_pejantan' => 'required',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date',
            'kandang' => 'required',
            'eartag_betina' => 'required|array|max:20',
        ]);

        $documentUrl = $this->firebaseUrl . '/' . $id;

        // Data yang akan diupdate
        $data = [
            'fields' => [
                'eartag_pejantan' => ['stringValue' => $request->eartag_pejantan],
                'tanggal_mulai' => ['stringValue' => $request->tanggal_mulai],
                'tanggal_selesai' => ['stringValue' => $request->tanggal_selesai],
                'kandang' => ['stringValue' => $request->kandang],
                'betina' => [
                    'arrayValue' => [
                        'values' => array_map(function ($val) {
                            return ['stringValue' => $val];
                        }, $request->eartag_betina)
                    ]
                ],
            ]
        ];

        // Kirim data untuk update
        $response = Http::patch($documentUrl, $data);

        // Mengecek status pengiriman update
        if ($response->successful()) {
            return redirect()->route('perkawinan.index')->with('success', 'Data berhasil diperbarui.');
        } else {
            return redirect()->route('perkawinan.index')->with('error', 'Terjadi kesalahan saat memperbarui data.');
        }
    }

    public function edit($id)
    {
        $documentUrl = $this->firebaseUrl . '/' . $id;
        $response = Http::get($documentUrl);
        $data = $response->json();

        // Pastikan betina adalah array yang valid
        if (!isset($data['fields']['betina']['arrayValue']['values'])) {
            return response()->json(['error' => 'Betina tidak ditemukan']);
        }

        $betina = $data['fields']['betina']['arrayValue']['values'];

        return response()->json([
            'id' => $id,
            'eartag_pejantan' => $data['fields']['eartag_pejantan']['stringValue'],
            'tanggal_mulai' => $data['fields']['tanggal_mulai']['stringValue'],
            'tanggal_selesai' => $data['fields']['tanggal_selesai']['stringValue'],
            'kandang' => $data['fields']['kandang']['stringValue'],
            'betina' => $betina, // Pastikan betina dikirim dalam format array
        ]);
    }


    // Hapus data
    public function destroy($id)
    {
        $documentUrl = $this->firebaseUrl . '/' . $id;
        Http::delete($documentUrl);

        return redirect()->route('perkawinan.index')->with('success', 'Data berhasil dihapus.');
    }

    public function show($id)
    {
        $documentUrl = $this->firebaseUrl . '/' . $id;
        $response = Http::get($documentUrl);
        $data = $response->json();

        if (!isset($data['fields'])) {
            return abort(404);
        }

        $betinaList = $data['fields']['betina']['arrayValue']['values'] ?? [];
        $warnaEartagMap = []; // Map untuk warna eartag

        // Ambil warna eartag dari data domba
        $responseDomba = Http::get($this->firebaseUrlGetData);
        $documents = $responseDomba->json()['documents'] ?? [];

        foreach ($documents as $doc) {
            if (isset($doc['fields']) && is_array($doc['fields'])) {
                $fields = $doc['fields'];
                $eartag = $fields['eartag']['stringValue'] ?? null;
                $warna = $fields['warna_eartag']['stringValue'] ?? null;
                if ($eartag && $warna) {
                    $warnaEartagMap[$eartag] = $warna;
                }
            }
        }

        // Simulasi persentase kehamilan berdasarkan usia dan tanggal perkawinan
        $betinaDetail = [];
        foreach ($betinaList as $index => $item) {
            $eartagBetina = $item['stringValue'];
            $warna = $warnaEartagMap[$eartagBetina] ?? 'Tidak Diketahui'; // Ambil warna eartag

            // Ambil data usia betina dan tanggal perkawinan
            $betinaFields = collect($documents)->firstWhere(fn($doc) => $doc['fields']['eartag']['stringValue'] === $eartagBetina);
            $tanggalKawin = $betinaFields['fields']['tanggal_kawin']['stringValue'] ?? null;
            $usiaBetina = $betinaFields['fields']['usia']['integerValue'] ?? 0;

            // Prediksi kehamilan berdasarkan usia dan tanggal perkawinan
            if ($tanggalKawin && $usiaBetina) {
                $persentaseKehamilan = $this->predictPregnancyProbability($tanggalKawin, $usiaBetina);
            } else {
                $persentaseKehamilan = 0;
            }

            $betinaDetail[] = [
                'no' => $index + 1,
                'eartag' => $eartagBetina,
                'warna_eartag' => $warna,
                'persentase' => $persentaseKehamilan . '%'
            ];
        }

        return response()->json([
            'betina' => $betinaDetail
        ]);
    }

    private function predictPregnancyProbability($tanggalKawin, $usiaBetina)
    {
        // Hitung durasi kehamilan berdasarkan tanggal kawin (diasumsikan kehamilan penuh = 150 hari)
        $tanggalKawin = Carbon::parse($tanggalKawin);
        $hariPerkawinan = $tanggalKawin->diffInDays(Carbon::now());

        // Asumsikan bahwa lebih banyak hari sejak perkawinan meningkatkan peluang kehamilan
        // juga menambah faktor usia betina untuk mempengaruhi hasil
        $baseProbability = 0;

        if ($hariPerkawinan >= 120) {
            $baseProbability = 80;
        } elseif ($hariPerkawinan >= 90) {
            $baseProbability = 60;
        } else {
            $baseProbability = 40;
        }

        // Faktor usia (asumsi usia ideal 2-4 tahun untuk kehamilan yang optimal)
        if ($usiaBetina >= 2 && $usiaBetina <= 4) {
            return $baseProbability + 20; // Penambahan faktor usia
        } elseif ($usiaBetina > 4) {
            return $baseProbability - 10; // Usia tua menurunkan kemungkinan kehamilan
        }

        return $baseProbability;
    }
}
