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