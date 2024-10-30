<?php

use App\Http\Controllers\Auth\LoginRegisterController;
use App\Http\Controllers\Book\BookController;
use App\Http\Middleware\Admin;
use App\Http\Middleware\AgeCheck;
use Illuminate\Support\Facades\Route;

Route::get('restricted', function() {
    return redirect()->route('login');
})->middleware(AgeCheck::class);

Route::get('/', function () {
    return view('welcome');
})->name('welcome');
 
Route::controller(LoginRegisterController::class)->group(function() {
    Route::get('/register', 'register')->name('register');
    Route::post('/store', 'store')->name('store');
    Route::get('/login', 'login')->name('login');
    Route::post('/authenticate', 'authenticate')->name('authenticate');
    Route::get('/dashboard', 'dashboard')->name('dashboard');
    Route::post('/logout', 'logout')->name('logout');
});


// Route CRUD untuk buku
Route::middleware(['auth', Admin::class])->prefix('books')->name('books.')->group(function () {
    Route::get('/', [BookController::class, 'index'])->name('index');               // Menampilkan daftar buku
    Route::get('/create', [BookController::class, 'create'])->name('create');       // Form tambah buku
    Route::post('/', [BookController::class, 'store'])->name('store');              // Menyimpan buku baru
    Route::get('/{book}', [BookController::class, 'show'])->name('show');           // Menampilkan detail buku
    Route::get('/{book}/edit', [BookController::class, 'edit'])->name('edit');      // Form edit buku
    Route::put('/{book}', [BookController::class, 'update'])->name('update');       // Mengupdate data buku
    Route::delete('/{book}', [BookController::class, 'destroy'])->name('destroy');  // Menghapus buku
});

// Route::middleware(['auth'])->group(function() {
//     Route::get('/index', [BookController::class, 'index'])->name('buku.index');
//     Route::get('buku/store', [BookController::class, 'store'])->name('buku.store');
// });



