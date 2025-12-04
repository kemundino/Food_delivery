<?php
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

/* Hero Section */
.hero {
    background: linear-gradient(135deg, var(--darker-bg) 0%, var(--dark-bg) 100%);
    padding: calc(100px + var(--spacing-2xl)) 0 var(--spacing-2xl);
    text-align: center;
    position: relative;
    overflow: hidden;
}

.hero::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grid" width="10" height="10" patternUnits="userSpaceOnUse"><path d="M 10 0 L 0 0 0 10" fill="none" stroke="%23ffffff" stroke-width="0.5" opacity="0.1"/></pattern></defs><rect width="100" height="100" fill="url(%23grid)"/></svg>');
    opacity: 0.3;
}

.hero-content {
    position: relative;
    z-index: 1;
    max-width: 800px;
    margin: 0 auto;
    padding: 0 var(--spacing-md);
}

.hero h1 {
    margin-bottom: var(--spacing-lg);
    background: linear-gradient(135deg, var(--primary-color), var(--primary-light));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.hero p {
    font-size: 1.25rem;
    margin-bottom: var(--spacing-xl);
    color: var(--text-secondary);
}

/* Search Form */
.search-container {
    max-width: 600px;
    margin: 0 auto;
}

.search-form {
    width: 100%;
}

.search-input-group {
    display: flex;
    background: var(--card-bg);
    border: 1px solid var(--border-color);
    border-radius: var(--border-radius-lg);
    overflow: hidden;
    box-shadow: var(--shadow-lg);
}

.search-input-group i {
    padding: var(--spacing-md);
    color: var(--text-muted);
}

.search-input-group input {
    flex: 1;
    padding: var(--spacing-md);
    background: transparent;
    border: none;
    color: var(--text-primary);
    font-size: 1rem;
}

.search-input-group input::placeholder {
    color: var(--text-muted);
}

.search-input-group input:focus {
    outline: none;
}

.search-input-group button {
    background: var(--primary-color);
    color: white;
    border: none;
    padding: var(--spacing-md) var(--spacing-lg);
    font-weight: 600;
    cursor: pointer;
    transition: var(--transition);
}

.search-input-group button:hover {
    background: var(--primary-dark);
}

/* Sections */
.section {
    padding: var(--spacing-2xl) 0;
}

.section-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: var(--spacing-xl);
}

.section-title {
    color: var(--text-primary);
    margin-bottom: var(--spacing-sm);
}

.section-subtitle {
    color: var(--text-muted);
    font-size: 1.125rem;
}

/* How It Works */
.steps-container {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: var(--spacing-xl);
    margin-top: var(--spacing-xl);
}

.step {
    text-align: center;
    padding: var(--spacing-lg);
    background: var(--card-bg);
    border-radius: var(--border-radius-lg);
    border: 1px solid var(--border-color);
    transition: var(--transition);
}

.step:hover {
    transform: translateY(-5px);
    box-shadow: var(--shadow-xl);
    border-color: var(--primary-color);
}

.step-number {
    width: 50px;
    height: 50px;
    background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
    color: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    font-weight: 700;
    margin: 0 auto var(--spacing-md);
}

.step-icon {
    font-size: 2rem;
    color: var(--primary-color);
    margin-bottom: var(--spacing-md);
}

/* Grid Layouts */
.restaurants-grid,
.foods-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: var(--spacing-lg);
}

/* Cards */
.restaurant-card,
.food-card {
    background: var(--card-bg);
    border: 1px solid var(--border-color);
    border-radius: var(--border-radius-lg);
    overflow: hidden;
    transition: var(--transition);
    position: relative;
}

.restaurant-card:hover,
.food-card:hover {
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

.restaurant-card:hover .card-img,
.food-card:hover .card-img {
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
    color: var(--text-muted);
    font-size: 0.875rem;
    margin-bottom: var(--spacing-sm);
}

.restaurant-meta,
.food-meta {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: var(--spacing-md);
    font-size: 0.875rem;
}

.rating {
    color: var(--warning-color);
    font-weight: 600;
}

.price {
    color: var(--primary-color);
    font-weight: 700;
    font-size: 1.125rem;
}

/* Testimonials */
.testimonials-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: var(--spacing-lg);
    margin-top: var(--spacing-xl);
}

.testimonial-card {
    background: var(--card-bg);
    border: 1px solid var(--border-color);
    border-radius: var(--border-radius-lg);
    padding: var(--spacing-lg);
    transition: var(--transition);
}

.testimonial-card:hover {
    transform: translateY(-3px);
    box-shadow: var(--shadow-lg);
}

