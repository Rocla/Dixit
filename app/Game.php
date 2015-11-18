<?php

namespace Dixit;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
	public function players()
	{
		return $this->hasMany('Dixit\Player', 'fk_games', 'pk_id');
	}

	public function turns()
	{
		return $this->hasMany('Dixit\Turn', 'fk_games', 'pk_id');
	}

	public function decks()
	{
		return $this->belongsToMany('Dixit\Deck', 'games_based_on_decks', 'fk_games', 'fk_decks');
	}

	protected $table = 'games';
	protected $primarykey = 'pk_id';
	protected $fillable = array('language', 'started', 'turn_timout');
}
