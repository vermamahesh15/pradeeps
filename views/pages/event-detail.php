<?php
declare(strict_types=1);

$eventDate = $item['event_date'] ?? $item['date'] ?? 'now';
$time = strtotime($eventDate);
?>

<section class="page-banner">
    <div class="container">
        <div class="page-banner-content">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= e(base_url('/')) ?>">होम</a></li>
                    <li class="breadcrumb-item"><a href="<?= e(base_url('/events')) ?>">कार्यक्रम</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><?= e($item['title']) ?></li>
                </ol>
            </nav>
            <div class="d-block mb-2">
                <span class="banner-kicker"><i class="fa-solid fa-calendar-check me-1"></i> कार्यक्रम विवरण</span>
            </div>
            <h1><?= e($item['title']) ?></h1>
        </div>
    </div>
</section>

<section class="section-pad">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-8">
                <?php if (!empty($item['image'])): ?>
                    <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4">
                        <img class="w-100" style="max-height: 440px; object-fit: cover;" src="<?= e(base_url($item['image'])) ?>" alt="<?= e($item['title']) ?>">
                    </div>
                <?php endif; ?>

                <div class="lead fw-semibold text-primary mb-4">
                    <?= e($item['excerpt'] ?? '') ?>
                </div>

                <div class="content-body mb-5">
                    <?= !empty($item['description']) || !empty($item['content']) ? ($item['description'] ?? $item['content']) : '<p>इस कार्यक्रम का मुख्य उद्देश्य समाज के विभिन्न वर्गों को एक मंच पर लाना, सामाजिक सरोकारों के प्रति जागरूकता उत्पन्न करना और जनसहयोग को बढ़ावा देना है।</p>' ?>
                </div>

                <div class="p-4 bg-light rounded-4 border d-flex flex-wrap align-items-center justify-content-between gap-3">
                    <div>
                        <h5 class="fw-bold mb-1">इस कार्यक्रम में भाग लें या सहयोग करें</h5>
                        <p class="small text-muted mb-0">स्वयंसेवक के रूप में सम्मिलित होकर अपना योगदान दें।</p>
                    </div>
                    <a href="<?= e(base_url('/volunteer')) ?>" class="btn btn-brand">
                        <i class="fa-solid fa-handshake-angle me-1"></i> सहभागिता दर्ज करें
                    </a>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card border-0 shadow-sm rounded-4 p-4 sticky-top" style="top: 100px;">
                    <h4 class="fw-bold mb-3">कार्यक्रम विवरण</h4>
                    
                    <ul class="list-unstyled d-flex flex-column gap-3 mb-4">
                        <li class="d-flex align-items-start gap-3">
                            <i class="fa-solid fa-calendar-day text-accent mt-1 fa-lg"></i>
                            <div>
                                <small class="text-muted d-block">दिनांक</small>
                                <strong><?= date('d F Y', $time) ?></strong>
                            </div>
                        </li>
                        <li class="d-flex align-items-start gap-3">
                            <i class="fa-solid fa-location-dot text-danger mt-1 fa-lg"></i>
                            <div>
                                <small class="text-muted d-block">स्थान / आयोजन स्थल</small>
                                <strong><?= e($item['location'] ?? 'जयपुर, राजस्थान') ?></strong>
                            </div>
                        </li>
                        <li class="d-flex align-items-start gap-3">
                            <i class="fa-solid fa-tag text-success mt-1 fa-lg"></i>
                            <div>
                                <small class="text-muted d-block">स्थिति</small>
                                <span class="badge-brand"><?= e(ucfirst($item['status'] ?? 'सक्रिय')) ?></span>
                            </div>
                        </li>
                    </ul>

                    <div class="d-grid gap-2">
                        <a href="<?= e(base_url('/volunteer')) ?>" class="btn btn-brand py-2">
                            <i class="fa-solid fa-user-plus me-1"></i> स्वयंसेवक बनें
                        </a>
                        <a href="<?= e(base_url('/contact')) ?>" class="btn btn-outline-brand py-2">
                            <i class="fa-solid fa-envelope me-1"></i> जानकारी प्राप्त करें
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
