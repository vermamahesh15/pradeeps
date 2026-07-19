<section class="page-banner">
    <div class="container">
        <span class="section-kicker">Causes</span>
        <h1>Campaigns with visible momentum and clear calls to action.</h1>
    </div>
</section>
<section class="section-pad">
    <div class="container">
        <div class="row g-4">
            <?php foreach ($items as $cause): ?>
                <?php $progress = (int) round(($cause['raised'] / $cause['goal']) * 100); ?>
                <div class="col-lg-4 col-md-6">
                    <article class="cause-card">
                        <img loading="lazy" src="<?= e($cause['image']) ?>" alt="<?= e($cause['title']) ?>">
                        <div class="cause-body">
                            <h3><?= e($cause['title']) ?></h3>
                            <p><?= e($cause['excerpt']) ?></p>
                            <div class="progress mb-3"><div class="progress-bar" style="width: <?= $progress ?>%"></div></div>
                            <!-- <div class="d-flex justify-content-between small text-muted">
                                <span><?= $progress ?>% funded</span>
                                <span>₹<?= number_format($cause['goal']) ?></span>
                            </div> -->
                            <div class="d-flex gap-2 mt-3">
                                <a class="btn btn-dark" href="<?= e(base_url('/campaigns/' . $cause['slug'])) ?>">View</a>
                                <a class="btn btn-outline-dark" href="#">Donate</a>
                            </div>
                        </div>
                    </article>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
