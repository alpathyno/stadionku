<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\Admin\AdminDashboardController;
use Illuminate\Support\Facades\Artisan;

// ── ROOT ──
// web.php — cukup satu baris
Route::get('/', [\App\Http\Controllers\WelcomeController::class, 'index']);

// ── ROUTE PANCINGAN STORAGE LINK ──
// Nanti HAPUS BAGIAN INI kalau sudah berhasil!
Route::get('/buat-storage', function () {
    Artisan::call('storage:link');
    return 'Mantap! Storage link berhasil dibuat di Railway!';
});

// ── USER ROUTES ──
Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    Route::get('/pertandingan', [\App\Http\Controllers\User\PertandinganController::class, 'index'])->name('pertandingan.index');
    Route::get('/pertandingan/{id}', [\App\Http\Controllers\User\PertandinganController::class, 'show'])->name('pertandingan.show');
    Route::get('/riwayat', [\App\Http\Controllers\User\RiwayatController::class, 'index'])->name('riwayat.index');
    Route::post('/booking', [\App\Http\Controllers\User\BookingController::class, 'store'])->name('booking.store');
    Route::get('/riwayat/{id}/tiket', [\App\Http\Controllers\User\RiwayatController::class, 'downloadTiket'])->name('riwayat.tiket');
    Route::get('/profil', [\App\Http\Controllers\User\ProfilController::class, 'index'])->name('profil.index');
    Route::post('/profil/update', [\App\Http\Controllers\User\ProfilController::class, 'updateProfil'])->name('profil.update');
    Route::post('/profil/password', [\App\Http\Controllers\User\ProfilController::class, 'updatePassword'])->name('profil.password');
});

// ── ADMIN ROUTES ──
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])
        ->name('dashboard');
    
    Route::resource('pertandingan', \App\Http\Controllers\Admin\PertandinganController::class);

    Route::get('/penonton', [\App\Http\Controllers\Admin\PenontonController::class, 'index'])->name('penonton.index');
    Route::delete('/penonton/{id}', [\App\Http\Controllers\Admin\PenontonController::class, 'destroy'])->name('penonton.destroy');
    Route::resource('admins', \App\Http\Controllers\Admin\UserController::class);

    Route::get('/transaksi', [\App\Http\Controllers\Admin\TransaksiController::class, 'index'])->name('transaksi.index');
    Route::patch('/transaksi/booking/{kode}/approve', [\App\Http\Controllers\Admin\TransaksiController::class, 'approveBooking'])->name('transaksi.approveBooking');
    Route::patch('/transaksi/booking/{kode}/tolak', [\App\Http\Controllers\Admin\TransaksiController::class, 'tolakBooking'])->name('transaksi.tolakBooking');
    Route::patch('/transaksi/{id}/approve', [\App\Http\Controllers\Admin\TransaksiController::class, 'approve'])->name('transaksi.approve');
    Route::patch('/transaksi/{id}/tolak', [\App\Http\Controllers\Admin\TransaksiController::class, 'tolak'])->name('transaksi.tolak');
    Route::get('/transaksi/{id}/tiket', [\App\Http\Controllers\Admin\TransaksiController::class, 'downloadTiket'])->name('transaksi.tiket');
    Route::get('/laporan', [\App\Http\Controllers\Admin\LaporanController::class, 'index'])->name('laporan.index');
    Route::get('/laporan/export-pdf', [\App\Http\Controllers\Admin\LaporanController::class, 'exportPdf'])->name('laporan.pdf');
    Route::get('/laporan/export-excel', [\App\Http\Controllers\Admin\LaporanController::class, 'exportExcel'])->name('laporan.excel');
    Route::resource('stadion', \App\Http\Controllers\Admin\StadionController::class);
});

// ── AUTH ROUTES ──
require __DIR__.'/auth.php';