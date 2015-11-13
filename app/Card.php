<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
	public function deck()
	{
		return $this->belongsTo('App\Deck');
	}

	public function player()
	{
		return $this->belongsToMany('App\Player');
	}

	public function selection()
	{
		return $this->hasMany('App\Selection');
	}

	protected $table = 'cards';
	protected $primarykey = 'pk_id';
	protected $fillable = array('name', 'image');

	private $name;
	private $image;
}
