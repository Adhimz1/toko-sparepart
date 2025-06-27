<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
 use Illuminate\Database\Eloquent\Factories\HasFactory;


class Order extends Model
{
    //// Sebuah Order milik seorang User
    use HasFactory; // Pastikan ini ada

    // ==========================================================
    // PERBAIKI ATAU TAMBAHKAN BLOK INI
    // ==========================================================
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'status',
        'total_price',
        'shipping_address',
        'billing_address',
        'customer_name', // <-- Kolom baru harus ada di sini
        'phone',         // <-- Dan di sini
        'payment_method',
        'payment_status',
    ];
public function user()
{
    return $this->belongsTo(User::class);
}

// Sebuah Order punya banyak Item
public function items()
{
    return $this->hasMany(OrderItem::class);
}
}
