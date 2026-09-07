<?php
declare(strict_types=1);
require_once __DIR__ . '/../partials/home/presentation.php';
$canonicalPath = preg_replace('#^/pradeep(?=/|$)#i', '', current_path()) ?: '/';
$isHomePage = basename($viewFile) === 'home.php';
?>
<!doctype html>
<html lang="<?= e(current_lang()) ?>" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= e($title) ?> | <?= e(app_config('name')) ?></title>
    <meta name="description" content="<?= e(ps_text('प्रदीप सारंग की जनसेवा, हरियाली अभियान, अवधी साहित्य और सामुदायिक कार्यों की यात्रा।','Discover Pradeep Sarang’s community service, Green Gang initiative, Awadhi literature and cultural work.')) ?>">
    <link rel="canonical" href="<?= e(base_url($canonicalPath)) ?>">
    <link rel="amphtml" href="<?= e(base_url(($canonicalPath === '/' ? '/amp' : rtrim($canonicalPath, '/') . '/amp'))) ?>">
    <link rel="icon" href="<?= e(asset('images/home/icon.svg')) ?>" type="image/svg+xml">
    
    <!-- Resource Hints & Non-blocking Fonts -->
    <link rel="dns-prefetch" href="https://fonts.googleapis.com">
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link rel="dns-prefetch" href="https://cdnjs.cloudflare.com">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Cinzel:wght@500;600;700&family=Playfair+Display:ital,wght@0,600;0,700;1,400&family=Manrope:wght@500;600;700&family=Noto+Sans:wght@400;500;600;700&family=Noto+Serif:ital,wght@0,400;0,600;1,400&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0..1,0&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" media="print" onload="this.media='all'">
    <noscript><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"></noscript>

    <!-- Tailwind CSS with custom Design Tokens -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script id="tailwind-config">
    tailwind.config = {
        darkMode: "class",
        theme: {
          extend: {
            "colors": {
              "surface-container-lowest": "#ffffff",
              "secondary-fixed-dim": "#ffb59a",
              "on-tertiary-container": "#fff2e7",
              "surface-bright": "#f0fdf1",
              "on-primary-container": "#d3ffd5",
              "primary-container": "#15803d",
              "surface-container-highest": "#d9e6da",
              "on-primary": "#ffffff",
              "error-container": "#ffdad6",
              "on-secondary-fixed-variant": "#802a00",
              "outline": "#6f7a6e",
              "primary": "#00652c",
              "surface-variant": "#d9e6da",
              "background": "#f0fdf1",
              "tertiary": "#7b4d00",
              "error": "#ba1a1a",
              "on-surface": "#131e17",
              "on-secondary-container": "#702400",
              "on-secondary-fixed": "#380d00",
              "inverse-on-surface": "#e7f4e9",
              "on-surface-variant": "#3f493f",
              "deep-forest": "#14532D",
              "text-muted": "#647067",
              "secondary-container": "#fe8859",
              "surface-tint": "#006d30",
              "on-tertiary-fixed": "#2a1700",
              "fresh-sprout": "#22C55E",
              "tertiary-fixed": "#ffddb8",
              "outline-variant": "#becabc",
              "on-secondary": "#ffffff",
              "soft-meadow": "#F3F8F3",
              "inverse-primary": "#79db8d",
              "secondary": "#a04118",
              "cream-canvas": "#FFFDF7",
              "on-primary-fixed-variant": "#005323",
              "border-warm": "#E4EAE5",
              "tertiary-container": "#9c6300",
              "pure-white": "#FFFFFF",
              "secondary-fixed": "#ffdbce",
              "primary-fixed": "#95f8a7",
              "primary-fixed-dim": "#79db8d",
              "on-tertiary-fixed-variant": "#653e00",
              "surface-dim": "#d0ddd2",
              "on-error": "#ffffff",
              "surface-container": "#e4f1e6",
              "inverse-surface": "#28332b",
              "on-tertiary": "#ffffff",
              "on-error-container": "#93000a",
              "on-primary-fixed": "#00210a",
              "surface": "#f0fdf1",
              "tertiary-fixed-dim": "#ffb95f",
              "surface-container-low": "#eaf7eb",
              "on-background": "#131e17",
              "surface-container-high": "#dfece0"
            },
            "borderRadius": {
              "DEFAULT": "0.25rem",
              "lg": "0.5rem",
              "xl": "0.75rem",
              "full": "9999px"
            },
            "spacing": {
              "space-xs": "0.5rem",
              "space-xl": "2rem",
              "space-2xl": "3rem",
              "space-4xl": "6rem",
              "space-lg": "1.5rem",
              "space-2xs": "0.25rem",
              "gutter-tablet": "1.5rem",
              "gutter-desktop": "2rem",
              "space-5xl": "8rem",
              "gutter-mobile": "1rem",
              "container-editorial": "780px",
              "space-md": "1rem",
              "container-max": "1280px",
              "space-3xl": "4.5rem",
              "space-sm": "0.75rem"
            },
            "fontFamily": {
              "headline-lg-mobile": ["Noto Serif", "serif"],
              "quote-editorial": ["Noto Serif", "serif"],
              "headline-lg": ["Noto Serif", "serif"],
              "body-md": ["Manrope", "sans-serif"],
              "label-md": ["Noto Sans", "sans-serif"],
              "display-hero": ["Noto Serif", "serif"],
              "headline-sm": ["Noto Serif", "serif"],
              "headline-md": ["Noto Serif", "serif"],
              "label-sm": ["Noto Sans", "sans-serif"],
              "title-lg": ["Manrope", "sans-serif"],
              "display-hero-mobile": ["Noto Serif", "serif"],
              "title-md": ["Manrope", "sans-serif"],
              "body-sm": ["Manrope", "sans-serif"],
              "body-lg": ["Manrope", "sans-serif"]
            },
            "fontSize": {
              "headline-lg-mobile": ["28px", { "lineHeight": "38px", "fontWeight": "600" }],
              "quote-editorial": ["24px", { "lineHeight": "38px", "fontWeight": "400" }],
              "headline-lg": ["40px", { "lineHeight": "52px", "letterSpacing": "-0.015em", "fontWeight": "600" }],
              "body-md": ["16px", { "lineHeight": "26px", "fontWeight": "400" }],
              "label-md": ["13px", { "lineHeight": "18px", "letterSpacing": "0.04em", "fontWeight": "600" }],
              "display-hero": ["56px", { "lineHeight": "68px", "letterSpacing": "-0.02em", "fontWeight": "600" }],
              "headline-sm": ["22px", { "lineHeight": "30px", "fontWeight": "600" }],
              "headline-md": ["28px", { "lineHeight": "38px", "fontWeight": "500" }],
              "label-sm": ["11px", { "lineHeight": "16px", "letterSpacing": "0.06em", "fontWeight": "600" }],
              "title-lg": ["20px", { "lineHeight": "28px", "fontWeight": "600" }],
              "display-hero-mobile": ["36px", { "lineHeight": "46px", "letterSpacing": "-0.01em", "fontWeight": "600" }],
              "title-md": ["18px", { "lineHeight": "26px", "fontWeight": "600" }],
              "body-sm": ["14px", { "lineHeight": "22px", "fontWeight": "400" }],
              "body-lg": ["18px", { "lineHeight": "30px", "fontWeight": "400" }]
            }
          }
        }
    };
    </script>
    <style>
        @layer base {
            html, body { margin: 0; padding: 0; }
            body { overscroll-behavior: none; }
            main > :first-child { margin-top: 0 !important; }
            main > :last-child { margin-bottom: 0 !important; }
        }
        header { z-index: 9999 !important; }
        .nav-dropdown-panel {
            background-color: #ffffff !important;
            background: #ffffff !important;
            opacity: 1 !important;
            box-shadow: 0 20px 40px -4px rgba(18, 38, 25, 0.22), 0 8px 20px -2px rgba(0, 0, 0, 0.12) !important;
            border: 1px solid rgba(197, 203, 196, 0.9) !important;
            z-index: 10000 !important;
        }
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
            display: inline-block;
            vertical-align: middle;
            line-height: 1;
        }
    </style>
    <?php if (!$isHomePage): ?>
        <link href="<?= e(asset('css/site/home.css')) ?>" rel="stylesheet">
    <?php endif; ?>
    <script src="<?= e(asset('js/site/home.js')) ?>" defer></script>
