<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MedicinesViewTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('
                        CREATE VIEW medicinesview AS 
                            (SELECT medicines.title, medicines.alias, umedicines.title AS `utitle`
                             FROM `medicines`
                             LEFT JOIN `umedicines` ON medicines.alias = umedicines.alias
                             )
                    ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('DROP VIEW medicinesview');
    }
}
