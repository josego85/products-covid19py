# Contributing Guide

Thank you for your interest in contributing to products-covid19py!

## 🤝 How to Contribute

### Reporting Issues

Before creating an issue:
1. **Search existing issues** to avoid duplicates
2. **Check the documentation** - your question might already be answered
3. **Use the latest version** - ensure you're using the most recent release

When creating an issue, provide:
- Clear, descriptive title
- Detailed steps to reproduce the problem
- Relevant logs, screenshots, or code samples
- Environment details (OS, PHP version, Docker version)

### Suggesting Features

1. **Check existing feature requests** to avoid duplicates
2. **Explain the use case** - why would this feature be useful?
3. **Provide detailed specifications** - how should it work?
4. **Consider backward compatibility** - will it break existing functionality?

## 🛠️ Development Workflow

### 1. Fork and Clone

```bash
# Fork the repository on GitHub, then clone your fork
git clone https://github.com/YOUR_USERNAME/products-covid19py.git
cd products-covid19py

# Add the original repository as upstream
git remote add upstream https://github.com/josego85/products-covid19py.git
```

### 2. Set Up Development Environment

For detailed setup instructions, see:
- **[Installation Guide](getting-started/installation.md)** - Basic setup
- **[FrankenPHP Setup](deployment/frankenphp.md)** - Recommended high-performance setup
- **[Docker Setup](deployment/docker.md)** - Traditional setup

### 3. Development Guidelines

- **Follow PSR-12 coding standards**
- **Write clean, readable code**
- **Add tests for new functionality**
- **Update documentation when needed**

### 4. Quality Checks

Before submitting, run:
```bash
composer check-style && composer phpstan && composer test
```

For complete development commands, see [Development Commands](development/commands.md).

### 5. Commit and Submit

#### Commit Message Format

Use [Conventional Commits](https://www.conventionalcommits.org/):

```
<type>: <description>

Examples:
feat: add FrankenPHP support
fix: resolve MySQL connection issues
docs: update API documentation
test: add unit tests for products
```

#### Submit Pull Request

```bash
# Commit your changes
git add .
git commit -m "feat: add amazing feature"

# Push your branch
git push origin feature/amazing-feature

# Create a Pull Request on GitHub
```

## 📋 Pull Request Guidelines

### Checklist

- [ ] All tests pass (`composer test`)
- [ ] Static analysis passes (`composer phpstan`)
- [ ] Code style is correct (`composer check-style`)
- [ ] Documentation updated if needed
- [ ] Commit messages follow conventional format

### Review Process

1. Automated checks must pass
2. Code review by maintainers
3. Testing and approval

## 📝 Code Standards

- **PSR-12** coding standards
- **PHPStan** static analysis
- **Unit tests** for new features
- **Documentation** updates when needed

For detailed development guidelines, see:
- **[Development Commands](development/commands.md)** - All composer and artisan commands
- **[Troubleshooting](development/troubleshooting.md)** - Common development issues
- **[Support Guide](SUPPORT.md)** - Getting help

## 🙏 Recognition

Contributors are credited in release notes and project documentation.

Thank you for contributing to products-covid19py! 🎉