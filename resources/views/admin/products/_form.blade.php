{{-- Product Form --}}
<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <div class="md:col-span-2">
        <label class="block text-sm font-semibold text-gray-700 mb-1">Product Name *</label>
        <input type="text" name="name" value="{{ old('name', $product->name ?? '') }}" required class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-pink-300">
    </div>
    <div>
        <label class="block text-sm font-semibold text-gray-700 mb-1">Category *</label>
        <select name="category_id" required class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-pink-300">
            <option value="">Select Category</option>
            @foreach($categories as $cat)
                <option value="{{ $cat->id }}" {{ old('category_id', $product->category_id ?? '') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
            @endforeach
        </select>
    </div>
    <div>
        <label class="block text-sm font-semibold text-gray-700 mb-1">SKU</label>
        <input type="text" name="sku" value="{{ old('sku', $product->sku ?? '') }}" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-pink-300">
    </div>
    <div>
        <label class="block text-sm font-semibold text-gray-700 mb-1">Price *</label>
        <input type="number" name="price" value="{{ old('price', $product->price ?? '') }}" required step="0.01" min="0" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-pink-300">
    </div>
    <div>
        <label class="block text-sm font-semibold text-gray-700 mb-1">Old Price</label>
        <input type="number" name="old_price" value="{{ old('old_price', $product->old_price ?? '') }}" step="0.01" min="0" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-pink-300">
    </div>
    <div>
        <label class="block text-sm font-semibold text-gray-700 mb-1">Discount %</label>
        <input type="number" name="discount_percent" value="{{ old('discount_percent', $product->discount_percent ?? 0) }}" min="0" max="100" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-pink-300">
    </div>
    <div>
        <label class="block text-sm font-semibold text-gray-700 mb-1">Stock</label>
        <input type="number" name="stock" value="{{ old('stock', $product->stock ?? 0) }}" min="0" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-pink-300">
    </div>
    <div>
        <label class="block text-sm font-semibold text-gray-700 mb-1">Badge Text</label>
        <input type="text" name="badge" value="{{ old('badge', $product->badge ?? '') }}" placeholder="e.g. ফ্রি হাস" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-pink-300">
    </div>
    <div>
        <label class="block text-sm font-semibold text-gray-700 mb-1">Badge Color</label>
        <input type="color" name="badge_color" value="{{ old('badge_color', $product->badge_color ?? '#E91E63') }}" class="w-10 h-10 rounded cursor-pointer">
    </div>
    <div>
        <label class="block text-sm font-semibold text-gray-700 mb-1">Order</label>
        <input type="number" name="order" value="{{ old('order', $product->order ?? 0) }}" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-pink-300">
    </div>

    {{-- Short Description --}}
    <div class="md:col-span-2">
        <label class="block text-sm font-semibold text-gray-700 mb-1">Short Description</label>
        <input type="text" name="short_description" value="{{ old('short_description', $product->short_description ?? '') }}" maxlength="500" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-pink-300">
    </div>

    {{-- Full Description --}}
    <div class="md:col-span-2">
        <label class="block text-sm font-semibold text-gray-700 mb-1">Full Description</label>
        <textarea name="description" rows="4" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-pink-300">{{ old('description', $product->description ?? '') }}</textarea>
    </div>

    {{-- Main Image --}}
    <div>
        <label class="block text-sm font-semibold text-gray-700 mb-1">Main Image</label>
        @if(isset($product) && $product->image)
            <img src="{{ asset('storage/' . $product->image) }}" class="w-24 h-24 rounded-lg object-cover mb-2">
        @endif
        <input type="file" name="image" accept="image/*" class="w-full text-sm">
    </div>

    {{-- Gallery --}}
    <div>
        <label class="block text-sm font-semibold text-gray-700 mb-1">Gallery Images</label>
        @if(isset($product) && $product->gallery)
            <div class="flex gap-2 mb-2">
                @foreach($product->gallery as $img)
                    <img src="{{ asset('storage/' . $img) }}" class="w-16 h-16 rounded-lg object-cover">
                @endforeach
            </div>
        @endif
        <input type="file" name="gallery[]" accept="image/*" multiple class="w-full text-sm">
    </div>

    {{-- Checkboxes --}}
    <div class="md:col-span-2 flex flex-wrap gap-6">
        <label class="flex items-center gap-2 cursor-pointer">
            <input type="checkbox" name="is_active" value="1" {{ old('is_active', $product->is_active ?? true) ? 'checked' : '' }} class="w-4 h-4 text-pink-500 rounded">
            <span class="text-sm font-semibold">Active</span>
        </label>
        <label class="flex items-center gap-2 cursor-pointer">
            <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $product->is_featured ?? false) ? 'checked' : '' }} class="w-4 h-4 text-pink-500 rounded">
            <span class="text-sm font-semibold">Featured</span>
        </label>
        <label class="flex items-center gap-2 cursor-pointer">
            <input type="checkbox" name="is_combo" value="1" {{ old('is_combo', $product->is_combo ?? false) ? 'checked' : '' }} class="w-4 h-4 text-pink-500 rounded">
            <span class="text-sm font-semibold">Combo Pack</span>
        </label>
        <label class="flex items-center gap-2 cursor-pointer">
            <input type="checkbox" name="free_delivery" value="1" {{ old('free_delivery', $product->free_delivery ?? false) ? 'checked' : '' }} class="w-4 h-4 text-pink-500 rounded">
            <span class="text-sm font-semibold">Free Delivery</span>
        </label>
    </div>
</div>
