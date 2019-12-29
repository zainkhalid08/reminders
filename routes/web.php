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


Route::prefix('adminn')->name('admin.')->group(function () {
	Route::get('/', 'Auth\LoginController@showLoginForm')->name('login.view');
	Route::post('login', 'Auth\LoginController@login')->name('login');
	Route::post('logout', 'Auth\LoginController@logout')->name('logout');
	Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
	Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');
	Route::get('dashboard', 'AdminController@dashboard')->name('dashboard');
	Route::get('post/create', 'AdminPostController@create')->name('post.create');
	Route::post('post', 'AdminPostController@store')->name('post.store');
	Route::get('posts', 'AdminPostController@index')->name('post.index');
	Route::get('post/{post}/edit', 'AdminPostController@edit')->name('post.edit');
	Route::put('posts/{post}', 'AdminPostController@update')->name('post.update');
});

Route::get('/', 'WelcomeController@welcome')->name('welcome');

Route::resource('post', 'PostController')->only('index', 'store', 'show');
