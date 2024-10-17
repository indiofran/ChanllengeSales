#!/bin/bash

composer install --no-ansi --no-interaction --no-plugins --no-progress --no-scripts --optimize-autoloader
php artisan cache:clear
php artisan config:clear
php artisan config:cache

#Artisan commands
php artisan migrate --force

php artisan db:seed --force

php artisan l5-swagger:generate

# Start the web server
php-fpm
