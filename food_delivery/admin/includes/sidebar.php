<?php
// admin/includes/sidebar.php
?>
<aside class="sidebar">
    <div class="sidebar-header">
        <h2>FoodExpress</h2>
    </div>
    <nav class="sidebar-menu">
        <ul>
            <li>
                <a href="dashboard.php" class="<?= basename($_SERVER['PHP_SELF']) == 'dashboard.php' ? 'active' : '' ?>">
                    <i class="fas fa-tachometer-alt"></i> Dashboard
                </a>
            </li>
            <li>
                <a href="restaurants.php" class="<?= basename($_SERVER['PHP_SELF']) == 'restaurants.php' ? 'active' : '' ?>">
                    <i class="fas fa-utensils"></i> Restaurants
                </a>
            </li>
            <li>
                <a href="foods.php" class="<?= basename($_SERVER['PHP_SELF']) == 'foods.php' ? 'active' : '' ?>">
                    <i class="fas fa-hamburger"></i> Foods
                </a>
            </li>
            <li>
                <a href="categories.php" class="<?= basename($_SERVER['PHP_SELF']) == 'categories.php' ? 'active' : '' ?>">
                    <i class="fas fa-tags"></i> Categories
                </a>
            </li>
            <li>
                <a href="orders.php" class="<?= basename($_SERVER['PHP_SELF']) == 'orders.php' ? 'active' : '' ?>">
                    <i class="fas fa-shopping-cart"></i> Orders
                    <span class="badge bg-primary float-end">3</span>
                </a>
            </li>
            <li>
                <a href="users.php" class="<?= basename($_SERVER['PHP_SELF']) == 'users.php' ? 'active' : '' ?>">
                    <i class="fas fa-users"></i> Users
                </a>
            </li>
            <li>
                <a href="reviews.php" class="<?= basename($_SERVER['PHP_SELF']) == 'reviews.php' ? 'active' : '' ?>">
                    <i class="fas fa-star"></i> Reviews
                </a>
            </li>
            <li>
                <a href="settings.php" class="<?= basename($_SERVER['PHP_SELF']) == 'settings.php' ? 'active' : '' ?>">
                    <i class="fas fa-cog"></i> Settings
                </a>
            </li>
        </ul>
    </nav>
</aside>