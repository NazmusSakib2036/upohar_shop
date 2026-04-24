@extends('admin.layout')

@section('title', 'অর্ডার ম্যানেজমেন্ট')
@section('page-title', 'অর্ডার ম্যানেজমেন্ট')

@section('content')
@if(session('success'))
<div class="mb-4 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl text-sm">{{ session('success') }}</div>
@endif

{{-- Filters --}}
<div class="bg-white rounded-2xl border border-gray-100 p-5 shadow-sm mb-6">
    <form method="GET" class="flex flex-wrap gap-3 items-end">
        <div class="flex-1 min-w-40">
            <label class="block text-xs font-medium text-gray-500 mb-1">সার্চ</label>
            <input type="text" name="search" value="{{ request('search') }}" placeholder="নাম, ফোন, অর্ডার নম্বর..."
                   class="w-full px-3 py-2 bg-gray-50 border border-gray-200 rounded-lg text-sm focus:ring-2 focus:ring-brand-pink/30 focus:border-brand-pink outline-none">
        </div>
        <div>
            <label class="block text-xs font-medium text-gray-500 mb-1">স্ট্যাটাস</label>
            <select name="status" class="px-3 py-2 bg-gray-50 border border-gray-200 rounded-lg text-sm focus:ring-2 focus:ring-brand-pink/30 focus:border-brand-pink outline-none">
                <option value="">সব</option>
                <option value="pending"    {{ request('status') === 'pending'    ? 'selected' : '' }}>পেন্ডিং</option>
                <option value="confirmed"  {{ request('status') === 'confirmed'  ? 'selected' : '' }}>কনফার্মড</option>
                <option value="processing" {{ request('status') === 'processing' ? 'selected' : '' }}>প্রসেসিং</option>
                <option value="shipped"    {{ request('status') === 'shipped'    ? 'selected' : '' }}>শিপড</option>
                <option value="delivered"  {{ request('status') === 'delivered'  ? 'selected' : '' }}>ডেলিভারড</option>
                <option value="cancelled"  {{ request('status') === 'cancelled'  ? 'selected' : '' }}>বাতিল</option>
            </select>
        </div>
        <div>
            <label class="block text-xs font-medium text-gray-500 mb-1">তারিখ থেকে</label>
            <input type="date" name="from" value="{{ request('from') }}" class="px-3 py-2 bg-gray-50 border border-gray-200 rounded-lg text-sm focus:ring-2 focus:ring-brand-pink/30 focus:border-brand-pink outline-none">
        </div>
        <div>
            <label class="block text-xs font-medium text-gray-500 mb-1">তারিখ পর্যন্ত</label>
            <input type="date" name="to" value="{{ request('to') }}" class="px-3 py-2 bg-gray-50 border border-gray-200 rounded-lg text-sm focus:ring-2 focus:ring-brand-pink/30 focus:border-brand-pink outline-none">
        </div>
        <button type="submit" class="px-5 py-2 bg-brand-pink text-white rounded-lg text-sm font-medium hover:bg-brand-pink-dark transition-colors">ফিল্টার</button>
        @if(request()->hasAny(['search','status','from','to']))
        <a href="{{ route('admin.orders.index') }}" class="px-4 py-2 bg-gray-100 text-gray-600 rounded-lg text-sm font-medium hover:bg-gray-200 transition-colors">রিসেট</a>
        @endif
    </form>
</div>

{{-- Table --}}
<div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 border-b border-gray-100">
                <tr>
                    <th class="text-left px-5 py-3.5 font-semibold text-gray-600 text-xs uppercase tracking-wide">অর্ডার</th>
                    <th class="text-left px-5 py-3.5 font-semibold text-gray-600 text-xs uppercase tracking-wide">প্রিয়জন</th>
                    <th class="text-left px-5 py-3.5 font-semibold text-gray-600 text-xs uppercase tracking-wide">প্রেরক</th>
                    <th class="text-left px-5 py-3.5 font-semibold text-gray-600 text-xs uppercase tracking-wide">মোট</th>
                    <th class="text-left px-5 py-3.5 font-semibold text-gray-600 text-xs uppercase tracking-wide">স্ট্যাটাস</th>
                    <th class="text-left px-5 py-3.5 font-semibold text-gray-600 text-xs uppercase tracking-wide">তারিখ</th>
                    <th class="text-right px-5 py-3.5 font-semibold text-gray-600 text-xs uppercase tracking-wide">অ্যাকশন</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @forelse($orders as $order)
                <tr class="hover:bg-gray-50/50 transition-colors">
                    <td class="px-5 py-4">
                        <span class="font-bold text-gray-800 text-xs tracking-wide">{{ $order->order_number }}</span>
                        @if($order->coupon_code)
                        <span class="block text-[10px] text-green-600 font-medium mt-0.5">🏷️ {{ $order->coupon_code }}</span>
                        @endif
                    </td>
                    <td class="px-5 py-4">
                        <p class="font-medium text-gray-800">{{ $order->recipient_name }}</p>
                        <p class="text-xs text-gray-400">{{ $order->recipient_phone }} · {{ $order->recipient_district }}</p>
                    </td>
                    <td class="px-5 py-4">
                        <p class="font-medium text-gray-800">{{ $order->sender_name }}</p>
                        <p class="text-xs text-gray-400">{{ $order->sender_whatsapp }}</p>
                    </td>
                    <td class="px-5 py-4">
                        <span class="font-bold text-gray-900">৳{{ number_format($order->total) }}</span>
                        @if($order->discount > 0)
                        <span class="block text-[10px] text-green-600">-৳{{ number_format($order->discount) }} ছাড়</span>
                        @endif
                    </td>
                    <td class="px-5 py-4">
                        @php
                            $statusMap = [
                                'pending'    => ['label' => 'পেন্ডিং',    'class' => 'bg-yellow-50 text-yellow-700 border-yellow-200'],
                                'confirmed'  => ['label' => 'কনফার্মড',   'class' => 'bg-blue-50 text-blue-700 border-blue-200'],
                                'processing' => ['label' => 'প্রসেসিং',   'class' => 'bg-purple-50 text-purple-700 border-purple-200'],
                                'shipped'    => ['label' => 'শিপড',        'class' => 'bg-indigo-50 text-indigo-700 border-indigo-200'],
                                'delivered'  => ['label' => 'ডেলিভারড',   'class' => 'bg-green-50 text-green-700 border-green-200'],
                                'cancelled'  => ['label' => 'বাতিল',       'class' => 'bg-red-50 text-red-700 border-red-200'],
                            ];
                            $s = $statusMap[$order->status] ?? ['label' => $order->status, 'class' => 'bg-gray-50 text-gray-700 border-gray-200'];
                        @endphp
                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium border {{ $s['class'] }}">{{ $s['label'] }}</span>
                    </td>
                    <td class="px-5 py-4 text-xs text-gray-400">{{ $order->created_at->format('d M Y') }}<br>{{ $order->created_at->format('h:i A') }}</td>
                    <td class="px-5 py-4 text-right">
                        <a href="{{ route('admin.orders.show', $order) }}" class="inline-flex items-center gap-1 px-3 py-1.5 bg-brand-pink-light text-brand-pink rounded-lg text-xs font-medium hover:bg-brand-pink hover:text-white transition-colors">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                            দেখুন
                        </a>
                    </td>
                </tr>
                @empty
                <tr><td colspan="7" class="text-center py-16 text-gray-400">কোনো অর্ডার নেই</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($orders->hasPages())
    <div class="px-5 py-4 border-t border-gray-100">{{ $orders->links() }}</div>
    @endif
</div>
@endsection
