<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FrameController;
use App\Http\Controllers\LensaController;
use App\Http\Controllers\PengaturanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RekamMedisController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn() => view('welcome'))->name('welcome');


Route::middleware('auth', 'verified')->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

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
        // Route::get('/rekap/pdf', [RekamMedisController::class, 'rekapPdf'])->name('rekapPdf');
        Route::get('/rekap/excel', [RekamMedisController::class, 'rekapExcel'])->name('rekapExcel');
        Route::get('/{pasien}/detail', [RekamMedisController::class, 'show'])->name('show');
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

    Route::resource('lensa', LensaController::class);

    Route::get('/riwayatAll', [DashboardController::class, 'riwayatAll'])->name('riwayat.all');


    // Pengaturan Sistem
    Route::prefix('pengaturan')->name('pengaturan.')->group(function () {
        Route::get('/', [PengaturanController::class, 'index'])->name('index');
        Route::put('/storage', [PengaturanController::class, 'update'])->name('update');
    });

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



require __DIR__ . '/auth.php';
