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

Auth::routes();

Route::group(['namespace' => 'Pages'], function (){
    Route::group(['middleware'=>'auth'], function (){
        Route::group(['namespace'=>'about'], function (){

        });
        Route::group(['namespace'=> 'generalchat', 'prefix' => 'chat'], function (){
            Route::get('/',[
                'uses'           => 'GeneralChatController@getHome',
                'as'             => 'get.generalchat'
            ]);
        });
        Route::group(['namespace'=>'home'], function (){
            Route::get('/',[
                'uses'           => 'HomeController@getHome',
                'as'             => 'get.home'
            ]);
        });
        Route::group(['namespace'=>'profile'], function (){
            Route::get('/profile',[
                'uses'           => 'ProfileController@getProfile',
                'as'             => 'get.profile'
            ]);
            Route::get('/profile/images',[
               'uses'            => 'ProfileController@getProfileImages',
               'as'              => 'get.profile.images'
            ]);
            Route::get('/profile/friends',[
                'uses'           => 'ProfileController@getProfileFriends',
                'as'             => 'get.profile.friends'
            ]);
        });
        Route::group(['namespace'=>'search'], function (){
            Route::get('/search',[
                'uses'            => 'SearchController@getSearch'
            ]);
        });
        Route::group(['namespace'=>'setting'], function (){
            Route::get('/settings',[
               'uses'            => 'SettingController@getSetting',
               'as'              => 'get.settings'
            ]);
            Route::post('/edit/setting',[
                'uses'              =>  'SettingController@editSetting',
                'as'                =>  'post.edit.setting'
            ]);
            Route::post('/edit/profilepic',[
               'uses'               =>  'SettingController@editProfilepic',
               'as'                 =>  'edit.profilepic'
            ]);
            Route::post('/edit/wallpaper',[
               'uses'               =>  'SettingController@editWallpaper',
               'as'                 =>  'edit.wallpaper'
            ]);
        });
        Route::group(['namespace'=>'stalker'], function (){

        });
        Route::group(['namespace'=>'post'], function (){
            Route::get('/post',[
                'uses'           => 'PostController@getPost',
                'as'             => 'get.post'
            ]);
        });
    });
});

Route::group(['prefix'=>'vue'], function (){
    Route::post('/get/messages', [
       'uses'       =>  'VueController@postMessages',
       'as'         =>  'vue.post.messages'
   ]);
    Route::post('/get/your',[
        'uses'      =>  'VueController@postYou',
        'as'        =>  'vue.post.you'
    ]);
    Route::post('/new/message',[
       'uses'       =>  'VueController@postNewMessage',
       'as'         =>  'vue.post.new.message'
    ]);
    Route::post('/get/friendships',[
        'uses'       => 'FriendshipController@getFriendships',
        'as'         => 'get.friendships'
    ]);
    Route::post('/set/friendship',[
        'uses'           => 'FriendshipController@handleFriendship',
        'as'             => 'set.friendship'
    ]);
    Route::post('/new/post',[
        'uses'          => 'VueController@postNewPost',
        'as'            =>  'vue.new.post'
    ]);
    Route::post('/new/like',[
        'uses'               => 'VueController@newLike',
        'as'                 => 'post.new.like'
    ]);
    Route::post('/get/posts', [
       'uses'           =>  'VueController@postPosts',
        'as'            =>  'vue.get.posts'
    ]);
});
