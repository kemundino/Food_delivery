<?php
session_start();

// Check if user is already logged in
if (isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit();
}

$error = '';

// Process login form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    
    if (empty($email) || empty($password)) {
        $error = 'Please enter both email and password.';
    } else {
        // Prepare a select statement
        $sql = "SELECT id, name, email, password, role FROM users WHERE email = ?";
        
        if ($stmt = $conn->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("s", $email);
            
            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                // Store result
                $stmt->store_result();
                
                // Check if email exists, if yes then verify password
                if ($stmt->num_rows == 1) {                    
                    // Bind result variables
                    $stmt->bind_result($id, $name, $email, $hashed_password, $role);
                    if ($stmt->fetch()) {
                        if (password_verify($password, $hashed_password)) {
                            // Password is correct, start a new session
                            session_regenerate_id();
                            
                            // Store data in session variables
                            $_SESSION['user_id'] = $id;
                            $_SESSION['user_name'] = $name;
                            $_SESSION['user_email'] = $email;
                            $_SESSION['role'] = $role;
                            
                            // Check if there's a redirect URL stored in session
                            $redirect_url = $_SESSION['redirect_after_login'] ?? null;
                            unset($_SESSION['redirect_after_login']); // Clear the redirect URL
                            
                            // Redirect user based on role
                            switch ($role) {
                                case 'admin':
                                    header('Location: ' . ($redirect_url ?: 'admin/dashboard.php'));
                                    break;
                                case 'vendor':
                                    header('Location: ' . ($redirect_url ?: 'vendor/home.php'));
                                    break;
                                case 'customer':
                                default:
                                    header('Location: ' . ($redirect_url ?: 'customer/home.php'));
                                    break;
                            }
                            exit();
                        } else {
                            // Password is not valid
                            $error = 'The password you entered is not valid.';
                        }
                    }
                } else {
                    // Email doesn't exist
                    $error = 'No account found with that email address.';
                }
            } else {
                $error = 'Oops! Something went wrong. Please try again later.';
            }

            // Close statement
            $stmt->close();
        }
    }
    
    // Close connection
    $conn->close();
}

require_once 'includes/header.php';
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

/* Forms */
.form-group {
    margin-bottom: var(--spacing-lg);
}

.form-label {
    display: block;
    margin-bottom: var(--spacing-xs);
    font-weight: 600;
    color: var(--text-primary);
}

.form-control {
    width: 100%;
    padding: var(--spacing-md);
    background: var(--card-bg);
    border: 1px solid var(--border-color);
    border-radius: var(--border-radius);
    color: var(--text-primary);
    font-size: 1rem;
    transition: var(--transition);
}

.form-control::placeholder {
    color: var(--text-muted);
}

.form-control:focus {
    outline: none;
    border-color: var(--primary-color);
    box-shadow: 0 0 0 3px rgba(255, 107, 53, 0.1);
}

/* Alerts */
.alert {
    padding: var(--spacing-md);
    border-radius: var(--border-radius);
    margin-bottom: var(--spacing-md);
    border: 1px solid transparent;
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

.alert-danger {
    background: rgba(245, 101, 101, 0.1);
    border-color: var(--danger-color);
    color: var(--danger-color);
}

/* Login Page Specific */
.login-container {
  min-height: 100vh;
  width: 100vw;
  display: flex;
  align-items: center;
  justify-content: center;
  padding: var(--spacing-lg);
  margin-top: 0;
}
  min-height: 100vh;
  display: flex;
  align-items: flex-start;
  justify-content: center;
  padding: var(--spacing-lg);
}

.login-card {
  background: var(--card-bg);
  border: 1px solid var(--border-color);
  border-radius: var(--border-radius-lg);
  padding: var(--spacing-md);
  width: 28vw;
  min-width: 180px;
  max-width: 300px;
  box-shadow: var(--shadow-xl);
  flex-shrink: 0;
  margin-top: 0;
}
.login-image {
  width: 22vw;
  min-width: 40px;
  max-width: 90px;
  height: auto;
  display: flex;
  align-items: center;
  justify-content: center;
  margin-top: 0;
}
.login-image img {
  max-width: 60px;
  width: 100%;
  height: auto;
}

