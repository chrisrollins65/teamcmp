## TeamCMP Tech challenge

### To run:
With docker, you can set up and run the app with:

    docker-compose up

The initial installation will take several minutes. When finished you should be able to access the application at http://localhost:8080

**Alternative:** To use the application without Docker, you can run it on a server with PHP 7.4, composer and npm, run the following commands:

    composer install
    php artisan migrate && php artisan db:seed
    npm install && npm run dev
    php artisan serve

This should bring up the application on http://localhost:8000

### To run tests:

With docker:
- Backend tests: `docker-compose exec laravel php vendor/phpunit/phpunit/phpunit`
- Frontend tests: `docker-compose exec laravel npm run test`

Without docker:
- Backend tests: `php vendor/phpunit/phpunit/phpunit`
- Frontend tests: `npm run test`

### Where to find my code

The bulk of my code can be found in these directories and files:

- app/Domain
- app/Http/Controllers/ApiController.php
- app/Infrastructure
- app/Repositories
- resources/js
- tests/Unit
- routes/api.php
