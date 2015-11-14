<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Selection extends Model
{
	public function player()
	{
		return $this->belongsTo('App\Player', 'fk_players', 'pk_id');
	}

	public function turn()
	{
		return $this->belongsTo('App\Turn', 'fk_turns', 'pk_id');
	}

	public function card()
	{
		return $this->belongsTo('App\Card', 'fk_cards');
	}

	public function votes()
	{
		return $this->belongsToMany('App\Player', 'selection_is_voted_players', 'fk_players', 'pk_selection');
	}


	protected $table = 'selections';
	protected $primarykey = 'pk_selection';
}
