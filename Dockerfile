FROM php:8.4.1-apache-bullseye

RUN apt-get update && apt-get install -y libzip-dev zip unzip \
  && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN docker-php-ext-install zip pdo pdo_mysql
RUN docker-php-ext-install pcntl

# RUN pecl install -o -f xdebug \
#   && docker-php-ext-enable xdebug

# COPY ./deploy/config/php.ini /usr/local/etc/php/

COPY . /var/www/html

RUN sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf

RUN chown -R www-data:www-data /var/www/html \
  && chmod -R 755 /var/www/html \
  && chmod -R 775 /var/www/html/storage \
  && chmod -R 775 /var/www/html/bootstrap/cache

RUN cd /var/www/html && if [ ! -f .env ]; then cp .env.example .env; fi && php artisan key:generate

COPY ./entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

RUN a2enmod rewrite

EXPOSE 80

ENTRYPOINT ["entrypoint.sh"]