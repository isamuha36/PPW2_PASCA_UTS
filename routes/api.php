<?php

use App\Http\Controllers\ApiInfo\InfoController;
use App\Http\Controllers\Gallery\GalleryController;
use App\Http\Controllers\Greet\GreetController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/info', [InfoController::class, 'index']) ->name ('info');

Route::get('/greet', [GreetController::class, 'greet'])->name('greet');

Route::get('/gallery', [GalleryController::class, 'GalleryApi'])->name('gallery');