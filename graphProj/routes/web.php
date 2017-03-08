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

Route::get('/', 'dController@home');

Route::get('test','dController@test');

Route::get('trans','dController@trans');

Route::get('map','dController@maps');

Route::get('usmap','dController@usmap');

Route::get('oceans',function() {
	return view('oceans');
});