/* Responsive scaling for login form */
.login-card, .login-form, .login-card form, .login-card label, .login-card input, .login-card button, .login-card .form-control {
  font-size: clamp(0.85rem,1.7vw,1.02rem);
}
.login-card input, .login-card .form-control {
  padding: 0.35em 0.7em;
  height: 1.7em;
}
.login-card button, .login-card .btn {
  font-size: clamp(0.82rem,1.5vw,0.97rem);
  padding: 0.35em 1em;
}

  width: 40%;
  margin-top: 3.5%;
  height: auto;
  display: flex;
  align-items: center;
  justify-content: center;
}
  width: 40%;
  margin-top: 3.5%;
  height: auto;
  display: flex;
  align-items: center;
  justify-content: center;
}
  width: 40%;
  margin-top: 4%;
  height: auto;
  display: flex;
  align-items: center;
  justify-content: center;
}

@media (max-width: 1024px) {
  .login-card {
  background: var(--card-bg);
  border: 1px solid var(--border-color);
  border-radius: var(--border-radius-lg);
  padding: var(--spacing-2xl);
  width: 45%;
  max-width: 500px;
  box-shadow: var(--shadow-xl);
  flex-shrink: 0;
  margin-top: 0;
} width: 80%; margin-top: 3.5%; }
  .login-image {
  width: 40%;
  height: auto;
  display: flex;
  align-items: center;
  justify-content: center;
  margin-top: 0;
} width: 80%; margin-top: 3.5%; }

  .login-card {
  background: var(--card-bg);
  border: 1px solid var(--border-color);
  border-radius: var(--border-radius-lg);
  padding: var(--spacing-2xl);
  width: 45%;
  max-width: 500px;
  box-shadow: var(--shadow-xl);
  flex-shrink: 0;
  margin-top: 0;
}
  background: var(--card-bg);
  border: 1px solid var(--border-color);
  border-radius: var(--border-radius-lg);
  padding: var(--spacing-2xl);
  width: 45%;
  margin-top: 3.5%;
  max-width: 500px;
  box-shadow: var(--shadow-xl);
  flex-shrink: 0;
}
  background: var(--card-bg);
  border: 1px solid var(--border-color);
  border-radius: var(--border-radius-lg);
  padding: var(--spacing-2xl);
  width: 45%;
  margin-top: 3.5%;
  max-width: 500px;
  box-shadow: var(--shadow-xl);
  flex-shrink: 0;
} width: 80%; margin-top: 4%; }
  .login-image {
  width: 40%;
  height: auto;
  display: flex;
  align-items: center;
  justify-content: center;
  margin-top: 0;
}
  width: 40%;
  margin-top: 3.5%;
  height: auto;
  display: flex;
  align-items: center;
  justify-content: center;
}
  width: 40%;
  margin-top: 3.5%;
  height: auto;
  display: flex;
  align-items: center;
  justify-content: center;
} width: 80%; margin-top: 4%; }
}

.login-container {
  min-height: 100vh;
  width: 100vw;
  display: flex;
  align-items: center;
  justify-content: center;
  padding: var(--spacing-lg);
  margin-top: 0;
}
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: var(--spacing-lg);
}

.login-card {
  background: var(--card-bg);
  border: 1px solid var(--border-color);
  border-radius: var(--border-radius-lg);
  padding: var(--spacing-2xl);
  width: 45%;
  max-width: 500px;
  box-shadow: var(--shadow-xl);
  flex-shrink: 0;
  margin-top: 0;
}
  background: var(--card-bg);
  border: 1px solid var(--border-color);
  border-radius: var(--border-radius-lg);
  padding: var(--spacing-2xl);
  width: 45%;
  margin-top: 3.5%;
  max-width: 500px;
  box-shadow: var(--shadow-xl);
  flex-shrink: 0;
}
  background: var(--card-bg);
  border: 1px solid var(--border-color);
  border-radius: var(--border-radius-lg);
  padding: var(--spacing-2xl);
  width: 45%;
  margin-top: 3.5%;
  max-width: 500px;
  box-shadow: var(--shadow-xl);
  flex-shrink: 0;
}
    background: var(--card-bg);
    border: 1px solid var(--border-color);
    border-radius: var(--border-radius-lg);
    padding: var(--spacing-2xl);
    width: 100%;
    max-width: 400px;
    box-shadow: var(--shadow-xl);
}

