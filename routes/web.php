<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'PagesController@index' );
Route::get('/home', 'PagesController@index' );
Route::get('/main', 'PagesController@index' );
Route::get('/about', 'PagesController@about' );
Route::get('/services', 'PagesController@services' );

Route::get('/calendars/{id}', 'TimeblocksController@show' );
Route::get('/calendars/{scheduleid}/modify', 'TimeblocksController@create' );
Route::post('/calendars/{scheduleid}/modify', 'TimeblocksController@store');
Route::get('/calendars/{scheduleid}/edit', 'TimeblocksController@edit');
Route::put('/calendars/{id}', 'TimeblocksController@update' );
Route::delete('/calendars/{timeblockid}/delete', 'TimeblocksController@destroy');

Route::resource('articles', 'ArticlesController');
Route::resource('games', 'GamesController');
Route::resource('events', 'SchedulesController');
Route::resource('locations', 'LocationsController');

Auth::routes();
Route::get('/dashboard', 'DashboardController@index');
