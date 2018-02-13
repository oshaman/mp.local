<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeAmedicinemapsview extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('
                    CREATE OR REPLACE VIEW amedicinemapsview AS
                    (SELECT amedicines.id, amedicines.updated_at, amedicines.alias FROM `amedicines` WHERE `approved`=1)
                ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('
                    CREATE OR REPLACE VIEW amedicinemapsview AS
                    (SELECT amedicines.id, amedicines.updated_at, amedicines.alias FROM `amedicines`)
                ');
    }
}
