<?php
require_once '../includes/header.php';
require_once '../includes/db.php';
?>
<style>
/* Modern Dark Theme CSS for Food Delivery Website */

/* CSS Variables */
:root {
    --primary-color: #ff6b35;
    --primary-dark: #e55a2b;
    --primary-light: #ff8555;
    --secondary-color: #8b5cf6;
    --accent-color: #ec4899;
    --success-color: #10b981;
    --warning-color: #f59e0b;
    --danger-color: #ef4444;
    --dark-bg: #0f172a;
    --darker-bg: #020617;
    --light-bg: #1e293b;
    --card-bg: #1e293b;
    --text-primary: #f1f5f9;
    --text-secondary: #94a3b8;
    --text-muted: #64748b;
    --border-color: #334155;
    --shadow-sm: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);
    --shadow-md: 0 4px 6px rgba(0, 0, 0, 0.1), 0 2px 4px rgba(0, 0, 0, 0.06);
    --shadow-lg: 0 10px 25px rgba(0, 0, 0, 0.15), 0 4px 8px rgba(0, 0, 0, 0.1);
    --shadow-xl: 0 20px 40px rgba(0, 0, 0, 0.2), 0 8px 16px rgba(0, 0, 0, 0.1);
    --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    --border-radius: 12px;
    --border-radius-lg: 16px;
    --spacing-xs: 0.25rem;
    --spacing-sm: 0.5rem;
    --spacing-md: 1rem;
    --spacing-lg: 1.5rem;
    --spacing-xl: 2rem;
    --spacing-2xl: 3rem;
}

/* Reset and Base Styles */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

html {
    scroll-behavior: smooth;
}

body {
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, sans-serif;
    background: linear-gradient(135deg, var(--dark-bg) 0%, var(--darker-bg) 100%);
    color: var(--text-primary);
    line-height: 1.6;
    font-size: 16px;
    min-height: 100vh;
}

/* Container */
.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 var(--spacing-md);
}

/* Typography */
h1, h2, h3, h4, h5, h6 {
    font-weight: 600;
    line-height: 1.2;
    margin-bottom: var(--spacing-md);
    color: var(--text-primary);
}

h1 {
    font-size: clamp(2rem, 5vw, 3.5rem);
    font-weight: 700;
}

h2 {
    font-size: clamp(1.5rem, 4vw, 2.5rem);
}

h3 {
    font-size: clamp(1.25rem, 3vw, 1.875rem);
}

h4 {
    font-size: clamp(1.125rem, 2.5vw, 1.5rem);
}

p {
    color: var(--text-secondary);
    margin-bottom: var(--spacing-md);
}

a {
    color: var(--primary-color);
    text-decoration: none;
    transition: var(--transition);
}

a:hover {
    color: var(--primary-light);
}

/* Header & Navigation */
header {
    background: rgba(15, 20, 25, 0.98);
    backdrop-filter: blur(20px);
    border-bottom: 1px solid var(--border-color);
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    z-index: 1000;
    transition: var(--transition);
}

.navbar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: var(--spacing-md) 0;
}

.logo a {
    font-size: 1.5rem;
    font-weight: 700;
    color: var(--primary-color);
    text-decoration: none;
}

.nav-links {
    display: flex;
    align-items: center;
    gap: var(--spacing-lg);
}

.nav-links a {
    color: var(--text-primary);
    font-weight: 500;
    padding: var(--spacing-sm) var(--spacing-md);
    border-radius: var(--border-radius);
    transition: var(--transition);
}

.nav-links a:hover {
    background: var(--primary-color);
    color: white;
    transform: translateY(-2px);
}

/* Cart Dropdown */
.cart-dropdown {
    position: relative;
}

.cart-icon {
    display: flex;
    align-items: center;
    gap: var(--spacing-xs);
    color: var(--text-primary);
    position: relative;
    padding: var(--spacing-sm);
    border-radius: var(--border-radius);
    transition: var(--transition);
}

.cart-icon:hover {
    background: var(--card-bg);
}

.cart-count {
    background: var(--primary-color);
    color: white;
    border-radius: 50%;
    width: 20px;
    height: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.75rem;
    font-weight: 600;
}

.cart-dropdown-content {
    position: absolute;
    top: 100%;
    right: 0;
    background: var(--card-bg);
    border: 1px solid var(--border-color);
    border-radius: var(--border-radius);
    box-shadow: var(--shadow-xl);
    min-width: 300px;
    max-height: 400px;
    overflow-y: auto;
    opacity: 0;
    visibility: hidden;
    transform: translateY(-10px);
    transition: var(--transition);
}

.cart-dropdown:hover .cart-dropdown-content {
    opacity: 1;
    visibility: visible;
    transform: translateY(0);
}

.cart-item {
    padding: var(--spacing-md);
    border-bottom: 1px solid var(--border-color);
}

.cart-total {
    padding: var(--spacing-md);
    font-weight: 600;
    display: flex;
    justify-content: space-between;
    border-top: 1px solid var(--border-color);
}

.cart-empty {
    padding: var(--spacing-lg);
    text-align: center;
    color: var(--text-muted);
}

/* Mobile Menu */
.hamburger {
    display: flex;
    flex-direction: column;
    cursor: pointer;
    gap: 4px;
    padding: var(--spacing-sm);
    border-radius: var(--border-radius);
    transition: var(--transition);
    position: relative;
    z-index: 1001;
    min-height: 44px;
    min-width: 44px;
    justify-content: center;
    align-items: center;
}

.hamburger:hover {
    background: var(--card-bg);
}

.hamburger:focus {
    outline: 2px solid var(--primary-color);
    outline-offset: 2px;
}

.hamburger span {
    width: 25px;
    height: 3px;
    background: var(--text-primary);
    border-radius: 2px;
    transition: var(--transition);
}

/* Buttons */
.btn {
    display: inline-flex;
    align-items: center;
    gap: var(--spacing-xs);
    padding: var(--spacing-sm) var(--spacing-lg);
    border: none;
    border-radius: var(--border-radius);
    font-weight: 600;
    font-size: 0.875rem;
    text-decoration: none;
    cursor: pointer;
    transition: var(--transition);
    position: relative;
    overflow: hidden;
}

.btn::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
    transition: left 0.5s;
}

.btn:hover::before {
    left: 100%;
}

.btn-primary {
    background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
    color: white;
    box-shadow: var(--shadow-md);
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: var(--shadow-lg);
}

.btn-outline {
    background: transparent;
    color: var(--primary-color);
    border: 2px solid var(--primary-color);
}

.btn-outline:hover {
    background: var(--primary-color);
    color: white;
}

.btn-sm {
    padding: var(--spacing-xs) var(--spacing-md);
    font-size: 0.75rem;
}

.btn-lg {
    padding: var(--spacing-md) var(--spacing-xl);
    font-size: 1.125rem;
}

.btn-admin {
    background: var(--accent-color);
    color: white;
}

.btn-admin:hover {
    background: #3182ce;
    transform: translateY(-2px);
}

/* Page Header */
.page-header {
    background: linear-gradient(135deg, var(--darker-bg) 0%, var(--dark-bg) 100%);
    padding: calc(100px + var(--spacing-2xl)) 0 var(--spacing-xl);
    text-align: center;
    position: relative;
    overflow: hidden;
}

