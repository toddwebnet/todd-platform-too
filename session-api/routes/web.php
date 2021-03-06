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

$router->get('/start', 'SessionController@start');
$router->post('/start', 'SessionController@start');
$router->get('/ping', 'SessionController@ping');
$router->get('/get', 'SessionController@get');
$router->post('/set/{key}', 'SessionController@setKey');
$router->post('/set', 'SessionController@setSet');
$router->post('/end', 'SessionController@end');
