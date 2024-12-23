<?php

require_once 'vendor/autoload.php';

use App\Database;

try {
    $pdo = Database::getConnection();

    // Test a query
    $stmt = $pdo->query('SELECT DATABASE()');
    $result = $stmt->fetch();

    echo "Connected to database: " . $result['DATABASE()'] . "\n";

} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage() . "\n";
}
