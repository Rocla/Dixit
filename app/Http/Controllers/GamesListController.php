<?php

namespace Dixit\Http\Controllers;

use Illuminate\Http\Request;
use Dixit\Http\Requests;
use Dixit\Game;
use Dixit\Player;
use Dixit\User;
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
        Game::create(array_merge($request->all(), ['id_owner'=>$request->user()->id,'started' => 0, 'turn_timeout' => 3]));       
        return redirect('play');
    }
    
    public function addPlayer($gameId, $playerId)
    {
//      $user=User::find($playerId);
//      $user->games()->attach($gameId);
        Player::create(['fk_user_id'=>$playerId, 'fk_games'=>$gameId]);
        return redirect()->route('play', [$gameId]);
        
    }
    public function delete($gameId)
    {
        //to do 
    }
}
