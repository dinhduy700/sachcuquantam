<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePageTranslationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('page_translation', function (Blueprint $table) {
            $table->id();
            $table->string('locale');
            $table->integer('page_id');
            $table->string('page_title', 500)->nullable();
            $table->string('page_slug', 800)->nullable();
            $table->text('page_description')->nullable();
            $table->longText('page_content')->nullable();
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
        Schema::dropIfExists('page_translation');
    }
}
