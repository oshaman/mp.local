<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTopthemesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('topthemes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('description');
            $table->string('link');
            $table->string('path');
            $table->string('alt')->nullable()->default(null);
            $table->string('imgtitle')->nullable()->default(null);
            $table->unsignedTinyInteger('priority')->nullable()->default(null)->index();

            $table->enum('loc', ['ru', 'ua'])->index();
            $table->boolean('approved')->index()->default(false)->index();

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
        Schema::dropIfExists('topthemes');
    }
}
