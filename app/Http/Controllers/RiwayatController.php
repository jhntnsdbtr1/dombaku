<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log; // Jangan lupa import Log

class RiwayatController extends Controller
{
    public function index(Request $request)
    {
        $eartag = $request->input('eartag');
        $warnaEartag = $request->input('warna_eartag'); // Warna yang dipilih (opsional)
    
        // Log input eartag untuk memastikan yang dikirimkan oleh user
        Log::info("Menerima eartag: " . $eartag);
    
        // Jika Eartag belum diisi, tampilkan error
        if (!$eartag) {
            return view('history')->with('error', 'Eartag harus diisi!');
        }
    
        $url = "https://firestore.googleapis.com/v1/projects/dombaku-974fe/databases/(default)/documents/riwayat";
        $response = Http::get($url);
    
        // Log response dari Firestore untuk memastikan data diterima dengan benar
        Log::info("Response dari Firestore: " . json_encode($response->json()));
    
        if ($response->failed()) {
            return view('history')->with('error', 'Gagal mengambil data dari Firestore!');
        }
    
        $riwayatSemua = $response->json()['documents'] ?? [];
        $riwayatDomba = [];
        $warna_eartag_list = [];  // Inisialisasi variabel warna_eartag_list
    
        // Memproses semua riwayat untuk menemukan warna eartag yang berbeda
        foreach ($riwayatSemua as $riwayat) {
            $fields = $riwayat['fields'] ?? [];
    
            // Mengakses eartag dan warna eartag langsung dari fields
            $eartagDomba = $fields['eartag']['stringValue'] ?? null;
            $warnaEartagDomba = $fields['warna_eartag']['stringValue'] ?? null;
    
            if ($eartagDomba === $eartag) {
                // Menambahkan warna eartag ke dalam daftar jika belum ada
                if (!in_array($warnaEartagDomba, $warna_eartag_list)) {
                    $warna_eartag_list[] = $warnaEartagDomba;
                }
    
                // Menambahkan riwayat ke dalam array
                $timestamp = $fields['waktu']['timestampValue'] ?? null;
                $kategori = $fields['kategori']['stringValue'] ?? 'Tidak Diketahui';
    
                $riwayatDomba[] = [
                    'tanggal' => $timestamp ? $this->formatDate($timestamp) : '-',
                    'kategori' => $kategori,
                    'deskripsi' => $fields['deskripsi']['stringValue'] ?? '-',
                    'data_sebelum' => $this->flattenFields($fields['data_sebelum']['mapValue']['fields'] ?? []),
                    'data_setelah' => $this->flattenFields($fields['data_setelah']['mapValue']['fields'] ?? []),
                    'oleh' => $fields['oleh']['stringValue'] ?? 'guest',
                    'warna_eartag' => $warnaEartagDomba, // Menambahkan warna eartag untuk filter nanti
                ];
            }
        }
    
        // Jika ada warna yang dipilih, filter riwayat berdasarkan warna eartag
        if ($warnaEartag) {
            $riwayatDomba = array_filter($riwayatDomba, function ($riwayat) use ($warnaEartag) {
                return $riwayat['warna_eartag'] === $warnaEartag;
            });
        }
    
        // Urutkan dari terbaru
        usort($riwayatDomba, function ($a, $b) {
            return strtotime(str_replace('-', '/', $b['tanggal'])) - strtotime(str_replace('-', '/', $a['tanggal']));
        });
    
        return view('history', [
            'riwayatDomba' => $riwayatDomba,
            'eartag' => $eartag,
            'warna_eartag_list' => $warna_eartag_list, // Daftar warna eartag yang konsisten
            'warna_eartag' => $warnaEartag // Warna yang dipilih (jika ada)
        ]);
    }
    

    // Fungsi untuk memformat tanggal Firestore ke format yang diinginkan
    private function formatDate($timestamp)
    {
        return date('d-m-Y H:i:s', strtotime($timestamp));
    }

    // Fungsi untuk mem-flatten fields
    private function flattenFields($fields)
    {
        $flattened = [];

        foreach ($fields as $key => $value) {
            $flattened[$key] = $value['stringValue'] ?? $value['integerValue'] ?? $value['doubleValue'] ?? json_encode($value);
        }

        return $flattened;
    }
}
