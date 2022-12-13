#!/command/with-contenv sh

cd /var/www

php artisan config:cache
php artisan october:up
