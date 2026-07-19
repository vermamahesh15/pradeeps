CREATE DATABASE IF NOT EXISTS sahyog_foundation CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE sahyog_foundation;

CREATE TABLE admins (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(120) NOT NULL,
    email VARCHAR(190) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE pages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    slug VARCHAR(190) NOT NULL UNIQUE,
    title VARCHAR(190) NOT NULL,
    content LONGTEXT NULL,
    meta_title VARCHAR(190) NULL,
    meta_description TEXT NULL,
    language_code VARCHAR(5) DEFAULT 'en',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE settings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    setting_key VARCHAR(190) NOT NULL UNIQUE,
    setting_value LONGTEXT NULL
);

CREATE TABLE blog_categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(120) NOT NULL,
    slug VARCHAR(150) NOT NULL UNIQUE
);

CREATE TABLE blogs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    category_id INT NULL,
    title VARCHAR(190) NOT NULL,
    slug VARCHAR(190) NOT NULL UNIQUE,
    excerpt TEXT NULL,
    content LONGTEXT NULL,
    banner_image VARCHAR(255) NULL,
    author VARCHAR(120) NULL,
    published_at DATETIME NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT fk_blogs_category FOREIGN KEY (category_id) REFERENCES blog_categories(id) ON DELETE SET NULL
);

CREATE TABLE blog_comments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    blog_id INT NOT NULL,
    name VARCHAR(120) NOT NULL,
    email VARCHAR(190) NOT NULL,
    comment TEXT NOT NULL,
    status ENUM('pending', 'approved') DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_comments_blog FOREIGN KEY (blog_id) REFERENCES blogs(id) ON DELETE CASCADE
);

