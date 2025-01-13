@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-12">
    <h1 class="text-3xl font-bold mb-8 capitalize">{{ str_replace('-', ' ', $collection) }}</h1>
    
    <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @forelse($products as $product)
            <!-- Product card here -->
        @empty
            <p class="col-span-full text-center text-gray-500">No products found in this collection.</p>
        @endforelse
    </div>
</div>
@endsection

