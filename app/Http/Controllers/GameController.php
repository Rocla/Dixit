<?php

namespace Dixit\Http\Controllers;

use Dixit\Http\Controllers\Controller;
use Dixit\Game;
use Dixit\Player;
use Dixit\User;
use Dixit\Turn;
use Dixit\Card;
use Dixit\Selection;

class GameController extends Controller {
    /* ================================================================== */
    //      RELATIVE TO ALL PLAYER / TO A GAME
    /* ================================================================== */

    /**
     * Return the players pseudo in an array.
     * 
     * The key is the player id 
     * The value is the name 
     *
     * @return php array
     */
    public function getPlayers($gameId) {
        $game = Game::find($gameId);
        $player = $game->players()->orderBy('pk_id', 'desc')->select('pk_id')->getResults();

        $pseudo = array();
        foreach ($player as $p) {
            $user = Player::find($p['pk_id'])->user()->select('username')->getResults();
            array_push($pseudo, array($p['pk_id'] => $user['username']));
        }

        return $pseudo;
    }

    /**
     * Return the players status in an array.
     * 1 mean the player is connected and not afk
     * 0 mean the player is connected but afk
     * -1 mean the player has been disconected
     *
     * @return php array
     */
    public function getPlayersStatus($gameId) {
        //TODO recupérer le tableau des joueurs de la partie
        //TODO organiser ses joueurs par id
        //TODO faire une méthode calculant leur status
        //TODO extraire leur status dans un tableau et le retourner

        return getStatus(1);
    }

    /**
     * Return the players scores in an array.
     *
     * @return php array
     */
    public function getPlayersScore($gameId) {
        //TODO recupérer le tableau des joueurs de la partie
        //TODO organiser ses joueurs par id
        //TODO faire une methode de calcule de score
        //TODO extraire leur score dans un tableau et le retourner

        return getScore(1);
    }

    /**
     * Return the curent cards displayed on the board as a array.
     *
     * @return php array
     */
    public function getBoard($gameId) {
        //TODO recupérer le tableau des  de la partie
        //TODO organiser ses joueurs par id
        //TODO faire une methode de calcule de score
        //TODO extraire leur score dans un tableau et le retourner
    }

    /**
     * Return the current status of the turn as integer value.
     * 0 : the turn has not begin, waiting for all players are ready (if afk, disconnected, etc.)
     * 10 : when the story teller is choosing his sentance and his card
     * 20 : when the other players have to choose a card
     * 30 : when the other players have to vote for a card
     * 40 : when the vote is done and the score updated
     *
     * @return integer value
     */
    public function getTurnStatus($gameId) {
        return $this->getCurrentTurn($gameId)->state;
    }

    /**
     * Return the number of the current turn as integer value.
     *
     * @return integer value
     */
    public function getTurnNumber($gameId) {
        $game = Game::find($gameId);
        return $game->turns()->count();
    }

    /**
     * Return the current story teller for this turn
     * 
     * @return integer player id
     */
    public function getStoryTeller($gameId) {
        return $this->getCurrentTurn($gameId)->storyteller()->getResults();
    }

    /**
     * Return the current sentence
     *
     * @return string 
     */
    public function getCurrentSentence($gameId) {
        return $this->getCurrentTurn($gameId)->story;
    }

    /* ================================================================== */
    //      RELATIVE TO ONE PLAYER
    /* ================================================================== */

    /**
     * Return the hand of a specific player. The cards ids are in an array.
     *
     * @return php array
     */
    public function getHand($gameId, $playerId) {
        $game = Game::find($gameId);

        $player = Player::find($playerId);
        $cards = $player->cards()->getResults();

        return $cards;
    }

    /**
     * Return if a player has vote.
     *
     * @return true if voted, false othervise
     */
    public function getVotedStatus($gameId, $playerId) {
        return $this->hasPlayerVoted($gameId, $playerId);
    }

    /**
     * Player vote for a specific card in the board.
     */
    public function vote($gameId, $playerId, $cardId) {
        if ($this->getTurnStatus($gameId) == State::PLAYERS_VOTE &&
                $this->isPlayerOfThisGame($gameId, $playerId) &&
                !$this->isPlayerIdCurrentStorryteller($gameId, $playerId) &&
                $this->isCardOnBoard($gameId, $cardId) &&
                !$this->hasPlayerVoted($gameId, $playerId)) {

            $turn = $this->getCurrentTurn($gameId);

            $selection = $turn->selections()->where('card', '=', Card::find($cardId));
            if ($selection != null) {
                $selection->attach(Player::find($playerId));
                $selection->update();
            }
            if ($turn->selections()->votes() == $game->players()->count - 1) {
                $this->calculateScore();
            }
        }
    }

