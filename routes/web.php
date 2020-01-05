<?php

// use App\Surah;

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

Route::get('/play/{post}/{slug}', function($post, $slug){
	echo "it came in $post $slug";
// 	$needle = '</ayah>';

// 	//no tags
// 	// $content = ''; // returns ""
// 	//1 tag present
// 	$content = '<ayah></ayah>'; // returns ""
// 	//1 tag present with content
// 	$content = '<ayah>loremd d d d d  d d (quran)</ayah>'; // returns "loremd d d d d  d d (quran)"
// 	//1 tag present with content and other tags are also present
// 	$content = '<ayah>loremd d d d d  d d (quran)</ayah><p>dont get this</p>'; // returns "loremd d d d d  d d (quran)"
// 	//1 tag present with content and other similar tags are also present
// 	$content = '<ayah>loremd d d d d  d d (quran)</ayah><ayat>dont get this</ayat>'; // returns "loremd d d d d  d d (quran)"
// 	//1 < tags present
// 	$content = '<ayah>loremd d d d d  d d (quran)</ayah><ayah>dont get this</ayah>'; // returns "loremd d d d d  d d (quran)" NOTE THIS, ONLY FIRST OCCURANCE IS CAPTURED

    // $surahs = Surah::all();
    // $i = 1;
    // foreach ($surahs as $surah) {
    // 	echo '["id" => '.$i++.', "name" => "'.$surah->name.'", "english" => "'.$surah->english.'", "ayahs" => "'.$surah->ayahs.'"],'.'<br>';
    // }

});

Route::prefix(config('admin.slug'))->middleware('admin')->name('admin.')->group(function () {
	Route::get('/', 'Auth\LoginController@showLoginForm')->name('login.view');
	Route::post('login', 'Auth\LoginController@login')->name('login');
	Route::post('logout', 'Auth\LoginController@logout')->name('logout');
	Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
	Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');
	Route::get('dashboard', 'AdminController@dashboard')->name('dashboard');
	Route::get('dashboard', 'AdminController@dashboard')->name('dashboard');
	Route::get('post/create', 'AdminPostController@create')->name('post.create');
	Route::post('post', 'AdminPostController@store')->name('post.store');
	Route::get('posts', 'AdminPostController@index')->name('post.index');
	Route::get('post/{post}/edit', 'AdminPostController@edit')->name('post.edit');
	Route::put('post/{post}', 'AdminPostController@update')->name('post.update');
	Route::put('post/{post}/publish', 'AdminPostController@publish')->name('post.update.publish');
});

Route::get('/', 'WelcomeController@welcome')->name('welcome');

Route::get('friday-sermons', 'PostController@index')->name('post.index'); 

// title and location are kept optional just so the user can access different posts just by changing the number
Route::get('friday-sermon/{post}/{title?}/{location?}', 'PostController@show')->name('post.show'); 


