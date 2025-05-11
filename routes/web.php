<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\KonsultasiController;
use App\Http\Controllers\ObatController;
use App\Http\Controllers\ResepController;

Route::get('/', function () {
    return redirect()->route('auth.login');
});

//Route Autentikasi
Route::get('/login', [AuthController::class, 'showLogin'])->name('auth.login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('auth.register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');

// Route Dashboard berdasarkan peran
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/admin', [DashboardController::class, 'admin'])->middleware('role:Admin')->name('dashboard.admin');
    Route::get('/dokter', [DashboardController::class, 'dokter'])->middleware('role:Dokter')->name('dashboard.dokter');
    Route::get('/pasien', [DashboardController::class, 'pasien'])->middleware('role:Pasien')->name('dashboard.pasien');
});

//Route Pengguna (Admin saja)
Route::middleware(['auth', 'role:Admin'])->group(function () {
    Route::get('/pengguna', [PenggunaController::class, 'index'])->name('pengguna.index');
    Route::get('/pengguna/create', [PenggunaController::class, 'create'])->name('pengguna.create');
    Route::post('/pengguna', [PenggunaController::class, 'store'])->name('pengguna.store');
    Route::get('/pengguna/{id}/edit', [PenggunaController::class, 'edit'])->name('pengguna.edit');
    Route::put('/pengguna/{id}', [PenggunaController::class, 'update'])->name('pengguna.update');
    Route::delete('/pengguna/{id}', [PenggunaController::class, 'destroy'])->name('pengguna.delete');
});

//Route Konsultasi (Dokter & Pasien)
Route::middleware(['auth'])->group(function () {
    Route::get('/konsultasi', [KonsultasiController::class, 'index'])->name('konsultasi.index');
    Route::get('/konsultasi/create', [KonsultasiController::class, 'create'])->middleware('role:Pasien')->name('konsultasi.create');
    Route::post('/konsultasi', [KonsultasiController::class, 'store'])->middleware('role:Pasien')->name('konsultasi.store');
    Route::get('/konsultasi/{id}', [KonsultasiController::class, 'show'])->name('konsultasi.detail');
    Route::put('/konsultasi/{id}', [KonsultasiController::class, 'update'])->middleware('role:Dokter')->name('konsultasi.update');
});

//Route Obat (Hanya Admin)
Route::middleware(['auth', 'role:Admin'])->group(function () {
    Route::get('/obat', [ObatController::class, 'index'])->name('obat.index');
    Route::get('/obat/tambah', [ObatController::class, 'create'])->name('obat.create');
    Route::post('/obat', [ObatController::class, 'store'])->name('obat.store');
    Route::get('/obat/{id}/edit', [ObatController::class, 'edit'])->name('obat.edit');
    Route::put('/obat/{id}', [ObatController::class, 'update'])->name('obat.update');
    Route::delete('/obat/{id}', [ObatController::class, 'destroy'])->name('obat.delete');
});

// Route Resep (Hanya Dokter)
Route::middleware(['auth', 'role:Dokter'])->group(function () {
    Route::get('/resep', [ResepController::class, 'index'])->name('resep.index');
    Route::get('/resep/tambah', [ResepController::class, 'create'])->name('resep.create');
    Route::post('/resep', [ResepController::class, 'store'])->name('resep.store');
    Route::get('/resep/{id}/edit', [ResepController::class, 'edit'])->name('resep.edit');
    Route::put('/resep/{id}', [ResepController::class, 'update'])->name('resep.update');
});

// Manajemen Dokter
Route::middleware(['auth', 'role:Admin'])->group(function () {
    Route::post('/dokter', [DashboardController::class, 'storeDokter'])->name('dokter.store');
    Route::delete('/dokter/{id}', [DashboardController::class, 'destroyDokter'])->name('dokter.hapus');
});

use App\Http\Controllers\TransaksiController;

// Middleware untuk transaksi (hanya pasien yang bisa membeli obat)
Route::middleware(['auth', 'role:Pasien'])->group(function () {
    Route::get('/transaksi', [TransaksiController::class, 'index'])->name('transaksi.index');
    Route::get('/transaksi/tambah', [TransaksiController::class, 'create'])->name('transaksi.create');
    Route::post('/transaksi', [TransaksiController::class, 'store'])->name('transaksi.store');
});
