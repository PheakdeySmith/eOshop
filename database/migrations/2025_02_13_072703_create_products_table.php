<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('product_code')->unique();
            $table->string('product_name');
            $table->decimal('price', 8, 2);
            $table->string('category_name');
            $table->integer('stock_quantity');
            $table->text('description')->nullable();
            $table->string('image')->nullable();
	        $table->boolean('on_sale')->default(0);
            $table->decimal('discount_price', 10, 2)->nullable();
            $table->string('slug')->unique();
            $table->decimal('weight', 10, 2)->nullable();
            $table->string('dimensions')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('products');
    }
}
