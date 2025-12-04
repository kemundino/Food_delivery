<?php
require_once 'includes/header.php';
?>

<style>
/* 403 Error Page Styles */
.error-403-page {
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, var(--dark-bg) 0%, var(--darker-bg) 100%);
    padding: var(--spacing-md) 0;
}

.error-403-container {
    text-align: center;
    max-width: 600px;
    padding: var(--spacing-2xl);
}

.error-403-code {
    font-size: 8rem;
    font-weight: 700;
    color: var(--danger-color);
    text-shadow: 0 0 20px rgba(239, 68, 68, 0.3);
    margin-bottom: var(--spacing-lg);
    line-height: 1;
}

.error-403-title {
    font-size: 2.5rem;
    font-weight: 700;
    color: var(--text-primary);
    margin-bottom: var(--spacing-md);
}

.error-403-message {
    font-size: 1.2rem;
    color: var(--text-secondary);
    margin-bottom: var(--spacing-xl);
    line-height: 1.6;
}

.error-403-description {
    font-size: 1rem;
    color: var(--text-muted);
    margin-bottom: var(--spacing-2xl);
    line-height: 1.5;
}

.error-403-actions {
    display: flex;
    gap: var(--spacing-md);
    justify-content: center;
    flex-wrap: wrap;
}

.btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: var(--spacing-md) var(--spacing-xl);
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
    background: var(--card-bg);
    color: var(--text-primary);
    border: 1px solid var(--border-color);
}

.btn-secondary:hover {
    background: var(--light-bg);
    border-color: var(--primary-color);
}

.error-403-icon {
    font-size: 4rem;
    color: var(--danger-color);
    margin-bottom: var(--spacing-lg);
    opacity: 0.8;
}

/* Responsive Design */
@media (max-width: 768px) {
    .error-403-code {
        font-size: 6rem;
    }
    
    .error-403-title {
        font-size: 2rem;
    }
    
    .error-403-message {
        font-size: 1.1rem;
    }
    
    .error-403-container {
        padding: var(--spacing-xl);
    }
    
    .error-403-actions {
        flex-direction: column;
        align-items: center;
    }
    
    .btn {
        width: 100%;
        max-width: 250px;
    }
}

@media (max-width: 480px) {
    .error-403-code {
        font-size: 4rem;
    }
    
    .error-403-title {
        font-size: 1.5rem;
    }
    
    .error-403-message {
        font-size: 1rem;
    }
    
    .error-403-container {
        padding: var(--spacing-lg);
    }
}
</style>

<div class="error-403-page">
    <div class="error-403-container">
        <div class="error-403-icon">
            <i class="fas fa-lock"></i>
        </div>
        
        <div class="error-403-code">403</div>
        
        <h1 class="error-403-title">Access Denied</h1>
        
        <p class="error-403-message">
            You don't have permission to access this page.
        </p>
        
        <p class="error-403-description">
            This page requires special privileges that your current account doesn't have. 
            If you believe this is an error, please contact your system administrator.
        </p>
        
        <div class="error-403-actions">
            <?php if (isset($_SESSION['user_id'])): ?>
                <a href="index.php" class="btn btn-primary">
                    <i class="fas fa-home"></i>
                    Go to Homepage
                </a>
                
                <?php if ($_SESSION['role'] === 'customer'): ?>
                    <a href="customer/home.php" class="btn btn-secondary">
                        <i class="fas fa-user"></i>
                        Customer Dashboard
                    </a>
                <?php elseif ($_SESSION['role'] === 'vendor'): ?>
                    <a href="vendor/home.php" class="btn btn-secondary">
                        <i class="fas fa-store"></i>
                        Vendor Dashboard
                    </a>
                <?php elseif ($_SESSION['role'] === 'admin'): ?>
                    <a href="admin/dashboard.php" class="btn btn-secondary">
                        <i class="fas fa-cog"></i>
                        Admin Dashboard
                    </a>
                <?php endif; ?>
                
                <a href="logout.php" class="btn btn-secondary">
                    <i class="fas fa-sign-out-alt"></i>
                    Logout
                </a>
            <?php else: ?>
                <a href="login.php" class="btn btn-primary">
                    <i class="fas fa-sign-in-alt"></i>
                    Login to Continue
                </a>
                
                <a href="index.php" class="btn btn-secondary">
                    <i class="fas fa-home"></i>
                    Go to Homepage
                </a>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php require_once 'includes/footer.php'; ?>
