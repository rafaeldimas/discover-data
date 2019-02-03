<?php

namespace DiscoverData\Traits;


use DiscoverData\Support\Cache as CacheStore;
use Predis\Client;

trait Cache
{
    /**
     * @var Client
     */
    private $cache;

    public function init()
    {
        $this->cache = CacheStore::getInstance();
    }

    public function get($key)
    {
        return $this->cache->get($key);
    }

    public function set($key, $value, $expireResolution = null, $expireTTL = null, $flag = null)
    {
        return $this->cache->set($key, $value, $expireResolution, $expireTTL, $flag);
    }
}