.testimonial-content {
    margin-bottom: var(--spacing-md);
    font-style: italic;
    color: var(--text-secondary);
}

.testimonial-author {
    display: flex;
    align-items: center;
    gap: var(--spacing-md);
}

.testimonial-author img {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    object-fit: cover;
}

.testimonial-author h4 {
    margin-bottom: 0;
    color: var(--text-primary);
}

/* App Download Section */
.app-download {
  padding: 3vw 0;
}
.app-content {
  display: flex;
  flex-wrap: wrap;
  align-items: center;
  justify-content: space-between;
  gap: 2vw;
}
.app-text {
  flex: 1 1 260px;
  min-width: 200px;
  max-width: 420px;
}
.app-buttons {
  display: flex;
  flex-direction: row;
  gap: 1vw;
  flex: 0 1 220px;
  min-width: 150px;
  justify-content: center;
}
.app-buttons img {
  width: 120px;
  max-width: 45vw;
  height: auto;
}
.app-image {
  flex: 0 1 260px;
  min-width: 160px;
  max-width: 320px;
  display: flex;
  align-items: center;
  justify-content: center;
}
.app-image img {
  width: 100%;
  max-width: 240px;
  height: auto;
  border-radius: 18px;
}
@media (max-width: 1024px) {
  .app-content {
    flex-direction: column;
    gap: 3vw;
    align-items: stretch;
  }
  .app-text, .app-image, .app-buttons {
    max-width: 100%;
    min-width: 0;
    flex: 1 1 100%;
  }
  .app-buttons {
    justify-content: flex-start;
    gap: 2vw;
  }
}
@media (max-width: 600px) {
  .app-download {
    padding: 6vw 0 3vw 0;
  }
  .app-content {
    gap: 5vw;
  }
  .app-buttons img {
    width: 90px;
    max-width: 80vw;
  }
  .app-image img {
    max-width: 150px;
  }
}
    background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
    color: white;
}

.app-content {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: var(--spacing-2xl);
    align-items: center;
}

.app-text h2 {
    margin-bottom: var(--spacing-md);
}

.app-buttons {
    display: flex;
    gap: var(--spacing-md);
    margin-top: var(--spacing-lg);
}

.app-store-btn,
.google-play-btn {
    display: block;
    transition: var(--transition);
}

.app-store-btn:hover,
.google-play-btn:hover {
    transform: translateY(-2px);
}

.app-store-btn img,
.google-play-btn img {
    height: 50px;
}

.app-image img {
    width: 100%;
    max-width: 300px;
    border-radius: var(--border-radius-lg);
    box-shadow: var(--shadow-xl);
}

/* CTA Section */
.cta-section {
    background: linear-gradient(135deg, var(--darker-bg), var(--dark-bg));
    text-align: center;
    padding: var(--spacing-2xl) 0;
}

.cta-content h2 {
    margin-bottom: var(--spacing-md);
    color: var(--primary-color);
}

