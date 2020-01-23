<?php

use App\Post;

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

// Route::get('/play', function(){
// 	$post = Post::first();
// 	echo dd($post->raw_content);
// });

Route::prefix(config('admin.slug'))->middleware('admin')->name('admin.')->group(function () {
	Route::get('/', 'Auth\LoginController@showLoginForm')->name('login.view');
	Route::post('login', 'Auth\LoginController@login')->name('login');
	Route::post('logout', 'Auth\LoginController@logout')->name('logout');

	// Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
	// Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');

	Route::get('dashboard', 'AdminController@dashboard')->name('dashboard');

	Route::get('post/create', 'AdminPostController@create')->name('post.create');
	Route::post('post', 'AdminPostController@store')->name('post.store');

	Route::get('posts', 'AdminPostController@index')->name('post.index');
	
	Route::get('post/{post}/edit', 'AdminPostController@edit')->name('post.edit');
	Route::put('post/{post}', 'AdminPostController@update')->name('post.update');
	Route::put('post/{post}/publish', 'AdminPostPublisherController@publish')->name('post.update.publish');
});

// Route::get('/', 'WelcomeController@welcome')->name('welcome')->middleware('cache.headers:private;max_age=36000'); // [1]
Route::get('/', 'WelcomeController@welcome')->name('welcome');

Route::get('friday-sermons', 'PostController@index')->name('post.index'); 

// title and location are kept optional just so the user can access different posts just by changing the number
Route::get('friday-sermon/{post}/{title?}/{location?}', 'PostController@show')->name('post.show');

Route::get('/feedback', 'FeedbackController@create')->name('feedback');
Route::post('/feedback', 'FeedbackController@store')->name('feedback.store');

// REFERENCES: 
// [1] : caching resource for 2678400s 1 month(31 days) https://developers.google.com/web/tools/lighthouse/audits/cache-policy?utm_source=lighthouse&utm_medium=devtools
