<?php
use Pimple\Container;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Syntaxseed\Templateseed\TemplateSeed;
use TeamTNT\TNTSearch\TNTSearch;


$container = new Container();

// General application settings config:
$container['config'] = [];
$container['config'] = include('config.php');

$container['config'] = array_merge(
    $container['config'],
    // API Keys and database info, etc:
    include('security-'.$container['config']['settings']['environment'].'.php'),
    // Environment specific config:
    include('environment-'.$container['config']['settings']['environment'].'.php')
);

// Set up logging:
$container['logger'] = function () use ($container) {
    return ((new Logger('applog'))->pushHandler(new StreamHandler($container['config']['env']['log_file'], $container['config']['env']['logging_level'])));
};

// Set up templating/view class:
$container['tpl'] = new TemplateSeed(__DIR__.'/../src/templates/');

// Set up tnt search:
$container['tntsearch'] = function () use ($container) {
    $tntConfig = [
        "driver"    => 'filesystem',
        "location"  => __DIR__.'/../tntsearch/dummysource/',
        "extension" => "txt",
        'storage'   => __DIR__.'/../tntsearch/indexes/'
    ];
    $tnt = new TNTSearch;
    $tnt->loadConfig($tntConfig);
    return $tnt;
};

return $container;
