<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    protected $table='cards';
    protected $primaryKey='pk_id';
    protected $fillable=['name', 'image', 'decks_id'];
    
    public function selection()
    {
        return $this->belongsTo('App\Selection', 'card_id' );
    }
    
    public function decks()
    {
        return $this->hasMany('App\Deck', 'decks_id');
    }
    
    public function games()
    {
        return $this->belongsToMany('App\Game');
    }
}
