<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'category_id', 'name', 'slug', 'description', 'short_description',
        'price', 'old_price', 'discount_percent', 'badge', 'badge_color',
        'image', 'gallery', 'is_combo', 'free_delivery', 'sku',
        'stock', 'is_active', 'is_featured', 'order',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'old_price' => 'decimal:2',
        'gallery' => 'array',
        'is_combo' => 'boolean',
        'free_delivery' => 'boolean',
        'is_active' => 'boolean',
        'is_featured' => 'boolean',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order')->orderBy('id', 'desc');
    }

    public function getImageUrlAttribute()
    {
        return $this->image ? asset('storage/' . $this->image) : null;
    }

    public function getGalleryUrlsAttribute()
    {
        if (!$this->gallery) return [];
        return array_map(fn($img) => asset('storage/' . $img), $this->gallery);
    }

    public function getStockLabelAttribute()
    {
        return $this->stock > 0 ? 'স্টক আছে' : 'স্টক নেই';
    }
}
