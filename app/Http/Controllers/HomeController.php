<?php

namespace App\Http\Controllers;

use App\Models\Sparepart;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Ambil semua data sparepart, urutkan dari yang terbaru
        $spareparts = Sparepart::latest()->get();

        // Kirim data ke view 'welcome'
        return view('welcome', compact('spareparts'));
    }
}