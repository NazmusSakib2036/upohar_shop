<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $fillable = [
        'code', 'description', 'type', 'value', 'min_order',
        'max_discount', 'usage_limit', 'used_count', 'expires_at', 'is_active',
    ];

    protected $casts = [
        'value' => 'decimal:2',
        'min_order' => 'decimal:2',
        'max_discount' => 'decimal:2',
        'expires_at' => 'date',
        'is_active' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true)
            ->where(function ($q) {
                $q->whereNull('expires_at')->orWhere('expires_at', '>=', now()->toDateString());
            });
    }

    public function isValid(float $orderTotal): bool
    {
        if (!$this->is_active) return false;
        if ($this->expires_at && $this->expires_at->isPast()) return false;
        if ($this->usage_limit && $this->used_count >= $this->usage_limit) return false;
        if ($orderTotal < $this->min_order) return false;
        return true;
    }

    public function calculateDiscount(float $subtotal): float
    {
        if ($this->type === 'percent') {
            $discount = $subtotal * ($this->value / 100);
            if ($this->max_discount) {
                $discount = min($discount, $this->max_discount);
            }
        } else {
            $discount = $this->value;
        }
        return min($discount, $subtotal);
    }
}
