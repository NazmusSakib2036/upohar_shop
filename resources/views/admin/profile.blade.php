@extends('admin.layout')

@section('title', 'অ্যাডমিন প্রোফাইল')
@section('page-title', 'প্রোফাইল সেটিংস')

@section('content')
@if(session('success'))
<div class="mb-4 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl text-sm">{{ session('success') }}</div>
@endif

<div class="max-w-xl space-y-6">
    {{-- Profile Info --}}
    <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm">
        <div class="flex items-center gap-4 mb-6">
            <div class="w-16 h-16 bg-gradient-to-br from-brand-pink to-brand-pink-dark rounded-2xl flex items-center justify-center text-white text-2xl font-bold">
                {{ strtoupper(substr($user->name, 0, 1)) }}
            </div>
            <div>
                <h2 class="font-bold text-gray-900 text-lg">{{ $user->name }}</h2>
                <p class="text-sm text-gray-400">{{ $user->email }}</p>
                <span class="inline-flex items-center gap-1 mt-1 px-2.5 py-0.5 bg-brand-pink-light text-brand-pink text-xs font-bold rounded-full">
                    ✓ অ্যাডমিন
                </span>
            </div>
        </div>

        <form method="POST" action="{{ route('admin.profile.update') }}">
            @csrf
            @method('PUT')
            @if($errors->has('name') || $errors->has('email'))
            <div class="mb-4 bg-red-50 border border-red-200 rounded-xl p-3 text-sm text-red-600 space-y-1">
                @foreach(['name','email'] as $field)
                    @error($field)<p>{{ $message }}</p>@enderror
                @endforeach
            </div>
            @endif

            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">পূর্ণ নাম *</label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}"
                           class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-brand-pink/30 focus:border-brand-pink outline-none" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">ইমেইল *</label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}"
                           class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-brand-pink/30 focus:border-brand-pink outline-none" required>
                </div>
            </div>

            <button type="submit" class="mt-5 w-full py-3 bg-brand-pink text-white rounded-xl font-bold text-sm hover:bg-brand-pink-dark transition-colors">
                প্রোফাইল সেভ করুন
            </button>
        </form>
    </div>

    {{-- Change Password --}}
    <div id="password" class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm">
        <h3 class="font-bold text-gray-800 mb-5 flex items-center gap-2">
            <div class="w-8 h-8 bg-orange-50 rounded-lg flex items-center justify-center">
                <svg class="w-4 h-4 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
            </div>
            পাসওয়ার্ড পরিবর্তন
        </h3>

        <form method="POST" action="{{ route('admin.profile.password') }}">
            @csrf
            @method('PUT')
            @error('current_password')
            <div class="mb-4 bg-red-50 border border-red-200 rounded-xl p-3 text-sm text-red-600">{{ $message }}</div>
            @enderror
            @error('password')
            <div class="mb-4 bg-red-50 border border-red-200 rounded-xl p-3 text-sm text-red-600">{{ $message }}</div>
            @enderror

            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">বর্তমান পাসওয়ার্ড *</label>
                    <input type="password" name="current_password"
                           class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-brand-pink/30 focus:border-brand-pink outline-none" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">নতুন পাসওয়ার্ড *</label>
                    <input type="password" name="password"
                           class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-brand-pink/30 focus:border-brand-pink outline-none" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">নতুন পাসওয়ার্ড নিশ্চিত করুন *</label>
                    <input type="password" name="password_confirmation"
                           class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-brand-pink/30 focus:border-brand-pink outline-none" required>
                </div>
            </div>

            <button type="submit" class="mt-5 w-full py-3 bg-orange-500 text-white rounded-xl font-bold text-sm hover:bg-orange-600 transition-colors">
                পাসওয়ার্ড পরিবর্তন করুন
            </button>
        </form>
    </div>
</div>
@endsection
