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

    {{-- ==================== CATEGORY SCROLLING BAR ==================== --}}
    <section class="bg-white border-y border-gray-100 py-4 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="category-scroll flex gap-3 overflow-x-auto pb-1" x-data="{}" x-ref="catScroll">
                @if(isset($categories) && $categories->count())
                    @foreach($categories as $cat)
                        <a href="{{ route('category.show', $cat->slug) }}"
                           class="flex items-center gap-2 px-5 py-2.5 rounded-full border border-gray-100 bg-white hover:shadow-md transition-all whitespace-nowrap shrink-0 group"
                           style="background: linear-gradient(135deg, {{ $cat->bg_color }}20, white);">
                            <span class="w-7 h-7 rounded-full flex items-center justify-center text-white text-xs font-bold shrink-0"
                                  style="background: {{ $cat->icon_color }};">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
                            </span>
                            <span class="text-sm font-semibold text-gray-700 group-hover:text-brand-pink transition-colors">{{ $cat->name }}</span>
                        </a>
                    @endforeach
                @else
                    @php
                        $defaultCats = ['সেন্টি','ফুল মালা','বাবি চুড়ি','বেনারসি','ভেনাস চুড়ি','শাখা চুড়ি','সারপ্রাইজ গিফট','সিন্দু শাড়ি','সুতার চুড়ি','সুতার মালা'];
                        $catColors = ['#4CAF50','#E91E63','#FF9800','#E91E63','#9C27B0','#009688','#FF9800','#607D8B','#FF9800','#E91E63'];
                        $catBgs = ['#E8F5E9','#FCE4EC','#FFF3E0','#FCE4EC','#F3E5F5','#E0F2F1','#FFF3E0','#ECEFF1','#FFF3E0','#FCE4EC'];
                    @endphp
                    @foreach($defaultCats as $i => $catName)
                        <span class="flex items-center gap-2 px-5 py-2.5 rounded-full border border-gray-100 bg-white whitespace-nowrap shrink-0"
                              style="background: linear-gradient(135deg, {{ $catBgs[$i] }}80, white);">
                            <span class="w-7 h-7 rounded-full flex items-center justify-center text-white text-xs font-bold shrink-0"
                                  style="background: {{ $catColors[$i] }};">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
                            </span>
                            <span class="text-sm font-semibold text-gray-700">{{ $catName }}</span>
                        </span>
                    @endforeach
                @endif
            </div>
        </div>
    </section>

    {{-- ==================== FEATURED PRODUCTS SECTION ==================== --}}
    <section class="py-10 sm:py-14 bg-white" x-data="productSection()">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-8">
                <span class="inline-block px-3 py-1 bg-pink-100 text-brand-pink text-xs font-semibold rounded-full mb-3">🎁 জনপ্রিয় গিফট</span>
                <h2 class="text-2xl sm:text-3xl font-bold text-gray-900">বেস্ট সেলিং গিফট কালেকশন</h2>
                <p class="text-gray-500 mt-2">আমাদের সেরা প্রোডাক্ট গুলো ঘুরে দেখুন</p>
            </div>

            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4 sm:gap-5">
                @forelse($featuredProducts as $product)
                    @include('partials.product-card', ['product' => $product])
                @empty
                    <div class="col-span-full text-center py-12 text-gray-400">
                        <p class="text-lg">এখনো কোনো প্রোডাক্ট যোগ করা হয়নি</p>
                        <p class="text-sm mt-1">অ্যাডমিন প্যানেল থেকে প্রোডাক্ট যোগ করুন</p>
                    </div>
                @endforelse
            </div>

            @if($featuredProducts->count() >= 8)
            <div class="text-center mt-8">
                <a href="{{ route('gifts') }}"
                   class="inline-flex items-center gap-2 px-8 py-3 bg-pink-50 hover:bg-pink-100 text-brand-pink rounded-xl font-semibold transition-colors border border-pink-200">
                    সকল গিফট দেখুন
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </a>
            </div>
            @endif
        </div>

        {{-- ==================== LATEST PRODUCTS ==================== --}}
        @if($latestProducts->count())
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-14">
            <div class="text-center mb-8">
                <span class="inline-block px-3 py-1 bg-green-100 text-green-600 text-xs font-semibold rounded-full mb-3">✨ নতুন আইটেম</span>
                <h2 class="text-2xl sm:text-3xl font-bold text-gray-900">নতুন প্রোডাক্ট সমূহ</h2>
            </div>
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4 sm:gap-5">
                @foreach($latestProducts as $product)
                    @include('partials.product-card', ['product' => $product])
                @endforeach
            </div>
        </div>
        @endif

        {{-- ==================== QUICK VIEW MODAL ==================== --}}
        <div x-show="quickViewOpen" x-cloak
             class="fixed inset-0 z-[100] flex items-center justify-center p-4"
             @keydown.escape.window="quickViewOpen = false">
            {{-- Backdrop --}}
            <div class="absolute inset-0 bg-black/60 backdrop-blur-sm" @click="quickViewOpen = false"></div>
            {{-- Modal --}}
            <div class="relative bg-white rounded-2xl shadow-2xl max-w-3xl w-full max-h-[90vh] overflow-y-auto z-10"
                 x-show="quickViewOpen"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 scale-95"
                 x-transition:enter-end="opacity-100 scale-100"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100 scale-100"
                 x-transition:leave-end="opacity-0 scale-95">
                {{-- Close button --}}
                <button @click="quickViewOpen = false" class="absolute top-4 right-4 z-20 w-8 h-8 bg-gray-100 hover:bg-gray-200 rounded-full flex items-center justify-center">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-0">
                    {{-- Left: Image --}}
                    <div class="relative bg-gray-50 p-6 flex flex-col">
                        <template x-if="qvProduct.category">
                            <span class="absolute top-4 left-4 z-10 px-3 py-1 bg-yellow-400 text-gray-900 text-xs font-bold rounded-md" x-text="qvProduct.category"></span>
                        </template>
                        <div class="flex-1 flex items-center justify-center min-h-[300px]">
                            <img :src="qvSelectedImage || qvProduct.image || '/images/placeholder.png'" class="max-w-full max-h-[350px] object-contain rounded-lg" alt="">
                        </div>
                        {{-- Thumbnails --}}
                        <div class="flex gap-2 mt-4 justify-center" x-show="qvProduct.gallery && qvProduct.gallery.length > 0">
                            <button @click="qvSelectedImage = qvProduct.image"
                                    :class="qvSelectedImage === qvProduct.image || (!qvSelectedImage && true) ? 'border-brand-pink' : 'border-gray-200'"
                                    class="w-14 h-14 rounded-lg border-2 overflow-hidden">
                                <img :src="qvProduct.image" class="w-full h-full object-cover">
                            </button>
                            <template x-for="(img, idx) in qvProduct.gallery" :key="idx">
                                <button @click="qvSelectedImage = img"
                                        :class="qvSelectedImage === img ? 'border-brand-pink' : 'border-gray-200'"
                                        class="w-14 h-14 rounded-lg border-2 overflow-hidden">
                                    <img :src="img" class="w-full h-full object-cover">
                                </button>
                            </template>
                        </div>
                        <button class="absolute bottom-6 right-6 w-10 h-10 bg-white rounded-full shadow-md flex items-center justify-center hover:bg-pink-50">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                        </button>
                    </div>

                    {{-- Right: Details --}}
                    <div class="p-6 sm:p-8 flex flex-col justify-center">
                        <h2 class="text-2xl font-bold text-gray-900 mb-1" x-text="qvProduct.name"></h2>
                        <p class="text-sm text-gray-400 mb-1">প্রাইস</p>
                        <p class="text-2xl font-bold text-brand-pink mb-5">৳<span x-text="Number(qvProduct.price).toLocaleString('bn-BD')"></span></p>

                        {{-- Quantity + Cart + WhatsApp --}}
                        <div class="flex items-center gap-3 mb-3">
                            <div class="flex items-center border border-gray-200 rounded-lg">
                                <button @click="qvQty = Math.max(1, qvQty - 1)" class="w-10 h-10 flex items-center justify-center text-gray-500 hover:bg-gray-50">−</button>
                                <span class="w-10 h-10 flex items-center justify-center font-semibold text-gray-700 border-x border-gray-200" x-text="qvQty"></span>
                                <button @click="qvQty++" class="w-10 h-10 flex items-center justify-center text-gray-500 hover:bg-gray-50">+</button>
                            </div>
                            <button @click="addToCart(qvProduct, qvQty)" class="w-10 h-10 border border-gray-200 rounded-lg flex items-center justify-center hover:bg-pink-50">
                                <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 100 4 2 2 0 000-4z"/></svg>
                            </button>
                            <a :href="'https://wa.me/880XXXXXXXXXX?text=' + encodeURIComponent('আমি অর্ডার করতে চাই: ' + qvProduct.name + ' - ৳' + qvProduct.price)"
                               target="_blank"
                               class="flex-1 flex items-center justify-center gap-2 px-4 py-2.5 bg-green-500 hover:bg-green-600 text-white rounded-lg font-semibold text-sm transition-colors">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/><path d="M12 0C5.373 0 0 5.373 0 12c0 2.625.846 5.059 2.284 7.034L.789 23.492a.5.5 0 00.612.638l4.648-1.218A11.94 11.94 0 0012 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 22c-2.244 0-4.322-.725-6.013-1.955l-.42-.312-3.088.809.824-3.01-.343-.545A9.963 9.963 0 012 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10z"/></svg>
                                হোয়াটসঅ্যাপ অর্ডার
                            </a>
                        </div>

                        {{-- Order Button --}}
                        <button @click="addToCart(qvProduct, qvQty); quickViewOpen = false; window.dispatchEvent(new CustomEvent('open-cart'))"
                                class="w-full flex items-center justify-center gap-2 px-6 py-3 bg-gray-900 hover:bg-gray-800 text-white rounded-lg font-semibold text-sm transition-colors mb-5">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 100 4 2 2 0 000-4z"/></svg>
                            অর্ডার করুন
                        </button>

                        {{-- Badges --}}
                        <div class="flex items-center gap-4 text-xs text-gray-500 mb-3">
                            <span class="flex items-center gap-1.5">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a2 2 0 104 0m-4 0a2 2 0 114 0"/></svg>
                                ফাস্ট ডেলিভারি
                            </span>
                            <span class="flex items-center gap-1.5">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                অরিজিনাল পণ্য
                            </span>
                        </div>

                        {{-- Stock status --}}
                        <div class="flex items-center gap-2 text-sm mb-5">
                            <template x-if="qvProduct.stock > 0">
                                <span class="flex items-center gap-1.5 text-green-600">
                                    <span class="w-2 h-2 bg-green-500 rounded-full"></span>
                                    স্টক আছে
                                </span>
                            </template>
                            <template x-if="qvProduct.stock <= 0">
                                <span class="flex items-center gap-1.5 text-red-500 font-semibold">
                                    স্টক নেই
                                </span>
                            </template>
                        </div>

                        {{-- Full Details Link --}}
                        <a :href="window.baseUrl + '/product/' + qvProduct.slug"
                           class="flex items-center justify-center gap-2 text-sm text-gray-500 hover:text-brand-pink transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                            সম্পূর্ণ বিবরণ দেখুন
                        </a>
                    </div>
                </div>
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

