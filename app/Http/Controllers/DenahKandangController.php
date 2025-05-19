<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class DenahKandangController extends Controller
{
    private $firebaseUrl = 'https://firestore.googleapis.com/v1/projects/dombaku-974fe/databases/(default)/documents/manajemenkandang';

    public function index()
    {
        return view('denahkandang.index');
    }

    public function show($id)
    {
        $url = 'https://firestore.googleapis.com/v1/projects/dombaku-974fe/databases/(default)/documents:runQuery';

        $response = Http::post($url, [
            'structuredQuery' => [
                'from' => [
                    ['collectionId' => 'manajemenkandang']
                ],
                'where' => [
                    'fieldFilter' => [
                        'field' => ['fieldPath' => 'nama_kandang'],
                        'op' => 'EQUAL',
                        'value' => ['stringValue' => $id]
                    ]
                ],
                'limit' => 1
            ]
        ]);

        $data = $response->json();

        if (!$response->ok() || empty($data) || !isset($data[0]['document']['fields'])) {
            return response()->json(['error' => 'Data tidak ditemukan.'], 404);
        }

        $fields = $data[0]['document']['fields'];

        $status = $fields['status']['stringValue'] ?? 'Tersedia';
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

        $detail = [
            'id' => $id,
            'nama_kandang' => $fields['nama_kandang']['stringValue'] ?? '',
            'kapasitas_maks' => (int) ($fields['kapasitas_maks']['integerValue'] ?? 0),
            'status' => $status,
            'eartag_domba' => $eartagDetail, // Gabungkan eartag dan warna_eartag
        ];

        return response()->json($detail);
    }

    public function list()
    {
        $url = $this->firebaseUrl;
        $response = Http::get($url);
        $data = $response->json();

        if (!$response->ok() || !isset($data['documents'])) {
            return response()->json(['error' => 'Gagal mengambil data kandang.'], 500);
        }

        $kandangs = [];

        foreach ($data['documents'] as $doc) {
            $fields = $doc['fields'];

            $kandangs[] = [
                'nama_kandang' => $fields['nama_kandang']['stringValue'] ?? '',
                'status' => $fields['status']['stringValue'] ?? 'Tersedia',
            ];
        }

        return response()->json($kandangs);
    }
}
