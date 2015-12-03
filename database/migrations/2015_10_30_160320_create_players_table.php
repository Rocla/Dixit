<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlayersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('players', function (Blueprint $table) {
            $table->increments('pk_id');
            $table->integer('fk_user_id')->unsigned();
            $table->timestamps();
            $table->integer('fk_games')->unsigned();

            $table->foreign('fk_games')
                ->references('pk_id')
                ->on('games')
                ->onDelete('cascade');
                
            $table->foreign('fk_user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('players');
    }
}
