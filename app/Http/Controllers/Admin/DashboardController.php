<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sparepart; // <-- Import model Sparepart
use App\Models\User;      // <-- Import model User
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Ambil data ringkasan
        $totalSpareparts = Sparepart::count();
        $totalUsers = User::count();
        $latestSpareparts = Sparepart::latest()->take(5)->get();
        // Nantinya bisa ditambahkan data lain, contoh:
        // $lowStockSpareparts = Sparepart::where('stok', '<', 5)->count();

        // Kirim data ke view
        return view('admin.dashboard', [
            'totalSpareparts' => $totalSpareparts,
            'totalUsers' => $totalUsers,
            'latestSpareparts' => $latestSpareparts,
        ]);
    }
}