<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sparepart extends Model
{
    protected $fillable = [
        'nama_barang',
        'kode_barang',
        'harga',
        'stok',
        'deskripsi',
        'gambar',
    ];

    // Sebuah Sparepart bisa ada di banyak OrderItem
public function orderItems()
{
    return $this->hasMany(OrderItem::class);
}
}
