<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Sparepart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CheckoutController extends Controller
{
    /**
     * Menampilkan halaman form checkout.
     */
    public function index()
    {
        $cart = Session::get('cart', []);
        
        if (empty($cart)) {
            return redirect()->route('products.index')->with('info', 'Keranjang Anda kosong.');
        }

        return view('checkout.index');
    }

    /**
     * Memproses pesanan dari form checkout.
     */
    public function process(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'shipping_address' => 'required|string|max:500',
        ]);

        $cart = Session::get('cart');
        if (empty($cart)) {
            return redirect()->route('products.index')->with('error', 'Keranjang Anda kosong.');
        }

        DB::beginTransaction();

        try {
            $totalPrice = 0;
            foreach ($cart as $id => $details) {
                $sparepart = Sparepart::find($id);
                if (!$sparepart || $sparepart->stok < $details['quantity']) {
                    throw new \Exception("Stok untuk produk '" . ($details['name'] ?? 'ID:'.$id) . "' tidak mencukupi.");
                }
                $totalPrice += $details['price'] * $details['quantity'];
            }
            
            $grandTotal = $totalPrice; // Ongkir gratis

            $order = Order::create([
                'user_id' => Auth::id(),
                'status' => 'pending',
                'total_price' => $grandTotal,
                'shipping_address' => $request->shipping_address,
                'billing_address' => $request->shipping_address,
                'customer_name' => $request->customer_name,
                'phone' => $request->phone,
                'payment_method' => 'COD',
                'payment_status' => 'unpaid',
            ]);

            foreach ($cart as $id => $details) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'sparepart_id' => $id,
                    'quantity' => $details['quantity'],
                    'price' => $details['price'],
                ]);
                
                Sparepart::where('id', $id)->decrement('stok', $details['quantity']);
            }

            DB::commit();
            Session::forget('cart');

            return redirect()->route('checkout.success', ['order' => $order]);

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('cart.index')->with('error', 'Gagal memproses pesanan: ' . $e->getMessage());
        }
    }

    /**
     * Menampilkan halaman konfirmasi setelah checkout berhasil.
     */
    public function success(Order $order)
    {
        // Pastikan hanya pemilik pesanan yang bisa melihat halaman ini
        if ($order->user_id !== Auth::id()) {
            abort(403, 'Akses Ditolak.');
        }
        
        // Kirim data pesanan ke view checkout.success
        return view('checkout.success', compact('order'));
    }
}