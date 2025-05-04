FROM php:8.4.6-fpm-bullseye

RUN apt-get update \
  && apt-get install -y --no-install-recommends \
     libzip-dev zip unzip git libicu-dev libonig-dev \
  && docker-php-ext-install zip pdo pdo_mysql pcntl intl \
  && rm -rf /var/lib/apt/lists/*

RUN curl -sS https://getcomposer.org/installer | php \
  -- --install-dir=/usr/local/bin --filename=composer

RUN pecl install xdebug \
  && docker-php-ext-enable xdebug

COPY ./docker/dev/php/php.ini /usr/local/etc/php/

WORKDIR /var/www/html

COPY docker/dev/entrypoint.sh /usr/local/bin/entrypoint.sh

RUN chmod +x /usr/local/bin/entrypoint.sh

EXPOSE 9000

CMD ["php-fpm"]