.page-header::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grid" width="10" height="10" patternUnits="userSpaceOnUse"><path d="M 10 0 L 0 0 0 10" fill="none" stroke="%23ffffff" stroke-width="0.5" opacity="0.1"/></pattern></defs><rect width="100" height="100" fill="url(%23grid)"/></svg>');
    opacity: 0.3;
}

.page-header-content {
    position: relative;
    z-index: 1;
    max-width: 800px;
    margin: 0 auto;
    padding: 0 var(--spacing-md);
}

.page-header h1 {
    margin-bottom: var(--spacing-lg);
    background: linear-gradient(135deg, var(--primary-color), var(--primary-light));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.page-header p {
    font-size: 1.125rem;
    margin-bottom: var(--spacing-xl);
    color: var(--text-secondary);
}

/* Filters Section */
.filters-section {
    background: var(--card-bg);
    border: 1px solid var(--border-color);
    border-radius: var(--border-radius-lg);
    padding: var(--spacing-lg);
    margin-bottom: var(--spacing-xl);
    box-shadow: var(--shadow-md);
}

.filters-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: var(--spacing-lg);
}

.filters-header h2 {
    margin-bottom: 0;
    color: var(--text-primary);
}

.filters-toggle {
    background: none;
    border: none;
    color: var(--primary-color);
    font-size: 1.25rem;
    cursor: pointer;
    transition: var(--transition);
}

.filters-toggle:hover {
    color: var(--primary-light);
}

.filters-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: var(--spacing-md);
}

.filter-group {
    display: flex;
    flex-direction: column;
}

.filter-label {
    font-weight: 600;
    color: var(--text-primary);
    margin-bottom: var(--spacing-xs);
    font-size: 0.875rem;
}

.filter-control {
    background: var(--dark-bg);
    border: 1px solid var(--border-color);
    border-radius: var(--border-radius);
    padding: var(--spacing-sm) var(--spacing-md);
    color: var(--text-primary);
    font-size: 0.875rem;
    transition: var(--transition);
}

.filter-control:focus {
    outline: none;
    border-color: var(--primary-color);
    box-shadow: 0 0 0 3px rgba(255, 107, 53, 0.1);
}

.filter-control option {
    background: var(--dark-bg);
    color: var(--text-primary);
}

/* Results Section */
.results-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: var(--spacing-lg);
    padding-bottom: var(--spacing-md);
    border-bottom: 1px solid var(--border-color);
}

.results-count {
    color: var(--text-secondary);
    font-size: 0.875rem;
}

.sort-dropdown {
    display: flex;
    align-items: center;
    gap: var(--spacing-sm);
}

.sort-dropdown label {
    color: var(--text-muted);
    font-size: 0.875rem;
}

/* Grid Layouts */
.restaurants-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: var(--spacing-lg);
    margin-bottom: var(--spacing-xl);
}

/* Cards */
.restaurant-card {
    background: var(--card-bg);
    border: 1px solid var(--border-color);
    border-radius: var(--border-radius-lg);
    overflow: hidden;
    transition: var(--transition);
    position: relative;
}

.restaurant-card:hover {
    transform: translateY(-5px);
    box-shadow: var(--shadow-xl);
    border-color: var(--primary-color);
}

.card-img-container {
    position: relative;
    height: 200px;
    overflow: hidden;
}

.card-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: var(--transition);
}

.restaurant-card:hover .card-img {
    transform: scale(1.05);
}

.badge {
    position: absolute;
    top: var(--spacing-sm);
    right: var(--spacing-sm);
    padding: var(--spacing-xs) var(--spacing-sm);
    border-radius: var(--border-radius);
    font-size: 0.75rem;
    font-weight: 600;
}

.badge.open {
    background: var(--success-color);
    color: white;
}

.badge.closed {
    background: var(--danger-color);
    color: white;
}

.btn-favorite {
    position: absolute;
    top: var(--spacing-sm);
    right: var(--spacing-sm);
    background: rgba(26, 32, 44, 0.8);
    color: white;
    border: none;
    border-radius: 50%;
    width: 36px;
    height: 36px;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: var(--transition);
}

.btn-favorite:hover {
    background: var(--danger-color);
    transform: scale(1.1);
}

.card-content {
    padding: var(--spacing-md);
}

.card-content h3 {
    margin-bottom: var(--spacing-xs);
    font-size: 1.125rem;
}

.cuisine,
.restaurant {
    color: var(--text-secondary);
    font-size: 0.875rem;
    margin-bottom: var(--spacing-sm);
    font-weight: 500;
}

.restaurant-meta {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: var(--spacing-md);
    font-size: 0.875rem;
}

.rating {
    color: var(--warning-color);
    font-weight: 700;
    font-size: 0.95rem;
}

.delivery-info {
    color: var(--text-muted);
    font-size: 0.875rem;
}

/* Pagination */
.pagination {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: var(--spacing-sm);
    margin-top: var(--spacing-xl);
}

.pagination-link {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 40px;
    height: 40px;
    background: var(--card-bg);
    border: 1px solid var(--border-color);
    border-radius: var(--border-radius);
    color: var(--text-primary);
    text-decoration: none;
    font-weight: 600;
    transition: var(--transition);
}

.pagination-link:hover {
    background: var(--primary-color);
    border-color: var(--primary-color);
    color: white;
}

.pagination-link.active {
    background: var(--primary-color);
    border-color: var(--primary-color);
    color: white;
}

.pagination-link.disabled {
    opacity: 0.5;
    cursor: not-allowed;
}

.pagination-link.disabled:hover {
    background: var(--card-bg);
    border-color: var(--border-color);
    color: var(--text-primary);
}

/* Empty State */
.empty-state {
    text-align: center;
    padding: var(--spacing-2xl);
    color: var(--text-muted);
}

.empty-state-icon {
    font-size: 4rem;
    color: var(--text-muted);
    margin-bottom: var(--spacing-lg);
}

.empty-state h3 {
    color: var(--text-primary);
    margin-bottom: var(--spacing-sm);
}

.empty-state p {
    margin-bottom: var(--spacing-lg);
}

/* Loading State */
.loading {
    text-align: center;
    padding: var(--spacing-xl);
}

