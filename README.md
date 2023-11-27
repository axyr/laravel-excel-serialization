# Demo setup to reproduce serialization error

## Steps to reproduce

- Install laravel
- Create a database, set database config and migrate `php artisan queue:table && php artisan migrate`
- Set queue connection to database `QUEUE_CONNECTION=database`
- Install Laravel Excel `composer require maatwebsite/excel:^3.1`
- Publish Laravel Excel config: `php artisan vendor:publish --provider="Maatwebsite\Excel\ExcelServiceProvider" --tag=config`
- Set Excel cache.driver to batch in config/excel.php ` 'driver' => 'batch',`
- Run `php artisan workbook:export && php artisan queue:work --stop-when-empty`

This will result in a an error "Spreadsheet objects cannot be serialized"

Which is documented here that "Spreadsheets should not be serialized":

https://github.com/PHPOffice/PhpSpreadsheet/issues/3291
