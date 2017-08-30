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
Route::get('/calendars/{scheduleid}/create', 'TimeblocksController@create' );

Route::resource('articles', 'ArticlesController');
Route::resource('games', 'GamesController');
Route::resource('events', 'SchedulesController');

Auth::routes();
Route::get('/dashboard', 'DashboardController@index');
