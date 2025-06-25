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
        // 1. Ambil pengguna yang sedang login
        $user = Auth::user();

        // 2. Ambil semua pesanan milik pengguna tersebut.
        //    'with('items.sparepart')' adalah eager loading untuk mengambil detail item dan produknya.
        //    'latest()' untuk mengurutkan dari yang terbaru.
        $orders = $user->orders()->with('items.sparepart')->latest()->paginate(5);

        // 3. Kirim data pesanan ke view
        return view('user.orders.index', compact('orders'));
    }
}