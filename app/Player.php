<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
	public function game()
	{
		return $this->belongsTo('App\Game');
	}

	public function card()
	{
		return $this->belongsToMany('App\Card');
	}

	public function turn()
	{
		return $this->hasMany('App\Turn');
	}

	public function vote()
	{
		return $this->belongsToMany('App\Selection');
	}

	public function selection()
	{
		return $this->hasMany('App\Selection');
	}

	protected $table = 'players';
	protected $primarykey = 'pk_id';
	protected $fillable = array('pseudo');

	private $pseudo;
}
