@extends('layouts.app')

@section('content')
<div class="min-h-screen flex flex-col">
    <!-- Main content -->
    <div class="flex-grow">
        <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
            <div class="px-4 py-6 sm:px-0">
                <h1 class="text-2xl font-semibold text-gray-900">Your Orders</h1>
                
                <div class="mt-6">
                    @if($orders->isEmpty())
                        <p class="text-gray-500">You haven't placed any orders yet.</p>
                    @else
                        <div class="bg-white shadow overflow-hidden sm:rounded-md">
                            <ul role="list" class="divide-y divide-gray-200">
                                @foreach($orders as $order)
                                    <li>
                                        <a href="{{ route('orders.show', $order) }}" class="block hover:bg-gray-50">
                                            <div class="px-4 py-4 sm:px-6">
                                                <div class="flex items-center justify-between">
                                                    <div class="flex flex-col">
                                                        <p class="text-sm font-medium text-blue-600 truncate">
                                                            Order #{{ $order->id }}
                                                        </p>
                                                        <p class="mt-1 text-sm text-gray-500">
                                                            Placed on {{ $order->created_at->format('M d, Y') }}
                                                        </p>
                                                    </div>
                                                    <div class="ml-2 flex-shrink-0 flex">
                                                        <p class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                            {{ $order->status === 'completed' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                                            {{ ucfirst($order->status) }}
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="mt-2 sm:flex sm:justify-between">
                                                    <div class="sm:flex">
                                                        <p class="flex items-center text-sm text-gray-500">
                                                            Total: ${{ number_format($order->total, 2) }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        
                        <div class="mt-4">
                            {{ $orders->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection