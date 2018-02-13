<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeUmedicinemapsview extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('
                    CREATE OR REPLACE VIEW umedicinemapsview AS
                    (SELECT umedicines.id, umedicines.updated_at, umedicines.alias FROM `umedicines` WHERE `approved`=1)
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
                    CREATE OR REPLACE VIEW umedicinemapsview AS
                    (SELECT umedicines.id, umedicines.updated_at, umedicines.alias FROM `umedicines`)
                ');
    }
}
