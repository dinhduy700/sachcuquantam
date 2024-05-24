<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news', function (Blueprint $table) {
            $table->id();
            $table->json('tag_id')->nullable();
            $table->text('news_image')->nullable();
            $table->dateTime('news_publish')->nullable();
            $table->integer('news_position')->default(0);
            $table->boolean('is_active')->default(1)->comment('0: inactive, 1: active');
            $table->boolean('is_hot_news')->default(0)->comment('0: inactive, 1: active');
            $table->boolean('is_promotion_news')->default(0)->comment('0: inactive, 1: active');
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
        Schema::dropIfExists('news');
    }
}
