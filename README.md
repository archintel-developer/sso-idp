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
and publish the **Provider:** _ArchintelDev\SSOIDPServiceProvider_

or you can use this command

```
php artisan vendor:publish --provider="ArchintelDev\SSOIDPServiceProvider"
```

routes and config are added 
config file is located in config folder with filename **ssoidp.php**


also add in the .env file


```
EM_HOST=
EM_APP_ID=
EM_CLIENT_SECRET=
EM_REDIRECT_URI=
```

**Using logout:**
copy this in blade
```
<a href="/logout/sso" >Logout</a>
```
or
```
<a href="{{ route('sso.logout') }}" >Logout</a>
```
