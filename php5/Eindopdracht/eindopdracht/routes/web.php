<?php

use Illuminate\Support\Facades\Route;

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
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/profile/{user}', 'profileController@index')->name('profile.show');

Auth::routes();

Route::get('/bandPage/{user}', 'profileController@showBand')->name('profile.show');

Auth::routes();

Route::get('/message', 'MessageController@index')->name('message');

Auth::routes();

Route::get('/settings', 'SettingsController@index')->name('settings');

Auth::routes();

Route::get('/band','BandController@index')->name('band');

Auth::routes();

Route::post('/search','searchController@formSubmit')->name('search');//gets navBar input

Auth::routes();

Route::post('/message/accept','MessageController@Acceptinvite')->name('message');//accepts invite

Route::post('/message/decline','MessageController@DeclineInvite')->name('message');//declines invite

Route::post('/band/Invite','BandController@invite')->name('band');//invites person

Route::post('/band/setGradient','BandController@formSubmitStyle')->name('band');//sets band style

Route::post('/band/create','BandController@createBand')->name('band');//creates new band

Route::post('/bands/product','BandController@submitProduct')->name('band');

Route::post('/band/leave','BandController@leaveBand')->name('band');

Route::post('/band/setting','BandController@SubmitSettings')->name('band');//sets band style

Route::post('/band/vids','BandController@SubmitVids')->name('band');//sets band vids

Route::post('/band/kick','BandController@kickMember')->name('band');//sets band vids

Route::post('/band/promote','BandController@promote')->name('band');//promote's member

Route::post('/review','ReviewController@formSubmit')->name('review');//creates new review

Route::post('/settings/send','ReviewController@formSubmitSettings')->name('review');//gets form values profile info

Route::get('/settings/submit3','ReviewController@formSubmitStyle')->name('settings');//gets form values profile style

// Auth::routes();
//
// Route::get('/search', 'SearchController@index')->name('search');
