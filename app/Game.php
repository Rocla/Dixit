<?php

namespace Dixit;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
        function __construct() {
            parent::__construct();
            $this->primaryKey = 'pk_id'; // because PHP don't override the field
        }
        
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
	protected $fillable = array('name', 'language', 'no_players' ,'started', 'turn_timeout', 'id_owner');
}
