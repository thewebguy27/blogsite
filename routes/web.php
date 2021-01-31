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

Route::get('/','WelcomeController@index')->name('welcome');
Route::get('blog/posts/{post}','Blog\Postcontroller@show')->name('blog.show');
Route::get('blog/categories/{category}','Blog\Postcontroller@category')->name('blog.category');
Route::get('blog/tags/{tag}','Blog\Postcontroller@tag')->name('blog.tag');
Auth::routes();
Route::middleware(['auth'])->group(function(){
    Route::get('/home', 'HomeController@index')->name('home');
    Route::resource('categories','CategoriesController');
    Route::resource('posts','PostController');
    Route::resource('tags','TagsController');
    Route::get('trashed-posts','PostController@trashed')->name('trahsedpost.index');
    Route::put('restore-posts/{post}','PostController@restore')->name('restore-posts'); //put is for security
});
Route::middleware(['auth','VerifyAdmin'])->group(function(){
    Route::get('users','UsersController@index')->name('users.index');
    Route::get('users/profile','UsersController@edit')->name('users.edit-profile');
    Route::post('users/{user}/makeadmin','UsersController@makeadmin')->name('users.makeadmin');
    Route::put('users/profile','UsersController@update')->name('users.update-profile');
});

