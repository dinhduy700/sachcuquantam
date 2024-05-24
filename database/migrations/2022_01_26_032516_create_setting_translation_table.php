<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingTranslationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('setting_translation', function (Blueprint $table) {
            $table->id();
            $table->string('locale');
            $table->string('site')->nullable();
            $table->text('description')->nullable();
            $table->text('office')->nullable();
            $table->text('working_time')->nullable();
            $table->text('address')->nullable();
            $table->text('policy')->nullable()->comment('Policy short description in footer');
            $table->text('payment_at')->nullable()->comment('Payment short description in footer');
            $table->text('shipping_free')->nullable()->comment('Shipping short description in footer');
            $table->text('staffs')->nullable()->comment('Staffs short description in footer');
            $table->string('seo_title')->nullable();
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
        Schema::dropIfExists('setting_translation');
    }
}
