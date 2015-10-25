<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// Front page route
Route::get('/', function () {
    return view('welcome');
});

// Unprotected page rountes
Route::get('about', 'PagesController@about');
Route::get('images', 'PagesController@images');

// Authentication routes
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');

// Upload routes
Route::post('computer/upload', 'UploadController@computerUpload');
Route::get('instagram/upload', 'UploadController@instagramUpload');
Route::get('approve/upload', 'UploadController@approveUpload');
Route::get('decline/upload', 'UploadController@declineUpload');

// Protected routes (login required)
Route::group(array('before' => 'auth'), function()
{
   Route::get('upload', 'PagesController@upload');
   Route::get('controlpanel', 'PagesController@controlpanel');
});

// Redirect guests to login if required
Route::filter('auth', function()
{
    if (Auth::guest()) return Redirect::to('auth/login');
});