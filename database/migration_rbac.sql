-- Migration script to add multi-user author features and RBAC system

-- Create users table
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(150) NOT NULL,
    email VARCHAR(190) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('super_admin', 'admin', 'author') NOT NULL DEFAULT 'author',
    status ENUM('active', 'inactive') NOT NULL DEFAULT 'active',
    profile_photo VARCHAR(255) NULL,
    biography TEXT NULL,
    facebook_link VARCHAR(255) NULL,
    twitter_link VARCHAR(255) NULL,
    linkedin_link VARCHAR(255) NULL,
    last_login DATETIME NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- Add new columns to blogs table
ALTER TABLE blogs ADD COLUMN author_id INT NULL AFTER category_id;
ALTER TABLE blogs ADD COLUMN created_by INT NULL AFTER author;
ALTER TABLE blogs ADD COLUMN updated_by INT NULL AFTER created_by;
ALTER TABLE blogs ADD COLUMN status ENUM('draft', 'pending', 'published', 'rejected', 'archived') NOT NULL DEFAULT 'published' AFTER updated_by;
ALTER TABLE blogs ADD COLUMN featured_image VARCHAR(255) NULL AFTER status;
ALTER TABLE blogs ADD COLUMN seo_title VARCHAR(255) NULL;
ALTER TABLE blogs ADD COLUMN meta_description TEXT NULL;
ALTER TABLE blogs ADD COLUMN meta_keywords VARCHAR(255) NULL;
ALTER TABLE blogs ADD COLUMN canonical_url VARCHAR(255) NULL;
ALTER TABLE blogs ADD COLUMN og_image VARCHAR(255) NULL;

-- Add foreign key constraint for author_id
ALTER TABLE blogs ADD CONSTRAINT fk_blogs_author FOREIGN KEY (author_id) REFERENCES users(id) ON DELETE SET NULL;

-- Create notifications table
CREATE TABLE IF NOT EXISTS notifications (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    title VARCHAR(255) NOT NULL,
    message TEXT NOT NULL,
    is_read TINYINT(1) DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_notifications_user FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- Create audit_logs table
CREATE TABLE IF NOT EXISTS audit_logs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NULL,
    action VARCHAR(100) NOT NULL,
    ip_address VARCHAR(45) NULL,
    user_agent VARCHAR(255) NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_audit_user FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE SET NULL
) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- Seed default users (passwords: kunal, admin123, author123)
INSERT INTO users (name, email, password, role, status) VALUES
('Super Admin', 'admin@example.com', '$2y$12$BwJc5s0iWSDbJ1lsURtNneMY/rvD/qzI9z/2bW.8Ni6FqnNDCLBOq', 'super_admin', 'active'),
('Admin User', 'admin2@example.com', '$2y$12$towI3tY20yoIAh57c9sBYeMqVHL/fXUQZUwLqTupibplBeZxk7ZHS', 'admin', 'active'),
('Author User', 'author@example.com', '$2y$12$cz/xJnk/k5ESjDWW3XumNuEdT2stuVtizHNoDLntuwzajotXarD9C', 'author', 'active');

-- Associate existing blogs with Super Admin (ID 1)
UPDATE blogs SET author_id = 1, status = 'published';
