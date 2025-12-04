<?php
require_once '../includes/header.php';
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
    display: none;
    flex-direction: column;
    cursor: pointer;
    gap: 4px;
    padding: var(--spacing-sm);
    border-radius: var(--border-radius);
    transition: var(--transition);
}

.hamburger:hover {
    background: var(--card-bg);
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

/* Restaurant Header */
.restaurant-header {
    position: relative;
    height: 400px;
    overflow: hidden;
    margin-top: 70px;
}

.restaurant-hero {
    position: relative;
    height: 100%;
    background: linear-gradient(rgba(0,0,0,0.4), rgba(0,0,0,0.6)), url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><rect fill="%232d3748" width="100" height="100"/></svg>');
    background-size: cover;
    background-position: center;
    display: flex;
    align-items: center;
    justify-content: center;
}

.restaurant-hero-content {
    text-align: center;
    color: white;
    z-index: 2;
    position: relative;
}

.restaurant-hero h1 {
    font-size: 3rem;
    margin-bottom: var(--spacing-md);
    text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
}

.restaurant-hero p {
    font-size: 1.25rem;
    margin-bottom: var(--spacing-lg);
    opacity: 0.9;
}

.restaurant-info {
    display: flex;
    justify-content: center;
    gap: var(--spacing-lg);
    flex-wrap: wrap;
}

.info-item {
    display: flex;
    align-items: center;
    gap: var(--spacing-xs);
    font-size: 1rem;
}

/* Restaurant Details */
.restaurant-details {
    background: var(--card-bg);
    border: 1px solid var(--border-color);
    border-radius: var(--border-radius-lg);
    padding: var(--spacing-xl);
    margin: -50px auto 0;
    position: relative;
    z-index: 10;
    max-width: 1200px;
    box-shadow: var(--shadow-xl);
}

.details-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: var(--spacing-lg);
    margin-bottom: var(--spacing-lg);
}

.detail-item {
    text-align: center;
}

.detail-item h3 {
    color: var(--primary-color);
    margin-bottom: var(--spacing-xs);
    font-size: 1.5rem;
}

.detail-item p {
    color: var(--text-muted);
    font-size: 0.875rem;
    margin-bottom: 0;
}

/* Menu Section */
.menu-section {
    margin-top: var(--spacing-2xl);
}

.menu-header {
    text-align: center;
    margin-bottom: var(--spacing-xl);
}

.menu-header h2 {
    font-size: 2.5rem;
    margin-bottom: var(--spacing-md);
}

.menu-header p {
    font-size: 1.125rem;
    color: var(--text-muted);
}

/* Categories */
.category-tabs {
    display: flex;
    justify-content: center;
    gap: var(--spacing-sm);
    margin-bottom: var(--spacing-xl);
    flex-wrap: wrap;
}

.category-tab {
    padding: var(--spacing-sm) var(--spacing-lg);
    background: var(--card-bg);
    border: 1px solid var(--border-color);
    border-radius: var(--border-radius);
    color: var(--text-primary);
    cursor: pointer;
    transition: var(--transition);
    font-weight: 500;
}

.category-tab:hover,
.category-tab.active {
    background: var(--primary-color);
    border-color: var(--primary-color);
    color: white;
}

/* Menu Items Grid */
.menu-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: var(--spacing-lg);
    margin-bottom: var(--spacing-xl);
}

/* Menu Item Card */
.menu-item {
    background: var(--card-bg);
    border: 1px solid var(--border-color);
    border-radius: var(--border-radius-lg);
    overflow: hidden;
    transition: var(--transition);
    display: flex;
    flex-direction: column;
}

.menu-item:hover {
    transform: translateY(-5px);
    box-shadow: var(--shadow-xl);
    border-color: var(--primary-color);
}

.menu-item-img {
    width: 100%;
    height: 200px;
    object-fit: cover;
    background: var(--light-bg);
}

.menu-item-content {
    padding: var(--spacing-md);
    flex: 1;
    display: flex;
    flex-direction: column;
}

.menu-item-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: var(--spacing-sm);
}

.menu-item-title {
    font-size: 1.125rem;
    font-weight: 600;
    color: var(--text-primary);
    margin-bottom: var(--spacing-xs);
}

.menu-item-price {
    font-size: 1.25rem;
    font-weight: 700;
    color: var(--primary-color);
}

.menu-item-description {
    color: var(--text-muted);
    font-size: 0.875rem;
    line-height: 1.5;
    margin-bottom: var(--spacing-md);
    flex: 1;
}

.menu-item-footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding-top: var(--spacing-md);
    border-top: 1px solid var(--border-color);
}

.menu-item-rating {
    display: flex;
    align-items: center;
    gap: var(--spacing-xs);
    color: var(--warning-color);
    font-size: 0.875rem;
}

.add-to-cart {
    background: var(--primary-color);
    color: white;
    border: none;
    border-radius: var(--border-radius);
    padding: var(--spacing-sm) var(--spacing-md);
    font-size: 0.875rem;
    font-weight: 600;
    cursor: pointer;
    transition: var(--transition);
}

.add-to-cart:hover {
    background: var(--primary-dark);
    transform: translateY(-2px);
}

/* Quantity Controls */
.quantity-controls {
    display: flex;
    align-items: center;
    gap: var(--spacing-sm);
}

.quantity-btn {
    background: var(--light-bg);
    border: 1px solid var(--border-color);
    border-radius: var(--border-radius);
    width: 32px;
    height: 32px;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: var(--transition);
    color: var(--text-primary);
}

.quantity-btn:hover {
    background: var(--primary-color);
    border-color: var(--primary-color);
    color: white;
}

.quantity-display {
    min-width: 40px;
    text-align: center;
    font-weight: 600;
    color: var(--text-primary);
}

/* Reviews Section */
.reviews-section {
    margin-top: var(--spacing-2xl);
}

.reviews-header {
    text-align: center;
    margin-bottom: var(--spacing-xl);
}

.reviews-header h2 {
    font-size: 2.5rem;
    margin-bottom: var(--spacing-md);
}

.reviews-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: var(--spacing-lg);
    margin-bottom: var(--spacing-xl);
}

.review-card {
    background: var(--card-bg);
    border: 1px solid var(--border-color);
    border-radius: var(--border-radius-lg);
    padding: var(--spacing-lg);
    transition: var(--transition);
}

.review-card:hover {
    transform: translateY(-2px);
    box-shadow: var(--shadow-lg);
}

.review-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: var(--spacing-md);
}

.review-author {
    font-weight: 600;
    color: var(--text-primary);
}

.review-rating {
    color: var(--warning-color);
}

.review-date {
    color: var(--text-muted);
    font-size: 0.875rem;
    margin-bottom: var(--spacing-sm);
}

.review-text {
    color: var(--text-secondary);
    line-height: 1.6;
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
    
    .restaurant-hero h1 {
        font-size: 2rem;
    }
    
    .restaurant-hero p {
        font-size: 1rem;
    }
    
    .restaurant-info {
        gap: var(--spacing-md);
    }
    
    .details-grid {
        grid-template-columns: repeat(2, 1fr);
    }
    
    .menu-grid {
        grid-template-columns: 1fr;
    }
    
    .category-tabs {
        gap: var(--spacing-xs);
    }
    
    .category-tab {
        padding: var(--spacing-xs) var(--spacing-md);
        font-size: 0.875rem;
    }
}

