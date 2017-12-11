<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUamedicinemapsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('
                    CREATE VIEW uamedicinemapsview AS 
                        (SELECT uamedicines.id, uamedicines.updated_at, uamedicines.alias FROM `uamedicines`)
                ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('DROP VIEW uamedicinemapsview');
    }
}
