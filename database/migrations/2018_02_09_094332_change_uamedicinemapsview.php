<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeUamedicinemapsview extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('
                    CREATE OR REPLACE VIEW uamedicinemapsview AS
                    (SELECT uamedicines.id, uamedicines.updated_at, uamedicines.alias FROM `uamedicines` WHERE `approved`=1)
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
                    CREATE OR REPLACE VIEW uamedicinemapsview AS
                    (SELECT uamedicines.id, uamedicines.updated_at, uamedicines.alias FROM `uamedicines`)
                ');
    }
}
