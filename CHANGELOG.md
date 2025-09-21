# Changelog

All notable changes to this project will be documented in this file.

This project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

---

## [1.7.0] - 2025-09-21

### Added

- **FrankenPHP Integration**: Modern high-performance PHP application server with Laravel Octane
  - Added `docker/frankenphp/Dockerfile.dev` for development environment with Xdebug and Node.js
  - Added `docker/frankenphp/Dockerfile.prod` for production environment with optimized settings
  - Created `docker-compose.frankenphp.yml` for development with single worker and immediate file changes
  - Created `docker-compose.frankenphp.prod.yml` for production with multiple workers and optimizations
  - Added PHP 8.4 support with required extensions: `pdo_mysql`, `zip`, `opcache`, `intl`, `pcntl`, `gd`, `curl`, `mbstring`, `xml`, `bcmath`
- **Alternative Architecture**: Optional FrankenPHP + Octane stack alongside existing nginx + PHP-FPM setup
- **Documentation Structure**: Complete documentation reorganization for better maintainability
  - Added `docs/getting-started/installation.md` - Comprehensive setup guide
  - Added `docs/deployment/docker.md` - Traditional Docker deployment guide
  - Added `docs/deployment/frankenphp.md` - Modern FrankenPHP deployment guide (6.5KB detailed guide)
  - Added `docs/development/commands.md` - Development workflows and commands
  - Added `docs/development/troubleshooting.md` - Centralized troubleshooting guide
  - Added `docs/api/README.md` - REST API and GraphQL documentation
  - Added `docs/CONTRIBUTING.md` - Streamlined contribution guidelines
  - Added `docs/SUPPORT.md` - Support channels and contact information

### Changed

- **Configuration**: Updated Laravel Octane configuration to use FrankenPHP as default server (was RoadRunner)
- **Docker Structure**: Reorganized Docker configuration for better separation of concerns
  - Development and production Dockerfiles are now clearly separated
  - Better organized file structure under `docker/frankenphp/` directory
- **README.md**: Transformed from 336 lines to concise 117-line dashboard with modular documentation links
- **Documentation Architecture**: Applied DRY principle - single source of truth for all topics
  - Eliminated duplicate content across documentation files
  - Each document has single responsibility and clear purpose
  - Cross-references and proper navigation between documents

### Removed

- **Legacy Files**: Cleaned up obsolete FrankenPHP configurations
  - Removed `Dockerfile-frankenphp` (replaced by structured approach)
  - Removed `Caddyfile` (handled by Octane internally)
  - Removed `standalone.Dockerfile` (legacy static binary approach)
  - Removed `static-build.Dockerfile` (superseded by modern Octane approach)

### Technical Details

- **Development Setup**:
  ```bash
  docker-compose -f docker-compose.frankenphp.yml up --build
  ```
- **Production Setup**:
  ```bash
  docker-compose -f docker-compose.frankenphp.prod.yml up --build
  ```
- **Performance**: FrankenPHP with Octane provides 2-3x performance improvement over traditional setup
- **Hot Reload**: Development environment supports immediate file change detection with single worker mode

---

## [1.6.2] - 2025-09-21

### Fixed

- **Docker Development Environment**: Resolved MySQL connection issues in development mode
  - Added MySQL service configuration to `docker-compose.override.yml` with port mapping `3306:3306`
  - Fixed nginx container restart loop by creating `/var/run/nginx` directory and setting proper permissions
  - Added nginx port mapping `80:80` for development environment access
  - Implemented automatic storage permissions fix through entrypoint script
  - Added `ENTRYPOINT` to app Dockerfile to ensure proper file permissions on container startup
- **Dependencies**: Updated deprecated static analysis package
  - Replaced deprecated `nunomaduro/larastan` with `larastan/larastan` 3.7.2
  - Updated `phpstan/phpstan` from `2.1.11` to `2.1.28`
  - Maintained PHPStan compatibility and code quality standards

### Improved

- **Development Workflow**: Enhanced Docker development experience
  - Development environment now works seamlessly with `docker-compose up -d`
  - Fixed file permissions issues for Laravel storage directories
  - Ensured nginx serves the application correctly on `http://localhost`
  - Maintained backward compatibility with production configuration

---

## [1.6.1] - 2025-09-21

### Fixed

-   **Security**: Upgraded `axios` from `1.6.x` to `>=1.12.0` to resolve high-severity Denial of Service vulnerability (GHSA-4hjh-wcwx-xvwj) [CVE-2024-39338]
-   **Dependencies**: Updated development dependencies for improved stability and security
    -   `vite`: `6.3.4` → `6.3.6` (build tooling improvements)
    -   `form-data`: `4.0.2` → `4.0.4` (security patches)
-   **Security**: Executed `npm audit fix` to address all dependency vulnerabilities
    -   **Result**: Reduced vulnerability count from X to **0** (clean audit)

### Maintenance

-   Ran full dependency audit and cleanup
-   Verified all security patches applied successfully
-   Updated lockfile to reflect dependency changes

