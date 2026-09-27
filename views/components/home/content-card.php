<article class="ps-card <?= $featured ? 'ps-card-feature' : '' ?> <?= ($kind === 'blog' || !ps_image_path($image)) ? 'ps-card-text' : '' ?>">
    <?php if ($kind !== 'blog' && ps_image_path($image)): ?><a class="ps-card-image" href="<?= e($url) ?>" tabindex="-1" aria-hidden="true"><?php ps_image($image, ''); ?></a><?php endif; ?>
    <div class="ps-card-body">
        <span class="ps-eyebrow"><?= e($item['category_name'] ?? ($kind === 'campaigns' ? ps_text('जन-अभियान','COMMUNITY INITIATIVE') : ps_text('साहित्य संकलन','FROM THE JOURNAL'))) ?></span>
        <h3 lang="<?= ps_content_lang($title) ?>"><a href="<?= e($url) ?>"><?= e($title) ?></a></h3>
        <?php if ($excerpt): ?><p lang="<?= ps_content_lang($excerpt) ?>"><?= e($excerpt) ?></p><?php endif; ?>
        <?php if ($kind === 'blog' && !empty($item['published_at'])): ?><p class="ps-meta"><time datetime="<?= e(date('Y-m-d', strtotime($item['published_at']))) ?>"><?= e(format_date($item['published_at'])) ?></time> · <span lang="<?= ps_content_lang($item['author'] ?? '') ?>"><?= e($item['author'] ?? '') ?></span></p><?php endif; ?>
        <a class="ps-link" href="<?= e($url) ?>"><?= e($kind === 'blog' ? ps_text('रचना पढ़ें','Read the story') : ps_text('अभियान जानें','Explore initiative')) ?> <span aria-hidden="true">↗</span><span class="ps-sr-only"> — <?= e($title) ?></span></a>
    </div>
</article>
