<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Deck extends Model
{
	protected $table = 'decks';
	protected $primarykey = 'pk_id';
	protected $fillable = array('name', 'id');

	private $id;
	private $name;
}
 