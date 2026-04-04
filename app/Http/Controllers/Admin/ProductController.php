<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->ordered()->get();
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::active()->ordered()->get();
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'short_description' => 'nullable|string|max:500',
            'price' => 'required|numeric|min:0',
            'old_price' => 'nullable|numeric|min:0',
            'discount_percent' => 'nullable|integer|min:0|max:100',
            'badge' => 'nullable|string|max:50',
            'badge_color' => 'nullable|string|max:20',
            'image' => 'nullable|image|max:2048',
            'gallery.*' => 'nullable|image|max:2048',
            'is_combo' => 'nullable|boolean',
            'free_delivery' => 'nullable|boolean',
            'sku' => 'nullable|string|max:50',
            'stock' => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean',
            'is_featured' => 'nullable|boolean',
            'order' => 'nullable|integer',
        ]);

        $validated['slug'] = Str::slug($validated['name']) ?: Str::random(8);
        $validated['is_combo'] = $request->has('is_combo');
        $validated['free_delivery'] = $request->has('free_delivery');
        $validated['is_active'] = $request->has('is_active');
        $validated['is_featured'] = $request->has('is_featured');

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('products', 'public');
        }

        if ($request->hasFile('gallery')) {
            $galleryPaths = [];
            foreach ($request->file('gallery') as $file) {
                $galleryPaths[] = $file->store('products/gallery', 'public');
            }
            $validated['gallery'] = $galleryPaths;
        }

        Product::create($validated);

        return redirect()->route('admin.products.index')->with('success', 'Product created!');
    }

    public function edit(Product $product)
    {
        $categories = Category::active()->ordered()->get();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'short_description' => 'nullable|string|max:500',
            'price' => 'required|numeric|min:0',
            'old_price' => 'nullable|numeric|min:0',
            'discount_percent' => 'nullable|integer|min:0|max:100',
            'badge' => 'nullable|string|max:50',
            'badge_color' => 'nullable|string|max:20',
            'image' => 'nullable|image|max:2048',
            'gallery.*' => 'nullable|image|max:2048',
            'is_combo' => 'nullable|boolean',
            'free_delivery' => 'nullable|boolean',
            'sku' => 'nullable|string|max:50',
            'stock' => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean',
            'is_featured' => 'nullable|boolean',
            'order' => 'nullable|integer',
        ]);

        $validated['slug'] = Str::slug($validated['name']) ?: Str::random(8);
        $validated['is_combo'] = $request->has('is_combo');
        $validated['free_delivery'] = $request->has('free_delivery');
        $validated['is_active'] = $request->has('is_active');
        $validated['is_featured'] = $request->has('is_featured');

        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $validated['image'] = $request->file('image')->store('products', 'public');
        }

        if ($request->hasFile('gallery')) {
            if ($product->gallery) {
                foreach ($product->gallery as $old) {
                    Storage::disk('public')->delete($old);
                }
            }
            $galleryPaths = [];
            foreach ($request->file('gallery') as $file) {
                $galleryPaths[] = $file->store('products/gallery', 'public');
            }
            $validated['gallery'] = $galleryPaths;
        }

        $product->update($validated);

        return redirect()->route('admin.products.index')->with('success', 'Product updated!');
    }

    public function destroy(Product $product)
    {
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }
        if ($product->gallery) {
            foreach ($product->gallery as $img) {
                Storage::disk('public')->delete($img);
            }
        }
        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Product deleted!');
    }

    public function toggleActive(Product $product)
    {
        $product->update(['is_active' => !$product->is_active]);
        return back()->with('success', 'Product status updated!');
    }
}
