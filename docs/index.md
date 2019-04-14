# Documentation

- [Commands](https://keerill.github.io/widgets/commands)
- [Widget](https://keerill.github.io/widgets/widget)

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

After installing the package, you need to enter a command to create base classes of widgets (Without this, widgets will NOT work) [Version >= 1.2]

```bash
php artisan vendor:publish --provider=Keerill\Widgets\Providers\ServiceProvider --tag=widgets-install
```

Config [Version any]

```bash
php artisan vendor:publish --provider=Keerill\Widgets\Providers\ServiceProvider --tag=widgets-config
```

Views [Version any]

```bash
php artisan vendor:publish --provider=Keerill\Widgets\Providers\ServiceProvider --tag=widgets-views
```
