@extends('admin.layout')

@section('title', 'ড্যাশবোর্ড')
@section('page-title', 'ড্যাশবোর্ড')

@section('content')

{{-- ===== ORDER STATS ===== --}}
<div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-4 mb-6">
    <div class="bg-gradient-to-br from-brand-pink to-brand-pink-dark rounded-2xl p-5 text-white">
        <div class="text-3xl font-bold">{{ $totalOrders }}</div>
        <div class="text-white/80 text-xs mt-1 font-medium">মোট অর্ডার</div>
        <a href="{{ route('admin.orders.index') }}" class="text-white/70 text-xs hover:text-white mt-2 inline-block transition-colors">সব দেখুন &rarr;</a>
    </div>
    <div class="bg-white rounded-2xl border border-gray-100 p-5 shadow-sm">
        <div class="text-2xl font-bold text-gray-900">&#2547;{{ number_format($totalRevenue) }}</div>
        <div class="text-gray-400 text-xs mt-1 font-medium">মোট রেভিনিউ</div>
        <div class="text-green-500 text-xs mt-1">ক্যান্সেল বাদে</div>
    </div>
    <div class="bg-white rounded-2xl border border-gray-100 p-5 shadow-sm">
        <div class="flex items-center gap-2 mb-1">
            <div class="w-2.5 h-2.5 bg-yellow-400 rounded-full animate-pulse"></div>
            <div class="text-2xl font-bold text-gray-900">{{ $pendingOrders }}</div>
        </div>
        <div class="text-gray-400 text-xs font-medium">পেন্ডিং অর্ডার</div>
        <a href="{{ route('admin.orders.index', ['status' => 'pending']) }}" class="text-yellow-500 text-xs hover:text-yellow-600 mt-1 inline-block">দেখুন &rarr;</a>
    </div>
    <div class="bg-white rounded-2xl border border-gray-100 p-5 shadow-sm">
        <div class="text-2xl font-bold text-gray-900">{{ $deliveredOrders }}</div>
        <div class="text-gray-400 text-xs mt-1 font-medium">ডেলিভারড</div>
        <a href="{{ route('admin.orders.index', ['status' => 'delivered']) }}" class="text-green-500 text-xs hover:text-green-600 mt-1 inline-block">দেখুন &rarr;</a>
    </div>
    <div class="bg-white rounded-2xl border border-gray-100 p-5 shadow-sm">
        <div class="text-2xl font-bold text-gray-900">{{ $cancelledOrders }}</div>
        <div class="text-gray-400 text-xs mt-1 font-medium">বাতিল অর্ডার</div>
        <a href="{{ route('admin.orders.index', ['status' => 'cancelled']) }}" class="text-red-400 text-xs hover:text-red-500 mt-1 inline-block">দেখুন &rarr;</a>
    </div>
</div>

{{-- ===== FILTER + PERIOD STATS ===== --}}
<div class="bg-white rounded-2xl border border-gray-100 p-5 sm:p-6 shadow-sm mb-6">
    <div class="flex flex-wrap items-center justify-between gap-4 mb-5">
        <h2 class="font-bold text-gray-800">ফিল্টার করে হিসাব দেখুন</h2>
        <form method="GET" action="{{ route('admin.dashboard') }}" class="flex flex-wrap gap-2 items-end">
            <div>
                <label class="block text-xs text-gray-400 mb-1">তারিখ থেকে</label>
                <input type="date" name="from" value="{{ $filterFrom }}" class="px-3 py-2 bg-gray-50 border border-gray-200 rounded-lg text-sm focus:ring-2 focus:ring-brand-pink/30 focus:border-brand-pink outline-none">
            </div>
            <div>
                <label class="block text-xs text-gray-400 mb-1">তারিখ পর্যন্ত</label>
                <input type="date" name="to" value="{{ $filterTo }}" class="px-3 py-2 bg-gray-50 border border-gray-200 rounded-lg text-sm focus:ring-2 focus:ring-brand-pink/30 focus:border-brand-pink outline-none">
            </div>
            <button type="submit" class="px-4 py-2 bg-brand-pink text-white rounded-lg text-sm font-medium hover:bg-brand-pink-dark transition-colors">গণনা করুন</button>
            <a href="{{ route('admin.dashboard') }}" class="px-3 py-2 bg-gray-100 text-gray-500 rounded-lg text-sm hover:bg-gray-200 transition-colors">রিসেট</a>
        </form>
    </div>
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
        <div class="bg-gradient-to-br from-pink-50 to-rose-50 border border-pink-100 rounded-2xl p-5">
            <div class="text-xs text-pink-400 uppercase tracking-wider font-medium mb-2">
                {{ \Carbon\Carbon::parse($filterFrom)->format('d M Y') }} &ndash; {{ \Carbon\Carbon::parse($filterTo)->format('d M Y') }}
            </div>
            <div class="text-3xl font-bold text-brand-pink">{{ $periodOrders }}</div>
            <div class="text-sm text-gray-500 mt-1">এই সময়ে অর্ডার</div>
        </div>
        <div class="bg-gradient-to-br from-green-50 to-emerald-50 border border-green-100 rounded-2xl p-5">
            <div class="text-xs text-green-400 uppercase tracking-wider font-medium mb-2">
                {{ \Carbon\Carbon::parse($filterFrom)->format('d M Y') }} &ndash; {{ \Carbon\Carbon::parse($filterTo)->format('d M Y') }}
            </div>
            <div class="text-3xl font-bold text-green-600">&#2547;{{ number_format($periodRevenue) }}</div>
            <div class="text-sm text-gray-500 mt-1">এই সময়ে রেভিনিউ (ক্যান্সেল বাদে)</div>
        </div>
    </div>
