#!/bin/bash
set -e

# Fix ownership and permissions for the entire Laravel project
chown -R www-data:www-data /var/www/html

# Create and set proper permissions for Laravel directories
mkdir -p /var/www/html/storage /var/www/html/bootstrap/cache
chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Fix git ownership if .git exists
if [ -d "/var/www/html/.git" ]; then
    chown -R 1000:1000 /var/www/html/.git
fi

# Ensure proper permissions for user files
chown -R 1000:1000 /var/www/html/composer.json /var/www/html/composer.lock 2>/dev/null || true
chown -R 1000:1000 /var/www/html/package*.json 2>/dev/null || true
chown -R 1000:1000 /var/www/html/docker-compose*.yml 2>/dev/null || true
chown -R 1000:1000 /var/www/html/docker/ 2>/dev/null || true
chown -R 1000:1000 /var/www/html/CHANGELOG.md 2>/dev/null || true

exec "$@"
