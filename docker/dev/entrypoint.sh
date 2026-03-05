#!/bin/bash
set -e

# Create Laravel writable directories and give www-data access only where needed
mkdir -p /var/www/html/storage/app/public \
         /var/www/html/storage/framework/cache \
         /var/www/html/storage/framework/sessions \
         /var/www/html/storage/framework/views \
         /var/www/html/storage/logs \
         /var/www/html/bootstrap/cache

chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Install PHP dependencies if vendor is missing
if [ ! -d "/var/www/html/vendor" ]; then
    echo "vendor/ not found, running composer install..."
    su -s /bin/sh www-data -c "composer install --no-interaction --optimize-autoloader --no-scripts"
fi

# Install JS dependencies if node_modules is missing and npm is available
if [ ! -d "/var/www/html/node_modules" ] && command -v npm > /dev/null 2>&1; then
    echo "node_modules/ not found, running npm install..."
    su -s /bin/sh www-data -c "npm install"
fi

exec "$@"
