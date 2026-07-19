<section class="page-banner page-banner-detail" style="background-image:url('<?= e($post['banner_image'] ?? $post['image'] ?? '') ?>')">
    <div class="container">
        <span class="section-kicker"><?= e($post['category_name'] ?? $post['category'] ?? '') ?></span>
        <h1><?= e($post['title']) ?></h1>
        <p><?= e(format_date($post['published_at'] ?? $post['date'] ?? $post['created_at'] ?? '')) ?> · <?= e($post['author'] ?? '') ?></p>
    </div>
</section>
<section class="section-pad">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-8">
                <article class="post-content">
                    <?= $post['content'] ?>
                </article>
                <div class="share-strip mt-4">
                    <strong>Share:</strong>
                    <a href="#">Facebook</a>
                    <a href="#">LinkedIn</a>
                    <a href="#">WhatsApp</a>
                </div>
                <div class="sidebar-panel mt-4">
                    <h3>Comments</h3>
                    <form class="row g-3">
                        <div class="col-md-6"><input class="form-control" placeholder="Name"></div>
                        <div class="col-md-6"><input class="form-control" placeholder="Email"></div>
                        <div class="col-12"><textarea class="form-control" rows="4" placeholder="Comment"></textarea></div>
                        <div class="col-12"><button class="btn btn-dark" type="button">Post Comment</button></div>
                    </form>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="sidebar-panel">
                    <h3>Related Posts</h3>
                    <?php foreach (array_slice($related, 0, 3) as $item): ?>
                        <div class="related-post">
                            <!-- <img src="<?= e($item['image']) ?>" alt="<?= e($item['title']) ?>"> -->
                            <div>
                                <a href="<?= e(base_url('/blog/' . $item['slug'])) ?>"><?= e($item['title']) ?></a>
                                <span><?= e(format_date($item['date'])) ?></span>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</section>
