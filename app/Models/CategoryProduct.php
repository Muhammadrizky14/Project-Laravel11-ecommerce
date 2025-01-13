<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Builder;

class CategoryProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'image',
        'category_id',
        'is_visible',
        'sort',
        'pricing'
    ];

    protected $casts = [
        'is_visible' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    // Scope for visible products
    public function scopeVisible(Builder $query): Builder
    {
        return $query->where('is_visible', true);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}