<?php

namespace App\WebSocket;

use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

class NotificationServer implements MessageComponentInterface
{
    protected $clients;
    protected $subscriptions;

    public function __construct()
    {
        $this->clients = new \SplObjectStorage;
        $this->subscriptions = [];
    }

    public function onOpen(ConnectionInterface $conn)
    {
        $this->clients->attach($conn);
        $conn->send(json_encode([
            'type' => 'connection',
            'message' => 'Connected to notification server',
            'clientId' => $conn->resourceId
        ]));
        
        echo "New connection! ({$conn->resourceId})\n";
    }

    public function onMessage(ConnectionInterface $from, $msg)
    {
        $data = json_decode($msg, true);
        
        if (!$data) {
            return;
        }

        switch ($data['type']) {
            case 'subscribe':
                $this->handleSubscribe($from, $data);
                break;
            
            case 'unsubscribe':
                $this->handleUnsubscribe($from, $data);
                break;
            
            case 'broadcast':
                $this->handleBroadcast($data);
                break;
                
            default:
                echo "Unknown message type: {$data['type']}\n";
        }
    }

    protected function handleSubscribe(ConnectionInterface $conn, $data)
    {
        $channel = $data['channel'] ?? 'general';
        
        if (!isset($this->subscriptions[$channel])) {
            $this->subscriptions[$channel] = new \SplObjectStorage;
        }
        
        $this->subscriptions[$channel]->attach($conn);
        
        $conn->send(json_encode([
            'type' => 'subscribed',
            'channel' => $channel,
            'message' => "Subscribed to {$channel}"
        ]));
        
        echo "Client {$conn->resourceId} subscribed to {$channel}\n";
    }

    protected function handleUnsubscribe(ConnectionInterface $conn, $data)
    {
        $channel = $data['channel'] ?? 'general';
        
        if (isset($this->subscriptions[$channel])) {
            $this->subscriptions[$channel]->detach($conn);
        }
        
        echo "Client {$conn->resourceId} unsubscribed from {$channel}\n";
    }

    protected function handleBroadcast($data)
    {
        $channel = $data['channel'] ?? 'general';
        $message = $data['message'] ?? [];
        
        if (!isset($this->subscriptions[$channel])) {
            return;
        }
        
        $notification = json_encode([
            'type' => 'notification',
            'channel' => $channel,
            'data' => $message,
            'timestamp' => time()
        ]);
        
        foreach ($this->subscriptions[$channel] as $client) {
            $client->send($notification);
        }
        
        echo "Broadcast to {$channel}: " . json_encode($message) . "\n";
    }

    public function onClose(ConnectionInterface $conn)
    {
        $this->clients->detach($conn);
        
        // Remove from all subscriptions
        foreach ($this->subscriptions as $channel => $clients) {
            if ($clients->contains($conn)) {
                $clients->detach($conn);
            }
        }
        
        echo "Connection {$conn->resourceId} has disconnected\n";
    }

    public function onError(ConnectionInterface $conn, \Exception $e)
    {
        echo "An error has occurred: {$e->getMessage()}\n";
        $conn->close();
    }
}
