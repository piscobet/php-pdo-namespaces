<?php

require_once 'vendor/autoload.php';

use App\Database;
use User\User;

try {
    // Connect to the database
    $pdo = Database::getConnection();
    $user = new User($pdo);

    // Check if the user is logged in
    if ($user->isLoggedIn()) {
        echo "<h1>Welcome, " . htmlspecialchars($_SESSION['username']) . "!</h1>";
        echo "<a href='logout.php'>Logout</a>";

        // Existing functionality: Add products to the cart table
        // Products to insert
        $products = [
            ['product_name' => 'Laptop', 'product_price' => 999.99],
            ['product_name' => 'Mouse', 'product_price' => 25.50],
            ['product_name' => 'Keyboard', 'product_price' => 49.99],
        ];

        // Insert products into the cart table
        $stmt = $pdo->prepare("INSERT INTO cart (product_name, product_price) VALUES (:product_name, :product_price)");
        foreach ($products as $product) {
            $stmt->execute([
                ':product_name' => $product['product_name'],
                ':product_price' => $product['product_price'],
            ]);
        }

        echo "<p>Products added to the cart table successfully!</p>";
    } else {
        // If the user is not logged in, show a login prompt
        echo "<h1>You are not logged in.</h1>";
        echo "<a href='user-login.php'>Login here</a>";
    }
} catch (PDOException $e) {
    echo "Failed to add products: " . $e->getMessage();
}
