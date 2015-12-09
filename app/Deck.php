<?php

namespace Dixit;

use Illuminate\Database\Eloquent\Model;

class Deck extends Model
{
        function __construct() {
            parent::__construct();
            $this->primaryKey = 'pk_id'; // because PHP don't override the field
        }
        
	public function cards()
	{
		return $this->hasMany('Dixit\Card', 'fk_decks', 'pk_id');
	}

	public function games()
	{
		return $this->belongsToMany('Dixit\Game', 'games_based_on_decks', 'fk_decks', 'fk_games');
	}

	protected $table = 'decks';
	protected $fillable = array('name');
}
 