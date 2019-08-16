<?php


Route::get('/redirect', array(
    'as'    => 'ssoauth.redirect',
    'uses'  => 'SSOAuth\Http\Controllers\SSOAuthController@redirect',
));
Route::get('/callback', array(
    'as'    => 'ssoauth.callback',
    'uses'  => 'SSOAuth\Http\Controllers\SSOAuthController@callback',
));