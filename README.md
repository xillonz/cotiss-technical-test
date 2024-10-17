## Technical Test Example

This is a technical test for an example Fish API using PHP and the Laravel framework

## Viewing it

If your environment is setup to run it, you can do so with `php artisan serve` and run tests with `php artisan test`

Otherwise the folders of interest are:

Data: `database/migrations`, `database/factory`

Controller: `app/Http/Controllers/FishesController.php`

Services: `app/Services`

Models: `app/Models`

Tests: `tests`

And then a few other potentially relevant files:
`app/Observers/FishesObserver.php`, `app/Exceptions/ConcurrentEditingException.php`