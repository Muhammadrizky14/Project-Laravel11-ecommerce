<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    // Tambah produk ke keranjang
    public function add(Request $request)
    {
        try {
            $product = Product::findOrFail($request->product_id);

            // Ambil keranjang dari sesi
            $cart = session()->get('cart', []);

            // Tambah atau perbarui produk di keranjang
            if (isset($cart[$product->id])) {
                $cart[$product->id]['quantity']++;
            } else {
                $cart[$product->id] = [
                    'name' => $product->name,
                    'quantity' => 1,
                    'price' => $product->price,
                    'image' => $product->images[0] ?? null, // Pastikan $product->images valid
                ];
            }

            // Simpan keranjang kembali ke sesi
            session()->put('cart', $cart);

            return response()->json([
                'success' => true,
                'message' => 'Product added to cart successfully!',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to add product to cart.',
            ], 500);
        }
    }

    // Tampilkan halaman keranjang
    public function index()
    {
        $cartItems = session()->get('cart', []);
        $total = 0;

        foreach ($cartItems as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        // Ambil pesanan sebelumnya jika pengguna login
        $previousOrders = auth()->check()
            ? auth()->user()->orders()->with('items.product')->latest()->take(6)->get()
            : collect([]);

        return view('cart.index', compact('cartItems', 'total', 'previousOrders'));
    }

    // Perbarui jumlah item di keranjang
    public function update(Request $request, $id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity'] = $request->quantity;
            session()->put('cart', $cart);
            return redirect()->back()->with('success', 'Cart updated successfully');
        }

        return redirect()->back()->with('error', 'Item not found in cart');
    }

    // Hapus item dari keranjang
    public function remove($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
            return redirect()->back()->with('success', 'Item removed successfully');
        }

        return redirect()->back()->with('error', 'Item not found in cart');
    }
}
