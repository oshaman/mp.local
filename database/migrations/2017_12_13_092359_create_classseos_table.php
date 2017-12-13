<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClassseosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('classseos', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('classification_id');
            $table->foreign('classification_id')->references('id')->on('classifications')->onDelete('cascade');

            $table->string('seo_title')->nullable()->default(null);
            $table->string('seo_keywords')->nullable()->default(null);
            $table->string('seo_description')->nullable()->default(null);
            $table->string('og_image')->nullable()->default(null);
            $table->string('og_title')->nullable()->default(null);
            $table->string('og_description')->nullable()->default(null);
            $table->text('seo_text')->nullable()->default(null);

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
        Schema::dropIfExists('classseos');
    }
}







