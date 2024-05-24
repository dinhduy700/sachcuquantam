<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVideoTranslationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('video_translation', function (Blueprint $table) {
            $table->id();
            $table->string('locale');
            $table->integer('video_id')->nullable();
            $table->string('video_title')->nullable();
            $table->string('video_slug')->nullable();
            $table->string('video_link')->nullable();
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
        Schema::dropIfExists('video_translation');
    }
}
