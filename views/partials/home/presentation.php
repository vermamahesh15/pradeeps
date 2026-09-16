<?php
declare(strict_types=1);

if (!function_exists('ps_text')) {
    function ps_text(string $hi, string $en): string { return current_lang() === 'hi' ? $hi : $en; }
}
if (!function_exists('ps_content_lang')) {
    function ps_content_lang(string $text): string { return preg_match('/[\x{0900}-\x{097F}]/u', $text) ? 'hi' : 'en'; }
}
if (!function_exists('ps_excerpt')) {
    function ps_excerpt(array $item, int $length = 180): string {
        $raw = ($item['excerpt'] ?? '') ?: ($item['content'] ?? $item['description'] ?? '');
        $text = trim(ps_decode_entities(strip_tags($raw)));
        return mb_strlen($text) > $length ? mb_substr($text, 0, $length) . '…' : $text;
    }
}
if (!function_exists('ps_image_path')) {
    function ps_image_path(string $path): ?string {
        $path = trim($path);
        if ($path === '') return null;
        if (preg_match('#^https?://#i', $path)) return $path;
        return base_url(ltrim($path, '/'));
    }
}
function ps_image(string $path, string $alt, string $class = '', bool $hero = false): void {
    $path = trim($path);
    if ($path === '') return;

    if (preg_match('#^https?://#i', $path)) {
        ?><img class="<?= e($class) ?>" src="<?= e($path) ?>" alt="<?= e($alt) ?>" loading="<?= $hero ? 'eager' : 'lazy' ?>" decoding="async" <?= $hero ? 'fetchpriority="high"' : '' ?>><?php
        return;
    }

    static $manifest;
    $manifest ??= @json_decode(@file_get_contents(__DIR__ . '/../../../assets/images/home/manifest.json'), true) ?: [];

    $resolvedPath = ps_image_path($path) ?: ltrim($path, '/');
    $entry = $manifest[$path] ?? $manifest[ltrim($path, '/')] ?? $manifest[$resolvedPath] ?? null;

    if ($entry) {
        $variants = $entry['variants'] ?? [];
        $source = $variants ? $variants[count($variants) - 1]['path'] : $resolvedPath;
        $size = [$entry['width'] ?? 800, $entry['height'] ?? 600];
        $srcset = implode(', ', array_map(fn($v) => base_url($v['path']) . ' ' . $v['width'] . 'w', $variants));
    } else {
        $source = $resolvedPath;
        $root = realpath(__DIR__ . '/../../..') ?: dirname(__DIR__, 3);
        $fullLocalPath = $root . '/' . ltrim($source, '/');
        $rawSize = @getimagesize($fullLocalPath);
        $size = is_array($rawSize) ? [$rawSize[0], $rawSize[1]] : [800, 600];
        $srcset = '';
    }

    ?><img class="<?= e($class) ?>" src="<?= e(base_url($source)) ?>" <?php if ($srcset): ?>srcset="<?= e($srcset) ?>" sizes="<?= $hero ? '(min-width: 1024px) 58vw, 100vw' : '(min-width: 768px) 50vw, 100vw' ?>"<?php endif; ?> width="<?= (int)$size[0] ?>" height="<?= (int)$size[1] ?>" alt="<?= e($alt) ?>" loading="<?= $hero ? 'eager' : 'lazy' ?>" decoding="async" <?= $hero ? 'fetchpriority="high"' : '' ?>><?php
}
function ps_heading(string $id, string $eyebrow, string $title, string $description = '', string $url = '', string $link = ''): void {
    ?><div class="ps-section-heading"><div><span class="ps-eyebrow"><?= e($eyebrow) ?></span><h2 id="<?= e($id) ?>"><?= e($title) ?></h2><?php if ($description): ?><p><?= e($description) ?></p><?php endif; ?></div><?php if ($url): ?><a class="ps-link" href="<?= e($url) ?>"><?= e($link) ?> <span aria-hidden="true">↗</span></a><?php endif; ?></div><?php
}
function ps_page_hero(string $eyebrow, string $heading, string $description = ''): void {
    ?>
    <section class="relative w-full bg-soft-meadow overflow-hidden py-space-2xl md:py-space-3xl border-b border-border-warm">
      <div class="max-w-container-max mx-auto px-4 sm:px-8 relative z-10">
        <nav aria-label="<?= e(ps_text('ब्रेडक्रंब','Breadcrumb')) ?>" class="flex items-center gap-2 font-label-md text-label-md text-text-muted mb-space-sm">
          <a class="hover:text-primary transition-colors flex items-center gap-1" href="<?= e(base_url('/')) ?>">
            <span class="material-symbols-outlined text-[16px]">home</span>
            <span><?= e(ps_text('गृह (Home)', 'Home')) ?></span>
          </a>
          <span class="opacity-40">/</span>
          <span class="text-deep-forest font-semibold"><?= e($heading) ?></span>
        </nav>
        <div class="max-w-4xl">
          <?php if ($eyebrow): ?>
          <div class="inline-flex items-center gap-2 bg-primary-fixed/40 text-deep-forest px-3.5 py-1 rounded-full font-label-sm text-label-sm mb-space-sm border border-border-warm font-semibold">
            <span class="material-symbols-outlined text-[15px] text-[#D97706]" style="font-variation-settings: 'FILL' 1;">eco</span>
            <span><?= e($eyebrow) ?></span>
          </div>
          <?php endif; ?>
          <h1 class="font-display-hero text-headline-lg md:text-display-hero text-deep-forest leading-tight tracking-tight font-bold">
            <?= e($heading) ?>
          </h1>
          <?php if ($description): ?>
          <p class="font-body-lg text-body-lg text-text-muted mt-space-sm max-w-3xl leading-relaxed">
            <?= e($description) ?>
          </p>
          <?php endif; ?>
        </div>
      </div>
    </section>
    <?php
}
function ps_cta(string $heading, string $description = ''): void {
    ?><section class="ps-section ps-inner-cta"><div class="ps-container"><div><h2><?= e($heading) ?></h2><?php if($description): ?><p><?= e($description) ?></p><?php endif; ?></div><div class="ps-actions"><a class="ps-button ps-button-inverse" href="<?= e(base_url('/volunteer')) ?>"><?= e(ps_text('स्वयंसेवक बनें','Become a volunteer')) ?> ↗</a><a class="ps-light-link" href="<?= e(base_url('/contact')) ?>"><?= e(ps_text('संवाद करें','Contact')) ?> →</a></div></div></section><?php
}
function ps_rich_text(string $html): string {
    if (trim($html) === '') {
        return '<p>' . e(ps_text('विस्तृत जानकारी जल्द उपलब्ध होगी।', 'More information will be available soon.')) . '</p>';
    }
    return ps_decode_entities($html);
}
function ps_card(array $item, string $kind = 'campaigns', bool $featured = false): void {
    $title = $item['title'];
    $image = $item['image'] ?? $item['featured_image'] ?? $item['banner_image'] ?? '';
    $url = base_url('/' . $kind . '/' . $item['slug']);
    $excerpt = ps_excerpt($item);
    require __DIR__ . '/../../components/home/content-card.php';
}

