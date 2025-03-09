<?php

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/', function () {
    return view('welcome');
});

Route::get('/berita', function () {
    return view('berita.index');
})->name('berita');

Route::get('/data-bencana', function () {
    return view('data-bencana.index');
})->name('data-bencana');

Route::get('/tentang', function () {
    return view('tentang.index');
})->name('tentang');