.login-header {
    text-align: center;
    margin-bottom: var(--spacing-xl);
}

.login-header h1 {
    margin-bottom: var(--spacing-sm);
    color: var(--primary-color);
}

.login-header p {
    color: var(--text-muted);
    margin-bottom: 0;
}

.login-form {
    margin-bottom: var(--spacing-lg);
}

.login-footer {
    text-align: center;
    padding-top: var(--spacing-lg);
    border-top: 1px solid var(--border-color);
}

.login-footer p {
    color: var(--text-muted);
    margin-bottom: var(--spacing-sm);
}

.login-footer a {
    color: var(--primary-color);
    font-weight: 600;
}

.login-footer a:hover {
    color: var(--primary-light);
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
    
    .login-container {
  min-height: 100vh;
  width: 100vw;
  display: flex;
  align-items: center;
  justify-content: center;
  padding: var(--spacing-lg);
  margin-top: 0;
}
        padding: var(--spacing-md);
    }
    
    .login-card {
  background: var(--card-bg);
  border: 1px solid var(--border-color);
  border-radius: var(--border-radius-lg);
  padding: var(--spacing-2xl);
  width: 45%;
  max-width: 500px;
  box-shadow: var(--shadow-xl);
  flex-shrink: 0;
  margin-top: 0;
}
  background: var(--card-bg);
  border: 1px solid var(--border-color);
  border-radius: var(--border-radius-lg);
  padding: var(--spacing-2xl);
  width: 45%;
  margin-top: 3.5%;
  max-width: 500px;
  box-shadow: var(--shadow-xl);
  flex-shrink: 0;
}
  background: var(--card-bg);
  border: 1px solid var(--border-color);
  border-radius: var(--border-radius-lg);
  padding: var(--spacing-2xl);
  width: 45%;
  margin-top: 3.5%;
  max-width: 500px;
  box-shadow: var(--shadow-xl);
  flex-shrink: 0;
}
        padding: var(--spacing-lg);
    }
}

@media (max-width: 480px) {
    .container {
        padding: 0 var(--spacing-sm);
    }
    
    .login-card {
  background: var(--card-bg);
  border: 1px solid var(--border-color);
  border-radius: var(--border-radius-lg);
  padding: var(--spacing-2xl);
  width: 45%;
  max-width: 500px;
  box-shadow: var(--shadow-xl);
  flex-shrink: 0;
  margin-top: 0;
}
  background: var(--card-bg);
  border: 1px solid var(--border-color);
  border-radius: var(--border-radius-lg);
  padding: var(--spacing-2xl);
  width: 45%;
  margin-top: 3.5%;
  max-width: 500px;
  box-shadow: var(--shadow-xl);
  flex-shrink: 0;
}
  background: var(--card-bg);
  border: 1px solid var(--border-color);
  border-radius: var(--border-radius-lg);
  padding: var(--spacing-2xl);
  width: 45%;
  margin-top: 3.5%;
  max-width: 500px;
  box-shadow: var(--shadow-xl);
  flex-shrink: 0;
}
        padding: var(--spacing-md);
        margin: var(--spacing-md);
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

<style>
/* Auth Page Responsive Styles */
.auth-page {
    min-height: 100vh;
    display: flex;
    align-items: center;
    background: linear-gradient(135deg, var(--dark-bg) 0%, var(--darker-bg) 100%);
    padding: var(--spacing-md) 0;
}

.auth-container {
    max-width: 1200px;
    width: 100%;
    margin: 0 auto;
    padding: 0 var(--spacing-md);
}

.auth-card {
    display: flex;
    background: var(--card-bg);
    border-radius: var(--border-radius-lg);
    overflow: hidden;
    box-shadow: var(--shadow-xl);
    min-height: 600px;
}

