@extends('admin.layout')

@section('title', 'স্লাইডার ম্যানেজ')
@section('page-title', 'স্লাইডার ম্যানেজ')

@section('content')
    {{-- Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
        <div>
            <p class="text-sm text-gray-500">মোট {{ $sliders->count() }}টি স্লাইডার</p>
        </div>
        <a href="{{ route('admin.sliders.create') }}"
           class="inline-flex items-center gap-2 px-5 py-2.5 bg-brand-pink hover:bg-brand-pink-dark text-white rounded-xl text-sm font-semibold transition-all shadow-sm">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            নতুন স্লাইডার যোগ করুন
        </a>
    </div>

    {{-- Slider Cards --}}
    @if($sliders->isEmpty())
        <div class="bg-white rounded-2xl border border-gray-100 p-12 text-center shadow-sm">
            <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
            </div>
            <h3 class="text-lg font-semibold text-gray-700 mb-2">কোনো স্লাইডার নেই</h3>
            <p class="text-sm text-gray-500 mb-6">প্রথম স্লাইডার তৈরি করুন যেটি হোমপেজে দেখাবে।</p>
            <a href="{{ route('admin.sliders.create') }}"
               class="inline-flex items-center gap-2 px-5 py-2.5 bg-brand-pink hover:bg-brand-pink-dark text-white rounded-xl text-sm font-semibold transition-all">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                প্রথম স্লাইডার তৈরি করুন
            </a>
        </div>
    @else
        <div class="space-y-4" id="slider-list">
            @foreach($sliders as $slider)
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden hover:shadow-md transition-shadow"
                     data-slider-id="{{ $slider->id }}">
                    <div class="flex flex-col sm:flex-row">
                        {{-- Image Preview --}}
                        <div class="sm:w-48 lg:w-56 flex-shrink-0">
                            @if($slider->image)
                                <img src="{{ asset('storage/' . $slider->image) }}" alt="{{ $slider->heading_normal }}"
                                     class="w-full h-32 sm:h-full object-cover">
                            @else
                                <div class="w-full h-32 sm:h-full bg-gradient-to-br from-brand-pink-light to-pink-100 flex items-center justify-center min-h-[120px]">
                                    <span class="text-4xl">{{ $slider->heading_emoji ?? '🎁' }}</span>
                                </div>
                            @endif
                        </div>

                        {{-- Content --}}
                        <div class="flex-1 p-4 sm:p-5">
                            <div class="flex items-start justify-between gap-4 mb-3">
                                <div class="flex-1">
                                    <div class="flex items-center gap-2 mb-2">
                                        @if($slider->badge_1)
                                            <span class="px-2 py-0.5 bg-gray-100 rounded-md text-xs text-gray-600">{{ $slider->badge_1 }}</span>
                                        @endif
                                        @if($slider->badge_2)
                                            <span class="px-2 py-0.5 bg-brand-pink-light text-brand-pink rounded-md text-xs font-medium">{{ $slider->badge_2 }}</span>
                                        @endif
                                    </div>
                                    <h3 class="text-lg font-bold text-gray-800">
                                        {{ $slider->heading_normal }}
                                        <span class="text-brand-pink">{{ $slider->heading_highlight }}</span>
                                        {{ $slider->heading_emoji }}
                                    </h3>
                                </div>

                                {{-- Status Badge --}}
                                <div class="flex items-center gap-2">
                                    <span class="px-2.5 py-1 rounded-full text-xs font-medium {{ $slider->is_active ? 'bg-green-50 text-green-600' : 'bg-gray-100 text-gray-500' }}">
                                        {{ $slider->is_active ? 'সক্রিয়' : 'নিষ্ক্রিয়' }}
                                    </span>
                                    <span class="px-2 py-1 bg-gray-50 rounded-md text-xs text-gray-400">
                                        #{{ $slider->order }}
                                    </span>
                                </div>
                            </div>

                            <p class="text-sm text-gray-500 line-clamp-2 mb-4">{{ $slider->description }}</p>

                            {{-- Action Buttons --}}
                            <div class="flex items-center gap-2 flex-wrap">
                                <a href="{{ route('admin.sliders.edit', $slider) }}"
                                   class="inline-flex items-center gap-1.5 px-3.5 py-2 bg-blue-50 hover:bg-blue-100 text-blue-600 rounded-lg text-xs font-medium transition-colors">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                    এডিট
                                </a>

                                <form action="{{ route('admin.sliders.toggle', $slider) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit"
                                            class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-lg text-xs font-medium transition-colors
                                                   {{ $slider->is_active ? 'bg-yellow-50 hover:bg-yellow-100 text-yellow-600' : 'bg-green-50 hover:bg-green-100 text-green-600' }}">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $slider->is_active ? 'M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636' : 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z' }}"/>
                                        </svg>
                                        {{ $slider->is_active ? 'নিষ্ক্রিয় করুন' : 'সক্রিয় করুন' }}
                                    </button>
                                </form>

                                <form action="{{ route('admin.sliders.destroy', $slider) }}" method="POST" class="inline"
                                      onsubmit="return confirm('আপনি কি নিশ্চিত এই স্লাইডার ডিলিট করতে চান?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="inline-flex items-center gap-1.5 px-3.5 py-2 bg-red-50 hover:bg-red-100 text-red-600 rounded-lg text-xs font-medium transition-colors">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                        ডিলিট
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
@endsection
