<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMedicinesCatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medicines_cats', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 24);
            $table->string('utitle', 24);
            $table->string('alias1')->nullable()->default(null);
            $table->string('alias2')->nullable()->default(null);
            $table->string('alias3')->nullable()->default(null);

            $table->foreign('alias1')->references('alias')->on('medicines')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('alias2')->references('alias')->on('medicines')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('alias3')->references('alias')->on('medicines')->onDelete('cascade')->onUpdate('cascade');

            $table->timestamps();
        });

        $titles = [
            ['title' => 'Аллергия', 'utitle' => 'Аллергия'],
            ['title' => 'Гастроентерология', 'utitle' => 'Гастроентерология'],
            ['title' => 'Боль в суставах', 'utitle' => 'Боль в суставах'],
            ['title' => 'Дерматологія', 'utitle' => 'Дерматологія'],
            ['title' => 'Гінекологія', 'utitle' => 'Гінекологія'],
            ['title' => 'Аллергия', 'utitle' => 'Аллергия'],

        ];
        foreach ($titles as $title) {
            \Fresh\Medpravda\MedicinesCat::create($title);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('medicines_cats');
    }
}
