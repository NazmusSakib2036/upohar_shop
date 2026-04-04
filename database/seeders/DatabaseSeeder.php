<?php

namespace Database\Seeders;

use App\Models\Slider;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

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
    }
}
