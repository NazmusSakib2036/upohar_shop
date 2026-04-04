@extends('layouts.app')

@section('title', $product->name . ' - উপহার Shop')

@section('styles')
<style>
    .product-card:hover .product-overlay { opacity: 1; }
    .product-card:hover .product-img { transform: scale(1.05); }
    .thumb-active { border-color: #E91E63 !important; }
</style>
@endsection

@section('content')
<div class="pt-24 sm:pt-28 pb-12 bg-white min-h-screen" x-data="productDetail()">
    {{-- Breadcrumb --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-6">
        <div class="flex items-center justify-between">
            <a href="{{ url()->previous() }}" class="flex items-center gap-2 text-sm text-brand-pink hover:text-brand-pink-dark transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                ফিরে যান
            </a>
            <nav class="text-sm text-gray-400 hidden sm:flex items-center gap-2">
                <a href="/" class="hover:text-brand-pink">HOME</a>
                <span>/</span>
                @if($product->category)
                    <a href="{{ route('category.show', $product->category->slug) }}" class="hover:text-brand-pink">{{ strtoupper($product->category->name) }}</a>
                    <span>/</span>
                @endif
                <span class="text-gray-600">{{ $product->name }}</span>
            </nav>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12">
            {{-- Left: Product Images --}}
            <div class="relative">
                @if($product->category)
                    <span class="absolute top-4 left-4 z-10 px-3 py-1 bg-yellow-400 text-gray-900 text-xs font-bold rounded-md">{{ $product->category->name }}</span>
                @endif

                {{-- Main Image --}}
                <div class="bg-gray-50 rounded-2xl overflow-hidden aspect-square flex items-center justify-center mb-4">
                    @if($product->image)
                        <img :src="selectedImage" alt="{{ $product->name }}" class="max-w-full max-h-full object-contain p-4">
                    @else
                        <span class="text-8xl">🎁</span>
                    @endif
                </div>

                {{-- Wishlist --}}
                <button class="absolute bottom-20 right-4 w-10 h-10 bg-white rounded-full shadow-md flex items-center justify-center hover:bg-pink-50 z-10">
                    <svg class="w-5 h-5 text-gray-400 hover:text-brand-pink transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                    </svg>
                </button>

                {{-- Thumbnails --}}
                @if($product->gallery && count($product->gallery) > 0)
                <div class="flex gap-3">
                    <button @click="selectedImage = '{{ asset('storage/' . $product->image) }}'"
                            :class="selectedImage === '{{ asset('storage/' . $product->image) }}' ? 'thumb-active' : ''"
                            class="w-16 h-16 rounded-lg border-2 border-gray-200 overflow-hidden hover:border-brand-pink transition-colors">
                        <img src="{{ asset('storage/' . $product->image) }}" class="w-full h-full object-cover">
                    </button>
                    @foreach($product->gallery as $img)
                    <button @click="selectedImage = '{{ asset('storage/' . $img) }}'"
                            :class="selectedImage === '{{ asset('storage/' . $img) }}' ? 'thumb-active' : ''"
                            class="w-16 h-16 rounded-lg border-2 border-gray-200 overflow-hidden hover:border-brand-pink transition-colors">
                        <img src="{{ asset('storage/' . $img) }}" class="w-full h-full object-cover">
                    </button>
                    @endforeach
                </div>
                @endif
            </div>

            {{-- Right: Product Details --}}
            <div class="flex flex-col justify-center">
                {{-- Rating --}}
                <div class="flex items-center gap-2 mb-2">
                    <div class="flex text-yellow-400">
                        @for($i = 0; $i < 4; $i++) ★ @endfor
                        <span class="text-gray-300">★</span>
                    </div>
                    <a href="#" class="text-sm text-blue-500 hover:underline">ফেসবুক গ্রুপে রিভিউ দেখুন</a>
                </div>

                <h1 class="text-2xl sm:text-3xl font-bold text-gray-900 mb-2">{{ $product->name }}</h1>

                <p class="text-sm text-gray-400 mb-1">প্রাইস</p>
                <p class="text-3xl font-bold text-brand-pink mb-6">৳{{ number_format($product->price, 0) }}</p>

                {{-- Quantity + Cart + WhatsApp --}}
                <div class="flex flex-wrap items-center gap-3 mb-3">
                    <div class="flex items-center border border-gray-200 rounded-lg">
                        <button @click="qty = Math.max(1, qty - 1)" class="w-10 h-10 flex items-center justify-center text-gray-500 hover:bg-gray-50 text-lg">−</button>
                        <span class="w-10 h-10 flex items-center justify-center font-semibold text-gray-700 border-x border-gray-200" x-text="qty"></span>
                        <button @click="qty++" class="w-10 h-10 flex items-center justify-center text-gray-500 hover:bg-gray-50 text-lg">+</button>
                    </div>
                    <button @click="addProductToCart()" class="w-10 h-10 border border-gray-200 rounded-lg flex items-center justify-center hover:bg-pink-50 transition-colors">
                        <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 100 4 2 2 0 000-4z"/>
                        </svg>
                    </button>
                    <a href="https://wa.me/8801313186576?text={{ urlencode('আমি অর্ডার করতে চাই: ' . $product->name . ' - ৳' . number_format($product->price, 0)) }}"
                       target="_blank"
                       class="flex-1 flex items-center justify-center gap-2 px-4 py-2.5 bg-green-500 hover:bg-green-600 text-white rounded-lg font-semibold text-sm transition-colors">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/><path d="M12 0C5.373 0 0 5.373 0 12c0 2.625.846 5.059 2.284 7.034L.789 23.492a.5.5 0 00.612.638l4.648-1.218A11.94 11.94 0 0012 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 22c-2.244 0-4.322-.725-6.013-1.955l-.42-.312-3.088.809.824-3.01-.343-.545A9.963 9.963 0 012 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10z"/></svg>
                        হোয়াটসঅ্যাপ অর্ডার
                    </a>
                </div>

                {{-- Order Button --}}
                <button @click="addProductToCart(); cartOpen = true"
                        class="w-full flex items-center justify-center gap-2 px-6 py-3.5 bg-gray-900 hover:bg-gray-800 text-white rounded-lg font-semibold transition-colors mb-6">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 100 4 2 2 0 000-4z"/>
                    </svg>
                    অর্ডার করুন
                </button>

                {{-- Badges --}}
                <div class="flex items-center gap-5 text-sm text-gray-500 mb-4">
                    <span class="flex items-center gap-2">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a2 2 0 104 0m-4 0a2 2 0 114 0"/></svg>
                        ফাস্ট ডেলিভারি
                    </span>
                    <span class="flex items-center gap-2">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        অরিজিনাল পণ্য
                    </span>
                </div>

                {{-- Stock --}}
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center gap-2 text-sm">
                        @if($product->stock > 0)
                            <span class="w-2.5 h-2.5 bg-green-500 rounded-full"></span>
                            <span class="text-green-600 font-medium">স্টক আছে</span>
                        @else
                            <span class="text-red-500 font-bold text-lg">স্টক নেই</span>
                        @endif
                    </div>
                    {{-- Share buttons --}}
                    <div class="flex items-center gap-2">
                        <button onclick="navigator.clipboard.writeText(window.location.href)" class="w-8 h-8 border border-gray-200 rounded-full flex items-center justify-center hover:bg-gray-50" title="লিংক কপি করুন">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3"/></svg>
                        </button>
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}" target="_blank" class="w-8 h-8 border border-gray-200 rounded-full flex items-center justify-center hover:bg-blue-50">
                            <svg class="w-4 h-4 text-blue-600" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                        </a>
                        <a href="https://wa.me/?text={{ urlencode($product->name . ' - ' . request()->url()) }}" target="_blank" class="w-8 h-8 border border-gray-200 rounded-full flex items-center justify-center hover:bg-green-50">
                            <svg class="w-4 h-4 text-green-500" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/></svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- Product Description Tabs --}}
        <div class="mt-12 border-t border-gray-100 pt-8">
            <div class="flex items-center gap-8 border-b border-gray-100 mb-6">
                <button @click="activeTab = 'desc'" :class="activeTab === 'desc' ? 'text-gray-900 border-brand-pink' : 'text-gray-400 border-transparent'" class="pb-3 text-sm font-semibold border-b-2 transition-colors">পণ্য সম্পর্কে</button>
                <button @click="activeTab = 'spec'" :class="activeTab === 'spec' ? 'text-gray-900 border-brand-pink' : 'text-gray-400 border-transparent'" class="pb-3 text-sm font-semibold border-b-2 transition-colors">স্পেসিফিকেশন</button>
            </div>

            <div x-show="activeTab === 'desc'">
                <h3 class="text-lg font-bold text-gray-900 mb-3">বিবরণ</h3>
                <div class="text-gray-600 text-sm leading-relaxed prose max-w-none">
                    {!! nl2br(e($product->description ?? 'আমাদের এই পণ্যটি অত্যন্ত যত্ন সকারে বাছাই করা হয়েছে। এটি প্রিমিয়াম কোয়ালিটি নিশ্চিত করে আপনার প্রিয়জনকে আনন্দ দেবে।')) !!}
                </div>
            </div>

            <div x-show="activeTab === 'spec'" x-cloak>
                <div class="grid grid-cols-2 gap-4 text-sm">
                    @if($product->sku)
                    <div class="bg-gray-50 p-3 rounded-lg">
                        <span class="text-gray-400 block">SKU</span>
                        <span class="font-semibold text-gray-700">{{ $product->sku }}</span>
                    </div>
                    @endif
                    @if($product->category)
                    <div class="bg-gray-50 p-3 rounded-lg">
                        <span class="text-gray-400 block">ক্যাটাগরি</span>
                        <span class="font-semibold text-gray-700">{{ $product->category->name }}</span>
                    </div>
                    @endif
                    <div class="bg-gray-50 p-3 rounded-lg">
                        <span class="text-gray-400 block">ডেলিভারি</span>
                        <span class="font-semibold text-gray-700">{{ $product->free_delivery ? 'ফ্রি ডেলিভারি' : 'স্ট্যান্ডার্ড ডেলিভারি' }}</span>
                    </div>
                    <div class="bg-gray-50 p-3 rounded-lg">
                        <span class="text-gray-400 block">স্টক</span>
                        <span class="font-semibold {{ $product->stock > 0 ? 'text-green-600' : 'text-red-500' }}">{{ $product->stock_label }}</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Related Products --}}
        @if($relatedProducts->count())
        <div class="mt-14">
            <h2 class="text-xl font-bold text-gray-900 mb-6">সম্পর্কিত পণ্য</h2>
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4 sm:gap-5" x-data="productSection()">
                @foreach($relatedProducts as $relProduct)
                    @include('partials.product-card', ['product' => $relProduct])
                @endforeach
            </div>
        </div>
        @endif
    </div>
