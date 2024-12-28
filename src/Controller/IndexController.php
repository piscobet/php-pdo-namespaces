<?php
namespace Controller;

class IndexController
{
    public function index()
    {
        // Start the session
        session_start();

        // Fetch session data
        $loggedIn = isset($_SESSION['user_id']);
        $username = $_SESSION['username'] ?? null;
        $isAdmin = $_SESSION['is_admin'] ?? false;

        // Pass the data to the view
        include 'views/index.view.php';
    }
}
