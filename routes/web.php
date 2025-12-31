<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FrameController;
use App\Http\Controllers\LensaController;
use App\Http\Controllers\PengaturanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RekamMedisController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\RiwayatFrameController;
use App\Http\Controllers\RoleRekamMedis;
use Illuminate\Support\Facades\Route;

Route::get('/', fn() => view('welcome'))->name('welcome');


Route::middleware('auth', 'verified')->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::middleware('role:admin|superadmin')->group(function () {
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

        // riwayat frame
        Route::get('/riwayat-frame', [RiwayatFrameController::class, 'index'])
            ->name('frame.riwayat');


        Route::resource('lensa', LensaController::class);

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

    Route::middleware('role:bpjs')->group(function () {
        Route::get('/rekapMedis', [RoleRekamMedis::class, 'rekapMedisBpjs'])->name('rekapMedis.Bpjs');
        Route::get('/rekapMedis/{pasien}/detail', [RoleRekamMedis::class, 'rekapMedisDetail'])->name('rekapMedis.show');
        Route::get('/rekapMedis/{pasien}/struk', [RoleRekamMedis::class, 'rekapMedisStruk'])->name('rekapMedis.Struk');
        Route::get('/rekapMedis/{pasien}/suratBalasan', [RoleRekamMedis::class, 'rekapMedisSurat'])->name('rekapMedis.surat');
    });

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
