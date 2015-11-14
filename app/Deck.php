<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Deck extends Model
{
	public function cards()
	{
		return $this->hasMany('App\Card');
	}

	public function games()
	{
		return $this->belongsToMany('App\Game', 'games_based_on_decks', 'fk_decks', 'fk_games');
	}

	protected $table = 'decks';
	protected $primarykey = 'pk_id';
	protected $fillable = array('name');
}
 