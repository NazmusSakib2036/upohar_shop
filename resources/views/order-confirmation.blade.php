@extends('layouts.app')

@section('title', 'অর্ডার সফল - উপহার Shop')

@section('content')
<div class="pt-28 sm:pt-32 pb-16 bg-gray-50/50 min-h-screen">
    <div class="max-w-3xl mx-auto px-4 sm:px-6">
        {{-- Success Header --}}
        <div class="text-center mb-10">
            <div class="w-24 h-24 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-6 animate-bounce" style="animation-duration: 2s;">
                <svg class="w-12 h-12 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                </svg>
            </div>
            <h1 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-2">অর্ডার সফল হয়েছে! 🎉</h1>
            <p class="text-gray-500 text-base">আপনার অর্ডারটি সফলভাবে গৃহীত হয়েছে। আমরা শীঘ্রই WhatsApp এ আপনার সাথে যোগাযোগ করবো।</p>
        </div>

        {{-- Order Info Card --}}
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden mb-6">
            {{-- Order Number Bar --}}
            <div class="bg-gradient-to-r from-brand-pink to-brand-pink-dark px-6 py-4 flex items-center justify-between">
                <div>
                    <p class="text-white/70 text-xs uppercase tracking-wider">ORDER NUMBER</p>
                    <p class="text-white text-lg font-bold tracking-wide">{{ $order->order_number }}</p>
                </div>
                <div class="text-right">
                    <p class="text-white/70 text-xs">তারিখ</p>
                    <p class="text-white text-sm font-medium">{{ $order->created_at->format('d M, Y h:i A') }}</p>
                </div>
            </div>

            {{-- Order Details --}}
            <div class="p-6 sm:p-8">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-8">
                    {{-- Recipient Info --}}
                    <div class="bg-gray-50 rounded-xl p-5">
                        <div class="flex items-center gap-2 mb-3">
                            <div class="w-8 h-8 bg-pink-100 rounded-lg flex items-center justify-center">
                                <svg class="w-4 h-4 text-brand-pink" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                            </div>
                            <h3 class="text-sm font-bold text-gray-800">প্রিয়জনের তথ্য</h3>
                        </div>
                        <div class="space-y-2 text-sm">
                            <p><span class="text-gray-400">নাম:</span> <span class="text-gray-800 font-medium">{{ $order->recipient_name }}</span></p>
                            <p><span class="text-gray-400">ফোন:</span> <span class="text-gray-800 font-medium">{{ $order->recipient_phone }}</span></p>
                            <p><span class="text-gray-400">জেলা:</span> <span class="text-gray-800 font-medium">{{ $order->recipient_district }}</span></p>
                            <p><span class="text-gray-400">ঠিকানা:</span> <span class="text-gray-800 font-medium">{{ $order->recipient_address }}</span></p>
                        </div>
                    </div>

                    {{-- Sender Info --}}
                    <div class="bg-pink-50/50 rounded-xl p-5 border border-pink-100">
                        <div class="flex items-center gap-2 mb-3">
                            <div class="w-8 h-8 bg-pink-100 rounded-lg flex items-center justify-center">
                                <svg class="w-4 h-4 text-brand-pink" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7"/></svg>
                            </div>
                            <h3 class="text-sm font-bold text-gray-800">প্রেরকের তথ্য</h3>
                        </div>
                        <div class="space-y-2 text-sm">
                            <p><span class="text-gray-400">নাম:</span> <span class="text-gray-800 font-medium">{{ $order->sender_name }}</span></p>
                            <p><span class="text-gray-400">WhatsApp:</span> <span class="text-gray-800 font-medium">{{ $order->sender_whatsapp }}</span></p>
                            @if($order->note)
                            <p><span class="text-gray-400">নোট:</span> <span class="text-gray-800 font-medium">{{ $order->note }}</span></p>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- Ordered Items --}}
                <h3 class="text-sm font-bold text-gray-800 mb-4 flex items-center gap-2">
                    <svg class="w-4 h-4 text-brand-pink" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                    অর্ডারকৃত পণ্যসমূহ
                </h3>
                <div class="space-y-3 mb-6">
                    @foreach($order->items as $item)
                    <div class="flex items-center gap-4 bg-gray-50 rounded-xl p-3">
                        <div class="w-14 h-14 bg-white rounded-lg overflow-hidden border border-gray-100 shrink-0">
                            <img src="{{ $item['image'] ?? '' }}" alt="{{ $item['name'] ?? '' }}" class="w-full h-full object-cover">
                        </div>
                        <div class="flex-1 min-w-0">
                            <h4 class="text-sm font-semibold text-gray-800 truncate">{{ $item['name'] ?? '' }}</h4>
                            <p class="text-xs text-gray-400">{{ $item['qty'] ?? 1 }} x ৳{{ number_format($item['price'] ?? 0) }}</p>
                        </div>
                        <span class="text-sm font-bold text-gray-800 shrink-0">৳{{ number_format(($item['price'] ?? 0) * ($item['qty'] ?? 1)) }}</span>
                    </div>
                    @endforeach
                </div>

                {{-- Price Summary --}}
                <div class="bg-gray-50 rounded-xl p-5 space-y-3">
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-500">সাব-টোটাল</span>
                        <span class="text-gray-800 font-medium">৳{{ number_format($order->subtotal) }}</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-500">ডেলিভারি চার্জ</span>
                        <span class="text-gray-800 font-medium">{{ $order->delivery_charge > 0 ? '৳' . number_format($order->delivery_charge) : 'ফ্রি' }}</span>
                    </div>
                    @if($order->discount > 0)
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-500">ডিস্কাউন্ট</span>
                        <span class="text-green-600 font-medium">-৳{{ number_format($order->discount) }}</span>
                    </div>
                    @endif
                    <div class="border-t border-gray-200 pt-3 flex justify-between">
                        <span class="font-bold text-gray-900">সর্বমোট</span>
                        <span class="text-xl font-bold text-brand-pink">৳{{ number_format($order->total) }}</span>
                    </div>
                    <div class="flex items-center gap-2 mt-2">
                        <span class="inline-flex items-center gap-1 px-3 py-1 bg-yellow-50 border border-yellow-200 rounded-full text-xs text-yellow-700 font-medium">
                            💛 ক্যাশ অন ডেলিভারি
                        </span>
                        <span class="inline-flex items-center gap-1 px-3 py-1 bg-blue-50 border border-blue-200 rounded-full text-xs text-blue-700 font-medium">
                            ⏳ {{ $order->status === 'pending' ? 'প্রসেসিং' : $order->status }}
                        </span>
                    </div>
                </div>
            </div>
        </div>

        {{-- WhatsApp Notice --}}
        <div class="flex items-start gap-4 bg-green-50 border border-green-200 rounded-2xl p-5 mb-6">
            <div class="w-10 h-10 bg-green-100 rounded-xl flex items-center justify-center shrink-0">
                <svg class="w-5 h-5 text-green-600" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/></svg>
            </div>
            <div>
                <h3 class="font-bold text-green-800 text-sm mb-1">WhatsApp কনফার্মেশন</h3>
                <p class="text-xs text-green-600 leading-relaxed">আমরা শীঘ্রই আপনার WhatsApp নম্বরে (<strong>{{ $order->sender_whatsapp }}</strong>) অর্ডার কনফার্মেশন ও ডেলিভারি আপডেট পাঠাবো। অনুগ্রহ করে WhatsApp চালু রাখুন।</p>
            </div>
        </div>

        {{-- Action Buttons --}}
        <div class="flex flex-col sm:flex-row items-center justify-center gap-3">
            <a href="{{ url('/') }}" class="inline-flex items-center gap-2 px-8 py-3.5 bg-gradient-to-r from-brand-pink to-brand-pink-dark text-white rounded-2xl font-bold text-sm hover:shadow-lg hover:shadow-pink-300/40 transition-all duration-300 hover:-translate-y-0.5">
                🏠 হোম পেজে যান
            </a>
            <a href="{{ url('/gifts') }}" class="inline-flex items-center gap-2 px-8 py-3.5 bg-white border-2 border-gray-200 text-gray-700 rounded-2xl font-bold text-sm hover:border-brand-pink hover:text-brand-pink transition-all duration-300">
                🎁 আরও শপিং করুন
            </a>
        </div>
    </div>
</div>
@endsection
