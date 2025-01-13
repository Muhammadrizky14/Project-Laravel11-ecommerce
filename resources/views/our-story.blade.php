@extends('layouts.app')

@section('content')
<div class="bg-white">
    <!-- Hero Section -->
    <div class="relative bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24">
            <div class="text-center max-w-3xl mx-auto">
                <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6">Our Story</h1>
                <p class="text-lg text-gray-600 mb-8">Founded in 2020, Krist began with a simple mission: to create timeless fashion that combines elegance with sustainability.</p>
            </div>
        </div>
    </div>

    <!-- Mission Section -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="grid md:grid-cols-2 gap-12 items-center">
            <div class="relative aspect-[4/3]">
                <img 
                    src="{{ asset('images/about/about-1.jpg') }}" 
                    alt="Our Mission"
                    class="w-full h-full object-cover rounded-lg"
                >
            </div>
            <div>
                <h2 class="text-3xl font-bold text-gray-900 mb-6">Our Mission</h2>
                <p class="text-gray-600 mb-6">We believe that fashion should be both beautiful and responsible. Every piece in our collection is thoughtfully designed and crafted with sustainable materials, ensuring that style never comes at the expense of our planet.</p>
                <div class="grid grid-cols-2 gap-6">
                    <div>
                        <h3 class="font-bold text-xl mb-2">200+</h3>
                        <p class="text-gray-600">Sustainable Products</p>
                    </div>
                    <div>
                        <h3 class="font-bold text-xl mb-2">50k+</h3>
                        <p class="text-gray-600">Happy Customers</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Values Section -->
    <div class="bg-gray-50 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-center mb-12">Our Values</h2>
            <div class="grid md:grid-cols-3 gap-8">
                <div class="bg-white p-8 rounded-lg">
                    <div class="w-12 h-12 bg-gray-900 text-white rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-4">Quality First</h3>
                    <p class="text-gray-600">We never compromise on quality, ensuring each piece meets our high standards.</p>
                </div>
                <div class="bg-white p-8 rounded-lg">
                    <div class="w-12 h-12 bg-gray-900 text-white rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-4">Sustainability</h3>
                    <p class="text-gray-600">Environmental responsibility is at the core of everything we do.</p>
                </div>
                <div class="bg-white p-8 rounded-lg">
                    <div class="w-12 h-12 bg-gray-900 text-white rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-4">Customer First</h3>
                    <p class="text-gray-600">Your satisfaction is our top priority, always.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- CTA Section -->
    <div class="bg-gray-900 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 text-center">
            <h2 class="text-3xl font-bold mb-4">Join Our Journey</h2>
            <p class="text-gray-300 mb-8 max-w-2xl mx-auto">Be part of our story and discover the latest collections that combine style, comfort, and sustainability.</p>
            <a href="{{ route('shop.index') }}" class="inline-block bg-white text-gray-900 px-8 py-3 rounded-md hover:bg-gray-100 transition-colors">
                Shop Now
            </a>
        </div>
    </div>
</div>
@endsection

    