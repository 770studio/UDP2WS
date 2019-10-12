<?php



 
    // post.php ???
    // This all was here before  ;)
    $entryData = array(
        'category' => 'kittensCategory' 
      , 'title'    =>  'title'
      , 'article'  => 3333333333333
      , 'when'     => time()
    );

 

    // This is our new stuff
    $context = new ZMQContext();
    $socket = $context->getSocket(ZMQ::SOCKET_PUSH, 'my pusher');
    $socket->connect("tcp://localhost:5555");

    $socket->send(json_encode($entryData));


EXIT ;






/*
	Simple php udp socket client
*/

//Reduce errors
error_reporting(~E_WARNING);

$server = '127.0.0.1';
$port = 20000;
$input = '455559999999';

if(!($sock = socket_create(AF_INET, SOCK_DGRAM, 0)))
{
	$errorcode = socket_last_error();
    $errormsg = socket_strerror($errorcode);
    
    die("Couldn't create socket: [$errorcode] $errormsg \n");
}

echo "Socket created \n";

	//Send the message to the server
	if( ! socket_sendto($sock, $input , strlen($input) , 0 , $server , $port))
	{
		$errorcode = socket_last_error();
		$errormsg = socket_strerror($errorcode);
		
		die("Could not send data: [$errorcode] $errormsg \n");
	}




EXIT;

if(!($sock = socket_create(AF_INET, SOCK_DGRAM, 0)))
{
	$errorcode = socket_last_error();
    $errormsg = socket_strerror($errorcode);
    
    die("Couldn't create socket: [$errorcode] $errormsg \n");
}

echo "Socket created \n";

//Communication loop
while(1)
{
	//Take some input to send
	echo 'Enter a message to send : ';
	$input = fgets(STDIN);
	
	//Send the message to the server
	if( ! socket_sendto($sock, $input , strlen($input) , 0 , $server , $port))
	{
		$errorcode = socket_last_error();
		$errormsg = socket_strerror($errorcode);
		
		die("Could not send data: [$errorcode] $errormsg \n");
	}
		
	//Now receive reply from server and print it
	if(socket_recv ( $sock , $reply , 2045 , MSG_WAITALL ) === FALSE)
	{
		$errorcode = socket_last_error();
		$errormsg = socket_strerror($errorcode);
		
		die("Could not receive data: [$errorcode] $errormsg \n");
	}
	
	echo "Reply : $reply";
}




EXIT;





require_once __DIR__.'/../vendor/autoload.php';
$loop = React\EventLoop\Factory::create();
$factory = new React\Datagram\Factory($loop);
$factory->createClient('127.0.0.1:20000')->then(function (React\Datagram\Socket $client) use ($loop) {
    $client->send('first');
    $client->on('message', function($message, $serverAddress, $client) {
        echo 'received "' . $message . '" from ' . $serverAddress. PHP_EOL;
    });
    $client->on('error', function($error, $client) {
        echo 'error: ' . $error->getMessage() . PHP_EOL;
    });
    $n = 0;
	if($n > 10) EXIT;
    $tid = $loop->addPeriodicTimer(2.0, function() use ($client, &$n) {
        $client->send('tick' . ++$n);
    });
    // read input from STDIN and forward everything to server
    $loop->addReadStream(STDIN, function () use ($client, $loop, $tid) {
        $msg = fgets(STDIN, 2000);
        if ($msg === false) {
            // EOF => flush client and stop perodic sending and waiting for input
            $client->end();
            $loop->cancelTimer($tid);
            $loop->removeReadStream(STDIN);
        } else {
            $client->send(trim($msg));
        }
    });
}, function($error) {
    echo 'ERROR: ' . $error->getMessage() . PHP_EOL;
});
$loop->run();