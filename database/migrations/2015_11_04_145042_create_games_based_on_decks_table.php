<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGamesBasedOnDecksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('games_based_on_decks', function (Blueprint $table) {
            $table->integer('fk_games')->unsigned();
            $table->integer('fk_decks')->unsigned();

            $table->primary(array('fk_games', 'fk_decks'));

            $table->foreign('fk_games')
                ->references('pk_id')
                ->on('games')
                ->onDelete('cascade');
            $table->foreign('fk_decks')
                ->references('pk_id')
                ->on('decks')
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
        Schema::drop('games_based_on_decks');
    }
}
