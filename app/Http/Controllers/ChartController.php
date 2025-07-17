<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;

class ChartController extends Controller
{
    private $firebaseUrlDomba = 'https://firestore.googleapis.com/v1/projects/dombaku-974fe/databases/(default)/documents/manajemendomba';
    private $firebaseUrlKelahiran = 'https://firestore.googleapis.com/v1/projects/dombaku-974fe/databases/(default)/documents/manajemenkelahiran';

    public function index()
    {
        $tahun = request()->query('tahun'); // ambil dari query string, contoh: charts?tahun=2023

        // Ambil data dari Firebase
        $responseDomba = Http::get($this->firebaseUrlDomba);
        $responseKelahiran = Http::get($this->firebaseUrlKelahiran);

        $dataDomba = $responseDomba->json();
        $dataKelahiran = $responseKelahiran->json();

        // Inisialisasi statistik
        $jantan = 0;
        $betina = 0;
        $totalAnakBetina = 0;
        $totalAnakJantan = 0;
        $rekapBulananKelahiran = array_fill(0, 12, 0);

        $umurDistribusi = [
            '0-6 Bulan' => 0,
            '7-12 Bulan' => 0,
            '13-24 Bulan' => 0,
            '25-36 Bulan' => 0,
            '37-48 Bulan' => 0,
            '49 Bulan Ke Atas' => 0,
        ];

        $ageData = [
            0,
            0,
            0,
            0,
            0,
            0
        ];

        $now = Carbon::now();

        // === Proses manajemendomba ===
        $populasiPerBulan = array_fill(0, 12, 0);

        if (isset($dataDomba['documents'])) {
            foreach ($dataDomba['documents'] as $domba) {
                $fields = $domba['fields'] ?? [];

                // Cek apakah nama_peternak sesuai dengan session
                $namaPeternak = $fields['nama_peternak']['stringValue'] ?? '';
                if ($namaPeternak !== session('nama_peternak')) {
                    continue;
                }

                $gender = $fields['kelamin']['stringValue'] ?? '';
                $birthDate = $fields['tanggal_lahir']['stringValue'] ?? '';

                $age = 0;
                if (!empty($birthDate)) {
                    try {
                        $parsedDate = Carbon::parse($birthDate);
                        if ($tahun && $parsedDate->year != $tahun) {
                            continue; // skip jika bukan tahun yang dicari
                        }

                        $age = $parsedDate->diffInMonths($now);
                    } catch (\Exception $e) {
                        $age = 0;
                    }
                }

                if ($gender == 'Jantan') {
                    $jantan++;
                } elseif ($gender == 'Betina') {
                    $betina++;
                }

                if ($age <= 6) {
                    $umurDistribusi['0-6 Bulan']++;
                    $ageData[0]++;
                } elseif ($age <= 12) {
                    $umurDistribusi['7-12 Bulan']++;
                    $ageData[1]++;
                } elseif ($age <= 24) {
                    $umurDistribusi['13-24 Bulan']++;
                    $ageData[2]++;
                } elseif ($age <= 36) {
                    $umurDistribusi['25-36 Bulan']++;
                    $ageData[3]++;
                } elseif ($age <= 48) {
                    $umurDistribusi['37-48 Bulan']++;
                    $ageData[4]++;
                } else {
                    $umurDistribusi['49 Bulan Ke Atas']++;
                    $ageData[5]++;
                }

                if (!empty($birthDate)) {
                    $birthMonth = Carbon::parse($birthDate)->month - 1;
                    $populasiPerBulan[$birthMonth]++;
                }
            }
        }

        // === Proses manajemenkelahiran ===
        $rekapBulanan = array_fill(0, 12, 0);

        if (isset($dataKelahiran['documents'])) {
            foreach ($dataKelahiran['documents'] as $kelahiran) {
                $fields = $kelahiran['fields'] ?? [];

                $namaPeternak = $fields['nama_peternak']['stringValue'] ?? '';
                if ($namaPeternak !== session('nama_peternak')) {
                    continue;
                }

                $birthDate = $fields['tanggal_lahir']['stringValue'] ?? '';
                $kelaminBetina = $fields['kelamin_betina']['integerValue'] ?? 0;
                $kelaminJantan = $fields['kelamin_jantan']['integerValue'] ?? 0;

                if (!empty($birthDate)) {
                    try {
                        $parsedDate = Carbon::parse($birthDate);
                        if ($tahun && $parsedDate->year != $tahun) {
                            continue;
                        }

                        $month = $parsedDate->month - 1;
                        $rekapBulanan[$month]++;
                    } catch (\Exception $e) {
                        continue;
                    }
                }

                $totalAnakBetina += (int) $kelaminBetina;
                $totalAnakJantan += (int) $kelaminJantan;
            }
        }

        return view('charts', [
            'rekapBulanan' => $rekapBulanan,
            'populasiPerBulan' => $populasiPerBulan,
            'genderData' => [$jantan, $betina],
            'fertilityData' => $rekapBulanan,
            'umurDistribusi' => $umurDistribusi,
            'ageData' => $ageData,
            'jantan' => $jantan,
            'betina' => $betina,
            'tahun' => $tahun // kirim ke view agar bisa tetap tampil saat reload
        ]);
    }
}
