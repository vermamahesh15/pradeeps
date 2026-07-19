CREATE TABLE IF NOT EXISTS donation_settings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    org_name VARCHAR(255),
    account_name VARCHAR(255),
    bank_name VARCHAR(255),
    account_number VARCHAR(100),
    ifsc VARCHAR(50),
    upi_id VARCHAR(100),
    qr_code VARCHAR(255),
    phone VARCHAR(50),
    email VARCHAR(100),
    thank_you_msg TEXT
);

CREATE TABLE IF NOT EXISTS donations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    receipt_no VARCHAR(50) UNIQUE,
    full_name VARCHAR(255) NOT NULL,
    mobile VARCHAR(20) NOT NULL,
    email VARCHAR(100),
    city VARCHAR(100),
    state VARCHAR(100),
    country VARCHAR(100),
    address TEXT,
    pan_number VARCHAR(20),
    amount DECIMAL(15, 2) NOT NULL,
    payment_method ENUM('UPI', 'Bank Transfer', 'Cash', 'Card', 'Other'),
    transaction_id VARCHAR(100),
    purpose VARCHAR(255),
    message TEXT,
    screenshot VARCHAR(255),
    status ENUM('pending', 'verified', 'rejected') DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Default Settings
INSERT INTO donation_settings (org_name, account_name, bank_name, account_number, ifsc, upi_id, thank_you_msg)
VALUES ('Pradeep Sarang Foundation', 'Pradeep Sarang Foundation Trust', 'State Bank of India', '1234567890', 'SBIN0001234', 'sahyog@upi', 'Thank you for your generous contribution!');

-- Admin User for this module
CREATE TABLE IF NOT EXISTS donation_admins (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) UNIQUE,
    password VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Default Admin (password: admin123)
INSERT INTO donation_admins (username, password) 
VALUES ('admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi');