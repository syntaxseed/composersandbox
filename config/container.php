<?php 
use Pimple\Container;

$container = new Container();

// Base config:
$container['config'] = array_merge(include('config/config.php'), include('config/security.php'));

// Environment specific config:
$container['env'] = include('config/environment-'.$container['config']['environment'].'.php');

return $container;