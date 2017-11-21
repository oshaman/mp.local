<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUphotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('uphotos', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('umedicine_id');
            $table->string('path');

            $table->unique(['umedicine_id', 'path']);
            $table->foreign('umedicine_id')->references('id')->on('umedicines')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('uphotos');
    }
}
