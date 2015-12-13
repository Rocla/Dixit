<?php

use Illuminate\Database\Seeder;

use Dixit\Game;
use Dixit\Player;

class TestGamesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$this->command->info('Game 1');  
    	$game1 = new Game();
    	$game1->name = 'Game 1';
    	$game1->id_owner = 1;
    	$game1->language = 'en';
    	$game1->no_players = 3;
    	$game1->turn_timeout = 30;
    	$game1->save();

        $this->command->info('Player 1');  
        $player1 = new Player();
        $player1->fk_user_id = 1;
        $player1->fk_games = 1;
        $player1->save();

        $this->command->info('Player 2');  
        $player2 = new Player();
        $player2->fk_user_id = 2;
        $player2->fk_games = 1;
        $player2->save();

        $this->command->info('Player 3');  
        $player3 = new Player();
        $player3->fk_user_id = 3;
        $player3->fk_games = 1;
        $player3->save();
        
    }
}
