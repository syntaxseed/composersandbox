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

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$client = new Client('192.168.1.2', 'Se5sEWE5Lin30rOu5zNG0K7acvZZuNPp0DHT3mfQ');

try {
    $client->sendCommand(
        new Ping
    );


    $lights = $client->getLights();
    $groups = $client->getGroups();

    /*
    foreach ($lights as $lightId => $light) {
        echo "Id #{$lightId} - {$light->getName()}<br>";
    }
    */

    echo('<hr>');
    /*
    foreach ($groups as $group) {
        $groupLightIds = implode(', ', $group->getLightIds());
        echo <<<EOT
            Id #{$group->getId()} - {$group->getName()}
            (Type: {$group->getType()})
            Lights: {$groupLightIds}<br>
        EOT;
    }
    */

    /*
    Id #1 - Hue color lamp 1
    Id #2 - Hue color lamp 2
    Id #3 - Hue color -Sherri's bedside
    Id #4 - Hue color - Kevin's bedside
    Id #1 - Master Bedroom (Type: Room) Lights: 4, 3
    Id #2 - Family Room (Type: Room) Lights: 1, 2
    */



    $light = $lights[2];

    $light->setOn(false);

    sleep(2); // Wait for 2 seconds.
    $light->setOn(true);
    $light->setBrightness(100);

    // $light->setColorTemp(153);
    // sleep(2); // Wait for 2 seconds.
    // $light->setColorTemp(200);
    // sleep(2); // Wait for 2 seconds.
    // $light->setColorTemp(400);
    // sleep(2); // Wait for 2 seconds.

    //$light->setEffect('colorloop');

    // $light->setRGB(255, 0, 0);
    // sleep(2); // Wait for 2 seconds.
    // $light->setRGB(0, 255, 0);
    // sleep(2); // Wait for 2 seconds.
    // $light->setRGB(0, 0, 255);
    //$light->setBrightness(255);

    //$light->setEffect('none'); // none or colorloop



    // Flickering candle effect.
    for ($i = 1; $i < 100; $i++) {
        // Randomly choose values.
        $brightness = rand(20, 50);
        $colorTemp = rand(420, 450);
        $transitionTime = rand(0, 3) / 10;
        $waitTime = $transitionTime;

        // Setup command.
        $command = new SetLightState(2);
        $command->brightness($brightness)
            ->colorTemp($colorTemp)
            ->transitionTime($transitionTime);

        // Send command.
        $client->sendCommand($command);

        // Sleep for transition time plus some extra for request time.
        usleep($waitTime * 1000000 + 25000);
    }
} catch (ConnectionException $e) {
    echo 'ERROR: There was a problem accessing the Hue bridge.';
}
