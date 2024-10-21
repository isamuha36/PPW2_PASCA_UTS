<?php

use App\Http\Controllers\Auth\LoginRegisterController;
use App\Http\Controllers\Book\BookController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::controller(LoginRegisterController::class)->group(function() {
    Route::get('/register', 'register')->name('register');
    Route::post('/store', 'store')->name('store');
    Route::get('/login', 'login')->name('login');
    Route::post('/authenticate', 'authenticate')->name('authenticate');
    Route::get('/dashboard', 'dashboard')->name('dashboard');
    Route::post('/logout', 'logout')->name('logout');
});


// Route::controller(BookController::class)->group(function() {
//     Route::get('/index', 'index')->name('index');
// });

// Route::middleware(['auth'])->group(function() {
//     Route::get('/index', [BookController::class, 'index'])->name('buku.index');
//     Route::get('buku/store'. [BookController::class, 'store'])->name('buku.store');
// });