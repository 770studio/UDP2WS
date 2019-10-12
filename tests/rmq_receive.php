<?php
require_once __DIR__ . '/vendor/autoload.php';




 \Ratchet\Client\connect('ws://localhost:8080')->then(function($conn)   {
		/*
        $conn->on('message', function($msg) use ($conn) {
            echo "Received: {$msg}\n";
            $conn->close();
        });
		*/
		 //var_dump(555555, $message ); EXIT;
        $conn->send(  '666666655555555hhhhhhhh999999999999977777777');
    }, function ($e) {
        echo "Could not connect: {$e->getMessage()}\n";
    });
	
	
	
	exit;



use PhpAmqpLib\Connection\AMQPStreamConnection;
$connection = new AMQPStreamConnection('localhost', 5672, 'guest', 'guest');
$channel = $connection->channel();
$channel->queue_declare('hello', false, false, false, false);
echo " [*] Waiting for messages. To exit press CTRL+C\n";
$callback = function ($msg) {
   
	$message = $msg->body;
	
 
	
	
	
	 echo ' [x] Received ', $message , "\n";
	
	
	
};
$channel->basic_consume('hello', '', false, true, false, false, $callback);
while ($channel->is_consuming()) {
    $channel->wait();
}
$channel->close();
$connection->close();
?>