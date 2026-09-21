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
function ps_decode_entities($value): string
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

function e($value): string
{
    if ($value === null || $value === '') {
        return '';
    }
    $decoded = ps_decode_entities((string) $value);
    return htmlspecialchars($decoded, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

function current_lang(): string
{
    // Temporarily disabled multi-language/English switching - Hindi is strict default
    /*
    if (isset($_GET['lang']) && in_array($_GET['lang'], app_config('supported_langs', []), true)) {
        $_SESSION['lang'] = $_GET['lang'];
    }

    return $_SESSION['lang'] ?? app_config('default_lang', 'hi');
    */
    return 'hi';
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

    $baseUrl = rtrim(app_config('base_url', ''), '/');
    $cleanPath = '/' . ltrim($path, '/');

    if (!empty($_SERVER['HTTP_HOST'])) {
        $scheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
        $host = $_SERVER['HTTP_HOST'];
        
        $scriptName = $_SERVER['SCRIPT_NAME'] ?? '';
        $subDir = dirname($scriptName);
        $subDir = ($subDir === '/' || $subDir === '\\') ? '' : rtrim(str_replace('\\', '/', $subDir), '/');
        
        if (preg_match('#/admin(?=/|$)#i', $subDir)) {
            $subDir = preg_replace('#/admin(?=/|$)#i', '', $subDir);
        }

        return $scheme . '://' . $host . $subDir . $cleanPath;
    }

    return $baseUrl . $cleanPath;
}

function asset(string $path): string
{
    $cleanPath = ltrim($path, '/');
    if (preg_match('/\.(css|js)$/i', $cleanPath) && !str_contains($cleanPath, '.min.')) {
        $minPath = preg_replace('/\.(css|js)$/i', '.min.$1', $cleanPath);
        $fullMinPath = dirname(__DIR__) . '/assets/' . $minPath;
        if (is_file($fullMinPath)) {
            $cleanPath = $minPath;
        }
    }
    return base_url('assets/' . $cleanPath);
}

function current_path(): string
{
    $uri = $_SERVER['REQUEST_URI'] ?? '/';
    $path = parse_url($uri, PHP_URL_PATH) ?: '/';
    return '/' . trim($path, '/');
}

function is_active(string $path): string
{
    return current_path() === '/' . trim($path, '/') ? 'active' : '';
}

function is_nav_item_active(string $navUrl, string $currentPath): bool
{
    $cleanNav = '/' . trim($navUrl, '/');
    $cleanCurr = '/' . trim($currentPath, '/');
    
    if ($cleanNav === '/') {
        return $cleanCurr === '/';
    }
    
    return $cleanCurr === $cleanNav || str_starts_with($cleanCurr, $cleanNav . '/');
}

function ps_text(string $hi, string $en): string
{
    // English suspended for the time being; kept for future use:
    // return current_lang() === 'hi' ? $hi : $en;
    return $hi;
}

function json_response(array $data, int $statusCode = 200): void
{
    http_response_code($statusCode);
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    exit;
}

function csrf_token(): string
{
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }

    return $_SESSION['csrf_token'];
}

function csrf_field(): string
{
    return '<input type="hidden" name="csrf_token" value="' . e(csrf_token()) . '">';
}

function verify_csrf(): void
{
    $token = $_POST['csrf_token'] ?? $_SERVER['HTTP_X_CSRF_TOKEN'] ?? '';
    if (empty($token) || !hash_equals(csrf_token(), $token)) {
        json_response(['status' => 'error', 'message' => 'CSRF token mismatch.'], 403);
    }
}

function is_post(): bool
{
    return ($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST';
}

function redirect(string $path): void
{
    header('Location: ' . base_url($path));
    exit;
}

function flash(string $key, ?string $message = null): ?string
{
    if ($message !== null) {
        $_SESSION['flash'][$key] = $message;
        return null;
    }

    $val = $_SESSION['flash'][$key] ?? null;
    unset($_SESSION['flash'][$key]);

    return $val;
}

function ps_image_path(?string $dbPath): ?string
{
    if (empty($dbPath)) return null;
    if (preg_match('#^https?://#i', $dbPath)) return $dbPath;

    $clean = ltrim($dbPath, '/');
    $root = realpath(__DIR__ . '/..') ?: dirname(__DIR__);

    if (file_exists($root . '/' . $clean)) {
        return base_url($clean);
    }

    $webp = preg_replace('/\.(png|jpg|jpeg)$/i', '.webp', $clean);
    if (file_exists($root . '/' . $webp)) {
        return base_url($webp);
    }

    return null;
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
            // If explicit path was provided in DB, preserve it so browser can load the image
            if ($clean !== '') {
                return base_url($clean);
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
        return base_url('assets/images/slider_final_1.webp');
    }
}

if (!function_exists('setting')) {
    function setting(string $key, $default = null)
    {
        static $settings = null;
        if ($settings === null) {
            try {
                if (class_exists('ContentModel')) {
                    $content = new ContentModel();
                    $settings = $content->getSettings();
                } else {
                    $settings = [];
                }
            } catch (\Throwable $e) {
                $settings = [];
            }
        }
        return $settings[$key] ?? $default;
    }
}

if (!function_exists('ps_responsive_img')) {
    /**
     * Renders a production-grade responsive HTML5 <picture> element with WebP fallback,
     * srcset attributes, lazy loading, and modern performance decoding.
     *
     * @param string|null $src Image relative path or full URL
     * @param string $alt Alt text for accessibility
     * @param string $class CSS classes for the <img> tag
     * @param string $sizes Viewport sizes attribute (e.g. "(max-width: 768px) 100vw, 50vw")
     * @param string $loading Loading attribute ("lazy" or "eager")
     * @param array $extraAttributes Additional attributes (e.g. ['id' => 'hero-img'])
     * @return string Rendered HTML <picture> or <img> markup
     */
    function ps_responsive_img(
        ?string $src,
        string $alt = '',
        string $class = '',
        string $sizes = '100vw',
        string $loading = 'lazy',
        array $extraAttributes = []
    ): string {
        $resolved = ps_resolve_img($src);
        if (empty($resolved)) {
            return '';
        }

        $altAttr = e($alt);
        $classAttr = !empty($class) ? ' class="' . e($class) . '"' : '';
        $sizesAttr = !empty($sizes) ? ' sizes="' . e($sizes) . '"' : '';
        $loadingAttr = ' loading="' . ($loading === 'eager' ? 'eager' : 'lazy') . '"';
        $decodingAttr = ' decoding="async"';

        $cleanPath = parse_url($resolved, PHP_URL_PATH) ?? '';
        $root = dirname(__DIR__);
        $relPath = ltrim(preg_replace('#^/pradeep/#i', '', $cleanPath), '/');
        $localFile = $root . '/' . $relPath;

        $dimAttr = '';
        if (isset($extraAttributes['width']) && isset($extraAttributes['height'])) {
            $dimAttr = sprintf(' width="%s" height="%s"', e((string)$extraAttributes['width']), e((string)$extraAttributes['height']));
            unset($extraAttributes['width'], $extraAttributes['height']);
        } elseif (file_exists($localFile) && !is_dir($localFile)) {
            $imgInfo = @getimagesize($localFile);
            if ($imgInfo && !empty($imgInfo[0]) && !empty($imgInfo[1])) {
                $dimAttr = sprintf(' width="%d" height="%d"', $imgInfo[0], $imgInfo[1]);
            }
        }
        if (empty($dimAttr)) {
            $dimAttr = ' width="800" height="600"';
        }

        $extraStr = '';
        foreach ($extraAttributes as $k => $v) {
            $extraStr .= ' ' . e((string)$k) . '="' . e((string)$v) . '"';
        }

        $priorityAttr = ($loading === 'eager') ? ' fetchpriority="high"' : '';

        // Standard <img> with explicit width & height and async decoding
        return sprintf(
            '<img src="%s" alt="%s"%s%s%s%s%s%s>',
            e($resolved),
            $altAttr,
            $classAttr,
            $sizesAttr,
            $loadingAttr . $decodingAttr,
            $priorityAttr,
            $dimAttr,
            $extraStr
        );
    }
}

if (!function_exists('format_date')) {
    function format_date(?string $dateStr, string $format = 'd M Y'): string {
        if (empty($dateStr)) return '';
        $timestamp = strtotime($dateStr);
        return $timestamp ? date($format, $timestamp) : $dateStr;
    }
}

if (!function_exists('ps_excerpt')) {
    function ps_excerpt($item, int $length = 140): string {
        $content = is_array($item) ? ($item['excerpt'] ?? $item['content'] ?? '') : (string)$item;
        $clean = strip_tags(ps_decode_entities($content));
        if (mb_strlen($clean) <= $length) return $clean;
        return mb_substr($clean, 0, $length) . '...';
    }
}

if (!function_exists('is_role')) {
    function is_role(...$roles): bool {
        $userRole = $_SESSION['user_role'] ?? 'author';
        if (empty($roles)) return true;
        foreach ($roles as $role) {
            if ($userRole === $role) return true;
            if ($role === 'admin' && $userRole === 'super_admin') return true;
        }
        return false;
    }
}

if (!function_exists('upload_file')) {
    /**
     * Handles secure file uploading with automatic image optimization & WebP conversion.
     * For blog featured images and site graphics, constrains maximum dimensions to 1200x630
     * and converts to optimized WebP format with full mobile responsiveness.
     */
    function upload_file(array $file, string &$error = '', string $subfolder = 'blogs', int $maxWidth = 1200, int $maxHeight = 630): ?string {
        $error = '';
        if (empty($file) || !isset($file['error']) || $file['error'] === UPLOAD_ERR_NO_FILE) {
            $error = 'No file uploaded.';
            return null;
        }

        if ($file['error'] !== UPLOAD_ERR_OK) {
            $error = 'File upload error code: ' . $file['error'];
            return null;
        }

        if ($file['size'] > 15 * 1024 * 1024) {
            $error = 'File size exceeds maximum limit of 15MB.';
            return null;
        }

        $tmpPath = $file['tmp_name'];
        if (!is_uploaded_file($tmpPath) && !file_exists($tmpPath)) {
            $error = 'Invalid uploaded file source.';
            return null;
        }

        $origName = pathinfo($file['name'], PATHINFO_FILENAME);
        $cleanSlug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $origName), '-')) ?: 'upload';
        
        $root = realpath(__DIR__ . '/..') ?: dirname(__DIR__);
        $cleanSubfolder = trim(str_replace(['..', '\\'], ['', '/'], $subfolder), '/');
        $uploadDir = $root . '/uploads' . ($cleanSubfolder ? '/' . $cleanSubfolder : '');

        if (!is_dir($uploadDir)) {
            @mkdir($uploadDir, 0775, true);
        }
        @chmod($uploadDir, 0775);

        $isImage = false;
        $imgInfo = @getimagesize($tmpPath);
        if ($imgInfo !== false && in_array($imgInfo[2], [IMAGETYPE_GIF, IMAGETYPE_JPEG, IMAGETYPE_PNG, IMAGETYPE_WEBP], true)) {
            $isImage = true;
        }

        if ($isImage && extension_loaded('gd')) {
            $filename = uniqid() . '_' . substr($cleanSlug, 0, 40) . '.webp';
            $destPath = $uploadDir . '/' . $filename;

            $raw = @file_get_contents($tmpPath);
            $srcImg = $raw ? @imagecreatefromstring($raw) : false;

            if ($srcImg) {
                $origW = imagesx($srcImg);
                $origH = imagesy($srcImg);

                // Calculate scaling ratio to constrain max dimensions to 1200x630
                $scale = min(1.0, min($maxWidth / $origW, $maxHeight / $origH));
                $targetW = max(1, (int)round($origW * $scale));
                $targetH = max(1, (int)round($origH * $scale));

                $dstImg = imagecreatetruecolor($targetW, $targetH);
                imagealphablending($dstImg, false);
                imagesavealpha($dstImg, true);
                $transparent = imagecolorallocatealpha($dstImg, 255, 255, 255, 127);
                imagefilledrectangle($dstImg, 0, 0, $targetW, $targetH, $transparent);

                imagecopyresampled($dstImg, $srcImg, 0, 0, 0, 0, $targetW, $targetH, $origW, $origH);

                $saved = false;
                if (function_exists('imagewebp')) {
                    $saved = @imagewebp($dstImg, $destPath, 85);
                }
                if (!$saved) {
                    $saved = @imagejpeg($dstImg, $destPath, 85);
                }

                imagedestroy($srcImg);
                imagedestroy($dstImg);

                if ($saved && file_exists($destPath) && filesize($destPath) > 0) {
                    return 'uploads/' . ($cleanSubfolder ? $cleanSubfolder . '/' : '') . $filename;
                }
            }
        }

        // Non-image file or GD fallback
        $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
        $filename = uniqid() . '_' . substr($cleanSlug, 0, 40) . ($ext ? '.' . strtolower($ext) : '');
        $destPath = $uploadDir . '/' . $filename;

        if (@move_uploaded_file($tmpPath, $destPath) || @copy($tmpPath, $destPath)) {
            if (file_exists($destPath) && filesize($destPath) > 0) {
                return 'uploads/' . ($cleanSubfolder ? $cleanSubfolder . '/' : '') . $filename;
            }
        }

        $error = 'Failed to save uploaded file to disk. Please check directory permissions for uploads/';
        return null;
    }
}

