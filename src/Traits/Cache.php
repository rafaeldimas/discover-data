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

    public function initCache()
    {
        $this->cache = CacheStore::getInstance();
    }

    public function getCache($key)
    {
        return $this->cache->get($key);
    }

    public function setCache($key, $value, $expireResolution = null, $expireTTL = null, $flag = null)
    {
        return $this->cache->set($key, $value, $expireResolution, $expireTTL, $flag);
    }
}
