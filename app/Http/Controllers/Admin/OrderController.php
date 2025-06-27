<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    /**
     * Menampilkan daftar semua pesanan.
     */
    public function index()
    {
        // Ambil semua order, yang terbaru di atas, dengan data user-nya (Eager Loading)
        $orders = Order::with('user')->latest()->paginate(10);
        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Menampilkan detail satu pesanan.
     */
    public function show(Order $order)
    {
        // Eager load item-item dan produk terkaitnya untuk ditampilkan di detail
        $order->load('items.sparepart');
        return view('admin.orders.show', compact('order'));
    }

    /**
     * Menampilkan form edit (kita gunakan halaman show untuk update status).
     * Anda bisa membuat halaman edit terpisah jika fiturnya kompleks.
     */
    public function edit(Order $order)
    {
        // Arahkan saja ke halaman show untuk simplicity
        return redirect()->route('admin.orders.show', $order);
    }

    /**
     * Memperbarui status pesanan.
     */
    public function update(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|string|in:pending,processing,completed,cancelled',
        ]);

        $order->status = $request->status;
        $order->save();

        return redirect()->route('admin.orders.show', $order)->with('success', 'Status pesanan berhasil diperbarui!');
    }

    /**
     * Menghapus pesanan dari database.
     */
    public function destroy(Order $order)
    {
        // Di sini kita tidak mengembalikan stok, hanya menghapus record.
        // Jika ingin mengembalikan stok, tambahkan logika perulangan item.
        $order->delete();
        
        return redirect()->route('admin.orders.index')->with('success', 'Pesanan berhasil dihapus.');
    }
}