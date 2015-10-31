<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plays', function (Blueprint $table) {
            $table->integer('user_id')->unsigned();
            $table->integer('game_id')->unsigned();
            $table->primary(['user_id','game_id']);
            $table->integer('play_position');
            $table->enum('choices', ['Wait', 'Ready', 'Inactive'])->default('Wait');
            $table->bigInteger('play_last_action');
            $table->foreign('user_id')->references('user_id')->on('users')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
            $table->foreign('game_id')->references('game_id')->on('games')
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
        Schema::drop('plays');
    }
}
