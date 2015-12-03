<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateGamesAddStorytellerOwner extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('games',function(Blueprint $table){ 
            $table->integer('id_storyteller')->unsigned()->after('name')->nullable();
            $table->integer('id_owner')->unsigned()->after('id_storyteller');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $table->dropColumn('id_storyteller');
        $table->dropColumn('id_owner');
    }
}
