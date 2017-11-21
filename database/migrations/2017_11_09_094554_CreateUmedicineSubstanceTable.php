<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUmedicineSubstanceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('umedicine_substance', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('umedicine_id')->unsigned()->default(1);
            $table->integer('substance_id')->unsigned()->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('umedicine_substance');
    }
}
