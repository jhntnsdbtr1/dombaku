<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ManajemenKelahiranController extends Controller
{
    private $firebaseUrl = 'https://firestore.googleapis.com/v1/projects/dombaku-974fe/databases/(default)/documents/manajemenkelahiran';
    private $firebaseUrlGetData = 'https://firestore.googleapis.com/v1/projects/dombaku-974fe/databases/(default)/documents/manajemendomba'; // tambah URL baru

    public function index()
    {
        // Ambil data kelahiran
        $response = Http::get($this->firebaseUrl);
        $data = $response->json();

        $dataKelahiran = [];
        $totalKehamilan = 0;
        $totalAnakBetina = 0;
        $totalAnakJantan = 0;
        $totalMortalitas = 0;
        $totalAnakHidup = 0;

        if (isset($data['documents'])) {
            foreach ($data['documents'] as $doc) {
                $fields = $doc['fields'];

                // Cek apakah nama_peternak sesuai dengan session
                $namaPeternak = $fields['nama_peternak']['stringValue'] ?? '';
                if ($namaPeternak !== session('nama_peternak')) {
                    continue; // Skip data yang tidak cocok
                }

                $jumlahAnak = isset($fields['jumlah_anak']['integerValue']) ? (int) $fields['jumlah_anak']['integerValue'] : 0;
                $kelaminBetina = isset($fields['kelamin_betina']['integerValue']) ? (int) $fields['kelamin_betina']['integerValue'] : 0;
                $kelaminJantan = isset($fields['kelamin_jantan']['integerValue']) ? (int) $fields['kelamin_jantan']['integerValue'] : 0;
                $mortalitas = isset($fields['mortalitas']['integerValue']) ? (int) $fields['mortalitas']['integerValue'] : 0;

                $dataKelahiran[] = [
                    'id' => basename($doc['name']),
                    'eartag_induk' => $fields['eartag_induk']['stringValue'] ?? '',
                    'eartag_jantan' => $fields['eartag_jantan']['stringValue'] ?? '',
                    'eartag_anak' => $fields['eartag_anak']['stringValue'] ?? '',
                    'kelamin_betina' => $kelaminBetina,
                    'kelamin_jantan' => $kelaminJantan,
                    'tanggal_lahir' => $fields['tanggal_lahir']['stringValue'] ?? '',
                    'jumlah_anak' => $jumlahAnak,
                    'bobot_anak' => $fields['bobot_anak']['doubleValue'] ?? 0,
                    'mortalitas' => $mortalitas,
                    'persentase_mortalitas' => $fields['persentase_mortalitas']['doubleValue'] ?? 0,
                    'keterangan' => $fields['keterangan']['stringValue'] ?? '',
                ];

                $totalKehamilan++;
                $totalAnakBetina += $kelaminBetina;
                $totalAnakJantan += $kelaminJantan;
                $totalMortalitas += $mortalitas;
                $totalAnakHidup += ($jumlahAnak - $mortalitas);
            }
        }

        $persentaseJumlahAnak = $totalKehamilan > 0 ? ($totalAnakBetina + $totalAnakJantan) / $totalKehamilan * 100 : 0;
        $persentaseMortalitas = 0;
        if ($totalAnakHidup > 0) {
            $persentaseMortalitas = ($totalMortalitas / $totalAnakHidup) * 100;
        } elseif ($totalAnakHidup == 0 && $totalMortalitas > 0) {
            $persentaseMortalitas = 100;
        }
        $anakHidupPerKehamilan = $totalKehamilan > 0 ? ($totalAnakHidup / $totalKehamilan) : 0;
        $jumlahAnak = $totalAnakBetina + $totalAnakJantan;

        $rekapData = [
            'jumlah_kehamilan' => $totalKehamilan,
            'jumlah_anak_betina' => $totalAnakBetina,
            'jumlah_anak_jantan' => $totalAnakJantan,
            'jumlah_anak' => $jumlahAnak,
            'total_mortalitas' => $totalMortalitas,
            'jumlah_anak_hidup' => $totalAnakHidup,
            'persentase_mortalitas' => $persentaseMortalitas,
            'persentase_jumlah_anak' => $persentaseJumlahAnak,
            'anak_hidup_per_kehamilan' => $anakHidupPerKehamilan,
        ];

        // ===== Tambahkan ambil data eartag domba di sini =====
        $responseDomba = Http::get($this->firebaseUrlGetData);
        $documents = $responseDomba->json()['documents'] ?? [];

        $eartagJantan = [];
        $eartagBetina = [];
        $warnaEartagMap = [];

        foreach ($documents as $doc) {
            $fields = $doc['fields'];
            $eartag = $fields['eartag']['stringValue'] ?? null;
            $warna = $fields['warna_eartag']['stringValue'] ?? null;

            if ($eartag && $warna) {
                $warnaEartagMap[$eartag] = $warna;
            }

            $kelamin = strtolower($fields['kelamin']['stringValue'] ?? '');
            if ($kelamin === 'jantan') {
                $eartagJantan[] = ['eartag' => $eartag, 'warna' => $warna];
            } elseif ($kelamin === 'betina') {
                $eartagBetina[] = ['eartag' => $eartag, 'warna' => $warna];
            }
        }

        usort($dataKelahiran, function ($a, $b) {
            return strcmp($a['tanggal_lahir'], $b['tanggal_lahir']);
        });

        // Pastikan return view mengirim semua variabel yang dibutuhkan
        return view('kelahiran', compact('dataKelahiran', 'rekapData', 'eartagJantan', 'eartagBetina'));
    }

    // Form create
    public function create()
    {
        // Ambil semua data domba untuk dropdown eartag pejantan dan betina
        $responseDomba = Http::get($this->firebaseUrlGetData);
        $documents = $responseDomba->json()['documents'] ?? [];

        $eartagJantan = [];
        $eartagBetina = [];

        foreach ($documents as $doc) {
            $fields = $doc['fields'];
            $eartag = $fields['eartag']['stringValue'] ?? null;
            $kelamin = strtolower($fields['kelamin']['stringValue'] ?? '');

            if ($kelamin === 'jantan') {
                $eartagJantan[] = $eartag;
            } elseif ($kelamin === 'betina') {
                $eartagBetina[] = $eartag;
            }
        }

        return view('kelahiran', compact('eartagJantan', 'eartagBetina'));
    }

    // Menyimpan data baru
    public function store(Request $request)
    {
        $request->validate([
            'eartagInduk' => 'required',
            'eartagJantan' => 'required',
            'eartagAnak' => 'required',
            'tanggalLahir' => 'required|date',
            'jumlahAnak' => 'required|numeric',
            'bobotAnak' => 'required|numeric',
            'mortalitas' => 'required|numeric',
            'keterangan' => 'nullable|string',
            'jenisKelaminAnak' => 'required|in:betina,jantan',
        ]);

        $persentase = ($request->jumlahAnak > 0) ? ($request->mortalitas / $request->jumlahAnak) * 100 : 0;

        $response = Http::post($this->firebaseUrl, [
            'fields' => [
                'eartag_induk' => ['stringValue' => $request->eartagInduk],
                'eartag_jantan' => ['stringValue' => $request->eartagJantan],
                'eartag_anak' => ['stringValue' => $request->eartagAnak],
                'kelamin_betina' => ['integerValue' => $request->jenisKelaminAnak == 'betina' ? 1 : 0],
                'kelamin_jantan' => ['integerValue' => $request->jenisKelaminAnak == 'jantan' ? 1 : 0],
                'tanggal_lahir' => ['stringValue' => $request->tanggalLahir],
                'jumlah_anak' => ['integerValue' => $request->jumlahAnak],
                'bobot_anak' => ['doubleValue' => $request->bobotAnak],
                'mortalitas' => ['integerValue' => $request->mortalitas],
                'persentase_mortalitas' => ['doubleValue' => $persentase],
                'keterangan' => ['stringValue' => $request->keterangan ?? ''],
                'nama_peternak' => ['stringValue' => (string) session('nama_peternak')],
            ]
        ]);

        return redirect()->route('kelahiran.index')->with('success', 'Data kelahiran berhasil ditambahkan!');
    }

    // Show detail
    public function show($id)
    {
        // Request data dari Firebase Firestore
        $response = Http::get("{$this->firebaseUrl}/{$id}");

        // Mendapatkan JSON dari response
        $json = $response->json();

        // Mengecek jika data tidak ditemukan atau response gagal
        if (!$response->successful() || !isset($json['fields'])) {
            return redirect()->route('kelahiran.index')->with('error', 'Data tidak ditemukan.');
        }

        // Menyusun data kelahiran dari response Firebase
        $fields = $json['fields'];
        $kelahiran = [
            'id' => $id,
            'eartag_induk' => $fields['eartag_induk']['stringValue'] ?? '',
            'eartag_jantan' => $fields['eartag_jantan']['stringValue'] ?? '',
            'eartag_anak' => $fields['eartag_anak']['stringValue'] ?? '',
            'kelamin_betina' => $fields['kelamin_betina']['integerValue'] ?? 0,
            'kelamin_jantan' => $fields['kelamin_jantan']['integerValue'] ?? 0,
            'tanggal_lahir' => $fields['tanggal_lahir']['stringValue'] ?? '',
            'jumlah_anak' => $fields['jumlah_anak']['integerValue'] ?? 0,
            'bobot_anak' => $fields['bobot_anak']['doubleValue'] ?? 0,
            'mortalitas' => $fields['mortalitas']['integerValue'] ?? 0,
            'persentase_mortalitas' => $fields['persentase_mortalitas']['doubleValue'] ?? 0,
            'keterangan' => $fields['keterangan']['stringValue'] ?? '',
        ];

        // Return data kelahiran ke view atau JSON
        return response()->json($kelahiran);
    }

    // Edit form
    public function edit($id)
    {
        try {
            // Request data from Firebase Firestore
            $response = Http::get("{$this->firebaseUrl}/{$id}");

            Log::debug('Firebase Response:', ['response' => $response->json()]);

            // Handle the response as before...
        } catch (\Exception $e) {
            Log::error('Error in /kelahiran/{id}/edit', ['exception' => $e->getMessage()]);
            return response()->json(['error' => 'Data tidak ditemukan atau kesalahan lainnya'], 500);
        }
    }

    // Update data kelahiran
    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'eartagInduk' => 'required',
            'eartagJantan' => 'required',
            'eartagAnak' => 'required',
            'tanggalLahir' => 'required|date',
            'jumlahAnak' => 'required|numeric',
            'bobotAnak' => 'required|numeric',
            'mortalitas' => 'required|numeric',
            'keterangan' => 'nullable|string',
            'jenisKelaminAnak' => 'required|in:betina,jantan',
        ]);

        // Hitung persentase mortalitas
        $persentase = ($request->jumlahAnak > 0) ? ($request->mortalitas / $request->jumlahAnak) * 100 : 0;

        // Mengirim data yang diperbarui ke Firebase
        $response = Http::patch("{$this->firebaseUrl}/{$id}", [
            'fields' => [
                'eartag_induk' => ['stringValue' => $request->eartagInduk],
                'eartag_jantan' => ['stringValue' => $request->eartagJantan],
                'eartag_anak' => ['stringValue' => $request->eartagAnak],
                'kelamin_betina' => ['integerValue' => $request->jenisKelaminAnak == 'betina' ? 1 : 0],
                'kelamin_jantan' => ['integerValue' => $request->jenisKelaminAnak == 'jantan' ? 1 : 0],
                'tanggal_lahir' => ['stringValue' => $request->tanggalLahir],
                'jumlah_anak' => ['integerValue' => $request->jumlahAnak],
                'bobot_anak' => ['doubleValue' => $request->bobotAnak],
                'mortalitas' => ['integerValue' => $request->mortalitas],
                'persentase_mortalitas' => ['doubleValue' => $persentase],
                'keterangan' => ['stringValue' => $request->keterangan ?? ''],
                'nama_peternak' => ['stringValue' => (string) session('nama_peternak')],
            ]
        ]);

        // Cek status code dan error dari API
        if ($response->successful()) {
            return redirect()->route('kelahiran.index')->with('success', 'Data berhasil diperbarui');
        } else {
            // Jika respons gagal, kirim pesan kesalahan yang sesuai
            Log::error('Error updating data', ['response' => $response->json()]);
            return back()->with('error', 'Gagal memperbarui data. Coba lagi nanti.');
        }
    }

    // Hapus data
    public function destroy($id)
    {
        Http::delete("{$this->firebaseUrl}/{$id}");

        return redirect()->route('kelahiran.index')->with('success', 'Data kelahiran berhasil dihapus!');
    }

    public function getData($id)
    {
        $response = Http::get("{$this->firebaseUrl}/{$id}");

        if (!$response->ok()) {
            return response()->json(['error' => 'Data tidak ditemukan'], 404);
        }

        $doc = $response->json();

        $fields = $doc['fields'] ?? [];

        return response()->json([
            'id' => $id,
            'eartag_induk' => $fields['eartag_induk']['stringValue'] ?? '',
            'eartag_jantan' => $fields['eartag_jantan']['stringValue'] ?? '',
            'eartag_anak' => $fields['eartag_anak']['stringValue'] ?? '',
            'tanggal_lahir' => $fields['tanggal_lahir']['stringValue'] ?? '',
            'jumlah_anak' => $fields['jumlah_anak']['integerValue'] ?? 0,
            'bobot_anak' => $fields['bobot_anak']['doubleValue'] ?? 0,
            'mortalitas' => $fields['mortalitas']['integerValue'] ?? 0,
            'persentase_mortalitas' => $fields['persentase_mortalitas']['doubleValue'] ?? 0,
            'keterangan' => $fields['keterangan']['stringValue'] ?? '',
        ]);
    }
}
