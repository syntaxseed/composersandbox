<?php

require_once '../app/bootstrap.php';

// Trying out Symfony Mailer: https://packagist.org/packages/symfony/mailer

use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mailer\Transport;
use Symfony\Component\Mime\Email;

$transport = Transport::fromDsn('smtp://fd983475aac8f1:df2ad970a1b440@smtp.mailtrap.io:2525?encryption=tls&auth_mode=login'); // MailTrap DSN
// SMTP - ICDSoft DSN:  smtp://sitemailer%40rgcomics.com:password@mail.s402.sureserver.com:587?encryption=tls&auth_mode=plain
$mailer = new Mailer($transport);

$email = (new Email())
    ->from('noreply@avinus.com')
    ->to('sherri@ofitall.com')
    //->cc('cc@example.com')
    //->bcc('bcc@example.com')
    //->replyTo('fabien@example.com')
    //->priority(Email::PRIORITY_HIGH)
    ->subject('Test Symfony Mailer')
    ->text('Testing from ComposerSandbox.')
    ->html('<p>Testing from ComposerSandbox.</p>');

$mailer->send($email);

echo("Mail Sent to MailTrap.io!<br><br>");

echo("<pre>");
var_dump($email);
echo("</pre>");
