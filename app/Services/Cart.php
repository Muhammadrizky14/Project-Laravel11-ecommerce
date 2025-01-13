<?php

namespace App\Services;

use Illuminate\Support\Facades\Session;

class Cart
{
    public static function getContent()
    {
        return Session::get('cart', []);
    }

    public static function getTotal()
    {
        $cart = self::getContent();
        return array_reduce($cart, function ($total, $item) {
            return $total + ($item['price'] * $item['quantity']);
        }, 0);
    }

    public static function add($product, $quantity = 1)
    {
        $cart = self::getContent();
        $productId = $product->id;

        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] += $quantity;
        } else {
            $cart[$productId] = [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => $quantity,
            ];
        }

        Session::put('cart', $cart);
    }

    public static function remove($productId)
    {
        $cart = self::getContent();
        unset($cart[$productId]);
        Session::put('cart', $cart);
    }

    public static function clear()
    {
        Session::forget('cart');
    }
}