.cta-buttons {
    display: flex;
    gap: var(--spacing-md);
    justify-content: center;
    margin-top: var(--spacing-lg);
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

/* Footer */
footer {
    background: var(--darker-bg);
    border-top: 1px solid var(--border-color);
    padding: var(--spacing-2xl) 0 var(--spacing-lg);
    margin-top: auto;
}

.footer-content {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: var(--spacing-xl);
    margin-bottom: var(--spacing-lg);
}

.footer-section h4 {
    margin-bottom: var(--spacing-md);
    color: var(--primary-color);
}

.footer-section p,
.footer-section li {
    color: var(--text-secondary);
}

.footer-section ul {
    list-style: none;
}

.footer-section ul li {
    margin-bottom: var(--spacing-xs);
}

.footer-section ul li a {
    color: var(--text-secondary);
    transition: var(--transition);
}

.footer-section ul li a:hover {
    color: var(--primary-color);
}

.footer-bottom {
    text-align: center;
    padding-top: var(--spacing-lg);
    border-top: 1px solid var(--border-color);
    color: var(--text-muted);
}

.social-links {
    display: flex;
    gap: var(--spacing-md);
    margin-top: var(--spacing-md);
}

.social-links a {
    color: var(--text-muted);
    font-size: 1.25rem;
    transition: var(--transition);
}

.social-links a:hover {
    color: var(--primary-color);
}

/* Animations */
.fade-in {
    opacity: 0;
    transform: translateY(20px);
    animation: fadeIn 0.6s ease-out forwards;
}

@keyframes fadeIn {
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.js-loaded .fade-in {
    animation-delay: 0.2s;
}

.js-loaded .fade-in:nth-child(2) {
    animation-delay: 0.4s;
}

.js-loaded .fade-in:nth-child(3) {
    animation-delay: 0.6s;
}

/* Notification */
.notification {
    position: fixed;
    top: 100px;
    right: var(--spacing-md);
    background: var(--card-bg);
    border: 1px solid var(--primary-color);
    border-radius: var(--border-radius);
    padding: var(--spacing-md);
    box-shadow: var(--shadow-xl);
    z-index: 1001;
    transform: translateX(100%);
    transition: var(--transition);
}

.notification.show {
    transform: translateX(0);
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
    
    .hamburger.active span:nth-child(1) {
        transform: rotate(45deg) translate(5px, 5px);
    }
    
    .hamburger.active span:nth-child(2) {
        opacity: 0;
    }
    
    .hamburger.active span:nth-child(3) {
        transform: rotate(-45deg) translate(7px, -6px);
    }
    
    .hero {
        padding: calc(100px + var(--spacing-lg)) 0 var(--spacing-lg);
    }
    
    .search-input-group {
        flex-direction: column;
    }
    
    .search-input-group button {
        border-radius: 0 0 var(--border-radius) var(--border-radius);
    }
    
    .section-header {
        flex-direction: column;
        text-align: center;
        gap: var(--spacing-md);
    }
    
    .restaurants-grid,
    .foods-grid,
    .testimonials-grid {
        grid-template-columns: 1fr;
    }
    
    .app-content {
        grid-template-columns: 1fr;
        text-align: center;
    }
    
    .app-buttons {
        justify-content: center;
    }
    
    .cta-buttons {
        flex-direction: column;
        align-items: center;
    }
    
    .footer-content {
        grid-template-columns: 1fr;
        text-align: center;
    }
    
    .cart-dropdown-content {
        right: -50px;
        min-width: 280px;
    }
}

@media (max-width: 480px) {
    .container {
        padding: 0 var(--spacing-sm);
    }
    
    .hero h1 {
        font-size: 2rem;
    }
    
    .hero p {
        font-size: 1rem;
    }
    
    .btn {
        padding: var(--spacing-sm) var(--spacing-md);
        font-size: 0.875rem;
    }
    
    .card-img-container {
        height: 150px;
    }
    
    .step {
        padding: var(--spacing-md);
    }
    
    .app-buttons {
        flex-direction: column;
    }
    
    .cta-buttons {
        flex-direction: column;
        width: 100%;
    }
    
    .cta-buttons .btn {
        width: 100%;
        justify-content: center;
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
// Fetch featured restaurants (in a real app, this would come from the database)
$featuredRestaurants = [
    [
        'id' => 1,
        'name' => 'Pizza Palace',
        'cuisine' => 'Italian, Pizza',
        'delivery_time' => '30-45 min',
        'min_order' => '$15.00',
        'rating' => 4.5,
        'review_count' => 128,
        'image' => 'https://images.unsplash.com/photo-1513104890138-7c749659a591?ixlib=rb-1.2.1&auto=format&fit=crop&w=1000&q=80',
        'is_open' => true
    ],
    [
        'id' => 2,
        'name' => 'Burger Barn',
        'cuisine' => 'American, Burgers',
        'delivery_time' => '20-35 min',
        'min_order' => '$10.00',
        'rating' => 4.2,
        'review_count' => 95,
        'image' => 'https://images.unsplash.com/photo-1553979459-d2229ba7433b?ixlib=rb-1.2.1&auto=format&fit=crop&w=1000&q=80',
        'is_open' => true
    ],
    [
        'id' => 3,
        'name' => 'Sushi Express',
        'cuisine' => 'Japanese, Sushi',
        'delivery_time' => '25-40 min',
        'min_order' => '$20.00',
        'rating' => 4.7,
        'review_count' => 156,
        'image' => 'https://images.unsplash.com/photo-1579871494447-9811cf80d66c?ixlib=rb-1.2.1&auto=format&fit=crop&w=1000&q=80',
        'is_open' => true
    ]
];

// Fetch popular foods (in a real app, this would come from the database)
$popularFoods = [
    [
        'id' => 1,
        'name' => 'Margherita Pizza',
        'restaurant' => 'Pizza Palace',
        'price' => 12.99,
        'rating' => 4.8,
        'image' => 'https://images.unsplash.com/photo-1604382355076-af4b0eb60143?ixlib=rb-1.2.1&auto=format&fit=crop&w=1000&q=80'
    ],
    [
        'id' => 2,
        'name' => 'Classic Burger',
        'restaurant' => 'Burger Barn',
        'price' => 9.99,
        'rating' => 4.5,
        'image' => 'https://images.unsplash.com/photo-1568901346375-23c9450c58cd?ixlib=rb-1.2.1&auto=format&fit=crop&w=1000&q=80'
    ],
    [
        'id' => 3,
        'name' => 'California Roll',
        'restaurant' => 'Sushi Express',
        'price' => 14.99,
        'rating' => 4.7,
        'image' => 'https://images.unsplash.com/photo-1579871494447-9811cf80d66c?ixlib=rb-1.2.1&auto=format&fit=crop&w=1000&q=80'
    ],
    [
        'id' => 4,
        'name' => 'Pasta Carbonara',
        'restaurant' => 'Pizza Palace',
        'price' => 11.99,
        'rating' => 4.6,
        'image' => 'https://images.unsplash.com/photo-1529692236672-191c62873dce?ixlib=rb-1.2.1&auto=format&fit=crop&w=1000&q=80'
    ]
];
?>

<!-- Hero Section -->
<section class="hero">
    <div class="hero-content">
        <h1>Delicious food, delivered to your door</h1>
        <p>Order from your favorite restaurants with just a few clicks</p>
        <div class="search-container">
            <form action="search.php" method="GET" class="search-form">
                <div class="search-input-group">
                    <i class="fas fa-map-marker-alt"></i>
                    <input type="text" name="location" placeholder="Enter your delivery address" required>
                    <button type="submit" class="btn btn-primary">Find Food</button>
                </div>
            </form>
        </div>
    </div>
</section>

<!-- How It Works Section -->
<section class="section how-it-works">
    <div class="container">
        <h2 class="section-title text-center">How It Works</h2>
        <div class="steps">
            <div class="step">
                <div class="step-icon">1</div>
                <h3>Choose a restaurant</h3>
                <p>Browse hundreds of menus to find the food you like</p>
            </div>
            <div class="step">
                <div class="step-icon">2</div>
                <h3>Customize your order</h3>
                <p>Add items to your cart and customize your meal</p>
            </div>
            <div class="step">
                <div class="step-icon">3</div>
                <h3>Fast delivery</h3>
                <p>Get your food delivered to your door in minutes</p>
            </div>
        </div>
    </div>
</section>

<!-- Featured Restaurants Section -->
<!-- How It Works Section -->
<section class="section how-it-works">
    <div class="container">
        <div class="section-header text-center">
            <h2 class="section-title">How It Works</h2>
            <p class="section-subtitle">Get your favorite food delivered in 3 easy steps</p>
        </div>
        <div class="steps-container">
            <div class="step">
                <div class="step-number">1</div>
                <div class="step-content">
                    <div class="step-icon">
                        <i class="fas fa-utensils"></i>
                    </div>
                    <h3>Choose a Restaurant</h3>
                    <p>Browse hundreds of menus to find the food you like</p>
                </div>
            </div>
            <div class="step">
                <div class="step-number">2</div>
                <div class="step-content">
                    <div class="step-icon">
                        <i class="fas fa-hamburger"></i>
                    </div>
                    <h3>Customize Your Order</h3>
                    <p>Add items to your cart and customize your meal</p>
                </div>
            </div>
            <div class="step">
                <div class="step-number">3</div>
                <div class="step-content">
                    <div class="step-icon">
                        <i class="fas fa-motorcycle"></i>
                    </div>
                    <h3>Fast Delivery</h3>
                    <p>Get your food delivered to your door in minutes</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Featured Restaurants Section -->
<section class="section featured-restaurants">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">Popular Restaurants</h2>
            <a href="pages/restaurants.php" class="btn btn-outline">View All</a>
        </div>
        
        <div class="restaurants-grid">
            <?php foreach ($featuredRestaurants as $restaurant): ?>
            <div class="restaurant-card fade-in" data-id="<?php echo $restaurant['id']; ?>" 
                 data-name="<?php echo htmlspecialchars($restaurant['name']); ?>"
                 data-image="<?php echo $restaurant['image']; ?>">
                <div class="card-img-container">
                    <img src="<?php echo $restaurant['image']; ?>" alt="<?php echo htmlspecialchars($restaurant['name']); ?>" class="card-img">
                    <?php if ($restaurant['is_open']): ?>
                        <span class="badge open">Open Now</span>
                    <?php else: ?>
                        <span class="badge closed">Closed</span>
                    <?php endif; ?>
                </div>
                <div class="card-content">
                    <h3><?php echo htmlspecialchars($restaurant['name']); ?></h3>
                    <p class="cuisine"><?php echo htmlspecialchars($restaurant['cuisine']); ?></p>
                    <div class="restaurant-meta">
                        <span class="rating">
                            <i class="fas fa-star"></i> <?php echo $restaurant['rating']; ?> (<?php echo $restaurant['review_count']; ?>)
                        </span>
                        <span class="delivery-time">
                            <i class="fas fa-clock"></i> <?php echo $restaurant['delivery_time']; ?>
                        </span>
                        <span class="min-order">
                            <i class="fas fa-shopping-bag"></i> Min: <?php echo $restaurant['min_order']; ?>
                        </span>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Popular Foods Section -->
<section class="section popular-foods">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">Popular Dishes</h2>
            <a href="#" class="btn btn-outline">View Menu</a>
        </div>
        
        <div class="foods-grid">
            <?php foreach ($popularFoods as $food): ?>
            <div class="food-card fade-in" data-id="<?php echo $food['id']; ?>" 
                 data-name="<?php echo htmlspecialchars($food['name']); ?>"
                 data-price="<?php echo $food['price']; ?>"
                 data-restaurant="<?php echo htmlspecialchars($food['restaurant']); ?>"
                 data-image="<?php echo $food['image']; ?>">
                <div class="card-img-container">
                    <img src="<?php echo $food['image']; ?>" alt="<?php echo htmlspecialchars($food['name']); ?>" class="card-img">
                    <button class="btn-favorite" aria-label="Add to favorites">
                        <i class="far fa-heart"></i>
                    </button>
                </div>
                <div class="card-content">
                    <h3><?php echo htmlspecialchars($food['name']); ?></h3>
                    <p class="restaurant"><?php echo htmlspecialchars($food['restaurant']); ?></p>
                    <div class="food-meta">
                        <span class="price">$<?php echo number_format($food['price'], 2); ?></span>
                        <span class="rating">
                            <i class="fas fa-star"></i> <?php echo $food['rating']; ?>
                        </span>
                    </div>
                    <button class="btn btn-sm btn-primary add-to-cart">
                        <i class="fas fa-plus"></i> Add to Cart
                    </button>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- App Download Section -->
<section class="section app-download">
    <div class="container">
        <div class="app-content d-flex flex-column flex-md-row align-items-center justify-content-between">
            <div class="app-text">
                <h2>Download Our Mobile App</h2>
                <p>Get exclusive offers and track your orders on the go. Download our app now!</p>
            </div>
            <div class="app-buttons">
                <a href="#" class="app-store-btn">
                    <img src="assets/images/app-store.png" alt="Download on the App Store">
                </a>
                <a href="#" class="google-play-btn">
                    <img src="assets/images/google-play.png" alt="Get it on Google Play">
                </a>
            </div>
            <div class="app-image flex-shrink-0">
                <img src="https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80" alt="FoodExpress App">
            </div>
        </div>
    </div>
</section>

<!-- Testimonials Section -->
<section class="section testimonials">
    <div class="container">
        <h2 class="section-title text-center">What Our Customers Say</h2>
        <div class="testimonials-grid">
            <div class="testimonial-card">
                <div class="testimonial-content">
                    <p>"The best food delivery service I've ever used. The food is always hot and delicious!"</p>
                </div>
                <div class="testimonial-author">
                    <img src="https://randomuser.me/api/portraits/women/32.jpg" alt="Sarah Johnson">
                    <div>
                        <h4>Sarah Johnson</h4>
                        <div class="rating">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="testimonial-card">
                <div class="testimonial-content">
                    <p>"Fast delivery and great customer service. Highly recommended!"</p>
                </div>
                <div class="testimonial-author">
                    <img src="https://randomuser.me/api/portraits/men/45.jpg" alt="Michael Chen">
                    <div>
                        <h4>Michael Chen</h4>
                        <div class="rating">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="far fa-star"></i>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="testimonial-card">
                <div class="testimonial-content">
                    <p>"Amazing selection of restaurants and the food always arrives on time. 5 stars!"</p>
                </div>
                <div class="testimonial-author">
                    <img src="https://randomuser.me/api/portraits/women/68.jpg" alt="Emily Rodriguez">
                    <div>
                        <h4>Emily Rodriguez</h4>
                        <div class="rating">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="cta-section">
    <div class="container">
        <div class="cta-content">
            <h2>Hungry? You're in the right place</h2>
            <p>Join thousands of other restaurants who benefit from having their menus on FoodExpress</p>
            <div class="cta-buttons">
                <a href="signup.php" class="btn btn-primary btn-lg">Sign Up Now</a>
                <a href="pages/restaurants.php" class="btn btn-outline btn-lg">Order Now</a>
            </div>
        </div>
    </div>
</section>

<script src="assets/js/main.js"></script>
<?php require_once 'includes/footer.php'; ?>
