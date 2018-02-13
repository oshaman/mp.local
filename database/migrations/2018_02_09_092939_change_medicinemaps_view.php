<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeMedicinemapsView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('
                    CREATE OR REPLACE VIEW medicinemapsview AS
                    (SELECT medicines.id, medicines.updated_at, medicines.alias FROM `medicines` WHERE `approved`=1)
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
                    CREATE OR REPLACE VIEW medicinemapsview AS
                    (SELECT medicines.id, medicines.updated_at, medicines.alias FROM `medicines`)
                ');
    }
}
