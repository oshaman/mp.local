<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class KeysMedicineSubstanceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('medicine_substance', function (Blueprint $table) {
            $table->foreign('medicine_id')->references('id')->on('medicines')->onDelete('cascade');
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
        Schema::table('medicine_substance', function (Blueprint $table) {
            $table->dropForeign(['medicine_id']);
            $table->dropForeign(['substance_id']);
        });
    }
}
