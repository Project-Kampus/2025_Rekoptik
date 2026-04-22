<?php

namespace App\Providers;

use App\Models\pengaturan;
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
                $view->with(
                    'pengaturan',
                    pengaturan::first()
                );
            } catch (\Exception $e) {
                // Jika database belum siap (saat test), gunakan data default
                $view->with('pengaturan', null);
            }
        });
    }
}
