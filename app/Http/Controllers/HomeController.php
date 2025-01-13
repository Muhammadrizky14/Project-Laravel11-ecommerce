<?php

namespace App\Http\Controllers;

use App\Models\FlashSale;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Fetch categories with related visible products (limit to 3 per category)
        $categories = Category::with(['categoryProducts' => function($query) {
            $query->where('is_visible', true)
                  ->orderBy('sort')
                  ->take(3); // Limit to 3 products per category
        }])
        ->where('is_visible', true)
        ->orderBy('sort')
        ->get();

        // Fetch active flash sales with related products
        $flashSales = FlashSale::with('product')
            ->where('is_active', true)
            ->where('start_time', '<=', now())
            ->where('end_time', '>', now())
            ->get();

        return view('home', compact('categories', 'flashSales'));
    }

    public function ourStory()
    {
        return view('our-story');
    }

    public function blog()
    {
        return view('blog');
    }

    public function contactUs()
    {
        return view('contact-us');
    }
}
