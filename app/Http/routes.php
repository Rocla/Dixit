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
Route::get('play/trial', 'GameController@trial');

/*To test the game controler*/

//0 start a game
//Route::get('play/{gameId}', 'GameController@startGame');
//1 start a turn
Route::get('play/{gameId}', 'GameController@startNewTurn');
//2 describe a card by storyteller
//Route::get('play/{gameId}/{playerId}/{cardId}/{sentence}', 'GameController@describe');
//3 all player choose a card
//Route::get('play/{gameId}/{playerId}/{cardId}', 'GameController@select');
//4 all player vote for a card
//Route::get('play/{gameId}/{playerId}/{cardId}', 'GameController@vote');


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

