<?php
declare(strict_types=1);

$pageTitle = $title ?? 'पेज';
$pageContent = function_exists('ps_amp_content') ? ps_amp_content($content ?? '') : ($content ?? '');
$items = $items ?? [];
?>

<article class="amp-card">
    <h1 class="amp-article-title"><?= e($pageTitle) ?></h1>

    <?php if (!empty($subtitle)): ?>
        <p style="font-size: 15px; color: var(--secondary); margin: -4px 0 16px 0; font-weight: 600;">
            <?= e($subtitle) ?>
        </p>
    <?php endif; ?>

    <?php if (!empty($pageContent)): ?>
        <div class="amp-content">
            <?= $pageContent ?>
        </div>
    <?php endif; ?>

    <?php if (!empty($items)): ?>
        <div style="margin-top: 24px;">
            <?php foreach ($items as $item): ?>
                <?php
                $itemTitle = $item['title'] ?? $item['name'] ?? '';
                $itemExcerpt = $item['excerpt'] ?? $item['short_description'] ?? $item['description'] ?? '';
                $rawItemImg = $item['image'] ?? $item['banner_image'] ?? $item['thumbnail'] ?? '';
                $itemImg = $rawItemImg ? (preg_match('#^https?://#i', $rawItemImg) ? $rawItemImg : base_url($rawItemImg)) : '';
                $itemLink = $item['url'] ?? $item['link'] ?? (!empty($item['slug']) && !empty($itemRoutePrefix) ? base_url($itemRoutePrefix . '/' . $item['slug'] . '/amp') : '');
                ?>
                <div style="border-top: 1px solid var(--border-warm); padding-top: 18px; margin-top: 18px;">
                    <h2 style="font-size: 18px; margin: 0 0 8px 0; color: var(--primary-dark); font-weight: 700;">
                        <?php if ($itemLink): ?>
                            <a href="<?= e($itemLink) ?>" style="color: var(--primary-dark); text-decoration: none;">
                                <?= e($itemTitle) ?>
                            </a>
                        <?php else: ?>
                            <?= e($itemTitle) ?>
                        <?php endif; ?>
                    </h2>

                    <?php if (!empty($item['meta']) || !empty($item['date'])): ?>
                        <div style="font-size: 12px; color: var(--secondary); font-weight: 600; margin-bottom: 8px;">
                            <?= e($item['meta'] ?? $item['date'] ?? '') ?>
                        </div>
                    <?php endif; ?>

                    <?php if ($itemImg): ?>
                        <div style="border-radius: 8px; overflow: hidden; margin-bottom: 10px;">
                            <amp-img src="<?= e($itemImg) ?>" width="600" height="340" layout="responsive" alt="<?= e($itemTitle) ?>"></amp-img>
                        </div>
                    <?php endif; ?>

                    <?php if ($itemExcerpt): ?>
                        <p style="font-size: 14px; margin: 8px 0 0 0; color: var(--text-main); line-height: 1.6;">
                            <?= e(ps_excerpt($itemExcerpt, 180)) ?>
                        </p>
                    <?php endif; ?>

                    <?php if ($itemLink): ?>
                        <div style="margin-top: 8px;">
                            <a href="<?= e($itemLink) ?>" style="color: var(--primary); font-size: 13px; font-weight: bold; text-decoration: none;">
                                पढ़ें व विवरण देखें ⚡
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</article>

