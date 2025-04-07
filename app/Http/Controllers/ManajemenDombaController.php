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

        if (isset($data['documents'])) {
            foreach ($data['documents'] as $document) {
                $fields = $document['fields'] ?? [];
                // Ambil tanggal lahir
                $tanggalLahir = $fields['tanggal_lahir']['stringValue'] ?? '';
                $umur = '';
                if ($tanggalLahir) {
                    $tanggalLahirCarbon = Carbon::parse($tanggalLahir);
                    $umur = $tanggalLahirCarbon->diff(Carbon::now());
                    $tahun = $umur->y;
                    $bulan = $umur->m;
                    $hari = $umur->d;
                    $umur = "{$tahun} Tahun, {$bulan} Bulan, {$hari} Hari"; // Format umur
                }

                $dombaData[] = [
                    'id' => basename($document['name']),
                    'eartag' => $fields['eartag']['stringValue'] ?? '',
                    'kelamin' => $fields['kelamin']['stringValue'] ?? '',
                    'tanggal_lahir' => $tanggalLahir,
                    'umur' => $umur, // Menambahkan umur yang dihitung
                    'induk_betina' => $fields['induk_betina']['stringValue'] ?? '',
                    'induk_jantan' => $fields['induk_jantan']['stringValue'] ?? '',
                    'bobot_badan' => $fields['bobot_badan']['integerValue'] ?? 0,
                    'kandang' => $fields['kandang']['stringValue'] ?? '',
                    'keterangan' => $fields['keterangan']['stringValue'] ?? '',
                    'kesehatan' => $fields['kesehatan']['stringValue'] ?? '',
                    'foto' => $fields['foto']['stringValue'] ?? 'default-image.jpg'
                ];
            }
        }

        return view('manajemendomba', compact('dombaData'));
    }

    public function store(Request $request)
    {
        // Validasi form jika diperlukan
        $request->validate([
            'eartag' => 'required|string|max:255',
            'kelamin' => 'required|string',
            'tanggal_lahir' => 'required|date',
            'bobot_badan' => 'required|numeric',
            'kandang' => 'required|string',
            'dokumentasi' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        // Menyimpan file dokumentasi ke storage
        $file = $request->file('dokumentasi');
        $path = $file->store('dokumen-domba', 'public'); // Menyimpan file di storage/app/public

        // Data untuk dikirim ke Firebase
        $data = [
            'fields' => [
                'eartag' => ['stringValue' => $request->eartag],
                'kelamin' => ['stringValue' => $request->kelamin],
                'tanggal_lahir' => ['stringValue' => $request->tanggal_lahir],
                'induk_betina' => ['stringValue' => $request->induk_betina],
                'induk_jantan' => ['stringValue' => $request->induk_jantan],
                'bobot_badan' => ['integerValue' => $request->bobot_badan],
                'kandang' => ['stringValue' => $request->kandang],
                'keterangan' => ['stringValue' => $request->keterangan],
                'kesehatan' => ['stringValue' => $request->kesehatan],
                'foto' => ['stringValue' => $path], // Menyimpan path file foto di Firebase
            ]
        ];

        // Mengirim data ke Firebase
        $response = Http::post($this->firebaseUrl, $data);

        // Mengalihkan kembali dengan pesan sukses
        return redirect()->back()->with('success', 'Data domba berhasil ditambahkan!');
    }

    public function show($id)
    {
        $url = "$this->firebaseUrl/$id";
        $response = Http::get($url);
        $document = $response->json();

        if (!isset($document['fields'])) {
            abort(404);
        }

        // Ambil data domba utama
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
            'foto' => $fields['foto']['stringValue'] ?? 'default-image.jpg'
        ];

        // Ambil semua data untuk mencari saudara & anak
        $allDomba = Http::get($this->firebaseUrl)->json()['documents'] ?? [];
        $saudara = [];
        $anak = [];

        foreach ($allDomba as $doc) {
            $f = $doc['fields'] ?? [];
            if (($f['induk_betina']['stringValue'] ?? '') == $domba['induk_betina'] &&
                ($f['induk_jantan']['stringValue'] ?? '') == $domba['induk_jantan'] &&
                ($f['eartag']['stringValue'] ?? '') !== $domba['eartag']
            ) {
                $saudara[] = [
                    'eartag' => $f['eartag']['stringValue'] ?? '',
                    'kelamin' => $f['kelamin']['stringValue'] ?? '',
                    'tanggal_lahir' => $f['tanggal_lahir']['stringValue'] ?? '',
                    'induk_betina' => $f['induk_betina']['stringValue'] ?? '',
                    'induk_jantan' => $f['induk_jantan']['stringValue'] ?? '',
                ];
            }
            if (($f['induk_betina']['stringValue'] ?? '') == $domba['eartag'] ||
                ($f['induk_jantan']['stringValue'] ?? '') == $domba['eartag']
            ) {
                $anak[] = [
                    'eartag' => $f['eartag']['stringValue'] ?? '',
                    'kelamin' => $f['kelamin']['stringValue'] ?? '',
                    'tanggal_lahir' => $f['tanggal_lahir']['stringValue'] ?? '',
                    'induk_betina' => $f['induk_betina']['stringValue'] ?? '',
                    'induk_jantan' => $f['induk_jantan']['stringValue'] ?? '',
                ];
            }
        }

        return view('detaildomba', compact('domba', 'saudara', 'anak'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->except(['_token', '_method', 'deskripsi']); // hindari agar deskripsi tidak masuk update

        if (empty($data) && !$request->hasFile('dokumentasi')) {
            return response()->json(['message' => 'Tidak ada data yang dikirim.'], 400);
        }

        try {
            $docUrl = "https://firestore.googleapis.com/v1/projects/dombaku-974fe/databases/(default)/documents/manajemendomba/{$id}";

            // Ambil data lama sebelum update
            $response = Http::get($docUrl);
            $dataLama = $response->json()['fields'] ?? [];

            // Jika ada file baru, simpan dan update path
            if ($request->hasFile('dokumentasi')) {
                $request->validate([
                    'dokumentasi' => 'file|mimes:jpg,jpeg,png,pdf|max:2048',
                ]);

                $file = $request->file('dokumentasi');
                $path = $file->store('dokumen-domba', 'public');

                $data['foto'] = $path;
            } else {
                // Kalau tidak upload dokumentasi baru, pakai path lama (biar gak hilang)
                if (isset($dataLama['foto']['stringValue'])) {
                    $data['foto'] = $dataLama['foto']['stringValue'];
                }
            }

            // Ambil data lengkap dari form atau fallback ke data lama jika tidak dikirim
            $finalData = [
                'eartag' => ['stringValue' => $data['eartag'] ?? $dataLama['eartag']['stringValue'] ?? ''],
                'kelamin' => ['stringValue' => $data['kelamin'] ?? $dataLama['kelamin']['stringValue'] ?? ''],
                'tanggal_lahir' => ['stringValue' => $data['tanggal_lahir'] ?? $dataLama['tanggal_lahir']['stringValue'] ?? ''],
                'induk_betina' => ['stringValue' => $data['induk_betina'] ?? $dataLama['induk_betina']['stringValue'] ?? ''],
                'induk_jantan' => ['stringValue' => $data['induk_jantan'] ?? $dataLama['induk_jantan']['stringValue'] ?? ''],
                'bobot_badan' => ['integerValue' => isset($data['bobot_badan']) ? (int)$data['bobot_badan'] : (int)($dataLama['bobot_badan']['integerValue'] ?? 0)],
                'kandang' => ['stringValue' => $data['kandang'] ?? $dataLama['kandang']['stringValue'] ?? ''],
                'keterangan' => ['stringValue' => $data['keterangan'] ?? $dataLama['keterangan']['stringValue'] ?? ''],
                'kesehatan' => ['stringValue' => $data['kesehatan'] ?? $dataLama['kesehatan']['stringValue'] ?? ''],
                'foto' => ['stringValue' => $data['foto'] ?? ''],
            ];

            // Simpan ke riwayat
            $riwayatData = [
                'fields' => [
                    'id_domba' => ['stringValue' => $id],
                    'waktu' => ['timestampValue' => now()->toIso8601String()],
                    'data_sebelum' => ['mapValue' => ['fields' => $dataLama]],
                    'data_setelah' => ['mapValue' => ['fields' => $finalData]],
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
