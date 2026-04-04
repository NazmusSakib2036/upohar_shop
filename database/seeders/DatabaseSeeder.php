<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\Slider;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        // Admin user
        User::updateOrCreate(
            ['email' => 'admin@upoharshop.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('admin123'),
                'is_admin' => true,
            ]
        );

        // Default sliders
        Slider::create([
            'badge_1' => 'SPECIAL OFFER',
            'badge_2' => '10% অফার',
            'heading_normal' => '10% বিশেষ',
            'heading_highlight' => 'ছাড়',
            'heading_emoji' => '🎊',
            'description' => 'আমাদের ওয়েবসাইট থেকে প্রথম অর্ডারে পাবেন সকল পণ্যে 10% ডিসকাউন্ট। যেকোনো তথ্যের জন্য ইনবক্স করুন আমাদের ফেসবুক পেজে অথবা যোগাযোগ করুন হোয়াটসঅ্যাপে। 💌 ✨',
            'btn_primary_text' => 'অর্ডার করুন',
            'btn_primary_link' => '/gifts',
            'btn_secondary_text' => 'সকল গিফট দেখুন',
            'btn_secondary_link' => '/gifts',
            'order' => 0,
            'is_active' => true,
        ]);

        Slider::create([
            'badge_1' => 'NEW ARRIVAL',
            'badge_2' => 'ফ্রি ডেলিভারি',
            'heading_normal' => 'ফ্রি ডেলিভারি',
            'heading_highlight' => 'চার্জ!',
            'heading_emoji' => '🚚',
            'description' => '৳২৫০০+ অর্ডারে সারা বাংলাদেশে ফ্রি ডেলিভারি। প্রিয়জনের কাছে সারপ্রাইজ পাঠিয়ে দিন, গিফট র্যাপিং ফ্রি! 🎁 💝',
            'btn_primary_text' => 'শপিং শুরু করুন',
            'btn_primary_link' => '/gifts',
            'btn_secondary_text' => 'আরো জানুন',
            'btn_secondary_link' => '/contact',
            'order' => 1,
            'is_active' => true,
        ]);

        Slider::create([
            'badge_1' => 'PREMIUM GIFT',
            'badge_2' => 'নতুন কালেকশন',
            'heading_normal' => 'প্রিমিয়াম গিফট',
            'heading_highlight' => 'বক্স!',
            'heading_emoji' => '🎁',
            'description' => 'বিশেষ দিনে বিশেষ মানুষকে দিন প্রিমিয়াম গিফট বক্স। কাস্টম মেসেজ কার্ড সহ ডেলিভারি। বিশেষ প্যাকেজিং এ। 🌟 💐',
            'btn_primary_text' => 'গিফট বক্স দেখুন',
            'btn_primary_link' => '/gifts',
            'btn_secondary_text' => 'কাস্টম অর্ডার',
            'btn_secondary_link' => '/contact',
            'order' => 2,
            'is_active' => true,
        ]);

        // Categories
        $categories = [
            ['name' => 'সেন্টি',        'icon_color' => '#E91E63', 'bg_color' => '#FCE4EC', 'order' => 1],
            ['name' => 'ফুল মালা',      'icon_color' => '#FF5722', 'bg_color' => '#FBE9E7', 'order' => 2],
            ['name' => 'বাবি চুড়ি',     'icon_color' => '#9C27B0', 'bg_color' => '#F3E5F5', 'order' => 3],
            ['name' => 'বেনারসি',       'icon_color' => '#FF9800', 'bg_color' => '#FFF3E0', 'order' => 4],
            ['name' => 'ভেনাস চুড়ি',    'icon_color' => '#4CAF50', 'bg_color' => '#E8F5E9', 'order' => 5],
            ['name' => 'শাখা চুড়ি',     'icon_color' => '#F44336', 'bg_color' => '#FFEBEE', 'order' => 6],
            ['name' => 'সারপ্রাইজ গিফট', 'icon_color' => '#2196F3', 'bg_color' => '#E3F2FD', 'order' => 7],
            ['name' => 'সিন্দু শাড়ি',    'icon_color' => '#E91E63', 'bg_color' => '#FCE4EC', 'order' => 8],
            ['name' => 'সুতার চুড়ি',    'icon_color' => '#FF6F00', 'bg_color' => '#FFF8E1', 'order' => 9],
            ['name' => 'সুতার মালা',    'icon_color' => '#00BCD4', 'bg_color' => '#E0F7FA', 'order' => 10],
        ];

        $categoryModels = [];
        foreach ($categories as $cat) {
            $categoryModels[] = Category::create([
                'name'       => $cat['name'],
                'slug'       => Str::slug($cat['name'], '-', null),
                'icon_color' => $cat['icon_color'],
                'bg_color'   => $cat['bg_color'],
                'order'      => $cat['order'],
                'is_active'  => true,
            ]);
        }

        // Sample Products
        $sampleProducts = [
            [
                'category_idx' => 0,
                'name' => 'রেড সেন্টি সেট',
                'price' => 1200,
                'old_price' => 1500,
                'discount_percent' => 20,
                'badge' => 'HOT',
                'badge_color' => '#E91E63',
                'is_combo' => false,
                'free_delivery' => true,
                'stock' => 25,
                'is_featured' => true,
                'short_description' => 'সুন্দর রেড সেন্টি সেট - বিশেষ দিনের জন্য পারফেক্ট।',
                'description' => 'প্রিমিয়াম কোয়ালিটির রেড সেন্টি সেট। বিয়ে, পার্টি বা যেকোনো বিশেষ অনুষ্ঠানের জন্য উপযুক্ত। দীর্ঘস্থায়ী রং এবং আরামদায়ক ডিজাইন।',
            ],
            [
                'category_idx' => 0,
                'name' => 'গোল্ডেন সেন্টি কালেকশন',
                'price' => 1800,
                'old_price' => 2200,
                'discount_percent' => 18,
                'badge' => 'NEW',
                'badge_color' => '#4CAF50',
                'is_combo' => false,
                'free_delivery' => true,
                'stock' => 15,
                'is_featured' => true,
                'short_description' => 'এক্সক্লুসিভ গোল্ডেন সেন্টি - প্রিমিয়াম কোয়ালিটি।',
                'description' => 'গোল্ডেন কালারের প্রিমিয়াম সেন্টি কালেকশন। হাতে তৈরি ডিজাইন, উচ্চমানের উপকরণ ব্যবহার করা হয়েছে।',
            ],
            [
                'category_idx' => 1,
                'name' => 'রজনীগন্ধা ফুল মালা',
                'price' => 800,
                'old_price' => 1000,
                'discount_percent' => 20,
                'badge' => null,
                'badge_color' => null,
                'is_combo' => false,
                'free_delivery' => false,
                'stock' => 50,
                'is_featured' => true,
                'short_description' => 'তাজা রজনীগন্ধা ফুলের মালা।',
                'description' => 'ফ্রেশ রজনীগন্ধা ফুল দিয়ে তৈরি সুন্দর মালা। বিয়ে, পূজা বা বিশেষ অনুষ্ঠানের জন্য পারফেক্ট। তাজা ফুল ব্যবহার করা হয়।',
            ],
            [
                'category_idx' => 2,
                'name' => 'প্রিমিয়াম বাবি চুড়ি সেট',
                'price' => 2500,
                'old_price' => 3000,
                'discount_percent' => 17,
                'badge' => 'BEST',
                'badge_color' => '#FF9800',
                'is_combo' => true,
                'free_delivery' => true,
                'stock' => 10,
                'is_featured' => true,
                'short_description' => 'কম্বো বাবি চুড়ি সেট - ৬ পিস।',
                'description' => '৬ পিসের প্রিমিয়াম বাবি চুড়ি সেট। বিভিন্ন ডিজাইন এবং কালার কম্বিনেশন। দীর্ঘস্থায়ী এবং স্কিন-ফ্রেন্ডলি উপকরণ।',
            ],
            [
                'category_idx' => 3,
                'name' => 'বেনারসি সিল্ক শাড়ি',
                'price' => 3300,
                'old_price' => 3750,
                'discount_percent' => 12,
                'badge' => 'COMBO',
                'badge_color' => '#E91E63',
                'is_combo' => true,
                'free_delivery' => true,
                'stock' => 8,
                'is_featured' => true,
                'short_description' => 'অরিজিনাল বেনারসি সিল্ক শাড়ি।',
                'description' => 'ভারতের বেনারস থেকে আনা অরিজিনাল সিল্ক শাড়ি। এক্সক্লুসিভ ডিজাইন, প্রিমিয়াম কোয়ালিটির সিল্ক ফেব্রিক। বিয়ে বা বিশেষ অনুষ্ঠানের জন্য আইডিয়াল।',
            ],
            [
                'category_idx' => 4,
                'name' => 'ভেনাস চুড়ি গোল্ড প্লেটেড',
                'price' => 1500,
                'old_price' => 1800,
                'discount_percent' => 17,
                'badge' => null,
                'badge_color' => null,
                'is_combo' => false,
                'free_delivery' => false,
                'stock' => 30,
                'is_featured' => false,
                'short_description' => 'গোল্ড প্লেটেড ভেনাস চুড়ি।',
                'description' => 'হাই কোয়ালিটি গোল্ড প্লেটেড ভেনাস চুড়ি। ফ্যাশনেবল ডিজাইন, সব ধরনের পোশাকের সাথে মানানসই।',
            ],
            [
                'category_idx' => 5,
                'name' => 'শাখা চুড়ি কম্প্লিট সেট',
                'price' => 2800,
                'old_price' => 3500,
                'discount_percent' => 20,
                'badge' => 'HOT',
                'badge_color' => '#F44336',
                'is_combo' => true,
                'free_delivery' => true,
                'stock' => 12,
                'is_featured' => true,
                'short_description' => 'বিয়ের শাখা চুড়ি কম্প্লিট সেট।',
                'description' => 'বিয়ের জন্য পারফেক্ট শাখা চুড়ি কম্প্লিট সেট। শাখা, পলা, নোয়া সহ সব কিছু একসাথে। ট্র্যাডিশনাল ডিজাইন।',
            ],
            [
                'category_idx' => 6,
                'name' => 'সারপ্রাইজ গিফট বক্স ডিলাক্স',
                'price' => 3500,
                'old_price' => 4000,
                'discount_percent' => 12,
                'badge' => 'COMBO',
                'badge_color' => '#2196F3',
                'is_combo' => true,
                'free_delivery' => true,
                'stock' => 20,
                'is_featured' => true,
                'short_description' => 'ডিলাক্স সারপ্রাইজ গিফট বক্স - ৮+ আইটেম।',
                'description' => '৮+ আইটেমের ডিলাক্স সারপ্রাইজ গিফট বক্স। চকলেট, টেডি বিয়ার, ফুল, কার্ড এবং আরও অনেক সারপ্রাইজ আইটেম। কাস্টম মেসেজ কার্ড ফ্রি!',
            ],
            [
                'category_idx' => 7,
                'name' => 'সিন্দু শাড়ি - মেরুন কালেকশন',
                'price' => 2200,
                'old_price' => 2800,
                'discount_percent' => 21,
                'badge' => 'SALE',
                'badge_color' => '#E91E63',
                'is_combo' => false,
                'free_delivery' => true,
                'stock' => 18,
                'is_featured' => false,
                'short_description' => 'প্রিমিয়াম সিন্দু শাড়ি মেরুন কালার।',
                'description' => 'সুন্দর মেরুন কালারের সিন্দু শাড়ি। হালকা এবং আরামদায়ক ফেব্রিক। সব ঋতুতে পরা যায়।',
            ],
            [
                'category_idx' => 8,
                'name' => 'রংধনু সুতার চুড়ি সেট',
                'price' => 450,
                'old_price' => 600,
                'discount_percent' => 25,
                'badge' => null,
                'badge_color' => null,
                'is_combo' => false,
                'free_delivery' => false,
                'stock' => 100,
                'is_featured' => false,
                'short_description' => '৬ পিস রংধনু সুতার চুড়ি।',
                'description' => 'হ্যান্ডমেইড রংধনু কালারের সুতার চুড়ি সেট। ৬ পিসের সেট। হালকা এবং আরামদায়ক।',
            ],
            [
                'category_idx' => 9,
                'name' => 'হ্যান্ডমেইড সুতার মালা',
                'price' => 350,
                'old_price' => 500,
                'discount_percent' => 30,
                'badge' => 'SALE',
                'badge_color' => '#4CAF50',
                'is_combo' => false,
                'free_delivery' => false,
                'stock' => 80,
                'is_featured' => false,
                'short_description' => 'সুন্দর হ্যান্ডমেইড সুতার মালা।',
                'description' => 'ট্র্যাডিশনাল হ্যান্ডমেইড সুতার মালা। বিভিন্ন রঙ এবং ডিজাইনে পাওয়া যায়। প্রতিদিনের ব্যবহারের জন্য পারফেক্ট।',
            ],
            [
                'category_idx' => 6,
                'name' => 'মিনি সারপ্রাইজ বক্স',
                'price' => 1500,
                'old_price' => 1800,
                'discount_percent' => 17,
                'badge' => 'NEW',
                'badge_color' => '#2196F3',
                'is_combo' => false,
                'free_delivery' => true,
                'stock' => 35,
                'is_featured' => true,
                'short_description' => 'ছোট কিন্তু সুন্দর সারপ্রাইজ বক্স।',
                'description' => 'ছোট সাইজের সারপ্রাইজ গিফট বক্স। ৪-৫টি আইটেম সহ। জন্মদিন, ভ্যালেন্টাইনস ডে বা যেকোনো বিশেষ দিনের জন্য পারফেক্ট।',
            ],
        ];

        foreach ($sampleProducts as $idx => $p) {
            Product::create([
                'category_id'       => $categoryModels[$p['category_idx']]->id,
                'name'              => $p['name'],
                'slug'              => Str::slug($p['name'], '-', null),
                'price'             => $p['price'],
                'old_price'         => $p['old_price'],
                'discount_percent'  => $p['discount_percent'],
                'badge'             => $p['badge'],
                'badge_color'       => $p['badge_color'] ?? '#E91E63',
                'is_combo'          => $p['is_combo'],
                'free_delivery'     => $p['free_delivery'],
                'stock'             => $p['stock'],
                'is_active'         => true,
                'is_featured'       => $p['is_featured'],
                'short_description' => $p['short_description'],
                'description'       => $p['description'],
                'image'             => null,
                'gallery'           => null,
                'sku'               => 'UPO-' . str_pad($idx + 1, 4, '0', STR_PAD_LEFT),
                'order'             => $idx,
            ]);
        }
    }
}
