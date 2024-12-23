<?php

namespace Shop;

class Cart {
    private array $products = [];

    public function addProduct(Product $product): void {
        $this->products[] = $product;
    }

    public function getProducts(): array {
        return $this->products;
    }

    public function getTotal(): float {
        return array_reduce($this->products, fn($sum, $product) => $sum + $product->getPrice(), 0.0);
    }

    public function getCartDetails(): string {
        $details = "Cart Details:\n";
        foreach ($this->products as $product) {
            $details .= "- " . $product->getName() . " (" . $product->getPrice() . " USD)\n";
        }
        $details .= "Total: " . $this->getTotal() . " USD\n";
        return $details;
    }
}
