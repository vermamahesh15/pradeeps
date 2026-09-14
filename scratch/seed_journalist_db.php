<?php
declare(strict_types=1);

require_once __DIR__ . '/../includes/helpers.php';
require_once __DIR__ . '/../models/Blog.php';

$blogModel = new Blog();
$db = $blogModel->getConnection();

if (!$db) {
    echo "No DB connection available.\n";
    exit;
}

$slug = 'how-to-become-a-journalist-key-things-you-should-know';
$title = 'पत्रकार कैसे बनें: मुख्य बातें जो आपको जाननी चाहिए';
$category_id = 1; // Default category
$excerpt = 'पत्रकारिता लोकतंत्र का चौथा स्तंभ है। यदि आप एक सफल, निष्पक्ष और प्रभावकारी पत्रकार बनना चाहते हैं, तो इन महत्वपूर्ण बातों, शैक्षणिक योग्यता और नैतिक सिद्धांतों को जानना आपके लिए अत्यंत आवश्यक है।';

// Check if category exists or create one
$stmtCat = $db->query("SELECT id FROM blog_categories WHERE name LIKE '%पत्रकारिता%' OR name LIKE '%मीडिया%' LIMIT 1");
$catRow = $stmtCat->fetch();
if ($catRow) {
    $category_id = (int)$catRow['id'];
} else {
    $stmtInsCat = $db->prepare("INSERT INTO blog_categories (name, slug) VALUES ('पत्रकारिता एवं मीडिया', 'journalism-media')");
    $stmtInsCat->execute();
    $category_id = (int)$db->lastInsertId();
}

$stmtCheck = $db->prepare("SELECT id FROM blogs WHERE slug = :slug");
$stmtCheck->execute([':slug' => $slug]);
$existing = $stmtCheck->fetch();

if ($existing) {
    $stmtUpd = $db->prepare("UPDATE blogs SET title = :title, category_id = :category_id, excerpt = :excerpt, status = 'published', published_at = NOW() WHERE id = :id");
    $stmtUpd->execute([
        ':title' => $title,
        ':category_id' => $category_id,
        ':excerpt' => $excerpt,
        ':id' => $existing['id']
    ]);
    echo "Updated existing blog ID " . $existing['id'] . "\n";
} else {
    $stmtIns = $db->prepare("INSERT INTO blogs (title, slug, category_id, author_id, excerpt, content, featured_image, status, published_at, created_at) VALUES (:title, :slug, :category_id, 1, :excerpt, '', 'assets/images/slider_final_1.webp', 'published', NOW(), NOW())");
    $stmtIns->execute([
        ':title' => $title,
        ':slug' => $slug,
        ':category_id' => $category_id,
        ':excerpt' => $excerpt
    ]);
    echo "Inserted new blog ID " . $db->lastInsertId() . "\n";
}
