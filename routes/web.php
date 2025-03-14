<?php

use Illuminate\Support\Facades\Route;

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