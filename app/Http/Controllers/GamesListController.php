<?php

namespace Dixit\Http\Controllers;

use Illuminate\Http\Request;
use Dixit\Http\Requests;
use Dixit\Http\Controllers\Controller;
use Dixit\Game;
use DebugBar;

class GamesListController extends Controller
{
    protected $games;
    
    public function __construct(Game $games)
    {     
        $this->games=$games;
        $this->middleware('auth');
    }   
  
    public function getIndex()
    {  
        return view('gameslist')->with('games', $this->games->all());
        Debugbar::error('test');

    }
}
