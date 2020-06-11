<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['prefix' => 'board'], function () use ($router) {
	$router->get('/',  ['uses' => 'BoardController@index']);
	$router->post('save',  ['uses' => 'BoardController@store']);
	$router->get('show/{id}', ['uses' => 'BoardController@show']);
	$router->post('update/{id}',  ['uses' => 'BoardController@update']);
	$router->get('delete/{id}',  ['uses' => 'BoardController@delete']);
});

$router->group(['prefix' => 'user'], function () use ($router){
	$router->post('login', ['uses' => 'AuthController@login']);
	$router->get('logout', ['uses' => 'AuthController@logout']);
	$router->post('register', ['uses' => 'AuthController@register']);
});

$router->group(['prefix' => 'board'], function () use ($router) {
	$router->get('/{board}/list',  ['uses' => 'ListController@index']);
	$router->post('save/{board}/list',  ['uses' => 'ListController@store']);
	$router->get('show/{board}/list/{list}', ['uses' => 'ListController@show']);
	$router->post('update/{board}/list/{list}',  ['uses' => 'ListController@update']);
	$router->get('delete/{board}/list/{list}',  ['uses' => 'ListController@delete']);
});


$router->group(['prefix' => 'boardcard'], function () use ($router) {
	$router->get('{board}/list/{list}/card',  ['uses' => 'CardController@index']);
	$router->post('{board}/list/save/{list}/card',  ['uses' => 'CardController@store']);
	$router->get('{board}/list/show/{list}/card/{card}', ['uses' => 'CardController@show']);
	$router->post('{board}/list/update/{list}/card/{card}',  ['uses' => 'CardController@update']);
	$router->get('{board}/list/delete/{list}/card/{card}',  ['uses' => 'CardController@delete']);
});