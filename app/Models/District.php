<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    //use HasFactory;

    public $timestamps = false;
    protected $fillable = ['regency_id', 'name'];
}
