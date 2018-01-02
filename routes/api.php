<?php

Route::group(['prefix' => 'recent'], function() {
    Route::get('images', "Api\\RecentController@images");
    Route::get('tags', "Api\\RecentController@tags");
});