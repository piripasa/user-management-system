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

$router->group(['prefix' => 'api'], function () use ($router) {
    //Group routes
    $router->get('groups', 'GroupController@index');
    $router->post('groups', 'GroupController@store');
    $router->delete('groups/{id}', 'GroupController@destroy');

    //User routes
    $router->get('users', 'UserController@index');
    $router->post('users', 'UserController@store');
    $router->delete('users/{id}', 'UserController@destroy');
});