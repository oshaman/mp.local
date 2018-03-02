<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeMedicinesViewTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('
                    CREATE OR REPLACE VIEW medicinesview AS
                        (SELECT medicines.title, medicines.alias, umedicines.title AS `utitle`
                             FROM `medicines`
                             LEFT JOIN `umedicines` ON medicines.alias = umedicines.alias
                             WHERE medicines.approved=1
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
        DB::statement('
                    CREATE OR REPLACE VIEW medicinesview AS
                        (SELECT medicines.title, medicines.alias, umedicines.title AS `utitle`
                             FROM `medicines`
                             LEFT JOIN `umedicines` ON medicines.alias = umedicines.alias
                             )
                ');
    }
}
