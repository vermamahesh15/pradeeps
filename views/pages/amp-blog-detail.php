<?php
declare(strict_types=1);

$post = $post ?? [];
$postTitle = html_entity_decode(trim($post['title'] ?? '') ?: 'झरिहख', ENT_QUOTES | ENT_HTML5, 'UTF-8');
$postCategory = html_entity_decode(trim($post['category_name'] ?? '') ?: 'अवधी संस्मरण', ENT_QUOTES | ENT_HTML5, 'UTF-8');
$postAuthor = html_entity_decode(trim(($post['author'] ?? '') ?: ($post['author_name'] ?? 'श्री प्रदीप सारंग')), ENT_QUOTES | ENT_HTML5, 'UTF-8');
$postDate = !empty($post['published_at']) ? date('d M Y', strtotime($post['published_at'])) : date('d M Y');

$rawImg = !empty($post['featured_image']) ? $post['featured_image'] : (!empty($post['banner_image']) ? $post['banner_image'] : (!empty($post['image']) ? $post['image'] : (!empty($post['image_url']) ? $post['image_url'] : '')));
$bannerImage = $rawImg ? (preg_match('#^https?://#i', $rawImg) ? $rawImg : base_url($rawImg)) : null;

$contentAmp = ps_amp_content($post['content'] ?? $post['excerpt'] ?? '');
?>

<article class="amp-card">
    <div style="font-size: 12px; color: var(--secondary); font-weight: bold; text-transform: uppercase; margin-bottom: 6px;">
        <?= e($postCategory) ?>
    </div>
    
    <h1 class="amp-article-title"><?= e($postTitle) ?></h1>

    <div class="amp-meta">
        <span>लेखक: <strong class="amp-meta-author"><?= e($postAuthor) ?></strong></span>
        <span>•</span>
        <span><?= e($postDate) ?></span>
    </div>

    <?php if ($bannerImage): ?>
        <div style="margin-bottom: 24px; border-radius: 8px; overflow: hidden;">
            <amp-img src="<?= e($bannerImage) ?>" width="800" height="450" layout="responsive" alt="<?= e($postTitle) ?>"></amp-img>
        </div>
    <?php endif; ?>

    <div class="amp-content">
        <?= $contentAmp ?>
    </div>
</article>

<?php if (!empty($related)): ?>
    <div style="margin-top: 32px;">
        <h3 style="color: var(--primary-dark); border-bottom: 2px solid var(--primary); padding-bottom: 8px; margin-bottom: 16px;">संबंधित आलेख (Related Articles)</h3>
        <?php foreach ($related as $rel): ?>
            <div class="amp-card" style="padding: 14px; margin-bottom: 12px;">
                <h4 style="margin: 0 0 6px 0;">
                    <a href="<?= e(base_url('/blog/' . $rel['slug'] . '/amp')) ?>" style="color: var(--primary-dark); text-decoration: none; font-weight: bold;">
                        <?= e($rel['title']) ?>
                    </a>
                </h4>
                <p style="font-size: 13px; color: var(--text-muted); margin: 0;">
                    <?= e(ps_excerpt($rel['excerpt'] ?? $rel['content'] ?? '', 90)) ?>
                </p>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>
