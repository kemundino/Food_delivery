<?php
// Define BASE_URL if not already defined
if (!defined('BASE_URL')) {
    define('BASE_URL', '/food_delivery/');
}

require_once __DIR__ . '/db.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FoodExpress - Food Delivery</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
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
  display: flex;
  flex-direction: column;
}

main {
  flex: 1;
}

.footer {
  position: static;
}

.footer.sticky {
  position: fixed;
  left: 0;
  right: 0;
  bottom: 0;
  width: 100%;
  z-index: 100;
}

        main {
            flex: 1;
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
            max-width: 1200px;
            margin: 0 auto;
            padding-left: var(--spacing-md);
            padding-right: var(--spacing-md);
        }

        .logo a {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary-color);
            text-decoration: none;
            transition: var(--transition);
        }

        .logo a:hover {
            color: var(--primary-light);
            transform: translateY(-2px);
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
            text-decoration: none;
            transition: var(--transition);
            position: relative;
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
            text-decoration: none;
        }

        .cart-icon:hover {
            background: var(--card-bg);
            color: var(--primary-color);
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
            position: absolute;
            top: -5px;
            right: -5px;
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

        .cart-item-details h6 {
            color: var(--text-primary);
            font-size: 0.9rem;
            margin-bottom: var(--spacing-xs);
        }

        .cart-item-details p {
            color: var(--text-secondary);
            font-size: 0.8rem;
            margin: 0;
        }

        .cart-total {
            padding: var(--spacing-md);
            font-weight: 600;
            display: flex;
            justify-content: space-between;
            border-top: 1px solid var(--border-color);
            color: var(--text-primary);
        }

        .cart-empty {
            padding: var(--spacing-lg);
            text-align: center;
            color: var(--text-muted);
        }

        .cart-actions {
            padding: var(--spacing-md);
            border-top: 1px solid var(--border-color);
        }

        /* Mobile Menu */
        .hamburger {
  display: none;
            flex-direction: column;
            cursor: pointer;
            padding: var(--spacing-sm);
            border-radius: var(--border-radius);
            transition: var(--transition);
            position: relative;
            z-index: 9999;
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
            margin: 2px 0;
            transition: var(--transition);
            transform-origin: center;
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

        .btn-primary {
            background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
            color: white;
            box-shadow: var(--shadow-md);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-lg);
        }

        .btn-sm {
            padding: var(--spacing-xs) var(--spacing-md);
            font-size: 0.75rem;
        }

        .btn-admin {
            background: var(--accent-color);
            color: white;
        }

        .btn-admin:hover {
            background: #3182ce;
            transform: translateY(-2px);
        }

        /* Alerts */
        .alert {
            padding: var(--spacing-md);
            border-radius: var(--border-radius);
            margin-bottom: var(--spacing-md);
            border: 1px solid transparent;
            display: flex;
            align-items: center;
            gap: var(--spacing-sm);
        }

        .alert-success {
            background: rgba(72, 187, 120, 0.1);
            border-color: var(--success-color);
            color: var(--success-color);
        }

        .alert-error {
            background: rgba(245, 101, 101, 0.1);
            border-color: var(--danger-color);
            color: var(--danger-color);
        }

        /* Hide scrollbars but allow vertical scrolling */
::-webkit-scrollbar {
  width: 0;
  height: 0;
  background: transparent;
}

/* Responsive Design */
@media (min-width:1024px) {
  .hamburger {display:none;}
  .nav-links {display:flex;}
}

html, body {
  overflow-x: hidden;
  /* vertical scrolling remains enabled */
}
  /* allow normal scrolling */

  width: 100vw;
  min-height: 100vh;
  height: 100%;
  margin: 0;
  padding: 0;
}
main {
  min-height: 100vh;
  width: 100vw;
  display: block;
}

.page-content {
  margin-left: 5%;
  margin-right: 5%;
  width: auto;
}

@media (max-width: 1024px) {
  .page-content {
    margin-left: 3%;
    margin-right: 3%;
  }
}
@media (max-width: 600px) {
  .page-content {
    margin-left: 2%;
    margin-right: 2%;
  }
}

/* Responsive text, buttons, input, forms */
body, .page-content, h1, h2, h3, h4, h5, h6, p, label, span, a {
  font-size: clamp(1rem, 2vw, 1.15rem);
}

button, .btn {
  font-size: clamp(0.95rem, 2vw, 1.05rem);
  padding: clamp(0.5rem, 2vw, 1rem) clamp(1rem, 4vw, 2rem);
}

input[type="text"], input[type="email"], input[type="password"], input[type="number"], textarea, select, .form-control {
  font-size: clamp(1rem, 2vw, 1.1rem);
  padding: clamp(0.5rem, 2vw, 1rem);
  width: 100%;
  box-sizing: border-box;
}

form {
  width: 100%;
  max-width: 600px;
}

  margin-top: 70px; /* height of navbar */
}

