<?php

require_once '../app/bootstrap.php';

use Syntaxseed\Libsodiumfacade\LibsodiumFacade;

$secretMessage = "I want to encrypt this content.";

$key = LibsodiumFacade::generateSymmetricKey();

$encryptedMessage = LibsodiumFacade::symmetricEncrypt($secretMessage, $key);

$decryptedMessage = LibsodiumFacade::symmetricDecrypt(
    $encryptedMessage['encrypted'],
    $encryptedMessage['nonce'],
    $key
);

echo("<pre>\n\n");

echo("==== SYMMETRIC KEY ENCRYPTION ====\n\n");

echo("Original Message: \n");
print_r($secretMessage);
echo("\n\n");

echo("Encrypted Message: \n");
print_r($encryptedMessage);
echo("\n\n");

echo("Decrypted Message: \n");
print_r($decryptedMessage);
echo("\n\n");


echo("\n\n");
echo("==== PUBLIC KEY ENCRYPTION ====\n\n");

$secretMessage = "I want to encrypt this content with public key encryption.";

$myKeyPair = LibsodiumFacade::generateKeyPair();
$theirKeyPair = LibsodiumFacade::generateKeyPair();

$encryptedMessage = LibsodiumFacade::publicKeyEncrypt(
    $secretMessage,
    $theirKeyPair['public'],
    $myKeyPair['private']
);

$decryptedMessage = LibsodiumFacade::publicKeyDecrypt(
    $encryptedMessage['encrypted'],
    $encryptedMessage['nonce'],
    $myKeyPair['public'],
    $theirKeyPair['private']
);


echo("Original Message: \n");
print_r($secretMessage);
echo("\n\n");

echo("Encrypted Message: \n");
print_r($encryptedMessage);
echo("\n\n");

echo("Decrypted Message: \n");
print_r($decryptedMessage);
echo("\n\n");