</div>

{{-- ===== RECENT ORDERS ===== --}}
<div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden mb-6">
    <div class="px-5 py-4 border-b border-gray-100 flex items-center justify-between">
        <h2 class="font-bold text-gray-800">সাম্প্রতিক অর্ডার</h2>
        <a href="{{ route('admin.orders.index') }}" class="text-sm text-brand-pink hover:text-brand-pink-dark font-medium transition-colors">সব দেখুন &rarr;</a>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-gray-50">
                <tr>
                    <th class="text-left px-5 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wide">অর্ডার</th>
                    <th class="text-left px-5 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wide">প্রিয়জন</th>
                    <th class="text-left px-5 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wide">মোট</th>
                    <th class="text-left px-5 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wide">স্ট্যাটাস</th>
                    <th class="text-left px-5 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wide">তারিখ</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @forelse($recentOrders as $order)
                @php
                    $statusMap = [
                        'pending'    => ['label' => 'পেন্ডিং',   'class' => 'bg-yellow-50 text-yellow-700 border-yellow-200'],
                        'confirmed'  => ['label' => 'কনফার্মড',  'class' => 'bg-blue-50 text-blue-700 border-blue-200'],
                        'processing' => ['label' => 'প্রসেসিং',  'class' => 'bg-purple-50 text-purple-700 border-purple-200'],
                        'shipped'    => ['label' => 'শিপড',       'class' => 'bg-indigo-50 text-indigo-700 border-indigo-200'],
                        'delivered'  => ['label' => 'ডেলিভারড',  'class' => 'bg-green-50 text-green-700 border-green-200'],
                        'cancelled'  => ['label' => 'বাতিল',      'class' => 'bg-red-50 text-red-700 border-red-200'],
                    ];
                    $s = $statusMap[$order->status] ?? ['label' => $order->status, 'class' => 'bg-gray-50 text-gray-700 border-gray-200'];
                @endphp
                <tr class="hover:bg-gray-50/50 transition-colors">
                    <td class="px-5 py-3.5">
                        <a href="{{ route('admin.orders.show', $order) }}" class="font-bold text-brand-pink text-xs hover:underline">{{ $order->order_number }}</a>
                    </td>
                    <td class="px-5 py-3.5">
                        <span class="font-medium text-gray-800">{{ $order->recipient_name }}</span>
                        <span class="text-gray-400 text-xs ml-1">&middot; {{ $order->recipient_district }}</span>
                    </td>
                    <td class="px-5 py-3.5 font-bold text-gray-900">&#2547;{{ number_format($order->total) }}</td>
                    <td class="px-5 py-3.5">
                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium border {{ $s['class'] }}">{{ $s['label'] }}</span>
                    </td>
                    <td class="px-5 py-3.5 text-xs text-gray-400">{{ $order->created_at->diffForHumans() }}</td>
                </tr>
                @empty
                <tr><td colspan="5" class="text-center py-10 text-gray-400">কোনো অর্ডার নেই</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- ===== QUICK ACTIONS ===== --}}
