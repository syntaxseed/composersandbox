<?php
use Pimple\Container;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

$container = new Container();

// Base config:
$container['config'] = array_merge(include('config.php'), include('security.php'));

// Environment specific config:
$container['env'] = include('environment-'.$container['config']['environment'].'.php');

// Set up logging:
$container['logger'] = function () use ($container) {
    return ((new Logger('applog'))->pushHandler(new StreamHandler(__DIR__.'/../logs/app.log', $container['env']['logging_level'])));
};

return $container;
