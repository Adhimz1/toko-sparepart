<?php

namespace App\Http\Controllers;

use App\Models\Order;
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
    public function cancel(Order $order)
    {
        // 1. Otorisasi: Pastikan pesanan ini benar-benar milik pengguna yang login.
        if ($order->user_id !== Auth::id()) {
            abort(403, 'ANDA TIDAK BERHAK MENGAKSES PESANAN INI.');
        }

        // 2. Logika Bisnis: Hanya pesanan dengan status 'pending' yang bisa dibatalkan.
        if ($order->status !== 'pending') {
            return redirect()->route('user.orders.index')->with('error', 'Pesanan tidak dapat dibatalkan karena sudah diproses.');
        }
        
        // 3. Ubah status dan simpan
        $order->status = 'cancelled';
        $order->save();

        // Di sini kita bisa tambahkan logika untuk mengembalikan stok, jika perlu.
        // foreach ($order->items as $item) {
        //     $sparepart = $item->sparepart;
        //     if ($sparepart) {
        //         $sparepart->stok += $item->quantity;
        //         $sparepart->save();
        //     }
        // }

        return redirect()->route('user.orders.index')->with('success', 'Pesanan #' . $order->id . ' berhasil dibatalkan.');
    }
}
