// DOM Elements (all assigned inside DOMContentLoaded)
let hamburger, navLinks, cartCount, searchForm, foodSearch, addToCartButtons, quantityControls, removeItemButtons, checkoutForm; // declared ONCE only

// Mobile menu helpers
function toggleMobileMenu() {
    if (!hamburger || !navLinks) return;

    const isActive = hamburger.classList.contains('active');
    
    // Toggle classes
    hamburger.classList.toggle('active');
    navLinks.classList.toggle('active');
    
    // Prevent body scroll when menu is open
    if (!isActive) {
        document.body.style.overflow = 'hidden';
    } else {
        document.body.style.overflow = '';
    }
    
    // Update ARIA attributes for accessibility
    hamburger.setAttribute('aria-expanded', !isActive);
}

function closeMobileMenu() {
    if (!hamburger || !navLinks) return;

    hamburger.classList.remove('active');
    navLinks.classList.remove('active');
    document.body.style.overflow = '';
    hamburger.setAttribute('aria-expanded', 'false');
}

// Cart Functions
class Cart {
    constructor() {
        this.items = this.loadCart();
        this.updateCartCount();
    }

    loadCart() {
        return JSON.parse(localStorage.getItem('cart')) || [];
    }

    saveCart() {
        localStorage.setItem('cart', JSON.stringify(this.items));
        this.updateCartCount();
    }

    addItem(item) {
        const existingItem = this.items.find(i => i.id === item.id);
        
        if (existingItem) {
            existingItem.quantity += item.quantity || 1;
        } else {
            this.items.push({ ...item, quantity: item.quantity || 1 });
        }
        
        this.saveCart();
        this.showNotification('Item added to cart!');
    }

    removeItem(itemId) {
        this.items = this.items.filter(item => item.id !== itemId);
        this.saveCart();
        this.showNotification('Item removed from cart!');
    }

    updateQuantity(itemId, newQuantity) {
        if (newQuantity < 1) return;
        
        const item = this.items.find(i => i.id === itemId);
        if (item) {
            item.quantity = newQuantity;
            this.saveCart();
        }
    }

    getTotalItems() {
        return this.items.reduce((total, item) => total + item.quantity, 0);
    }

    getTotalPrice() {
        return this.items.reduce((total, item) => {
            return total + (item.price * item.quantity);
        }, 0).toFixed(2);
    }

    updateCartCount() {
        if (cartCount) {
            const count = this.getTotalItems();
            cartCount.textContent = count > 0 ? count : '';
        }
    }

    clearCart() {
        this.items = [];
        this.saveCart();
    }

    showNotification(message) {
        const notification = document.createElement('div');
        notification.className = 'notification';
        notification.textContent = message;
        document.body.appendChild(notification);
        
        setTimeout(() => {
            notification.classList.add('show');
        }, 100);
        
        setTimeout(() => {
            notification.classList.remove('show');
            setTimeout(() => {
                notification.remove();
            }, 300);
        }, 3000);
    }
}

// Initialize Cart
const cart = new Cart();

// Add to Cart Functionality
if (addToCartButtons) {
    addToCartButtons.forEach(button => {
        button.addEventListener('click', (e) => {
            e.preventDefault();
            
            const card = button.closest('.food-card, .restaurant-card');
            const item = {
                id: card.dataset.id,
                name: card.dataset.name,
                price: parseFloat(card.dataset.price),
                image: card.dataset.image,
                restaurant: card.dataset.restaurant
            };
            
            cart.addItem(item);
        });
    });
}

// Quantity Controls
if (quantityControls) {
    quantityControls.forEach(control => {
        control.addEventListener('click', () => {
            const input = control.parentElement.querySelector('.quantity');
            let value = parseInt(input.value);
            
            if (control.classList.contains('decrease')) {
                value = Math.max(1, value - 1);
            } else {
                value += 1;
            }
            
            input.value = value;
            
            // If we're on the cart page, update the cart
            if (window.location.pathname.includes('cart.php')) {
                const itemId = control.closest('.cart-item').dataset.itemId;
                cart.updateQuantity(itemId, value);
                updateCartTotals();
            }
        });
    });
}

