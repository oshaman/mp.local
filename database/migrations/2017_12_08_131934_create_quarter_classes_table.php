<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuarterClassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('
            CREATE VIEW quarter_classes AS (SELECT `class_alias` FROM `classification_statistics`
             WHERE `created_at` BETWEEN date_sub(NOW(), INTERVAL 90 DAY ) AND NOW())
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('DROP VIEW quarter_classes');
    }
}
