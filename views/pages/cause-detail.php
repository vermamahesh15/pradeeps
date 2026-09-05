<?php
declare(strict_types=1);

$goal = (float)($item['goal_amount'] ?? $item['goal'] ?? 0);
$raised = (float)($item['raised_amount'] ?? $item['raised'] ?? 0);
$progress = $goal > 0 ? (int) round(($raised / $goal) * 100) : 0;
?>

<section class="page-banner">
    <div class="container">
        <div class="page-banner-content">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= e(base_url('/')) ?>">होम</a></li>
                    <li class="breadcrumb-item"><a href="<?= e(base_url('/campaigns')) ?>">अभियान</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><?= e($item['title']) ?></li>
                </ol>
            </nav>
            <div class="d-block mb-2">
                <span class="banner-kicker"><i class="fa-solid fa-hand-holding-heart me-1"></i> अभियान विवरण</span>
            </div>
            <h1><?= e($item['title']) ?></h1>
        </div>
    </div>
</section>

<section class="section-pad">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4">
                    <img class="w-100" style="max-height: 440px; object-fit: cover;" src="<?= e(!empty($item['image']) ? base_url($item['image']) : asset('images/slider_final_2.png')) ?>" alt="<?= e($item['title']) ?>">
                </div>

                <div class="lead fw-semibold text-primary mb-4">
                    <?= e($item['excerpt']) ?>
                </div>

                <div class="content-body mb-5">
                    <?= !empty($item['content']) ? $item['content'] : '<p>इस अभियान का मुख्य उद्देश्य समाज के जरूरतमंद वर्गों तक सीधी सहायता पहुँचाना, जन-जागरूकता का प्रसार करना और जनसहयोग के माध्यम से स्थायी समाधान प्रस्तुत करना है।</p>' ?>
                </div>

                <div class="p-4 bg-light rounded-4 border d-flex flex-wrap align-items-center justify-content-between gap-3">
                    <div>
                        <h5 class="fw-bold mb-1">इस अभियान में अपना योगदान दें</h5>
                        <p class="small text-muted mb-0">आपका सहयोग समाज में बड़ा बदलाव ला सकता है।</p>
                    </div>
                    <a href="<?= e(base_url('/donation')) ?>" class="btn btn-brand">
                        <i class="fa-solid fa-heart me-1"></i> अभी सहयोग करें
                    </a>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card border-0 shadow-sm rounded-4 p-4 sticky-top" style="top: 100px;">
                    <h4 class="fw-bold mb-3">अभियान स्थिति</h4>
                    
                    <?php if ($goal > 0): ?>
                        <div class="mb-4">
                            <div class="d-flex justify-content-between small fw-bold mb-1">
                                <span>प्राप्त: ₹<?= number_format($raised) ?></span>
                                <span class="text-accent"><?= $progress ?>%</span>
                            </div>
                            <div class="progress mb-2" style="height: 10px;">
                                <div class="progress-bar" style="width: <?= min(100, $progress) ?>%"></div>
                            </div>
                            <div class="small text-muted">कुल लक्ष्य: ₹<?= number_format($goal) ?></div>
                        </div>
                    <?php endif; ?>

                    <div class="d-grid gap-2 mb-4">
                        <a href="<?= e(base_url('/donation')) ?>" class="btn btn-brand py-2">
                            <i class="fa-solid fa-hand-holding-heart me-1"></i> सहयोग करें
                        </a>
                        <a href="<?= e(base_url('/volunteer')) ?>" class="btn btn-outline-brand py-2">
                            <i class="fa-solid fa-user-plus me-1"></i> स्वयंसेवक बनें
                        </a>
                    </div>

                    <hr>

                    <h6 class="fw-bold mb-2">साझा करें:</h6>
                    <div class="d-flex gap-2">
                        <a href="https://api.whatsapp.com/send?text=<?= urlencode($item['title'] . ' ' . base_url('/campaigns/' . ($item['slug'] ?? ''))) ?>" target="_blank" class="btn btn-sm btn-success rounded-circle" style="width:36px;height:36px;display:inline-flex;align-items:center;justify-content:center;"><i class="fa-brands fa-whatsapp"></i></a>
                        <a href="https://www.facebook.com/sharer/sharer.php?u=<?= urlencode(base_url('/campaigns/' . ($item['slug'] ?? ''))) ?>" target="_blank" class="btn btn-sm btn-primary rounded-circle" style="width:36px;height:36px;display:inline-flex;align-items:center;justify-content:center;"><i class="fa-brands fa-facebook-f"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
