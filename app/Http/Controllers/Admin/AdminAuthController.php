<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use App\Models\Product;
use App\Models\Category;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminAuthController extends Controller
{
    public function showLogin()
    {
        if (Auth::check() && Auth::user()->is_admin) {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($request->only('email', 'password'), $request->boolean('remember'))) {
            if (!Auth::user()->is_admin) {
                Auth::logout();
                return back()->with('error', 'আপনার অ্যাডমিন অ্যাক্সেস নেই।');
            }
            $request->session()->regenerate();
            return redirect()->route('admin.dashboard');
        }

        return back()->with('error', 'ইমেইল বা পাসওয়ার্ড ভুল হয়েছে।');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.login');
    }

    public function dashboard(Request $request)
    {
        $sliderCount   = Slider::count();
        $activeSliders = Slider::active()->count();
        $userCount     = User::count();
        $productCount  = Product::count();
        $categoryCount = Category::count();

        // Order stats
        $totalOrders    = Order::count();
        $totalRevenue   = Order::where('status', '!=', 'cancelled')->sum('total');
        $pendingOrders  = Order::where('status', 'pending')->count();
        $cancelledOrders = Order::where('status', 'cancelled')->count();
        $deliveredOrders = Order::where('status', 'delivered')->count();

        // Filter: this month or custom range
        $filterFrom = $request->filled('from') ? $request->from : now()->startOfMonth()->toDateString();
        $filterTo   = $request->filled('to')   ? $request->to   : now()->toDateString();

        $periodOrders  = Order::whereDate('created_at', '>=', $filterFrom)
                               ->whereDate('created_at', '<=', $filterTo)
                               ->count();
        $periodRevenue = Order::whereDate('created_at', '>=', $filterFrom)
                               ->whereDate('created_at', '<=', $filterTo)
                               ->where('status', '!=', 'cancelled')
                               ->sum('total');

        $recentOrders = Order::latest()->limit(10)->get();

        return view('admin.dashboard', compact(
            'sliderCount', 'activeSliders', 'userCount', 'productCount', 'categoryCount',
            'totalOrders', 'totalRevenue', 'pendingOrders', 'cancelledOrders', 'deliveredOrders',
            'periodOrders', 'periodRevenue', 'filterFrom', 'filterTo', 'recentOrders'
        ));
    }
}
