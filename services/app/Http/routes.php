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

// $app->get('/', function () use ($app) {
//     return $app->welcome();
// });

$app->get('/',function () use ($app){
	return $app->welcome();
});

$app->group([
    'prefix' => 'api/', 
    'namespace' => 'App\Api'], function() use($app) {

    // registrasi
    $app->post('registrasi/reg', 'Registrasi@byReg');
    $app->get('registrasi/{nik}', 'Registrasi@byNik');

    #token
    $app->post('authenticate', 'AuthenticateController@authenticate');
    $app->get('authenticate/user', 'AuthenticateController@getAuthenticatedUser');
});

$app->group([
    'prefix' => 'api/v1', 
    'namespace' => 'App\Api', 'before' => 'auth'], function() use($app) {

    #token
    $app->get('/', 'APIController@index');
    $app->get('user', 'APIController@getUser');
    $app->post('user', 'APIController@getUserPost');
});