</head>
    <?php $isFullPage = $isHomePage || in_array(basename($viewFile), ['contact.php', 'volunteer.php', 'blog.php', 'cause-detail.php', 'causes.php', 'events.php', 'media.php', 'blog-detail.php', 'donation.php', 'about.php', 'portfolio.php', 'awards.php', 'journey.php', 'impact.php', 'green-gang.php', 'salahkaar.php'], true); ?>
<body class="<?= $isFullPage ? 'bg-cream-canvas font-body-md text-body-md text-on-surface antialiased' : 'ps-site ps-inner-page' ?>">
    <a href="#main" class="sr-only focus:not-sr-only focus:fixed focus:top-4 focus:left-4 focus:z-[100] focus:bg-primary focus:text-on-primary focus:px-4 focus:py-2 focus:rounded-md"><?= e(ps_text('मुख्य सामग्री पर जाएं','Skip to content')) ?></a>
    
    <?php require __DIR__ . '/../partials/home/header.php'; ?>

    <?php foreach (['success', 'error'] as $flashType): if ($message = flash($flashType)): ?>
        <div class="fixed top-24 right-4 z-50 max-w-md bg-emerald-800 text-white px-5 py-3.5 rounded-xl shadow-2xl flex items-center gap-3 border border-emerald-600" role="status">
            <span class="material-symbols-outlined text-fresh-sprout">check_circle</span>
            <span><?= e($message) ?></span>
            <button type="button" onclick="this.parentElement.remove()" class="ml-auto text-white/70 hover:text-white">&times;</button>
        </div>
    <?php endif; endforeach; ?>

    <?php if ($isFullPage): ?>
        <main id="main" class="w-full pt-[116px] bg-cream-canvas min-h-screen">
            <?php require $viewFile; ?>
        </main>
    <?php else: ?>
        <main id="main" class="pt-28"><?php require $viewFile; ?></main>
    <?php endif; ?>

    <?php require __DIR__ . '/../partials/home/footer.php'; ?>

    <!-- Image Lightbox Modal for Gallery & Media -->
    <dialog class="ps-lightbox backdrop:bg-black/80 rounded-2xl p-4 bg-pure-white max-w-4xl w-[92vw] shadow-2xl z-[100]" id="ps-lightbox" aria-labelledby="ps-lightbox-caption">
        <div class="flex justify-end mb-2">
            <button class="ps-icon-button ps-lightbox-close text-2xl font-bold text-deep-forest hover:text-secondary p-1" type="button" aria-label="<?= e(ps_text('बंद करें','Close image')) ?>">✕</button>
        </div>
        <div class="max-h-[75vh] flex items-center justify-center overflow-hidden rounded-xl bg-surface-container">
            <img class="max-h-[70vh] w-auto object-contain mx-auto" alt="" id="ps-lightbox-img" src="">
        </div>
        <div class="mt-4 flex items-center justify-between gap-4">
            <p id="ps-lightbox-caption" class="font-body-md text-deep-forest font-medium"></p>
            <a class="text-primary hover:text-deep-forest font-label-md text-label-md font-bold flex items-center gap-1 shrink-0" id="ps-lightbox-original" href="#" target="_blank" rel="noopener noreferrer">
                <?= e(ps_text('मूल चित्र खोलें','Open original image')) ?> ↗
            </a>
        </div>
    </dialog>
    <!-- Deferred Application Engine JS -->
    <script src="<?= e(asset('js/app.js')) ?>" defer></script>
</body>
</html>

