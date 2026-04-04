{{-- Product Card Component - matches upoharshop.com design --}}
<div class="product-card group bg-white rounded-2xl border border-gray-100 hover:border-pink-200 hover:shadow-xl transition-all duration-300 overflow-hidden">
    {{-- Product Image --}}
    <div class="relative aspect-square overflow-hidden bg-gray-50">
        @if($product->image)
            <img src="{{ asset('storage/' . $product->image) }}"
                 alt="{{ $product->name }}"
                 class="w-full h-full object-cover product-img transition-transform duration-500">
        @else
            <div class="w-full h-full bg-gradient-to-br from-pink-50 to-pink-100 flex items-center justify-center">
                <span class="text-6xl">🎁</span>
            </div>
        @endif

        {{-- Badges --}}
        <div class="absolute top-3 left-3 flex flex-wrap gap-1.5 z-10">
            @if($product->is_combo)
                <span class="px-2.5 py-1 bg-brand-pink text-white text-[10px] font-bold rounded-md uppercase tracking-wide">COMBO</span>
            @endif
            @if($product->discount_percent > 0)
                <span class="px-2.5 py-1 bg-yellow-400 text-gray-900 text-[10px] font-bold rounded-md">-{{ $product->discount_percent }}%</span>
            @endif
            @if($product->badge)
                <span class="px-2.5 py-1 text-white text-[10px] font-bold rounded-md" style="background: {{ $product->badge_color ?? '#E91E63' }}">{{ $product->badge }}</span>
            @endif
            @if($product->free_delivery)
                <span class="px-2 py-1 bg-pink-100 text-brand-pink text-[9px] font-semibold rounded-md">ফ্রি হাস</span>
            @endif
        </div>

        {{-- Wishlist Button --}}
        <button class="absolute top-3 right-3 w-9 h-9 bg-white/90 hover:bg-white rounded-full flex items-center justify-center shadow-sm z-10 transition-all hover:scale-110">
            <svg class="w-4.5 h-4.5 text-brand-pink" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
            </svg>
        </button>

        {{-- Hover Overlay with View & Cart --}}
        <div class="product-overlay absolute inset-0 bg-black/20 flex items-center justify-center gap-3 opacity-0 transition-opacity duration-300 z-[5]">
            <button @click="openQuickView({{ $product->id }})"
                    class="w-11 h-11 bg-white rounded-full flex items-center justify-center shadow-lg hover:bg-pink-50 transition-colors hover:scale-110 transform"
                    title="দ্রুত দেখুন">
                <svg class="w-5 h-5 text-brand-pink" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                </svg>
            </button>
            <button @click="addToCartById({{ $product->id }})"
                    class="w-11 h-11 bg-white rounded-full flex items-center justify-center shadow-lg hover:bg-pink-50 transition-colors hover:scale-110 transform"
                    title="কার্টে যোগ করুন">
                <svg class="w-5 h-5 text-brand-pink" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 100 4 2 2 0 000-4z"/>
                </svg>
            </button>
        </div>

        {{-- Stock Out Overlay --}}
        @if($product->stock <= 0)
            <div class="absolute inset-0 bg-white/60 flex items-center justify-center z-[6]">
                <span class="text-lg font-bold text-gray-700 bg-white/80 px-4 py-2 rounded-lg">স্টক নেই</span>
            </div>
        @endif
    </div>

    {{-- Product Info --}}
    <div class="p-3 sm:p-4">
        <a href="{{ route('product.show', $product->slug) }}" class="block">
            <h3 class="font-semibold text-gray-800 text-sm sm:text-base mb-1.5 truncate hover:text-brand-pink transition-colors">{{ $product->name }}</h3>
        </a>
        <p class="text-[11px] text-gray-400 uppercase tracking-wider mb-1">PRICE</p>
        <div class="flex items-center justify-between gap-2">
            <div class="flex items-center gap-2">
                <span class="text-brand-pink font-bold text-lg sm:text-xl">৳{{ number_format($product->price, 0) }}</span>
                @if($product->old_price)
                    <span class="text-gray-400 text-xs line-through">৳{{ number_format($product->old_price, 0) }}</span>
                @endif
            </div>
            <a href="{{ route('product.show', $product->slug) }}"
               class="px-4 py-2 bg-gray-900 hover:bg-gray-800 text-white text-xs font-semibold rounded-md transition-colors whitespace-nowrap">
                অর্ডার করুন
            </a>
        </div>
    </div>
</div>
