<?php
declare(strict_types=1);
?>

<section class="page-banner">
    <div class="container">
        <div class="page-banner-content">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= e(base_url('/')) ?>">होम</a></li>
                    <li class="breadcrumb-item active" aria-current="page">साहित्य व आलेख</li>
                </ol>
            </nav>
            <div class="d-block mb-2">
                <span class="banner-kicker"><i class="fa-solid fa-feather-pointed me-1"></i> साहित्य एवं विचार</span>
            </div>
            <h1>प्रदीप सारंग का साहित्य एवं विचार संकलन</h1>
            <p>अवधी गद्य, निबंध, कहानियां, संस्मरण एवं सामाजिक विचारों का प्रामाणिक संकलन</p>
        </div>
    </div>
</section>

<section class="section-pad">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-8">
                <?php if (!empty($items)): ?>
                    <div class="row g-4">
                        <?php foreach ($items as $post): ?>
                            <div class="col-md-6">
                                <div class="literary-card h-100 d-flex flex-column">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <span class="badge-brand">
                                            <i class="fa-solid fa-feather-pointed me-1"></i> <?= e($post['category_name'] ?? 'साहित्य') ?>
                                        </span>
                                        <small class="text-muted"><i class="fa-regular fa-clock me-1"></i> 3-5 मिनट</small>
                                    </div>
                                    <h3 class="h4 mb-2">
                                        <a href="<?= e(base_url('/blog/' . $post['slug'])) ?>" class="text-dark">
                                            <?= e($post['title']) ?>
                                        </a>
                                    </h3>
                                    <div class="small text-muted mb-3">
                                        <i class="fa-regular fa-calendar me-1"></i> <?= e(format_date($post['published_at'] ?? $post['created_at'])) ?> · <strong><?= e($post['author'] ?? 'प्रदीप सारंग') ?></strong>
                                    </div>
                                    <p class="small text-muted flex-grow-1">
                                        <?= e(!empty($post['excerpt']) ? $post['excerpt'] : mb_substr(strip_tags($post['content']), 0, 130) . '...') ?>
                                    </p>
                                    <div class="mt-3 pt-3 border-top d-flex justify-content-between align-items-center">
                                        <a href="<?= e(base_url('/blog/' . $post['slug'])) ?>" class="btn btn-sm btn-brand">
                                            <i class="fa-solid fa-book-open me-1"></i> पुस्तक रूप में पढ़ें
                                        </a>
                                        <a href="<?= e(base_url('/blog/' . $post['slug'])) ?>" class="text-muted small">
                                            <i class="fa-solid fa-share-nodes"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <div class="text-center py-5">
                        <p class="text-muted">वर्तमान में कोई रचना उपलब्ध नहीं है।</p>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
                    <h5 class="fw-bold mb-3"><i class="fa-solid fa-magnifying-glass text-accent me-2"></i> रचना खोजें</h5>
                    <div class="input-group">
                        <input class="form-control" type="search" placeholder="शीर्षक या विषय लिखें...">
                        <button class="btn btn-brand" type="button"><i class="fa-solid fa-search"></i></button>
                    </div>
                </div>

                <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
                    <h5 class="fw-bold mb-3"><i class="fa-solid fa-layer-group text-accent me-2"></i> श्रेणियां (Categories)</h5>
                    <ul class="list-unstyled mb-0 d-flex flex-column gap-2">
                        <?php if (!empty($categories)): ?>
                            <?php foreach ($categories as $cat): ?>
                                <li>
                                    <a href="<?= e(base_url('/blog?category=' . ($cat['slug'] ?? ''))) ?>" class="d-flex justify-content-between align-items-center text-dark py-1 px-2 rounded-2 hover-bg-light">
                                        <span><i class="fa-solid fa-chevron-right text-warning small me-2"></i> <?= e($cat['name']) ?></span>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <li><a href="#" class="text-dark"><i class="fa-solid fa-chevron-right text-warning small me-2"></i> अवधी गद्य</a></li>
                            <li><a href="#" class="text-dark"><i class="fa-solid fa-chevron-right text-warning small me-2"></i> साक्षात्कार व संस्मरण</a></li>
                            <li><a href="#" class="text-dark"><i class="fa-solid fa-chevron-right text-warning small me-2"></i> सामाजिक आलेख</a></li>
                        <?php endif; ?>
                    </ul>
                </div>

                <div class="card border-0 shadow-sm rounded-4 p-4 text-center bg-light">
                    <i class="fa-solid fa-feather-pointed text-accent fa-2x mb-2"></i>
                    <h5 class="fw-bold mb-1">साहित्यिक विचार साझा करें</h5>
                    <p class="small text-muted mb-3">प्रदीप सारंग के साहित्य एवं रचनाओं पर अपने विचार या समीक्षा भेजें।</p>
                    <a href="<?= e(base_url('/contact')) ?>" class="btn btn-sm btn-outline-brand">
                        संदेश भेजें
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