// Remove Item from Cart
if (removeItemButtons) {
    removeItemButtons.forEach(button => {
        button.addEventListener('click', () => {
            const itemId = button.closest('.cart-item').dataset.itemId;
            cart.removeItem(itemId);
            
            // Remove the item from the DOM
            setTimeout(() => {
                button.closest('.cart-item').remove();
                updateCartTotals();
                
                // If cart is empty, show empty cart message
                if (document.querySelectorAll('.cart-item').length === 0) {
                    document.querySelector('.cart-items').innerHTML = `
                        <div class="empty-cart">
                            <i class="fas fa-shopping-cart"></i>
                            <h3>Your cart is empty</h3>
                            <p>Looks like you haven't added anything to your cart yet.</p>
                            <a href="/food_delivery/pages/restaurants.php" class="btn btn-primary">Browse Restaurants</a>
                        </div>
                    `;
                }
            }, 300);
        });
    });
}

// Update Cart Totals
function updateCartTotals() {
    const cart = new Cart();
    const subtotalElement = document.querySelector('.subtotal-amount');
    const totalElement = document.querySelector('.total-amount');
    const taxRate = 0.08; // 8% tax
    
    if (subtotalElement && totalElement) {
        const subtotal = parseFloat(cart.getTotalPrice());
        const tax = subtotal * taxRate;
        const total = subtotal + tax;
        
        subtotalElement.textContent = `$${subtotal.toFixed(2)}`;
        document.querySelector('.tax-amount').textContent = `$${tax.toFixed(2)}`;
        totalElement.textContent = `$${total.toFixed(2)}`;
    }
}


