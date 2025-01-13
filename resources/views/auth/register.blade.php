@extends('layouts.app')

@section('content')
<div class="min-h-screen flex">
    <!-- Left side - Image -->
    <div class="hidden lg:block lg:w-1/2 bg-gray-100">
        <img src="/images/login-image.jpg" alt="Fashion Model" class="w-full h-full object-cover">
    </div>

    <!-- Right side - Sign Up Form -->
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
                    <h2 class="text-3xl font-bold text-gray-900">Create Account 👋</h2>
                    <p class="mt-2 text-sm text-gray-600">Please fill in your details</p>
                </div>

                <form action="{{ route('register.store') }}" method="POST" class="space-y-6">
                    @csrf
                    <div class="space-y-5">
                        <div>
                            <label for="name" class="text-sm font-medium text-gray-900 block mb-1">Full Name</label>
                            <input 
                                id="name" 
                                name="name" 
                                type="text" 
                                required 
                                class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-black focus:border-transparent"
                                placeholder="Full name"
                                value="{{ old('name') }}"
                            >
                            @error('name')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="email" class="text-sm font-medium text-gray-900 block mb-1">Email Address</label>
                            <input 
                                id="email" 
                                name="email" 
                                type="email" 
                                required 
                                class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-black focus:border-transparent"
                                placeholder="name@gmail.com"
                                value="{{ old('email') }}"
                            >
                            @error('email')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
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
                            @error('password')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="password_confirmation" class="text-sm font-medium text-gray-900 block mb-1">Confirm Password</label>
                            <input 
                                id="password_confirmation" 
                                name="password_confirmation" 
                                type="password" 
                                required 
                                class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-black focus:border-transparent"
                                placeholder="••••••••••••••"
                            >
                        </div>
                    </div>

                    <div class="flex items-center">
                        <input 
                            id="terms" 
                            name="terms" 
                            type="checkbox" 
                            required
                            class="h-4 w-4 text-black focus:ring-black border-gray-300 rounded"
                        >
                        <label for="terms" class="ml-2 block text-sm text-gray-900">
                            I agree to the <a href="#" class="text-black hover:underline">Terms and Conditions</a>
                        </label>
                    </div>

                    <button 
                        type="submit" 
                        class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg text-white bg-black hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-black"
                    >
                        Create Account
                    </button>

                    <p class="text-center text-sm text-gray-600">
                        Already have an account? 
                        <a href="{{ route('login') }}" class="font-medium text-black hover:underline">
                            Login
                        </a>
                    </p>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection