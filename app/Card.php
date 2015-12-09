<?php

namespace Dixit;

use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
	public function deck()
	{
            return $this->belongsTo('Dixit\Deck', 'fk_decks', 'pk_id');
	}

	public function players()
	{
            return $this->belongsToMany('Dixit\Player', 'hands', 'fk_cards', 'fk_players' );
	}

	public function selections()
	{
            return $this->hasMany('Dixit\Selection', 'fk_cards', 'pk_id');
	}

	protected $table = 'cards';
	protected $primaryKey = 'pk_id';
	protected $fillable = array('name', 'image');
}
