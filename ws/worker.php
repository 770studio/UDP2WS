<?php
EXIT;
require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/Pusher.php';

$loop   = React\EventLoop\Factory::create();
$pusher = new Pusher;

// PHP client
$webSockPhp = new React\Socket\Server('0.0.0.0:9057', $loop);

new Ratchet\Server\IoServer(
    new Ratchet\Http\HttpServer(
        new Ratchet\WebSocket\WsServer(
            $pusher
        )
    ),
    $webSockPhp
);

use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;
use MyApp\Tracker;
use MyApp\Chat;
   
 

    $server = IoServer::factory(
        new HttpServer(
            new WsServer(
                new Tracker()
            )
        ),
        8080
    );

    $server->run();

/*
// WebClient
$webSockClient = new React\Socket\Server('0.0.0.0:8080', $loop);

new Ratchet\Server\IoServer(
    new Ratchet\Http\HttpServer(
        new Ratchet\WebSocket\WsServer(
            $pusher
        )
    ),
    $webSockClient
);

$loop->run();
*/