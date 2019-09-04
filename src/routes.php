<?php


Route::get('/redirect', array(
    'as'    => 'ssoidp.redirect',
    'uses'  => 'ArchintelDev\Http\Controllers\SSOIDPController@redirect',
));
Route::get('/callback', array(
    'as'    => 'ssoidp.callback',
    'uses'  => 'ArchintelDev\Http\Controllers\SSOIDPController@callback',
));