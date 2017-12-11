<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeMedicinesCatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('medicines_cats', function (Blueprint $table) {
            $table->string('path');
            $table->string('alt')->nullable()->default(null);
            $table->string('imgtitle')->nullable()->default(null);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('medicines_cats', function (Blueprint $table) {
            $table->dropColumn('path');
            $table->dropColumn('alt');
            $table->dropColumn('imgtitle');
        });
    }
}
