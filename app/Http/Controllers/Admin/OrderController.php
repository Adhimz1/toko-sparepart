<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Menampilkan daftar semua pesanan.
     */
    public function index()
    {
        $orders = Order::with('user')->latest()->paginate(10);
        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Menampilkan detail satu pesanan.
     */
    public function show(Order $order)
    {
        // 'items.sparepart' akan mengambil semua item di pesanan ini,
        // dan untuk setiap item, ambil juga detail produk sparepart-nya.
        $order->load('items.sparepart');
        return view('admin.orders.show', compact('order'));
    }

    /**
     * Menampilkan form untuk mengedit pesanan (mengubah status).
     */
    public function edit(Order $order)
    {
        // Daftar status yang bisa dipilih oleh admin
        $statuses = ['pending', 'processing', 'completed', 'cancelled'];
        return view('admin.orders.edit', compact('order', 'statuses'));
    }

    /**
     * Mengupdate data pesanan di database.
     */
    public function update(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|string|in:pending,processing,completed,cancelled',
        ]);

        $order->status = $request->status;
        $order->save();

        return redirect()->route('admin.orders.index')->with('success', 'Status pesanan #' . $order->id . ' berhasil diperbarui.');
    }

    /**
     * Menghapus pesanan dari database.
     */
    public function destroy(Order $order)
    {
        // Kita juga bisa memilih untuk tidak mengembalikan stok saat pesanan dihapus.
        // Tergantung kebijakan bisnis. Untuk saat ini, kita hapus saja.
        $order->delete();
        
        return redirect()->route('admin.orders.index')->with('success', 'Pesanan #' . $order->id . ' berhasil dihapus.');
    }
}