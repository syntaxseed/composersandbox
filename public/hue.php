<?php
use \Phue\Client;
use \Phue\Command\Ping;
use \Phue\Command\GetLights;
use \Phue\Command\SetLightState;
use Phue\Transport\Exception\ConnectionException;

require_once '../vendor/autoload.php';

/**
 * Hue IP: 192.168.1.2 (Local network)
 * Hue Username: Se5sEWE5Lin30rOu5zNG0K7acvZZuNPp0DHT3mfQ
 * https://github.com/neoteknic/Phue
 */

 // Finding Hue IP
 // nmap -sP 192.168.1.255/24 > /dev/null; sudo arp -na | grep "at 00:17:88"


$client = new Client('192.168.1.2', 'Se5sEWE5Lin30rOu5zNG0K7acvZZuNPp0DHT3mfQ');

try {
    $client->sendCommand(
        new Ping
    );

    $lights = $client->getLights();

    foreach ($lights as $lightId => $light) {
        echo "Id #{$lightId} - {$light->getName()}<br>";
    }

    echo('<hr>');

    foreach ($client->getGroups() as $group) {
        $groupLightIds = implode(', ', $group->getLightIds());
        echo <<<EOT
            Id #{$group->getId()} - {$group->getName()}
            (Type: {$group->getType()})
            Lights: {$groupLightIds}<br>
        EOT;
    }



    $light = $lights[1];


    $light->setOn(true);
    $light->setRGB(100, 10, 10);
    $light->setBrightness(255);

    $light->setEffect('none'); // none or colorloop


    /*
    // Candle effect:

    for($i = 1; $i < 100; $i++) {
        // Randomly choose values
        $brightness = rand(20, 60);
        $colorTemp = rand(440, 450);
        $transitionTime = rand(0, 3) / 10;

        // Send command

        $x = new SetLightState(1);
        $y = $x->brightness($brightness)
            ->colorTemp($colorTemp)
            ->transitionTime($transitionTime);
        $client->sendCommand($y);

        // Sleep for transition time plus extra for request time
        usleep($transitionTime * 1000000 + 25000);
    }
    */
} catch (ConnectionException $e) {
    echo 'ERROR: There was a problem accessing the Hue bridge.';
}
