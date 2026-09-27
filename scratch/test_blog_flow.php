<?php

require_once '/var/www/html/pradeep/includes/helpers.php';
require_once '/var/www/html/pradeep/models/Blog.php';
require_once '/var/www/html/pradeep/models/BlogCategory.php';
require_once '/var/www/html/pradeep/models/UserModel.php';

session_start();
$_SESSION['user_id'] = 1;
$_SESSION['user_name'] = 'Test Author';
$_SESSION['user_role'] = 'author';

$blogModel = new Blog();
$categoryModel = new BlogCategory();

echo "--- 1. Testing Category Model ---\n";
$categories = $categoryModel->all();
echo "Categories count: " . count($categories) . "\n";
$firstCatId = $categories[0]['id'] ?? 1;
echo "First Category ID: " . $firstCatId . "\n\n";

echo "--- 2. Testing Article Creation (Pending Approval) ---\n";
$testSlug = 'test-article-' . time();
$blogData = [
    'title' => 'परीक्षण आलेख - ' . date('Y-m-d H:i:s'),
    'en_title' => 'Test Article ' . time(),
    'category_id' => $firstCatId,
    'slug' => $testSlug,
    'excerpt' => 'यह एक परीक्षण आलेख का सारांश है।',
    'content' => '<p>यह परीक्षण आलेख की पूर्ण सामग्री है।</p>',
    'author' => 'Test Author',
    'author_id' => 1,
    'status' => 'pending',
    'banner_image' => '',
    'featured_image' => '',
    'og_image' => '',
    'seo_title' => 'Test Article | Pradeep Sarang',
    'meta_description' => 'Test Meta Description',
    'meta_keywords' => 'test, article',
    'canonical_url' => 'http://localhost/pradeep/blog/' . $testSlug,
    'published_at' => null,
    'created_by' => 1,
    'updated_by' => 1,
];

try {
    $newId = $blogModel->create($blogData);
    echo "SUCCESS: Created new blog post with ID: " . $newId . "\n";
} catch (Throwable $e) {
    echo "ERROR in Blog::create: " . $e->getMessage() . "\n";
    exit(1);
}

echo "\n--- 3. Testing Article Fetching by ID & Slug ---\n";
$fetchKey = $newId > 0 ? $newId : $testSlug;
$fetchedBlog = $blogModel->find($fetchKey);
if ($fetchedBlog) {
    echo "SUCCESS: Fetched blog article: " . $fetchedBlog['title'] . " (Status: " . $fetchedBlog['status'] . ")\n";
} else {
    echo "ERROR: Could not fetch blog with key: " . $fetchKey . "\n";
    exit(1);
}

echo "\n--- 4. Testing Article Update / Publish by Admin ---\n";
$_SESSION['user_role'] = 'admin';
$fetchedBlog['title'] .= ' (Updated & Published)';
$fetchedBlog['status'] = 'published';
$fetchedBlog['published_at'] = date('Y-m-d H:i:s');

try {
    $updateSuccess = $blogModel->update($fetchKey, $fetchedBlog);
    echo "SUCCESS: Updated blog status to published. Result: " . ($updateSuccess ? "true" : "false") . "\n";
} catch (Throwable $e) {
    echo "ERROR in Blog::update: " . $e->getMessage() . "\n";
    exit(1);
}

echo "\n--- 5. Verifying Updated Record ---\n";
$updatedRecord = $blogModel->find($fetchKey);
if ($updatedRecord && $updatedRecord['status'] === 'published') {
    echo "ALL TESTS PASSED! Status: " . $updatedRecord['status'] . ", Title: " . $updatedRecord['title'] . "\n";
} else {
    echo "ERROR: Update verification failed.\n";
}
