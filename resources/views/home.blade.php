@extends('layouts.app')

@section('content')
<div class="bg-gray-50">
    <div class="max-w-7xl mx-auto px-4">
        <!-- Hero Section -->
        <div class="relative grid md:grid-cols-2 gap-4 items-center py-12">
            <div class="space-y-6">
                <p class="text-gray-600">Starting from: <span class="font-medium">499.999</span></p>
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-gray-900 leading-tight">
                    Exclusive collection<br class="hidden md:block"> for everyone
                </h1>
                <a href="{{ route('shop.index') }}" class="inline-flex items-center bg-gray-900 text-white px-6 py-3 rounded-full hover:bg-gray-800 transition-colors">
                    Shop Now
                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </a>
            </div>
            
            <div class="relative min-h-[500px] flex items-center justify-center">
                <img src="{{ asset('images/home.png') }}" 
                    alt="Fashion Collection" 
                    class="w-650 h-full absolute inset-0 object-cover object-center rounded-lg"
                >
            </div>
        </div>

        <!-- Flash Sales Section -->
        <div class="flash-sales py-12">
            <!-- Flash Sales Header -->
            <div class="flex flex-col md:flex-row justify-between items-center mb-8 gap-4">
                <div class="flex items-center gap-2">
                    <div class="bg-red-500 p-2 rounded">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                    </div>
                    <h2 class="text-xl font-bold">Today's Flash Sales</h2>
                </div>
                
                <!-- Timer -->
                <div class="flex gap-4">
                    <div id="timer" class="flex items-center gap-2">
                        <div class="countdown-item bg-gray-900 text-white px-3 py-2 rounded">
                            <span id="days" class="text-xl font-bold">00</span>
                            <span class="text-xs">Days</span>
                        </div>
                        <span class="text-xl font-bold">:</span>
                        <div class="countdown-item bg-gray-900 text-white px-3 py-2 rounded">
                            <span id="hours" class="text-xl font-bold">00</span>
                            <span class="text-xs">Hours</span>
                        </div>
                        <span class="text-xl font-bold">:</span>
                        <div class="countdown-item bg-gray-900 text-white px-3 py-2 rounded">
                            <span id="minutes" class="text-xl font-bold">00</span>
                            <span class="text-xs">Minutes</span>
                        </div>
                        <span class="text-xl font-bold">:</span>
                        <div class="countdown-item bg-gray-900 text-white px-3 py-2 rounded">
                            <span id="seconds" class="text-xl font-bold">00</span>
                            <span class="text-xs">Seconds</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Products Slider -->
            <div class="relative overflow-hidden">
                <div id="products-container" class="flex gap-6 transition-transform duration-500 w-full min-w-max">
                    @forelse($flashSales as $flashSale) 
                        <div class="flex-shrink-0 w-[280px]">
                            <div class="relative bg-white rounded-lg shadow-sm overflow-hidden group">
                                <!-- Discount Badge -->
                                @php
                                    $discount = round((($flashSale->product->price - $flashSale->flash_sale_price) / $flashSale->product->price) * 100);
                                @endphp
                                <div class="absolute top-4 left-4 bg-red-500 text-white px-2 py-1 rounded-md z-10">
                                    -{{ $discount }}%
                                </div>
                                
                                <!-- Product Image -->
                                <div class="relative pt-[100%] overflow-hidden">
                                    @if($flashSale->product->images && is_array($flashSale->product->images) && count($flashSale->product->images) > 0)
                                        <img 
                                            src="{{ Storage::url($flashSale->product->images[0]) }}" 
                                            alt="{{ $flashSale->product->name }}"
                                            class="absolute inset-0 w-full h-full object-cover transition-transform duration-300 group-hover:scale-105"
                                        >
                                    @else
                                        <div class="absolute inset-0 bg-gray-100 flex items-center justify-center">
                                            <span class="text-gray-400">No image</span>
                                        </div>
                                    @endif
                                </div>
                                
                                <!-- Product Info -->
                                <div class="p-4">
                                    <h3 class="text-lg font-medium text-gray-900 mb-2 line-clamp-1">
                                        {{ $flashSale->product->name }}
                                    </h3>
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center gap-2">
                                            <span class="text-red-500 font-bold">
                                                ${{ number_format($flashSale->flash_sale_price, 2) }}
                                            </span>
                                            <span class="text-gray-400 line-through text-sm">
                                                ${{ number_format($flashSale->product->price, 2) }}
                                            </span>
                                        </div>
                                        <div class="flex items-center">
                                            <div class="flex text-yellow-400">
                                                @for($i = 1; $i <= 5; $i++)
                                                    @if($i <= ($flashSale->product->rating ?? 5))
                                                        <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20">
                                                            <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                                                        </svg>
                                                    @else
                                                        <svg class="w-4 h-4 fill-current text-gray-300" viewBox="0 0 20 20">
                                                            <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                                                        </svg>
                                                    @endif
                                                @endfor
                                            </div>
                                            <span class="text-gray-400 text-sm ml-2">
                                                ({{ $flashSale->product->reviews_count ?? 0 }})
                                            </span>
                                        </div>
                                    </div>
                                    <!-- Add to Cart Button -->
                                    <button 
                                        onclick="addToCart({{ $flashSale->product->id }}, this)"
                                        class="w-full mt-4 bg-red-500 text-white py-2 rounded hover:bg-red-600 transition-colors"
                                    >
                                        Add to Cart
                                    </button>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="w-full text-center py-8">
                            <p class="text-gray-500">No flash sale items available at the moment.</p>
                        </div>
                    @endforelse
                </div>
            

