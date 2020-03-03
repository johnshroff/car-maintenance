<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register', 'Api\AuthController@register');
Route::post('/login', 'Api\AuthController@login');

Route::group(['middleware' => 'auth:api'], function()  {
	JsonApi::register('v1')->routes(function ($api) {
		$api->resource('cars', [
			'has-one'	=> 'user',
			'has-many'	=> 'maintenance-events'
		]);
		$api->resource('users', [
			'has-many'	=> 'cars'
		]);
		$api->resource('maintenance-events', [
			'has-one'	=> ['car', 'maintenance-services'],
		]);
		$api->resource('maintenance-services', [
			'has-many'	=> 'maintenance-events'
		]);
	});
});