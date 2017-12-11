<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('u_articles', function (Blueprint $table) {
            $table->unsignedInteger('id');
            $table->foreign('id')->references('id')->on('articles')->onDelete('cascade')->onUpdate('cascade');

            $table->string('title')->index()->nullable()->default(null);

            $table->string('alias')->unique();
            $table->foreign('alias')->references('alias')->on('articles')->onDelete('cascade')->onUpdate('cascade');

            $table->boolean('approved')->index()->default(false)->index();
            $table->unsignedInteger('view')->default(1)->index();

            $table->text('content')->nullable()->default(null);

            $table->integer('category_id')->unsigned()->default(1);
            $table->foreign('category_id')->references('id')->on('categories');

            $table->text('seo')->nullable()->default(null);

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
        Schema::dropIfExists('u_articles');
    }
}
