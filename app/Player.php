<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
	protected $table = 'players';
	protected $primarykey = 'pk_id';
	protected $fillable = array('token', 'pseudo', 'id');

	private $id;
	private $pseudo;
	private $token;
}
