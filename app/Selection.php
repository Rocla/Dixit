<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Selection extends Model
{
	public function player()
	{
		return $this->belongsTo('App\Player');
	}

	public function turn()
	{
		return $this->belongsTo('App\Turn');
	}

	public function card()
	{
		return $this->belongsTo('App\Card');
	}

	public function vote()
	{
		return $this->belongsToMany('App\Player');
	}

	protected $table = 'selections';
	protected $primarykey = 'pk_selection';
}
