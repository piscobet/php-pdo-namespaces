<?php

namespace Shop;

use PDO;

class Shop {
    private PDO $db;

    public function __construct(PDO $db) {
        $this->db = $db;
    }

    // Add a product to the database
    public function addProduct(string $name, float $price, ?string $description = null): bool {
        $stmt = $this->db->prepare("INSERT INTO products (name, price, description) VALUES (:name, :price, :description)");
        return $stmt->execute([
            ':name' => $name,
            ':price' => $price,
            ':description' => $description,
        ]);
    }

    // Retrieve all products from the database
    public function getProducts(): array {
        $stmt = $this->db->query("SELECT * FROM products ORDER BY created_at DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