.auth-illustration {
    flex: 1;
    background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
    color: white;
    padding: var(--spacing-2xl);
    display: flex;
    flex-direction: column;
    justify-content: center;
    position: relative;
    overflow: hidden;
}

.auth-illustration::before {
    content: '';
    position: absolute;
    top: -50%;
    right: -50%;
    width: 100%;
    height: 200%;
    background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0) 60%);
    transform: rotate(30deg);
}

.illustration-container {
  display: flex;
  justify-content: center;
  align-items: center;
  margin: 0 auto;
  width: 100%;
  max-width: 220px;
  min-height: 80px;
}
    position: relative;
    z-index: 1;
    text-align: center;
    max-width: 400px;
    margin: 0 auto;
}

.auth-illustration .logo {
  width: 80px;
  height: auto;
  margin: 0 auto var(--spacing-lg) auto;
  display: block;
  max-width: 100%;
}
    width: 80px;
    height: auto;
    margin-bottom: var(--spacing-lg);
}

.auth-illustration h1 {
    font-size: 2.25rem;
    margin: var(--spacing-lg) 0 var(--spacing-md);
    font-weight: 700;
    color: white;
}

.auth-illustration p {
    font-size: 1.1rem;
    opacity: 0.9;
    line-height: 1.6;
    color: rgba(255, 255, 255, 0.9);
}

.auth-content {
    flex: 1;
    padding: var(--spacing-2xl);
    display: flex;
    flex-direction: column;
    justify-content: center;
}

.auth-form {
    max-width: 400px;
    width: 100%;
    margin: 0 auto;
}

.auth-form h2 {
    font-size: 2rem;
    color: var(--text-primary);
    margin-bottom: var(--spacing-sm);
    font-weight: 700;
}

.auth-subtitle {
    color: var(--text-secondary);
    margin-bottom: var(--spacing-xl);
    font-size: 1rem;
}

.form-group {
    margin-bottom: var(--spacing-lg);
}

.form-group label {
    display: block;
    margin-bottom: var(--spacing-sm);
    font-weight: 500;
    color: var(--text-primary);
}

.input-group {
    position: relative;
    display: flex;
    align-items: center;
}

.input-icon {
    position: absolute;
    left: var(--spacing-md);
    color: var(--text-muted);
    z-index: 1;
}

.form-control {
    width: 100%;
    padding: var(--spacing-md) var(--spacing-md) var(--spacing-md) 3rem;
    border: 1px solid var(--border-color);
    border-radius: var(--border-radius);
    font-size: 1rem;
    transition: var(--transition);
    background: var(--card-bg);
    color: var(--text-primary);
}

.form-control::placeholder {
    color: var(--text-muted);
}

.form-control:focus {
    outline: none;
    border-color: var(--primary-color);
    box-shadow: 0 0 0 3px rgba(255, 107, 53, 0.1);
}

.toggle-password {
    position: absolute;
    right: var(--spacing-md);
    background: none;
    border: none;
    color: var(--text-muted);
    cursor: pointer;
    padding: var(--spacing-sm);
    z-index: 1;
    transition: var(--transition);
}

