# Widgets
The Laravel widgets

Dear developers! I created this package for my projects. In order to do manual updates all the time, I decided to upload this package to packagist.
If you have reached this page and you need widgets for a project, then, unfortunately, there is no time for documentation. It may soon appear!

Installation
------------

```bash
composer require keerill/widgets
```
In Laravel 5.5 the service provider will automatically get registered. In older versions of the framework just add the service provider in `config/app.php` file:

```php
'providers' => [
    // ...
    \Keerill\Widgets\Providers\ServiceProvider::class,
];
```

After installing the package, you need to enter a command to create base classes of widgets (Without this, widgets will NOT work)

```bash
php artisan vendor:publish --provider=Keerill\Widgets\Providers\ServiceProvider --tag=widgets-install
```

Config

```bash
php artisan vendor:publish --provider=Keerill\Widgets\Providers\ServiceProvider --tag=widgets-config
```

Views

```bash
php artisan vendor:publish --provider=Keerill\Widgets\Providers\ServiceProvider --tag=widgets-views
```

[Documentation](https://keerill.github.io/widgets/)
----
