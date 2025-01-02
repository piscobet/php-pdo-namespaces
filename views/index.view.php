<!DOCTYPE html>
<html>
<head>
    <title>Index Page</title>
</head>
<body>
    <h1>Welcome to the Index Page</h1>

    <?php if ($loggedIn): ?>
        <p>Welcome, <?= htmlspecialchars($username); ?>!</p>
        <a href="logout.php">Logout</a>
        
        <!-- User Actions -->
        <h2>User Section</h2>
        <ul>
            <li><a href="add-cart.php">Add Products to Cart</a></li>
            <li><a href="send-invoice.php">Send Invoice</a></li>
            <li><a href="user-edit.php">Edit User</a></li>
        </ul>

        <!-- Admin Actions -->
        <?php if ($isAdmin): ?>
            <h2>Admin Section</h2>
            <ul>
                <li><a href="add-product.php">Add Product</a></li>
                <li><a href="get-products.php">View Products</a></li>
            </ul>
        <?php endif; ?>

    <?php else: ?>
        <p>You are not logged in.</p>
        <ul>
            <li><a href="login.php">Login</a></li>
            <li><a href="user-create.php">Create Account</a></li>
        </ul>
    <?php endif; ?>
</body>
</html>
