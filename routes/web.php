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

Route::get('/', function () {
    return view('welcome');
})->middleware('guest');

Auth::routes();

// home feed
Route::get('/home', 'HomeController@index')->name('home');

//adding, deleting posts
Route::post('/home', 'PostsController@store')->name('home');
Route::delete('/home/delete/{post}', 'PostsController@destroy');


// user profile, info edit
Route::get('/profile/{user}', 'UserController@showUsersPosts');
Route::get('/edit', 'UserController@editForm');
Route::put('/edit', 'UserController@update');

// search
Route::get('/search', 'SearchController@getResults')->name('search.results');

// Follow/unfollow
Route::post('/profile/{user}', 'FollowerController@follow');
Route::delete('/profile/{user}', 'FollowerController@unfollow');

