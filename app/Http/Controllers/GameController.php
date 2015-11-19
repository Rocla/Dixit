<?php

namespace Dixit\Http\Controllers;

use Dixit\Http\Controllers\Controller;
use Dixit\InterfaceDAO\PlayerInterface;
class GameController extends Controller
{
    private $player;
    
    function __construct(PlayerInterface $player) {
        $this->player = $player;
    }

    /*==================================================================*/
    //      RELATIVE TO ALL PLAYER / TO A GAME
    /*==================================================================*/
    
    /**
     * Return the players pseudo in an array.
     *
     * @return php array
     */
    public function getPlayers($gameId)
    {
        return $this->player->getPlayerInGame($gameId);
    }
    
    /**
     * Return the players status in an array.
     * 1 mean the player is connected and not afk
     * 0 mean the player is connected but afk
     * -1 mean the player has been disconected
     *
     * @return php array
     */
    public function getPlayersStatus($gameId)
    {
        
    }

    /**
     * Return the players scores in an array.
     *
     * @return php array
     */
    public function getPlayersScore($gameId)
    {
        
    }
    
    /**
     * Return the curent cards displayed on the board as a array.
     *
     * @return php array
     */
    public function getBoard($gameId)
    {
        
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
    public function getTurnStatus($gameId)
    {
        
    }  
    
    /**
     * Return the number of the current turn as integer value.
     *
     * @return integer value
     */
    public function getTurnNumber($gameId)
    {
        
    }
    
    /**
     * Return the current story teller for this turn
     *
     * @return integer index (relative to the getPlayer() returned array)
     */
    public function getStoryTeller($gameId)
    {
        
    }
    
    /**
     * Return the current sentence
     *
     * @return string 
     */
    public function getCurrentSentence($gameId)
    {
        
    }
    
    /*==================================================================*/
    //      RELATIVE TO ONE PLAYER
    /*==================================================================*/
    
    /**
     * Return the hand of a specific player. The cards ids are in an array.
     *
     * @return php array
     */
    public function getHand($gameId, $playerId)
    {
        
    }
        
    /**
     * Return if a player has vote.
     *
     * @return true if voted, false othervise
     */
    public function getVotedStatus($gameId, $playerId)
    {
        
    }
    
    /**
     * Player vote for a specific card in the board.
     */
    public function vote($gameId, $playerId, $cardId)
    {
        
    }
    
    /**
     * Player select a card in his hand to match the sentence.
     */
    public function select($gameId, $playerId, $cardId)
    {
        
    }
    
    /**
     * Story teller choose a card and a sentence.
     */
    public function describe($gameId, $playerId, $cardId, $sentence)
    {
        
    }
}
