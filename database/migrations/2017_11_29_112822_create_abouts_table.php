<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAboutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('abouts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('path')->nullable()->default(null);
            $table->string('alt')->nullable()->default(null);
            $table->string('img_title')->nullable()->default(null);
            $table->text('text')->nullable()->default(null);

            $table->timestamps();
        });

        \Fresh\Medpravda\About::create(['title' => 'О портале “Мед Правда”', 'path' => '123.jpg', 'alt' => 'MedPravda', 'img_title' => 'MedPravda']);
        \Fresh\Medpravda\About::create(['title' => 'Про портал “Мед Правда”', 'path' => '124.jpg', 'alt' => 'MedPravda', 'img_title' => 'MedPravda']);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('abouts');
    }
}
