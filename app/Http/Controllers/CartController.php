<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sparepart; // Pastikan model di-import

class CartController extends Controller
{
    /**
     * Menampilkan halaman keranjang belanja.
     */
    public function index()
    {
        return view('cart.index');
    }

    /**
     * Menambahkan produk ke dalam keranjang.
     */
    public function add(Request $request, $id)
    {
        $sparepart = Sparepart::findOrFail($id);
        $cart = session()->get('cart', []);
        $quantity = $request->input('quantity', 1);

        if ($quantity > $sparepart->stok) {
            return redirect()->back()->with('error', 'Kuantitas yang diminta melebihi stok yang tersedia!');
        }

        if(isset($cart[$id])) {
            $cart[$id]['quantity'] += $quantity;
        } else {
            $cart[$id] = [
                "name" => $sparepart->nama_barang,
                "quantity" => $quantity,
                "price" => $sparepart->harga,
                "image" => $sparepart->gambar
            ];
        }

        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Produk berhasil ditambahkan ke keranjang!');
    }

    /**
     * Memperbarui kuantitas item di keranjang. (VERSI YANG BENAR)
     */
    public function update(Request $request)
    {
        if($request->id && $request->quantity){
            $cart = session()->get('cart');
            $sparepart = Sparepart::find($request->id);

            if (!$sparepart) {
                return response()->json(['message' => 'Produk tidak ditemukan.'], 404);
            }

            if ($request->quantity > $sparepart->stok) {
                return response()->json(['message' => 'Kuantitas melebihi stok yang tersedia (' . $sparepart->stok . ').'], 422);
            }

            $cart[$request->id]["quantity"] = $request->quantity;
            session()->put('cart', $cart);
            return response()->json(['message' => 'Keranjang berhasil diperbarui!']);
        }
        return response()->json(['message' => 'Data tidak valid.'], 400);
    }

    /**
     * Menghapus item dari keranjang.
     */
    public function remove(Request $request)
    {
        if($request->id) {
            $cart = session()->get('cart');
            if(isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            session()->flash('success', 'Produk berhasil dihapus dari keranjang!');
        }
    }
}