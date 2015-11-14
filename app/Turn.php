<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Turn extends Model
{
	public function game()
	{
		return $this->belongsTo('App\Game', 'fk_games', 'pk_id');
	}

	public function storyteller()
	{
		return $this->belongsTo('App\Player', 'fk_story_teller', 'pk_id');
	}

	public function selections()
	{
		return $this->hasMany('App\Selection', 'fk_turns', 'pk_id');
	}

	protected $table = 'turns';
	protected $primarykey = 'pk_id';
	protected $fillable = array('story');
}
