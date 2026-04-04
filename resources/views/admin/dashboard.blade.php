@extends('admin.layout')

@section('title', 'ড্যাশবোর্ড')
@section('page-title', 'ড্যাশবোর্ড')

@section('content')
    {{-- Stats Cards --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-4 sm:gap-6 mb-8">
        {{-- Total Sliders --}}
        <div class="bg-white rounded-2xl border border-gray-100 p-5 sm:p-6 shadow-sm">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-brand-pink-light rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-brand-pink" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
            </div>
            <p class="text-3xl font-bold text-gray-800">{{ $sliderCount }}</p>
            <p class="text-sm text-gray-500 mt-1">মোট স্লাইডার</p>
        </div>

        {{-- Active Sliders --}}
        <div class="bg-white rounded-2xl border border-gray-100 p-5 sm:p-6 shadow-sm">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-green-50 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>
            <p class="text-3xl font-bold text-gray-800">{{ $activeSliders }}</p>
            <p class="text-sm text-gray-500 mt-1">সক্রিয় স্লাইডার</p>
        </div>

        {{-- Categories --}}
        <div class="bg-white rounded-2xl border border-gray-100 p-5 sm:p-6 shadow-sm">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-purple-50 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                    </svg>
                </div>
            </div>
            <p class="text-3xl font-bold text-gray-800">{{ $categoryCount }}</p>
            <p class="text-sm text-gray-500 mt-1">মোট ক্যাটাগরি</p>
        </div>

        {{-- Products --}}
        <div class="bg-white rounded-2xl border border-gray-100 p-5 sm:p-6 shadow-sm">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-orange-50 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                    </svg>
                </div>
            </div>
            <p class="text-3xl font-bold text-gray-800">{{ $productCount }}</p>
            <p class="text-sm text-gray-500 mt-1">মোট প্রোডাক্ট</p>
        </div>

        {{-- Users --}}
        <div class="bg-white rounded-2xl border border-gray-100 p-5 sm:p-6 shadow-sm">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-blue-50 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                    </svg>
                </div>
            </div>
            <p class="text-3xl font-bold text-gray-800">{{ $userCount }}</p>
            <p class="text-sm text-gray-500 mt-1">মোট ব্যবহারকারী</p>
        </div>
    </div>

    {{-- Quick Actions --}}
    <div class="bg-white rounded-2xl border border-gray-100 p-5 sm:p-6 shadow-sm">
        <h2 class="text-lg font-semibold text-gray-800 mb-4">দ্রুত অ্যাকশন</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3">
            <a href="{{ route('admin.sliders.create') }}"
               class="flex items-center gap-3 p-4 rounded-xl border border-gray-100 hover:border-brand-pink/30 hover:bg-brand-pink-light/30 transition-colors group">
                <div class="w-10 h-10 bg-brand-pink-light rounded-lg flex items-center justify-center group-hover:bg-brand-pink transition-colors">
                    <svg class="w-5 h-5 text-brand-pink group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-800">নতুন স্লাইডার</p>
                    <p class="text-xs text-gray-500">স্লাইডার যোগ করুন</p>
                </div>
            </a>

            <a href="{{ route('admin.categories.create') }}"
               class="flex items-center gap-3 p-4 rounded-xl border border-gray-100 hover:border-brand-pink/30 hover:bg-brand-pink-light/30 transition-colors group">
                <div class="w-10 h-10 bg-purple-50 rounded-lg flex items-center justify-center group-hover:bg-purple-500 transition-colors">
                    <svg class="w-5 h-5 text-purple-500 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-800">নতুন ক্যাটাগরি</p>
                    <p class="text-xs text-gray-500">ক্যাটাগরি যোগ করুন</p>
                </div>
            </a>

            <a href="{{ route('admin.products.create') }}"
               class="flex items-center gap-3 p-4 rounded-xl border border-gray-100 hover:border-brand-pink/30 hover:bg-brand-pink-light/30 transition-colors group">
                <div class="w-10 h-10 bg-orange-50 rounded-lg flex items-center justify-center group-hover:bg-orange-500 transition-colors">
                    <svg class="w-5 h-5 text-orange-500 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-800">নতুন প্রোডাক্ট</p>
                    <p class="text-xs text-gray-500">প্রোডাক্ট যোগ করুন</p>
                </div>
            </a>

            <a href="{{ route('admin.sliders.index') }}"
               class="flex items-center gap-3 p-4 rounded-xl border border-gray-100 hover:border-brand-pink/30 hover:bg-brand-pink-light/30 transition-colors group">
                <div class="w-10 h-10 bg-blue-50 rounded-lg flex items-center justify-center group-hover:bg-blue-500 transition-colors">
                    <svg class="w-5 h-5 text-blue-500 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/>
                    </svg>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-800">সকল স্লাইডার</p>
                    <p class="text-xs text-gray-500">ম্যানেজ করুন</p>
                </div>
            </a>

            <a href="{{ route('admin.categories.index') }}"
               class="flex items-center gap-3 p-4 rounded-xl border border-gray-100 hover:border-brand-pink/30 hover:bg-brand-pink-light/30 transition-colors group">
                <div class="w-10 h-10 bg-purple-50 rounded-lg flex items-center justify-center group-hover:bg-purple-500 transition-colors">
                    <svg class="w-5 h-5 text-purple-500 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/>
                    </svg>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-800">সকল ক্যাটাগরি</p>
                    <p class="text-xs text-gray-500">ম্যানেজ করুন</p>
                </div>
            </a>

            <a href="{{ route('admin.products.index') }}"
               class="flex items-center gap-3 p-4 rounded-xl border border-gray-100 hover:border-brand-pink/30 hover:bg-brand-pink-light/30 transition-colors group">
                <div class="w-10 h-10 bg-orange-50 rounded-lg flex items-center justify-center group-hover:bg-orange-500 transition-colors">
                    <svg class="w-5 h-5 text-orange-500 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/>
                    </svg>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-800">সকল প্রোডাক্ট</p>
                    <p class="text-xs text-gray-500">ম্যানেজ করুন</p>
                </div>
            </a>

            <a href="/" target="_blank"
               class="flex items-center gap-3 p-4 rounded-xl border border-gray-100 hover:border-brand-pink/30 hover:bg-brand-pink-light/30 transition-colors group">
                <div class="w-10 h-10 bg-green-50 rounded-lg flex items-center justify-center group-hover:bg-green-500 transition-colors">
                    <svg class="w-5 h-5 text-green-500 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                    </svg>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-800">ওয়েবসাইট</p>
                    <p class="text-xs text-gray-500">লাইভ সাইট দেখুন</p>
                </div>
            </a>
        </div>
    </div>
@endsection
