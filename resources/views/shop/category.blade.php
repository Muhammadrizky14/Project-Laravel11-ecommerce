@extends('layouts.app')

@section('content')
<div class="bg-gray-50 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-8">
            <a href="{{ route('categories.index') }}" class="text-gray-600 hover:text-gray-900">
                ← Back to Categories
            </a>
        </div>

        <div class="flex items-center justify-between mb-8">
            <h1 class="text-3xl font-bold text-gray-900">{{ $category->name }}</h1>
            <span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full">
                {{ $category->categoryProducts->count() }} Products
            </span>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @forelse($category->categoryProducts as $product)
                <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                    <div class="aspect-w-3 aspect-h-2">
                        @if($product->image)
                            <img 
                                src="{{ Storage::url($product->image) }}"
                                alt="{{ $product->name }}"
                                class="w-full h-full object-cover"
                            >
                        @else
                            <div class="w-full h-full bg-gray-100 flex items-center justify-center">
                                <span class="text-gray-400">No image</span>
                            </div>
                        @endif
                    </div>
                    
                    <div class="p-4">
                        <h2 class="text-lg font-semibold text-gray-900 mb-2">{{ $product->name }}</h2>
                        @if($product->description)
                            <p class="text-gray-600 text-sm">{{ Str::limit($product->description, 100) }}</p>
                        @endif

                        <!-- Menampilkan Harga -->
                        @if($product->price)
                            <p class="text-gray-800 font-semibold mt-2">Rp {{ number_format($product->price, 2, ',', '.') }}</p>
                        @endif

                        <!-- Tombol Add to Cart -->
                        <form action="{{ route('cart.add', $product->id) }}" method="POST" class="mt-4">
                            @csrf
                            <button 
                                type="submit"
                                class="w-full bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring focus:ring-blue-300">
                                Add to Cart
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-12">
                    <p class="text-gray-500">No products found in this category</p>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
