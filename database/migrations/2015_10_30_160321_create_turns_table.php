<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTurnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('turns', function (Blueprint $table) {
            $table->increments('pk_id');
            $table->string('story',100);
            $table->timestamps();
            $table->integer('fk_games')->unsigned();
            $table->integer('fk_story_teller')->unsigned();

            $table->foreign('fk_games')
                ->references('pk_id')
                ->on('games')
                ->onDelete('cascade');
            $table->foreign('fk_story_teller')
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
        Schema::drop('turns');
    }
}
