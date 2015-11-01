<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCardsDecksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cards_decks', function (Blueprint $table) {
            $table->integer('card_id')->unsigned();
            $table->integer('deck_id')->unsigned();
            $table->primary(['card_id','deck_id']);
            $table->timestamps();
            $table->foreign('card_id')->references('card_id')->on('cards')
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
        Schema::drop('cards_decks');
    }
}
