<?php

namespace App\Http\Controllers;

use App\Models\Sparepart;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Ambil semua data sparepart, urutkan dari yang terbaru
       $spareparts = Sparepart::latest()->take(8)->get();

        // Kirim data ke view 'welcome'
        return view('welcome', compact('spareparts'));
    }
    public function productsIndex(Request $request)
    {
        // Ambil kata kunci pencarian dari request
        $search = $request->query('search');

        $sparepartsQuery = Sparepart::query(); // Memulai query Sparepart

        if ($search) {
            // Jika ada kata kunci pencarian, filter data berdasarkan nama_barang atau deskripsi
            $sparepartsQuery->where('nama_barang', 'like', '%' . $search . '%')
                            ->orWhere('deskripsi', 'like', '%' . $search . '%');
        }

        // Ambil produk yang sudah difilter atau semua produk jika tidak ada pencarian, dengan paginasi (misal 12 produk per halaman)
        $spareparts = $sparepartsQuery->latest()->paginate(12)->withQueryString();

        return view('user.products.index', compact('spareparts')); // Mengirim data ke view user.products.index
    }
}
