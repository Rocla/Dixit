<?php

namespace Dixit\ImplementationEloquentDAO;

use Dixit\Player;
use Dixit\Game;
use Dixit\InterfaceDAO\PlayerInterface;

class PlayerRepository implements PlayerInterface {
    
    public function getPlayerInGame($gameId)
    {
        $game = Game::find($gameId);
        return $game->players();
    }
}
