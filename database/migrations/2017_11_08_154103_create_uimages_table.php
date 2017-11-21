<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUimagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('uimages', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('umedicine_id');
            $table->string('path')->nullable()->default(null);
            $table->string('alt')->nullable()->default(null);
            $table->string('title')->nullable()->default(null);

            $table->foreign('umedicine_id')->references('id')->on('umedicines')->onDelete('cascade');
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
        Schema::dropIfExists('uimages');
    }
}