@media (min-width:1024px) {
  .hamburger {display:none;}
  .nav-links {display:flex;}
}

        @media (max-width: 1200px) {
}
@media (max-width:1023px){
  .hamburger{display:flex;}
  .nav-links{display:none;}
}
@media (min-width:1024px){
  .hamburger{display:none;}
  .nav-links{display:flex;}
}
            .hamburger {
                display: flex;
            }
            
            .nav-links {
                gap: var(--spacing-sm);
            }
        }
        
        @media (max-width: 1024px) {
            .nav-links {
                gap: var(--spacing-md);
            }
            
            .nav-links a {
                font-size: 0.9rem;
            }
        }
        
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
                z-index: 999;
                max-height: calc(100vh - 70px);
                overflow-y: auto;
            }
            
            .nav-links.active {
                transform: translateX(0);
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
        }

        @media (max-width: 480px) {
            .navbar {
                padding-left: var(--spacing-sm);
                padding-right: var(--spacing-sm);
            }
            
            .logo a {
                font-size: 1.25rem;
            }
            
            .cart-dropdown-content {
                min-width: 250px;
            }
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="<?php echo BASE_URL; ?>assets/js/main.js"></script>
</head>
<body>
    <header>
        <nav class="navbar">
            <div class="logo">
                <a href="<?php echo BASE_URL; ?>index.php">FoodExpress</a>
            </div>
            <div class="nav-links">
                <a href="<?php echo BASE_URL; ?>index.php">Home</a>
                <a href="<?php echo BASE_URL; ?>pages/restaurants.php">Restaurants</a>
                <?php if(isset($_SESSION['user_id'])): ?>
                    <?php
                    // Initialize cart if not exists
                    if (!isset($_SESSION['cart'])) {
                        $_SESSION['cart'] = [
                            'items' => [],
                            'restaurant_id' => null,
                            'total' => 0.00,
                            'item_count' => 0
                        ];
                    }
                    $cart = $_SESSION['cart'];
                    ?>
                    <div class="cart-dropdown">
                        <a href="<?php echo BASE_URL; ?>pages/cart.php" class="cart-icon">
                            <i class="fas fa-shopping-cart"></i>
                            <span class="cart-count"><?php echo $cart['item_count']; ?></span>
                        </a>
                        <div class="cart-dropdown-content">
                            <?php if (empty($cart['items'])): ?>
                                <div class="cart-empty">
                                    <i class="fas fa-shopping-basket"></i>
                                    <p>Your cart is empty</p>
                                </div>
                            <?php else: ?>
                                <div class="cart-items">
                                    <?php 
                                    $item_count = 0;
                                    foreach ($cart['items'] as $item): 
                                        if ($item_count >= 3) break; // Show max 3 items in dropdown
                                        $item_count++;
                                    ?>
                                        <div class="cart-item">
                                            <div class="cart-item-details">
                                                <h6><?php echo htmlspecialchars($item['name']); ?></h6>
                                                <p><?php echo $item['quantity']; ?> x $<?php echo number_format($item['price'], 2); ?></p>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                    <?php if (count($cart['items']) > 3): ?>
                                        <div class="text-center p-2">
                                            <small class="text-muted">+<?php echo (count($cart['items']) - 3); ?> more items</small>
                                        </div>
                                    <?php endif; ?>
                                    <div class="cart-total">
                                        <span>Total:</span>
                                        <span>$<?php echo number_format($cart['total'], 2); ?></span>
                                    </div>
                                    <div class="cart-actions">
                                        <a href="<?php echo BASE_URL; ?>pages/cart.php" class="btn btn-primary btn-sm w-100">View Cart</a>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <a href="<?php echo BASE_URL; ?>admin/profile.php">My Profile</a>
                    <a href="<?php echo BASE_URL; ?>logout.php">Logout</a>
                <?php else: ?>
                    <a href="<?php echo BASE_URL; ?>login.php">Login</a>
                    <a href="<?php echo BASE_URL; ?>signup.php" class="btn btn-primary">Sign Up</a>
                <?php endif; ?>
                <?php if(isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1): ?>
                    <a href="<?php echo BASE_URL; ?>admin/" class="btn-admin">Admin Panel</a>
                <?php endif; ?>
            </div>
            <div class="hamburger" role="button" aria-label="Toggle navigation menu" aria-expanded="false" tabindex="0">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </nav>
    </header>
    <main>
        <?php if(isset($_SESSION['success_message'])): ?>
            <div class="alert alert-success">
                <?php 
                    echo $_SESSION['success_message']; 
                    unset($_SESSION['success_message']);
                ?>
            </div>
        <?php endif; ?>
        
        <?php if(isset($_SESSION['error_message'])): ?>
            <div class="alert alert-error">
                <?php 
                    echo $_SESSION['error_message']; 
                    unset($_SESSION['error_message']);
                ?>
            </div>
        <?php endif; ?>
