<?php


Route::get('/login/sso', array(
    'as'    => 'sso.login',
    'uses'  => 'ArchintelDev\Http\Controllers\SSOIDPController@login',
));
Route::get('/logout/sso', array(
    'as'    => 'sso.logout',
    'uses'  => 'ArchintelDev\Http\Controllers\SSOIDPController@logout',
));
Route::get('/login/sso/callback', array(
    'as'    => 'sso.callback',
    'uses'  => 'ArchintelDev\Http\Controllers\SSOIDPController@callback',
));