</div>
@endsection

@section('scripts')
<script>
function productDetail() {
    return {
        qty: 1,
        activeTab: 'desc',
        selectedImage: '{{ $product->image ? asset("storage/" . $product->image) : "" }}',

        addProductToCart() {
            const product = {
                id: {{ $product->id }},
                name: '{{ addslashes($product->name) }}',
                price: {{ $product->price }},
                image: '{{ $product->image_url }}',
                slug: '{{ $product->slug }}',
            };
            let cart = JSON.parse(localStorage.getItem('upohar_cart') || '[]');
            const existing = cart.findIndex(i => i.id === product.id);
            if (existing >= 0) {
                cart[existing].qty += this.qty;
            } else {
                cart.push({ ...product, qty: this.qty });
            }
            localStorage.setItem('upohar_cart', JSON.stringify(cart));
            window.dispatchEvent(new CustomEvent('cart-updated'));
            window.dispatchEvent(new CustomEvent('open-cart'));
        }
    }
}

function productSection() {
    return {
        quickViewOpen: false,
        qvProduct: {},
        qvSelectedImage: null,
        qvQty: 1,
        async openQuickView(productId) {
            this.qvQty = 1;
            this.qvSelectedImage = null;
            const res = await fetch(window.baseUrl + '/product/' + productId + '/quick-view');
            this.qvProduct = await res.json();
            this.qvSelectedImage = this.qvProduct.image;
            this.quickViewOpen = true;
        },
        addToCart(product, qty = 1) {
            let cart = JSON.parse(localStorage.getItem('upohar_cart') || '[]');
            const existing = cart.findIndex(i => i.id === product.id);
            if (existing >= 0) { cart[existing].qty += qty; }
            else { cart.push({ id: product.id, name: product.name, price: product.price, image: product.image, slug: product.slug, qty }); }
            localStorage.setItem('upohar_cart', JSON.stringify(cart));
            window.dispatchEvent(new CustomEvent('cart-updated'));
        },
        addToCartById(productId) {
            fetch(window.baseUrl + '/product/' + productId + '/quick-view').then(r => r.json()).then(p => { this.addToCart(p, 1); window.dispatchEvent(new CustomEvent('open-cart')); });
        }
    }
}
</script>
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
