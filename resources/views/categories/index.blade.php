@extends('layouts.app')

@section('content')
<div class="bg-gray-50 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-8">Our Categories</h1>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @forelse($categories as $category)
                <div class="bg-white rounded-lg shadow-sm overflow-hidden group hover:shadow-md transition-shadow duration-300">
                    <a href="{{ route('categories.show', $category->slug) }}" class="block">
                        <div class="aspect-w-3 aspect-h-2 relative">
                            @if($category->image)
                                <img 
                                    src="{{ Storage::url($category->image) }}"
                                    alt="{{ $category->name }}"
                                    class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105"
                                    loading="lazy"
                                >
                            @else
                                <div class="w-full h-full bg-gray-100 flex items-center justify-center">
                                    <span class="text-gray-400">No image</span>
                                </div>
                            @endif
                            
                            <div class="absolute bottom-2 right-2 bg-white/90 px-2 py-1 rounded text-sm font-medium">
                                {{ $category->categoryProducts->count() }} 
                                {{ Str::plural('Product', $category->categoryProducts->count()) }}
                            </div>
                        </div>
                        
                        <div class="p-4">
                            <h2 class="text-lg font-semibold text-gray-900 mb-2 group-hover:text-blue-600 transition-colors">
                                {{ $category->name }}
                            </h2>
                            
                            @if($category->categoryProducts->isNotEmpty())
                                <div class="grid grid-cols-3 gap-2">
                                    @foreach($category->categoryProducts->take(3) as $product)
                                        <div class="aspect-square rounded overflow-hidden bg-gray-50">
                                            @if($product->image)
                                                <img 
                                                    src="{{ Storage::url($product->image) }}"
                                                    alt="{{ $product->name }}"
                                                    class="w-full h-full object-cover"
                                                    loading="lazy"
                                                >
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </a>
                </div>
            @empty
                <div class="col-span-full text-center py-12">
                    <p class="text-gray-500">No categories found</p>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection