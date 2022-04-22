<?php

/**
 * Notes: This technically works but fuzzy search does not.
 * Package hasn't been updated in a LONG time. Bugs aren't being fixed.
 */
require_once '../app/bootstrap.php';

// TNT Search

$indexName = 'test.index';
$createIndex = true;

$tnt = $container['tntsearch'];

if ($createIndex) {

    // Creating a NEW index. Empty old one first:
    if (file_exists($tnt->config['storage'] . $indexName)) {
        unlink($tnt->config['storage'] . $indexName);
    }
    touch($tnt->config['storage'] . $indexName);

    $indexer = $tnt->createIndex($indexName);

    $indexer->insert(['id' => 1, 'content' => 'new awesome article about php']);
    $indexer->insert(['id' => 2, 'content' => 'another article about php']);
    $indexer->insert(['id' => 3, 'content' => 'read this one because it is cool.']);
    $indexer->insert(['id' => 4, 'content' => 'some stuff about interesting things']);
    $indexer->insert(['id' => 5, 'content' => 'I have read great articles in the past.']);  // <--- Why does it not return this one which is plural?

    $indexer->run();
}

$tnt->selectIndex($indexName);
$tnt->fuzziness = true; // Doesn't work>
$results = @$tnt->search('article');

echo('<br><br>Ids found: ' . implode(", ", array_keys($results)));
