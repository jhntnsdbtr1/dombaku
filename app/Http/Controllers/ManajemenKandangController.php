<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ManajemenKandangController extends Controller
{
    private $firebaseUrl = 'https://firestore.googleapis.com/v1/projects/dombaku-974fe/databases/(default)/documents/manajemenkandang';

    public function index()
    {
        // Step 1: Ambil semua domba (manajemendomba)
        $dombaResponse = Http::get('https://firestore.googleapis.com/v1/projects/dombaku-974fe/databases/(default)/documents/manajemendomba');
        $dombaData = $dombaResponse->json();

        // Step 2: Buat mapping id => eartag 
        $dombaMap = [];
        if (!empty($dombaData['documents'])) {
            foreach ($dombaData['documents'] as $doc) {
                $id = basename($doc['name']); // Ambil ID dari path dokumen
                $fields = $doc['fields'] ?? []; // Ambil fields dari dokumen jika ada
                // Mapping ID domba ke eartag dan warna_eartag
                $dombaMap[$id] = [
                    'eartag' => $fields['eartag']['stringValue'] ?? 'Tidak Diketahui', // Jika eartag tidak ada, berikan default
                    'warna_eartag' => $fields['warna_eartag']['stringValue'] ?? 'Tidak Diketahui', // Jika warna_eartag tidak ada, berikan default
                ];
            }
        }

        // Ambil semua eartag untuk dropdown
        $semuaEartag = array_values($dombaMap);

        // Step 3: Ambil data kandang
        $response = Http::get($this->firebaseUrl);
        $data = $response->json();

        $kandangs = [];
        if (!empty($data['documents'])) {
            foreach ($data['documents'] as $doc) {
                $fields = $doc['fields'] ?? [];
                $eartagIds = $fields['eartag_domba']['arrayValue']['values'] ?? [];

                // Jika data eartag_domba berupa array, kita ambil semua nilai string
                $eartags = [];
                if (!empty($eartagIds)) {
                    foreach ($eartagIds as $eartagId) {
                        $eartags[] = $eartagId['stringValue'] ?? '';  // Ambil semua string dalam array
                    }
                }

                $kandangs[] = [
                    'id' => basename($doc['name']),
                    'nama_kandang' => $fields['nama_kandang']['stringValue'] ?? '',
                    'kapasitas_maks' => $fields['kapasitas_maks']['integerValue'] ?? 0,
                    'status' => $fields['status']['stringValue'] ?? '',
                    'eartag_domba' => $eartags,  // Menyimpan eartag yang sesuai (array)
                ];
            }
        }

        return view('manajemenkandang', compact('kandangs', 'semuaEartag', 'dombaMap'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kandang' => 'required|string',
            'kapasitas_maks' => 'required|integer',
            'status' => 'required|string',
            'eartag_domba' => 'nullable|array', // Pastikan eartag_domba valid sebagai array
        ]);

        // Menyusun data untuk disimpan ke Firestore
        $data = [
            'fields' => [
                'nama_kandang' => ['stringValue' => $request->nama_kandang],
                'kapasitas_maks' => ['integerValue' => $request->kapasitas_maks],
                'status' => ['stringValue' => $request->status],
                'eartag_domba' => ['arrayValue' => [
                    'values' => array_map(function ($eartag) {
                        return ['stringValue' => (string)$eartag];
                    }, $request->eartag_domba)
                ]],
            ]
        ];

        // Kirim data ke Firestore melalui HTTP POST
        $response = Http::post($this->firebaseUrl, $data);

        // Log untuk memastikan data terkirim dengan benar
        Log::info('Data yang terkirim ke Firestore:', $data);

        // Redirect dengan pesan
        return redirect()->back()->with('success', 'Data kandang berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_kandang' => 'required|string',
            'kapasitas_maks' => 'required|integer',
            'status' => 'required|string',
            'eartag_domba' => 'nullable|string',  // Ubah menjadi string, bukan array
        ]);

        $dombaMap[$id] = [
            'eartag' => $fields['eartag']['stringValue'] ?? 'Tidak Diketahui',
            'warna_eartag' => $fields['warna_eartag']['stringValue'] ?? 'Tidak Diketahui',
        ];
        // Pastikan eartag_domba yang diterima adalah string jika hanya satu, atau array jika lebih dari satu
        $eartags = is_array($request->eartag_domba) ? $request->eartag_domba : [$request->eartag_domba];

        // Log untuk memverifikasi data eartag_domba yang diterima saat update
        Log::info('Data yang diterima untuk Eartag Domba (update):', $eartags);

        // Ambil data lama
        $oldData = Http::get("{$this->firebaseUrl}/$id")->json();
        $oldEartags = collect($oldData['fields']['eartag_domba']['arrayValue']['values'] ?? [])
            ->pluck('stringValue')
            ->toArray();

        // Siapkan data untuk update (hanya field yang ingin diubah)
        $payload = [
            'fields' => [
                'nama_kandang' => ['stringValue' => $request->nama_kandang],
                'kapasitas_maks' => ['integerValue' => (int) $request->kapasitas_maks],
                'status' => ['stringValue' => $request->status],
                'eartag_domba' => [
                    'arrayValue' => [
                        'values' => array_map(function ($eartag) {
                            // Pastikan eartag adalah string yang valid
                            return ['stringValue' => (string)$eartag];
                        }, $eartags)
                    ]
                ],
            ]
        ];

        // Update ke Firestore menggunakan PATCH
        $response = Http::patch("{$this->firebaseUrl}/$id", $payload);

        // Jika update gagal, beri pesan error
        if (!$response->successful()) {
            return back()->with('error', 'Gagal memperbarui kandang: ' . $response->body());
        }

        return redirect()->route('manajemenkandang.index')->with('success', 'Data kandang berhasil diperbarui!');
    }

    public function show($id)
    {
        // Ambil data kandang berdasarkan ID
        $response = Http::get("{$this->firebaseUrl}/$id");
        $data = $response->json();
        $fields = $data['fields'] ?? [];

        // Ambil data eartag_domba dari kandang
        $eartags = [];
        $eartag_domba = $fields['eartag_domba']['arrayValue']['values'] ?? [];

        if (is_array($eartag_domba)) {
            foreach ($eartag_domba as $eartag) {
                if (isset($eartag['stringValue'])) {
                    $eartags[] = $eartag['stringValue'];
                }
            }
        }

        // Ambil data domba berdasarkan eartag untuk mencari warna_eartag
        $dombaResponse = Http::get('https://firestore.googleapis.com/v1/projects/dombaku-974fe/databases/(default)/documents/manajemendomba');
        $dombaData = $dombaResponse->json();
        $dombaMap = [];

        // Membuat mapping dari ID domba ke eartag dan warna_eartag
        if (!empty($dombaData['documents'])) {
            foreach ($dombaData['documents'] as $doc) {
                $docId = basename($doc['name']);
                $dombaMap[$docId] = [
                    'eartag' => $doc['fields']['eartag']['stringValue'] ?? '',
                    'warna_eartag' => $doc['fields']['warna_eartag']['stringValue'] ?? 'Tidak Diketahui',
                ];
            }
        }

        // Gabungkan data eartag dan warna berdasarkan eartag_domba
        $eartagDetail = [];
        foreach ($eartags as $tag) {
            foreach ($dombaMap as $data) {
                if ($data['eartag'] == $tag) {
                    $eartagDetail[] = [
                        'eartag' => $data['eartag'],
                        'warna_eartag' => $data['warna_eartag'],
                    ];
                    break;
                }
            }
        }

        // Siapkan detail kandang
        $detail = [
            'id' => $id,
            'nama_kandang' => $fields['nama_kandang']['stringValue'] ?? '',
            'kapasitas_maks' => $fields['kapasitas_maks']['integerValue'] ?? 0,
            'status' => $fields['status']['stringValue'] ?? '',
            'eartag_domba' => $eartagDetail, // Gabungkan eartag dan warna_eartag
        ];

        // Mengembalikan detail kandang dengan eartag dan warna_eartag
        return response()->json($detail);
    }

    public function destroy($id)
    {
        $url = "$this->firebaseUrl/$id";
        Http::delete($url);
        return redirect()->back()->with('success', 'Data domba berhasil dihapus!');
    }
}
