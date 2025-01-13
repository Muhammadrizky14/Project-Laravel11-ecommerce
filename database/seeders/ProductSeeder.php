<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        Product::create([
            'name' => 'Product Name',  // Make sure to include this
            'description' => 'Product Description',
            'price' => 100.00,
            'stock' => 10
        ]);
    }
}