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

// Follow, unfollow, following view
Route::post('/profile/{user}', 'FollowerController@follow');
Route::delete('/profile/{user}', 'FollowerController@unfollow');
Route::get('/following', 'FollowerController@allFollowingTo');

//Add Friend, unfriend, approve and delete requests, friends view
Route::post('/profile/friend/{user}', 'PendingInvitationController@inviteFriend');
Route::delete('/profile/friend/{user}', 'FriendsController@deleteFriend');
Route::get('/friends', 'FriendsController@allFriendsAndPending');
Route::post('friends/approve/{user}', 'PendingInvitationController@approveFriend');
Route::delete('/friends/{user}', 'PendingInvitationController@deleteFriendRequest');
Route::delete('/friends/delete/{user}', 'FriendsController@deleteFriendFromFriendsView');

//Like, unlike function
//Route::post('/profile/friend/{user}', 'LikeController@like');

