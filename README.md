# products-covid19py
Sitio para ver productos que se venden para el uso contra el virus COVID19.


Levantar en sitio en cualquier server (Apache, etc.)
[Sitio] (https://productospy.org/)


Tecnologías utilizadas:
- JavaScript (Leaflet, JQuery, Boostrap)
- CSS
- HTML
- Datos OSM (Nominatim como buscador)


Todo list:
- Formulario de carga.
- Versión móvil para Android.


Pasos:
sudo git https://github.com/josego85/api-products-covid19py.git /var/www/html/api-products-covid19py.proyectosbeta.net
sudo chown -R proyectosbeta:www-data api-products-covid19py
cd api-products-covid19py
composer install
composer update
sudo chmod -R 775 storage
sudo chown -R proyectosbeta:www-data storage
sudo chmod -R 775 bootstrap/cache


Base de datos:
mysql -u root -p
CREATE DATABASE products_covid19 CHARACTER SET utf8 COLLATE utf8_general_ci;
exit
mysql -u root -p products_covid19 < ~/products_covid19.sql
mysql -u root -p
GRANT ALL PRIVILEGES ON products_covid19.* TO covid19@'localhost' IDENTIFIED BY 'xxxxxxxxxxxxx';
FLUSH PRIVILEGES;
exit


Routes:
- Method get: http://api-products-covid19py.proyectosbeta.net/api/vendors
- Method post: http://api-products-covid19py.proyectosbeta.net/api/vendor