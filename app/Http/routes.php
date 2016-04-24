<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => 'web'], function(){
	Route::auth();
	Route::get('/home', 'HomeController@index');
});

//API Routing
Route::group(['prefix' => 'v1/'], function(){
	Route::resource('events', 'EventsController');	

	Route::get('users', [
		'as' => 'users.index',
		'uses' => 'UserController@index'
	]);
	Route::get('users/{id}', [
		'as' => 'users.show',
		'uses' => 'UserController@show'
	])->where('id', '[0-9]+');

	Route::post('events/{event}/reminders', [
    	'as'   => 'events.reminders.store',
	    'uses' => 'EventReminderController@store'
	])->where('event', '[0-9]+');
	Route::put('events/{event}/reminders/{reminder}', [
    	'as'   => 'events.reminders.update',
	    'uses' => 'EventReminderController@update'
	])->where('event', '[0-9]+')->where('reminder', '[0-9]+');
	Route::delete('events/{event}/reminders/{reminder}', [
    	'as'   => 'events.reminders.destroy',
	    'uses' => 'EventReminderController@destroy'
	])->where('event', '[0-9]+')->where('reminder', '[0-9]+');
});
