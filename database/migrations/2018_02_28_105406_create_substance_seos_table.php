<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubstanceSeosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('substance_seos', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('substance_id');
            $table->foreign('substance_id')->references('id')->on('substances')->onDelete('cascade');

            $table->string('seo_title')->nullable();
            $table->string('seo_keywords')->nullable();
            $table->string('seo_description')->nullable();
            $table->text('seo_text')->nullable();
            $table->string('og_title')->nullable();
            $table->string('og_description')->nullable();
            $table->string('og_image')->nullable();

            $table->string('useo_title')->nullable()->default(null);
            $table->string('useo_keywords')->nullable()->default(null);
            $table->string('useo_description')->nullable()->default(null);
            $table->string('uog_image')->nullable()->default(null);
            $table->string('uog_title')->nullable()->default(null);
            $table->string('uog_description')->nullable()->default(null);
            $table->text('useo_text')->nullable()->default(null);

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
        Schema::dropIfExists('substance_seos');
    }
}
