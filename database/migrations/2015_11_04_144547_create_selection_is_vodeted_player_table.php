<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSelectionIsVodetedPlayerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('selection_is_voted_players', function (Blueprint $table) {
            $table->integer('fk_selections_players')->unsigned();
            $table->integer('fk_selections_turns')->unsigned();
            $table->integer('fk_players')->unsigned();

            $table->primary(array('fk_selections_players', 'fk_selections_turns', 'fk_players'), 'selection_voted_primary');
            

            $table->foreign('fk_selections_players')
                ->references('fk_players')
                ->on('selections')
                ->onDelete('cascade');
            $table->foreign('fk_selections_turns')
                ->references('fk_turns')
                ->on('selections')             
                ->onDelete('cascade');
            $table->foreign('fk_players')
                ->references('pk_id')
                ->on('players')
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
        Schema::drop('selection_is_voted_players');
    }
}
