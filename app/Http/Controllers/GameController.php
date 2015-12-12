<?php

namespace Dixit\Http\Controllers;

use Dixit\Http\Controllers\Controller;
use \Illuminate\Support\Facades\DB;
use Dixit\Game;
use Dixit\Player;
use Dixit\User;
use Dixit\Turn;
use Dixit\Card;
use Dixit\Selection;
use \Dixit\Deck;

class GameController extends Controller {
    /* ================================================================== */
    //      RELATIVE TO ALL PLAYER / TO A GAME
    /* ================================================================== */

    /**
     * Return the players id in an array.
     *
     * @return php array
     */
    public function getPlayersId($gameId) {
        $game = Game::find($gameId);
        $player = $game->players()->orderBy('pk_id', 'desc')->select('pk_id')->getResults();

        return $player;
    }

    /**
     * Return the players status in an array.
     * 0 : The player has not played
     * 1 : The player has played
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
        return $this->getCurrentTurn($gameId)->storyteller()->select('pk_id')->
                        getResults()['pk_id'];
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
        if (!$this->isPlayerOfThisGame($gameId, $playerId))
            return "this player doesn't belong to this game";
        if ($this->getTurnStatus($gameId) != State::PLAYERS_VOTE)
            return "it's not the time to vote for a card";
        if ($this->isPlayerIdCurrentStorryteller($gameId, $playerId))
            return "the story teller can't vote now";
        if (!$this->isCardOnBoard($gameId, $cardId))
            return "this card is not on the board";
        if ($this->hasPlayerVoted($gameId, $playerId))
            return "this player has already voted";

        $turn = $this->getCurrentTurn($gameId);

        $selection = $turn->selections()->where('fk_cards', '=', $cardId)->first();
        if ($selection != null) {

            $selectionPlayerId = $selection->player()->select('pk_id')->getResults()['pk_id'];
            if ($selectionPlayerId == $playerId)
                return "this player can't vote for his card";

            $selection->votes()->attach($playerId);
            $selection->update();
        }
        
        $game = Game::find($gameId);
        
        if ($this->getVoteCount($gameId) == $game->players()->count() - 1) {
            $this->calculateScore($gameId);
        }
    }

    /**
     * Player select a card in his hand to match the sentence.
     */
    public function select($gameId, $playerId, $cardId) {
        if (!$this->isPlayerOfThisGame($gameId, $playerId))
            return "this player doesn't belong to this game";
        if ($this->getTurnStatus($gameId) != State::PLAYERS_PLAY)
            return "it's not the time to play a card";
        if ($this->isPlayerIdCurrentStorryteller($gameId, $playerId))
            return "the story teller can't play now";
        if (!$this->hasPlayerACard($gameId, $playerId, $cardId))
            return "this player doesn't have this card";
        if ($this->hasPlayerAlreadyPlay($gameId, $playerId))
            return "this player has already played";

        $game = Game::find($gameId);
        $turn = $this->getCurrentTurn($gameId);

        //Create the player selection
        $selection = new Selection;
        $selection->player()->associate(Player::find($playerId));
        $selection->card()->associate(Card::find($cardId));
        $selection->turn()->associate($turn);
        $selection->save();

        //remove card from player hand
        Player::find($playerId)->cards()->detach(Card::find($cardId));

        if ($turn->selections()->count() == $game->players()->count()) {
            $turn->state = State::PLAYERS_VOTE;
            $turn->update();
        }
    }

    /**
     * Story teller choose a card and a sentence.
     */
    public function describe($gameId, $playerId, $cardId, $sentence) {
        if (!$this->isPlayerOfThisGame($gameId, $playerId))
            return "this player doesn't belong to this game";
        if ($this->getTurnStatus($gameId) != State::STORRYTELLER_PLAY)
            return "it's not the time to tell a story";
        if (!$this->isPlayerIdCurrentStorryteller($gameId, $playerId))
            return "this player is not the story teller now";
        if (!$this->hasPlayerACard($gameId, $playerId, $cardId))
            return "this player doesn't have this card";

        $turn = $this->getCurrentTurn($gameId);
        $turn->story = $sentence;

        //Create the player selection
        $selection = new Selection;
        $selection->player()->associate($turn->storyteller()->first());
        $selection->card()->associate(Card::find($cardId));
        $selection->turn()->associate($turn);
        $selection->save();

        //remove card from player hand
        Player::find($playerId)->cards()->detach(Card::find($cardId));

        $turn->state = State::PLAYERS_PLAY;
        $turn->update();
    }

    /* ================================================================== */

    //      PUBLIC
    /* ================================================================== */

