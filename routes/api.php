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

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::group(['namespace' => 'frontend'], function() {
    Route::get('/v1/search', 'ApiController@search');
    Route::get('/v1/good/{id}', 'ApiController@show');
    Route::get('/v1/index', 'ApiController@index');
});
