<?php
declare(strict_types=1);

$pageTitle = $title ?? 'पेज';
$pageContent = ps_amp_content($content ?? '');
$items = $items ?? [];
?>

<article class="amp-card">
    <h1 class="amp-article-title"><?= e($pageTitle) ?></h1>

    <?php if ($pageContent): ?>
        <div class="amp-content">
            <?= $pageContent ?>
        </div>
    <?php endif; ?>

    <?php if (!empty($items)): ?>
        <div style="margin-top: 24px;">
            <?php foreach ($items as $item): ?>
                <div style="border-top: 1px solid var(--border-warm); padding-top: 16px; margin-top: 16px;">
                    <h3 style="margin: 0 0 8px 0; color: var(--primary-dark);"><?= e($item['title'] ?? '') ?></h3>
                    <?php if (!empty($item['image'])): ?>
                        <amp-img src="<?= e(base_url($item['image'])) ?>" width="600" height="350" layout="responsive" alt="<?= e($item['title'] ?? '') ?>"></amp-img>
                    <?php endif; ?>
                    <p style="font-size: 14px; margin-top: 8px; color: var(--text-main);"><?= e($item['excerpt'] ?? $item['description'] ?? '') ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</article>
