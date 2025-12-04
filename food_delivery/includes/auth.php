<?php
// Authentication middleware
// This file checks if user is logged in and redirects to login if not

session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id']) || !isset($_SESSION['role'])) {
    // Store the requested page for redirect after login
    $_SESSION['redirect_after_login'] = $_SERVER['REQUEST_URI'];
    
    // Redirect to login page
    header('Location: /food_delivery/login.php');
    exit();
}

// Optional: Regenerate session ID periodically for security
if (!isset($_SESSION['last_regeneration'])) {
    $_SESSION['last_regeneration'] = time();
} elseif (time() - $_SESSION['last_regeneration'] > 300) { // 5 minutes
    session_regenerate_id(true);
    $_SESSION['last_regeneration'] = time();
}
?>
