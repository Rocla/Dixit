<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
	public function deck()
	{
		return $this->belongsTo('App\Deck', 'fk_decks', 'pk_id');
	}

	public function players()
	{
		return $this->belongsToMany('App\Player', 'hands', 'fk_cards', 'fk_players' );
	}

	public function selections()
	{
		return $this->hasMany('App\Selection', 'fk_cards', 'pk_id');
	}

	protected $table = 'cards';
	protected $primarykey = 'pk_id';
	protected $fillable = array('name', 'image');
}
