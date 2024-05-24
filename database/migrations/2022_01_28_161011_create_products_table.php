<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->integer('product_category_id')->nullable();
            $table->json('brand_id')->nullable();
            $table->text('product_image')->nullable();
            $table->json('product_slides')->nullable();
            $table->string('product_code')->nullable();
            $table->double('price', 15, 2)->default(0)->nullable();
            $table->double('promotion_price', 15, 2)->nullable();
            $table->date('promotion_start')->nullable();
            $table->date('promotion_end')->nullable();
            $table->integer('product_position')->default(0);
            $table->boolean('is_active')->default(1)->comment('0: inactive, 1: active');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