document.addEventListener('DOMContentLoaded', function() {
    // Assign DOM elements only inside DOMContentLoaded
    hamburger = document.querySelector('.hamburger');
    navLinks = document.querySelector('.nav-links');
    cartCount = document.querySelector('.cart-count');
    searchForm = document.querySelector('.search-form');
    foodSearch = document.getElementById('food-search');
    addToCartButtons = document.querySelectorAll('.add-to-cart');
    quantityControls = document.querySelectorAll('.quantity-control');
    removeItemButtons = document.querySelectorAll('.remove-item');
    checkoutForm = document.getElementById('checkout-form');

    // Mark that JS enhancements are active
    document.body.classList.add('js-loaded');

    // Navigation elements
    hamburger = document.querySelector('.hamburger');
    navLinks = document.querySelector('.nav-links');

    if (hamburger && navLinks) {
        // Toggle via click
        hamburger.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            toggleMobileMenu();
        });

        // Toggle via touch
        hamburger.addEventListener('touchstart', function(e) {
            e.preventDefault();
            e.stopPropagation();
            toggleMobileMenu();
        });

        // Keyboard support
        hamburger.addEventListener('keydown', function(e) {
            if (e.key === 'Enter' || e.key === ' ') {
                e.preventDefault();
                toggleMobileMenu();
            }
        });

        // Close when clicking a nav link
        navLinks.querySelectorAll('a').forEach(function(link) {
            link.addEventListener('click', function() {
                closeMobileMenu();
            });
        });

        // Close when clicking outside the nav
        document.addEventListener('click', function(e) {
            if (!hamburger || !navLinks) return;
            if (
                navLinks.classList.contains('active') &&
                !hamburger.contains(e.target) &&
                !navLinks.contains(e.target)
            ) {
                closeMobileMenu();
            }
        });

        // Close on Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && navLinks && navLinks.classList.contains('active')) {
                closeMobileMenu();
            }
        });

        // Close on large-screen resize
        window.addEventListener('resize', function() {
            if (window.innerWidth > 1024 && navLinks && navLinks.classList.contains('active')) {
                closeMobileMenu();
            }
        });
    }

    // Add to cart functionality for restaurant menu modal
    const addToCartButtonsModal = document.querySelectorAll('.add-to-cart');
    let addToCartModal = null;
    let currentItem = null;

    // Check if Bootstrap is available and modal exists
    if (typeof bootstrap !== 'undefined' && document.getElementById('addToCartModal')) {
        addToCartModal = new bootstrap.Modal(document.getElementById('addToCartModal'));
    }

    // Initialize tooltips if Bootstrap is available
    if (typeof bootstrap !== 'undefined') {
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        const tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    }
    
    // Handle add to cart button click
    addToCartButtonsModal.forEach(function(button) {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            
            const menuItem = this.closest('.menu-item');
            if (!menuItem) return;
            // Get restaurant info from data attributes on the page
            const restaurantInfo = document.getElementById('restaurant-info');
            currentItem = {
                id: menuItem.dataset.id,
                name: menuItem.dataset.name,
                price: parseFloat(menuItem.dataset.price),
                restaurant_id: restaurantInfo ? restaurantInfo.dataset.restaurantId : '',
                restaurant_name: restaurantInfo ? restaurantInfo.dataset.restaurantName : '',
                image: menuItem.dataset.image || 'https://via.placeholder.com/300x200?text=Food+Item'
            };
            
            // Update modal content
            document.getElementById('modalItemName').textContent = currentItem.name;
            document.getElementById('modalItemPrice').textContent = '$' + currentItem.price.toFixed(2);
            document.getElementById('modalItemImage').src = currentItem.image;
            document.getElementById('modalItemImage').alt = currentItem.name;
            document.getElementById('itemQuantity').value = 1;
            document.getElementById('itemNotes').value = '';
            updateModalTotal();
            
            // Show the modal only if it exists
            if (addToCartModal) {
                addToCartModal.show();
            } else {
                // Fallback: add directly to cart if modal is not available
                console.log('Modal not available, adding item directly to cart');
                // You could implement direct cart addition here
            }
        });
    });
    
    // Quantity controls
    document.getElementById('increaseQty').addEventListener('click', function() {
        const qtyInput = document.getElementById('itemQuantity');
        let qty = parseInt(qtyInput.value) || 1;
        if (qty < 20) {
            qtyInput.value = qty + 1;
            updateModalTotal();
        }
    });
    
    document.getElementById('decreaseQty').addEventListener('click', function() {
        const qtyInput = document.getElementById('itemQuantity');
        let qty = parseInt(qtyInput.value) || 1;
        if (qty > 1) {
            qtyInput.value = qty - 1;
            updateModalTotal();
        }
    });
    
    document.getElementById('itemQuantity').addEventListener('change', function() {
        let qty = parseInt(this.value) || 1;
        if (qty < 1) this.value = 1;
        if (qty > 20) this.value = 20;
        updateModalTotal();
    });
    
    // Update modal total when quantity changes
    function updateModalTotal() {
        if (!currentItem) return;
        const quantity = parseInt(document.getElementById('itemQuantity').value) || 1;
        const total = (currentItem.price * quantity).toFixed(2);
        document.getElementById('modalItemTotal').textContent = total;
    }
    
    // Handle add to cart confirmation
    document.getElementById('confirmAddToCart').addEventListener('click', function() {
        if (!currentItem) return;
        
        const quantity = parseInt(document.getElementById('itemQuantity').value) || 1;
        const notes = document.getElementById('itemNotes').value.trim();
        
        // Add to cart via AJAX
        $.ajax({
            url: '../includes/cart_functions.php',
            type: 'POST',
            data: {
                action: 'add',
                item_id: currentItem.id,
                name: currentItem.name,
                price: currentItem.price,
                quantity: quantity,
                restaurant_id: currentItem.restaurant_id,
                notes: notes
            },
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    // Show success message
                    showAlert(`${currentItem.name} added to cart!`, 'success');
                    
                    // Update cart count in header
                    updateCartCount(response.cart.item_count);
                    
                    // Update sticky cart if exists
                    const stickyCart = document.querySelector('.sticky-add-to-cart');
                    if (stickyCart) {
                        stickyCart.querySelector('.item-count').textContent = response.cart.item_count;
                        stickyCart.querySelector('.total-amount').textContent = '$' + parseFloat(response.cart.total).toFixed(2);
                    }
                    
                    // Close the modal only if it exists
                    if (addToCartModal) {
                        addToCartModal.hide();
                    }
                } else {
                    showAlert(response.message || 'Error adding item to cart', 'danger');
                }
            },
            error: function() {
                showAlert('Error adding item to cart', 'danger');
            }
        });
    });
    
    // Function to update cart count in header
    function updateCartCount(count) {
        const cartCount = document.querySelector('.cart-count');
        if (cartCount) {
            cartCount.textContent = count > 0 ? count : '';
        }
    }
    
    // Function to show alert messages
    function showAlert(message, type = 'info') {
        const alertHtml = `
            <div class="alert alert-${type} alert-dismissible fade show" role="alert">
                ${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        `;
        
        // Prepend alert to the container
        const container = document.querySelector('.container');
        if (container) {
            container.insertAdjacentHTML('afterbegin', alertHtml);
            
            // Auto-remove alert after 5 seconds
            setTimeout(() => {
                const alert = document.querySelector('.alert');
                if (alert && typeof bootstrap !== 'undefined') {
                    const bsAlert = new bootstrap.Alert(alert);
                    bsAlert.close();
                } else if (alert) {
                    // Fallback: remove alert manually if Bootstrap is not available
                    alert.remove();
                }
            }, 5000);
        }
    }
    
    // Handle sticky cart view button
    const viewCartBtn = document.getElementById('viewCartBtn');
    if (viewCartBtn) {
        viewCartBtn.addEventListener('click', function() {
            window.location.href = 'cart.php';
        });
    }
    
    // Initialize cart count on page load
    function initCartCount() {
        $.ajax({
            url: '../includes/cart_functions.php',
            type: 'POST',
            data: { action: 'get' },
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    updateCartCount(response.cart.item_count);
                }
            }
        });
    }
    
    // Initialize cart count
    initCartCount();
});

