<?php

require './vendor/autoload.php';

use Jumia\Core\Request;
use Jumia\Core\Router;

/** @var \Psr\Container\ContainerInterface $container */
$container = require_once __DIR__.'/config/container.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

Router::load('./config/routes.php')
      ->direct(Request::uri(), Request::method());
