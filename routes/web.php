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

// genre routes
Route::get('/zanr', 'GenreController@index')->name('genre.index');
Route::get('/zanr/kreiraj', 'GenreController@create')->name('genre.create');
Route::post('/zanr/kreiraj', 'GenreController@store')->name('genre.store');
Route::delete('/zanr/{id}', 'GenreController@destroy')->name('genre.destroy');
Route::get('/zanr/{id}/edit', 'GenreController@edit')->name('genre.edit');
Route::post('/zanr/{id}', 'GenreController@update')->name('genre.update');


// movies routes
Route::get('/{letter?}', 'MovieController@index')->name('movie.index');
Route::get('/filmovi/unos', 'MovieController@create')->name('movie.create');
Route::post('/filmovi/unos', 'MovieController@store')->name('movie.store');
Route::get('/filmovi/unos/{id}/uredi', 'MovieController@edit')->name('movie.edit');
Route::post('/filmovi/{id}', 'MovieController@update')->name('movie.update');
Route::delete('/filmovi/unos/{id}', 'MovieController@destroy')->name('movie.destroy');
