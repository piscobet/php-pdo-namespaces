<?php
require_once 'vendor/autoload.php';

use App\Database;
use Shop\Shop;

$pdo = Database::getConnection();
$shop = new Shop($pdo);

$products = $shop->getProducts();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Products List</title>
</head>
<body>
    <h1>Products List</h1>
    <?php if (count($products) > 0): ?>
        <ul>
            <?php foreach ($products as $product): ?>
                <li>
                    <strong><?= htmlspecialchars($product['name']); ?></strong><br>
                    Price: $<?= htmlspecialchars(number_format($product['price'], 2)); ?><br>
                    Description: <?= htmlspecialchars($product['description']); ?><br>
                    Added on: <?= htmlspecialchars($product['created_at']); ?>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>No products found.</p>
    <?php endif; ?>
    <a href="index.php">Back to Home</a>
</body>
</html>
