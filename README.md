# Laravel

## Start project

1. Install [composer](https://getcomposer.org/download/)
2. Run ``php composer.phar install``
3. Create .env file ``cp .env.example .env``
4. Run migrations ``php artisan migrate``
5. Generate key ``php artisan key:generate``
6. Generate jwt token ``php artisan jwt:secret``
7. Run development web server ``php artisan serve``

## Config testing environment

1. Create .env file ``cp .env .env.testing``
2. Change value of DB_DATABASE environment variable
3. Run migrations ``php artisan --env=testing migrate``
4. Run ``./vendor/bin/phpunit``