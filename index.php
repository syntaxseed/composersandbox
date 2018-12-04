<?php
require_once 'vendor/autoload.php';

// Dependencies:
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Syntaxseed\Templateseed\TemplateSeed;
use TeamTNT\TNTSearch\TNTSearch;


// Set up DI container:
$container = require 'config/container.php';

// Set up logging:
$container['logger'] = new Logger('applog');
$container['logger']->pushHandler(new StreamHandler(__DIR__.'/logs/app.log', $container['env']['logging_level']));



// ****** SANDBOX - trying things out below. ******************

$tpl = new TemplateSeed(__DIR__.'/src/templates/');
echo $tpl->render('theme/hello', ['name' => 'World']);
echo("\n\n");


// TNT Search

/*
$indexName = 'test.index';
$createIndex = false;
$tntConfig = [
		"driver"    => 'filesystem',
	    "location"  => __DIR__.'/tntsearch/dummysource/',
	    "extension" => "txt",
	    'storage'   => __DIR__.'/tntsearch/indexes/'
	];

$tnt = new TNTSearch;
$tnt->loadConfig($tntConfig);

if( $createIndex ){

	// Creating a NEW index. Empty old one first:
	if (file_exists($tnt->config['storage'].$indexName)) {
	    unlink($tnt->config['storage'].$indexName);
	    touch($tnt->config['storage'].$indexName);
	}

	$indexer = $tnt->createIndex($indexName);
	$indexer->run();

	$indexer->insert(['id' => 0, 'content' => 'new awesome article about php']);
	$indexer->insert(['id' => 1, 'content' => 'another article about php']);
	$indexer->insert(['id' => 2, 'content' => 'read this one because it is cool.']);
	$indexer->insert(['id' => 3, 'content' => 'some stuff about interesting things']);
}

$tnt->selectIndex($indexName);
$results = $tnt->search('article', 4);

var_dump($results);
*/




// add records to the log
//$container['logger']->warning('Foo');
//$container['logger']->error('Bar');
//$container['logger']->info('Some info here.');

//echo( "Hello Composer! ".$container['config']['database']);

//echo( "\nSecure config:  ".$container['config']['database']['dbuser']);

echo("\n\n");

//var_dump($container);
