<?php

declare(strict_types=1);

$settings = (new ContentModel())->getSettings();
$flashSuccess = flash('success');
$route = current_path();
?>
<!DOCTYPE html>
<html lang="<?= e(current_lang()) ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php if (isset($post) && !empty($post['seo_title'])): ?>
        <title><?= e($post['seo_title']) ?></title>
    <?php else: ?>
        <title><?= e($title) ?> | <?= e(app_config('name')) ?></title>
    <?php endif; ?>
    <?php if (isset($post) && !empty($post['meta_description'])): ?>
        <meta name="description" content="<?= e($post['meta_description']) ?>">
    <?php else: ?>
        <meta name="description" content="<?= e($settings['site_tagline']) ?>">
    <?php endif; ?>
    <?php if (isset($post) && !empty($post['meta_keywords'])): ?>
        <meta name="keywords" content="<?= e($post['meta_keywords']) ?>">
    <?php endif; ?>
    <?php if (isset($post) && !empty($post['canonical_url'])): ?>
        <link rel="canonical" href="<?= e($post['canonical_url']) ?>">
    <?php endif; ?>
    <?php if (isset($post)): ?>
        <meta property="og:type" content="article">
        <meta property="og:title" content="<?= e($post['seo_title'] ?: $post['title']) ?>">
        <meta property="og:description" content="<?= e($post['meta_description'] ?: $post['excerpt']) ?>">
        <?php if (!empty($post['og_image']) || !empty($post['featured_image']) || !empty($post['banner_image'])): ?>
            <meta property="og:image" content="<?= e(base_url($post['og_image'] ?: ($post['featured_image'] ?: $post['banner_image']))) ?>">
        <?php endif; ?>
    <?php endif; ?>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;700;800&family=Fraunces:wght@600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
    <link href="<?= e(asset('css/style.css')) ?>" rel="stylesheet">
    <style>
        .navbar-brand img {
            height: 60px;
            width: auto;
            transition: all 0.3s ease;
            object-fit: contain;
            display: block;
        }
        .navbar-brand:hover img {
            transform: scale(1.05);
            filter: brightness(1.1);
        }
        @media (max-width: 991.98px) {
            .navbar-brand img { height: 50px; }
        }
    </style>
</head>
<body>
    <div class="topbar py-2">
        <div class="container d-flex flex-wrap gap-3 justify-content-between align-items-center">
            <div class="small text-white-50">
                <span class="me-3"><i class="fa-solid fa-phone-volume me-2"></i><?= e($settings['phone']) ?></span>
                <span><i class="fa-solid fa-envelope me-2"></i><?= e($settings['email']) ?></span>
            </div>
            <div class="d-flex align-items-center gap-3">
                <div class="social-links">
                    <a href="<?= e($settings['facebook']) ?>"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="<?= e($settings['instagram']) ?>"><i class="fa-brands fa-instagram"></i></a>
                    <a href="<?= e($settings['linkedin']) ?>"><i class="fa-brands fa-linkedin-in"></i></a>
                </div>
                <div class="lang-switcher">
                    <a href="?lang=en" class="<?= current_lang() === 'en' ? 'active' : '' ?>">EN</a>
                    <a href="?lang=hi" class="<?= current_lang() === 'hi' ? 'active' : '' ?>">HI</a>
                </div>
            </div>
        </div>
    </div>

    <header class="site-header sticky-top">
        <nav class="navbar navbar-expand-lg py-3">
            <div class="container">
                <a class="navbar-brand py-0" href="<?= e(base_url('/')) ?>">
                    <img src="<?= e(!empty($settings['logo']) ? base_url($settings['logo']) : asset('images/logo.png')) ?>" alt="<?= e(app_config('name')) ?>"> 
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navMenu">
                    <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-2">
                        <li class="nav-item"><a class="nav-link <?= is_active('/') ?>" href="<?= e(base_url('/')) ?>"><?= e(lang('home')) ?></a></li>
                        <li class="nav-item"><a class="nav-link <?= is_active('/about') ?>" href="<?= e(base_url('/about')) ?>"><?= e(lang('about')) ?></a></li>
                        <li class="nav-item"><a class="nav-link <?= is_active('/campaigns') ?>" href="<?= e(base_url('/campaigns')) ?>"><?= e(lang('causes')) ?></a></li>
                        <li class="nav-item"><a class="nav-link <?= is_active('/events') ?>" href="<?= e(base_url('/events')) ?>"><?= e(lang('events')) ?></a></li>
                        <li class="nav-item"><a class="nav-link <?= is_active('/portfolio') ?>" href="<?= e(base_url('/portfolio')) ?>"><?= e(lang('portfolio')) ?></a></li>
                        <li class="nav-item"><a class="nav-link <?= is_active('/blog') ?>" href="<?= e(base_url('/blog')) ?>"><?= e(lang('blog')) ?></a></li>
                        <li class="nav-item"><a class="nav-link <?= is_active('/contact') ?>" href="<?= e(base_url('/contact')) ?>"><?= e(lang('contact')) ?></a></li>
                        <li class="nav-item"><a class="nav-link <?= is_active('/donation') ?>" href="<?= e(base_url('/donation')) ?>"><?= e(lang('donate')) ?></a></li>
                        <li class="nav-item ms-lg-3"><a class="btn btn-brand" href="<?= e(base_url('/volunteer')) ?>"><?= e(lang('volunteer')) ?></a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <?php if ($flashSuccess): ?>
        <div class="container mt-3">
            <div class="alert alert-success"><?= e($flashSuccess) ?></div>
        </div>
    <?php endif; ?>

    <?php require $viewFile; ?>

    <footer class="site-footer">
        <div class="container py-5">
            <div class="row g-4">
                <div class="col-lg-4">
                    <h4 class="footer-title">Pradeep Sarang Foundation</h4>
                    <p><?= e($settings['footer_text']) ?></p>
                </div>
                <div class="col-md-4 col-lg-2">
                    <h5>Menu</h5>
                    <ul class="list-unstyled footer-links">
                        <li><a href="<?= e(base_url('/about')) ?>">About</a></li>
                        <li><a href="<?= e(base_url('/causes')) ?>">Causes</a></li>
                        <li><a href="<?= e(base_url('/events')) ?>">Events</a></li>
                        <li><a href="<?= e(base_url('/blog')) ?>">Blog</a></li>
                        <li><a href="<?= e(base_url('/donation')) ?>"><?= e(lang('donate')) ?></a></li>
                    </ul>
                </div>
                <div class="col-md-4 col-lg-3">
                    <h5>Contact</h5>
                    <p class="mb-1"><?= e($settings['address']) ?></p>
                    <p class="mb-1"><?= e($settings['phone']) ?></p>
                    <p><?= e($settings['email']) ?></p>
                </div>
                <div class="col-md-4 col-lg-3">
                    <h5><?= e(lang('newsletter')) ?></h5>
                    <form method="post" action="<?= e(base_url('/')) ?>" class="newsletter-form">
                        <?= csrf_field() ?>
                        <input type="hidden" name="form_type" value="newsletter">
                        <input class="form-control mb-2" type="email" name="email" placeholder="Enter email" required>
                        <button class="btn btn-brand w-100" type="submit">Subscribe</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="footer-bottom py-3">
            <div class="container d-flex flex-wrap justify-content-between gap-2">
                <span>© 2026 <?= e(app_config('name')) ?></span>
                <a href="<?= e(base_url('/admin')) ?>" class="text-decoration-none text-white-50">Admin Panel</a>
            </div>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?= e(asset('js/app.js')) ?>"></script>
</body>
</html>
