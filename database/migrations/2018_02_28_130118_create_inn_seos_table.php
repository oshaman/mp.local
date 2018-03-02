<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInnSeosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inn_seos', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('innname_id');
            $table->foreign('innname_id')->references('id')->on('innnames')->onDelete('cascade');

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
        Schema::dropIfExists('inn_seos');
    }
}
