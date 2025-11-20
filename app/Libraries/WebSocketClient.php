<?php

namespace App\Libraries;

class WebSocketClient
{
    protected $host;
    protected $port;

    public function __construct($host = 'localhost', $port = 8080)
    {
        $this->host = $host;
        $this->port = $port;
    }

    public function send($data)
    {
        try {
            $socket = @fsockopen($this->host, $this->port, $errno, $errstr, 5);
            
            if (!$socket) {
                error_log("WebSocket connection failed: $errstr ($errno)");
                return false;
            }

            $message = json_encode($data);
            $header = "GET / HTTP/1.1\r\n";
            $header .= "Host: {$this->host}:{$this->port}\r\n";
            $header .= "Upgrade: websocket\r\n";
            $header .= "Connection: Upgrade\r\n";
            $header .= "Sec-WebSocket-Key: " . base64_encode(random_bytes(16)) . "\r\n";
            $header .= "Sec-WebSocket-Version: 13\r\n";
            $header .= "\r\n";

            fwrite($socket, $header);
            fwrite($socket, $this->encode($message));
            fclose($socket);

            return true;
        } catch (\Exception $e) {
            error_log("WebSocket send error: " . $e->getMessage());
            return false;
        }
    }

    protected function encode($message)
    {
        $length = strlen($message);
        $header = chr(0x81); // Text frame

        if ($length <= 125) {
            $header .= chr($length);
        } elseif ($length <= 65535) {
            $header .= chr(126) . pack('n', $length);
        } else {
            $header .= chr(127) . pack('J', $length);
        }

        return $header . $message;
    }

    public function notifyNewOrder($orderId, $orderData)
    {
        return $this->send([
            'type' => 'broadcast',
            'channel' => 'orders',
            'message' => [
                'event' => 'new_order',
                'order_id' => $orderId,
                'data' => $orderData
            ]
        ]);
    }

    public function notifyOrderStatusChange($orderId, $status)
    {
        return $this->send([
            'type' => 'broadcast',
            'channel' => 'orders',
            'message' => [
                'event' => 'order_status_changed',
                'order_id' => $orderId,
                'status' => $status
            ]
        ]);
    }

    public function notifyNewReservation($reservationId, $reservationData)
    {
        return $this->send([
            'type' => 'broadcast',
            'channel' => 'reservations',
            'message' => [
                'event' => 'new_reservation',
                'reservation_id' => $reservationId,
                'data' => $reservationData
            ]
        ]);
    }

    public function notifyLowStock($itemId, $itemName, $quantity)
    {
        return $this->send([
            'type' => 'broadcast',
            'channel' => 'inventory',
            'message' => [
                'event' => 'low_stock',
                'item_id' => $itemId,
                'item_name' => $itemName,
                'quantity' => $quantity
            ]
        ]);
    }

    public function notifyKDS($orderId, $action)
    {
        return $this->send([
            'type' => 'broadcast',
            'channel' => 'kds',
            'message' => [
                'event' => 'kds_update',
                'order_id' => $orderId,
                'action' => $action
            ]
        ]);
    }
}
