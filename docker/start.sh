#!/bin/bash

cd /var/www

php artisan config:clear
php artisan migrate --force
php artisan config:cache
php artisan route:cache

php-fpm -D
nginx -g "daemon off;"