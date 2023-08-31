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
            $table->string('order_id');
            $table->unsignedBigInteger('product_id'); // Add the reference to the product
            $table->string('guest_id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('company_name')->nullable();
            $table->string('vat')->nullable();
            $table->string('address');
            $table->string('zip');
            $table->string('phone');
            $table->string('client_email');
            $table->text('comment')->nullable();
            $table->unsignedBigInteger('quantity')->default(1); // Minimum quantity of 1
            $table->timestamps();

            // Define the foreign key relationship with the products table
            $table->foreign('product_id')->references('id')->on('products');
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
