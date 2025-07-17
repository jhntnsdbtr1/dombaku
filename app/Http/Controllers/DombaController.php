<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;

class DombaController extends Controller
{
    private $baseFirebaseUrl = 'https://firestore.googleapis.com/v1/projects/dombaku-974fe/databases/(default)/documents';

    public function index(Request $request)
    {
        $selectedYear = $request->input('year', Carbon::now()->year);
        $response = Http::timeout(30)->get($this->baseFirebaseUrl . '/manajemendomba');
        $data = $response->json();

        $jantan = $betina = $anakan = $totalDomba = 0;
        $jantanLastMonth = $betinaLastMonth = $anakanLastMonth = 0;
        $rekapBulanan = array_fill(0, 12, 0);

        $now = Carbon::now();
        $lastMonthStart = $now->copy()->subMonth()->startOfMonth();
        $lastMonthEnd = $now->copy()->subMonth()->endOfMonth();

        if (isset($data['documents'])) {
            foreach ($data['documents'] as $document) {
                $fields = $document['fields'] ?? [];

                // Cek apakah nama_peternak sesuai dengan session
                $namaPeternak = $fields['nama_peternak']['stringValue'] ?? '';
                if ($namaPeternak !== session('nama_peternak')) {
                    continue; // Skip data yang tidak cocok
                }

                $kelamin = $fields['kelamin']['stringValue'] ?? '';
                $tanggalLahir = $fields['tanggal_lahir']['stringValue'] ?? '';

                if ($tanggalLahir) {
                    $tanggalLahirCarbon = Carbon::parse($tanggalLahir);
                    $umur = $tanggalLahirCarbon->diff($now);
                    $tahun = $umur->y;
                    $bulan = $umur->m;

                    if ($tanggalLahirCarbon->year == $selectedYear) {
                        if ($kelamin === 'Jantan') $jantan++;
                        if ($kelamin === 'Betina') $betina++;
                        if ($bulan <= 6 && $tahun == 0) $anakan++;

                        $bulanLahir = $tanggalLahirCarbon->month - 1;
                        $rekapBulanan[$bulanLahir]++;

                        if ($tanggalLahirCarbon->between($lastMonthStart, $lastMonthEnd)) {
                            if ($kelamin === 'Jantan') $jantanLastMonth++;
                            if ($kelamin === 'Betina') $betinaLastMonth++;
                            if ($bulan <= 6 && $tahun == 0) $anakanLastMonth++;
                        }
                    }
                }
            }
        }

        $totalDomba = $jantan + $betina;
        $totalLastMonth = $jantanLastMonth + $betinaLastMonth;

        $jantanDiff = $this->calculatePercentageDiff($jantanLastMonth, $jantan);
        $betinaDiff = $this->calculatePercentageDiff($betinaLastMonth, $betina);
        $anakanDiff = $this->calculatePercentageDiff($anakanLastMonth, $anakan);
        $totalDiff = $this->calculatePercentageDiff($totalLastMonth, $totalDomba);

        // Ambil notifikasi alert juga
        $alerts = $this->fetchPerkawinanAlerts();

        return view('dashboard', compact(
            'selectedYear',
            'jantan',
            'betina',
            'anakan',
            'totalDomba',
            'rekapBulanan',
            'jantanDiff',
            'betinaDiff',
            'anakanDiff',
            'totalDiff',
            'alerts'
        ));
    }

    private function calculatePercentageDiff($lastMonth, $current)
    {
        if ($lastMonth == 0) {
            // Jika tidak ada data bulan lalu, anggap pertumbuhan 100% maksimal
            return $current > 0 ? 100 : 0;
        }

        $diff = (($current - $lastMonth) / $lastMonth) * 100;

        // Batasi maksimum ke 100%, minimum tetap bisa negatif (penurunan)
        return $diff > 100 ? 100 : $diff;
    }

