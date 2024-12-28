<?php
require_once 'vendor/autoload.php';

use App\Database;
use Shop\Shop;
use Utils\Logger;

$pdo = Database::getConnection();
$logger = new Logger('app.log');
$shop = new Shop($pdo, $logger);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $price = (float) ($_POST['price'] ?? 0);
    $description = $_POST['description'] ?? null;

    if ($shop->addProduct($name, $price, $description)) {
        echo "Product added successfully! <a href='index.php'>Back to Home</a>";
        exit;
    } else {
        echo "Failed to add product.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Product</title>
</head>
<body>
    <h1>Add a New Product</h1>
    <form method="POST" action="add-product.php">
        <label for="name">Product Name:</label>
        <input type="text" id="name" name="name" required><br>
        
        <label for="price">Price:</label>
        <input type="number" step="0.01" id="price" name="price" required><br>
        
        <label for="description">Description:</label>
        <textarea id="description" name="description"></textarea><br>
        
        <button type="submit">Add Product</button>
    </form>
</body>
</html>
