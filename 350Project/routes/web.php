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

Route::get('/', 'JqueryController@jquery');


Route::get('/bars', 'JqueryController@barsQuery');

Route::get('/lines', 'JqueryController@showlines');


Route::get('/disc', function () {
    return view('disc');
});

Route::get('/tester', function () {
    return view('updateLines');
});

Route::get('/d3', function() {
   return view('map');
});
Route::get('/barstest', function() {
   return view('d3bars');
});

Route::get('/test', 'JqueryController@jquery');
Route::get('/ajaxget', 'JqueryController@get');
Route::get('/lineinfo','JqueryController@linesget');
