echo ^<?php
$database_url = getenv('DATABASE_URL');
if ($database_url) {
    $db_config = parse_url($database_url);
    $host = $db_config['host'];
    $port = $db_config['port'];
    $dbname = ltrim($db_config['path'], '/');
    $username = $db_config['user'];
    $password = $db_config['pass'];
} else {
    $host = 'localhost';
    $port = 3306;
    $dbname = 'railway';
    $username = 'root';
    $password = '';
}
try {
    $pdo = new PDO("mysql:host=$host;port=$port;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die(json_encode(['success' => false, 'message' => 'DB Connection Failed: ' . $e->getMessage()]));
}
?^> > config/db.php