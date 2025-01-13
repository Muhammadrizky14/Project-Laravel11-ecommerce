<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'price',
        'stock',
        'is_visible',
        'availability_date',
        'brand_id',
        'images',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'stock' => 'integer',
        'is_visible' => 'boolean',
        'availability_date' => 'date',
        'images' => 'array',
    ];

    public function up()
{
    Schema::create('categories', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('slug')->unique();
        $table->string('thumbnail')->nullable();
        $table->timestamps();
    });
}

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function flashSale()
    {
    return $this->hasOne(FlashSale::class);
    }
    
}

