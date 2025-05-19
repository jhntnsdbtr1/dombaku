<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class DombaController extends Controller
{
    // URL Firebase untuk mengambil data perkawinan
    protected $firebaseUrlPerkawinan = 'https://firestore.googleapis.com/v1/projects/dombaku-974fe/databases/(default)/documents/perkawinan';
    protected $firebaseUrlManajemenDomba = 'https://firestore.googleapis.com/v1/projects/dombaku-974fe/databases/(default)/documents/manajemendomba';
    protected $firebaseUrlAlert = 'https://firestore.googleapis.com/v1/projects/dombaku-974fe/databases/(default)/documents/alert';

    protected $alerts = [];

    public function index(Request $request)
    {
        // Ambil tahun yang dipilih, default ke tahun sekarang jika tidak dipilih
        $selectedYear = $request->input('tahun', Carbon::now()->year);

        // Cek apakah tahun yang dipilih valid
        Log::info('Tahun yang dipilih: ' . $selectedYear);

        // Ambil data manajemen domba
        Log::info('Mengambil data manajemen domba dari Firebase...');
        $dataDomba = $this->getDataFromFirebase($this->firebaseUrlManajemenDomba, 'manajemen domba');
        if (!$dataDomba) {
            Log::error('Gagal mengambil data manajemen domba');
            return redirect()->route('dashboard')->with('error', 'Gagal mengambil data domba');
        }

        // Ambil data perkawinan
        Log::info('Mengambil data perkawinan dari Firebase...');
        $dataPerkawinan = $this->getDataFromFirebase($this->firebaseUrlPerkawinan, 'perkawinan');
        if (!$dataPerkawinan) {
            Log::error('Gagal mengambil data perkawinan');
            return redirect()->route('dashboard')->with('error', 'Gagal mengambil data perkawinan');
        }

        // Ambil data alert perkawinan yang selesai hari ini
        Log::info('Mengambil data alert perkawinan dari Firebase...');
        $dataAlert = $this->getDataFromFirebase($this->firebaseUrlAlert, 'alert');
        if (!$dataAlert) {
            Log::error('Gagal mengambil data alert');
            return redirect()->route('dashboard')->with('error', 'Gagal mengambil data alert');
        }

        // Lanjutkan dengan logika perhitungan dan pengolahan data...
        Log::info('Data berhasil diambil dari Firebase. Mulai memproses data domba...');

        // Menghitung data domba
        $now = Carbon::now();
        $lastMonthStart = $now->copy()->subMonth()->startOfMonth();
        $lastMonthEnd = $now->copy()->subMonth()->endOfMonth();

        $jantan = $betina = $anakan = $totalDomba = 0;
        $rekapBulanan = array_fill(0, 12, 0);
        $jantanLastMonth = $betinaLastMonth = $anakanLastMonth = 0;

        if (isset($dataDomba['documents'])) {
            Log::info('Menghitung data domba berdasarkan data yang diterima...');
            foreach ($dataDomba['documents'] as $document) {
                $fields = $document['fields'] ?? [];
                $kelamin = $fields['kelamin']['stringValue'] ?? '';
                $tanggalLahir = $fields['tanggal_lahir']['stringValue'] ?? '';

                // Log setiap data yang diproses
                Log::debug('Memproses domba dengan Eartag: ' . ($fields['eartag']['stringValue'] ?? 'Unknown'));

                if ($tanggalLahir) {
                    $tanggalLahirCarbon = Carbon::parse($tanggalLahir);
                    $tahunLahir = $tanggalLahirCarbon->year;
                    $bulanLahir = $tanggalLahirCarbon->month - 1;
                    $umur = $tanggalLahirCarbon->diff($now);
                    $tahun = $umur->y;
                    $bulan = $umur->m;

                    if ($tahunLahir == $selectedYear) {
                        if ($kelamin === 'Jantan') $jantan++;
                        if ($kelamin === 'Betina') $betina++;
                        if ($bulan <= 6 && $tahun == 0) $anakan++; // Anakan adalah yang berusia 6 bulan atau kurang

                        // Hitung grafik bulanan
                        $rekapBulanan[$bulanLahir]++;

                        // Cek jika lahir di bulan lalu
                        if ($tanggalLahirCarbon->between($lastMonthStart, $lastMonthEnd)) {
                            if ($kelamin === 'Jantan') $jantanLastMonth++;
                            if ($kelamin === 'Betina') $betinaLastMonth++;
                            if ($bulan <= 6 && $tahun == 0) $anakanLastMonth++;
                        }
                    }
                }
            }
        }

        // Setelah selesai memproses data domba, lanjutkan dengan penghitungan dan logika lainnya
        $totalDomba = $jantan + $betina;
        $totalLastMonth = $jantanLastMonth + $betinaLastMonth;

        // Hitung perubahan (%)
        $jantanDiff = $this->calculatePercentageDiff($jantanLastMonth, $jantan);
        $betinaDiff = $this->calculatePercentageDiff($betinaLastMonth, $betina);
        $anakanDiff = $this->calculatePercentageDiff($anakanLastMonth, $anakan);
        $totalDiff = $this->calculatePercentageDiff($totalLastMonth, $totalDomba);

        // Ambil alert perkawinan yang selesai hari ini
        Log::info('Memproses data alert perkawinan...');
        $alerts = [];
        Log::info('Data perkawinan:', ['data' => $dataPerkawinan]);
        if (isset($dataAlert['documents']) && count($dataAlert['documents']) > 0) {
            foreach ($dataPerkawinan['documents'] as $doc) {
                // Proses setiap alert perkawinan
                // ...

                Log::debug('Alert perkawinan ditemukan dan diproses');
            }
        } else {
            Log::warning('Tidak ada data perkawinan ditemukan dari Firebase');
        }

        // Kirim semua data ke view dashboard
        Log::info('Mengirim data ke view dashboard');
        return view('dashboard', compact(
            'jantan',
            'betina',
            'anakan',
            'totalDomba',
            'rekapBulanan',
            'jantanDiff',
            'betinaDiff',
            'anakanDiff',
            'totalDiff',
            'alerts',
            'unreadAlertsCount', // Pastikan 'unreadAlertsCount' dikirim ke view
            'selectedYear' // Mengirim tahun yang dipilih ke view
        ));
    }


    private function calculatePercentageDiff($old, $new)
    {
        if ($old == 0) {
            return $new > 0 ? 100 : 0;
        }

        return round((($new - $old) / $old) * 100, 2);
    }

    private function getDataFromFirebase($url, $dataType)
    {
        $response = Http::get($url);
        if ($response->failed()) {
            Log::error("Gagal mengambil data $dataType dari Firebase");
            return null;
        }
        return $response->json();
    }

    public function readAlert($id)
    {
        // Jika id adalah markAllRead, maka kita tidak perlu mencari alert secara individual
        if ($id === 'markAllRead') {
            return $this->markAllRead(); // Panggil fungsi markAllRead untuk menandai semua alert
        }

        // Log untuk memeriksa apakah kita menerima id alert
        Log::info('Mencoba membaca alert dengan id: ' . $id);

        // Ambil alert berdasarkan id
        $alert = $this->getAlertById($id);

        if ($alert) {
            // Log status sebelum diperbarui
            Log::info('Status alert sebelum diperbarui: ', ['alert' => $alert]);

            // Ubah status alert menjadi sudah dibaca (is_read = true)
            $alert['is_read'] = true;

            // Update status di Firebase
            $updateResponse = Http::patch($this->firebaseUrlAlert . '/' . $alert['id'], [
                'fields' => [
                    'is_read' => ['booleanValue' => true]
                ]
            ]);

            if ($updateResponse->successful()) {
                // Kirim kembali notifikasi dengan status yang diperbarui
                $this->alerts = collect($this->alerts)->filter(function ($alert) {
                    return $alert['is_read'] == false;
                });

                // Log status setelah diperbarui
                Log::info('Status alert setelah diperbarui: ', ['alert' => $alert]);

                // Kembalikan ke halaman dengan pesan sukses
                Log::info('Alert dengan id ' . $id . ' telah dibaca dan status diperbarui');
                return redirect()->route('dashboard')->with('success', 'Alert telah dibaca');
            } else {
                Log::error('Gagal memperbarui status alert ke Firebase. Response: ', ['response' => $updateResponse->json()]);
                return redirect()->route('dashboard')->with('error', 'Gagal memperbarui status alert');
            }
        } else {
            Log::error('Alert dengan id ' . $id . ' tidak ditemukan');
            return redirect()->route('dashboard')->with('error', 'Alert tidak ditemukan');
        }
    }

    public function markAllRead()
    {
        $dataPerkawinan = $this->getDataFromFirebase($this->firebaseUrlPerkawinan, 'perkawinan');
        if (!$dataPerkawinan) return redirect()->route('dashboard')->with('error', 'Gagal mengambil data perkawinan');

        $alertsToUpdate = [];

        foreach ($dataPerkawinan['documents'] as $doc) {
            $fields = $doc['fields'] ?? [];
            $tanggalSelesai = $fields['tanggal_selesai']['stringValue'] ?? null;
            $isRead = $fields['is_read']['booleanValue'] ?? false;

            if ($tanggalSelesai && !$isRead && Carbon::parse($tanggalSelesai)->isToday()) {
                $alertsToUpdate[] = basename($doc['name']);
            }
        }

        if (empty($alertsToUpdate)) {
            Log::info('Tidak ada alert hari ini yang belum dibaca');
            return redirect()->route('dashboard')->with('info', 'Tidak ada alert hari ini yang belum dibaca');
        }

        // Cek dulu sebelum memproses update
        Log::info('Alert yang akan diperbarui: ', ['alerts' => $alertsToUpdate]);

        foreach ($alertsToUpdate as $id) {
            $updateResponse = Http::patch($this->firebaseUrlAlert . '/' . $id, [
                'fields' => [
                    'is_read' => ['booleanValue' => true]
                ]
            ]);

            if (!$updateResponse->successful()) {
                Log::error('Gagal update alert ke Firebase untuk ID: ' . $id . '. Response: ', ['response' => $updateResponse->json()]);
            } else {
                Log::info('Alert ID ' . $id . ' berhasil diperbarui');
            }
        }

        // Update alerts lokal setelah semua alert diperbarui
        $this->alerts = collect($this->alerts)->map(function ($alert) {
            $alert['is_read'] = true;
            return $alert;
        });

        Log::info('Semua alert hari ini telah diperbarui sebagai sudah dibaca');

        return redirect()->route('dashboard')->with('success', 'Semua alert hari ini telah dibaca');
    }
}
