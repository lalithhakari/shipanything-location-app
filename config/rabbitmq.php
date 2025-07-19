<?php

return [
    'host' => env('RABBITMQ_HOST', 'location-rabbitmq'),
    'port' => env('RABBITMQ_PORT', 5672),
    'user' => env('RABBITMQ_USER', 'location_user'),
    'password' => env('RABBITMQ_PASSWORD', 'location_password'),
];
