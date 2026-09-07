<?php
declare(strict_types=1);

$currentLang = current_lang();
$canonicalUrl = $canonicalUrl ?? base_url(preg_replace('#/amp$#i', '', current_path()));
$siteName = app_config('name', 'Pradeep Sarang');
?>
<!doctype html>
<html ⚡ lang="<?= e($currentLang) ?>">
<head>
    <meta charset="utf-8">
    <title><?= e($title) ?> | <?= e($siteName) ?> AMP</title>
    <link rel="canonical" href="<?= e($canonicalUrl) ?>">
    <meta name="viewport" content="width=device-width,minimum-scale=1,initial-scale=1">
    
    <script async src="https://cdn.ampproject.org/v0.js"></script>

    <!-- AMP Boilerplate -->
    <style amp-boilerplate>body{-webkit-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-moz-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-ms-animation:-amp-start 8s steps(1,end) 0s 1 normal both;animation:-amp-start 8s steps(1,end) 0s 1 normal both}@-webkit-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-moz-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-ms-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-o-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}</style><noscript><style amp-boilerplate>body{-webkit-animation:none;-moz-animation:none;-ms-animation:none;animation:none}</style></noscript>

    <!-- AMP Custom CSS -->
    <style amp-custom>
        :root {
            --primary: #14532D;
            --primary-dark: #18392B;
            --secondary: #15803D;
            --accent: #C05632;
            --bg-canvas: #FAF8F3;
            --bg-card: #FFFFFF;
            --text-main: #172033;
            --text-muted: #667085;
            --border-warm: #E5E7EB;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            background-color: var(--bg-canvas);
            color: var(--text-main);
            margin: 0;
            padding: 0;
            line-height: 1.6;
            -webkit-font-smoothing: antialiased;
        }

        .amp-header {
            background-color: var(--primary-dark);
            color: #ffffff;
            padding: 12px 16px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 2px 8px rgba(0,0,0,0.15);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .amp-brand {
            color: #ffffff;
            text-decoration: none;
            font-weight: 700;
            font-size: 18px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .amp-badge {
            background: #15803d;
            color: #ffffff;
            font-size: 10px;
            padding: 2px 6px;
            border-radius: 4px;
            text-transform: uppercase;
            font-weight: bold;
        }

        .amp-nav {
            background: #ffffff;
            border-bottom: 1px solid var(--border-warm);
            padding: 8px 16px;
            overflow-x: auto;
            white-space: nowrap;
            display: flex;
            gap: 12px;
        }

        .amp-nav a {
            color: var(--text-main);
            text-decoration: none;
            font-size: 13px;
            font-weight: 600;
            padding: 4px 8px;
            border-radius: 4px;
        }

        .amp-nav a:hover, .amp-nav a.active {
            background: #f0fdf1;
            color: var(--primary);
        }

        .amp-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px 16px 40px 16px;
        }

        .amp-article-title {
            font-size: 28px;
            line-height: 1.3;
            color: var(--primary-dark);
            margin: 0 0 12px 0;
            font-weight: 800;
        }

        .amp-meta {
            font-size: 13px;
            color: var(--text-muted);
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 12px;
            border-bottom: 1px solid var(--border-warm);
            padding-bottom: 12px;
        }

        .amp-meta-author {
            color: var(--primary);
            font-weight: bold;
        }

        .amp-card {
            background: var(--bg-card);
            border: 1px solid var(--border-warm);
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 24px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.03);
        }

        .amp-content p {
            font-size: 17px;
            line-height: 1.8;
            margin-bottom: 20px;
            color: #2b382d;
        }

        .amp-content h2, .amp-content h3 {
            color: var(--primary-dark);
            margin-top: 32px;
            margin-bottom: 12px;
        }

        .amp-footer {
            background: var(--primary-dark);
            color: #d9e6da;
            padding: 30px 16px;
            text-align: center;
            font-size: 13px;
            margin-top: 40px;
            border-top: 3px solid var(--secondary);
        }

        .amp-footer a {
            color: #ffffff;
            text-decoration: underline;
            margin: 0 8px;
        }

        .amp-btn {
            display: inline-block;
            background: var(--primary);
            color: #ffffff;
            padding: 10px 20px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: bold;
            margin-top: 16px;
        }

        .amp-canonical-link {
            display: block;
            text-align: center;
            margin: 20px 0;
            padding: 12px;
            background: #fff3dc;
            border: 1px solid #f59e0b;
            border-radius: 8px;
            color: #78350f;
            text-decoration: none;
            font-size: 14px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <!-- AMP Header -->
    <header class="amp-header">
        <a href="<?= e(base_url('/amp')) ?>" class="amp-brand">
            <span>🍃 <?= e($siteName) ?></span>
            <span class="amp-badge">⚡ AMP</span>
        </a>
        <a href="<?= e($canonicalUrl) ?>" class="amp-btn" style="padding: 4px 10px; font-size: 12px; margin: 0;">Desktop / Full Site</a>
    </header>

    <!-- AMP Navigation -->
    <nav class="amp-nav">
        <a href="<?= e(base_url('/amp')) ?>">होम</a>
        <a href="<?= e(base_url('/about/amp')) ?>">परिचय</a>
        <a href="<?= e(base_url('/campaigns/amp')) ?>">अभियान</a>
        <a href="<?= e(base_url('/green-gang/amp')) ?>">ग्रीन गैंग</a>
        <a href="<?= e(base_url('/events/amp')) ?>">कार्यक्रम</a>
        <a href="<?= e(base_url('/blog/amp')) ?>">साहित्य व विचार</a>
        <a href="<?= e(base_url('/contact/amp')) ?>">संपर्क</a>
    </nav>

    <!-- AMP Content Container -->
    <main class="amp-container">
        <?php require $viewFile; ?>

        <a href="<?= e($canonicalUrl) ?>" class="amp-canonical-link">
            🌐 View Full Interactive Version on Official Site ↗
        </a>
    </main>

    <!-- AMP Footer -->
    <footer class="amp-footer">
        <p><strong><?= e($siteName) ?></strong> — पर्यावरण संरक्षण, जनसेवा एवं अवधी साहित्य</p>
        <p>
            <a href="<?= e(base_url('/privacy-policy/amp')) ?>">Privacy Policy</a> |
            <a href="<?= e(base_url('/terms-and-conditions/amp')) ?>">Terms</a> |
            <a href="<?= e(base_url('/disclaimer/amp')) ?>">Disclaimer</a>
        </p>
        <p>&copy; <?= date('Y') ?> <?= e($siteName) ?>. All rights reserved.</p>
    </footer>
</body>
</html>
