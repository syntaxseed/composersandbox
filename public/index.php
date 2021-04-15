<?php
//use TeamTNT\TNTSearch\TNTSearch;

require_once '../app/bootstrap.php';

// ****** SANDBOX - trying things out below. ******************

//echo('<img src="images/templateseed.png" alt="TemplateSeed image" /><br clear="all"><br>');

echo("sherri.dev<br><br>Test on Dec 14, 11am.<br><br>");

echo $container['tpl']->render('theme/hello', ['name' => 'World']);


// add records to the log
$container['logger']->warning('Logger Test from index.php.');
//$container['logger']->error('Bar');
//$container['logger']->info('Some info here.');

//echo( '<pre>');
//var_dump($container);
