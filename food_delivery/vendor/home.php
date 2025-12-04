<?php
require_once '../includes/auth.php';
require_once '../includes/role_check.php';

// Check if user has vendor role
requireRole(['vendor']);

require_once '../includes/header.php';
?>

<style>
/* Vendor Dashboard Styles */
.vendor-dashboard {
    padding: var(--spacing-xl) 0;
}

.dashboard-header {
    background: linear-gradient(135deg, var(--secondary-color) 0%, var(--accent-color) 100%);
    color: white;
    padding: var(--spacing-2xl) 0;
    margin-bottom: var(--spacing-xl);
}

.dashboard-header-content {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 var(--spacing-md);
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.welcome-message h1 {
    font-size: 2.5rem;
    margin-bottom: var(--spacing-sm);
}

.welcome-message p {
    font-size: 1.2rem;
    opacity: 0.9;
}

.user-info {
    text-align: right;
}

.user-info .user-name {
    font-size: 1.1rem;
    font-weight: 600;
    margin-bottom: var(--spacing-xs);
}

.user-info .user-role {
    font-size: 0.9rem;
    opacity: 0.8;
}

.dashboard-content {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 var(--spacing-md);
}

.dashboard-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: var(--spacing-xl);
    margin-bottom: var(--spacing-2xl);
}

.dashboard-card {
    background: var(--card-bg);
    border: 1px solid var(--border-color);
    border-radius: var(--border-radius-lg);
    padding: var(--spacing-xl);
    transition: var(--transition);
}

.dashboard-card:hover {
    transform: translateY(-4px);
    box-shadow: var(--shadow-xl);
    border-color: var(--secondary-color);
}

.card-icon {
    width: 60px;
    height: 60px;
    background: linear-gradient(135deg, var(--secondary-color), var(--accent-color));
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: var(--spacing-lg);
    font-size: 1.5rem;
    color: white;
}

.card-title {
    font-size: 1.5rem;
    font-weight: 600;
    color: var(--text-primary);
    margin-bottom: var(--spacing-sm);
}

.card-description {
    color: var(--text-secondary);
    line-height: 1.6;
    margin-bottom: var(--spacing-lg);
}

.card-action {
    display: inline-flex;
    align-items: center;
    gap: var(--spacing-sm);
    color: var(--secondary-color);
    text-decoration: none;
    font-weight: 600;
    transition: var(--transition);
}

.card-action:hover {
    color: var(--accent-color);
    transform: translateX(4px);
}

.quick-actions {
    background: var(--card-bg);
    border: 1px solid var(--border-color);
    border-radius: var(--border-radius-lg);
    padding: var(--spacing-xl);
    margin-bottom: var(--spacing-xl);
}

.quick-actions h2 {
    color: var(--text-primary);
    margin-bottom: var(--spacing-lg);
    font-size: 1.8rem;
}

.action-buttons {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: var(--spacing-md);
}

.btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: var(--spacing-md) var(--spacing-lg);
    border: none;
    border-radius: var(--border-radius);
    font-weight: 600;
    font-size: 1rem;
    cursor: pointer;
    transition: var(--transition);
    text-decoration: none;
    gap: var(--spacing-sm);
}

.btn-primary {
    background: linear-gradient(135deg, var(--secondary-color), var(--accent-color));
    color: white;
    box-shadow: var(--shadow-md);
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: var(--shadow-lg);
}

.btn-secondary {
    background: var(--light-bg);
    color: var(--text-primary);
    border: 1px solid var(--border-color);
}

.btn-secondary:hover {
    background: var(--card-bg);
    border-color: var(--secondary-color);
    color: var(--secondary-color);
}

/* Responsive Design */
@media (max-width: 768px) {
    .dashboard-header-content {
        flex-direction: column;
        text-align: center;
        gap: var(--spacing-md);
    }
    
    .user-info {
        text-align: center;
    }
    
    .welcome-message h1 {
        font-size: 2rem;
    }
    
    .dashboard-grid {
        grid-template-columns: 1fr;
        gap: var(--spacing-lg);
    }
    
    .action-buttons {
        grid-template-columns: 1fr;
    }
}
</style>

<div class="vendor-dashboard">
    <div class="dashboard-header">
        <div class="dashboard-header-content">
            <div class="welcome-message">
                <h1>Welcome back, <?php echo htmlspecialchars($_SESSION['user_name']); ?>!</h1>
                <p>Your restaurant management dashboard</p>
            </div>
            <div class="user-info">
                <div class="user-name"><?php echo htmlspecialchars($_SESSION['user_name']); ?></div>
                <div class="user-role">Vendor Account</div>
            </div>
        </div>
    </div>

    <div class="dashboard-content">
        <div class="quick-actions">
            <h2>Quick Actions</h2>
            <div class="action-buttons">
                <a href="restaurant.php" class="btn btn-primary">
                    <i class="fas fa-store"></i>
                    Manage Restaurant
                </a>
                <a href="menu.php" class="btn btn-secondary">
                    <i class="fas fa-utensils"></i>
                    Menu Management
                </a>
                <a href="orders.php" class="btn btn-secondary">
                    <i class="fas fa-receipt"></i>
                    New Orders
                </a>
                <a href="analytics.php" class="btn btn-secondary">
                    <i class="fas fa-chart-line"></i>
                    Analytics
                </a>
            </div>
        </div>

        <div class="dashboard-grid">
            <div class="dashboard-card">
                <div class="card-icon">
                    <i class="fas fa-store"></i>
                </div>
                <h3 class="card-title">Restaurant Profile</h3>
                <p class="card-description">
                    Manage your restaurant information, update business hours, upload photos, and configure delivery settings.
                </p>
                <a href="restaurant.php" class="card-action">
                    Manage Restaurant
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div>

            <div class="dashboard-card">
                <div class="card-icon">
                    <i class="fas fa-hamburger"></i>
                </div>
                <h3 class="card-title">Menu Management</h3>
                <p class="card-description">
                    Add, edit, and remove menu items. Set prices, update availability, and organize items by categories.
                </p>
                <a href="menu.php" class="card-action">
                    Manage Menu
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div>

            <div class="dashboard-card">
                <div class="card-icon">
                    <i class="fas fa-shopping-bag"></i>
                </div>
                <h3 class="card-title">Order Management</h3>
                <p class="card-description">
                    View incoming orders, update order status, manage delivery logistics, and handle customer requests.
                </p>
                <a href="orders.php" class="card-action">
                    View Orders
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div>

            <div class="dashboard-card">
                <div class="card-icon">
                    <i class="fas fa-chart-bar"></i>
                </div>
                <h3 class="card-title">Sales Analytics</h3>
                <p class="card-description">
                    Track your sales performance, view popular items, analyze customer trends, and generate business reports.
                </p>
                <a href="analytics.php" class="card-action">
                    View Analytics
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div>

            <div class="dashboard-card">
                <div class="card-icon">
                    <i class="fas fa-star"></i>
                </div>
                <h3 class="card-title">Reviews & Ratings</h3>
                <p class="card-description">
                    Monitor customer reviews, respond to feedback, and improve your service based on customer insights.
                </p>
                <a href="reviews.php" class="card-action">
                    Manage Reviews
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div>

            <div class="dashboard-card">
                <div class="card-icon">
                    <i class="fas fa-bullhorn"></i>
                </div>
                <h3 class="card-title">Promotions</h3>
                <p class="card-description">
                    Create special offers, discounts, and promotions to attract more customers and boost your sales.
                </p>
                <a href="promotions.php" class="card-action">
                    Manage Promotions
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>
</div>

<?php require_once '../includes/footer.php'; ?>
