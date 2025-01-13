@extends('layouts.app')

@section('content')
<div class="bg-gray-50 min-h-screen py-8">
    <div class="max-w-7xl mx-auto px-4">
        <form action="{{ route('checkout.store') }}" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-8">
            @csrf
            <!-- Billing Details -->
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Payment Details</h2>
                
                <div class="space-y-4">
                    <div>
                        <label for="first_name" class="block text-sm font-medium text-gray-700">First Name</label>
                        <input type="text" id="first_name" name="first_name" required
                               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        @error('first_name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="street_address" class="block text-sm font-medium text-gray-700">Address</label>
                        <input type="text" id="street_address" name="street_address" required
                               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        @error('street_address')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="town_city" class="block text-sm font-medium text-gray-700">City</label>
                        <input type="text" id="town_city" name="town_city" required
                               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        @error('town_city')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="phone_number" class="block text-sm font-medium text-gray-700">Phone Number</label>
                        <input type="tel" id="phone_number" name="phone_number" required
                               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        @error('phone_number')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="email_address" class="block text-sm font-medium text-gray-700">Email Address</label>
                        <input type="email" id="email_address" name="email_address" required
                               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        @error('email_address')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Order Summary -->
            <div class="bg-white rounded-lg shadow p-6 h-fit">
                <h2 class="text-lg font-medium text-gray-900 mb-4">Order Summary</h2>
                <div class="space-y-3">
                    @foreach($cartItems as $item)
                        <div class="flex justify-between text-gray-600">
                            <span>{{ $item['name'] }} (x{{ $item['quantity'] }})</span>
                            <span>${{ number_format($item['price'] * $item['quantity'], 2) }}</span>
                        </div>
                    @endforeach
                    <div class="border-t pt-3 flex justify-between font-medium text-gray-900">
                        <span>Total</span>
                        <span>${{ number_format($total, 2) }}</span>
                    </div>
                </div>

                <!-- Payment Methods -->
                <div class="mt-6 space-y-3">
                    <div class="flex items-center">
                        <input type="radio" id="bank" name="payment_method" value="bank" required
                               class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300">
                        <label for="bank" class="ml-2 block text-sm text-gray-700">Bank</label>
                    </div>
                    <div class="flex items-center">
                        <input type="radio" id="cash_on_delivery" name="payment_method" value="cash_on_delivery" required
                               class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300">
                        <label for="cash_on_delivery" class="ml-2 block text-sm text-gray-700">Cash on delivery</label>
                    </div>
                </div>

                <button type="submit" class="w-full mt-6 bg-blue-600 text-white py-3 px-4 rounded-lg hover:bg-blue-700 transition-colors">
                    Place Order
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