@media (max-width: 480px) {
    .container {
        padding: 0 var(--spacing-sm);
    }
    
    .restaurant-header {
        height: 300px;
        margin-top: 70px;
    }
    
    .restaurant-details {
        padding: var(--spacing-lg);
        margin: -30px var(--spacing-sm) 0;
    }
    
    .details-grid {
        grid-template-columns: 1fr;
        gap: var(--spacing-md);
    }
    
    .menu-item-img {
        height: 150px;
    }
    
    .menu-item-content {
        padding: var(--spacing-sm);
    }
    
    .btn {
        padding: var(--spacing-sm) var(--spacing-md);
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

// Check if restaurant ID is provided
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header('Location: restaurants.php');
    exit();
}

$restaurant_id = (int)$_GET['id'];

// Fetch restaurant details
$restaurant = [];
$sql = "SELECT r.*, 
        (SELECT AVG(rating) FROM reviews WHERE restaurant_id = r.id) as avg_rating,
        (SELECT COUNT(*) FROM reviews WHERE restaurant_id = r.id) as review_count
        FROM restaurants r 
        WHERE r.id = ? AND r.is_active = 1";

if ($stmt = $conn->prepare($sql)) {
    $stmt->bind_param("i", $restaurant_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $restaurant = $result->fetch_assoc();
    $stmt->close();
}

// If restaurant not found or not active, redirect
if (empty($restaurant)) {
    $_SESSION['error_message'] = 'Restaurant not found or is not available.';
    header('Location: restaurants.php');
    exit();
}

// Fetch restaurant categories and menu items
$categories = [];
$menu_items = [];

// Get all active categories for this restaurant
$category_sql = "SELECT DISTINCT c.* 
                FROM categories c
                JOIN foods f ON c.id = f.category_id
                WHERE f.restaurant_id = ? AND f.is_available = 1 AND c.is_active = 1
                ORDER BY c.name";

if ($stmt = $conn->prepare($category_sql)) {
    $stmt->bind_param("i", $restaurant_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $categories = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
}

// Get all menu items for this restaurant
$menu_sql = "SELECT f.*, c.name as category_name 
            FROM foods f
            LEFT JOIN categories c ON f.category_id = c.id
            WHERE f.restaurant_id = ? AND f.is_available = 1
            ORDER BY c.name, f.name";

if ($stmt = $conn->prepare($menu_sql)) {
    $stmt->bind_param("i", $restaurant_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $menu_items = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
}

// Group menu items by category
$menu_by_category = [];
foreach ($menu_items as $item) {
    $category_id = $item['category_id'] ?? 0;
    $category_name = $item['category_name'] ?? 'Other';
    
    if (!isset($menu_by_category[$category_id])) {
        $menu_by_category[$category_id] = [
            'name' => $category_name,
            'items' => []
        ];
    }
    
    $menu_by_category[$category_id]['items'][] = $item;
}

// Get restaurant reviews
$reviews = [];
$review_sql = "SELECT r.*, u.name as user_name, u.profile_image 
              FROM reviews r
              JOIN users u ON r.user_id = u.id
              WHERE r.restaurant_id = ?
              ORDER BY r.created_at DESC
              LIMIT 5";

if ($stmt = $conn->prepare($review_sql)) {
    $stmt->bind_param("i", $restaurant_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $reviews = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
}

// Calculate rating percentages
$rating_counts = [5 => 0, 4 => 0, 3 => 0, 2 => 0, 1 => 0];
$total_reviews = count($reviews);

foreach ($reviews as $review) {
    $rating = (int)$review['rating'];
    if (isset($rating_counts[$rating])) {
        $rating_counts[$rating]++;
    }
}

$rating_percentages = [];
foreach ($rating_counts as $rating => $count) {
    $percentage = $total_reviews > 0 ? ($count / $total_reviews) * 100 : 0;
    $rating_percentages[$rating] = round($percentage);
}

// Set page title
$page_title = $restaurant['name'] . ' - FoodExpress';
?>

<!-- Restaurant Header -->
<div class="restaurant-header">
    <div class="restaurant-cover" 
         style="background-image: url('<?php echo !empty($restaurant['cover_image']) ? htmlspecialchars($restaurant['cover_image']) : 'https://via.placeholder.com/1920x500?text=' . urlencode($restaurant['name']); ?>');">
        <div class="restaurant-overlay"></div>
    </div>
    
    <div class="restaurant-info">
        <div class="container">
            <div class="restaurant-header-content">
                <div class="restaurant-logo">
                    <img src="<?php echo !empty($restaurant['logo']) ? htmlspecialchars($restaurant['logo']) : 'https://via.placeholder.com/120?text=' . urlencode(substr($restaurant['name'], 0, 2)); ?>" 
                         alt="<?php echo htmlspecialchars($restaurant['name']); ?>">
                </div>
                
                <div class="restaurant-details">
                    <div class="restaurant-title">
                        <h1><?php echo htmlspecialchars($restaurant['name']); ?></h1>
                        <div class="restaurant-rating">
                            <?php 
                            $rating = $restaurant['avg_rating'] ? (float)$restaurant['avg_rating'] : 0;
                            $full_stars = floor($rating);
                            $has_half_star = $rating - $full_stars >= 0.5;
                            $empty_stars = 5 - $full_stars - ($has_half_star ? 1 : 0);
                            
                            // Full stars
                            for ($i = 0; $i < $full_stars; $i++) {
                                echo '<i class="fas fa-star"></i>';
                            }
                            
                            // Half star
                            if ($has_half_star) {
                                echo '<i class="fas fa-star-half-alt"></i>';
                            }
                            
                            // Empty stars
                            for ($i = 0; $i < $empty_stars; $i++) {
                                echo '<i class="far fa-star"></i>';
                            }
                            ?>
                            <span class="rating-value"><?php echo number_format($rating, 1); ?></span>
                            <span class="review-count">(<?php echo $restaurant['review_count'] ?? 0; ?> reviews)</span>
                        </div>
                    </div>
                    
                    <div class="restaurant-meta">
                        <div class="meta-item">
                            <i class="fas fa-utensils"></i>
                            <span><?php echo htmlspecialchars($restaurant['cuisine']); ?></span>
                        </div>
                        
                        <div class="meta-item">
                            <i class="fas fa-map-marker-alt"></i>
                            <span><?php echo htmlspecialchars($restaurant['address']); ?></span>
                        </div>
                        
                        <div class="meta-item">
                            <i class="fas fa-clock"></i>
                            <span>Delivery: <?php echo $restaurant['delivery_time'] ?? '30-45 min'; ?></span>
                        </div>
                        
                        <div class="meta-item">
                            <i class="fas fa-shopping-bag"></i>
                            <span>Min. Order: $<?php echo number_format($restaurant['min_order'] ?? 0, 2); ?></span>
                        </div>
                        
                        <div class="meta-item">
                            <i class="fas fa-truck"></i>
                            <span>Delivery Fee: $<?php echo number_format($restaurant['delivery_fee'] ?? 2.99, 2); ?></span>
                        </div>
                    </div>
                    
                    <div class="restaurant-actions">
                        <button class="btn btn-outline btn-favorite">
                            <i class="far fa-heart"></i> Save
                        </button>
                        <button class="btn btn-primary" id="orderNowBtn">Order Now</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <!-- Restaurant Navigation -->
    <nav class="restaurant-nav">
        <ul>
            <li class="active"><a href="#menu">Menu</a></li>
            <li><a href="#info">Info</a></li>
            <li><a href="#reviews">Reviews</a></li>
            <?php if (!empty($restaurant['description'])): ?>
                <li><a href="#about">About</a></li>
            <?php endif; ?>
        </ul>
    </nav>
    
    <div class="restaurant-content">
        <!-- Menu Section -->
        <section id="menu" class="restaurant-section">
            <h2 class="section-title">Menu</h2>
            
            <?php if (empty($menu_by_category)): ?>
                <div class="no-items">
                    <i class="fas fa-utensils"></i>
                    <p>No menu items available at the moment.</p>
                </div>
            <?php else: ?>
                <div class="menu-categories">
                    <?php foreach ($menu_by_category as $category_id => $category): ?>
                        <div class="menu-category" id="category-<?php echo $category_id; ?>">
                            <h3 class="category-title"><?php echo htmlspecialchars($category['name']); ?></h3>
                            
                            <div class="menu-items">
                                <?php foreach ($category['items'] as $item): ?>
                                    <div class="menu-item" data-id="<?php echo $item['id']; ?>"
                                         data-name="<?php echo htmlspecialchars($item['name']); ?>"
                                         data-price="<?php echo $item['price']; ?>"
                                         data-restaurant="<?php echo htmlspecialchars($restaurant['name']); ?>"
                                         data-image="<?php echo !empty($item['image']) ? htmlspecialchars($item['image']) : 'https://via.placeholder.com/300x200?text=' . urlencode($item['name']); ?>">
                                        <div class="item-image">
                                            <?php if (!empty($item['image'])): ?>
                                                <img src="<?php echo htmlspecialchars($item['image']); ?>" 
                                                     alt="<?php echo htmlspecialchars($item['name']); ?>">
                                            <?php else: ?>
                                                <div class="no-image">
                                                    <i class="fas fa-utensils"></i>
                                                </div>
                                            <?php endif; ?>
                                            
                                            <button class="btn-favorite" aria-label="Add to favorites">
                                                <i class="far fa-heart"></i>
                                            </button>
                                        </div>
                                        
                                        <div class="item-details">
                                            <h4 class="item-name"><?php echo htmlspecialchars($item['name']); ?></h4>
                                            
                                            <?php if (!empty($item['description'])): ?>
                                                <p class="item-description"><?php echo htmlspecialchars($item['description']); ?></p>
                                            <?php endif; ?>
                                            
                                            <div class="item-footer">
                                                <span class="item-price">$<?php echo number_format($item['price'], 2); ?></span>
                                                <button class="btn btn-sm btn-primary add-to-cart">
                                                    <i class="fas fa-plus"></i> Add
                                                </button>
                                            </div>
                                            
                                            <?php if ($item['is_vegetarian'] || $item['is_vegan'] || $item['is_gluten_free']): ?>
                                                <div class="item-dietary">
                                                    <?php if ($item['is_vegetarian']): ?>
                                                        <span class="dietary-tag vegetarian" title="Vegetarian">
                                                            <i class="fas fa-leaf"></i>
                                                        </span>
                                                    <?php endif; ?>
                                                    
                                                    <?php if ($item['is_vegan']): ?>
                                                        <span class="dietary-tag vegan" title="Vegan">
                                                            <i class="fas fa-seedling"></i>
                                                        </span>
                                                    <?php endif; ?>
                                                    
                                                    <?php if ($item['is_gluten_free']): ?>
                                                        <span class="dietary-tag gluten-free" title="Gluten Free">
                                                            GF
                                                        </span>
                                                    <?php endif; ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </section>
        
        <!-- Info Section -->
        <section id="info" class="restaurant-section">
            <h2 class="section-title">Restaurant Information</h2>
            
            <div class="info-grid">
                <div class="info-card">
                    <h3><i class="fas fa-clock"></i> Opening Hours</h3>
                    <div class="opening-hours">
                        <?php 
                        $hours = json_decode($restaurant['opening_hours'] ?? '{}', true);
                        $days = [
                            'monday' => 'Monday',
                            'tuesday' => 'Tuesday',
                            'wednesday' => 'Wednesday',
                            'thursday' => 'Thursday',
                            'friday' => 'Friday',
                            'saturday' => 'Saturday',
                            'sunday' => 'Sunday'
                        ];
                        
                        $today = strtolower(date('l'));
                        
                        foreach ($days as $day => $day_name):
                            $is_today = (strtolower($day_name) === $today);
                            $hours_text = $hours[$day]['is_closed'] ?? false ? 'Closed' : 
                                        ($hours[$day]['open'] . ' - ' . $hours[$day]['close']);
                        ?>
                            <div class="hour-row <?php echo $is_today ? 'today' : ''; ?>">
                                <span class="day"><?php echo $day_name; ?></span>
                                <span class="hours"><?php echo $hours_text; ?></span>
                                <?php if ($is_today): ?>
                                    <span class="badge">Today</span>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                
                <div class="info-card">
                    <h3><i class="fas fa-map-marker-alt"></i> Location</h3>
                    <div class="map-container">
                        <!-- In a real app, you would embed a Google Map here -->
                        <div class="map-placeholder">
                            <i class="fas fa-map-marked-alt"></i>
                            <p>Map of <?php echo htmlspecialchars($restaurant['name']); ?></p>
                        </div>
                        <p class="address">
                            <i class="fas fa-map-marker-alt"></i> 
                            <?php echo nl2br(htmlspecialchars($restaurant['address'])); ?>
                        </p>
                    </div>
                </div>
                
                <div class="info-card">
                    <h3><i class="fas fa-info-circle"></i> Additional Info</h3>
                    <ul class="additional-info">
                        <li>
                            <span class="info-label">Cuisine:</span>
                            <span class="info-value"><?php echo htmlspecialchars($restaurant['cuisine']); ?></span>
                        </li>
                        <li>
                            <span class="info-label">Average Cost:</span>
                            <span class="info-value">$<?php echo number_format($restaurant['average_cost'] ?? 15, 2); ?> for two people</span>
                        </li>
                        <li>
                            <span class="info-label">Minimum Order:</span>
                            <span class="info-value">$<?php echo number_format($restaurant['min_order'] ?? 0, 2); ?></span>
                        </li>
                        <li>
                            <span class="info-label">Delivery Fee:</span>
                            <span class="info-value">$<?php echo number_format($restaurant['delivery_fee'] ?? 2.99, 2); ?></span>
                        </li>
                        <li>
                            <span class="info-label">Delivery Time:</span>
                            <span class="info-value"><?php echo $restaurant['delivery_time'] ?? '30-45 min'; ?></span>
                        </li>
                        <?php if (!empty($restaurant['phone'])): ?>
                            <li>
                                <span class="info-label">Phone:</span>
                                <span class="info-value">
                                    <a href="tel:<?php echo preg_replace('/[^0-9+]/', '', $restaurant['phone']); ?>">
                                        <?php echo htmlspecialchars($restaurant['phone']); ?>
                                    </a>
                                </span>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </section>
        
        <?php if (!empty($restaurant['description'])): ?>
        <!-- About Section -->
        <section id="about" class="restaurant-section">
            <h2 class="section-title">About <?php echo htmlspecialchars($restaurant['name']); ?></h2>
            <div class="about-content">
                <?php echo nl2br(htmlspecialchars($restaurant['description'])); ?>
            </div>
        </section>
        <?php endif; ?>
        
        <!-- Reviews Section -->
        <section id="reviews" class="restaurant-section">
            <div class="reviews-header">
                <h2 class="section-title">Customer Reviews</h2>
                
                <div class="overall-rating">
                    <div class="rating-summary">
                        <div class="rating-average">
                            <span class="average"><?php echo number_format($restaurant['avg_rating'] ?? 0, 1); ?></span>
                            <span class="out-of">/5</span>
                        </div>
                        <div class="rating-stars">
                            <?php
                            $rating = $restaurant['avg_rating'] ? (float)$restaurant['avg_rating'] : 0;
                            $full_stars = floor($rating);
                            $has_half_star = $rating - $full_stars >= 0.5;
                            
                            for ($i = 1; $i <= 5; $i++) {
                                if ($i <= $full_stars) {
                                    echo '<i class="fas fa-star"></i>';
                                } elseif ($i == $full_stars + 1 && $has_half_star) {
                                    echo '<i class="fas fa-star-half-alt"></i>';
                                } else {
                                    echo '<i class="far fa-star"></i>';
                                }
                            }
                            ?>
                        </div>
                        <div class="total-reviews">
                            <?php echo $restaurant['review_count'] ?? 0; ?> reviews
                        </div>
                    </div>
                    
                    <div class="rating-bars">
                        <?php for ($i = 5; $i >= 1; $i--): ?>
                            <div class="rating-bar">
                                <span class="star-count"><?php echo $i; ?> <i class="fas fa-star"></i></span>
                                <div class="progress">
                                    <div class="progress-bar" style="width: <?php echo $rating_percentages[$i] ?? 0; ?>%;"></div>
                                </div>
                                <span class="percentage"><?php echo $rating_percentages[$i] ?? 0; ?>%</span>
                            </div>
                        <?php endfor; ?>
                    </div>
                </div>
                
                <?php if (isset($_SESSION['user_id'])): ?>
                    <button class="btn btn-primary" id="writeReviewBtn">
                        <i class="fas fa-pen"></i> Write a Review
                    </button>
                <?php else: ?>
                    <a href="../login.php?redirect=<?php echo urlencode($_SERVER['REQUEST_URI']); ?>" class="btn btn-primary">
                        Sign in to write a review
                    </a>
                <?php endif; ?>
            </div>
            
            <div class="reviews-list">
                <?php if (empty($reviews)): ?>
                    <div class="no-reviews">
                        <i class="far fa-comment-dots"></i>
                        <p>No reviews yet. Be the first to review!</p>
                    </div>
                <?php else: ?>
                    <?php foreach ($reviews as $review): ?>
                        <div class="review-item">
                            <div class="review-header">
                                <div class="reviewer">
                                    <div class="avatar">
                                        <?php if (!empty($review['profile_image'])): ?>
                                            <img src="<?php echo htmlspecialchars($review['profile_image']); ?>" 
                                                 alt="<?php echo htmlspecialchars($review['user_name']); ?>">
                                        <?php else: ?>
                                            <div class="avatar-initials">
                                                <?php 
                                                    $initials = '';
                                                    $name_parts = explode(' ', $review['user_name']);
                                                    foreach ($name_parts as $part) {
                                                        $initials .= strtoupper(substr($part, 0, 1));
                                                        if (strlen($initials) >= 2) break;
                                                    }
                                                    echo $initials;
                                                ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="reviewer-info">
                                        <h4><?php echo htmlspecialchars($review['user_name']); ?></h4>
                                        <div class="review-rating">
                                            <?php
                                            $rating = (int)$review['rating'];
                                            for ($i = 1; $i <= 5; $i++) {
                                                if ($i <= $rating) {
                                                    echo '<i class="fas fa-star"></i>';
                                                } else {
                                                    echo '<i class="far fa-star"></i>';
                                                }
                                            }
                                            ?>
                                            <span class="review-date">
                                                <?php echo date('M j, Y', strtotime($review['created_at'])); ?>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <?php if (!empty($review['comment'])): ?>
                                <div class="review-comment">
                                    <?php echo nl2br(htmlspecialchars($review['comment'])); ?>
                                </div>
                            <?php endif; ?>
                            
                            <?php if (!empty($review['reply'])): ?>
                                <div class="review-reply">
                                    <div class="reply-header">
                                        <i class="fas fa-reply"></i>
                                        <strong>Response from <?php echo htmlspecialchars($restaurant['name']); ?></strong>
                                    </div>
                                    <div class="reply-content">
                                        <?php echo nl2br(htmlspecialchars($review['reply'])); ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                    
                    <?php if ($restaurant['review_count'] > 5): ?>
                        <div class="view-all-reviews">
                            <a href="#" class="btn btn-outline">View All Reviews</a>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        </section>
    </div>
</div>

<!-- Review Modal -->
<div id="reviewModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3>Write a Review</h3>
            <button class="close-modal">&times;</button>
        </div>
        <div class="modal-body">
            <form id="reviewForm" method="POST" action="../api/submit_review.php">
                <input type="hidden" name="restaurant_id" value="<?php echo $restaurant_id; ?>">
                
                <div class="form-group">
                    <label>Your Rating</label>
                    <div class="star-rating">
                        <input type="radio" id="star5" name="rating" value="5" required>
                        <label for="star5" title="5 stars"><i class="fas fa-star"></i></label>
                        
                        <input type="radio" id="star4" name="rating" value="4" required>
                        <label for="star4" title="4 stars"><i class="fas fa-star"></i></label>
                        
                        <input type="radio" id="star3" name="rating" value="3" required>
                        <label for="star3" title="3 stars"><i class="fas fa-star"></i></label>
                        
                        <input type="radio" id="star2" name="rating" value="2" required>
                        <label for="star2" title="2 stars"><i class="fas fa-star"></i></label>
                        
                        <input type="radio" id="star1" name="rating" value="1" required>
                        <label for="star1" title="1 star"><i class="fas fa-star"></i></label>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="reviewTitle">Title</label>
                    <input type="text" id="reviewTitle" name="title" class="form-control" 
                           placeholder="Summarize your experience" required>
                </div>
                
                <div class="form-group">
                    <label for="reviewComment">Your Review</label>
                    <textarea id="reviewComment" name="comment" class="form-control" 
                              rows="5" placeholder="Share details of your experience at this restaurant" required></textarea>
                </div>
                
                <div class="form-actions">
                    <button type="button" class="btn btn-outline cancel-review">Cancel</button>
                    <button type="submit" class="btn btn-primary">Submit Review</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Add to Cart Modal -->
<div class="modal fade" id="addToCartModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add to Cart</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <img id="modalItemImage" src="" alt="Item image" class="img-fluid rounded">
                    </div>
                    <div class="col-md-8">
                        <h5 id="modalItemName"></h5>
                        <p id="modalItemDescription" class="text-muted"></p>
                        <h5 id="modalItemPrice" class="text-primary mb-4"></h5>
                        
                        <div class="mb-3">
                            <label for="itemQuantity" class="form-label">Quantity</label>
                            <div class="input-group" style="max-width: 150px;">
                                <button class="btn btn-outline-secondary btn-sm" type="button" id="decreaseQty">-</button>
                                <input type="number" class="form-control text-center" id="itemQuantity" value="1" min="1" max="20">
                                <button class="btn btn-outline-secondary btn-sm" type="button" id="increaseQty">+</button>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="itemNotes" class="form-label">Special Instructions (Optional)</label>
                            <textarea class="form-control" id="itemNotes" rows="2" placeholder="E.g. No onions, extra sauce, etc."></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="confirmAddToCart">
                    <i class="fas fa-cart-plus me-2"></i> Add to Cart - $<span id="modalItemTotal">0.00</span>
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Sticky Add to Cart Bar (Mobile) -->
<div class="sticky-add-to-cart">
    <div class="container">
        <div class="sticky-content">
            <div class="item-info">
                <span class="item-count">0</span> items | 
                <span class="total-amount">$0.00</span>
            </div>
            <button class="btn btn-primary" id="viewCartBtn">View Cart</button>
        </div>
    </div>
</div>

<style>
/* Restaurant Page Styles */
.restaurant-header {
    position: relative;
    margin-bottom: 2rem;
}

.restaurant-cover {
    height: 300px;
    background-size: cover;
    background-position: center;
    position: relative;
}

.restaurant-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(to bottom, rgba(0,0,0,0.2), rgba(0,0,0,0.7));
}

.restaurant-info {
    position: relative;
    background: white;
    border-radius: 10px;
    margin-top: -50px;
    padding: 2rem;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    z-index: 1;
}

.restaurant-header-content {
    display: flex;
    align-items: flex-start;
    gap: 2rem;
}

.restaurant-logo {
    width: 120px;
    height: 120px;
    border-radius: 10px;
    overflow: hidden;
    border: 3px solid white;
    box-shadow: 0 3px 10px rgba(0,0,0,0.1);
    flex-shrink: 0;
    margin-top: -60px;
}

.restaurant-logo img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.restaurant-details {
    flex: 1;
}

.restaurant-title h1 {
    margin: 0 0 0.5rem;
    font-size: 1.8rem;
    color: #333;
}

.restaurant-rating {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    margin-bottom: 1rem;
}

.restaurant-rating i {
    color: #ffc107;
}

.rating-value {
    font-weight: 600;
    color: #333;
}

.review-count {
    color: #666;
    font-size: 0.9rem;
}

.restaurant-meta {
    display: flex;
    flex-wrap: wrap;
    gap: 1.5rem;
    margin: 1.5rem 0;
}

.meta-item {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.95rem;
    color: #555;
}

.meta-item i {
    color: var(--primary-color);
}

.restaurant-actions {
    display: flex;
    gap: 1rem;
    margin-top: 1.5rem;
}

/* Restaurant Navigation */
.restaurant-nav {
    margin: 2rem 0 3rem;
    border-bottom: 1px solid #eee;
}

.restaurant-nav ul {
    display: flex;
    list-style: none;
    padding: 0;
    margin: 0;
    gap: 2rem;
}

.restaurant-nav li {
    position: relative;
    padding-bottom: 1rem;
}

.restaurant-nav a {
    text-decoration: none;
    color: #666;
    font-weight: 500;
    transition: color 0.3s;
}

.restaurant-nav li.active a {
    color: var(--primary-color);
}

.restaurant-nav li.active::after {
    content: '';
    position: absolute;
    bottom: -1px;
    left: 0;
    width: 100%;
    height: 3px;
    background: var(--primary-color);
    border-radius: 3px 3px 0 0;
}

/* Menu Section */
.menu-category {
    margin-bottom: 3rem;
}

.category-title {
    font-size: 1.5rem;
    color: #333;
    margin-bottom: 1.5rem;
    padding-bottom: 0.75rem;
    border-bottom: 2px solid #f0f0f0;
}

.menu-items {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    gap: 1.5rem;
}

.menu-item {
    background: white;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 3px 10px rgba(0,0,0,0.05);
    transition: transform 0.3s, box-shadow 0.3s;
    display: flex;
    flex-direction: column;
}

.menu-item:hover {
    transform: translateY(-5px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}

.item-image {
    position: relative;
    height: 180px;
    overflow: hidden;
}

.item-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s;
}

.menu-item:hover .item-image img {
    transform: scale(1.05);
}

.no-image {
    width: 100%;
    height: 100%;
    background: #f5f5f5;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #ccc;
    font-size: 2rem;
}

.btn-favorite {
    position: absolute;
    top: 10px;
    right: 10px;
    width: 36px;
    height: 36px;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.9);
    border: none;
    color: #ccc;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.3s;
}

.btn-favorite:hover {
    color: #ff6b6b;
    background: white;
}

.btn-favorite .fas {
    color: #ff6b6b;
}

.item-details {
    padding: 1.25rem;
    flex: 1;
    display: flex;
    flex-direction: column;
}

.item-name {
    margin: 0 0 0.5rem;
    font-size: 1.1rem;
    color: #333;
}

.item-description {
    color: #666;
    font-size: 0.9rem;
    margin: 0 0 1rem;
    flex: 1;
}

.item-footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 1rem;
}

.item-price {
    font-weight: 600;
    color: var(--primary-color);
    font-size: 1.1rem;
}

.item-dietary {
    display: flex;
    gap: 0.5rem;
    margin-top: 0.75rem;
}

.dietary-tag {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-size: 0.7rem;
    padding: 0.25rem 0.5rem;
    border-radius: 4px;
    font-weight: 500;
}

.dietary-tag.vegetarian {
    background: rgba(76, 175, 80, 0.1);
    color: #4CAF50;
}

.dietary-tag.vegan {
    background: rgba(139, 195, 74, 0.1);
    color: #8BC34A;
}

.dietary-tag.gluten-free {
    background: rgba(255, 152, 0, 0.1);
    color: #FF9800;
}

/* Info Section */
.info-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 2rem;
    margin-top: 2rem;
}

.info-card {
    background: white;
    border-radius: 8px;
    padding: 1.5rem;
    box-shadow: 0 3px 10px rgba(0,0,0,0.05);
}

.info-card h3 {
    margin-top: 0;
    margin-bottom: 1.5rem;
    color: #333;
    font-size: 1.25rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.info-card h3 i {
    color: var(--primary-color);
}

.opening-hours {
    display: flex;
    flex-direction: column;
    gap: 0.75rem;
}

.hour-row {
    display: flex;
    justify-content: space-between;
    padding: 0.5rem 0;
    position: relative;
}

.hour-row::after {
    content: '';
    position: absolute;
    left: 0;
    right: 0;
    bottom: 0;
    height: 1px;
    background: #f0f0f0;
}

.hour-row:last-child::after {
    display: none;
}

.hour-row.today {
    font-weight: 600;
}

.hour-row .badge {
    background: var(--primary-color);
    color: white;
    font-size: 0.7rem;
    padding: 0.2rem 0.5rem;
    border-radius: 10px;
    margin-left: 1rem;
}

.map-container {
    margin-top: 1rem;
}

.map-placeholder {
    height: 200px;
    background: #f5f5f5;
    border-radius: 8px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    color: #999;
    margin-bottom: 1rem;
}

.map-placeholder i {
    font-size: 2.5rem;
    margin-bottom: 0.5rem;
}

.address {
    color: #555;
    line-height: 1.6;
    margin: 0;
}

.additional-info {
    list-style: none;
    padding: 0;
    margin: 0;
}

.additional-info li {
    display: flex;
    margin-bottom: 0.75rem;
    padding-bottom: 0.75rem;
    border-bottom: 1px solid #f0f0f0;
}

.additional-info li:last-child {
    margin-bottom: 0;
    padding-bottom: 0;
    border-bottom: none;
}

.info-label {
    font-weight: 500;
    color: #555;
    min-width: 120px;
}

.info-value {
    color: #333;
    flex: 1;
}

/* Reviews Section */
.reviews-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 2rem;
    flex-wrap: wrap;
    gap: 1.5rem;
}

.overall-rating {
    display: flex;
    align-items: center;
    gap: 3rem;
    background: #f9f9f9;
    padding: 1.5rem;
    border-radius: 8px;
    flex: 1;
}

.rating-summary {
    text-align: center;
}

.rating-average {
    font-size: 2.5rem;
    font-weight: 700;
    color: #333;
    line-height: 1;
    margin-bottom: 0.5rem;
}

.rating-average .out-of {
    font-size: 1.5rem;
    color: #999;
    font-weight: 400;
}

.rating-stars {
    color: #ffc107;
    margin-bottom: 0.5rem;
}

.total-reviews {
    color: #666;
    font-size: 0.9rem;
}

.rating-bars {
    flex: 1;
    max-width: 400px;
}

.rating-bar {
    display: flex;
    align-items: center;
    margin-bottom: 0.75rem;
}

.star-count {
    width: 60px;
    font-size: 0.9rem;
    color: #666;
    display: flex;
    align-items: center;
    gap: 0.25rem;
}

.star-count i {
    color: #ffc107;
}

.progress {
    flex: 1;
    height: 8px;
    background: #f0f0f0;
    border-radius: 4px;
    margin: 0 1rem;
    overflow: hidden;
}

.progress-bar {
    height: 100%;
    background: #ffc107;
    border-radius: 4px;
}

.percentage {
    width: 40px;
    text-align: right;
    font-size: 0.9rem;
    color: #666;
}

.reviews-list {
    margin-top: 2rem;
}

.review-item {
    background: white;
    border-radius: 8px;
    padding: 1.5rem;
    margin-bottom: 1.5rem;
    box-shadow: 0 2px 10px rgba(0,0,0,0.05);
}

.review-header {
    margin-bottom: 1rem;
}

.reviewer {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.avatar {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    overflow: hidden;
    background: #f0f0f0;
    display: flex;
    align-items: center;
    justify-content: center;
}

.avatar img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.avatar-initials {
    font-weight: 600;
    color: #666;
    font-size: 1.2rem;
}

.reviewer-info h4 {
    margin: 0 0 0.25rem;
    font-size: 1rem;
    color: #333;
}

.review-rating {
    color: #ffc107;
    font-size: 0.9rem;
    display: flex;
    align-items: center;
    gap: 0.25rem;
}

.review-date {
    color: #999;
    font-size: 0.85rem;
    margin-left: 0.5rem;
}

.review-comment {
    color: #444;
    line-height: 1.6;
    margin-bottom: 1rem;
}

.review-reply {
    background: #f9f9f9;
    border-radius: 6px;
    padding: 1rem;
    margin-top: 1rem;
    border-right: 3px solid var(--primary-color);
}

.reply-header {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    color: #555;
    font-size: 0.9rem;
    margin-bottom: 0.5rem;
}

.reply-header i {
    color: var(--primary-color);
}

.reply-content {
    color: #555;
    font-size: 0.9rem;
    line-height: 1.5;
}

.view-all-reviews {
    text-align: center;
    margin-top: 2rem;
}

.no-reviews {
    text-align: center;
    padding: 3rem 1rem;
    color: #999;
}

.no-reviews i {
    font-size: 3rem;
    margin-bottom: 1rem;
    opacity: 0.5;
}

/* Modal Styles */
.modal {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.5);
    z-index: 1000;
    justify-content: center;
    align-items: center;
    padding: 1rem;
}

.modal.show {
    display: flex;
}

.modal-content {
    background: white;
    border-radius: 8px;
    width: 100%;
    max-width: 600px;
    max-height: 90vh;
    overflow-y: auto;
    box-shadow: 0 5px 20px rgba(0, 0, 0, 0.2);
    animation: modalFadeIn 0.3s;
}

@keyframes modalFadeIn {
    from {
        opacity: 0;
        transform: translateY(-20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.modal-header {
    padding: 1.25rem 1.5rem;
    border-bottom: 1px solid #eee;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.modal-header h3 {
    margin: 0;
    font-size: 1.25rem;
    color: #333;
}

.close-modal {
    background: none;
    border: none;
    font-size: 1.5rem;
    color: #999;
    cursor: pointer;
    padding: 0.5rem;
    line-height: 1;
    transition: color 0.2s;
}

.close-modal:hover {
    color: #333;
}

.modal-body {
    padding: 1.5rem;
}

/* Star Rating */
.star-rating {
    direction: rtl;
    display: inline-block;
    unicode-bidi: bidi-override;
    text-align: center;
}

.star-rating input[type="radio"] {
    display: none;
}

.star-rating label {
    color: #ddd;
    font-size: 1.5rem;
    padding: 0 0.25rem;
    cursor: pointer;
    transition: color 0.2s;
}

.star-rating label:hover,
.star-rating label:hover ~ label,
.star-rating input[type="radio"]:checked ~ label {
    color: #ffc107;
}

/* Form Styles */
.form-group {
    margin-bottom: 1.5rem;
}

.form-group label {
    display: block;
    margin-bottom: 0.5rem;
    font-weight: 500;
    color: #555;
}

.form-control {
    width: 100%;
    padding: 0.75rem 1rem;
    border: 1px solid #ddd;
    border-radius: 6px;
    font-size: 1rem;
    transition: border-color 0.3s;
}

.form-control:focus {
    outline: none;
    border-color: var(--primary-color);
    box-shadow: 0 0 0 3px rgba(255, 107, 107, 0.1);
}

textarea.form-control {
    min-height: 120px;
    resize: vertical;
}

.form-actions {
    display: flex;
    justify-content: flex-end;
    gap: 1rem;
    margin-top: 2rem;
}

/* Sticky Add to Cart Bar */
.sticky-add-to-cart {
    position: fixed;
    bottom: 0;
    left: 0;
    right: 0;
    background: white;
    box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.1);
    padding: 1rem 0;
    z-index: 100;
    display: none;
}

.sticky-content {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.sticky-add-to-cart .item-info {
    font-size: 1rem;
    color: #333;
}

.sticky-add-to-cart .item-count {
    font-weight: 600;
}

.sticky-add-to-cart .total-amount {
    color: var(--primary-color);
    font-weight: 600;
}

/* Responsive Styles */
@media (max-width: 992px) {
    .restaurant-header-content {
        flex-direction: column;
    }
    
    .restaurant-logo {
        width: 100px;
        height: 100px;
        margin-top: -50px;
        margin-left: 1rem;
    }
    
    .restaurant-actions {
        position: fixed;
        bottom: 1rem;
        right: 1rem;
        left: 1rem;
        z-index: 100;
    }
    
    .restaurant-actions .btn {
        flex: 1;
        padding: 0.75rem;
    }
    
    .sticky-add-to-cart {
        display: block;
    }
}

@media (max-width: 768px) {
    .restaurant-info {
        margin-top: -30px;
    }
    
    .restaurant-meta {
        flex-direction: column;
        gap: 0.75rem;
    }
    
    .overall-rating {
        flex-direction: column;
        gap: 1.5rem;
        text-align: center;
    }
    
    .rating-bars {
        width: 100%;
        max-width: 100%;
    }
    
    .reviews-header {
        flex-direction: column;
    }
    
    .reviews-header .btn {
        width: 100%;
    }
    
    .menu-items {
        grid-template-columns: 1fr;
    }
}

@media (max-width: 576px) {
    .restaurant-nav ul {
        overflow-x: auto;
        padding-bottom: 0.5rem;
        -webkit-overflow-scrolling: touch;
        scrollbar-width: none;
    }
    
    .restaurant-nav ul::-webkit-scrollbar {
        display: none;
    }
    
    .restaurant-nav li {
        white-space: nowrap;
    }
    
    .modal-content {
        margin: 1rem;
        width: calc(100% - 2rem);
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Add to cart functionality
    const addToCartButtons = document.querySelectorAll('.add-to-cart');
    const addToCartModal = new bootstrap.Modal(document.getElementById('addToCartModal'));
    let currentItem = null;
    
    // Initialize cart
    const cart = {
        items: [],
        total: 0,
        itemCount: 0,
        
        init() {
            this.loadCart();
            this.updateStickyCart();
        },
        
        loadCart() {
            const savedCart = localStorage.getItem('cart');
            if (savedCart) {
                const cartData = JSON.parse(savedCart);
                this.items = cartData.items || [];
                this.total = cartData.total || 0;
                this.itemCount = cartData.itemCount || 0;
            }
        },
        
        saveCart() {
            const cartData = {
                items: this.items,
                total: this.total,
                itemCount: this.itemCount
            };
            localStorage.setItem('cart', JSON.stringify(cartData));
            this.updateStickyCart();
        },
        
        addItem(item, quantity, specialInstructions = '') {
            // Check if item already exists in cart
            const existingItemIndex = this.items.findIndex(i => i.id === item.id);
            
            if (existingItemIndex > -1) {
                // Update quantity if item exists
                this.items[existingItemIndex].quantity += quantity;
                if (specialInstructions) {
                    this.items[existingItemIndex].specialInstructions = specialInstructions;
                }
            } else {
                // Add new item to cart
                const cartItem = {
                    ...item,
                    quantity,
                    specialInstructions
                };
                this.items.push(cartItem);
            }
            
            // Update cart totals
            this.updateTotals();
            this.saveCart();
            
            // Show success message
            this.showNotification('Item added to cart!');
        },
        
        updateTotals() {
            this.itemCount = this.items.reduce((total, item) => total + item.quantity, 0);
            this.total = this.items.reduce((total, item) => {
                return total + (item.price * item.quantity);
            }, 0);
        },
        
        updateStickyCart() {
            if (this.itemCount > 0) {
                itemCountEl.textContent = this.itemCount;
                totalAmountEl.textContent = '$' + this.total.toFixed(2);
                stickyCart.style.display = 'block';
            } else {
                stickyCart.style.display = 'none';
            }
        },
        
        showNotification(message) {
            // Create notification element
            const notification = document.createElement('div');
            notification.className = 'notification';
            notification.innerHTML = `
                <div class="notification-content">
                    <i class="fas fa-check-circle"></i>
                    <span>${message}</span>
                </div>
            `;
            
            // Add to DOM
            document.body.appendChild(notification);
            
            // Show notification
            setTimeout(() => {
                notification.classList.add('show');
            }, 100);
            
            // Hide after delay
            setTimeout(() => {
                notification.classList.remove('show');
                setTimeout(() => {
                    notification.remove();
                }, 300);
            }, 3000);
        }
    };
    
    // Initialize cart
    cart.init();
    
    // Add to cart button click handler
    addToCartButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            
            const menuItem = this.closest('.menu-item');
            currentItem = {
                id: menuItem.dataset.id,
                name: menuItem.dataset.name,
                price: parseFloat(menuItem.dataset.price),
                image: menuItem.dataset.image || 'https://via.placeholder.com/300x200?text=Food+Image',
                restaurant: menuItem.dataset.restaurant
            };
            
            // Update modal with item details
            document.getElementById('modalItemName').textContent = currentItem.name;
            document.getElementById('modalItemRestaurant').textContent = currentItem.restaurant;
            document.getElementById('modalItemPrice').textContent = '$' + currentItem.price.toFixed(2);
            document.getElementById('modalItemImage').src = currentItem.image;
            document.getElementById('modalItemImage').alt = currentItem.name;
            
            // Reset quantity and special instructions
            itemQuantity.value = 1;
            document.getElementById('specialInstructions').value = '';
            updateTotalPrice();
            
            // Show modal
            modal.style.display = 'flex';
            document.body.style.overflow = 'hidden';
        });
    });
    
    // Close modal when clicking close button or outside modal
    function closeModalHandler() {
        modal.style.display = 'none';
        document.body.style.overflow = 'auto';
    }
    
    closeModal.addEventListener('click', closeModalHandler);
    cancelAdd.addEventListener('click', closeModalHandler);
    
    // Close modal when clicking outside modal content
    window.addEventListener('click', function(e) {
        if (e.target === modal) {
            closeModalHandler();
        }
    });
    
    // Quantity controls
    document.getElementById('increaseQty').addEventListener('click', function() {
        const currentValue = parseInt(itemQuantity.value);
        if (currentValue < 10) {
            itemQuantity.value = currentValue + 1;
            updateTotalPrice();
        }
    });
    
    document.getElementById('decreaseQty').addEventListener('click', function() {
        const currentValue = parseInt(itemQuantity.value);
        if (currentValue > 1) {
            itemQuantity.value = currentValue - 1;
            updateTotalPrice();
        }
    });
    
    // Update total price when quantity changes
    itemQuantity.addEventListener('change', function() {
        let value = parseInt(this.value);
        if (isNaN(value) || value < 1) {
            value = 1;
            this.value = 1;
        } else if (value > 10) {
            value = 10;
            this.value = 10;
        }
        updateTotalPrice();
    });
    
    function updateTotalPrice() {
        if (currentItem) {
            const quantity = parseInt(itemQuantity.value) || 1;
            const total = (currentItem.price * quantity).toFixed(2);
            totalPriceEl.textContent = total;
        }
    }
    
    // Confirm add to cart
    confirmAdd.addEventListener('click', function() {
        if (currentItem) {
            const quantity = parseInt(itemQuantity.value) || 1;
            const specialInstructions = document.getElementById('specialInstructions').value;
            
            cart.addItem(currentItem, quantity, specialInstructions);
            closeModalHandler();
        }
    });
    
    // View cart button
    viewCartBtn.addEventListener('click', function(e) {
        e.preventDefault();
        window.location.href = '../cart.php';
    });
    
    // Smooth scrolling for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();
            
            const targetId = this.getAttribute('href');
            if (targetId === '#') return;
            
            const targetElement = document.querySelector(targetId);
            if (targetElement) {
                // Update active nav item
                document.querySelectorAll('.restaurant-nav li').forEach(li => {
                    li.classList.remove('active');
                });
                
                this.parentElement.classList.add('active');
                
                // Scroll to target
                window.scrollTo({
                    top: targetElement.offsetTop - 100,
                    behavior: 'smooth'
                });
            }
        });
    });
    
    // Update active nav item on scroll
    window.addEventListener('scroll', function() {
        const scrollPosition = window.scrollY + 150;
        
        document.querySelectorAll('.restaurant-section').forEach(section => {
            const sectionTop = section.offsetTop;
            const sectionHeight = section.offsetHeight;
            const sectionId = '#' + section.getAttribute('id');
            
            if (scrollPosition >= sectionTop && scrollPosition < sectionTop + sectionHeight) {
                document.querySelectorAll('.restaurant-nav li').forEach(li => {
                    li.classList.remove('active');
                    if (li.querySelector('a').getAttribute('href') === sectionId) {
                        li.classList.add('active');
                    }
                });
            }
        });
    });
    
    // Review modal functionality
    const reviewModal = document.getElementById('reviewModal');
    const writeReviewBtn = document.getElementById('writeReviewBtn');
    const cancelReviewBtn = document.querySelector('.cancel-review');
    const closeReviewModal = reviewModal.querySelector('.close-modal');
    
    if (writeReviewBtn) {
        writeReviewBtn.addEventListener('click', function() {
            reviewModal.style.display = 'flex';
            document.body.style.overflow = 'hidden';
        });
    }
    
    function closeReviewModalHandler() {
        reviewModal.style.display = 'none';
        document.body.style.overflow = 'auto';
    }
    
    if (cancelReviewBtn) cancelReviewBtn.addEventListener('click', closeReviewModalHandler);
    if (closeReviewModal) closeReviewModal.addEventListener('click', closeReviewModalHandler);
    
    // Star rating interaction
    const starInputs = document.querySelectorAll('.star-rating input[type="radio"]');
    const starLabels = document.querySelectorAll('.star-rating label');
    
    starLabels.forEach((label, index) => {
        label.addEventListener('mouseover', function() {
            // Highlight stars on hover
            const rating = 5 - index;
            highlightStars(rating);
        });
        
        label.addEventListener('mouseout', function() {
            // Restore selected rating on mouseout
            const selectedRating = document.querySelector('.star-rating input[type="radio"]:checked');
            const rating = selectedRating ? parseInt(selectedRating.value) : 0;
            highlightStars(rating);
        });
    });
    
    function highlightStars(rating) {
        starLabels.forEach((label, index) => {
            const starValue = 5 - index;
            const starIcon = label.querySelector('i');
            
            if (starValue <= rating) {
                starIcon.classList.remove('far');
                starIcon.classList.add('fas');
            } else {
                starIcon.classList.remove('fas');
                starIcon.classList.add('far');
            }
        });
    }
    
    // Handle form submission
    const reviewForm = document.getElementById('reviewForm');
    if (reviewForm) {
        reviewForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // In a real app, you would submit this to your server
            const formData = new FormData(this);
            const reviewData = {
                restaurant_id: formData.get('restaurant_id'),
                rating: formData.get('rating'),
                title: formData.get('title'),
                comment: formData.get('comment')
            };
            
            console.log('Submitting review:', reviewData);
            
            // Simulate form submission
            setTimeout(() => {
                closeReviewModalHandler();
                alert('Thank you for your review! It will be published after moderation.');
                // In a real app, you would refresh the reviews section here
            }, 1000);
        });
    }
    
    // Order now button scroll to menu
    const orderNowBtn = document.getElementById('orderNowBtn');
    if (orderNowBtn) {
        orderNowBtn.addEventListener('click', function() {
            const menuSection = document.getElementById('menu');
            if (menuSection) {
                window.scrollTo({
                    top: menuSection.offsetTop - 100,
                    behavior: 'smooth'
                });
            }
        });
    }
    
    // Initialize tooltips
    const tooltipElements = document.querySelectorAll('[title]');
    tooltipElements.forEach(element => {
        element.addEventListener('mouseover', function(e) {
            const tooltip = document.createElement('div');
            tooltip.className = 'tooltip';
            tooltip.textContent = this.getAttribute('title');
            document.body.appendChild(tooltip);
            
            const rect = this.getBoundingClientRect();
            tooltip.style.left = rect.left + 'px';
            tooltip.style.top = (rect.top - tooltip.offsetHeight - 10) + 'px';
            
            // Remove tooltip on mouseout
            this.addEventListener('mouseout', function() {
                tooltip.remove();
            }, { once: true });
        });
    });
});

