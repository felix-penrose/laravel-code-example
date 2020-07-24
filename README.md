## Introduction
This is a small example based around a simple application where a user can interact with a frontend Vue based table to generate CSV data. You can add rows & columns and then export the table into a CSV file using a Laravel API end-point. 

## Setup

- `npm install && npm run watch`
- `composer install`
- `cp .env.example .env`
- `php artisan key:generate`
- `php artisan serve --port=8086`
- Visit http://localhost:8086


## Testing

### PHPUnit Testing

- `vendor/bin/phpunit`

### Browser Testing (Laravel Dusk)

- `php artisan dusk`

## Troubleshooting 
If you receive the following error, you must ensure your browser and the driver match.

`session not created: This version of ChromeDriver only supports Chrome version XX`

1. Check your browser version (Help > About Google Chrome). e.g. 85.
2. Then update to the latest driver with `php artisan dusk:chrome-driver`
3. Check this matches the version of your browser
4. If these DON'T match, you can run `php artisan dusk:chrome-driver XX` where `XX` matches the version of your browser
