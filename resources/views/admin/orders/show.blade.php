@extends('admin.layout')

@section('title', 'অর্ডার #' . $order->order_number)
@section('page-title', 'অর্ডার বিস্তারিত')

@section('content')
@if(session('success'))
<div class="mb-4 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl text-sm">{{ session('success') }}</div>
@endif

<div class="mb-4">
    <a href="{{ route('admin.orders.index') }}" class="inline-flex items-center gap-1.5 text-sm text-gray-500 hover:text-gray-800 transition-colors">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
        সকল অর্ডার
    </a>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    {{-- Left: Order Info --}}
    <div class="lg:col-span-2 space-y-6">
        {{-- Order Header --}}
        <div class="bg-gradient-to-r from-brand-pink to-brand-pink-dark rounded-2xl p-6 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-white/70 text-xs uppercase tracking-wider">Order Number</p>
                    <p class="text-2xl font-bold tracking-wide">{{ $order->order_number }}</p>
                </div>
                <div class="text-right">
                    <p class="text-white/70 text-xs">তারিখ</p>
                    <p class="font-semibold">{{ $order->created_at->format('d M Y, h:i A') }}</p>
                </div>
            </div>
        </div>

        {{-- Recipient & Sender Info --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div class="bg-white rounded-2xl border border-gray-100 p-5 shadow-sm">
                <h3 class="font-bold text-gray-800 text-sm mb-3 flex items-center gap-2">
                    <div class="w-7 h-7 bg-pink-100 rounded-lg flex items-center justify-center"><svg class="w-3.5 h-3.5 text-brand-pink" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg></div>
                    প্রিয়জনের তথ্য
                </h3>
                <div class="space-y-2 text-sm">
                    <div class="flex gap-2"><span class="text-gray-400 w-16 shrink-0">নাম</span><span class="font-medium text-gray-800">{{ $order->recipient_name }}</span></div>
                    <div class="flex gap-2"><span class="text-gray-400 w-16 shrink-0">ফোন</span><span class="font-medium text-gray-800">{{ $order->recipient_phone }}</span></div>
                    <div class="flex gap-2"><span class="text-gray-400 w-16 shrink-0">জেলা</span><span class="font-medium text-gray-800">{{ $order->recipient_district }}</span></div>
                    <div class="flex gap-2"><span class="text-gray-400 w-16 shrink-0">ঠিকানা</span><span class="font-medium text-gray-800">{{ $order->recipient_address }}</span></div>
                </div>
            </div>
            <div class="bg-white rounded-2xl border border-gray-100 p-5 shadow-sm">
                <h3 class="font-bold text-gray-800 text-sm mb-3 flex items-center gap-2">
                    <div class="w-7 h-7 bg-pink-100 rounded-lg flex items-center justify-center"><svg class="w-3.5 h-3.5 text-brand-pink" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7"/></svg></div>
                    প্রেরকের তথ্য
                </h3>
                <div class="space-y-2 text-sm">
                    <div class="flex gap-2"><span class="text-gray-400 w-20 shrink-0">নাম</span><span class="font-medium text-gray-800">{{ $order->sender_name }}</span></div>
                    <div class="flex gap-2"><span class="text-gray-400 w-20 shrink-0">WhatsApp</span><span class="font-medium text-gray-800">{{ $order->sender_whatsapp }}</span></div>
                    @if($order->note)
                    <div class="flex gap-2"><span class="text-gray-400 w-20 shrink-0">নোট</span><span class="font-medium text-gray-800">{{ $order->note }}</span></div>
                    @endif
                </div>
            </div>
        </div>

        {{-- Ordered Items --}}
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
            <div class="px-5 py-4 border-b border-gray-100">
                <h3 class="font-bold text-gray-800 text-sm">অর্ডারকৃত পণ্যসমূহ</h3>
            </div>
            <div class="divide-y divide-gray-50">
                @foreach($order->items as $item)
                <div class="flex items-center gap-4 px-5 py-4">
                    <div class="w-14 h-14 bg-gray-50 rounded-xl overflow-hidden border border-gray-100 shrink-0">
                        <img src="{{ $item['image'] ?? '' }}" alt="{{ $item['name'] ?? '' }}" class="w-full h-full object-cover">
                    </div>
                    <div class="flex-1">
                        <p class="font-semibold text-gray-800 text-sm">{{ $item['name'] ?? '' }}</p>
                        <p class="text-xs text-gray-400">{{ $item['qty'] ?? 1 }} × ৳{{ number_format($item['price'] ?? 0) }}</p>
                    </div>
                    <span class="font-bold text-gray-900">৳{{ number_format(($item['price'] ?? 0) * ($item['qty'] ?? 1)) }}</span>
                </div>
                @endforeach
            </div>
            <div class="bg-gray-50 px-5 py-4 space-y-2 border-t border-gray-100">
                <div class="flex justify-between text-sm"><span class="text-gray-500">সাব-টোটাল</span><span class="font-medium">৳{{ number_format($order->subtotal) }}</span></div>
                <div class="flex justify-between text-sm"><span class="text-gray-500">ডেলিভারি চার্জ</span><span class="font-medium">{{ $order->delivery_charge > 0 ? '৳'.number_format($order->delivery_charge) : 'ফ্রি' }}</span></div>
                @if($order->discount > 0)
                <div class="flex justify-between text-sm"><span class="text-gray-500">ডিস্কাউন্ট @if($order->coupon_code)({{ $order->coupon_code }})@endif</span><span class="font-medium text-green-600">-৳{{ number_format($order->discount) }}</span></div>
                @endif
                <div class="flex justify-between pt-2 border-t border-gray-200"><span class="font-bold text-gray-900">সর্বমোট</span><span class="font-bold text-brand-pink text-lg">৳{{ number_format($order->total) }}</span></div>
            </div>
        </div>
    </div>

    {{-- Right: Actions --}}
    <div class="space-y-5">
        {{-- Update Status --}}
        <div class="bg-white rounded-2xl border border-gray-100 p-5 shadow-sm">
            <h3 class="font-bold text-gray-800 text-sm mb-4">স্ট্যাটাস পরিবর্তন</h3>
            <form method="POST" action="{{ route('admin.orders.status', $order) }}">
                @csrf
                @method('PATCH')
                <select name="status" class="w-full px-3 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-brand-pink/30 focus:border-brand-pink outline-none mb-3">
                    @foreach(['pending' => 'পেন্ডিং', 'confirmed' => 'কনফার্মড', 'processing' => 'প্রসেসিং', 'shipped' => 'শিপড', 'delivered' => 'ডেলিভারড', 'cancelled' => 'বাতিল'] as $val => $label)
                    <option value="{{ $val }}" {{ $order->status === $val ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                <button type="submit" class="w-full py-2.5 bg-brand-pink text-white rounded-xl text-sm font-bold hover:bg-brand-pink-dark transition-colors">স্ট্যাটাস আপডেট করুন</button>
            </form>
        </div>

        {{-- Payment & Payment Info --}}
        <div class="bg-white rounded-2xl border border-gray-100 p-5 shadow-sm">
            <h3 class="font-bold text-gray-800 text-sm mb-3">পেমেন্ট তথ্য</h3>
            <div class="space-y-2 text-sm">
                <div class="flex justify-between"><span class="text-gray-400">পদ্ধতি</span><span class="font-medium">💛 ক্যাশ অন ডেলিভারি</span></div>
                @if($order->coupon_code)
                <div class="flex justify-between"><span class="text-gray-400">কুপন</span><span class="font-medium text-green-600">🏷️ {{ $order->coupon_code }}</span></div>
                @endif
            </div>
        </div>

        {{-- Delete --}}
        <form method="POST" action="{{ route('admin.orders.destroy', $order) }}" onsubmit="return confirm('এই অর্ডারটি মুছে ফেলবেন?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="w-full py-2.5 bg-red-50 text-red-500 border border-red-200 rounded-xl text-sm font-medium hover:bg-red-500 hover:text-white transition-colors">
                অর্ডার মুছে ফেলুন
            </button>
        </form>

        {{-- WhatsApp --}}
        <a href="https://wa.me/880{{ ltrim($order->sender_whatsapp, '0') }}?text={{ urlencode('আপনার অর্ডার '.$order->order_number.' কনফার্ম হয়েছে। আমরা শীঘ্রই ডেলিভারি দেবো।') }}"
           target="_blank"
           class="flex items-center justify-center gap-2 w-full py-2.5 bg-green-50 text-green-600 border border-green-200 rounded-xl text-sm font-medium hover:bg-green-500 hover:text-white transition-colors">
            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/></svg>
            WhatsApp করুন
        </a>
    </div>
</div>
@endsection
