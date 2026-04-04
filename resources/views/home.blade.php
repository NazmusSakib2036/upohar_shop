@extends('layouts.app')

@section('title', 'উপহার Shop - প্রিয়জনকে সারপ্রাইজ দিন')

@section('styles')
<style>
    .hero-bg {
        background: linear-gradient(135deg, #fce4ec 0%, #f8bbd0 25%, #fce4ec 50%, #fff0f3 75%, #fce4ec 100%);
        position: relative;
        overflow: hidden;
    }

    .brand-marquee {
        animation: marquee 30s linear infinite;
    }
    @keyframes marquee {
        0% { transform: translateX(0); }
        100% { transform: translateX(-50%); }
    }

    .category-scroll::-webkit-scrollbar { display: none; }
    .category-scroll { -ms-overflow-style: none; scrollbar-width: none; }

    .product-card:hover .product-overlay { opacity: 1; }
    .product-card:hover .product-img { transform: scale(1.05); }

    /* Slider transition */
    .slide-fade-enter {
        opacity: 0;
        transform: translateX(30px);
    }
    .slide-fade-leave {
        opacity: 0;
        transform: translateX(-30px);
    }

    /* Floating gift decorations */
    .gift-float-1 { animation: giftFloat1 8s ease-in-out infinite; }
    .gift-float-2 { animation: giftFloat2 6s ease-in-out infinite; }
    .gift-float-3 { animation: giftFloat3 10s ease-in-out infinite; }
    .gift-float-4 { animation: giftFloat4 7s ease-in-out infinite; }

    @keyframes giftFloat1 {
        0%, 100% { transform: translateY(0) rotate(0deg); }
        50% { transform: translateY(-15px) rotate(3deg); }
    }
    @keyframes giftFloat2 {
        0%, 100% { transform: translateY(0) rotate(0deg); }
        50% { transform: translateY(-20px) rotate(-2deg); }
    }
    @keyframes giftFloat3 {
        0%, 100% { transform: translateY(0) rotate(0deg); }
        50% { transform: translateY(-10px) rotate(2deg); }
    }
    @keyframes giftFloat4 {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-12px); }
    }

    /* Cloud float */
    .cloud-float {
        animation: cloudMove 12s ease-in-out infinite;
    }
    @keyframes cloudMove {
        0%, 100% { transform: translateX(0); }
        50% { transform: translateX(15px); }
    }
</style>
@endsection

