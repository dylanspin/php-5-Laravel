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

Route::get('/message', 'MessageController@index')->name('message');

Auth::routes();

Route::get('/settings', 'SettingsController@index')->name('settings');

Auth::routes();

Route::get('/band','BandController@index')->name('band');

Auth::routes();

Route::post('/search','searchController@formSubmit')->name('search');//gets navBar input

Auth::routes();

Route::post('/band/create','BandController@createBand')->name('band');//gets navBar input

Route::post('/review','ReviewController@formSubmit')->name('review');//gets navBar input

Route::post('/settings/submit','ReviewController@formSubmitSettings')->name('settings');//gets form values profile info

Route::post('/settings/product','ReviewController@submitProduct')->name('settings');

Route::get('/settings/submit3','ReviewController@formSubmitStyle')->name('settings');//gets form values profile style

// Auth::routes();
//
// Route::get('/search', 'SearchController@index')->name('search');
