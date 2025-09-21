# API Documentation

## Overview

This application provides multiple API interfaces:

- **REST API** via API Platform
- **GraphQL API** for flexible queries
- **GraphiQL** for interactive exploration

## REST API

### Endpoint

```
http://localhost:8080/api-docs
```

### API Platform Features

- Auto-generated OpenAPI documentation
- JSON-LD and JSON API support
- Filtering, sorting, and pagination
- Validation and serialization

### Example Endpoints

```http
GET /api/products
GET /api/products/{id}
POST /api/products
PUT /api/products/{id}
DELETE /api/products/{id}
```

## GraphQL API

### Endpoint

```
http://localhost:8080/graphql
```

### Features

- Single endpoint for all operations
- Flexible query structure
- Type safety
- Real-time subscriptions (if configured)

### Example Query

```graphql
{
    sellers {
        id
        longitude
        latitude
        comment
        user {
            full_name
            email
            phone_number
        }
        products(type: "papel") {
            name
            description
            price
        }
    }
}
```

### Example Mutation

```graphql
mutation {
    createProduct(input: {
        name: "Face Mask"
        description: "N95 protection mask"
        price: 25.99
        type: "protection"
    }) {
        id
        name
        created_at
    }
}
```

## GraphiQL Interface

### Access

```
http://localhost:8080/graphiql
```

### Features

- Interactive query builder
- Auto-completion
- Documentation explorer
- Query history
- Variables support

### Usage Tips

1. **Explore Schema**: Use the documentation panel to explore available types and fields
2. **Auto-completion**: Press `Ctrl+Space` to see available options
3. **Query Variables**: Use the variables panel for dynamic values
4. **Query History**: Access previous queries from the history panel

### Security Note

⚠️ **GraphiQL should only be enabled in development environments**

## Authentication

### API Platform

```http
POST /api/auth/login
Content-Type: application/json

{
    "email": "user@example.com",
    "password": "password"
}
```

### GraphQL

```graphql
mutation {
    login(email: "user@example.com", password: "password") {
        token
        user {
            id
            email
        }
    }
}
```

## Error Handling

### REST API Errors

```json
{
    "@context": "/api/contexts/Error",
    "@type": "hydra:Error",
    "hydra:title": "An error occurred",
    "hydra:description": "Not Found"
}
```

### GraphQL Errors

```json
{
    "errors": [
        {
            "message": "Product not found",
            "locations": [{"line": 2, "column": 3}],
            "path": ["product"]
        }
    ],
    "data": {
        "product": null
    }
}
```

## Rate Limiting

Default rate limits:
- **REST API**: 60 requests per minute per IP
- **GraphQL**: 30 requests per minute per IP

Headers included in responses:
```http
X-RateLimit-Limit: 60
X-RateLimit-Remaining: 59
X-RateLimit-Reset: 1609459200
```

## Testing APIs

### Using cURL

```bash
# GET request
curl -X GET "http://localhost:8080/api/products" \
     -H "Accept: application/json"

# POST request
curl -X POST "http://localhost:8080/api/products" \
     -H "Content-Type: application/json" \
     -d '{"name": "Test Product", "price": 19.99}'

# GraphQL query
curl -X POST "http://localhost:8080/graphql" \
     -H "Content-Type: application/json" \
     -d '{"query": "{ products { id name } }"}'
```

### Using HTTPie

```bash
# REST API
http GET localhost:8080/api/products
http POST localhost:8080/api/products name="Test Product" price:=19.99

# GraphQL
http POST localhost:8080/graphql query='{ products { id name } }'
```

## API Clients

### JavaScript/TypeScript

```javascript
// REST API with fetch
const response = await fetch('http://localhost:8080/api/products');
const products = await response.json();

// GraphQL with fetch
const response = await fetch('http://localhost:8080/graphql', {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify({
        query: '{ products { id name } }'
    })
});
```

### PHP

```php
// REST API with Guzzle
$client = new \GuzzleHttp\Client();
$response = $client->get('http://localhost:8080/api/products');
$products = json_decode($response->getBody(), true);

// GraphQL
$response = $client->post('http://localhost:8080/graphql', [
    'json' => [
        'query' => '{ products { id name } }'
    ]
]);
```

## Schema Documentation

### GraphQL Schema

Access the GraphQL schema documentation:
- **Introspection**: Available via GraphiQL
- **Schema SDL**: Available at `/graphql/schema.graphql`

### OpenAPI Schema

Access the REST API schema:
- **Interactive Docs**: `http://localhost:8080/api-docs`
- **JSON Schema**: `http://localhost:8080/api/docs.json`
- **YAML Schema**: `http://localhost:8080/api/docs.yaml`

## Environment Configuration

### Development

```env
# API Platform
API_PLATFORM_ENABLE_DOCS=true
API_PLATFORM_ENABLE_ENTRYPOINT=true

# GraphQL
GRAPHQL_ENABLE_GRAPHIQL=true
GRAPHQL_DEBUG=true
```

### Production

```env
# API Platform (secure)
API_PLATFORM_ENABLE_DOCS=false
API_PLATFORM_ENABLE_ENTRYPOINT=false

# GraphQL (secure)
GRAPHQL_ENABLE_GRAPHIQL=false
GRAPHQL_DEBUG=false
```

## Best Practices

### API Design

1. **Consistent naming**: Use camelCase for GraphQL, snake_case for REST
2. **Proper HTTP status codes**: 200, 201, 400, 404, 500, etc.
3. **Versioning**: Use URL versioning for REST API (`/api/v1/`)
4. **Pagination**: Implement cursor-based pagination for large datasets

### Security

1. **Authentication**: Always authenticate sensitive operations
2. **Authorization**: Implement proper role-based access control
3. **Input validation**: Validate all input data
4. **Rate limiting**: Implement appropriate rate limits
5. **CORS**: Configure CORS properly for frontend access

### Performance

1. **Caching**: Implement response caching where appropriate
2. **Database queries**: Use eager loading to avoid N+1 problems
3. **Compression**: Enable gzip compression
4. **CDN**: Use CDN for static assets

## Troubleshooting

### Common Issues

#### 1. CORS Errors

```php
// config/cors.php
'allowed_origins' => ['http://localhost:3000'],
'allowed_methods' => ['*'],
'allowed_headers' => ['*'],
```

#### 2. GraphQL Introspection Disabled

```env
GRAPHQL_ENABLE_INTROSPECTION=true
```

#### 3. API Platform Not Loading

```bash
# Clear cache
php artisan cache:clear
php artisan config:clear
```

### Debug Mode

Enable debug mode for detailed error messages:

```env
APP_DEBUG=true
API_PLATFORM_DEBUG=true
GRAPHQL_DEBUG=true
```

## Additional Resources

- [API Platform Documentation](https://api-platform.com/docs/)
- [GraphQL Documentation](https://graphql.org/learn/)
- [Laravel API Resources](https://laravel.com/docs/eloquent-resources)
- [Lighthouse GraphQL](https://lighthouse-php.com/)