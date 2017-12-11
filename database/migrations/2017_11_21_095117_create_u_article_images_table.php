<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUArticleImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('u_article_images', function (Blueprint $table) {
            $table->unsignedInteger('article_id');
            $table->string('path')->unique();
            $table->string('alt')->nullable()->default(null);
            $table->string('title')->nullable()->default(null);

            $table->foreign('article_id')->references('id')->on('u_articles')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('u_article_images');
    }
}
