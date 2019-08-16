# ssoauth-sp
Service provider


## Installation
```
composer require ssoauth/ssoauth-sp
```

in your terminal run this command

```
php artisan vendor:publish
```
and publish the **Provider:** _SSOAuth\SSOAuthServiceProvider_

routes and config are added located in config folder with filename **ssoauth.php**

inside the config file

```php
return [
    'client_id' => env('EM_CLIENT_ID'),
    'api_key'   => env('EM_API_KEY'),
    'redirect_uri'  => env('EM_REDIRECT_URI'),
    'name'  => env('EM_NAME'),

    'routesPrefix'  => 'ssoauth',

    'idp'   => [
        'host'  => 'http://192.168.0.99:8000',
        'login_uri' => 'http://192.168.0.99:8000/login/v1/autho/authAccount',
    ],

    'add_query' => [
        'dosso' => 1,
        'action'  => 'sso',
    ],
];
```

also add in the .env file

```
EM_CLIENT_ID=
EM_API_KEY=
EM_REDIRECT_URI=
```

