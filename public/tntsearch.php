<?php
require_once '../app/bootstrap.php';

// TNT Search

$indexName = 'test.index';
$createIndex = true;

$tnt = $container['tntsearch'];

if ($createIndex) {

    // Creating a NEW index. Empty old one first:
    if (file_exists($tnt->config['storage'].$indexName)) {
        unlink($tnt->config['storage'].$indexName);
    }
    touch($tnt->config['storage'].$indexName);

    $indexer = $tnt->createIndex($indexName);

    $indexer->insert(['id' => 1, 'content' => 'new awesome article about php']);
    $indexer->insert(['id' => 2, 'content' => 'another article about php']);
    $indexer->insert(['id' => 3, 'content' => 'read this one because it is cool.']);
    $indexer->insert(['id' => 4, 'content' => 'some stuff about interesting things']);

    $indexer->run();
}

$tnt->selectIndex($indexName);
$results = @$tnt->search('article', 4);

var_dump($results);