.toggle-password:hover {
    color: var(--primary-color);
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
    width: 100%;
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

.btn-block {
    display: flex;
    width: 100%;
}

.btn-lg {
    padding: var(--spacing-lg) var(--spacing-xl);
    font-size: 1.05rem;
}

.btn-text {
    margin-right: var(--spacing-sm);
}

.btn i {
    font-size: 1.1em;
    transition: transform 0.3s ease;
}

.btn:hover i {
    transform: translateX(4px);
}

.remember-me {
    display: flex;
    align-items: center;
    margin: var(--spacing-lg) 0;
}

.checkbox-container {
    display: flex;
    align-items: center;
    cursor: pointer;
    position: relative;
    padding-left: 2rem;
    user-select: none;
}

.checkbox-container input {
    position: absolute;
    opacity: 0;
    cursor: pointer;
    height: 0;
    width: 0;
}

.checkmark {
    position: absolute;
    left: 0;
    top: 0;
    height: 20px;
    width: 20px;
    background-color: var(--card-bg);
    border: 1px solid var(--border-color);
    border-radius: 4px;
    transition: var(--transition);
}

.checkbox-container:hover input ~ .checkmark {
    border-color: var(--text-muted);
}

.checkbox-container input:checked ~ .checkmark {
    background-color: var(--primary-color);
    border-color: var(--primary-color);
}

.checkmark:after {
    content: "";
    position: absolute;
    display: none;
}

.checkbox-container input:checked ~ .checkmark:after {
    display: block;
}

.checkbox-container .checkmark:after {
    left: 7px;
    top: 3px;
    width: 5px;
    height: 10px;
    border: solid white;
    border-width: 0 2px 2px 0;
    transform: rotate(45deg);
}

.label-text {
    color: var(--text-primary);
    font-size: 0.95rem;
}

.forgot-password {
    font-size: 0.875rem;
    color: var(--primary-color);
    text-decoration: none;
    font-weight: 500;
    transition: var(--transition);
}

.forgot-password:hover {
    color: var(--primary-light);
    text-decoration: underline;
}

.divider {
    display: flex;
    align-items: center;
    text-align: center;
    margin: var(--spacing-xl) 0;
    color: var(--text-muted);
    font-size: 0.875rem;
}

.divider::before,
.divider::after {
    content: '';
    flex: 1;
    border-bottom: 1px solid var(--border-color);
}

.divider:not(:empty)::before {
    margin-right: var(--spacing-lg);
}

.divider:not(:empty)::after {
    margin-left: var(--spacing-lg);
}

.social-login {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: var(--spacing-md);
    margin-bottom: var(--spacing-xl);
}

.btn-outline {
    background: transparent;
    border: 1px solid var(--border-color);
    color: var(--text-primary);
    padding: var(--spacing-md) var(--spacing-md);
    font-size: 0.95rem;
}

.btn-outline:hover {
    background: var(--card-bg);
    border-color: var(--text-muted);
    transform: translateY(-2px);
}

.btn-social {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: var(--spacing-sm);
    padding: var(--spacing-md) var(--spacing-md);
    font-size: 0.95rem;
}

.social-icon {
    width: 18px;
    height: 18px;
    object-fit: contain;
}

.auth-footer {
    text-align: center;
    margin-top: var(--spacing-xl);
    color: var(--text-secondary);
    font-size: 0.95rem;
}

.text-link {
    color: var(--primary-color);
    text-decoration: none;
    font-weight: 600;
    transition: var(--transition);
}

.text-link:hover {
    color: var(--primary-light);
    text-decoration: underline;
}

.alert {
    padding: var(--spacing-md);
    border-radius: var(--border-radius);
    margin-bottom: var(--spacing-lg);
    display: flex;
    align-items: flex-start;
    font-size: 0.95rem;
    line-height: 1.5;
}

.alert i {
    margin-right: var(--spacing-sm);
    font-size: 1.1rem;
    margin-top: 0.15rem;
}

.alert-error {
    background: rgba(239, 68, 68, 0.1);
    border-left: 4px solid var(--danger-color);
    color: var(--danger-color);
}

/* Responsive Design */
@media (max-width: 1024px) {
  .login-card {
  background: var(--card-bg);
  border: 1px solid var(--border-color);
  border-radius: var(--border-radius-lg);
  padding: var(--spacing-2xl);
  width: 45%;
  max-width: 500px;
  box-shadow: var(--shadow-xl);
  flex-shrink: 0;
  margin-top: 0;
} width: 80%; margin-top: 3.5%; }
  .login-image {
  width: 40%;
  height: auto;
  display: flex;
  align-items: center;
  justify-content: center;
  margin-top: 0;
} width: 80%; margin-top: 3.5%; }

    .auth-illustration {
        padding: var(--spacing-xl);
    }
    
    .auth-content {
        padding: var(--spacing-xl);
    }
    
    .auth-illustration h1 {
        font-size: 2rem;
    }
    
    .auth-form h2 {
        font-size: 1.75rem;
    }
}

