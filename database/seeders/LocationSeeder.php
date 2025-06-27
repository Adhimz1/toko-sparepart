<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Province;
use App\Models\Regency;
use App\Models\District;

class LocationSeeder extends Seeder
{
    public function run(): void
    {
        // Provinsi
        $jawaBarat = Province::create(['name' => 'Jawa Barat']);

        // Kabupaten/Kota di Jawa Barat
        $kuningan = Regency::create(['province_id' => $jawaBarat->id, 'name' => 'Kuningan']);
        $bandung = Regency::create(['province_id' => $jawaBarat->id, 'name' => 'Bandung']);

        // Kecamatan di Kuningan
        District::create(['regency_id' => $kuningan->id, 'name' => 'Cilimus']);
        District::create(['regency_id' => $kuningan->id, 'name' => 'Kuningan']);
        District::create(['regency_id' => $kuningan->id, 'name' => 'Ciawigebang']);

        // Kecamatan di Bandung
        District::create(['regency_id' => $bandung->id, 'name' => 'Coblong']);
        District::create(['regency_id' => $bandung->id, 'name' => 'Gedebage']);
    }
}