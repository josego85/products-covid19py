FROM php:7.4-apache2

RUN docker-php-ext-install pdo pdo_mysql

COPY . /var/www/html

RUN chown -R www-data:www-data /var/www/html \
  && chmod -R 755 /var/www/html/storage

RUN a2enmod rewrite

EXPOSE 80