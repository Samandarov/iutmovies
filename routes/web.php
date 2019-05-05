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

Route::get('/', 'PagesController@index');

Auth::routes();
Route::get('/logout','Auth\LoginController@logout');

Route::get('/dashboard', 'DashboardController@index');
// http:posts//www.omdbapi.com/?apikey=1150ac4&t=Dark%20knight
Route::resource('movies','MovieController');
Route::resource('series','SeriesController');
Route::post('/comments', 'CommentController@store');
Route::delete('/comments/{id}', 'CommentController@destroy');
Route::post('/search', 'SearchController@search');

Route::get('socialauth/{provider}', 'Auth\SocialAuthController@redirectToProvider');
Route::get('socialauth/{provider}/callback', 'Auth\SocialAuthController@handleProviderCallback');