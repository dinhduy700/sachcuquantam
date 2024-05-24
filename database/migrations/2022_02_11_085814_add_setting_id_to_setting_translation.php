<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSettingIdToSettingTranslation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('setting_translation', function (Blueprint $table) {
            $table->integer('setting_id')->nullable()->after('locale');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('setting_translation', function (Blueprint $table) {
            $table->dropColumn('setting_id');
        });
    }
}
