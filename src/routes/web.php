<?php

Route::group(['namespace' => 'Xyrotech\Stratus\Http\Controllers'],function(){
    Route::get('stratus', 'SetupController@index');
});


