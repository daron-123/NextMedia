<?php

Route::group([
    'prefix'    => 'categories',
], function () {


    Route::get('/', [
        'as'   => 'categories.index',
        'uses' => 'CategoryController@index',
    ]);

    Route::get('/list', [
        'as'   => 'categories.list',
        'uses' => 'CategoryController@list',
    ]);
    Route::get('/{id}/edit', [
        'as'   => 'categories.edit',
        'uses' => 'CategoryController@edit',
    ]);
    Route::put('/{id}', [
        'as'   => 'categories.update',
        'uses' => 'CategoryController@update',
    ]);
    Route::get('/{id}', [
        'as'   => 'categories.show',
        'uses' => 'CategoryController@show',
    ]);


    Route::post('/', [
        'as'   => 'categories.store',
        'uses' => 'CategoryController@store',
    ]);

    Route::delete('/', [
        'as'   => 'categories.delete',
        'uses' => 'CategoryController@delete',
    ]);




});
