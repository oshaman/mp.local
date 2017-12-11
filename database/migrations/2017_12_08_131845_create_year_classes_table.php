<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateYearClassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('
            CREATE VIEW year_classes AS (SELECT `class_alias` FROM `classification_statistics`
             WHERE `created_at` BETWEEN date_sub(NOW(), INTERVAL 365 DAY ) AND NOW())
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('DROP VIEW year_classes');
    }
}
