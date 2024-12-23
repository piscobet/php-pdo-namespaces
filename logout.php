<?php

require_once 'vendor/autoload.php';

use App\Database;
use User\User;

$pdo = Database::getConnection();
$user = new User($pdo);

$user->logout();

echo "You have been logged out.";
header("Location: index.php");
exit;
