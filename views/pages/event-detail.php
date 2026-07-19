<section class="page-banner">
    <div class="container">
        <span class="section-kicker">Event Detail</span>
        <h1><?= e($item['title']) ?></h1>
    </div>
</section>
<section class="section-pad">
    <div class="container">
        <div class="row g-5 align-items-start">
            <div class="col-lg-8">
                <img class="rounded-4 w-100 mb-4" src="<?= e($item['image']) ?>" alt="<?= e($item['title']) ?>">
                <p class="lead"><?= e($item['excerpt']) ?></p>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec congue nisi sed dui posuere laoreet. Aliquam sit amet tortor mattis, consequat ipsum id, porttitor lacus.</p>
            </div>
            <div class="col-lg-4">
                <div class="sidebar-panel">
                    <h3>Event Information</h3>
                    <p><strong>Date:</strong> <?= e(format_date($item['date'])) ?></p>
                    <p><strong>Location:</strong> <?= e($item['location']) ?></p>
                    <p><strong>Status:</strong> <?= e(ucfirst($item['status'])) ?></p>
                    <a href="<?= e(base_url('/volunteer')) ?>" class="btn btn-brand w-100">Register Interest</a>
                </div>
            </div>
        </div>
    </div>
</section>