// Add styles for notifications and tooltips
const style = document.createElement('style');
style.textContent = `
    /* Notification styles */
    .notification {
        position: fixed;
        bottom: 20px;
        right: 20px;
        background: #4CAF50;
        color: white;
        padding: 12px 20px;
        border-radius: 4px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        z-index: 1000;
        transform: translateY(100px);
        opacity: 0;
        transition: transform 0.3s ease, opacity 0.3s ease;
        max-width: 300px;
    }
    
    .notification.show {
        transform: translateY(0);
        opacity: 1;
    }
    
    .notification-content {
        display: flex;
        align-items: center;
        gap: 10px;
    }
    
    .notification i {
        font-size: 1.2rem;
    }
    
    /* Tooltip styles */
    .tooltip {
        position: absolute;
        background: #333;
        color: white;
        padding: 5px 10px;
        border-radius: 4px;
        font-size: 0.85rem;
        z-index: 1000;
        pointer-events: none;
        white-space: nowrap;
    }
    
    .tooltip::after {
        content: '';
        position: absolute;
        top: 100%;
        left: 50%;
        margin-left: -5px;
        border-width: 5px;
        border-style: solid;
        border-color: #333 transparent transparent transparent;
    }
`;
document.head.appendChild(style);
</script>

<?php require_once '../includes/footer.php'; ?>
