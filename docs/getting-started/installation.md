# Installation Guide

## Prerequisites

- PHP 8.4.6
- Laravel v11.44.7
- MySQL 8.0.42
- Composer 2.8.8
- Docker & Docker Compose
- Node.js 22.15.0
- NPM 10.9.2

## Quick Start

### 1. Clone the Repository

```bash
git clone https://github.com/josego85/products-covid19py.git
cd products-covid19py
```

### 2. Environment Configuration

```bash
cp .env.example .env
```

Edit `.env` file with your database credentials:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=productospy
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

### 3. Install Dependencies

```bash
# PHP dependencies
composer install

# Frontend dependencies
npm install
```

### 4. Application Setup

```bash
# Generate application key
php artisan key:generate

# Build frontend assets
npm run build
```

### 5. Database Setup

```bash
# Extract database dump
tar -xzvf database/productospy.sql.tar.gz

# Create database
mysql -u root -p
CREATE DATABASE productospy CHARACTER SET utf8 COLLATE utf8_general_ci;
exit

# Import database
mysql -u root -p productospy < database/productospy.sql
```

### 6. Verify Installation

```bash
# Start development server
php artisan serve
```

Visit `http://localhost:8000` to see the application.

## Next Steps

- [Docker Setup](../deployment/docker.md)
- [FrankenPHP Setup](../deployment/frankenphp.md)
- [Development Commands](../development/commands.md)
- [Troubleshooting](../development/troubleshooting.md) - For common issues