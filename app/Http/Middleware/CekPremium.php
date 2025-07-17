<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CekPremium
{
    public function handle(Request $request, Closure $next)
    {
        $uid = session('uid'); // Ambil UID dari sesi login
        if (!$uid) {
            // Biarkan tetap ke halaman sekarang tapi berikan notifikasi
            return redirect()->back()->with('error', 'Anda harus login terlebih dahulu.');
        }

        $url = "https://firestore.googleapis.com/v1/projects/dombaku-974fe/databases/(default)/documents/users/{$uid}";
        $response = Http::get($url);
        $data = $response->json();

        $fields = $data['fields'] ?? [];
        $isPaid = $fields['is_paid']['booleanValue'] ?? false;

        if ($isPaid) {
            return $next($request);
        }

        // Kembali ke halaman sebelumnya, kasih flash message
        return redirect()->back()->with('error', 'Fitur ini hanya untuk pengguna premium.');
    }
}