    /**
     * Player select a card in his hand to match the sentence.
     */
    public function select($gameId, $playerId, $cardId) {
        if ($this->getTurnStatus($gameId) == State::PLAYERS_PLAY &&
                $this->isPlayerOfThisGame($gameId, $playerId) &&
                !$this->isPlayerIdCurrentStorryteller($gameId, $playerId) &&
                $this->hasPlayerACard($gameId, $playerId, $cardId) &&
                !$this->hasPlayerAlreadyPlay($gameId, $playerId)) {

            $game = Game::find($gameId);
            $turn = $this->getCurrentTurn($gameId);

            $selection = new Selection;
            $selection->player()->associate(Player::find($playerId));
            $selection->card()->associate(Card::find($cardId));
            $selection->save();

            $turn->selections()->attach($selection);
            $turn->update();

            if ($turn->selections()->count == $game->players()->count) {
                $turn->state = State::PLAYERS_VOTE;
                $turn->update();
            }
        }
    }

    /**
     * Story teller choose a card and a sentence.
     */
    public function describe($gameId, $playerId, $cardId, $sentence) {
        return $this->hasPlayerACard($gameId, $playerId, $cardId) ? 'true' : 'false';;
        if ($this->getTurnStatus($gameId) == State::STORRYTELLER_PLAY &&
                $this->isPlayerOfThisGame($gameId, $playerId) &&
                $this->isPlayerIdCurrentStorryteller($gameId, $playerId) &&
                $this->hasPlayerACard($gameId, $playerId, $cardId)) {
            $turn = $this->getCurrentTurn($gameId);
            $turn->story = $sentence;

            $selection = new Selection;
            $selection->player()->associate($turn->storyteller());
            $selection->card()->associate(Card::find($cardId));

            $turn->selections()->attach($selection);
            $turn->state = State::PLAYERS_PLAY;
            $turn->update();
        }
    }

    /* ================================================================== */

    //      PUBLIC
    /* ================================================================== */

    public function startNewTurn($gameId) {

        $game = Game::find($gameId);

        if ($game->players()->count() > 0) {

            if ($game->turns()->count() == 0 ||
                    $this->getTurnStatus($gameId) == State::FINISHED) {
                $turn = new Turn;
                $turn->story = "";
                $turn->number = 1;
                $turn->state = State::STORRYTELLER_PLAY;
                $turn->game()->associate($game);
                $turn->storyteller()->associate($this->getCurrentPlayer($gameId));
                $turn->save();
            }
        }
    }

    /* ================================================================== */

    //      PRIVATE
    /* ================================================================== */

    private function getStatus($player) {
        //TODO faire le calcule du status
        return 1;
    }

    private function getScore($player) {
        //TODO recuperer les tours de jeux
        //TODO pour chaque tours calculer le score du joueur
        //TODO sommer ce score et le retourner        
        return 1000;
    }

    private function getCurrentTurn($gameId) {
        $game = Game::find($gameId);
        $maxValue = $game->turns()->max('number');
        $currentTurn = Turn::where('number', '=', $maxValue)->first();
        return $currentTurn;
    }

    private function getRandomPlayer($gameId) {
        $game = Game::find($gameId);
        $playersId = $game->players()->orderBy('pk_id', 'desc')->select('pk_id')->getResults();
        $player = Player::find($playersId[mt_rand(1, count($playersId)) - 1]['pk_id']);
        return $player;
    }

    private function getCurrentPlayer($gameId) {
        $game = Game::find($gameId);
        $playersId = $game->players()->orderBy('pk_id', 'desc')->select('pk_id')->getResults();
        $player = Player::find($playersId[$this->getTurnNumber($gameId) % count($playersId)]['pk_id']);
        return $player;
    }

    private function isPlayerIdCurrentStorryteller($gameId, $playerId) {
        return $this->getCurrentTurn($gameId)->storyteller()->first()->pk_id;
    }

    private function isPlayerOfThisGame($gameId, $playerId) {
        $game = Game::find($gameId);
        $nbPlayer = $game->players()->where('pk_id', '=', $playerId)->count();
        return $nbPlayer == 1;
    }

    private function hasPlayerACard($gameId, $playerId, $cardId) {
        $game = Game::find($gameId);
        $player = Player::find($playerId);
        //return $player->cards()->where('pk_id', '=', $cardId)->count == 1;
        return true;
    }

    private function hasPlayerVoted($gameId, $playerId) {
        $game = Game::find($gameId);
        if($game->players->contains($playerId))
        {
            
        }
        
        $player = Player::find($playerId);
        
        return false;
    }

    private function isCardOnBoard($gameId, $cardId) {
        return true;
    }

    private function hasPlayerAlreadyPlay($gameId, $playerId) {
        return false;
    }

    private function calculateScore($gameId) {
        $turn = $this->getCurrentTurn($gameId);
        $turn->state = State::FINISHED;
        $turn->update();
    }

}

/**
 * Return the current status of the turn as integer value.
 * 0 : the turn has not begin, waiting for all players are ready (if afk, disconnected, etc.)
 * 10 : when the story teller is choosing his sentance and his card
 * 20 : when the other players have to choose a card
 * 30 : when the other players have to vote for a card
 * 40 : when the vote is done and the score updated
 *
 * @return integer value
 */
abstract class State {

    const NOT_STARTED = 0;
    const STORRYTELLER_PLAY = 10;
    const PLAYERS_PLAY = 20;
    const PLAYERS_VOTE = 30;
    const FINISHED = 40;

}
