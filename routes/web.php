<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DombaController;
use App\Http\Controllers\ChartController;
use App\Http\Controllers\DenahKandangController;
use App\Http\Controllers\RekomendasiController;
use App\Http\Controllers\ManajemenKandangController;
use App\Http\Controllers\ManajemenKelahiranController;
use App\Http\Controllers\RiwayatController;
use App\Http\Controllers\PerkawinanController;
use App\Http\Controllers\ManajemenDombaController;
use App\Http\Controllers\FirebaseAuthController;
use App\Http\Controllers\FirestoreController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FirebaseController;

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

Route::middleware(['auth.firebase'])->group(function () {

    Route::get('/manajemendomba/{id}', [ManajemenDombaController::class, 'show'])->name('manajemendomba.show');
    Route::post('/manajemendomba', [ManajemenDombaController::class, 'store'])->name('manajemendomba.store');
    Route::patch('/manajemendomba/update/{id}', [ManajemenDombaController::class, 'update'])->name('manajemendomba.update');
    Route::post('/manajemendomba/update/{id}', [ManajemenDombaController::class, 'update']);
    Route::delete('/manajemendomba/{id}', [ManajemenDombaController::class, 'destroy'])->name('manajemendomba.destroy');

    Route::post('/perkawinan', [PerkawinanController::class, 'store'])->name('perkawinan.store');
    Route::get('/perkawinan/{id}/edit', [PerkawinanController::class, 'edit'])->name('perkawinan.edit');
    Route::patch('/perkawinan/{id}', [PerkawinanController::class, 'update'])->name('perkawinan.update');
    Route::delete('/perkawinan/{id}', [PerkawinanController::class, 'destroy'])->name('perkawinan.destroy');
    Route::get('/perkawinan/{id}', [PerkawinanController::class, 'show'])->name('perkawinan.show');
    Route::get('/perkawinan/get-eartag-data', [PerkawinanController::class, 'getEartagData'])->name('perkawinan.getEartagData');

    Route::get('/kelahiran/create', [ManajemenKelahiranController::class, 'create'])->name('kelahiran.create');
    Route::post('/kelahiran', [ManajemenKelahiranController::class, 'store'])->name('kelahiran.store');
    Route::get('/kelahiran/{id}', [ManajemenKelahiranController::class, 'show'])->name('kelahiran.show');
    Route::get('/kelahiran/{id}/edit', [ManajemenKelahiranController::class, 'edit'])->name('kelahiran.edit');
    Route::put('/kelahiran/{id}', [ManajemenKelahiranController::class, 'update'])->name('kelahiran.update');
    Route::delete('/kelahiran/{id}', [ManajemenKelahiranController::class, 'destroy'])->name('kelahiran.destroy');
    Route::get('/kelahiran/{id}/data', [ManajemenKelahiranController::class, 'getData'])->name('kelahiran.data');

    Route::get('/manajemenkandang/{id}', [ManajemenKandangController::class, 'show'])->name('manajemenkandang.show');
    Route::post('/manajemenkandang', [ManajemenKandangController::class, 'store'])->name('manajemenkandang.store');
    Route::patch('/manajemenkandang/update/{id}', [ManajemenKandangController::class, 'update'])->name('manajemenkandang.update');
    Route::delete('/manajemenkandang/{id}', [ManajemenKandangController::class, 'destroy'])->name('manajemenkandang.destroy');

    Route::middleware(['auth.firebase', 'premium'])->group(function () {
        Route::get('/uploadcsv', function () {
            return view('uploadcsv');
        })->name('uploadcsv');

        Route::post('/upload-rekomendasi', [RekomendasiController::class, 'uploadCSV'])->name('upload.rekomendasi');

        Route::get('/rekomendasikawin', function () {
            return view('rekomendasikawin');
        })->name('rekomendasikawin');

        Route::get('/rekomendasi/kawin', [RekomendasiController::class, 'rekomendasiKawinView'])->name('rekomendasi.kawin.view');
        Route::post('/rekomendasi/kawin', [RekomendasiController::class, 'rekomendasiKawin'])->name('rekomendasi.kawin');
        Route::get('/rekomendasi/kawin/hasil', [RekomendasiController::class, 'showRekomendasiKawin'])->name('rekomendasikawin.show');
        Route::post('/lanjutkan-manajemenperkawinan', [RekomendasiController::class, 'lanjutkanManajemenPerkawinan'])->name('lanjutkan.manajemenperkawinan');
    });

    Route::patch('/mark-alert-read/{alertId}', [DombaController::class, 'markAlertAsRead'])->name('markAlertAsRead');


    Route::get('/denahkandang/{id}', [DenahKandangController::class, 'show'])->name('denahkandang.show');
    Route::get('/api/denahkandang', [DenahKandangController::class, 'list']);

    // Rute untuk metode index
    Route::get('/firebase-index', [FirebaseController::class, 'index']);

    // Rute untuk metode createData
    Route::get('/firebase-create', [FirebaseController::class, 'createData']);

    Route::post('/add-user', [UserController::class, 'store']);
    Route::get('/users/{id}', [UserController::class, 'show']);
    Route::put('/users/{id}', [UserController::class, 'update']);
    Route::delete('/users/{id}', [UserController::class, 'destroy']);

    Route::get('/add-firestore', [FirestoreController::class, 'addDocument']);

    // Route untuk memverifikasi ID Token
    Route::post('/verify-id-token', [FirebaseAuthController::class, 'verifyIdToken']);

    Route::get('/dashboard', [DombaController::class, 'index'])->name('dashboard');
    Route::get('/manajemendomba', [ManajemenDombaController::class, 'index'])->name('manajemendomba.index');
    Route::get('/manajemenkandang', [ManajemenKandangController::class, 'index'])->name('manajemenkandang.index');
    Route::get('/denahkandang', [DenahKandangController::class, 'index'])->name('denahkandang.index');
    Route::get('/charts', [ChartController::class, 'index']);
    Route::get('/kelahiran', [ManajemenKelahiranController::class, 'index'])->name('kelahiran.index');
    Route::get('/history', [RiwayatController::class, 'index'])->name('riwayat.index');
    Route::get('/users', [UserController::class, 'index']);
    Route::get('/perkawinan', [PerkawinanController::class, 'index'])->name('perkawinan.index');
});


Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// Tampilkan form register
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');

// Tangani submit form register
Route::post('/register', [AuthController::class, 'register']);

Route::post('/upgrade-premium', [UserController::class, 'upgrade'])->name('upgrade.premium');
