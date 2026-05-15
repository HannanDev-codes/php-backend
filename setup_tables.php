<?php
header("Content-Type: application/json");
require '../config/db.php';

$sqls = [
    "CREATE TABLE IF NOT EXISTS users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(100) NOT NULL UNIQUE,
        email VARCHAR(255) NOT NULL UNIQUE,
        password VARCHAR(255) NOT NULL,
        role ENUM('user', 'admin') DEFAULT 'user',
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )",
    
    "CREATE TABLE IF NOT EXISTS products (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(255) NOT NULL,
        price DECIMAL(10,2) NOT NULL,
        image VARCHAR(500),
        description TEXT,
        category VARCHAR(100),
        stock INT DEFAULT 10,
        supplier VARCHAR(100),
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )",
    
    "INSERT IGNORE INTO users (username, email, password, role) 
     VALUES ('admin', 'admin@ecommercestore.com', '\$2y\$10\$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin')"
];

$results = [];

foreach ($sqls as $sql) {
    try {
        $pdo->exec($sql);
        $results[] = ["success" => true, "sql" => substr($sql, 0, 50) . "..."];
    } catch (Exception $e) {
        $results[] = ["success" => false, "error" => $e->getMessage()];
    }
}

echo json_encode([
    "success" => true,
    "message" => "Setup completed",
    "results" => $results
]);
?>