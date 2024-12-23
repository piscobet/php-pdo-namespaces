<?php

require_once 'vendor/autoload.php';

use App\Database;
use User\User;

$pdo = Database::getConnection();
$user = new User($pdo);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    try {
        if ($user->createUser($username, $password)) {
            echo "User created successfully! <a href='user-login.php'>Login here</a>";
        } else {
            echo "Failed to create user.";
        }
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Create User</title>
</head>
<body>
    <h1>Create a New User</h1>
    <form method="POST" action="user-create.php">
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" required>
        <br>
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required>
        <br>
        <button type="submit">Create User</button>
    </form>
</body>
</html>
