<?php

namespace Dixit\Http\Controllers;

use Illuminate\Http\Request;

use Dixit\Http\Requests;
use Dixit\Http\Controllers\Controller;

use Dixit\Card;

class WelcomeController extends Controller {

	protected $cards;

	public function __construct(Card $_cards)
	{
		$this->cards=$_cards;
		$this->middleware('guest');
	}

	public function getIndex()
	{
		return view('welcome')->with('cards', $this->cards->all());

        DebugBar::error("error");
	}

}