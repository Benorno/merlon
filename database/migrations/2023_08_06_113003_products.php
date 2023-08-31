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
            $table->unsignedBigInteger('category_id')->nullable();
            $table->string('product_code')->unique();
            $table->string('photo')->nullable();
            $table->string('name');
            $table->string('material')->nullable();
            $table->string('top_width')->nullable();
            $table->string('bottom_width')->nullable();
            $table->string('height')->nullable();
            $table->string('weight')->nullable();
            $table->string('quantity_carton')->nullable();
            $table->string('origin')->default('UK');
            $table->text('description')->nullable();
            $table->decimal('price', 10, 2);
            $table->integer('stock_quantity')->unsigned();
            $table->unsignedInteger('views')->default(0);
            $table->boolean('stockable')->default('0');
            $table->boolean('nucleated')->default('0');
            $table->boolean('is_hidden')->default('0');
            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('categories');
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
