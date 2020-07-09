<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('/testendpoint2', function (Request $request) {
	header('Access-Control-Allow-Origin: *');
	header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS, post, get');
	header("Access-Control-Max-Age", "3600");
	header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
	header("Access-Control-Allow-Credentials", "true");
    // return [
    // 	'timeSubcategories' => [
    // 		['id'=>1, 'name'=>'loerore', 'category'=>['name'=>'cate']],
    // 		['id'=>2, 'name'=>'srore', 'category'=>['name'=>'date2']]
    // 	]
    // ];
    return ['id' => 1];
});
