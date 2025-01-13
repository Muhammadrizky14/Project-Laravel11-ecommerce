<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\RajaOngkirService;
use Illuminate\Http\Request;

class ShippingController extends Controller
{
    protected $rajaOngkir;

    public function __construct(RajaOngkirService $rajaOngkir)
    {
        $this->rajaOngkir = $rajaOngkir;
    }

    public function cities($provinceId)
    {
        return response()->json(
            $this->rajaOngkir->getCities($provinceId)
        );
    }

    public function calculateCost(Request $request)
    {
        $request->validate([
            'destination' => 'required',
            'courier' => 'required|in:jne,pos,tiki'
        ]);

        // Assuming your store location is fixed
        $origin = config('services.rajaongkir.origin_city');
        
        // Calculate total weight from cart items
        $weight = \Cart::getContent()->sum(function($item) {
            return $item->quantity * ($item->attributes->weight ?? 1000); // Default to 1kg if weight not set
        });

        $costs = $this->rajaOngkir->calculateShipping(
            $origin,
            $request->destination,
            $weight,
            $request->courier
        );

        // Get the first available service
        $cost = $costs[0]['cost'][0]['value'] ?? 0;

        return response()->json([
            'cost' => $cost
        ]);
    }
}

