<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDownloadClassesView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('CREATE VIEW download_classes AS (SELECT year_classes.class_alias, COUNT(year_classes.class_alias) AS \'yearCount\', (SELECT COUNT(semester_classes.class_alias) FROM `semester_classes` WHERE semester_classes.class_alias=year_classes.class_alias) AS \'semesterCount\', (SELECT COUNT(quarter_classes.class_alias) FROM `quarter_classes` WHERE quarter_classes.class_alias=year_classes.class_alias) AS \'quarterCount\', (SELECT COUNT(month_classes.class_alias) FROM `month_classes` WHERE month_classes.class_alias=year_classes.class_alias) AS \'monthCount\', (SELECT COUNT(week_classes.class_alias) FROM `week_classes` WHERE week_classes.class_alias=year_classes.class_alias) AS \'weekCount\' FROM `year_classes` GROUP BY year_classes.class_alias)');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('DROP VIEW download_classes');
    }
}
