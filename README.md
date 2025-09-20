# products-covid19py

[![Version](https://img.shields.io/badge/version-1.6.1-blue.svg)](https://github.com/josego85/products-covid19py)
[![License](https://img.shields.io/badge/License-MIT-yellow.svg?style=flat-square)](https://opensource.org/licenses/MIT)
[![PHP](https://img.shields.io/badge/PHP-8.4.6-777BB4?style=flat-square&logo=php)](https://php.net)
[![Laravel](https://img.shields.io/badge/Laravel-v11.44.7-FF2D20?style=flat-square&logo=laravel)](https://laravel.com)
[![API Platform](https://img.shields.io/badge/API%20Platform-4.1.7-38A9B4?style=flat-square&logo=api-platform)](https://api-platform.com)
[![MySQL](https://img.shields.io/badge/MySQL-8.0.42-4479A1?style=flat-square&logo=mysql&logoColor=white)](https://www.mysql.com)
[![GraphQL](https://img.shields.io/badge/GraphQL-16.8.1-E10098?style=flat-square&logo=graphql)](https://graphql.org)
[![Docker](https://img.shields.io/badge/Docker-20.10.21-2496ED?style=flat-square&logo=docker&logoColor=white)](https://www.docker.com)
[![Nginx](https://img.shields.io/badge/Nginx-1.28-009639?style=flat-square&logo=nginx&logoColor=white)](https://nginx.org)
[![Node](https://img.shields.io/badge/Node-22.15.0-339933?style=flat-square&logo=node.js&logoColor=white)](https://nodejs.org)
[![npm](https://img.shields.io/badge/npm-10.9.2-CB3837?style=flat-square&logo=npm)](https://www.npmjs.com)
[![Vite](https://img.shields.io/badge/Vite-6.3.4-646CFF?style=flat-square&logo=vite)](https://vitejs.dev)
[![Maintenance](https://img.shields.io/badge/Maintained%3F-yes-green.svg?style=flat-square)](https://github.com/josego85/products-covid19py/graphs/commit-activity)

A web application for browsing products sold to combat COVID-19.

## Contents

-   [Overview](#overview)
-   [Features](#features)
-   [Requirements](#requirements)
-   [Getting Started](#getting-started)
-   [Docker](#docker)
-   [Development Commands](#development-commands)
-   [Developer Tools](#developer-tools)
-   [API Documentation](#api-documentation)
-   [GraphQL and GraphiQL](#graphql-and-graphiql)
-   [Contribution Guidelines](#contribution-guidelines)
-   [License](#license)

## Overview

This project is built with PHP using the Laravel framework and is designed to display products useful in the fight against COVID-19.

## Features

-   Showcase COVID-19 related products
-   RESTful API support
-   Database integration with MySQL 8.0
-   Dockerized development environment
-   Code quality tools integration
-   High-performance execution with FrankenPHP and Laravel Octane

## Requirements

-   PHP 8.4.6
-   Laravel v11.44.7
-   API Platform v4.1.7
-   MySQL 8.0.42
-   Composer 2.8.8
-   Docker & Docker Compose
-   Node.js 22.15.0
-   NPM 10.9.2
-   Vite 6.3.4
-   Nginx 1.28

## Getting Started

### Clone the Repository

```bash
git clone https://github.com/josego85/products-covid19py.git
cd products-covid19py
```

### Configure Environment Variables

```bash
cp .env.example .env
```

### Install Dependencies

```bash
composer install
npm install
```

### Generate Application Key

```bash
php artisan key:generate
```

### Database Setup

```bash
tar -xzvf database/productospy.sql.tar.gz
mysql -u root -p
CREATE DATABASE productospy CHARACTER SET utf8 COLLATE utf8_general_ci;
exit
mysql -u root -p productospy < database/productospy.sql
```

## Docker

### Development Environment

The development environment uses `docker-compose.override.yml` automatically with the base configuration.

```bash
# Build containers (with no cache)
docker compose build --no-cache

# Build specific container
docker compose build nginx

# Start containers
docker compose up -d

# Stop containers
docker compose down
```

### Production Environment

Production uses only the base `docker-compose.yml` configuration.

```bash
# Build containers (with no cache)
docker compose -f docker-compose.yml build --no-cache

# Start containers
docker compose -f docker-compose.yml up -d

# Stop containers
docker compose -f docker-compose.yml down
```

### Container Management

```bash
# Access PHP container
docker compose exec app bash

# Access Nginx container
docker compose exec nginx sh

# View logs
docker compose logs -f

# View logs for specific container
docker compose logs -f app
```

### Frontend Development

```bash
# Install dependencies
npm install

# Start Vite development server
npm run dev

# Build for production
npm run build
```

### Common Issues

If you encounter permission issues:

```bash
sudo chown -R $USER:www-data storage bootstrap/cache
chmod -R 775 storage bootstrap/cache
```

If assets are not loading:

```bash
npm run build
docker compose restart nginx
```

## Development Commands

### Application Optimization

```bash
# Optimize the application
composer optimize

# Clear all caches
composer cache-clear

# Reset the application
composer reset

# Run tests
composer test

# Check code style
composer check-style

# Fix code style
composer fix-style

# Run static analysis
composer phpstan
```

### Command Descriptions

-   `optimize`: Clears and rebuilds all caches
-   `cache-clear`: Clears all application caches
-   `reset`: Complete cache clear and autoloader reload
-   `test`: Run PHPUnit test suite
-   `test-coverage`: Generate test coverage report
-   `check-style`: Verify code formatting
-   `fix-style`: Auto-fix code style issues
-   `phpstan`: Run static analysis

### When to Use

-   Before deployment: `composer optimize`
-   During development: `composer cache-clear`
-   Before committing: `composer check-style && composer test`
-   After pulling changes: `composer reset`

## Developer Tools

### PHPStan

```bash
composer phpstan
```

### PHP CS Fixer

```bash
PHP_CS_FIXER_IGNORE_ENV=1 vendor/bin/php-cs-fixer check
PHP_CS_FIXER_IGNORE_ENV=1 vendor/bin/php-cs-fixer fix -vv
PHP_CS_FIXER_IGNORE_ENV=1 vendor/bin/php-cs-fixer fix
```

### SonarQube Analysis

Access SonarQube dashboard at: [http://localhost:9000](http://localhost:9000)

Default credentials:

-   **Username:** `admin`
-   **Password:** `admin`

For detailed SonarQube setup and usage, see our [SonarQube Documentation](docs/development/sonarqube.md).

## API Documentation

Access the API documentation at:

```
http://localhost:8080/api-docs
```

## GraphQL and GraphiQL

### GraphQL

This project includes support for GraphQL, allowing you to query and manipulate data using a flexible and efficient API.

#### GraphQL Endpoint

The GraphQL endpoint is available at:

```
http://localhost:8080/graphql
```

You can send queries and mutations to this endpoint using tools like Postman, Insomnia, or any GraphQL client.

#### Example Query

Here is an example of a query to fetch sellers:

```graphql
{
    sellers {
        id
        longitude
        latitude
        comment
        user {
            full_name
            email
            phone_number
        }
        products(type: "papel") {
            name
        }
    }
}
```

### GraphiQL

GraphiQL is a graphical interface for testing and exploring GraphQL APIs. It is enabled in this project for development purposes.

#### Accessing GraphiQL

You can access the GraphiQL interface at:

```
http://localhost:8080/graphiql
```

#### Using GraphiQL

1. Open the URL in your browser.
2. Write your GraphQL queries or mutations in the editor.
3. Click the "Execute" button (▶️) to run the query and view the results.

### Notes

-   Ensure that the GraphQL endpoint is accessible and properly configured in your environment.
-   GraphiQL is intended for development use only and should not be enabled in production environments.

For more information about GraphQL, visit the [official documentation](https://graphql.org/).

## Contribution Guidelines

1. Fork the repository
2. Create feature branch
3. Commit changes
4. Push branch
5. Create Pull Request

## License

MIT License

---

For more information, please contact the development team.
