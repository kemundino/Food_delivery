<?php
require_once '../includes/auth.php';
require_once '../includes/role_check.php';

// Check if user has admin role
requireRole(['admin']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - FoodExpress</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/admin.css">
</head>
<body class="admin-dashboard">
    <div class="admin-container">
        <?php include 'includes/sidebar.php'; ?>
        
        <main class="main-content">
            <header class="admin-header">
                <h1>Dashboard Overview</h1>
                <div class="admin-actions">
                    <span>Welcome, <?php echo htmlspecialchars($_SESSION['user_name']); ?></span>
                    <a href="../logout.php" class="btn btn-logout">Logout</a>
                </div>
            </header>

            <div class="dashboard-cards">
                <div class="card">
                    <div class="card-icon">
                        <i class="fas fa-utensils"></i>
                    </div>
                    <div class="card-content">
                        <h3>Restaurants</h3>
                        <?php
                        $result = $conn->query("SELECT COUNT(*) as count FROM restaurants");
                        $count = $result->fetch_assoc()['count'];
                        ?>
                        <p class="card-number"><?php echo $count; ?></p>
                        <a href="restaurants.php" class="card-link">View All <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>

                <div class="card">
                    <div class="card-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="card-content">
                        <h3>Users</h3>
                        <?php
                        $result = $conn->query("SELECT COUNT(*) as count FROM users WHERE is_admin = 0");
                        $count = $result->fetch_assoc()['count'];
                        ?>
                        <p class="card-number"><?php echo $count; ?></p>
                        <a href="users.php" class="card-link">View All <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>

                <div class="card">
                    <div class="card-icon">
                        <i class="fas fa-shopping-cart"></i>
                    </div>
                    <div class="card-content">
                        <h3>Orders</h3>
                        <?php
                        $result = $conn->query("SELECT COUNT(*) as count FROM orders");
                        $count = $result->fetch_assoc()['count'];
                        ?>
                        <p class="card-number"><?php echo $count; ?></p>
                        <a href="orders.php" class="card-link">View All <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>

            <!-- Recent Orders Section -->
            <section class="recent-orders">
                <h2>Recent Orders</h2>
                <div class="table-responsive">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Customer</th>
                                <th>Restaurant</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = "SELECT o.*, u.name as customer_name, r.name as restaurant_name 
                                    FROM orders o 
                                    JOIN users u ON o.user_id = u.id 
                                    JOIN restaurants r ON o.restaurant_id = r.id 
                                    ORDER BY o.created_at DESC LIMIT 5";
                            $result = $conn->query($sql);
                            
                            if ($result->num_rows > 0) {
                                while($row = $result->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<td>#" . $row['order_number'] . "</td>";
                                    echo "<td>" . htmlspecialchars($row['customer_name']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['restaurant_name']) . "</td>";
                                    echo "<td>$" . number_format($row['final_amount'], 2) . "</td>";
                                    echo "<td><span class='status-badge status-" . strtolower($row['status']) . "'>" . ucfirst($row['status']) . "</span></td>";
                                    echo "<td>" . date('M d, Y', strtotime($row['created_at'])) . "</td>";
                                    echo "<td><a href='order_details.php?id=" . $row['id'] . "' class='btn-action'><i class='fas fa-eye'></i></a></td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='7' class='text-center'>No recent orders found.</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </section>
        </main>
    </div>

    <script src="../assets/js/admin.js"></script>
</body>
</html>
