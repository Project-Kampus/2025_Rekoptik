<?php

use App\Http\Controllers\Master\FrameController;
use App\Http\Controllers\Master\LensaController;
use App\Http\Controllers\Master\SupplierController;

use App\Http\Controllers\Super\AdminController;
use App\Http\Controllers\Super\PengaturanController;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Master\AksesorisController;
use App\Http\Controllers\Master\DocumentController;
use App\Http\Controllers\ProfileController;

use Illuminate\Support\Facades\Route;

Route::get('/', fn() => view('welcome'))->name('welcome');
Route::get('/test', fn() => view('test'))->name('test');


Route::middleware('auth', 'verified')->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::middleware('role:admin|superadmin')->group(function () {
        // Rekam Medis

        // Mater data
        Route::resource('frame', FrameController::class);
        Route::resource('lensa', LensaController::class);
        Route::resource('supplier', SupplierController::class);
        Route::resource('document', DocumentController::class);
        Route::resource('aksesoris', AksesorisController::class);
    });

    Route::middleware('role:superadmin')->group(function () {
        // Pengaturan Sistem
        Route::prefix('pengaturan')->name('pengaturan.')->group(function () {
            Route::get('/', [PengaturanController::class, 'index'])->name('index');
            Route::put('/storage', [PengaturanController::class, 'update'])->name('update');
        });
        Route::prefix('admin')->name('admin.')->group(function () {
            Route::get('/', [AdminController::class, 'index'])->name('index');
            Route::get('/create', [AdminController::class, 'create'])->name('create');
            Route::post('/', [AdminController::class, 'store'])->name('store');
            Route::get('/{admin}/edit', [AdminController::class, 'edit'])->name('edit');
            Route::put('/{admin}', [AdminController::class, 'update'])->name('update');
            Route::delete('/{admin}', [AdminController::class, 'destroy'])->name('destroy');
        });
    });

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
