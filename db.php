<?php
// backend/config/db.php

// Check if running on Railway (has DATABASE_URL environment variable)
$db_url = getenv('DATABASE_URL') ?: getenv('MYSQL_URL');

if ($db_url) {
    // Railway provides a DATABASE_URL like: mysql://user:pass@host:port/dbname
    $db_config = parse_url($db_url);
    
    $host = $db_config['host'];
    $port = $db_config['port'];
    $dbname = ltrim($db_config['path'], '/');
    $username = $db_config['user'];
    $password = $db_config['pass'];
} else {
    // Local development
    $host = 'localhost';
    $port = 3306;
    $dbname = ecommerce_db; 
    $username = 'root';
    $password = '';
}

try {
    $pdo = new PDO("mysql:host=$host;port=$port;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    die(json_encode(["success" => false, "message" => "Database Connection Failed: " . $e->getMessage()]));
}
?>