<?php

require_once __DIR__ . '/vendor/autoload.php';

use Shop\Product;
use Shop\Cart;
use Shop\Emailer;

// Create a Cart instance
$cart = new Cart();

// Add products to the cart
$cart->addProduct(new Product('Laptop', 999.99));
$cart->addProduct(new Product('Mouse', 25.50));
$cart->addProduct(new Product('Keyboard', 49.99));

// Display cart details (for testing purposes)
echo $cart->getCartDetails();

// Send the cart details via email
$emailer = new Emailer();
$recipient = 'seventh.sky@gmail.com';

if ($emailer->sendCartDetails($recipient, $cart)) {
    echo "Cart details sent successfully to $recipient.\n";
} else {
    echo "Failed to send cart details.\n";
}
