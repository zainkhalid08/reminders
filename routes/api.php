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
    return [
    	'data' => [
    		['id'=>1, 'name'=>'loerore', 'category'=>['name'=>'cate']],
    		['id'=>2, 'name'=>'srore', 'category'=>['name'=>'date2']]
    	]
    ];
});
