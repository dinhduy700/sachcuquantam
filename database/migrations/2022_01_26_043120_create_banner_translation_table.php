<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBannerTranslationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banner_translation', function (Blueprint $table) {
            $table->id();
            $table->string('locale');
            $table->integer('banner_id')->nullable();
            $table->string('banner_title')->nullable();
            $table->text('banner_image')->nullable();
            $table->string('banner_link')->nullable();
            $table->text('banner_content')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('banner_translation');
    }
}
