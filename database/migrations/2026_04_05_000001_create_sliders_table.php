<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sliders', function (Blueprint $table) {
            $table->id();
            $table->string('badge_1')->nullable();
            $table->string('badge_2')->nullable();
            $table->string('heading_normal');
            $table->string('heading_highlight');
            $table->string('heading_emoji')->nullable();
            $table->text('description');
            $table->string('btn_primary_text')->default('অর্ডার করুন');
            $table->string('btn_primary_link')->default('/gifts');
            $table->string('btn_secondary_text')->nullable();
            $table->string('btn_secondary_link')->nullable();
            $table->string('image')->nullable();
            $table->string('stat_1')->default('৫০০০+ সন্তুষ্ট গ্রাহক');
            $table->string('stat_2')->default('৪০০০+ গিফট আইটেম');
            $table->string('stat_3')->default('২৪/৭ কাস্টমার সাপোর্ট');
            $table->integer('order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sliders');
    }
};
