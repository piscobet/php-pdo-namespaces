<?php

namespace Shop;

class Cart {
    public function __construct() {
        if (!isset($_SESSION)) {
            session_start();
        }
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }
    }

    // Add product to cart
    public function addProduct(int $productId): void {
        if (!in_array($productId, $_SESSION['cart'])) {
            $_SESSION['cart'][] = $productId;
        }
    }

    // Get all product IDs in the cart
    public function getProducts(): array {
        return $_SESSION['cart'];
    }

    // Clear the cart
    public function clearCart(): void {
        $_SESSION['cart'] = [];
    }
}
