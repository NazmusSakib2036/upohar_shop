<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index()
    {
        return view('checkout');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'recipient_name' => 'required|string|max:255',
            'recipient_phone' => 'required|string|max:20',
            'recipient_district' => 'required|string|max:100',
            'recipient_address' => 'required|string|max:1000',
            'sender_name' => 'required|string|max:255',
            'sender_whatsapp' => 'required|string|max:20',
            'note' => 'nullable|string|max:1000',
            'items' => 'required|string',
            'payment_method' => 'required|in:cod',
            'coupon_code' => 'nullable|string|max:50',
        ]);

        $items = json_decode($validated['items'], true);

        if (empty($items) || !is_array($items)) {
            return back()->withErrors(['items' => 'কার্ট খালি আছে।']);
        }

        $subtotal = collect($items)->sum(fn($item) => $item['price'] * $item['qty']);
        $deliveryCharge = $subtotal >= 2500 ? 0 : 150;
        $discount = 0;
        $total = $subtotal + $deliveryCharge - $discount;

        $order = Order::create([
            'order_number' => Order::generateOrderNumber(),
            'recipient_name' => $validated['recipient_name'],
            'recipient_phone' => $validated['recipient_phone'],
            'recipient_district' => $validated['recipient_district'],
            'recipient_address' => $validated['recipient_address'],
            'sender_name' => $validated['sender_name'],
            'sender_whatsapp' => $validated['sender_whatsapp'],
            'note' => $validated['note'],
            'items' => $items,
            'subtotal' => $subtotal,
            'delivery_charge' => $deliveryCharge,
            'discount' => $discount,
            'coupon_code' => $validated['coupon_code'],
            'total' => $total,
            'payment_method' => $validated['payment_method'],
            'status' => 'pending',
        ]);

        return redirect()->route('order.confirmation', $order->order_number);
    }

    public function confirmation($orderNumber)
    {
        $order = Order::where('order_number', $orderNumber)->firstOrFail();
        return view('order-confirmation', compact('order'));
    }
}
