#!/bin/sh

cd /var/www

php artisan route:clear
php artisan config:clear
php artisan cache:clear

/usr/bin/supervisord -c /etc/supervisord.conf