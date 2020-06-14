<?php

use Illuminate\Support\Facades\Route;

Route::get('/','MoviesController@index')->name('movies.index');
Route::get('/movies/{movie}','MoviesController@show')->name('movies.show');

Route::get('/actors','ActorsController@index')->name('actors.index');
Route::get('/actors/page/{page?}', 'ActorsController@index');
Route::get('/actors/{actors}','ActorsController@show')->name('actors.show');
// Route::view('/', 'index');
// Route::view('/movie', 'show');