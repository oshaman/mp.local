<?php

use Fresh\Medpravda\Tag;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tags', function (Blueprint $table) {
            $table->increments('id');
            $table->string('alias', 64)->unique();
            $table->string('name', 64)->unique();

            $table->timestamps();
        });
        $tags = ['aspirin' => 'Аспирин', 'alergiya' => 'Алергия', 'diclofenac' => 'Диклофенак'];
        foreach ($tags as $alias => $tag) {
            Tag::create(['name' => $tag, 'alias' => $alias]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tags');
    }
}
