<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class RiwayatController extends Controller
{
    public function index(Request $request)
    {
        $eartag = $request->input('eartag');

        if (!$eartag) {
            return view('history')->with('error', 'Eartag harus diisi!');
        }

        $url = "https://firestore.googleapis.com/v1/projects/dombaku-974fe/databases/(default)/documents/riwayat";
        $response = Http::get($url);

        if ($response->failed()) {
            return view('history')->with('error', 'Gagal mengambil data dari Firestore!');
        }

        $riwayatSemua = $response->json()['documents'] ?? [];
        $riwayatDomba = [];

        foreach ($riwayatSemua as $riwayat) {
            $fields = $riwayat['fields'] ?? [];

            $dataSebelum = $fields['data_sebelum']['mapValue']['fields'] ?? [];
            $dataSetelah = $fields['data_setelah']['mapValue']['fields'] ?? [];

            $eartagSebelum = $dataSebelum['eartag']['stringValue'] ?? null;
            $eartagSetelah = $dataSetelah['eartag']['stringValue'] ?? null;

            if ($eartagSebelum === $eartag || $eartagSetelah === $eartag) {
                $timestamp = $fields['waktu']['timestampValue'] ?? null;

                $kategori = $fields['kategori']['stringValue'] ?? 'Tidak Diketahui';

                $riwayatDomba[] = [
                    'tanggal' => $timestamp ? date('d-m-Y', strtotime($timestamp)) : '-',
                    'kategori' => $kategori,
                    'deskripsi' => $fields['deskripsi']['stringValue'] ?? '-',
                    'data_sebelum' => $this->flattenFields($dataSebelum),
                    'data_setelah' => $this->flattenFields($dataSetelah),
                    'oleh' => $fields['oleh']['stringValue'] ?? 'guest',
                ];
            }
        }

        // Urutkan dari terbaru
        usort($riwayatDomba, function ($a, $b) {
            return strtotime(str_replace('-', '/', $b['tanggal'])) - strtotime(str_replace('-', '/', $a['tanggal']));
        });

        return view('history', [
            'riwayatDomba' => $riwayatDomba,
            'eartag' => $eartag
        ]);
    }

    // Fungsi ini fleksibel untuk menampilkan semua isi field
    private function flattenFields($fields)
    {
        $flattened = [];

        foreach ($fields as $key => $value) {
            // Ambil stringValue atau nilai lainnya (jaga-jaga jika selain stringValue)
            $flattened[$key] = $value['stringValue'] ?? $value['integerValue'] ?? $value['doubleValue'] ?? json_encode($value);
        }

        return $flattened;
    }
}
