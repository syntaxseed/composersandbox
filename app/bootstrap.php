<?php
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;

require_once '../vendor/autoload.php';


// Set up DI container:
$container = require '../config/container.php';

// Set up logging:
$container['logger'] = new Logger('applog');
$container['logger']->pushHandler(new StreamHandler(__DIR__.'/../logs/app.log', $container['env']['logging_level']));