if (!function_exists('format_bytes')) {
    function format_bytes(int $bytes, int $precision = 1): string {
        $units = ['B', 'KB', 'MB', 'GB'];
        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min((int)$pow, count($units) - 1);
        $bytes /= (1 << (10 * $pow));
        return round($bytes, $precision) . ' ' . $units[$pow];
    }
}

if (!function_exists('get_awadhi_master_dictionary')) {
    function get_awadhi_master_dictionary(): array
    {
        return [
            'झरिहख' => [
                'word' => 'झरिहख',
                'type' => 'संज्ञा • Awadhi',
                'meaning_hi' => 'अनवरत कई दिनों तक चलने वाली लगातार धीमी फुहार व मूसलाधार बारिश।',
                'meaning_en' => 'Continuous drizzle and rain lasting uninterruptedly for days.'
            ],
            'घरैतिन' => [
                'word' => 'घरैतिन',
                'type' => 'संज्ञा • Awadhi',
                'meaning_hi' => 'गृहस्वामिनी, घर की मालकिन अथवा धर्मपत्नी के लिए आदरसूचक शब्द।',
                'meaning_en' => 'Respectful Awadhi term for homemaker or wife.'
            ],
            'कनकी' => [
                'word' => 'कनकी',
                'type' => 'संज्ञा • Awadhi',
                'meaning_hi' => 'चावल का खंडित टुकड़ा (खंढा), जो पक्षियों को चुगाने के काम आता है।',
                'meaning_en' => 'Broken rice grains fed to birds.'
            ],
            'हरहा गोरु' => [
                'word' => 'हरहा गोरु',
                'type' => 'संज्ञा • Awadhi',
                'meaning_hi' => 'हल जोतने वाले बैल एवं मवेशी जानवर, जो खूंटे पर बंधे रहते हैं।',
                'meaning_en' => 'Ploughing oxen and farm cattle tethered at posts.'
            ],
            'सुरा बघ्घी' => [
                'word' => 'सुरा बघ्घी',
                'type' => 'संज्ञा • Awadhi',
                'meaning_hi' => 'अवध क्षेत्र का प्रसिद्ध पारंपरिक चौपाल खेल (बकरी और बाघ का खेल)।',
                'meaning_en' => 'Traditional Awadhi chaupal game of goats and tigers.'
            ],
            'ओसारा' => [
                'word' => 'ओसारा',
                'type' => 'संज्ञा • Awadhi',
                'meaning_hi' => 'मकान के सामने बना बरामदा या छज्जे के नीचे की बैठक जहाँ चौपाल लगती है।',
                'meaning_en' => 'Shaded front verandah or porch of a rural home.'
            ],
            'चौपाल' => [
                'word' => 'चौपाल',
                'type' => 'संज्ञा • Awadhi',
                'meaning_hi' => 'गांव का सार्वजनिक सामुदायिक बैठक स्थल जहां लोक चर्चाएं होती हैं।',
                'meaning_en' => 'Traditional village community meeting ground.'
            ],
            'सकोरा' => [
                'word' => 'सकोरा',
                'type' => 'संज्ञा • Awadhi',
                'meaning_hi' => 'मिट्टी का छोटा पात्र या पुरवा, जिसमें पक्षियों के लिए पानी रखा जाता है।',
                'meaning_en' => 'Earthen pot for birds water.'
            ],
            'मँड़ई' => [
                'word' => 'मँड़ई',
                'type' => 'संज्ञा • Awadhi',
                'meaning_hi' => 'पुआल और बांस से छाई गई छोटी ग्रामीण कुटिया या छप्पर।',
                'meaning_en' => 'Traditional thatched roof cottage.'
            ],
            'खलियान' => [
                'word' => 'खलियान',
                'type' => 'संज्ञा • Awadhi',
                'meaning_hi' => 'गांव का वह खुला खेत जहां फसल काटकर दँवनी के लिए एकत्र की जाती है।',
                'meaning_en' => 'Threshing floor in agricultural fields.'
            ],
            'बरही' => [
                'word' => 'बरही',
                'type' => 'संज्ञा • Awadhi',
                'meaning_hi' => 'शिशु के जन्म के बारहवें दिन आयोजित होने वाला पारंपरिक मांगलिक लोक उत्सव।',
                'meaning_en' => 'Traditional 12th-day newborn ceremony.'
            ],
            'पुरवा' => [
                'word' => 'पुरवा',
                'type' => 'संज्ञा • Awadhi',
                'meaning_hi' => 'पूर्व दिशा से बहने वाली ठंडी व नमीयुक्त हवा अथवा मिट्टी का कुल्हड़।',
                'meaning_en' => 'Easterly breeze or small clay cup.'
            ],
            'हरियाली' => [
                'word' => 'हरियाली',
                'type' => 'संज्ञा • Awadhi',
                'meaning_hi' => 'प्राकृतिक पेड़-पौधे और वृक्षारोपण से फैली समृद्ध प्राकृतिक संपदा।',
                'meaning_en' => 'Lush natural greenery and environmental wealth.'
            ]
        ];
    }
}

