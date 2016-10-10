<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return redirect()->route('users.index');
});

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::resource('users', 'UserController', ['except' => ['store', 'create']]);
Route::resource('matches', 'MatchController', ['only' => ['index', 'show', 'create', 'store']]);
