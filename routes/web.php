<?php

use App\Http\Controllers\FrameController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RekamMedisController;
use App\Http\Controllers\SettingController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn() => view('welcome'))->name('welcome');


Route::middleware('auth', 'verified')->group(function () {
    // Dashboard
    Route::get('/dashboard', fn() => view('dashboard'))->name('dashboard');

    // Rekam Medis
    Route::prefix('rekam-medis')->name('rekam-medis.')->group(function () {
        Route::get('/', [RekamMedisController::class, 'index'])->name('index');
        Route::get('/create', [RekamMedisController::class, 'create'])->name('create');
        Route::post('/', [RekamMedisController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [RekamMedisController::class, 'edit'])->name('edit');
        Route::put('/{id}', [RekamMedisController::class, 'update'])->name('update');
        Route::delete('/{id}', [RekamMedisController::class, 'destroy'])->name('destroy');
    });

    // Manajemen Frame
    Route::prefix('frame')->name('frame.')->group(function () {
        Route::get('/', [FrameController::class, 'index'])->name('index');
        Route::get('/create', [FrameController::class, 'create'])->name('create');
        Route::post('/', [FrameController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [FrameController::class, 'edit'])->name('edit');
        Route::put('/{id}', [FrameController::class, 'update'])->name('update');
        Route::delete('/{id}', [FrameController::class, 'destroy'])->name('destroy');
    });

    // Pengaturan Sistem
    Route::prefix('settings')->name('settings.')->group(function () {
        Route::get('/', [SettingController::class, 'index'])->name('index');
    });

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



require __DIR__ . '/auth.php';
