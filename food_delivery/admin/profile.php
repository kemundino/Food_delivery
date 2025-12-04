<?php
// profile.php
require_once '../includes/auth.php';
require_once '../includes/role_check.php';

// Check if user has admin role
requireRole(['admin']);

// Get user data
$user_id = $_SESSION['user_id'];
$user = [];
$errors = [];

// Fetch user data
$stmt = $conn->prepare("SELECT id, name, email, phone, address, created_at FROM users WHERE id = ?");
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
            } elseif (strlen($new_password) < 8) {
                $errors[] = "New password must be at least 8 characters long";
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
            
            $_SESSION['success_message'] = "Profile updated successfully!";
            header("Location: " . $_SERVER['PHP_SELF']);
            exit();
        } catch (Exception $e) {
            $conn->rollback();
            $errors[] = "An error occurred. Please try again.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile - FoodExpress</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        .profile-container {
            max-width: 800px;
            margin: 2rem auto;
            padding: 2rem;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.05);
        }
        .profile-header {
            text-align: center;
            margin-bottom: 2rem;
        }
        .profile-avatar {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            margin: 0 auto 1rem;
            background: #f0f2f5;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 3rem;
            color: #6c757d;
            position: relative;
            overflow: hidden;
        }
        .profile-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .profile-name {
            font-size: 1.8rem;
            font-weight: 600;
            margin: 0.5rem 0;
            color: #212529;
        }
        .profile-email {
            color: #6c757d;
            margin-bottom: 1.5rem;
        }
        .form-section {
            margin-bottom: 2rem;
            padding: 1.5rem;
            border: 1px solid #e9ecef;
            border-radius: 8px;
        }
        .form-section h3 {
            margin-top: 0;
            margin-bottom: 1.5rem;
            padding-bottom: 0.75rem;
            border-bottom: 1px solid #e9ecef;
            color: #4361ee;
        }
        .form-group {
            margin-bottom: 1.25rem;
        }
        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: #495057;
        }
        .form-control {
            width: 100%;
            padding: 0.6rem 0.75rem;
            font-size: 1rem;
            line-height: 1.5;
            color: #495057;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #ced4da;
            border-radius: 6px;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }
        .form-control:focus {
            border-color: #80bdff;
            outline: 0;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
        }
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0.6rem 1.25rem;
            font-weight: 500;
            line-height: 1.5;
            color: #fff;
            text-align: center;
            text-decoration: none;
            white-space: nowrap;
            vertical-align: middle;
            cursor: pointer;
            user-select: none;
            background-color: #4361ee;
            border: 1px solid transparent;
            border-radius: 6px;
            transition: all 0.2s ease-in-out;
        }
        .btn:hover {
            background-color: #3a56d4;
            transform: translateY(-1px);
        }
        .btn i {
            margin-right: 0.5rem;
        }
        .text-danger {
            color: #dc3545;
        }
        .alert {
            padding: 1rem;
            margin-bottom: 1.5rem;
            border: 1px solid transparent;
            border-radius: 6px;
        }
        .alert-danger {
            color: #721c24;
            background-color: #f8d7da;
            border-color: #f5c6cb;
        }
        .password-toggle {
            position: relative;
        }
        .password-toggle .form-control {
            padding-right: 2.5rem;
        }
        .password-toggle-icon {
            position: absolute;
            top: 50%;
            right: 0.75rem;
            transform: translateY(-50%);
            color: #6c757d;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <?php include 'includes/header.php'; ?>

    <div class="container">
        <div class="profile-container">
            <div class="profile-header">
                <div class="profile-avatar">
                    <i class="fas fa-user"></i>
                </div>
                <h1 class="profile-name"><?php echo htmlspecialchars($user['name']); ?></h1>
                <div class="profile-email"><?php echo htmlspecialchars($user['email']); ?></div>
                <div class="text-muted">Member since <?php echo date('F Y', strtotime($user['created_at'])); ?></div>
            </div>

            <?php if (!empty($errors)): ?>
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        <?php foreach ($errors as $error): ?>
                            <li><?php echo htmlspecialchars($error); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <form method="POST" action="" class="needs-validation" novalidate>
                <div class="form-section">
                    <h3><i class="fas fa-user-circle me-2"></i> Personal Information</h3>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name" class="form-label">Full Name</label>
                                <input type="text" class="form-control" id="name" name="name" 
                                       value="<?php echo htmlspecialchars($user['name']); ?>" required>
                                <div class="invalid-feedback">Please enter your name</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email" class="form-label">Email Address</label>
                                <input type="email" class="form-control" id="email" name="email" 
                                       value="<?php echo htmlspecialchars($user['email']); ?>" required>
                                <div class="invalid-feedback">Please enter a valid email</div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="phone" class="form-label">Phone Number</label>
                                <input type="tel" class="form-control" id="phone" name="phone" 
                                       value="<?php echo htmlspecialchars($user['phone'] ?? ''); ?>">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="address" class="form-label">Address</label>
                                <textarea class="form-control" id="address" name="address" rows="2"><?php echo htmlspecialchars($user['address'] ?? ''); ?></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-section">
                    <h3><i class="fas fa-lock me-2"></i> Change Password</h3>
                    <p class="text-muted">Leave blank to keep current password</p>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group password-toggle">
                                <label for="current_password" class="form-label">Current Password</label>
                                <input type="password" class="form-control" id="current_password" name="current_password">
                                <span class="password-toggle-icon" onclick="togglePassword('current_password')">
                                    <i class="fas fa-eye"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group password-toggle">
                                <label for="new_password" class="form-label">New Password</label>
                                <input type="password" class="form-control" id="new_password" name="new_password">
                                <span class="password-toggle-icon" onclick="togglePassword('new_password')">
                                    <i class="fas fa-eye"></i>
                                </span>
                                <small class="form-text text-muted">At least 8 characters long</small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group password-toggle">
                                <label for="confirm_password" class="form-label">Confirm New Password</label>
                                <input type="password" class="form-control" id="confirm_password" name="confirm_password">
                                <span class="password-toggle-icon" onclick="togglePassword('confirm_password')">
                                    <i class="fas fa-eye"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="text-end">
                    <a href="index.php" class="btn btn-outline-secondary me-2">Cancel</a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i> Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>

    <?php include 'includes/footer.php'; ?>

    <script>
        // Form validation
        (function() {
            'use strict';
            window.addEventListener('load', function() {
                var forms = document.getElementsByClassName('needs-validation');
                var validation = Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();

        // Toggle password visibility
        function togglePassword(inputId) {
            const input = document.getElementById(inputId);
            const icon = document.querySelector(`#${inputId} + .password-toggle-icon i`);
            
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }

        // Initialize phone input mask
        if (document.getElementById('phone')) {
            document.getElementById('phone').addEventListener('input', function(e) {
                var x = e.target.value.replace(/\D/g, '').match(/(\d{0,3})(\d{0,3})(\d{0,4})/);
                e.target.value = !x[2] ? x[1] : '(' + x[1] + ') ' + x[2] + (x[3] ? '-' + x[3] : '');
            });
        }
    </script>
</body>
</html>