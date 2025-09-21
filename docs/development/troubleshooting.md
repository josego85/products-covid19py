# Troubleshooting Guide

Common issues and their solutions when developing with products-covid19py.

## 🐳 Docker Issues

### Container Won't Start

**Symptoms**: Container fails to start or exits immediately

**Solutions**:
```bash
# Check logs
docker-compose logs app

# Rebuild containers
docker-compose build --no-cache
docker-compose up -d

# Check port conflicts
lsof -i :8080
lsof -i :3306
```

### Database Connection Issues

**Symptoms**: "Connection refused" or "Database not found"

**Solutions**:
```bash
# Check MySQL container
docker-compose logs mysql

# Wait for MySQL to fully start
docker-compose exec mysql mysqladmin ping -h localhost

# Verify environment variables
cat .env | grep DB_
```

### Permission Issues

**Symptoms**: "Permission denied" errors in storage or cache

**Solutions**:
```bash
# Fix Laravel permissions
sudo chown -R $USER:www-data storage bootstrap/cache
chmod -R 775 storage bootstrap/cache

# In Docker
docker-compose exec app chown -R www-data:www-data storage bootstrap/cache
```

## ⚡ FrankenPHP Issues

### Performance Issues

**Symptoms**: Slow response times or memory issues

**Solutions**:
```bash
# Check worker status
php artisan octane:status

# Reload workers
php artisan octane:reload

# Adjust worker count
php artisan octane:frankenphp --workers=4 --max-requests=1000
```

### Workers Not Responding

**Symptoms**: Application hangs or workers become unresponsive

**Solutions**:
```bash
# Restart Octane
php artisan octane:stop
php artisan octane:frankenphp

# Check memory usage
docker stats

# Reduce max requests per worker
php artisan octane:frankenphp --max-requests=500
```

## 🎨 Frontend Issues

### Assets Not Loading

**Symptoms**: CSS/JS files not found or outdated

**Solutions**:
```bash
# Rebuild assets
npm run build

# Clear Laravel caches
php artisan cache:clear
php artisan config:clear
php artisan view:clear

# Restart web server
docker-compose restart nginx
# OR for FrankenPHP
docker-compose restart frankenphp
```

### Vite Development Server Issues

**Symptoms**: Hot reloading not working

**Solutions**:
```bash
# Restart Vite
npm run dev

# Check Vite configuration
cat vite.config.js

# Clear npm cache
npm cache clean --force
```

## 📦 Dependencies Issues

### Composer Issues

**Symptoms**: Package installation failures

**Solutions**:
```bash
# Clear composer cache
composer clear-cache
composer install

# Reset autoloader
composer dump-autoload

# Update dependencies
composer update
```

### NPM Issues

**Symptoms**: Node package installation failures

**Solutions**:
```bash
# Clear npm cache
npm cache clean --force

# Remove and reinstall
rm -rf node_modules package-lock.json
npm install

# Use specific Node version
nvm use 20
npm install
```

## 🗄️ Database Issues

### Migration Failures

**Symptoms**: Migration errors or rollback issues

**Solutions**:
```bash
# Check migration status
php artisan migrate:status

# Reset migrations (WARNING: Data loss)
php artisan migrate:fresh

# Manual rollback
php artisan migrate:rollback --step=1
```

### Seeder Issues

**Symptoms**: Database seeding fails

**Solutions**:
```bash
# Run specific seeder
php artisan db:seed --class=ProductSeeder

# Fresh database with seeds
php artisan migrate:fresh --seed

# Check seeder code for errors
tail -f storage/logs/laravel.log
```

## 🔧 Application Issues

### Cache Problems

**Symptoms**: Changes not reflected or configuration issues

**Solutions**:
```bash
# Nuclear option - clear everything
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan route:clear
composer dump-autoload
```

### Queue Issues

**Symptoms**: Jobs not processing

**Solutions**:
```bash
# Check queue status
php artisan queue:work

# Clear failed jobs
php artisan queue:clear

# Restart queue workers
php artisan queue:restart
```

## 🔍 Debugging

### Enable Debug Mode

```bash
# In .env file
APP_DEBUG=true
APP_LOG_LEVEL=debug

# Clear config cache
php artisan config:clear
```

### View Logs

```bash
# Laravel logs
tail -f storage/logs/laravel.log

# Docker logs
docker-compose logs -f app

# FrankenPHP logs
docker-compose logs -f frankenphp
```

### Xdebug (Development)

For FrankenPHP development container:

```bash
# Verify Xdebug is installed
docker-compose exec frankenphp php -m | grep xdebug

# Configure your IDE to connect to port 9003
```

## 🌍 Environment Issues

### Development vs Production

```bash
# Check current environment
php artisan env

# Development optimizations
composer cache-clear

# Production optimizations
composer optimize
```

### Environment Variables

```bash
# Check loaded environment
php artisan tinker
>>> env('APP_ENV')
>>> config('database.default')

# Verify .env file is loaded
php artisan config:show
```

## 🚨 Emergency Recovery

### Complete Reset

```bash
# Stop all containers
docker-compose down

# Remove volumes (WARNING: Data loss)
docker-compose down -v

# Rebuild everything
docker-compose build --no-cache
docker-compose up -d

# Reinstall dependencies
docker-compose exec app composer install
docker-compose exec app npm install
```

### Backup Before Reset

```bash
# Backup database
docker-compose exec mysql mysqldump -u root -p productospy > backup.sql

# Backup uploads
tar -czf uploads_backup.tar.gz public/uploads
```

## 📊 Performance Debugging

### Slow Queries

```bash
# Enable query logging
DB_LOG_QUERIES=true

# Check slow query log
tail -f storage/logs/laravel.log | grep "slow"
```

### Memory Issues

```bash
# Check memory usage
php artisan tinker
>>> memory_get_usage(true)
>>> memory_get_peak_usage(true)

# Monitor with Docker
docker stats
```

### Profiling

```bash
# Use Laravel Telescope (if installed)
php artisan telescope:install
php artisan migrate

# Access at /telescope
```

## 📞 When to Ask for Help

If you've tried the solutions above and still have issues:

1. **Gather information**:
   - Error messages
   - Log files
   - Environment details
   - Steps to reproduce

2. **Create a GitHub issue** with detailed information

3. **Use GitHub Discussions** for general questions

See [Support Guide](../SUPPORT.md) for more details.