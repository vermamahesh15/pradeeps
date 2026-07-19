<section class="page-banner">
    <div class="container">
        <span class="section-kicker">Portfolio</span>
        <h1>Original gallery layout with category filters and lightbox-ready media.</h1>
    </div>
</section>
<section class="section-pad">
    <div class="container">
        <div class="filter-chips mb-4">
            <button class="chip active" data-filter="all">All</button>
            <button class="chip" data-filter="Infrastructure">Infrastructure</button>
            <button class="chip" data-filter="Training">Training</button>
            <button class="chip" data-filter="Healthcare">Healthcare</button>
            <button class="chip" data-filter="Environment">Environment</button>
        </div>
        <div class="row g-4" id="portfolioGrid">
            <?php foreach ($items as $project): ?>
                <div class="col-lg-3 col-md-6 portfolio-filter-item" data-category="<?= e($project['category']) ?>">
                    <a href="<?= e($project['image']) ?>" class="portfolio-item card-stack lightbox-link">
                        <img src="<?= e($project['image']) ?>" alt="<?= e($project['title']) ?>">
                        <div class="portfolio-copy">
                            <span><?= e($project['category']) ?></span>
                            <h3><?= e($project['title']) ?></h3>
                            <p>Project details, outcomes, and gallery preview.</p>
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
