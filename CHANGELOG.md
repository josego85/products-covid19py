# Changelog

All notable changes to this project will be documented in this file.

## [1.6.0] - 2025-05-04

### Added
- Added detailed SonarQube documentation (sonarqube.md) with setup and usage instructions
- Created new model factories for improved testing:
  - Added ProductFactory with proper product attributes
  - Added SellerFactory with user associations and location data
  - Fixed UserFactory to include required status and password fields
- Implemented comprehensive test suite:
  - Added SellerRepository unit tests
  - Created GraphQL product query tests
  - Added API endpoint tests with JSON-LD support
  - Removed example/placeholder tests
- Integrated SonarQube with Docker for improved code quality analysis:
  - Added containerized SonarQube server configuration
  - Implemented automated scanner setup
  - Added persistent data storage for analysis history
  - Configured development environment integration in docker-compose.dev.yml
  - Added comprehensive setup and usage documentation
- Improved README index structure:
  - Added better section organization
  - Enhanced navigation with clear subsections
  - Included new SonarQube documentation links
  - Updated table of contents formatting

### Changed
- Refactored Docker architecture:
  - Implemented base docker-compose.yml for production environment
  - Added docker-compose.override.yml for development-specific settings
  - Migrated from Apache to Nginx for improved performance
  - Split application and web server into separate containers
  - Implemented multi-stage builds for optimized images
  - Added development-specific configurations and tools
- Modernized frontend build system:
  - Migrated from webpack to Vite for improved performance
  - Configured Vite for production builds
  - Updated asset compilation process
  - Optimized static asset handling
- Updated PHP version from 8.4.5 to 8.4.6
- Specified MySQL version (8.0.42) in docker-compose.yml for better version control
- Enhanced code quality with static analysis tools:
  - Implemented PHPStan for enhanced type checking
  - Applied PHP CS Fixer to standardize code style
- Enhanced README documentation:
  - Added comprehensive technology badges
  - Updated version badges (Version 1.6.0)
  - Restructured table of contents for better organization
  - Improved navigation and readability
- Updated dependencies:
  - Upgraded packages in composer.json to latest stable versions
  - Updated npm packages in package.json for improved security and performance

## [1.5.0] - 2025-03-XX

### Changed
- Updated PHP version to 8.4.5
- Enhanced README documentation:
  - Added comprehensive table of contents
  - Improved installation and setup instructions
  - Added detailed Docker deployment guides
  - Updated configuration steps for FrankenPHP and Laravel Octane
  - Included developer tools and code quality sections
- Improved task management functionality, including better organization and prioritization of tasks.
- Updated and optimized dependencies in `composer.json` to ensure compatibility and improve performance.

### Added
- Introduced new scripts in `composer.json` to streamline development and deployment workflows.
- Added GraphQL support for city and cities endpoints:
  - Implemented query resolvers for single city and multiple cities
  - Added GraphQL schema definitions
  - Optimized data fetching with GraphQL fields selection
- Added comprehensive GraphQL support for sellers endpoint:
  - Implemented comprehensive GraphQL query resolvers for sellers:
    - Added support for seller-product relationship queries
    - Created detailed schema definitions for sellers and products
    - Integrated city information in seller queries
- Added comprehensive GraphQL support for seller id endpoint:
  - Implemented single seller query by ID
  - Added detailed field resolvers for seller details
  - Included product relationship resolution
  - Added support for filtering seller's products
- Enhanced coordinate validation for city resolution:
  - Checks if coordinates exist
  - Verifies they are numeric values
  - Validates they are within proper geographical ranges:
    - Longitude: -180 to 180 degrees
    - Latitude: -90 to 90 degrees
  - The city resolver returns 'Unknown' if any validation fails

## [1.4.0]

### Changed
- Updated PHP version to 8.4.4
- Modified php.ini configuration values
- Updated dependencies in composer.json

## [1.3.0]

### Changed
- Refactored GIS service implementation

## [1.2.0]

### Added
- Implemented API Platform 4 integration

### Changed
- Updated to PHP 8.4
- Improved performance for sellers and cities endpoints
- Updated MySQL Workbench model
- Enhanced database structure

### Fixed
- Resolved Swagger documentation issues

## [1.1.1]

### Fixed
- Corrected migration issues in sellers table
- Fixed frontend list and map display
- Resolved product query issues in ProductRepository

## [1.1.0]

### Changed
- Optimized composer.json and package.json for production environment

## [1.0.0]

### Added
- Initial release of the ProductosPY system