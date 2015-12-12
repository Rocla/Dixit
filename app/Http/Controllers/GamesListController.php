<?php

namespace Dixit\Http\Controllers;

use Illuminate\Http\Request;
use Dixit\Http\Requests;
use Dixit\Game;
use Dixit\Player;
use Dixit\User;
use Auth;
use DebugBar;

class GamesListController extends Controller {

    protected $game;

    public function __construct(Game $game) {
        $this->game = $game;
        $this->middleware('auth');
    }

    public function getIndex() {
        $games = $this->game->all();
        foreach ($games as $currentGame) {
            if ($currentGame->users->contains(Auth::user())) {
                //return redirect()->route('play', [$currentGame->pk_id]);      
            }
        }
        return view('gameslist')->with('games', $this->game->all());
    }

    public function createGame(Request $request) {
        Game::create(array_merge($request->all(), ['id_owner' => $request->user()->id, 'started' => 0, 'turn_timeout' => 3]));
        return redirect('play');
    }

    public function addPlayer($gameId, $playerId) {
        $user = User::find($playerId);
        $user->games()->attach($gameId);
        return redirect()->route('play', [$gameId]);
    }

    public function delete($gameId) {
        //to do 
    }
    
    public function getPlayer($userId) {
        $user = User::find($userId);
        
        return $user->players()->select('pk_id')->first()['pk_id'];
    }
    
    public function getGame($userId) {
        $playerId = $this->getPlayer($userId);
        return Player::find($playerId)->game()->select('pk_id')->first()['pk_id'];
    }
}
