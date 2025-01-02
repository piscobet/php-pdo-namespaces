<?php
require_once 'vendor/autoload.php';

use App\Database;
use User\User;
use Utils\GeoLocator;

$pdo = Database::getConnection();
$user = new User($pdo);
$geolocator = new GeoLocator();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //$username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    try {
        if ($user->editUser($_SESSION['user_id'], $password)) {
            echo "Account edited successfully!";
        }
    } catch (Exception $e) {
        $error = $e->getMessage();
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Account -  <?php echo $data['country']; ?></title>
</head>
<body>
    <h1>Edit Account - <?php echo $_SESSION['username']; ?></h1>
    <?php if (!empty($error)): ?>
        <p style="color: red;"><?= htmlspecialchars($error); ?></p>
    <?php endif; ?>
    <form method="POST">
        <label>Username: <?php echo $_SESSION['username']; ?></label><br>
        <label>Password: <input type="password" name="password" required></label><br>
        <button type="submit">Edit Account</button>
    </form>
</body>
</html>
