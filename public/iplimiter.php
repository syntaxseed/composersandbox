<?php
use Syntaxseed\IPLimiter\IPLimiter;

require_once '../app/bootstrap.php';


// ****** SANDBOX - trying things out below. ******************

$host = 'localhost';
$db   = 'db1_sandbox';
$user = 'db1_usr1';
$pass = 'DB1USR1rt6';
$charset = 'utf8mb4';

$dsn = "mysql:host={$host};dbname={$db};charset={$charset}";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}

$ipLimiter = (new IPLimiter($pdo, 'syntaxseed_iplimiter'))
             ->event($_SERVER['REMOTE_ADDR'], 'ComposerTest')
             ->log();

/*
$result = $ipLimiter->migrate()
if($result){
    echo('Created Database!');
}else{
    echo($ipLimiter->getLastError());
}
*/

//$ipLimiter->event($_SERVER['REMOTE_ADDR'], 'ComposerTest');

echo("Attempts: ".$ipLimiter->attempts());
echo("<br>Seconds Since Last: ".$ipLimiter->last());

$rule='{
    "resetAtSeconds":60,
    "waitAtLeast":10,
    "allowedAttempts":5,
    "allowBanned":false
}';

echo("<br><br>Passes rule?<br><pre>{$rule}</pre>...");

echo(var_export($ipLimiter->rule($rule), true));

echo("<br><br>Logged new event.");
$ipLimiter->log();