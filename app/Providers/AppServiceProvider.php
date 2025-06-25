<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
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
        //
        View::composer('*', function ($view) {
            $cartCount = 0;
            if (session('cart')) {
                // Menghitung jumlah item unik di keranjang
                $cartCount = count(session('cart'));
            }
            // Kirim variabel $cartCount ke semua view
            $view->with('cartCount', $cartCount);
        });
    }
}
