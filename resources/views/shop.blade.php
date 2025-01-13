@extends('layouts.app')

@section('title', 'Shop')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-4xl font-bold text-gray-900 mb-2">Shop</h1>
    <div class="text-gray-600 mb-8">Discover our unique collection of products</div>
    
    <div class="flex flex-col md:flex-row gap-8">
        <!-- Filters Section -->
        <div class="w-full md:w-64">
            <div class="sticky top-4">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-lg font-medium">Filters</h2>
                    <button 
                        onclick="clearFilters()"
                        class="text-gray-500 text-sm hover:text-gray-700 transition-colors"
                    >
                        Clear filters
                    </button>
                </div>
                
                <form action="{{ route('shop.index') }}" method="GET" id="filterForm">
                    <div class="mb-6">
                        <h3 class="text-sm font-medium mb-2">Categories</h3>
                        <div class="space-y-2">
                        @php
                        $validCategories = [
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

                        $selectedCategories = array_filter(
                            request()->get('category', []),
                            fn($cat) => in_array($cat, $validCategories)
                        );
                        @endphp

                            @foreach($validCategories as $category)
                                <label class="flex items-center space-x-2">
                                    <input 
                                        type="checkbox" 
                                        class="rounded border-gray-300 text-blue-600 focus:ring-blue-500" 
                                        name="category[]" 
                                        value="{{ $category }}"
                                        {{ in_array($category, $selectedCategories) ? 'checked' : '' }}
                                    >
                                    <span class="text-gray-700 capitalize">{{ $category }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>
                    
                    <div class="mb-6">
                        <h3 class="text-sm font-medium mb-2">Price Range</h3>
                        <div class="space-y-2">
                            <div class="flex gap-2">
                                <input 
                                    type="number" 
                                    name="min_price" 
                                    placeholder="Min"
                                    min="0"
                                    step="0.01"
                                    class="w-full border-gray-300 rounded-md text-sm"
                                    value="{{ filter_var(request('min_price'), FILTER_VALIDATE_FLOAT) !== false ? request('min_price') : '' }}"
                                >
                                <input 
                                    type="number" 
                                    name="max_price" 
                                    placeholder="Max"
                                    min="0"
                                    step="0.01"
                                    class="w-full border-gray-300 rounded-md text-sm"
                                    value="{{ filter_var(request('max_price'), FILTER_VALIDATE_FLOAT) !== false ? request('max_price') : '' }}"
                                >
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Products Section -->
        <div class="flex-1">
            <div class="flex justify-between items-center mb-6">
                <p class="text-gray-600">
                    Showing {{ $products->firstItem() ?? 0 }} - {{ $products->lastItem() ?? 0 }} 
                    of {{ $products->total() ?? 0 }} products
                </p>
                
                @php
                    $validSortOptions = [
                        'price_high' => 'Price: High to Low',
                        'price_low' => 'Price: Low to High',
                        'newest' => 'Newest',
                        'popular' => 'Popular'
                    ];
                    $currentSort = array_key_exists(request('sort'), $validSortOptions) ? request('sort') : '';
                @endphp
                
                <select 
                    class="border border-gray-300 rounded px-4 py-2 text-sm focus:ring-blue-500 focus:border-blue-500" 
                    name="sort" 
                    form="filterForm"
                    onchange="document.getElementById('filterForm').submit()"
                >
                    <option value="">Sort by</option>
                    @foreach($validSortOptions as $value => $label)
                        <option value="{{ $value }}" {{ $currentSort === $value ? 'selected' : '' }}>
                            {{ $label }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse ($products as $product)
                <div class="bg-white rounded-lg shadow-sm overflow-hidden hover:shadow-md transition-shadow">
                    <div class="relative pt-[100%]">
                        @php
                            $productImages = is_array($product->images) ? $product->images : [];
                        @endphp
                        @if(count($productImages) > 0)
                            <img 
                                src="{{ Storage::url($productImages[0]) }}" 
                                alt="{{ htmlspecialchars($product->name) }}"
                                class="absolute inset-0 w-full h-full object-cover"
                            >
                        @else
                            <div class="absolute inset-0 w-full h-full flex items-center justify-center bg-gray-100">
                                <span class="text-gray-400">No image</span>
                            </div>
                        @endif
                    </div>
                    
                    <div class="p-4">
                        <div class="flex flex-col mb-4">
                            <h3 class="text-lg font-medium text-gray-900">{{ htmlspecialchars($product->name) }}</h3>
                            <span class="text-lg font-medium text-gray-900 mt-1">
                                ${{ number_format((float)$product->price, 2) }}
                            </span>
                            <div class="text-gray-600 text-sm mt-2">
                                {{ strip_tags($product->description) }}
                            </div>
                        </div>
                        
                        <div class="flex items-center justify-between">
                            <button 
                                onclick="addToCart({{ (int)$product->id }}, this)"
                                class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 transition-colors"
                            >
                                Add to cart
                            </button>
                            <button 
                                onclick="toggleWishlist({{ (int)$product->id }})"
                                class="text-gray-400 hover:text-red-500 transition-colors"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-span-3 text-center py-12">
                    <div class="text-gray-500 text-lg">No products found</div>
                    <button 
                        onclick="clearFilters()"
                        class="mt-4 text-blue-600 hover:text-blue-700 transition-colors"
                    >
                        Clear all filters
                    </button>
                </div>
                @endforelse
            </div>

            @if ($products->hasPages())
                <div class="mt-8">
                    {{ $products->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function clearFilters() {
        // Reset form and submit
        document.getElementById('filterForm').reset();
        document.getElementById('filterForm').submit();
    }

    function toggleWishlist(productId) {
        // Add your wishlist logic here
        console.log('Toggling wishlist for product:', productId);
    }

    // Add debounce function for price inputs
    function debounce(func, wait) {
        let timeout;
        return function executedFunction(...args) {
            const later = () => {
                clearTimeout(timeout);
                func(...args);
            };
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
        };
    }

    // Auto-submit form when checkboxes are clicked
    document.querySelectorAll('input[type="checkbox"]').forEach(input => {
        input.addEventListener('change', () => {
            document.getElementById('filterForm').submit();
        });
    });

    // Debounced submit for price inputs
    document.querySelectorAll('input[type="number"]').forEach(input => {
        input.addEventListener('input', debounce(() => {
            document.getElementById('filterForm').submit();
        }, 500));
    });
</script>
@endpush

@push('scripts')
<script>
function addToCart(productId, button) {
    // Validate productId
    if (!Number.isInteger(productId) || productId <= 0) {
        console.error('Invalid product ID');
        return;
    }

    // Disable button while processing
    button.disabled = true;
    button.textContent = 'Adding...';

    // Create form data
    const formData = new FormData();
    formData.append('_token', '{{ csrf_token() }}');
    formData.append('product_id', productId);
    formData.append('quantity', 1);

    // Send request to add to cart
    fetch('/cart/add', {
        method: 'POST',
        body: formData,
        headers: {
            'Accept': 'application/json',
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(data => {
        if (data.success) {
            window.location.href = '{{ route("cart.index") }}';
        } else {
            throw new Error(data.message || 'Failed to add item to cart');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An error occurred. Please try again.');
        // Reset button
        button.disabled = false;
        button.textContent = 'Add to cart';
    });
}
</script>
@endpush