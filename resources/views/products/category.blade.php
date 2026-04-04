@extends('layouts.app')

@section('title', $category->name . ' - উপহার Shop')

@section('styles')
<style>
    .category-scroll { -ms-overflow-style: none; scrollbar-width: none; }
    .category-scroll::-webkit-scrollbar { display: none; }
    .product-card:hover .product-overlay { opacity: 1; }
</style>
@endsection

@section('content')
<div x-data="categoryPage()" class="pt-28 sm:pt-32">
    {{-- Breadcrumb --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-6">
        <nav class="flex items-center gap-2 text-sm text-gray-500">
            <a href="/" class="hover:text-brand-pink transition-colors">হোম</a>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            <a href="{{ route('gifts') }}" class="hover:text-brand-pink transition-colors">সকল গিফট</a>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            <span class="text-gray-800 font-medium">{{ $category->name }}</span>
        </nav>
    </div>

    {{-- Category Filter Bar --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-8">
        <div class="flex items-center gap-3 overflow-x-auto category-scroll pb-2">
            <a href="{{ route('gifts') }}"
               class="flex-shrink-0 px-5 py-2.5 rounded-full text-sm font-medium transition-all duration-200 bg-gray-100 text-gray-700 hover:bg-brand-pink-light hover:text-brand-pink">
                সকল
            </a>
            @foreach($categories as $cat)
            <a href="{{ route('category.show', $cat->slug) }}"
               class="flex-shrink-0 px-5 py-2.5 rounded-full text-sm font-medium transition-all duration-200 {{ $cat->id === $category->id ? 'bg-brand-pink text-white shadow-md' : 'bg-gray-100 text-gray-700 hover:bg-brand-pink-light hover:text-brand-pink' }}">
                {{ $cat->name }}
            </a>
            @endforeach
        </div>
    </div>

    {{-- Page Header --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-6">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-full flex items-center justify-center" style="background: {{ $category->bg_color }}">
                    <span class="text-lg" style="color: {{ $category->icon_color }}">🎁</span>
                </div>
                <h1 class="text-2xl font-bold text-gray-800">{{ $category->name }}</h1>
            </div>
            <span class="text-sm text-gray-500">{{ $products->total() }}টি পণ্য</span>
        </div>
    </div>

    {{-- Product Grid --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-12">
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4 sm:gap-6">
            @forelse($products as $product)
                @include('partials.product-card', ['product' => $product])
            @empty
                <div class="col-span-full text-center py-16">
                    <div class="text-6xl mb-4">📦</div>
                    <p class="text-gray-500 text-lg">এই ক্যাটাগরিতে কোনো পণ্য নেই।</p>
                    <a href="{{ route('gifts') }}" class="inline-block mt-4 bg-brand-pink text-white px-6 py-2.5 rounded-full font-medium hover:bg-brand-pink-dark transition-colors">সকল গিফট দেখুন</a>
                </div>
            @endforelse
        </div>

        @if($products->hasPages())
        <div class="mt-8">
            {{ $products->links() }}
        </div>
        @endif
    </div>

    {{-- Quick View Modal --}}
    <div x-show="showQuickView" x-cloak
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
         class="fixed inset-0 z-50 flex items-center justify-center p-4" style="background: rgba(0,0,0,0.5); backdrop-filter: blur(4px);">
        <div @click.away="showQuickView = false"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100"
             class="bg-white rounded-2xl shadow-2xl w-full max-w-3xl max-h-[90vh] overflow-y-auto">
            <template x-if="quickViewProduct">
                <div class="p-6">
                    <div class="flex justify-between items-start mb-4">
                        <span class="bg-brand-pink-light text-brand-pink px-3 py-1 rounded-full text-xs font-medium" x-text="quickViewProduct.category"></span>
                        <button @click="showQuickView = false" class="text-gray-400 hover:text-gray-600 p-1">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                        </button>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <div class="aspect-square bg-gray-50 rounded-xl overflow-hidden mb-3">
                                <img :src="selectedImage || quickViewProduct.image || '/storage/products/placeholder.jpg'" class="w-full h-full object-cover" :alt="quickViewProduct.name">
                            </div>
                            <div class="flex gap-2 overflow-x-auto" x-show="quickViewProduct.gallery && quickViewProduct.gallery.length > 0">
                                <template x-for="(img, i) in quickViewProduct.gallery" :key="i">
                                    <button @click="selectedImage = img" class="w-16 h-16 rounded-lg overflow-hidden border-2 flex-shrink-0 transition-colors"
                                            :class="selectedImage === img ? 'border-brand-pink' : 'border-gray-200'">
                                        <img :src="img" class="w-full h-full object-cover">
                                    </button>
                                </template>
                            </div>
                        </div>
                        <div>
                            <h2 class="text-xl font-bold text-gray-800 mb-3" x-text="quickViewProduct.name"></h2>
                            <div class="flex items-baseline gap-3 mb-4">
                                <span class="text-2xl font-bold text-brand-pink">৳<span x-text="Number(quickViewProduct.price).toLocaleString('bn-BD')"></span></span>
                                <span class="text-sm text-gray-400 line-through" x-show="quickViewProduct.old_price" x-text="'৳' + Number(quickViewProduct.old_price).toLocaleString('bn-BD')"></span>
                                <span class="bg-red-100 text-red-600 px-2 py-0.5 rounded text-xs font-medium" x-show="quickViewProduct.discount_percent" x-text="'-' + quickViewProduct.discount_percent + '%'"></span>
                            </div>
                            <p class="text-gray-600 text-sm mb-4" x-text="quickViewProduct.short_description || quickViewProduct.description"></p>
                            <div class="flex items-center gap-2 mb-4">
                                <div class="flex items-center border border-gray-200 rounded-lg">
                                    <button @click="qty = Math.max(1, qty - 1)" class="px-3 py-2 text-gray-500 hover:text-brand-pink">−</button>
                                    <span class="px-3 py-2 font-medium" x-text="qty"></span>
                                    <button @click="qty++" class="px-3 py-2 text-gray-500 hover:text-brand-pink">+</button>
                                </div>
                                <button @click="addToCartById(quickViewProduct.id, qty)" class="flex-1 bg-gray-900 text-white py-2.5 rounded-lg font-medium hover:bg-gray-800 transition-colors">
                                    অর্ডার করুন
                                </button>
                            </div>
                            <a :href="'https://wa.me/880XXXXXXXXX?text=' + encodeURIComponent('আমি অর্ডার করতে চাই: ' + quickViewProduct.name + ' - ৳' + quickViewProduct.price)"
                               target="_blank" class="flex items-center justify-center gap-2 w-full bg-green-500 text-white py-2.5 rounded-lg font-medium hover:bg-green-600 transition-colors mb-4">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/><path d="M12 0C5.373 0 0 5.373 0 12c0 2.126.555 4.12 1.522 5.855L.053 23.682l5.972-1.437A11.936 11.936 0 0012 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 21.818c-1.904 0-3.68-.53-5.194-1.45l-.373-.22-3.86.93.974-3.757-.243-.386A9.78 9.78 0 012.182 12 9.818 9.818 0 0112 2.182 9.818 9.818 0 0121.818 12 9.818 9.818 0 0112 21.818z"/></svg>
                                WhatsApp অর্ডার
                            </a>
                            <div class="flex items-center gap-4 text-xs text-gray-500 mb-3">
                                <span x-show="quickViewProduct.free_delivery" class="flex items-center gap-1">🚚 ফ্রি ডেলিভারি</span>
                                <span class="flex items-center gap-1">✅ অরিজিনাল প্রোডাক্ট</span>
                            </div>
                            <div class="flex items-center gap-2 text-sm">
                                <span class="w-2 h-2 rounded-full" :class="quickViewProduct.stock > 0 ? 'bg-green-500' : 'bg-red-500'"></span>
                                <span x-text="quickViewProduct.stock_label"></span>
                            </div>
                            <a :href="window.baseUrl + '/product/' + quickViewProduct.slug" class="inline-block mt-4 text-brand-pink text-sm font-medium hover:underline">সম্পূর্ণ বিবরণ দেখুন →</a>
                        </div>
                    </div>
                </div>
            </template>
        </div>
    </div>
</div>
@endsection

@section('footer')
<footer class="bg-gray-900 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            <div>
                <div class="flex items-center gap-1 mb-4">
                    <span class="text-3xl font-bold text-brand-pink">উপহার</span>
                    <span class="shop-badge">S<br>H<br>O<br>P</span>
                </div>
                <p class="text-gray-400 text-sm leading-relaxed">আপনার প্রিয়জনকে সারপ্রাইজ দিন আমাদের বিশেষ গিফট কালেকশন থেকে।</p>
            </div>
            <div>
                <h3 class="font-semibold text-white mb-4">দ্রুত লিংক</h3>
                <ul class="space-y-2 text-sm text-gray-400">
                    <li><a href="/" class="hover:text-brand-pink transition-colors">হোম</a></li>
                    <li><a href="/gifts" class="hover:text-brand-pink transition-colors">সকল গিফট</a></li>
                    <li><a href="/contact" class="hover:text-brand-pink transition-colors">যোগাযোগ</a></li>
                </ul>
            </div>
            <div>
                <h3 class="font-semibold text-white mb-4">সহায়তা</h3>
                <ul class="space-y-2 text-sm text-gray-400">
                    <li><a href="#" class="hover:text-brand-pink transition-colors">গোপনীয়তা নীতি</a></li>
                    <li><a href="#" class="hover:text-brand-pink transition-colors">রিটার্ন পলিসি</a></li>
                    <li><a href="#" class="hover:text-brand-pink transition-colors">শর্তাবলী</a></li>
                </ul>
            </div>
            <div>
                <h3 class="font-semibold text-white mb-4">যোগাযোগ</h3>
                <ul class="space-y-2 text-sm text-gray-400">
                    <li class="flex items-center gap-2"><span>📞</span> ০১XXXXXXXXX</li>
                    <li class="flex items-center gap-2"><span>📧</span> info&#64;upoharshop.com</li>
                    <li class="flex items-center gap-2"><span>📍</span> ঢাকা, বাংলাদেশ</li>
                </ul>
            </div>
        </div>
        <div class="border-t border-gray-800 mt-10 pt-6 text-center text-sm text-gray-500">
            <p>&copy; {{ date('Y') }} উপহার Shop। সকল স্বত্ব সংরক্ষিত।</p>
        </div>
    </div>
</footer>
@endsection

@section('scripts')
<script>
function categoryPage() {
    return {
        showQuickView: false,
        quickViewProduct: null,
        selectedImage: null,
        qty: 1,
        openQuickView(productId) {
            this.qty = 1;
            this.selectedImage = null;
            fetch(`${window.baseUrl}/product/${productId}/quick-view`)
                .then(r => r.json())
                .then(data => {
                    this.quickViewProduct = data;
                    this.selectedImage = data.image;
                    this.showQuickView = true;
                });
        },
        addToCart(product) {
            let cart = JSON.parse(localStorage.getItem('upohar_cart') || '[]');
            const existing = cart.find(i => i.id === product.id);
            if (existing) { existing.qty++; } else { cart.push({ id: product.id, name: product.name, price: product.price, image: product.image_url || product.image, qty: 1 }); }
            localStorage.setItem('upohar_cart', JSON.stringify(cart));
            window.dispatchEvent(new CustomEvent('cart-updated'));
            window.dispatchEvent(new CustomEvent('open-cart'));
        },
        addToCartById(id, qty) {
            if (!qty) {
                fetch(window.baseUrl + '/product/' + id + '/quick-view')
                    .then(r => r.json())
                    .then(product => {
                        this.addToCart(product);
                    });
                return;
            }
            let cart = JSON.parse(localStorage.getItem('upohar_cart') || '[]');
            const existing = cart.find(i => i.id === id);
            if (existing) { existing.qty += qty; } else { cart.push({ id: id, name: this.quickViewProduct.name, price: this.quickViewProduct.price, image: this.quickViewProduct.image, qty: qty }); }
            localStorage.setItem('upohar_cart', JSON.stringify(cart));
            window.dispatchEvent(new CustomEvent('cart-updated'));
            this.showQuickView = false;
            window.dispatchEvent(new CustomEvent('open-cart'));
        }
    }
}
</script>
@endsection
