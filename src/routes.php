<?php


Route::group([
    'prefix'    => config('ssoauth.routesPrefix')
], function () {

    Route::get('/redirect', array(
        'uses'  => 'SSOAuth\Http\Controllers\SSOAuthController@redirect',
    ));

});