<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateAddTimestamp extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('selections',function(Blueprint $table){ 
            $table->timestamps();  
        });
        Schema::table('selection_is_voted_players',function(Blueprint $table){ 
            $table->timestamps(); 
        });
        Schema::table('hands',function(Blueprint $table){ 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
