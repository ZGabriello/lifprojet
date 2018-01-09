<?php
// myapp\src\yourBundle\Sockets\Chat.php;

// Change the namespace according to your bundle, and that's all !
namespace OC\PlatformBundle\Sockets;

use \PDO;
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;
use OC\PlatformBundle\Entity\Tchat;

class Chat implements MessageComponentInterface {
    protected $clients;

    public function __construct() {
        $this->clients = new \SplObjectStorage;
    }

    public function onOpen(ConnectionInterface $conn) {
        // Store the new connection to send messages to later
        $this->clients->attach($conn);

        echo "New connection! ({$conn->resourceId})\n";
    }

    public function onMessage(ConnectionInterface $from, $msg) {
        $numRecv = count($this->clients) - 1;
        echo sprintf('Connection %d sending message "%s" to %d other connection%s' . "\n"
            , $from->resourceId, $msg, $numRecv, $numRecv == 1 ? '' : 's');

        foreach ($this->clients as $client) {
            if ($from !== $client) {
                // The sender is not the receiver, send to each client connected
                $client->send($msg);
            }
        }
         $pseudo  = $msg;
$test = preg_replace('/{"username":"/', '', $pseudo, 1);
$nom = strstr($test, '","message', true); 
echo 'Pseudo';
echo $nom;
$message = strstr($test, ':');
$test = preg_replace('/:"/','', $message, 1);
$message = strstr($test, '"}',true);
echo 'Message';
echo $message;
 try
{
	$bdd = new PDO('mysql:host=localhost;dbname=symfony;charset=utf8', 'root', '');
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}

$req = $bdd->prepare('INSERT INTO tchat(message, pseudo,date) VALUES(:message, :pseudo,NOW())');
$req->execute(array(
	'message' => $message,
	'pseudo' => $nom
	));
    }

    public function onClose(ConnectionInterface $conn) {
        // The connection is closed, remove it, as we can no longer send it messages
        $this->clients->detach($conn);

        echo "Connection {$conn->resourceId} has disconnected\n";
    }

    public function onError(ConnectionInterface $conn, \Exception $e) {
        echo "An error has occurred: {$e->getMessage()}\n";

        $conn->close();
    }
}