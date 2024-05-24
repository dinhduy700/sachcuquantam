<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->integer('customer_id')->nullable();
            $table->string('buyer_name')->nullable();
            $table->string('buyer_phone')->nullable();
            $table->string('buyer_country')->nullable();
            $table->string('buyer_city')->nullable();
            $table->string('buyer_district')->nullable();
            $table->string('buyer_ward')->nullable();
            $table->string('buyer_zipcode')->nullable();
            $table->text('buyer_note')->nullable();
            $table->string('order_code')->nullable();
            $table->string('order_promotion_code')->nullable();
            $table->double('order_amount', 15, 2)->default(0);
            $table->double('order_shipping_fee', 15, 2)->default(0);
            $table->double('order_discount', 15, 2)->default(0);
            $table->double('total_amount', 15, 2)->default(0);
            $table->integer('payment_method')->default(0)->comment('0: COD');
            $table->integer('shipping_method')->nullable();
            $table->integer('order_status')->default(0)->comment('0: pending, 1: approved, 2: shipped, 3: cancelled');
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
        Schema::dropIfExists('orders');
    }
}
