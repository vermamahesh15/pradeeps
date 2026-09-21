<?php

declare(strict_types=1);

// Force Full Error Display & Shutdown Error Capture for Live Server Debugging
// error_reporting(E_ALL);
// ini_set('display_errors', '1');
// ini_set('display_startup_errors', '1');

set_exception_handler(function (Throwable $e) {
    if (!headers_sent()) {
        header('HTTP/1.1 200 OK');
    }
    echo "<div style='font-family:sans-serif; padding:20px; background:#fef2f2; border:2px solid #ef4444; color:#991b1b; border-radius:12px; margin:20px; z-index:999999; position:relative;'>";
    echo "<h2 style='margin-top:0;'>⚠️ Server Uncaught Exception</h2>";
    echo "<p><strong>Message:</strong> " . htmlspecialchars($e->getMessage()) . "</p>";
    echo "<p><strong>File:</strong> " . htmlspecialchars($e->getFile()) . " (Line " . $e->getLine() . ")</p>";
    echo "<pre style='background:#fff; padding:10px; border-radius:6px; overflow:auto; max-height:300px; font-size:13px; color:#333;'>" . htmlspecialchars($e->getTraceAsString()) . "</pre>";
    echo "</div>";
    exit;
});

register_shutdown_function(function () {
    $error = error_get_last();
    if ($error && in_array($error['type'], [E_ERROR, E_PARSE, E_CORE_ERROR, E_COMPILE_ERROR], true)) {
        if (!headers_sent()) {
            header('HTTP/1.1 200 OK');
        }
        echo "<div style='font-family:sans-serif; padding:20px; background:#fef2f2; border:2px solid #ef4444; color:#991b1b; border-radius:12px; margin:20px; z-index:999999; position:relative;'>";
        echo "<h2 style='margin-top:0;'>⚠️ Server PHP Fatal Error</h2>";
        echo "<p><strong>Message:</strong> " . htmlspecialchars($error['message']) . "</p>";
        echo "<p><strong>File:</strong> " . htmlspecialchars($error['file']) . " (Line " . $error['line'] . ")</p>";
        echo "</div>";
    }
});

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

if ($path === '/sitemap.xml') {
    header('Content-Type: application/xml; charset=utf-8');
    if (file_exists(__DIR__ . '/sitemap.xml')) {
        echo file_get_contents(__DIR__ . '/sitemap.xml');
    } else {
        echo '<?xml version="1.0" encoding="UTF-8"?><urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"><url><loc>' . htmlspecialchars(base_url('/')) . '</loc></url></urlset>';
    }
    return;
}

if ($path === '/') {
    $controller->home();
    return;
}

// Intercept legacy/obsolete shop, product and cart URLs (permanently removed - HTTP 410 Gone)
if (preg_match('#^/(amp/)?(shop|products|product|cart|checkout)(/.*)?$#i', $path) || preg_match('#^/(shop|products|product|cart|checkout)(/.*)?/amp$#i', $path)) {
    http_response_code(410);
    header('X-Robots-Tag: noindex, nofollow');
    $controller->render('404', [
        'title' => 'Page Permanently Removed'
    ]);
    return;
}

if ($path === '/api/cities') {
    $rawStateId = $_GET['state_id'] ?? ($_GET['state'] ?? 0);
    $stateId = is_numeric($rawStateId) ? (int)$rawStateId : trim((string)$rawStateId);
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
    $controller->ampPage($rawSlug);
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
