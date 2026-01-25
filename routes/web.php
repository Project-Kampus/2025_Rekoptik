<?php

use App\Http\Controllers\Master\FrameController;
use App\Http\Controllers\Master\LensaController;
use App\Http\Controllers\Master\SupplierController;

use App\Http\Controllers\Super\AdminController;
use App\Http\Controllers\Super\PengaturanController;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Master\AksesorisController;
use App\Http\Controllers\Master\DocumentController;
use App\Http\Controllers\Mitra\RekapBpjsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RekamMedis\DataMedisController;
use App\Http\Controllers\RekamMedis\IdentitasPasienController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn() => view('welcome'))->name('welcome');
Route::get('/test', fn() => view('test'))->name('test');

Route::middleware('auth', 'verified')->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::middleware('role:admin|superadmin')->group(function () {
        // Rekam Medis
        Route::prefix('datamedis')
            ->name('datamedis.')
            ->group(function () {
                Route::get('/', [DataMedisController::class, 'index'])->name('index');
                Route::get('/create/step1', [DataMedisController::class, 'createStep1'])->name('create.step1');
                Route::post('/create/step1', [DataMedisController::class, 'storeStep1'])->name('store.step1');
                Route::get('/create/step2/{pasien}', [DataMedisController::class, 'createStep2'])->name('create.step2');
                Route::post('/create/step2/{pasien}', [DataMedisController::class, 'storeStep2'])->name('store.step2');
                Route::get('/{RmPemeriksaan}/show', [DataMedisController::class, 'show'])->name('show');
                Route::get('/{RmPemeriksaan}/edit', [DataMedisController::class, 'edit'])->name('edit');
                Route::get('/{RmPemeriksaan}/edit', [DataMedisController::class, 'edit'])->name('edit');
                Route::put('/{RmPemeriksaan}/update', [DataMedisController::class, 'update'])->name('update');
                Route::post('/{RmPemeriksaan}/storePengambilan', [DataMedisController::class, 'storePengambilan'])->name('storePengambilan');
                Route::post('/{RmPemeriksaan}/storeDokumnet', [DataMedisController::class, 'storeDokumnet'])->name('storeDokumnet');
                Route::post('/{RmPemeriksaan}/storePembayaran', [DataMedisController::class, 'storePembayaran'])->name('storePembayaran');
                Route::delete('/{RmPembayaran}/destroyPembayaran', [DataMedisController::class, 'destroyPembayaran'])->name('destroyPembayaran');
                Route::get('/{RmPembayaran}/cetatakStruk', [DataMedisController::class, 'cetatakStruk'])->name('cetatakStruk');
                Route::get('/{RmPemeriksaan}/cetakSuratBalasan', [DataMedisController::class, 'cetakSuratBalasan'])->name('cetakSuratBalasan');
            });
        // Identitas Pasien
        Route::prefix('identitaspasien')
            ->name('identitaspasien.')
            ->group(function () {
                Route::get('/', [IdentitasPasienController::class, 'index'])->name('index');
                Route::get('/create', [IdentitasPasienController::class, 'create'])->name('create');
                Route::post('/', [IdentitasPasienController::class, 'store'])->name('store');
                Route::get('/{identitaspasien}/edit', [IdentitasPasienController::class, 'edit'])->name('edit');
                Route::put('/{identitaspasien}', [IdentitasPasienController::class, 'update'])->name('update');
                Route::get('/{identitaspasien}/show', [IdentitasPasienController::class, 'show'])->name('show');
            });
        // Mater data
        Route::resource('frame', FrameController::class);
        Route::resource('lensa', LensaController::class);
        Route::resource('supplier', SupplierController::class);
        Route::resource('document', DocumentController::class);
        Route::resource('aksesoris', AksesorisController::class);
    });

    Route::middleware('role:superadmin')->group(function () {
        // Pengaturan Sistem
        Route::prefix('pengaturan')
            ->name('pengaturan.')
            ->group(function () {
                Route::get('/', [PengaturanController::class, 'index'])->name('index');
                Route::put('/storage', [PengaturanController::class, 'update'])->name('update');
            });
        Route::prefix('admin')
            ->name('admin.')
            ->group(function () {
                Route::get('/', [AdminController::class, 'index'])->name('index');
                Route::get('/create', [AdminController::class, 'create'])->name('create');
                Route::post('/', [AdminController::class, 'store'])->name('store');
                Route::get('/{admin}/edit', [AdminController::class, 'edit'])->name('edit');
                Route::put('/{admin}', [AdminController::class, 'update'])->name('update');
                Route::delete('/{admin}', [AdminController::class, 'destroy'])->name('destroy');
            });
    });

    Route::middleware('role:bpjs')->prefix('mitra')->name('mitra.')->group(function () {
        // Pengaturan Sistem
        Route::prefix('bpjs')
            ->name('bpjs.')
            ->group(function () {
                Route::get('/', [RekapBpjsController::class, 'index'])->name('index');
                Route::get('/{pesanan}', [RekapBpjsController::class, 'show'])->name('show');
            });
    });



    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
