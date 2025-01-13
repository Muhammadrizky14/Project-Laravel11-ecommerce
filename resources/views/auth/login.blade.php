@extends('layouts.app')

@section('content')
<div class="min-h-screen flex">
    <!-- Left side - Image -->
    <div class="hidden lg:block lg:w-1/2 bg-gray-100">
        <img src="/images/login-image.jpg" alt="Fashion Model" class="w-full h-full object-cover">
    </div>

    <!-- Right side - Login Form -->
    <div class="w-full lg:w-1/2 flex items-center justify-center px-8 md:px-16 py-12">
        <div class="w-full max-w-md space-y-8">
            <!-- Logo -->
            <div>
                <a href="/" class="text-2xl font-bold">
                    <span class="text-black">I</span>Kizzt
                </a>
            </div>

            <div class="space-y-6">
                <div>
                    <h2 class="text-3xl font-bold text-gray-900">Welcome 👋</h2>
                    <p class="mt-2 text-sm text-gray-600">Please login here</p>
                </div>

                <form action="{{ route('login.authenticate') }}" method="POST" class="space-y-6">
                    @csrf
                    <div class="space-y-5">
                        <div>
                            <label for="email" class="text-sm font-medium text-gray-900 block mb-1">Email Address</label>
                            <input 
                                id="email" 
                                name="email" 
                                type="email" 
                                required 
                                class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-black focus:border-transparent"
                                placeholder="name@gmail.com"
                            >
                        </div>

                        <div>
                            <label for="password" class="text-sm font-medium text-gray-900 block mb-1">Password</label>
                            <input 
                                id="password" 
                                name="password" 
                                type="password" 
                                required 
                                class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-black focus:border-transparent"
                                placeholder="••••••••••••••"
                            >
                        </div>
                    </div>

                    @if ($errors->any())
                        <div class="text-red-500 text-sm">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <input 
                                id="remember_me" 
                                name="remember" 
                                type="checkbox" 
                                class="h-4 w-4 text-black focus:ring-black border-gray-300 rounded"
                            >
                            <label for="remember_me" class="ml-2 block text-sm text-gray-900">
                                Remember Me
                            </label>
                        </div>

                        <a href="#" class="text-sm text-gray-900 hover:underline">
                            Forgot Password?
                        </a>
                    </div>

                    <button 
                        type="submit" 
                        class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg text-white bg-black hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-black"
                    >
                        Login
                    </button>

                    <p class="text-center text-sm text-gray-600">
                        Don't have account? 
                        <a href="{{ route('register') }}" class="font-medium text-black hover:underline">
                        Sign Up
                    </a>
                    </p>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection