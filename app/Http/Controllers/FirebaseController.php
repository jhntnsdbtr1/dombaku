<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

use Google\Cloud\Firestore\FirestoreClient;

class FirebaseController extends Controller
{
    public function createData(Request $request)
    {
        try {
            // Inisialisasi FirestoreClient
            $firestore = new FirestoreClient([
                'keyFilePath' => base_path('firebase_credentials.json') // Ganti dengan path file JSON kredensial Anda
            ]);

            // Mengakses koleksi 'users'
            $usersCollection = $firestore->collection('users');

            // Menambahkan data pengguna
            $user = [
                'email' => $request->input('email'),
                'username' => $request->input('username'),
                'role' => $request->input('role'),
                'status' => $request->input('status'),
            ];

            // Menambahkan dokumen ke koleksi
            $usersCollection->add($user);

            return response()->json(['message' => 'Data pengguna berhasil ditambahkan'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }
}
