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

Route::prefix('v1')->group(function () {
	Route::prefix('auth')->group(function () {
		Route::post('/login', 'API\AuthController@login')->name('login');
		Route::post('/register', 'API\AuthController@register')->name('register');
	});
	
	Route::get('/home', 'API\APIHomeController@index');
	Route::group(['prefix'=>'user', 'middleware'=>['jwt.verify']], function(){
		Route::get('current', 'API\AuthController@getAuthenticatedUser');
		Route::post('logout', 'API\AuthController@logout');

	});
});
