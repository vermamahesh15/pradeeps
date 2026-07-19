<section class="page-banner">
    <div class="container">
        <span class="section-kicker">Blog</span>
        <h1>Grid-based stories, category browsing, tags, and search-friendly layout.</h1>
    </div>
</section>
<section class="section-pad">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-8">
                <div class="row g-4">
                    <?php foreach ($items as $post): ?>
                        <div class="col-md-6">
                            <article class="blog-card blog-card-list">
                                <!-- <img src="<?= e($post['banner_image'] ?? $post['image'] ?? '') ?>" alt="<?= e($post['title']) ?>"> -->
                                <div class="blog-body">
                                    <span class="badge-soft"><?= e($post['category_name'] ?? $post['category'] ?? '') ?></span>
                                    <h3><?= e($post['title']) ?></h3>
                                    <div class="small text-muted mb-2"><?= e(format_date($post['published_at'] ?? $post['date'] ?? $post['created_at'] ?? '')) ?> · <?= e($post['author'] ?? '') ?></div>
                                    <p><?= e($post['excerpt'] ?? '') ?></p>
                                    <a href="<?= e(base_url('/blog/' . $post['slug'])) ?>" class="text-link">Continue reading</a>
                                </div>
                            </article>
                        </div>
                    <?php endforeach; ?>
                </div>
                <nav class="mt-4"><ul class="pagination"><li class="page-item active"><span class="page-link">1</span></li><li class="page-item"><a class="page-link" href="#">2</a></li></ul></nav>
            </div>
            <div class="col-lg-4">
                <div class="sidebar-panel mb-4">
                    <h3>Search</h3>
                    <input class="form-control" type="search" placeholder="Search posts">
                </div>
                <div class="sidebar-panel mb-4">
                    <h3>Categories</h3>
                    <ul class="list-unstyled sidebar-list">
                        <li><a href="#">Insights</a></li>
                        <li><a href="#">News</a></li>
                        <li><a href="#">Strategy</a></li>
                    </ul>
                </div>
                <div class="sidebar-panel">
                    <h3>Tags</h3>
                    <div class="filter-chips">
                        <span class="chip static">Community</span>
                        <span class="chip static">Education</span>
                        <span class="chip static">Health</span>
                        <span class="chip static">Volunteers</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
