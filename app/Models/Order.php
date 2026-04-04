<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'order_number', 'recipient_name', 'recipient_phone', 'recipient_district',
        'recipient_address', 'sender_name', 'sender_whatsapp', 'note',
        'items', 'subtotal', 'delivery_charge', 'discount', 'coupon_code',
        'total', 'payment_method', 'status',
    ];

    protected $casts = [
        'items' => 'array',
        'subtotal' => 'decimal:2',
        'delivery_charge' => 'decimal:2',
        'discount' => 'decimal:2',
        'total' => 'decimal:2',
    ];

    public static function generateOrderNumber()
    {
        return 'UPH-' . strtoupper(substr(uniqid(), -8));
    }
}
