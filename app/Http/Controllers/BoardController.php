<?php

namespace Dixit\Http\Controllers;

use Illuminate\Http\Request;

use Dixit\Http\Requests;
use Dixit\Http\Controllers\Controller;

use Dixit\Card;

class BoardController extends Controller
{
	protected $cards;

	public function __construct(Card $_cards)
	{
		$this->cards=$_cards;
		$this->middleware('auth');
	}

    public function getIndex()
    {  
        return view('board')->with('cards', $this->cards->all());  
    }
}
