<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Log;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('landingpage');
})->name('landingpage');

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::get('/register', function () {
    return view('register');
})->name('register');

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/charts', function () {
    return view('charts');
})->name('charts');

Route::get('/manajemenkandang', function () {
    return view('manajemenkandang');
})->name('manajemenkandang');

Route::get('/manajemendomba', function () {
    return view('manajemendomba');
})->name('manajemendomba');

Route::get('/chart', function () {
    return view('chart');
})->name('chart');

Route::get('/kesehatan', function () {
    return view('kesehatan');
})->name('kesehatan');

Route::get('/perkawinan', function () {
    return view('perkawinan');
})->name('perkawinan');

Route::get('/kelahiran', function () {
    return view('kelahiran');
})->name('kelahiran');

Route::get('/kandang', function () {
    return view('kandang');
})->name('kandang');

Route::get('/detaildomba', function () {
    return view('detaildomba');
})->name('detaildomba');

Route::get('/users', function () {
    return view('users');
})->name('users');

Route::get('/history', function () {
    return view('history');
})->name('history');

Route::get('/test', function () {
    return 'Server Laravel berjalan dengan baik!';
});

use App\Http\Controllers\FirebaseController;

// Rute untuk metode index
Route::get('/firebase-index', [FirebaseController::class, 'index']);

// Rute untuk metode createData
Route::get('/firebase-create', [FirebaseController::class, 'createData']);

use App\Http\Controllers\UserController;

Route::get('/users', [UserController::class, 'index']);
Route::post('/add-user', [UserController::class, 'store']);
Route::get('/users/{id}', [UserController::class, 'show']);
Route::put('/users/{id}', [UserController::class, 'update']);
Route::delete('/users/{id}', [UserController::class, 'destroy']);


use App\Http\Controllers\FirestoreController;

Route::get('/add-firestore', [FirestoreController::class, 'addDocument']);

use App\Http\Controllers\FirebaseAuthController;
// Route untuk memverifikasi ID Token
Route::post('/verify-id-token', [FirebaseAuthController::class, 'verifyIdToken']);

use App\Http\Controllers\AuthController;

Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

use App\Http\Controllers\ManajemenDombaController;

Route::get('/manajemendomba', [ManajemenDombaController::class, 'index'])->name('manajemendomba.index');
Route::get('/manajemendomba/{id}', [ManajemenDombaController::class, 'show'])->name('manajemendomba.show');
Route::post('/manajemendomba', [ManajemenDombaController::class, 'store'])->name('manajemendomba.store');
Route::patch('/manajemendomba/update/{id}', [ManajemenDombaController::class, 'update'])->name('manajemendomba.update');
Route::delete('/manajemendomba/{id}', [ManajemenDombaController::class, 'destroy'])->name('manajemendomba.destroy');

use App\Http\Controllers\RiwayatController;

Route::get('/history', [RiwayatController::class, 'index'])->name('riwayat.index');

use App\Http\Controllers\PerkawinanController;

Route::get('/perkawinan', [PerkawinanController::class, 'index'])->name('perkawinan.index');
Route::post('/perkawinan', [PerkawinanController::class, 'store'])->name('perkawinan.store');
Route::get('/perkawinan/{id}/edit', [PerkawinanController::class, 'edit'])->name('perkawinan.edit');
Route::patch('/perkawinan/{id}', [PerkawinanController::class, 'update'])->name('perkawinan.update');
Route::delete('/perkawinan/{id}', [PerkawinanController::class, 'destroy'])->name('perkawinan.destroy');
Route::get('/perkawinan/{id}', [PerkawinanController::class, 'show'])->name('perkawinan.show');
Route::get('/perkawinan/get-eartag-data', [PerkawinanController::class, 'getEartagData'])->name('perkawinan.getEartagData');

use App\Http\Controllers\ManajemenKelahiranController;

Route::get('/kelahiran', [ManajemenKelahiranController::class, 'index'])->name('kelahiran.index');
Route::get('/kelahiran/create', [ManajemenKelahiranController::class, 'create'])->name('kelahiran.create');
Route::post('/kelahiran', [ManajemenKelahiranController::class, 'store'])->name('kelahiran.store');
Route::get('/kelahiran/{id}', [ManajemenKelahiranController::class, 'show'])->name('kelahiran.show');
Route::get('/kelahiran/{id}/edit', [ManajemenKelahiranController::class, 'edit'])->name('kelahiran.edit');
Route::put('/kelahiran/{id}', [ManajemenKelahiranController::class, 'update'])->name('kelahiran.update');
Route::delete('/kelahiran/{id}', [ManajemenKelahiranController::class, 'destroy'])->name('kelahiran.destroy');
Route::get('/kelahiran/{id}/data', [ManajemenKelahiranController::class, 'getData'])->name('kelahiran.data');


use App\Http\Controllers\ManajemenKandangController;

Route::get('/manajemenkandang', [ManajemenKandangController::class, 'index'])->name('manajemenkandang.index');
Route::get('/manajemenkandang/{id}', [ManajemenKandangController::class, 'show'])->name('manajemenkandang.show');
Route::post('/manajemenkandang', [ManajemenKandangController::class, 'store'])->name('manajemenkandang.store');
Route::patch('/manajemenkandang/update/{id}', [ManajemenKandangController::class, 'update'])->name('manajemenkandang.update');
Route::delete('/manajemenkandang/{id}', [ManajemenKandangController::class, 'destroy'])->name('manajemenkandang.destroy');

use App\Http\Controllers\RekomendasiController;

// Route untuk form upload CSV
Route::get('/uploadcsv', function () {
    return view('uploadcsv');
})->name('uploadcsv');

Route::get('/rekomendasikawin', function () {
    return view('rekomendasikawin');
})->name('rekomendasikawin');

// Route untuk menampilkan halaman rekomendasi kawin (View)
Route::get('/rekomendasi/kawin', [RekomendasiController::class, 'rekomendasiKawinView'])->name('rekomendasi.kawin.view');

// Route untuk memproses upload CSV
Route::post('/upload-rekomendasi', [RekomendasiController::class, 'uploadCSV'])->name('upload.rekomendasi');

// Route untuk mendapatkan rekomendasi berdasarkan ID Jantan
Route::post('/rekomendasi/kawin', [RekomendasiController::class, 'rekomendasiKawin'])->name('rekomendasi.kawin');

// Route untuk melanjutkan manajemen perkawinan
Route::post('/lanjutkan-manajemenperkawinan', [RekomendasiController::class, 'lanjutkanManajemenPerkawinan'])->name('lanjutkan.manajemenperkawinan');

// Ubah URL untuk rute showRekomendasiKawin
Route::get('/rekomendasi/kawin/hasil', [RekomendasiController::class, 'showRekomendasiKawin'])->name('rekomendasikawin.show');

use App\Http\Controllers\DombaController;

Route::get('/dashboard', [DombaController::class, 'index'])->name('dashboard');
Route::patch('/mark-alert-read/{alertId}', [DombaController::class, 'markAlertAsRead'])->name('markAlertAsRead');

use App\Http\Controllers\ChartController;

// Route untuk menampilkan data chart
Route::get('/charts', [ChartController::class, 'index']);


use App\Http\Controllers\DenahKandangController;

Route::get('/denahkandang', [DenahKandangController::class, 'index'])->name('denahkandang.index');
Route::get('/denahkandang/{id}', [DenahKandangController::class, 'show'])->name('denahkandang.show');
Route::get('/api/denahkandang', [DenahKandangController::class, 'list']);
