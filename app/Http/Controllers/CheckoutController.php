<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Sparepart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CheckoutController extends Controller
{
    /**
     * Menampilkan halaman form checkout sederhana.
     */
    public function index()
    {
        $cart = Session::get('cart', []);
        
        if (empty($cart)) {
            return redirect()->route('products.index')->with('info', 'Keranjang Anda kosong, silakan belanja terlebih dahulu.');
        }

        $total = 0;
        foreach ($cart as $details) {
            $total += $details['price'] * $details['quantity'];
        }

        // Tidak perlu lagi mengirim data provinsi
        return view('checkout.index', compact('total'));
    }

    /**
     * Memproses pesanan dari form checkout sederhana.
     */
    public function process(Request $request)
    {
        // 1. Validasi input yang lebih sederhana
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'shipping_address' => 'required|string|max:1000', // Hanya satu field alamat
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
                    throw new \Exception('Stok untuk produk "' . $details['name'] . '" tidak mencukupi.');
                }
                $totalPrice += $details['price'] * $details['quantity'];
            }
            
            // Ongkos kirim bisa dibuat flat rate atau gratis untuk sementara
            $shippingCost = 10000; // Contoh ongkir tetap Rp 10.000
            $totalPrice += $shippingCost;

            // 2. Buat entri baru di tabel 'orders'
            $order = Order::create([
                'user_id' => Auth::id(),
                'status' => 'pending',
                'total_price' => $totalPrice,
                'shipping_address' => $request->shipping_address, // Menggunakan alamat dari textarea
                'billing_address' => $request->shipping_address, // Samakan saja
                'customer_name' => $request->customer_name,
                'phone' => $request->phone,
                'payment_method' => 'COD',
                'payment_status' => 'unpaid',
            ]);

            // 3. Simpan item dan kurangi stok (logika ini tidak berubah)
            foreach ($cart as $id => $details) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'sparepart_id' => $id,
                    'quantity' => $details['quantity'],
                    'price' => $details['price'],
                ]);
                
                $sparepart = Sparepart::find($id);
                $sparepart->stok -= $details['quantity'];
                $sparepart->save();
            }

            DB::commit();
            Session::forget('cart');

            return redirect()->route('user.orders.index')->with('success', 'Pesanan Anda dengan ID #' . $order->id . ' berhasil dibuat!');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('checkout.index')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    // Kita tidak lagi memerlukan getRegencies dan getDistricts, jadi bisa dihapus
}