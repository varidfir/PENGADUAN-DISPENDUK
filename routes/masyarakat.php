<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Masyarakat\DashboardController;
use App\Http\Controllers\Masyarakat\PengaduanController;

Route::middleware(['auth', 'role.masyarakat'])->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('pengaduan/create', [PengaduanController::class, 'create'])->name('pengaduan.create');
    Route::post('pengaduan', [PengaduanController::class, 'store'])->name('pengaduan.store');
    Route::get('pengaduan/{id}', [PengaduanController::class, 'show'])->name('pengaduan.show');
    Route::post('pengaduan/{id}/chat', [PengaduanController::class, 'chat'])->name('pengaduan.chat');
});

