# WebSocket Real-time Notifications - Setup Guide

This guide explains how to set up and use the WebSocket real-time notification system.

## 🚀 Quick Start

### 1. Start the WebSocket Server

Open a terminal and run:

```bash
cd c:/xampp/htdocs/resturant_managment
php websocket-server.php
```

You should see:
```
WebSocket server started on port 8080
Listening for connections...
```

**Keep this terminal open** - the WebSocket server needs to run continuously.

### 2. Include Notifications in Your Views

Add this to your admin layout or individual pages:

```php
<script src="<?= base_url('js/notifications.js') ?>"></script>
<?php include(APPPATH . 'Views/Admin/includes/websocket_integration.php'); ?>
```

### 3. Send Notifications from Controllers

```php
use App\Libraries\WebSocketClient;

// In your controller method
$wsClient = new WebSocketClient();

// New order notification
$wsClient->notifyNewOrder($orderId, $orderData);

// Order status change
$wsClient->notifyOrderStatusChange($orderId, 'Preparing');

// New reservation
$wsClient->notifyNewReservation($reservationId, $reservationData);

// Low stock alert
$wsClient->notifyLowStock($itemId, $itemName, $quantity);

// KDS update
$wsClient->notifyKDS($orderId, 'Order ready');
```

## 📡 Available Channels

- **orders** - New orders, status changes
- **reservations** - New reservations, updates
- **inventory** - Low stock alerts
- **kds** - Kitchen display updates

## 🎨 Notification Types

### 1. Toast Notifications
Automatically displayed for all events with color-coded styling.

### 2. Browser Notifications
Requires user permission. Automatically requested on page load.

### 3. Sound Alerts
Optional sound effects for critical events (new orders, reservations).

## 🔧 Configuration

### Change WebSocket Port

Edit `websocket-server.php`:
```php
$server = IoServer::factory(
    new HttpServer(
        new WsServer(
            new NotificationServer()
        )
    ),
    8080  // Change this port
);
```

Also update in `public/js/notifications.js`:
```javascript
this.ws = new WebSocket('ws://localhost:8080');  // Update port here
```

### Customize Notification Display

Edit `public/js/notifications.js` in the `displayNotification()` method to customize:
- Icons
- Colors
- Messages
- Sound effects

## 🧪 Testing

### Test from Browser Console

```javascript
// Subscribe to a channel
notificationManager.subscribe('orders');

// Send a test notification (from PHP)
$wsClient = new WebSocketClient();
$wsClient->send([
    'type' => 'broadcast',
    'channel' => 'orders',
    'message' => [
        'event' => 'new_order',
        'order_id' => 123,
        'data' => ['test' => 'data']
    ]
]);
```

## 🐛 Troubleshooting

### Connection Failed

1. **Check if WebSocket server is running**
   ```bash
   netstat -an | findstr :8080
   ```

2. **Firewall blocking port 8080**
   - Add firewall exception for port 8080

3. **Port already in use**
   - Change to a different port (see Configuration)

### Notifications Not Appearing

1. **Check browser console** for errors
2. **Verify subscription** to correct channel
3. **Check WebSocket connection** status in browser DevTools → Network → WS

### Browser Notifications Not Working

1. **Check permission** - should be "granted"
   ```javascript
   console.log(Notification.permission);
   ```

2. **Request permission** manually
   ```javascript
   Notification.requestPermission();
   ```

## 🚀 Production Deployment

### Using Supervisor (Linux)

Create `/etc/supervisor/conf.d/websocket.conf`:

```ini
[program:restaurant-websocket]
command=php /var/www/restaurant/websocket-server.php
directory=/var/www/restaurant
autostart=true
autorestart=true
user=www-data
redirect_stderr=true
stdout_logfile=/var/log/websocket.log
```

Start:
```bash
sudo supervisorctl reread
sudo supervisorctl update
sudo supervisorctl start restaurant-websocket
```

### Using PM2 (Alternative)

```bash
pm2 start websocket-server.php --name restaurant-ws --interpreter php
pm2 save
pm2 startup
```

### Nginx Proxy (Optional)

```nginx
location /ws {
    proxy_pass http://localhost:8080;
    proxy_http_version 1.1;
    proxy_set_header Upgrade $http_upgrade;
    proxy_set_header Connection "upgrade";
    proxy_set_header Host $host;
}
```

## 📊 Monitoring

### Check Active Connections

The WebSocket server logs all connections and messages to the console.

### Performance Tips

1. **Limit notification frequency** - Don't send too many notifications
2. **Use specific channels** - Subscribe only to needed channels
3. **Clean up subscriptions** - Unsubscribe when leaving pages

## 🔐 Security Considerations

1. **Authentication** - Add token-based auth for production
2. **SSL/TLS** - Use `wss://` instead of `ws://` in production
3. **Rate limiting** - Prevent notification spam
4. **Input validation** - Sanitize all notification data

## 📚 API Reference

### Client-Side Methods

```javascript
// Connection
notificationManager.connect()
notificationManager.disconnect()

// Subscriptions
notificationManager.subscribe('channel_name')
notificationManager.unsubscribe('channel_name')

// Event handlers
notificationManager.on('channel:event', callback)

// Manual notifications
notificationManager.showToast(message, type, icon, title)
```

### Server-Side Methods

```php
$wsClient = new WebSocketClient();

// Send custom notification
$wsClient->send([
    'type' => 'broadcast',
    'channel' => 'custom_channel',
    'message' => ['your' => 'data']
]);
```

## 🎯 Examples

See `app/Views/Admin/includes/websocket_integration.php` for complete integration examples.

---

**Need Help?** Check the logs in the WebSocket server terminal for debugging information.
