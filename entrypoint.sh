#!/bin/bash

if [ ! -f /var/www/html/.env ]; then
    echo "Creating .env file from .env.example..."
    cp /var/www/html/.env.example /var/www/html/.env
fi

if ! grep -q "APP_KEY=base64" /var/www/html/.env; then
    echo "Generating application key..."
    php artisan key:generate
fi

apache2-foreground

