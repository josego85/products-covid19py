# FrankenPHP Setup Guide

## Overview

FrankenPHP is a modern PHP application server that provides significant performance improvements over traditional nginx + PHP-FPM setups. Combined with Laravel Octane, it offers:

- **2-3x performance improvement**
- **Persistent worker processes**
- **Built-in HTTP/2 and HTTP/3 support**
- **Automatic HTTPS with Let's Encrypt**
- **Zero-configuration setup**

## Architecture

```
┌─────────────────┐    ┌──────────────────┐    ┌──────────────┐
│   Web Request   │───▶│    FrankenPHP    │───▶│   Laravel    │
│                 │    │   (Caddy + Go)   │    │   Octane     │
└─────────────────┘    └──────────────────┘    └──────────────┘
```

## Quick Start

### Development Environment

```bash
# Start FrankenPHP development environment
docker-compose -f docker-compose.frankenphp.yml up --build

# Application available at: http://localhost:8000
```

### Production Environment

```bash
# Start FrankenPHP production environment
docker-compose -f docker-compose.frankenphp.prod.yml up --build

# Application available at: http://localhost:80
```

## Configuration Files

### Development: `docker/frankenphp/Dockerfile.dev`

Features:
- **Xdebug** for debugging
- **Node.js** for asset compilation
- **Single worker** for immediate file change detection
- **Development extensions**

```dockerfile
FROM dunglas/frankenphp:1-php8.4

# Install development extensions including Xdebug
RUN install-php-extensions xdebug

# Single worker for immediate changes
CMD ["php", "artisan", "octane:frankenphp", "--workers=1", "--max-requests=1"]
```

### Production: `docker/frankenphp/Dockerfile.prod`

Features:
- **Optimized for performance**
- **Multiple workers (4)**
- **Laravel caching**
- **Minimal image size**

```dockerfile
FROM dunglas/frankenphp:1-php8.4

# Production optimizations
CMD ["php", "artisan", "octane:frankenphp", "--workers=4"]
```

## Docker Compose Configurations

### Development: `docker-compose.frankenphp.yml`

```yaml
services:
  frankenphp:
    build:
      dockerfile: docker/frankenphp/Dockerfile.dev
    ports:
      - "8000:80"
    volumes:
      - .:/app:cached  # Live code reloading
    environment:
      - APP_ENV=local
      - APP_DEBUG=true
```

### Production: `docker-compose.frankenphp.prod.yml`

```yaml
services:
  frankenphp:
    build:
      dockerfile: docker/frankenphp/Dockerfile.prod
    ports:
      - "80:80"
    environment:
      - APP_ENV=production
      - APP_DEBUG=false
    # No volumes for security
```

## Performance Benefits

| Aspect | Traditional (nginx + PHP-FPM) | FrankenPHP + Octane |
|--------|-------------------------------|-------------------|
| **Throughput** | Baseline | 2-3x improvement |
| **Memory Usage** | Higher overhead | Lower overhead |
| **Cold Start** | Every request | Once per worker |
| **HTTP/2** | Manual config | Built-in |
| **SSL/TLS** | Manual config | Automatic |

Performance improvements depend on your specific application and server configuration. Benchmark your own workload for accurate metrics.

## Laravel Octane Configuration

### Configuration File: `config/octane.php`

```php
return [
    'server' => env('OCTANE_SERVER', 'frankenphp'),

    'listeners' => [
        // Automatic memory management
        // State cleanup between requests
        // Database connection management
    ],

    'warm' => [
        // Services to pre-load in workers
    ],

    'flush' => [
        // Services to reset between requests
    ],
];
```

### Key Features

- **Worker Management**: Handles multiple concurrent requests
- **Memory Management**: Automatic garbage collection
- **State Management**: Proper cleanup between requests
- **Hot Reloading**: File watching in development

## Advanced Usage

### Custom Worker Configuration

```bash
# Development: Single worker for debugging
php artisan octane:frankenphp --workers=1 --max-requests=1

# Production: Multiple workers for performance
php artisan octane:frankenphp --workers=4 --max-requests=1000
```

### Environment Variables

```env
# Octane Configuration
OCTANE_SERVER=frankenphp
OCTANE_HTTPS=false

# FrankenPHP Configuration
CADDY_GLOBAL_OPTIONS="auto_https off"
SERVER_NAME=:80

# Performance Tuning
OCTANE_WORKERS=4
OCTANE_MAX_REQUESTS=1000
```

### Debugging with Xdebug

Development container includes Xdebug extension for debugging support. Configure your IDE to connect on port 9003.

## Monitoring and Logs

### Application Logs

```bash
# View FrankenPHP logs
docker-compose -f docker-compose.frankenphp.yml logs -f frankenphp

# Laravel logs inside container
docker-compose exec frankenphp tail -f storage/logs/laravel.log
```

### Performance Monitoring

```bash
# Worker status
php artisan octane:status

# Memory usage
php artisan octane:reload

# Stop workers gracefully
php artisan octane:stop
```

## Troubleshooting

For FrankenPHP-specific issues and solutions, see the [Troubleshooting Guide](../development/troubleshooting.md#frankenphp-issues).

### Best Practices

1. **Development**: Use single worker for debugging
2. **Production**: Use multiple workers based on CPU cores
3. **Memory**: Monitor and set appropriate `max-requests`
4. **Scaling**: Use load balancer for multiple FrankenPHP instances
5. **Monitoring**: Implement health checks and logging

## Migration from Traditional Setup

### Step-by-Step Migration

1. **Test FrankenPHP** in development:
   ```bash
   docker-compose -f docker-compose.frankenphp.yml up
   ```

2. **Verify functionality** with your application

3. **Performance testing** with realistic load

4. **Deploy to staging** environment

5. **Production deployment** with monitoring

### Rollback Plan

Keep traditional setup files for quick rollback:
```bash
# Rollback to traditional setup
docker-compose -f docker-compose.yml up

# FrankenPHP is additive, no data loss
```

## Support and Resources

- [Official FrankenPHP Documentation](https://frankenphp.dev/)
- [Laravel Octane Documentation](https://laravel.com/docs/octane)
- [Performance Benchmarks](https://frankenphp.dev/docs/benchmark/)
- [GitHub Issues](https://github.com/dunglas/frankenphp/issues)

## Next Steps

- [Development Commands](../development/commands.md)
- [API Documentation](../api/README.md)
- [Traditional Docker Setup](docker.md)