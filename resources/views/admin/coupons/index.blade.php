@extends('admin.layout')

@section('title', 'কুপন ম্যানেজমেন্ট')
@section('page-title', 'কুপন ম্যানেজমেন্ট')

@section('content')
@if(session('success'))
<div class="mb-4 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl text-sm">{{ session('success') }}</div>
@endif

<div class="flex justify-between items-center mb-5">
    <p class="text-sm text-gray-400">মোট {{ $coupons->total() }} টি কুপন</p>
    <a href="{{ route('admin.coupons.create') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-brand-pink text-white rounded-xl text-sm font-bold hover:bg-brand-pink-dark transition-colors">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
        নতুন কুপন
    </a>
</div>

<div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 border-b border-gray-100">
                <tr>
                    <th class="text-left px-5 py-3.5 font-semibold text-gray-600 text-xs uppercase tracking-wide">কোড</th>
                    <th class="text-left px-5 py-3.5 font-semibold text-gray-600 text-xs uppercase tracking-wide">ধরন / মান</th>
                    <th class="text-left px-5 py-3.5 font-semibold text-gray-600 text-xs uppercase tracking-wide">মিনিমাম অর্ডার</th>
                    <th class="text-left px-5 py-3.5 font-semibold text-gray-600 text-xs uppercase tracking-wide">ব্যবহার</th>
                    <th class="text-left px-5 py-3.5 font-semibold text-gray-600 text-xs uppercase tracking-wide">মেয়াদ</th>
                    <th class="text-left px-5 py-3.5 font-semibold text-gray-600 text-xs uppercase tracking-wide">স্ট্যাটাস</th>
                    <th class="text-right px-5 py-3.5 font-semibold text-gray-600 text-xs uppercase tracking-wide">অ্যাকশন</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @forelse($coupons as $coupon)
                <tr class="hover:bg-gray-50/50 transition-colors">
                    <td class="px-5 py-4">
                        <span class="font-bold text-brand-pink text-sm tracking-wider">{{ $coupon->code }}</span>
                        @if($coupon->description)
                        <p class="text-xs text-gray-400 mt-0.5">{{ $coupon->description }}</p>
                        @endif
                    </td>
                    <td class="px-5 py-4">
                        @if($coupon->type === 'percent')
                        <span class="inline-flex items-center px-2.5 py-1 bg-purple-50 text-purple-700 rounded-full text-xs font-bold border border-purple-100">{{ $coupon->value }}% ছাড়</span>
                        @else
                        <span class="inline-flex items-center px-2.5 py-1 bg-blue-50 text-blue-700 rounded-full text-xs font-bold border border-blue-100">৳{{ number_format($coupon->value) }} ছাড়</span>
                        @endif
                        @if($coupon->max_discount)
                        <p class="text-xs text-gray-400 mt-1">সর্বোচ্চ ৳{{ number_format($coupon->max_discount) }}</p>
                        @endif
                    </td>
                    <td class="px-5 py-4 text-gray-700">৳{{ number_format($coupon->min_order) }}</td>
                    <td class="px-5 py-4">
                        <span class="text-gray-700">{{ $coupon->used_count }}</span>
                        @if($coupon->usage_limit)
                        <span class="text-gray-400"> / {{ $coupon->usage_limit }}</span>
                        @else
                        <span class="text-gray-400"> / ∞</span>
                        @endif
                    </td>
                    <td class="px-5 py-4 text-xs text-gray-500">
                        {{ $coupon->expires_at ? $coupon->expires_at->format('d M Y') : 'মেয়াদহীন' }}
                    </td>
                    <td class="px-5 py-4">
                        <form method="POST" action="{{ route('admin.coupons.toggle', $coupon) }}">
                            @csrf
                            <button type="submit" class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium border transition-colors
                                {{ $coupon->is_active ? 'bg-green-50 text-green-700 border-green-200 hover:bg-green-100' : 'bg-gray-50 text-gray-500 border-gray-200 hover:bg-gray-100' }}">
                                {{ $coupon->is_active ? '✓ সক্রিয়' : '✗ নিষ্ক্রিয়' }}
                            </button>
                        </form>
                    </td>
                    <td class="px-5 py-4 text-right">
                        <div class="flex items-center justify-end gap-2">
                            <a href="{{ route('admin.coupons.edit', $coupon) }}" class="p-2 text-gray-400 hover:text-brand-pink hover:bg-brand-pink-light rounded-lg transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                            </a>
                            <form method="POST" action="{{ route('admin.coupons.destroy', $coupon) }}" onsubmit="return confirm('এই কুপনটি মুছে ফেলবেন?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="p-2 text-gray-400 hover:text-red-500 hover:bg-red-50 rounded-lg transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="7" class="text-center py-16 text-gray-400">কোনো কুপন নেই</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($coupons->hasPages())
    <div class="px-5 py-4 border-t border-gray-100">{{ $coupons->links() }}</div>
    @endif
</div>
@endsection
