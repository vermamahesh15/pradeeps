<?php
declare(strict_types=1);

$blogs = $blogs ?? [];
$campaigns = $campaigns ?? [];
$siteName = app_config('name', 'Pradeep Sarang');
?>

<div class="amp-card" style="background: linear-gradient(135deg, #003e1a, #00652c); color: #ffffff; text-align: center; padding: 30px 20px;">
    <amp-img src="<?= e(base_url('assets/images/pradeepsarang.webp')) ?>" width="140" height="140" layout="fixed" alt="Pradeep Sarang" style="border-radius: 50%; border: 3px solid #ffffff; margin-bottom: 12px;"></amp-img>
    <h1 style="font-size: 26px; margin: 0 0 8px 0; color: #ffffff; font-weight: 800;"><?= e($siteName) ?></h1>
    <p style="font-size: 14px; opacity: 0.9; margin: 0 0 16px 0;">पर्यावरणविद् • लोकसेवक • अवधी साहित्यकार</p>
    <a href="<?= e(base_url('/volunteer')) ?>" class="amp-btn" style="background: #15803d; color: #ffffff;">अभियान से जुड़ें 🍃</a>
</div>

<section style="margin-bottom: 32px;">
    <h2 style="color: var(--primary-dark); border-bottom: 2px solid var(--primary); padding-bottom: 6px;">ताज़ा विचार व आलेख (Recent Articles)</h2>
    <?php foreach (array_slice($blogs, 0, 5) as $b): ?>
        <div class="amp-card">
            <span style="font-size: 11px; color: var(--secondary); font-weight: bold; text-transform: uppercase;">
                <?= e($b['category_name'] ?? 'साहित्य') ?>
            </span>
            <h3 style="margin: 6px 0 10px 0;">
                <a href="<?= e(base_url('/blog/' . $b['slug'] . '/amp')) ?>" style="color: var(--primary-dark); text-decoration: none; font-weight: bold;">
                    <?= e($b['title']) ?>
                </a>
            </h3>
            <p style="font-size: 14px; color: var(--text-main); margin-bottom: 12px;">
                <?= e($b['excerpt'] ?: ps_excerpt($b['content'] ?? '', 120)) ?>
            </p>
            <div style="font-size: 12px; color: var(--text-muted); display: flex; justify-content: space-between; align-items: center;">
                <span>लेखक: <?= e($b['author'] ?: 'प्रदीप सारंग') ?></span>
                <a href="<?= e(base_url('/blog/' . $b['slug'] . '/amp')) ?>" style="color: var(--primary); font-weight: bold; text-decoration: none;">पढ़ें ⚡</a>
            </div>
        </div>
    <?php endforeach; ?>
</section>

<section style="margin-bottom: 32px;">
    <h2 style="color: var(--primary-dark); border-bottom: 2px solid var(--primary); padding-bottom: 6px;">प्रमुख जन-अभियान (Key Campaigns)</h2>
    <div class="amp-card">
        <h3 style="color: var(--primary-dark); margin: 0 0 8px 0;">हरियाली अभियान ('ग्रीन गैंग' एवं 'ग्रीन मॉर्निंग')</h3>
        <p style="font-size: 14px; margin-bottom: 12px;">
            धरती पर हरियाली बढ़ाने तथा जन-जन की जीवनशैली में प्रकृति प्रेम को शामिल कराने के उद्देश्य से स्थापित 50,000+ वृक्षारोपण की सजीव मुहिम।
        </p>
        <a href="<?= e(base_url('/green-gang/amp')) ?>" style="color: var(--primary); font-weight: bold; text-decoration: none;">विस्तार से पढ़ें ⚡</a>
    </div>
</section>
