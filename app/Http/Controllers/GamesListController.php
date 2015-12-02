<?php

namespace Dixit\Http\Controllers;

use Illuminate\Http\Request;
use Dixit\Http\Requests;
use Dixit\Game;
use DebugBar;

class GamesListController extends Controller
{
    protected $game;
    
    public function __construct(Game $game)
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
        Game::create(array_merge($request->all(), ['started' => 0, 'turn_timeout' => 3]));
        return redirect('games');
    }
    
    public function addPlayer()
    {
        return redirect('home');
    }
}
