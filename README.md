# Code WOW! Starterkit

A **easy-to-use Laravel starterkit** with Filament 5 pre-configured.

> **Requires PHP 8.5+**

---

## Quick Start

```bash
composer create-project codewow/starterkit your-project-name
cd your-project-name
composer install
npm install
npm run build
php artisan serve
```

Serve with **Laravel Herd**: the app is available at `https://your-project-name.test`.

---

## Stack

| Layer | Tech |
|-------|------|
| Framework | Laravel 12.x |
| Admin | FilamentPHP 5.x (SPA mode, custom theme, MFA) |
| Defaults | [nunomaduro/essentials](https://github.com/nunomaduro/laravel-essentials) (strict models, auto-eager loading, immutable dates) |
| Static analysis | Larastan |
| Code style | Laravel Pint |
| Tests | Pest 4.x (incl. browser tests) |
| Refactoring | Rector |

---

## Developer Experience

### One command to rule them all

```bash
composer review   # Pint → Rector → PHPStan → Pest
```

### Quality & testing

- **Pint** – `vendor/bin/pint --dirty --format agent` (or `composer run pint`)
- **Rector** – `vendor/bin/rector --ansi`
- **PHPStan** – `vendor/bin/phpstan analyse`
- **Pest** – `php artisan test --compact`

### CI (GitHub Actions)

- **Tests** – PEST 4.x, 4 parallel shards
- **PHPStan** – static analysis
- **Pint** – style fix + auto-commit

---

## Filament

- SPA mode
- Custom login (with developer login in local)
- Custom theme
- Profile management
- MFA (App Authentication)
- Tables: striped rows, deferred loading

---

## Customizations

### Migration stubs

Custom stubs omit the `down()` method. Remove the custom stubs to restore Laravel’s default migration templates.

### Helpers

Add app-wide helpers in `app/Helpers.php`:

```php
if (! function_exists('example')) {
    function example(): string
    {
        return 'Your helper function here.';
    }
}
```

---

This project is based on [CodeWithDennis/larament](https://github.com/CodeWithDennis/larament).
We have made some changes to the original project to make it more suitable for our needs.
