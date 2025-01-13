<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BrandSeeder extends Seeder
{
    public function run(): void
    {
        $brands = [
            'Nike',
            'Adidas',
            'Puma',
            'Under Armour',
            'New Balance',
            'Reebok',
            'Converse',
            'Vans',
            'Fila',
            'ASICS'
        ];

        foreach ($brands as $brand) {
            Brand::create([
                'name' => $brand,
                'slug' => Str::slug($brand)
            ]);
        }
    }
}