    public function startGame($gameId) {

        $game = Game::find($gameId);

        if (!$game->started) {

            if (count($game->decks()->select('pk_id')->getResults()) == 0)
                return "the game is not well init (not decks linked)";

            $nbPlayers = $game->players()->count();
            if ($nbPlayers >= 3) {

                $idPlayers = $game->players()->select('pk_id')->getResults();
                foreach ($idPlayers as $id) {
                    $idPlayer = $id['pk_id'];

                    for ($i = 1; $i <= 6; $i++) {
                        $card = Card::find($this->getRandomCard($gameId));
                        $player = Player::find($idPlayer);
                        $player->cards()->attach($card);
                        $player->update();
                    }
                }
                $game->started = true;
                $game->update();
            } else {
                return "not enough players";
            }
        } else {
            return "game already started";
        }
    }

    public function startNewTurn($gameId) {

        $game = Game::find($gameId);

        if ($game->started) {

            if ($game->turns()->count() == 0 ||
                    $this->getTurnStatus($gameId) == State::FINISHED) {
                $turn = new Turn;
                $turn->story = "";
                $turn->number = $this->getTurnNumber($gameId)+1;
                $turn->state = State::STORRYTELLER_PLAY;
                $turn->game()->associate($game);
                $turn->storyteller()->associate($this->getCurrentPlayer($gameId));
                $turn->save();
            } else {
                return "a turn is currently playing";
            }
        } else {
            return "game is not started";
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
        $currentTurn = $game->turns()->where('number', '=', $maxValue)->first();
        return $currentTurn;
    }

    private function getRandomPlayer($gameId) {
        $game = Game::find($gameId);
        $playersId = $game->players()->orderBy('pk_id', 'desc')->select('pk_id')->getResults();
        $player = Player::find($playersId[mt_rand(0, count($playersId)) - 1]['pk_id']);
        return $player;
    }

    private function getCurrentPlayer($gameId) {
        $game = Game::find($gameId);
        $playersId = $game->players()->orderBy('pk_id', 'desc')->select('pk_id')->getResults();
        $player = Player::find($playersId[$this->getTurnNumber($gameId) % count($playersId)]['pk_id']);
        return $player;
    }

    private function isPlayerIdCurrentStorryteller($gameId, $playerId) {
        return $this->getCurrentTurn($gameId)->storyteller()->first()->pk_id == $playerId;
    }

    private function isPlayerOfThisGame($gameId, $playerId) {
        $game = Game::find($gameId);
        $nbPlayer = $game->players()->where('pk_id', '=', $playerId)->count();
        return $nbPlayer == 1;
    }

    private function hasPlayerACard($gameId, $playerId, $cardId) {
        $player = Player::find($playerId);
        return count($player->cards()->where('pk_id', '=', $cardId)->first()) == 1;
    }

    private function hasPlayerVoted($gameId, $playerId) {
        $turn = $this->getCurrentTurn($gameId);

        $selectionsId = $turn->selections()->select('pk_id')->getResults();

        foreach($selectionsId as $id) {
            $selection = Selection::find($id['pk_id']);
            if($selection->votes()->where('fk_players', '=', $playerId)->count() > 0)
                return true;
        }
    }
    
    private function getVoteCount($gameId) {
        $turn = $this->getCurrentTurn($gameId);

        $selectionsId = $turn->selections()->select('pk_id')->getResults();

        $total = 0;
        foreach($selectionsId as $id) {
            $selection = Selection::find($id['pk_id']);
            $total += $selection->votes()->count();
        }
        
        return $total;
    }

    private function isCardOnBoard($gameId, $cardId) {
        return $this->getCurrentTurn($gameId)->selections()->
                        where('fk_cards', '=', $cardId)->count() > 0;
    }

    private function hasPlayerAlreadyPlay($gameId, $playerId) {
        return $this->getCurrentTurn($gameId)->selections()->
                        where('fk_players', '=', $playerId)->count() > 0;
    }

    private function isCardAlreadyPlayed($gameId, $cardId) {
        $result = false;

        if (Selection::where("fk_cards", "=", $cardId)->count() > 0)
            $result = true;

        if (DB::table('hands')->where("fk_cards", "=", $cardId)->count() > 0)
            $result = true;

        return $result;
    }

    private function calculateScore($gameId) {
        $turn = $this->getCurrentTurn($gameId);
        $turn->state = State::FINISHED;
        $turn->update();
    }

    private function getRandomCard($gameId) {
        $game = Game::find($gameId);
        $idDecks = $game->decks()->select('pk_id')->getResults();

        $idDeckChoosen = $idDecks[mt_rand(0, count($idDecks) - 1)]['pk_id'];

        $deck = Deck::find($idDeckChoosen);
        $idCards = $deck->cards()->select('pk_id')->getResults();

        $idCardChoosen;
        do {
            $idCardChoosen = $idCards[mt_rand(0, count($idCards) - 1)]['pk_id'];
        } while ($this->isCardAlreadyPlayed($gameId, $idCardChoosen));

        return $idCardChoosen;
    }

    public function trial() {
        $this->getPlayers(4);
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