@section('content')
    {{-- ==================== HERO SLIDER (Admin Controllable from Database) ==================== --}}
    @php
        // Fallback if no slides in DB yet
        if (!isset($slides) || $slides->isEmpty()) {
            $slides = collect([
                (object)[
                    'badge_1' => 'SPECIAL OFFER',
                    'badge_2' => '10% অফার',
                    'heading_normal' => '10% বিশেষ',
                    'heading_highlight' => 'ছাড়',
                    'heading_emoji' => '🎊',
                    'description' => 'আমাদের ওয়েবসাইট থেকে প্রথম অর্ডারে পাবেন সকল পণ্যে 10% ডিসকাউন্ট। যেকোনো তথ্যের জন্য ইনবক্স করুন আমাদের ফেসবুক পেজে অথবা যোগাযোগ করুন হোয়াটসঅ্যাপে। 💌 ✨',
                    'btn_primary_text' => 'অর্ডার করুন',
                    'btn_primary_link' => '/gifts',
                    'btn_secondary_text' => 'সকল গিফট দেখুন',
                    'btn_secondary_link' => '/gifts',
                    'stat_1' => '৫০০০+ সন্তুষ্ট গ্রাহক',
                    'stat_2' => '৪০০০+ গিফট আইটেম',
                    'stat_3' => '২৪/৭ কাস্টমার সাপোর্ট',
                    'image' => null,
                ],
            ]);
        }
    @endphp

    <section class="hero-bg relative"
             style="min-height: 600px; max-height: 700px;"
             x-data="{
                currentSlide: 0,
                totalSlides: {{ count($slides) }},
                autoPlay: null,
                startAutoPlay() {
                    this.autoPlay = setInterval(() => { this.nextSlide() }, 5000);
                },
                stopAutoPlay() {
                    clearInterval(this.autoPlay);
                },
                nextSlide() {
                    this.currentSlide = (this.currentSlide + 1) % this.totalSlides;
                },
                prevSlide() {
                    this.currentSlide = (this.currentSlide - 1 + this.totalSlides) % this.totalSlides;
                },
                goToSlide(i) {
                    this.currentSlide = i;
                    this.stopAutoPlay();
                    this.startAutoPlay();
                }
             }"
             x-init="startAutoPlay()"
             @mouseenter="stopAutoPlay()"
             @mouseleave="startAutoPlay()">

        {{-- Background Decorative Elements (Gift boxes, balloons, clouds, hearts) --}}
        <div class="absolute inset-0 pointer-events-none overflow-hidden">
            {{-- Hot air balloon with gift - top right --}}
            <div class="absolute top-[8%] right-[15%] gift-float-1 hidden lg:block">
                <div class="relative">
                    {{-- Balloon --}}
                    <div class="w-24 h-32 bg-pink-200/60 rounded-full relative">
                        <div class="absolute inset-x-0 bottom-0 h-8 bg-pink-200/40" style="clip-path: polygon(20% 0%, 80% 0%, 60% 100%, 40% 100%);"></div>
                    </div>
                    {{-- String lines --}}
                    <div class="absolute bottom-0 left-1/2 -translate-x-1/2 w-px h-8 bg-pink-300/50"></div>
                    {{-- Gift box --}}
                    <div class="absolute -bottom-12 left-1/2 -translate-x-1/2">
                        <div class="w-10 h-8 bg-pink-100 border border-pink-200/60 rounded-sm relative">
                            <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full h-1frac bg-pink-300/40 top-1/2 h-px"></div>
                            <div class="absolute top-0 left-1/2 -translate-x-1/2 w-4 h-3 -top-2">
                                <div class="w-full h-full bg-yellow-300/70 rounded-t-full"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Large gift box - right center --}}
            <div class="absolute top-[35%] right-[5%] gift-float-2 hidden lg:block">
                <div class="w-32 h-28 bg-pink-200/40 rounded-lg border border-pink-300/30 relative">
                    <div class="absolute inset-x-0 top-0 h-6 bg-pink-300/30 rounded-t-lg"></div>
                    <div class="absolute top-0 left-1/2 -translate-x-1/2 w-px h-full bg-pink-300/30"></div>
                    <div class="absolute -top-4 left-1/2 -translate-x-1/2">
                        <div class="w-10 h-5 bg-yellow-200/60 rounded-t-full"></div>
                    </div>
                </div>
            </div>

            {{-- Small gift box - far right --}}
            <div class="absolute top-[15%] right-[3%] gift-float-3 hidden lg:block">
                <div class="w-14 h-12 bg-pink-100/50 rounded-md border border-pink-200/40 relative">
                    <div class="absolute inset-x-0 top-0 h-3 bg-pink-200/30 rounded-t-md"></div>
                    <div class="absolute -top-2 left-1/2 -translate-x-1/2 w-6 h-3 bg-yellow-200/50 rounded-t-full"></div>
                </div>
            </div>

            {{-- Clouds --}}
            <div class="absolute top-[30%] right-[25%] cloud-float hidden lg:block">
                <div class="flex gap-0">
                    <div class="w-16 h-8 bg-white/40 rounded-full"></div>
                    <div class="w-12 h-8 bg-white/30 rounded-full -ml-4 mt-1"></div>
                    <div class="w-10 h-6 bg-white/25 rounded-full -ml-3 mt-2"></div>
                </div>
            </div>
            <div class="absolute top-[50%] right-[30%] hidden lg:block" style="animation: cloudMove 15s ease-in-out infinite;">
                <div class="flex gap-0">
                    <div class="w-12 h-6 bg-white/30 rounded-full"></div>
                    <div class="w-8 h-5 bg-white/20 rounded-full -ml-3 mt-1"></div>
                </div>
            </div>

            {{-- Heart balloons --}}
            <div class="absolute bottom-[15%] right-[8%] gift-float-4 hidden lg:block">
                <div class="w-12 h-14 bg-pink-300/40 rounded-full relative" style="border-radius: 50% 50% 50% 50% / 40% 40% 60% 60%; transform: rotate(-45deg);">
                </div>
            </div>

            {{-- Small floating gift - bottom right --}}
            <div class="absolute bottom-[25%] right-[18%] gift-float-1 hidden lg:block">
                <div class="w-16 h-14 bg-pink-100/50 rounded-md border border-pink-200/40 relative">
                    <div class="absolute inset-x-0 top-0 h-3 bg-pink-200/30 rounded-t-md"></div>
                    <div class="absolute -top-3 left-1/2 -translate-x-1/2 w-8 h-4 bg-yellow-200/50 rounded-t-full"></div>
                </div>
            </div>

            {{-- Hot air balloon small - top center-right --}}
            <div class="absolute top-[5%] right-[35%] gift-float-3 hidden lg:block opacity-50">
                <div class="w-10 h-14 bg-pink-200/40 rounded-full"></div>
                <div class="w-px h-4 bg-pink-200/30 mx-auto"></div>
                <div class="w-6 h-4 bg-pink-100/40 rounded-sm mx-auto"></div>
            </div>

            {{-- Additional hot air balloon - bottom center --}}
            <div class="absolute bottom-[10%] right-[40%] gift-float-2 hidden lg:block opacity-40">
                <div class="w-8 h-12 bg-pink-300/30 rounded-full"></div>
                <div class="w-px h-3 bg-pink-200/30 mx-auto"></div>
                <div class="w-5 h-3 bg-pink-100/30 rounded-sm mx-auto"></div>
            </div>
        </div>

        {{-- Slide Content --}}
        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-full flex items-center" style="min-height: 600px; max-height: 700px;">
            <div class="w-full lg:w-[55%] xl:w-[50%] pt-24 sm:pt-28 pb-8">
                @foreach($slides as $index => $slide)
                    <div x-show="currentSlide === {{ $index }}"
                         x-transition:enter="transition ease-out duration-500"
                         x-transition:enter-start="opacity-0 translate-x-8"
                         x-transition:enter-end="opacity-100 translate-x-0"
                         x-transition:leave="transition ease-in duration-300"
                         x-transition:leave-start="opacity-100 translate-x-0"
                         x-transition:leave-end="opacity-0 -translate-x-8"
                         class="w-full"
                         @if($index > 0) x-cloak @endif>

                        {{-- Badges --}}
                        <div class="flex flex-wrap items-center gap-2 mb-6 sm:mb-8">
                            @if($slide->badge_1)
                            <span class="inline-flex items-center gap-2 px-4 py-1.5 bg-white/80 backdrop-blur-sm rounded-full text-xs font-semibold border border-pink-100">
                                <span class="w-2 h-2 bg-green-500 rounded-full"></span>
                                <span class="text-brand-pink tracking-wide">{{ $slide->badge_1 }}</span>
                            </span>
                            @endif
                            @if($slide->badge_2)
                            <span class="inline-flex items-center gap-1 px-3 py-1.5 bg-brand-pink rounded-full text-xs font-semibold text-white">
                                ✨ {{ $slide->badge_2 }}
                            </span>
                            @endif
                        </div>

                        {{-- Heading --}}
                        <h1 class="text-4xl sm:text-5xl lg:text-[3.5rem] xl:text-6xl font-bold text-gray-900 leading-[1.15] mb-5 sm:mb-6">
                            {{ $slide->heading_normal }}
                            <span class="text-brand-pink">{{ $slide->heading_highlight }}</span>
                            @if($slide->heading_emoji)
                            <span class="inline-block ml-1">{{ $slide->heading_emoji }}</span>
                            @endif
                        </h1>

                        {{-- Description --}}
                        <p class="text-gray-600 text-sm sm:text-base lg:text-[15px] max-w-lg leading-relaxed mb-6 sm:mb-8">
                            {{ $slide->description }}
                        </p>

                        {{-- CTA Buttons --}}
                        <div class="flex flex-wrap items-center gap-3 sm:gap-4 mb-8 sm:mb-10">
                            <a href="{{ $slide->btn_primary_link ?? '/gifts' }}"
                               class="inline-flex items-center gap-2 px-7 py-3.5 bg-brand-pink hover:bg-brand-pink-dark text-white rounded-full font-semibold text-sm transition-all shadow-lg shadow-pink-300/40 hover:shadow-pink-400/50 hover:-translate-y-0.5">
                                <span>✨</span>
                                {{ $slide->btn_primary_text ?? 'অর্ডার করুন' }}
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                </svg>
                            </a>
                            @if($slide->btn_secondary_text)
                            <a href="{{ $slide->btn_secondary_link ?? '#' }}"
                               class="inline-flex items-center gap-2 px-6 py-3.5 bg-white hover:bg-gray-50 text-gray-700 rounded-full font-semibold text-sm transition-all border border-gray-200 shadow-sm">
                                {{ $slide->btn_secondary_text }}
                            </a>
                            @endif
                        </div>

                        {{-- Stats --}}
                        <div class="flex flex-wrap items-center gap-3 sm:gap-5 text-xs sm:text-sm text-gray-500">
                            <span class="flex items-center gap-1.5">
                                <span class="w-2 h-2 bg-green-500 rounded-full"></span>
                                {{ $slide->stat_1 ?? '৫০০০+ সন্তুষ্ট গ্রাহক' }}
                            </span>
                            <span class="text-gray-300">|</span>
                            <span>{{ $slide->stat_2 ?? '৪০০০+ গিফট আইটেম' }}</span>
                            <span class="text-gray-300 hidden sm:inline">|</span>
                            <span class="hidden sm:inline">{{ $slide->stat_3 ?? '২৪/৭ কাস্টমার সাপোর্ট' }}</span>
                        </div>
                    </div>
                @endforeach

                {{-- Slider Dots --}}
                <div class="flex items-center gap-2 mt-8 sm:mt-10">
                    @foreach($slides as $index => $slide)
                        <button @click="goToSlide({{ $index }})"
                                :class="currentSlide === {{ $index }} ? 'bg-brand-pink w-8' : 'bg-pink-300/50 w-2.5'"
                                class="h-2.5 rounded-full transition-all duration-300 hover:bg-brand-pink/70">
                        </button>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    {{-- ==================== BRAND MARQUEE ==================== --}}
    <section class="bg-white border-y border-gray-100 py-4 overflow-hidden">
        <div class="flex brand-marquee whitespace-nowrap">
            @for($i = 0; $i < 2; $i++)
                <div class="flex items-center gap-8 px-4">
                    <span class="flex items-center gap-2 text-sm font-medium text-gray-400">
                        <span class="w-2 h-2 bg-red-400 rounded-full"></span> বিকাশ
                    </span>
                    <span class="flex items-center gap-2 text-sm font-medium text-gray-400">
                        <span class="w-2 h-2 bg-pink-400 rounded-full"></span> নগদ
                    </span>
                    <span class="flex items-center gap-2 text-sm font-medium text-gray-400">
                        <span class="w-2 h-2 bg-green-400 rounded-full"></span> উপায়
                    </span>
                    <span class="flex items-center gap-2 text-sm font-medium text-gray-400">
                        <span class="w-2 h-2 bg-blue-400 rounded-full"></span> রকেট
                    </span>
                    <span class="flex items-center gap-2 text-sm font-medium text-gray-400">
                        <span class="w-2 h-2 bg-green-500 rounded-full"></span> ক্যাশ অন ডেলিভারি
                    </span>
                    <span class="flex items-center gap-2 text-sm font-medium text-gray-400">
                        <span class="w-2 h-2 bg-purple-400 rounded-full"></span> ভিসা/মাস্টারকার্ড
                    </span>
                    <span class="flex items-center gap-2 text-sm font-medium text-gray-400">
                        <span class="w-2 h-2 bg-orange-400 rounded-full"></span> ট্যাপ
                    </span>
                    <span class="flex items-center gap-2 text-sm font-medium text-gray-400">
                        <span class="w-2 h-2 bg-teal-400 rounded-full"></span> শিওর ক্যাশ
                    </span>
                </div>
            @endfor
        </div>
    </section>

    {{-- ==================== PRODUCTS SECTION ==================== --}}
    <section class="py-12 sm:py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            {{-- Section Header --}}
            <div class="text-center mb-10">
                <span class="inline-block px-3 py-1 bg-pink-100 text-brand-pink text-xs font-semibold rounded-full mb-3">🎁 জনপ্রিয় গিফট</span>
                <h2 class="text-2xl sm:text-3xl font-bold text-gray-900">বেস্ট সেলিং গিফট কালেকশন</h2>
                <p class="text-gray-500 mt-2">আমাদের সেরা প্রোডাক্ট গুলো ঘুরে দেখুন</p>
            </div>

            {{-- Product Grid --}}
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4 sm:gap-6">
                @php
                    $products = [
                        ['name' => 'প্রিমিয়াম গিফট বক্স', 'price' => '১,২৯৯', 'old' => '১,৫৯৯', 'emoji' => '🎁', 'badge' => 'হট'],
                        ['name' => 'হ্যান্ড ব্যাগ কালেকশন', 'price' => '৮৯৯', 'old' => '১,১৯৯', 'emoji' => '👜', 'badge' => 'নতুন'],
                        ['name' => 'চকলেট গিফট সেট', 'price' => '৫৯৯', 'old' => '৭৯৯', 'emoji' => '🍫', 'badge' => 'সেল'],
                        ['name' => 'ফ্লাওয়ার বুকে', 'price' => '৯৯৯', 'old' => '১,২৯৯', 'emoji' => '💐', 'badge' => ''],
                        ['name' => 'কসমেটিক্স সেট', 'price' => '১,৪৯৯', 'old' => '১,৯৯৯', 'emoji' => '💄', 'badge' => 'ট্রেন্ডিং'],
                        ['name' => 'সিল্ক শাড়ি', 'price' => '২,৪৯৯', 'old' => '৩,১৯৯', 'emoji' => '👗', 'badge' => ''],
                        ['name' => 'টেডি বিয়ার', 'price' => '৬৯৯', 'old' => '৮৯৯', 'emoji' => '🧸', 'badge' => 'জনপ্রিয়'],
                        ['name' => 'কাতান শাড়ি', 'price' => '৩,৯৯৯', 'old' => '৪,৫৯৯', 'emoji' => '🥻', 'badge' => 'প্রিমিয়াম'],
                    ];
                @endphp

                @foreach($products as $product)
                    <div class="product-card group bg-white rounded-2xl border border-gray-100 hover:border-pink-200 hover:shadow-lg transition-all duration-300 overflow-hidden">
                        {{-- Product Image --}}
                        <div class="relative bg-gradient-to-br from-pink-50 to-pink-100/50 p-6 sm:p-8 aspect-square flex items-center justify-center overflow-hidden">
                            <span class="text-5xl sm:text-6xl product-img transition-transform duration-300">{{ $product['emoji'] }}</span>
                            @if($product['badge'])
                                <span class="absolute top-3 left-3 px-2 py-0.5 bg-brand-pink text-white text-[10px] font-bold rounded-lg">
                                    {{ $product['badge'] }}
                                </span>
                            @endif
                            {{-- Wishlist --}}
                            <button class="absolute top-3 right-3 w-8 h-8 bg-white/80 hover:bg-white rounded-full flex items-center justify-center shadow-sm opacity-0 group-hover:opacity-100 transition-opacity">
                                <svg class="w-4 h-4 text-gray-400 hover:text-red-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                </svg>
                            </button>
                        </div>
                        {{-- Product Info --}}
                        <div class="p-3 sm:p-4">
                            <h3 class="font-semibold text-gray-800 text-sm sm:text-base mb-1 truncate">{{ $product['name'] }}</h3>
                            <div class="flex items-center gap-2">
                                <span class="text-brand-pink font-bold text-sm sm:text-base">৳{{ $product['price'] }}</span>
                                <span class="text-gray-400 text-xs line-through">৳{{ $product['old'] }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- View All Button --}}
            <div class="text-center mt-10">
                <a href="/gifts"
                   class="inline-flex items-center gap-2 px-8 py-3 bg-pink-50 hover:bg-pink-100 text-brand-pink rounded-xl font-semibold transition-colors border border-pink-200">
                    সকল গিফট দেখুন
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </a>
            </div>
        </div>
    </section>

    {{-- ==================== FEATURES SECTION ==================== --}}
    <section class="py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="flex items-center gap-4 bg-white p-5 rounded-2xl shadow-sm">
                    <div class="w-12 h-12 bg-pink-100 rounded-xl flex items-center justify-center shrink-0">
                        <span class="text-xl">🚚</span>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-800 text-sm">ফ্রি ডেলিভারি</h3>
                        <p class="text-xs text-gray-400">৳২৫০০+ অর্ডারে</p>
                    </div>
                </div>
                <div class="flex items-center gap-4 bg-white p-5 rounded-2xl shadow-sm">
                    <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center shrink-0">
                        <span class="text-xl">🔒</span>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-800 text-sm">সিকিউর পেমেন্ট</h3>
                        <p class="text-xs text-gray-400">১০০% নিরাপদ</p>
                    </div>
                </div>
                <div class="flex items-center gap-4 bg-white p-5 rounded-2xl shadow-sm">
                    <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center shrink-0">
                        <span class="text-xl">🎀</span>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-800 text-sm">গিফট র্যাপিং</h3>
                        <p class="text-xs text-gray-400">ফ্রি গিফট র্যাপ</p>
                    </div>
                </div>
                <div class="flex items-center gap-4 bg-white p-5 rounded-2xl shadow-sm">
                    <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center shrink-0">
                        <span class="text-xl">💬</span>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-800 text-sm">২৪/৭ সাপোর্ট</h3>
                        <p class="text-xs text-gray-400">সবসময় পাশে আছি</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('footer')
    {{-- ==================== FOOTER ==================== --}}
    <footer class="bg-gray-900 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                {{-- Brand --}}
                <div>
                    <div class="flex items-center gap-1 mb-4">
                        <span class="text-3xl font-bold text-brand-pink">উপহার</span>
                        <span class="shop-badge">S<br>H<br>O<br>P</span>
                    </div>
                    <p class="text-gray-400 text-sm leading-relaxed">
                        আপনার প্রিয়জনকে সারপ্রাইজ দিন আমাদের বিশেষ গিফট কালেকশন থেকে।
                    </p>
                </div>

                {{-- Quick Links --}}
                <div>
                    <h3 class="font-semibold text-white mb-4">দ্রুত লিংক</h3>
                    <ul class="space-y-2 text-sm text-gray-400">
                        <li><a href="/" class="hover:text-brand-pink transition-colors">হোম</a></li>
                        <li><a href="/gifts" class="hover:text-brand-pink transition-colors">সকল গিফট</a></li>
                        <li><a href="/contact" class="hover:text-brand-pink transition-colors">যোগাযোগ</a></li>
                    </ul>
                </div>

                {{-- Support --}}
                <div>
                    <h3 class="font-semibold text-white mb-4">সহায়তা</h3>
                    <ul class="space-y-2 text-sm text-gray-400">
                        <li><a href="#" class="hover:text-brand-pink transition-colors">গোপনীয়তা নীতি</a></li>
                        <li><a href="#" class="hover:text-brand-pink transition-colors">রিটার্ন পলিসি</a></li>
                        <li><a href="#" class="hover:text-brand-pink transition-colors">শর্তাবলী</a></li>
                    </ul>
                </div>

                {{-- Contact --}}
                <div>
                    <h3 class="font-semibold text-white mb-4">যোগাযোগ</h3>
                    <ul class="space-y-2 text-sm text-gray-400">
                        <li class="flex items-center gap-2">
                            <span>📞</span> ০১XXXXXXXXX
                        </li>
                        <li class="flex items-center gap-2">
                            <span>📧</span> info&#64;upoharshop.com
                        </li>
                        <li class="flex items-center gap-2">
                            <span>📍</span> ঢাকা, বাংলাদেশ
                        </li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-gray-800 mt-10 pt-6 text-center text-sm text-gray-500">
                <p>&copy; {{ date('Y') }} উপহার Shop। সকল স্বত্ব সংরক্ষিত।</p>
            </div>
        </div>
    </footer>
@endsection
