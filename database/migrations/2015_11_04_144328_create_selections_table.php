<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSelectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('selections', function (Blueprint $table) {
            $table->integer('fk_players')->unsigned();
            $table->integer('fk_turns')->unsigned();
            $table->integer('fk_cards')->unsigned();

            $table->primary(array('fk_players', 'fk_turns'), 'pk_selection');

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
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('selections');
    }
}
