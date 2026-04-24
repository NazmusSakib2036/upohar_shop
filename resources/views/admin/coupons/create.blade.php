@extends('admin.layout')

@section('title', 'নতুন কুপন তৈরি')
@section('page-title', 'নতুন কুপন তৈরি')

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.coupons.index') }}" class="inline-flex items-center gap-1.5 text-sm text-gray-500 hover:text-gray-800 transition-colors">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
        সকল কুপন
    </a>
</div>

<div class="max-w-xl">
    <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm">
        <form method="POST" action="{{ route('admin.coupons.store') }}">
            @csrf
            @include('admin.coupons._form')
            <div class="flex gap-3 mt-6">
                <button type="submit" class="flex-1 py-3 bg-brand-pink text-white rounded-xl font-bold text-sm hover:bg-brand-pink-dark transition-colors">কুপন তৈরি করুন</button>
                <a href="{{ route('admin.coupons.index') }}" class="px-5 py-3 bg-gray-100 text-gray-600 rounded-xl font-medium text-sm hover:bg-gray-200 transition-colors">বাতিল</a>
            </div>
        </form>
    </div>
</div>
@endsection
