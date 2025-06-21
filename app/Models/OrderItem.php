<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{// Sebuah OrderItem milik sebuah Order
public function order()
{
    return $this->belongsTo(Order::class);
}

// Sebuah OrderItem merujuk ke satu Sparepart
public function sparepart()
{
    return $this->belongsTo(Sparepart::class);
}
}
