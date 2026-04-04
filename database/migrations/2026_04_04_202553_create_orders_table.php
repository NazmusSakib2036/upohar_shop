<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_number')->unique();

            // Recipient (প্রিয়জনের তথ্য)
            $table->string('recipient_name');
            $table->string('recipient_phone');
            $table->string('recipient_district');
            $table->text('recipient_address');

            // Sender (উপহার প্রদানকারী)
            $table->string('sender_name');
            $table->string('sender_whatsapp');
            $table->text('note')->nullable();

            // Order details
            $table->json('items');
            $table->decimal('subtotal', 10, 2);
            $table->decimal('delivery_charge', 10, 2)->default(0);
            $table->decimal('discount', 10, 2)->default(0);
            $table->string('coupon_code')->nullable();
            $table->decimal('total', 10, 2);

            // Payment & status
            $table->string('payment_method')->default('cod');
            $table->string('status')->default('pending');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
