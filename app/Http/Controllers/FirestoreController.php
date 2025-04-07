<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class FirestoreController extends Controller
{
    public function addDocument()
    {
        // Timestamp saat ini
        $currentTime = now()->format('Y-m-d\TH:i:s');

        // Data untuk disimpan
        $data = [
            "fields" => [
                "nama" => ["stringValue" => "DombaKu"],
                "status" => ["stringValue" => "Tes via Laravel cURL"],
                "waktu" => ["stringValue" => $currentTime]
            ]
        ];

        // Endpoint Firestore
        $url = "https://firestore.googleapis.com/v1/projects/dombaku-974fe/databases/(default)/documents/test_collection";

        // Request ke Firestore API
        $response = Http::withHeaders([
            'Content-Type' => 'application/json'
        ])->post($url, $data);

        if ($response->successful()) {
            return response()->json(['message' => 'Data berhasil ditulis ke Firestore']);
        } else {
            return response()->json(['error' => 'Gagal menulis data ke Firestore'], 500);
        }
    }
}
