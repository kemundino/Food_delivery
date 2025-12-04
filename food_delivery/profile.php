<?php
require_once 'includes/auth.php';
require_once 'includes/role_check.php';

// Check if user is logged in (any role allowed)
requireRole(['customer', 'vendor', 'admin']);

require_once 'includes/header.php';

// Get user data
$user_id = $_SESSION['user_id'];
$user = [];
$errors = [];
$success = '';

// Fetch user data
$stmt = $conn->prepare("SELECT id, name, email, phone, address, role, created_at FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

// Process form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $address = trim($_POST['address'] ?? '');
    $current_password = $_POST['current_password'] ?? '';
    $new_password = $_POST['new_password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';

    // Basic validation
    if (empty($name)) {
        $errors[] = "Name is required";
    }

    if (empty($email)) {
        $errors[] = "Email is required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format";
    }

    // Check if email already exists (if changed)
    if ($email !== $user['email']) {
        $stmt = $conn->prepare("SELECT id FROM users WHERE email = ? AND id != ?");
        $stmt->bind_param("si", $email, $user_id);
        $stmt->execute();
        if ($stmt->get_result()->num_rows > 0) {
            $errors[] = "Email already in use";
        }
    }

    // Password change logic
    if (!empty($current_password) || !empty($new_password) || !empty($confirm_password)) {
        if (empty($current_password)) {
            $errors[] = "Current password is required to change password";
        } else {
            // Verify current password
            $stmt = $conn->prepare("SELECT password FROM users WHERE id = ?");
            $stmt->bind_param("i", $user_id);
            $stmt->execute();
            $result = $stmt->get_result();
            $db_password = $result->fetch_assoc()['password'];

            if (!password_verify($current_password, $db_password)) {
                $errors[] = "Current password is incorrect";
            } elseif (empty($new_password)) {
                $errors[] = "New password is required";
            } elseif (strlen($new_password) < 6) {
                $errors[] = "New password must be at least 6 characters long";
            } elseif ($new_password !== $confirm_password) {
                $errors[] = "New passwords do not match";
            }
        }
    }

    // Update user data if no errors
    if (empty($errors)) {
        try {
            $conn->begin_transaction();

            // Update basic info
            $stmt = $conn->prepare("UPDATE users SET name = ?, email = ?, phone = ?, address = ? WHERE id = ?");
            $stmt->bind_param("ssssi", $name, $email, $phone, $address, $user_id);
            $stmt->execute();

            // Update password if changed
            if (!empty($new_password)) {
                $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
                $stmt = $conn->prepare("UPDATE users SET password = ? WHERE id = ?");
                $stmt->bind_param("si", $hashed_password, $user_id);
                $stmt->execute();
            }

            $conn->commit();
            
            // Update session
            $_SESSION['user_name'] = $name;
            $_SESSION['user_email'] = $email;
            
            // Refresh user data
            $stmt = $conn->prepare("SELECT id, name, email, phone, address, role, created_at FROM users WHERE id = ?");
            $stmt->bind_param("i", $user_id);
            $stmt->execute();
            $result = $stmt->get_result();
            $user = $result->fetch_assoc();
            
            $success = "Profile updated successfully!";
        } catch (Exception $e) {
            $conn->rollback();
            $errors[] = "An error occurred. Please try again.";
        }
    }
}
?>

<style>
/* Profile Page Styles */
.profile-container {
    max-width: 800px;
    margin: var(--spacing-2xl) auto;
    padding: var(--spacing-2xl);
    background: var(--card-bg);
    border: 1px solid var(--border-color);
    border-radius: var(--border-radius-lg);
    box-shadow: var(--shadow-xl);
}

.profile-header {
    text-align: center;
    margin-bottom: var(--spacing-2xl);
}

.profile-avatar {
    width: 120px;
    height: 120px;
    border-radius: 50%;
    margin: 0 auto var(--spacing-lg);
    background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 3rem;
    color: white;
    position: relative;
    overflow: hidden;
}

.profile-name {
    font-size: 2rem;
    font-weight: 700;
    margin-bottom: var(--spacing-sm);
    color: var(--text-primary);
}

.profile-email {
    color: var(--text-secondary);
    margin-bottom: var(--spacing-sm);
}

.profile-role {
    display: inline-block;
    padding: var(--spacing-xs) var(--spacing-md);
    background: var(--primary-color);
    color: white;
    border-radius: var(--border-radius);
    font-size: 0.9rem;
    font-weight: 600;
    text-transform: capitalize;
}

.form-section {
    margin-bottom: var(--spacing-2xl);
    padding: var(--spacing-xl);
    border: 1px solid var(--border-color);
    border-radius: var(--border-radius);
}

.form-section h3 {
    margin-top: 0;
    margin-bottom: var(--spacing-lg);
    padding-bottom: var(--spacing-md);
    border-bottom: 1px solid var(--border-color);
    color: var(--primary-color);
    font-size: 1.3rem;
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

.form-control {
    width: 100%;
    padding: var(--spacing-md);
    background: var(--darker-bg);
    border: 1px solid var(--border-color);
    border-radius: var(--border-radius);
    color: var(--text-primary);
    font-size: 1rem;
    transition: var(--transition);
}

.form-control:focus {
    outline: none;
    border-color: var(--primary-color);
    box-shadow: 0 0 0 3px rgba(255, 107, 53, 0.1);
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

.alert {
    padding: var(--spacing-md);
    border-radius: var(--border-radius);
    margin-bottom: var(--spacing-lg);
    display: flex;
    align-items: center;
    gap: var(--spacing-sm);
}

.alert-success {
    background: rgba(16, 185, 129, 0.1);
    border-left: 4px solid var(--success-color);
    color: var(--success-color);
}

.alert-error {
    background: rgba(239, 68, 68, 0.1);
    border-left: 4px solid var(--danger-color);
    color: var(--danger-color);
}

.error-list {
    margin: 0;
    padding-left: var(--spacing-lg);
}

.error-list li {
    margin-bottom: var(--spacing-xs);
}

.back-link {
    display: inline-flex;
    align-items: center;
    gap: var(--spacing-sm);
    color: var(--text-secondary);
    text-decoration: none;
    margin-bottom: var(--spacing-xl);
    transition: var(--transition);
}

.back-link:hover {
    color: var(--primary-color);
    transform: translateX(-4px);
}

/* Responsive Design */
@media (max-width: 768px) {
    .profile-container {
        margin: var(--spacing-lg) var(--spacing-md);
        padding: var(--spacing-lg);
    }
    
    .profile-name {
        font-size: 1.5rem;
    }
    
    .form-section {
        padding: var(--spacing-lg);
    }
}
</style>

<div class="profile-container">
    <a href="javascript:history.back()" class="back-link">
        <i class="fas fa-arrow-left"></i>
        Back
    </a>

    <div class="profile-header">
        <div class="profile-avatar">
            <i class="fas fa-user"></i>
        </div>
        <h1 class="profile-name"><?php echo htmlspecialchars($user['name']); ?></h1>
        <p class="profile-email"><?php echo htmlspecialchars($user['email']); ?></p>
        <span class="profile-role"><?php echo htmlspecialchars($user['role']); ?></span>
    </div>

    <?php if ($success): ?>
        <div class="alert alert-success">
            <i class="fas fa-check-circle"></i>
            <?php echo $success; ?>
        </div>
    <?php endif; ?>

    <?php if (!empty($errors)): ?>
        <div class="alert alert-error">
            <i class="fas fa-exclamation-circle"></i>
            <div>
                <strong>Please fix the following:</strong>
                <ul class="error-list">
                    <?php foreach ($errors as $error): ?>
                        <li><?php echo $error; ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    <?php endif; ?>

    <form method="POST" action="">
        <div class="form-section">
            <h3>Basic Information</h3>
            
            <div class="form-group">
                <label for="name">Full Name</label>
                <input type="text" id="name" name="name" class="form-control" 
                       value="<?php echo htmlspecialchars($user['name']); ?>" required>
            </div>

            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" class="form-control" 
                       value="<?php echo htmlspecialchars($user['email']); ?>" required>
            </div>

            <div class="form-group">
                <label for="phone">Phone Number</label>
                <input type="tel" id="phone" name="phone" class="form-control" 
                       value="<?php echo htmlspecialchars($user['phone'] ?? ''); ?>">
            </div>

            <div class="form-group">
                <label for="address">Address</label>
                <textarea id="address" name="address" class="form-control" rows="3"><?php echo htmlspecialchars($user['address'] ?? ''); ?></textarea>
            </div>
        </div>

        <div class="form-section">
            <h3>Change Password</h3>
            <p style="color: var(--text-secondary); margin-bottom: var(--spacing-lg);">
                Leave blank if you don't want to change your password
            </p>

            <div class="form-group">
                <label for="current_password">Current Password</label>
                <input type="password" id="current_password" name="current_password" class="form-control">
            </div>

            <div class="form-group">
                <label for="new_password">New Password</label>
                <input type="password" id="new_password" name="new_password" class="form-control" 
                       minlength="6">
            </div>

            <div class="form-group">
                <label for="confirm_password">Confirm New Password</label>
                <input type="password" id="confirm_password" name="confirm_password" class="form-control" 
                       minlength="6">
            </div>
        </div>

        <button type="submit" class="btn btn-primary">
            <i class="fas fa-save"></i>
            Update Profile
        </button>
    </form>
</div>

<?php require_once 'includes/footer.php'; ?>
