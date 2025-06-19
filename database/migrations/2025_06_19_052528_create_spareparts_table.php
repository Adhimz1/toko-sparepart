<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('spareparts', function (Blueprint $table) {
         $table->id();
        $table->string('nama_barang');
        $table->string('kode_barang')->unique()->nullable();
        $table->integer('harga');
        $table->integer('stok');
        $table->text('deskripsi')->nullable();
        $table->string('gambar')->nullable(); // untuk menyimpan path/nama file gambar
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('spareparts');
    }
};
