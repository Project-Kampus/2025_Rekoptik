<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FrameController;
use App\Http\Controllers\LensaController;
use App\Http\Controllers\PengaturanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RekamMedisController;
use App\Http\Controllers\SupplierController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn() => view('welcome'))->name('welcome');


Route::middleware('auth', 'verified')->group(function () {
    Route::middleware('role:admin')->group(function () {
        // Dashboard
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('role:admin');

        // Rekam Medis
        Route::prefix('rekam-medis')->name('rekam-medis.')->group(function () {
            Route::get('/', [RekamMedisController::class, 'index'])->name('index');
            Route::get('/create', [RekamMedisController::class, 'create'])->name('create');
            Route::post('/', [RekamMedisController::class, 'store'])->name('store');
            Route::get('/{pasien}/edit', [RekamMedisController::class, 'edit'])->name('edit');
            Route::put('/{pasien}', [RekamMedisController::class, 'update'])->name('update');
            Route::delete('/{pasien}', [RekamMedisController::class, 'destroy'])->name('destroy');
            Route::get('/{pasien}/struk', [RekamMedisController::class, 'struk'])->name('struk');
            Route::get('/rekap', [RekamMedisController::class, 'rekap'])->name('rekap');
            Route::get('/rekap/excel', [RekamMedisController::class, 'rekapExcel'])->name('rekapExcel');
            Route::get('/{pasien}/detail', [RekamMedisController::class, 'show'])->name('show');
            Route::post('/{pasien}/pengambilan', [RekamMedisController::class, 'pengambilan'])->name('pengambilan');
            Route::get('/{pasien}/surat', [RekamMedisController::class, 'surat'])->name('surat');
        });

        // Manajemen Frame
        Route::prefix('frame')->name('frame.')->group(function () {
            Route::get('/', [FrameController::class, 'index'])->name('index');
            Route::get('/create', [FrameController::class, 'create'])->name('create');
            Route::post('/', [FrameController::class, 'store'])->name('store');
            Route::get('/{frame}/edit', [FrameController::class, 'edit'])->name('edit');
            Route::put('/{frame}', [FrameController::class, 'update'])->name('update');
            Route::delete('/{frame}', [FrameController::class, 'destroy'])->name('destroy');
        });

        // Manajemen Lensa
        Route::prefix('lensa')->name('lensa.')->group(function () {
            Route::get('/', [LensaController::class, 'index'])->name('index');
            Route::get('/create', [LensaController::class, 'create'])->name('create');
            Route::post('/', [LensaController::class, 'store'])->name('store');
            Route::get('/{lensa}/edit', [LensaController::class, 'edit'])->name('edit');
            Route::put('/{lensa}', [LensaController::class, 'update'])->name('update');
            Route::delete('/{lensa}', [LensaController::class, 'destroy'])->name('destroy');
        });

        // Manajemen Supplier
        Route::prefix('supplier')->name('supplier.')->group(function () {
            Route::get('/', [SupplierController::class, 'index'])->name('index');
            Route::get('/create', [SupplierController::class, 'create'])->name('create');
            Route::post('/', [SupplierController::class, 'store'])->name('store');
            Route::get('/{supplier}/edit', [SupplierController::class, 'edit'])->name('edit');
            Route::put('/{supplier}', [SupplierController::class, 'update'])->name('update');
            Route::delete('/{supplier}', [SupplierController::class, 'destroy'])->name('destroy');
            Route::get('/{supplier}/show', [SupplierController::class, 'show'])->name('show');
        });


        Route::get('/riwayatAll', [DashboardController::class, 'riwayatAll'])->name('riwayat.all');


        // Pengaturan Sistem
        Route::prefix('pengaturan')->name('pengaturan.')->group(function () {
            Route::get('/', [PengaturanController::class, 'index'])->name('index');
            Route::put('/storage', [PengaturanController::class, 'update'])->name('update');
        });
    });

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
