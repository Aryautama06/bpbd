<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BencanaController; 
use App\Http\Controllers\PersonelController;
use App\Http\Controllers\PeralatanController;
use App\Http\Controllers\DanaController;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\AlternatifController;
use App\Http\Controllers\PerhitunganController;
use App\Http\Controllers\AnalisisController;
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
    Route::get('/dana/{dana}', [DanaController::class, 'show'])->name('dana.show');
    Route::get('/dana/{dana}/edit', [DanaController::class, 'edit'])->name('dana.edit');
    Route::put('/dana/{dana}', [DanaController::class, 'update'])->name('dana.update');

    // SPK Routes
    Route::resource('kriteria', KriteriaController::class)->parameters([
        'kriteria' => 'kriteria'
    ]);
    Route::get('/kriteria/{kriteria}', [KriteriaController::class, 'show'])->name('kriteria.show');
    Route::get('/kriteria/{kriteria}/edit', [KriteriaController::class, 'edit'])->name('kriteria.edit');
    Route::put('/kriteria/{kriteria}', [KriteriaController::class, 'update'])->name('kriteria.update');
    Route::resource('alternatif', AlternatifController::class)->parameters([
        'alternatif' => 'alternatif'
    ]);
    Route::get('/alternatif/{alternatif}', [AlternatifController::class, 'show'])->name('alternatif.show');
    Route::get('/alternatif/{alternatif}/edit', [AlternatifController::class, 'edit'])->name('alternatif.edit');
    Route::put('/alternatif/{alternatif}', [AlternatifController::class, 'update'])->name('alternatif.update');

    Route::prefix('perhitungan')->name('perhitungan.')->group(function () {
        Route::get('/ahp', [PerhitunganController::class, 'ahp'])->name('ahp');
        Route::get('/', [PerhitunganController::class, 'index'])->name('index');
        Route::post('/nilai', [PerhitunganController::class, 'nilaiAlternatif'])->name('nilai');
        Route::get('/topsis', [PerhitunganController::class, 'topsis'])->name('topsis');
        Route::post('/simpan-nilai', [PerhitunganController::class, 'simpanNilai'])->name('simpan-nilai');
        Route::post('/simpan-perbandingan', [PerhitunganController::class, 'simpanPerbandingan'])->name('simpan-perbandingan');
        Route::post('/hitung-topsis', [PerhitunganController::class, 'hitungTopsis'])->name('hitung-topsis');
        Route::post('/simpan-hasil', [PerhitunganController::class, 'simpanHasil'])->name('simpan-hasil');
        Route::get('/riwayat', [PerhitunganController::class, 'riwayat'])->name('riwayat');
        Route::get('/detail/{hasil}', [PerhitunganController::class, 'detail'])->name('detail');
    });

    Route::get('/analisis', [AnalisisController::class, 'index'])->name('analisis.index');

    Route::get('/perhitungan/{hasil}/detail', [PerhitunganController::class, 'detail'])
        ->name('perhitungan.detail');
    Route::delete('/perhitungan/{hasil}', [PerhitunganController::class, 'hapus'])
        ->name('perhitungan.hapus');
});
