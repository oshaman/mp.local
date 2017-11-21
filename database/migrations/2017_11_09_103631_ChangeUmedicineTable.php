<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeUmedicineTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('umedicines', function (Blueprint $table) {
            $table->integer('form_id')->unsigned()->default(1);
            $table->foreign('form_id')->references('id')->on('forms');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('umedicines', function (Blueprint $table) {
            $table->dropForeign(['form_id']);
            $table->dropColumn('form_id');
        });
    }
}
