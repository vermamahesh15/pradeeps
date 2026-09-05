<?php
declare(strict_types=1);
$home = $page;
?>

<main class="homepage-main">
    <!-- Interactive Hero Section -->
    <section class="hero-section position-relative pt-5 pb-5">
        <div class="container py-4">
            <div class="row g-5 align-items-center">
                <!-- Left: Dynamic Typographic Statement -->
                <div class="col-lg-7 text-white">
                    <div class="d-inline-flex align-items-center gap-2 mb-3">
                        <span class="badge-gold shadow-sm">
                            <i class="fa-solid fa-certificate text-warning"></i> १५+ वर्ष समर्पित लोकसेवा
                        </span>
                        <span class="badge-brand shadow-sm">
                            <i class="fa-solid fa-feather-pointed"></i> साहित्य एवं संस्कृति संवर्धन
                        </span>
                    </div>

                    <h1 class="display-3 fw-bold text-white mb-2" style="font-family:'Fraunces','Noto Serif Devanagari',serif; letter-spacing: -1px;">
                        प्रदीप सारंग
                    </h1>

                    <div class="h3 fw-semibold mb-4 text-warning" style="font-family:'Noto Serif Devanagari',serif; min-height: 42px;">
                        <span id="typeWriterText">सामाजिक कार्यकर्ता</span><span class="typewriter-cursor"></span>
                    </div>

                    <p class="lead text-white-50 mb-4 pe-lg-4" style="font-size: 1.18rem; line-height: 1.85;">
                        समाज के समग्र विकास, शिक्षा, पर्यावरण संरक्षण, रक्तदान, जन-जागरूकता और अवधी एवं हिंदी भाषा-साहित्य के संरक्षण हेतु निरंतर सक्रिय एवं समर्पित जीवन।
                    </p>

                    <div class="d-flex flex-wrap gap-3 align-items-center mb-5">
                        <a href="<?= e(base_url('/campaigns')) ?>" class="btn btn-brand btn-lg shadow-lg">
                            <i class="fa-solid fa-compass me-1"></i> प्रमुख अभियान देखें
                        </a>
                        <a href="<?= e(base_url('/donation')) ?>" class="btn btn-outline-light rounded-pill px-4 py-3 fw-bold">
                            <i class="fa-solid fa-hand-holding-heart me-1 text-warning"></i> सहयोग करें
                        </a>
                        <a href="<?= e(base_url('/blog')) ?>" class="btn btn-dark-brand d-none d-sm-inline-flex px-4 py-3">
                            <i class="fa-solid fa-book-open me-1"></i> साहित्य संकलन
                        </a>
                    </div>

                    <!-- Quick Highlights Counter Strip -->
                    <div class="row g-3 pt-4 border-top border-white border-opacity-10 text-white">
                        <div class="col-4">
                            <div class="d-flex align-items-center gap-2">
                                <i class="fa-solid fa-users text-warning fa-xl"></i>
                                <div>
                                    <h4 class="mb-0 fw-bold stat-number-animated text-white fs-4" data-target="10000" data-suffix="+">10,000+</h4>
                                    <small class="text-white-50">लाभान्वित नागरिक</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="d-flex align-items-center gap-2">
                                <i class="fa-solid fa-tree text-success fa-xl"></i>
                                <div>
                                    <h4 class="mb-0 fw-bold stat-number-animated text-white fs-4" data-target="25000" data-suffix="+">25,000+</h4>
                                    <small class="text-white-50">वृक्षारोपण अभियान</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="d-flex align-items-center gap-2">
                                <i class="fa-solid fa-droplet text-danger fa-xl"></i>
                                <div>
                                    <h4 class="mb-0 fw-bold stat-number-animated text-white fs-4" data-target="1500" data-suffix="+">1,500+</h4>
                                    <small class="text-white-50">रक्तदान यूनिट संग्रह</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right: Interactive 3D Leader Card of Pradeep Sarang -->
                <div class="col-lg-5">
                    <div class="interactive-3d-card position-relative p-2">
                        <div class="position-relative overflow-hidden rounded-4 shadow-lg border border-4 border-white bg-dark">
                            <img class="w-100" src="<?= asset('images/pradeepsarang.png') ?>" alt="प्रदीप सारंग" style="min-height: 480px; object-fit: cover; object-position: top center;">
                            <div class="position-absolute bottom-0 start-0 w-100 p-4 text-white" style="background: linear-gradient(180deg, transparent 0%, rgba(8, 20, 38, 0.95) 85%);">
                                <span class="badge bg-warning text-dark fw-bold mb-1">संस्थापक एवं साहित्यकार</span>
                                <h3 class="fw-bold mb-0 text-white">प्रदीप सारंग</h3>
                                <small class="text-white-50">दीपावली की पावन भोर (20 अक्टूबर 1969) में जन्मे लोकसेवक</small>
                            </div>
                        </div>

                        <!-- Floating Glass Stat Badges -->
                        <div class="hero-glass-badge position-absolute top-0 start-0 m-3 d-none d-sm-inline-flex">
                            <i class="fa-solid fa-award text-warning fa-lg"></i>
                            <div>
                                <small class="d-block text-muted" style="font-size:0.7rem;line-height:1;">सम्मानित</small>
                                <strong class="text-dark small">राज्य व राष्ट्रीय सम्मान</strong>
                            </div>
                        </div>

                        <div class="hero-glass-badge position-absolute bottom-0 end-0 m-4 d-none d-sm-inline-flex">
                            <i class="fa-solid fa-feather-pointed text-danger fa-lg"></i>
                            <div>
                                <small class="d-block text-muted" style="font-size:0.7rem;line-height:1;">साहित्य</small>
                                <strong class="text-dark small">अवधी गद्य संवर्धन</strong>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Live Announcement Strip -->
        <div class="hero-marquee">
            <div class="container d-flex align-items-center justify-content-between flex-wrap gap-2">
                <div class="d-flex align-items-center gap-2">
                    <span class="badge bg-warning text-dark fw-bold text-uppercase px-2 py-1">सूचना</span>
                    <span class="small text-white-50">नवीनतम सामाजिक अभियान एवं अवधी साहित्य संकलन वेबसाइट पर उपलब्ध हैं।</span>
                </div>
                <a href="<?= e(base_url('/blog')) ?>" class="small text-warning fw-bold text-decoration-none">
                    साहित्य संकलन पढ़ें <i class="fa-solid fa-arrow-right ms-1"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- Interactive Person Portfolio & Impact Explorer -->
    <section class="section-pad">
        <div class="container">
            <div class="text-center max-w-700 mx-auto mb-5">
                <span class="banner-kicker mb-2"><i class="fa-solid fa-layer-group me-1"></i> कार्यक्षेत्र एवं प्रभाव</span>
                <h2 class="section-title">प्रदीप सारंग का बहुआयामी व्यक्तित्व</h2>
                <p class="text-muted">विभिन्न क्षेत्रों में सक्रियता एवं समाज निर्माण में विशिष्ट योगदान का इंटरएक्टिव संकलन</p>

                <!-- Interactive Filter Matrix Tabs -->
                <div class="d-flex flex-wrap gap-2 justify-content-center mt-4">
                    <button type="button" class="interactive-filter-btn active" data-filter="all">सभी आयाम (All)</button>
                    <button type="button" class="interactive-filter-btn" data-filter="literature">📖 साहित्य व संस्कृति</button>
                    <button type="button" class="interactive-filter-btn" data-filter="health">🩸 रक्तदान व स्वास्थ्य</button>
                    <button type="button" class="interactive-filter-btn" data-filter="environment">🌿 पर्यावरण व जल</button>
                    <button type="button" class="interactive-filter-btn" data-filter="awareness">🗳️ मतदाता जागरूकता</button>
                </div>
            </div>

            <!-- Filterable Cards Grid -->
            <div class="row g-4" id="portfolioMatrix">
                <!-- Card 1: Literature -->
                <div class="col-md-6 col-lg-3 filterable-card" data-category="literature">
                    <div class="card border-0 shadow-sm rounded-4 p-4 h-100 bg-white border-top border-4 border-danger">
                        <div class="stat-icon bg-danger bg-opacity-10 text-danger"><i class="fa-solid fa-feather-pointed"></i></div>
                        <h4 class="h5 fw-bold mb-2">अवधी भाषा व साहित्य</h4>
                        <p class="small text-muted mb-3">अवधी गद्य, कहानियों, संस्मरणों एवं निबंधों की रचना कर लोक-संस्कृति को नई पहचान दी।</p>
                        <a href="<?= e(base_url('/blog')) ?>" class="mt-auto small fw-bold text-danger">रचनाएं पढ़ें <i class="fa-solid fa-arrow-right ms-1"></i></a>
                    </div>
                </div>

                <!-- Card 2: Health / Blood -->
                <div class="col-md-6 col-lg-3 filterable-card" data-category="health">
                    <div class="card border-0 shadow-sm rounded-4 p-4 h-100 bg-white border-top border-4 border-primary">
                        <div class="stat-icon bg-primary bg-opacity-10 text-primary"><i class="fa-solid fa-droplet"></i></div>
                        <h4 class="h5 fw-bold mb-2">रक्तदान एवं स्वास्थ्य</h4>
                        <p class="small text-muted mb-3">सैकड़ों रक्तदान शिविरों का सफल आयोजन, आपातकालीन रक्त सहायता नेटवर्क का संचालन।</p>
                        <a href="<?= e(base_url('/campaigns')) ?>" class="mt-auto small fw-bold text-primary">अभियान देखें <i class="fa-solid fa-arrow-right ms-1"></i></a>
                    </div>
                </div>

                <!-- Card 3: Environment -->
                <div class="col-md-6 col-lg-3 filterable-card" data-category="environment">
                    <div class="card border-0 shadow-sm rounded-4 p-4 h-100 bg-white border-top border-4 border-success">
                        <div class="stat-icon bg-success bg-opacity-10 text-success"><i class="fa-solid fa-tree"></i></div>
                        <h4 class="h5 fw-bold mb-2">पर्यावरण संरक्षण</h4>
                        <p class="small text-muted mb-3">२५,००० से अधिक वृक्षारोपण, निःशुल्क पौधा वितरण और जल संरक्षण जनजागरूकता कार्यक्रम।</p>
                        <a href="<?= e(base_url('/campaigns')) ?>" class="mt-auto small fw-bold text-success">विस्तार से जानें <i class="fa-solid fa-arrow-right ms-1"></i></a>
                    </div>
                </div>

                <!-- Card 4: Awareness / Voting -->
                <div class="col-md-6 col-lg-3 filterable-card" data-category="awareness">
                    <div class="card border-0 shadow-sm rounded-4 p-4 h-100 bg-white border-top border-4 border-warning">
                        <div class="stat-icon bg-warning bg-opacity-10 text-warning"><i class="fa-solid fa-check-to-slot"></i></div>
                        <h4 class="h5 fw-bold mb-2">मतदाता व नागरिक जागरूकता</h4>
                        <p class="small text-muted mb-3">लोकतंत्र के सशक्तिकरण हेतु मतदान के महत्व का व्यापक प्रचार एवं युवा चेतना अभियान।</p>
                        <a href="<?= e(base_url('/about')) ?>" class="mt-auto small fw-bold text-warning">परिचय पढ़ें <i class="fa-solid fa-arrow-right ms-1"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Key Campaigns / Causes Section -->
    <?php if (!empty($home['campaigns'])): ?>
        <section class="section-pad section-tint border-top border-bottom">
            <div class="container">
                <div class="d-flex flex-wrap justify-content-between align-items-end mb-5 gap-3">
                    <div>
                        <span class="banner-kicker mb-2"><i class="fa-solid fa-hand-holding-heart me-1"></i> सक्रिय सेवा कार्य</span>
                        <h2 class="section-title mb-0">प्रमुख अभियान एवं मिशन</h2>
                    </div>
                    <a href="<?= e(base_url('/campaigns')) ?>" class="btn btn-outline-brand">
                        सभी अभियान देखें <i class="fa-solid fa-arrow-right ms-1"></i>
                    </a>
                </div>

                <div class="row g-4">
                    <?php foreach ($home['campaigns'] as $cause): ?>
                        <?php 
                        $goal = (float)($cause['goal_amount'] ?? 0);
                        $raised = (float)($cause['raised_amount'] ?? 0);
                        $progress = $goal > 0 ? (int) round(($raised / $goal) * 100) : 0; 
                        ?>
                        <div class="col-lg-4 col-md-6">
                            <article class="cause-card">
                                <div class="cause-img-wrap">
                                    <img loading="lazy" src="<?= e(!empty($cause['image']) ? base_url($cause['image']) : asset('images/slider_final_2.png')) ?>" alt="<?= e($cause['title']) ?>">
                                    <span class="cause-category-badge">सामाजिक अभियान</span>
                                </div>
                                <div class="cause-body">
                                    <h3>
                                        <a href="<?= e(base_url('/campaigns/' . $cause['slug'])) ?>"><?= e($cause['title']) ?></a>
                                    </h3>
                                    <p class="small text-muted flex-grow-1"><?= e($cause['excerpt']) ?></p>
                                    
                                    <?php if ($goal > 0): ?>
                                        <div class="cause-progress-wrap">
                                            <div class="d-flex justify-content-between small fw-bold mb-1">
                                                <span>संग्रह: ₹<?= number_format($raised) ?></span>
                                                <span class="text-accent"><?= $progress ?>%</span>
                                            </div>
                                            <div class="progress mb-2">
                                                <div class="progress-bar" role="progressbar" style="width: <?= min(100, $progress) ?>%"></div>
                                            </div>
                                            <div class="small text-muted">लक्ष्य: ₹<?= number_format($goal) ?></div>
                                        </div>
                                    <?php endif; ?>

                                    <div class="d-flex gap-2 mt-4 pt-3 border-top">
                                        <a href="<?= e(base_url('/campaigns/' . $cause['slug'])) ?>" class="btn btn-sm btn-dark-brand flex-grow-1">
                                            विवरण देखें
                                        </a>
                                        <a href="<?= e(base_url('/donation')) ?>" class="btn btn-sm btn-brand">
                                            सहयोग करें
                                        </a>
                                    </div>
                                </div>
                            </article>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <!-- Interactive Literary Bookshelf (डिजिटल पुस्तकालय) -->
    <?php if (!empty($home['blogs'])): ?>
        <section class="section-pad">
            <div class="container">
                <div class="d-flex flex-wrap justify-content-between align-items-end mb-5 gap-3">
                    <div>
                        <span class="banner-kicker mb-2"><i class="fa-solid fa-feather-pointed me-1"></i> डिजिटल पुस्तकालय</span>
                        <h2 class="section-title mb-0">प्रदीप सारंग का साहित्य संकलन</h2>
                    </div>
                    <a href="<?= e(base_url('/blog')) ?>" class="btn btn-outline-brand">
                        सभी रचनाएं पढ़ें <i class="fa-solid fa-arrow-right ms-1"></i>
                    </a>
                </div>

                <div class="row g-4">
                    <?php foreach ($home['blogs'] as $story): ?>
                        <?php 
                        $excerptText = !empty($story['excerpt']) ? $story['excerpt'] : mb_substr(strip_tags($story['content']), 0, 160) . '...';
                        ?>
                        <div class="col-lg-4 col-md-6">
                            <div class="literary-card h-100 d-flex flex-column">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <span class="badge-brand">
                                        <i class="fa-solid fa-feather-pointed me-1"></i> <?= e($story['category_name'] ?? 'साहित्य') ?>
                                    </span>
                                    <small class="text-muted"><i class="fa-regular fa-clock me-1"></i> 3-5 मिनट</small>
                                </div>
                                <h3 class="mb-2">
                                    <a href="<?= e(base_url('/blog/' . $story['slug'])) ?>" class="text-dark">
                                        <?= e($story['title']) ?>
                                    </a>
                                </h3>
                                <div class="small text-muted mb-3">
                                    <i class="fa-regular fa-calendar me-1"></i> <?= e(format_date($story['published_at'] ?? $story['created_at'])) ?> · <strong><?= e($story['author'] ?? 'प्रदीप सारंग') ?></strong>
                                </div>
                                <p class="small text-muted flex-grow-1">
                                    <?= e($excerptText) ?>
                                </p>
                                
                                <div class="mt-3 pt-3 border-top d-flex gap-2">
                                    <button type="button" class="btn btn-sm btn-outline-brand flex-grow-1 quick-read-trigger" 
                                            data-title="<?= e($story['title']) ?>"
                                            data-author="<?= e($story['author'] ?? 'प्रदीप सारंग') ?>"
                                            data-category="<?= e($story['category_name'] ?? 'साहित्य') ?>"
                                            data-excerpt="<?= e($excerptText) ?>"
                                            data-link="<?= e(base_url('/blog/' . $story['slug'])) ?>">
                                        <i class="fa-solid fa-eye me-1"></i> त्वरित सार
                                    </button>
                                    <a href="<?= e(base_url('/blog/' . $story['slug'])) ?>" class="btn btn-sm btn-brand">
                                        <i class="fa-solid fa-book-open me-1"></i> पूरी पुस्तक
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <!-- Events & Initiatives -->
    <?php if (!empty($home['events'])): ?>
        <section class="section-pad section-tint border-top">
            <div class="container">
                <div class="d-flex flex-wrap justify-content-between align-items-end mb-5 gap-3">
                    <div>
                        <span class="banner-kicker mb-2"><i class="fa-solid fa-calendar-days me-1"></i> सामाजिक गतिविधियां</span>
                        <h2 class="section-title mb-0">आगामी एवं प्रमुख कार्यक्रम</h2>
                    </div>
                    <a href="<?= e(base_url('/events')) ?>" class="btn btn-outline-brand">
                        सभी कार्यक्रम <i class="fa-solid fa-arrow-right ms-1"></i>
                    </a>
                </div>

                <div class="row g-4">
                    <?php foreach (array_slice($home['events'], 0, 4) as $ev): ?>
                        <?php 
                        $time = strtotime($ev['event_date'] ?? 'now');
                        $day = date('d', $time);
                        $month = date('M', $time);
                        ?>
                        <div class="col-lg-6">
                            <div class="event-card h-100">
                                <div class="event-date-badge">
                                    <span class="event-date-day"><?= $day ?></span>
                                    <span class="event-date-month"><?= $month ?></span>
                                </div>
                                <div class="event-body d-flex flex-column justify-content-between">
                                    <div>
                                        <h4 class="h5 mb-2">
                                            <a href="<?= e(base_url('/events/' . ($ev['slug'] ?? ''))) ?>" class="text-dark">
                                                <?= e($ev['title']) ?>
                                            </a>
                                        </h4>
                                        <p class="small text-muted mb-2">
                                            <i class="fa-solid fa-location-dot text-danger me-1"></i> <?= e($ev['location'] ?? 'जयपुर, राजस्थान') ?>
                                        </p>
                                        <p class="small text-muted mb-0">
                                            <?= e(mb_substr(strip_tags($ev['description'] ?? ''), 0, 95)) ?>...
                                        </p>
                                    </div>
                                    <div class="mt-3 pt-2 border-top">
                                        <a href="<?= e(base_url('/events/' . ($ev['slug'] ?? ''))) ?>" class="small fw-bold text-accent">
                                            विवरण देखें <i class="fa-solid fa-arrow-right ms-1"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <!-- Photo Gallery / Moments of Service with Lightbox -->
    <?php if (!empty($home['gallery'])): ?>
        <section class="section-pad">
            <div class="container">
                <div class="d-flex flex-wrap justify-content-between align-items-end mb-4 gap-3">
                    <div>
                        <span class="banner-kicker mb-2"><i class="fa-solid fa-camera-retro me-1"></i> छायाचित्र संकलन</span>
                        <h2 class="section-title mb-0">सेवा एवं गतिविधियों की झलकियां</h2>
                    </div>
                    <a href="<?= e(base_url('/portfolio')) ?>" class="btn btn-outline-brand">
                        पूरी गैलरी देखें <i class="fa-solid fa-arrow-right ms-1"></i>
                    </a>
                </div>

                <div class="row g-3">
                    <?php foreach (array_slice($home['gallery'], 0, 8) as $img): ?>
                        <div class="col-6 col-md-4 col-lg-3">
                            <a href="<?= e(base_url($img['image'])) ?>" data-title="<?= e($img['title'] ?? 'छायाचित्र') ?>" class="gallery-card lightbox-trigger d-block position-relative rounded-4 overflow-hidden shadow-sm">
                                <img src="<?= e(base_url($img['image'])) ?>" alt="<?= e($img['title'] ?? 'गैलरी') ?>" class="w-100" style="aspect-ratio:1/1;object-fit:cover;transition:transform 0.4s ease;">
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <!-- Call to Action Banner -->
    <section class="section-pad">
        <div class="container">
            <div class="cta-banner">
                <div class="row align-items-center g-4">
                    <div class="col-lg-8">
                        <h2>समाज निर्माण में सहभागी बनें</h2>
                        <p>
                            आपका एक छोटा सा सहयोग किसी के जीवन में बड़ा परिवर्तन ला सकता है। हमारे साथ स्वयंसेवक के रूप में जुड़ें या समाज सेवा अभियानों में अपना सहयोग दें।
                        </p>
                    </div>
                    <div class="col-lg-4 text-lg-end">
                        <div class="d-flex flex-column flex-sm-row gap-3 justify-content-lg-end">
                            <a href="<?= e(base_url('/volunteer')) ?>" class="btn btn-brand btn-lg">
                                <i class="fa-solid fa-user-plus me-1"></i> स्वयंसेवक बनें
                            </a>
                            <a href="<?= e(base_url('/donation')) ?>" class="btn btn-light btn-lg text-primary fw-bold">
                                <i class="fa-solid fa-heart me-1 text-danger"></i> सहयोग करें
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
