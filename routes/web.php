<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\KonsultasiController;
use App\Http\Controllers\ObatController;
use App\Http\Controllers\ResepController;
use App\Http\Controllers\TransaksiController;

Route::get('/', fn() => redirect()->route('auth.login'));

// Autentikasi
Route::get('/login', [AuthController::class, 'showLogin'])->name('auth.login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('auth.register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');

// Dashboard Berdasarkan Peran
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->middleware('auth')
        ->name('dashboard');
    Route::get('/admin', [DashboardController::class, 'admin'])
        ->middleware('role:Admin')
        ->name('dashboard.admin');
    Route::get('/dokter', [DashboardController::class, 'dokter'])
        ->middleware('role:Dokter')
        ->name('dashboard.dokter');
    Route::get('/pasien', [DashboardController::class, 'pasien'])
        ->middleware('role:Pasien')
        ->name('dashboard.pasien');
});

// Pengguna (Admin Only)
Route::middleware(['auth', 'role:Admin'])->group(function () {
    Route::resource('pengguna', PenggunaController::class)->except(['show']);
});

Route::get('/konsultasi', [KonsultasiController::class, 'index'])->name('konsultasi.index');
Route::middleware(['auth'])->group(function () {
    // Pasien routes
    Route::middleware('role:Pasien')->group(function () {
        Route::get('/konsultasi-ajukan', [KonsultasiController::class, 'create'])->name('konsultasi.create');
        Route::post('/konsultasi-kirim', [KonsultasiController::class, 'store'])->name('konsultasi.store');
    });
    
    // Dokter routes
    Route::middleware('role:Dokter')->group(function () {
        Route::put('/konsultasi/{id}', [KonsultasiController::class, 'update'])->name('konsultasi.update');
        Route::post('/konsultasi/{id}/selesai', [KonsultasiController::class, 'selesaikan'])->name('konsultasi.selesai');
    });

    // Umum
    Route::get('/konsultasi/{id}', [KonsultasiController::class, 'show'])
        ->where('id', '[0-9]+')
        ->name('konsultasi.detail');
});

// Obat (Admin Only)
Route::middleware(['auth', 'role:Admin'])->group(function () {
    Route::resource('obat', ObatController::class)->except(['show']);
});

// Resep (Dokter Only)
Route::middleware(['auth', 'role:Dokter'])->group(function () {
    Route::put('/konsultasi/{id}', [KonsultasiController::class, 'update'])->name('konsultasi.update');
    
});

// Manajemen Dokter via Dashboard
Route::middleware(['auth', 'role:Admin'])->group(function () {
    Route::post('/dokter', [DashboardController::class, 'storeDokter'])->name('dokter.store');
    Route::delete('/dokter/{id}', [DashboardController::class, 'destroyDokter'])->name('dokter.hapus');
    
});

// Transaksi (Pasien Only)
Route::middleware(['auth', 'role:Pasien'])->group(function () {
    Route::resource('transaksi', TransaksiController::class)->only(['index', 'create', 'store']);
    
});

Route::middleware(['auth'])->group(function () {
    Route::resource('resep', ResepController::class)->except(['show', 'destroy']);
});

