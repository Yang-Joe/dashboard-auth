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

$app->get('/', function () use ($app) {
    return $app->version();
});

$app->group(['prefix' => 'group', 'namespace' => 'App\Http\Controllers\Api'], function ($app) {
    $app->post('create', 'GroupController@store');
    $app->post('update', 'GroupController@update');
    $app->post('delete', 'GroupController@destory');
    $app->get ('list', 'GroupController@index');
});

$app->group(['prefix' => 'role', 'namespace' => 'App\Http\Controllers\Api'], function ($app) {
    $app->post('create', 'RoleController@store');
    $app->post('update', 'RoleController@update');
    $app->post('delete', 'RoleController@destroy');
    $app->get ('{groupID}', 'RoleController@index');
});

$app->group(['prefix' => 'user', 'namespace' => 'App\Http\Controllers\Api'], function ($app) {
    $app->post('register', 'AuthController@register');
    $app->post('update', 'AuthController@update');
    $app->post('delete', 'AuthController@destroy');
    $app->get ('{userID}', 'AuthController@index');
});
