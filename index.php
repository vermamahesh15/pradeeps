<?php

declare(strict_types=1);

require_once __DIR__ . '/includes/helpers.php';
require_once __DIR__ . '/includes/bootstrap.php';
require_once __DIR__ . '/controllers/BlogController.php';

// Normalize the path: remove project subdirectory and trailing slashes
$path = current_path();
$path = preg_replace('#^/pradeep#i', '', $path);
$path = rtrim($path, '/') ?: '/';

$blogController = new BlogController(new Blog(), new BlogCategory());
$method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
$override = strtoupper($_POST['_method'] ?? '') ?: $method;

if ($path === '/') {
    $controller->home();
    return;
}

if ($path === '/api/cities') {
    $stateId = (int)($_GET['state_id'] ?? 0);
    $cities = $contentModel->getCitiesByState($stateId);
    json_response(['status' => 'success', 'data' => $cities]);
    return;
}

if ($path === '/blogs') {
    if ($override === 'GET') {
        $blogController->list($_GET);
        return;
    }
    if ($override === 'POST') {
        $blogController->create();
        return;
    }
    json_response(['status' => 'error', 'message' => 'Method not allowed.'], 405);
}

if (preg_match('#^/blogs/(\d+)$#', $path, $matches)) {
    $id = (int) $matches[1];
    if ($override === 'PUT' || $override === 'PATCH') {
        $blogController->update($id);
        return;
    }
    if ($override === 'DELETE') {
        $blogController->delete($id);
        return;
    }
    json_response(['status' => 'error', 'message' => 'Method not allowed.'], 405);
}

if (preg_match('#^/blogs/([^/]+)$#', $path, $matches)) {
    if ($override === 'GET') {
        $blogController->showBySlug($matches[1]);
        return;
    }
    json_response(['status' => 'error', 'message' => 'Method not allowed.'], 405);
}

if ($path === '/categories') {
    if ($override === 'GET') {
        $blogController->listCategories();
        return;
    }
    if ($override === 'POST') {
        $blogController->createCategory();
        return;
    }
    json_response(['status' => 'error', 'message' => 'Method not allowed.'], 405);
}

if (preg_match('#^/categories/(\d+)$#', $path, $matches)) {
    $id = (int) $matches[1];
    if ($override === 'PUT' || $override === 'PATCH') {
        $blogController->updateCategory($id);
        return;
    }
    if ($override === 'DELETE') {
        $blogController->deleteCategory($id);
        return;
    }
    json_response(['status' => 'error', 'message' => 'Method not allowed.'], 405);
}

// AMP Route Handling
if ($path === '/amp' || $path === '/amp/') {
    $controller->renderAmp('amp-home', [
        'title' => 'Home',
        'canonicalUrl' => base_url('/'),
        'blogs' => (new Blog())->allPublished(6),
        'campaigns' => $contentModel->all('campaigns'),
    ]);
    return;
}

if (preg_match('#^/blog/([^/]+)/amp$#', $path, $matches) || preg_match('#^/amp/blog/([^/]+)$#', $path, $matches)) {
    $controller->ampBlogDetail($matches[1]);
    return;
}

if (preg_match('#^/amp/(.+)$#', $path, $matches) || preg_match('#^(.+)/amp$#', $path, $matches)) {
    $rawSlug = '/' . ltrim($matches[1], '/');
    $canonical = base_url($rawSlug);
    $controller->renderAmp('amp-page', [
        'title' => ucwords(trim($rawSlug, '/')),
        'canonicalUrl' => $canonical,
    ]);
    return;
}

if (preg_match('#^/blog/([^/]+)$#', $path, $matches)) {
    $controller->blogDetail($matches[1]);
    return;
}

if (preg_match('#^/campaigns/([^/]+)$#', $path, $matches)) {
    $controller->campaignDetail($matches[1]);
    return;
}

if (preg_match('#^/events/([^/]+)$#', $path, $matches)) {
    $controller->eventDetail($matches[1]);
    return;
}

$controller->page($path);
