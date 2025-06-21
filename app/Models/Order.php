<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //// Sebuah Order milik seorang User
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
