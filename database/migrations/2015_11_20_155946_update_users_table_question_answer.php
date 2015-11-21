<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateUsersTableQuestionAnswer extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users',function(Blueprint $table){ 
            //besoin d'ajouter doctrine/dbal en dependance a composer.json
            //$table->renameColumn('public_key', 'question');
            //$table->renameColumn('private_key', 'answer');
            $table->dropColumn('public_key');
            $table->dropColumn('private_key');
            $table->string('question')->after('password');
            $table->string('answer')->after('question');
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
