<?php 

 





require dirname(__DIR__) . '/vendor/autoload.php';

 



   
   
$loop = React\EventLoop\Factory::create();
$factory = new React\Datagram\Factory($loop);
$factory->createServer('0.0.0.0:20000')->then(function (React\Datagram\Socket $server) {
    $server->on('message', function($message, $address, $server) {
        //$server->send('hello ' . $address . '! echo: ' . $message, $address);
        echo 'client555 ' . $address . ': ' . $message .  PHP_EOL;
		//file_put_contents('test.log', time() );
	 
		//var_dump(__DIR__ . "./websocket_client.php"); exit;
		require_once __DIR__ . "/websocket_client.php";
		$server = 'localhost';
		echo "Connecting to server: $server \n";
		if( $sp = websocket_open($server, 8080,'',$errstr) ) {
		  echo "Sending message to server: '$message' \n";
		  websocket_write($sp,$message);
		  echo "Server responed with: '" . websocket_read($sp,$errstr) ."'\n";
		}else {
		  echo "Failed to connect to server\n";
		  echo "Server responed with: $errstr\n";
		}

		/*
		 
			//use PhpAmqpLib\Connection\AMQPStreamConnection;
			//use PhpAmqpLib\Message\AMQPMessage;

			$connection = new \PhpAmqpLib\Connection\AMQPStreamConnection('localhost', 5672, 'guest', 'guest');
			$channel = $connection->channel();

			$channel->queue_declare('hello', false, false, false, false);

			$msg = new \PhpAmqpLib\Message\AMQPMessage( $message );
			$channel->basic_publish($msg, '', 'hello');
		
		
		
		
		
		 Create new queue object */
		//$queue = new ZMQSocket(new ZMQContext(), ZMQ::SOCKET_PUB);
		//$queue->connect("tcp://127.0.0.1:5555");
		//var_dump( $queue->send( $message ) );
		/*
		$loop = React\EventLoop\Factory::create();
		$context = new React\ZMQ\Context($loop);
		$push = $context->getSocket(ZMQ::SOCKET_PUSH);
		$push->connect('tcp://127.0.0.1:5555');
		$push->send( $message  );
		$loop->run();
		
		
		
		
		$connection = \Ratchet\Client\connect('ws://127.0.0.1:8080')->then(function($conn) {
			$conn->on('message', function($msg) use ($conn) {
				echo "Received: {$msg}\n";
				$conn->close();
			});

			$conn->send('{"command": "update_data", "user": "tester01"}');
			$conn->close();

		}, function ($e) {
			echo "Could not connect: {$e->getMessage()}\n";
		});
		
		
		*/
		

    });
});
$loop->run();


 



 
//$tracker->update_clients($message);


 EXIT;

 \Ratchet\Client\connect('ws://ds.cucos.de/design:8080')->then(function($conn) use ($message ) {
		/*
        $conn->on('message', function($msg) use ($conn) {
            echo "Received: {$msg}\n";
            $conn->close();
        });
		*/
		 //var_dump(555555, $message ); EXIT;
        $conn->send( 'gg66vvvvvvvvvvvvvvvv78888888888');
    }, function ($e) {
        echo "Could not connect: {$e->getMessage()}\n";
    });
	


set_time_limit(500);
 

 
$port= 20000;


 
 
//Reduce errors
error_reporting(~E_WARNING);

//Create a UDP socket
if(!($sock = socket_create(AF_INET, SOCK_DGRAM, 0)))
{
	$errorcode = socket_last_error();
    $errormsg = socket_strerror($errorcode);
    
    die("Couldn't create socket: [$errorcode] $errormsg \n");
}

echo "Socket created \n";

// Bind the source address
if( !socket_bind($sock, "localhost" , $port ) )
{
	$errorcode = socket_last_error();
    $errormsg = socket_strerror($errorcode);
    
    die("Could not bind socket : [$errorcode] $errormsg \n");
}

echo "Socket bind OK \n";

//Do some communication, this loop can handle multiple clients
while(1)
{
	echo "Waiting for data ... \n";
	
	//Receive some data
	$r = socket_recvfrom($sock, $buf, 32768, 0, $remote_ip, $remote_port);
	echo "$remote_ip : $remote_port -- " . $buf;
	
	//Send back the data to the client
	socket_sendto($sock, "OK " . $buf , 100 , 0 , $remote_ip , $remote_port);
}

socket_close($sock);
