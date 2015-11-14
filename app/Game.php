<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
	public function players()
	{
		return $this->hasMany('App\Player', 'fk_games', 'pk_id');
	}

	public function turns()
	{
		return $this->hasMany('App\Turn', 'fk_games', 'pk_id');
	}

	public function decks()
	{
		return $this->belongsToMany('App\Deck', 'games_based_on_decks', 'fk_games', 'fk_decks');
	}

	protected $table = 'games';
	protected $primarykey = 'pk_id';
	protected $fillable = array('language', 'started', 'turn_timout');
}
