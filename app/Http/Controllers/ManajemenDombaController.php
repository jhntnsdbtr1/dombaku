<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon; // Import Carbon di bagian atas controller
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class ManajemenDombaController extends Controller
{
    private $firebaseUrl = 'https://firestore.googleapis.com/v1/projects/dombaku-974fe/databases/(default)/documents/manajemendomba';

    public function index()
    {
        $response = Http::get($this->firebaseUrl);
        $data = $response->json();
        $dombaData = [];

        // Mapping eartag ke warna
        $eartagToWarna = [];
        if (isset($data['documents'])) {
            foreach ($data['documents'] as $document) {
                $fields = $document['fields'] ?? [];
                $eartag = $fields['eartag']['stringValue'] ?? '';
                $warna = $fields['warna_eartag']['stringValue'] ?? '';
                if ($eartag) {
                    $eartagToWarna[$eartag] = $warna;
                }
            }

            // Biar bisa akses data domba lain buat cari kakek & buyut
            $dombaMap = [];
            foreach ($data['documents'] as $document) {
                $fields = $document['fields'] ?? [];
                $eartag = $fields['eartag']['stringValue'] ?? '';
                $documentId = basename($document['name']); // Ambil ID dokumennya

                if ($eartag) {
                    $fields['id'] = $documentId; // Tambahkan ID ke fields
                    $dombaMap[$eartag] = $fields; // Simpan ke peta eartag → fields lengkap + id
                }
            }

            foreach ($data['documents'] as $document) {
                $fields = $document['fields'] ?? [];

                // Hitung umur
                $tanggalLahir = $fields['tanggal_lahir']['stringValue'] ?? '';
                $umur = '';
                if ($tanggalLahir) {
                    $tanggalLahirCarbon = Carbon::parse($tanggalLahir);
                    $umur = $tanggalLahirCarbon->diff(Carbon::now());
                    $tahun = $umur->y;
                    $bulan = $umur->m;
                    $hari = $umur->d;
                    $umur = "{$tahun} Tahun, {$bulan} Bulan, {$hari} Hari";
                }

                // Induk
                $indukBetina = $fields['induk_betina']['stringValue'] ?? '';
                $indukJantan = $fields['induk_jantan']['stringValue'] ?? '';
                $warnaIndukBetina = $eartagToWarna[$indukBetina] ?? '';
                $warnaIndukJantan = $eartagToWarna[$indukJantan] ?? '';

                // Cari ID Kakek dan Buyut
                $kakek = '';
                $buyut = '';

                if (isset($dombaMap[$indukJantan])) {
                    $ayahFields = $dombaMap[$indukJantan];
                    $kakekId = $ayahFields['induk_jantan']['stringValue'] ?? '';

                    if ($kakekId) {
                        $kakek = $kakekId;

                        if (isset($dombaMap[$kakekId])) {
                            $kakekFields = $dombaMap[$kakekId];
                            $buyutId = $kakekFields['induk_jantan']['stringValue'] ?? '';

                            if ($buyutId) {
                                $buyut = $buyutId;
                            }
                        }
                    }
                }

                // Ambil warna kakek dan buyut
                $warnaKakek = $eartagToWarna[$kakek] ?? '';
                $warnaBuyut = $eartagToWarna[$buyut] ?? '';

                $dombaData[] = [
                    'id' => basename($document['name']),
                    'eartag' => $fields['eartag']['stringValue'] ?? '',
                    'warna_eartag' => $fields['warna_eartag']['stringValue'] ?? '',
                    'kelamin' => $fields['kelamin']['stringValue'] ?? '',
                    'tanggal_lahir' => $tanggalLahir,
                    'umur' => $umur,
                    'induk_betina' => $indukBetina,
                    'induk_betina_id' => $dombaMap[$indukBetina]['id'] ?? null, // <- Tambahkan ini
                    'warna_induk_betina' => $warnaIndukBetina,
                    'induk_jantan' => $indukJantan,
                    'induk_jantan_id' => $dombaMap[$indukJantan]['id'] ?? null,
                    'warna_induk_jantan' => $warnaIndukJantan,
                    'bobot_badan' => $fields['bobot_badan']['integerValue'] ?? 0,
                    'kandang' => $fields['kandang']['stringValue'] ?? '',
                    'keterangan' => $fields['keterangan']['stringValue'] ?? '',
                    'kesehatan' => $fields['kesehatan']['stringValue'] ?? '',
                    'foto' => $fields['foto']['stringValue'] ?? 'default-image.jpg',
                    'kakek' => $kakek,
                    'kakek_id' => $kakek,
                    'warna_kakek' => $eartagToWarna[$kakek] ?? '',
                    'buyut' => $buyut,
                    'buyut_id' => $buyut,
                    'warna_buyut' => $eartagToWarna[$buyut] ?? ''
                ];
            }
        }

        return view('manajemendomba', compact('dombaData'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'eartag' => 'required|string|max:255',
            'warna_eartag' => 'required|string|max:50',
            'kelamin' => 'required|string|in:Jantan,Betina',
            'tanggal_lahir' => 'required|date',
            'induk_betina' => 'nullable|string|max:255',
            'induk_jantan' => 'nullable|string|max:255',
            'bobot_badan' => 'required|numeric|min:0',
            'kandang' => 'nullable|string|max:255',
            'keterangan' => 'nullable|string',
            'kesehatan' => 'required|string|in:Sehat,Sakit',
            'dokumentasi' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048', // maksimal 2MB
        ]);

        if ($request->hasFile('dokumentasi') && $request->file('dokumentasi')->isValid()) {
            $file = $request->file('dokumentasi');
            $path = $file->store('dokumen-domba', 'public');
        } else {
            $path = null;
        }

        // Pakai (string) untuk pastikan tidak null
        $data = [
            'fields' => [
                'eartag' => ['stringValue' => (string) $request->eartag],
                'warna_eartag' => ['stringValue' => (string) $request->warna_eartag],
                'kelamin' => ['stringValue' => (string) $request->kelamin],
                'tanggal_lahir' => ['stringValue' => (string) $request->tanggal_lahir],
                'induk_betina' => ['stringValue' => (string) ($request->induk_betina ?? '')],
                'induk_jantan' => ['stringValue' => (string) ($request->induk_jantan ?? '')],
                'bobot_badan' => ['integerValue' => (int) $request->bobot_badan],
                'kandang' => ['stringValue' => (string) ($request->kandang ?? '')],
                'keterangan' => ['stringValue' => (string) ($request->keterangan ?? '')],
                'kesehatan' => ['stringValue' => (string) $request->kesehatan],
                'foto' => ['stringValue' => (string) ($path ?? '')],
            ]
        ];


        $response = Http::post($this->firebaseUrl, $data);

        if ($response->successful()) {
            return redirect()->back()->with('success', 'Data domba berhasil ditambahkan!');
        } else {
            return redirect()->back()->with('error', 'Gagal menambahkan data domba.');
        }
    }

    public function show($id)
    {
        $url = "$this->firebaseUrl/$id";
        $response = Http::get($url);
        $document = $response->json();

        if (!isset($document['fields'])) {
            abort(404);
        }

        // Ambil data domba utama (anak)
        $fields = $document['fields'];
        $tanggalLahir = $fields['tanggal_lahir']['stringValue'] ?? '';
        $umur = Carbon::parse($tanggalLahir)->diff(Carbon::now())->format('%y Tahun, %m Bulan, %d Hari');

        $domba = [
            'id' => $id,
            'eartag' => $fields['eartag']['stringValue'] ?? '',
            'kelamin' => $fields['kelamin']['stringValue'] ?? '',
            'tanggal_lahir' => $tanggalLahir,
            'umur' => $umur,
            'induk_betina' => $fields['induk_betina']['stringValue'] ?? '',
            'induk_jantan' => $fields['induk_jantan']['stringValue'] ?? '',
            'bobot_badan' => $fields['bobot_badan']['integerValue'] ?? 0,
            'kandang' => $fields['kandang']['stringValue'] ?? '',
            'keterangan' => $fields['keterangan']['stringValue'] ?? '',
            'kesehatan' => $fields['kesehatan']['stringValue'] ?? '',
            'warna_eartag' => $fields['warna_eartag']['stringValue'] ?? '',
            'foto' => $fields['foto']['stringValue'] ?? 'default-image.jpg'
        ];

        // Ambil semua data domba
        $allDomba = Http::get($this->firebaseUrl)->json()['documents'] ?? [];
        $saudara = [];
        $anak = [];
        $ayah = null;
        $kakek = null;
        $buyut = null;

        // DFS untuk menelusuri keturunan lebih jauh
        function dfs($domba, $allDomba, $generasi = 1)
        {
            static $keturunan = [];
            if ($generasi > 3) return $keturunan;

            foreach ($allDomba as $doc) {
                $f = $doc['fields'] ?? [];
                $eartag = $f['eartag']['stringValue'] ?? '';

                if (($f['induk_betina']['stringValue'] ?? '') === $domba['eartag'] ||
                    ($f['induk_jantan']['stringValue'] ?? '') === $domba['eartag']
                ) {

                    $keturunan[] = [
                        'id' => basename($doc['name']),
                        'eartag' => $eartag,
                        'generasi' => $generasi,
                        'kelamin' => $f['kelamin']['stringValue'] ?? '',
                        'tanggal_lahir' => $f['tanggal_lahir']['stringValue'] ?? '',
                        'induk_betina' => $f['induk_betina']['stringValue'] ?? '',
                        'induk_jantan' => $f['induk_jantan']['stringValue'] ?? '',
                        'warna_eartag' => $f['warna_eartag']['stringValue'] ?? ''
                    ];

                    dfs(['eartag' => $eartag], $allDomba, $generasi + 1);
                }
            }

            return $keturunan;
        }

        // Menjalankan pencarian keturunan dengan DFS
        $keturunan = dfs($domba, $allDomba);

        // Pencarian data saudara, anak, ayah, kakek, dan buyut tetap seperti sebelumnya
        foreach ($allDomba as $doc) {
            $f = $doc['fields'] ?? [];
            $eartag = $f['eartag']['stringValue'] ?? '';

            // Cek saudara
            if (
                !empty($domba['induk_jantan']) &&
                ($f['induk_jantan']['stringValue'] ?? '') === $domba['induk_jantan'] &&
                $eartag !== $domba['eartag']
            ) {
                $saudara[] = [
                    'id' => basename($doc['name']),
                    'eartag' => $eartag,
                    'kelamin' => $f['kelamin']['stringValue'] ?? '',
                    'tanggal_lahir' => $f['tanggal_lahir']['stringValue'] ?? '',
                    'induk_betina' => $f['induk_betina']['stringValue'] ?? '',
                    'induk_jantan' => $f['induk_jantan']['stringValue'] ?? '',
                    'warna_eartag' => $f['warna_eartag']['stringValue'] ?? ''
                ];
            }

            // Cek anak
            if (($f['induk_betina']['stringValue'] ?? '') === $domba['eartag'] ||
                ($f['induk_jantan']['stringValue'] ?? '') === $domba['eartag']
            ) {
                $anak[] = [
                    'id' => basename($doc['name']),
                    'eartag' => $eartag,
                    'kelamin' => $f['kelamin']['stringValue'] ?? '',
                    'tanggal_lahir' => $f['tanggal_lahir']['stringValue'] ?? '',
                    'induk_betina' => $f['induk_betina']['stringValue'] ?? '',
                    'induk_jantan' => $f['induk_jantan']['stringValue'] ?? '',
                    'warna_eartag' => $f['warna_eartag']['stringValue'] ?? ''
                ];
            }

            // Ambil data ayah terlebih dahulu
            foreach ($allDomba as $doc) {
                $f = $doc['fields'] ?? [];
                $eartag = $f['eartag']['stringValue'] ?? '';

                if ($eartag === $domba['induk_jantan']) {
                    $ayah = [
                        'id' => basename($doc['name']),
                        'eartag' => $eartag,
                        'kelamin' => $f['kelamin']['stringValue'] ?? '',
                        'tanggal_lahir' => $f['tanggal_lahir']['stringValue'] ?? '',
                        'induk_betina' => $f['induk_betina']['stringValue'] ?? '',
                        'induk_jantan' => $f['induk_jantan']['stringValue'] ?? '',
                        'warna_eartag' => $f['warna_eartag']['stringValue'] ?? ''
                    ];
                    break; // keluar setelah ketemu ayah
                }
            }

            // Jika ayah ditemukan, cari kakek (ayah dari ayah)
            if ($ayah) {
                foreach ($allDomba as $doc) {
                    $f = $doc['fields'] ?? [];
                    $eartag = $f['eartag']['stringValue'] ?? '';

                    if ($eartag === $ayah['induk_jantan']) {
                        $kakek = [
                            'id' => basename($doc['name']),
                            'eartag' => $eartag,
                            'kelamin' => $f['kelamin']['stringValue'] ?? '',
                            'tanggal_lahir' => $f['tanggal_lahir']['stringValue'] ?? '',
                            'induk_betina' => $f['induk_betina']['stringValue'] ?? '',
                            'induk_jantan' => $f['induk_jantan']['stringValue'] ?? '',
                            'warna_eartag' => $f['warna_eartag']['stringValue'] ?? ''
                        ];
                        break; // keluar setelah ketemu kakek
                    }
                }
            }

            // Jika kakek ditemukan, cari buyut (ayah dari kakek)
            if ($kakek) {
                foreach ($allDomba as $doc) {
                    $f = $doc['fields'] ?? [];
                    $eartag = $f['eartag']['stringValue'] ?? '';

                    if ($eartag === $kakek['induk_jantan']) {
                        $buyut = [
                            'id' => basename($doc['name']),
                            'eartag' => $eartag,
                            'kelamin' => $f['kelamin']['stringValue'] ?? '',
                            'tanggal_lahir' => $f['tanggal_lahir']['stringValue'] ?? '',
                            'induk_betina' => $f['induk_betina']['stringValue'] ?? '',
                            'induk_jantan' => $f['induk_jantan']['stringValue'] ?? '',
                            'warna_eartag' => $f['warna_eartag']['stringValue'] ?? ''
                        ];
                        break; // keluar setelah ketemu buyut
                    }
                }
            }
        }

        // Cari saudara-saudara dari kakek (anak lain dari buyut selain kakek)
        $saudaraKakek = [];
        $sepupuDariKakek = [];

        if ($buyut && $kakek) {
            foreach ($allDomba as $doc) {
                $f = $doc['fields'] ?? [];
                $eartag = $f['eartag']['stringValue'] ?? '';

                // Cek saudara dari kakek
                if (
                    $eartag !== $kakek['eartag'] &&
                    ($f['induk_jantan']['stringValue'] ?? '') === $buyut['eartag']
                ) {
                    $saudaraKakek[] = $eartag;
                }
            }

            // Cari anak dari saudara-saudara kakek (sepupu dari ayah)
            foreach ($allDomba as $doc) {
                $f = $doc['fields'] ?? [];
                $eartag = $f['eartag']['stringValue'] ?? '';
                $indukJantan = $f['induk_jantan']['stringValue'] ?? '';

                if (in_array($indukJantan, $saudaraKakek)) {
                    $sepupuDariKakek[] = [
                        'id' => basename($doc['name']),
                        'eartag' => $eartag,
                        'kelamin' => $f['kelamin']['stringValue'] ?? '',
                        'tanggal_lahir' => $f['tanggal_lahir']['stringValue'] ?? '',
                        'induk_betina' => $f['induk_betina']['stringValue'] ?? '',
                        'induk_jantan' => $indukJantan,
                        'warna_eartag' => $f['warna_eartag']['stringValue'] ?? ''
                    ];
                }
            }
        }

        // Cari saudara dari buyut (anak lain dari ayah buyut, jika tersedia)
        $saudaraBuyut = [];
        $sepupuDariBuyut = [];

        if ($buyut && $buyut['induk_jantan']) {
            foreach ($allDomba as $doc) {
                $f = $doc['fields'] ?? [];
                $eartag = $f['eartag']['stringValue'] ?? '';

                // Cek saudara dari buyut
                if (
                    $eartag !== $buyut['eartag'] &&
                    ($f['induk_jantan']['stringValue'] ?? '') === $buyut['induk_jantan']
                ) {
                    $saudaraBuyut[] = $eartag;
                }
            }

            // Cari anak dari saudara-saudara buyut
            foreach ($allDomba as $doc) {
                $f = $doc['fields'] ?? [];
                $eartag = $f['eartag']['stringValue'] ?? '';
                $indukJantan = $f['induk_jantan']['stringValue'] ?? '';

                if (in_array($indukJantan, $saudaraBuyut)) {
                    $sepupuDariBuyut[] = [
                        'id' => basename($doc['name']),
                        'eartag' => $eartag,
                        'kelamin' => $f['kelamin']['stringValue'] ?? '',
                        'tanggal_lahir' => $f['tanggal_lahir']['stringValue'] ?? '',
                        'induk_betina' => $f['induk_betina']['stringValue'] ?? '',
                        'induk_jantan' => $indukJantan,
                        'warna_eartag' => $f['warna_eartag']['stringValue'] ?? ''
                    ];
                }
            }
        }

        // Menyusun data untuk grafik
        $generations = [];
        $generations[] = ['Generasi', 'Jumlah'];
        $generations[] = ['Sepupu dari Kakek', count($sepupuDariKakek)];
        $generations[] = ['Sepupu dari Buyut', count($sepupuDariBuyut)];
        $generations[] = ['Domba Utama', 1];
        $generations[] = ['Anak', count($anak)];
        $generations[] = ['Saudara', count($saudara)];
        $generations[] = ['Ayah', $ayah ? 1 : 0];
        $generations[] = ['Kakek', $kakek ? 1 : 0];
        $generations[] = ['Buyut', $buyut ? 1 : 0];

        return view('detaildomba', compact(
            'domba',
            'saudara',
            'anak',
            'ayah',
            'kakek',
            'buyut',
            'sepupuDariKakek',
            'sepupuDariBuyut',
            'keturunan',
            'generations'
        ));
    }

    public function update(Request $request, $id)
    {
        $data = $request->except(['_token', '_method', 'deskripsi']); // Hindari agar deskripsi tidak masuk update

        // Jika tidak ada data lain yang dikirim dan foto tidak ada yang diubah, beri respons error
        if (empty($data) && !$request->hasFile('foto')) {
            return response()->json(['message' => 'Tidak ada data yang dikirim.'], 400);
        }

        try {
            $docUrl = "https://firestore.googleapis.com/v1/projects/dombaku-974fe/databases/(default)/documents/manajemendomba/{$id}";

            // Ambil data lama sebelum update
            $response = Http::get($docUrl);
            $dataLama = $response->json()['fields'] ?? [];
            Log::info("Data lama: ", $dataLama);  // Log data lama untuk referensi

            // Inisialisasi path untuk foto
            $path = null;

            // Cek apakah ada file foto baru yang diupload
            if ($request->hasFile('foto') && $request->file('foto')->isValid()) {
                $file = $request->file('foto');
                // Simpan foto ke storage
                $path = $file->store('foto-domba', 'public');
                Log::info("Foto baru diupload dan disimpan: ", ['path' => $path]);  // Log path foto yang baru diupload
            } else {
                // Jika tidak ada foto yang diupload, periksa apakah foto lama masih kosong atau null
                $path = $dataLama['foto']['stringValue'] ?? null;
                Log::info("Tidak ada foto baru, menggunakan foto lama: ", ['path' => $path]);  // Log bahwa foto tidak diupdate
            }

            // Cek perubahan hanya pada field tertentu (misalnya kesehatan, kandang, dll.)
            $fieldsToUpdate = [];
            $dataSepertiSebelumnya = [];

            // Cek perubahan di setiap field yang relevan
            if (isset($data['kesehatan']) && $data['kesehatan'] != $dataLama['kesehatan']['stringValue']) {
                $fieldsToUpdate['kesehatan'] = ['stringValue' => $data['kesehatan']];
                $dataSepertiSebelumnya['kesehatan'] = ['stringValue' => $dataLama['kesehatan']['stringValue']];
            }

            if (isset($data['kandang']) && $data['kandang'] != $dataLama['kandang']['stringValue']) {
                $fieldsToUpdate['kandang'] = ['stringValue' => $data['kandang']];
                $dataSepertiSebelumnya['kandang'] = ['stringValue' => $dataLama['kandang']['stringValue']];
            }

            // Menambahkan pengecekan untuk bobot_badan
            if (isset($data['bobot_badan']) && $data['bobot_badan'] != $dataLama['bobot_badan']['integerValue']) {
                $fieldsToUpdate['bobot_badan'] = ['integerValue' => (int)$data['bobot_badan']];
                $dataSepertiSebelumnya['bobot_badan'] = ['integerValue' => (int)$dataLama['bobot_badan']['integerValue']];
            }

            // Menambahkan pengecekan untuk keterangan
            if (isset($data['keterangan']) && $data['keterangan'] != $dataLama['keterangan']['stringValue']) {
                $fieldsToUpdate['keterangan'] = ['stringValue' => $data['keterangan']];
                $dataSepertiSebelumnya['keterangan'] = ['stringValue' => $dataLama['keterangan']['stringValue']];
            }

            // Menambahkan pengecekan untuk warna_eartag
            if (isset($data['warna_eartag']) && $data['warna_eartag'] != $dataLama['warna_eartag']['stringValue']) {
                $fieldsToUpdate['warna_eartag'] = ['stringValue' => $data['warna_eartag']];
                $dataSepertiSebelumnya['warna_eartag'] = ['stringValue' => $dataLama['warna_eartag']['stringValue']];
            }

            // Jika tidak ada perubahan apapun, return error
            if (empty($fieldsToUpdate)) {
                return response()->json(['message' => 'Tidak ada perubahan yang dicatat.'], 400);
            }

            // Ambil data lengkap dari form atau fallback ke data lama jika tidak dikirim
            $finalData = [
                'eartag' => ['stringValue' => $data['eartag'] ?? $dataLama['eartag']['stringValue'] ?? ''],
                'warna_eartag' => ['stringValue' => $data['warna_eartag'] ?? $dataLama['warna_eartag']['stringValue'] ?? ''],
                'kelamin' => ['stringValue' => $data['kelamin'] ?? $dataLama['kelamin']['stringValue'] ?? ''],
                'tanggal_lahir' => ['stringValue' => $data['tanggal_lahir'] ?? $dataLama['tanggal_lahir']['stringValue'] ?? ''],
                'induk_betina' => ['stringValue' => $data['induk_betina'] ?? $dataLama['induk_betina']['stringValue'] ?? ''],
                'induk_jantan' => ['stringValue' => $data['induk_jantan'] ?? $dataLama['induk_jantan']['stringValue'] ?? ''],
                'bobot_badan' => ['integerValue' => isset($data['bobot_badan']) ? (int)$data['bobot_badan'] : (int)($dataLama['bobot_badan']['integerValue'] ?? 0)],
                'kandang' => ['stringValue' => $data['kandang'] ?? $dataLama['kandang']['stringValue'] ?? ''],
                'keterangan' => ['stringValue' => $data['keterangan'] ?? $dataLama['keterangan']['stringValue'] ?? ''],
                'kesehatan' => ['stringValue' => $data['kesehatan'] ?? $dataLama['kesehatan']['stringValue'] ?? ''],
                'foto' => ['stringValue' => $path ?? ''],
            ];

            // Simpan ke riwayat (tanpa foto dalam riwayat)
            $riwayatData = [
                'fields' => [
                    'id_domba' => ['stringValue' => $id],
                    'eartag' => ['stringValue' => $data['eartag'] ?? $dataLama['eartag']['stringValue'] ?? ''],
                    'warna_eartag' => ['stringValue' => $data['warna_eartag'] ?? $dataLama['warna_eartag']['stringValue'] ?? ''],
                    'waktu' => ['timestampValue' => now()->toIso8601String()],
                    'data_sebelum' => ['mapValue' => ['fields' => $dataSepertiSebelumnya]],
                    'data_setelah' => ['mapValue' => ['fields' => $fieldsToUpdate]],
                    'oleh' => ['stringValue' => session('username', 'guest')],
                    'kategori' => ['stringValue' => 'Manajemen Domba'],
                    'deskripsi' => ['stringValue' => $request->input('deskripsi', 'Perubahan data manajemen')],
                ]
            ];

            Http::post("https://firestore.googleapis.com/v1/projects/dombaku-974fe/databases/(default)/documents/riwayat", $riwayatData);

            // Simpan perubahan ke manajemendomba
            Http::patch($docUrl, ['fields' => $finalData]);

            return response()->json(['message' => 'Berhasil update dan simpan riwayat.']);
        } catch (\Throwable $e) {
            Log::error('Update error: ' . $e->getMessage());
            return response()->json(['message' => 'Gagal update.'], 500);
        }
    }


    public function destroy($id)
    {
        $url = "$this->firebaseUrl/$id";
        Http::delete($url);
        return redirect()->back()->with('success', 'Data domba berhasil dihapus!');
    }
}