if (!function_exists('get_awadhi_lexicon_for_post')) {
    function get_awadhi_lexicon_for_post(?string $title = '', ?string $content = '', array $customLexicon = []): array
    {
        if (!empty($customLexicon)) {
            return array_slice($customLexicon, 0, 6);
        }

        $title = (string)($title ?? '');
        $content = (string)($content ?? '');
        $master = get_awadhi_master_dictionary();
        $textToScan = mb_strtolower($title . ' ' . strip_tags($content));

        $matched = [];
        foreach ($master as $term => $data) {
            if (mb_strpos($textToScan, mb_strtolower($term)) !== false) {
                $matched[$term] = $data;
            }
        }

        if (count($matched) < 6) {
            foreach ($master as $term => $data) {
                if (!isset($matched[$term])) {
                    $matched[$term] = $data;
                }
                if (count($matched) >= 6) {
                    break;
                }
            }
        }

        return array_slice(array_values($matched), 0, 6);
    }
}

if (!function_exists('ps_generate_sitemap')) {
    /**
     * Automatically regenerates sitemap.xml in the website root directory.
     */
    function ps_generate_sitemap($blogModel = null, $contentModel = null): bool
    {
        try {
            if (!$blogModel) {
                require_once __DIR__ . '/../models/Blog.php';
                $blogModel = new Blog();
            }
            if (!$contentModel) {
                require_once __DIR__ . '/../models/ContentModel.php';
                $contentModel = new ContentModel();
            }

            $urls = [
                '',
                '/about',
                '/campaigns',
                '/events',
                '/portfolio',
                '/contact',
                '/volunteer',
                '/donation',
                '/blog'
            ];

            // Fetch published blogs
            $blogs = $blogModel->allPublished(500);
            foreach ($blogs as $b) {
                if (!empty($b['slug'])) {
                    $urls[] = '/blog/' . $b['slug'];
                }
            }

            // Fetch campaigns
            $campaigns = $contentModel->all('campaigns');
            foreach ($campaigns as $c) {
                if (!empty($c['slug'])) {
                    $urls[] = '/campaigns/' . $c['slug'];
                }
            }

            // Fetch events
            $events = $contentModel->all('events');
            foreach ($events as $e) {
                if (!empty($e['slug'])) {
                    $urls[] = '/events/' . $e['slug'];
                }
            }

            // Fetch custom pages
            $pages = $contentModel->allPages();
            foreach ($pages as $p) {
                if (!empty($p['slug'])) {
                    $urls[] = '/' . $p['slug'];
                }
            }

            // Deduplicate URLs
            $urls = array_unique($urls);

            // Build dynamic XML
            $xml = '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL;
            $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . PHP_EOL;
            foreach ($urls as $url) {
                $absolute = base_url($url);
                $xml .= '  <url>' . PHP_EOL;
                $xml .= '    <loc>' . htmlspecialchars($absolute, ENT_XML1) . '</loc>' . PHP_EOL;
                $xml .= '    <changefreq>weekly</changefreq>' . PHP_EOL;
                $xml .= '    <priority>' . ($url === '' ? '1.0' : '0.8') . '</priority>' . PHP_EOL;
                $xml .= '  </url>' . PHP_EOL;
            }
            $xml .= '</urlset>' . PHP_EOL;

            // Write to the root directory
            $sitemapFile = __DIR__ . '/../sitemap.xml';
            return (file_put_contents($sitemapFile, $xml) !== false);
        } catch (Throwable $e) {
            error_log('Sitemap auto-generation failed: ' . $e->getMessage());
            return false;
        }
    }
}

