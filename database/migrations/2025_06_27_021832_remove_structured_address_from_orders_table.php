<?php
// File: ...remove_structured_address_from_orders_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Menjalankan migrasi untuk menghapus kolom.
     */
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            // Hapus kolom-kolom ini jika ada
            if (Schema::hasColumn('orders', 'province')) {
                $table->dropColumn('province');
            }
            if (Schema::hasColumn('orders', 'regency')) {
                $table->dropColumn('regency');
            }
            if (Schema::hasColumn('orders', 'district')) {
                $table->dropColumn('district');
            }
            if (Schema::hasColumn('orders', 'detail_address')) {
                $table->dropColumn('detail_address');
            }
        });
    }

    /**
     * Membatalkan migrasi (mengembalikan kolom jika di-rollback).
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('province')->nullable();
            $table->string('regency')->nullable();
            $table->string('district')->nullable();
            $table->string('detail_address')->nullable();
        });
    }
};