<?php


Route::get('/redirect', array(
    'as'    => 'ssoidp.redirect',
    'uses'  => 'SSOIDP\Http\Controllers\SSOIDPController@redirect',
));
Route::get('/callback', array(
    'as'    => 'ssoidp.callback',
    'uses'  => 'SSOIDP\Http\Controllers\SSOIDPController@callback',
));