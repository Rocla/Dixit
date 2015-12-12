<?php

namespace Dixit;

use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
        
	public function game()
	{
		return $this->belongsTo('Dixit\Game', 'fk_games', 'pk_id');
	}
        
	public function user()
	{
		return $this->belongsTo('Dixit\User', 'fk_user_id', 'id');
	}

	public function cards()
	{
		return $this->belongsToMany('Dixit\Card', 'hands', 'fk_players', 'fk_cards' );
	}

	public function turns()
	{
		return $this->hasMany('Dixit\Turn', 'fk_story_teller', 'pk_id');
	}

	public function votes()
	{
		return $this->belongsToMany('Dixit\Selection', 'selection_is_voted_players',
                        'fk_players', 'fk_selections');
	}

	public function selections()
	{
		return $this->hasMany('Dixit\Selection', 'fk_players', 'pk_id');
	}

	protected $table = 'players';
        protected $primaryKey = 'pk_id';
        protected $fillable = array('score');

}
