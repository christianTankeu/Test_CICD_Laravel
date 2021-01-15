#!/bin/sh

# update application cache
php artisan optimize

# Apply migrate
php artisan migrate

# Apply encryption keys

php artisan passport:keys

# start the application

php-fpm -D &&  nginx -g "daemon off;"
