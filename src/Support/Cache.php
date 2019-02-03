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
            'host' => 'cache',
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
