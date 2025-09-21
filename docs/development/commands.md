# Development Commands

## Composer Scripts

### Application Optimization

```bash
# Optimize the application (production ready)
composer optimize

# Clear all caches (development)
composer cache-clear

# Reset the application (clean slate)
composer reset
```

### Testing

```bash
# Run PHPUnit test suite
composer test

# Generate test coverage report
composer test-coverage
```

### Code Quality

```bash
# Check code style compliance
composer check-style

# Auto-fix code style issues
composer fix-style

# Run static analysis with PHPStan
composer phpstan
```

## Command Descriptions

| Command | Purpose | When to Use |
|---------|---------|-------------|
| `optimize` | Clears and rebuilds all caches for production | Before deployment |
| `cache-clear` | Clears all application caches | During development |
| `reset` | Complete cache clear and autoloader reload | After pulling changes |
| `test` | Run complete test suite | Before committing |
| `test-coverage` | Generate detailed coverage report | CI/CD and code review |
| `check-style` | Verify code formatting standards | Before committing |
| `fix-style` | Automatically fix style issues | During development |
| `phpstan` | Static analysis for bugs and issues | Before committing |

## Artisan Commands

### Development

```bash
# Start development server
php artisan serve

# Generate application key
php artisan key:generate

# Clear specific caches
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan route:clear
```

### Database

```bash
# Run migrations
php artisan migrate

# Rollback migrations
php artisan migrate:rollback

# Reset database
php artisan migrate:reset

# Seed database
php artisan db:seed
```

### FrankenPHP + Octane

```bash
# Start FrankenPHP server
php artisan octane:frankenphp

# Start with custom configuration
php artisan octane:frankenphp --workers=4 --max-requests=1000

# Start with file watching (development)
php artisan octane:frankenphp --watch

# Check worker status
php artisan octane:status

# Reload workers
php artisan octane:reload

# Stop Octane server
php artisan octane:stop
```

## Frontend Commands

### NPM Scripts

```bash
# Install dependencies
npm install

# Start Vite development server
npm run dev

# Build for production
npm run build

# Preview production build
npm run preview
```

### Asset Management

```bash
# Watch for changes (alternative to npm run dev)
npx vite

# Build with specific environment
NODE_ENV=production npm run build

# Analyze bundle size
npm run build -- --analyze
```

## Docker Commands

### Container Management

```bash
# Build containers
docker compose build --no-cache

# Start containers
docker compose up -d

# Stop containers
docker compose down

# Restart specific service
docker compose restart app
```

### Access Containers

```bash
# PHP container
docker compose exec app bash

# Run artisan commands in container
docker compose exec app php artisan migrate

# Run composer in container
docker compose exec app composer install
```

## Code Quality Tools

### PHPStan Configuration

```bash
# Run with memory limit
vendor/bin/phpstan analyse --memory-limit=512M

# Generate baseline (ignore existing issues)
vendor/bin/phpstan analyse --generate-baseline

# Custom configuration
vendor/bin/phpstan analyse -c phpstan.custom.neon
```

### PHP CS Fixer

```bash
# Check without fixing
vendor/bin/php-cs-fixer fix --dry-run --diff

# Fix specific directory
vendor/bin/php-cs-fixer fix app/

# Use custom config
vendor/bin/php-cs-fixer fix --config=.php-cs-fixer.custom.php
```

## Best Practices

### Before Committing

```bash
# Complete pre-commit checklist
composer check-style
composer phpstan
composer test
```

### Before Deployment

```bash
# Production optimization
composer optimize
npm run build

# Verify tests pass
composer test

# Static analysis
composer phpstan
```

### After Pulling Changes

```bash
# Update dependencies and clear caches
composer reset
npm install
```

### Development Workflow

```bash
# Daily development routine
composer cache-clear
npm run dev  # In separate terminal
php artisan serve  # Or use FrankenPHP
```

## Troubleshooting Commands

### Permission Issues

```bash
# Fix storage permissions
sudo chown -R $USER:www-data storage bootstrap/cache
chmod -R 775 storage bootstrap/cache
```

### Cache Issues

```bash
# Nuclear option - clear everything
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan route:clear
composer dump-autoload
```

### Database Issues

```bash
# Check database connection
php artisan migrate:status

# Fresh database
php artisan migrate:fresh --seed
```

### Asset Issues

```bash
# Clear Node modules and reinstall
rm -rf node_modules package-lock.json
npm install
npm run build
```

## Custom Scripts

You can add custom scripts to `composer.json`:

```json
{
    "scripts": {
        "fresh": [
            "@php artisan migrate:fresh --seed",
            "@php artisan cache:clear"
        ],
        "deploy": [
            "composer install --no-dev --optimize-autoloader",
            "@php artisan config:cache",
            "@php artisan route:cache",
            "@php artisan view:cache"
        ]
    }
}
```

## Environment-Specific Commands

### Development

```bash
# Start with debugging
APP_DEBUG=true php artisan serve

# Enable query logging
DB_LOG_QUERIES=true php artisan tinker
```

### Staging

```bash
# Staging optimizations
composer install --no-dev
php artisan config:cache
```

### Production

```bash
# Production deployment
composer install --no-dev --optimize-autoloader
php artisan optimize
```