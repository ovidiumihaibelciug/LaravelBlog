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

Route::get('/home', 'HomeController@index')->name('home');
//  ------- PAGES -------
Route::get('/', 'PagesController@index');
Route::get('/about', 'PagesController@about');
Route::get('/services', 'PagesController@services');
Route::get('/contact', 'ContactController@contact');
Route::post('/contact', 'ContactController@contactCreate');

//  ------- POSTS --------
Route::post('/posts/{post}/comments', 'CommentController@store');
Route::get('posts/tags/{tag}', 'TagsController@index');
Route::resource('/posts', 'PostsController');

//  ------- USER -------
Auth::routes();