// Form Validation
if (checkoutForm) {
    checkoutForm.addEventListener('submit', (e) => {
        e.preventDefault();
        
        let isValid = true;
        const formData = new FormData(checkoutForm);
        const errors = [];
        
        // Simple validation example
        if (!formData.get('name')) {
            errors.push('Name is required');
            isValid = false;
        }
        
        if (!formData.get('email') || !isValidEmail(formData.get('email'))) {
            errors.push('Valid email is required');
            isValid = false;
        }
        
        if (!formData.get('address')) {
            errors.push('Delivery address is required');
            isValid = false;
        }
        
        if (isValid) {
            // Here you would typically send the form data to your server
            alert('Order placed successfully!');
            cart.clearCart();
            window.location.href = '/food_delivery/order-confirmation.php';
        } else {
            // Show errors to the user
            alert('Please fix the following errors:\n' + errors.join('\n'));
        }
    });
}

// Helper function to validate email
function isValidEmail(email) {
    const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return re.test(String(email).toLowerCase());
}

// Search Functionality
if (searchForm && foodSearch) {
    searchForm.addEventListener('submit', (e) => {
        e.preventDefault();
        const query = foodSearch.value.trim();
        
        if (query) {
            window.location.href = `/food_delivery/search.php?q=${encodeURIComponent(query)}`;
        }
    });
}

// Image Lazy Loading
if ('loading' in HTMLImageElement.prototype) {
    const images = document.querySelectorAll('img[loading="lazy"]');
    images.forEach(img => {
        img.src = img.dataset.src;
    });
} else {
    // Fallback for browsers that don't support lazy loading
    const script = document.createElement('script');
    script.src = 'https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js';
    document.body.appendChild(script);
}

// Add to cart animation
document.addEventListener('click', (e) => {
    if (e.target.closest('.add-to-cart')) {
        const button = e.target.closest('.add-to-cart');
        const buttonRect = button.getBoundingClientRect();
        
        const cartIcon = document.querySelector('.fa-shopping-cart');
        if (!cartIcon) return;
        
        const cartRect = cartIcon.getBoundingClientRect();
        
        const animation = document.createElement('div');
        animation.className = 'add-to-cart-animation';
        
        // Set initial position
        
        document.body.appendChild(animation);
        
        // Trigger reflow
        void animation.offsetWidth;
        
        // Animate to cart
        
        // Remove animation element after it's done
        setTimeout(() => {
            animation.remove();
        }, 500);
    }
});

// js-loaded class is added in the main DOMContentLoaded handler above
