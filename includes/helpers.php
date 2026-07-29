<?php

declare(strict_types=1);

function app_config(?string $key = null, $default = null)
{
    static $config;
    $config ??= require __DIR__ . '/../config/app.php';

    if ($key === null) {
        return $config;
    }

    return $config[$key] ?? $default;
}

function db_config(): array
{
    static $config;
    $config ??= require __DIR__ . '/../config/database.php';

    return $config;
}

function e(?string $value): string
{
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}

function current_lang(): string
{
    if (isset($_GET['lang']) && in_array($_GET['lang'], app_config('supported_langs', []), true)) {
        $_SESSION['lang'] = $_GET['lang'];
    }

    return $_SESSION['lang'] ?? app_config('default_lang', 'en');
}

function lang(string $key, ?string $lang = null): string
{
    static $cache = [];
    $lang ??= current_lang();

    if (!isset($cache[$lang])) {
        $path = __DIR__ . '/../lang/' . $lang . '.php';
        $cache[$lang] = file_exists($path) ? require $path : [];
    }

    return $cache[$lang][$key] ?? ucwords(str_replace(['_', '.'], ' ', $key));
}

function base_url(string $path = ''): string
{
    $configured = app_config('base_url');
    $httpHost = $_SERVER['HTTP_HOST'] ?? '';
    $isLocal = (strpos($httpHost, 'localhost') !== false || strpos($httpHost, '127.0.0.1') !== false);

    if ($isLocal || $configured === null || $configured === '') {
        $script = str_replace('\\', '/', $_SERVER['SCRIPT_NAME'] ?? '');
        $root = rtrim(dirname($script), '/');
        if (substr($root, -6) === '/admin') {
            $root = substr($root, 0, -6);
        }
        if ($root === '/' || $root === '.') {
            $root = '';
        }
        if ($httpHost) {
            $scheme = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') ? 'https' : 'http';
            $root = $scheme . '://' . $httpHost . $root;
        }
    } else {
        $root = rtrim((string) $configured, '/');
    }

    $path = ltrim($path, '/');
    return $root . ($path !== '' ? '/' . $path : '');
}

function current_path(): string
{
    $uri = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/';
    $configured = app_config('base_url');
    if ($configured === null || $configured === '') {
        $base = rtrim(base_url(), '/');
    } else {
        $base = rtrim((string) $configured, '/');
    }

    if ($base !== '' && strpos($uri, $base) === 0) {
        $uri = substr($uri, strlen($base)) ?: '/';
    }

    return trim($uri, '/') === '' ? '/' : rtrim($uri, '/');
}

function is_post(): bool
{
    return strtoupper($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST';
}

function csrf_token(): string
{
    if (empty($_SESSION['_csrf'])) {
        $_SESSION['_csrf'] = bin2hex(random_bytes(32));
    }

    return $_SESSION['_csrf'];
}

function csrf_field(): string
{
    return '<input type="hidden" name="_csrf" value="' . e(csrf_token()) . '">';
}

function verify_csrf(): void
{
    if (!is_post()) {
        return;
    }

    $token = $_POST['_csrf'] ?? '';
    if (!hash_equals($_SESSION['_csrf'] ?? '', $token)) {
        http_response_code(419);
        exit('Invalid CSRF token.');
    }
}

function flash(string $key, ?string $message = null): ?string
{
    if ($message !== null) {
        $_SESSION['_flash'][$key] = $message;
        return null;
    }

    $value = $_SESSION['_flash'][$key] ?? null;
    unset($_SESSION['_flash'][$key]);
    return $value;
}

function redirect(string $path): never
{
    header('Location: ' . base_url($path));
    exit;
}

function asset(string $path): string
{
    return base_url('assets/' . ltrim($path, '/'));
}

function is_active(string $path): string
{
    return current_path() === $path ? 'active' : '';
}

function format_date(string $date): string
{
    return date('d M Y', strtotime($date));
}

function json_response($data, int $status = 200): never
{
    http_response_code($status);
    header('Content-Type: application/json; charset=UTF-8');
    echo json_encode($data, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
    exit;
}

function request_payload(): array
{
    $contentType = $_SERVER['CONTENT_TYPE'] ?? '';
    if (str_contains($contentType, 'application/json')) {
        $data = json_decode(file_get_contents('php://input'), true);
        return is_array($data) ? $data : [];
    }

    return $_POST;
}

function setting(string $key, $default = null)
{
    static $settings = null;
    if ($settings === null) {
        $settings = (new ContentModel())->getSettings();
    }
    return $settings[$key] ?? $default;
}

/**
 * Centralized file upload handler
 */
function upload_file(array $file, string &$error = '', string $subfolder = ''): ?string
{
    if ($file['error'] !== UPLOAD_ERR_OK) {
        $error = 'File upload error code: ' . $file['error'];
        return null;
    }

    // File size validation (5MB max)
    $maxSize = 5 * 1024 * 1024;
    if ($file['size'] > $maxSize) {
        $error = 'File is too large. Maximum size is 5MB.';
        return null;
    }

    // File extension validation
    $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp', 'pdf', 'svg'];
    $extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    if (!in_array($extension, $allowedExtensions, true)) {
        $error = 'Invalid file type. Allowed types: ' . implode(', ', $allowedExtensions);
        return null;
    }

    $baseDir = app_config('uploads_dir');
    $relativeDir = 'uploads' . ($subfolder ? '/' . trim($subfolder, '/') : '');
    $absoluteDir = rtrim($baseDir, '/\\') . ($subfolder ? DIRECTORY_SEPARATOR . trim($subfolder, '/\\') : '');

    if (!is_dir($absoluteDir)) {
        if (!@mkdir($absoluteDir, 0775, true)) {
            $error = 'Could not create directory: ' . $absoluteDir;
            return null;
        }
    }

    if (!is_writable($absoluteDir)) {
        $error = 'The directory is not writable: ' . $absoluteDir;
        return null;
    }

    // Clean unique filename
    $fileName = uniqid() . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '', basename($file['name']));
    $targetFile = $absoluteDir . DIRECTORY_SEPARATOR . $fileName;

    if (move_uploaded_file($file['tmp_name'], $targetFile)) {
        return $relativeDir . '/' . $fileName;
    }

    return null;
}

function get_logged_in_user(): ?array
{
    static $userModel;
    if (!isset($_SESSION['user_id'])) {
        return null;
    }
    if ($userModel === null) {
        require_once __DIR__ . '/../models/UserModel.php';
        $userModel = new UserModel();
    }
    return $userModel->find((int)$_SESSION['user_id']);
}

function is_role(string ...$roles): bool
{
    $user = get_logged_in_user();
    if ($user === null) {
        return false;
    }
    return in_array($user['role'], $roles, true);
}

function log_audit(string $action): void
{
    $user = get_logged_in_user();
    $userId = $user ? (int)$user['id'] : null;
    $ip = $_SERVER['REMOTE_ADDR'] ?? 'unknown';
    $ua = $_SERVER['HTTP_USER_AGENT'] ?? 'unknown';
    
    require_once __DIR__ . '/../models/UserModel.php';
    $userModel = new UserModel();
    if ($userId !== null) {
        $userModel->logAudit($userId, $action, $ip, $ua);
    }
}

function add_notification(int $userId, string $title, string $message): void
{
    require_once __DIR__ . '/../models/UserModel.php';
    $userModel = new UserModel();
    $userModel->addNotification($userId, $title, $message);
}
?>
