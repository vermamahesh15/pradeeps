<?php $progress = (int) round(($item['raised'] / $item['goal']) * 100); ?>
<section class="page-banner">
    <div class="container">
        <span class="section-kicker">Cause Detail</span>
        <h1><?= e($item['title']) ?></h1>
    </div>
</section>
<section class="section-pad">
    <div class="container">
        <div class="row g-5 align-items-start">
            <div class="col-lg-12">
                <img class="rounded-4 w-100 mb-4" src="<?= e($item['image']) ?>" alt="<?= e($item['title']) ?>">
                <p class="lead"><?= e($item['excerpt']) ?></p>
                <p><?= e($item['content']) ?></p>
            </div>
            <!-- <div class="col-lg-5">
                <div class="sidebar-panel">
                    <h3>Campaign Progress</h3>
                    <div class="progress mb-3"><div class="progress-bar" style="width: <?= $progress ?>%"></div></div>
                    <p class="mb-1">Raised: ₹<?= number_format($item['raised']) ?></p>
                    <p>Goal: ₹<?= number_format($item['goal']) ?></p>
                    <a href="#" class="btn btn-brand w-100">Donate Now</a>
                </div>
            </div> -->
        </div>
    </div>
</section>
