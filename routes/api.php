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

Route::get('/user', function (Request $request) {
    return response()->json([
        'name'  => $request->user()->name
    ]);
})->middleware('auth:api');


Route::post('/access_token', 'Api\AuthController@accessToken');
Route::post('/logout', 'Api\AuthController@logout')->middleware('auth:api');
Route::post('/refresh_token', 'Api\AuthController@refreshToken');
