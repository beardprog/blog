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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('/posts', 'PostController');
Route::group(['prefix'=>'comments'], function(){
    Route::get('{comment}/like','CommentController@like');
    Route::get('{comment}/unlike','CommentController@unlike');
    Route::post('{post}','CommentController@store');
    Route::get('{post}/parent/{comment}','CommentController@create');
});


Route::get('/category/{category}', 'CategoryController@index');

Route::get('comments/{post}/parent/{comment}', 'CommentController@create');
Route::get('/user/favorites','UserController@favorites')->middleware('auth')->name('users.favorites');

//Route::get('/posts', 'PostController@index')->name('post.index');;
//Route::get('/posts/create', 'PostController@create')->name('posts.create');
//Route::get('/posts/{post}', 'PostController@Show')->name('post.show');
//Route::post('/posts', 'PostController@store')->name('posts.store');
//Route::get('/posts/{post}/edit', 'PostController@edit')->name('posts.edit');
//Route::put('/posts/{post}', 'PostController@update')->name('posts.update');
//Route::delete('/posts/{post}', 'PostController@destroy')->name('posts.destroy');

Route::get('users/posts','UserController@posts')->middleware('auth');

