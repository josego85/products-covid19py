# products-covid19py

A web application for browsing products sold to combat COVID-19.

## Table of Contents

- [products-covid19py](#products-covid19py)
  - [Table of Contents](#table-of-contents)
  - [Overview](#overview)
  - [Features](#features)
  - [Requirements](#requirements)
  - [Getting Started](#getting-started)
    - [Clone the Repository](#clone-the-repository)
    - [Configure Environment Variables](#configure-environment-variables)
    - [Install Dependencies](#install-dependencies)
    - [Generate Application Key](#generate-application-key)
    - [Database Setup](#database-setup)
  - [Docker](#docker)
    - [Build and Run the Containers](#build-and-run-the-containers)
    - [Access the Application Container](#access-the-application-container)
    - [View Docker Logs](#view-docker-logs)
  - [Additional Configuration](#additional-configuration)
    - [Set Proper Permissions](#set-proper-permissions)
    - [Laravel Octane with FrankenPHP](#laravel-octane-with-frankenphp)
    - [Standalone FrankenPHP Binaries](#standalone-frankenphp-binaries)
  - [Developer Tools](#developer-tools)
    - [PHPStan (Static Analysis)](#phpstan-static-analysis)
    - [PHP CS Fixer (Code Style)](#php-cs-fixer-code-style)
  - [API Documentation](#api-documentation)
  - [Sonarqube Integration](#sonarqube-integration)
  - [Contribution Guidelines](#contribution-guidelines)
  - [License](#license)
  - [Final Notes](#final-notes)

## Overview

This project is built with PHP using the [Laravel framework](https://laravel.com/docs) and is designed to display products useful in the fight against COVID-19. It supports containerized deployment with Docker and offers various developer tools for quality assurance.

## Features

- Showcase COVID-19 related products
- RESTful API support via Api Platform
- Database integration with MySQL 8.0
- Dockerized development environment
- Code quality tools like PHPStan and PHP CS Fixer
- High-performance execution with FrankenPHP and Laravel Octane

## Requirements

- PHP 8.4.5 or later
- Laravel v11.44.1
- MySQL 8.0
- Composer 2.8.6
- Docker & Docker Compose
- Node.js & npm (for frontend dependencies)

## Getting Started

### Clone the Repository

```bash
git clone https://github.com/josego85/products-covid19py.git
cd products-covid19py
```

### Configure Environment Variables

Copy the example `.env` file and update it as needed:

```bash
cp .env.example .env
```

Edit the `.env` file if necessary. For example:

```env
APP_DEBUG=true

DB_PORT=3306
DB_DATABASE=productospy
DB_USERNAME=productospy
DB_PASSWORD=123456789
DB_ROOT_PASSWORD=123456789
```

### Install Dependencies

Install PHP dependencies using Composer:

```bash
composer install
composer update
```

If using Node.js for frontend tasks, install the Node dependencies:

```bash
npm install
```

### Generate Application Key

Run the following command to generate the application key:

```bash
php artisan key:generate
```

### Database Setup

Set up your MySQL database:

1. Extract the SQL archive:

    ```bash
    tar -xzvf database/productospy.sql.tar.gz
    ```

2. Create the database and import the schema:

    ```bash
    mysql -u root -p
    CREATE DATABASE productospy CHARACTER SET utf8 COLLATE utf8_general_ci;
    exit
    mysql -u root -p productospy < database/productospy.sql
    ```

3. (Optional) Grant privileges if needed:

    ```sql
    mysql -u root -p
    GRANT ALL PRIVILEGES ON productospy.* TO your_user@'localhost' IDENTIFIED BY 'your_password';
    FLUSH PRIVILEGES;
    exit
    ```

4. Run Laravel migrations (if required and using Docker):

    ```bash
    docker exec -it app bash
    php artisan migrate
    ```

## Docker

The project includes Docker configurations to streamline setup and deployment.

### Build and Run the Containers

```bash
docker compose up -d --build
```

### Access the Application Container

To enter the container’s shell:

```bash
docker exec -it app bash
```

Inside the container, you can execute Composer and Artisan commands.

### View Docker Logs

Monitor container logs with:

```bash
docker compose logs -f
```

## Additional Configuration

### Set Proper Permissions

Ensure proper permissions for storage and cache directories:

```bash
sudo chown -R $USER:www-data storage
sudo chown -R $USER:www-data bootstrap/cache
chmod -R 775 storage
chmod -R 775 bootstrap/cache
```

### Laravel Octane with FrankenPHP

For high-performance execution using Laravel Octane and FrankenPHP:

1. Enter the container:

    ```bash
    docker exec -it app bash
    ```

2. Install Laravel Octane:

    ```bash
    composer require laravel/octane
    php artisan octane:install --server=frankenphp
    php artisan octane:frankenphp --port=8089 --host=172.21.0.3
    ```

Access the service via your browser at:

```
http://172.21.0.3:8089/vendors
```

### Standalone FrankenPHP Binaries

Build and run a standalone container:

```bash
docker build -t frankenapp -f Dockerfile-frankenphp .
docker run -d -p 80:80 frankenapp
docker ps
docker logs -f <container_id>
```

Then, access via:

```
http://localhost:8090/vendors
```

## Developer Tools

### PHPStan (Static Analysis)

Check your code with PHPStan:

```bash
composer phpstan
```

### PHP CS Fixer (Code Style)

To check for code style issues:

```bash
vendor/bin/php-cs-fixer check
```

To automatically fix style issues:

```bash
vendor/bin/php-cs-fixer fix
```

## API Documentation

Access the API documentation at:

```
http://localhost:8080/api-docs
```

If there are issues with Swagger UI, try:

```
http://localhost:8080/api/docs
```

## Sonarqube Integration

Run a Sonarqube scan using the following command:

```bash
docker run \
  --rm \
  -e SONAR_HOST_URL="http://172.21.197.47:9999"  \
  -e SONAR_TOKEN="sqp_8382d6f4beb8ced1aa42dc27580a3a0bb66b8879" \
  -v "/home/proyectosbeta/repositoriosGit/products-covid19py:/usr/src" \
  sonarsource/sonar-scanner-cli
```

## Contribution Guidelines

1. Fork the repository.
2. Create a new feature branch:

    ```bash
    git checkout -b new-feature
    ```

3. Commit your changes:

    ```bash
    git commit -am 'Add new feature'
    ```

4. Push your branch:

    ```bash
    git push origin new-feature
    ```

5. Open a pull request.

## License

Specify the license details as applicable.

## Final Notes

Make sure your server has SSL configured and review any additional configurations if required. Enjoy contributing and improving the project!