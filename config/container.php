<?php
use Pimple\Container;

$container = new Container();

// Base config:
$container['config'] = array_merge(include('config.php'), include('security.php'));

// Environment specific config:
$container['env'] = include('environment-'.$container['config']['environment'].'.php');

return $container;
