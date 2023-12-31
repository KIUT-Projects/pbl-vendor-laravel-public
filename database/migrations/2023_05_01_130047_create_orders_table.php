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
            $table->integer('user_id')->nullable();
            $table->integer('customer_id')->nullable();
            $table->string('coupon_code')->nullable();
            $table->double('price')->default('0');
            $table->double('price_vat')->default('0');
            $table->double('price_delivery')->default('0');
            $table->double('price_discount')->default('0');
            $table->double('total_price')->default('0');
            $table->string('payment_method')->default('cash');
            $table->boolean('status')->default(1);
            $table->timestamps();
            $table->softDeletes();
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
