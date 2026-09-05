<?php
declare(strict_types=1);
?>

<section class="page-banner">
    <div class="container">
        <div class="page-banner-content">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= e(base_url('/')) ?>">होम</a></li>
                    <li class="breadcrumb-item active" aria-current="page">गैलरी</li>
                </ol>
            </nav>
            <div class="d-block mb-2">
                <span class="banner-kicker"><i class="fa-solid fa-camera-retro me-1"></i> छायाचित्र संकलन</span>
            </div>
            <h1>सेवा, संस्कृति एवं जन-सरोकार की झलकियां</h1>
            <p>विभिन्न सामाजिक गतिविधियों, जन-जागरूकता अभियानों एवं साहित्य सम्मेलनों के छायाचित्र</p>
        </div>
    </div>
</section>

<section class="section-pad">
    <div class="container">
        <div class="d-flex flex-wrap gap-2 justify-content-center mb-5" id="galleryFilters">
            <button class="btn btn-sm btn-brand filter-btn active" data-filter="all">सभी छायाचित्र</button>
            <button class="btn btn-sm btn-outline-brand filter-btn" data-filter="community">समाज सेवा</button>
            <button class="btn btn-sm btn-outline-brand filter-btn" data-filter="blood">रक्तदान</button>
            <button class="btn btn-sm btn-outline-brand filter-btn" data-filter="environment">पर्यावरण</button>
            <button class="btn btn-sm btn-outline-brand filter-btn" data-filter="literature">साहित्य व सम्मान</button>
        </div>

        <div class="row g-4" id="galleryGrid">
            <?php if (!empty($items)): ?>
                <?php foreach ($items as $idx => $project): ?>
                    <?php 
                    $category = $project['category'] ?? 'community';
                    ?>
                    <div class="col-lg-4 col-md-6 gallery-item" data-cat="<?= e(strtolower($category)) ?>">
                        <div class="card border-0 shadow-sm rounded-4 overflow-hidden h-100 position-relative group-hover">
                            <a href="<?= e(base_url($project['image'])) ?>" target="_blank" class="d-block overflow-hidden position-relative">
                                <img src="<?= e(base_url($project['image'])) ?>" alt="<?= e($project['title']) ?>" class="w-100" style="height: 260px; object-fit: cover; transition: transform 0.4s ease;">
                                <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center" style="background: rgba(11,26,48,0.5); opacity: 0; transition: opacity 0.3s ease;">
                                    <span class="btn btn-light rounded-circle shadow" style="width:45px;height:45px;display:inline-flex;align-items:center;justify-content:center;">
                                        <i class="fa-solid fa-magnifying-glass-plus text-primary"></i>
                                    </span>
                                </div>
                            </a>
                            <div class="p-3 bg-white">
                                <span class="badge-brand small mb-1"><?= e($project['category'] ?? 'सेवा कार्य') ?></span>
                                <h5 class="fw-bold text-dark mb-1 h6"><?= e($project['title']) ?></h5>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12 text-center py-5">
                    <p class="text-muted">गैलरी में कोई छायाचित्र उपलब्ध नहीं है।</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const buttons = document.querySelectorAll('.filter-btn');
    const items = document.querySelectorAll('.gallery-item');

    buttons.forEach(btn => {
        btn.addEventListener('click', function() {
            buttons.forEach(b => {
                b.classList.remove('btn-brand', 'active');
                b.classList.add('btn-outline-brand');
            });
            this.classList.remove('btn-outline-brand');
            this.classList.add('btn-brand', 'active');

            const filter = this.getAttribute('data-filter');
            items.forEach(item => {
                if (filter === 'all' || item.getAttribute('data-cat') === filter || item.getAttribute('data-cat').includes(filter)) {
                    item.style.display = 'block';
                } else {
                    item.style.display = 'none';
                }
            });
        });
    });
});
</script>
