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

            // Ambil data perkawinan
            $perkawinanResponse = Http::get('https://firestore.googleapis.com/v1/projects/dombaku-974fe/databases/(default)/documents/perkawinan');
            $perkawinanData = $perkawinanResponse->json();

            $eartagSudahKawin = [];

            if (isset($perkawinanData['documents'])) {
                foreach ($perkawinanData['documents'] as $perkawinan) {
                    $fields = $perkawinan['fields'] ?? [];
                    $tanggalSelesai = $fields['tanggal_selesai']['stringValue'] ?? null;

                    $sudahSelesai = false;
                    if ($tanggalSelesai) {
                        try {
                            $tanggalSelesaiCarbon = Carbon::parse($tanggalSelesai);
                            $sudahSelesai = $tanggalSelesaiCarbon->isPast();
                        } catch (\Exception $e) {
                            $sudahSelesai = false;
                        }
                    }

                    if ($sudahSelesai) {
                        $eartagPejantan = trim($fields['eartag_pejantan']['stringValue'] ?? '');
                        if ($eartagPejantan !== '') {
                            $eartagSudahKawin[] = $eartagPejantan;
                        }

                        $betinaArray = $fields['betina']['arrayValue']['values'] ?? [];
                        foreach ($betinaArray as $betinaItem) {
                            $eartagBetina = trim($betinaItem['stringValue'] ?? '');
                            if ($eartagBetina !== '') {
                                $eartagSudahKawin[] = $eartagBetina;
                            }
                        }
                    }
                }
            }

            // Hilangkan duplikat
            $eartagSudahKawin = array_unique($eartagSudahKawin);


            foreach ($data['documents'] as $document) {
                $fields = $document['fields'] ?? [];

                // Cek apakah nama_peternak sesuai dengan session
                $namaPeternak = $fields['nama_peternak']['stringValue'] ?? '';
                if ($namaPeternak !== session('nama_peternak')) {
                    continue; // Skip data yang tidak cocok
                }

                // Ambil tanggal lahir dari data (format awal diasumsikan yyyy-mm-dd atau bisa di-parse Carbon)
                $tanggalLahir = $fields['tanggal_lahir']['stringValue'] ?? '';
                $umur = '';
                $tanggalLahirFormatted = '';

                if ($tanggalLahir) {
                    $tanggalLahirCarbon = Carbon::parse($tanggalLahir);

                    // Format tanggal lahir menjadi d-m-Y
                    $tanggalLahirFormatted = $tanggalLahirCarbon->format('d-m-Y');

                    // Hitung umur
                    $diff = $tanggalLahirCarbon->diff(Carbon::now());
                    $tahun = $diff->y;
                    $bulan = $diff->m;
                    $hari = $diff->d;
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

                $eartagSekarang = $fields['eartag']['stringValue'] ?? '';

                // Ambil warna kakek dan buyut
                $warnaKakek = $eartagToWarna[$kakek] ?? '';
                $warnaBuyut = $eartagToWarna[$buyut] ?? '';

                $dombaData[] = [
                    'id' => basename($document['name']),
                    'eartag' => $fields['eartag']['stringValue'] ?? '',
                    'warna_eartag' => $fields['warna_eartag']['stringValue'] ?? '',
                    'kelamin' => $fields['kelamin']['stringValue'] ?? '',
                    'tanggal_lahir' => $tanggalLahirFormatted,
                    'umur' => $umur,
                    'induk_betina' => $indukBetina,
                    'induk_betina_id' => $dombaMap[$indukBetina]['id'] ?? null, // <- Tambahkan ini
                    'warna_induk_betina' => $warnaIndukBetina,
                    'induk_jantan' => $indukJantan,
                    'induk_jantan_id' => $dombaMap[$indukJantan]['id'] ?? null,
                    'warna_induk_jantan' => $warnaIndukJantan,
                    'bobot_badan' => $fields['bobot_badan']['doubleValue']
                        ?? $fields['bobot_badan']['integerValue']
                        ?? 0,
                    'kandang' => $fields['kandang']['stringValue'] ?? '',
                    'keterangan' => $fields['keterangan']['stringValue'] ?? '',
                    'kesehatan' => $fields['kesehatan']['stringValue'] ?? '',
                    'pernah_kawin' => in_array($eartagSekarang, $eartagSudahKawin, true),
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

        usort($dombaData, function ($a, $b) {
            return strcmp($a['eartag'], $b['eartag']); // ASC berdasarkan eartag
        });

        return view('manajemendomba', compact('dombaData'));
    }

    public function store(Request $request)
    {
        // ✅ Validasi input
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
            'dokumentasi' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048', // max 2MB
        ]);

        // ✅ Ubah koma menjadi titik agar valid sebagai float
        $bobot_badan = str_replace(',', '.', $request->bobot_badan);

        // ✅ Proses file dokumentasi (foto)
        if ($request->hasFile('dokumentasi') && $request->file('dokumentasi')->isValid()) {
            $file = $request->file('dokumentasi');
            $path = $file->store('dokumen-domba', 'public'); // path tersimpan di storage/app/public/dokumen-domba
        } else {
            $path = 'default-image.jpg'; // default jika tidak upload file
        }

        // ✅ Siapkan data untuk dikirim ke Firestore
        $data = [
            'fields' => [
                'eartag' => ['stringValue' => (string) $request->eartag],
                'warna_eartag' => ['stringValue' => (string) $request->warna_eartag],
                'kelamin' => ['stringValue' => (string) $request->kelamin],
                'tanggal_lahir' => ['stringValue' => (string) $request->tanggal_lahir],
                'induk_betina' => ['stringValue' => (string) ($request->induk_betina ?? '')],
                'induk_jantan' => ['stringValue' => (string) ($request->induk_jantan ?? '')],
                'bobot_badan' => ['doubleValue' => (float) $bobot_badan],
                'kandang' => ['stringValue' => (string) ($request->kandang ?? '')],
                'keterangan' => ['stringValue' => (string) ($request->keterangan ?? '')],
                'kesehatan' => ['stringValue' => (string) $request->kesehatan],
                'foto' => ['stringValue' => $path],
                'nama_peternak' => ['stringValue' => (string) session('nama_peternak')],
            ]
        ];

        // ✅ Kirim ke Firestore
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
        $tanggalLahirRaw = $fields['tanggal_lahir']['stringValue'] ?? '';
        $tanggalLahirFormatted = '';
        $umur = '';

        if ($tanggalLahirRaw) {
            try {
                $tanggalLahirCarbon = Carbon::parse($tanggalLahirRaw);
                $tanggalLahirFormatted = $tanggalLahirCarbon->format('d-m-Y');

                $diff = $tanggalLahirCarbon->diff(Carbon::now());
                $umur = "{$diff->y} Tahun, {$diff->m} Bulan, {$diff->d} Hari";
            } catch (\Exception $e) {
                // fallback jika gagal parsing
                $tanggalLahirFormatted = $tanggalLahirRaw;
                $umur = '-';
            }
        }

        $domba = [
            'id' => $id,
            'eartag' => $fields['eartag']['stringValue'] ?? '',
            'kelamin' => $fields['kelamin']['stringValue'] ?? '',
            'tanggal_lahir' => $tanggalLahirFormatted,
            'umur' => $umur,
            'induk_betina' => $fields['induk_betina']['stringValue'] ?? '',
            'induk_jantan' => $fields['induk_jantan']['stringValue'] ?? '',
            'bobot_badan' => $fields['bobot_badan']['doubleValue']
                ?? $fields['bobot_badan']['integerValue']
                ?? 0,
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
                $tanggalLahirRaw = $f['tanggal_lahir']['stringValue'] ?? '';
                $tanggalLahirFormatted = '';

                if ($tanggalLahirRaw) {
                    try {
                        $tanggalLahirFormatted = Carbon::parse($tanggalLahirRaw)->format('d-m-Y');
                    } catch (\Exception $e) {
                        // Kalau gagal parsing, tetap pakai tanggal asli
                        $tanggalLahirFormatted = $tanggalLahirRaw;
                    }
                }

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
                $tanggalLahirRaw = $f['tanggal_lahir']['stringValue'] ?? '';
                $tanggalLahirFormatted = '';

                if ($tanggalLahirRaw) {
                    try {
                        $tanggalLahirFormatted = Carbon::parse($tanggalLahirRaw)->format('d-m-Y');
                    } catch (\Exception $e) {
                        // Kalau gagal parsing, tetap pakai tanggal asli
                        $tanggalLahirFormatted = $tanggalLahirRaw;
                    }
                }

                $anak[] = [
                    'id' => basename($doc['name']),
                    'eartag' => $eartag,
                    'kelamin' => $f['kelamin']['stringValue'] ?? '',
                    'tanggal_lahir' => $tanggalLahirFormatted,
                    'induk_betina' => $f['induk_betina']['stringValue'] ?? '',
                    'induk_jantan' => $f['induk_jantan']['stringValue'] ?? '',
                    'warna_eartag' => $f['warna_eartag']['stringValue'] ?? ''
                ];
            }

            // Ambil data ayah terlebih dahulu
            foreach ($allDomba as $doc) {
                $f = $doc['fields'] ?? [];
                $eartag = $f['eartag']['stringValue'] ?? '';

                $tanggalLahirRaw = $f['tanggal_lahir']['stringValue'] ?? '';
                $tanggalLahirFormatted = '';

                if ($tanggalLahirRaw) {
                    try {
                        $tanggalLahirFormatted = Carbon::parse($tanggalLahirRaw)->format('d-m-Y');
                    } catch (\Exception $e) {
                        // Jika parsing gagal, pakai tanggal asli
                        $tanggalLahirFormatted = $tanggalLahirRaw;
                    }
                }

                if ($eartag === $domba['induk_jantan']) {
                    $ayah = [
                        'id' => basename($doc['name']),
                        'eartag' => $eartag,
                        'kelamin' => $f['kelamin']['stringValue'] ?? '',
                        'tanggal_lahir' => $tanggalLahirFormatted,
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

                    $tanggalLahirRaw = $f['tanggal_lahir']['stringValue'] ?? '';
                    $tanggalLahirFormatted = '';

                    if ($tanggalLahirRaw) {
                        try {
                            $tanggalLahirFormatted = Carbon::parse($tanggalLahirRaw)->format('d-m-Y');
                        } catch (\Exception $e) {
                            // Jika parsing gagal, pakai tanggal asli
                            $tanggalLahirFormatted = $tanggalLahirRaw;
                        }
                    }

                    if ($eartag === $ayah['induk_jantan']) {
                        $kakek = [
                            'id' => basename($doc['name']),
                            'eartag' => $eartag,
                            'kelamin' => $f['kelamin']['stringValue'] ?? '',
                            'tanggal_lahir' => $tanggalLahirFormatted,
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

                    $tanggalLahirRaw = $f['tanggal_lahir']['stringValue'] ?? '';
                    $tanggalLahirFormatted = '';

                    if ($tanggalLahirRaw) {
                        try {
                            $tanggalLahirFormatted = Carbon::parse($tanggalLahirRaw)->format('d-m-Y');
                        } catch (\Exception $e) {
                            // Jika parsing gagal, pakai tanggal asli
                            $tanggalLahirFormatted = $tanggalLahirRaw;
                        }
                    }

                    if ($eartag === $kakek['induk_jantan']) {
                        $buyut = [
                            'id' => basename($doc['name']),
                            'eartag' => $eartag,
                            'kelamin' => $f['kelamin']['stringValue'] ?? '',
                            'tanggal_lahir' => $tanggalLahirFormatted,
                            'induk_betina' => $f['induk_betina']['stringValue'] ?? '',
                            'induk_jantan' => $f['induk_jantan']['stringValue'] ?? '',
                            'warna_eartag' => $f['warna_eartag']['stringValue'] ?? ''
                        ];
                        break; // keluar setelah ketemu buyut
                    }
                }
            }
        }

        $indukBetinaData = null;
        $indukJantanData = null;
        $indukBetinaKakekData = null;
        $indukJantanKakekData = null;
        $indukBetinaBuyutData = null;
        $indukJantanBuyutData = null;
        $indukBetinaAnakData = null;
        $indukJantanAnakData = null;
        $indukBetinaSaudaraData = null;
        $indukJantanSaudaraData = null;
        $indukBetinaSepupuBuyutData = null;
        $indukJantanSepupuBuyutData = null;
        $indukBetinaSepupuKakekData = null;
        $indukJantanSepupuKakekData = null;

        if ($ayah) {
            foreach ($allDomba as $doc) {
                $f = $doc['fields'] ?? [];
                $eartag = $f['eartag']['stringValue'] ?? '';

                if ($eartag === $ayah['induk_betina']) {
                    $indukBetinaData = [
                        'id' => basename($doc['name']),
                        'eartag' => $eartag,
                        'warna_eartag' => $f['warna_eartag']['stringValue'] ?? ''
                    ];
                }

                if ($eartag === $ayah['induk_jantan']) {
                    $indukJantanData = [
                        'id' => basename($doc['name']),
                        'eartag' => $eartag,
                        'warna_eartag' => $f['warna_eartag']['stringValue'] ?? ''
                    ];
                }
            }
        }

        if ($kakek) {
            foreach ($allDomba as $doc) {
                $f = $doc['fields'] ?? [];
                $eartag = $f['eartag']['stringValue'] ?? '';

                if ($eartag === $kakek['induk_betina']) {
                    $indukBetinaKakekData = [
                        'id' => basename($doc['name']),
                        'eartag' => $eartag,
                        'warna_eartag' => $f['warna_eartag']['stringValue'] ?? ''
                    ];
                }

                if ($eartag === $kakek['induk_jantan']) {
                    $indukJantanKakekData = [
                        'id' => basename($doc['name']),
                        'eartag' => $eartag,
                        'warna_eartag' => $f['warna_eartag']['stringValue'] ?? ''
                    ];
                }
            }
        }

        if ($buyut) {
            foreach ($allDomba as $doc) {
                $f = $doc['fields'] ?? [];
                $eartag = $f['eartag']['stringValue'] ?? '';

                if ($eartag === $buyut['induk_betina']) {
                    $indukBetinaBuyutData = [
                        'id' => basename($doc['name']),
                        'eartag' => $eartag,
                        'warna_eartag' => $f['warna_eartag']['stringValue'] ?? ''
                    ];
                }

                if ($eartag === $buyut['induk_jantan']) {
                    $indukJantanBuyutData = [
                        'id' => basename($doc['name']),
                        'eartag' => $eartag,
                        'warna_eartag' => $f['warna_eartag']['stringValue'] ?? ''
                    ];
                }
            }
        }

        if (!empty($anak)) {
            foreach ($anak as $anakDomba) {
                foreach ($allDomba as $doc) {
                    $f = $doc['fields'] ?? [];
                    $eartag = $f['eartag']['stringValue'] ?? '';

                    // Cek dan simpan induk betina tanpa duplikat
                    if ($eartag === ($anakDomba['induk_betina'] ?? '') && !isset($indukBetinaAnakData[$eartag])) {
                        $indukBetinaAnakData[$eartag] = [
                            'id' => basename($doc['name']),
                            'eartag' => $eartag,
                            'warna_eartag' => $f['warna_eartag']['stringValue'] ?? ''
                        ];
                    }

                    // Cek dan simpan induk jantan tanpa duplikat
                    if ($eartag === ($anakDomba['induk_jantan'] ?? '') && !isset($indukJantanAnakData[$eartag])) {
                        $indukJantanAnakData[$eartag] = [
                            'id' => basename($doc['name']),
                            'eartag' => $eartag,
                            'warna_eartag' => $f['warna_eartag']['stringValue'] ?? ''
                        ];
                    }
                }
            }
        }

        if (!empty($saudara)) {
            foreach ($saudara as $sd) {
                foreach ($allDomba as $doc) {
                    $f = $doc['fields'] ?? [];
                    $eartag = $f['eartag']['stringValue'] ?? '';

                    // Cek dan simpan induk betina tanpa duplikat
                    if (
                        $eartag === ($sd['induk_betina'] ?? '') &&
                        !isset($indukBetinaSaudaraData[$eartag])
                    ) {
                        $indukBetinaSaudaraData[$eartag] = [
                            'id' => basename($doc['name']),
                            'eartag' => $eartag,
                            'warna_eartag' => $f['warna_eartag']['stringValue'] ?? ''
                        ];
                    }

                    // Cek dan simpan induk jantan tanpa duplikat
                    if (
                        $eartag === ($sd['induk_jantan'] ?? '') &&
                        !isset($indukJantanSaudaraData[$eartag])
                    ) {
                        $indukJantanSaudaraData[$eartag] = [
                            'id' => basename($doc['name']),
                            'eartag' => $eartag,
                            'warna_eartag' => $f['warna_eartag']['stringValue'] ?? ''
                        ];
                    }
                }
            }
        }

        if (!empty($sepupuDariKakek)) {
            foreach ($sepupuDariKakek as $sepupu) {
                foreach ($allDomba as $doc) {
                    $f = $doc['fields'] ?? [];
                    $eartag = $f['eartag']['stringValue'] ?? '';

                    // Cek dan simpan induk betina tanpa duplikat
                    if (
                        $eartag === ($sepupu['induk_betina'] ?? '') &&
                        !isset($indukBetinaSepupuKakekData[$eartag])
                    ) {
                        $indukBetinaSepupuKakekData[$eartag] = [
                            'id' => basename($doc['name']),
                            'eartag' => $eartag,
                            'warna_eartag' => $f['warna_eartag']['stringValue'] ?? ''
                        ];
                    }

                    // Cek dan simpan induk jantan tanpa duplikat
                    if (
                        $eartag === ($sepupu['induk_jantan'] ?? '') &&
                        !isset($indukJantanSepupuKakekData[$eartag])
                    ) {
                        $indukJantanSepupuKakekData[$eartag] = [
                            'id' => basename($doc['name']),
                            'eartag' => $eartag,
                            'warna_eartag' => $f['warna_eartag']['stringValue'] ?? ''
                        ];
                    }
                }
            }
        }

        if (!empty($sepupuDariBuyut)) {
            foreach ($sepupuDariBuyut as $sepupu) {
                foreach ($allDomba as $doc) {
                    $f = $doc['fields'] ?? [];
                    $eartag = $f['eartag']['stringValue'] ?? '';

                    // Cek dan simpan induk betina tanpa duplikat
                    if (
                        $eartag === ($sepupu['induk_betina'] ?? '') &&
                        !isset($indukBetinaSepupuBuyutData[$eartag])
                    ) {
                        $indukBetinaSepupuBuyutData[$eartag] = [
                            'id' => basename($doc['name']),
                            'eartag' => $eartag,
                            'warna_eartag' => $f['warna_eartag']['stringValue'] ?? ''
                        ];
                    }

                    // Cek dan simpan induk jantan tanpa duplikat
                    if (
                        $eartag === ($sepupu['induk_jantan'] ?? '') &&
                        !isset($indukJantanSepupuBuyutData[$eartag])
                    ) {
                        $indukJantanSepupuBuyutData[$eartag] = [
                            'id' => basename($doc['name']),
                            'eartag' => $eartag,
                            'warna_eartag' => $f['warna_eartag']['stringValue'] ?? ''
                        ];
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

                $tanggalLahirRaw = $f['tanggal_lahir']['stringValue'] ?? '';
                $tanggalLahirFormatted = '';

                if ($tanggalLahirRaw) {
                    try {
                        $tanggalLahirFormatted = Carbon::parse($tanggalLahirRaw)->format('d-m-Y');
                    } catch (\Exception $e) {
                        // Jika parsing gagal, pakai tanggal asli
                        $tanggalLahirFormatted = $tanggalLahirRaw;
                    }
                }

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

                $tanggalLahirRaw = $f['tanggal_lahir']['stringValue'] ?? '';
                $tanggalLahirFormatted = '';

                if ($tanggalLahirRaw) {
                    try {
                        $tanggalLahirFormatted = Carbon::parse($tanggalLahirRaw)->format('d-m-Y');
                    } catch (\Exception $e) {
                        // Jika parsing gagal, pakai tanggal asli
                        $tanggalLahirFormatted = $tanggalLahirRaw;
                    }
                }

                if (in_array($indukJantan, $saudaraKakek)) {
                    $sepupuDariKakek[] = [
                        'id' => basename($doc['name']),
                        'eartag' => $eartag,
                        'kelamin' => $f['kelamin']['stringValue'] ?? '',
                        'tanggal_lahir' => $tanggalLahirFormatted,
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

        $tanggalLahirRaw = $f['tanggal_lahir']['stringValue'] ?? '';
        $tanggalLahirFormatted = '';

        if ($tanggalLahirRaw) {
            try {
                $tanggalLahirFormatted = Carbon::parse($tanggalLahirRaw)->format('d-m-Y');
            } catch (\Exception $e) {
                // Jika parsing gagal, pakai tanggal asli
                $tanggalLahirFormatted = $tanggalLahirRaw;
            }
        }

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
                        'tanggal_lahir' => $tanggalLahirFormatted,
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
            'indukBetinaData',
            'indukJantanData',
            'indukBetinaKakekData',
            'indukJantanKakekData',
            'indukBetinaBuyutData',
            'indukJantanBuyutData',
            'indukBetinaAnakData',
            'indukJantanAnakData',
            'indukJantanSaudaraData',
            'indukBetinaSaudaraData',
            'indukBetinaSepupuBuyutData',
            'indukJantanSepupuBuyutData',
            'indukBetinaSepupuKakekData',
            'indukBetinaSepupuKakekData',
            'sepupuDariKakek',
            'sepupuDariBuyut',
            'keturunan',
            'generations'
        ));
    }

    public function update(Request $request, $id)
    {
        $data = $request->except(['_token', '_method', 'deskripsi']); // Hindari agar deskripsi tidak masuk update

        // Ubah koma menjadi titik agar valid sebagai float
        if (isset($data['bobot_badan'])) {
            $data['bobot_badan'] = str_replace(',', '.', $data['bobot_badan']);
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

            if (!empty($data['documents'])) {
                foreach ($data['documents'] as $doc) {
                    $id = basename($doc['name']); // Ambil ID dokumen dari path lengkap

                    // Jangan ambil dari field 'nama_kandang', ambil dari field 'id_kandang' di data lama dan input
                    $kandangSebelumnya = $dataLama['id_kandang']['stringValue'] ?? null;
                    $kandangBaru = $data['id_kandang'] ?? $kandangSebelumnya;

                    // Ambil eartag dari data baru dulu, fallback ke data lama
                    $eartagDomba = $data['eartag'] ?? ($dataLama['eartag']['stringValue'] ?? null);

                    Log::info("ID Kandang Sebelumnya: " . ($kandangSebelumnya ?? 'NULL'));
                    Log::info("ID Kandang Baru: " . ($kandangBaru ?? 'NULL'));
                    Log::info("Eartag Domba: " . ($eartagDomba ?? 'NULL'));

                    // Jika ada perubahan kandang dan eartag tersedia, lakukan update list eartag pada kandang lama dan baru
                    if (isset($data['id_kandang']) && $kandangSebelumnya !== $kandangBaru && $eartagDomba !== null) {

                        // URL API Firestore kandang lama
                        $kandangLamaUrl = "https://firestore.googleapis.com/v1/projects/dombaku-974fe/databases/(default)/documents/manajemenkandang/{$kandangSebelumnya}";

                        Log::info("Ambil data kandang lama dari: $kandangLamaUrl");
                        $resLama = Http::get($kandangLamaUrl);

                        if ($resLama->ok()) {
                            $fieldsLama = $resLama->json()['fields'] ?? [];
                            $eartagsLama = $fieldsLama['eartag_domba']['arrayValue']['values'] ?? [];

                            Log::info('Eartag sebelum hapus di kandang lama:', $eartagsLama);

                            // Filter hapus eartag domba dari kandang lama
                            $eartagsBaruLama = array_filter($eartagsLama, function ($tag) use ($eartagDomba) {
                                return ($tag['stringValue'] ?? '') !== $eartagDomba;
                            });

                            Log::info('Eartag setelah hapus di kandang lama:', array_values($eartagsBaruLama));

                            $patchDataLama = [
                                'fields' => [
                                    'eartag_domba' => [
                                        'arrayValue' => ['values' => array_values($eartagsBaruLama)]
                                    ]
                                ]
                            ];

                            Log::info("Kirim PATCH update kandang lama dengan data:", $patchDataLama);
                            $patchLama = Http::patch($kandangLamaUrl, $patchDataLama);

                            Log::info("Response PATCH kandang lama: " . $patchLama->status() . ' - ' . $patchLama->body());
                        } else {
                            Log::error("Gagal mengambil data kandang lama. Response: " . $resLama->status() . ' - ' . $resLama->body());
                        }

                        // URL API Firestore kandang baru
                        $kandangBaruUrl = "https://firestore.googleapis.com/v1/projects/dombaku-974fe/databases/(default)/documents/manajemenkandang/{$kandangBaru}";

                        Log::info("Ambil data kandang baru dari: $kandangBaruUrl");
                        $resBaru = Http::get($kandangBaruUrl);

                        if ($resBaru->ok()) {
                            $fieldsBaru = $resBaru->json()['fields'] ?? [];
                            $eartagsBaru = $fieldsBaru['eartag_domba']['arrayValue']['values'] ?? [];

                            Log::info('Eartag sebelum tambah di kandang baru:', $eartagsBaru);

                            // Cek apakah eartag sudah ada di kandang baru
                            $existingTags = array_map(fn($item) => $item['stringValue'] ?? '', $eartagsBaru);

                            if (!in_array($eartagDomba, $existingTags)) {
                                $eartagsBaru[] = ['stringValue' => $eartagDomba];
                                Log::info("Eartag {$eartagDomba} ditambahkan ke kandang baru.");
                            } else {
                                Log::info("Eartag {$eartagDomba} sudah ada di kandang baru, tidak ditambahkan.");
                            }

                            $patchDataBaru = [
                                'fields' => [
                                    'eartag_domba' => [
                                        'arrayValue' => ['values' => $eartagsBaru]
                                    ]
                                ]
                            ];

                            Log::info("Kirim PATCH update kandang baru dengan data:", $patchDataBaru);
                            $patchBaru = Http::patch($kandangBaruUrl, $patchDataBaru);

                            Log::info("Response PATCH kandang baru: " . $patchBaru->status() . ' - ' . $patchBaru->body());
                        } else {
                            Log::error("Gagal mengambil data kandang baru. Response: " . $resBaru->status() . ' - ' . $resBaru->body());
                        }
                    } else {
                        Log::info('Tidak ada perpindahan kandang yang terjadi atau eartag tidak tersedia.');
                    }
                }
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
            if (isset($data['bobot_badan'])) {
                $bobotLama = $dataLama['bobot_badan']['doubleValue']
                    ?? $dataLama['bobot_badan']['integerValue']
                    ?? 0;

                if ((float)$data['bobot_badan'] != (float)$bobotLama) {
                    $fieldsToUpdate['bobot_badan'] = ['doubleValue' => (float)$data['bobot_badan']];
                    $dataSepertiSebelumnya['bobot_badan'] = ['doubleValue' => (float)$bobotLama];
                }
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

            // Tambahkan pengecekan jika foto baru diupload
            if (isset($dataLama['foto']['stringValue']) && $path !== $dataLama['foto']['stringValue']) {
                $fieldsToUpdate['foto'] = ['stringValue' => $path];
                $dataSepertiSebelumnya['foto'] = ['stringValue' => $dataLama['foto']['stringValue']];
            }

            // Jika tidak ada perubahan apapun, return error
            if (empty($fieldsToUpdate)) {
                return response()->json(['message' => 'Tidak ada perubahan yang dicatat.'], 200);
            }

            if (is_null($path) || $path === '') {
                $path = 'default-image.jpg'; // atau string kosong '', asal BUKAN null
            }

            // Ambil data lengkap dari form atau fallback ke data lama jika tidak dikirim
            $finalData = [
                'eartag' => ['stringValue' => $data['eartag'] ?? $dataLama['eartag']['stringValue'] ?? ''],
                'warna_eartag' => ['stringValue' => $data['warna_eartag'] ?? $dataLama['warna_eartag']['stringValue'] ?? ''],
                'kelamin' => ['stringValue' => $data['kelamin'] ?? $dataLama['kelamin']['stringValue'] ?? ''],
                'tanggal_lahir' => ['stringValue' => $data['tanggal_lahir'] ?? $dataLama['tanggal_lahir']['stringValue'] ?? ''],
                'induk_betina' => ['stringValue' => $data['induk_betina'] ?? $dataLama['induk_betina']['stringValue'] ?? ''],
                'induk_jantan' => ['stringValue' => $data['induk_jantan'] ?? $dataLama['induk_jantan']['stringValue'] ?? ''],
                'bobot_badan' => ['doubleValue' => isset($data['bobot_badan'])
                    ? (float) $data['bobot_badan']
                    : (float) ($dataLama['bobot_badan']['doubleValue']
                        ?? $dataLama['bobot_badan']['integerValue']
                        ?? 0)],
                'kandang' => ['stringValue' => $data['kandang'] ?? $dataLama['kandang']['stringValue'] ?? ''],
                'keterangan' => ['stringValue' => $data['keterangan'] ?? $dataLama['keterangan']['stringValue'] ?? ''],
                'kesehatan' => ['stringValue' => $data['kesehatan'] ?? $dataLama['kesehatan']['stringValue'] ?? ''],
                'foto' => ['stringValue' => $path ?? ''],
                'nama_peternak' => ['stringValue' => (string) session('nama_peternak')],
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
                    'nama_peternak' => ['stringValue' => (string) session('nama_peternak')],
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
