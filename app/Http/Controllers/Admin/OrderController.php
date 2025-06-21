<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
     public function index()
    {
        // Ambil semua order, yang terbaru di atas
        // 'with('user')' adalah untuk Eager Loading, agar lebih efisien
        $orders = Order::with('user')->latest()->paginate(10);

        return view('admin.orders.index', compact('orders'));
    }
}
