<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewsTranslationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news_translation', function (Blueprint $table) {
            $table->id();
            $table->string('locale');
            $table->integer('news_id')->nullable();
            $table->string('news_title', 500)->nullable();
            $table->string('news_slug', 800)->nullable();
            $table->text('news_description')->nullable();
            $table->longText('news_content')->nullable();
            $table->string('seo_title', 500)->nullable();
            $table->text('seo_description')->nullable();
            $table->text('seo_keywords')->nullable();
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
        Schema::dropIfExists('news_translation');
    }
}
