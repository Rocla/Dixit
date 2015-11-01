<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('games', function (Blueprint $table) {
            $table->increments('game_id');
            $table->integer('user_id')->unsigned();
            $table->integer('deck_id')->unsigned();
            $table->string('game_name')->nullable();
            $table->integer('game_players_nb');
            $table->integer('game_points_limit');            
            $table->timestamps();
            $table->foreign('user_id')->references('user_id')->on('users')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
            $table->foreign('deck_id')->references('deck_id')->on('decks')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('games');
    }
}
