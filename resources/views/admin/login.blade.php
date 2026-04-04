<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>অ্যাডমিন লগইন - উপহার Shop</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'brand-pink': '#E91E63',
                        'brand-pink-dark': '#C2185B',
                        'brand-pink-light': '#FCE4EC',
                    }
                }
            }
        }
    </script>
    <style>* { font-family: 'Hind Siliguri', sans-serif; }</style>
</head>
<body class="min-h-screen bg-gradient-to-br from-brand-pink-light via-white to-pink-50 flex items-center justify-center p-4">

    <div class="w-full max-w-md">
        {{-- Logo --}}
        <div class="text-center mb-8">
            <div class="inline-flex items-center gap-2 mb-2">
                <div class="w-12 h-12 bg-gradient-to-br from-brand-pink to-brand-pink-dark rounded-xl flex items-center justify-center shadow-lg shadow-pink-300/40">
                    <span class="text-white text-xl font-bold">U</span>
                </div>
            </div>
            <h1 class="text-2xl font-bold text-gray-800">অ্যাডমিন প্যানেল</h1>
            <p class="text-sm text-gray-500 mt-1">উপহার Shop - ম্যানেজমেন্ট সিস্টেম</p>
        </div>

        {{-- Login Card --}}
        <div class="bg-white rounded-2xl shadow-xl shadow-pink-100/50 border border-gray-100 p-8">
            @if(session('error'))
                <div class="mb-4 px-4 py-3 bg-red-50 border border-red-200 text-red-600 rounded-xl text-sm">
                    {{ session('error') }}
                </div>
            @endif

            <form action="{{ route('admin.login.submit') }}" method="POST" class="space-y-5">
                @csrf

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">ইমেইল</label>
                    <input type="email" name="email" value="{{ old('email') }}" required autofocus
                           class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none text-sm transition-colors"
                           placeholder="admin@example.com">
                    @error('email')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">পাসওয়ার্ড</label>
                    <div class="relative" x-data="{ showPass: false }">
                        <input :type="showPass ? 'text' : 'password'" name="password" required
                               class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-brand-pink focus:ring-2 focus:ring-brand-pink/20 outline-none text-sm transition-colors pr-12"
                               placeholder="••••••••">
                        <button type="button" @click="showPass = !showPass" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600">
                            <svg x-show="!showPass" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                            <svg x-show="showPass" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" x-cloak>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>
                            </svg>
                        </button>
                    </div>
                    @error('password')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center justify-between">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="remember" class="w-4 h-4 rounded border-gray-300 text-brand-pink focus:ring-brand-pink">
                        <span class="text-sm text-gray-600">মনে রাখুন</span>
                    </label>
                </div>

                <button type="submit"
                        class="w-full py-3.5 bg-brand-pink hover:bg-brand-pink-dark text-white rounded-xl font-semibold text-sm transition-all shadow-lg shadow-pink-300/40">
                    লগইন করুন
                </button>
            </form>
        </div>

        <p class="text-center text-xs text-gray-400 mt-6">
            &copy; {{ date('Y') }} উপহার Shop। সর্বস্বত্ব সংরক্ষিত।
        </p>
    </div>

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</body>
</html>