.loading-spinner {
    width: 40px;
    height: 40px;
    border: 4px solid var(--border-color);
    border-top: 4px solid var(--primary-color);
    border-radius: 50%;
    animation: spin 1s linear infinite;
    margin: 0 auto var(--spacing-md);
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

/* Responsive Design */
@media (max-width: 768px) {
    .nav-links {
        position: fixed;
        top: 70px;
        left: 0;
        right: 0;
        background: var(--darker-bg);
        flex-direction: column;
        padding: var(--spacing-lg);
        gap: var(--spacing-md);
        transform: translateX(-100%);
        transition: var(--transition);
        box-shadow: var(--shadow-xl);
    }
    
    .nav-links.active {
        transform: translateX(0);
    }
    
    .hamburger {
        display: flex;
    }
    
    .hamburger.active span:nth-child(1) {
        transform: rotate(45deg) translate(5px, 5px);
    }
    
    .hamburger.active span:nth-child(2) {
        opacity: 0;
    }
    
    .hamburger.active span:nth-child(3) {
        transform: rotate(-45deg) translate(7px, -6px);
    }
    
    .page-header {
        padding: calc(100px + var(--spacing-lg)) 0 var(--spacing-lg);
    }
    
    .filters-grid {
        grid-template-columns: 1fr;
    }
    
    .results-header {
        flex-direction: column;
        gap: var(--spacing-md);
        text-align: center;
    }
    
    .restaurants-grid {
        grid-template-columns: 1fr;
    }
    
    .pagination {
        flex-wrap: wrap;
    }
}

@media (max-width: 480px) {
    .container {
        padding: 0 var(--spacing-sm);
    }
    
    .page-header h1 {
        font-size: 2rem;
    }
    
    .page-header p {
        font-size: 1rem;
    }
    
    .filters-section {
        padding: var(--spacing-md);
    }
    
    .btn {
        padding: var(--spacing-sm) var(--spacing-md);
        font-size: 0.875rem;
    }
    
    .card-img-container {
        height: 150px;
    }
    
    .pagination-link {
        width: 36px;
        height: 36px;
        font-size: 0.875rem;
    }
}

/* Custom Scrollbar */
::-webkit-scrollbar {
    width: 8px;
}

::-webkit-scrollbar-track {
    background: var(--darker-bg);
}

::-webkit-scrollbar-thumb {
    background: var(--primary-color);
    border-radius: 4px;
}

::-webkit-scrollbar-thumb:hover {
    background: var(--primary-dark);
}
</style>

<?php

// Initialize variables
$restaurants = [];
$total_restaurants = 0;
$total_pages = 1;

// Set page title
$page_title = 'Restaurants - FoodExpress';

// Get search parameters
$search = isset($_GET['search']) ? trim($_GET['search']) : '';
$cuisine = isset($_GET['cuisine']) ? (int)$_GET['cuisine'] : 0;
$sort = isset($_GET['sort']) ? $_GET['sort'] : 'rating';
$page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
$per_page = 12; // Number of restaurants per page
$offset = ($page - 1) * $per_page;

try {
    // Build the query
    $query = "SELECT r.*, 
              (SELECT COALESCE(AVG(rating), 0) FROM reviews WHERE restaurant_id = r.id) as avg_rating,
              (SELECT COUNT(*) FROM reviews WHERE restaurant_id = r.id) as review_count
              FROM restaurants r 
              WHERE r.is_active = 1";

    $count_query = "SELECT COUNT(*) as total FROM restaurants r WHERE r.is_active = 1";
    $params = [];
    $types = '';

    // Add search conditions
    if (!empty($search)) {
        $query .= " AND (r.name LIKE ? OR r.cuisine LIKE ? OR r.description LIKE ?)";
        $count_query .= " AND (r.name LIKE ? OR r.cuisine LIKE ? OR r.description LIKE ?)";
        $search_term = "%$search%";
        $params = array_merge($params, [$search_term, $search_term, $search_term]);
        $types .= 'sss';
    }

    // Add cuisine filter
    if ($cuisine > 0) {
        $query .= " AND r.cuisine_id = ?";
        $count_query .= " AND r.cuisine_id = ?";
        $params[] = $cuisine;
        $types .= 'i';
    }

    // Add sorting
    switch ($sort) {
        case 'name_asc':
            $query .= " ORDER BY r.name ASC";
            break;
        case 'name_desc':
            $query .= " ORDER BY r.name DESC";
            break;
        case 'delivery_time':
        $query .= " ORDER BY r.delivery_time ASC";
        break;
    case 'min_order':
        $query .= " ORDER BY r.min_order ASC";
        break;
        case 'rating':
        default:
            $query .= " ORDER BY avg_rating DESC, review_count DESC";
            break;
    }

// Build the count query with the same WHERE conditions but without sorting
$count_query = "SELECT COUNT(*) as total FROM restaurants r WHERE r.is_active = 1";

// Add the same search conditions as the main query
if (!empty($search)) {
    $count_query .= " AND (r.name LIKE ? OR r.cuisine LIKE ? OR r.description LIKE ?)";
}
if ($cuisine > 0) {
    $count_query .= " AND r.cuisine_id = ?";
}

// Execute count query
$count_stmt = $conn->prepare($count_query);
if (!$count_stmt) {
    die('Prepare failed: ' . $conn->error);
}

// Bind parameters for count query (all parameters except pagination)
if (!empty($params)) {
    $count_params = $params;
    $count_types = $types;
    
    // If we have pagination parameters, remove them (last two elements)
    if (strlen($types) >= 2 && substr($types, -2) === 'ii') {
        $count_params = array_slice($params, 0, -2);
        $count_types = substr($types, 0, -2);
    }
    
    if (!empty($count_params)) {
        $count_stmt->bind_param($count_types, ...$count_params);
    }
}

if (!$count_stmt->execute()) {
    die('Execute failed: ' . $count_stmt->error);
}

$result = $count_stmt->get_result();
if (!$result) {
    die('Get result failed: ' . $count_stmt->error);
}

$row = $result->fetch_assoc();
$total_restaurants = $row ? (int)$row['total'] : 0;
$total_pages = max(1, (int)ceil($total_restaurants / $per_page));
$count_stmt->close();

// Now add pagination to the main query
$query .= " LIMIT ? OFFSET ?";
$params[] = $per_page;
$params[] = $offset;
$types .= 'ii';

// Execute main query with pagination
$stmt = $conn->prepare($query);
if (!$stmt) {
    die('Prepare failed: ' . $conn->error);
}

if (!empty($params)) {
    $stmt->bind_param($types, ...$params);
}

if (!$stmt->execute()) {
    die('Execute failed: ' . $stmt->error);
}

$result = $stmt->get_result();
if (!$result) {
    throw new Exception('Get result failed: ' . $stmt->error);
}

$restaurants = $result->fetch_all(MYSQLI_ASSOC);
$stmt->close();

// Debug output (remove in production)
error_log("Fetched " . count($restaurants) . " restaurants");

// Check database connection
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

} catch (Exception $e) {
    error_log("Error in restaurants query: " . $e->getMessage());
    $error_message = "An error occurred while loading restaurants. Please try again later.";
    $restaurants = [];
    $total_restaurants = 0;
    $total_pages = 1;
}

// If no restaurants found from database, use mock data for demonstration
if (empty($restaurants) && !isset($error_message)) {
    $restaurants = [
        [
            'id' => 1,
            'name' => 'Pizza Palace',
            'cuisine' => 'Italian, Pizza',
            'description' => 'Authentic Italian pizza with fresh ingredients and traditional recipes',
            'delivery_time' => '30-45 min',
            'min_order' => 15.00,
            'avg_rating' => 4.5,
            'review_count' => 128,
            'cover_image' => 'https://images.unsplash.com/photo-1513104890138-7c749659a591?ixlib=rb-1.2.1&auto=format&fit=crop&w=1000&q=80',
            'is_active' => 1,
            'created_at' => date('Y-m-d H:i:s', strtotime('-1 month'))
        ],
        [
            'id' => 2,
            'name' => 'Burger Barn',
            'cuisine' => 'American, Burgers',
            'description' => 'Gourmet burgers made with premium beef and fresh toppings',
            'delivery_time' => '20-35 min',
            'min_order' => 10.00,
            'avg_rating' => 4.2,
            'review_count' => 95,
            'cover_image' => 'https://images.unsplash.com/photo-1553979459-d2229ba7433b?ixlib=rb-1.2.1&auto=format&fit=crop&w=1000&q=80',
            'is_active' => 1,
            'created_at' => date('Y-m-d H:i:s', strtotime('-2 weeks'))
        ],
        [
            'id' => 3,
            'name' => 'Sushi Express',
            'cuisine' => 'Japanese, Sushi',
            'description' => 'Fresh sushi and Japanese delicacies prepared by expert chefs',
            'delivery_time' => '25-40 min',
            'min_order' => 20.00,
            'avg_rating' => 4.7,
            'review_count' => 156,
            'cover_image' => 'https://images.unsplash.com/photo-1579871494447-9811cf80d66c?ixlib=rb-1.2.1&auto=format&fit=crop&w=1000&q=80',
            'is_active' => 1,
            'created_at' => date('Y-m-d H:i:s', strtotime('-3 days'))
        ],
        [
            'id' => 4,
            'name' => 'Taco Town',
            'cuisine' => 'Mexican, Tacos',
            'description' => 'Authentic Mexican tacos and burritos with homemade salsas',
            'delivery_time' => '25-35 min',
            'min_order' => 12.00,
            'avg_rating' => 4.4,
            'review_count' => 87,
            'cover_image' => 'https://images.unsplash.com/photo-1565299624946-b28f40a0ae38?ixlib=rb-1.2.1&auto=format&fit=crop&w=1000&q=80',
            'is_active' => 1,
            'created_at' => date('Y-m-d H:i:s', strtotime('-1 week'))
        ],
        [
            'id' => 5,
            'name' => 'Pasta Paradise',
            'cuisine' => 'Italian, Pasta',
            'description' => 'Homemade pasta dishes with rich sauces and fresh ingredients',
            'delivery_time' => '35-50 min',
            'min_order' => 18.00,
            'avg_rating' => 4.6,
            'review_count' => 112,
            'cover_image' => 'https://images.unsplash.com/photo-1612874742237-6526229898c7?ixlib=rb-1.2.1&auto=format&fit=crop&w=1000&q=80',
            'is_active' => 1,
            'created_at' => date('Y-m-d H:i:s', strtotime('-5 days'))
        ],
        [
            'id' => 6,
            'name' => 'BBQ Brothers',
            'cuisine' => 'American, BBQ',
            'description' => 'Slow-smoked BBQ ribs, brisket, and southern comfort food',
            'delivery_time' => '40-55 min',
            'min_order' => 25.00,
            'avg_rating' => 4.8,
            'review_count' => 203,
            'cover_image' => 'https://images.unsplash.com/photo-1529692236672-191c62873dce?ixlib=rb-1.2.1&auto=format&fit=crop&w=1000&q=80',
            'is_active' => 1,
            'created_at' => date('Y-m-d H:i:s', strtotime('-2 weeks'))
        ]
    ];
    
    // Apply search filter to mock data
    if (!empty($search)) {
        $search_lower = strtolower($search);
        $restaurants = array_filter($restaurants, function($restaurant) use ($search_lower) {
            return (
                strpos(strtolower($restaurant['name']), $search_lower) !== false ||
                strpos(strtolower($restaurant['cuisine']), $search_lower) !== false ||
                strpos(strtolower($restaurant['description']), $search_lower) !== false
            );
        });
        $restaurants = array_values($restaurants); // Re-index array
    }
    
    $total_restaurants = count($restaurants);
    $total_pages = max(1, (int)ceil($total_restaurants / $per_page));
    
    // Apply pagination to mock data
    $offset = ($page - 1) * $per_page;
    $restaurants = array_slice($restaurants, $offset, $per_page);
    
    // Apply responsive styles to mock data
    foreach ($restaurants as &$restaurant) {
        $restaurant['name_style'] = 'text-3xl font-bold text-center sm:text-4xl md:text-5xl lg:text-6xl';
        $restaurant['cuisine_style'] = 'text-lg text-center sm:text-xl md:text-2xl lg:text-3xl';
        $restaurant['description_style'] = 'text-lg text-center sm:text-xl md:text-2xl lg:text-3xl';
        $restaurant['cover_image_style'] = 'w-full h-64 sm:h-80 md:h-96 lg:h-112';
        $restaurant['box_style'] = 'border border-gray-200 bg-white shadow-md rounded-lg p-6 sm:p-8';
    }
}

// Get all cuisines for the filter
$cuisines = [];
try {
    $cuisine_query = "SELECT * FROM cuisines WHERE is_active = 1 ORDER BY name";
    $cuisine_result = $conn->query($cuisine_query);
    
    if ($cuisine_result === false) {
        throw new Exception("Query failed: " . $conn->error);
    }
    
    $cuisines = $cuisine_result->fetch_all(MYSQLI_ASSOC);
    $cuisine_result->free();
} catch (Exception $e) {
    error_log("Error fetching cuisines: " . $e->getMessage());
    $cuisines = [];
}

// If no cuisines found from database, use mock data
if (empty($cuisines)) {
    $cuisines = [
        ['id' => 1, 'name' => 'Italian'],
        ['id' => 2, 'name' => 'American'],
        ['id' => 3, 'name' => 'Japanese'],
        ['id' => 4, 'name' => 'Mexican'],
        ['id' => 5, 'name' => 'Chinese'],
        ['id' => 6, 'name' => 'Indian'],
        ['id' => 7, 'name' => 'Thai'],
        ['id' => 8, 'name' => 'Mediterranean']
    ];
}
?>

<div class="restaurants-hero">
    <div class="container">
        <div class="page-header">
            <h1>Discover Amazing Restaurants</h1>
            <p>Order from your favorite local restaurants with fast delivery</p>
        </div>
        
        <!-- Search and Filter Section -->
        <div class="restaurant-filters">
            <form method="GET" class="search-filter-form">
                <div class="search-container">
                    <div class="search-input-group">
                        <i class="fas fa-search"></i>
                        <input type="text" 
                               name="search" 
                               placeholder="Search for restaurants, cuisines, or dishes..." 
                               value="<?php echo htmlspecialchars($search); ?>"
                               aria-label="Search restaurants">
                        <button type="submit" class="btn btn-primary search-btn">
                            <i class="fas fa-search"></i>
                            <span>Search</span>
                        </button>
                    </div>
                </div>
                
                <div class="filter-options">
                    <div class="filter-group">
                        <div class="custom-select">
                            <select name="cuisine" id="cuisine" onchange="this.form.submit()" aria-label="Filter by cuisine">
                                <option value="">All Cuisines</option>
                                <?php foreach ($cuisines as $c): ?>
                                    <option value="<?php echo $c['id']; ?>" <?php echo $cuisine == $c['id'] ? 'selected' : ''; ?>>
                                        <?php echo htmlspecialchars($c['name']); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <div class="select-arrow">
                                <i class="fas fa-chevron-down"></i>
                            </div>
                        </div>
                    </div>
                    
                    <div class="filter-group">
                        <div class="custom-select">
                            <select name="sort" id="sort" onchange="this.form.submit()" aria-label="Sort by">
                                <option value="rating" <?php echo $sort === 'rating' ? 'selected' : ''; ?>>Top Rated</option>
                                <option value="name_asc" <?php echo $sort === 'name_asc' ? 'selected' : ''; ?>>Name (A-Z)</option>
                                <option value="name_desc" <?php echo $sort === 'name_desc' ? 'selected' : ''; ?>>Name (Z-A)</option>
                                <option value="delivery_time" <?php echo $sort === 'delivery_time' ? 'selected' : ''; ?>>Fastest Delivery</option>
                                <option value="min_order" <?php echo $sort === 'min_order' ? 'selected' : ''; ?>>Minimum Order</option>
                            </select>
                            <div class="select-arrow">
                                <i class="fas fa-chevron-down"></i>
                            </div>
                        </div>
                    </div>
                </div>
                
                <?php if (!empty($search) || $cuisine > 0): ?>
                <div class="active-filters">
                    <?php if (!empty($search)): ?>
                        <span class="filter-tag">
                            Search: <?php echo htmlspecialchars($search); ?>
                            <a href="?<?php echo http_build_query(array_merge($_GET, ['search' => ''])); ?>" class="remove-filter" aria-label="Remove search">
                                <i class="fas fa-times"></i>
                            </a>
                        </span>
                    <?php endif; ?>
                    
                    <?php if ($cuisine > 0): ?>
                        <?php foreach ($cuisines as $c): ?>
                            <?php if ($c['id'] == $cuisine): ?>
                                <span class="filter-tag">
                                    <?php echo htmlspecialchars($c['name']); ?>
                                    <a href="?<?php echo http_build_query(array_merge($_GET, ['cuisine' => ''])); ?>" class="remove-filter" aria-label="Remove cuisine filter">
                                        <i class="fas fa-times"></i>
                                    </a>
                                </span>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
                <?php endif; ?>
            </form>
        </div>
    </div>
</div>

<div class="container">
    
    <!-- Restaurants Grid -->
    <?php if (count($restaurants) > 0): ?>
        <div class="restaurants-grid">
            <?php foreach ($restaurants as $restaurant): 
                $rating = $restaurant['avg_rating'] ? number_format((float)$restaurant['avg_rating'], 1) : 'N/A';
                $review_count = $restaurant['review_count'] ?? 0;
                $delivery_time = $restaurant['delivery_time'] ?? '30-45 min';
                $min_order = $restaurant['min_order'] > 0 ? '$' . number_format($restaurant['min_order'], 2) : 'No minimum';
                $image = !empty($restaurant['cover_image']) ? $restaurant['cover_image'] : 'https://source.unsplash.com/random/600x400/?restaurant,food,' . urlencode($restaurant['name']);
                $is_new = strtotime($restaurant['created_at']) > strtotime('-2 weeks');
            ?>
                <article class="restaurant-card" 
                         data-id="<?php echo $restaurant['id']; ?>"
                         data-rating="<?php echo $rating; ?>"
                         data-delivery-time="<?php echo $delivery_time; ?>">
                    <a href="restaurant.php?id=<?php echo $restaurant['id']; ?>" class="card-link" aria-label="View <?php echo htmlspecialchars($restaurant['name']); ?>">
                        <div class="card-media">
                            <div class="card-image-container">
                                <img src="<?php echo $image; ?>" 
                                     alt="<?php echo htmlspecialchars($restaurant['name']); ?>" 
                                     class="card-image"
                                     loading="lazy">
                                <?php if ($is_new): ?>
                                    <span class="badge new-badge">New</span>
                                <?php endif; ?>
                                <div class="card-rating" aria-label="Rating: <?php echo $rating; ?> out of 5">
                                    <div class="stars" style="--rating: <?php echo $rating; ?>">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                    </div>
                                    <span class="review-count">(<?php echo $review_count; ?>)</span>
                                </div>
                            </div>
                            <div class="card-details">
                                <div class="card-header">
                                    <h3 class="card-title"><?php echo htmlspecialchars($restaurant['name']); ?></h3>
                                    <span class="delivery-time">
                                        <i class="fas fa-clock"></i> <?php echo $delivery_time; ?>
                                    </span>
                                </div>
                                
                                <div class="card-meta">
                                    <span class="cuisine-tag">
                                        <i class="fas fa-utensils"></i> 
                                        <?php echo !empty($restaurant['cuisine']) ? htmlspecialchars($restaurant['cuisine']) : 'Various Cuisines'; ?>
                                    </span>
                                    <span class="min-order">
                                        <i class="fas fa-shopping-bag"></i> <?php echo $min_order; ?> min
                                    </span>
                                </div>
                                
                                <?php if (!empty($restaurant['description'])): ?>
                                    <p class="card-description">
                                        <?php echo mb_strimwidth(htmlspecialchars($restaurant['description']), 0, 100, '...'); ?>
                                    </p>
                                <?php endif; ?>
                                
                                <div class="card-actions">
                                    <button class="btn btn-outline btn-sm" onclick="event.preventDefault(); window.location.href='restaurant.php?id=<?php echo $restaurant['id']; ?>'">
                                        View Menu
                                    </button>
                                    <button class="btn btn-primary btn-sm" 
                                            onclick="event.preventDefault(); addToFavorites(<?php echo $restaurant['id']; ?>)"
                                            aria-label="Add to favorites">
                                        <i class="far fa-heart"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </a>
                </article>
            <?php endforeach; ?>
        </div>
        
        <!-- Pagination -->
        <?php if ($total_pages > 1): ?>
            <div class="pagination">
                <?php if ($page > 1): ?>
                    <a href="?<?php echo http_build_query(array_merge($_GET, ['page' => 1])); ?>" class="page-link first">First</a>
                    <a href="?<?php echo http_build_query(array_merge($_GET, ['page' => $page - 1])); ?>" class="page-link prev">Previous</a>
                <?php endif; ?>
                
                <?php
                $start = max(1, $page - 2);
                $end = min($total_pages, $page + 2);
                
                if ($start > 1) {
                    echo '<span class="page-ellipsis">...</span>';
                }
                
                for ($i = $start; $i <= $end; $i++):
                    $is_active = $i == $page ? 'active' : '';
                ?>
                    <a href="?<?php echo http_build_query(array_merge($_GET, ['page' => $i])); ?>" class="page-link <?php echo $is_active; ?>">
                        <?php echo $i; ?>
                    </a>
                <?php endfor; ?>
                
                <?php if ($end < $total_pages): ?>
                    <span class="page-ellipsis">...</span>
                <?php endif; ?>
                
                <?php if ($page < $total_pages): ?>
                    <a href="?<?php echo http_build_query(array_merge($_GET, ['page' => $page + 1])); ?>" class="page-link next">Next</a>
                    <a href="?<?php echo http_build_query(array_merge($_GET, ['page' => $total_pages])); ?>" class="page-link last">Last</a>
                <?php endif; ?>
            </div>
        <?php endif; ?>
        
    <?php else: ?>
        <div class="no-results-container">
            <div class="no-results">
                <div class="no-results-illustration">
                    <svg width="200" height="200" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z" stroke="#E5E7EB" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M12 8V12" stroke="#9CA3AF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M12 16H12.01" stroke="#9CA3AF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
                <div class="no-results-content">
                    <h2>No restaurants found</h2>
                    <p>We couldn't find any restaurants matching your search. Try adjusting your filters or search for something else.</p>
                    <div class="no-results-actions">
                        <a href="restaurants.php" class="btn btn-primary">
                            <i class="fas fa-undo"></i> Reset Filters
                        </a>
                        <button class="btn btn-outline" onclick="history.back()">
                            <i class="fas fa-arrow-left"></i> Go Back
                        </button>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>

<style>
/* Modern Restaurant Listing Styles */
.restaurants-hero {
    background: linear-gradient(135deg, var(--dark-bg) 0%, var(--darker-bg) 100%);
    color: var(--text-primary);
    padding: 4rem 0 2rem;
    margin-bottom: 3rem;
    border-radius: 0 0 20px 20px;
    box-shadow: var(--shadow-xl);
    border-bottom: 1px solid var(--border-color);
}

.restaurants-hero .page-header {
    text-align: center;
    margin-bottom: 2.5rem;
}

.restaurants-hero h1 {
    font-size: 2.8rem;
    font-weight: 800;
    margin-bottom: 1rem;
    color: var(--primary-color);
    line-height: 1.2;
}

.restaurants-hero p {
    font-size: 1.25rem;
    opacity: 0.9;
    max-width: 700px;
    margin: 0 auto;
    color: var(--text-secondary);
}

/* Search and Filter Section */
.restaurant-filters {
    background: var(--card-bg);
    border-radius: 16px;
    padding: 2rem;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
    margin-top: 2rem;
}

.search-filter-form {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
}

.search-container {
    position: relative;
    width: 100%;
    max-width: 800px;
    margin: 0 auto;
}

.search-input-group {
    display: flex;
    align-items: center;
    background: linear-gradient(135deg, var(--card-bg) 0%, rgba(30, 41, 59, 0.8) 100%);
    border-radius: 50px;
    overflow: hidden;
    border: 2px solid var(--border-color);
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    box-shadow: var(--shadow-md);
    position: relative;
}

.search-input-group::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 107, 53, 0.1), transparent);
    transition: left 0.6s ease;
}

