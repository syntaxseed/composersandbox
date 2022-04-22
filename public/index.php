<?php

//use TeamTNT\TNTSearch\TNTSearch;

use chillerlan\QRCode\QRCode;
use chillerlan\QRCode\QROptions;

require_once '../app/bootstrap.php';

// ****** SANDBOX - trying things out below. ******************

//echo('<img src="images/templateseed.png" alt="TemplateSeed image" /><br clear="all"><br>');

echo("sherri.dev<br><br>Test on June 11, 12pm.<br><br>");

echo $container['tpl']->render('theme/hello', ['name' => 'World']);

//Test

// add records to the log
$container['logger']->warning('Logger Test from index.php.');
//$container['logger']->error('Bar');
//$container['logger']->info('Some info here.');

//echo( '<pre>');
//var_dump($container);



// QR Code library

$data = 'https://www.avinus.com';

$options = new QROptions([
    'version'    => 5,
    'outputType' => QRCode::OUTPUT_IMAGE_PNG,
    'eccLevel'   => QRCode::ECC_M,
]);

$qrcode = new QRCode($options);

// quick and simple:
echo '<img src="' . $qrcode->render($data) . '" alt="QR Code" />';
