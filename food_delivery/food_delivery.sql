-- Create database
CREATE DATABASE IF NOT EXISTS food_delivery;
USE food_delivery;

-- Users table
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    phone VARCHAR(20),
    address TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Admin table
CREATE TABLE IF NOT EXISTS admin (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    full_name VARCHAR(100) NOT NULL,
    last_login TIMESTAMP NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Restaurants table
CREATE TABLE IF NOT EXISTS restaurants (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    description TEXT,
    address TEXT NOT NULL,
    phone VARCHAR(20) NOT NULL,
    email VARCHAR(100),
    logo VARCHAR(255),
    cover_image VARCHAR(255),
    rating DECIMAL(3,2) DEFAULT 0,
    delivery_time VARCHAR(50),
    min_order DECIMAL(10,2) DEFAULT 0,
    delivery_fee DECIMAL(10,2) DEFAULT 0,
    is_active BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Food categories
CREATE TABLE IF NOT EXISTS categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    description TEXT,
    image VARCHAR(255),
    is_active BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Foods table
CREATE TABLE IF NOT EXISTS foods (
    id INT AUTO_INCREMENT PRIMARY KEY,
    restaurant_id INT NOT NULL,
    category_id INT,
    name VARCHAR(100) NOT NULL,
    description TEXT,
    price DECIMAL(10,2) NOT NULL,
    image VARCHAR(255),
    is_vegetarian BOOLEAN DEFAULT FALSE,
    is_vegan BOOLEAN DEFAULT FALSE,
    is_gluten_free BOOLEAN DEFAULT FALSE,
    is_available BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (restaurant_id) REFERENCES restaurants(id) ON DELETE CASCADE,
    FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Orders table
CREATE TABLE IF NOT EXISTS orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    restaurant_id INT NOT NULL,
    order_number VARCHAR(50) NOT NULL UNIQUE,
    total_amount DECIMAL(10,2) NOT NULL,
    delivery_fee DECIMAL(10,2) NOT NULL DEFAULT 0,
    tax_amount DECIMAL(10,2) NOT NULL DEFAULT 0,
    final_amount DECIMAL(10,2) NOT NULL,
    delivery_address TEXT NOT NULL,
    customer_name VARCHAR(100) NOT NULL,
    customer_phone VARCHAR(20) NOT NULL,
    customer_email VARCHAR(100),
    payment_method ENUM('cash_on_delivery', 'credit_card', 'paypal') NOT NULL,
    payment_status ENUM('pending', 'paid', 'failed', 'refunded') DEFAULT 'pending',
    status ENUM('pending', 'confirmed', 'preparing', 'on_the_way', 'delivered', 'cancelled') DEFAULT 'pending',
    notes TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (restaurant_id) REFERENCES restaurants(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Order items table
CREATE TABLE IF NOT EXISTS order_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT NOT NULL,
    food_id INT NOT NULL,
    quantity INT NOT NULL,
    unit_price DECIMAL(10,2) NOT NULL,
    total_price DECIMAL(10,2) NOT NULL,
    special_instructions TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE CASCADE,
    FOREIGN KEY (food_id) REFERENCES foods(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- User addresses
CREATE TABLE IF NOT EXISTS user_addresses (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    address_type ENUM('home', 'work', 'other') NOT NULL,
    address_line1 VARCHAR(255) NOT NULL,
    address_line2 VARCHAR(255),
    city VARCHAR(100) NOT NULL,
    state VARCHAR(100) NOT NULL,
    postal_code VARCHAR(20) NOT NULL,
    country VARCHAR(100) NOT NULL,
    is_default BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Reviews table
CREATE TABLE IF NOT EXISTS reviews (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    restaurant_id INT NOT NULL,
    order_id INT,
    food_id INT,
    rating TINYINT NOT NULL CHECK (rating BETWEEN 1 AND 5),
    comment TEXT,
    is_approved BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (restaurant_id) REFERENCES restaurants(id) ON DELETE CASCADE,
    FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE SET NULL,
    FOREIGN KEY (food_id) REFERENCES foods(id) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS favorites (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    restaurant_id INT,
    food_id INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (restaurant_id) REFERENCES restaurants(id) ON DELETE CASCADE,
    FOREIGN KEY (food_id) REFERENCES foods(id) ON DELETE CASCADE,
    UNIQUE KEY unique_favorite (user_id, restaurant_id, food_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
-- Insert default admin user (password: admin123 - make sure to change this after first login)
INSERT INTO admin (username, password, email, full_name) 
VALUES ('admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin@foodexpress.com', 'Administrator');

-- Insert sample categories
INSERT INTO categories (name, description, is_active) VALUES
('Pizza', 'Delicious pizzas with various toppings', 1),
('Burgers', 'Juicy burgers with fresh ingredients', 1),
('Sushi', 'Fresh and tasty Japanese cuisine', 1),
('Pasta', 'Italian pasta dishes', 1),
('Salads', 'Fresh and healthy salads', 1),
('Desserts', 'Sweet treats to finish your meal', 1);

-- Insert sample restaurant
INSERT INTO restaurants (name, description, address, phone, email, rating, delivery_time, min_order, delivery_fee, is_active) 
VALUES ('Pizza Palace', 'The best pizza in town with fresh ingredients and secret sauce!', '123 Food Street, Cuisine City', '123-456-7890', 'info@pizzapalace.com', 4.5, '30-45 min', 15.00, 2.99, 1);

-- Insert sample foods for the restaurant
INSERT INTO foods (restaurant_id, category_id, name, description, price, is_available) VALUES
(1, 1, 'Margherita Pizza', 'Classic pizza with tomato sauce, mozzarella, and basil', 12.99, 1),
(1, 1, 'Pepperoni Pizza', 'Traditional pizza with tomato sauce, mozzarella, and pepperoni', 14.99, 1),
(1, 2, 'Classic Burger', 'Beef patty with lettuce, tomato, and special sauce', 9.99, 1),
(1, 4, 'Spaghetti Carbonara', 'Pasta with creamy egg sauce, pancetta, and parmesan', 11.99, 1),
(1, 5, 'Caesar Salad', 'Fresh romaine lettuce with Caesar dressing, croutons, and parmesan', 8.99, 1),
(1, 6, 'Tiramisu', 'Classic Italian dessert with coffee-soaked ladyfingers', 6.99, 1);

-- Create indexes for better performance
CREATE INDEX idx_restaurant_name ON restaurants(name);
CREATE INDEX idx_food_name ON foods(name);
CREATE INDEX idx_food_restaurant ON foods(restaurant_id);
CREATE INDEX idx_orders_user ON orders(user_id);
CREATE INDEX idx_orders_restaurant ON orders(restaurant_id);
CREATE INDEX idx_order_items_order ON order_items(order_id);
CREATE INDEX idx_order_items_food ON order_items(food_id);

-- Create a view for popular foods
CREATE VIEW popular_foods AS
SELECT f.*, r.name as restaurant_name, COUNT(oi.id) as order_count
FROM foods f
JOIN restaurants r ON f.restaurant_id = r.id
LEFT JOIN order_items oi ON f.id = oi.food_id
GROUP BY f.id
ORDER BY order_count DESC
LIMIT 10;

-- Create a view for restaurant ratings
CREATE VIEW restaurant_ratings AS
SELECT r.*, 
       AVG(rv.rating) as average_rating,
       COUNT(rv.id) as review_count
FROM restaurants r
LEFT JOIN reviews rv ON r.id = rv.restaurant_id
GROUP BY r.id;

-- Create a stored procedure to place an order
DELIMITER //
CREATE PROCEDURE place_order(
    IN p_user_id INT,
    IN p_restaurant_id INT,
    IN p_delivery_address TEXT,
    IN p_customer_name VARCHAR(100),
    IN p_customer_phone VARCHAR(20),
    IN p_customer_email VARCHAR(100),
    IN p_payment_method VARCHAR(20),
    IN p_notes TEXT
)
BEGIN
    DECLARE v_order_id INT;
    DECLARE v_order_number VARCHAR(50);
    DECLARE v_total_amount DECIMAL(10,2) DEFAULT 0;
    DECLARE v_tax_rate DECIMAL(5,2) DEFAULT 0.08; -- 8% tax
    DECLARE v_tax_amount DECIMAL(10,2);
    DECLARE v_delivery_fee DECIMAL(10,2);
    DECLARE v_final_amount DECIMAL(10,2);
    
    -- Get delivery fee from restaurant
    SELECT delivery_fee INTO v_delivery_fee 
    FROM restaurants 
    WHERE id = p_restaurant_id;
    
    -- Generate order number (example: ORD-YYYYMMDD-XXXXX)
    SET v_order_number = CONCAT('ORD-', DATE_FORMAT(NOW(), '%Y%m%d-'), LPAD(FLOOR(RAND() * 100000), 5, '0'));
    
    -- Create order record
    INSERT INTO orders (
        user_id, 
        restaurant_id, 
        order_number,
        delivery_address,
        customer_name,
        customer_phone,
        customer_email,
        payment_method,
        notes,
        status,
        payment_status,
        delivery_fee,
        created_at,
        updated_at
    ) VALUES (
        p_user_id,
        p_restaurant_id,
        v_order_number,
        p_delivery_address,
        p_customer_name,
        p_customer_phone,
        p_customer_email,
        p_payment_method,
        p_notes,
        'pending',
        'pending',
        v_delivery_fee,
        NOW(),
        NOW()
    );
    
    -- Get the order ID
    SET v_order_id = LAST_INSERT_ID();
    
    -- Update order number with ID for better uniqueness
    UPDATE orders 
    SET order_number = CONCAT('ORD-', DATE_FORMAT(NOW(), '%Y%m%d-'), LPAD(v_order_id, 5, '0'))
    WHERE id = v_order_id;
    
    -- Here you would typically add order items from the cart
    -- For example: INSERT INTO order_items (order_id, food_id, quantity, unit_price, total_price)
    -- SELECT v_order_id, food_id, quantity, price, (quantity * price)
    -- FROM cart_items WHERE user_id = p_user_id;
    
    -- Calculate total amount (this would be the sum of all order items)
    -- For this example, we'll set a default value
    SET v_total_amount = 0; -- This would be calculated from order items
    SET v_tax_amount = v_total_amount * v_tax_rate;
    SET v_final_amount = v_total_amount + v_tax_amount + v_delivery_fee;
    
    -- Update order with calculated amounts
    UPDATE orders
    SET 
        total_amount = v_total_amount,
        tax_amount = v_tax_amount,
        final_amount = v_final_amount
    WHERE id = v_order_id;
    
    -- Here you would typically clear the user's cart
    -- DELETE FROM cart_items WHERE user_id = p_user_id;
    
    -- Return the order ID and number
    SELECT v_order_id as order_id, v_order_number as order_number;
END //
DELIMITER ;