<?php

namespace Shop;

use PDO;
use Utils\Logger;

class Shop {
    private PDO $db;
    private ?Logger $logger;

    public function __construct(PDO $db, Logger $logger = null) {
        $this->db = $db;
        $this->logger = $logger;
    }

    // Add a product to the database
    public function addProduct(string $name, float $price, ?string $description = null): bool {
        $stmt = $this->db->prepare("INSERT INTO products (name, price, description) VALUES (:name, :price, :description)");
        $success = $stmt->execute([
            ':name' => $name,
            ':price' => $price,
            ':description' => $description,
        ]);

        if($success && $this->logger):
            $this->logger->log("Product added $name ($price)");
        endif;
        
        return $success;
    }

    // Retrieve all products from the database
    public function getProducts(): array {
        $stmt = $this->db->query("SELECT * FROM products ORDER BY created_at DESC");
        if($this->logger):
            $this->logger->log("all products getted");
        endif;
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function cartChecker(string $hashcheck): string {
        return password_hash($hashcheck, PASSWORD_BCRYPT);
    }
}
