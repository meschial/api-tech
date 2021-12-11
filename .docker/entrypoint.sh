#!/bin/bash

npm config set cache /var/www/.npm-cache --global
cd /var/www/frontend && npm install && npm run build-spa && cd ..

cd backend
chown -R tech:tech .
composer install
php artisan key:generate
php artisan migrate

php-fpm