.search-input-group:hover::before {
    left: 100%;
}

.search-input-group:focus-within {
    border-color: var(--primary-color);
    box-shadow: 0 0 0 4px rgba(255, 107, 53, 0.15), var(--shadow-lg);
    transform: translateY(-2px);
}

.search-input-group i {
    color: var(--primary-color);
    margin: 0 1.25rem;
    font-size: 1.2rem;
    transition: var(--transition);
    animation: pulse 2s infinite;
}

@keyframes pulse {
    0%, 100% { opacity: 1; }
    50% { opacity: 0.7; }
}

.search-input-group:focus-within i {
    color: var(--primary-light);
    transform: scale(1.1);
}

.search-input-group input {
    flex: 1;
    border: none;
    background: transparent;
    padding: 1rem 0;
    font-size: 1.05rem;
    color: black;
    outline: none;
}

.search-input-group input::placeholder {
    color: var(--text-muted);
}

.search-btn {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.875rem 2rem;
    margin: 0.25rem;
    border-radius: 50px;
    font-weight: 600;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    position: relative;
    overflow: hidden;
    background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
    color: white;
    border: none;
    cursor: pointer;
    box-shadow: var(--shadow-md);
}

.search-btn::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
    transition: left 0.6s ease;
}

.search-btn:hover::before {
    left: 100%;
}

