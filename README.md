# products-covid19py
Sitio para ver productos que se venden para el uso contra el virus COVID19.


Levantar en sitio en cualquier server (Apache, etc.)

[Ir a productospy.org](https://productospy.org/)


## Logros

- Formamos parte de la plataforma [Wendá](https://wenda.org.py/)


## Tecnologías utilizadas (Toolkit)

- HTML
- CSS
- JavaScript (Leaflet, JQuery, Boostrap)
- PHP 8.3.13
- [Laravel 11.30](https://laravel.com/docs)
- [Composer 2.8.2](https://getcomposer.org/download/)
- MySQL 5.7
- Datos OSM (Nominatim como buscador)
- Docker version 27.3.1, build ce12230
- Docker Compose version v2.30.3

## Docker

```bash
docker compose up -d --build
docker exec -it app bash
composer install
exit
```

### Logs

```bash
docker compose logs -f
```

## Pasos

```bash
git clone https://github.com/josego85/products-covid19py.git
sudo chown -R $USER:www-data ./products-covid19py
cd products-covid19py
composer install 
composer update
cp .env.example .env
php artisan key:generate
php artisan serve 
```


## Base de datos

```bash
tar -xzvf database/productospy.sql.tar.gz
mysql -u root -p
CREATE DATABASE productospy CHARACTER SET utf8 COLLATE utf8_general_ci;
exit
mysql -u root -p productospy < database/productospy.sql
mysql -u root -p
GRANT ALL PRIVILEGES ON productospy.* TO your_user@'localhost' IDENTIFIED BY 'xxxxxxxxxxxxx';
FLUSH PRIVILEGES;
exit
```

## Permisos

```bash
sudo chown -R $USER:www-data storage
sudo chown -R $USER:www-data bootstrap/cache
chmod -R 775 storage
chmod -R 775 bootstrap/cache
```

## Sonarqube

You need to have a Sonarqube server running in order to run the sonar scanner cli

```bash
docker run \
   --rm \
   -e SONAR_HOST_URL="http://172.21.197.47:9999"  \
   -e SONAR_TOKEN="sqp_8382d6f4beb8ced1aa42dc27580a3a0bb66b8879" \
   -v "/home/proyectosbeta/repositoriosGit/products-covid19py:/usr/src" \
   sonarsource/sonar-scanner-cli
```

## Observaciones:

- El sitio debe de tener un certificado SSL para que funcione la geolocalización.
- Se recomienda usar un servicio web como Apache.


## Contribuir

- Crear fork.
- Crear un feature branch: git checkout -b nueva-feature
- Comitear tus cambios: git commit -am 'Añadir alguna feature'
- Push el branch: git push origin nueva-feature
- Enviar un pull request.