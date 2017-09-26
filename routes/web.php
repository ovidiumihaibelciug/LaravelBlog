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

//See alt the posts with the tag in url
Route::get('/posts/tags/{tag}', 'TagsController@index');
// TAG CRUD
Route::get('/tags', 'TagsController@create');
Route::post('/tags', 'TagsController@store');
Route::get('/tag/{name}', 'TagsController@show');
Route::get('/tag/{id}/edit', 'TagsController@edit');
Route::put('/tag/{id}', 'TagsController@update');
Route::delete('/tag/{id}/delete', 'TagsController@destroy');


Route::resource('/posts', 'PostsController');
Route::get('blog/{slug}', 'PostsController@blogshow');

//  ------- USER -------
Auth::routes();


