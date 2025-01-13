<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    use HasFactory;

    protected $fillable = [
        'province_id',
        'city_id',
        'province',
        'city',
        'courier',
        'base_cost',
    ];

    protected $casts = [
        'base_cost' => 'decimal:2',
    ];
}

