<?php

use App\Enums\OrderStatusEnum;
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
            $table->string('order_number');
            $table->string('customer_name');
            $table->string('customer_phone_number');
            $table->string('customer_chat_id')->nullable();
            $table->enum('order_status', [
                OrderStatusEnum::WAITING->value,
                OrderStatusEnum::PREPARING->value,
                OrderStatusEnum::DONE->value
            ])->default(OrderStatusEnum::WAITING->value);
            $table->string('order_summary')->nullable();
            $table->integer('floor');
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
