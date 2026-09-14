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

/**
 * Recursively decodes HTML entity codes (e.g. &#039;, &#39;, &quot;, &amp;, &lt;, &gt;, &nbsp;, etc.) into actual character symbols.
 */
function ps_decode_entities(?string $value): string
{
    if ($value === null || $value === '') {
        return '';
    }
    $str = (string) $value;
    while (preg_match('/&(#?[a-zA-Z0-9]+);/', $str)) {
        $prev = $str;
        $str = html_entity_decode($prev, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        if ($str === $prev) break;
    }
    $str = str_replace(['&#039;', '&#39;', '&amp;#039;', '&amp;#39;'], "'", $str);
    $str = str_replace(['&quot;', '&amp;quot;'], '"', $str);
    return $str;
}

function e(?string $value): string
{
    if ($value === null || $value === '') {
        return '';
    }
    $decoded = ps_decode_entities((string) $value);
    return htmlspecialchars($decoded, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
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
    if (preg_match('#^https?://#i', $path)) {
        return $path;
    }

    $configured = app_config('base_url');
    $httpHost = $_SERVER['HTTP_HOST'] ?? '';

    if ($httpHost !== '') {
        $scheme = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' || ($_SERVER['HTTP_X_FORWARDED_PROTO'] ?? '') === 'https') ? 'https' : 'http';
        $script = str_replace('\\', '/', $_SERVER['SCRIPT_NAME'] ?? '');
        $root = rtrim(dirname($script), '/');
        if (substr($root, -6) === '/admin') {
            $root = substr($root, 0, -6);
        }
        if ($root === '/' || $root === '.') {
            $root = '';
        }
        $baseUrl = $scheme . '://' . $httpHost . $root;
    } else {
        $baseUrl = rtrim((string) ($configured ?: ''), '/');
    }

    $path = ltrim($path, '/');
    return $baseUrl . ($path !== '' ? '/' . $path : '');
}

function current_path(): string
{
    $uri = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/';
    $baseUrl = base_url();
    $basePath = parse_url($baseUrl, PHP_URL_PATH) ?: '';
    $basePath = rtrim($basePath, '/');

    if ($basePath !== '' && strpos($uri, $basePath) === 0) {
        $uri = substr($uri, strlen($basePath)) ?: '/';
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
    $cleanPath = ltrim($path, '/');
    $webpVersion = preg_replace('/\.(png|jpg|jpeg)$/i', '.webp', $cleanPath);
    $localWebpPath = __DIR__ . '/../assets/' . $webpVersion;
    if ($webpVersion !== $cleanPath && file_exists($localWebpPath)) {
        return base_url('assets/' . $webpVersion);
    }
    return base_url('assets/' . $cleanPath);
}

function is_nav_item_active(string $url, string $currPath): bool
{
    $url = '/' . ltrim($url, '/');
    $currPath = '/' . ltrim(preg_replace('#^/pradeep#i', '', $currPath), '/');

    // 1. Home
    if ($url === '/') {
        return $currPath === '/' || $currPath === '' || $currPath === '/home';
    }

    // 2. Green Gang (takes priority over generic campaigns)
    if ($url === '/green-gang') {
        return $currPath === '/green-gang'
            || $currPath === '/greengang'
            || str_contains($currPath, 'green-gang')
            || str_contains($currPath, 'greengang')
            || str_contains($currPath, 'hariyali');
    }

    // 3. Campaigns (excluding Green Gang)
    if ($url === '/campaigns') {
        if ($currPath === '/green-gang' || $currPath === '/greengang' || str_contains($currPath, 'green-gang') || str_contains($currPath, 'greengang') || str_contains($currPath, 'hariyali')) {
            return false;
        }
        return $currPath === '/campaigns' 
            || $currPath === '/causes' 
            || str_starts_with($currPath, '/campaigns/') 
            || str_starts_with($currPath, '/causes/');
    }

    // 4. About
    if ($url === '/about') {
        return $currPath === '/about' || $currPath === '/about-us' || $currPath === '/parichay';
    }

    // 5. Impact
    if ($url === '/impact') {
        return $currPath === '/impact' || $currPath === '/janprabhav' || $currPath === '/community-impact' || $currPath === '/proof';
    }

    // 6. Journey
    if ($url === '/journey') {
        return $currPath === '/journey' || $currPath === '/timeline' || $currPath === '/seva-yatra';
    }

    // 7. Awards
    if ($url === '/awards') {
        return $currPath === '/awards' || $currPath === '/samman' || $currPath === '/recognition';
    }

    // 8. Portfolio (Photo Gallery)
    if ($url === '/portfolio') {
        return $currPath === '/portfolio' || $currPath === '/gallery' || $currPath === '/chhayachitra' || str_starts_with($currPath, '/portfolio/');
    }

    // 8.5 Video Gallery
    if ($url === '/videos') {
        return $currPath === '/videos' || $currPath === '/video-gallery' || $currPath === '/youtube-videos' || str_starts_with($currPath, '/videos/');
    }

    // 9. Media (Press & Clippings)
    if ($url === '/media') {
        return $currPath === '/media' || $currPath === '/press' || $currPath === '/news' || str_starts_with($currPath, '/media/');
    }

    // 10. Salahkaar / Counsellor
    if ($url === '/salahkaar') {
        return $currPath === '/salahkaar' || $currPath === '/counsellor' || $currPath === '/counsellor-guidance' || $currPath === '/advisor';
    }

    // 11. Events
    if ($url === '/events') {
        return $currPath === '/events' || $currPath === '/karyakram' || str_starts_with($currPath, '/events/');
    }

    // 12. Blog / Literature & Writings
    if ($url === '/blog') {
        return $currPath === '/blog' 
            || $currPath === '/blogs' 
            || $currPath === '/blog-and-thoughts' 
            || str_starts_with($currPath, '/blog/') 
            || str_starts_with($currPath, '/blogs/') 
            || str_starts_with($currPath, '/categories/');
    }

    // 13. Contact
    if ($url === '/contact') {
        return $currPath === '/contact' || $currPath === '/sampark' || $currPath === '/contact-us';
    }

    // 14. Volunteer
    if ($url === '/volunteer') {
        return $currPath === '/volunteer' || $currPath === '/join' || $currPath === '/shramdaan';
    }

    // 15. Donation
    if ($url === '/donation') {
        return $currPath === '/donation' || $currPath === '/donate';
    }

    // Default fallback check
    return $currPath === $url || (!str_starts_with($url, '/#') && str_starts_with($currPath, $url . '/'));
}

function is_active(string $path): string
{
    return is_nav_item_active($path, current_path()) ? 'active' : '';
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
 * Converts an image file (JPG, JPEG, PNG, GIF, BMP) to WebP format.
 * Returns absolute path to the WebP image.
 */
function convert_image_to_webp(string $filePath, int $quality = 82): string
{
    if (!file_exists($filePath) || !function_exists('imagewebp')) {
        return $filePath;
    }

    $info = @getimagesize($filePath);
    if (!$info) {
        return $filePath;
    }

    $mime = $info['mime'] ?? '';
    $imageResource = null;

    switch ($mime) {
        case 'image/jpeg':
        case 'image/jpg':
        case 'image/pjpeg':
            $imageResource = @imagecreatefromjpeg($filePath);
            break;
        case 'image/png':
            $imageResource = @imagecreatefrompng($filePath);
            if ($imageResource) {
                imagealphablending($imageResource, false);
                imagesavealpha($imageResource, true);
            }
            break;
        case 'image/gif':
            $imageResource = @imagecreatefromgif($filePath);
            if ($imageResource) {
                imagealphablending($imageResource, false);
                imagesavealpha($imageResource, true);
            }
            break;
        case 'image/bmp':
        case 'image/x-ms-bmp':
            if (function_exists('imagecreatefrombmp')) {
                $imageResource = @imagecreatefrombmp($filePath);
            }
            break;
        case 'image/webp':
            return $filePath;
        default:
            return $filePath;
    }

    if (!$imageResource) {
        return $filePath;
    }

    $pathInfo = pathinfo($filePath);
    $webpPath = $pathInfo['dirname'] . DIRECTORY_SEPARATOR . $pathInfo['filename'] . '.webp';

    $success = @imagewebp($imageResource, $webpPath, $quality);
    imagedestroy($imageResource);

    if ($success && file_exists($webpPath)) {
        if (realpath($filePath) !== realpath($webpPath) && file_exists($filePath)) {
            @unlink($filePath);
        }
        return $webpPath;
    }

    return $filePath;
}

/**
 * Centralized file upload handler with automatic WebP conversion
 */
function upload_file(array $file, string &$error = '', string $subfolder = ''): ?string
{
    if ($file['error'] !== UPLOAD_ERR_OK) {
        $error = 'File upload error code: ' . $file['error'];
        return null;
    }

    // File size validation (10MB max)
    $maxSize = 10 * 1024 * 1024;
    if ($file['size'] > $maxSize) {
        $error = 'File is too large. Maximum size is 10MB.';
        return null;
    }

    // File extension validation
    $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp', 'pdf', 'svg', 'bmp'];
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
    $rawBaseName = pathinfo($file['name'], PATHINFO_FILENAME);
    $cleanBaseName = preg_replace('/[^a-zA-Z0-9_-]/', '', $rawBaseName) ?: 'img';
    $fileName = uniqid() . '_' . $cleanBaseName . '.' . $extension;
    $targetFile = $absoluteDir . DIRECTORY_SEPARATOR . $fileName;

    if (move_uploaded_file($file['tmp_name'], $targetFile)) {
        // Automatically convert images to WebP for optimal compression & performance
        if (in_array($extension, ['jpg', 'jpeg', 'png', 'gif', 'bmp'], true)) {
            $finalPath = convert_image_to_webp($targetFile, 82);
            $finalFileName = basename($finalPath);
            return $relativeDir . '/' . $finalFileName;
        }
        return $relativeDir . '/' . $fileName;
    }

    $error = 'Failed to save uploaded file on server. Directory permissions error.';
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

function ps_amp_content(string $html): string
{
    if (trim($html) === '') return '';

    $html = preg_replace_callback('/<img([^>]+)>/i', function ($matches) {
        $attrs = $matches[1];
        $src = '';
        $alt = '';
        $width = '800';
        $height = '500';

        if (preg_match('/src=["\']([^"\']+)["\']/i', $attrs, $m)) $src = $m[1];
        if (preg_match('/alt=["\']([^"\']+)["\']/i', $attrs, $m)) $alt = $m[1];
        if (preg_match('/width=["\']([^"\']+)["\']/i', $attrs, $m)) $width = $m[1];
        if (preg_match('/height=["\']([^"\']+)["\']/i', $attrs, $m)) $height = $m[1];

        if (empty($src)) return '';

        return sprintf(
            '<amp-img src="%s" width="%s" height="%s" layout="responsive" alt="%s"></amp-img>',
            e($src),
            e($width),
            e($height),
            e($alt)
        );
    }, $html);

    $html = preg_replace('/style=["\']([^"\']*)["\']/i', '', $html);
    $html = preg_replace('/<script\b[^>]*>(.*?)<\/script>/is', '', $html);
    $html = preg_replace('/<iframe\b[^>]*>(.*?)<\/iframe>/is', '', $html);

    return $html;
}

if (!function_exists('ps_resolve_img')) {
    function ps_resolve_img(?string $dbPath, string $fallback = 'assets/images/slider_final_1.webp'): string {
        $root = realpath(__DIR__ . '/..') ?: dirname(__DIR__);
        if (!empty($dbPath)) {
            if (preg_match('#^https?://#i', $dbPath)) return $dbPath;
            $clean = ltrim($dbPath, '/');
            if (file_exists($root . '/' . $clean)) {
                return base_url($clean);
            }
            $webp = preg_replace('/\.(png|jpg|jpeg)$/i', '.webp', $clean);
            if (file_exists($root . '/' . $webp)) {
                return base_url($webp);
            }
        }
        if (empty($fallback)) {
            $fallback = 'assets/images/slider_final_1.webp';
        }
        if (preg_match('#^https?://#i', $fallback)) return $fallback;
        $cleanFallback = ltrim($fallback, '/');
        if (file_exists($root . '/' . $cleanFallback)) {
            return base_url($cleanFallback);
        }
        $webpFallback = preg_replace('/\.(png|jpg|jpeg)$/i', '.webp', $cleanFallback);
        if (file_exists($root . '/' . $webpFallback)) {
            return base_url($webpFallback);
        }
        return base_url($cleanFallback);
    }
}
?>
