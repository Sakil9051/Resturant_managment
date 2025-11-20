<?php
// Direct database connection to create notifications table
$host = 'localhost';
$database = 'restaurant_db';
$username = 'root';
$password = 'Techm@123';
$port = 3306;

try {
    $conn = new mysqli($host, $username, $password, $database, $port);
    
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    $sql = "CREATE TABLE IF NOT EXISTS `notifications` (
      `id` int(11) NOT NULL AUTO_INCREMENT,
      `user_id` int(11) DEFAULT NULL,
      `type` varchar(50) NOT NULL,
      `title` varchar(255) NOT NULL,
      `message` text NOT NULL,
      `data` text DEFAULT NULL,
      `is_read` tinyint(1) DEFAULT 0,
      `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
      PRIMARY KEY (`id`),
      KEY `user_id` (`user_id`),
      KEY `is_read` (`is_read`),
      KEY `created_at` (`created_at`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
    
    if ($conn->query($sql) === TRUE) {
        echo "✅ SUCCESS: Notifications table created successfully!\n";
    } else {
        echo "❌ ERROR: " . $conn->error . "\n";
    }
    
    $conn->close();
    
} catch (Exception $e) {
    echo "❌ ERROR: " . $e->getMessage() . "\n";
}
?>
