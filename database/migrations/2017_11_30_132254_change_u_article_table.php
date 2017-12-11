<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeUArticleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('u_articles', function (Blueprint $table) {
            $table->unsignedTinyInteger('priority')->nullable()->default(null)->index();
            $table->string('description')->nullable()->default(null);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('u_articles', function (Blueprint $table) {
            $table->dropColumn('priority');
            $table->dropColumn('description');
        });
    }
}