    private function fetchPerkawinanAlerts()
    {
        $perkawinanUrl = $this->baseFirebaseUrl . '/perkawinan';
        $alertUrl = $this->baseFirebaseUrl . '/alert';

        $response = Http::timeout(30)->get($perkawinanUrl);
        $data = $response->json();

        $alerts = [];

        if (isset($data['documents'])) {
            foreach ($data['documents'] as $document) {
                $fields = $document['fields'] ?? [];

                // Cek apakah nama_peternak sesuai dengan session
                $namaPeternak = $fields['nama_peternak']['stringValue'] ?? '';
                if ($namaPeternak !== session('nama_peternak')) {
                    continue; // Skip data yang tidak cocok
                }

                $eartagPejantan = $fields['eartag_pejantan']['stringValue'] ?? null;
                $tanggalSelesai = $fields['tanggal_selesai']['stringValue'] ?? null;

                if ($tanggalSelesai && $eartagPejantan) {
                    $tanggalCarbon = Carbon::parse($tanggalSelesai);
                    $now = Carbon::now()->startOfDay();

                    if ($tanggalCarbon->equalTo($now) || $tanggalCarbon->lessThan($now)) {
                        $message = "Perkawinan pejantan {$eartagPejantan} selesai pada {$tanggalCarbon->format('d M Y')}";

                        // Ambil data alert yang sudah ada
                        $existingAlerts = Http::get($alertUrl)->json();
                        $alreadyExists = false;
                        $alertId = null;  // ID alert yang ditemukan (jika ada)

                        if (isset($existingAlerts['documents'])) {
                            foreach ($existingAlerts['documents'] as $alertDoc) {
                                $alertFields = $alertDoc['fields'] ?? [];
                                if (
                                    ($alertFields['message']['stringValue'] ?? '') === $message &&
                                    ($alertFields['eartag_pejantan']['stringValue'] ?? '') === $eartagPejantan
                                ) {
                                    $alreadyExists = true;
                                    $alertId = basename($alertDoc['name']);  // Menyimpan ID dari alert yang ditemukan
                                    break;
                                }
                            }
                        }

                        // Jika alert belum ada, kirim alert baru
                        if (!$alreadyExists) {
                            Http::post($alertUrl, [
                                'fields' => [
                                    'message' => ['stringValue' => $message],
                                    'tanggal' => ['stringValue' => $tanggalCarbon->format('Y-m-d')],
                                    'eartag_pejantan' => ['stringValue' => $eartagPejantan],
                                    'read' => ['booleanValue' => false], // status "belum dibaca"
                                ],
                            ]);
                        }

                        $alerts[] = [
                            'message' => $message,
                            'tanggal' => $tanggalCarbon->format('Y-m-d'),
                            'eartag_pejantan' => $eartagPejantan,
                        ];
                    }
                }
            }
        }

        // Ambil hanya alert yang belum dibaca
        $finalAlerts = [];
        $existingAlerts = Http::get($alertUrl)->json();
        if (isset($existingAlerts['documents'])) {
            foreach ($existingAlerts['documents'] as $alertDoc) {
                $fields = $alertDoc['fields'] ?? [];

                // Cek apakah nama_peternak sesuai dengan session
                $namaPeternak = $fields['nama_peternak']['stringValue'] ?? '';
                if ($namaPeternak !== session('nama_peternak')) {
                    continue; // Skip data yang tidak cocok
                }

            
                $isRead = $fields['read']['booleanValue'] ?? true;

                // Tambahkan hanya alert yang belum dibaca
                if (!$isRead) {
                    $finalAlerts[] = [
                        'message' => $fields['message']['stringValue'] ?? '',
                        'tanggal' => $fields['tanggal']['stringValue'] ?? '',
                        'eartag_pejantan' => $fields['eartag_pejantan']['stringValue'] ?? '',
                        'id' => basename($alertDoc['name']),
                    ];
                }
            }
        }

        return $finalAlerts;
    }

    public function markAlertAsRead($alertId)
    {
        $alertUrl = $this->baseFirebaseUrl . '/alert/' . $alertId;

        // Ambil data alert sebelumnya
        $existingAlert = Http::get($alertUrl)->json();
        $fields = $existingAlert['fields'] ?? null;

        if (!$fields) {
            return response()->json(['error' => 'Data alert tidak ditemukan'], 404);
        }

        // Kirim ulang semua field dengan `read: true`
        $updateResponse = Http::patch($alertUrl, [
            'fields' => [
                'message' => ['stringValue' => $fields['message']['stringValue'] ?? ''],
                'tanggal' => ['stringValue' => $fields['tanggal']['stringValue'] ?? ''],
                'eartag_pejantan' => ['stringValue' => $fields['eartag_pejantan']['stringValue'] ?? ''],
                'read' => ['booleanValue' => true], // status "sudah dibaca"
            ]
        ]);

        // Ambil kembali semua alert yang belum dibaca
        $finalAlerts = $this->fetchPerkawinanAlerts();

        // Kembalikan jumlah alert yang belum dibaca
        return response()->json([
            'newCount' => count($finalAlerts)
        ]);
    }
}
