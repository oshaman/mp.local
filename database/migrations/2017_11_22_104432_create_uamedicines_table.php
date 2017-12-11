<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUamedicinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('uamedicines', function (Blueprint $table) {
            $table->unsignedInteger('id');
            $table->foreign('id')->references('id')->on('medicines')->onDelete('cascade');

            $table->string('title')->index();
            $table->string('alias')->unique();
            $table->foreign('alias')->references('alias')->on('medicines')->onDelete('cascade')->onUpdate('cascade');

            $table->unsignedInteger('fabricator_id');
            $table->foreign('fabricator_id')->references('id')->on('fabricators');

            $table->unsignedInteger('innname_id');
            $table->foreign('innname_id')->references('id')->on('innnames');

            $table->unsignedInteger('pharmagroup_id');
            $table->foreign('pharmagroup_id')->references('id')->on('pharmagroups');

            $table->unsignedInteger('classification_id');
            $table->foreign('classification_id')->references('id')->on('classifications');

            $table->boolean('approved')->index()->default(true)->index();
            $table->unsignedInteger('view')->default(0)->index();
            $table->text('seo')->nullable()->default(null);

            $table->text('consist')->nullable()->default(null);
            $table->text('docs_form')->nullable()->default(null);
            $table->text('physicochemical_char')->nullable()->default(null);
            $table->text('fabricator')->nullable()->default(null);
            $table->text('addr_fabricator')->nullable()->default(null);
            $table->mediumText('pharm_group')->nullable()->default(null);
            $table->mediumText('indications')->nullable()->default(null);
            $table->mediumText('pharm_prop')->nullable()->default(null);
            $table->text('contraindications')->nullable()->default(null);
            $table->text('security')->nullable()->default(null);
            $table->mediumText('application_features')->nullable()->default(null);
            $table->text('pregnancy')->nullable()->default(null);
            $table->text('cars')->nullable()->default(null);
            $table->text('children')->nullable()->default(null);
            $table->mediumText('app_mode')->nullable()->default(null);
            $table->text('overdose')->nullable()->default(null);
            $table->mediumText('side_effects')->nullable()->default(null);
            $table->mediumText('interaction')->nullable()->default(null);
            $table->text('shelf_life')->nullable()->default(null);
            $table->text('saving')->nullable()->default(null);
            $table->text('packaging')->nullable()->default(null);
            $table->text('leave_cat')->nullable()->default(null);
            $table->string('dose')->nullable()->default(null);
            $table->mediumText('additionally')->nullable()->default(null);
            $table->string('reg')->nullable()->default(null);

            $table->integer('form_id')->unsigned()->default(1);
            $table->foreign('form_id')->references('id')->on('forms');

            $table->string('backcolor', 6)->nullable()->default(null);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('uamedicines');
    }
}
