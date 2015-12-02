<?php

namespace Dixit\Http\Controllers;

use Illuminate\Http\Request;
use Dixit\Http\Requests;
use Dixit\Http\Controllers\Controller;
use Dixit\InterfaceDAO\GameInterface;
use DebugBar;

class GamesListController extends Controller
{
    protected $game;
    
    public function __construct(GameInterface $game)
    {     
        $this->game=$game;
        $this->middleware('auth');
    }  
    
    public function getIndex()
    {  
        return view('gameslist')->with('games', $this->game->all());  
    }
    
    public function createGame(Request $request)
    {
        $this->game->createNewGame($request->all());
        return redirect('games');
    }
}
