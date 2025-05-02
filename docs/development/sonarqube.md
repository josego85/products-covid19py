# Code Quality and SonarQube Integration

As of **version 1.6.0**, the ProductosPY project integrates **SonarQube** with Docker to enhance code quality, maintainability, and security through continuous inspection and analysis. This integration provides a containerized environment for consistent code quality checks across all development setups.

## Key Integration Features in v1.6.0

- **Dockerized SonarQube Server**: Runs in an isolated container
- **Automated Scanner Setup**: Pre-configured scanner container
- **Development Environment Integration**: Included in docker-compose.dev.yml
- **Persistent Data Storage**: Volume mapping for analysis history

## SonarQube Overview

**SonarQube** is a leading tool for continuous inspection of code quality. It automatically analyzes code to detect bugs, code smells, security vulnerabilities, and adherence to best practices.

## Setup Instructions

SonarQube is included as a service in the project's `docker-compose.dev.yml` file for streamlined local development and code quality analysis.

### Prerequisites

- Docker >= 20.10.21
- Docker Compose >= 2.0.0
- PHP >= 8.4.6
- Xdebug >= 3.2.0

### 1. Install SonarQube via Docker Compose

Start all services, including SonarQube:

```bash
docker compose -f docker-compose.dev.yml up --build -d
```

SonarQube will be accessible at:
- [http://localhost:9000](http://localhost:9000)

### 2. Default Credentials

- **Username:** `admin`
- **Password:** `admin`

> ⚠️ Upon first login, you will be prompted to change the default password.

### 3. Create a SonarQube Project and Token

1. Log in to SonarQube
2. Navigate to "Create New Project"
3. Choose "Manually"
4. Enter project details:
   - Project Key: `products-covid19py`
   - Display Name: `ProductosPY`
5. Generate authentication token:
   - Go to User > My Account > Security
   - Generate a new token
   - Save the token securely

> 🔒 **Security Note:** Never commit tokens to version control.

### 4. Configure Project for SonarQube

Create or update the following files:

```env
# filepath: .env
SONAR_TOKEN=your_generated_token
SONAR_HOST_URL=http://localhost:9000
```

```properties
# filepath: sonar-project.properties
sonar.projectKey=products-covid19py
sonar.projectName=ProductosPY
sonar.sources=app,routes
sonar.tests=tests
sonar.exclusions=vendor/**,storage/**,bootstrap/**,public/**
sonar.test.inclusions=tests/**/*.php
sonar.php.coverage.reportPaths=coverage.xml
sonar.php.tests.reportPath=tests-report.xml
```

### 5. Generate Code Coverage Report

Before running the analysis:

```bash
# Clean previous reports
rm -f coverage.xml tests-report.xml

# Generate fresh coverage report
XDEBUG_MODE=coverage ./vendor/bin/phpunit \
  --do-not-cache-result \
  --coverage-clover coverage.xml \
  --log-junit tests-report.xml
```

### 6. Run SonarQube Analysis

```bash
docker compose run --rm scanner
```

### 7. Monitor Results

1. Access the SonarQube dashboard
2. Navigate to your project
3. Review:
   - Quality Gates
   - Code Smells
   - Security Hotspots
   - Coverage Reports
   - Duplications

## Best Practices

- Run analysis before merging pull requests
- Address critical and blocker issues promptly
- Maintain minimum code coverage standards
- Review security hotspots regularly
- Update dependencies when security fixes are available

## Troubleshooting

Common issues and solutions:

1. **Scanner fails to connect:**
   ```bash
   docker compose restart sonarqube
   ```

2. **Coverage report not found:**
   ```bash
   chmod 644 coverage.xml
   ```

3. **Memory issues:**
   ```bash
   # Increase memory limit in docker-compose.dev.yml
   sonarqube:
     environment:
       - SONAR_ES_JAVA_OPTS=-Xmx2g -Xms2g
   ```

## Useful Links

- [SonarQube Documentation](https://docs.sonarqube.org/latest/)
- [SonarScanner CLI Documentation](https://docs.sonarqube.org/latest/analysis/scan/sonarscanner/)
- [SonarQube Docker Image](https://hub.docker.com/_/sonarqube)
- [PHP Plugin Documentation](https://docs.sonarqube.org/latest/analysis/languages/php/)

> 📅 **Last Updated:** 2025-05-02

---