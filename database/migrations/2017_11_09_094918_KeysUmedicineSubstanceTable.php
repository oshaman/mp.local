<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class KeysUmedicineSubstanceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('umedicine_substance', function (Blueprint $table) {
            $table->foreign('umedicine_id')->references('id')->on('umedicines')->onDelete('cascade');
            $table->foreign('substance_id')->references('id')->on('substances');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('umedicine_substance', function (Blueprint $table) {
            $table->dropForeign(['umedicine_id']);
            $table->dropForeign(['substance_id']);
        });
    }
}
