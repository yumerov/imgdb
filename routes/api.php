<?php

Route::group(['namespace' => 'Api'], function() {
    Route::group(['prefix' => 'recent'], function() {
        Route::get('images', "RecentController@images");
        Route::get('tags', "RecentController@tags");
    });
    Route::resource('images', ImagesController::class);
});

