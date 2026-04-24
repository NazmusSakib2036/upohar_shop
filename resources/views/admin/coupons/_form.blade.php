@if($errors->any())
<div class="mb-4 bg-red-50 border border-red-200 rounded-xl p-4">
    <ul class="text-sm text-red-600 space-y-1">
        @foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach
    </ul>
</div>
@endif

<div class="space-y-4">
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1.5">কুপন কোড *</label>
        <input type="text" name="code" value="{{ old('code', $coupon->code ?? '') }}" placeholder="SAVE20"
               class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm uppercase font-bold tracking-wider focus:ring-2 focus:ring-brand-pink/30 focus:border-brand-pink outline-none" required>
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1.5">বিবরণ</label>
        <input type="text" name="description" value="{{ old('description', $coupon->description ?? '') }}" placeholder="গ্রাহকের জন্য বিবরণ"
               class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-brand-pink/30 focus:border-brand-pink outline-none">
    </div>

    <div class="grid grid-cols-2 gap-4">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1.5">ধরন *</label>
            <select name="type" class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-brand-pink/30 focus:border-brand-pink outline-none" required>
                <option value="percent" {{ old('type', $coupon->type ?? '') === 'percent' ? 'selected' : '' }}>শতাংশ (%)</option>
                <option value="fixed"   {{ old('type', $coupon->type ?? '') === 'fixed'   ? 'selected' : '' }}>নির্দিষ্ট (৳)</option>
            </select>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1.5">মান *</label>
            <input type="number" name="value" value="{{ old('value', $coupon->value ?? '') }}" placeholder="20" min="0" step="0.01"
                   class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-brand-pink/30 focus:border-brand-pink outline-none" required>
        </div>
    </div>

    <div class="grid grid-cols-2 gap-4">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1.5">মিনিমাম অর্ডার (৳)</label>
            <input type="number" name="min_order" value="{{ old('min_order', $coupon->min_order ?? 0) }}" placeholder="500" min="0"
                   class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-brand-pink/30 focus:border-brand-pink outline-none">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1.5">সর্বোচ্চ ছাড় (৳)</label>
            <input type="number" name="max_discount" value="{{ old('max_discount', $coupon->max_discount ?? '') }}" placeholder="ঐচ্ছিক" min="0"
                   class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-brand-pink/30 focus:border-brand-pink outline-none">
        </div>
    </div>

    <div class="grid grid-cols-2 gap-4">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1.5">ব্যবহারের সীমা</label>
            <input type="number" name="usage_limit" value="{{ old('usage_limit', $coupon->usage_limit ?? '') }}" placeholder="খালি = সীমাহীন" min="1"
                   class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-brand-pink/30 focus:border-brand-pink outline-none">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1.5">মেয়াদ শেষ</label>
            <input type="date" name="expires_at" value="{{ old('expires_at', isset($coupon->expires_at) ? $coupon->expires_at->format('Y-m-d') : '') }}"
                   class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-brand-pink/30 focus:border-brand-pink outline-none">
        </div>
    </div>

    <label class="flex items-center gap-3 cursor-pointer">
        <div class="relative">
            <input type="checkbox" name="is_active" value="1" {{ old('is_active', $coupon->is_active ?? true) ? 'checked' : '' }} class="sr-only peer">
            <div class="w-10 h-5 bg-gray-200 rounded-full peer-checked:bg-brand-pink transition-colors"></div>
            <div class="absolute top-0.5 left-0.5 w-4 h-4 bg-white rounded-full transition-transform peer-checked:translate-x-5 shadow"></div>
        </div>
        <span class="text-sm font-medium text-gray-700">কুপন সক্রিয়</span>
    </label>
</div>
