<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    protected $validCategories = [
        'jackets',
        't-shirts',
        'pants',
        'shoes',
        'accessories',
        'sports-equipment',
        'running-gear',
        'training-wear',
        'casual-wear',
        'winter-collection',
        'baju',
        'cashmere-set'
    ];
    
    // Main shop page with category and price filters, sorting
    public function index(Request $request)
    {
        $query = Product::query();
        
        // Apply category filters with validation
        if ($request->has('category')) {
            $categories = array_filter(
                (array) $request->category,
                fn($category) => in_array($category, $this->validCategories)
            );
            
            if (!empty($categories)) {
                $query->whereHas('categories', function($q) use ($categories) {
                    $q->whereIn('name', $categories);
                });
            }
        }
        
        // Apply price filters with validation
        $minPrice = filter_var($request->min_price, FILTER_VALIDATE_FLOAT);
        if ($minPrice !== false) {
            $query->where('price', '>=', $minPrice);
        }
        
        $maxPrice = filter_var($request->max_price, FILTER_VALIDATE_FLOAT);
        if ($maxPrice !== false) {
            $query->where('price', '<=', $maxPrice);
        }
        
        // Apply sorting with validation
        $validSortOptions = ['price_high', 'price_low', 'newest', 'popular'];
        $sort = in_array($request->sort, $validSortOptions) ? $request->sort : 'newest';
        
        switch ($sort) {
            case 'price_high':
                $query->orderBy('price', 'desc');
                break;
            case 'price_low':
                $query->orderBy('price', 'asc');
                break;
            case 'popular':
                $query->withCount('orders')
                      ->orderBy('orders_count', 'desc')
                      ->orderBy('created_at', 'desc'); // secondary sort
                break;
            case 'newest':
            default:
                $query->latest();
                break;
        }
        
        try {
            $perPage = min(max((int) $request->input('per_page', 6), 1), 100);
            $products = $query->paginate($perPage)->withQueryString();
        } catch (\Exception $e) {
            \Log::error('Pagination error: ' . $e->getMessage());
            $products = $query->paginate(6)->withQueryString();
        }
        
        return view('shop', [
            'products' => $products,
            'validCategories' => $this->validCategories
        ]);
    }

    // Category-specific page with products
    public function category($slug)
    {
        $category = Category::where('slug', $slug)
            ->with(['categoryProducts' => function($query) {
                $query->where('is_visible', true)
                      ->orderBy('sort');
            }])
            ->firstOrFail();

        $products = $category->categoryProducts()
            ->where('is_visible', true)
            ->orderBy('sort')
            ->paginate(12);

        return view('shop.category', compact('category', 'products'));
    }

    /**
     * Handle failed validation
     *
     * @param array $errors
     * @return \Illuminate\Http\Response
     */
    protected function handleValidationErrors($errors)
    {
        if (request()->expectsJson()) {
            return response()->json([
                'success' => false,
                'errors' => $errors
            ], 422);
        }

        return redirect()->back()
            ->withInput()
            ->withErrors($errors);
    }
}
