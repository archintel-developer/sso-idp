# sso-idp
Service provider


## Installation
```
composer require archintel-dev/sso-idp
```

in your terminal run this command

```
php artisan vendor:publish
```
and publish the **Provider:** _SSOIDP\SSOIDPServiceProvider_

routes and config are added 
config file is located in config folder with filename **ssoidp.php**


also add in the .env file

```
EM_CLIENT_ID=
EM_API_KEY=
EM_REDIRECT_URI=
```

