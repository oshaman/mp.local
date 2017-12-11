<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMonthMedicinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('
                    CREATE VIEW month_medicines AS (SELECT `medicine_alias` FROM `medicine_statistics`
                     WHERE `created_at` BETWEEN date_sub(NOW(), INTERVAL 30 DAY ) AND NOW())
                ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('DROP VIEW month_medicines');
    }
}
