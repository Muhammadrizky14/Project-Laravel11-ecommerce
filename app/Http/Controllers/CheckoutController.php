<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Services\Cart;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index()
    {
        $cartItems = Cart::getContent();
        $total = Cart::getTotal();
        
        return view('checkout.index', compact('cartItems', 'total'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'street_address' => 'required|string|max:255',
            'town_city' => 'required|string|max:255',
            'phone_number' => 'required|string|max:255',
            'email_address' => 'required|email|max:255',
            'payment_method' => 'required|in:bank,cash_on_delivery',
        ]);

        // Create the order
        $order = Order::create([
            'user_id' => auth()->id(),
            'total' => Cart::getTotal(),
            'status' => 'pending',
            'payment_method' => $validated['payment_method'],
            'shipping_address' => json_encode([
                'first_name' => $validated['first_name'],
                'street_address' => $validated['street_address'],
                'town_city' => $validated['town_city'],
                'phone_number' => $validated['phone_number'],
                'email_address' => $validated['email_address'],
            ]),
            'billing_address' => json_encode([
                'first_name' => $validated['first_name'],
                'street_address' => $validated['street_address'],
                'town_city' => $validated['town_city'],
                'phone_number' => $validated['phone_number'],
                'email_address' => $validated['email_address'],
            ]),
        ]);

        // Save order items
        foreach (Cart::getContent() as $productId => $item) {
            $order->items()->create([
                'product_id' => $productId,
                'quantity' => $item['quantity'],
                'price' => $item['price'],
            ]);
        }

        // Clear the cart
        Cart::clear();

        return redirect()->route('checkout.success');
    }

    public function success()
    {
        return view('checkout.success');
    }
}
