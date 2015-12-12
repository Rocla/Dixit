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

//Route::get('test','WelcomeController@getName');
// Route::get('home','HomeController@getIndex');
//Route::get('auth','Auth\AuthController@getIndex');
//Route::get('user','UserController@getIndex');
// Route::get('/','WelcomeController@getIndex');

//Route::get('/', ['uses'=>'HomeController@getIndex', 'as'=>'home'] );

Route::post('cards/imageByID', 'WelcomeController@postImageByID');
Route::post('cards_secured/imageByID', 'HomeController@postImageByID');
Route::post('auth/testEmail', 'Auth\AuthController@postTestEmail');
Route::post('play', 'GamesListController@createGame');
Route::post('addPlayer', 'GameListController@addPlayer');
Route::get('board/{board_id}', 'BoardController@getBoard');

/*
 * GAME ACTIONS
 */

// Start the game
Route::get('play/action/create/{gameId}', 'GameController@startGame');
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

// get the player ID from a user ID
Route::get('play/data/player/{userId}', 'GamesListController@getPlayerId');
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
// get the player score
Route::get('play/data/player/score/{gameId}/{playerId}', 'GameController@getScore');




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

