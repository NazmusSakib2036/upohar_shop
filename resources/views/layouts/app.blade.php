<!DOCTYPE html>
<html lang="bn" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'উপহার Shop - গিফট শপ')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        'bangla': ['Hind Siliguri', 'sans-serif'],
                    },
                    colors: {
                        'brand-pink': '#E91E63',
                        'brand-pink-light': '#FCE4EC',
                        'brand-pink-dark': '#C2185B',
                        'brand-rose': '#F8BBD0',
                    }
                }
            }
        }
    </script>

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        body { font-family: 'Hind Siliguri', sans-serif; }

        /* Header gradient */
        .header-gradient {
            background: linear-gradient(135deg, #fce4ec 0%, #f8bbd0 30%, #fce4ec 60%, #fff0f3 100%);
        }

        /* Sidebar overlay */
        .sidebar-overlay {
            background: rgba(0,0,0,0.4);
            backdrop-filter: blur(2px);
        }

        /* Search modal backdrop */
        .search-backdrop {
            background: rgba(0,0,0,0.5);
            backdrop-filter: blur(8px);
        }

        /* Smooth transitions */
        .slide-left-enter { transform: translateX(-100%); }
        .slide-left-leave { transform: translateX(-100%); }
        .slide-right-enter { transform: translateX(100%); }
        .slide-right-leave { transform: translateX(100%); }

        /* Scrollbar hide */
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }

        /* Logo style */
        .logo-text {
            background: linear-gradient(135deg, #E91E63, #C2185B);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .shop-badge {
            writing-mode: vertical-rl;
            text-orientation: mixed;
            background: linear-gradient(180deg, #E91E63, #C2185B);
            color: white;
            font-size: 7px;
            font-weight: 700;
            letter-spacing: 2px;
            padding: 3px 2px;
            border-radius: 2px;
            line-height: 1;
        }
    </style>
    @yield('styles')
</head>
<body class="font-bangla bg-pink-50/30 text-gray-800 min-h-screen" x-data="{
    menuOpen: false,
    searchOpen: false,
    cartOpen: false,
    cartItems: [],
    cartCount: 0
}">

    {{-- ==================== HEADER (Floating Popup Sticky) ==================== --}}
    <div class="fixed top-0 left-0 right-0 z-50 px-4 sm:px-6 lg:px-10 pt-3 sm:pt-4">
        <header class="max-w-7xl mx-auto rounded-2xl bg-white/70 backdrop-blur-md shadow-lg shadow-pink-200/30 border border-white/80">
            <div class="px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between h-14 sm:h-16">
                    {{-- Logo --}}
                    <a href="/" class="flex items-center gap-0.5 shrink-0">
                        <span class="text-2xl sm:text-3xl font-bold logo-text leading-none">উপহার</span>
                        <span class="shop-badge mt-0.5">S<br>H<br>O<br>P</span>
                    </a>

                    {{-- Right Side Actions --}}
                    <div class="flex items-center gap-1.5 sm:gap-2">
                        {{-- Hamburger Menu --}}
                        <button @click="menuOpen = true"
                                class="w-9 h-9 sm:w-10 sm:h-10 flex items-center justify-center rounded-lg bg-white/80 hover:bg-white shadow-sm border border-white/90 transition-all duration-200">
                            <svg class="w-[18px] h-[18px] text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                            </svg>
                        </button>

                        {{-- Search --}}
                        <button @click="searchOpen = true"
                                class="w-9 h-9 sm:w-10 sm:h-10 flex items-center justify-center rounded-lg bg-white/80 hover:bg-white shadow-sm border border-white/90 transition-all duration-200">
                            <svg class="w-[18px] h-[18px] text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </button>

                        {{-- Cart --}}
                        <button @click="cartOpen = true"
                                class="w-9 h-9 sm:w-10 sm:h-10 flex items-center justify-center rounded-lg bg-white/80 hover:bg-white shadow-sm border border-white/90 transition-all duration-200 relative">
                            <svg class="w-[18px] h-[18px] text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                            </svg>
                            <span class="absolute -top-1 -right-1 w-4 h-4 bg-brand-pink text-white text-[9px] font-bold rounded-full flex items-center justify-center"
                                  x-text="cartCount || '1'">1</span>
                        </button>

                        {{-- Guest Login Button --}}
                        <a href="/login"
                           class="flex items-center gap-2 px-3 py-1.5 sm:px-4 sm:py-2 bg-white hover:bg-gray-50 rounded-lg shadow-sm border border-gray-200 transition-all duration-200 ml-1">
                            <svg class="w-4 h-4 text-brand-pink" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                            <div class="text-left leading-tight">
                                <span class="text-[10px] font-bold text-brand-pink block tracking-wide">GUEST</span>
                                <span class="text-[10px] font-medium text-gray-500">লগইন</span>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </header>
    </div>

    {{-- ==================== SIDE NAVIGATION MENU ==================== --}}
    <div x-show="menuOpen" x-cloak class="fixed inset-0 z-[60]" @keydown.escape.window="menuOpen = false">
        {{-- Overlay --}}
        <div class="sidebar-overlay absolute inset-0"
             x-show="menuOpen"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             @click="menuOpen = false"></div>

        {{-- Menu Panel --}}
        <div class="absolute inset-y-0 left-0 w-[320px] max-w-[85vw] bg-gray-50 shadow-2xl flex flex-col"
             x-show="menuOpen"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="-translate-x-full"
             x-transition:enter-end="translate-x-0"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="translate-x-0"
             x-transition:leave-end="-translate-x-full">

            {{-- Menu Header --}}
            <div class="flex items-center justify-between p-5 border-b border-gray-100">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-pink-100 rounded-xl flex items-center justify-center">
                        <svg class="w-5 h-5 text-brand-pink" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                    </div>
                    <div>
                        <h2 class="font-bold text-gray-800 text-lg leading-tight">মেনু এক্সপ্লোর</h2>
                        <p class="text-[11px] text-gray-400 font-medium tracking-wider uppercase">Navigation Guide</p>
                    </div>
                </div>
                <button @click="menuOpen = false"
                        class="w-9 h-9 bg-gray-200 hover:bg-gray-300 rounded-full flex items-center justify-center transition-colors">
                    <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            {{-- Menu Items --}}
            <div class="flex-1 overflow-y-auto no-scrollbar p-4 space-y-3">
                {{-- Home --}}
                <a href="/" @click="menuOpen = false"
                   class="flex items-center gap-4 p-4 bg-white rounded-2xl shadow-sm hover:shadow-md transition-all duration-200 group">
                    <div class="w-10 h-10 bg-gray-100 rounded-xl flex items-center justify-center group-hover:bg-pink-50 transition-colors">
                        <svg class="w-5 h-5 text-gray-500 group-hover:text-brand-pink transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <h3 class="font-semibold text-gray-800 group-hover:text-brand-pink transition-colors">হোম</h3>
                        <p class="text-xs text-gray-400">সাইটে প্রধান পাতায় ফিরে যান</p>
                    </div>
                    <svg class="w-4 h-4 text-gray-300 group-hover:text-brand-pink transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>

                {{-- All Gifts --}}
                <a href="/gifts" @click="menuOpen = false"
                   class="flex items-center gap-4 p-4 bg-white rounded-2xl shadow-sm hover:shadow-md transition-all duration-200 group border border-pink-100">
                    <div class="w-10 h-10 bg-brand-pink rounded-xl flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7"/>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <h3 class="font-semibold text-brand-pink">সকল গিফট</h3>
                        <p class="text-xs text-gray-400">বিশেষ গিফট বক্স কালেকশন</p>
                    </div>
                    <svg class="w-4 h-4 text-brand-pink" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>

                {{-- Contact --}}
                <a href="/contact" @click="menuOpen = false"
                   class="flex items-center gap-4 p-4 bg-white rounded-2xl shadow-sm hover:shadow-md transition-all duration-200 group">
                    <div class="w-10 h-10 bg-gray-100 rounded-xl flex items-center justify-center group-hover:bg-pink-50 transition-colors">
                        <svg class="w-5 h-5 text-gray-500 group-hover:text-brand-pink transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <h3 class="font-semibold text-gray-800 group-hover:text-brand-pink transition-colors">যোগাযোগ</h3>
                        <p class="text-xs text-gray-400">সরাসরি আমাদের সাথে কথা বলুন</p>
                    </div>
                    <svg class="w-4 h-4 text-gray-300 group-hover:text-brand-pink transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            </div>

            {{-- WhatsApp Chat Button --}}
            <div class="p-4 border-t border-gray-100">
                <a href="https://wa.me/8801XXXXXXXXX" target="_blank" rel="noopener noreferrer"
                   class="flex items-center justify-center gap-3 w-full py-3.5 bg-brand-pink hover:bg-brand-pink-dark text-white rounded-2xl font-semibold transition-colors shadow-lg shadow-pink-200">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                    </svg>
                    <span>হোয়াটসঅ্যাপ চ্যাট</span>
                </a>
                <p class="text-center text-xs text-gray-400 mt-2">২৪/৭ কাস্টমার সাপোর্ট</p>
            </div>
        </div>
    </div>

    {{-- ==================== SEARCH MODAL ==================== --}}
    <div x-show="searchOpen" x-cloak class="fixed inset-0 z-[60]" @keydown.escape.window="searchOpen = false">
        {{-- Backdrop --}}
        <div class="search-backdrop absolute inset-0"
             x-show="searchOpen"
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             @click="searchOpen = false"></div>

        {{-- Search Box --}}
        <div class="absolute top-20 left-1/2 -translate-x-1/2 w-[90%] max-w-xl"
             x-show="searchOpen"
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 -translate-y-4"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100 translate-y-0"
             x-transition:leave-end="opacity-0 -translate-y-4">
            <div class="bg-white rounded-2xl shadow-2xl overflow-hidden">
                {{-- Search Input --}}
                <div class="flex items-center gap-3 px-5 py-4 border-b border-gray-100">
                    <svg class="w-5 h-5 text-gray-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    <input type="text"
                           placeholder="উপহার খুজুন..."
                           class="flex-1 text-base outline-none bg-transparent placeholder-gray-400"
                           x-ref="searchInput"
                           x-init="$watch('searchOpen', value => { if(value) setTimeout(() => $refs.searchInput.focus(), 100) })">
                    <button @click="searchOpen = false" class="text-gray-400 hover:text-gray-600 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>

                {{-- Category Tags --}}
                <div class="p-5">
                    <p class="text-sm text-gray-500 text-center mb-4">ক্যাটাগরি</p>
                    <div class="flex flex-wrap justify-center gap-2">
                        <a href="#" class="px-4 py-2 bg-gray-100 hover:bg-pink-100 hover:text-brand-pink rounded-full text-sm transition-colors">হ্যান্ড ব্যাগ</a>
                        <a href="#" class="px-4 py-2 bg-gray-100 hover:bg-pink-100 hover:text-brand-pink rounded-full text-sm transition-colors">কসমেটিক্স</a>
                        <a href="#" class="px-4 py-2 bg-gray-100 hover:bg-pink-100 hover:text-brand-pink rounded-full text-sm transition-colors">কাঞ্জি কাতান শাড়ি</a>
                        <a href="#" class="px-4 py-2 bg-gray-100 hover:bg-pink-100 hover:text-brand-pink rounded-full text-sm transition-colors">ডেইরি মিল্ক চকলেট</a>
                        <a href="#" class="px-4 py-2 bg-gray-100 hover:bg-pink-100 hover:text-brand-pink rounded-full text-sm transition-colors">কাতান শাড়ি</a>
                        <a href="#" class="px-4 py-2 bg-gray-100 hover:bg-pink-100 hover:text-brand-pink rounded-full text-sm transition-colors">সিল্ক শাড়ি</a>
                        <a href="#" class="px-4 py-2 bg-gray-100 hover:bg-pink-100 hover:text-brand-pink rounded-full text-sm transition-colors">সুতি শাড়ি</a>
                        <a href="#" class="px-4 py-2 bg-gray-100 hover:bg-pink-100 hover:text-brand-pink rounded-full text-sm transition-colors">স্মৃতি জামদানি শাড়ি</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ==================== CART SIDEBAR ==================== --}}
    <div x-show="cartOpen" x-cloak class="fixed inset-0 z-[60]" @keydown.escape.window="cartOpen = false">
        {{-- Overlay --}}
        <div class="sidebar-overlay absolute inset-0"
             x-show="cartOpen"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             @click="cartOpen = false"></div>

        {{-- Cart Panel --}}
        <div class="absolute inset-y-0 right-0 w-[380px] max-w-[90vw] bg-white shadow-2xl flex flex-col"
             x-show="cartOpen"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="translate-x-full"
             x-transition:enter-end="translate-x-0"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="translate-x-0"
             x-transition:leave-end="translate-x-full">

            {{-- Cart Header --}}
            <div class="flex items-center justify-between p-5 border-b border-gray-100">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-brand-pink rounded-xl flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                    </div>
                    <div>
                        <h2 class="font-bold text-gray-800 text-lg leading-tight">আপনার কার্ট</h2>
                        <p class="text-xs text-gray-400"><span x-text="cartCount">0</span> টি প্রোডাক্ট</p>
                    </div>
                </div>
                <button @click="cartOpen = false"
                        class="w-9 h-9 bg-pink-100 hover:bg-pink-200 rounded-full flex items-center justify-center transition-colors">
                    <svg class="w-4 h-4 text-brand-pink" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            {{-- Free Delivery Banner --}}
            <div class="mx-4 mt-4 px-4 py-3 bg-pink-50 rounded-xl flex items-center gap-2 text-sm">
                <svg class="w-5 h-5 text-brand-pink shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <span class="text-gray-600">আর <span class="font-bold text-brand-pink">৳2500</span> অর্ডার করলে ফ্রি ডেলিভারি</span>
            </div>

            {{-- Cart Content --}}
            <div class="flex-1 flex flex-col items-center justify-center p-8">
                {{-- Empty Cart State --}}
                <div x-show="cartCount === 0" class="text-center">
                    <div class="w-20 h-20 bg-pink-50 rounded-2xl flex items-center justify-center mx-auto mb-4">
                        <svg class="w-10 h-10 text-brand-pink" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-700 mb-1">কার্ট খালি আছে</h3>
                    <p class="text-sm text-gray-400 mb-6">সুন্দর গিফট দেখতে শুরু করুন</p>
                    <a href="/gifts" @click="cartOpen = false"
                       class="inline-flex items-center px-6 py-3 bg-brand-pink hover:bg-brand-pink-dark text-white rounded-xl font-semibold transition-colors shadow-lg shadow-pink-200">
                        গিফট দেখুন
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- ==================== MAIN CONTENT ==================== --}}
    <main>
        @yield('content')
    </main>

    {{-- ==================== FOOTER ==================== --}}
    @yield('footer')

    <style>
        [x-cloak] { display: none !important; }
    </style>
</body>
</html>
