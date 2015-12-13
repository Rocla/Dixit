<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
/*
 * NAVIGATION
 */

Route::post('cards/imageByID', 'WelcomeController@postImageByID');
Route::post('cards_secured/imageByID', 'HomeController@postImageByID');
Route::post('auth/testEmail', 'Auth\AuthController@postTestEmail');
Route::post('play', 'GamesListController@getIndex');
Route::get('board/{board_id}',['as'=>'board', 'uses'=>'BoardController@getBoard'] );;

/*
 * GAME ACTIONS
 */

// Create the game
Route::post('play/action/create', 'GamesListController@createGame');
// Start the game
Route::get('play/action/start/{gameId}', 'GameController@startGame');
// Create a new turn
Route::get('play/action/new/turn/{gameId}', 'GameController@startNewTurn');
// Describe a story
Route::get('play/action/tell/{gameId}/{playerId}/{cardId}/{sentence}', 'GameController@describe');
// Choose a card
Route::get('play/action/choose/card/{gameId}/{playerId}/{cardId}', 'GameController@select');
// Vote for a card
Route::get('play/action/vote/{gameId}/{playerId}/{cardId}', 'GameController@vote');

/*
 * GAME DATA
 */

// add player
 Route::get('play/{gameId}/{playId}', 'GamesListController@addPlayer');
// get the player ID from a user ID
Route::get('play/data/player/{userId}', 'GamesListController@getPlayerId');
//get  game owner
Route::get('play/data/owner/{gameId}', 'GamesListController@getOwnerId' );
// get the game ID from a user ID
Route::get('play/data/game/{userId}', 'GamesListController@getGameId');
// get the list of players from game ID
Route::get('play/data/players/{gameId}', 'GameController@getPlayersId');
// has player already voted
Route::get('play/data/player/voted/status/{gameId}/{playerId}', 'GameController@hasPlayerVoted');
// has player already play a card
Route::get('play/data/player/played/status/{gameId}/{playerId}', 'GameController@hasPlayerAlreadyPlay');
// get the story teller id
Route::get('play/data/story/teller/{gameId}', 'GameController@getStoryTeller');
// get the sentence of the turn
Route::get('play/data/story/{gameId}', 'GameController@getCurrentSentence');
// get the turn number
Route::get('play/data/turn/number/{gameId}', 'GameController@getTurnNumber');
// get the turn status @see State in GameController on the botom
Route::get('play/data/turn/status/{gameId}', 'GameController@getTurnStatus');
// get the cards played on the board
Route::get('play/data/turn/board/{gameId}', 'GameController@getBoard');
// get the game status (started or not)
Route::get('play/data/game/status/{gameId}', 'GameController@getGameStarted');
// get the player score
Route::get('play/data/player/score/{gameId}/{playerId}', 'GameController@getScore');
// Get the player hands
Route::get('play/data/player/hand/{gameId}/{playerId}', 'GameController@getHand');
// Get image name by id
Route::get('play/data/cards/name/{cardId}', 'HomeController@getImageByID');
// get the played status of players (as a array of bool in the same order as players list)
Route::get('play/data/players/played/status/{gameId}', 'GameController@getPlayersWhoPlayed');
// get the voted status of players (as a array of bool in the same order as players list)
Route::get('play/data/players/voted/status/{gameId}', 'GameController@getPlayersWhoVoted');


/*
 * DEBUG
 */
Route::get('play/trial', 'GameController@trial');



Route::controllers
([
    'board'	=>	'BoardController',
	'readme'=>	'ReadMeController',
	'rules'	=>	'RulesController',
	'home'	=>	'HomeController',
	'auth'	=>	'Auth\AuthController',
	'user'	=>	'UserController',
	'play' =>	'GamesListController',
	'/'     => 	'WelcomeController',
        
 ]);

