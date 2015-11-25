<?php namespace Dixit\ImplementationEloquentDAO;

use Dixit\Game;
use Dixit\InterfaceDAO\GameInterface;

/**
 * Description of GameRepository
 *
 * @author claudiag.gheorghe
 */
class GameRepository implements GameInterface
{
    /**
     * Return all the games
     *
     * @return php array
     */
    public function all() 
    {
        return Game::all();
    }
    
    /**
     * Create a new game
     * started = 0 (false) at the creation of the game
     * turn_timout = 3 min by default;
     */
    public function createNewGame(Array $inputs) 
    {
        $game= new Game();
        $game->name=$inputs['name'];
        $game->language=$inputs['lang'];
        $game->no_players=$inputs['no_players'];
        $game->started = 0;
        $game->turn_timout=3;
        $game->save();
    }

}
