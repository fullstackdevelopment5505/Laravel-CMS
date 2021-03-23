<?php

Route::group(['middleware' => ['web', 'auth']], function(){
    Route::get('textla/addon/review/home',  'Textla\Review\ReviewController@onHome');
    Route::post('textla/addon/review/apply',  'Textla\Review\ReviewController@postReview');
    Route::get('textla/addon/review/status',  'Textla\Review\ReviewController@onStatus');
    Route::get('textla/addon/review',  'Textla\Review\ReviewController@add');
    
});