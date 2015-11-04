<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHandsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hands', function (Blueprint $table) {
            $table->integer('fk_players')->unsigned();
            $table->integer('fk_games')->unsigned();
            $table->integer('fk_cards')->unsigned();

            $table->primary(array('fk_players', 'fk_games', 'fk_cards'));

            $table->foreign('fk_players')
                ->references('pk_id')
                ->on('players')
                ->onDelete('cascade');
            $table->foreign('fk_games')
                ->references('pk_id')
                ->on('games')
                ->onDelete('cascade');
            $table->foreign('fk_cards')
                ->references('pk_id')
                ->on('cards')
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
        Schema::drop('hands');
    }
}
