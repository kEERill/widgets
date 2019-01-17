# Documentation

- [Commands](https://keerill.github.io/widgets/commands)

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
