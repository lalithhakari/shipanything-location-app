# Location Microservice

This is the Location microservice for the ShipAnything platform, handling geolocation, tracking, and location-based services. **This service is protected by the Auth Gateway and requires a valid Bearer token for API access.**

## Features

-   GPS tracking and geolocation
-   Route optimization
-   Location-based search
-   Distance calculations
-   User-specific location management

## Authentication

**All API endpoints (except health check) are protected by the NGINX API Gateway and require a valid Bearer token.**

The authentication flow works as follows:

1. Client sends request to `http://location.shipanything.test/api/*` with Bearer token
2. NGINX API Gateway intercepts and validates the token with the auth service
3. If valid, NGINX forwards the request with user context headers to this service
4. This service processes the request with authenticated user context

**Example API call:**

```bash
curl -X GET http://location.shipanything.test/api/locations \
  -H "Authorization: Bearer YOUR_ACCESS_TOKEN"
```

**To get an access token, register/login via the Auth service:**

```bash
# Login to get token
curl -X POST http://auth.shipanything.test/api/auth/login \
  -H "Content-Type: application/json" \
  -d '{"email": "your@email.com", "password": "yourpassword"}'
```

## API Endpoints

### Public Endpoints (No Authentication Required)

-   `GET /health` - Service health check

### Protected Endpoints (Require Bearer Token)

-   `GET /api/locations` - Get user's locations
-   `POST /api/locations` - Create new location
-   `GET /api/locations/{id}` - Get specific location
-   `PUT /api/locations/{id}` - Update location
-   `DELETE /api/locations/{id}` - Delete location

### Internal Test Endpoints (Container Network Only)

-   `GET /api/test/dbs` - Database connectivity test
-   `GET /api/test/rabbitmq` - RabbitMQ connectivity test
-   `GET /api/test/kafka` - Kafka connectivity test
-   `GET /api/test/auth-status` - Authentication status check

## User Context

**This service automatically receives user context from the NGINX API Gateway:**

-   User ID is available in controllers via `$request->attributes->get('user_id')`
-   User email via `$request->attributes->get('user_email')`
-   All location data is automatically filtered by authenticated user

**Example usage in controller:**

```php
public function getLocations(Request $request)
{
    $userId = $request->attributes->get('user_id');
    $userEmail = $request->attributes->get('user_email');

    // Get locations for the authenticated user only
    $locations = Location::where('user_id', $userId)->get();

    return response()->json($locations);
}
```

## Environment Variables

-   `DB_HOST` - PostgreSQL host (`location-postgres`)
-   `DB_DATABASE` - Database name (`location_db`)
-   `DB_USERNAME` - Database user (`location_user`)
-   `DB_PASSWORD` - Database password (`location_password`)
-   `REDIS_HOST` - Redis host (`location-redis`)
-   `RABBITMQ_HOST` - RabbitMQ host (`location-rabbitmq`)
-   `RABBITMQ_USER` - RabbitMQ user (`location_user`)
-   `RABBITMQ_PASSWORD` - RabbitMQ password (`location_password`)
-   `KAFKA_BROKERS` - Kafka brokers list (`kafka:29092`)

## Database Connection (Development)

**PostgreSQL:**

-   Host: `localhost`
-   Port: `5434`
-   Database: `location_db`
-   Username: `location_user`
-   Password: `location_password`

**Redis:**

-   Host: `localhost`
-   Port: `6381`

**RabbitMQ Management UI:**

-   URL: http://localhost:15673
-   Username: `location_user`
-   Password: `location_password`

## Docker Compose Ports

-   **Application**: 8082
-   **PostgreSQL**: 5434
-   **Redis**: 6381
-   **RabbitMQ AMQP**: 5673
-   **RabbitMQ Management**: 15673

## Development

This service is part of the larger ShipAnything microservices platform. See the main repository README for setup and deployment instructions.

### Running Commands

```bash
# Navigate to the docker folder
cd microservices/location-app/docker

# Run artisan commands
./cmd.sh php artisan migrate
./cmd.sh php artisan make:controller LocationController
./cmd.sh composer install
```
