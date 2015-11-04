<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlayerInGamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('player_in_games', function (Blueprint $table) {
            $table->integer('fk_players')->unsigned();
            $table->integer('fk_games')->unsigned();
            $table->timestamps();

            $table->primary(array('fk_players', 'fk_games'));

            $table->foreign('fk_players')
                ->references('pk_id')
                ->on('players')
                ->onDelete('cascade');
            $table->foreign('fk_games')
                ->references('pk_id')
                ->on('games')
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
        Schema::drop('player_in_games');
    }
}
