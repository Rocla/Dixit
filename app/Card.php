<?php

namespace Dixit;

use Illuminate\Database\Eloquent\Model;

class Card extends Model
{    
        function __construct() {
            parent::__construct();
            $this->primaryKey = 'pk_id'; // because PHP don't override the field
        }
        
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
	protected $fillable = array('name', 'image');
}
