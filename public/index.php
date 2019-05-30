<?php
//use TeamTNT\TNTSearch\TNTSearch;
use Syntaxseed\Templateseed\TemplateSeed;

require_once '../app/bootstrap.php';

// ****** SANDBOX - trying things out below. ******************

echo('<img src="images/templateseed.png" alt="TemplateSeed image" /><br clear="all"><br>');

$tpl = new TemplateSeed(__DIR__.'/../src/templates/');
echo $tpl->render('theme/hello', ['name' => 'World']);


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


echo("Hello! Secure Config: ".$container['config']['database']['dbuser']);
//echo( "<br>Secure config:  ".$container['config']['database']['dbuser']);


//var_dump($container);