if (!function_exists('transliterate_devanagari')) {
    /**
     * Convert Hindi Devanagari text into clean Roman / English characters for titles and slugs.
     */
    function transliterate_devanagari(string $text): string
    {
        $map = [
            'अ' => 'a', 'आ' => 'aa', 'इ' => 'i', 'ई' => 'ee', 'उ' => 'u', 'ऊ' => 'oo', 'ऋ' => 'ri',
            'ए' => 'e', 'ऐ' => 'ai', 'ओ' => 'o', 'औ' => 'au', 'अं' => 'an', 'अः' => 'ah',
            'क' => 'k', 'ख' => 'kh', 'ग' => 'g', 'घ' => 'gh', 'ङ' => 'ng',
            'च' => 'ch', 'छ' => 'chh', 'ज' => 'j', 'झ' => 'jh', 'ञ' => 'ny',
            'ट' => 't', 'ठ' => 'th', 'ड' => 'd', 'ढ' => 'dh', 'ण' => 'n',
            'त' => 't', 'थ' => 'th', 'द' => 'd', 'ध' => 'dh', 'न' => 'n',
            'प' => 'p', 'फ' => 'f', 'ब' => 'b', 'भ' => 'bh', 'म' => 'm',
            'य' => 'y', 'र' => 'r', 'ल' => 'l', 'व' => 'v', 'श' => 'sh', 'ष' => 'sh', 'स' => 's', 'ह' => 'h',
            'क्ष' => 'ksh', 'त्र' => 'tra', 'ज्ञ' => 'gya', 'श्र' => 'shra',
            'ा' => 'a', 'ि' => 'i', 'ी' => 'ee', 'ु' => 'u', 'ू' => 'oo', 'ृ' => 'ri',
            'े' => 'e', 'ै' => 'ai', 'ो' => 'o', 'ौ' => 'au', 'ं' => 'n', 'ँ' => 'n', 'ः' => 'h',
            '्' => '', '़' => '', '।' => '.', '॥' => '.'
        ];
        $res = strtr($text, $map);
        $res = preg_replace('/[^a-zA-Z0-9\s-]/', ' ', $res);
        $res = ucwords(strtolower(trim(preg_replace('/\s+/', ' ', $res))));
        return $res ?: 'Article';
    }
}

