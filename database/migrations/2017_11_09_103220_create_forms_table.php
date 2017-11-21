<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Fresh\Medpravda\Form;

class CreateFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('forms', function (Blueprint $table) {
            $table->increments('id');
            $table->string('alias')->unique();
            $table->string('name')->unique();
            $table->string('uname')->unique();
            $table->timestamps();
        });
        Form::create(['name' => 'none', 'uname' => 'none', 'alias' => 'none']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('forms');
    }
}
