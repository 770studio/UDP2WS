<?php
namespace MyApp;
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

class Tracker2 implements MessageComponentInterface {
    protected $clients;
	public $DisplayGroupIds;

    public function __construct() {
        $this->clients = new \SplObjectStorage;

    }

	public function update_clients($msg) {
		
		 foreach ($this->clients as $client) {
            $client->send($msg);
        }
	}
    public function onOpen(ConnectionInterface $conn) {
        // Store the new connection to send messages to later
        $this->clients->attach($conn);
		
	    parse_str( $conn->httpRequest->getUri()->getQuery() , $data );
		
		if($data['groups']) $this->DisplayGroupIds = explode(',', $data['group']);
		
		
			//$conn->send(. "\n 999999999999");
		 
        echo "New connection! ({$conn->resourceId})\n"   ;
    }

    public function onMessage(ConnectionInterface $from, $msg) {
		/*
        $numRecv = count($this->clients) - 1;
        echo sprintf('Connection %d sending message "%s" to %d other connection%s' . "\n"
            , $from->resourceId, $msg, $numRecv, $numRecv == 1 ? '' : 's');
		*/
        foreach ($this->clients as $client) {
            if ($from !== $client) {
 
				if($this->DisplayGroupIds) { // if a display has no group id, it would reiceive all the msgs.
						list($dGroup, $msg)  = sscanf($msg, "%d-%d");
						if( !in_array($dGroup, $this->DisplayGroupIds)   )  continue;
				}
			
                
                $client->send($msg);
            }
        }
		
    }

    public function onClose(ConnectionInterface $conn) {
        // The connection is closed, remove it, as we can no longer send it messages
        $this->clients->detach($conn);

       // echo "Connection {$conn->resourceId} has disconnected\n";
    }

    public function onError(ConnectionInterface $conn, \Exception $e) {
        echo "An error has occurred: {$e->getMessage()}\n";

        $conn->close();
    }
}