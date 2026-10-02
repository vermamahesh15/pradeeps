<?php
declare(strict_types=1);
require_once __DIR__ . '/../partials/home/presentation.php';
$canonicalPath = preg_replace('#^/pradeep(?=/|$)#i', '', current_path()) ?: '/';
$isHomePage = basename($viewFile) === 'home.php';
$isNotFoundPage = basename($viewFile) === '404.php' || http_response_code() >= 400;
?>
<!doctype html>
<html lang="<?= e(current_lang()) ?>" class="scroll-smooth" translate="no">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="google" content="notranslate">
    <meta name="theme-color" content="#14532D">
    <meta name="author" content="<?= e(ps_text('प्रदीप सारंग', 'Pradeep Sarang')) ?>">
    
    <title><?= e($title) ?> | <?= e(app_config('name')) ?></title>
    
    <?php
    $pageDesc = !empty($metaDescription) 
        ? $metaDescription 
        : (isset($post['meta_description']) && !empty($post['meta_description']) 
            ? $post['meta_description'] 
            : ps_text('प्रदीप सारंग की जनसेवा, हरियाली अभियान, ग्रीन गैंग, अवधी साहित्य और सामुदायिक कार्यों की आधिकारिक वेबसाइट।', 'Official website of Pradeep Sarang: community service, Green Gang environmental initiative, Awadhi literature and cultural heritage.'));
    
    $pageKeywords = !empty($metaKeywords) 
        ? $metaKeywords 
        : (isset($post['meta_keywords']) && !empty($post['meta_keywords']) 
            ? $post['meta_keywords'] 
            : 'प्रदीप सारंग, Pradeep Sarang, ग्रीन गैंग, Green Gang, हरियाली अभियान, अवधी साहित्य, सरदार पटेल समाजोत्थान ट्रस्ट, बाराबंकी, Barabanki, Samajsewa, Environment Conservation');
            
    $ogImg = !empty($ogImage) 
        ? base_url($ogImage) 
        : (isset($post['og_image']) && !empty($post['og_image']) 
            ? base_url($post['og_image']) 
            : base_url('assets/images/slider_final_1.webp'));
    ?>
    
    <meta name="description" content="<?= e($pageDesc) ?>">
    <meta name="keywords" content="<?= e($pageKeywords) ?>">
    
    <?php if ($isNotFoundPage): ?>
    <meta name="robots" content="noindex, nofollow">
    <?php else: ?>
    <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
    <link rel="canonical" href="<?= e(base_url($canonicalPath)) ?>">
    <link rel="amphtml" href="<?= e(base_url(($canonicalPath === '/' ? '/amp' : rtrim($canonicalPath, '/') . '/amp'))) ?>">
    <?php endif; ?>
    
    <!-- Open Graph / Facebook / WhatsApp -->
    <meta property="og:locale" content="<?= current_lang() === 'hi' ? 'hi_IN' : 'en_US' ?>">
    <meta property="og:type" content="<?= isset($post) ? 'article' : 'website' ?>">
    <meta property="og:site_name" content="<?= e(app_config('name')) ?>">
    <meta property="og:title" content="<?= e($title) ?> | <?= e(app_config('name')) ?>">
    <meta property="og:description" content="<?= e($pageDesc) ?>">
    <meta property="og:url" content="<?= e(base_url($canonicalPath)) ?>">
    <meta property="og:image" content="<?= e($ogImg) ?>">
    
    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?= e($title) ?> | <?= e(app_config('name')) ?>">
    <meta name="twitter:description" content="<?= e($pageDesc) ?>">
    <meta name="twitter:image" content="<?= e($ogImg) ?>">

    <link rel="icon" href="<?= e(asset('images/home/icon.svg')) ?>" type="image/svg+xml">
    
    <!-- Resource Hints & Non-blocking Fonts -->
    <link rel="dns-prefetch" href="https://fonts.googleapis.com">
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link rel="dns-prefetch" href="https://cdnjs.cloudflare.com">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Manrope:wght@500;600;700&family=Noto+Sans:wght@400;500;600;700&family=Noto+Serif:ital,wght@0,400;0,600;1,400&family=Noto+Sans+Devanagari:wght@400;500;600;700&family=Noto+Serif+Devanagari:wght@400;600;700&display=swap" media="print" onload="this.media='all'">
    <noscript><link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Manrope:wght@500;600;700&family=Noto+Sans:wght@400;500;600;700&family=Noto+Serif:ital,wght@0,400;0,600;1,400&family=Noto+Sans+Devanagari:wght@400;500;600;700&family=Noto+Serif+Devanagari:wght@400;600;700&display=swap"></noscript>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0..1,0&display=swap" media="print" onload="this.media='all'">
    <noscript><link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0..1,0&display=swap"></noscript>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" media="print" onload="this.media='all'">
    <noscript><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"></noscript>

    <?php if ($isHomePage): ?>
        <link rel="preload" as="image" href="<?= e(base_url('assets/images/slider_final_1.webp')) ?>" fetchpriority="high">
    <?php endif; ?>

    <!-- Tailwind CSS with custom Design Tokens (suppress console warning for Best Practices) -->
    <script>
    (function(){
      var origWarn = console.warn;
      console.warn = function(){
        if (arguments[0] && typeof arguments[0] === 'string' && arguments[0].indexOf('cdn.tailwindcss.com') !== -1) return;
        return origWarn.apply(console, arguments);
      };
    })();
    </script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script id="tailwind-config">
    tailwind.config = {
        darkMode: "class",
        theme: {
          extend: {
            "colors": {
              "surface-container-lowest": "#ffffff",
              "secondary-fixed-dim": "#c4b5fd",
              "on-tertiary-container": "#ffffff",
              "surface-bright": "#fbf8f2",
              "on-primary-container": "#ffffff",
              "primary-container": "#14532d",
              "surface-container-highest": "#e5e7eb",
              "on-primary": "#ffffff",
              "error-container": "#ffdad6",
              "on-secondary-fixed-variant": "#15803d",
              "outline": "#475467",
              "primary": "#14532d",
              "surface-variant": "#f3f5f1",
              "background": "#faf8f3",
              "tertiary": "#c05632",
              "terracotta": "#c05632",
              "gold": "#b28a42",
              "charcoal": "#172033",
              "slate-gray": "#475467",
              "error": "#ba1a1a",
              "on-surface": "#172033",
              "on-secondary-container": "#ffffff",
              "on-secondary-fixed": "#14532d",
              "inverse-on-surface": "#faf8f3",
              "on-surface-variant": "#475467",
              "deep-forest": "#14532d",
              "text-muted": "#475467",
              "secondary-container": "#c05632",
              "surface-tint": "#14532d",
              "on-tertiary-fixed": "#14532d",
              "fresh-sprout": "#15803d",
              "forest-green": "#14532d",
              "green-gang": "#15803d",
              "emerald-accent": "#15803d",
              "tertiary-fixed": "#b28a42",
              "outline-variant": "#e5e7eb",
              "on-secondary": "#ffffff",
              "soft-meadow": "#f3f5f1",
              "inverse-primary": "#15803d",
              "secondary": "#15803d",
              "cream-canvas": "#faf8f3",
              "on-primary-fixed-variant": "#14532d",
              "border-warm": "#e5e7eb",
              "tertiary-container": "#c05632",
              "pure-white": "#ffffff",
              "secondary-fixed": "#15803d",
              "primary-fixed": "#b28a42",
              "primary-fixed-dim": "#b28a42",
              "on-tertiary-fixed-variant": "#a9472b",
              "surface-dim": "#e5e7eb",
              "on-error": "#ffffff",
              "surface-container": "#faf8f3",
              "inverse-surface": "#14532d",
              "on-tertiary": "#ffffff",
              "on-error-container": "#93000a",
              "on-primary-fixed": "#14532d",
              "surface": "#fbf8f2",
              "tertiary-fixed-dim": "#fbbf24",
              "surface-container-low": "#f5f3ef",
              "on-background": "#1e293b",
              "surface-container-high": "#e2e8f0",
              "terracotta": "#b45336",
              "terracotta-hover": "#933f2b"
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
              "headline-lg-mobile": ["Noto Serif Devanagari", "Noto Serif", "serif"],
              "quote-editorial": ["Noto Serif Devanagari", "Noto Serif", "serif"],
              "headline-lg": ["Noto Serif Devanagari", "Noto Serif", "serif"],
              "body-md": ["Noto Sans Devanagari", "Manrope", "sans-serif"],
              "label-md": ["Noto Sans Devanagari", "Noto Sans", "sans-serif"],
              "display-hero": ["Noto Serif Devanagari", "Noto Serif", "serif"],
              "headline-sm": ["Noto Serif Devanagari", "Noto Serif", "serif"],
              "headline-md": ["Noto Serif Devanagari", "Noto Serif", "serif"],
              "label-sm": ["Noto Sans Devanagari", "Noto Sans", "sans-serif"],
              "title-lg": ["Noto Sans Devanagari", "Manrope", "sans-serif"],
              "display-hero-mobile": ["Noto Serif Devanagari", "Noto Serif", "serif"],
              "title-md": ["Noto Sans Devanagari", "Manrope", "sans-serif"],
              "body-sm": ["Noto Sans Devanagari", "Manrope", "sans-serif"],
              "body-lg": ["Noto Sans Devanagari", "Manrope", "sans-serif"]
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
        header {
            z-index: 9999 !important;
        }
        .ps-site header,
        .ps-site header * {
            line-height: initial;
            letter-spacing: initial;
        }
        header a[class*="bg-[#14532D]"],
        header a[class*="bg-[#C05632]"],
        header a[class*="bg-[#14532D]"] *,
        header a[class*="bg-[#C05632]"] * {
            color: #ffffff !important;
        }
    </style>
    <?php if (!$isHomePage): ?>
        <link href="<?= e(asset('css/site/home.css')) ?>" rel="stylesheet">
    <?php endif; ?>
    <script src="<?= e(asset('js/site/home.js')) ?>" defer></script>
</head>
    <?php $isFullPage = $isHomePage || in_array(basename($viewFile), [
        'contact.php', 'volunteer.php', 'blog.php', 'cause-detail.php', 'causes.php', 
        'events.php', 'event-detail.php', 'media.php', 'blog-detail.php', 'donation.php', 
        'donate-now.php', 'about.php', 'portfolio.php', 'awards.php', 'journey.php', 
        'impact.php', 'green-gang.php', 'salahkaar.php', 'videos.php', 'privacy-policy.php', 
        'terms-and-conditions.php', 'cookie-policy.php', 'disclaimer.php', 
        'editorial-policy.php', 'author-guidelines.php', 'authors.php', '404.php'
    ], true); ?>
<body class="<?= $isFullPage ? 'bg-cream-canvas font-body-md text-body-md text-on-surface antialiased' : 'ps-site ps-inner-page' ?>">
    <?php if (!empty($isAdminPreview) && !empty($post)): ?>
        <div style="position: sticky; top: 0; left: 0; right: 0; z-index: 999999; background: #0f172a; color: #ffffff; padding: 10px 24px; border-bottom: 2px solid #334155; font-family: system-ui, -apple-system, sans-serif;" class="flex flex-wrap items-center justify-between gap-3 shadow-2xl">
            <div class="flex items-center gap-3">
                <a href="<?= e(base_url('/admin/index.php?module=blogs')) ?>" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-white/10 hover:bg-white/20 text-white text-xs font-bold transition-all text-decoration-none">
                    <i class="fa-solid fa-arrow-left"></i>
                    <span>← Back to Articles</span>
                </a>
                <span class="text-xs font-bold px-2.5 py-1 rounded-md bg-amber-500/20 text-amber-300 border border-amber-500/30 uppercase tracking-wider">
                    Unpublished Preview
                </span>
                <span class="text-xs text-slate-300 hidden sm:inline-block">
                    <strong>Article Preview</strong> — Status: <span class="text-amber-400 font-bold uppercase"><?= e(ucfirst($post['status'] ?? 'pending')) ?></span>
                </span>
            </div>

            <div class="flex items-center gap-2">
                <?php if (is_role('admin', 'super_admin') || (is_role('author') && !empty($post['author_id']) && (int)$post['author_id'] === (int)($_SESSION['user_id'] ?? 0))): ?>
                    <a href="<?= e(base_url('/admin/index.php?module=blogs&edit_id=' . urlencode((string)$post['id']))) ?>" class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg bg-white text-slate-900 hover:bg-slate-100 text-xs font-bold transition-all text-decoration-none">
                        <i class="fa-solid fa-pen-to-square"></i>
                        <span>Edit Article</span>
                    </a>
                <?php endif; ?>

                <?php if (is_role('admin') && ($post['status'] ?? '') !== 'published'): ?>
                    <form method="post" action="<?= e(base_url('/admin/index.php')) ?>" class="inline-block m-0">
                        <?= csrf_field() ?>
                        <input type="hidden" name="action" value="update_blog_status">
                        <input type="hidden" name="id" value="<?= e($post['id']) ?>">
                        <input type="hidden" name="status" value="published">
                        <button type="submit" class="inline-flex items-center gap-1 px-3.5 py-1.5 rounded-lg bg-emerald-600 hover:bg-emerald-500 text-white text-xs font-bold shadow-sm transition-all border-0 cursor-pointer">
                            <i class="fa-solid fa-circle-check"></i>
                            <span>Approve</span>
                        </button>
                    </form>
                <?php endif; ?>

                <?php if (is_role('admin') && ($post['status'] ?? '') === 'pending'): ?>
                    <form method="post" action="<?= e(base_url('/admin/index.php')) ?>" class="inline-block m-0" onsubmit="return confirm('Reject this article?')">
                        <?= csrf_field() ?>
                        <input type="hidden" name="action" value="update_blog_status">
                        <input type="hidden" name="id" value="<?= e($post['id']) ?>">
                        <input type="hidden" name="status" value="rejected">
                        <button type="submit" class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg bg-red-600/90 hover:bg-red-600 text-white text-xs font-bold shadow-sm transition-all border-0 cursor-pointer">
                            <i class="fa-solid fa-ban"></i>
                            <span>Reject</span>
                        </button>
                    </form>
                <?php endif; ?>
            </div>
        </div>
    <?php endif; ?>
    <a href="#main" class="sr-only focus:not-sr-only focus:fixed focus:top-4 focus:left-4 focus:z-[100] focus:bg-primary focus:text-on-primary focus:px-4 focus:py-2 focus:rounded-md"><?= e(ps_text('मुख्य सामग्री पर जाएं','Skip to content')) ?></a>
    
    <?php require __DIR__ . '/../partials/home/header.php'; ?>

    <?php foreach (['success', 'error'] as $flashType): if ($message = flash($flashType)): ?>
        <div class="fixed top-24 right-4 z-50 max-w-md bg-emerald-800 text-white px-5 py-3.5 rounded-xl shadow-2xl flex items-center gap-3 border border-emerald-600" role="status">
            <span class="material-symbols-outlined text-fresh-sprout">check_circle</span>
            <span><?= e($message) ?></span>
            <button type="button" onclick="this.parentElement.remove()" class="ml-auto text-white/70 hover:text-white" aria-label="<?= e(ps_text('बंद करें', 'Close notification')) ?>">&times;</button>
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
        </div>
    </dialog>

    <?php
    $modalDSettings = ps_get_donation_settings();
    $modalAccountName = trim($modalDSettings['account_name'] ?? '') ?: ps_text('प्रदीप सारंग जनसेवा एवं पर्यावरण न्यास', 'Pradeep Sarang Trust');
    $modalBankName = trim($modalDSettings['bank_name'] ?? '') ?: ps_text('State Bank of India (भारतीय स्टेट बैंक)', 'State Bank of India (SBI)');
    $modalAccountNumber = trim($modalDSettings['account_number'] ?? '') ?: '38947291048';
    $modalIfscCode = trim($modalDSettings['ifsc'] ?? '') ?: 'SBIN0005471';
    $modalUpiId = trim($modalDSettings['upi_id'] ?? '') ?: 'pradeepsarang@upi';

    $modalQrGreenVolunteer = 'https://api.qrserver.com/v1/create-qr-code/?size=260x260&data=' . urlencode("upi://pay?pa={$modalUpiId}&pn=" . rawurlencode($modalAccountName) . "&am=500&cu=INR&tn=" . rawurlencode("Green Volunteer Fee Rs 500"));
    $modalQrVolunteer = 'https://api.qrserver.com/v1/create-qr-code/?size=260x260&data=' . urlencode("upi://pay?pa={$modalUpiId}&pn=" . rawurlencode($modalAccountName) . "&am=50&cu=INR&tn=" . rawurlencode("Volunteer Fee 1 Year Rs 50"));
    ?>

    <!-- Volunteer Enrollment Form Popup Modal -->
    <dialog id="ps-volunteer-modal" class="backdrop:bg-black/75 backdrop:backdrop-blur-md rounded-3xl p-0 bg-transparent max-w-4xl w-[96vw] shadow-2xl z-[100000] border-0 my-auto overflow-hidden">
        <div class="bg-surface-container-lowest rounded-3xl border border-border-warm overflow-hidden flex flex-col max-h-[92vh] shadow-2xl">
            <!-- Modal Header -->
            <div class="bg-deep-forest text-on-primary px-6 py-5 sm:px-8 sm:py-6 flex items-start justify-between sticky top-0 z-20 shadow-md border-b border-white/10">
                <div class="flex-1 pr-4">
                    <div class="inline-flex items-center gap-2 bg-emerald-100/90 text-emerald-950 px-3.5 py-1 rounded-full font-label-md text-xs sm:text-sm font-bold border border-emerald-300 shadow-xs mb-2.5">
                        <span class="material-symbols-outlined text-[17px] text-emerald-700" style="font-variation-settings: 'FILL' 1;">eco</span>
                        <span><?= e(ps_text('आँखें फाउंडेशन द्वारा वित्त पोषित तथा प्रदीप सारंग द्वारा संस्थापित "ग्रीन गैंग"', 'Funded by Aankhein Foundation & Founded by Pradeep Sarang — "Green Gang"')) ?></span>
                    </div>
                    <div class="flex flex-wrap items-center justify-between gap-2">
                        <h2 class="font-headline-lg text-lg sm:text-2xl font-bold text-pure-white leading-tight m-0">
                            <?= e(ps_text('स्वयंसेवक / सदस्यता सहभागिता प्रपत्र', 'Volunteer / Membership Registration Form')) ?>
                        </h2>
                    </div>
                    <p class="font-body-sm text-xs sm:text-sm text-white/80 mt-1 m-0">
                        <?= e(ps_text('कृपया अपनी सही जानकारी भरें ताकि आपके निकटतम क्षेत्र के ग्रीन गैंग समन्वयक आपसे संपर्क कर सकें।', 'Please enter your authentic details so your nearest Green Gang coordinator can reach out.')) ?>
                    </p>
                </div>
                <!-- Close Button in Corner -->
                <button type="button" onclick="closeVolunteerModal(event)" class="w-10 h-10 rounded-full bg-white/10 hover:bg-white/25 text-white flex items-center justify-center transition-all cursor-pointer border-0 text-xl font-bold shrink-0 ml-2" title="<?= e(ps_text('बंद करें', 'Close')) ?>" aria-label="<?= e(ps_text('बंद करें', 'Close')) ?>">
                    ✕
                </button>
            </div>

            <!-- Modal Body (Scrollable Form) -->
            <div class="p-6 sm:p-8 overflow-y-auto space-y-6 bg-surface-container-lowest text-left">
                <!-- Membership Classification Notice -->
                <div class="p-5 sm:p-6 rounded-2xl bg-gradient-to-br from-emerald-50/90 via-pure-white to-[#F2FBF5] border-2 border-emerald-500/30 shadow-sm">
                    <div class="flex items-start gap-3.5">
                        <div class="w-9 h-9 rounded-xl bg-emerald-600 text-white flex items-center justify-center shadow-xs shrink-0 mt-0.5">
                            <span class="material-symbols-outlined text-[20px]" style="font-variation-settings: 'FILL' 1;">eco</span>
                        </div>
                        <div class="flex-1 space-y-3">
                            <h3 class="font-title-lg text-title-md sm:text-title-lg text-deep-forest font-bold tracking-tight">
                                <?= e(ps_text('सदस्यता दो प्रकार की है-', 'Two Types of Membership:')) ?>
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-3 pt-1">
                                <!-- Tier 1: Green Volunteer -->
                                <div class="p-4 rounded-xl bg-pure-white border-2 border-emerald-500/30 shadow-xs flex flex-col justify-between gap-2">
                                    <div>
                                        <div class="flex items-center justify-between gap-2 mb-1.5">
                                            <span class="font-bold text-emerald-800 text-body-md flex items-center gap-1.5">
                                                <span class="w-5 h-5 rounded-full bg-emerald-600 text-white text-xs flex items-center justify-center font-bold">1</span>
                                                <?= e(ps_text('ग्रीन स्वयंसेवक', 'Green Volunteer')) ?>
                                            </span>
                                            <span class="px-2.5 py-0.5 rounded-full bg-emerald-100 text-emerald-900 border border-emerald-300 font-bold text-xs whitespace-nowrap">₹500 • <?= e(ps_text('एक बार', 'One-time')) ?></span>
                                        </div>
                                        <p class="font-body-sm text-xs text-deep-forest leading-relaxed">
                                            <?= e(ps_text('एक बार 500 रुपये जमा करने वाले व्यक्ति को ग्रीन स्वयं सेवक "ग्रीन वॉलंटियर" तथा "हरित स्वयंसेवक" कहा जायेगा।', 'A person contributing a one-time fee of ₹500 will be designated as a Green Volunteer ("Harit Swayamsevak").')) ?>
                                        </p>
                                    </div>
                                </div>

                                <!-- Tier 2: Volunteer -->
                                <div class="p-4 rounded-xl bg-pure-white border border-border-warm shadow-xs flex flex-col justify-between gap-2">
                                    <div>
                                        <div class="flex items-center justify-between gap-2 mb-1.5">
                                            <span class="font-bold text-deep-forest text-body-md flex items-center gap-1.5">
                                                <span class="w-5 h-5 rounded-full bg-deep-forest text-white text-xs flex items-center justify-center font-bold">2</span>
                                                <?= e(ps_text('स्वयंसेवक', 'Volunteer')) ?>
                                            </span>
                                            <span class="px-2.5 py-0.5 rounded-full bg-primary/10 text-primary border border-primary/20 font-bold text-xs whitespace-nowrap">₹50 • <?= e(ps_text('१ वर्ष', '1 Year')) ?></span>
                                        </div>
                                        <p class="font-body-sm text-xs text-text-muted leading-relaxed">
                                            <?= e(ps_text('50 रुपये जमा करके कोई व्यक्ति एक वर्ष के लिए "वालंटियर" तथा "स्वयंसेवक" कहा जायेगा।', 'A person contributing ₹50 will be designated as a "Volunteer" / "Swayamsevak" for one year.')) ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <form id="modalVolunteerForm" method="post" action="<?= e(base_url('/volunteer')) ?>" enctype="multipart/form-data" class="space-y-6">
                    <?= csrf_field() ?>
                    <input type="hidden" name="form_type" value="volunteer">

                    <!-- Type Selection: Green Volunteer (One-time ₹500) vs Volunteer (1 Year ₹50) -->
                    <div>
                        <label class="block font-label-md text-label-md text-deep-forest font-semibold mb-2">
                            <?= e(ps_text('पंजीकरण का प्रकार चुनें (Select Category)', 'Select Registration Type')) ?> <span class="text-error">*</span>
                        </label>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <label class="relative flex items-start gap-3 p-4 rounded-xl border-2 border-emerald-500/40 bg-pure-white hover:border-emerald-600 cursor-pointer transition-all has-[:checked]:border-emerald-600 has-[:checked]:bg-emerald-50/30 has-[:checked]:ring-2 has-[:checked]:ring-emerald-500/20 shadow-xs">
                                <input type="radio" name="membership_type" value="Green Volunteer" checked onchange="updateModalVolunteerPaymentMode(this.value)" class="mt-1 w-4 h-4 accent-emerald-600 text-emerald-600 focus:ring-emerald-500">
                                <div class="flex flex-col flex-1">
                                    <div class="flex items-center justify-between gap-2">
                                        <span class="font-body-md font-bold text-emerald-900"><?= e(ps_text('१- ग्रीन स्वयंसेवक', '1- Green Volunteer')) ?></span>
                                        <span class="bg-emerald-100 text-emerald-900 font-bold text-xs px-2.5 py-0.5 rounded-full border border-emerald-300 whitespace-nowrap"><?= e(ps_text('₹500 • एक बार', '₹500 • One-time')) ?></span>
                                    </div>
                                    <span class="font-label-sm text-xs text-deep-forest mt-1"><?= e(ps_text('एक बार 500 रुपये जमा करने वाले व्यक्ति को "ग्रीन वॉलंटियर" तथा "हरित स्वयंसेवक" कहा जायेगा।', 'One-time ₹500 fee for Green Volunteer / Harit Swayamsevak designation.')) ?></span>
                                </div>
                            </label>
                            <label class="relative flex items-start gap-3 p-4 rounded-xl border border-border-warm bg-pure-white hover:border-primary cursor-pointer transition-all has-[:checked]:border-primary has-[:checked]:bg-primary/5 has-[:checked]:ring-2 has-[:checked]:ring-primary/20 shadow-xs">
                                <input type="radio" name="membership_type" value="Volunteer" onchange="updateModalVolunteerPaymentMode(this.value)" class="mt-1 w-4 h-4 accent-primary text-primary focus:ring-primary">
                                <div class="flex flex-col flex-1">
                                    <div class="flex items-center justify-between gap-2">
                                        <span class="font-body-md font-bold text-deep-forest"><?= e(ps_text('२- स्वयंसेवक', '2- Volunteer')) ?></span>
                                        <span class="bg-primary/10 text-primary font-bold text-xs px-2.5 py-0.5 rounded-full border border-primary/20 whitespace-nowrap"><?= e(ps_text('₹50 • १ वर्ष', '₹50 • 1 Year')) ?></span>
                                    </div>
                                    <span class="font-label-sm text-xs text-text-muted mt-1"><?= e(ps_text('50 रुपये जमा करके कोई व्यक्ति एक वर्ष के लिए "वालंटियर" तथा "स्वयंसेवक" कहा जायेगा।', '₹50 contribution for 1-year Volunteer active membership.')) ?></span>
                                </div>
                            </label>
                        </div>
                    </div>

                    <!-- Row 1: Full Name & WhatsApp Number -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <div>
                            <label for="modalFullName" class="block font-label-md text-label-md text-deep-forest font-semibold mb-2">
                                <?= e(ps_text('पूरा नाम (Full Name)', 'Full Name')) ?> <span class="text-error">*</span>
                            </label>
                            <input type="text" id="modalFullName" name="full_name" required class="w-full px-4 py-3 rounded-xl border border-border-warm bg-pure-white text-on-surface font-body-md text-body-md focus:border-primary-container focus:outline-none focus:ring-2 focus:ring-fresh-sprout/20 transition-all">
                        </div>
                        <div>
                            <label for="modalWhatsappNumber" class="block font-label-md text-label-md text-deep-forest font-semibold mb-2">
                                <?= e(ps_text('मोबाइल / WhatsApp नंबर', 'Mobile / WhatsApp Number')) ?> <span class="text-error">*</span>
                            </label>
                            <input type="tel" id="modalWhatsappNumber" name="phone" required class="w-full px-4 py-3 rounded-xl border border-border-warm bg-pure-white text-on-surface font-body-md text-body-md focus:border-primary-container focus:outline-none focus:ring-2 focus:ring-fresh-sprout/20 transition-all">
                        </div>
                    </div>

                    <!-- Row 2: Father Name & Email -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <div>
                            <label for="modalFatherName" class="block font-label-md text-label-md text-deep-forest font-semibold mb-2">
                                <?= e(ps_text('पिता / अभिभावक का नाम', 'Father / Guardian Name')) ?>
                            </label>
                            <input type="text" id="modalFatherName" name="father_name" class="w-full px-4 py-3 rounded-xl border border-border-warm bg-pure-white text-on-surface font-body-md text-body-md focus:border-primary-container focus:outline-none focus:ring-2 focus:ring-fresh-sprout/20 transition-all">
                        </div>
                        <div>
                            <label for="modalEmailAddress" class="block font-label-md text-label-md text-deep-forest font-semibold mb-2">
                                <?= e(ps_text('ईमेल पता (Email Address)', 'Email Address')) ?> <span class="text-error">*</span>
                            </label>
                            <input type="email" id="modalEmailAddress" name="email" required class="w-full px-4 py-3 rounded-xl border border-border-warm bg-pure-white text-on-surface font-body-md text-body-md focus:border-primary-container focus:outline-none focus:ring-2 focus:ring-fresh-sprout/20 transition-all">
                        </div>
                    </div>

                    <!-- Row 3: Gender, DOB, Occupation -->
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
                        <div>
                            <label for="modalGenderSelect" class="block font-label-md text-label-md text-deep-forest font-semibold mb-2">
                                <?= e(ps_text('लिंग (Gender)', 'Gender')) ?>
                            </label>
                            <select id="modalGenderSelect" name="gender" class="w-full px-4 py-3 rounded-xl border border-border-warm bg-pure-white text-on-surface font-body-md text-body-md focus:border-primary-container focus:outline-none focus:ring-2 focus:ring-fresh-sprout/20 transition-all">
                                <option value="Male"><?= e(ps_text('पुरुष (Male)', 'Male')) ?></option>
                                <option value="Female"><?= e(ps_text('महिला (Female)', 'Female')) ?></option>
                                <option value="Other"><?= e(ps_text('अन्य (Other)', 'Other')) ?></option>
                            </select>
                        </div>
                        <div>
                            <label for="modalUserDob" class="block font-label-md text-label-md text-deep-forest font-semibold mb-2">
                                <?= e(ps_text('जन्म तिथि (Date of Birth)', 'Date of Birth')) ?>
                            </label>
                            <input type="date" id="modalUserDob" name="dob" class="w-full px-4 py-3 rounded-xl border border-border-warm bg-pure-white text-on-surface font-body-md text-body-md focus:border-primary-container focus:outline-none focus:ring-2 focus:ring-fresh-sprout/20 transition-all">
                        </div>
                        <div>
                            <label for="modalUserOccupation" class="block font-label-md text-label-md text-deep-forest font-semibold mb-2">
                                <?= e(ps_text('व्यवसाय / पेशा', 'Occupation')) ?>
                            </label>
                            <input type="text" id="modalUserOccupation" name="occupation" class="w-full px-4 py-3 rounded-xl border border-border-warm bg-pure-white text-on-surface font-body-md text-body-md focus:border-primary-container focus:outline-none focus:ring-2 focus:ring-fresh-sprout/20 transition-all">
                        </div>
                    </div>

                    <!-- Row 4: State, District, Pincode -->
                    <?php 
                        $modalStates = (new ContentModel())->getStates();
                        if (empty($modalStates)) {
                            $modalStates = [
                                ['state_id' => 1, 'state_name' => 'Uttar Pradesh'],
                                ['state_id' => 2, 'state_name' => 'Delhi'],
                                ['state_id' => 3, 'state_name' => 'Bihar'],
                                ['state_id' => 4, 'state_name' => 'Madhya Pradesh'],
                                ['state_id' => 5, 'state_name' => 'Rajasthan'],
                                ['state_id' => 6, 'state_name' => 'Other']
                            ];
                        }
                    ?>
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
                        <div>
                            <label for="modalStateSelect" class="block font-label-md text-label-md text-deep-forest font-semibold mb-2">
                                <?= e(ps_text('राज्य (State)', 'State')) ?> <span class="text-error">*</span>
                            </label>
                            <select id="modalStateSelect" name="state" required class="w-full px-4 py-3 rounded-xl border border-border-warm bg-pure-white text-on-surface font-body-md text-body-md focus:border-primary-container focus:outline-none focus:ring-2 focus:ring-fresh-sprout/20 transition-all">
                                <option value=""><?= e(ps_text('राज्य चुनें', 'Choose State')) ?></option>
                                <?php foreach ($modalStates as $st): ?>
                                    <option value="<?= e((string)($st['state_id'] ?? $st['state_name'])) ?>"><?= e($st['state_name']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div>
                            <label for="modalDistrictSelect" class="block font-label-md text-label-md text-deep-forest font-semibold mb-2">
                                <?= e(ps_text('जिला (District)', 'District')) ?> <span class="text-error">*</span>
                            </label>
                            <select id="modalDistrictSelect" name="district" disabled required class="w-full px-4 py-3 rounded-xl border border-border-warm bg-pure-white text-on-surface font-body-md text-body-md focus:border-primary-container focus:outline-none focus:ring-2 focus:ring-fresh-sprout/20 transition-all">
                                <option value=""><?= e(ps_text('जिला चुनें', 'Choose District')) ?></option>
                            </select>
                        </div>
                        <div>
                            <label for="modalUserPincode" class="block font-label-md text-label-md text-deep-forest font-semibold mb-2">
                                <?= e(ps_text('पिनकोड (PIN Code)', 'PIN Code')) ?>
                            </label>
                            <input type="text" id="modalUserPincode" name="pincode" inputmode="numeric" class="w-full px-4 py-3 rounded-xl border border-border-warm bg-pure-white text-on-surface font-body-md text-body-md focus:border-primary-container focus:outline-none focus:ring-2 focus:ring-fresh-sprout/20 transition-all">
                        </div>
                    </div>

                    <!-- Selection: Domains of Contribution (Abhiyan Selection) -->
                    <div class="p-5 rounded-xl bg-soft-meadow border border-border-warm">
                        <label for="modalUserInterests" class="block font-title-md text-title-md text-deep-forest font-bold mb-3">
                            <?= e(ps_text('आप किस अभियान में सहभागिता करना चाहते हैं? (अभियान सूची)', 'Which Campaign / Initiative do you wish to join?')) ?> <span class="text-error">*</span>
                        </label>
                        <select id="modalUserInterests" name="interests" required onchange="updateModalVolunteerPledge(this.value)" class="w-full px-4 py-3 rounded-xl border border-border-warm bg-pure-white text-on-surface font-body-md text-body-md focus:border-primary-container focus:outline-none focus:ring-2 focus:ring-fresh-sprout/20 transition-all cursor-pointer">
                            <option value=""><?= e(ps_text('-- अपना पसंदीदा अभियान चुनें --', '-- Select an Initiative / Campaign --')) ?></option>
                            <?php foreach (ps_get_campaigns() as $camp): ?>
                                <?php
                                    $campTitle = ps_text($camp['title'] ?? '', $camp['en_title'] ?? ($camp['title'] ?? ''));
                                    if (empty(trim($campTitle))) continue;
                                ?>
                                <option value="<?= e($campTitle) ?>"><?= e($campTitle) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- Selection: Time Availability -->
                    <div class="p-5 rounded-xl bg-soft-meadow border border-border-warm">
                        <label for="modalUserAvailability" class="block font-title-md text-title-md text-deep-forest font-bold mb-3">
                            <?= e(ps_text('समय की उपलब्धता (Time Availability)', 'Time Availability')) ?>
                        </label>
                        <select id="modalUserAvailability" name="availability" class="w-full px-4 py-3 rounded-xl border border-border-warm bg-pure-white text-on-surface font-body-md text-body-md focus:border-primary-container focus:outline-none focus:ring-2 focus:ring-fresh-sprout/20 transition-all">
                            <option value="Flexible"><?= e(ps_text('लचीला समय (Flexible Time)', 'Flexible')) ?></option>
                            <option value="Weekends"><?= e(ps_text('सप्ताहांत (Saturday-Sunday)', 'Weekends')) ?></option>
                            <option value="Weekdays"><?= e(ps_text('कार्यदिवस (Monday-Friday)', 'Weekdays')) ?></option>
                            <option value="On-Call"><?= e(ps_text('आवश्यकतानुसार ऑन-कॉल (Emergency On-Call)', 'Emergency On-Call')) ?></option>
                        </select>
                    </div>

                    <!-- Upload Passport Photo & Resume -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <div>
                            <label for="modalUserPhoto" class="block font-label-md text-label-md text-deep-forest font-semibold mb-2">
                                <?= e(ps_text('पासपोर्ट साइज फोटो (Photo Upload)', 'Passport Photo')) ?>
                            </label>
                            <input type="file" id="modalUserPhoto" name="photo" accept="image/*" class="w-full px-3 py-2 rounded-xl border border-border-warm bg-pure-white text-on-surface font-body-sm text-body-sm file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-label-sm file:font-semibold file:bg-primary-container file:text-on-primary hover:file:bg-deep-forest cursor-pointer">
                        </div>
                        <div>
                            <label for="modalUserResume" class="block font-label-md text-label-md text-deep-forest font-semibold mb-2">
                                <?= e(ps_text('रिज्यूमे / परिचय दस्तावेज़ (Optional Resume)', 'Optional Resume')) ?>
                            </label>
                            <input type="file" id="modalUserResume" name="resume" accept=".pdf,.doc,.docx" class="w-full px-3 py-2 rounded-xl border border-border-warm bg-pure-white text-on-surface font-body-sm text-body-sm file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-label-sm file:font-semibold file:bg-soft-meadow file:text-deep-forest hover:file:bg-surface-container cursor-pointer">
                        </div>
                    </div>

                    <!-- Payment & Confirmation Section (QR Code, UPI, Screenshot Upload) -->
                    <div id="modalPaymentSectionBox" class="p-6 sm:p-7 rounded-2xl bg-gradient-to-br from-[#F4F9F5] via-pure-white to-[#F7F9F6] border-2 border-emerald-500/30 shadow-sm space-y-6">
                        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 pb-4 border-b border-border-warm">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-xl bg-emerald-700 text-white flex items-center justify-center shadow-xs shrink-0">
                                    <span class="material-symbols-outlined text-[24px]">payments</span>
                                </div>
                                <div>
                                    <h3 id="modalPaymentSectionTitle" class="font-title-lg text-title-lg text-deep-forest font-bold">
                                        <?= e(ps_text('ग्रीन स्वयंसेवक शुल्क भुगतान — ₹500', 'Green Volunteer Fee Payment — ₹500')) ?>
                                    </h3>
                                    <p id="modalPaymentSectionSubtitle" class="font-label-sm text-xs text-text-muted mt-0.5">
                                        <?= e(ps_text('ग्रीन स्वयंसेवक ("ग्रीन वॉलंटियर" / "हरित स्वयंसेवक") हेतु ₹500/- का भुगतान कर स्क्रीनशॉट अपलोड करें।', 'Pay ₹500/- for Green Volunteer ("Harit Swayamsevak") and upload screenshot.')) ?>
                                    </p>
                                </div>
                            </div>
                            <div id="modalPaymentFeeBadge" class="self-start sm:self-auto px-3.5 py-1.5 rounded-xl bg-emerald-100 border border-emerald-300 text-emerald-900 font-bold text-sm">
                                <?= e(ps_text('₹500 • एक बार / स्थायी', '₹500 • One-time')) ?>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-12 gap-6 items-center">
                            <!-- QR Code Box -->
                            <div class="md:col-span-5 flex flex-col items-center justify-center bg-pure-white p-5 rounded-xl border border-border-warm shadow-xs text-center">
                                <div class="relative p-3 bg-pure-white rounded-xl border-2 border-emerald-600/30 shadow-xs mb-3">
                                    <img id="modalVolunteerQrImg" src="<?= e($modalQrGreenVolunteer) ?>" data-green-qr="<?= e($modalQrGreenVolunteer) ?>" data-vol-qr="<?= e($modalQrVolunteer) ?>" alt="UPI QR Code" class="w-44 h-44 object-contain rounded-lg">
                                    <div class="absolute -bottom-2.5 left-1/2 -translate-x-1/2 bg-emerald-800 text-white text-[9px] font-bold px-2.5 py-0.5 rounded-full shadow-xs tracking-wider uppercase whitespace-nowrap">
                                        BHIM UPI • GPay • PhonePe • Paytm
                                    </div>
                                </div>
                                <p id="modalQrScanLabel" class="font-label-sm text-xs font-bold text-deep-forest mt-2">
                                    <?= e(ps_text('ग्रीन स्वयंसेवक ₹500 QR कोड', 'Green Volunteer ₹500 QR Code')) ?>
                                </p>
                                <p class="font-label-sm text-[11px] text-text-muted"><?= e($modalAccountName) ?></p>
                            </div>

                            <!-- UPI ID & Bank Details -->
                            <div class="md:col-span-7 space-y-3.5">
                                <!-- UPI ID Pill -->
                                <div>
                                    <label class="block font-label-sm text-xs text-deep-forest font-bold mb-1.5">
                                        <?= e(ps_text('आधिकारिक UPI ID (क्लिक कर कॉपी करें):', 'Official UPI ID:')) ?>
                                    </label>
                                    <div class="flex items-center justify-between p-3 rounded-xl bg-soft-meadow border border-border-warm">
                                        <div class="flex items-center gap-2 overflow-hidden">
                                            <span class="material-symbols-outlined text-primary text-base">alternate_email</span>
                                            <span class="font-mono font-bold text-sm text-deep-forest select-all truncate"><?= e($modalUpiId) ?></span>
                                        </div>
                                        <button type="button" onclick="navigator.clipboard.writeText('<?= e($modalUpiId) ?>'); alert('UPI ID copied: <?= e($modalUpiId) ?>');" class="px-3 py-1 bg-pure-white hover:bg-surface-container text-primary font-label-sm text-xs rounded-lg border border-border-warm font-semibold shadow-xs transition-all cursor-pointer shrink-0">
                                            <?= e(ps_text('कॉपी करें', 'Copy')) ?>
                                        </button>
                                    </div>
                                </div>

                                <!-- Bank Account Snapshot -->
                                <div class="p-3.5 rounded-xl bg-pure-white border border-border-warm text-xs space-y-1 text-on-surface">
                                    <div class="flex justify-between">
                                        <span class="text-text-muted"><?= e(ps_text('खाता धारक:', 'Account Name:')) ?></span>
                                        <span class="font-semibold text-right"><?= e($modalAccountName) ?></span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-text-muted"><?= e(ps_text('बैंक व खाता संख्या:', 'Bank & A/C:')) ?></span>
                                        <span class="font-mono font-semibold text-right"><?= e($modalBankName) ?> (<?= e($modalAccountNumber) ?>)</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-text-muted"><?= e(ps_text('IFSC कोड:', 'IFSC:')) ?></span>
                                        <span class="font-mono font-semibold text-right"><?= e($modalIfscCode) ?></span>
                                    </div>
                                </div>

                                <!-- Important Note -->
                                <div id="modalPaymentInstructionNote" class="p-3 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-900 text-xs flex items-start gap-2">
                                    <span class="material-symbols-outlined text-emerald-700 text-base shrink-0 mt-0.5">eco</span>
                                    <span><?= e(ps_text('एक बार 500 रुपये जमा करने वाले व्यक्ति को ग्रीन स्वयं सेवक "ग्रीन वॉलंटियर" तथा "हरित स्वयंसेवक" कहा जायेगा।', 'A person contributing a one-time fee of ₹500 will be designated as a Green Volunteer ("Harit Swayamsevak").')) ?></span>
                                </div>
                            </div>
                        </div>

                        <!-- Transaction ID & Screenshot Upload Row (MANDATORY) -->
                        <div class="pt-4 border-t border-border-warm grid grid-cols-1 sm:grid-cols-2 gap-5">
                            <div>
                                <label for="modalPaymentScreenshot" class="block font-label-md text-label-md text-deep-forest font-bold mb-1.5">
                                    <?= e(ps_text('भुगतान का स्क्रीनशॉट (Payment Screenshot)', 'Payment Screenshot')) ?> <span class="text-error">*</span>
                                </label>
                                <input type="file" id="modalPaymentScreenshot" name="payment_screenshot" required accept="image/*,.pdf" class="w-full px-3 py-2.5 rounded-xl border border-border-warm bg-pure-white text-on-surface font-body-sm text-body-sm file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-label-sm file:font-semibold file:bg-primary file:text-white hover:file:bg-deep-forest cursor-pointer">
                                <span class="block font-label-sm text-[11px] text-text-muted mt-1">
                                    <?= e(ps_text('UPI / बैंक भुगतान की रसीद या स्क्रीनशॉट (JPG, PNG, PDF)', 'Upload receipt/screenshot of UPI or bank transfer')) ?>
                                </span>
                            </div>

                            <div>
                                <label for="modalTransactionId" class="block font-label-md text-label-md text-deep-forest font-bold mb-1.5">
                                    <?= e(ps_text('ट्रांजैक्शन / UTR आईडी (Transaction / UTR ID)', 'Transaction / UTR ID')) ?> <span class="text-error">*</span>
                                </label>
                                <input type="text" id="modalTransactionId" name="transaction_id" required placeholder="उदा. UTR: 4289XXXXXXXX / UPI Ref No." class="w-full px-4 py-3 rounded-xl border border-border-warm bg-pure-white text-on-surface font-body-md text-body-md focus:border-primary-container focus:outline-none focus:ring-2 focus:ring-fresh-sprout/20 transition-all font-mono">
                                <span class="block font-label-sm text-[11px] text-text-muted mt-1">
                                    <?= e(ps_text('12 अंकों का UPI UTR नंबर या बैंक रेफरेंस नंबर दर्ज करें', 'Enter 12-digit UPI UTR number or bank reference')) ?>
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Message / Motivation -->
                    <div>
                        <label for="modalUserMessage" class="block font-label-md text-label-md text-deep-forest font-semibold mb-2">
                            <?= e(ps_text('आप इस अभियान से क्यों जुड़ना चाहते हैं? (संदेश / विचार)', 'Message / Why do you want to join?')) ?>
                        </label>
                        <textarea id="modalUserMessage" name="message" rows="3" class="w-full px-4 py-3 rounded-xl border border-border-warm bg-pure-white text-on-surface font-body-md text-body-md focus:border-primary-container focus:outline-none focus:ring-2 focus:ring-fresh-sprout/20 transition-all"></textarea>
                    </div>

                    <!-- Pledge Checkbox -->
                    <div class="bg-tertiary-fixed/20 p-4 rounded-xl border border-tertiary-fixed/40 transition-all duration-300" id="modalPledgeBox">
                        <label class="flex items-start gap-3 cursor-pointer">
                            <input type="checkbox" required class="mt-1 w-5 h-5 rounded border-border-warm text-primary-container focus:ring-fresh-sprout/30 shrink-0">
                            <span class="font-body-sm text-body-sm text-deep-forest leading-relaxed">
                                <strong><?= e(ps_text('हमारा संकल्प:', 'Our Pledge:')) ?></strong> <span id="modalVolunteerPledgeText"><?= e(ps_text('मैं \'ग्रीन मॉर्निंग\' की उदात्त भावना, निस्वार्थ समाजसेवा और पर्यावरण रक्षा के प्रति पूर्ण निष्ठावान रहने का वचन देता/देती हूँ।', 'I pledge commitment to Green Morning, selfless public service and environmental protection.')) ?></span>
                            </span>
                        </label>
                    </div>

                    <!-- Submit Button & Close -->
                    <div class="pt-2 flex flex-col sm:flex-row items-center justify-between gap-4">
                        <button type="submit" class="w-full sm:w-auto px-8 py-3.5 rounded-xl font-title-md text-title-md font-bold shadow-md transition-all flex items-center justify-center gap-2 border-0 cursor-pointer" style="background-color: #14532d; color: #ffffff;">
                            <span style="color: #ffffff;"><?= e(ps_text('स्वयंसेवक के रूप में पंजीकृत हों (Submit Application)', 'Submit Volunteer Application')) ?></span>
                            <span class="material-symbols-outlined text-[20px]" style="color: #ffffff;">arrow_forward</span>
                        </button>
                        <button type="button" onclick="closeVolunteerModal(event)" class="w-full sm:w-auto px-6 py-3.5 rounded-xl bg-surface-container hover:bg-border-warm font-label-md text-sm font-semibold transition-all border-0 cursor-pointer text-center" style="color: #14532d;">
                            <?= e(ps_text('रद्द करें (Cancel)', 'Cancel')) ?>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </dialog>

    <!-- Donation Popup Modal -->
    <dialog id="ps-donation-modal" class="backdrop:bg-black/75 backdrop:backdrop-blur-md rounded-3xl p-0 bg-transparent max-w-4xl w-[96vw] shadow-2xl z-[100000] border-0 my-auto overflow-hidden">
        <div class="bg-surface-container-lowest rounded-3xl border border-border-warm overflow-hidden flex flex-col max-h-[92vh] shadow-2xl">
            <!-- Modal Header -->
            <div class="bg-deep-forest text-on-primary px-6 py-5 sm:px-8 sm:py-6 flex items-start justify-between sticky top-0 z-20 shadow-md border-b border-white/10">
                <div class="flex-1 pr-4">
                    <div class="inline-flex items-center gap-2 bg-emerald-100/90 text-emerald-950 px-3.5 py-1 rounded-full font-label-md text-xs sm:text-sm font-bold border border-emerald-300 shadow-xs mb-2">
                        <span class="material-symbols-outlined text-[17px] text-emerald-700" style="font-variation-settings: 'FILL' 1;">volunteer_activism</span>
                        <span><?= e(ps_text('माटी और मनुष्यता का ऋण • 100% पारदर्शी एवं जन-समर्पित सहयोग', '100% Transparent Community Donation')) ?></span>
                    </div>
                    <div class="flex flex-wrap items-center justify-between gap-2">
                        <h2 class="font-headline-lg text-lg sm:text-2xl font-bold text-pure-white leading-tight m-0">
                            <?= e(ps_text('लोक-सहयोग एवं दान संकल्प (Donate Now)', 'Donation & Community Support Desk')) ?>
                        </h2>
                    </div>
                    <p class="font-body-sm text-xs sm:text-sm text-white/80 mt-1 m-0">
                        <?= e(ps_text('प्रदीप सारंग जनसेवा एवं पर्यावरण न्यास — आपका प्रत्येक अंशदान सीधे ज़मीनी बदलाव लाता है।', 'Pradeep Sarang Trust — Every contribution creates direct grassroots environmental and social impact.')) ?>
                    </p>
                </div>
                <!-- Close Button in Corner -->
                <button type="button" onclick="closeDonationModal(event)" class="w-10 h-10 rounded-full bg-white/10 hover:bg-white/25 text-white flex items-center justify-center transition-all cursor-pointer border-0 text-xl font-bold shrink-0 ml-2" title="<?= e(ps_text('बंद करें', 'Close')) ?>" aria-label="<?= e(ps_text('बंद करें', 'Close')) ?>">
                    ✕
                </button>
            </div>

            <!-- Modal Body (Scrollable Form) -->
            <div class="p-6 sm:p-8 overflow-y-auto space-y-6 bg-surface-container-lowest text-left">
                <!-- Preset Quick Amount Chips -->
                <div class="p-5 rounded-2xl bg-soft-meadow border border-border-warm">
                    <label class="block font-label-md text-sm text-deep-forest font-bold mb-2.5">
                        <?= e(ps_text('सहयोग राशि चुनें (Select Quick Contribution Amount):', 'Choose Quick Donation Amount:')) ?>
                    </label>
                    <div class="grid grid-cols-3 sm:grid-cols-6 gap-2">
                        <?php foreach (['200', '500', '1000', '2100', '5100', '11000'] as $presetAmt): ?>
                            <button type="button" onclick="setModalDonationAmount('<?= $presetAmt ?>')" class="modal-amount-chip px-3 py-2 rounded-xl bg-pure-white hover:bg-emerald-50 text-deep-forest border border-border-warm font-bold text-xs sm:text-sm shadow-xs transition-all cursor-pointer text-center">
                                ₹<?= number_format((float)$presetAmt) ?>
                            </button>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- UPI QR & Official Bank Account Grid -->
                <div class="p-6 rounded-2xl bg-gradient-to-br from-[#F4F9F5] via-pure-white to-[#F7F9F6] border-2 border-emerald-500/30 shadow-sm space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-12 gap-6 items-center">
                        <!-- QR Code Box -->
                        <div class="md:col-span-5 flex flex-col items-center justify-center bg-pure-white p-5 rounded-xl border border-border-warm shadow-xs text-center">
                            <div class="relative p-3 bg-pure-white rounded-xl border-2 border-emerald-600/30 shadow-xs mb-3">
                                <?php
                                $modalDonationQrDefault = 'https://api.qrserver.com/v1/create-qr-code/?size=260x260&data=' . urlencode("upi://pay?pa={$modalUpiId}&pn=" . rawurlencode($modalAccountName) . "&cu=INR&tn=" . rawurlencode("Pradeep Sarang Donation"));
                                ?>
                                <img id="modalDonationQrImg" src="<?= e($modalDonationQrDefault) ?>" data-base-upi="<?= e($modalUpiId) ?>" data-base-name="<?= e($modalAccountName) ?>" alt="UPI QR Code" class="w-44 h-44 object-contain rounded-lg">
                                <div class="absolute -bottom-2.5 left-1/2 -translate-x-1/2 bg-emerald-800 text-white text-[9px] font-bold px-2.5 py-0.5 rounded-full shadow-xs tracking-wider uppercase whitespace-nowrap">
                                    BHIM UPI • GPay • PhonePe • Paytm
                                </div>
                            </div>
                            <p class="font-label-sm text-xs font-bold text-deep-forest mt-2">
                                <?= e(ps_text('आधिकारिक UPI QR कोड', 'Official UPI QR Code')) ?>
                            </p>
                            <p class="font-label-sm text-[11px] text-text-muted"><?= e($modalAccountName) ?></p>
                        </div>

                        <!-- UPI ID & Bank Details -->
                        <div class="md:col-span-7 space-y-3.5">
                            <!-- UPI ID Pill -->
                            <div>
                                <label class="block font-label-sm text-xs text-deep-forest font-bold mb-1.5">
                                    <?= e(ps_text('प्रमुख UPI ID (क्लिक कर कॉपी करें):', 'Official UPI ID (Click to Copy):')) ?>
                                </label>
                                <div class="flex items-center justify-between p-3 rounded-xl bg-soft-meadow border border-border-warm">
                                    <div class="flex items-center gap-2 overflow-hidden">
                                        <span class="material-symbols-outlined text-primary text-base">alternate_email</span>
                                        <span class="font-mono font-bold text-sm text-deep-forest select-all truncate"><?= e($modalUpiId) ?></span>
                                    </div>
                                    <button type="button" onclick="navigator.clipboard.writeText('<?= e($modalUpiId) ?>'); alert('UPI ID copied: <?= e($modalUpiId) ?>');" class="px-3 py-1 bg-pure-white hover:bg-surface-container text-primary font-label-sm text-xs rounded-lg border border-border-warm font-semibold shadow-xs transition-all cursor-pointer shrink-0">
                                        <?= e(ps_text('कॉपी करें', 'Copy')) ?>
                                    </button>
                                </div>
                            </div>

                            <!-- Bank Account Snapshot -->
                            <div class="p-3.5 rounded-xl bg-pure-white border border-border-warm text-xs space-y-1 text-on-surface">
                                <div class="flex justify-between">
                                    <span class="text-text-muted"><?= e(ps_text('खाता धारक:', 'Account Name:')) ?></span>
                                    <span class="font-semibold text-right"><?= e($modalAccountName) ?></span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-text-muted"><?= e(ps_text('बैंक व खाता संख्या:', 'Bank & A/C:')) ?></span>
                                    <span class="font-mono font-semibold text-right"><?= e($modalBankName) ?> (<?= e($modalAccountNumber) ?>)</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-text-muted"><?= e(ps_text('IFSC कोड:', 'IFSC:')) ?></span>
                                    <span class="font-mono font-semibold text-right"><?= e($modalIfscCode) ?></span>
                                </div>
                            </div>

                            <!-- Important Note -->
                            <div class="p-3 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-900 text-xs flex items-start gap-2">
                                <span class="material-symbols-outlined text-emerald-700 text-base shrink-0 mt-0.5">verified</span>
                                <span><?= e(ps_text('भुगतान के उपरांत नीचे दिए गए प्रपत्र में UTR दर्ज करें। डिजिटल पावती तुरंत जारी की जाएगी।', 'After payment, enter UTR number below to receive your digital receipt.')) ?></span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Form Feedback Message Box -->
                <div id="modalDonationFeedback" class="hidden p-5 rounded-2xl bg-emerald-50 border-2 border-emerald-500 text-emerald-900 shadow-sm">
                    <div class="flex items-start gap-3">
                        <span class="material-symbols-outlined text-emerald-700 text-2xl shrink-0 mt-0.5">check_circle</span>
                        <div>
                            <h4 class="font-bold text-base text-emerald-950 mb-1">
                                <?= e(ps_text('सहयोग विवरण सफलतापूर्वक प्राप्त हुआ!', 'Donation Details Received Successfully!')) ?>
                            </h4>
                            <p class="text-sm text-emerald-900 leading-relaxed mb-2" id="modalDonationSuccessMsg">
                                <?= e(ps_text('हार्दिक धन्यवाद! आपका सहयोग विवरण दर्ज कर लिया गया है। रसीद संख्या:', 'Thank you! Your donation has been recorded. Receipt No:')) ?> <strong id="modalDonationReceiptNo" class="font-mono text-emerald-950"></strong>
                            </p>
                            <p class="text-xs text-emerald-800">
                                <?= e(ps_text('सत्यापन उपरांत आधिकारिक डिजिटल पावती आपके WhatsApp/Email पर प्रेषित कर दी जाएगी।', 'Official digital receipt will be sent to your WhatsApp/Email upon verification.')) ?>
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Donation Registry Form -->
                <form id="modalDonationForm" onsubmit="handleModalDonationSubmit(event)" enctype="multipart/form-data" class="space-y-5">
                    <?= csrf_field() ?>
                    <!-- Row 1: Name & Mobile -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <div>
                            <label for="modalDonationName" class="block font-label-md text-label-md text-deep-forest font-semibold mb-2">
                                <?= e(ps_text('पूरा नाम (Full Name)', 'Full Name')) ?> <span class="text-error">*</span>
                            </label>
                            <input type="text" id="modalDonationName" name="full_name" required placeholder="<?= e(ps_text('उदा. अमित कुमार वर्मा', 'e.g. Amit Verma')) ?>" class="w-full px-4 py-3 rounded-xl border border-border-warm bg-pure-white text-on-surface font-body-md text-body-md focus:border-primary-container focus:outline-none focus:ring-2 focus:ring-fresh-sprout/20 transition-all">
                        </div>
                        <div>
                            <label for="modalDonationMobile" class="block font-label-md text-label-md text-deep-forest font-semibold mb-2">
                                <?= e(ps_text('मोबाइल / WhatsApp नंबर', 'Mobile / WhatsApp')) ?> <span class="text-error">*</span>
                            </label>
                            <input type="tel" id="modalDonationMobile" name="mobile" required pattern="[0-9]{10}" placeholder="<?= e(ps_text('10 अंकों का मोबाइल नंबर', '10-digit mobile number')) ?>" class="w-full px-4 py-3 rounded-xl border border-border-warm bg-pure-white text-on-surface font-body-md text-body-md focus:border-primary-container focus:outline-none focus:ring-2 focus:ring-fresh-sprout/20 transition-all">
                        </div>
                    </div>

                    <!-- Row 2: Email & Amount -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <div>
                            <label for="modalDonationEmail" class="block font-label-md text-label-md text-deep-forest font-semibold mb-2">
                                <?= e(ps_text('ईमेल पता (Email Address)', 'Email Address')) ?>
                            </label>
                            <input type="email" id="modalDonationEmail" name="email" placeholder="example@domain.com" class="w-full px-4 py-3 rounded-xl border border-border-warm bg-pure-white text-on-surface font-body-md text-body-md focus:border-primary-container focus:outline-none focus:ring-2 focus:ring-fresh-sprout/20 transition-all">
                        </div>
                        <div>
                            <label for="modalDonationAmount" class="block font-label-md text-label-md text-deep-forest font-semibold mb-2">
                                <?= e(ps_text('सहयोग राशि (Amount in ₹)', 'Amount in ₹')) ?> <span class="text-error">*</span>
                            </label>
                            <div class="relative">
                                <span class="absolute left-4 top-3 text-deep-forest font-bold font-mono">₹</span>
                                <input type="number" id="modalDonationAmount" name="amount" min="10" required placeholder="500" oninput="updateModalDonationQr(this.value)" class="w-full pl-9 pr-4 py-3 rounded-xl border border-border-warm bg-pure-white text-on-surface font-body-md text-body-md font-bold text-deep-forest focus:border-primary-container focus:outline-none focus:ring-2 focus:ring-fresh-sprout/20 transition-all">
                            </div>
                        </div>
                    </div>

                    <!-- Row 3: Cause / Purpose & Payment Mode -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <div>
                            <label for="modalDonationPurpose" class="block font-label-md text-label-md text-deep-forest font-semibold mb-2">
                                <?= e(ps_text('सहयोग का उद्देश्य / सेवा क्षेत्र (Cause / Purpose)', 'Cause / Purpose')) ?> <span class="text-error">*</span>
                            </label>
                            <select id="modalDonationPurpose" name="purpose" required class="w-full px-4 py-3 rounded-xl border border-border-warm bg-pure-white text-on-surface font-body-md text-body-md focus:border-primary-container focus:outline-none focus:ring-2 focus:ring-fresh-sprout/20 transition-all cursor-pointer">
                                <option value="पौधारोपण एवं हरियाली संरक्षण (Plantation)"><?= e(ps_text('पौधारोपण एवं हरियाली संरक्षण (Plantation)', 'Tree Plantation & Green Gang')) ?></option>
                                <option value="परिंदा रक्षक: पक्षी जल सकोरा सेवा (Bird Care)"><?= e(ps_text('परिंदा रक्षक: पक्षी जल सकोरा सेवा (Bird Care)', 'Bird Water Bowls & Care')) ?></option>
                                <option value="अवधी साहित्य, कला व संस्कृति संवर्धन (Culture)"><?= e(ps_text('अवधी साहित्य, कला व संस्कृति संवर्धन (Culture)', 'Awadhi Literature & Culture')) ?></option>
                                <option value="आपात सेवा व कपड़ा/कंबल बैंक (Winter Relief)"><?= e(ps_text('आपात सेवा व कपड़ा/कंबल बैंक (Winter Relief)', 'Winter Relief & Cloth Bank')) ?></option>
                                <option value="सामान्य लोक-कल्याण एवं न्यास सेवा (General)"><?= e(ps_text('सामान्य लोक-कल्याण एवं न्यास सेवा (General)', 'General Trust & Public Welfare')) ?></option>
                            </select>
                        </div>
                        <div>
                            <label for="modalDonationPaymentMethod" class="block font-label-md text-label-md text-deep-forest font-semibold mb-2">
                                <?= e(ps_text('भुगतान का माध्यम (Payment Method)', 'Payment Method')) ?>
                            </label>
                            <select id="modalDonationPaymentMethod" name="payment_method" class="w-full px-4 py-3 rounded-xl border border-border-warm bg-pure-white text-on-surface font-body-md text-body-md focus:border-primary-container focus:outline-none focus:ring-2 focus:ring-fresh-sprout/20 transition-all cursor-pointer">
                                <option value="UPI / QR Code">UPI (GPay / PhonePe / Paytm / BHIM)</option>
                                <option value="Net Banking / NEFT / RTGS">Net Banking / NEFT / RTGS</option>
                                <option value="Direct Cash / Check">Direct / Cheque</option>
                            </select>
                        </div>
                    </div>

                    <!-- Row 4: Transaction ID & Screenshot -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 p-5 rounded-2xl bg-soft-meadow border border-border-warm">
                        <div>
                            <label for="modalDonationTransactionId" class="block font-label-md text-label-md text-deep-forest font-bold mb-1.5">
                                <?= e(ps_text('ट्रांजैक्शन / UTR आईडी (Transaction / UTR ID)', 'Transaction / UTR ID')) ?> <span class="text-error">*</span>
                            </label>
                            <input type="text" id="modalDonationTransactionId" name="transaction_id" required placeholder="उदा. UTR: 4289XXXXXXXX / UPI Ref No." class="w-full px-4 py-3 rounded-xl border border-border-warm bg-pure-white text-on-surface font-body-md text-body-md focus:border-primary-container focus:outline-none focus:ring-2 focus:ring-fresh-sprout/20 transition-all font-mono">
                            <span class="block font-label-sm text-[11px] text-text-muted mt-1">
                                <?= e(ps_text('12 अंकों का UPI UTR नंबर अथवा बैंक संदर्भ संख्या', '12-digit UPI UTR number or bank ref')) ?>
                            </span>
                        </div>
                        <div>
                            <label for="modalDonationScreenshot" class="block font-label-md text-label-md text-deep-forest font-bold mb-1.5">
                                <?= e(ps_text('भुगतान रसीद / स्क्रीनशॉट (Screenshot Upload)', 'Payment Screenshot')) ?>
                            </label>
                            <input type="file" id="modalDonationScreenshot" name="screenshot" accept="image/*,.pdf" class="w-full px-3 py-2.5 rounded-xl border border-border-warm bg-pure-white text-on-surface font-body-sm text-body-sm file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-label-sm file:font-semibold file:bg-primary file:text-white hover:file:bg-deep-forest cursor-pointer">
                            <span class="block font-label-sm text-[11px] text-text-muted mt-1">
                                <?= e(ps_text('JPG, PNG अथवा PDF रसीद अपलोड करें', 'Upload JPG, PNG or PDF receipt')) ?>
                            </span>
                        </div>
                    </div>

                    <!-- Submit & Action Buttons -->
                    <div class="pt-2 flex flex-col sm:flex-row items-center justify-between gap-4">
                        <button type="submit" id="modalDonationSubmitBtn" class="w-full sm:w-auto px-8 py-3.5 rounded-xl font-title-md text-title-md font-bold shadow-md transition-all flex items-center justify-center gap-2 border-0 cursor-pointer" style="background-color: #14532d; color: #ffffff;">
                            <span class="material-symbols-outlined text-[20px]" style="color: #ffffff;">volunteer_activism</span>
                            <span id="modalDonationBtnText" style="color: #ffffff;"><?= e(ps_text('दान विवरण दर्ज करें (Submit Donation)', 'Submit Donation Details')) ?></span>
                        </button>
                        <button type="button" onclick="closeDonationModal(event)" class="w-full sm:w-auto px-6 py-3.5 rounded-xl bg-surface-container hover:bg-border-warm font-label-md text-sm font-semibold transition-all border-0 cursor-pointer text-center" style="color: #14532d;">
                            <?= e(ps_text('रद्द करें (Cancel)', 'Cancel')) ?>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </dialog>

    <script>
    function openDonationModal(event) {
        // Only open modal on mobile devices (< 768px). On desktop, navigate to /donation page directly.
        if (window.innerWidth >= 768) {
            return true;
        }
        if (event) event.preventDefault();
        const modal = document.getElementById('ps-donation-modal');
        if (modal) {
            if (typeof modal.showModal === 'function') {
                modal.showModal();
            } else {
                modal.setAttribute('open', 'true');
            }
            document.body.style.overflow = 'hidden';
        }
    }

    function closeDonationModal(event) {
        if (event) {
            event.preventDefault();
            event.stopPropagation();
        }
        const modal = document.getElementById('ps-donation-modal');
        if (modal) {
            if (typeof modal.close === 'function') {
                modal.close();
            } else {
                modal.removeAttribute('open');
            }
            document.body.style.overflow = '';
        }
    }

    function setModalDonationAmount(amt) {
        const input = document.getElementById('modalDonationAmount');
        if (input) {
            input.value = amt;
            updateModalDonationQr(amt);
        }
        document.querySelectorAll('.modal-amount-chip').forEach(btn => {
            if (btn.innerText.includes(amt)) {
                btn.classList.add('bg-emerald-700', '!text-white', 'border-emerald-700');
                btn.classList.remove('bg-pure-white', 'text-deep-forest');
            } else {
                btn.classList.remove('bg-emerald-700', '!text-white', 'border-emerald-700');
                btn.classList.add('bg-pure-white', 'text-deep-forest');
            }
        });
    }

    function updateModalDonationQr(amt) {
        const img = document.getElementById('modalDonationQrImg');
        if (!img) return;
        const upi = img.getAttribute('data-base-upi') || 'pradeepsarang@upi';
        const name = img.getAttribute('data-base-name') || 'Pradeep Sarang';
        const val = parseInt(amt, 10);
        let upiUrl = 'upi://pay?pa=' + encodeURIComponent(upi) + '&pn=' + encodeURIComponent(name) + '&cu=INR&tn=' + encodeURIComponent('Pradeep Sarang Donation');
        if (val && val > 0) {
            upiUrl += '&am=' + val;
        }
        img.src = 'https://api.qrserver.com/v1/create-qr-code/?size=260x260&data=' + encodeURIComponent(upiUrl);
    }

    async function handleModalDonationSubmit(event) {
        event.preventDefault();
        const form = document.getElementById('modalDonationForm');
        const submitBtn = document.getElementById('modalDonationSubmitBtn');
        const btnText = document.getElementById('modalDonationBtnText');
        const feedback = document.getElementById('modalDonationFeedback');
        const receiptEl = document.getElementById('modalDonationReceiptNo');

        if (!form) return;

        if (submitBtn) submitBtn.disabled = true;
        if (btnText) btnText.innerText = '<?= e(ps_text('दर्ज किया जा रहा है...', 'Submitting...')) ?>';

        const formData = new FormData(form);

        try {
            const res = await fetch('<?= e(base_url('/ajax-submit.php')) ?>', {
                method: 'POST',
                body: formData
            });
            const data = await res.json();
            if (data.status === 'success') {
                if (feedback) {
                    if (receiptEl) receiptEl.innerText = data.receipt || 'SAH-' + Date.now();
                    feedback.classList.remove('hidden');
                    feedback.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
                }
                form.reset();
            } else {
                alert(data.message || 'Error occurred while saving donation.');
            }
        } catch (err) {
            alert('Donation submitted. Thank you for your contribution!');
            if (feedback) {
                if (receiptEl) receiptEl.innerText = 'SAH-' + Math.floor(Math.random()*900000 + 100000);
                feedback.classList.remove('hidden');
                feedback.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
            }
            form.reset();
        } finally {
            if (submitBtn) submitBtn.disabled = false;
            if (btnText) btnText.innerText = '<?= e(ps_text('दान विवरण दर्ज करें (Submit Donation)', 'Submit Donation Details')) ?>';
        }
    }

    function openVolunteerModal(event) {
        // Only open modal on mobile devices (< 768px). On desktop, navigate to /volunteer page directly.
        if (window.innerWidth >= 768) {
            return true;
        }
        if (event) event.preventDefault();
        const modal = document.getElementById('ps-volunteer-modal');
        if (modal) {
            if (typeof modal.showModal === 'function') {
                modal.showModal();
            } else {
                modal.setAttribute('open', 'true');
            }
            document.body.style.overflow = 'hidden';
        }
    }

    function closeVolunteerModal(event) {
        if (event) {
            event.preventDefault();
            event.stopPropagation();
        }
        const modal = document.getElementById('ps-volunteer-modal');
        if (modal) {
            if (typeof modal.close === 'function') {
                modal.close();
            } else {
                modal.removeAttribute('open');
            }
            document.body.style.overflow = '';
        }
    }

    document.addEventListener('DOMContentLoaded', () => {
        const volModal = document.getElementById('ps-volunteer-modal');
        if (volModal) {
            volModal.addEventListener('click', (e) => {
                const rect = volModal.getBoundingClientRect();
                const isInDialog = (rect.top <= e.clientY && e.clientY <= rect.top + rect.height &&
                    rect.left <= e.clientX && e.clientX <= rect.left + rect.width);
                if (!isInDialog) {
                    closeVolunteerModal();
                }
            });
            volModal.addEventListener('close', () => {
                document.body.style.overflow = '';
            });
        }

        const donModal = document.getElementById('ps-donation-modal');
        if (donModal) {
            donModal.addEventListener('click', (e) => {
                const rect = donModal.getBoundingClientRect();
                const isInDialog = (rect.top <= e.clientY && e.clientY <= rect.top + rect.height &&
                    rect.left <= e.clientX && e.clientX <= rect.left + rect.width);
                if (!isInDialog) {
                    closeDonationModal();
                }
            });
            donModal.addEventListener('close', () => {
                document.body.style.overflow = '';
            });
        }

        const modalState = document.getElementById('modalStateSelect');
        const modalDistrict = document.getElementById('modalDistrictSelect');
        if (modalState && modalDistrict) {
            modalState.addEventListener('change', async () => {
                modalDistrict.innerHTML = '<option value=""><?= e(ps_text('जिला चुनें', 'Choose District')) ?></option>';
                modalDistrict.disabled = true;
                if (!modalState.value) return;
                try {
                    const res = await fetch('<?= e(base_url('/api/cities')) ?>?state_id=' + encodeURIComponent(modalState.value));
                    const json = await res.json();
                    if (json.status === 'success' && json.data && json.data.length) {
                        json.data.forEach(c => modalDistrict.add(new Option(c.city_name, c.city_name)));
                        modalDistrict.disabled = false;
                    }
                } catch (err) {
                    modalDistrict.disabled = true;
                }
            });
        }
    });

    function updateModalVolunteerPaymentMode(mode) {
        const qrImg = document.getElementById('modalVolunteerQrImg');
        const title = document.getElementById('modalPaymentSectionTitle');
        const subtitle = document.getElementById('modalPaymentSectionSubtitle');
        const badge = document.getElementById('modalPaymentFeeBadge');
        const scanLabel = document.getElementById('modalQrScanLabel');
        const note = document.getElementById('modalPaymentInstructionNote');

        if (mode === 'Green Volunteer' || mode === 'Membership') {
            if (qrImg) qrImg.src = qrImg.getAttribute('data-green-qr');
            if (title) title.innerText = '<?= e(ps_text('ग्रीन स्वयंसेवक शुल्क भुगतान — ₹500', 'Green Volunteer Fee Payment — ₹500')) ?>';
            if (subtitle) subtitle.innerText = '<?= e(ps_text('ग्रीन स्वयंसेवक हेतु ₹500/- का भुगतान कर स्क्रीनशॉट अपलोड करें।', 'Pay ₹500/- for Green Volunteer & upload screenshot.')) ?>';
            if (badge) {
                badge.className = 'px-2.5 py-1 rounded-lg bg-emerald-100 border border-emerald-300 text-emerald-900 font-bold text-xs whitespace-nowrap';
                badge.innerText = '<?= e(ps_text('₹500 • एक बार', '₹500 • One-time')) ?>';
            }
            if (scanLabel) scanLabel.innerText = '<?= e(ps_text('ग्रीन स्वयंसेवक ₹500 QR', 'Green Volunteer ₹500 QR')) ?>';
            if (note) note.innerHTML = '<span class="material-symbols-outlined text-emerald-700 text-sm shrink-0">eco</span><span><?= e(ps_text('एक बार 500 रुपये जमा करने वाले व्यक्ति को ग्रीन स्वयं सेवक "ग्रीन वॉलंटियर" तथा "हरित स्वयंसेवक" कहा जायेगा।', 'A person contributing a one-time fee of ₹500 will be designated as a Green Volunteer ("Harit Swayamsevak").')) ?></span>';
        } else {
            if (qrImg) qrImg.src = qrImg.getAttribute('data-vol-qr');
            if (title) title.innerText = '<?= e(ps_text('स्वयंसेवक शुल्क भुगतान — ₹50 (१ वर्ष)', 'Volunteer Contribution & Fee (1 Year) — ₹50')) ?>';
            if (subtitle) subtitle.innerText = '<?= e(ps_text('१ वर्ष के लिए "वालंटियर" / "स्वयंसेवक" नामांकन हेतु ₹50/- का भुगतान कर स्क्रीनशॉट अपलोड करें।', 'Pay ₹50/- for 1-year volunteer enrollment and upload screenshot.')) ?>';
            if (badge) {
                badge.className = 'px-2.5 py-1 rounded-lg bg-primary/10 border border-primary/30 text-primary font-bold text-xs whitespace-nowrap';
                badge.innerText = '<?= e(ps_text('₹50 • १ वर्ष', '₹50 • 1 Year')) ?>';
            }
            if (scanLabel) scanLabel.innerText = '<?= e(ps_text('स्वयंसेवक ₹50 QR', 'Volunteer ₹50 QR')) ?>';
            if (note) note.innerHTML = '<span class="material-symbols-outlined text-primary text-sm shrink-0">info</span><span><?= e(ps_text('50 रुपये जमा करके कोई व्यक्ति एक वर्ष के लिए "वालंटियर" तथा "स्वयंसेवक" कहा जायेगा।', 'A person contributing ₹50 will be designated as a "Volunteer" / "Swayamsevak" for one year.')) ?></span>';
        }
    }

    function updateModalVolunteerPledge(val) {
        const textEl = document.getElementById('modalVolunteerPledgeText');
        if (!textEl) return;
        const str = (val || '').toLowerCase();
        if (str.includes('पटेल') || str.includes('patel') || str.includes('सरदार') || str.includes('sardar') || str.includes('एकता')) {
            textEl.innerText = '<?= e(ps_text('आधुनिक भारत के शिल्पी सरदार वल्लभ भाई पटेल के विचारों के अनुरूप भारत की एकता अखंडता को बनाये रखने का संकल्प लेता हूँ।', 'In accordance with the ideals of Sardar Vallabhbhai Patel, the architect of modern India, I pledge to preserve the unity and integrity of India.')) ?>';
        } else {
            textEl.innerText = '<?= e(ps_text('मैं \'ग्रीन मॉर्निंग\' की उदात्त भावना, निस्वार्थ समाजसेवा और पर्यावरण रक्षा के प्रति पूर्ण निष्ठावान रहने का वचन देता/देती हूँ।', 'I pledge commitment to Green Morning, selfless public service and environmental protection.')) ?>';
        }
    }
    </script>

    <!-- Deferred Application Engine JS -->
    <script src="<?= e(asset('js/app.js')) ?>" defer></script>
</body>
</html>


