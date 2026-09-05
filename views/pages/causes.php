<?php
declare(strict_types=1);
?>

<section class="page-banner">
    <div class="container">
        <div class="page-banner-content">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= e(base_url('/')) ?>">होम</a></li>
                    <li class="breadcrumb-item active" aria-current="page">अभियान</li>
                </ol>
            </nav>
            <div class="d-block mb-2">
                <span class="banner-kicker"><i class="fa-solid fa-seedling me-1"></i> जनसेवा एवं विकास</span>
            </div>
            <h1>प्रमुख अभियान एवं सामाजिक मिशन</h1>
            <p>समाज में सकारात्मक परिवर्तन लाने के उद्देश्य से संचालित जन-जागरूकता एवं सेवा कार्यक्रम</p>
        </div>
    </div>
</section>

<section class="section-pad">
    <div class="container">
        <div class="row g-4">
            <?php if (!empty($items)): ?>
                <?php foreach ($items as $cause): ?>
                    <?php 
                    $goal = (float)($cause['goal_amount'] ?? $cause['goal'] ?? 0);
                    $raised = (float)($cause['raised_amount'] ?? $cause['raised'] ?? 0);
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
            <?php else: ?>
                <div class="col-12 text-center py-5">
                    <p class="text-muted">वर्तमान में कोई अभियान उपलब्ध नहीं है।</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>
