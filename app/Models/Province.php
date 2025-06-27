<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    //use HasFactory;

    // Beritahu Laravel bahwa model ini tidak menggunakan kolom created_at dan updated_at
    public $timestamps = false;
    
    // Definisikan kolom yang bisa diisi massal
    protected $fillable = ['name'];
}
