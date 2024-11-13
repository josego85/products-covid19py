FROM php:8.3.13-apache-bullseye

RUN docker-php-ext-install pdo pdo_mysql

RUN apt-get update && apt-get install -y zip unzip \
  && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

COPY . /var/www/html

RUN sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf

RUN chown -R www-data:www-data /var/www/html \
  && chmod -R 755 /var/www/html \
  && chmod -R 775 /var/www/html/storage \
  && chmod -R 775 /var/www/html/bootstrap/cache

RUN a2enmod rewrite

EXPOSE 80