<!-- Categories Section -->
<div class="py-12">
    <div class="max-w-7xl mx-auto px-4">
        <div class="text-center mb-8">
            <h2 class="text-2xl font-bold text-gray-900">Shop by Categories</h2>
            <p class="mt-2 text-gray-600">Discover our collection across various categories</p>
        </div>
        
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4">
            @foreach($categories as $category)
                <a href="{{ route('shop.category', $category->slug) }}" class="group">
                    <div class="bg-white border border-gray-200 rounded-lg overflow-hidden">
                        <div class="aspect-w-16 aspect-h-9 bg-gray-100">
                            @if($category->image)
                                <img 
                                    src="{{ Storage::url($category->image) }}"
                                    alt="{{ $category->name }}"
                                    class="w-full h-full object-cover"
                                >
                            @else
                                <div class="w-full h-full flex items-center justify-center">
                                    <span class="text-gray-400">No image</span>
                                </div>
                            @endif
                        </div>
                        <div class="p-3">
                            <div class="flex items-center justify-between">
                                <h3 class="text-sm font-medium text-gray-900">{{ $category->name }}</h3>
                                <span class="text-xs text-gray-500">{{ $category->categoryProducts->count() }} Products</span>
                            </div>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>

        <div class="text-center mt-8">
            <a href="{{ route('categories.index') }}" class="inline-flex items-center justify-center px-4 py-2 bg-gray-900 text-sm text-white font-medium rounded-lg hover:bg-gray-800">
                View All Categories
            </a>
        </div>
    </div>
</div>





            <!-- Collections Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <a href="{{ route('collections.show', 'november-outfits') }}" class="relative group overflow-hidden rounded-lg">
                    <div class="aspect-[4/3]">
                        <img 
                            src="{{ asset('images/collections/collections_1.png') }}" 
                            alt="November Outfits Collection"
                            class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105"
                        >
                    </div>
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent flex flex-col justify-end p-6">
                        <h3 class="text-2xl font-bold text-white">November Outfits</h3>
                        <p class="text-white/80 flex items-center gap-2">
                            Collection
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </p>
                    </div>
                </a>
                
                <a href="{{ route('collections.show', 'cashmere-set') }}" class="relative group overflow-hidden rounded-lg">
                    <div class="aspect-[4/3]">
                        <img 
                            src="{{ asset('images/collections/collections_2.png') }}" 
                            alt="Cashmere Set Collection"
                            class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105"
                        >
                    </div>
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent flex flex-col justify-end p-6">
                        <h3 class="text-2xl font-bold text-white">Cashmere Set</h3>
                        <p class="text-white/80 flex items-center gap-2">
                            Collection
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </p>
                    </div>
                </a>
                
                <a href="{{ route('collections.show', 'the-new-nordic') }}" class="relative group overflow-hidden rounded-lg">
                    <div class="aspect-[4/3]">
                        <img 
                            src="{{ asset('images/collections/collections_3.png') }}" 
                            alt="The New Nordic Collection"
                            class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105"
                        >
                    </div>
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent flex flex-col justify-end p-6">
                        <h3 class="text-2xl font-bold text-white">The New Nordic</h3>
                        <p class="text-white/80 flex items-center gap-2">
                            Collection
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </p>
                    </div>
                </a>
                
                <a href="{{ route('collections.show', 'the-leather') }}" class="relative group overflow-hidden rounded-lg">
                    <div class="aspect-[4/3]">
                        <img 
                            src="{{ asset('images/collections/collections_4.png') }}" 
                            alt="The Leather Collection"
                            class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105"
                        >
                    </div>
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent flex flex-col justify-end p-6">
                        <h3 class="text-2xl font-bold text-white">The Leather</h3>
                        <p class="text-white/80 flex items-center gap-2">
                            Collection
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </p>
                    </div>
                </a>
            </div>
        </div>

        <!-- Latest Arrivals Section -->
        <div class="py-12">
            <div class="text-center max-w-2xl mx-auto mb-24"> <!-- Increased bottom margin -->
                <h2 class="text-3xl font-bold mb-4">Our latest arrivals</h2>
                <p class="text-gray-600 mb-8">Caring for yourself, one piece at a time. Our clothing is designed to bring comfort and ease into your life, no matter the occasion.</p>
                <div class="relative z-10"> <!-- Added relative positioning and z-index -->
                    <a href="{{ route('shop.index') }}" class="inline-block border border-gray-900 text-gray-900 px-6 py-2 rounded-md hover:bg-gray-800 hover:text-white transition-colors bg-white"> <!-- Added white background -->
                        Shop All
                    </a>
                </div>
            </div>
    
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-7xl mx-auto -mt-12">
        <!-- First Product -->
        <div class="relative group">
            <div class="aspect-[3/4] bg-gray-200">
                <img 
                    src="{{ asset('images/latest/product1.jpg') }}" 
                    alt="Latest Product 1"
                    class="w-full h-full object-cover"
                >
            </div>
        </div>
        
        <!-- Second Product (Elevated) -->
        <div class="relative group md:mt-12">
            <div class="aspect-[3/4] bg-gray-200">
                <img 
                    src="{{ asset('images/latest/product2.jpg') }}" 
                    alt="Latest Product 2"
                    class="w-full h-full object-cover"
                >
            </div>
        </div>
        
        <!-- Third Product -->
        <div class="relative group">
            <div class="aspect-[3/4] bg-gray-200">
                <img 
                    src="{{ asset('images/latest/product3.jpg') }}" 
                    alt="Latest Product 3"
                    class="w-full h-full object-cover"
                >
            </div>
        </div>
    </div>
