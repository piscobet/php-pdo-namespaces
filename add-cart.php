<?php
require_once 'vendor/autoload.php';

use App\Database;
use Shop\Cart;

$pdo = Database::getConnection();
$cart = new Cart();

// Fetch all products
$stmt = $pdo->query("SELECT * FROM products ORDER BY created_at DESC");
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $selectedProducts = $_POST['product_ids'] ?? [];

    foreach ($selectedProducts as $productId) {
        $cart->addProduct((int)$productId);
    }

    echo "Products added to cart! <a href='index.php'>Back to Home</a>";
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Products to Cart</title>
</head>
<body>
    <h1>Select Products to Add to Cart</h1>
    <form method="POST">
        <?php foreach ($products as $product): ?>
            <div>
                <input type="checkbox" name="product_ids[]" value="<?= $product['id']; ?>">
                <?= htmlspecialchars($product['name']); ?> - $<?= htmlspecialchars($product['price']); ?>
            </div>
        <?php endforeach; ?>
        <button type="submit">Add to Cart</button>
    </form>
</body>
</html>
