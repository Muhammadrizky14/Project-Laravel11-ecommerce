<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LocationSeeder extends Seeder
{
    public function run()
    {
        // Insert provinces
        $provinces = [
            ['name' => 'Aceh'],
            ['name' => 'Sumatera Utara'],
            ['name' => 'Sumatera Barat'],
            ['name' => 'Riau'],
            ['name' => 'Jambi'],
            ['name' => 'Sumatera Selatan'],
            ['name' => 'Bengkulu'],
            ['name' => 'Lampung'],
            ['name' => 'Kepulauan Bangka Belitung'],
            ['name' => 'Kepulauan Riau'],
            ['name' => 'DKI Jakarta'],
            ['name' => 'Jawa Barat'],
            ['name' => 'Jawa Tengah'],
            ['name' => 'DI Yogyakarta'],
            ['name' => 'Jawa Timur'],
            ['name' => 'Banten'],
            ['name' => 'Bali'],
            ['name' => 'Nusa Tenggara Barat'],
            ['name' => 'Nusa Tenggara Timur'],
            ['name' => 'Kalimantan Barat'],
            ['name' => 'Kalimantan Tengah'],
            ['name' => 'Kalimantan Selatan'],
            ['name' => 'Kalimantan Timur'],
            ['name' => 'Kalimantan Utara'],
            ['name' => 'Sulawesi Utara'],
            ['name' => 'Sulawesi Tengah'],
            ['name' => 'Sulawesi Selatan'],
            ['name' => 'Sulawesi Tenggara'],
            ['name' => 'Gorontalo'],
            ['name' => 'Sulawesi Barat'],
            ['name' => 'Maluku'],
            ['name' => 'Maluku Utara'],
            ['name' => 'Papua'],
            ['name' => 'Papua Barat']
        ];

        DB::table('provinces')->insert($provinces);

        // Insert sample cities for each province
        $cities = [
            // DKI Jakarta
            ['province_id' => 11, 'name' => 'Jakarta Pusat'],
            ['province_id' => 11, 'name' => 'Jakarta Utara'],
            ['province_id' => 11, 'name' => 'Jakarta Barat'],
            ['province_id' => 11, 'name' => 'Jakarta Selatan'],
            ['province_id' => 11, 'name' => 'Jakarta Timur'],
            
            // Jawa Barat
            ['province_id' => 12, 'name' => 'Bandung'],
            ['province_id' => 12, 'name' => 'Bekasi'],
            ['province_id' => 12, 'name' => 'Bogor'],
            ['province_id' => 12, 'name' => 'Depok'],
            ['province_id' => 12, 'name' => 'Cimahi'],
            
            // Jawa Tengah
            ['province_id' => 13, 'name' => 'Semarang'],
            ['province_id' => 13, 'name' => 'Solo'],
            ['province_id' => 13, 'name' => 'Magelang'],
            ['province_id' => 13, 'name' => 'Pekalongan'],
            ['province_id' => 13, 'name' => 'Tegal'],
            
            // DI Yogyakarta
            ['province_id' => 14, 'name' => 'Yogyakarta'],
            ['province_id' => 14, 'name' => 'Bantul'],
            ['province_id' => 14, 'name' => 'Sleman'],
            ['province_id' => 14, 'name' => 'Kulon Progo'],
            ['province_id' => 14, 'name' => 'Gunung Kidul'],
            
            // Jawa Timur
            ['province_id' => 15, 'name' => 'Surabaya'],
            ['province_id' => 15, 'name' => 'Malang'],
            ['province_id' => 15, 'name' => 'Sidoarjo'],
            ['province_id' => 15, 'name' => 'Gresik'],
            ['province_id' => 15, 'name' => 'Mojokerto']
        ];

        DB::table('cities')->insert($cities);
    }
}