.search-btn:hover {
    transform: translateY(-2px) scale(1.02);
    box-shadow: var(--shadow-lg);
    background: linear-gradient(135deg, var(--primary-light), var(--primary-color));
}

.search-btn:active {
    transform: translateY(0) scale(0.98);
}

.search-btn i {
    font-size: 1rem;
    transition: var(--transition);
}

.search-btn:hover i {
    transform: rotate(90deg);
}

.filter-options {
    display: flex;
    flex-wrap: wrap;
    gap: 1rem;
    justify-content: center;
    margin-top: 1rem;
}

.filter-group {
    position: relative;
    min-width: 200px;
}

.custom-select {
    position: relative;
    width: 100%;
}

.custom-select select {
    width: 100%;
    padding: 0.75rem 1rem;
    padding-right: 2.5rem;
    border: 1px solid #e5e7eb;
    border-radius: 8px;
    background-color: var(--card-bg);
    color: white;
    font-size: 0.95rem;
    cursor: pointer;
    appearance: none;
    -webkit-appearance: none;
    -moz-appearance: none;
    transition: all 0.2s ease;
}

.custom-select select:focus {
    outline: none;
    border-color: var(--primary-color);
    box-shadow: 0 0 0 3px rgba(255, 107, 53, 0.1);
}

