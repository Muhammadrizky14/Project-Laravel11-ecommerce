@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-4">Order Details</h1>
    
    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
        <div class="px-4 py-5 sm:px-6">
            <h3 class="text-lg leading-6 font-medium text-gray-900">
                Order #{{ $order->id }}
            </h3>
            <p class="mt-1 max-w-2xl text-sm text-gray-500">
                Placed on {{ $order->created_at->format('F j, Y') }}
            </p>
        </div>
        <div class="border-t border-gray-200">
            <dl>
                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">
                        Total Amount
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        ${{ number_format($order->total, 2) }}
                    </dd>
                </div>
                <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">
                        Status
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        {{ ucfirst($order->status) }}
                    </dd>
                </div>
                <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">
                        Has the order arrived?
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        @if($order->status === 'completed')
                            <span class="px-2 py-1 text-xs font-medium bg-green-100 text-green-800 rounded-full">Yes</span>
                        @else
                            <span class="px-2 py-1 text-xs font-medium bg-gray-100 text-gray-800 rounded-full">No</span>
                        @endif
                    </dd>
                </div>
            </dl>
        </div>
    </div>

    <h2 class="text-xl font-bold mt-8 mb-4">Order Items</h2>
    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
        <ul class="divide-y divide-gray-200">
            @foreach ($order->items as $item)
                <li class="px-4 py-4 sm:px-6">
                    <div class="flex items-center justify-between">
                        <div class="text-sm font-medium text-gray-900">
                            {{ $item->product->name }}
                        </div>
                        <div class="text-sm text-gray-500">
                            Quantity: {{ $item->quantity }}
                        </div>
                    </div>
                    <div class="mt-2 flex justify-between">
                        <div class="text-sm text-gray-500">
                            Price: ${{ number_format($item->price, 2) }}
                        </div>
                        <div class="text-sm font-medium text-gray-900">
                            Subtotal: ${{ number_format($item->price * $item->quantity, 2) }}
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>

    @if($order->status === 'accepted')
        <div class="mt-8">
            <form action="{{ route('orders.confirm-delivery', $order) }}" method="POST">
                @csrf
                @method('PATCH')
                <button type="submit" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded">
                    Confirm Delivery
                </button>
            </form>
        </div>
    @endif

    @if($order->status === 'completed')
        <div class="mt-8 p-4 bg-green-50 border border-green-200 rounded-lg">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-lg font-medium text-green-800">Order Delivered Successfully</h3>
                    <p class="text-sm text-green-600">Thank you for shopping with us!</p>
                </div>
                <svg class="w-8 h-8 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
            </div>
        </div>
    @endif

    <div class="mt-8">
        <a href="{{ route('orders.index') }}" class="text-blue-600 hover:text-blue-800">
            &larr; Back to Orders
        </a>
    </div>
    
</div>
@endsection

