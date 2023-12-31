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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->integer('user_id');
            $table->integer('category_id')->nullable();
            $table->integer('brand_id')->nullable();
            $table->integer('supplier_id')->nullable();
            $table->integer('current_stock')->default(0);
            $table->boolean('featured')->default(0);
            $table->bigInteger('barcode')->nullable();
            $table->longText('description')->nullable();
            $table->text('short_description')->nullable();
            $table->double('price', 64);
            $table->double('price_additional', 64)->default(0);
            $table->double('discount', 64)->default(0);
            $table->string('discount_type')->default('sum');
            $table->double('tax', 64)->default(0);
            $table->string('tax_type')->default('sum');
            $table->string('image')->nullable();
            $table->text('gallery')->nullable();
            $table->text('tags')->nullable();
            $table->longText('attributes')->nullable();
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
        Schema::dropIfExists('products');
    }
};
