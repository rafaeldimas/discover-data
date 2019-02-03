<?php


namespace DiscoverData\Support;

class Path
{
    private static $rootPath = '';
    private static $storagePath = '';

    public function __construct()
    {
        self::init();
    }

    public static function init()
    {
        self::$rootPath = Config::get('path.root') . DS;
        self::$storagePath = Config::get('path.storage') . DS;
    }

    public static function path($path = '')
    {
        return self::$rootPath . ($path ? $path . DS : '');
    }

    public static function storage($path = '')
    {
        return self::$storagePath . ($path ? $path . DS : '');
    }

    public static function cookie($path = '')
    {
        return self::$storagePath . 'cookie' . DS . ($path ? $path . DS : '');
    }

    public static function csv($path = '')
    {
        return self::$storagePath . 'csv' . DS . ($path ? $path . DS : '');
    }

    public static function html($path = '')
    {
        return self::$storagePath . 'html' . DS . ($path ? $path . DS : '');
    }
}
