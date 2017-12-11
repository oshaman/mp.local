<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSlidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sliders', function (Blueprint $table) {
            $table->increments('id');

            $table->enum('loc', ['ru', 'ua'])->index();
            $table->string('description');
            $table->string('text')->nullable()->default(null);
            $table->string('link')->nullable()->default(null);
            $table->string('path');
            $table->string('alt')->nullable()->default(null);
            $table->string('title')->nullable()->default(null);
            $table->boolean('approved')->index()->default(false)->index();

            $table->timestamps();
        });

        \Fresh\Medpravda\Slider::create(['description' => 'О портале “Мед Правда”', 'path' => '123.jpg', 'loc' => 'ru']);
        \Fresh\Medpravda\Slider::create(['description' => 'О портале “Мед Правда”', 'path' => '123.jpg', 'loc' => 'ru']);
        \Fresh\Medpravda\Slider::create(['description' => 'О портале “Мед Правда”', 'path' => '123.jpg', 'loc' => 'ru']);
        \Fresh\Medpravda\Slider::create(['description' => 'О портале “Мед Правда”', 'path' => '123.jpg', 'loc' => 'ru']);
        \Fresh\Medpravda\Slider::create(['description' => 'О портале “Мед Правда”', 'path' => '123.jpg', 'loc' => 'ru']);

        \Fresh\Medpravda\Slider::create(['description' => 'О портале “Мед Правда”', 'path' => '123.jpg', 'loc' => 'ua']);
        \Fresh\Medpravda\Slider::create(['description' => 'О портале “Мед Правда”', 'path' => '123.jpg', 'loc' => 'ua']);
        \Fresh\Medpravda\Slider::create(['description' => 'О портале “Мед Правда”', 'path' => '123.jpg', 'loc' => 'ua']);
        \Fresh\Medpravda\Slider::create(['description' => 'О портале “Мед Правда”', 'path' => '123.jpg', 'loc' => 'ua']);
        \Fresh\Medpravda\Slider::create(['description' => 'О портале “Мед Правда”', 'path' => '123.jpg', 'loc' => 'ua']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sliders');
    }
}
