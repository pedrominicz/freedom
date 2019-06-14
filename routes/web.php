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

// Home
Route::get('/', 'HomeController@home_get');
Route::redirect('/home', '/');

// View Book
Route::get('/b/{id}', 'BookController@book_get');

// Search Book
Route::get('/s', 'HomeController@search_get');

// Comments
Route::post('/c/{id}', 'CommentController@add_post');
Route::get('/c/{id}', function() { abort(404); });

// Favorites
Route::get('/f', 'FavoriteController@favorite_get');
Route::post('/f/{id}', 'FavoriteController@favorite_post');
Route::redirect('/favorites', '/f');

// About
Route::view('/about', 'about');

// Add Book
Route::get('/a', 'BookController@add_get');
Route::post('/a', 'BookController@add_post');

// Edit Book
Route::get('/e/{id}', 'BookController@edit_get');
Route::get('/e', function() { abort(404); });
Route::post('/e', 'BookController@edit_post');

// Delete Book
Route::get('/d/{id}', 'BookController@delete_get');
Route::get('/d', function() { abort(404); });
Route::post('/d', 'BookController@delete_post');

Auth::routes();
