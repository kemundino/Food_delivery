<?php
require_once '../includes/auth.php';
require_once '../includes/role_check.php';
require_once '../includes/cart_functions.php';

// Check if user has customer role (cart is for customers only)
requireRole(['customer']);

$cart = getCart();
$restaurant = null;

// If cart is not empty, get restaurant details
if (!empty($cart['items'])) {
    $restaurant_id = $cart['restaurant_id'];
    $sql = "SELECT * FROM restaurants WHERE id = ?";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $restaurant_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $restaurant = $result->fetch_assoc();
        $stmt->close();
    }
}
?>

<div class="container py-5">
    <h1 class="mb-4">Your Cart</h1>
    
    <?php if (empty($cart['items'])): ?>
        <div class="text-center py-5">
            <div class="empty-cart-icon mb-4">
                <i class="fas fa-shopping-cart fa-4x text-muted"></i>
            </div>
            <h3 class="mb-3">Your cart is empty</h3>
            <p class="text-muted mb-4">Looks like you haven't added anything to your cart yet.</p>
            <a href="restaurants.php" class="btn btn-primary btn-lg">Browse Restaurants</a>
        </div>
    <?php else: ?>
        <div class="row">
            <div class="col-lg-8">
                <div class="card mb-4">
                    <div class="card-header bg-white">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">
                                <i class="fas fa-utensils me-2"></i>
                                <?php echo htmlspecialchars($restaurant['name']); ?>
                            </h5>
                            <a href="restaurant.php?id=<?php echo $restaurant['id']; ?>" class="text-primary">
                                View Menu <i class="fas fa-chevron-right ms-1"></i>
                            </a>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="list-group list-group-flush">
                            <?php foreach ($cart['items'] as $index => $item): ?>
                                <div class="list-group-item">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div class="me-3">
                                            <div class="d-flex align-items-center">
                                                <div class="quantity-controls me-3">
                                                    <button class="btn btn-sm btn-outline-secondary btn-decrease" 
                                                            data-item-index="<?php echo $index; ?>" 
                                                            data-item-id="<?php echo $item['id']; ?>">
                                                        <i class="fas fa-minus"></i>
                                                    </button>
                                                    <span class="mx-2 quantity"><?php echo $item['quantity']; ?></span>
                                                    <button class="btn btn-sm btn-outline-primary btn-increase" 
                                                            data-item-index="<?php echo $index; ?>"
                                                            data-item-id="<?php echo $item['id']; ?>">
                                                        <i class="fas fa-plus"></i>
                                                    </button>
                                                </div>
                                                <div>
                                                    <h6 class="mb-1"><?php echo htmlspecialchars($item['name']); ?></h6>
                                                    <?php if (!empty($item['notes'])): ?>
                                                        <p class="text-muted small mb-1">
                                                            <i>Note: <?php echo htmlspecialchars($item['notes']); ?></i>
                                                        </p>
                                                    <?php endif; ?>
                                                    <p class="text-muted small mb-0">
                                                        $<?php echo number_format($item['price'], 2); ?> each
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-end">
                                            <div class="h6 mb-2">
                                                $<?php echo number_format($item['subtotal'], 2); ?>
                                            </div>
                                            <button class="btn btn-sm btn-outline-danger btn-remove" 
                                                    data-item-index="<?php echo $index; ?>">
                                                <i class="far fa-trash-alt"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
                
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title mb-3">Special Instructions</h5>
                        <textarea class="form-control" id="specialInstructions" rows="3" 
                                  placeholder="Any special instructions for the restaurant? (e.g., no onions, extra sauce, etc.)"></textarea>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4">
                <div class="card sticky-top" style="top: 20px;">
                    <div class="card-body">
                        <h5 class="card-title mb-3">Order Summary</h5>
                        
                        <div class="d-flex justify-content-between mb-2">
                            <span>Subtotal (<?php echo $cart['item_count']; ?> items)</span>
                            <span>$<?php echo number_format($cart['total'], 2); ?></span>
                        </div>
                        
                        <div class="d-flex justify-content-between mb-2">
                            <span>Delivery Fee</span>
                            <span>$<?php echo number_format($restaurant['delivery_fee'] ?? 0, 2); ?></span>
                        </div>
                        
                        <div class="d-flex justify-content-between mb-2">
                            <span>Tax</span>
                            <?php 
                            $tax_rate = 0.08; // 8% tax rate
                            $tax = $cart['total'] * $tax_rate;
                            ?>
                            <span>$<?php echo number_format($tax, 2); ?></span>
                        </div>
                        
                        <hr>
                        
                        <div class="d-flex justify-content-between mb-4">
                            <strong>Total</strong>
                            <strong>$<?php echo number_format($cart['total'] + $tax + ($restaurant['delivery_fee'] ?? 0), 2); ?></strong>
                        </div>
                        
                        <button id="checkoutBtn" class="btn btn-primary btn-lg w-100 mb-3">
                            Proceed to Checkout
                        </button>
                        
                        <p class="text-muted small mb-0">
                            By placing your order, you agree to our Terms of Service and Privacy Policy.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>

