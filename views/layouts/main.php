<?php
declare(strict_types=1);

// Shared Phase 2/3 public shell. Admin pages use their own layout and are unaffected.
require __DIR__ . '/home.php';
return;

$settings = (new ContentModel())->getSettings();
$flashSuccess = flash('success');
$flashError = flash('error');
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
        <meta name="description" content="<?= e($settings['site_tagline'] ?? '') ?>">
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

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@500;600;700&family=Fraunces:ital,opsz,wght@0,9..144,600;0,9..144,700;1,9..144,400&family=Manrope:wght@400;500;600;700;800&family=Martel:wght@400;600;700;800&family=Noto+Serif+Devanagari:wght@400;500;600;700&family=Playfair+Display:ital,wght@0,500;0,600;0,700;1,400&display=swap" rel="stylesheet">
    
    <!-- Bootstrap 5.3 & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
    <link href="<?= e(asset('css/style.css')) ?>" rel="stylesheet">
</head>
<body>
    <!-- Top Scroll Progress Bar -->
    <div id="topScrollProgress" class="top-scroll-progress"></div>

    <!-- Top Utility Bar -->
    <div class="topbar">
        <div class="container d-flex flex-wrap gap-3 justify-content-between align-items-center">
            <div class="d-flex align-items-center gap-3">
                <?php if (!empty($settings['phone'])): ?>
                    <a href="tel:<?= e($settings['phone']) ?>" class="contact-item">
                        <i class="fa-solid fa-phone-volume me-2 text-warning"></i><?= e($settings['phone']) ?>
                    </a>
                <?php endif; ?>
                <?php if (!empty($settings['email'])): ?>
                    <span class="text-white-50 d-none d-sm-inline">|</span>
                    <a href="mailto:<?= e($settings['email']) ?>" class="contact-item d-none d-sm-inline-flex">
                        <i class="fa-solid fa-envelope me-2 text-warning"></i><?= e($settings['email']) ?>
                    </a>
                <?php endif; ?>
            </div>
            <div class="d-flex align-items-center gap-3">
                <div class="social-links d-none d-md-flex align-items-center gap-2">
                    <?php if (!empty($settings['facebook'])): ?>
                        <a href="<?= e($settings['facebook']) ?>" target="_blank" title="Facebook"><i class="fa-brands fa-facebook-f"></i></a>
                    <?php endif; ?>
                    <?php if (!empty($settings['instagram'])): ?>
                        <a href="<?= e($settings['instagram']) ?>" target="_blank" title="Instagram"><i class="fa-brands fa-instagram"></i></a>
                    <?php endif; ?>
                    <?php if (!empty($settings['linkedin'])): ?>
                        <a href="<?= e($settings['linkedin']) ?>" target="_blank" title="LinkedIn"><i class="fa-brands fa-linkedin-in"></i></a>
                    <?php endif; ?>
                </div>
                <div class="lang-switch-capsule">
                    <a href="?lang=en" class="<?= current_lang() === 'en' ? 'active' : '' ?>">EN</a>
                    <a href="?lang=hi" class="<?= current_lang() === 'hi' ? 'active' : '' ?>">HI</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Floating Island Navbar -->
    <header class="site-header">
        <div class="container">
            <nav class="navbar navbar-expand-lg nav-floating-island">
                <a class="navbar-brand" href="<?= e(base_url('/')) ?>">
                    <img src="<?= e(!empty($settings['logo']) ? base_url($settings['logo']) : asset('images/logo.png')) ?>" alt="<?= e(app_config('name')) ?>" style="max-height: 48px; width: auto; max-width: 220px; object-fit: contain;"> 
                </a>
                <button class="navbar-toggler border-0 shadow-none px-2" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu" aria-controls="navMenu" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navMenu">
                    <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-1">
                        <li class="nav-item"><a class="nav-link <?= is_active('/') ?>" href="<?= e(base_url('/')) ?>"><?= e(lang('home')) ?></a></li>
                        <li class="nav-item"><a class="nav-link <?= is_active('/about') ?>" href="<?= e(base_url('/about')) ?>"><?= e(lang('about')) ?></a></li>
                        <li class="nav-item"><a class="nav-link <?= is_active('/campaigns') ?>" href="<?= e(base_url('/campaigns')) ?>"><?= e(lang('causes')) ?></a></li>
                        <li class="nav-item"><a class="nav-link <?= is_active('/events') ?>" href="<?= e(base_url('/events')) ?>"><?= e(lang('events')) ?></a></li>
                        <li class="nav-item"><a class="nav-link <?= is_active('/portfolio') ?>" href="<?= e(base_url('/portfolio')) ?>"><?= e(lang('portfolio')) ?></a></li>
                        <li class="nav-item"><a class="nav-link <?= is_active('/blog') ?>" href="<?= e(base_url('/blog')) ?>"><?= e(lang('blog')) ?></a></li>
                        <li class="nav-item"><a class="nav-link <?= is_active('/contact') ?>" href="<?= e(base_url('/contact')) ?>"><?= e(lang('contact')) ?></a></li>
                        <li class="nav-item ms-lg-2">
                            <a class="nav-donate-pill <?= is_active('/donation') ?>" href="<?= e(base_url('/donation')) ?>">
                                <i class="fa-solid fa-heart"></i> <?= e(lang('donate')) ?>
                            </a>
                        </li>
                        <li class="nav-item ms-lg-2">
                            <a class="btn btn-brand btn-sm" href="<?= e(base_url('/volunteer')) ?>">
                                <i class="fa-solid fa-handshake-angle me-1"></i> <?= e(lang('volunteer')) ?>
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </header>

    <!-- Global Flash Notifications -->
    <?php if ($flashSuccess): ?>
        <div class="container mt-3">
            <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
                <i class="fa-solid fa-circle-check me-2"></i> <?= e($flashSuccess) ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    <?php endif; ?>
    <?php if ($flashError): ?>
        <div class="container mt-3">
            <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
                <i class="fa-solid fa-triangle-exclamation me-2"></i> <?= e($flashError) ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    <?php endif; ?>

    <!-- Main View Content -->
    <?php require $viewFile; ?>

    <!-- Premium Site Footer -->
    <footer class="site-footer pt-5">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-4 col-md-6">
                    <h4 class="footer-title d-flex align-items-center gap-2">
                        <span><?= e(app_config('name')) ?></span>
                    </h4>
                    <p class="text-white-50 mb-4"><?= e($settings['footer_text'] ?? 'Dedicated to social empowerment, education, literary preservation, and community service.') ?></p>
                    <div class="d-flex align-items-center gap-2">
                        <?php if (!empty($settings['facebook'])): ?>
                            <a href="<?= e($settings['facebook']) ?>" class="btn btn-sm btn-outline-light rounded-circle" style="width:36px;height:36px;display:inline-flex;align-items:center;justify-content:center;"><i class="fa-brands fa-facebook-f"></i></a>
                        <?php endif; ?>
                        <?php if (!empty($settings['instagram'])): ?>
                            <a href="<?= e($settings['instagram']) ?>" class="btn btn-sm btn-outline-light rounded-circle" style="width:36px;height:36px;display:inline-flex;align-items:center;justify-content:center;"><i class="fa-brands fa-instagram"></i></a>
                        <?php endif; ?>
                        <?php if (!empty($settings['linkedin'])): ?>
                            <a href="<?= e($settings['linkedin']) ?>" class="btn btn-sm btn-outline-light rounded-circle" style="width:36px;height:36px;display:inline-flex;align-items:center;justify-content:center;"><i class="fa-brands fa-linkedin-in"></i></a>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="col-lg-2 col-md-6">
                    <h5>त्वरित लिंक</h5>
                    <ul class="list-unstyled footer-links">
                        <li><a href="<?= e(base_url('/about')) ?>"><i class="fa-solid fa-chevron-right small text-warning"></i> <?= e(lang('about')) ?></a></li>
                        <li><a href="<?= e(base_url('/campaigns')) ?>"><i class="fa-solid fa-chevron-right small text-warning"></i> <?= e(lang('causes')) ?></a></li>
                        <li><a href="<?= e(base_url('/events')) ?>"><i class="fa-solid fa-chevron-right small text-warning"></i> <?= e(lang('events')) ?></a></li>
                        <li><a href="<?= e(base_url('/portfolio')) ?>"><i class="fa-solid fa-chevron-right small text-warning"></i> <?= e(lang('portfolio')) ?></a></li>
                        <li><a href="<?= e(base_url('/blog')) ?>"><i class="fa-solid fa-chevron-right small text-warning"></i> <?= e(lang('blog')) ?></a></li>
                        <li><a href="<?= e(base_url('/donation')) ?>"><i class="fa-solid fa-chevron-right small text-warning"></i> <?= e(lang('donate')) ?></a></li>
                    </ul>
                </div>

                <div class="col-lg-3 col-md-6">
                    <h5>संपर्क सूत्र</h5>
                    <div class="text-white-50 d-flex flex-column gap-2">
                        <?php if (!empty($settings['address'])): ?>
                            <div class="d-flex align-items-start gap-2">
                                <i class="fa-solid fa-location-dot text-warning mt-1"></i>
                                <span><?= e($settings['address']) ?></span>
                            </div>
                        <?php endif; ?>
                        <?php if (!empty($settings['phone'])): ?>
                            <div class="d-flex align-items-center gap-2">
                                <i class="fa-solid fa-phone text-warning"></i>
                                <span><?= e($settings['phone']) ?></span>
                            </div>
                        <?php endif; ?>
                        <?php if (!empty($settings['email'])): ?>
                            <div class="d-flex align-items-center gap-2">
                                <i class="fa-solid fa-envelope text-warning"></i>
                                <span><?= e($settings['email']) ?></span>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <h5><?= e(lang('newsletter')) ?></h5>
                    <p class="text-white-50 small mb-3">नवीनतम गतिविधियों एवं साहित्य संकलन के लिए हमारे साथ जुड़ें।</p>
                    <form method="post" action="<?= e(base_url('/')) ?>" class="newsletter-form">
                        <?= csrf_field() ?>
                        <input type="hidden" name="form_type" value="newsletter">
                        <div class="input-group mb-2">
                            <input class="form-control" type="email" name="email" placeholder="ईमेल पता दर्ज करें" required>
                            <button class="btn btn-brand" type="submit"><i class="fa-solid fa-paper-plane"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="footer-bottom py-3">
            <div class="container d-flex flex-wrap justify-content-between align-items-center gap-2">
                <span class="text-white-50">© <?= date('Y') ?> <?= e(app_config('name')) ?>. सर्वाधिकार सुरक्षित।</span>
                <a href="<?= e(base_url('/admin')) ?>" class="text-decoration-none text-white-50 hover-light">
                    <i class="fa-solid fa-lock me-1"></i> Admin Panel
                </a>
            </div>
        </div>
    </footer>

    <!-- Floating Interactive Speed-Dial Action Hub -->
    <div class="floating-action-hub">
        <div id="speedDialMenu" class="speed-dial-menu">
            <a href="https://api.whatsapp.com/send?phone=<?= preg_replace('/[^0-9]/', '', $settings['phone'] ?? '919876543210') ?>&text=<?= urlencode('नमस्ते, मैं प्रदीप सारंग से संपर्क करना चाहता हूँ।') ?>" target="_blank" class="speed-dial-btn whatsapp" title="WhatsApp पर संवाद करें">
                <i class="fa-brands fa-whatsapp"></i>
            </a>
            <a href="tel:<?= e($settings['phone'] ?? '') ?>" class="speed-dial-btn call" title="सीधे कॉल करें">
                <i class="fa-solid fa-phone"></i>
            </a>
            <a href="<?= e(base_url('/donation')) ?>" class="speed-dial-btn donate" title="सहयोग करें">
                <i class="fa-solid fa-heart"></i>
            </a>
            <a href="<?= e(base_url('/volunteer')) ?>" class="speed-dial-btn volunteer" title="स्वयंसेवक बनें">
                <i class="fa-solid fa-handshake-angle"></i>
            </a>
        </div>
        <button type="button" id="speedDialToggle" class="speed-dial-main-btn shadow-lg" title="त्वरित सेवाएं">
            <i class="fa-solid fa-bolt"></i>
        </button>
    </div>

    <!-- Back to Top Button -->
    <div id="backToTop" class="back-to-top" title="शीर्ष पर जाएं">
        <i class="fa-solid fa-arrow-up"></i>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?= e(asset('js/app.js')) ?>"></script>
    <script>
        // Scroll Progress Bar & Sticky Header
        const scrollBar = document.getElementById('topScrollProgress');
        const siteHeader = document.querySelector('.site-header');
        const backToTopBtn = document.getElementById('backToTop');

        window.addEventListener('scroll', function() {
            const totalHeight = document.documentElement.scrollHeight - window.innerHeight;
            if (totalHeight > 0) {
                const progress = (window.scrollY / totalHeight) * 100;
                if (scrollBar) scrollBar.style.width = Math.min(100, Math.max(0, progress)) + '%';
            }

            if (siteHeader) {
                if (window.scrollY > 40) {
                    siteHeader.classList.add('scrolled');
                } else {
                    siteHeader.classList.remove('scrolled');
                }
            }

            if (backToTopBtn) {
                if (window.scrollY > 300) {
                    backToTopBtn.classList.add('visible');
                } else {
                    backToTopBtn.classList.remove('visible');
                }
            }
        });

        if (backToTopBtn) {
            backToTopBtn.addEventListener('click', function() {
                window.scrollTo({ top: 0, behavior: 'smooth' });
            });
        }
    </script>
</body>
</html>
