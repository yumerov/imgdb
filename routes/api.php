<?php

Route::group(['namespace' => 'Api'], function() {
    Route::group(['prefix' => 'recent'], function() {
        Route::get('images', "RecentController@images");
        Route::get('tags', "RecentController@tags");
    });
    Route::resource('tags', TagsController::class);
    Route::resource('images', ImagesController::class, [
        'except' => [ 'create', 'edit' ],
    ]);
});

