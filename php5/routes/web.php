<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::group(['middleware' => ['auth']], function() {
  Route::resource('contacts', 'ContactController');
  Route::resource('companies', 'CompanyController');
  Route::get('/home,HomeController@index')->name('home');
});
