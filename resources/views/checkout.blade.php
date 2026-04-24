@extends('layouts.app')

@section('title', 'নিরাপদ চেকআউট - উপহার Shop')

@section('styles')
<style>
    .checkout-section {
        position: relative;
    }
    .checkout-section::before {
        content: attr(data-step);
        position: absolute;
        top: -14px;
        left: 20px;
        width: 28px;
        height: 28px;
        background: linear-gradient(135deg, #E91E63, #C2185B);
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 13px;
        font-weight: 700;
        z-index: 2;
    }
    .sender-section {
        background: linear-gradient(135deg, #FFF0F3, #FCE4EC);
        border: 1.5px solid #F8BBD0;
    }
    .sender-section::before {
        background: linear-gradient(135deg, #FF5722, #E91E63);
    }
    .payment-option {
        transition: all 0.2s;
    }
    .payment-option.selected {
        border-color: #E91E63;
        background: #FFF0F3;
    }
    .order-summary {
        position: sticky;
        top: 100px;
    }
</style>
@endsection

@section('content')
<div class="pt-28 sm:pt-32 pb-16 bg-gray-50/50 min-h-screen" x-data="checkoutPage()">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Page Header --}}
        <div class="flex items-center justify-between mb-8">
            <div>
                <h1 class="text-2xl sm:text-3xl font-bold text-gray-900">নিরাপদ চেকআউট</h1>
                <p class="text-xs text-gray-400 uppercase tracking-widest mt-1 font-medium">COMPLETE YOUR PREMIUM ORDER</p>
            </div>
            <div class="hidden sm:flex items-center gap-2 px-4 py-2.5 bg-green-50 border border-green-200 rounded-xl">
                <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center">
                    <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                </div>
                <div>
                    <p class="text-xs font-bold text-green-700">এনক্রিপ্টেড পেমেন্ট</p>
                    <p class="text-[10px] text-green-500 uppercase tracking-wider">SSL SECURED CONNECTION</p>
                </div>
            </div>
        </div>

        {{-- Empty Cart Warning --}}
        <div x-show="cartItems.length === 0" class="text-center py-20">
            <div class="w-24 h-24 bg-pink-50 rounded-full flex items-center justify-center mx-auto mb-6">
                <svg class="w-12 h-12 text-brand-pink/50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 100 4 2 2 0 000-4z"/></svg>
            </div>
            <h2 class="text-xl font-bold text-gray-800 mb-2">কার্টে কোনো প্রোডাক্ট নেই</h2>
            <p class="text-gray-400 mb-6">চেকআউট করতে হলে প্রথমে কার্টে প্রোডাক্ট যোগ করুন</p>
            <a :href="window.baseUrl + '/gifts'" class="inline-flex items-center gap-2 px-8 py-3 bg-brand-pink text-white rounded-xl font-semibold hover:bg-brand-pink-dark transition-colors">
                🎁 শপিং করুন
            </a>
        </div>

        {{-- Main Checkout Layout --}}
        <form x-show="cartItems.length > 0" @submit.prevent="submitOrder()" class="grid grid-cols-1 lg:grid-cols-3 gap-6 lg:gap-8">
            {{-- Left Column: Forms --}}
            <div class="lg:col-span-2 space-y-8">

                {{-- ❶ প্রিয়জনের তথ্য (Recipient Info) --}}
                <div class="checkout-section bg-white rounded-2xl p-6 sm:p-8 shadow-sm border border-gray-100" data-step="❶">
                    <h2 class="text-lg font-bold text-gray-900 mb-1">প্রিয়জনের তথ্য</h2>
                    <p class="text-xs text-gray-400 mb-6">যাকে উপহার পাঠাবেন তার তথ্য দিন</p>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1.5">প্রিয়জনের নাম *</label>
                            <div class="relative">
                                <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                </span>
                                <input type="text" x-model="form.recipient_name" placeholder="প্রিয়জনের পূর্ণ নাম"
                                       class="w-full pl-10 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-brand-pink/30 focus:border-brand-pink outline-none transition-all">
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1.5">প্রিয়জনের মোবাইল নম্বর *</label>
                            <div class="relative">
                                <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                                </span>
                                <input type="tel" x-model="form.recipient_phone" placeholder="প্রিয়জনের মোবাইল নাম্বার"
                                       class="w-full pl-10 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-brand-pink/30 focus:border-brand-pink outline-none transition-all">
                            </div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">জেলা নির্বাচন করুন *</label>
                        <div class="relative">
                            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            </span>
                            <select x-model="form.recipient_district"
                                    class="w-full pl-10 pr-10 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-brand-pink/30 focus:border-brand-pink outline-none transition-all appearance-none">
                                <option value="">জেলা নির্বাচন করুন</option>
                                <option value="ঢাকা">ঢাকা</option>
                                <option value="চট্টগ্রাম">চট্টগ্রাম</option>
                                <option value="রাজশাহী">রাজশাহী</option>
                                <option value="খুলনা">খুলনা</option>
                                <option value="সিলেট">সিলেট</option>
                                <option value="বরিশাল">বরিশাল</option>
                                <option value="রংপুর">রংপুর</option>
                                <option value="ময়মনসিংহ">ময়মনসিংহ</option>
                                <option value="কুমিল্লা">কুমিল্লা</option>
                                <option value="গাজীপুর">গাজীপুর</option>
                                <option value="নারায়ণগঞ্জ">নারায়ণগঞ্জ</option>
                                <option value="টাঙ্গাইল">টাঙ্গাইল</option>
                                <option value="নরসিংদী">নরসিংদী</option>
                                <option value="মানিকগঞ্জ">মানিকগঞ্জ</option>
                                <option value="মুন্সিগঞ্জ">মুন্সিগঞ্জ</option>
                                <option value="ফরিদপুর">ফরিদপুর</option>
                                <option value="গোপালগঞ্জ">গোপালগঞ্জ</option>
                                <option value="মাদারীপুর">মাদারীপুর</option>
                                <option value="শরীয়তপুর">শরীয়তপুর</option>
                                <option value="যশোর">যশোর</option>
                                <option value="সাতক্ষীরা">সাতক্ষীরা</option>
                                <option value="মেহেরপুর">মেহেরপুর</option>
                                <option value="নড়াইল">নড়াইল</option>
                                <option value="কুষ্টিয়া">কুষ্টিয়া</option>
                                <option value="চুয়াডাঙ্গা">চুয়াডাঙ্গা</option>
                                <option value="ঝিনাইদহ">ঝিনাইদহ</option>
                                <option value="মাগুরা">মাগুরা</option>
                                <option value="বাগেরহাট">বাগেরহাট</option>
                                <option value="ঝালকাঠি">ঝালকাঠি</option>
                                <option value="পটুয়াখালী">পটুয়াখালী</option>
                                <option value="পিরোজপুর">পিরোজপুর</option>
                                <option value="ভোলা">ভোলা</option>
                                <option value="বরগুনা">বরগুনা</option>
                                <option value="নোয়াখালী">নোয়াখালী</option>
                                <option value="ফেনী">ফেনী</option>
                                <option value="লক্ষ্মীপুর">লক্ষ্মীপুর</option>
                                <option value="চাঁদপুর">চাঁদপুর</option>
                                <option value="ব্রাহ্মণবাড়িয়া">ব্রাহ্মণবাড়িয়া</option>
                                <option value="কক্সবাজার">কক্সবাজার</option>
                                <option value="রাঙ্গামাটি">রাঙ্গামাটি</option>
                                <option value="খাগড়াছড়ি">খাগড়াছড়ি</option>
                                <option value="বান্দরবান">বান্দরবান</option>
                                <option value="হবিগঞ্জ">হবিগঞ্জ</option>
                                <option value="মৌলভীবাজার">মৌলভীবাজার</option>
                                <option value="সুনামগঞ্জ">সুনামগঞ্জ</option>
                                <option value="নওগাঁ">নওগাঁ</option>
                                <option value="নাটোর">নাটোর</option>
                                <option value="চাঁপাইনবাবগঞ্জ">চাঁপাইনবাবগঞ্জ</option>
                                <option value="পাবনা">পাবনা</option>
                                <option value="সিরাজগঞ্জ">সিরাজগঞ্জ</option>
                                <option value="বগুড়া">বগুড়া</option>
                                <option value="জয়পুরহাট">জয়পুরহাট</option>
                                <option value="দিনাজপুর">দিনাজপুর</option>
                                <option value="ঠাকুরগাঁও">ঠাকুরগাঁও</option>
                                <option value="পঞ্চগড়">পঞ্চগড়</option>
                                <option value="নীলফামারী">নীলফামারী</option>
                                <option value="লালমনিরহাট">লালমনিরহাট</option>
                                <option value="কুড়িগ্রাম">কুড়িগ্রাম</option>
                                <option value="গাইবান্ধা">গাইবান্ধা</option>
                                <option value="শেরপুর">শেরপুর</option>
                                <option value="জামালপুর">জামালপুর</option>
                                <option value="নেত্রকোনা">নেত্রকোনা</option>
                                <option value="কিশোরগঞ্জ">কিশোরগঞ্জ</option>
                            </select>
                            <svg class="absolute right-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">প্রিয়জনের পূর্ণ ঠিকানা *</label>
                        <textarea x-model="form.recipient_address" rows="3" placeholder="বাসা নম্বর, রোড নম্বর, এলাকা, থানা..."
                                  class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-brand-pink/30 focus:border-brand-pink outline-none transition-all resize-none"></textarea>
                    </div>
                </div>

                {{-- ❷ উপহার প্রদানকারী তথ্য (Sender Info) --}}
                <div class="checkout-section sender-section rounded-2xl p-6 sm:p-8" data-step="❷">
                    <h2 class="text-lg font-bold text-gray-900 mb-1">উপহার প্রদানকারী তথ্য</h2>
                    <p class="text-xs text-gray-500 mb-6">আপনার তথ্য দিন</p>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1.5">আপনার নাম *</label>
                            <div class="relative">
                                <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                </span>
                                <input type="text" x-model="form.sender_name" placeholder="আপনার পূর্ণ নাম"
                                       class="w-full pl-10 pr-4 py-3 bg-white border border-pink-200 rounded-xl text-sm focus:ring-2 focus:ring-brand-pink/30 focus:border-brand-pink outline-none transition-all">
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1.5">WhatsApp নম্বর *</label>
                            <div class="flex gap-2">
                                <div class="flex items-center gap-1 px-3 py-3 bg-white border border-pink-200 rounded-xl text-sm text-gray-500 shrink-0">
                                    <span class="text-xs">🇧🇩</span>
                                    <span>বাংলাদেশ</span>
                                    <span class="text-gray-300">▾</span>
                                    <span class="text-gray-700 font-medium">+880</span>
                                </div>
                                <input type="tel" x-model="form.sender_whatsapp" placeholder="নম্বর লিখুন"
                                       class="w-full px-4 py-3 bg-white border border-pink-200 rounded-xl text-sm focus:ring-2 focus:ring-brand-pink/30 focus:border-brand-pink outline-none transition-all">
                            </div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">নোট / চিরকুট (ঐচ্ছিক)</label>
                        <textarea x-model="form.note" rows="3" placeholder="আপনার প্রিয়জনের জন্য কোনো বিশেষ বার্তা বা নির্দেশনা লিখুন..."
                                  class="w-full px-4 py-3 bg-white border border-pink-200 rounded-xl text-sm focus:ring-2 focus:ring-brand-pink/30 focus:border-brand-pink outline-none transition-all resize-none"></textarea>
                    </div>

                    {{-- WhatsApp Info Banner --}}
                    <div class="flex items-start gap-3 bg-blue-50 border border-blue-100 rounded-xl px-4 py-3">
                        <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center shrink-0 mt-0.5">
                            <svg class="w-4 h-4 text-blue-500" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/></svg>
                        </div>
                        <p class="text-xs text-blue-700 leading-relaxed">
                            আপনার পাঠানো নম্বরে অর্ডার রেডিকৃত হওয়ার পরে এবং ডেলিভারি সংক্রান্ত বিষয়ে আপনাকে পরে WhatsApp এ যোগাযোগ করা হবে
                        </p>
                    </div>
                </div>

                {{-- ❸ পেমেন্ট মেথড (Payment Method) --}}
                <div class="checkout-section bg-white rounded-2xl p-6 sm:p-8 shadow-sm border border-gray-100" data-step="❸">
                    <h2 class="text-lg font-bold text-gray-900 mb-6">পেমেন্ট মেথড</h2>

                    <div class="space-y-3">
                        {{-- Cash on Delivery --}}
                        <label class="payment-option flex items-center gap-4 p-4 border-2 rounded-2xl cursor-pointer"
                               :class="form.payment_method === 'cod' ? 'border-brand-pink bg-pink-50/50' : 'border-gray-200 hover:border-gray-300'">
                            <input type="radio" x-model="form.payment_method" value="cod" class="hidden">
                            <div class="w-12 h-12 rounded-xl flex items-center justify-center shrink-0"
                                 :class="form.payment_method === 'cod' ? 'bg-pink-100' : 'bg-gray-100'">
                                <span class="text-2xl">💛</span>
                            </div>
                            <div class="flex-1">
                                <h3 class="font-bold text-gray-800 text-sm">ক্যাশ অন ডেলিভারি</h3>
                                <p class="text-xs text-gray-400">পণ্য হাতে পেয়ে পেমেন্ট করুন</p>
                            </div>
                            <div class="w-6 h-6 rounded-full border-2 flex items-center justify-center shrink-0"
                                 :class="form.payment_method === 'cod' ? 'border-brand-pink' : 'border-gray-300'">
                                <div class="w-3 h-3 rounded-full bg-brand-pink" x-show="form.payment_method === 'cod'"></div>
                            </div>
                        </label>
                    </div>
                </div>
            </div>

            {{-- Right Column: Order Summary --}}
            <div class="lg:col-span-1">
                <div class="order-summary bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
                    <h2 class="text-lg font-bold text-gray-900 mb-5">আপনার অর্ডার সামারি</h2>

                    {{-- Order Items --}}
                    <div class="space-y-4 mb-6">
                        <template x-for="(item, index) in cartItems" :key="item.id">
                            <div class="flex items-center gap-3">
                                <div class="w-14 h-14 bg-gray-50 rounded-xl overflow-hidden border border-gray-100 shrink-0">
                                    <img :src="item.image || '/images/placeholder.png'" class="w-full h-full object-cover" :alt="item.name">
                                </div>
                                <div class="flex-1 min-w-0">
                                    <h4 class="text-sm font-semibold text-gray-800 truncate" x-text="item.name"></h4>
                                    <p class="text-xs text-gray-400" x-text="item.qty + ' X ৳' + Number(item.price).toLocaleString('bn-BD')"></p>
                                </div>
                                <span class="text-sm font-bold text-gray-800 shrink-0">৳<span x-text="Number(item.price * item.qty).toLocaleString('bn-BD')"></span></span>
                            </div>
                        </template>
                    </div>

                    {{-- Divider --}}
                    <div class="border-t border-gray-100 my-4"></div>

                    {{-- Totals --}}
                    <div class="space-y-3 text-sm">
                        <div class="flex justify-between">
                            <span class="text-gray-500">সাব-টোটাল</span>
                            <span class="font-medium text-gray-700">৳<span x-text="Number(subtotal).toLocaleString('bn-BD')"></span></span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-500">ডেলিভারি চার্জ</span>
                            <span class="font-medium text-gray-700" x-text="deliveryCharge > 0 ? '৳' + Number(deliveryCharge).toLocaleString('bn-BD') : 'ফ্রি'"></span>
                        </div>
                        <div class="flex justify-between" x-show="appliedDiscount > 0">
                            <span class="text-green-600">ডিস্কাউন্ট (<span x-text="form.coupon_code"></span>)</span>
                            <span class="font-medium text-green-600">-৳<span x-text="Number(appliedDiscount).toLocaleString('bn-BD')"></span></span>
                        </div>
                    </div>

                    {{-- Grand Total --}}
                    <div class="border-t border-gray-200 mt-4 pt-4">
                        <div class="flex justify-between items-center">
                            <span class="text-base font-bold text-gray-900">সর্বমোট</span>
                            <span class="text-xl font-bold text-brand-pink">৳<span x-text="Number(grandTotal).toLocaleString('bn-BD')"></span></span>
                        </div>
                    </div>

                    {{-- Coupon --}}
                    <div class="mt-5">
                        <p class="text-xs text-gray-500 mb-2">ডিস্কাউন্ট কুপন আছে?</p>
                        <div class="flex gap-2">
                            <div class="relative flex-1">
                                <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
                                </span>
                                <input type="text" x-model="form.coupon_code" placeholder="কোডটি প্রদান করুন..."
                                       class="w-full pl-10 pr-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-brand-pink/30 focus:border-brand-pink outline-none transition-all">
                            </div>
                            <button type="button" @click="applyCoupon()" :disabled="couponLoading"
                                    class="px-5 py-2.5 bg-brand-pink text-white text-sm font-bold rounded-xl hover:bg-brand-pink-dark transition-colors shrink-0 disabled:opacity-60">
                                <span x-show="!couponLoading">APPLY</span>
                                <span x-show="couponLoading">...</span>
                            </button>
                        </div>
                    </div>

                    {{-- Coupon Message --}}
                    <div x-show="couponMessage" class="mt-2 text-xs font-medium" :class="couponSuccess ? 'text-green-600' : 'text-red-500'" x-text="couponMessage"></div>

                    {{-- Submit Button --}}
                    <button type="submit" :disabled="isSubmitting"
                            class="w-full mt-6 flex items-center justify-center gap-2 py-4 bg-gradient-to-r from-brand-pink to-brand-pink-dark hover:from-brand-pink-dark hover:to-brand-pink text-white rounded-2xl font-bold text-base transition-all duration-300 shadow-lg shadow-pink-300/40 hover:shadow-pink-400/60 hover:-translate-y-0.5 disabled:opacity-70 disabled:cursor-not-allowed disabled:hover:translate-y-0">
                        <template x-if="!isSubmitting">
                            <span class="flex items-center gap-2">অর্ডার কনফার্ম করুন <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg></span>
                        </template>
                        <template x-if="isSubmitting">
                            <span class="flex items-center gap-2">
                                <svg class="animate-spin w-5 h-5" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"/></svg>
                                প্রসেস হচ্ছে...
                            </span>
                        </template>
                    </button>
                </div>
            </div>
        </form>

        {{-- Validation Errors --}}
        @if($errors->any())
        <div class="mt-6 bg-red-50 border border-red-200 rounded-xl p-4">
            <ul class="text-sm text-red-600 space-y-1">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
    </div>
</div>
@endsection

@section('footer')
<footer class="bg-gray-900 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            <div>
                <div class="flex items-center gap-1 mb-4">
                    <span class="text-3xl font-bold text-brand-pink">উপহার</span>
                    <span class="shop-badge">S<br>H<br>O<br>P</span>
                </div>
                <p class="text-gray-400 text-sm leading-relaxed">আপনার প্রিয়জনকে সারপ্রাইজ দিন আমাদের বিশেষ গিফট কালেকশন থেকে।</p>
            </div>
            <div>
                <h3 class="font-semibold text-white mb-4">দ্রুত লিংক</h3>
                <ul class="space-y-2 text-sm text-gray-400">
                    <li><a href="/" class="hover:text-brand-pink transition-colors">হোম</a></li>
                    <li><a href="/gifts" class="hover:text-brand-pink transition-colors">সকল গিফট</a></li>
                    <li><a href="/contact" class="hover:text-brand-pink transition-colors">যোগাযোগ</a></li>
                </ul>
            </div>
            <div>
                <h3 class="font-semibold text-white mb-4">সহায়তা</h3>
                <ul class="space-y-2 text-sm text-gray-400">
                    <li><a href="#" class="hover:text-brand-pink transition-colors">গোপনীয়তা নীতি</a></li>
                    <li><a href="#" class="hover:text-brand-pink transition-colors">রিটার্ন পলিসি</a></li>
                    <li><a href="#" class="hover:text-brand-pink transition-colors">শর্তাবলী</a></li>
                </ul>
            </div>
            <div>
                <h3 class="font-semibold text-white mb-4">যোগাযোগ</h3>
                <ul class="space-y-2 text-sm text-gray-400">
                    <li class="flex items-center gap-2"><span>📞</span> ০১XXXXXXXXX</li>
                    <li class="flex items-center gap-2"><span>📧</span> info&#64;upoharshop.com</li>
                    <li class="flex items-center gap-2"><span>📍</span> ঢাকা, বাংলাদেশ</li>
                </ul>
            </div>
        </div>
        <div class="border-t border-gray-800 mt-10 pt-6 text-center text-sm text-gray-500">
            <p>&copy; {{ date('Y') }} উপহার Shop। সকল স্বত্ব সংরক্ষিত।</p>
        </div>
    </div>
</footer>
@endsection

@section('scripts')
<script>
function checkoutPage() {
    return {
        cartItems: JSON.parse(localStorage.getItem('upohar_cart') || '[]'),
        isSubmitting: false,
        couponLoading: false,
        couponMessage: '',
        couponSuccess: false,
        appliedDiscount: 0,
        form: {
            recipient_name: '',
            recipient_phone: '',
            recipient_district: '',
            recipient_address: '',
            sender_name: '',
            sender_whatsapp: '',
            note: '',
            payment_method: 'cod',
            coupon_code: '',
        },
        errors: {},

        get subtotal() {
            return this.cartItems.reduce((sum, i) => sum + (i.price * i.qty), 0);
        },
        get deliveryCharge() {
            return this.subtotal >= 2500 ? 0 : 150;
        },
        get grandTotal() {
            return this.subtotal + this.deliveryCharge - this.appliedDiscount;
        },

        async applyCoupon() {
            if (!this.form.coupon_code.trim()) return;
            this.couponLoading = true;
            this.couponMessage = '';
            this.appliedDiscount = 0;
            try {
                const res = await fetch(window.baseUrl + '/coupon/apply', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content },
                    body: JSON.stringify({ code: this.form.coupon_code, subtotal: this.subtotal })
                });
                const data = await res.json();
                if (data.success) {
                    this.appliedDiscount = data.discount;
                    this.couponSuccess = true;
                    this.couponMessage = data.message;
                } else {
                    this.couponSuccess = false;
                    this.couponMessage = data.message;
                    this.form.coupon_code = '';
                }
            } catch (e) {
                this.couponSuccess = false;
                this.couponMessage = 'নেটওয়ার্ক সমস্যা, আবার চেষ্টা করুন।';
            } finally {
                this.couponLoading = false;
            }
        },

        validateForm() {
            this.errors = {};
            if (!this.form.recipient_name.trim()) this.errors.recipient_name = 'প্রিয়জনের নাম দিন';
            if (!this.form.recipient_phone.trim()) this.errors.recipient_phone = 'মোবাইল নম্বর দিন';
            if (!this.form.recipient_district) this.errors.recipient_district = 'জেলা নির্বাচন করুন';
            if (!this.form.recipient_address.trim()) this.errors.recipient_address = 'ঠিকানা দিন';
            if (!this.form.sender_name.trim()) this.errors.sender_name = 'আপনার নাম দিন';
            if (!this.form.sender_whatsapp.trim()) this.errors.sender_whatsapp = 'WhatsApp নম্বর দিন';
            return Object.keys(this.errors).length === 0;
        },

        async submitOrder() {
            if (!this.validateForm()) {
                // Scroll to first error
                const firstErrorField = Object.keys(this.errors)[0];
                alert(Object.values(this.errors)[0]);
                return;
            }

            this.isSubmitting = true;

            try {
                const formData = new FormData();
                formData.append('recipient_name', this.form.recipient_name);
                formData.append('recipient_phone', this.form.recipient_phone);
                formData.append('recipient_district', this.form.recipient_district);
                formData.append('recipient_address', this.form.recipient_address);
                formData.append('sender_name', this.form.sender_name);
                formData.append('sender_whatsapp', this.form.sender_whatsapp);
                formData.append('note', this.form.note);
                formData.append('items', JSON.stringify(this.cartItems));
                formData.append('payment_method', this.form.payment_method);
                formData.append('coupon_code', this.form.coupon_code);
                formData.append('discount_applied', this.appliedDiscount);
                formData.append('_token', document.querySelector('meta[name="csrf-token"]').content);

                const res = await fetch(window.baseUrl + '/checkout', {
                    method: 'POST',
                    body: formData,
                });

                if (res.redirected) {
                    // Clear cart on success
                    localStorage.setItem('upohar_cart', '[]');
                    window.dispatchEvent(new CustomEvent('cart-updated'));
                    window.location.href = res.url;
                    return;
                }

                const html = await res.text();
                if (res.status === 422) {
                    alert('ফর্মে ত্রুটি আছে, সকল তথ্য সঠিকভাবে পূরণ করুন।');
                } else {
                    alert('কিছু সমস্যা হয়েছে, আবার চেষ্টা করুন।');
                }
            } catch (e) {
                console.error(e);
                alert('নেটওয়ার্ক সমস্যা, আবার চেষ্টা করুন।');
            } finally {
                this.isSubmitting = false;
            }
        }
    }
}
</script>
@endsection
