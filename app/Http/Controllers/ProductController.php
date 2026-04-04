<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function show($slug)
    {
        $product = Product::where('slug', $slug)->where('is_active', true)->firstOrFail();
        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->active()
            ->limit(4)
            ->get();

        return view('products.show', compact('product', 'relatedProducts'));
    }

    public function quickView($id)
    {
        $product = Product::with('category')->findOrFail($id);
        return response()->json([
            'id' => $product->id,
            'name' => $product->name,
            'slug' => $product->slug,
            'price' => $product->price,
            'old_price' => $product->old_price,
            'discount_percent' => $product->discount_percent,
            'description' => $product->description,
            'short_description' => $product->short_description,
            'image' => $product->image_url,
            'gallery' => $product->gallery_urls,
            'category' => $product->category ? $product->category->name : '',
            'stock' => $product->stock,
            'stock_label' => $product->stock_label,
            'is_combo' => $product->is_combo,
            'free_delivery' => $product->free_delivery,
            'badge' => $product->badge,
        ]);
    }

    public function byCategory($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        $products = Product::where('category_id', $category->id)->active()->ordered()->paginate(12);
        $categories = Category::active()->ordered()->get();

        return view('products.category', compact('category', 'products', 'categories'));
    }
}
