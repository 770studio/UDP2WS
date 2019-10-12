<?php
 require dirname(__DIR__) . '/vendor/autoload.php';

$loop = React\EventLoop\Factory::create();

$context = new React\ZMQ\Context($loop);

$push = $context->getSocket(ZMQ::SOCKET_PUSH);
$push->connect('tcp://127.0.0.1:5555');
$push->send(6756856);
$loop->run();
/*
$i = 0;
$loop->addPeriodicTimer(1, function () use (&$i, $push) {
    $i++;
    echo "sending $i\n";
    $push->send($i);
});
$loop->run();
*/


EXIT;



$context = new ZMQContext();

//  Socket to talk to server
echo "Connecting to hello world server…\n";
$requester = new ZMQSocket($context, ZMQ::SOCKET_REQ);
$requester->connect("tcp://localhost:5555");

for ($request_nbr = 0; $request_nbr != 10; $request_nbr++) {
    printf ("Sending request %d…\n", $request_nbr);
    $requester->send("Hello");

   // $reply = $requester->recv();
   // printf ("Received reply %d: [%s]\n", $request_nbr, $reply);
}