<!DOCTYPE html>
<html lang="bn" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>লগইন - উপহার Shop</title>

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
                    }
                }
            }
        }
    </script>

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        body { font-family: 'Hind Siliguri', sans-serif; }
        .logo-text {
            background: linear-gradient(135deg, #E91E63, #ff6b9d);
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
        .left-panel-bg {
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f0f23 100%);
        }
        .left-panel-bg::before {
            content: '';
            position: absolute;
            top: 20%;
            left: -10%;
            width: 300px;
            height: 300px;
            background: radial-gradient(circle, rgba(233,30,99,0.15) 0%, transparent 70%);
            border-radius: 50%;
        }
        .left-panel-bg::after {
            content: '';
            position: absolute;
            bottom: 10%;
            right: -5%;
            width: 250px;
            height: 250px;
            background: radial-gradient(circle, rgba(233,30,99,0.1) 0%, transparent 70%);
            border-radius: 50%;
        }
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="font-bangla bg-gray-50 min-h-screen" x-data="{ showPassword: false, loginMethod: 'phone' }">

    <div class="min-h-screen flex flex-col lg:flex-row">
        {{-- ==================== LEFT PANEL (Branding) ==================== --}}
        <div class="left-panel-bg relative overflow-hidden lg:w-[55%] xl:w-[50%] hidden lg:flex flex-col justify-between p-12 xl:p-16">
            {{-- Close / Back --}}
            <div>
                <a href="/" class="flex items-center gap-1">
                    <span class="text-3xl font-bold logo-text">উপহার</span>
                    <span class="shop-badge">S<br>H<br>O<br>P</span>
                </a>
            </div>

            {{-- Main Content --}}
            <div class="relative z-10 max-w-lg">
                <h1 class="text-4xl xl:text-5xl font-bold text-white leading-tight mb-4">
                    ম্যাজিক্যাল শপিং
                    <span class="text-brand-pink">অভিজ্ঞতা</span><br>
                    শুরু হোক এখান থেকেই।
                </h1>
                <p class="text-gray-400 text-base leading-relaxed">
                    আপনার প্রিয়জনের জন্য সেরা গিফট খুঁজে পেতে আজই লগইন করুন
                    আমাদের প্রিমিয়াম পোর্টালে।
                </p>
            </div>

            {{-- Bottom Stats --}}
            <div class="relative z-10 flex items-center gap-4">
                <div class="flex -space-x-2">
                    <span class="w-8 h-8 rounded-full bg-brand-pink text-white text-xs font-bold flex items-center justify-center border-2 border-gray-900">A</span>
                    <span class="w-8 h-8 rounded-full bg-blue-500 text-white text-xs font-bold flex items-center justify-center border-2 border-gray-900">B</span>
                    <span class="w-8 h-8 rounded-full bg-green-500 text-white text-xs font-bold flex items-center justify-center border-2 border-gray-900">C</span>
                    <span class="w-8 h-8 rounded-full bg-yellow-500 text-white text-xs font-bold flex items-center justify-center border-2 border-gray-900">D</span>
                </div>
                <span class="text-gray-400 text-sm">
                    <span class="text-white font-semibold">৫০০০+</span> কাস্টমার আমাদের সাথে আছে
                </span>
            </div>
        </div>

        {{-- ==================== RIGHT PANEL (Login Form) ==================== --}}
        <div class="flex-1 flex flex-col min-h-screen lg:min-h-0">
            {{-- Mobile Close Button --}}
            <div class="flex justify-end p-4 lg:p-6">
                <a href="/"
                   class="w-10 h-10 bg-gray-100 hover:bg-gray-200 rounded-full flex items-center justify-center transition-colors">
                    <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </a>
            </div>

            {{-- Form Container --}}
            <div class="flex-1 flex items-center justify-center px-6 pb-8 sm:px-12">
                <div class="w-full max-w-md">
                    {{-- Header --}}
                    <div class="mb-8">
                        <h2 class="text-3xl font-bold text-gray-900 mb-1">স্বাগতম!</h2>
                        <p class="text-sm text-gray-400 uppercase tracking-wider font-medium">Login to your account</p>
                    </div>

                    {{-- Login Method Toggle --}}
                    <div class="flex items-center justify-between mb-6">
                        <label class="text-sm font-medium text-gray-700">
                            <span x-show="loginMethod === 'phone'">ফোন নম্বর</span>
                            <span x-show="loginMethod === 'email'" x-cloak>ইমেইল</span>
                        </label>
                        <button @click="loginMethod = loginMethod === 'phone' ? 'email' : 'phone'"
                                class="text-sm text-brand-pink hover:text-brand-pink-dark font-medium transition-colors">
                            <span x-show="loginMethod === 'phone'">ইমেইল দিয়ে লগইন করুন</span>
                            <span x-show="loginMethod === 'email'" x-cloak>ফোন দিয়ে লগইন করুন</span>
                        </button>
                    </div>

                    <form action="/login" method="POST">
                        @csrf

                        {{-- Phone/Email Input --}}
                        <div class="mb-5">
                            <div x-show="loginMethod === 'phone'" class="relative">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-4">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                    </svg>
                                </div>
                                <input type="tel" name="phone"
                                       placeholder="01XXXXXXXXX"
                                       class="w-full pl-12 pr-4 py-4 bg-gray-50 border border-gray-200 rounded-xl text-gray-800 placeholder-gray-400 focus:outline-none focus:border-brand-pink focus:ring-2 focus:ring-pink-100 transition-all text-base">
                            </div>
                            <div x-show="loginMethod === 'email'" x-cloak class="relative">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-4">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"/>
                                    </svg>
                                </div>
                                <input type="email" name="email"
                                       placeholder="your@email.com"
                                       class="w-full pl-12 pr-4 py-4 bg-gray-50 border border-gray-200 rounded-xl text-gray-800 placeholder-gray-400 focus:outline-none focus:border-brand-pink focus:ring-2 focus:ring-pink-100 transition-all text-base">
                            </div>
                        </div>

                        {{-- Password --}}
                        <div class="mb-2">
                            <div class="flex items-center justify-between mb-2">
                                <label class="text-sm font-medium text-gray-700">পাসওয়ার্ড</label>
                                <a href="#" class="text-sm text-brand-pink hover:text-brand-pink-dark font-medium transition-colors">পাসওয়ার্ড ভুলে গেছেন?</a>
                            </div>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-4">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                    </svg>
                                </div>
                                <input :type="showPassword ? 'text' : 'password'" name="password"
                                       placeholder="••••••••"
                                       class="w-full pl-12 pr-12 py-4 bg-gray-50 border border-gray-200 rounded-xl text-gray-800 placeholder-gray-400 focus:outline-none focus:border-brand-pink focus:ring-2 focus:ring-pink-100 transition-all text-base">
                                <button type="button" @click="showPassword = !showPassword"
                                        class="absolute inset-y-0 right-0 flex items-center pr-4 text-gray-400 hover:text-gray-600 transition-colors">
                                    <svg x-show="!showPassword" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                    <svg x-show="showPassword" x-cloak class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>
                                    </svg>
                                </button>
                            </div>
                        </div>

                        {{-- Login Button --}}
                        <button type="submit"
                                class="w-full py-4 mt-6 bg-gray-900 hover:bg-black text-white rounded-xl font-semibold text-base flex items-center justify-center gap-2 transition-all shadow-lg hover:shadow-xl">
                            লগইন করুন
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                            </svg>
                        </button>
                    </form>

                    {{-- Divider --}}
                    <div class="flex items-center gap-4 my-6">
                        <div class="flex-1 h-px bg-gray-200"></div>
                        <span class="text-sm text-gray-400">অথবা</span>
                        <div class="flex-1 h-px bg-gray-200"></div>
                    </div>

                    {{-- Social Login --}}
                    <div class="grid grid-cols-2 gap-3">
                        <button class="flex items-center justify-center gap-2 py-3.5 bg-white border border-gray-200 rounded-xl hover:bg-gray-50 transition-colors font-medium text-gray-700 text-sm">
                            <svg class="w-5 h-5" viewBox="0 0 24 24">
                                <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92a5.06 5.06 0 0 1-2.2 3.32v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.1z" fill="#4285F4"/>
                                <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/>
                                <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"/>
                                <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/>
                            </svg>
                            Google
                        </button>
                        <button class="flex items-center justify-center gap-2 py-3.5 bg-white border border-gray-200 rounded-xl hover:bg-gray-50 transition-colors font-medium text-gray-700 text-sm">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M18.71 19.5c-.83 1.24-1.71 2.45-3.05 2.47-1.34.03-1.77-.79-3.29-.79-1.53 0-2 .77-3.27.82-1.31.05-2.3-1.32-3.14-2.53C4.25 17 2.94 12.45 4.7 9.39c.87-1.52 2.43-2.48 4.12-2.51 1.28-.02 2.5.87 3.29.87.78 0 2.26-1.07 3.8-.91.65.03 2.47.26 3.64 1.98-.09.06-2.17 1.28-2.15 3.81.03 3.02 2.65 4.03 2.68 4.04-.03.07-.42 1.44-1.38 2.83M13 3.5c.73-.83 1.94-1.46 2.94-1.5.13 1.17-.34 2.35-1.04 3.19-.69.85-1.83 1.51-2.95 1.42-.15-1.15.41-2.35 1.05-3.11z"/>
                            </svg>
                            Apple
                        </button>
                    </div>

                    {{-- Register Link --}}
                    <p class="text-center mt-8 text-sm text-gray-500">
                        অ্যাকাউন্ট নেই?
                        <a href="/register" class="text-brand-pink hover:text-brand-pink-dark font-semibold transition-colors">
                            নতুন অ্যাকাউন্ট তৈরি করুন
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
