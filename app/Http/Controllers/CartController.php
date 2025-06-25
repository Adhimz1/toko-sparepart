<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sparepart;

class CartController extends Controller
{
    /**
     * Menampilkan halaman keranjang belanja.
     */
    public function index()
    {
        // Kita hanya akan menampilkan view-nya di sini.
        // Data keranjang akan diambil langsung dari session di dalam file view.
        return view('cart.index');
    }

    /**
     * Menambahkan produk ke dalam keranjang.
     */
    public function add(Request $request, $id)
    {
        // 1. Cari produk berdasarkan ID. Jika tidak ada, kembali dengan error.
        $sparepart = Sparepart::findOrFail($id);
        
        // 2. Ambil data keranjang yang sudah ada dari session.
        //    Jika belum ada, buat array kosong.
        $cart = session()->get('cart', []);

        // 3. Validasi kuantitas yang diminta.
        $quantity = $request->input('quantity', 1); // Ambil kuantitas dari form, defaultnya 1.
        if ($quantity > $sparepart->stok) {
            return redirect()->back()->with('error', 'Kuantitas yang diminta melebihi stok yang tersedia!');
        }

        // 4. Cek apakah produk SUDAH ADA di keranjang.
        if(isset($cart[$id])) {
            // Jika sudah ada, cukup tambahkan kuantitasnya.
            $cart[$id]['quantity'] += $quantity;
        } else {
            // Jika belum ada, tambahkan sebagai item baru ke keranjang.
            $cart[$id] = [
                "name" => $sparepart->nama_barang,
                "quantity" => $quantity,
                "price" => $sparepart->harga,
                "image" => $sparepart->gambar
            ];
        }

        // 5. Simpan kembali data keranjang yang sudah diperbarui ke dalam session.
        session()->put('cart', $cart);

        // 6. Redirect kembali ke halaman produk dengan pesan sukses.
        return redirect()->back()->with('success', 'Produk berhasil ditambahkan ke keranjang!');
    }
public function update(Request $request)
    {
        if($request->id && $request->quantity){
            $cart = session()->get('cart');
            $sparepart = Sparepart::find($request->id); // Cari stok produk

            // Pastikan kuantitas tidak melebihi stok
            if ($request->quantity > $sparepart->stok) {
                session()->flash('error', 'Kuantitas melebihi stok yang tersedia!');
                return; // Berhenti jika melebihi stok
            }

            $cart[$request->id]["quantity"] = $request->quantity;
            session()->put('cart', $cart);
            session()->flash('success', 'Keranjang berhasil diperbarui!');
        }
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
    // (Nantinya kita akan tambahkan fungsi update dan remove di sini)
}