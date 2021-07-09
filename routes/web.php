<?php

/** @var \Laravel\Lumen\Routing\Router $router */

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

$router->group(['prefix' => 'api/v1'], function () use ($router) {
    // Wallet
    $router->get('/wallet', 'WalletController@index');
    $router->get('/wallet/{id}', 'WalletController@show');
    $router->post('/wallet', 'WalletController@store');
    $router->put('/wallet/{id}', 'WalletController@update');
    $router->delete('/wallet/{id}', 'WalletController@destroy');

    // Transaction Type
    $router->get('/transaction-type', 'TransactionTypeController@index');
    $router->get('/transaction-type/{id}', 'TransactionTypeController@show');
    $router->post('/transaction-type', 'TransactionTypeController@store');
    $router->put('/transaction-type/{id}', 'TransactionTypeController@update');
    $router->delete('/transaction-type/{id}', 'TransactionTypeController@destroy');
});
