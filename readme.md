# TeamSpeak3 Panel
Based on [Laravel 5.3](http://laravel.com/docs/master).

## Features

* Full user authentication
* Roles and Permissions system
* TeamSpeak3 server live information
* TeamSpeak3 server administration
* TeamSpeak3 channel management (for both Admins and ChannelAdmins)

## Installation

Copy `.env.example` to `.env` and set up database.

```
composer install
php artisan key:generate
php artisan migrate
php artisan db:seed
composer dump-autoload
```

## License

The Laravel framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).
