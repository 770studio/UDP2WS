<?php
    require dirname(__DIR__) . '/vendor/autoload.php';

$loop = React\EventLoop\Factory::create();

$context = new React\ZMQ\Context($loop);

$pull = $context->getSocket(ZMQ::SOCKET_PULL);
$pull->bind('tcp://127.0.0.1:5555');

$pull->on('error', function ($e) {
    var_dump($e->getMessage());
});

$pull->on('message', function ($msg) {
    echo "Received: $msg\n";
	 
	 \Ratchet\Client\connect('ws://localhost:8080')->then(function($conn) use ( $msg ) {
 
			 var_dump(555555, $msg ); EXIT;
			$conn->send( 'gg66vvvvvvvvvvvvvvvv78888888888');
			}, function ($e) {
				echo "Could not connect: {$e->getMessage()}\n";
			});

	
	
});

$loop->run();


EXIT;

	/*   
		The server waits for messages from the client
		and echoes back the received message
	*/
	//$server = new ZMQSocket(new ZMQContext(), ZMQ::SOCKET_REP);
	$server = new ZMQSocket(new ZMQContext(), ZMQ::SOCKET_REQ);
	//$server->bind("tcp://127.0.0.1:5555");
	$server->connect("tcp://localhost:5555");

	/* Loop receiving and echoing back */
	while ($message = $server->recv() ) {
		echo "Got message: $message\n";
		/* echo back the message */
		/**
			 \Ratchet\Client\connect('ws://localhost:8080')->then(function($conn) use ($message ) {
		 
			$conn->on('message', function($msg) use ($conn) {
				echo "Received: {$msg}\n";
				$conn->close();
			});
		 
			 //var_dump(555555, $message ); EXIT;
			$conn->send( 'gg66vvvvvvvvvvvvvvvv78888888888');
			}, function ($e) {
				echo "Could not connect: {$e->getMessage()}\n";
			});

			*/
	}



EXIT;


    $loop   = React\EventLoop\Factory::create();
    $pusher = new MyApp\Pusher;

    // Listen for the web server to make a ZeroMQ push after an ajax request
    $context = new React\ZMQ\Context($loop);
    $pull = $context->getSocket(ZMQ::SOCKET_PULL);
    $pull->bind('tcp://127.0.0.1:5555'); // Binding to 127.0.0.1 means the only client that can connect is itself
    $pull->on('message', array($pusher, 'onBlogEntry'));

    // Set up our WebSocket server for clients wanting real-time updates
    $webSock = new React\Socket\Server('0.0.0.0:8080', $loop); // Binding to 0.0.0.0 means remotes can connect
    $webServer = new Ratchet\Server\IoServer(
        new Ratchet\Http\HttpServer(
            new Ratchet\WebSocket\WsServer(
                new Ratchet\Wamp\WampServer(
                    $pusher
                )
            )
        ),
        $webSock
    );

    $loop->run();
	
 
	
	
	
	