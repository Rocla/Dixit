<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
	public function player()
	{
		return $this->hasMany('App\Player');
	}

	public function turn()
	{
		return $this->hasMany('App\Turn');
	}

	public function deck()
	{
		return $this->belongsToMany('App\Deck');
	}

	protected $table = 'games';
	protected $primarykey = 'pk_id';
	protected $fillable = array('language', 'started', 'turn_timout');

	private $language;
	private $started;
	private $turn_timout;
}
