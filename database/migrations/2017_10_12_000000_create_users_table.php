<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Fresh\Medpravda\User;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');

            $table->unsignedInteger('role_id');
            $table->foreign('role_id')->references('id')->on('roles');

            $table->rememberToken();
            $table->timestamps();
        });

        $users = [
            ['name' => 'oleg', 'email' => 'oshaman789@gmail.com', 'password' => bcrypt('111222'), 'role_id' => 1],
            ['name' => 'editor', 'email' => 'reg_forall@bigmir.net', 'password' => bcrypt('111222'), 'role_id' => 2],
        ];
        foreach ($users as $user) {
            User::create($user);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
