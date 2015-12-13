<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateFixCompositKeyInOne extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::drop('selection_is_voted_players');
        Schema::drop('selections');
        
        Schema::create('selections', function (Blueprint $table) {
            $table->increments('pk_id')->unsigned();
            $table->integer('fk_players')->unsigned();
            $table->integer('fk_turns')->unsigned();
            $table->integer('fk_cards')->unsigned();
            $table->timestamps();
            
            $table->foreign('fk_players')
                ->references('pk_id')
                ->on('players')
                ->onDelete('cascade');
            $table->foreign('fk_turns')
                ->references('pk_id')
                ->on('turns')
                ->onDelete('cascade');
            $table->foreign('fk_cards')
                ->references('pk_id')
                ->on('cards')
                ->onDelete('cascade');
        });
        
        Schema::create('selection_is_voted_players', function (Blueprint $table) {
            $table->increments('pk_id')->unsigned();
            $table->integer('fk_selections')->unsigned();
            $table->integer('fk_players')->unsigned();
            $table->timestamps();

            $table->foreign('fk_selections')
                ->references('pk_id')
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
        CreateSelectionsTable::up();
        CreateSelectionIsVodetedPlayerTable::up();
    }
}
