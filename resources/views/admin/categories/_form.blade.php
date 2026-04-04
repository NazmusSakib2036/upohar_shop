{{-- Category Form Partial --}}
<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <div>
        <label class="block text-sm font-semibold text-gray-700 mb-1">Name *</label>
        <input type="text" name="name" value="{{ old('name', $category->name ?? '') }}" required class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-pink-300 focus:border-pink-400">
    </div>
    <div>
        <label class="block text-sm font-semibold text-gray-700 mb-1">Order</label>
        <input type="number" name="order" value="{{ old('order', $category->order ?? 0) }}" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-pink-300 focus:border-pink-400">
    </div>
    <div>
        <label class="block text-sm font-semibold text-gray-700 mb-1">Icon Color</label>
        <div class="flex items-center gap-2">
            <input type="color" name="icon_color" value="{{ old('icon_color', $category->icon_color ?? '#E91E63') }}" class="w-10 h-10 rounded cursor-pointer">
            <input type="text" value="{{ old('icon_color', $category->icon_color ?? '#E91E63') }}" class="w-28 px-3 py-2 border rounded-lg text-sm" readonly>
        </div>
    </div>
    <div>
        <label class="block text-sm font-semibold text-gray-700 mb-1">Background Color</label>
        <div class="flex items-center gap-2">
            <input type="color" name="bg_color" value="{{ old('bg_color', $category->bg_color ?? '#fce4ec') }}" class="w-10 h-10 rounded cursor-pointer">
            <input type="text" value="{{ old('bg_color', $category->bg_color ?? '#fce4ec') }}" class="w-28 px-3 py-2 border rounded-lg text-sm" readonly>
        </div>
    </div>
    <div class="md:col-span-2">
        <label class="flex items-center gap-2 cursor-pointer">
            <input type="checkbox" name="is_active" value="1" {{ old('is_active', $category->is_active ?? true) ? 'checked' : '' }} class="w-4 h-4 text-pink-500 rounded">
            <span class="text-sm font-semibold text-gray-700">Active</span>
        </label>
    </div>
</div>
