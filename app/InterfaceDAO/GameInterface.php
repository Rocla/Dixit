<?php

namespace Dixit\InterfaceDAO;

/**
 * Description of GameInterface
 *
 * @author claudiag.gheorghe
 */
interface GameInterface 
{
    public function all();
    public function createNewGame(Array $inputs);
}
