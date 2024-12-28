<?php

namespace User;

use PDO;
use Utils\Geolocator;

class User {
    private PDO $db;

    public function __construct(PDO $db) {
        $this->db = $db;
        session_start();
    }

    public function login(string $username, string $password): bool {
        $stmt = $this->db->prepare("SELECT id, password, is_admin FROM users WHERE username = :username");
        $stmt->execute([':username' => $username]);
        $user = $stmt->fetch();
    
        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $username;
            $_SESSION['is_admin'] = (bool) $user['is_admin']; // Store admin flag
            return true;
        }
    
        return false;
    }
    

    public function isLoggedIn(): bool {
        return isset($_SESSION['user_id']);
    }

    public function logout(): void {
        session_unset();
        session_destroy();
    }

    public function createUser(string $username, string $password, GeoLocator $geolocator): bool {
        $geoData = $geolocator->getGeoLocation("178.197.223.71");
        // Check if the username already exists
        $stmt = $this->db->prepare("SELECT id FROM users WHERE username = :username");
        $stmt->execute([':username' => $username]);
        if ($stmt->fetch()) {
            throw new \Exception("Username already exists.");
        }
    
        // Hash the password
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
    
        // Insert the new user into the database
        $stmt = $this->db->prepare("INSERT INTO users (username, password, country) VALUES (:username, :password, :country)");
        return $stmt->execute([
            ':username' => $username,
            ':password' => $hashedPassword,
            ':country' => $geoData["country"]
        ]);
    }
    
}
