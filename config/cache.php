<?php

return [
    'redis_host' => env('REDIS_HOST','127.0.0.1'),
    'redis_port' => env('REDIS_PORT', 6379),
    'redis_password' => env('REDIS_PASSWORD', null),
    'redis_database' => env('REDIS_DATABASE', null),
];

