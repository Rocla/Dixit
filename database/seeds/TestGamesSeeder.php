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
    	$game1->turn_timout = 30;
    	$game1->save();

    	$this->command->info('Game 2');  
    	$game2 = new Game();
    	$game2->name = 'Game 2';
    	$game2->id_owner = 1;
    	$game2->language = 'fr';
    	$game2->no_players = 3;
    	$game2->turn_timout = 60;
    	$game2->save();

    	$this->command->info('Game 3');  
    	$game3 = new Game();
    	$game3->name = 'Game 3';
    	$game3->id_owner = 2;
    	$game3->language = 'de';
    	$game3->no_players = 3;
    	$game3->turn_timout = 10;
    	$game3->save();

        $this->command->info('Game 4');  
        $game4 = new Game();
        $game4->name = 'Game 4';
        $game4->id_owner = 1;
        $game4->language = 'fr';
        $game4->no_players = 3;
        $game4->turn_timout = 60;
        $game4->started = 1;
        $game4->save();



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



        $this->command->info('Player 4');  
        $player4 = new Player();
        $player4->fk_user_id = 1;
        $player4->fk_games = 2;
        $player4->save();

        $this->command->info('Player 5');  
        $player5 = new Player();
        $player5->fk_user_id = 2;
        $player5->fk_games = 2;
        $player5->save();



        $this->command->info('Player 6');  
        $player6 = new Player();
        $player6->fk_user_id = 2;
        $player6->fk_games = 3;
        $player6->save();



        $this->command->info('Player 7');  
        $player7 = new Player();
        $player7->fk_user_id = 1;
        $player7->fk_games = 4;
        $player7->save();

        $this->command->info('Player 8');  
        $player8 = new Player();
        $player8->fk_user_id = 2;
        $player8->fk_games = 4;
        $player8->save();

        $this->command->info('Player 9');  
        $player9 = new Player();
        $player9->fk_user_id = 3;
        $player9->fk_games = 4;
        $player9->save();
    	
        
    }
}