.select-arrow {
    position: absolute;
    right: 1rem;
    top: 50%;
    transform: translateY(-50%);
    pointer-events: none;
    color: white;
}

.active-filters {
    display: flex;
    flex-wrap: wrap;
    gap: 0.5rem;
    margin-top: 1rem;
    justify-content: center;
}

.filter-tag {
    display: inline-flex;
    align-items: center;
    background: #e0e7ff;
    color: var(--primary-color);
    padding: 0.35rem 0.75rem;
    border-radius: 50px;
    font-size: 0.85rem;
    font-weight: 500;
    gap: 0.5rem;
}

.remove-filter {
    color: var(--primary-color);
    opacity: 0.7;
    transition: opacity 0.2s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    width: 18px;
    height: 18px;
    border-radius: 50%;
}

.remove-filter:hover {
    opacity: 1;
    background: rgba(255, 255, 255, 0.3);
}

/* Restaurant Grid */
.restaurants-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
    gap: 2rem;
    padding: 1rem 0;
}

.restaurant-card {
    background: var(--card-bg);
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    position: relative;
    border: 1px solid #f3f4f6;
}

.restaurant-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 40px rgba(0, 0, 0, 0.1);
}

.card-link {
    text-decoration: none;
    color: inherit;
    display: block;
    height: 100%;
}

.card-media {
    position: relative;
    width: 100%;
    padding-top: 60%;
    overflow: hidden;
}

.card-image-container {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
}

.card-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s ease;
}

.restaurant-card:hover .card-image {
    transform: scale(1.05);
}

.badge {
    position: absolute;
    top: 1rem;
    right: 1rem;
    background: var(--accent-color);
    color: white;
    padding: 0.25rem 0.75rem;
    border-radius: 50px;
    font-size: 0.75rem;
    font-weight: 600;
    z-index: 2;
}

.card-rating {
    position: absolute;
    bottom: 1rem;
    left: 1rem;
    background: rgba(0, 0, 0, 0.85);
    color: white;
    padding: 0.5rem 0.875rem;
    border-radius: 50px;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.9rem;
    font-weight: 600;
    backdrop-filter: blur(8px);
    border: 1px solid rgba(255, 255, 255, 0.1);
    z-index: 2;
}

.stars {
    --percent: calc(var(--rating) / 5 * 100%);
    display: inline-block;
    font-size: 0.8rem;
    position: relative;
    color: #e5e7eb;
    white-space: nowrap;
}

