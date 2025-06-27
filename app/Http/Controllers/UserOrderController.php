<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserOrderController extends Controller
{
    /**
     * Menampilkan riwayat pesanan untuk pengguna yang sedang login.
     */
    public function index()
    {
        // Ambil pengguna yang sedang login
        $user = Auth::user();

        // ==========================================================
        // PERBAIKAN DI SINI: Tambahkan PHPDoc block
        // Ini memberitahu editor bahwa $user adalah instance dari App\Models\User,
        // sehingga editor bisa "melihat" relasi orders() yang ada di sana.
        // ==========================================================
        /** @var \App\Models\User $user */
        
        // Sekarang, error 'Undefined method' seharusnya hilang dari editor.
        $orders = $user->orders()->latest()->paginate(5);

        // Kirim data pesanan ke view
        return view('user.orders.index', compact('orders'));
    }
}