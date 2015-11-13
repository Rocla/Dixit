<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Deck extends Model
{
	public function cards()
	{
		return $this->hasMany('App\Card');
	}

	public function game()
	{
		return $this->belongsToMany('App\Game');
	}

	protected $table = 'decks';
	protected $primarykey = 'pk_id';
	protected $fillable = array('name');

	private $name;
}
 