.stars::before {
    content: '★★★★★';
    letter-spacing: 2px;
    background: linear-gradient(90deg, #ffd700 var(--percent), #e5e7eb var(--percent));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

.review-count {
    font-size: 0.8em;
    opacity: 0.9;
}

.card-details {
    padding: 1.5rem;
}

.card-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 0.75rem;
}

.card-title {
    font-size: 1.25rem;
    font-weight: 700;
    color: #111827;
    margin: 0;
    line-height: 1.3;
}

.delivery-time {
    display: flex;
    align-items: center;
    gap: 0.25rem;
    font-size: 0.9rem;
    color: #4b5563;
    background: #f3f4f6;
    padding: 0.25rem 0.75rem;
    border-radius: 50px;
    white-space: nowrap;
}

.card-meta {
    display: flex;
    flex-wrap: wrap;
    gap: 0.75rem;
    margin: 0.75rem 0;
    font-size: 0.9rem;
    color: #6b7280;
}

.cuisine-tag {
    background: rgba(255, 107, 53, 0.1);
    color: var(--primary-color);
    padding: 0.25rem 0.75rem;
    border-radius: 50px;
    font-size: 0.8rem;
    font-weight: 600;
    display: inline-flex;
    align-items: center;
    gap: 0.25rem;
    border: 1px solid rgba(255, 107, 53, 0.2);
}

.cuisine-tag i {
    color: var(--primary-color);
    font-size: 0.7em;
}

.min-order {
    display: inline-flex;
    align-items: center;
    gap: 0.35rem;
    background: #f8fafc;
    padding: 0.35rem 0.75rem;
    border-radius: 50px;
    font-size: 0.8rem;
    color: #4b5563;
}

.min-order i {
    color: var(--primary-color);
    font-size: 0.7em;
}

.card-description {
    color: #6b7280;
    font-size: 0.95rem;
    line-height: 1.6;
    margin: 1rem 0;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
    text-overflow: ellipsis;
}

.card-actions {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 1.25rem;
    padding-top: 1rem;
    border-top: 1px solid #f3f4f6;
}

.btn-outline {
    background: transparent;
    border: 1px solid var(--primary-color);
    color: var(--primary-color);
    transition: all 0.2s ease;
}

.btn-outline:hover {
    background: rgba(67, 97, 238, 0.05);
    transform: none;
}

.btn-sm {
    padding: 0.5rem 1.25rem;
    font-size: 0.9rem;
}

.btn i {
    margin-right: 0;
}

/* No Results */
.no-results-container {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 50vh;
    padding: 2rem;
}

.no-results {
    text-align: center;
    max-width: 500px;
    margin: 0 auto;
}

.no-results-illustration {
    margin-bottom: 2rem;
    opacity: 0.8;
}

.no-results h2 {
    font-size: 1.75rem;
    color: #1f2937;
    margin-bottom: 1rem;
}

.no-results p {
    color: #6b7280;
    font-size: 1.05rem;
    line-height: 1.6;
    margin-bottom: 2rem;
}

.no-results-actions {
    display: flex;
    gap: 1rem;
    justify-content: center;
    flex-wrap: wrap;
}

/* Responsive Design */
@media (max-width: 1024px) {
    .restaurants-grid {
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 1.5rem;
    }
}

@media (max-width: 768px) {
    .restaurants-hero h1 {
        font-size: 2.2rem;
    }
    
    .restaurants-hero p {
        font-size: 1.1rem;
    }
    
    .restaurant-filters {
        padding: 1.5rem;
    }
    
    .search-input-group {
        flex-direction: column;
        border-radius: 12px;
        overflow: visible;
        border: none;
        gap: 1rem;
    }
    
    .search-input-group input {
        width: 100%;
        padding: 1rem 1.25rem;
        border: 1px solid #e5e7eb;
        border-radius: 8px;
    }
    
    .search-btn {
        width: 100%;
        justify-content: center;
        margin: 0;
        border-radius: 8px;
    }
    
    .filter-options {
        flex-direction: column;
        align-items: stretch;
        gap: 1rem;
    }
    
    .filter-group {
        min-width: 100%;
    }
    
    .custom-select select {
        padding: 1rem;
        font-size: 0.9rem;
    }
    
    .filter-group label {
        font-size: 0.9rem;
        margin-bottom: 0.5rem;
    }
}

@media (max-width: 576px) {
    .restaurants-hero {
        padding: 3rem 0 1.5rem;
        border-radius: 0 0 16px 16px;
    }
    
    .restaurants-hero h1 {
        font-size: 1.8rem;
    }
    
    .restaurants-hero p {
        font-size: 1rem;
    }
    
    .restaurant-filters {
        padding: 1rem;
        margin-top: 1rem;
    }
    
    .search-filter-form {
        gap: 1rem;
    }
    
    .search-input-group input {
        padding: 0.875rem 1rem;
        font-size: 0.9rem;
    }
    
    .search-btn {
        padding: 0.875rem 1.5rem;
        font-size: 0.9rem;
    }
    
    .filter-options {
        gap: 0.75rem;
    }
    
    .custom-select select {
        padding: 0.875rem 1rem;
        font-size: 0.85rem;
    }
    
    .filter-group label {
        font-size: 0.85rem;
        margin-bottom: 0.375rem;
    }
    
    .active-filters {
        margin-top: 0.75rem;
    }
    
    .filter-tag {
        font-size: 0.8rem;
        padding: 0.375rem 0.75rem;
    }
    
    .restaurants-grid {
        grid-template-columns: 1fr;
        gap: 1.25rem;
    }
    
    .no-results-actions {
        flex-direction: column;
    }
    
    .no-results-actions .btn {
        width: 100%;
    }
}

@media (max-width: 400px) {
    .restaurant-filters {
        padding: 0.75rem;
        margin-top: 0.75rem;
    }
    
    .search-filter-form {
        gap: 0.75rem;
    }
    
    .search-input-group input {
        padding: 0.75rem 0.875rem;
        font-size: 0.85rem;
    }
    
    .search-btn {
        padding: 0.75rem 1rem;
        font-size: 0.85rem;
    }
    
    .filter-options {
        gap: 0.5rem;
    }
    
    .custom-select select {
        padding: 0.75rem 0.875rem;
        font-size: 0.8rem;
    }
    
    .filter-group label {
        font-size: 0.8rem;
        margin-bottom: 0.25rem;
    }
    
    .filter-tag {
        font-size: 0.75rem;
        padding: 0.25rem 0.5rem;
    }
    
    .restaurants-grid {
        gap: 1rem;
    }
}

/* Animations */
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}

.fade-in {
    animation: fadeIn 0.5s ease-out forwards;
}

/* Loading Skeleton */
.skeleton {
    background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
    background-size: 200% 100%;
    animation: loading 1.5s infinite;
    border-radius: 4px;
}

@keyframes loading {
    0% { background-position: 200% 0; }
    100% { background-position: -200% 0; }
}

/* Accessibility */
.sr-only {
    position: absolute;
    width: 1px;
    height: 1px;
    padding: 0;
    margin: -1px;
    overflow: hidden;
    clip: rect(0, 0, 0, 0);
    white-space: nowrap;
    border: 0;
}

/* Focus styles for better keyboard navigation */
:focus-visible {
    outline: 3px solid var(--primary-color);
    outline-offset: 2px;
    border-radius: 4px;
}

/* Print styles */
@media print {
    .no-print {
        display: none !important;
    }
    
    .restaurant-card {
        break-inside: avoid;
        page-break-inside: avoid;
    }
}

/* Additional styles for the restaurants page */
.page-header {
    text-align: center;
    margin: 2rem 0 3rem;
}

.page-header h1 {
    font-size: 2.5rem;
    color: var(--dark-color);
    margin-bottom: 0.5rem;
}

.page-header p {
    color: #666;
    font-size: 1.1rem;
}

/* Search and filter styles */
.restaurant-filters {
    background: var(--card-bg);
    padding: 1.5rem;
    border-radius: var(--border-radius);
    box-shadow: var(--box-shadow);
    margin-bottom: 2rem;
}

.search-filter-form {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
}

.search-container {
    width: 100%;
    max-width: 800px;
    margin: 0 auto;
}

.search-input-group {
    display: flex;
    align-items: center;
    background: #f5f5f5;
    border-radius: 50px;
    overflow: hidden;
    padding: 0.5rem 0.5rem 0.5rem 1.5rem;
}

.search-input-group i {
    color: #666;
    margin-right: 0.5rem;
}

.search-input-group input {
    flex: 1;
    border: none;
    background: transparent;
    padding: 0.75rem 0.5rem;
    font-size: 1rem;
    outline: none;
}

