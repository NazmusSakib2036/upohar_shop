{{-- Shared slider form fields --}}
<div class="space-y-6">
    {{-- Basic Info --}}
    <div class="bg-white rounded-2xl border border-gray-100 p-5 sm:p-6 shadow-sm">
        <h3 class="text-base font-semibold text-gray-800 mb-4 flex items-center gap-2">
            <svg class="w-5 h-5 text-brand-pink" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            মূল তথ্য
        </h3>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">হেডিং (সাধারণ অংশ) <span class="text-red-500">*</span></label>
                <input type="text" name="heading_normal" value="{{ old('heading_normal', $slider->heading_normal ?? '') }}" required
                       class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none text-sm"
                       placeholder="যেমন: 10% বিশেষ">
                @error('heading_normal') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">হেডিং (হাইলাইট অংশ) <span class="text-red-500">*</span></label>
                <input type="text" name="heading_highlight" value="{{ old('heading_highlight', $slider->heading_highlight ?? '') }}" required
                       class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none text-sm"
                       placeholder="যেমন: ছাড়">
                @error('heading_highlight') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">হেডিং ইমোজি</label>
                <input type="text" name="heading_emoji" value="{{ old('heading_emoji', $slider->heading_emoji ?? '') }}"
                       class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none text-sm"
                       placeholder="🎊">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">ক্রম (Order)</label>
                <input type="number" name="order" value="{{ old('order', $slider->order ?? 0) }}" min="0"
                       class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none text-sm"
                       placeholder="0">
            </div>
        </div>

        <div class="mt-4">
            <label class="block text-sm font-medium text-gray-700 mb-1.5">বিবরণ <span class="text-red-500">*</span></label>
            <textarea name="description" rows="3" required
                      class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none text-sm resize-none"
                      placeholder="স্লাইডার এর বিবরণ লিখুন...">{{ old('description', $slider->description ?? '') }}</textarea>
            @error('description') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
        </div>
    </div>

    {{-- Badges --}}
    <div class="bg-white rounded-2xl border border-gray-100 p-5 sm:p-6 shadow-sm">
        <h3 class="text-base font-semibold text-gray-800 mb-4 flex items-center gap-2">
            <svg class="w-5 h-5 text-brand-pink" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A2 2 0 013 12V7a4 4 0 014-4z"/>
            </svg>
            ব্যাজ সমূহ
        </h3>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">ব্যাজ ১ (সাদা)</label>
                <input type="text" name="badge_1" value="{{ old('badge_1', $slider->badge_1 ?? '') }}"
                       class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none text-sm"
                       placeholder="SPECIAL OFFER">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">ব্যাজ ২ (পিংক)</label>
                <input type="text" name="badge_2" value="{{ old('badge_2', $slider->badge_2 ?? '') }}"
                       class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none text-sm"
                       placeholder="10% অফার">
            </div>
        </div>
    </div>

    {{-- Buttons --}}
    <div class="bg-white rounded-2xl border border-gray-100 p-5 sm:p-6 shadow-sm">
        <h3 class="text-base font-semibold text-gray-800 mb-4 flex items-center gap-2">
            <svg class="w-5 h-5 text-brand-pink" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 15l-2 5L9 9l11 4-5 2zm0 0l5 5M7.188 2.239l.777 2.897M5.136 7.965l-2.898-.777M13.95 4.05l-2.122 2.122m-5.657 5.656l-2.12 2.122"/>
            </svg>
            বাটন সমূহ
        </h3>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">প্রাইমারি বাটন টেক্সট</label>
                <input type="text" name="btn_primary_text" value="{{ old('btn_primary_text', $slider->btn_primary_text ?? 'অর্ডার করুন') }}"
                       class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none text-sm"
                       placeholder="অর্ডার করুন">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">প্রাইমারি বাটন লিংক</label>
                <input type="text" name="btn_primary_link" value="{{ old('btn_primary_link', $slider->btn_primary_link ?? '/gifts') }}"
                       class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none text-sm"
                       placeholder="/gifts">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">সেকেন্ডারি বাটন টেক্সট</label>
                <input type="text" name="btn_secondary_text" value="{{ old('btn_secondary_text', $slider->btn_secondary_text ?? '') }}"
                       class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none text-sm"
                       placeholder="সকল গিফট দেখুন">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">সেকেন্ডারি বাটন লিংক</label>
                <input type="text" name="btn_secondary_link" value="{{ old('btn_secondary_link', $slider->btn_secondary_link ?? '') }}"
                       class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none text-sm"
                       placeholder="/gifts">
            </div>
        </div>
    </div>

    {{-- Image --}}
    <div class="bg-white rounded-2xl border border-gray-100 p-5 sm:p-6 shadow-sm">
        <h3 class="text-base font-semibold text-gray-800 mb-4 flex items-center gap-2">
            <svg class="w-5 h-5 text-brand-pink" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
            </svg>
            ছবি (ঐচ্ছিক)
        </h3>

        @if(isset($slider) && $slider->image)
            <div class="mb-4">
                <p class="text-sm text-gray-500 mb-2">বর্তমান ছবি:</p>
                <img src="{{ asset('storage/' . $slider->image) }}" alt="Current" class="h-32 rounded-xl object-cover border border-gray-200">
            </div>
        @endif

        <div x-data="{ preview: null }">
            <label class="block cursor-pointer">
                <div class="border-2 border-dashed border-gray-200 rounded-xl p-6 text-center hover:border-brand-pink/50 transition-colors"
                     :class="preview ? 'border-brand-pink/50' : ''">
                    <template x-if="!preview">
                        <div>
                            <svg class="w-10 h-10 text-gray-300 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                            </svg>
                            <p class="text-sm text-gray-500">ছবি আপলোড করতে ক্লিক করুন</p>
                            <p class="text-xs text-gray-400 mt-1">JPG, PNG, WebP, GIF (সর্বোচ্চ 2MB)</p>
                        </div>
                    </template>
                    <template x-if="preview">
                        <img :src="preview" class="max-h-40 mx-auto rounded-lg">
                    </template>
                </div>
                <input type="file" name="image" accept="image/*" class="hidden"
                       @change="if ($event.target.files[0]) { preview = URL.createObjectURL($event.target.files[0]) }">
            </label>
        </div>
        @error('image') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
    </div>

    {{-- Stats --}}
    <div class="bg-white rounded-2xl border border-gray-100 p-5 sm:p-6 shadow-sm">
        <h3 class="text-base font-semibold text-gray-800 mb-4 flex items-center gap-2">
            <svg class="w-5 h-5 text-brand-pink" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
            </svg>
            পরিসংখ্যান
        </h3>

        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">স্ট্যাট ১</label>
                <input type="text" name="stat_1" value="{{ old('stat_1', $slider->stat_1 ?? '৫০০০+ সন্তুষ্ট গ্রাহক') }}"
                       class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none text-sm">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">স্ট্যাট ২</label>
                <input type="text" name="stat_2" value="{{ old('stat_2', $slider->stat_2 ?? '৪০০০+ গিফট আইটেম') }}"
                       class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none text-sm">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">স্ট্যাট ৩</label>
                <input type="text" name="stat_3" value="{{ old('stat_3', $slider->stat_3 ?? '২৪/৭ কাস্টমার সাপোর্ট') }}"
                       class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none text-sm">
            </div>
        </div>
    </div>

    {{-- Status & Submit --}}
    <div class="bg-white rounded-2xl border border-gray-100 p-5 sm:p-6 shadow-sm">
        <div class="flex items-center justify-between">
            <label class="flex items-center gap-3 cursor-pointer">
                <input type="hidden" name="is_active" value="0">
                <input type="checkbox" name="is_active" value="1"
                       {{ old('is_active', $slider->is_active ?? true) ? 'checked' : '' }}
                       class="w-5 h-5 rounded border-gray-300 text-brand-pink focus:ring-brand-pink">
                <div>
                    <span class="text-sm font-medium text-gray-700">সক্রিয়</span>
                    <p class="text-xs text-gray-400">চালু থাকলে হোমপেজে দেখাবে</p>
                </div>
            </label>

            <div class="flex items-center gap-3">
                <a href="{{ route('admin.sliders.index') }}"
                   class="px-5 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-600 rounded-xl text-sm font-medium transition-colors">
                    বাতিল
                </a>
                <button type="submit"
                        class="px-6 py-2.5 bg-brand-pink hover:bg-brand-pink-dark text-white rounded-xl text-sm font-semibold transition-all shadow-sm">
                    {{ isset($slider) && $slider->exists ? 'আপডেট করুন' : 'তৈরি করুন' }}
                </button>
            </div>
        </div>
    </div>
</div>
