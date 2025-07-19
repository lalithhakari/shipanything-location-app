# Location Microservice

This is the Location microservice for the ShipAnything platform, handling geolocation, tracking, and location-based services.

## Features

-   GPS tracking and geolocation
-   Route optimization
-   Location-based search
-   Distance calculations

## Endpoints

-   `GET /health` - Health check
-   `GET /api/test/dbs` - Database connectivity test
-   `GET /api/test/rabbitmq` - RabbitMQ connectivity test
-   `GET /api/test/kafka` - Kafka connectivity test

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
