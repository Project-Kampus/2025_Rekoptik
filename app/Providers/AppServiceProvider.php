<?php

namespace App\Providers;

use App\Models\Pengaturan;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        view()->composer('*', function ($view) {
            try {
                // Cek apakah database sudah siap
                if (pengaturan::count() >= 0) {
                    $view->with('pengaturan', Pengaturan::first());
                }
            } catch (\Exception $e) {
                // Jika database belum siap (saat migration atau test), gunakan null
                $view->with('pengaturan', null);
            }
        });
    }
}
