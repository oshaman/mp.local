<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUquestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('uquestions', function (Blueprint $table) {
            $table->increments('id');

            $table->string('alias');
            $table->foreign('alias')->references('alias')->on('umedicines')->onUpdate('cascade')->onDelete('cascade');

            $table->string('question')->index();
            $table->text('answer');

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
        Schema::dropIfExists('uquestions');
    }
}
