<?php

return [
    'redis_host' => getenv('REDIS_HOST','127.0.0.1'),
    'redis_password' => getenv('REDIS_PASSWORD', null),
    'redis_port' => getenv('REDIS_PORT', 6379),
];

