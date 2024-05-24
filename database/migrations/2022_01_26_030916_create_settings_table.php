<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->text('logo')->nullable();
            $table->text('logo_footer')->nullable();
            $table->string('email')->nullable();
            $table->string('tel')->nullable();
            $table->string('hotline')->nullable();
            $table->string('fax')->nullable();
            $table->text('map')->nullable();
            $table->string('facebook')->nullable();
            $table->string('google_plus')->nullable();
            $table->string('pinterest')->nullable();
            $table->string('instagram')->nullable();
            $table->string('twitter')->nullable();
            $table->string('youtube')->nullable();
            $table->string('zalo')->nullable();
            $table->text('fanpage')->nullable();
            $table->text('fb_script')->nullable();
            $table->text('zalo_script')->nullable();
            $table->text('google_analystics')->nullable();
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
        Schema::dropIfExists('settings');
    }
}