@media (max-width: 768px) {
    .auth-page {
        padding: var(--spacing-sm) 0;
    }
    
    .auth-container {
        padding: 0 var(--spacing-sm);
    }
    
    .auth-card {
        flex-direction: column;
        border-radius: var(--border-radius);
        min-height: auto;
    }
    
    .auth-illustration {
        padding: var(--spacing-lg);
        text-align: center;
    }
    
    .auth-content {
        padding: var(--spacing-lg);
    }
    
    .illustration-container {
  display: flex;
  justify-content: center;
  align-items: center;
  margin: 0 auto;
  width: 100%;
  max-width: 220px;
  min-height: 80px;
}
        max-width: 300px;
    }
    
    .auth-illustration h1 {
        font-size: 1.75rem;
    }
    
    .auth-illustration p {
        font-size: 1rem;
    }
    
    .auth-form h2 {
        font-size: 1.5rem;
    }
    
    .auth-form {
        max-width: 100%;
    }
    
    .social-login {
        grid-template-columns: 1fr;
    }
}

@media (max-width: 576px) {
    .auth-page {
        padding: 0;
    }
    
    .auth-container {
        padding: 0;
    }
    
    .auth-card {
        border-radius: 0;
        min-height: 100vh;
    }
    
    .auth-illustration {
        padding: var(--spacing-md);
    }
    
    .auth-content {
        padding: var(--spacing-md);
    }
    
    .illustration-container {
  display: flex;
  justify-content: center;
  align-items: center;
  margin: 0 auto;
  width: 100%;
  max-width: 220px;
  min-height: 80px;
}
        max-width: 250px;
    }
    
    .auth-illustration .logo {
  width: 80px;
  height: auto;
  margin: 0 auto var(--spacing-lg) auto;
  display: block;
  max-width: 100%;
}
        width: 60px;
        margin-bottom: var(--spacing-md);
    }
    
    .auth-illustration h1 {
        font-size: 1.5rem;
        margin: var(--spacing-md) 0 var(--spacing-sm);
    }
    
    .auth-illustration p {
        font-size: 0.9rem;
    }
    
    .auth-form h2 {
        font-size: 1.25rem;
    }
    
    .auth-subtitle {
        font-size: 0.9rem;
        margin-bottom: var(--spacing-lg);
    }
    
    .form-group {
        margin-bottom: var(--spacing-md);
    }
    
    .form-control {
        padding: var(--spacing-sm) var(--spacing-sm) var(--spacing-sm) 2.5rem;
        font-size: 0.9rem;
    }
    
    .input-icon {
        left: var(--spacing-sm);
    }
    
    .toggle-password {
        right: var(--spacing-sm);
        padding: var(--spacing-xs);
    }
    
    .btn {
        padding: var(--spacing-sm) var(--spacing-lg);
        font-size: 0.9rem;
    }
    
    .btn-lg {
        padding: var(--spacing-md) var(--spacing-lg);
        font-size: 0.95rem;
    }
    
    .checkbox-container {
        font-size: 0.8rem;
    }
    
    .auth-footer {
        font-size: 0.85rem;
        margin-top: var(--spacing-lg);
    }
    
    .alert {
        padding: var(--spacing-sm);
        font-size: 0.85rem;
    }
    
    .alert i {
        font-size: 1rem;
    }
    
    .divider {
        margin: var(--spacing-lg) 0;
    }
}

@media (max-width: 400px) {
    .auth-illustration {
        padding: var(--spacing-sm);
    }
    
    .auth-content {
        padding: var(--spacing-sm);
    }
    
    .auth-illustration h1 {
        font-size: 1.25rem;
    }
    
    .auth-form h2 {
        font-size: 1.1rem;
    }
    
    .form-control {
        padding: var(--spacing-xs) var(--spacing-xs) var(--spacing-xs) 2rem;
        font-size: 0.85rem;
    }
    
    .btn {
        padding: var(--spacing-xs) var(--spacing-md);
        font-size: 0.85rem;
    }
    
    .btn-lg {
        padding: var(--spacing-sm) var(--spacing-md);
        font-size: 0.9rem;
    }
    
    .checkbox-container {
        font-size: 0.75rem;
        line-height: 1.4;
    }
    
    .social-login {
        gap: var(--spacing-sm);
    }
    
    .btn-social {
        padding: var(--spacing-sm);
        font-size: 0.85rem;
    }
}

