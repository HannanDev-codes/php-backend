<?php
header("Content-Type: application/json");
require '../config/db.php';

try {
    $stmt = $pdo->query("SELECT 'Connected successfully' as message, NOW() as time");
    $result = $stmt->fetch();
    
    echo json_encode([
        "success" => true,
        "message" => $result['message'],
        "timestamp" => $result['time'],
        "database_info" => [
            "host" => $pdo->getAttribute(PDO::ATTR_CONNECTION_STATUS),
            "server_version" => $pdo->getAttribute(PDO::ATTR_SERVER_VERSION)
        ]
    ]);
} catch (Exception $e) {
    echo json_encode([
        "success" => false,
        "message" => "Connection failed: " . $e->getMessage()
    ]);
}
?>