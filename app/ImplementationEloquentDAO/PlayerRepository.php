<?php

namespace Dixit\ImplementationEloquentDAO;

use \Dixit\Player;
use Dixit\InterfaceDAO\PlayerInterface;

class PlayerRepository implements PlayerInterface {
    
    public function getPlayerInGame($gameId)
    {
        return Player::where('fk_games','=',$gameId)->get();
    }
}
