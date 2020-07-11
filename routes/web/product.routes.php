<?php

Route::group([
    'prefix'    => 'products',
], function () {


    Route::get('/', [
        'as'   => 'products.index',
        'uses' => 'ProductController@index',
    ]);

    Route::get('/{id}', [
        'as'   => 'products.show',
        'uses' => 'ProductController@show',
    ]);
    Route::get('/{id}/edit', [
        'as'   => 'products.edit',
        'uses' => 'ProductController@edit',
    ]);
    Route::put('/{id}', [
        'as'   => 'products.update',
        'uses' => 'ProductController@update',
    ]);
    Route::post('/', [
        'as'   => 'products.store',
        'uses' => 'ProductController@store',
    ]);

    Route::delete('/', [
        'as'   => 'products.delete',
        'uses' => 'ProductController@delete',
    ]);




});
