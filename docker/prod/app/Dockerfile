FROM node:22.15.0-alpine AS node-builder
WORKDIR /app
COPY package*.json ./
RUN npm install
COPY . .
RUN npm run build

FROM php:8.4.6-fpm-bullseye AS builder

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy only files needed for composer
COPY composer.* ./
COPY database/ database/
COPY artisan .

# Install dependencies without running scripts
RUN composer install --no-dev --no-scripts --no-autoloader

# Copy the rest of the application
COPY . .
COPY --from=node-builder /app/public/build ./public/build

# Generate optimized autoloader but skip scripts
RUN composer dump-autoload --optimize --no-scripts

FROM php:8.4.6-fpm-bullseye AS app

# Copy PHP extensions and configurations
COPY --from=builder /usr/local/lib/php/extensions /usr/local/lib/php/extensions
COPY --from=builder /usr/local/etc/php/conf.d /usr/local/etc/php/conf.d

# Set working directory
WORKDIR /var/www/html

# Copy application from builder
COPY --from=builder --chown=www-data:www-data /var/www/html .

USER www-data

EXPOSE 9000

CMD ["php-fpm"]