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
            $table->renameColumn('public_key', 'question');
            $table->renameColumn('private_key', 'answer');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $table->renameColumn('question', 'public_key');
        $table->renameColumn('answer', 'private_key');
    }
}
