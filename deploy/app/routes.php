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

Route::get('/', 'HomeController@home');

Route::get('/playlists/export/{id}', 'PlaylistsController@export_artist');

Route::get('/playlists/export', 'PlaylistsController@export_postlogin');
Route::post('/playlists/export', 'PlaylistsController@export_tracks');

Route::get('/artist/{id}', 'PlaylistsController@view');

Route::get('/auth/logout', 'AuthController@logout');
Route::get('/auth/spotify', 'AuthController@spotify_login');
Route::get('/auth/spotify/callback', 'AuthController@spotify_callback');
