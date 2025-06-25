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
            // Cek jika session 'cart' ada dan tidak kosong
            if (session()->has('cart')) {
                // Lakukan perulangan pada setiap item di keranjang
                foreach(session('cart') as $id => $details) {
                    // Jumlahkan nilai 'quantity' dari setiap item
                    $cartCount += $details['quantity'];
                }
            }
            // Kirim total kuantitas ke semua view
            $view->with('cartCount', $cartCount);
        });
    }
}
