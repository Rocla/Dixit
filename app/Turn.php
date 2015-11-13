<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Turn extends Model
{
	public function game()
	{
		return $this->belongsTo('App\Game', 'fk_games');
	}


	public function storyteller()
	{
		return $this->belongsTo('App\Player', 'fk_story_teller');
	}

	protected $table = 'turns';
	protected $primarykey = 'pk_id';
	protected $fillable = array('story');

	private $start_time;
	private $story;
}
