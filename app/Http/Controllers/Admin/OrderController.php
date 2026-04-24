<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::latest();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        if ($request->filled('search')) {
            $s = $request->search;
            $query->where(function ($q) use ($s) {
                $q->where('order_number', 'like', "%$s%")
                  ->orWhere('recipient_name', 'like', "%$s%")
                  ->orWhere('recipient_phone', 'like', "%$s%")
                  ->orWhere('sender_name', 'like', "%$s%");
            });
        }
        if ($request->filled('from')) {
            $query->whereDate('created_at', '>=', $request->from);
        }
        if ($request->filled('to')) {
            $query->whereDate('created_at', '<=', $request->to);
        }

        $orders = $query->paginate(20)->withQueryString();

        return view('admin.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        return view('admin.orders.show', compact('order'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        $request->validate(['status' => 'required|in:pending,confirmed,processing,shipped,delivered,cancelled']);
        $order->update(['status' => $request->status]);

        return back()->with('success', 'অর্ডার স্ট্যাটাস আপডেট হয়েছে।');
    }

    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->route('admin.orders.index')->with('success', 'অর্ডার মুছে ফেলা হয়েছে।');
    }
}
