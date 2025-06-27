<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{// Sebuah OrderItem milik sebuah Order
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'order_id',
        'sparepart_id',
        'quantity',
        'price',
    ];
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
