<?php
// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

/**
 * Initialize the cart if it doesn't exist
 */
function initCart() {
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [
            'items' => [],
            'restaurant_id' => null,
            'total' => 0.00,
            'item_count' => 0
        ];
    }
}

/**
 * Add item to cart
 */
function addToCart($item_id, $name, $price, $quantity = 1, $restaurant_id, $notes = '') {
    initCart();
    
    // Check if cart is empty or from the same restaurant
    if (!empty($_SESSION['cart']['items']) && $_SESSION['cart']['restaurant_id'] != $restaurant_id) {
        return ['success' => false, 'message' => 'You can only order from one restaurant at a time.'];
    }
    
    // Set restaurant ID if this is the first item
    if (empty($_SESSION['cart']['items'])) {
        $_SESSION['cart']['restaurant_id'] = $restaurant_id;
    }
    
    // Check if item already exists in cart
    $item_exists = false;
    foreach ($_SESSION['cart']['items'] as &$item) {
        if ($item['id'] == $item_id && $item['notes'] == $notes) {
            $item['quantity'] += $quantity;
            $item_exists = true;
            break;
        }
    }
    
    // If item doesn't exist, add it
    if (!$item_exists) {
        $_SESSION['cart']['items'][] = [
            'id' => $item_id,
            'name' => $name,
            'price' => $price,
            'quantity' => $quantity,
            'notes' => $notes,
            'subtotal' => $price * $quantity
        ];
    }
    
    // Update cart totals
    updateCartTotals();
    
    return ['success' => true, 'cart' => $_SESSION['cart']];
}

/**
 * Remove item from cart
 */
function removeFromCart($item_index) {
    if (!isset($_SESSION['cart']['items'][$item_index])) {
        return false;
    }
    
    // Remove the item
    array_splice($_SESSION['cart']['items'], $item_index, 1);
    
    // Update cart totals
    updateCartTotals();
    
    // If cart is empty, reset restaurant ID
    if (empty($_SESSION['cart']['items'])) {
        $_SESSION['cart']['restaurant_id'] = null;
    }
    
    return true;
}

/**
 * Update item quantity in cart
 */
function updateCartItem($item_index, $quantity) {
    if (!isset($_SESSION['cart']['items'][$item_index])) {
        return false;
    }
    
    if ($quantity <= 0) {
        return removeFromCart($item_index);
    }
    
    $_SESSION['cart']['items'][$item_index]['quantity'] = $quantity;
    $_SESSION['cart']['items'][$item_index]['subtotal'] = 
        $quantity * $_SESSION['cart']['items'][$item_index]['price'];
    
    // Update cart totals
    updateCartTotals();
    
    return true;
}

/**
 * Update cart totals
 */
function updateCartTotals() {
    $total = 0;
    $item_count = 0;
    
    foreach ($_SESSION['cart']['items'] as $item) {
        $total += $item['subtotal'];
        $item_count += $item['quantity'];
    }
    
    $_SESSION['cart']['total'] = $total;
    $_SESSION['cart']['item_count'] = $item_count;
}

/**
 * Clear the cart
 */
function clearCart() {
    $_SESSION['cart'] = [
        'items' => [],
        'restaurant_id' => null,
        'total' => 0.00,
        'item_count' => 0
    ];
}

/**
 * Get cart contents
 */
function getCart() {
    initCart();
    return $_SESSION['cart'];
}

// Handle AJAX requests
if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
    header('Content-Type: application/json');
    $response = ['success' => false, 'message' => 'Invalid request'];
    
    // Check if user is logged in
    if (!isset($_SESSION['user_id'])) {
        echo json_encode(['success' => false, 'message' => 'Please login to add items to cart']);
        exit;
    }
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $action = $_POST['action'] ?? '';
        
        switch ($action) {
            case 'add':
                if (isset($_POST['item_id'], $_POST['name'], $_POST['price'], $_POST['restaurant_id'])) {
                    $quantity = (int)($_POST['quantity'] ?? 1);
                    $notes = $_POST['notes'] ?? '';
                    $response = addToCart(
                        $_POST['item_id'],
                        $_POST['name'],
                        $_POST['price'],
                        $quantity,
                        $_POST['restaurant_id'],
                        $notes
                    );
                }
                break;
                
            case 'update':
                if (isset($_POST['item_index'], $_POST['quantity'])) {
                    $success = updateCartItem((int)$_POST['item_index'], (int)$_POST['quantity']);
                    $response = [
                        'success' => $success,
                        'cart' => getCart()
                    ];
                }
                break;
                
            case 'remove':
                if (isset($_POST['item_index'])) {
                    $success = removeFromCart((int)$_POST['item_index']);
                    $response = [
                        'success' => $success,
                        'cart' => getCart()
                    ];
                }
                break;
                
            case 'clear':
                clearCart();
                $response = ['success' => true, 'cart' => getCart()];
                break;
                
            case 'get':
                $response = ['success' => true, 'cart' => getCart()];
                break;
        }
    }
    
    echo json_encode($response);
    exit;
}
