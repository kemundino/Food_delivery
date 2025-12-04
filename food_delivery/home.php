<?php
require_once '../includes/auth.php';
require_once '../includes/role_check.php';

// Check if user has customer role
requireRole(['customer']);

require_once '../includes/header.php';
?>

<style>
/* Customer Dashboard Styles */
.customer-dashboard {
    padding: var(--spacing-xl) 0;
}

.dashboard-header {
    background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
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
    margin-bottom: var-spacing-2xl);
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
    border-color: var(--primary-color);
}

.card-icon {
    width: 60px;
    height: 60px;
    background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
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
    color: var(--primary-color);
    text-decoration: none;
    font-weight: 600;
    transition: var(--transition);
}

.card-action:hover {
    color: var(--primary-light);
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
    background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
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
    border-color: var(--primary-color);
    color: var(--primary-color);
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

<div class="customer-dashboard">
    <div class="dashboard-header">
        <div class="dashboard-header-content">
            <div class="welcome-message">
                <h1>Welcome back, <?php echo htmlspecialchars($_SESSION['user_name']); ?>!</h1>
                <p>Your personal food ordering dashboard</p>
            </div>
            <div class="user-info">
                <div class="user-name"><?php echo htmlspecialchars($_SESSION['user_name']); ?></div>
                <div class="user-role">Customer Account</div>
            </div>
        </div>
    </div>

    <div class="dashboard-content">
        <div class="quick-actions">
            <h2>Quick Actions</h2>
            <div class="action-buttons">
                <a href="../index.php" class="btn btn-primary">
                    <i class="fas fa-utensils"></i>
                    Browse Restaurants
                </a>
                <a href="../search.php" class="btn btn-secondary">
                    <i class="fas fa-search"></i>
                    Search Food
                </a>
                <a href="orders.php" class="btn btn-secondary">
                    <i class="fas fa-receipt"></i>
                    My Orders
                </a>
                <a href="profile.php" class="btn btn-secondary">
                    <i class="fas fa-user"></i>
                    My Profile
                </a>
            </div>
        </div>

        <div class="dashboard-grid">
            <div class="dashboard-card">
                <div class="card-icon">
                    <i class="fas fa-shopping-cart"></i>
                </div>
                <h3 class="card-title">Order Food</h3>
                <p class="card-description">
                    Browse through our wide selection of restaurants and order your favorite meals delivered right to your doorstep.
                </p>
                <a href="../index.php" class="card-action">
                    Start Ordering
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div>

            <div class="dashboard-card">
                <div class="card-icon">
                    <i class="fas fa-history"></i>
                </div>
                <h3 class="card-title">Order History</h3>
                <p class="card-description">
                    View your past orders, track current deliveries, and reorder your favorite meals with just one click.
                </p>
                <a href="orders.php" class="card-action">
                    View Orders
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div>

            <div class="dashboard-card">
                <div class="card-icon">
                    <i class="fas fa-heart"></i>
                </div>
                <h3 class="card-title">Favorites</h3>
                <p class="card-description">
                    Save your favorite restaurants and dishes for quick access. Get notified about special offers from your favorites.
                </p>
                <a href="favorites.php" class="card-action">
                    Manage Favorites
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div>

            <div class="dashboard-card">
                <div class="card-icon">
                    <i class="fas fa-map-marker-alt"></i>
                </div>
                <h3 class="card-title">Delivery Addresses</h3>
                <p class="card-description">
                    Manage multiple delivery addresses for home, work, or any other location. Set your default address for faster checkout.
                </p>
                <a href="addresses.php" class="card-action">
                    Manage Addresses
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div>

            <div class="dashboard-card">
                <div class="card-icon">
                    <i class="fas fa-credit-card"></i>
                </div>
                <h3 class="card-title">Payment Methods</h3>
                <p class="card-description">
                    Add and manage your payment methods for quick and secure checkout. Save cards for faster ordering.
                </p>
                <a href="payment.php" class="card-action">
                    Manage Payments
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div>

            <div class="dashboard-card">
                <div class="card-icon">
                    <i class="fas fa-user-cog"></i>
                </div>
                <h3 class="card-title">Account Settings</h3>
                <p class="card-description">
                    Update your personal information, change password, manage notifications, and customize your account preferences.
                </p>
                <a href="profile.php" class="card-action">
                    Update Profile
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>
</div>

<?php require_once '../includes/footer.php'; ?>
