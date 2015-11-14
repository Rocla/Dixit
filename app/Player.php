<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
	public function game()
	{
		return $this->belongsTo('App\Game');
	}

	public function cards()
	{
		return $this->belongsToMany('App\Card', 'hands', 'fk_cards', 'fk_players' );
	}

	public function turn()
	{
		return $this->hasMany('App\Turn');
	}

	public function vote()
	{
		return $this->belongsToMany('App\Selection');
	}

	public function selections()
	{
		return $this->belongsToMany('App\Selection', 'selection_is_voted_players', 'fk_players', 'pk_selection_voted');
	}

	protected $table = 'players';
	protected $primarykey = 'pk_id';
	protected $fillable = array('pseudo');

	private $pseudo;
}
