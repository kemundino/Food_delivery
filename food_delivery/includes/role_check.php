<?php
// Role checking middleware
// This file provides functions to check user roles and permissions

/**
 * Check if the current user has one of the required roles
 * @param array $allowedRoles Array of allowed roles (e.g., ['customer', 'admin'])
 * @return bool True if user has permission, false otherwise
 */
function checkRole($allowedRoles) {
    // Start session if not already started
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    
    // Check if user is logged in
    if (!isset($_SESSION['user_id']) || !isset($_SESSION['role'])) {
        return false;
    }
    
    // Check if user's role is in the allowed roles
    return in_array($_SESSION['role'], $allowedRoles);
}

/**
 * Require user to have one of the specified roles
 * If user doesn't have permission, redirect to 403 page
 * @param array $allowedRoles Array of allowed roles
 */
function requireRole($allowedRoles) {
    if (!checkRole($allowedRoles)) {
        // Log the access attempt for security
        error_log("Access denied: User ID " . ($_SESSION['user_id'] ?? 'unknown') . 
                 " with role " . ($_SESSION['role'] ?? 'unknown') . 
                 " attempted to access " . $_SERVER['REQUEST_URI']);
        
        // Redirect to 403 page
        header('Location: ../403.php');
        exit();
    }
}

/**
 * Check if current user is admin
 * @return bool True if user is admin
 */
function isAdmin() {
    return checkRole(['admin']);
}

/**
 * Check if current user is vendor
 * @return bool True if user is vendor
 */
function isVendor() {
    return checkRole(['vendor']);
}

/**
 * Check if current user is customer
 * @return bool True if user is customer
 */
function isCustomer() {
    return checkRole(['customer']);
}

/**
 * Get current user's role
 * @return string|null Current user role or null if not logged in
 */
function getCurrentRole() {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    
    return $_SESSION['role'] ?? null;
}

/**
 * Get current user's ID
 * @return int|null Current user ID or null if not logged in
 */
function getCurrentUserId() {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    
    return $_SESSION['user_id'] ?? null;
}

/**
 * Get current user's name
 * @return string|null Current user name or null if not logged in
 */
function getCurrentUserName() {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    
    return $_SESSION['user_name'] ?? null;
}
?>
