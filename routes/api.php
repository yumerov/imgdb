<?php

Route::group(['namespace' => 'Api'], function() {
    $except = [
        'except' => [ 'create', 'edit' ],
    ];
    Route::resource('tags', TagsController::class, $except);
    Route::resource('images', ImagesController::class, $except);
    Route::get('search/tags', "SearchController@tags");
    Route::get('search/images', "SearchController@images");
});

