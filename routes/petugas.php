<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Petugas\DashboardController;

Route::middleware(['auth', 'role.petugas'])->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('petugas.dashboard');
    
    // List all pengaduan
    Route::get('pengaduan', [App\Http\Controllers\Petugas\PengaduanController::class, 'index'])->name('petugas.pengaduan.index');
    Route::get('pengaduan/{id}', [App\Http\Controllers\Petugas\PengaduanController::class, 'show'])->name('petugas.pengaduan.show');
    Route::post('pengaduan/{id}/respond', [App\Http\Controllers\Petugas\PengaduanController::class, 'respond'])->name('petugas.pengaduan.respond');
});
