<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blocks', function (Blueprint $table) {
            $table->unsignedInteger('id')->primary()->unique();
            $table->string('title', 64);
            $table->string('utitle', 64);
            $table->string('first', 64)->nullable()->default(null);
            $table->string('second', 64)->nullable()->default(null);
            $table->string('third', 64)->nullable()->default(null);
            $table->string('fourth', 64)->nullable()->default(null);
            $table->string('fifth', 64)->nullable()->default(null);
            $table->string('sixth', 64)->nullable()->default(null);
        });

        $titles = [
            ['id' => 1, 'title' => 'ПОПУЛЯРНЫЕ ТЕГИ:', 'utitle' => 'ПОПУЛЯРНЫЕ ТЕГИ:', 'first' => 'БОЛЕУТОЛЯЮЩИЕ', 'second' => 'ПРОСТАТА'],
            ['id' => 2, 'title' => 'Гастроентерология', 'utitle' => 'Гастроентерология', 'first' => 'БОЛЕУТОЛЯЮЩИЕ', 'second' => 'Беременность'],
            ['id' => 3, 'title' => 'КОММЕРЧИСКИЕ СТАТЬИ', 'utitle' => 'КОММЕРЧИСКИЕ СТАТЬИ', 'first' => 'БОЛЕУТОЛЯЮЩИЕ', 'second' => 'ПОПУЛЯРНЫЕ'],
            ['id' => 4, 'title' => 'ПОСЛЕДНИЕ СТАТЬИ', 'utitle' => 'ПОСЛЕДНИЕ СТАТЬИ', 'first' => 'МИНЗДРАВ', 'second' => 'Беременность'],
            ['id' => 5, 'title' => 'ТОП СТАТЬИ', 'utitle' => 'ТОП СТАТЬИ', 'first' => 'БОЛЕУТОЛЯЮЩИЕ', 'second' => 'ПОПУЛЯРНЫЕ'],
            ['id' => 6, 'title' => 'Аллергия', 'utitle' => 'Аллергия', 'first' => 'БОЛЕУТОЛЯЮЩИЕ', 'second' => 'ПРОСТАТА'],

        ];
        foreach ($titles as $title) {
            \Fresh\Medpravda\Block::create($title);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blocks');
    }
}
