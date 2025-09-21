# products-covid19py

[![Version](https://img.shields.io/badge/version-1.7.0-blue.svg)](https://github.com/josego85/products-covid19py)
[![PHP](https://img.shields.io/badge/PHP-8.4.6-777BB4?style=flat-square&logo=php)](https://php.net)
[![Laravel](https://img.shields.io/badge/Laravel-v11.44.7-FF2D20?style=flat-square&logo=laravel)](https://laravel.com)
[![API Platform](https://img.shields.io/badge/API%20Platform-4.1.7-38A9B4?style=flat-square&logo=api-platform)](https://api-platform.com)
[![GraphQL](https://img.shields.io/badge/GraphQL-16.8.1-E10098?style=flat-square&logo=graphql)](https://graphql.org)
[![FrankenPHP](https://img.shields.io/badge/FrankenPHP-1.0-00ADD8?style=flat-square&logo=go)](https://frankenphp.dev)
[![Nginx](https://img.shields.io/badge/Nginx-1.28-009639?style=flat-square&logo=nginx&logoColor=white)](https://nginx.org)
[![Docker](https://img.shields.io/badge/Docker-20.10.21-2496ED?style=flat-square&logo=docker&logoColor=white)](https://www.docker.com)
[![Maintenance](https://img.shields.io/badge/Maintained%3F-yes-green.svg?style=flat-square)](https://github.com/josego85/products-covid19py/graphs/commit-activity)
[![License](https://img.shields.io/badge/License-MIT-yellow.svg?style=flat-square)](https://opensource.org/licenses/MIT)

A modern, high-performance web application for browsing products sold to combat COVID-19. Built with Laravel and powered by FrankenPHP for optimal performance.

## 🚀 Quick Start

```bash
# Clone and setup
git clone https://github.com/josego85/products-covid19py.git
cd products-covid19py

# FrankenPHP (Recommended - High Performance)
docker-compose -f docker-compose.frankenphp.yml up --build

# Traditional setup
docker-compose up --build
```

## 📚 Documentation

### Getting Started
- **[Installation Guide](docs/getting-started/installation.md)** - Complete setup instructions
- **[Requirements & Dependencies](docs/getting-started/installation.md#prerequisites)** - System requirements

### Deployment
- **[FrankenPHP Setup](docs/deployment/frankenphp.md)** - Modern high-performance deployment (⚡ **Recommended**)
- **[Docker Setup](docs/deployment/docker.md)** - Traditional nginx + PHP-FPM deployment

### Development
- **[Development Commands](docs/development/commands.md)** - Composer scripts, Artisan commands, and workflows
- **[Code Quality](docs/development/commands.md#code-quality-tools)** - PHPStan, PHP CS Fixer, testing

### API
- **[API Documentation](docs/api/README.md)** - REST API, GraphQL, and GraphiQL usage

## ✨ Features

- **🔥 High Performance**: FrankenPHP + Laravel Octane for 2-3x performance improvement
- **🐳 Docker Ready**: Multiple deployment strategies (traditional and modern)
- **🌐 Dual APIs**: REST API (API Platform) and GraphQL with interactive explorer
- **🛠️ Developer Experience**: Hot reloading, Xdebug support, comprehensive tooling
- **📊 Code Quality**: PHPStan, PHP CS Fixer, automated testing
- **💾 Database**: MySQL 8.0 with migrations and seeders

## 🏗️ Architecture

### Modern Stack (Recommended)
```
🌐 Browser → 🚀 FrankenPHP + Octane → 🎯 Laravel → 🗄️ MySQL
```

### Traditional Stack
```
🌐 Browser → 🔧 Nginx → 🐘 PHP-FPM → 🎯 Laravel → 🗄️ MySQL
```

## 🛠️ Tech Stack

| Component | Technology | Version |
|-----------|------------|---------|
| **Runtime** | PHP | 8.4.6 |
| **Framework** | Laravel | 11.44.7 |
| **Server** | FrankenPHP | 1.0 |
| **Database** | MySQL | 8.0.42 |
| **API** | API Platform | 4.1.7 |
| **GraphQL** | GraphQL Laravel | 9.9 |
| **Frontend** | Vite | 6.3.6 |
| **Containers** | Docker | Latest |

## ⚡ Performance

### Traditional vs FrankenPHP

| Metric | Traditional (nginx + PHP-FPM) | FrankenPHP + Octane |
|--------|-------------------------------|-------------------|
| **Performance** | Baseline | 2-3x improvement* |
| **Memory Usage** | Higher | Lower |
| **Cold Start** | Every request | Once per worker |
| **HTTP/2** | Manual config | Built-in |

_*Performance improvements vary based on application complexity and server configuration._

## 🌍 Environment Support

- **Development**: Hot reloading, Xdebug, file watching
- **Staging**: Production-like with debugging capabilities
- **Production**: Optimized caching, multiple workers, security hardened

## 🤝 Contributing

We welcome contributions! Please see our [Contributing Guide](docs/CONTRIBUTING.md) for complete details on development workflow, coding standards, and submission guidelines.

## 🆘 Support

Need help? See our [Support Guide](docs/SUPPORT.md) for assistance channels and contact information.

## 📄 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

---

**Ready to experience modern PHP performance?** Try the [FrankenPHP setup](docs/deployment/frankenphp.md) for blazing-fast development and production environments.
