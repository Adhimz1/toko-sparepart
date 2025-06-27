<?php

use Illuminate\Support\Facades\Route;

// Import semua controller
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\UserOrderController;
use App\Http\Controllers\SparepartController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\UserController as AdminUserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// ================= RUTE PUBLIK =================
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/products', [HomeController::class, 'productsIndex'])->name('products.index');

// ================= RUTE OTENTIKASI =================
require __DIR__.'/auth.php';

// ================= RUTE PENGGUNA TEROTENTIKASI =================
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', fn() => view('user.dashboard'))->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
    Route::patch('/cart/update', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout', [CheckoutController::class, 'process'])->name('checkout.process');
    Route::get('/my-orders', [UserOrderController::class, 'index'])->name('user.orders.index');
    Route::delete('/my-orders/{order}/cancel', [UserOrderController::class, 'cancel'])->name('user.orders.cancel');
});

// ================= RUTE PANEL ADMIN =================
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::resource('orders', AdminOrderController::class)->except(['create', 'store']);
    Route::resource('spareparts', SparepartController::class);
    Route::resource('users', AdminUserController::class);
});

// ========================================================================
// PERBAIKAN DI SINI: RUTE API UNTUK AJAX DROPDOWN WILAYAH
// Diletakkan di luar middleware agar bisa diakses oleh JavaScript tanpa perlu login.
// ========================================================================

