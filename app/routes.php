<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::group(['before'=>'guest'], function() {
    Route::get('/login', 'AppController@showLogin');
    Route::post('/login', 'AppController@doLogin');
    Route::get('/register', 'AppController@showRegister');
    Route::post('/register', 'AppController@doRegister');
});

Route::group(['before'=>'auth'], function(){
    Route::get('/logout', 'AppController@logout');

    Route::get('/', 'AppController@index');
    Route::get('/profile/{id}', 'UserController@profile');

    Route::get('/search', 'SearchController@index');
    Route::post('/search', 'SearchController@search');

    Route::get('/users/online', 'UserController@online');

    Route::get('/notification', 'UserController@notification');
    Route::get('/notification/new/{id}', 'NotificationController@newNotifications');


    Route::get('/newsfeed', 'NewsFeedController@newsFeed');
    Route::get('/newsfeed/new/posts/{id}', 'NewsFeedController@newPosts');

    Route::get('/post/status', 'PostStatusController@getPostStatus');
    Route::post('/post/status', 'PostStatusController@postStatus');
    Route::get('/post/star/{id}', 'PostStatusController@postStar');
    Route::get('/post/comments/{id}', 'PostStatusController@getPostComments');
    Route::post('/post/comments/{id}', 'PostStatusController@postComments');
    Route::get('/post/edit/{id}', 'PostStatusController@edit');
    Route::post('/post/save/{id}', 'PostStatusController@save');
    Route::get('/post/remove/{id}', 'PostStatusController@remove');

    Route::get('/messages', 'MessageController@index');

    Route::get('/messages/view/{id}', 'MessageController@view');
    Route::post('/messages/personal/reply/{id}', 'MessageController@personalReply');
    Route::get('/messages/personal/delete/{id}', 'MessageController@personalDelete');

    Route::post('/messages/mygroup/create/', 'MessageController@myGroupCreate');
    Route::get('/messages/mygroup/{id}/add/{StudentID}', 'MessageController@myGroupAddPeople');
    Route::post('/messages/mygroup/{id}/search', 'MessageController@myGroupSearchPeople');


    Route::get('/messages/mygroup/view/{id}', 'MessageController@myGroupView');
    Route::get('/messages/group/view/{id}', 'MessageController@groupView');

    Route::get('/favorites', 'AppController@favorites');
    Route::get('/favorites/add/{id}', 'FavoriteController@add');
    Route::get('/favorites/remove/{id}', 'FavoriteController@remove');

    Route::get('/files', 'FilesController@index');

    Route::get('/more', 'AppController@more');

    Route::get('/grouppage/{id}', 'GroupPageController@view');
    Route::post('/grouppage/post/{id}', 'GroupPageController@postMessage');


});

Route::get('/angularjs', function ()
{
    return View::make('angularSample');
});
