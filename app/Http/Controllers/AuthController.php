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

        // Simpan data ke session
        session([
            'username' => $username,
            'email' => $request->email,
            'role' => $role,
            'firebase_token' => $response['idToken'],
        ]);

        return redirect('/dashboard');
    }

    public function logout()
    {
        session()->flush(); // Hapus semua session
        return redirect()->route('landingpage'); // Redirect menggunakan nama route
    }    
}
