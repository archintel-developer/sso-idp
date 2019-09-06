<?php

$idp_host = env('EM_HOST');

return [

    'app_id' => env('EM_APP_ID'),
    'client_secret'   => env('EM_CLIENT_SECRET'),
    'redirect_uri'  => env('EM_REDIRECT_URI'),

    'routesPrefix'  => 'ssoauth',
    'redirect_if_authenticated' => '/home',
    'redirect_after_logout' => '/register',

    'idp'   => [
        'login_uri' => $idp_host.'/login/v1/autho/authAccount',
        'logout_uri' => $idp_host.'/v1/auth/logout',
    ],

];