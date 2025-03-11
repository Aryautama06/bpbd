<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BencanaController; 
use App\Http\Controllers\PersonelController;
use App\Http\Controllers\PeralatanController;
use Illuminate\Support\Facades\Route;

// Public Routes
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

// Authentication Routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Registration Routes
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// Password Reset Routes
Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])
    ->name('password.request');
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])
    ->name('password.email');
Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])
    ->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class, 'reset'])
    ->name('password.update');

// Protected Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Redirect /home to /dashboard
    Route::get('/home', function () {
        return redirect('/dashboard');
    });

    // Manajemen Bencana
    Route::get('/bencana', [BencanaController::class, 'index'])->name('bencana.index');
    Route::resource('bencana', BencanaController::class);

    // Manajemen Bencana Routes
    Route::get('/bencana/create', [BencanaController::class, 'create'])->name('bencana.create');
    Route::post('/bencana', [BencanaController::class, 'store'])->name('bencana.store');
    Route::get('/bencana/{bencana}', [BencanaController::class, 'show'])->name('bencana.show');
    Route::get('/bencana/{bencana}/edit', [BencanaController::class, 'edit'])->name('bencana.edit');
    Route::put('/bencana/{bencana}', [BencanaController::class, 'update'])->name('bencana.update');
    Route::delete('/bencana/{bencana}', [BencanaController::class, 'destroy'])->name('bencana.destroy');

    // Resource Management Routes
    Route::resource('personel', PersonelController::class);
    Route::get('/personel/{personel}', [PersonelController::class, 'show'])->name('personel.show');
    Route::get('/personel/{personel}/edit', [PersonelController::class, 'edit'])->name('personel.edit');
    Route::put('/personel/{personel}', [PersonelController::class, 'update'])->name('personel.update');
    Route::resource('peralatan', PeralatanController::class);
    Route::get('/peralatan/{peralatan}', [PeralatanController::class, 'show'])->name('peralatan.show');
    Route::get('/peralatan/{peralatan}/edit', [PeralatanController::class, 'edit'])->name('peralatan.edit');
    Route::put('/peralatan/{peralatan}', [PeralatanController::class, 'update'])->name('peralatan.update');
    Route::resource('dana', DanaController::class);

    // SPK Routes
    Route::resource('kriteria', KriteriaController::class);
    Route::resource('alternatif', AlternatifController::class);
    Route::get('/perhitungan/ahp', [PerhitunganController::class, 'ahp'])->name('perhitungan.ahp');
    Route::get('/perhitungan/topsis', [PerhitunganController::class, 'topsis'])->name('perhitungan.topsis');
    Route::get('/hasil-analisis', [HasilAnalisisController::class, 'index'])->name('hasil.analisis');
});
