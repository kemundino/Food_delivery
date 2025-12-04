-- Add role column to users table
ALTER TABLE users ADD COLUMN role ENUM('customer', 'vendor', 'admin') NOT NULL DEFAULT 'customer' AFTER password;

-- Update existing users to have customer role (except those with is_admin = 1)
UPDATE users SET role = 'admin' WHERE is_admin = 1;
UPDATE users SET role = 'customer' WHERE is_admin = 0 AND role = 'customer';

-- Optional: Remove the is_admin column after migration (commented for safety)
-- ALTER TABLE users DROP COLUMN is_admin;
