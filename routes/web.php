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
Route::delete('/home/delete/{post}', 'PostsController@destroy')->name('deletePost');


// user profile, info edit
Route::get('/profile/{user}', 'UserController@showUsersPosts')->name('profile');
Route::get('/edit', 'UserController@editForm')->name('editForm');
Route::put('/edit', 'UserController@update')->name('updateProfileInfo');
Route::put("/edit/img", "UserController@profilePictureUpload")->name("editProfile");

// search
Route::get('/search', 'SearchController@getResults')->name('search.results');

// Follow, unfollow, following view
Route::post('/profile/{user}', 'FollowerController@follow')->name('follow');
Route::delete('/profile/{user}', 'FollowerController@unfollow')->name('unfollow');
Route::get('/following', 'FollowerController@allFollowingTo')->name('following');

//Add Friend, unfriend, approve and delete requests, friends view
Route::post('/profile/friend/{user}', 'PendingInvitationController@inviteFriend')->name('inviteFriend');
Route::delete('/profile/friend/{user}', 'FriendsController@deleteFriend')->name('deleteFriend');
Route::get('/friends', 'FriendsController@allFriendsAndPending')->name('friendsAndPending');
Route::post('friends/approve/{user}', 'PendingInvitationController@approveFriend')->name('approveFriend');
Route::delete('/friends/{user}', 'PendingInvitationController@deleteFriendRequest')->name('deleterequest');
Route::delete('/friends/delete/{user}', 'FriendsController@deleteFriendFromFriendsView')->name('deleteFriendFromView');

//Like, unlike function
Route::post('/like/{post}', 'LikeController@like')->name('likePost');
Route::delete('/like/{post}', 'LikeController@unlike')->name('unlikePost');

//Galleries
Route::get('/galleries', 'GalleryController@allGalleries')->name('galleriesShow');
Route::post('/galleries', 'GalleryController@storeGallery')->name('galleriesStore');
Route::get('/galleries/{gallery}', 'GalleryController@show')->name('galleryShow');
Route::post('/gallery/{gallery}', 'ImageController@uploadImage')->name('gallery');
Route::delete('/gallery/{image}', 'ImageController@deleteImage')->name('galleryDelete');
Route::delete('/galleries/delete/{gallery}', 'GalleryController@deleteGallery')->name('galleries');



