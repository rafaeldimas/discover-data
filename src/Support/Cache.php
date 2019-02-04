<?php

namespace DiscoverData\Support;

use Predis\Client;

class Cache
{
    private static $instance;

    /**
     * @return Client
     */
    public static function init()
    {
        return new Client([
            'host' => Config::get('cache.redis_host'),
            'port' => Config::get('cache.redis_port'),
            'password' => Config::get('cache.redis_password'),
            'database' => Config::get('cache.redis_database'),
        ]);
    }

    /**
     * @return Client
     */
    public static function getInstance()
    {
        if (!self::$instance){
            self::$instance = self::init();
        }
        return self::$instance;
    }
}