<!-- Remove Item Modal -->
<div class="modal fade" id="removeItemModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Remove Item</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to remove this item from your cart?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="confirmRemove">Remove</button>
            </div>
        </div>
    </div>
</div>

<?php require_once '../includes/footer.php'; ?>

<script>
$(document).ready(function() {
    let itemToRemove = null;
    
    // Handle quantity increase
    $('.btn-increase').click(function() {
        const itemIndex = $(this).data('item-index');
        const currentQty = parseInt($(this).siblings('.quantity').text());
        updateCartItem(itemIndex, currentQty + 1);
    });
    
    // Handle quantity decrease
    $('.btn-decrease').click(function() {
        const itemIndex = $(this).data('item-index');
        const currentQty = parseInt($(this).siblings('.quantity').text());
        
        if (currentQty > 1) {
            updateCartItem(itemIndex, currentQty - 1);
        } else {
            // If quantity would go to 0, prompt for removal
            showRemoveConfirmation(itemIndex);
        }
    });
    
    // Handle remove button click
    $('.btn-remove').click(function() {
        const itemIndex = $(this).data('item-index');
        showRemoveConfirmation(itemIndex);
    });
    
    // Show remove confirmation modal
    function showRemoveConfirmation(index) {
        itemToRemove = index;
        $('#removeItemModal').modal('show');
    }
    
    // Confirm remove
    $('#confirmRemove').click(function() {
        if (itemToRemove !== null) {
            removeCartItem(itemToRemove);
            itemToRemove = null;
            $('#removeItemModal').modal('hide');
        }
    });
    
    // Update cart item quantity
    function updateCartItem(index, quantity) {
        $.ajax({
            url: '../includes/cart_functions.php',
            type: 'POST',
            data: {
                action: 'update',
                item_index: index,
                quantity: quantity
            },
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    location.reload(); // Reload to reflect changes
                } else {
                    showAlert('Error updating cart', 'danger');
                }
            },
            error: function() {
                showAlert('Error updating cart', 'danger');
            }
        });
    }
    
    // Remove cart item
    function removeCartItem(index) {
        $.ajax({
            url: '../includes/cart_functions.php',
            type: 'POST',
            data: {
                action: 'remove',
                item_index: index
            },
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    location.reload(); // Reload to reflect changes
                } else {
                    showAlert('Error removing item', 'danger');
                }
            },
            error: function() {
                showAlert('Error removing item', 'danger');
            }
        });
    }
    
    // Handle checkout button click
    $('#checkoutBtn').click(function() {
        const specialInstructions = $('#specialInstructions').val();
        
        // In a real application, you would handle the checkout process here
        // For now, we'll just show a success message
        showAlert('Checkout functionality will be implemented here', 'info');
        
        // Example of what you might do:
        // window.location.href = 'checkout.php';
    });
    
    // Helper function to show alerts
    function showAlert(message, type = 'info') {
        const alertHtml = `
            <div class="alert alert-${type} alert-dismissible fade show" role="alert">
                ${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        `;
        
        // Prepend alert to the container
        $('.container').prepend(alertHtml);
        
        // Auto-remove alert after 5 seconds
        setTimeout(() => {
            $('.alert').alert('close');
        }, 5000);
    }
});
</script>
