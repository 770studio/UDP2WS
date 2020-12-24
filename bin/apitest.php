<?php
require '../vendor/autoload.php';
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Xibo\OAuth2\Client\Entity\XiboDisplayGroup;

session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

# Monolog logger requires dev composer dependencies
$handlers = [
    new \Monolog\Handler\StreamHandler(STDERR, Logger::INFO)
];
$log = new Monolog\Logger('API LIBRARY', $handlers);

# Create a Xibo provider
$clientId20 = 'LgzY2IbvZt0Z304KS0RSex4qYrs1sz0Q36giqhmC';
$clientSecret20 = 'dbEnsrGCYS2hKldGsC6ofYFpsdgkhm85mROQEmu5kkQKDjIj2ShhTcTWpUZCAg6LNb9fqVIFTHppnOfnR3q5HShy6zVkwkHINIygrAkMqQWdGGca9jdOKt3gFroc5lAceQrccPLoRzmL35nD5QjH6ZIHpUxmKGoQ7WAaiXxnU7MIVKk4gyy2ridEU8kEtTVh6pwIyqgRg00F3FiKfYpMSFKDL2Q93whBJLr6BnhYRZot7lMyxNpWwYwChIuFkR';

$provider = new \Xibo\OAuth2\Client\Provider\Xibo([
    'clientId' => $clientId20,    // The client ID assigned to you by the provider
    'clientSecret' => $clientSecret20,   // The client password assigned to you by the provider
    'redirectUri' => '',
    'baseUrl' => 'https://ds.cucos.de'
], ['logger' => $log]);

# Required for guzzle calls in this file.

if (!isset($argv[1])) {
    $token = $provider->getAccessToken('client_credentials')->getToken();
    echo 'Token for next time: ' . $token;
}
else
    $token = $argv[1];



var_dump($token);


# Create Xibo Entity Provider with logger
$entityProvider = new \Xibo\OAuth2\Client\Provider\XiboEntityProvider($provider, [
    'logger' => $log
]);


/*
$displayGroup = (new \Xibo\OAuth2\Client\Entity\XiboDisplayGroup($entityProvider))->create('phpunit displaygroup', 'phpunit displaygroup', 0, '');
print_r($displayGroup->displayGroup);
$displayGroup->edit('edited name', 'edited description', 0, '');
$displayGroup = (new \Xibo\OAuth2\Client\Entity\XiboDisplayGroup($entityProvider))->getById($displayGroup->displayGroupId);
print_r($displayGroup->displayGroup);
$displayGroup->assignDisplay(3);*/

$displayGroup = (new \Xibo\OAuth2\Client\Entity\XiboDisplayGroup($entityProvider))->getById(6);
Xibo\OAuth2\Client\Entity
var_dump($displayGroup );
$displayGroup->assignDisplay(9);

$displayGroup->changeLayout(1, 10, 1, 'replace');

EXIT;




$displayGroup = (new XiboDisplayGroup($entityProvider))->getById(6);
print_r($displayGroup->displayGroup);
//$displayGroup->assignDisplay(9);
//$layout = (new \Xibo\OAuth2\Client\Entity\XiboLayout($entityProvider))->create('phpunit layout', 'phpunit layout', '', 9);
//$displayGroup->assignLayout($layout->layoutId);
$displayGroup->collectNow();
//$displayGroup->clear();
$RES = $displayGroup->changeLayout(59, 10, 1,   'replace');

var_dump($RES);


