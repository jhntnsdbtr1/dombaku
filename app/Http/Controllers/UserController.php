<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;


class UserController extends Controller
{
    // Menampilkan daftar pengguna
    private $firebaseUrl = 'https://firestore.googleapis.com/v1/projects/dombaku-974fe/databases/(default)/documents/users';

    public function index()
    {
        $response = Http::get($this->firebaseUrl);
        $data = $response->json();

        $userList = collect($data['documents'] ?? [])
            ->filter(function ($user) {
                $fields = $user['fields'] ?? [];
                $namaPeternak = $fields['nama_peternak']['stringValue'] ?? '';
                return $namaPeternak === session('nama_peternak'); // Filter sesuai session
            })
            ->map(function ($user) {
                $fields = $user['fields'] ?? [];
                return [
                    'id' => basename($user['name']), // Ambil ID dari 'name'
                    'email' => $fields['email']['stringValue'] ?? 'Tidak ada email',
                    'username' => $fields['username']['stringValue'] ?? 'Tidak ada username',
                    'role' => $fields['role']['stringValue'] ?? 'Tidak ada role',
                    'status' => $fields['status']['stringValue'] ?? 'Tidak ada status',
                    'createdAt' => $fields['createdAt']['stringValue'] ?? now()->toDateTimeString(),
                ];
            })
            ->values()  // <- reset keys mulai dari 0
            ->toArray();

        return view('users', ['userList' => $userList]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6',
            'role' => 'required|string',
            'status' => 'required|string',
            'username' => 'required|string',
        ]);

        $firebaseAuthUrl = 'https://identitytoolkit.googleapis.com/v1/accounts:signUp?key=AIzaSyCruf8kD8sa1om5hM-ZWkQnnpm7n6vcJH4';

        $firebaseData = [
            'email' => $request->email,
            'password' => $request->password,
            'returnSecureToken' => true,
        ];

        $firebaseResponse = Http::post($firebaseAuthUrl, $firebaseData)->json();

        // Tambahkan log error untuk debugging
        if (!isset($firebaseResponse['idToken'])) {
            return response()->json([
                'message' => 'Gagal membuat akun Firebase',
                'error' => $firebaseResponse // Tambahkan untuk melihat respon dari Firebase
            ], 400);
        }

        $createdAt = now('Asia/Jakarta')->format('Y-m-d H:i:s');

        $data = [
            "fields" => [
                "email" => ["stringValue" => $request->email],
                "username" => ["stringValue" => $request->username],
                "role" => ["stringValue" => $request->role],
                "status" => ["stringValue" => $request->status],
                "password" => ["stringValue" => bcrypt($request->password)],
                "createdAt" => ["stringValue" => $createdAt],
                "firebaseToken" => ["stringValue" => $firebaseResponse['idToken']],
                'nama_peternak' => ['stringValue' => (string) session('nama_peternak')],
            ]
        ];

        $userResponse = Http::post($this->firebaseUrl, $data)->json();

        if (!isset($userResponse['name'])) {
            return response()->json(['message' => 'Gagal menambah pengguna ke Firestore'], 400);
        }

        $userId = basename($userResponse['name']);

        return response()->json(['message' => 'Pengguna berhasil ditambahkan', 'user' => compact('userId', 'createdAt')]);
    }

    public function show($id)
    {
        $response = Http::get("{$this->firebaseUrl}/{$id}");

        if ($response->failed()) {
            return response()->json(['message' => 'Pengguna tidak ditemukan'], 404);
        }

        $data = $response->json();
        return response()->json($data['fields'] ?? []);
    }

    public function update(Request $request, $id)
    {
        $data = [
            "fields" => [
                "email" => ["stringValue" => $request->email],
                "username" => ["stringValue" => $request->username],
                "role" => ["stringValue" => $request->role],
                "status" => ["stringValue" => $request->status],
                "password" => ["stringValue" => bcrypt($request->password)],
                'nama_peternak' => ['stringValue' => (string) session('nama_peternak')],
            ]
        ];

        $response = Http::patch("{$this->firebaseUrl}/{$id}", $data);

        if ($response->failed()) {
            return response()->json(['message' => 'Gagal memperbarui pengguna'], 400);
        }

        return response()->json(['message' => 'Data berhasil diperbarui']);
    }

    public function destroy($id)
    {
        // Ambil data pengguna berdasarkan ID Firestore
        $userResponse = Http::get("{$this->firebaseUrl}/{$id}")->json();

        if (!isset($userResponse['fields']['email']['stringValue'])) {
            return response()->json(['message' => 'Pengguna tidak ditemukan di Firestore'], 404);
        }

        $email = $userResponse['fields']['email']['stringValue'];

        // Hapus dari Firestore
        $firestoreResponse = Http::delete("{$this->firebaseUrl}/{$id}");

        if ($firestoreResponse->failed()) {
            return response()->json(['message' => 'Gagal menghapus pengguna dari Firestore'], 400);
        }

        // Hapus dari Firebase Authentication
        $firebaseAuthUrl = 'https://identitytoolkit.googleapis.com/v1/accounts:delete?key=AIzaSyCruf8kD8sa1om5hM-ZWkQnnpm7n6vcJH4';

        $authResponse = Http::post($firebaseAuthUrl, ['email' => $email])->json();

        if (isset($authResponse['error'])) {
            return response()->json(['message' => 'Gagal menghapus akun Firebase Authentication', 'error' => $authResponse], 400);
        }

        return response()->json(['message' => 'Pengguna berhasil dihapus dari Firestore dan Firebase Authentication']);
    }
    public function upgrade(Request $request)
    {
        $uid = session('uid'); // pastikan uid disimpan saat login
        if (!$uid) {
            return redirect()->back()->with('error', 'Silakan login terlebih dahulu.');
        }

        $url = "https://firestore.googleapis.com/v1/projects/dombaku-974fe/databases/(default)/documents/users/{$uid}?updateMask.fieldPaths=is_paid";

        $response = Http::patch($url, [
            'fields' => [
                'is_paid' => ['booleanValue' => true],
            ]
        ]);

        if ($response->successful()) {
            session(['is_paid' => true]); // update juga di session
            return redirect()->back()->with('success', 'Akun Anda berhasil di-upgrade ke Premium.');
        }

        return redirect()->back()->with('error', 'Gagal upgrade. Coba lagi nanti.');
    }
}
