<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    private $firebaseAuthUrl = 'https://identitytoolkit.googleapis.com/v1/accounts:';
    private $firebaseFirestoreUrl = 'https://firestore.googleapis.com/v1/projects/dombaku-974fe/databases/(default)/documents/users';
    private $apiKey = 'AIzaSyCruf8kD8sa1om5hM-ZWkQnnpm7n6vcJH4'; // Ganti dengan API Key Firebase

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        // Kirim permintaan login ke Firebase Authentication
        $response = Http::post($this->firebaseAuthUrl . 'signInWithPassword?key=' . $this->apiKey, [
            'email' => $request->email,
            'password' => $request->password,
            'returnSecureToken' => true,
        ])->json();

        if (!isset($response['idToken'])) {
            return back()->withErrors(['email' => 'Login gagal, periksa kembali email dan password.']);
        }

        // Ambil data pengguna dari Firestore
        $users = Http::get($this->firebaseFirestoreUrl)->json();
        $userData = collect($users['documents'] ?? [])->firstWhere(function ($user) use ($request) {
            return ($user['fields']['email']['stringValue'] ?? '') === $request->email;
        });

        if (!$userData) {
            return back()->withErrors(['email' => 'Data pengguna tidak ditemukan.']);
        }

        $username = $userData['fields']['username']['stringValue'] ?? 'Guest';
        $role = $userData['fields']['role']['stringValue'] ?? 'User';

        // 🔒 Cek apakah role adalah admin
        if ($role !== 'Admin') {
            return back()->withErrors(['email' => 'Hanya admin yang dapat login ke sistem.']);
        }

        $nama_peternak = $userData['fields']['nama_peternak']['stringValue'] ?? 'Peternak';

        $isPaid = $userData['fields']['is_paid']['booleanValue'] ?? false;

        session([
            'username' => $username,
            'email' => $request->email,
            'nama_peternak' => $nama_peternak,
            'role' => $role,
            'firebase_token' => $response['idToken'],
            'uid' => $userData['name'] ? basename($userData['name']) : null, // simpan UID
            'is_paid' => $isPaid, // simpan status premium
        ]);


        return redirect('/dashboard');
    }

    public function logout()
    {
        session()->flush(); // Hapus semua session
        return redirect()->route('landingpage'); // Redirect menggunakan nama route
    }
    public function showRegisterForm()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'nama_peternak' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'email' => 'required|email',
            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).+$/'
            ],
        ], [
            'password.regex' => 'Password harus memiliki huruf besar, huruf kecil, angka, dan simbol.'
        ]);

        // Buat akun Firebase Auth
        $response = Http::post($this->firebaseAuthUrl . 'signUp?key=' . $this->apiKey, [
            'email' => $request->email,
            'password' => $request->password,
            'returnSecureToken' => true,
        ])->json();

        if (!isset($response['localId'])) {
            return back()->withErrors(['email' => 'Pendaftaran gagal. Email mungkin sudah digunakan.']);
        }

        // Simpan ke Firestore
        $firebaseId = $response['localId'];
        Http::post($this->firebaseFirestoreUrl, [
            'fields' => [
                'nama_peternak' => ['stringValue' => $request->nama_peternak],
                'username' => ['stringValue' => $request->username],
                'email' => ['stringValue' => $request->email],
                'role' => ['stringValue' => 'Admin'],
                'status' => ['stringValue' => 'Aktif'],
                'firebase_id' => ['stringValue' => $firebaseId],
            ]
        ]);

        return redirect('/register')->with('success', 'Pendaftaran berhasil, silakan login!');
    }
}