@section('scripts')
<script>
function productSection() {
    return {
        quickViewOpen: false,
        qvProduct: {},
        qvSelectedImage: null,
        qvQty: 1,

        async openQuickView(productId) {
            this.qvQty = 1;
            this.qvSelectedImage = null;
            try {
                const res = await fetch(window.baseUrl + '/product/' + productId + '/quick-view');
                this.qvProduct = await res.json();
                this.qvSelectedImage = this.qvProduct.image;
                this.quickViewOpen = true;
            } catch(e) {
                console.error('Quick view error:', e);
            }
        },

        addToCart(product, qty = 1) {
            let cart = JSON.parse(localStorage.getItem('upohar_cart') || '[]');
            const existing = cart.findIndex(i => i.id === product.id);
            if (existing >= 0) {
                cart[existing].qty += qty;
            } else {
                cart.push({
                    id: product.id,
                    name: product.name,
                    price: product.price,
                    image: product.image,
                    slug: product.slug,
                    qty: qty,
                });
            }
            localStorage.setItem('upohar_cart', JSON.stringify(cart));
            window.dispatchEvent(new CustomEvent('cart-updated'));
        },

        addToCartById(productId) {
            fetch(window.baseUrl + '/product/' + productId + '/quick-view')
                .then(res => res.json())
                .then(product => {
                    this.addToCart(product, 1);
                    window.dispatchEvent(new CustomEvent('open-cart'));
                });
        }
    }
}
</script>
@endsection
