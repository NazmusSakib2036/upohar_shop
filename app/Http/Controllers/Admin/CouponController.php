<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function index()
    {
        $coupons = Coupon::latest()->paginate(20);
        return view('admin.coupons.index', compact('coupons'));
    }

    public function create()
    {
        return view('admin.coupons.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'code'        => 'required|string|max:50|unique:coupons,code',
            'description' => 'nullable|string|max:255',
            'type'        => 'required|in:percent,fixed',
            'value'       => 'required|numeric|min:0',
            'min_order'   => 'nullable|numeric|min:0',
            'max_discount'=> 'nullable|numeric|min:0',
            'usage_limit' => 'nullable|integer|min:1',
            'expires_at'  => 'nullable|date|after_or_equal:today',
            'is_active'   => 'boolean',
        ]);

        $validated['code'] = strtoupper($validated['code']);
        $validated['is_active'] = $request->boolean('is_active');
        $validated['min_order'] = $validated['min_order'] ?? 0;

        Coupon::create($validated);
        return redirect()->route('admin.coupons.index')->with('success', 'কুপন তৈরি হয়েছে।');
    }

    public function edit(Coupon $coupon)
    {
        return view('admin.coupons.edit', compact('coupon'));
    }

    public function update(Request $request, Coupon $coupon)
    {
        $validated = $request->validate([
            'code'        => 'required|string|max:50|unique:coupons,code,' . $coupon->id,
            'description' => 'nullable|string|max:255',
            'type'        => 'required|in:percent,fixed',
            'value'       => 'required|numeric|min:0',
            'min_order'   => 'nullable|numeric|min:0',
            'max_discount'=> 'nullable|numeric|min:0',
            'usage_limit' => 'nullable|integer|min:1',
            'expires_at'  => 'nullable|date',
            'is_active'   => 'boolean',
        ]);

        $validated['code'] = strtoupper($validated['code']);
        $validated['is_active'] = $request->boolean('is_active');
        $validated['min_order'] = $validated['min_order'] ?? 0;

        $coupon->update($validated);
        return redirect()->route('admin.coupons.index')->with('success', 'কুপন আপডেট হয়েছে।');
    }

    public function destroy(Coupon $coupon)
    {
        $coupon->delete();
        return redirect()->route('admin.coupons.index')->with('success', 'কুপন মুছে ফেলা হয়েছে।');
    }

    public function toggle(Coupon $coupon)
    {
        $coupon->update(['is_active' => !$coupon->is_active]);
        return back()->with('success', 'কুপন স্ট্যাটাস পরিবর্তন হয়েছে।');
    }
}
