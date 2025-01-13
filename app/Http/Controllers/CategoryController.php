<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        // Mengambil semua kategori beserta produk terkait yang visible
        $categories = Category::with(['categoryProducts' => function($query) {
            $query->where('is_visible', true)
                  ->orderBy('sort');
        }])
        ->where('is_visible', true)
        ->orderBy('sort')
        ->get();

        return view('categories.index', compact('categories'));
    }

    public function show($slug)
    {
        // Mengambil satu kategori berdasarkan slug beserta produk terkait yang visible
        $category = Category::where('slug', $slug)
            ->with(['categoryProducts' => function($query) {
                $query->where('is_visible', true)
                      ->orderBy('sort');
            }])
            ->firstOrFail();

        // Jika klien meminta format JSON
        if (request()->wantsJson()) {
            return response()->json($category);
        }

        // Render halaman show
        return view('categories.show', compact('category'));
    }
}
