<?php
declare(strict_types=1);
?>

<section class="page-banner">
    <div class="container">
        <div class="page-banner-content">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= e(base_url('/')) ?>">होम</a></li>
                    <li class="breadcrumb-item active" aria-current="page">कार्यक्रम</li>
                </ol>
            </nav>
            <div class="d-block mb-2">
                <span class="banner-kicker"><i class="fa-solid fa-calendar-days me-1"></i> सामाजिक गतिविधियां</span>
            </div>
            <h1>कार्यक्रम एवं सामाजिक समागम</h1>
            <p>रक्तदान शिविर, वृक्षारोपण, मतदाता जागरूकता और सांस्कृतिक आयोजनों का विवरण</p>
        </div>
    </div>
</section>

<section class="section-pad">
    <div class="container">
        <div class="row g-4">
            <?php if (!empty($items)): ?>
                <?php foreach ($items as $event): ?>
                    <?php 
                    $eventDate = $event['event_date'] ?? $event['date'] ?? 'now';
                    $time = strtotime($eventDate);
                    $day = date('d', $time);
                    $month = date('M', $time);
                    $year = date('Y', $time);
                    ?>
                    <div class="col-lg-6">
                        <div class="card border-0 shadow-sm rounded-4 overflow-hidden h-100 flex-row">
                            <div class="event-date-badge d-flex flex-column align-items-center justify-content-center p-3 text-center" style="min-width: 100px; background: var(--primary); color: #fff;">
                                <span class="event-date-day display-6 fw-bold text-warning"><?= $day ?></span>
                                <span class="event-date-month small text-uppercase"><?= $month ?></span>
                                <span class="small text-white-50"><?= $year ?></span>
                            </div>
                            <div class="card-body p-4 d-flex flex-column">
                                <span class="badge-brand mb-2 align-self-start">
                                    <?= e(ucfirst($event['status'] ?? 'आगामी')) ?>
                                </span>
                                <h4 class="h5 fw-bold mb-2">
                                    <a href="<?= e(base_url('/events/' . ($event['slug'] ?? ''))) ?>" class="text-dark">
                                        <?= e($event['title']) ?>
                                    </a>
                                </h4>
                                <p class="small text-muted mb-2">
                                    <i class="fa-solid fa-location-dot text-danger me-1"></i> <?= e($event['location'] ?? 'जयपुर / बाराबंकी') ?>
                                </p>
                                <p class="small text-muted flex-grow-1">
                                    <?= e($event['excerpt'] ?? mb_substr(strip_tags($event['description'] ?? ''), 0, 110) . '...') ?>
                                </p>
                                <div class="mt-3 pt-2 border-top">
                                    <a href="<?= e(base_url('/events/' . ($event['slug'] ?? ''))) ?>" class="btn btn-sm btn-outline-brand">
                                        पूरा विवरण देखें <i class="fa-solid fa-arrow-right ms-1"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12 text-center py-5">
                    <p class="text-muted">वर्तमान में कोई कार्यक्रम उपलब्ध नहीं है।</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>