$home = basename($viewFile) === 'home.php' ? $page : ($shared ?? []);
$campaigns = $home['campaigns'] ?? [];
$blogs = $home['blogs'] ?? [];
$events = $home['events'] ?? [];
$today = new DateTimeImmutable('today', new DateTimeZone('Asia/Kolkata'));
$validEvents = array_filter($events, fn($ev) => !empty($ev['event_date']) && strtotime($ev['event_date']) !== false);
$upcoming = array_values(array_filter($validEvents, fn($ev) => $ev['event_date'] >= $today->format('Y-m-d')));
$past = array_values(array_filter($validEvents, fn($ev) => $ev['event_date'] < $today->format('Y-m-d')));
usort($upcoming, fn($a, $b) => strcmp($a['event_date'], $b['event_date']));
usort($past, fn($a, $b) => strcmp($b['event_date'], $a['event_date']));
$gallery = array_values(array_filter($home['gallery'] ?? [], fn($i) => ps_image_path($i['image'] ?? '') !== null));
$media = array_values(array_filter($home['newspaper_cuttings'] ?? [], fn($i) => ps_image_path($i['image'] ?? '') !== null));
$timeline = $home['timeline'] ?? [];
$awards = array_values(array_filter($timeline, fn($i) => preg_match('/सम्मान|पुरस्कार|प्रशस्ति|award|recognition/iu', $i['title'] . ' ' . ($i['description'] ?? ''))));
$green = null;
$parinda = null;
$awadhi = null;
$patel = null;
$tulsi = null;
foreach ($campaigns as $campaign) {
    $t = ($campaign['title'] ?? '') . ' ' . ($campaign['slug'] ?? '');
    if (!$green && preg_match('/हरियाली|green gang|hariyali/iu', $t)) { $green = $campaign; }
    if (!$parinda && preg_match('/परिंदा|bird|parinda/iu', $t)) { $parinda = $campaign; }
    if (!$awadhi && preg_match('/अवधी|awadhi|language-and-literature/iu', $t)) { $awadhi = $campaign; }
    if (!$patel && preg_match('/पटेल|patel/iu', $t)) { $patel = $campaign; }
    if (!$tulsi && preg_match('/तुलसी|tulsi/iu', $t)) { $tulsi = $campaign; }
}
if ($patel) {
    $campaigns = array_merge([$patel], array_values(array_filter($campaigns, fn($c) => $c['slug'] !== $patel['slug'])));
} elseif ($green) {
    $campaigns = array_merge([$green], array_values(array_filter($campaigns, fn($c) => $c['slug'] !== $green['slug'])));
}
$literature = $awadhi ?: ($campaigns[0] ?? null);

