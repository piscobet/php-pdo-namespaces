<?php
require_once 'vendor/autoload.php';

use App\Database;
use Shop\Cart;
use Shop\Emailer;

session_start();

$pdo = Database::getConnection();
$cart = new Cart();
$emailer = new Emailer();

// Get all products in the cart
$productIds = $cart->getProducts();
if (empty($productIds)) {
    echo "Cart is empty. <a href='index.php'>Back to Home</a>";
    exit;
}

// Fetch product details from the database
$stmt = $pdo->prepare("SELECT * FROM products WHERE id IN (" . implode(',', array_map('intval', $productIds)) . ")");
$stmt->execute();
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Prepare cart details as a string
$cartDetails = "Invoice:\n\n";
foreach ($products as $product) {
    $cartDetails .= "- " . $product['name'] . " ($" . $product['price'] . ")\n";
}
$cartDetails .= "\nTotal: $" . array_sum(array_column($products, 'price')) . "\n";

// Send the invoice via email
$recipient = $_SESSION['email'] ?? 'seventh.sky@gmail.com';
if ($emailer->sendCartDetails($recipient, $cartDetails)) {
    $cart->clearCart(); // Clear the cart after sending the invoice
    echo "Invoice sent successfully to $recipient. <a href='index.php'>Back to Home</a>";
} else {
    echo "Failed to send invoice. <a href='index.php'>Back to Home</a>";
}
?>
