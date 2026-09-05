<?php
declare(strict_types=1);
?>

<section class="section-pad d-flex align-items-center" style="min-height: 70vh;">
    <div class="container text-center py-5">
        <div class="stat-icon mx-auto mb-4" style="width: 90px; height: 90px; font-size: 2.5rem; background: var(--accent-subtle); color: var(--accent);">
            <i class="fa-solid fa-compass"></i>
        </div>
        <span class="section-kicker">४०४ त्रुटि / 404 Error</span>
        <h1 class="display-5 fw-bold text-primary mb-3">पेज नहीं मिला (Page Not Found)</h1>
        <p class="text-muted max-w-600 mx-auto mb-4">
            जिस पृष्ठ को आप खोज रहे हैं वह उपलब्ध नहीं है या उसका पता बदल दिया गया है।
        </p>
        <div class="d-flex justify-content-center gap-3">
            <a class="btn btn-brand" href="<?= e(base_url('/')) ?>">
                <i class="fa-solid fa-house me-1"></i> मुख्य पृष्ठ पर जाएं
            </a>
            <a class="btn btn-outline-brand" href="<?= e(base_url('/blog')) ?>">
                <i class="fa-solid fa-book-open me-1"></i> साहित्य संकलन
            </a>
        </div>
    </div>
</section>
