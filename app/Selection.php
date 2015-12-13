<?php

namespace Dixit;

use Illuminate\Database\Eloquent\Model;

class Selection extends Model {

    public function player() {
        return $this->belongsTo('Dixit\Player', 'fk_players', 'pk_id');
    }

    public function turn() {
        return $this->belongsTo('Dixit\Turn', 'fk_turns', 'pk_id');
    }

    public function card() {
        return $this->belongsTo('Dixit\Card', 'fk_cards');
    }

    public function votes() {
        return $this->belongsToMany('Dixit\Player', 'selection_is_voted_players',
                'fk_selections', 'fk_players');
    }

    protected $table = 'selections';
    protected $primaryKey = 'pk_id';

}
