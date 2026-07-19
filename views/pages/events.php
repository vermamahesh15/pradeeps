<section class="page-banner">
    <div class="container">
        <span class="section-kicker">Events</span>
        <h1>Upcoming and past experiences that strengthen community connection.</h1>
    </div>
</section>
<section class="section-pad">
    <div class="container">
        <div class="row g-4">
            <?php foreach ($items as $event): ?>
                <div class="col-lg-4 col-md-6">
                    <article class="event-card event-card-list">
                        <img src="<?= e($event['image']) ?>" alt="<?= e($event['title']) ?>">
                        <div class="event-content">
                            <span class="badge-soft"><?= e(ucfirst($event['status'])) ?></span>
                            <h3><?= e($event['title']) ?></h3>
                            <p><?= e($event['excerpt']) ?></p>
                            <div class="small text-muted mb-3"><?= e(format_date($event['date'])) ?> · <?= e($event['location']) ?></div>
                            <a href="<?= e(base_url('/events/' . $event['slug'])) ?>" class="btn btn-outline-dark">Details</a>
                        </div>
                    </article>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
