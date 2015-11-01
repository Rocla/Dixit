<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('user_id');
            $table->string('user_name')->nullable();
            $table->string('user_lastname')->nullable();
            $table->string('user_pseudo');
            $table->string('user_avatar')->nullable();
            $table->string('email')->unique();
            $table->string('password', 60);
            $table->date('user_birthdate')->nullable();
            $table->dateTime('user_last_connexion');
            $table->rememberToken();
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
        Schema::drop('users');
    }
}
