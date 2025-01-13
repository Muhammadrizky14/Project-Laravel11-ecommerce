<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Ikizzt') }}</title>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="icon" type="image/jpg" href="{{ asset('images/logo/logo.png') }}">
</head>
<body class="bg-white">
    <nav class="bg-white py-4">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center">
                <!-- Logo -->
                <div class="flex-shrink-0">
                    <a href="/" class="text-2xl font-bold">
                        <span class="text-black">I</span>Kizzt
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="/" class="text-gray-900 hover:text-gray-600">Home</a>
                    <a href="shop" class="text-gray-900 hover:text-gray-600 flex items-center">Shop</a>
                    <a href="our-story" class="text-gray-900 hover:text-gray-600">Our Story</a>
                    <a href="blog" class="text-gray-900 hover:text-gray-600">Blog</a>
                    <a href="contact-us" class="text-gray-900 hover:text-gray-600">Contact Us</a>
                </div>

            
                    <!-- Right Side Icons -->
                    <div class="flex items-center space-x-6">
                        <button class="text-gray-900 hover:text-gray-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </button>
                        <button class="text-gray-900 hover:text-gray-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                            </svg>
                        </button>
                        <a href="{{ route('cart.index') }}" class="text-gray-900 hover:text-gray-600 relative inline-block">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                        </svg>
                        <span id="cartCounter" class="absolute -top-2 -right-2 bg-blue-600 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center transition-transform duration-200">
                            {{ count(session('cart', [])) }}
                        </span>
                    </a>
                        @auth
                            <form action=   "{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="inline-block bg-black text-white px-6 py-2 rounded-md hover:bg-gray-800 transition duration-150 ease-in-out">
                                    Logout
                                </button>
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="inline-block bg-black text-white px-6 py-2 rounded-md hover:bg-gray-800 transition duration-150 ease-in-out">
                                Login
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>

<!-- Footer -->
<footer class="bg-[#18191B] text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="flex flex-wrap justify-between items-center">
            <!-- Logo and Store Description -->
            <div class="w-full md:w-auto mb-6 md:mb-0">
                <div class="flex items-center gap-2">
                    <h1 class="text-2xl font-bold">Ikizzt.</h1>
                    <span class="text-sm text-gray-400">|</span>
                    <span class="text-sm text-gray-400">Gift & Clothes shop</span>
                </div>
            </div>

            <!-- Navigation Links -->
            <nav class="flex gap-8">
                <a href="/" class="hover:text-gray-300 transition-colors">Home</a>
                <a href="/shop" class="hover:text-gray-300 transition-colors">Shop</a>
                <a href="/our-story" class="hover:text-gray-300 transition-colors">Our Story</a>
                <a href="/blog" class="hover:text-gray-300 transition-colors">About</a>
                <a href="/contact-us" class="hover:text-gray-300 transition-colors">Contact Us</a>
            </nav>
        </div>

        <!-- Divider -->
        <hr class="border-gray-700 my-8">

        <!-- Copyright and Social Links -->
        <div class="flex flex-wrap justify-between items-center">
            <p class="text-sm text-gray-400">
                Copyright © 2025 Ikizzt. All rights reserved
            </p>
            <div class="flex gap-6">
                <a href="#" class="text-gray-400 hover:text-white transition-colors">Privacy Policy</a>
                <a href="#" class="text-gray-400 hover:text-white transition-colors">Terms of Use</a>
            </div>
            <div class="flex gap-6">
                <a href="#" class="text-white hover:text-gray-300 transition-colors">
                    <svg class="w-6 h-6" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                    </svg>
                </a>
                <a href="#" class="text-white hover:text-gray-300 transition-colors">
                    <svg class="w-6 h-6" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                    </svg>
                </a>
                <a href="#" class="text-white hover:text-gray-300 transition-colors">
                    <svg class="w-6 h-6" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
                    </svg>
                </a>
            </div>
        </div>
    </div>
</footer>
@stack('scripts')
</body>
</html>