/* Footer Responsive Styles */
.footer {
    background: var(--darker-bg);
    border-top: 1px solid var(--border-color);
    color: var(--text-primary);
    padding: var(--spacing-2xl) 0 var(--spacing-lg);
    margin-top: auto;
}

.footer-content {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 var(--spacing-md);
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: var(--spacing-xl);
}

.footer-section h3 {
    color: var(--primary-color);
    font-size: 1.25rem;
    font-weight: 600;
    margin-bottom: var(--spacing-md);
    position: relative;
}

.footer-section h3::after {
    content: '';
    position: absolute;
    bottom: -8px;
    left: 0;
    width: 40px;
    height: 2px;
    background: var(--primary-color);
}

.footer-section p {
    color: var(--text-secondary);
    line-height: 1.6;
    margin-bottom: var(--spacing-md);
}

.footer-section ul {
    list-style: none;
    padding: 0;
    margin: 0;
}

.footer-section ul li {
    margin-bottom: var(--spacing-sm);
}

.footer-section ul li a {
    color: var(--text-secondary);
    text-decoration: none;
    transition: var(--transition);
    display: inline-flex;
    align-items: center;
}

.footer-section ul li a:hover {
    color: var(--primary-color);
    transform: translateX(4px);
}

.footer-section p i {
    color: var(--primary-color);
    margin-right: var(--spacing-sm);
    width: 16px;
}

.social-links {
    display: flex;
    gap: var(--spacing-md);
    margin-top: var(--spacing-md);
}

.social-links a {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 40px;
    height: 40px;
    background: var(--card-bg);
    border: 1px solid var(--border-color);
    border-radius: 50%;
    color: var(--text-secondary);
    text-decoration: none;
    transition: var(--transition);
}

.social-links a:hover {
    background: var(--primary-color);
    color: white;
    transform: translateY(-2px);
    box-shadow: var(--shadow-md);
}

.footer-bottom {
    max-width: 1200px;
    margin: 0 auto;
    padding: var(--spacing-lg) var(--spacing-md) 0;
    border-top: 1px solid var(--border-color);
    text-align: center;
    color: var(--text-muted);
    font-size: 0.9rem;
}

/* Footer Responsive Design */
@media (max-width: 768px) {
    .footer {
        padding: var(--spacing-xl) 0 var(--spacing-md);
    }
    
    .footer-content {
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: var(--spacing-lg);
        padding: 0 var(--spacing-sm);
    }
    
    .footer-section h3 {
        font-size: 1.1rem;
    }
    
    .footer-section h3::after {
        width: 30px;
        height: 2px;
    }
    
    .social-links {
        gap: var(--spacing-sm);
    }
    
    .social-links a {
        width: 36px;
        height: 36px;
    }
    
    .footer-bottom {
        padding: var(--spacing-md) var(--spacing-sm) 0;
        font-size: 0.85rem;
    }
}

@media (max-width: 576px) {
    .footer {
        padding: var(--spacing-lg) 0 var(--spacing-sm);
    }
    
    .footer-content {
        grid-template-columns: 1fr;
        gap: var(--spacing-md);
        text-align: center;
    }
    
    .footer-section h3::after {
        left: 50%;
        transform: translateX(-50%);
    }
    
    .social-links {
        justify-content: center;
    }
    
    .footer-section p i {
        margin-right: var(--spacing-xs);
    }
    
    .footer-section ul li a {
        justify-content: center;
    }
    
    .footer-section ul li a:hover {
        transform: translateY(-2px);
    }
}

@media (max-width: 400px) {
    .footer {
        padding: var(--spacing-md) 0 var(--spacing-sm);
    }
    
    .footer-content {
        gap: var(--spacing-sm);
    }
    
    .footer-section h3 {
        font-size: 1rem;
        margin-bottom: var(--spacing-sm);
    }
    
    .footer-section p {
        font-size: 0.9rem;
    }
    
    .footer-section ul li a {
        font-size: 0.9rem;
    }
    
    .social-links a {
        width: 32px;
        height: 32px;
        font-size: 0.9rem;
    }
    
    .footer-bottom {
        font-size: 0.8rem;
    }
}
</style>

