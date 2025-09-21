# Docker Deployment

## Overview

This project supports multiple Docker deployment strategies:

- **Traditional**: Nginx + PHP-FPM (stable)
- **Modern**: FrankenPHP + Octane (high-performance)

## Traditional Docker Setup

### Development Environment

Uses `docker-compose.override.yml` automatically:

```bash
# Build containers
docker compose build --no-cache

# Start containers
docker compose up -d

# Stop containers
docker compose down
```

### Production Environment

Uses only base `docker-compose.yml`:

```bash
# Build for production
docker compose -f docker-compose.yml build --no-cache

# Start production containers
docker compose -f docker-compose.yml up -d

# Stop production containers
docker compose -f docker-compose.yml down
```

## Container Management

### Access Containers

```bash
# PHP container
docker compose exec app bash

# Nginx container
docker compose exec nginx sh

# MySQL container
docker compose exec mysql mysql -u root -p
```

### View Logs

```bash
# All containers
docker compose logs -f

# Specific container
docker compose logs -f app
docker compose logs -f nginx
docker compose logs -f mysql
```

### Health Checks

```bash
# Check container status
docker compose ps

# Check container health
docker compose exec app php artisan --version
```

## Frontend Assets in Docker

### Development

```bash
# Install dependencies
npm install

# Start Vite development server (outside container)
npm run dev

# Or build assets for Docker
npm run build
docker compose restart nginx
```

### Production

```bash
# Build optimized assets
npm run build

# Assets are automatically included in production build
```

## Troubleshooting

For common Docker issues and solutions, see the [Troubleshooting Guide](../development/troubleshooting.md#docker-issues).

## Environment Variables

Key Docker environment variables:

```env
# Database (for Docker)
DB_HOST=mysql
DB_PORT=3306

# Application
APP_ENV=production
APP_DEBUG=false

# Cache drivers
CACHE_DRIVER=file
SESSION_DRIVER=file
```

## Next Steps

- [FrankenPHP Setup](frankenphp.md) - Modern high-performance alternative
- [Development Commands](../development/commands.md)
- [API Documentation](../api/README.md)