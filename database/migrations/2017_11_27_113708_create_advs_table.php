<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdvsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('utitle');
            $table->string('path')->nullable()->default(null);
            $table->string('upath')->nullable()->default(null);
            $table->string('img_alt')->nullable()->default(null);
            $table->string('uimg_alt')->nullable()->default(null);
            $table->string('img_title')->nullable()->default(null);
            $table->string('uimg_title')->nullable()->default(null);
            $table->text('text')->nullable()->default(null);
            $table->text('utext')->nullable()->default(null);
            $table->boolean('approved')->index()->default(true)->index();

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
        Schema::dropIfExists('advs');
    }
}
