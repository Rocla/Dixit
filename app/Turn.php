<?php

namespace Dixit;

use Illuminate\Database\Eloquent\Model;

class Turn extends Model
{
	public function game()
	{
		return $this->belongsTo('Dixit\Game', 'fk_games', 'pk_id');
	}

	public function storyteller()
	{
		return $this->belongsTo('Dixit\Player', 'fk_story_teller', 'pk_id');
	}

	public function selections()
	{
		return $this->hasMany('Dixit\Selection', 'fk_turns', 'pk_id');
	}

	protected $table = 'turns';
	protected $primaryKey = 'pk_id';
	protected $fillable = array('story');
}
