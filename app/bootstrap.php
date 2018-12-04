<?php
require_once '../vendor/autoload.php';

// Dependencies:
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Syntaxseed\Templateseed\TemplateSeed;
use TeamTNT\TNTSearch\TNTSearch;


// Set up DI container:
$container = require '../config/container.php';

// Set up logging:
$container['logger'] = new Logger('applog');
$container['logger']->pushHandler(new StreamHandler(__DIR__.'/../logs/app.log', $container['env']['logging_level']));
