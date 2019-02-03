<?php

use Dotenv\Dotenv;
use DiscoverData\Support\Config;
use DiscoverData\Support\Path;

// Constants
define('ROOT_PATH', dirname(__DIR__));
define('DS', DIRECTORY_SEPARATOR);

require_once ROOT_PATH.'/vendor/autoload.php';

// Environments
$dotenv = Dotenv::create(ROOT_PATH);
$dotenv->load();

// Configs
Config::init(ROOT_PATH);
Path::init();