.search-input-group button {
    border: none;
    background: var(--primary-color);
    color: white;
    padding: 0.75rem 1.5rem;
    border-radius: 50px;
    cursor: pointer;
    font-weight: 600;
    transition: var(--transition);
}

.search-input-group button:hover {
    background: #ff5252;
}

.filter-options {
    display: flex;
    flex-wrap: wrap;
    gap: 1.5rem;
    justify-content: center;
    margin-top: 1rem;
}

.filter-group {
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.filter-group label {
    font-weight: 500;
    color: #555;
}

.filter-group select {
    padding: 0.5rem 1rem;
    border: 1px solid #ddd;
    border-radius: 50px;
    background: var(--card-bg);
    cursor: pointer;
    outline: none;
    transition: var(--transition);
}

.filter-group select:hover,
.filter-group select:focus {
    border-color: var(--primary-color);
}

/* Restaurant card styles */
.restaurants-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    gap: 2rem;
    margin-bottom: 3rem;
}

.restaurant-card {
    background: var(--card-bg);
    border-radius: var(--border-radius);
    overflow: hidden;
    box-shadow: var(--box-shadow);
    transition: var(--transition);
}

.restaurant-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
}

.card-link {
    text-decoration: none;
    color: inherit;
    display: block;
    height: 100%;
}

.card-img-container {
    position: relative;
    width: 100%;
    height: 200px;
    overflow: hidden;
}

.card-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s ease;
}

.restaurant-card:hover .card-img {
    transform: scale(1.05);
}

.card-badge {
    position: absolute;
    top: 1rem;
    left: 1rem;
    background: rgba(255, 255, 255, 0.9);
    padding: 0.35rem 0.75rem;
    border-radius: 50px;
    font-weight: 600;
    font-size: 0.9rem;
    display: flex;
    align-items: center;
    gap: 0.25rem;
    color: var(--warning-color);
}

.card-badge .review-count {
    color: #666;
    font-size: 0.8rem;
    font-weight: normal;
}

.card-content {
    padding: 1.5rem;
}

.card-content h3 {
    margin: 0 0 0.5rem;
    font-size: 1.25rem;
    color: var(--dark-color);
}

.cuisine {
    color: #666;
    font-size: 0.9rem;
    margin-bottom: 1rem;
    display: block;
}

.restaurant-meta {
    display: flex;
    gap: 1.5rem;
    margin-top: 1rem;
    font-size: 0.9rem;
    color: #555;
}

.restaurant-meta i {
    margin-right: 0.25rem;
    color: var(--primary-color);
}

.description {
    margin-top: 1rem;
    color: #666;
    font-size: 0.9rem;
    line-height: 1.5;
}

/* Pagination styles */
.pagination {
    display: flex;
    justify-content: center;
    gap: 0.5rem;
    margin: 3rem 0;
    flex-wrap: wrap;
}

.page-link {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: var(--card-bg);
    color: #333;
    text-decoration: none;
    font-weight: 500;
    transition: var(--transition);
    border: 1px solid #eee;
}

.page-link:hover,
.page-link.active {
    background: var(--primary-color);
    color: white;
    border-color: var(--primary-color);
}

.page-ellipsis {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 40px;
    height: 40px;
    color: #666;
}

/* No results styles */
.no-results {
    text-align: center;
    padding: 4rem 2rem;
    background: var(--card-bg);
    border-radius: var(--border-radius);
    box-shadow: var(--box-shadow);
}

.no-results-icon {
    font-size: 3rem;
    color: #ddd;
    margin-bottom: 1.5rem;
}

.no-results h3 {
    color: #333;
    margin-bottom: 0.5rem;
}

.no-results p {
    color: #666;
    margin-bottom: 1.5rem;
    max-width: 500px;
    margin-left: auto;
    margin-right: auto;
}

/* Responsive styles */
@media (max-width: 768px) {
    .restaurants-grid {
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        gap: 1.5rem;
    }
    
    .filter-options {
        flex-direction: column;
        align-items: flex-start;
        gap: 1rem;
    }
    
    .filter-group {
        width: 100%;
    }
    
    .filter-group select {
        flex: 1;
    }
}

@media (max-width: 480px) {
    .restaurants-grid {
        grid-template-columns: 1fr;
    }
    
    .page-header h1 {
        font-size: 2rem;
    }
    
    .search-input-group {
        flex-direction: column;
        border-radius: var(--border-radius);
        padding: 0;
        background: transparent;
    }
    
    .search-input-group input {
        width: 100%;
        padding: 0.75rem 1rem;
        border: 1px solid #ddd;
        border-radius: var(--border-radius);
        margin-bottom: 0.5rem;
    }
    
    .search-input-group button {
        width: 100%;
        border-radius: var(--border-radius);
    }
}
</style>

<script>
// Add to favorites functionality
document.addEventListener('DOMContentLoaded', function() {
    // Initialize favorite buttons
    const favoriteButtons = document.querySelectorAll('.btn-favorite');
    
    favoriteButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            
            const icon = this.querySelector('i');
            const isFavorite = icon.classList.contains('fas');
            
            // Toggle icon
            if (isFavorite) {
                icon.classList.remove('fas', 'text-danger');
                icon.classList.add('far');
            } else {
                icon.classList.remove('far');
                icon.classList.add('fas', 'text-danger');
            }
            
            // In a real app, you would make an AJAX call to save the favorite
            // const restaurantId = this.closest('.restaurant-card').dataset.id;
            // toggleFavorite(restaurantId, !isFavorite);
        });
    });
});

// Function to toggle favorite (would be used with AJAX)
function toggleFavorite(restaurantId, isFavorite) {
    // This is a placeholder for the actual AJAX call
    console.log(`Restaurant ${restaurantId} ${isFavorite ? 'added to' : 'removed from'} favorites`);
    
    // Example of how the AJAX call might look:
    /*
    fetch('api/toggle-favorite.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            restaurant_id: restaurantId,
            is_favorite: isFavorite
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Show success message or update UI
        } else {
            // Show error message
        }
    });
    */
}
</script>

<?php require_once '../includes/footer.php'; ?>

<script>
// Add to favorites functionality
document.addEventListener('DOMContentLoaded', function() {
    // Initialize favorite buttons
    const favoriteButtons = document.querySelectorAll('.btn-favorite');
    
    favoriteButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            
            const icon = this.querySelector('i');
            const isFavorite = icon.classList.contains('fas');
            
            // Toggle icon
            if (isFavorite) {
                icon.classList.remove('fas', 'text-danger');
                icon.classList.add('far');
            } else {
                icon.classList.remove('far');
                icon.classList.add('fas', 'text-danger');
            }
            
            // In a real app, you would make an AJAX call to save the favorite
            // const restaurantId = this.closest('.restaurant-card').dataset.id;
            // toggleFavorite(restaurantId, !isFavorite);
        });
    });
});

// Function to toggle favorite (would be used with AJAX)
function toggleFavorite(restaurantId, isFavorite) {
    // This is a placeholder for the actual AJAX call
    console.log(`Restaurant ${restaurantId} ${isFavorite ? 'added to' : 'removed from'} favorites`);
    
    // Example of how the AJAX call might look:
    /*
    fetch('api/toggle-favorite.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            restaurant_id: restaurantId,
            is_favorite: isFavorite
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Show success message or update UI
        } else {
            // Show error message
        }
    });
    */
}
</script>
<script src="../assets/js/main.js"></script>
