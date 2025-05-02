# products-covid19py

[![Version](https://img.shields.io/badge/version-1.5.0-blue.svg)](https://github.com/josego85/products-covid19py)
[![License](https://img.shields.io/badge/License-MIT-yellow.svg?style=flat-square)](https://opensource.org/licenses/MIT)
[![PHP](https://img.shields.io/badge/PHP-8.4.6-777BB4?style=flat-square&logo=php)](https://php.net)
[![Laravel](https://img.shields.io/badge/Laravel-v11.44.2-FF2D20?style=flat-square&logo=laravel)](https://laravel.com)
[![MySQL](https://img.shields.io/badge/MySQL-8.0.42-4479A1?style=flat-square&logo=mysql&logoColor=white)](https://www.mysql.com)
[![Docker](https://img.shields.io/badge/Docker-20.10.21-2496ED?style=flat-square&logo=docker&logoColor=white)](https://www.docker.com)
[![API Platform](https://img.shields.io/badge/API%20Platform-4.1.3-38A9B4?style=flat-square&logo=api-platform)](https://api-platform.com)
[![GraphQL](https://img.shields.io/badge/GraphQL-16.8.1-E10098?style=flat-square&logo=graphql)](https://graphql.org)
[![Maintenance](https://img.shields.io/badge/Maintained%3F-yes-green.svg?style=flat-square)](https://github.com/josego85/products-covid19py/graphs/commit-activity)

A web application for browsing products sold to combat COVID-19.

## Contents

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
- [Build and Run](#build-and-run)
- [Access Container](#access-container)
- [View Logs](#view-logs)
- [Development Commands](#development-commands)
- [Application Optimization](#application-optimization)
- [Command Descriptions](#command-descriptions)
- [When to Use](#when-to-use)
- [Additional Configuration](#additional-configuration)
- [Set Permissions](#set-permissions)
- [Developer Tools](#developer-tools)
- [PHPStan](#phpstan)
- [PHP CS Fixer](#php-cs-fixer)
- [API Documentation](#api-documentation)
- [GraphQL and GraphiQL](#graphql-and-graphiql)
- [GraphQL](#graphql)
  - [GraphQL Endpoint](#graphql-endpoint)
  - [Example Query](#example-query)
- [GraphiQL](#graphiql)
  - [Accessing GraphiQL](#accessing-graphiql)
  - [Using GraphiQL](#using-graphiql)
- [Notes](#notes)
- [Contribution Guidelines](#contribution-guidelines)
- [License](#license)

## Overview

This project is built with PHP using the Laravel framework and is designed to display products useful in the fight against COVID-19.

## Features

- Showcase COVID-19 related products
- RESTful API support
- Database integration with MySQL 8.0
- Dockerized development environment
- Code quality tools integration
- High-performance execution with FrankenPHP and Laravel Octane

## Requirements

- PHP 8.4.6
- Laravel v11.44.2
- API Platform v4.1.3
- MySQL 8.0.42
- Composer 2.8.8
- Docker & Docker Compose
- Node.js & npm
- Apache

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

### Build and Run

```bash
docker compose up -d --build
```

### Access Container

```bash
docker exec -it app bash
```

### View Logs

```bash
docker compose logs -f
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

- `optimize`: Clears and rebuilds all caches
- `cache-clear`: Clears all application caches
- `reset`: Complete cache clear and autoloader reload
- `test`: Run PHPUnit test suite
- `test-coverage`: Generate test coverage report
- `check-style`: Verify code formatting
- `fix-style`: Auto-fix code style issues
- `phpstan`: Run static analysis

### When to Use

- Before deployment: `composer optimize`
- During development: `composer cache-clear`
- Before committing: `composer check-style && composer test`
- After pulling changes: `composer reset`

## Additional Configuration

### Set Permissions

```bash
sudo chown -R $USER:www-data storage
sudo chown -R $USER:www-data bootstrap/cache
chmod -R 775 storage
chmod -R 775 bootstrap/cache
```

## Developer Tools

### PHPStan

```bash
composer phpstan
```

### PHP CS Fixer

```bash
vendor/bin/php-cs-fixer check
vendor/bin/php-cs-fixer fix
```

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
  sellers   {
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

- Ensure that the GraphQL endpoint is accessible and properly configured in your environment.
- GraphiQL is intended for development use only and should not be enabled in production environments.

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
