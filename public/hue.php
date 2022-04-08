<?php
use \Phue\Client;
use \Phue\Command\CreateScene;
use \Phue\Command\DeleteScene;
use \Phue\Command\GetLights;
use \Phue\Command\Ping;
use \Phue\Command\SetGroupState;
use \Phue\Command\SetLightState;
use \Phue\Command\SetSceneLightState;
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
    $scenes = $client->getScenes();

    echo('<h2>Initial Scene Set:</h2>');
    //displayScenes($client);

    // Create a scene.

    $lights[1]->setOn(true);
    $lights[1]->setRGB(0, 0, 255);
    $lights[2]->setOn(true);
    $lights[2]->setRGB(0, 0, 255);
    sleep(1);



    $client->sendCommand(new CreateScene('phparch', 'PHP Architect', [1, 2]));

    $command = new SetSceneLightState('phparch', 1);
    $command = $command->brightness(200)
        ->rgb(220, 90, 33); // Orange
    $client->sendCommand($command);

    $command = new SetSceneLightState('phparch', 2);
    $command = $command->brightness(200)
        ->rgb(60, 70, 175);  // Purple
    $client->sendCommand($command);


    echo('<hr>');
    echo('<h2>Updated Scene Set:</h2>');
    $scenes = displayScenes($client);

    print_r($scenes['phparch']);

    echo('<hr>');
    echo('Turning on scene...<br>');

    $lights[1]->setOn(true);
    $lights[1]->setRGB(0, 255, 0);
    $lights[2]->setOn(true);
    $lights[2]->setRGB(0, 255, 0);
    sleep(3);

    $command = new SetGroupState($groups[2]);
    $command->scene('phparch');
    $client->sendCommand($command);

    sleep(5);
    echo('Deleting scene...<br>');

    $scenes['phparch']->delete();

    echo('<h2>Deleted Scene Set:</h2>');
    displayScenes($client);

    exit();




    $lights[1]->setRGB(0, 255, 0);
    $lights[2]->setRGB(0, 255, 0);

    sleep(1);




    /*
    for ($i = 1; $i <= 5; $i++) {
        $light->setRGB(0, 0, 255);
        sleep(2); // Wait for 2 seconds.
        $light->setRGB(0, 255, 0);
        sleep(2); // Wait for 2 seconds.
        $light->setRGB(155, 0, 0);
        sleep(2); // Wait for 2 seconds.
    }
    */

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
    /*
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
    */
} catch (ConnectionException $e) {
    echo 'ERROR: There was a problem accessing the Hue bridge.';
}


/*
Light Id #1 - Hue color lamp 1
Light Id #2 - Hue color lamp 2
Light Id #3 - Hue color -Sherri's bedside
Light Id #4 - Hue color - Kevin's bedside
*/
function displayLights($client)
{
    $lights = $client->getLights();
    foreach ($lights as $lightId => $light) {
        echo "Light Id #{$lightId} - {$light->getName()}<br>";
    }
    return $lights;
}

/*
Group Id #1 - Master Bedroom (Type: Room) Lights: 4, 3
Group Id #2 - Family Room (Type: Room) Lights: 1, 2
Group Id #200 - Living room music area (Type: Entertainment) Lights: 1, 2
Group Id #201 - Bedroom music area (Type: Entertainment) Lights: 4, 3
*/
function displayGroups($client)
{
    $groups = $client->getGroups();
    foreach ($groups as $group) {
        $groupLightIds = implode(', ', $group->getLightIds());
        echo <<<EOT
            Group Id #{$group->getId()} - {$group->getName()}
            (Type: {$group->getType()})
            Lights: {$groupLightIds}<br>
        EOT;
    }
    return $groups;
}

/*
Scene Id #qJbs3HT4XQaatx2 - Savanna sunset (Lights: 3, 4)
Scene Id #O0cshlfoi1LNeys - Tropical twilight (Lights: 3, 4)
Scene Id #u7Bk9fBJ7qtiRnA - Arctic aurora (Lights: 3, 4)
Scene Id #JVz9N-5hvIs-BbC - Spring blossom (Lights: 3, 4)
Scene Id #Ri1gzX2-KYpczwE - Spring blossom (Lights: 1, 2)
Scene Id #RQDUc6yccQ8kav1 - Relax (Lights: 1, 2)
Scene Id #zahvZZ30xwtRTPQ - Read (Lights: 1, 2)
...
*/
function displayScenes($client)
{
    $scenes = $client->getScenes();
    foreach ($scenes as $scene) {
        $lightIds = implode(', ', $scene->getLightIds());
        echo <<<EOT
            Scene Id #{$scene->getId()} - {$scene->getName()}
            (Lights: {$lightIds})<br>
        EOT;
    }
    return $scenes;
}