CREATE TABLE campaigns (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(190) NOT NULL,
    slug VARCHAR(190) NOT NULL UNIQUE,
    excerpt TEXT NULL,
    content LONGTEXT NULL,
    goal_amount DECIMAL(12,2) DEFAULT 0,
    raised_amount DECIMAL(12,2) DEFAULT 0,
    image VARCHAR(255) NULL,
    status ENUM('active', 'closed') DEFAULT 'active',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE events (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(190) NOT NULL,
    slug VARCHAR(190) NOT NULL UNIQUE,
    excerpt TEXT NULL,
    content LONGTEXT NULL,
    event_date DATE NOT NULL,
    location VARCHAR(190) NULL,
    image VARCHAR(255) NULL,
    status ENUM('upcoming', 'past') DEFAULT 'upcoming',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE portfolio (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(190) NOT NULL,
    slug VARCHAR(190) NULL,
    category VARCHAR(120) NULL,
    description TEXT NULL,
    image VARCHAR(255) NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE volunteers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(150) NOT NULL,
    volunteer_id VARCHAR(50) UNIQUE NULL,
    father_name VARCHAR(150) NULL,
    email VARCHAR(190) NOT NULL,
    gender ENUM('Male', 'Female', 'Other') DEFAULT 'Male',
    dob DATE NULL,
    phone VARCHAR(50) NULL,
    state VARCHAR(100) NULL,
    district VARCHAR(100) NULL,
    pincode VARCHAR(10) NULL,
    occupation VARCHAR(150) NULL,
    photo VARCHAR(255) NULL,
    skills VARCHAR(255) NULL,
    interests VARCHAR(255) NULL,
    availability VARCHAR(100) NULL,
    resume VARCHAR(255) NULL,
    message TEXT NULL,
    status ENUM('Active', 'Inactive', 'Pending') DEFAULT 'Pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE contacts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(150) NOT NULL,
    email VARCHAR(190) NOT NULL,
    phone VARCHAR(50) NULL,
    subject VARCHAR(190) NULL,
    message TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE subscribers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(190) NOT NULL UNIQUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE testimonials (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(120) NOT NULL,
    role VARCHAR(120) NULL,
    quote TEXT NOT NULL,
    image VARCHAR(255) NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE sliders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(190) NOT NULL,
    subtitle TEXT NULL,
    image VARCHAR(255) NULL,
    cta_text VARCHAR(120) NULL,
    cta_link VARCHAR(255) NULL
);

CREATE TABLE menus (
    id INT AUTO_INCREMENT PRIMARY KEY,
    label VARCHAR(120) NOT NULL,
    url VARCHAR(255) NOT NULL,
    sort_order INT DEFAULT 0,
    language_code VARCHAR(5) DEFAULT 'en'
);

CREATE TABLE translations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    translation_key VARCHAR(190) NOT NULL,
    en_text TEXT NULL,
    hi_text TEXT NULL,
    UNIQUE KEY unique_translation_key (translation_key)
);

CREATE TABLE timeline (
    id INT AUTO_INCREMENT PRIMARY KEY,
    year VARCHAR(20) NOT NULL,
    title VARCHAR(190) NOT NULL,
    description TEXT NULL,
    sort_order INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE tab_state (
    state_id INT AUTO_INCREMENT PRIMARY KEY,
    state_name VARCHAR(100) NOT NULL
);

CREATE TABLE tab_city (
    city_id INT AUTO_INCREMENT PRIMARY KEY,
    state_id INT NOT NULL,
    city_name VARCHAR(100) NOT NULL,
    CONSTRAINT fk_city_state FOREIGN KEY (state_id) REFERENCES tab_state(state_id) ON DELETE CASCADE
);

CREATE TABLE gallery (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(190) NULL,
    image VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE newspaper_cuttings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(190) NULL,
    image VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO admins (name, email, password) VALUES
('Administrator', 'admin@example.com', '$2y$10$dMm.vS7rWauBL1W8sFDtB.wSdPKLiHcsAHNycyCXOETw6Nxl/on/C');

INSERT INTO blog_categories (name, slug) VALUES
('Geet', 'गीत'),
('Story', 'अवधी किहानी'),
('Memories', 'संस्मरण/वर्णन');

INSERT INTO blogs (category_id, title, slug, excerpt, content, banner_image, author, published_at) VALUES
(1, 'How volunteer-led programs reshape local trust', 'how-volunteer-led-programs-reshape-local-trust', 'Lorem ipsum dolor sit amet.', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>', 'https://picsum.photos/seed/blog-one/1200/800', 'Admin', '2026-04-14 10:00:00'),
(2, 'Field notes from our nutrition campaign', 'field-notes-from-our-nutrition-campaign', 'Sed ut perspiciatis unde omnis iste.', '<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem.</p>', 'https://picsum.photos/seed/blog-two/1200/800', 'Admin', '2026-04-02 10:00:00');

INSERT INTO campaigns (title, slug, excerpt,  image) VALUES
('Digital Learning Kits', 'digital-learning-kits', 'Providing tablets and learning kits.', 'https://picsum.photos/seed/cause-one/900/700'),
('Nutrition For Every Child', 'nutrition-for-every-child', 'Nutrition and regular health checkups.', 'https://picsum.photos/seed/cause-two/900/700');

INSERT INTO events (title, slug, excerpt, event_date, location, image, status) VALUES
('Youth Leadership Summit', 'youth-leadership-summit', 'A summit on civic leadership.', '2026-05-11', 'Delhi', 'https://picsum.photos/seed/event-one/900/700', 'upcoming'),
('Community Health Camp', 'community-health-camp', 'Medical screening and consultations.', '2026-04-05', 'Lucknow', 'https://picsum.photos/seed/event-two/900/700', 'past');

INSERT INTO portfolio (title, slug, category, description, image) VALUES
('School Renovation', 'school-renovation', 'Infrastructure', 'Project details here.', 'https://picsum.photos/seed/portfolio-one/900/700'),
('Women Skill Labs', 'women-skill-labs', 'Training', 'Project details here.', 'https://picsum.photos/seed/portfolio-two/900/700');

INSERT INTO testimonials (name, role, quote, image) VALUES
('Neha Sharma', 'Volunteer', 'The platform feels professional and the programs feel human.', 'https://picsum.photos/seed/testimonial-one/300/300'),
('Arjun Mehta', 'Donor Partner', 'Clear reporting and strong storytelling.', 'https://picsum.photos/seed/testimonial-two/300/300');

INSERT INTO sliders (title, subtitle, image, cta_text, cta_link) VALUES
('Together We Build Stronger Communities', 'Portfolio, causes, events, and stories in one modern multilingual platform.', 'https://picsum.photos/seed/hero-one/1600/900', 'Join as Volunteer', '/volunteer'),
('From Grassroots Action To Measurable Impact', 'Run campaigns, publish updates, and manage volunteers through a clean CMS.', 'https://picsum.photos/seed/hero-two/1600/900', 'Explore Causes', '/causes');

INSERT INTO menus (label, url, sort_order, language_code) VALUES
('Home', '/', 1, 'en'),
('About', '/about', 2, 'en'),
('होम', '/', 1, 'hi'),
('हमारे बारे में', '/about', 2, 'hi');

INSERT INTO translations (translation_key, en_text, hi_text) VALUES
('home', 'Home', 'होम'),
('contact', 'Contact', 'संपर्क'),
('volunteer', 'Volunteer', 'स्वयंसेवक');

INSERT INTO timeline (year, title, description, sort_order) VALUES
('2020', 'Foundation Start', 'Pradeep Sarang Foundation was established to serve the community.', 1),
('2022', 'First Major Project', 'Completed renovation of 5 local schools.', 2),
('2024', 'Expansion', 'Expanded operations to 18 cities.', 3);
