<?php

Auth::routes();

Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
    Auth::routes();

    // Rotas do Admin
    Route::group(['middleware' => 'can:access-admin'], function () {
        Route::get('/home', 'HomeController@index');
    });
});

Route::get('/app', function () {
    return view('layouts.spa');
});