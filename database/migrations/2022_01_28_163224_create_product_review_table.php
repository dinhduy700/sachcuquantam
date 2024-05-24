<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductReviewTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_review', function (Blueprint $table) {
            $table->id();
            $table->integer('product_id')->nullable();
            $table->integer('reply_id')->default(0)->nullable();
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->text('review_content')->nullable();
            $table->text('file')->nullable();
            $table->integer('score')->default(1)->comment('from 1 to 5');
            $table->boolean('is_active')->default(0)->comment('0: inactive, 1:active');
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
        Schema::dropIfExists('product_review');
    }
}