</div>




@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Slider functionality
    const container = document.getElementById('products-container');
    const prevButton = document.getElementById('prev');
    const nextButton = document.getElementById('next');
    
    if (container && prevButton && nextButton) {
        let position = 0;
        const itemWidth = 296; // 280px width + 16px gap
        const containerWidth = container.offsetWidth;
        const itemsPerPage = Math.floor(containerWidth / itemWidth);
        const maxPosition = Math.max(0, (container.children.length - itemsPerPage) * itemWidth);

        function updateSliderPosition() {
            container.style.transform = `translateX(-${position}px)`;
            if (prevButton) prevButton.disabled = position === 0;
            if (nextButton) nextButton.disabled = position >= maxPosition;
        }

        prevButton.addEventListener('click', () => {
            position = Math.max(position - itemWidth, 0);
            updateSliderPosition();
        });

        nextButton.addEventListener('click', () => {
            position = Math.min(position + itemWidth, maxPosition);
            updateSliderPosition();
        });

        // Initial update
        updateSliderPosition();

        // Update on window resize
        window.addEventListener('resize', () => {
            const newContainerWidth = container.offsetWidth;
            const newItemsPerPage = Math.floor(newContainerWidth / itemWidth);
            const newMaxPosition = Math.max(0, (container.children.length - newItemsPerPage) * itemWidth);
            position = Math.min(position, newMaxPosition);
            updateSliderPosition();
        });
    }

    // Countdown Timer
    function updateTimer() {
        @if($flashSales->isNotEmpty())
            const now = new Date().getTime();
            const endTime = new Date("{{ $flashSales->first()->end_time }}").getTime();
            const timeLeft = endTime - now;

            if (timeLeft > 0) {
                const days = Math.floor(timeLeft / (1000 * 60 * 60 * 24));
                const hours = Math.floor((timeLeft % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                const minutes = Math.floor((timeLeft % (1000 * 60 * 60)) / (1000 * 60));
                const seconds = Math.floor((timeLeft % (1000 * 60)) / 1000);

                document.getElementById('days').textContent = String(days).padStart(2, '0');
                document.getElementById('hours').textContent = String(hours).padStart(2, '0');
                document.getElementById('minutes').textContent = String(minutes).padStart(2, '0');
                document.getElementById('seconds').textContent = String(seconds).padStart(2, '0');
            } else {
                // Refresh the page when the timer ends
                window.location.reload();
            }
        @endif
    }

    // Update timer every second
    setInterval(updateTimer, 1000);
    updateTimer();
});

// Add to Cart Function
function addToCart(productId, button) {
    // Disable button and show loading state
    button.disabled = true;
    const originalText = button.textContent;
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
            'Accept': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Redirect to cart page on success
            window.location.href = '{{ route("cart.index") }}';
        } else {
            alert(data.message || 'Failed to add item to cart');
            // Reset button
            button.disabled = false;
            button.textContent = originalText;
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An error occurred. Please try again.');
        // Reset button
        button.disabled = false;
        button.textContent = originalText;
    });
}
</script>
@endpush
@endsection