<?php
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Rute Halaman Utama (Publik)
//ute::get('/', function () {
   //eturn view('welcome');
//;

Route::get('/', [HomeController::class, 'index'])->name('home');

// Rute Dashboard bawaan Breeze untuk user yang sudah login
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Rute Profile bawaan Breeze
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Ini memuat rute otentikasi (login, register, dll)
require __DIR__.'/auth.php';


// ========================================================================
// <-- TAMBAHKAN BLOK INI DI SINI
// GRUP RUTE UNTUK ADMIN PANEL
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    
    // Nanti bisa ditambahkan rute untuk dashboard admin di sini
    // Contoh: Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    // Rute untuk mengelola data sparepart (CRUD)
    Route::resource('spareparts', App\Http\Controllers\SparepartController::class)->except([
        'show'
    ]);

        Route::resource('users', App\Http\Controllers\Admin\UserController::class);

});

Route::get('/test-write', function () {
    try {
        // Coba tulis file 'test.txt' ke dalam 'storage/app/public/'
        \Illuminate\Support\Facades\Storage::disk('public')->put('test.txt', 'Hello World, I can write!');
        return 'SUCCESS: File berhasil ditulis di folder storage/app/public/';
    } catch (\Exception $e) {
        // Jika gagal, tampilkan pesan errornya
        return 'ERROR: Gagal menulis file. Pesan error: ' . $e->getMessage();
    }
});
// ========================================================================