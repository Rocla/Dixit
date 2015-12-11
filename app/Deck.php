<?php

namespace Dixit;

use Illuminate\Database\Eloquent\Model;

class Deck extends Model {

    public function cards() {
        return $this->hasMany('Dixit\Card', 'fk_decks', 'pk_id');
    }

    public function games() {
        return $this->belongsToMany('Dixit\Game', 'games_based_on_decks', 'fk_decks', 'fk_games');
    }

    protected $table = 'decks';
    protected $fillable = array('name');
    protected $primaryKey = 'pk_id';
}
