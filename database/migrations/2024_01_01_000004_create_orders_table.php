<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_number')->unique();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('customer_name');
            $table->string('customer_phone');
            $table->text('shipping_address');
            $table->integer('total_amount');
            $table->enum('status', ['pending', 'paid', 'completed', 'cancelled'])->default('pending');
            $table->string('payment_method')->default('whatsapp'); // 'whatsapp' atau 'cod'
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
