<?php

namespace Dixit\Http\Controllers;

use Illuminate\Http\Request;

use Dixit\Http\Requests;
use Dixit\Http\Controllers\Controller;

use Dixit\Card;
use Dixit\Player;
use Auth;
use DB;

class BoardController extends Controller
{
	protected $cards;

	public function __construct(Card $_cards)
	{
		$this->cards = $_cards;
		$this->middleware('auth');
	}

    public function getIndex()
    {  
        return view('board');
    }

    public function getBoard($board_id)
    {
    	DB::table('hands')->where('fk_players', '=', Auth::user()->id)->delete();

    	$player_hand = DB::table('hands');
    	$randomHand = [];
    	$i=0;
    	while($i<6){
    		$randomCardID = $this->getRandomCardID();
    		if(!array_key_exists($randomCardID,$randomHand)){
    			$player_hand->insert(['fk_players' => Auth::user()->id, 'fk_cards' => $randomCardID]);
    			array_push($randomHand, $randomCardID);
    			$i++;
    		}
    	}

    	$hand = $player_hand->where('fk_players', Auth::user()->id)->select('fk_cards')->get();

    	return $hand;

        return view('board')->with('hand', $hand);
    }

    private function getRandomCard()
    {  
		return Card::where('pk_id', mt_rand(1, Card::count()))->first()->name;
    }

    private function getRandomCardID()
    {  
		return mt_rand(1, Card::count());
    }

}