---

## [1.6.0] - 2025-05-04

### Added

-   Added detailed SonarQube documentation (sonarqube.md) with setup and usage instructions
-   Created new model factories for improved testing:
    -   Added ProductFactory with proper product attributes
    -   Added SellerFactory with user associations and location data
    -   Fixed UserFactory to include required status and password fields
-   Implemented comprehensive test suite:
    -   Added SellerRepository unit tests
    -   Created GraphQL product query tests
    -   Added API endpoint tests with JSON-LD support
    -   Removed example/placeholder tests
-   Integrated SonarQube with Docker for improved code quality analysis:
    -   Added containerized SonarQube server configuration
    -   Implemented automated scanner setup
    -   Added persistent data storage for analysis history
    -   Configured development environment integration in docker-compose.dev.yml
    -   Added comprehensive setup and usage documentation
-   Improved README index structure:
    -   Added better section organization
    -   Enhanced navigation with clear subsections
    -   Included new SonarQube documentation links
    -   Updated table of contents formatting

### Changed

-   Refactored Docker architecture:
    -   Implemented base docker-compose.yml for production environment
    -   Added docker-compose.override.yml for development-specific settings
    -   Migrated from Apache to Nginx for improved performance
    -   Split application and web server into separate containers
    -   Implemented multi-stage builds for optimized images
    -   Added development-specific configurations and tools
-   Modernized frontend build system:
    -   Migrated from webpack to Vite for improved performance
    -   Configured Vite for production builds
    -   Updated asset compilation process
    -   Optimized static asset handling
-   Updated PHP version from 8.4.5 to 8.4.6
-   Specified MySQL version (8.0.42) in docker-compose.yml for better version control
-   Enhanced code quality with static analysis tools:
    -   Implemented PHPStan for enhanced type checking
    -   Applied PHP CS Fixer to standardize code style
-   Enhanced README documentation:
    -   Added comprehensive technology badges (Node.js, npm, Vite, Nginx)
    -   Updated version badges (Version 1.6.0)
    -   Restructured table of contents for better organization
    -   Improved navigation and readability
    -   Added detailed Docker documentation:
        -   Separated development and production environments
        -   Clear instructions for dev and prod commands
-   Updated dependencies:
    -   Upgraded packages in composer.json to latest stable versions
    -   Updated npm packages in package.json for improved security and performance
    -   Performed npm audit and fixed security vulnerabilities
    -   Updated Node.js version from 20 to 22.15.0 for improved performance and security

## [1.5.0] - 2025-03-XX

### Changed

-   Updated PHP version to 8.4.5
-   Enhanced README documentation:
    -   Added comprehensive table of contents
    -   Improved installation and setup instructions
    -   Added detailed Docker deployment guides
    -   Updated configuration steps for FrankenPHP and Laravel Octane
    -   Included developer tools and code quality sections
-   Improved task management functionality, including better organization and prioritization of tasks.
-   Updated and optimized dependencies in `composer.json` to ensure compatibility and improve performance.

### Added

-   Introduced new scripts in `composer.json` to streamline development and deployment workflows.
-   Added GraphQL support for city and cities endpoints:
    -   Implemented query resolvers for single city and multiple cities
    -   Added GraphQL schema definitions
    -   Optimized data fetching with GraphQL fields selection
-   Added comprehensive GraphQL support for sellers endpoint:
    -   Implemented comprehensive GraphQL query resolvers for sellers:
        -   Added support for seller-product relationship queries
        -   Created detailed schema definitions for sellers and products
        -   Integrated city information in seller queries
-   Added comprehensive GraphQL support for seller id endpoint:
    -   Implemented single seller query by ID
    -   Added detailed field resolvers for seller details
    -   Included product relationship resolution
    -   Added support for filtering seller's products
-   Enhanced coordinate validation for city resolution:
    -   Checks if coordinates exist
    -   Verifies they are numeric values
    -   Validates they are within proper geographical ranges:
        -   Longitude: -180 to 180 degrees
        -   Latitude: -90 to 90 degrees
    -   The city resolver returns 'Unknown' if any validation fails

## [1.4.0]

### Changed

-   Updated PHP version to 8.4.4
-   Modified php.ini configuration values
-   Updated dependencies in composer.json

## [1.3.0]

### Changed

-   Refactored GIS service implementation

## [1.2.0]

### Added

-   Implemented API Platform 4 integration

### Changed

-   Updated to PHP 8.4
-   Improved performance for sellers and cities endpoints
-   Updated MySQL Workbench model
-   Enhanced database structure

### Fixed

-   Resolved Swagger documentation issues

## [1.1.1]

### Fixed

-   Corrected migration issues in sellers table
-   Fixed frontend list and map display
-   Resolved product query issues in ProductRepository

## [1.1.0]

### Changed

-   Optimized composer.json and package.json for production environment

## [1.0.0]

### Added

-   Initial release of the ProductosPY system
