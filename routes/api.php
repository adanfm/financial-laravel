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
/*
Route::get('/user', function (Request $request) {
    return response()->json([
        'name'  => $request->user()->name
    ]);
})->middleware('auth:api');
*/

Route::group(['middleware' => 'cors', 'as ' => 'api.'], function(){
    Route::post('/access_token', 'Api\AuthController@accessToken')->name('access_token');
    Route::post('/refresh_token', 'Api\AuthController@refreshToken')->name('refresh_token');

    Route::group(['middleware' => 'auth:api'], function() {
        Route::post('/logout', 'Api\AuthController@logout')
            ->middleware('auth:api')
            ->name('logout')
        ;

        Route::get('/user', function (Request $request) {
            $user = $request->user('api');
            return response()->json($user);
        })->name('user');

        Route::resource('/bank_accounts', 'Api\BankAccountsController', ['except' => ['create', 'edit']]);
        Route::resource('/banks', 'Api\BankController', ['only' => ['index', 'show']]);
        Route::resource('/bill_receives', 'Api\BillReceivesController', ['except' => ['create', 'edit']]);
        Route::resource('/bill_pays', 'Api\BillPaysController', ['except' => ['create', 'edit']]);
    });
});