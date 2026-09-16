-- Migration: Create about_personal_photos table for Personal Photographs of Pradeep Sarang
-- Date: 2026-09-16

CREATE TABLE IF NOT EXISTS `about_personal_photos` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `title` VARCHAR(190) NULL,
    `caption` TEXT NULL,
    `photo_path` VARCHAR(255) NOT NULL,
    `thumbnail_path` VARCHAR(255) NULL,
    `alt_text` VARCHAR(255) NULL,
    `location` VARCHAR(190) NULL,
    `photo_date` DATE NULL,
    `photo_year` VARCHAR(20) NULL,
    `display_order` INT NOT NULL DEFAULT 0,
    `status` ENUM('published', 'hidden') NOT NULL DEFAULT 'published',
    `uploaded_by` INT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX `idx_status_order` (`status`, `display_order` ASC),
    INDEX `idx_uploaded_by` (`uploaded_by`),
    INDEX `idx_photo_year` (`photo_year`),
    CONSTRAINT `fk_about_photos_user` FOREIGN KEY (`uploaded_by`) REFERENCES `users`(`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
