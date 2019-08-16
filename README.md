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


also add in the .env file

```
EM_CLIENT_ID=
EM_API_KEY=
EM_REDIRECT_URI=
```

