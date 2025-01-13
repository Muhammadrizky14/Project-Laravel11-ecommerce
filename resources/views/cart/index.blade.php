@extends('layouts.app')

@section('content')
<div class="bg-gray-50 min-h-screen py-8">
    <div class="max-w-7xl mx-auto px-4">
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        @endif

        <div class="flex justify-between items-center mb-8">
            <h1 class="text-2xl font-bold text-gray-900">Shopping Cart</h1>
            <p class="text-gray-600">{{ count($cartItems) }} items</p>
        </div>

        @if(count($cartItems) > 0)
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Cart Items -->
                <div class="md:col-span-2 bg-white rounded-lg shadow p-6 space-y-4">
                    @foreach($cartItems as $id => $item)
                        <div class="flex items-center justify-between border-b pb-4">
                            <div class="flex items-center space-x-4">
                                <img src="{{ $item['image'] }}" alt="{{ $item['name'] }}" class="w-20 h-20 object-cover rounded">
                                <div>
                                    <h3 class="text-lg font-medium text-gray-900">{{ $item['name'] }}</h3>
                                    <p class="text-gray-600">Price: ${{ number_format($item['price'], 2) }}</p>
                                </div>
                            </div>
                            
                            <div class="flex items-center space-x-4">
                                <form action="{{ route('cart.update', $id) }}" method="POST" class="flex items-center">
                                    @csrf
                                    @method('PATCH')
                                    <input type="number" name="quantity" value="{{ $item['quantity'] }}" 
                                           min="1" class="w-16 px-2 py-1 border rounded text-center">
                                    <button type="submit" class="ml-2 text-blue-600 hover:text-blue-800">Update</button>
                                </form>
                                
                                <form action="{{ route('cart.remove', $id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Order Summary -->
                <div class="bg-white rounded-lg shadow p-6 h-fit">
                    <h2 class="text-lg font-medium text-gray-900 mb-4">Order Summary</h2>
                    <div class="space-y-3">
                        <div class="flex justify-between text-gray-600">
                            <span>Subtotal</span>
                            <span>${{ number_format($total, 2) }}</span>
                        </div>
                        <div class="flex justify-between text-gray-600">
                            <span>Shipping</span>
                            <span>Free</span>
                        </div>
                        <div class="border-t pt-3 flex justify-between font-medium text-gray-900">
                            <span>Total</span>
                            <span>${{ number_format($total, 2) }}</span>
                        </div>
                    </div>
                    
                    <div class="flex flex-col items-center gap-4">
                        <a href="{{ route('checkout.index') }}" class="w-full text-center bg-[#3B82F6] text-white py-3 px-4 rounded-md">
                            Proceed to Checkout
                        </a>
                        <a href="{{ route('shop.index') }}" class="text-[#3B82F6] hover:underline">
                            Continue Shopping
                        </a>
                    </div>
                </div>
            </div>
        @else
            <div class="text-center py-12">
                <svg class="w-16 h-16 mx-auto text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                </svg>
                <h2 class="mt-4 text-lg font-medium text-gray-900">Your cart is empty</h2>
                <p class="mt-2 text-gray-600">Looks like you haven't added any items to your cart yet.</p>
                <a href="{{ route('shop.index') }}" class="mt-6 inline-block bg-blue-600 text-white py-3 px-8 rounded-lg hover:bg-blue-700 transition-colors">
                    Start Shopping
                </a>
            </div>
        @endif

        <!-- Previous Orders Section -->
        @auth
            <div class="mt-12">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Your Previous Orders</h2>
                @if(count($previousOrders ?? []) > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($previousOrders as $order)
                            <div class="bg-white rounded-lg shadow p-6">
                                <div class="flex justify-between items-start mb-4">
                                    <div>
                                        <h3 class="text-lg font-medium text-gray-900">Order #{{ $order->id }}</h3>
                                        <p class="text-sm text-gray-600">{{ $order->created_at->format('M d, Y') }}</p>
                                    </div>
                                    <span class="px-3 py-1 text-sm rounded-full 
                                        @if($order->status === 'completed') bg-green-100 text-green-800
                                        @elseif($order->status === 'processing') bg-blue-100 text-blue-800
                                        @else bg-gray-100 text-gray-800 @endif">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </div>
                                
                                <div class="space-y-3">
                                    @foreach($order->items as $item)
                                        <div class="flex items-center space-x-3">
                                            <img src="{{ $item->product->image }}" alt="{{ $item->product->name }}" 
                                                 class="w-16 h-16 object-cover rounded">
                                            <div>
                                                <p class="font-medium text-gray-900">{{ $item->product->name }}</p>
                                                <p class="text-sm text-gray-600">Qty: {{ $item->quantity }}</p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                
                                <div class="mt-4 pt-4 border-t">
                                    <div class="flex justify-between items-center">
                                        <span class="text-gray-600">Total:</span>
                                        <span class="font-medium text-gray-900">${{ number_format($order->total, 2) }}</span>
                                    </div>
                                    <a href="{{ route('orders.show', $order->id) }}" 
                                       class="mt-4 block text-center text-blue-600 hover:text-blue-800 font-medium">
                                        View Order Details
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-8 bg-white rounded-lg shadow">
                        <p class="text-gray-600">You haven't placed any orders yet.</p>
                    </div>
                @endif
            </div>
        @endauth
    </div>
</div>
@endsection