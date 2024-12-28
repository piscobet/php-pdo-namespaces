<?php
require_once 'vendor/autoload.php';

use App\Database;
use User\User;
use Utils\GeoLocator;

$pdo = Database::getConnection();
$user = new User($pdo);
$geolocator = new GeoLocator();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    try {
        if ($user->createUser($username, $password, $geolocator)) {
            echo "Account created successfully! <a href='login.php'>Login here</a>";
        }
    } catch (Exception $e) {
        $error = $e->getMessage();
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Create Account -  <?php echo $data['country']; ?></title>
</head>
<body>
    <h1>Create Account - <?php echo $geolocator->getGeoLocation("178.197.223.71")["country"]; ?></h1>
    <?php if (!empty($error)): ?>
        <p style="color: red;"><?= htmlspecialchars($error); ?></p>
    <?php endif; ?>
    <form method="POST">
        <label>Username: <input type="text" name="username" required></label><br>
        <label>Password: <input type="password" name="password" required></label><br>
        <button type="submit">Create Account</button>
    </form>
</body>
</html>
