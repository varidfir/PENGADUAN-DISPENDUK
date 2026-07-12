<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\PetugasController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\BannerController;

Route::middleware(['auth', 'role.superadmin'])->name('admin.')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('users', UserController::class);
    Route::resource('petugas', PetugasController::class);
    Route::resource('kategoris', KategoriController::class);
Route::resource('banners', BannerController::class);

Route::patch(
    'banners/{banner}/toggle',
    [BannerController::class, 'toggle']
)->name('banners.toggle');
    Route::get('pengaduan', [App\Http\Controllers\Admin\PengaduanController::class, 'index'])->name('pengaduan.index');
    Route::get('pengaduan/{id}', [App\Http\Controllers\Admin\PengaduanController::class, 'show'])->name('pengaduan.show');
});
