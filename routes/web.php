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

    // Category
    $router->get('/category', 'CategoryController@index');
    $router->get('/category/{id}', 'CategoryController@show');
    $router->post('/category', 'CategoryController@store');
    $router->put('/category/{id}', 'CategoryController@update');
    $router->delete('/category/{id}', 'CategoryController@destroy');

    // Transaction
    $router->get('/transaction', 'TransactionController@index');
    $router->get('/transaction/{id}', 'TransactionController@show');
    $router->post('/transaction', 'TransactionController@store');
    $router->put('/transaction/{id}', 'TransactionController@update');
    $router->delete('/transaction/{id}', 'TransactionController@destroy');
    $router->get('/transaction-detail', 'TransactionController@indexJoin');
    $router->get('/transaction-detail/{id}', 'TransactionController@showJoin');
});
