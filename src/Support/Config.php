<?php


namespace DiscoverData\Support;

use Adbar\Dot;
use FilesystemIterator;
use SplFileInfo;

/**
 * Class Config
 * @package DiscoverData\Support
 * @method static Dot add(array|int|string $keys, mixed $value = null)
 * @method static Dot all()
 * @method static Dot clear(array|int|string|null $keys = null)
 * @method static Dot count()
 * @method static Dot delete(array|int|string $keys)
 * @method static Dot flatten(string $delimiter = '.', array|null $items = null, string $prepend = '')
 * @method static Dot get(int|string|null $key = null, mixed $default = null)
 * @method static Dot has(array|int|string $keys)
 * @method static Dot isEmpty(array|int|string|null $keys = null)
 * @method static Dot merge(array|string|self $key, array|self $value = [])
 * @method static Dot mergeRecursive(array|string|self $key, array|self $value = [])
 * @method static Dot mergeRecursiveDistinct(array|string|self $key, array|self $value = [])
 * @method static Dot pull(int|string|null $key = null, mixed $default = null)
 * @method static Dot push(mixed $key, mixed $value = null)
 * @method static Dot replace(array|string|self $key, array|self $value = [])
 * @method static Dot set(array|string|self $keys, mixed $value = null)
 * @method static Dot setArray(mixed $items)
 * @method static Dot setReference(array $items)
 * @method static Dot toJson(mixed $key = null, int $options = 0)
 */
class Config
{
    private static $staticItems = [];
    private static $instance;

    public static function init($rootPath = false)
    {
        $rootPath = ($rootPath ?: dirname(__DIR__, 2)).DS;
        $files = new FilesystemIterator($rootPath.'config');
        /** @var SplFileInfo $file */
        foreach ($files as $file) {
            self::$staticItems[$file->getBasename('.php')] = require_once $file->getPathname();
        }
    }

    public static function __callStatic($method, $args)
    {
        if (!self::$instance) {
            self::$instance = new Dot(self::$staticItems);
        }
        return self::$instance->$method(...$args);
    }
}