if (!function_exists('clean_plain_text')) {
    /**
     * Completely strips HTML tags, script/style content, decodes entities,
     * and collapses whitespaces into a clean, human-readable plain text string.
     */
    function clean_plain_text(?string $text): string
    {
        if ($text === null || $text === '') {
            return '';
        }
        // Remove style and script blocks completely
        $clean = preg_replace('/<style\b[^>]*>(.*?)<\/style>/is', '', $text);
        $clean = preg_replace('/<script\b[^>]*>(.*?)<\/script>/is', '', $clean);
        // Strip tags
        $clean = strip_tags($clean);
        // Decode entities
        $clean = html_entity_decode($clean, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        // Double pass in case encoded tags were revealed
        $clean = strip_tags($clean);
        // Collapse multiple spaces and newlines
        $clean = preg_replace('/\s+/', ' ', $clean);
        return trim($clean);
    }
}

if (!function_exists('to_hindi_num')) {
    /**
     * Converts any integer or numeric string to Hindi Devanagari numerals.
     */
    function to_hindi_num($n): string
    {
        return strtr((string)$n, [
            '0' => '०', '1' => '१', '2' => '२', '3' => '३', '4' => '४',
            '5' => '५', '6' => '६', '7' => '७', '8' => '८', '9' => '९',
        ]);
    }
}

if (!function_exists('ps_amp_content')) {
    /**
     * Converts HTML / rich-text content into valid, clean AMP HTML:
     * - Strips forbidden tags (<script>, <style>, <form>, <svg>, <canvas>, <frame>, <object>, <embed>)
     * - Strips inline event handlers (onclick, onload, onerror, etc.)
     * - Strips inline style attributes forbidden in AMP
     * - Strips prohibited attributes and javascript: URIs
     * - Converts <img> tags into responsive <amp-img> components
     * - Converts <iframe> tags into responsive <amp-iframe> components
     * - Preserves valid typography, paragraphs, headings, blockquotes, lists, links
     */
    function ps_amp_content(?string $html): string
    {
        if ($html === null || trim($html) === '') {
            return '';
        }

        $html = (string) $html;

        // If string has no HTML tags, auto-convert newlines to paragraphs / breaks
        if (!str_contains($html, '<') && !str_contains($html, '>')) {
            return '<p>' . nl2br(htmlspecialchars($html, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8')) . '</p>';
        }

        // 1. Remove dangerous or forbidden container tags and their contents
        $html = preg_replace('#<(script|style|form|svg|canvas|frame|frameset|object|embed|applet)[^>]*>.*?</\1>#is', '', $html);
        $html = preg_replace('#<(script|style|form|svg|canvas|frame|frameset|object|embed|applet)[^>]*\/?>#is', '', $html);

        // 2. Remove inline event handlers (onclick, onload, onerror, etc.)
        $html = preg_replace('/\s+on[a-zA-Z]+\s*=\s*("[^"]*"|\'[^\']*\'|[^\s>]+)/i', '', $html);

        // 3. Remove javascript: links
        $html = preg_replace('/\s+href\s*=\s*["\']\s*javascript:[^"\']*["\']/i', ' href="#"', $html);

        // 4. Remove inline style attributes (AMP disallows inline style attributes on HTML tags)
        $html = preg_replace('/\s+style\s*=\s*("[^"]*"|\'[^\']*\'|[^\s>]+)/i', '', $html);

        // 5. Convert <img> tags to <amp-img>
        $html = preg_replace_callback('/<img\b([^>]*?)\/?>/is', function ($matches) {
            $attrs = $matches[1];

            // Extract src
            if (!preg_match('/src\s*=\s*["\']([^"\']+)["\']/i', $attrs, $sm)) {
                return '';
            }
            $src = trim($sm[1]);
            if ($src === '') {
                return '';
            }
            if (!preg_match('#^https?://#i', $src) && !str_starts_with($src, '//')) {
                $src = base_url($src);
            }

            // Extract width & height (AMP requires width & height)
            $width = 800;
            $height = 480;
            if (preg_match('/width\s*=\s*["\']?(\d+)/i', $attrs, $wm)) {
                $width = max(10, (int) $wm[1]);
            }
            if (preg_match('/height\s*=\s*["\']?(\d+)/i', $attrs, $hm)) {
                $height = max(10, (int) $hm[1]);
            }

            // Extract alt
            $alt = '';
            if (preg_match('/alt\s*=\s*["\']([^"\']*)["\']/i', $attrs, $am)) {
                $alt = htmlspecialchars($am[1], ENT_QUOTES, 'UTF-8');
            }

            return sprintf(
                '<amp-img src="%s" width="%d" height="%d" layout="responsive" alt="%s"></amp-img>',
                htmlspecialchars($src, ENT_QUOTES, 'UTF-8'),
                $width,
                $height,
                $alt
            );
        }, $html);

        // 6. Convert <iframe> to <amp-iframe>
        $html = preg_replace_callback('/<iframe\b([^>]*?)>(.*?)<\/iframe>/is', function ($matches) {
            $attrs = $matches[1];
            if (!preg_match('/src\s*=\s*["\']([^"\']+)["\']/i', $attrs, $sm)) {
                return '';
            }
            $src = trim($sm[1]);
            // AMP requires HTTPS for iframes
            if (str_starts_with($src, 'http://')) {
                $src = 'https://' . substr($src, 7);
            }

            $width = 600;
            $height = 340;
            if (preg_match('/width\s*=\s*["\']?(\d+)/i', $attrs, $wm)) {
                $width = max(10, (int) $wm[1]);
            }
            if (preg_match('/height\s*=\s*["\']?(\d+)/i', $attrs, $hm)) {
                $height = max(10, (int) $hm[1]);
            }

            return sprintf(
                '<amp-iframe src="%s" width="%d" height="%d" layout="responsive" sandbox="allow-scripts allow-same-origin"></amp-iframe>',
                htmlspecialchars($src, ENT_QUOTES, 'UTF-8'),
                $width,
                $height
            );
        }, $html);

        return trim($html);
    }
}


