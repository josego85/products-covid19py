# products-covid19py
Sitio para ver productos que se venden para el uso contra el virus COVID19.


Levantar en sitio en cualquier server (Apache, etc.)
[Sitio] (https://productospy.org/)


Tecnologías utilizadas:
- JavaScript (Leaflet, JQuery, Boostrap)
- CSS
- HTML
- PHP 7.4 (Laravel 6)
- Datos OSM (Nominatim como buscador)


Todo list:
- Mejoras en la lista de vendedores sin ubicación.


Pasos:

```
sudo git https://github.com/josego85/api-products-covid19py.git /var/www/html/products-covid19py
sudo chown -R proyectosbeta:www-data products-covid19py
cd products-covid19py
composer install
composer update
sudo chown www-data:www-data storage -R
```


Base de datos:

```
mysql -u root -p
CREATE DATABASE products_covid19 CHARACTER SET utf8 COLLATE utf8_general_ci;
exit
mysql -u root -p products_covid19 < ~/products_covid19.sql
mysql -u root -p
GRANT ALL PRIVILEGES ON products_covid19.* TO covid19@'localhost' IDENTIFIED BY 'xxxxxxxxxxxxx';
FLUSH PRIVILEGES;
exit
```
