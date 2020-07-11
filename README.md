# products-covid19py
Sitio para ver productos que se venden para el uso contra el virus COVID19.


Levantar en sitio en cualquier server (Apache, etc.)

[Ir a productospy.org](https://productospy.org/)


## Tecnologías utilizadas (Toolkit)

- JavaScript (Leaflet, JQuery, Boostrap)
- CSS
- HTML
- [PHP 7.4 (Laravel 7)](https://laravel.com/docs)
- [Composer](https://getcomposer.org/download/)
- Datos OSM (Nominatim como buscador)


## Pasos

```sh
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

```sh
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

```sh
	sudo chown -R $USER:www-data storage
	sudo chown -R $USER:www-data bootstrap/cache
	chmod -R 775 storage
	chmod -R 775 bootstrap/cache
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


## Todo list (master)
* Mejoras en la lista de vendedores sin ubicación.
* Mejora en la GUI.
* Implementar autenticación de dos factores (A2F) para los usuarios Admin (obligatorio).
* Multi lenguaje (español, ingles)


## Todo list (branch login)
* En el registro que se verifique que el password sea strong.
* El dashboard que sea en español (primera version).
* Probar que funcione en el login el recordar password.
* Hacer test unitarios.
* Traducir al español las vistas roles:
  * Crear
  * Listar
* Implementar responsive en las vistas de los roles.
* Buscador en el listado de usuarios.
* Agregar módulo Productos