<div class="auth-page">
    <div class="auth-container">
        <div class="auth-card">
            <div class="auth-illustration">
                <div class="illustration-container">
                    <img src="https://img.icons8.com/fluency/144/000000/restaurant-checked.png" alt="FoodExpress" class="logo">
                    <h1>Welcome Back!</h1>
                    <p>Sign in to continue to FoodExpress</p>
                </div>
            </div>
            
            <div class="auth-content">
                <?php if ($error): ?>
                    <div class="alert alert-error">
                        <i class="fas fa-exclamation-circle"></i>
                        <span><?php echo $error; ?></span>
                    </div>
                <?php endif; ?>
                
                <form action="login.php" method="POST" class="auth-form" novalidate>
                    <h2>Sign In</h2>
                    <p class="auth-subtitle">Enter your credentials to access your account</p>
                    
                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <div class="input-group">
                            <span class="input-icon"><i class="fas fa-envelope"></i></span>
                            <input type="email" id="email" name="email" class="form-control" 
                                   placeholder="Enter your email" required 
                                   value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="d-flex justify-content-between">
                            <label for="password">Password</label>
                            <a href="forgot-password.php" class="forgot-password">Forgot password?</a>
                        </div>
                        <div class="input-group">
                            <span class="input-icon"><i class="fas fa-lock"></i></span>
                            <input type="password" id="password" name="password" class="form-control" 
                                   placeholder="Enter your password" required>
                            <button type="button" class="toggle-password" aria-label="Toggle password visibility">
                                <i class="far fa-eye"></i>
                            </button>
                        </div>
                    </div>
                    
                    <div class="form-group remember-me">
                        <label class="checkbox-container">
                            <input type="checkbox" id="remember" name="remember">
                            <span class="checkmark"></span>
                            <span class="label-text">Remember me</span>
                        </label>
                    </div>
                    
                    <button type="submit" class="btn btn-primary btn-block btn-lg">
                        <span class="btn-text">Sign In</span>
                        <i class="fas fa-arrow-right"></i>
                    </button>
                    
                    <div class="divider">
                        <span>or continue with</span>
                    </div>
                    
                    <div class="social-login">
                        <button type="button" class="btn btn-outline btn-social">
                            <img src="https://img.icons8.com/color/24/000000/google-logo.png" alt="Google" class="social-icon">
                            <span>Google</span>
                        </button>
                        <button type="button" class="btn btn-outline btn-social">
                            <i class="fab fa-facebook-f"></i>
                            <span>Facebook</span>
                        </button>
                    </div>
                    
                    <p class="auth-footer">
                        Don't have an account? <a href="signup.php" class="text-link">Create one</a>
                    </p>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Toggle password visibility
    const togglePassword = document.querySelector('.toggle-password');
    const passwordInput = document.getElementById('password');
    
    if (togglePassword && passwordInput) {
        togglePassword.addEventListener('click', function() {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            this.querySelector('i').classList.toggle('fa-eye');
            this.querySelector('i').classList.toggle('fa-eye-slash');
        });
    }
    
    // Form validation
    const form = document.querySelector('.auth-form');
    if (form) {
        form.addEventListener('submit', function(e) {
            const email = document.getElementById('email');
            const password = document.getElementById('password');
            let isValid = true;
            
            // Reset error states
            document.querySelectorAll('.is-invalid').forEach(el => {
                el.classList.remove('is-invalid');
            });
            
            // Validate email
            if (!email.value || !email.validity.valid) {
                email.classList.add('is-invalid');
                isValid = false;
            }
            
            // Validate password
            if (!password.value) {
                password.classList.add('is-invalid');
                isValid = false;
            }
            
            if (!isValid) {
                e.preventDefault();
            }
        });
    }
});
</script>
<script src="assets/js/main.js"></script>

<?php require_once 'includes/footer.php'; ?>
