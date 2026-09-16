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
              "secondary-fixed-dim": "#c4b5fd",
              "on-tertiary-container": "#ffffff",
              "surface-bright": "#fbf8f2",
              "on-primary-container": "#ffffff",
              "primary-container": "#14532d",
              "surface-container-highest": "#e5e7eb",
              "on-primary": "#ffffff",
              "error-container": "#ffdad6",
              "on-secondary-fixed-variant": "#15803d",
              "outline": "#667085",
              "primary": "#14532d",
              "surface-variant": "#f3f5f1",
              "background": "#faf8f3",
              "tertiary": "#c05632",
              "terracotta": "#c05632",
              "gold": "#b28a42",
              "charcoal": "#172033",
              "slate-gray": "#667085",
              "error": "#ba1a1a",
              "on-surface": "#172033",
              "on-secondary-container": "#ffffff",
              "on-secondary-fixed": "#14532d",
              "inverse-on-surface": "#faf8f3",
              "on-surface-variant": "#667085",
              "deep-forest": "#14532d",
              "text-muted": "#667085",
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
    <?php $isFullPage = $isHomePage || in_array(basename($viewFile), ['contact.php', 'volunteer.php', 'blog.php', 'cause-detail.php', 'causes.php', 'events.php', 'media.php', 'blog-detail.php', 'donation.php', 'about.php', 'portfolio.php', 'awards.php', 'journey.php', 'impact.php', 'green-gang.php', 'salahkaar.php', 'videos.php'], true); ?>
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
        </div>
    </dialog>

    <!-- Volunteer Enrollment Form Popup Modal -->
    <dialog id="ps-volunteer-modal" class="backdrop:bg-black/75 backdrop:backdrop-blur-sm rounded-2xl p-0 bg-transparent max-w-3xl w-[94vw] shadow-2xl z-[100000] border-0 my-auto overflow-hidden">
        <div class="bg-surface-container-lowest rounded-2xl border border-border-warm overflow-hidden flex flex-col max-h-[90vh]">
            <!-- Modal Header with Close Button in Corner -->
            <div class="bg-deep-forest text-on-primary px-5 py-4 flex items-center justify-between sticky top-0 z-20 shadow-md">
                <div class="flex items-center gap-3">
                    <span class="material-symbols-outlined text-fresh-sprout text-[26px]">volunteer_activism</span>
                    <div>
                        <h3 class="font-headline-sm text-base sm:text-lg font-bold text-pure-white leading-tight m-0">
                            <?= e(ps_text('स्वयंसेवक सहभागिता प्रपत्र (Volunteer Enrollment Form)', 'Volunteer Registration Form')) ?>
                        </h3>
                        <p class="font-label-sm text-xs opacity-90 m-0" style="color: rgba(255, 255, 255, 0.9);">
                            <?= e(ps_text('माटी का ऋण और सामाजिक उत्तरदायित्व • ग्रीन गैंग स्वयंसेवक दल', 'Green Gang & Public Service Volunteer Network')) ?>
                        </p>
                    </div>
                </div>
                <!-- Close Button in Corner -->
                <button type="button" onclick="closeVolunteerModal(event)" class="w-9 h-9 rounded-full bg-white/10 hover:bg-white/25 text-white flex items-center justify-center transition-all cursor-pointer border-0 text-xl font-bold shrink-0 ml-2" title="<?= e(ps_text('बंद करें', 'Close')) ?>" aria-label="<?= e(ps_text('बंद करें', 'Close')) ?>">
                    ✕
                </button>
            </div>

            <!-- Modal Body (Scrollable Form) -->
            <div class="p-5 sm:p-7 overflow-y-auto space-y-5 bg-cream-canvas text-left">
                <form id="modalVolunteerForm" method="post" action="<?= e(base_url('/volunteer')) ?>" enctype="multipart/form-data" class="space-y-5">
                    <?= csrf_field() ?>
                    <input type="hidden" name="form_type" value="volunteer">

                    <div class="bg-surface-container-lowest p-3.5 rounded-xl border border-border-warm shadow-xs flex items-center gap-3 text-xs text-text-muted">
                        <span class="material-symbols-outlined text-primary text-[20px] shrink-0">edit_note</span>
                        <span><?= e(ps_text('कृपया अपनी सही जानकारी भरें ताकि आपके निकटतम क्षेत्र के ग्रीन गैंग समन्वयक आपसे संपर्क कर सकें।', 'Please enter your authentic details so your nearest Green Gang coordinator can reach out.')) ?></span>
                    </div>

                    <!-- Row 1: Full Name & WhatsApp Number -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label for="modalFullName" class="block font-label-md text-sm text-deep-forest font-semibold mb-1.5">
                                <?= e(ps_text('पूरा नाम (Full Name)', 'Full Name')) ?> <span class="text-error">*</span>
                            </label>
                            <input type="text" id="modalFullName" name="full_name" required class="w-full px-3.5 py-2.5 rounded-xl border border-border-warm bg-pure-white text-on-surface text-sm focus:border-primary-container focus:outline-none focus:ring-2 focus:ring-fresh-sprout/20 transition-all">
                        </div>
                        <div>
                            <label for="modalWhatsappNumber" class="block font-label-md text-sm text-deep-forest font-semibold mb-1.5">
                                <?= e(ps_text('मोबाइल / WhatsApp नंबर', 'Mobile / WhatsApp Number')) ?> <span class="text-error">*</span>
                            </label>
                            <input type="tel" id="modalWhatsappNumber" name="phone" required class="w-full px-3.5 py-2.5 rounded-xl border border-border-warm bg-pure-white text-on-surface text-sm focus:border-primary-container focus:outline-none focus:ring-2 focus:ring-fresh-sprout/20 transition-all">
                        </div>
                    </div>

                    <!-- Row 2: Father Name & Email -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label for="modalFatherName" class="block font-label-md text-sm text-deep-forest font-semibold mb-1.5">
                                <?= e(ps_text('पिता / अभिभावक का नाम', 'Father / Guardian Name')) ?>
                            </label>
                            <input type="text" id="modalFatherName" name="father_name" class="w-full px-3.5 py-2.5 rounded-xl border border-border-warm bg-pure-white text-on-surface text-sm focus:border-primary-container focus:outline-none focus:ring-2 focus:ring-fresh-sprout/20 transition-all">
                        </div>
                        <div>
                            <label for="modalEmailAddress" class="block font-label-md text-sm text-deep-forest font-semibold mb-1.5">
                                <?= e(ps_text('ईमेल पता (Email Address)', 'Email Address')) ?> <span class="text-error">*</span>
                            </label>
                            <input type="email" id="modalEmailAddress" name="email" required class="w-full px-3.5 py-2.5 rounded-xl border border-border-warm bg-pure-white text-on-surface text-sm focus:border-primary-container focus:outline-none focus:ring-2 focus:ring-fresh-sprout/20 transition-all">
                        </div>
                    </div>

                    <!-- Row 3: Gender, DOB, Occupation -->
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <div>
                            <label for="modalGenderSelect" class="block font-label-md text-sm text-deep-forest font-semibold mb-1.5">
                                <?= e(ps_text('लिंग (Gender)', 'Gender')) ?>
                            </label>
                            <select id="modalGenderSelect" name="gender" class="w-full px-3.5 py-2.5 rounded-xl border border-border-warm bg-pure-white text-on-surface text-sm focus:border-primary-container focus:outline-none focus:ring-2 focus:ring-fresh-sprout/20 transition-all">
                                <option value="Male"><?= e(ps_text('पुरुष (Male)', 'Male')) ?></option>
                                <option value="Female"><?= e(ps_text('महिला (Female)', 'Female')) ?></option>
                                <option value="Other"><?= e(ps_text('अन्य (Other)', 'Other')) ?></option>
                            </select>
                        </div>
                        <div>
                            <label for="modalUserDob" class="block font-label-md text-sm text-deep-forest font-semibold mb-1.5">
                                <?= e(ps_text('जन्म तिथि (Date of Birth)', 'Date of Birth')) ?>
                            </label>
                            <input type="date" id="modalUserDob" name="dob" class="w-full px-3.5 py-2.5 rounded-xl border border-border-warm bg-pure-white text-on-surface text-sm focus:border-primary-container focus:outline-none focus:ring-2 focus:ring-fresh-sprout/20 transition-all">
                        </div>
                        <div>
                            <label for="modalUserOccupation" class="block font-label-md text-sm text-deep-forest font-semibold mb-1.5">
                                <?= e(ps_text('व्यवसाय / पेशा', 'Occupation')) ?>
                            </label>
                            <input type="text" id="modalUserOccupation" name="occupation" class="w-full px-3.5 py-2.5 rounded-xl border border-border-warm bg-pure-white text-on-surface text-sm focus:border-primary-container focus:outline-none focus:ring-2 focus:ring-fresh-sprout/20 transition-all">
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
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <div>
                            <label for="modalStateSelect" class="block font-label-md text-sm text-deep-forest font-semibold mb-1.5">
                                <?= e(ps_text('राज्य (State)', 'State')) ?> <span class="text-error">*</span>
                            </label>
                            <select id="modalStateSelect" name="state" required class="w-full px-3.5 py-2.5 rounded-xl border border-border-warm bg-pure-white text-on-surface text-sm focus:border-primary-container focus:outline-none focus:ring-2 focus:ring-fresh-sprout/20 transition-all">
                                <option value=""><?= e(ps_text('राज्य चुनें', 'Choose State')) ?></option>
                                <?php foreach ($modalStates as $st): ?>
                                    <option value="<?= e((string)($st['state_id'] ?? $st['state_name'])) ?>"><?= e($st['state_name']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div>
                            <label for="modalDistrictSelect" class="block font-label-md text-sm text-deep-forest font-semibold mb-1.5">
                                <?= e(ps_text('जिला (District)', 'District')) ?> <span class="text-error">*</span>
                            </label>
                            <select id="modalDistrictSelect" name="district" disabled required class="w-full px-3.5 py-2.5 rounded-xl border border-border-warm bg-pure-white text-on-surface text-sm focus:border-primary-container focus:outline-none focus:ring-2 focus:ring-fresh-sprout/20 transition-all">
                                <option value=""><?= e(ps_text('जिला चुनें', 'Choose District')) ?></option>
                            </select>
                        </div>
                        <div>
                            <label for="modalUserPincode" class="block font-label-md text-sm text-deep-forest font-semibold mb-1.5">
                                <?= e(ps_text('पिनकोड (PIN Code)', 'PIN Code')) ?>
                            </label>
                            <input type="text" id="modalUserPincode" name="pincode" inputmode="numeric" class="w-full px-3.5 py-2.5 rounded-xl border border-border-warm bg-pure-white text-on-surface text-sm focus:border-primary-container focus:outline-none focus:ring-2 focus:ring-fresh-sprout/20 transition-all">
                        </div>
                    </div>

                    <!-- Domains of Contribution -->
                    <div>
                        <label for="modalUserInterests" class="block font-label-md text-sm text-deep-forest font-semibold mb-1.5">
                            <?= e(ps_text('आप किस अभियान में सहभागिता करना चाहते हैं? (रुचि/कौशल)', 'Which initiatives interest you?')) ?> <span class="text-error">*</span>
                        </label>
                        <input type="text" id="modalUserInterests" name="interests" required class="w-full px-3.5 py-2.5 rounded-xl border border-border-warm bg-pure-white text-on-surface text-sm focus:border-primary-container focus:outline-none focus:ring-2 focus:ring-fresh-sprout/20 transition-all">
                    </div>

                    <!-- Time Availability -->
                    <div>
                        <label for="modalUserAvailability" class="block font-label-md text-sm text-deep-forest font-semibold mb-1.5">
                            <?= e(ps_text('समय की उपलब्धता (Time Availability)', 'Time Availability')) ?>
                        </label>
                        <select id="modalUserAvailability" name="availability" class="w-full px-3.5 py-2.5 rounded-xl border border-border-warm bg-pure-white text-on-surface text-sm focus:border-primary-container focus:outline-none focus:ring-2 focus:ring-fresh-sprout/20 transition-all">
                            <option value="Flexible"><?= e(ps_text('लचीला समय (Flexible Time)', 'Flexible')) ?></option>
                            <option value="Weekends"><?= e(ps_text('सप्ताहांत (Saturday-Sunday)', 'Weekends')) ?></option>
                            <option value="Weekdays"><?= e(ps_text('कार्यदिवस (Monday-Friday)', 'Weekdays')) ?></option>
                            <option value="On-Call"><?= e(ps_text('आवश्यकतानुसार ऑन-कॉल (Emergency On-Call)', 'Emergency On-Call')) ?></option>
                        </select>
                    </div>

                    <!-- Upload Photo & Resume -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label for="modalUserPhoto" class="block font-label-md text-sm text-deep-forest font-semibold mb-1.5">
                                <?= e(ps_text('पासपोर्ट साइज फोटो (Photo Upload)', 'Passport Photo')) ?>
                            </label>
                            <input type="file" id="modalUserPhoto" name="photo" accept="image/*" class="w-full px-3 py-2 rounded-xl border border-border-warm bg-pure-white text-on-surface text-xs file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-deep-forest file:text-white cursor-pointer">
                        </div>
                        <div>
                            <label for="modalUserResume" class="block font-label-md text-sm text-deep-forest font-semibold mb-1.5">
                                <?= e(ps_text('रिज्यूमे / परिचय (Optional Resume)', 'Optional Resume')) ?>
                            </label>
                            <input type="file" id="modalUserResume" name="resume" accept=".pdf,.doc,.docx" class="w-full px-3 py-2 rounded-xl border border-border-warm bg-pure-white text-on-surface text-xs file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-deep-forest file:text-white cursor-pointer">
                        </div>
                    </div>

                    <!-- Message / Motivation -->
                    <div>
                        <label for="modalUserMessage" class="block font-label-md text-sm text-deep-forest font-semibold mb-1.5">
                            <?= e(ps_text('आप इस अभियान से क्यों जुड़ना चाहते हैं?', 'Why do you want to join?')) ?>
                        </label>
                        <textarea id="modalUserMessage" name="message" rows="2" class="w-full px-3.5 py-2.5 rounded-xl border border-border-warm bg-pure-white text-on-surface text-sm focus:border-primary-container focus:outline-none focus:ring-2 focus:ring-fresh-sprout/20 transition-all"></textarea>
                    </div>

                    <!-- Pledge Checkbox -->
                    <div class="bg-tertiary-fixed/20 p-3.5 rounded-xl border border-tertiary-fixed/40">
                        <label class="flex items-start gap-2.5 cursor-pointer">
                            <input type="checkbox" required class="mt-0.5 w-4 h-4 rounded border-border-warm text-primary-container focus:ring-fresh-sprout/30 shrink-0">
                            <span class="font-body-sm text-xs text-deep-forest leading-relaxed">
                                <strong><?= e(ps_text('हमारा संकल्प:', 'Our Pledge:')) ?></strong> <?= e(ps_text('मैं \'ग्रीन मॉर्निंग\' की उदात्त भावना, निस्वार्थ समाजसेवा और पर्यावरण रक्षा के प्रति पूर्ण निष्ठावान रहने का वचन देता/देती हूँ।', 'I pledge commitment to Green Morning, selfless public service and environmental protection.')) ?>
                            </span>
                        </label>
                    </div>

                    <!-- Submit Button & Close -->
                    <div class="pt-2 flex flex-col sm:flex-row items-center justify-between gap-3">
                        <button type="submit" class="w-full sm:w-auto px-7 py-3 rounded-xl font-title-md text-sm font-bold shadow-md transition-all flex items-center justify-center gap-2 border-0 cursor-pointer" style="background-color: #14532d; color: #ffffff;">
                            <span style="color: #ffffff;"><?= e(ps_text('स्वयंसेवक के रूप में पंजीकृत हों', 'Submit Application')) ?></span>
                            <span class="material-symbols-outlined text-[18px]" style="color: #ffffff;">arrow_forward</span>
                        </button>
                        <button type="button" onclick="closeVolunteerModal(event)" class="w-full sm:w-auto px-5 py-3 rounded-xl bg-surface-container hover:bg-border-warm font-label-md text-sm font-semibold transition-all border-0 cursor-pointer text-center" style="color: #14532d;">
                            <?= e(ps_text('रद्द करें (Cancel)', 'Cancel')) ?>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </dialog>

    <script>
    function openVolunteerModal(event) {
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
        const modal = document.getElementById('ps-volunteer-modal');
        if (modal) {
            modal.addEventListener('click', (e) => {
                const rect = modal.getBoundingClientRect();
                const isInDialog = (rect.top <= e.clientY && e.clientY <= rect.top + rect.height &&
                    rect.left <= e.clientX && e.clientX <= rect.left + rect.width);
                if (!isInDialog) {
                    closeVolunteerModal();
                }
            });
            modal.addEventListener('close', () => {
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
    </script>

    <!-- Deferred Application Engine JS -->
    <script src="<?= e(asset('js/app.js')) ?>" defer></script>
</body>
</html>


