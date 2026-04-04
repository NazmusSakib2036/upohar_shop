<?php

use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\ProductController;
use App\Models\Slider;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $slides = Slider::active()->ordered()->get();
    $categories = Category::active()->ordered()->get();
    $featuredProducts = Product::with('category')->active()->featured()->ordered()->limit(8)->get();
    $latestProducts = Product::with('category')->active()->ordered()->limit(8)->get();
    return view('home', compact('slides', 'categories', 'featuredProducts', 'latestProducts'));
});

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

// Product Routes
Route::get('/product/{slug}', [ProductController::class, 'show'])->name('product.show');
Route::get('/product/{id}/quick-view', [ProductController::class, 'quickView'])->name('product.quickview');
Route::get('/category/{slug}', [ProductController::class, 'byCategory'])->name('category.show');

Route::get('/gifts', function () {
    $categories = Category::active()->ordered()->get();
    $products = Product::with('category')->active()->ordered()->paginate(12);
    return view('products.index', compact('categories', 'products'));
})->name('gifts');

Route::get('/contact', function () {
    return view('home');
});

// ==================== ADMIN ROUTES ====================
Route::prefix('admin')->name('admin.')->group(function () {
    // Admin Auth
    Route::get('/login', [AdminAuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AdminAuthController::class, 'login'])->name('login.submit');
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');

    // Protected admin routes
    Route::middleware('admin')->group(function () {
        Route::get('/', [AdminAuthController::class, 'dashboard'])->name('dashboard');

        // Slider CRUD
        Route::resource('sliders', SliderController::class)->except(['show']);
        Route::post('sliders/{slider}/toggle', [SliderController::class, 'toggleActive'])->name('sliders.toggle');
        Route::post('sliders/reorder', [SliderController::class, 'reorder'])->name('sliders.reorder');

        // Category CRUD
        Route::resource('categories', CategoryController::class)->except(['show']);

        // Product CRUD
        Route::resource('products', AdminProductController::class)->except(['show']);
        Route::post('products/{product}/toggle', [AdminProductController::class, 'toggleActive'])->name('products.toggle');
    });
});
