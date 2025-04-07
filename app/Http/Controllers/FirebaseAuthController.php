<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FirebaseAuthController extends Controller
{
    /**
     * Verifikasi ID Token Firebase.
     */
    public function verifyIdToken(Request $request)
    {
        // Ambil ID Token dari request
        $idToken = $request->input('firebase_token'); // Token yang dikirim melalui body atau header

        // API Key Firebase Anda (ambil dari Firebase Console)
        $apiKey = 'AIzaSyCruf8kD8sa1om5hM-ZWkQnnpm7n6vcJH4'; // Ganti dengan API Key Firebase Anda

        // Siapkan data untuk request
        $data = [
            'idToken' => $idToken,
        ];

        // URL untuk verifikasi token
        $url = 'https://identitytoolkit.googleapis.com/v1/accounts:lookup?key=AIzaSyCruf8kD8sa1om5hM-ZWkQnnpm7n6vcJH4';

        // Inisialisasi cURL
        $ch = curl_init($url);

        // Set opsi cURL
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
        ]);

        // Eksekusi cURL dan ambil respons
        $response = curl_exec($ch);

        // Cek jika ada error
        if (curl_errno($ch)) {
            return response()->json(['message' => 'Request Error: ' . curl_error($ch)], 400);
        }

        // Tutup cURL
        curl_close($ch);

        // Decode respons JSON dari Firebase
        $result = json_decode($response, true);

        // Cek apakah ID Token valid
        if (isset($result['users']) && count($result['users']) > 0) {
            // Ambil UID pengguna dari respons
            $uid = $result['users'][0]['localId'];
            return response()->json(['message' => 'Token valid!', 'uid' => $uid]);
        } else {
            return response()->json(['error' => 'Invalid token'], 400);
        }
    }
}