<div class="bg-white rounded-2xl border border-gray-100 p-5 sm:p-6 shadow-sm">
    <h2 class="font-bold text-gray-800 mb-4">দ্রুত অ্যাকশন</h2>
    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-3">
        <a href="{{ route('admin.products.create') }}" class="flex items-center gap-3 p-4 rounded-xl border border-gray-100 hover:border-brand-pink/30 hover:bg-brand-pink-light/30 transition-colors group">
            <div class="w-10 h-10 bg-orange-50 rounded-lg flex items-center justify-center group-hover:bg-orange-500 transition-colors">
                <svg class="w-5 h-5 text-orange-500 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            </div>
            <div><p class="text-sm font-medium text-gray-800">নতুন প্রোডাক্ট</p><p class="text-xs text-gray-400">যোগ করুন</p></div>
        </a>
        <a href="{{ route('admin.coupons.create') }}" class="flex items-center gap-3 p-4 rounded-xl border border-gray-100 hover:border-brand-pink/30 hover:bg-brand-pink-light/30 transition-colors group">
            <div class="w-10 h-10 bg-green-50 rounded-lg flex items-center justify-center group-hover:bg-green-500 transition-colors">
                <svg class="w-5 h-5 text-green-500 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
            </div>
            <div><p class="text-sm font-medium text-gray-800">নতুন কুপন</p><p class="text-xs text-gray-400">তৈরি করুন</p></div>
        </a>
        <a href="{{ route('admin.orders.index') }}" class="flex items-center gap-3 p-4 rounded-xl border border-gray-100 hover:border-brand-pink/30 hover:bg-brand-pink-light/30 transition-colors group">
            <div class="w-10 h-10 bg-brand-pink-light rounded-lg flex items-center justify-center group-hover:bg-brand-pink transition-colors">
                <svg class="w-5 h-5 text-brand-pink group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
            </div>
            <div><p class="text-sm font-medium text-gray-800">সকল অর্ডার</p><p class="text-xs text-gray-400">ম্যানেজ করুন</p></div>
        </a>
        <a href="{{ route('admin.sliders.create') }}" class="flex items-center gap-3 p-4 rounded-xl border border-gray-100 hover:border-brand-pink/30 hover:bg-brand-pink-light/30 transition-colors group">
            <div class="w-10 h-10 bg-brand-pink-light rounded-lg flex items-center justify-center group-hover:bg-brand-pink transition-colors">
                <svg class="w-5 h-5 text-brand-pink group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            </div>
            <div><p class="text-sm font-medium text-gray-800">নতুন স্লাইডার</p><p class="text-xs text-gray-400">যোগ করুন</p></div>
        </a>
        <a href="{{ route('admin.categories.create') }}" class="flex items-center gap-3 p-4 rounded-xl border border-gray-100 hover:border-brand-pink/30 hover:bg-brand-pink-light/30 transition-colors group">
            <div class="w-10 h-10 bg-purple-50 rounded-lg flex items-center justify-center group-hover:bg-purple-500 transition-colors">
                <svg class="w-5 h-5 text-purple-500 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            </div>
            <div><p class="text-sm font-medium text-gray-800">নতুন ক্যাটাগরি</p><p class="text-xs text-gray-400">যোগ করুন</p></div>
        </a>
        <a href="{{ route('admin.products.index') }}" class="flex items-center gap-3 p-4 rounded-xl border border-gray-100 hover:border-brand-pink/30 hover:bg-brand-pink-light/30 transition-colors group">
            <div class="w-10 h-10 bg-orange-50 rounded-lg flex items-center justify-center group-hover:bg-orange-500 transition-colors">
                <svg class="w-5 h-5 text-orange-500 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/></svg>
            </div>
            <div><p class="text-sm font-medium text-gray-800">সকল প্রোডাক্ট</p><p class="text-xs text-gray-400">ম্যানেজ করুন</p></div>
        </a>
        <a href="{{ route('admin.coupons.index') }}" class="flex items-center gap-3 p-4 rounded-xl border border-gray-100 hover:border-brand-pink/30 hover:bg-brand-pink-light/30 transition-colors group">
            <div class="w-10 h-10 bg-green-50 rounded-lg flex items-center justify-center group-hover:bg-green-500 transition-colors">
                <svg class="w-5 h-5 text-green-500 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/></svg>
            </div>
            <div><p class="text-sm font-medium text-gray-800">সকল কুপন</p><p class="text-xs text-gray-400">ম্যানেজ করুন</p></div>
        </a>
        <a href="{{ url('/') }}" target="_blank" class="flex items-center gap-3 p-4 rounded-xl border border-gray-100 hover:border-brand-pink/30 hover:bg-brand-pink-light/30 transition-colors group">
            <div class="w-10 h-10 bg-blue-50 rounded-lg flex items-center justify-center group-hover:bg-blue-500 transition-colors">
                <svg class="w-5 h-5 text-blue-500 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
            </div>
            <div><p class="text-sm font-medium text-gray-800">ওয়েবসাইট</p><p class="text-xs text-gray-400">লাইভ সাইট দেখুন</p></div>
        </a>
    </div>
</div>
@endsection