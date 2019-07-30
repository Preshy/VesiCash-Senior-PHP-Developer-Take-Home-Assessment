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
   // return app('db')->select('SELECT * FROM escrow_transactions');
    return $router->app->version();
});

$router->get('/all', function () use ($router) {
    return dd(app('db')->select('SELECT * FROM escrow_transactions'));
    //return $router->app->version();
});

$router->get('escrow/transactions', 'EscrowTransactionsController@all');
$router->post('escrow/transaction/create', 'EscrowTransactionsController@create');
$router->put('escrow/transaction/edit', 'EscrowTransactionsController@edit');
$router->delete('escrow/transaction/delete', 'EscrowTransactionsController@delete');