$defaults = (require __DIR__ . '/../../../includes/data.php')['settings'];
$contact = array_filter($settings, fn($v, $k) => in_array($k, ['phone','email','address','facebook','instagram','linkedin','youtube'], true) && $v && $v !== '#' && $v !== ($defaults[$k] ?? null), ARRAY_FILTER_USE_BOTH);
$nav = [
    ['/', ps_text('होम','Home')],
    ['/about', ps_text('परिचय','About')],
    ['/campaigns', ps_text('अभियान','Campaigns')],
    ['/green-gang', ps_text('ग्रीन गैंग','Green Gang')],
    [
        'label' => ps_text('प्रभाव व यात्रा', 'Impact & Journey'),
        'children' => [
            ['/impact', ps_text('जनप्रभाव', 'Community Impact')],
            ['/journey', ps_text('सेवा यात्रा', 'Service Journey')],
            ['/awards', ps_text('सम्मान व पुरस्कार', 'Awards & Recognition')]
        ]
    ],
    [
        'label' => ps_text('गैलरी व मीडिया', 'Gallery & Media'),
        'children' => [
            ['/portfolio', ps_text('छायाचित्र दीर्घा', 'Photo Gallery')],
            ['/videos', ps_text('वीडियो दीर्घा', 'Video Gallery')],
            ['/media', ps_text('प्रेस व कतरनें', 'Press Coverage')]
        ]
    ],
    ['/salahkaar', ps_text('सलाहकार', 'Counsellor')],
    ['/events', ps_text('कार्यक्रम','Events')],
    ['/blog', ps_text('साहित्य व विचार', 'Literature & Writings')],
    ['/donation', ps_text('सहयोग करें', 'Donate Now')],
    ['/contact', ps_text('संपर्क','Contact')]
];

