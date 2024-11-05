<?php

use App\Http\Controllers\Auth\LoginRegisterController;
use App\Http\Controllers\Author\AuthorController;
use App\Http\Controllers\Book\BookController;
use App\Http\Controllers\User\UserController;
use App\Http\Middleware\Admin;
use App\Http\Middleware\AgeCheck;
use App\Models\User;
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

// Route CRUD untuk author
Route::prefix('authors')->name('authors.')->group(function(){
    Route::get('/', [AuthorController::class, 'index'])->name('index');
    Route::get('/create', [AuthorController::class, 'create'])->name('create');
    Route::post('/', [AuthorController::class, 'store'])->name('store');
    Route::delete('/{author}', [AuthorController::class, 'destroy'])->name('destroy');
    Route::get('/{author}/edit', [AuthorController::class, 'edit'])->name('edit');
    Route::put('/{author}', [AuthorController::class, 'update'])->name('update');        
});


// Route CRUD untuk buku
Route::prefix('books')->name('books.')->group(function () {
    Route::get('/', [BookController::class, 'index'])->name('index');               // Menampilkan daftar buku
    Route::get('/create', [BookController::class, 'create'])->name('create');       // Form tambah buku
    Route::post('/', [BookController::class, 'store'])->name('store');              // Menyimpan buku baru
    Route::get('/{book}', [BookController::class, 'show'])->name('show');           // Menampilkan detail buku
    Route::get('/{book}/edit', [BookController::class, 'edit'])->name('edit');      // Form edit buku
    Route::put('/{book}', [BookController::class, 'update'])->name('update');       // Mengupdate data buku
    Route::delete('/{book}', [BookController::class, 'destroy'])->name('destroy');  // Menghapus buku
});

// Route CRUD untuk user
Route::middleware(['auth', Admin::class])->prefix('users')->name('users.')->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('index');               // Menampilkan daftar user
    Route::get('/create', [UserController::class, 'create'])->name('create');       // Form tambah user
    Route::post('/', [UserController::class, 'store'])->name('store');              // Menyimpan user baru
    Route::delete('/{user}', [UserController::class, 'destroy'])->name('destroy');  // Menghapus user
    Route::put('/{user}', [UserController::class, 'update'])->name('update');       // Mengupdate data buku
    Route::get('/{user}/edit', [UserController::class, 'edit'])->name('edit');      // Form edit user
});



