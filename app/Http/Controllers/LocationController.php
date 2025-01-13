<?php

namespace App\Http\Controllers;

use App\Models\Province;
use App\Models\City;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function provinces()
    {
        $provinces = Province::all();
        return response()->json($provinces);
    }

    public function cities($provinceId)
    {
        $cities = City::where('province_id', $provinceId)->get();
        return response()->json($cities);
    }
}

