<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = auth()->check()
            ? Order::where('user_id', auth()->id())->latest()->paginate(10)
            : Order::latest()->paginate(10);

        return view('orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        return view('orders.show', compact('order'));
    }

    public function create()
    {
        return view('orders.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'customer_name' => 'required',
            'product_name' => 'required',
            'quantity' => 'required|numeric',
        ]);

        Order::create(array_merge($validatedData, ['user_id' => auth()->id()]));

        return redirect()->route('orders.index')->with('success', 'Order created successfully!');
    }

    public function edit(Order $order)
    {
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        return view('orders.edit', compact('order'));
    }

    public function update(Request $request, Order $order)
    {
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        $validatedData = $request->validate([
            'customer_name' => 'required',
            'product_name' => 'required',
            'quantity' => 'required|numeric',
        ]);

        $order->update($validatedData);

        return redirect()->route('orders.index')->with('success', 'Order updated successfully!');
    }

    public function destroy(Order $order)
    {
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        $order->delete();

        return redirect()->route('orders.index')->with('success', 'Order deleted successfully!');
    }

    public function details(Order $order)
    {
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        return view('orders.details', compact('order'));
    }
}

