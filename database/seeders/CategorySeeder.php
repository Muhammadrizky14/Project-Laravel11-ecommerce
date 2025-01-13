<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'Jackets',
            'T-Shirts',
            'Pants',
            'Shoes',
            'Accessories',
            'Sports Equipment',
            'Running Gear',
            'Training Wear',
            'Casual Wear',
            'Winter Collection'
        ];

        foreach ($categories as $category) {
            Category::create([
                'name' => $category,
                'slug' => Str::slug($category)
            ]);
        }
    }
}

