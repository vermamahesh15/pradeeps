<?php
declare(strict_types=1);

if (!function_exists('to_hindi_num')) {
    function to_hindi_num($n): string {
        return strtr((string)$n, [
            '0' => '०', '1' => '१', '2' => '२', '3' => '३', '4' => '४',
            '5' => '५', '6' => '६', '7' => '७', '8' => '८', '9' => '९',
        ]);
    }
}

$post = $post ?? [];
$allArticles = $allArticles ?? [];
if (empty($allArticles)) {
    $allArticles = [$post];
}
$currentIndex = (int)($currentIndex ?? 0);
$totalArticles = count($allArticles);
if ($currentIndex < 0 || $currentIndex >= $totalArticles) {
    $currentIndex = 0;
}

$postTitle = html_entity_decode(trim($post['title'] ?? '') ?: ps_text('झरिहख', 'Jharihakh'), ENT_QUOTES | ENT_HTML5, 'UTF-8');
$postCategory = html_entity_decode(trim($post['category_name'] ?? $post['category'] ?? '') ?: ps_text('अवधी संस्मरण', 'Awadhi Memoir'), ENT_QUOTES | ENT_HTML5, 'UTF-8');
$postAuthor = html_entity_decode(trim(($post['author_name'] ?? '') ?: ($post['author'] ?? '')) ?: ps_text('श्री प्रदीप सारंग', 'Shri Pradeep Sarang'), ENT_QUOTES | ENT_HTML5, 'UTF-8');
$postDate = !empty($post['published_at']) ? date('d M Y', strtotime($post['published_at'])) : ps_text('मई २०२६', 'May 2026');
$postExcerpt = html_entity_decode(trim(strip_tags($post['excerpt'] ?? '')), ENT_QUOTES | ENT_HTML5, 'UTF-8');
$postContent = (string)($post['content'] ?? $post['body'] ?? $post['excerpt'] ?? '');
$postReadingTime = $post['reading_time'] ?? '12 min read';

$currHindi = to_hindi_num($currentIndex + 1);
$totHindi = to_hindi_num($totalArticles);
$badgeDisplay = $currHindi . ' / ' . $totHindi;
$progressPercent = (int)round((($currentIndex + 1) / max(1, $totalArticles)) * 100);
?>

<style>
  /* 3D Slow Book Page Flip Animation */
  .book-viewport {
    perspective: 2200px;
    transform-style: preserve-3d;
  }
  .spread-slide {
    transform-origin: left center;
    transition: transform 1.2s cubic-bezier(0.25, 1, 0.45, 1), opacity 1s cubic-bezier(0.4, 0, 0.2, 1), box-shadow 1.2s ease;
    backface-visibility: hidden;
    will-change: transform, opacity, box-shadow;
  }
  .spread-slide.active {
    opacity: 1;
    transform: rotateY(0deg) scale(1) translateX(0);
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.06);
    pointer-events: auto;
    z-index: 10;
  }
  .spread-slide.flip-next {
    opacity: 0;
    transform: rotateY(-90deg) scale(0.95) translateX(-40px);
    box-shadow: -30px 0 50px rgba(0, 0, 0, 0.35);
    pointer-events: none;
    z-index: 1;
  }
  .spread-slide.flip-prev {
    opacity: 0;
    transform: rotateY(90deg) scale(0.95) translateX(40px);
    box-shadow: 30px 0 50px rgba(0, 0, 0, 0.35);
    pointer-events: none;
    z-index: 1;
  }
  .page-curl-corner {
    position: absolute;
    width: 0;
    height: 0;
    border-style: solid;
    transition: all 0.3s ease;
    cursor: pointer;
  }
  .curl-bottom-right {
    bottom: 0;
    right: 0;
    border-width: 0 0 32px 32px;
    border-color: transparent transparent rgba(160, 65, 24, 0.4) transparent;
  }
  .curl-bottom-right:hover {
    border-width: 0 0 46px 46px;
    border-color: transparent transparent rgba(160, 65, 24, 0.7) transparent;
  }
  .curl-bottom-left {
    bottom: 0;
    left: 0;
    border-width: 32px 0 0 32px;
    border-color: transparent transparent transparent rgba(0, 101, 44, 0.4);
  }
  .curl-bottom-left:hover {
    border-width: 46px 0 0 46px;
    border-color: transparent transparent transparent rgba(0, 101, 44, 0.7);
  }

  /* Sound wave animation */
  @keyframes soundwave {
    0%, 100% { height: 4px; }
    50% { height: 16px; }
  }
  .sound-bar {
    animation: soundwave 1s ease-in-out infinite;
  }
  .sound-bar:nth-child(2) { animation-delay: 0.2s; }
  .sound-bar:nth-child(3) { animation-delay: 0.4s; }
  .sound-bar:nth-child(4) { animation-delay: 0.15s; }
</style>

<!-- 2. BREADCRUMB & READING TOOLBAR STRIP -->
<div class="flex flex-col w-full">
  <!-- Breadcrumb and Reader Tools -->
  <section class="w-full bg-soft-meadow border-b border-border-warm py-2 relative z-30 shadow-xs">
    <div class="max-w-container-max mx-auto px-4 sm:px-8 flex flex-wrap items-center justify-between gap-3">
      <!-- Breadcrumb Navigation -->
      <nav class="flex items-center gap-2 font-label-sm text-label-sm text-on-surface-variant">
        <a class="hover:text-deep-forest transition-colors flex items-center gap-1" data-path="home" href="<?= e(base_url('/')) ?>">
          <span class="material-symbols-outlined text-[15px]">home</span>
          <span><?= e(ps_text('मुख्य पृष्ठ', 'Home')) ?></span>
        </a>
        <span class="text-outline-variant">/</span>
        <a class="hover:text-deep-forest transition-colors" data-path="blog-and-thoughts" href="<?= e(base_url('/blog')) ?>">
          <?= e(ps_text('ब्लॉग एवं आलेख', 'Blog & Journal')) ?>
        </a>
        <span class="text-outline-variant">/</span>
        <span class="text-secondary font-semibold" id="crumb-category"><?= e($postCategory) ?></span>
        <span class="text-outline-variant">/</span>
        <span class="text-deep-forest font-bold" id="crumb-title"><?= e($postTitle) ?></span>
      </nav>

      <!-- Reading Tools Strip -->
      <div class="flex flex-wrap items-center gap-2 sm:gap-3">
        <!-- Top Page Nav Pill (Dynamic Chapter Counter) -->
        <div class="inline-flex items-center gap-1.5 bg-pure-white border border-border-warm rounded-lg p-0.5 shadow-xs">
          <button type="button" class="px-2.5 py-1 rounded-md bg-surface text-deep-forest hover:bg-primary-container hover:text-pure-white font-label-sm text-label-sm font-semibold transition-colors flex items-center gap-1 disabled:opacity-40 disabled:cursor-not-allowed cursor-pointer" id="btn-top-prev-page" title="<?= e(ps_text('पिछला पृष्ठ', 'Previous Page')) ?>" <?= $currentIndex === 0 ? 'disabled' : '' ?>>
            <span class="material-symbols-outlined text-[16px]">arrow_back</span>
            <span class="hidden sm:inline"><?= e(ps_text('पिछला', 'Prev')) ?></span>
          </button>
          <span class="text-deep-forest font-mono font-bold text-xs px-2" id="top-page-counter-badge"><?= $badgeDisplay ?></span>
          <button type="button" class="px-2.5 py-1 rounded-md bg-primary-container text-pure-white hover:bg-deep-forest font-label-sm text-label-sm font-semibold transition-colors flex items-center gap-1 disabled:opacity-40 disabled:cursor-not-allowed cursor-pointer shadow-xs" id="btn-top-next-page" title="<?= e(ps_text('अगला पृष्ठ', 'Next Page')) ?>" <?= $currentIndex >= $totalArticles - 1 ? 'disabled' : '' ?>>
            <span><?= e(ps_text('अगला पृष्ठ', 'Next Page')) ?></span>
            <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
          </button>
        </div>

        <!-- Table of Contents Modal Button -->
        <button type="button" class="px-2.5 py-1 rounded-lg bg-pure-white border border-border-warm text-deep-forest hover:bg-soft-meadow font-label-sm text-label-sm font-semibold transition-colors flex items-center gap-1.5 shadow-xs cursor-pointer" id="btn-open-toc" title="<?= e(ps_text('सभी अध्याय एवं ग्रंथ अनुक्रमणिका देखें', 'View Table of Contents')) ?>">
          <span class="material-symbols-outlined text-[17px] text-secondary">auto_stories</span>
          <span class="hidden md:inline"><?= e(ps_text('ग्रंथ अनुक्रमणिका (' . $totHindi . ' आलेख)', 'Contents (' . $totalArticles . ' Stories)')) ?></span>
          <span class="md:hidden"><?= e(ps_text('अनुक्रमणिका', 'Contents')) ?></span>
        </button>

        <!-- Font Size Adjuster -->
        <div class="inline-flex items-center bg-pure-white border border-border-warm rounded-lg p-0.5 shadow-xs">
          <button type="button" class="px-2 py-1 text-on-surface hover:text-deep-forest font-label-sm text-label-sm transition-colors active:scale-95 cursor-pointer" id="btn-font-dec" title="<?= e(ps_text('अक्षर छोटा करें', 'Decrease Font Size')) ?>">A-</button>
          <span class="text-outline-variant text-[11px] px-1">|</span>
          <button type="button" class="px-2 py-1 text-on-surface hover:text-deep-forest font-label-md text-label-md font-bold transition-colors active:scale-95 cursor-pointer" id="btn-font-inc" title="<?= e(ps_text('अक्षर बड़ा करें', 'Increase Font Size')) ?>">A+</button>
        </div>

        <!-- Typography Serif / Sans Toggle -->
        <div class="inline-flex items-center bg-pure-white border border-border-warm rounded-lg p-0.5 shadow-xs text-label-sm">
          <button type="button" class="px-2.5 py-1 rounded bg-surface text-deep-forest font-bold shadow-xs transition-colors cursor-pointer" id="btn-font-serif">Serif</button>
          <button type="button" class="px-2.5 py-1 rounded text-on-surface-variant hover:text-on-surface font-medium transition-colors cursor-pointer" id="btn-font-sans">Sans</button>
        </div>

        <!-- Reading Time Badge -->
        <div class="hidden sm:inline-flex items-center gap-1 px-2.5 py-1 rounded-lg bg-pure-white border border-border-warm text-text-muted font-label-sm text-label-sm">
          <span class="material-symbols-outlined text-[15px] text-secondary">schedule</span>
          <span id="reading-time-badge"><?= e($postReadingTime) ?></span>
        </div>

        <!-- Paper Tone Selector -->
        <div class="flex items-center gap-1 bg-pure-white border border-border-warm px-2 py-1 rounded-lg shadow-xs">
          <button type="button" class="w-4 h-4 rounded-full bg-[#fdfaf3] ring-1 ring-border-warm hover:scale-110 transition-transform cursor-pointer" data-tone="tone-parchment" title="<?= e(ps_text('हल्का पीला (Parchment)', 'Parchment Tone')) ?>"></button>
          <button type="button" class="w-4 h-4 rounded-full bg-[#fcf9f2] ring-2 ring-primary transition-transform cursor-pointer" data-tone="tone-ivory" title="<?= e(ps_text('क्रीमी श्वेत (Ivory)', 'Ivory Tone')) ?>"></button>
          <button type="button" class="w-4 h-4 rounded-full bg-[#f4ede1] ring-1 ring-border-warm hover:scale-110 transition-transform cursor-pointer" data-tone="tone-linen" title="<?= e(ps_text('गर्म खादी (Warm Linen)', 'Warm Linen Tone')) ?>"></button>
        </div>

        <!-- Print Button -->
        <button type="button" class="p-1.5 rounded-lg bg-pure-white border border-border-warm text-on-surface-variant hover:text-deep-forest shadow-xs transition-colors cursor-pointer" onclick="window.print()" title="<?= e(ps_text('किताब सहेजें या प्रिंट करें', 'Print or Save Memoir')) ?>">
          <span class="material-symbols-outlined text-[18px]">print</span>
        </button>
      </div>
    </div>
  </section>

  <!-- Reading Progress Bar -->
  <div class="w-full h-1 bg-surface-variant sticky top-[116px] z-20">
    <div class="h-full bg-fresh-sprout transition-all duration-300" id="read-progress-fill" style="width: <?= $progressPercent ?>%;"></div>
  </div>

  <!-- 3. MAIN CONTENT BODY — REALISTIC OPEN-BOOK EXPERIENCE WITH 3D FLIP MECHANISM -->
  <section class="w-full bg-[#1b261d] py-3 lg:py-5 px-3 sm:px-6 md:px-8 relative overflow-hidden">
    <!-- Ambient Vignette & Texture Gradients -->
    <div class="absolute inset-0 bg-gradient-to-b from-black/40 via-transparent to-black/60 pointer-events-none"></div>
    <div class="absolute -top-32 -left-32 w-96 h-96 rounded-full bg-primary/15 blur-3xl pointer-events-none"></div>
    <div class="absolute -bottom-32 -right-32 w-96 h-96 rounded-full bg-secondary/15 blur-3xl pointer-events-none"></div>

    <div class="max-w-[1240px] mx-auto relative z-10">
      <!-- Realistic Hardcover Leather Binder Backing with 3D Depth -->
      <div class="rounded-2xl p-2 sm:p-3.5 md:p-5 bg-[#261d18] shadow-[0_25px_60px_-15px_rgba(0,0,0,0.8),0_12px_24px_rgba(0,0,0,0.6)] border border-[#3d2c22] relative">
        <!-- Top Floating Book Binder Nav Controls -->
        <div class="flex items-center justify-between gap-3 mb-3 text-cream-canvas font-label-sm text-label-sm px-1">
          <div class="flex items-center gap-2">
            <span class="inline-block w-2.5 h-2.5 rounded-full bg-fresh-sprout animate-pulse"></span>
            <span class="font-bold text-surface-bright"><?= e(ps_text('प्रदीप सारंग संस्मरण ग्रंथावली', 'Pradeep Sarang Memoir Archives')) ?></span>
          </div>
          <div class="flex items-center gap-2 sm:gap-3">
            <button type="button" class="px-3 py-1.5 rounded-lg bg-deep-forest/90 hover:bg-deep-forest disabled:opacity-40 disabled:cursor-not-allowed text-pure-white flex items-center gap-1 transition-all shadow-sm active:scale-95 cursor-pointer font-semibold" id="btn-binder-prev-page" <?= $currentIndex === 0 ? 'disabled' : '' ?>>
              <span class="material-symbols-outlined text-[16px]">arrow_back</span>
              <span class="hidden sm:inline"><?= e(ps_text('पिछला पृष्ठ', 'Previous Page')) ?></span>
            </button>
            <span class="text-surface-variant font-mono text-xs px-2.5 py-1 rounded bg-black/40 border border-white/10" id="binder-page-counter-badge"><?= $badgeDisplay ?></span>
            <button type="button" class="px-3 py-1.5 rounded-lg bg-primary-container hover:bg-deep-forest disabled:opacity-40 disabled:cursor-not-allowed text-pure-white flex items-center gap-1 transition-all shadow-sm active:scale-95 cursor-pointer font-semibold" id="btn-binder-next-page" <?= $currentIndex >= $totalArticles - 1 ? 'disabled' : '' ?>>
              <span><?= e(ps_text('अगला पृष्ठ', 'Next Page')) ?></span>
              <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
            </button>
          </div>
        </div>

        <!-- Gold foil debossed boundary aesthetic -->
        <div class="rounded-xl p-1.5 sm:p-2 bg-[#34251e] border border-[#523a2f]/50">
          <!-- The 3D Viewport enclosing all single-page book stories -->
          <div class="book-viewport relative min-h-[650px] overflow-hidden rounded-lg bg-[#fcf9f2] text-[#1f2421] shadow-2xl transition-colors duration-300" id="book-spread-paper">
            
            <!-- Left/Right Click Hot-Zones for Intuitive Flipping -->
            <div class="absolute top-0 bottom-0 left-0 w-12 sm:w-16 z-20 cursor-pointer group flex items-center justify-start pl-2" id="hotzone-left" title="<?= e(ps_text('पिछला पृष्ठ पलटें (Left Arrow)', 'Turn Previous Page')) ?>">
              <span class="material-symbols-outlined text-black/25 group-hover:text-deep-forest group-hover:scale-125 transition-all text-[28px]">chevron_left</span>
              <div class="page-curl-corner curl-bottom-left" title="<?= e(ps_text('पिछला पृष्ठ', 'Previous Page')) ?>"></div>
            </div>
            <div class="absolute top-0 bottom-0 right-0 w-12 sm:w-16 z-20 cursor-pointer group flex items-center justify-end pr-2" id="hotzone-right" title="<?= e(ps_text('अगला पृष्ठ पलटें (Right Arrow)', 'Turn Next Page')) ?>">
              <span class="material-symbols-outlined text-black/25 group-hover:text-secondary group-hover:scale-125 transition-all text-[28px]">chevron_right</span>
              <div class="page-curl-corner curl-bottom-right" title="<?= e(ps_text('अगला पृष्ठ', 'Next Page')) ?>"></div>
            </div>

            <!-- ================= DYNAMIC ARTICLES BOOK SPREADS ================= -->
            <?php foreach ($allArticles as $spreadIdx => $articleItem): 
              $isActive = ($spreadIdx === $currentIndex);
              $artTitle = html_entity_decode(trim($articleItem['title'] ?? '') ?: ps_text('अध्याय', 'Story'), ENT_QUOTES | ENT_HTML5, 'UTF-8');
              $artCategory = html_entity_decode(trim($articleItem['category_name'] ?? $articleItem['category'] ?? '') ?: ps_text('आलेख', 'Article'), ENT_QUOTES | ENT_HTML5, 'UTF-8');
              $artAuthor = html_entity_decode(trim(($articleItem['author_name'] ?? '') ?: ($articleItem['author'] ?? '')) ?: ps_text('श्री प्रदीप सारंग', 'Shri Pradeep Sarang'), ENT_QUOTES | ENT_HTML5, 'UTF-8');
              $artDate = !empty($articleItem['published_at']) ? date('d M Y', strtotime($articleItem['published_at'])) : ps_text('मई २०२६', 'May 2026');
              $artExcerpt = html_entity_decode(trim(strip_tags($articleItem['excerpt'] ?? '')), ENT_QUOTES | ENT_HTML5, 'UTF-8');
              $artContent = trim($articleItem['content'] ?? '');
              $artReading = $articleItem['reading_time'] ?? '12 min read';
              
              $artImg = !empty($articleItem['featured_image']) ? $articleItem['featured_image'] : (!empty($articleItem['banner_image']) ? $articleItem['banner_image'] : (!empty($articleItem['image']) ? $articleItem['image'] : ''));
              if ($artImg && !preg_match('#^https?://#i', $artImg)) {
                  $artImg = base_url($artImg);
              }
              
              $chapterNumHi = to_hindi_num($spreadIdx + 1);
            ?>
            <div class="spread-slide <?= $isActive ? 'active' : 'hidden' ?> min-h-full" data-spread="<?= $spreadIdx ?>" data-slug="<?= e($articleItem['slug'] ?? '') ?>">
              <article class="p-6 sm:p-10 md:p-12 lg:p-14 max-w-4xl mx-auto flex flex-col justify-between min-h-full bg-[#faf8f2] book-page-content">
                <div>
                  <!-- Archival Top Header -->
                  <header class="flex items-center justify-between pb-3 mb-6 border-b border-[#e2dacf]">
                    <span class="font-label-sm text-[11px] sm:text-xs uppercase tracking-widest text-[#795548] font-bold">
                      <?= e(ps_text('प्रदीप सारंग संस्मरण संकलन • अध्याय ' . $chapterNumHi . ' / ' . $totHindi, 'Pradeep Sarang Memoir Collection • Story ' . ($spreadIdx + 1) . ' of ' . $totalArticles)) ?>
                    </span>
                    <div class="flex items-center gap-1.5 text-on-surface-variant font-label-sm text-label-sm">
                      <span class="material-symbols-outlined text-[17px] text-secondary">menu_book</span>
                      <span class="font-serif font-bold text-deep-forest"><?= e(ps_text('अध्याय ' . $chapterNumHi, 'Chapter ' . ($spreadIdx + 1))) ?></span>
                    </div>
                  </header>

                  <!-- Majestic Masthead (Redesigned with commanding presence) -->
                  <div class="text-center mb-6">
                    <span class="inline-block px-3.5 py-1 rounded-full bg-[#f4ebd9] text-secondary font-label-sm text-xs sm:text-sm font-semibold mb-3 border border-[#decbb4]/80 shadow-xs">
                      <?= e($artCategory) ?>
                    </span>
                    <h1 class="font-headline-lg text-[28px] sm:text-[36px] md:text-[42px] leading-[1.25] text-deep-forest tracking-tight font-bold mb-3">
                      <?= e($artTitle) ?>
                    </h1>
                    <?php if (!empty($artExcerpt)): ?>
                    <p class="font-serif italic text-[#5c4a3e] text-base sm:text-lg md:text-xl leading-relaxed max-w-3xl mx-auto mt-2">
                      <?= e($artExcerpt) ?>
                    </p>
                    <?php endif; ?>
                  </div>

                  <!-- Memoir Metadata Stamp Ribbon -->
                  <div class="p-3.5 bg-[#f7f3ea] border border-[#ebe0d0] rounded-xl mb-6 flex flex-wrap items-center justify-between text-xs sm:text-sm font-label-sm text-on-surface-variant gap-3 shadow-xs">
                    <div class="flex items-center gap-1.5">
                      <span class="material-symbols-outlined text-primary text-[18px]">account_circle</span>
                      <span><?= e(ps_text('लेखक:', 'Author:')) ?> <strong class="text-deep-forest"><?= e($artAuthor) ?></strong></span>
                    </div>
                    <div class="flex items-center gap-1.5">
                      <span class="material-symbols-outlined text-secondary text-[18px]">event</span>
                      <span><?= e($artDate) ?></span>
                    </div>
                    <div class="flex items-center gap-1.5">
                      <span class="material-symbols-outlined text-deep-forest text-[18px]">pin_drop</span>
                      <span><?= e(ps_text('कमरावां, बाराबंकी (उ.प्र.)', 'Kamrawan, Barabanki (UP)')) ?></span>
                    </div>
                    <div class="flex items-center gap-1.5 text-secondary font-semibold">
                      <span class="material-symbols-outlined text-[18px]">schedule</span>
                      <span><?= e($artReading) ?></span>
                    </div>
                  </div>

                  <!-- Decorative Motif Divider -->
                  <div class="flex items-center justify-center my-5">
                    <div class="w-16 h-px bg-secondary/40"></div>
                    <span class="material-symbols-outlined text-secondary mx-3 text-[22px]" style="font-variation-settings: 'FILL' 1;">spa</span>
                    <div class="w-16 h-px bg-secondary/40"></div>
                  </div>

                  <!-- PROMINENT GRAND FEATURED IMAGE (Full-width, large & majestic) -->
                  <?php if (!empty($artImg)): ?>
                  <div class="my-6 sm:my-8 rounded-2xl overflow-hidden shadow-[0_12px_32px_rgba(0,0,0,0.12)] border border-[#decbb4] bg-white p-2 group">
                    <div class="relative w-full overflow-hidden rounded-xl bg-[#f2ecdf]">
                      <img src="<?= e($artImg) ?>" alt="<?= e($artTitle) ?>" class="w-full h-[280px] sm:h-[400px] md:h-[480px] lg:h-[540px] object-cover object-center group-hover:scale-[1.015] transition-transform duration-700 ease-out" loading="eager" onerror="this.parentElement.parentElement.style.display='none';" />
                      <div class="absolute inset-0 bg-gradient-to-t from-black/25 via-transparent to-transparent pointer-events-none"></div>
                    </div>
                    <div class="flex items-center justify-between px-3 pt-2.5 pb-1 text-xs text-[#7d6b5c] font-serif">
                      <span class="flex items-center gap-1.5">
                        <span class="material-symbols-outlined text-[15px] text-secondary">photo_camera</span>
                        <span><?= e(ps_text('आलेख प्रमुख दृश्य • श्री प्रदीप सारंग संग्रह', 'Featured Editorial Visual • Pradeep Sarang Archives')) ?></span>
                      </span>
                      <span class="italic text-[11px]"><?= e(ps_text('उच्च-रिज़ॉल्यूशन मूल छायाचित्र', 'High-Resolution Archival Plate')) ?></span>
                    </div>
                  </div>
                  <?php endif; ?>

                  <!-- Article Narrative Content -->
                  <div class="space-y-4 sm:space-y-5 prose-book font-headline-sm font-normal text-[16px] sm:text-[17px] leading-[1.85] text-justify text-[#2b302c]">
                    <?php if (!empty($artContent)): ?>
                      <?= ps_rich_text($artContent) ?>
                    <?php else: ?>
                      <p>
                        <?= e($artExcerpt) ?>
                      </p>
                    <?php endif; ?>
                  </div>
                </div>

                <!-- Footnote & Author Signoff -->
                <footer class="mt-10 pt-5 border-t border-[#e2dacf]">
                  <div class="flex flex-col items-center justify-center text-center">
                    <div class="flex items-center gap-2 text-secondary opacity-80 mb-1">
                      <span class="w-8 h-px bg-secondary"></span>
                      <span class="material-symbols-outlined text-[20px]">auto_stories</span>
                      <span class="w-8 h-px bg-secondary"></span>
                    </div>
                    <p class="font-serif italic text-title-md text-deep-forest font-semibold">— <?= e($artAuthor) ?></p>
                    <span class="font-label-sm text-[11px] text-text-muted"><?= e(ps_text('कमरवाँ, सतरिख (बाराबंकी) • संस्मरण संकलन', 'Kamrawan, Satrikh (Barabanki) • Memoir Archives')) ?></span>
                  </div>
                </footer>
              </article>
            </div>
            <?php endforeach; ?>

          </div>
        </div>
      </div>

      <!-- Book Spread Floating Bottom Interactive Controls -->
      <div class="flex flex-wrap items-center justify-between gap-3 mt-space-md text-cream-canvas font-label-sm text-label-sm">
        <div class="flex items-center gap-2">
          <span class="inline-block w-2.5 h-2.5 rounded-full bg-fresh-sprout animate-pulse"></span>
          <span id="book-footer-title"><?= e(ps_text('प्रदीप सारंग संस्मरण डिजिटल ग्रंथावली (संस्करण 2026)', 'Pradeep Sarang Memoir Digital Archives (2026 Edition)')) ?></span>
        </div>
        <div class="flex items-center gap-2 sm:gap-3">
          <button type="button" class="px-3.5 py-2 rounded-lg bg-deep-forest/90 hover:bg-deep-forest disabled:opacity-40 disabled:cursor-not-allowed text-pure-white flex items-center gap-1.5 transition-all shadow-sm active:scale-95 cursor-pointer" id="btn-prev-page" <?= $currentIndex === 0 ? 'disabled' : '' ?>>
            <span class="material-symbols-outlined text-[18px]">arrow_back</span>
            <span><?= e(ps_text('पिछला पृष्ठ', 'Previous Page')) ?></span>
          </button>
          <span class="text-surface-variant font-mono text-sm px-2.5 py-1 rounded bg-black/40 border border-white/10" id="page-counter-badge"><?= $badgeDisplay ?></span>
          <button type="button" class="px-3.5 py-2 rounded-lg bg-deep-forest/90 hover:bg-deep-forest disabled:opacity-40 disabled:cursor-not-allowed text-pure-white flex items-center gap-1.5 transition-all shadow-sm active:scale-95 cursor-pointer" id="btn-next-page" <?= $currentIndex >= $totalArticles - 1 ? 'disabled' : '' ?>>
            <span><?= e(ps_text('अगला पृष्ठ', 'Next Page')) ?></span>
            <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
          </button>
        </div>
      </div>
    </div>
  </section>

  <!-- Table of Contents Slide-Over Drawer Modal -->
  <div id="toc-modal" class="fixed inset-0 z-50 flex justify-end bg-black/60 backdrop-blur-xs opacity-0 pointer-events-none transition-opacity duration-300">
    <div id="toc-drawer" class="w-full max-w-md bg-[#faf8f2] h-full shadow-2xl flex flex-col transform translate-x-full transition-transform duration-300 border-l border-[#dfd6c8]">
      <!-- TOC Header -->
      <div class="p-5 bg-deep-forest text-pure-white flex items-center justify-between border-b border-[#2d4032]">
        <div class="flex items-center gap-2">
          <span class="material-symbols-outlined text-amber-300 text-[24px]">auto_stories</span>
          <div>
            <h3 class="font-title-md text-base sm:text-lg font-bold text-amber-200"><?= e(ps_text('ग्रंथ अनुक्रमणिका', 'Table of Contents')) ?></h3>
            <span class="text-xs text-stone-300"><?= e(ps_text('कुल ' . $totHindi . ' आलेख व अध्याय', 'Total ' . $totalArticles . ' Chapters & Stories')) ?></span>
          </div>
        </div>
        <button type="button" id="btn-close-toc" class="w-8 h-8 rounded-full bg-white/10 hover:bg-white/20 flex items-center justify-center text-white cursor-pointer transition-colors" title="<?= e(ps_text('बंद करें', 'Close')) ?>">
          <span class="material-symbols-outlined text-[20px]">close</span>
        </button>
      </div>

      <!-- TOC Chapter List -->
      <div class="p-4 overflow-y-auto flex-1 space-y-3">
        <?php foreach ($allArticles as $tocIdx => $tocArt): 
          $tocImg = !empty($tocArt['featured_image']) ? $tocArt['featured_image'] : (!empty($tocArt['banner_image']) ? $tocArt['banner_image'] : '');
          if ($tocImg && !preg_match('#^https?://#i', $tocImg)) $tocImg = base_url($tocImg);
        ?>
        <div class="toc-item p-3 rounded-xl border border-[#ebe0d0] bg-white hover:border-secondary/60 hover:shadow-md transition-all cursor-pointer flex items-center gap-3 group" data-jump="<?= $tocIdx ?>">
          <span class="w-8 h-8 rounded-lg bg-[#f5efe4] text-secondary font-mono font-bold text-sm flex items-center justify-center shrink-0 border border-[#decbb4] group-hover:bg-secondary group-hover:text-white transition-colors">
            <?= to_hindi_num($tocIdx + 1) ?>
          </span>
          <?php if ($tocImg): ?>
          <img src="<?= e($tocImg) ?>" alt="" class="w-14 h-14 rounded-lg object-cover border border-[#e2dacf] shrink-0" />
          <?php endif; ?>
          <div class="flex-1 min-w-0">
            <span class="text-[10px] font-bold text-stone-500 uppercase tracking-wider block mb-0.5"><?= e($tocArt['category_name'] ?? $tocArt['category'] ?? 'आलेख') ?></span>
            <h4 class="font-serif font-bold text-deep-forest text-sm line-clamp-1 group-hover:text-secondary transition-colors"><?= e($tocArt['title']) ?></h4>
            <span class="text-[11px] text-stone-400 mt-0.5 block"><?= e($tocArt['reading_time'] ?? '10 min read') ?></span>
          </div>
          <span class="material-symbols-outlined text-stone-400 group-hover:text-secondary group-hover:translate-x-1 transition-all text-[18px]">chevron_right</span>
        </div>
        <?php endforeach; ?>
      </div>

      <!-- TOC Footer -->
      <div class="p-4 bg-[#f3ede1] border-t border-[#dfd6c8] text-center text-xs text-stone-600 font-serif">
        <?= e(ps_text('प्रदीप सारंग संस्मरण डिजिटल ग्रंथावली (संस्करण 2026)', 'Pradeep Sarang Memoir Archives (2026 Edition)')) ?>
      </div>
    </div>
  </div>

  <!-- 4. POST-BOOK CONTENT AREA -->
  <!-- 4A. Awadhi Lexicon Drawer -->
  <section class="max-w-container-max mx-auto px-4 sm:px-8 py-space-2xl w-full">
    <div class="bg-soft-meadow border border-border-warm rounded-2xl p-6 sm:p-8 shadow-sm relative overflow-hidden">
      <div class="absolute top-0 right-0 w-32 h-32 bg-secondary/10 rounded-bl-full pointer-events-none"></div>
      <div class="flex flex-col md:flex-row md:items-center justify-between gap-3 mb-6">
        <div class="space-y-1">
          <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-[#fdf3ef] text-secondary font-label-sm text-label-sm font-semibold">
            <span class="material-symbols-outlined text-[15px]">translate</span>
            <span><?= e(ps_text('अवधी लोक-शब्दावली मंजूषा (Awadhi Lexicon)', 'Awadhi Dialect Lexicon')) ?></span>
          </div>
          <h2 class="font-headline-md text-title-lg md:text-headline-md text-deep-forest font-bold">
            <?= e(ps_text('इस संस्मरण में प्रयुक्त ठेठ अवधी शब्दों के अर्थ', 'Meanings of Authentic Awadhi Dialect Terms')) ?>
          </h2>
        </div>
        <span class="font-label-sm text-label-sm text-text-muted">
          <?= e(ps_text('बाराबंकी जनपद की बोलचाल से संकलित', 'Compiled from local Barabanki vernacular')) ?>
        </span>
      </div>

      <!-- Vocabulary Grid: Dynamically Scanned & Generated for Each Approved Article -->
      <?php foreach ($allArticles as $lexSpreadIdx => $lexArt): 
        $lTitle = $lexArt['title'] ?? '';
        $lContent = $lexArt['content'] ?? ($lexArt['excerpt'] ?? '');
        $lexiconItems = get_awadhi_lexicon_for_post($lTitle, $lContent);
      ?>
      <div class="lexicon-deck <?= $lexSpreadIdx === $currentIndex ? 'grid' : 'hidden' ?> grid-cols-1 sm:grid-cols-2 lg:grid-cols-6 gap-3.5" data-lex-spread="<?= $lexSpreadIdx ?>">
        <?php foreach ($lexiconItems as $idx => $lexItem): ?>
        <div class="p-4 bg-pure-white rounded-xl shadow-xs border border-border-warm hover:shadow-md transition-shadow">
          <span class="<?= $idx % 2 === 0 ? 'text-secondary' : 'text-deep-forest' ?> font-bold font-headline-sm text-title-md"><?= e($lexItem['word']) ?></span>
          <span class="block text-text-muted text-[11px] font-semibold mt-0.5"><?= e($lexItem['type'] ?? 'संज्ञा • Awadhi') ?></span>
          <p class="font-body-sm text-body-sm text-on-surface mt-2">
            <?= e(ps_text($lexItem['meaning_hi'], $lexItem['meaning_en'] ?? $lexItem['meaning_hi'])) ?>
          </p>
        </div>
        <?php endforeach; ?>
      </div>
      <?php endforeach; ?>
    </div>
  </section>

  <!-- 4B. Social Share Strip -->
  <section class="max-w-container-max mx-auto px-4 sm:px-8 pb-space-2xl w-full">
    <div class="bg-pure-white border border-border-warm rounded-2xl p-5 sm:p-6 shadow-sm flex flex-col md:flex-row items-center justify-between gap-4">
      <div class="flex items-center gap-3">
        <span class="material-symbols-outlined text-primary text-[28px]">share</span>
        <div>
          <h3 class="font-title-md text-title-md text-on-surface font-bold"><?= e(ps_text('इस संस्मरण को साझा करें', 'Share this Memoir')) ?></h3>
          <p class="font-body-sm text-body-sm text-text-muted"><?= e(ps_text('अवधी भाषा और ग्रामीण जीवन के यथार्थ को जन-जन तक पहुँचाएँ', 'Spread Awadhi literature and rural heritage with readers')) ?></p>
        </div>
      </div>
      <div class="flex flex-wrap items-center gap-2">
        <?php 
        $shareUrl = base_url('/blog/' . ($post['slug'] ?? ''));
        $shareText = $postTitle . ' - ' . ps_excerpt(['excerpt' => $postExcerpt], 120);
        ?>
        <a href="https://api.whatsapp.com/send?text=<?= urlencode($shareText . "\n\n" . $shareUrl) ?>" target="_blank" rel="noopener noreferrer" class="px-3.5 py-2 rounded-lg bg-[#25D366]/15 text-[#128C7E] hover:bg-[#25D366] hover:text-pure-white transition-all flex items-center gap-2 font-label-md text-label-md font-semibold">
          <i class="fa-brands fa-whatsapp text-lg"></i>
          <span>WhatsApp</span>
        </a>
        <a href="https://www.facebook.com/sharer/sharer.php?u=<?= urlencode($shareUrl) ?>" target="_blank" rel="noopener noreferrer" class="px-3.5 py-2 rounded-lg bg-[#1877F2]/10 text-[#1877F2] hover:bg-[#1877F2] hover:text-pure-white transition-all flex items-center gap-2 font-label-md text-label-md font-semibold">
          <i class="fa-brands fa-facebook text-lg"></i>
          <span>Facebook</span>
        </a>
        <a href="https://twitter.com/intent/tweet?text=<?= urlencode($postTitle) ?>&url=<?= urlencode($shareUrl) ?>&hashtags=PradeepSarang,AwadhiLiterature" target="_blank" rel="noopener noreferrer" class="px-3.5 py-2 rounded-lg bg-black/5 text-on-surface hover:bg-black hover:text-pure-white transition-all flex items-center gap-2 font-label-md text-label-md font-semibold">
          <i class="fa-brands fa-x-twitter text-lg"></i>
          <span>Twitter/X</span>
        </a>
        <a href="https://www.linkedin.com/sharing/share-offsite/?url=<?= urlencode($shareUrl) ?>" target="_blank" rel="noopener noreferrer" class="px-3.5 py-2 rounded-lg bg-[#0A66C2]/10 text-[#0A66C2] hover:bg-[#0A66C2] hover:text-pure-white transition-all flex items-center gap-2 font-label-md text-label-md font-semibold">
          <i class="fa-brands fa-linkedin text-lg"></i>
          <span>LinkedIn</span>
        </a>
        <button type="button" class="px-3.5 py-2 rounded-lg bg-surface-container text-deep-forest hover:bg-surface-container-high transition-all flex items-center gap-2 font-label-md text-label-md font-semibold cursor-pointer" id="copy-link-btn">
          <span class="material-symbols-outlined text-[18px]">content_copy</span>
          <span id="copy-text-label"><?= e(ps_text('लिंक कॉपी करें', 'Copy Link')) ?></span>
        </button>
      </div>
    </div>
  </section>

  <!-- 4C. Author Bio Card (Redesigned & Settings Connected) -->
  <?php 
  $authorNameVal = !empty($settings['author_name']) ? $settings['author_name'] : $postAuthor;
  $authorRoleVal = !empty($settings['author_role']) ? $settings['author_role'] : ps_text('वरिष्ठ साहित्यकार एवं पर्यावरण कार्यकर्ता', 'Senior Awadhi Author & Environmentalist');
  $authorLocVal = !empty($settings['author_location']) ? $settings['author_location'] : ps_text('ग्राम कमरावां, जिला बाराबंकी, उत्तर प्रदेश, भारत', 'Gram Kamrawan, District Barabanki, Uttar Pradesh, India');
  $authorBadgeVal = !empty($settings['author_badge']) ? $settings['author_badge'] : ps_text('साहित्यिक व जमीनी सरोकार', 'Literary & Social Legacy');
  $authorBioVal = !empty($settings['author_bio']) ? $settings['author_bio'] : ps_text('विगत चार दशकों से अवधी साहित्य की समृद्ध वाचिक परंपरा के संवर्धन और ग्रामीण पर्यावरण के पुनर्जीवन में संलग्न। हिंदी दैनिक समाचार पत्र सन्दौली टाइम्स के सह-संपादक के रूप में निरंतर पत्रकारिता के सरोकारों को जीने वाले सारंग जी ने बाराबंकी की मिट्टी, तालाबों और वृक्षों के संरक्षण हेतु युवाओं की \'ग्रीन गैंग\' का नेतृत्व किया है।', 'For over four decades, Shri Pradeep Sarang has dedicated his life to Awadhi oral literature, rural environmental conservation, and Sandauli Times journalism, guiding the youth Green Gang initiative.');
  $authorQuoteVal = !empty($settings['author_quote']) ? $settings['author_quote'] : ps_text('हारना सीखा नहीं है, जीत का मैं गीत हूँ। जुगनुओं का संग है, इंसानियत का मीत हूँ।', 'I have not learned to lose; I am a song of victory. With fireflies as companions, I am a friend of humanity.');
  $authorBadgesRaw = !empty($settings['author_badges_list']) ? $settings['author_badges_list'] : '40+ वर्ष साहित्य सेवा, ग्रीन गैंग संस्थापक';
  $authorBadgesArr = array_filter(array_map('trim', explode(',', $authorBadgesRaw)));
  
  $authorImgUrl = trim(($settings['author_image'] ?? '') ?: ($post['author_avatar'] ?? '') ?: ($post['author_image'] ?? '') ?: 'https://lh3.googleusercontent.com/aida-public/AB6AXuDV_HGESOnSGI8q8ywujcEK6vRtVsOrdz502F3M5Z3_iBt-apeIJvCT2qEGffDgf8Hfw3Trl6b4LOb0u23MwhSMq1XATA2O5p6C7IszVlI0mgmGc1XsnvwEBgG9k4M5un7ZUweEDJAYP3NFJTvABtAibY-POBUWwX4dxzERa9DsVb1z2_UJ7sQSkS8sCpvCTx4WZfu5t9HvRgWa45RYIVUJREA6xPYv0Ptsgz_zk346-4A4ws_a5mPu');
  if ($authorImgUrl && !preg_match('#^https?://#i', $authorImgUrl)) {
      $authorImgUrl = base_url($authorImgUrl);
  }
  ?>
  <section class="max-w-container-max mx-auto px-4 sm:px-8 pb-space-3xl w-full">
    <div class="relative bg-gradient-to-br from-[#fbf8f3] via-white to-[#edf4ec] border border-emerald-900/10 rounded-2xl sm:rounded-3xl shadow-xl shadow-emerald-950/5 p-6 sm:p-8 md:p-10 overflow-hidden">
      <!-- Decorative background accent blurred glows -->
      <div class="absolute -top-16 -right-16 w-64 h-64 bg-emerald-500/5 rounded-full blur-3xl pointer-events-none"></div>
      <div class="absolute -bottom-16 -left-16 w-64 h-64 bg-amber-500/5 rounded-full blur-3xl pointer-events-none"></div>

      <div class="relative z-10 grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-10 items-center">
        <!-- Left: Author Profile Column -->
        <div class="lg:col-span-4 flex flex-col items-center text-center lg:border-r lg:border-emerald-900/10 lg:pr-8">
          <h3 class="font-serif text-2xl font-bold text-emerald-950 mt-1 mb-1 tracking-tight"><?= e($authorNameVal) ?></h3>
          <span class="inline-flex items-center gap-1.5 text-xs sm:text-sm font-semibold text-emerald-800 bg-emerald-100/70 px-3 py-1 rounded-full mt-1">
            <span class="material-symbols-outlined text-[15px]">edit_note</span>
            <span><?= e($authorRoleVal) ?></span>
          </span>
          <span class="text-xs text-stone-500 flex items-center gap-1 mt-2">
            <span class="material-symbols-outlined text-[14px] text-amber-700">location_on</span>
            <span><?= e($authorLocVal) ?></span>
          </span>

          <!-- Quick Stats / Badges -->
          <?php if (!empty($authorBadgesArr)): ?>
          <div class="flex flex-wrap items-center justify-center gap-2 mt-4 pt-3 border-t border-emerald-900/10 w-full">
            <?php foreach ($authorBadgesArr as $bIdx => $badgeTxt): ?>
              <span class="text-[11px] font-bold px-2.5 py-1 rounded-md <?= $bIdx % 2 === 0 ? 'bg-amber-50 text-amber-900 border border-amber-200/60' : 'bg-emerald-50 text-emerald-900 border border-emerald-200/60' ?>">
                <?= e($badgeTxt) ?>
              </span>
            <?php endforeach; ?>
          </div>
          <?php endif; ?>

          <!-- Author Social Profiles -->
          <div class="flex flex-col items-center gap-1.5 mt-3 pt-3 border-t border-emerald-900/10 w-full">
            <span class="text-[11px] font-bold text-emerald-950/70 uppercase tracking-wider"><?= e(ps_text('लेखक सोशल मीडिया जुड़ें', 'Follow Author')) ?></span>
            <div class="flex items-center justify-center gap-2 mt-0.5">
              <a href="<?= e($settings['facebook'] ?? 'https://facebook.com/pradeepsarang') ?>" target="_blank" rel="noopener noreferrer" class="w-8 h-8 rounded-lg bg-[#1877F2]/10 text-[#1877F2] hover:bg-[#1877F2] hover:text-white flex items-center justify-center transition-all shadow-sm transform hover:-translate-y-0.5" title="Facebook Profile">
                <i class="fa-brands fa-facebook-f text-xs"></i>
              </a>
              <a href="<?= e($settings['twitter'] ?? 'https://twitter.com/pradeepsarang') ?>" target="_blank" rel="noopener noreferrer" class="w-8 h-8 rounded-lg bg-black/10 text-stone-800 hover:bg-black hover:text-white flex items-center justify-center transition-all shadow-sm transform hover:-translate-y-0.5" title="Twitter / X">
                <i class="fa-brands fa-x-twitter text-xs"></i>
              </a>
              <a href="<?= e($settings['whatsapp'] ?? 'https://api.whatsapp.com/send?phone=919919007190') ?>" target="_blank" rel="noopener noreferrer" class="w-8 h-8 rounded-lg bg-[#25D366]/15 text-[#128C7E] hover:bg-[#25D366] hover:text-white flex items-center justify-center transition-all shadow-sm transform hover:-translate-y-0.5" title="WhatsApp">
                <i class="fa-brands fa-whatsapp text-sm"></i>
              </a>
              <a href="<?= e($settings['youtube'] ?? 'https://youtube.com/@pradeepsarang') ?>" target="_blank" rel="noopener noreferrer" class="w-8 h-8 rounded-lg bg-[#FF0000]/10 text-[#FF0000] hover:bg-[#FF0000] hover:text-white flex items-center justify-center transition-all shadow-sm transform hover:-translate-y-0.5" title="YouTube Channel">
                <i class="fa-brands fa-youtube text-xs"></i>
              </a>
              <a href="<?= e($settings['instagram'] ?? 'https://instagram.com/pradeepsarang') ?>" target="_blank" rel="noopener noreferrer" class="w-8 h-8 rounded-lg bg-[#E4405F]/10 text-[#E4405F] hover:bg-[#E4405F] hover:text-white flex items-center justify-center transition-all shadow-sm transform hover:-translate-y-0.5" title="Instagram">
                <i class="fa-brands fa-instagram text-xs"></i>
              </a>
            </div>
          </div>
        </div>

        <!-- Right: Bio Details Column -->
        <div class="lg:col-span-8 space-y-4">
          <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-emerald-100/80 text-emerald-900 font-bold text-xs uppercase tracking-wider shadow-sm">
            <span class="material-symbols-outlined text-[16px] text-emerald-700">psychology_alt</span>
            <span><?= e($authorBadgeVal) ?></span>
          </div>

          <p class="text-stone-700 text-sm sm:text-base leading-relaxed font-normal">
            <?= e($authorBioVal) ?>
          </p>

          <!-- Pull Quote Block -->
          <div class="relative p-4 sm:p-5 rounded-2xl bg-emerald-50/70 border-l-4 border-emerald-700 shadow-inner overflow-hidden">
            <span class="material-symbols-outlined absolute -right-2 -bottom-3 text-[72px] text-emerald-900/5 select-none pointer-events-none">format_quote</span>
            <blockquote class="font-serif italic text-emerald-950 text-base sm:text-lg leading-snug font-medium relative z-10">
              “<?= e($authorQuoteVal) ?>”
            </blockquote>
            <cite class="block text-xs font-bold text-emerald-700 uppercase tracking-widest mt-2 not-italic relative z-10">
              — <?= e($authorNameVal) ?>
            </cite>
          </div>

          <!-- Action Buttons & Social Row -->
          <div class="flex flex-wrap items-center justify-between gap-3 pt-2 border-t border-emerald-900/10">
            <div class="flex flex-wrap items-center gap-3">
              <a href="<?= e(base_url('/about')) ?>" data-path="about" class="px-5 py-2.5 rounded-xl bg-emerald-800 hover:bg-emerald-900 text-white font-bold text-sm shadow-md hover:shadow-lg transition-all transform hover:-translate-y-0.5 inline-flex items-center gap-2">
                <span class="material-symbols-outlined text-[18px]">account_box</span>
                <span><?= e(ps_text('संपूर्ण जीवनी व कृतियाँ', 'Full Biography & Works')) ?></span>
                <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
              </a>
              <a href="<?= e(base_url('/contact')) ?>" data-path="contact" class="px-4 py-2.5 rounded-xl bg-white hover:bg-stone-100 text-emerald-900 border border-emerald-900/20 font-bold text-sm shadow-sm transition-all inline-flex items-center gap-2">
                <span class="material-symbols-outlined text-[18px]">mail</span>
                <span><?= e(ps_text('संपर्क करें', 'Contact Author')) ?></span>
              </a>
            </div>

            <!-- Quick Social Media Links -->
            <div class="flex items-center gap-2">
              <span class="text-xs font-semibold text-stone-500 hidden sm:inline"><?= e(ps_text('सोशल:', 'Social:')) ?></span>
              <a href="<?= e($settings['facebook'] ?? 'https://facebook.com/pradeepsarang') ?>" target="_blank" rel="noopener noreferrer" class="w-8 h-8 rounded-lg bg-[#1877F2]/10 text-[#1877F2] hover:bg-[#1877F2] hover:text-white flex items-center justify-center transition-all" title="Facebook">
                <i class="fa-brands fa-facebook-f text-xs"></i>
              </a>
              <a href="<?= e($settings['twitter'] ?? 'https://twitter.com/pradeepsarang') ?>" target="_blank" rel="noopener noreferrer" class="w-8 h-8 rounded-lg bg-black/10 text-stone-800 hover:bg-black hover:text-white flex items-center justify-center transition-all" title="Twitter / X">
                <i class="fa-brands fa-x-twitter text-xs"></i>
              </a>
              <a href="<?= e($settings['youtube'] ?? 'https://youtube.com/@pradeepsarang') ?>" target="_blank" rel="noopener noreferrer" class="w-8 h-8 rounded-lg bg-[#FF0000]/10 text-[#FF0000] hover:bg-[#FF0000] hover:text-white flex items-center justify-center transition-all" title="YouTube">
                <i class="fa-brands fa-youtube text-xs"></i>
              </a>
            </div>
          </div>
      </div>
    </div>
  </section>

  <!-- 4D. Author Opinion Disclaimer Banner -->
  <section class="max-w-container-max mx-auto px-4 sm:px-8 pb-space-2xl w-full">
    <div class="bg-pure-white border border-border-warm rounded-2xl p-5 sm:p-6 shadow-sm flex items-start gap-4">
      <div class="w-10 h-10 rounded-xl bg-primary-fixed/40 text-deep-forest flex items-center justify-center shrink-0 mt-0.5">
        <span class="material-symbols-outlined text-[22px]">gavel</span>
      </div>
      <div class="space-y-1">
        <h4 class="font-title-md text-title-md text-deep-forest font-bold flex items-center gap-2">
          <span><?= e(ps_text('लेखक विचार अस्वीकरण (Editorial & Author Disclaimer)', 'Editorial & Author Disclaimer')) ?></span>
        </h4>
        <p class="font-body-sm text-body-sm text-text-muted leading-relaxed">
          <?= e(ps_text('इस आलेख में व्यक्त किए गए विचार, अनुभव और विश्लेषण पूर्णतः लेखक के व्यक्तिगत विचार हैं। वेबसाइट एवं संपादकीय मंडल आलेख में व्यक्त निजी दृष्टिकोण की स्वतंत्रता का सम्मान करता है। विस्तृत कानूनी शर्तों व नीतियों के लिए कृपया हमारी ', 'The views, thoughts, and opinions expressed in this article belong solely to the author. For detailed legal disclosures, please review our ')) ?>
          <a href="<?= e(base_url('/disclaimer')) ?>" class="text-primary font-semibold underline hover:text-deep-forest transition-colors"><?= e(ps_text('अस्वीकरण नीति (Disclaimer)', 'Disclaimer Policy')) ?></a> 
          <?= e(ps_text('एवं ', 'and ')) ?>
          <a href="<?= e(base_url('/editorial-policy')) ?>" class="text-primary font-semibold underline hover:text-deep-forest transition-colors"><?= e(ps_text('संपादकीय नीति (Editorial Policy)', 'Editorial Policy')) ?></a> 
          <?= e(ps_text('देखें।', 'page.')) ?>
        </p>
      </div>
    </div>
  </section>

  <!-- 4D. Related Literary Posts (Admin-Approved Articles Only) -->
  <?php if (!empty($related)): ?>
  <section class="w-full bg-soft-meadow py-space-3xl border-t border-b border-border-warm">
    <div class="max-w-container-max mx-auto px-4 sm:px-8 space-y-6">
      <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-3">
        <div>
          <span class="font-label-sm text-label-sm text-secondary uppercase font-bold tracking-wider"><?= e(ps_text('साहित्य संचयन', 'Literary Collection')) ?></span>
          <h2 class="font-headline-md text-headline-sm sm:text-headline-md text-deep-forest font-bold mt-1">
            <?= e(ps_text('स्वीकृत अवधी कृतियाँ व अन्य आलेख', 'Approved Literary Works & Other Articles')) ?>
          </h2>
        </div>
        <a href="<?= e(base_url('/blog')) ?>" data-path="blog-and-thoughts" class="inline-flex items-center gap-1 text-primary font-title-md text-body-sm hover:underline font-semibold">
          <span><?= e(ps_text('सभी स्वीकृत आलेख देखें', 'View All Approved Articles')) ?></span>
          <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
        </a>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <?php foreach ($related as $relIdx => $relArt): 
          $rawImg = !empty($relArt['banner_image']) ? $relArt['banner_image'] : (!empty($relArt['featured_image']) ? $relArt['featured_image'] : ($relArt['image'] ?? ''));
          $relImg = ps_resolve_img($rawImg, 'assets/images/slider_final_1.webp');
          $relTitle = html_entity_decode((string)($relArt['title'] ?? ''), ENT_QUOTES, 'UTF-8');
          $relExcerpt = html_entity_decode((string)(!empty($relArt['excerpt']) ? $relArt['excerpt'] : ps_excerpt($relArt['content'] ?? '', 120)), ENT_QUOTES, 'UTF-8');
          
          // Find spread index for this related approved article
          $relSpreadIdx = -1;
          foreach ($allArticles as $sIdx => $sArt) {
              if (($sArt['slug'] ?? '') === ($relArt['slug'] ?? '')) {
                  $relSpreadIdx = $sIdx;
                  break;
              }
          }
        ?>
        <article class="bg-pure-white border border-border-warm rounded-2xl overflow-hidden shadow-xs hover:shadow-md transition-all flex flex-col justify-between group">
          <div>
            <div class="relative h-48 overflow-hidden bg-surface-container">
              <img src="<?= e($relImg) ?>" alt="<?= e($relTitle) ?>" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
              <span class="absolute top-3 left-3 px-2.5 py-1 rounded bg-deep-forest/90 text-pure-white font-label-sm text-label-sm shadow-sm font-semibold">
                <?= e($relArt['category_name'] ?? ps_text('अवधी आलेख', 'Awadhi Article')) ?>
              </span>
            </div>
            <div class="p-5 space-y-2">
              <span class="font-label-sm text-label-sm text-text-muted">
                <?= !empty($relArt['published_at']) ? date('d M Y', strtotime($relArt['published_at'])) : date('d M Y') ?> • <?= e($relArt['reading_time'] ?? '8 min read') ?>
              </span>
              <h3 class="font-headline-sm text-title-md text-on-surface group-hover:text-deep-forest transition-colors font-bold">
                <?= e($relTitle) ?>
              </h3>
              <p class="font-body-sm text-body-sm text-on-surface-variant line-clamp-2">
                <?= e($relExcerpt) ?>
              </p>
            </div>
          </div>
          <div class="p-5 pt-0">
            <?php if ($relSpreadIdx !== -1): ?>
            <button type="button" data-jump="<?= $relSpreadIdx ?>" class="inline-flex items-center gap-1 font-title-md text-body-sm text-primary group-hover:text-deep-forest font-semibold quick-spread-jump cursor-pointer">
              <span><?= e(ps_text('यह आलेख अभी पढ़ें (पृष्ठ ' . to_hindi_num($relSpreadIdx + 1) . ')', 'Read Story (Page ' . ($relSpreadIdx + 1) . ')')) ?></span>
              <span class="material-symbols-outlined text-[16px]">auto_stories</span>
            </button>
            <?php else: ?>
            <a href="<?= e(base_url('/blog/' . $relArt['slug'])) ?>" class="inline-flex items-center gap-1 font-title-md text-body-sm text-primary group-hover:text-deep-forest font-semibold">
              <span><?= e(ps_text('यह आलेख पढ़ें', 'Read Story')) ?></span>
              <span class="material-symbols-outlined text-[16px]">auto_stories</span>
            </a>
            <?php endif; ?>
          </div>
        </article>
        <?php endforeach; ?>
      </div>
    </div>
  </section>
  <?php endif; ?>

  <!-- 4E. Community Comments & Reflections Section -->
  <section class="max-w-container-editorial mx-auto px-4 sm:px-6 w-full py-space-3xl">
    <div class="space-y-6">
      <div class="flex items-center justify-between pb-2 border-b border-border-warm">
        <div>
          <h3 class="font-headline-sm text-title-lg sm:text-headline-sm text-deep-forest font-bold">
            <?= e(ps_text('पाठक प्रतिक्रिया व संस्मरण (Comments)', 'Reader Reflections & Comments')) ?>
          </h3>
          <p class="font-body-sm text-body-sm text-text-muted">
            <span id="comment-story-prompt"><?= e($postTitle) ?></span> <?= e(ps_text('एवं अवधी साहित्य पर अपने विचार साझा करें', 'and your reflections on Awadhi literature')) ?>
          </p>
        </div>
        <span class="px-3 py-1 rounded-full bg-soft-meadow text-deep-forest font-label-sm text-label-sm font-bold border border-border-warm">
          २ <?= e(ps_text('विचार', 'Comments')) ?>
        </span>
      </div>

      <!-- Comment Submission Form -->
      <div class="bg-pure-white border border-border-warm rounded-2xl p-5 sm:p-6 shadow-sm">
        <form id="reader-comment-form" onsubmit="event.preventDefault(); alert('<?= e(ps_text('आपकी टिप्पणी सफलतापूर्वक दर्ज कर ली गई है।', 'Your reflection has been submitted successfully!')) ?>'); this.reset();" class="space-y-4">
          <div>
            <label class="block font-label-md text-label-md text-deep-forest mb-1 font-semibold">
              <?= e(ps_text('आपकी टिप्पणी अथवा बचपन का अवधी संस्मरण:', 'Your Reflection or Childhood Memoir:')) ?>
            </label>
            <textarea rows="4" required class="w-full px-4 py-3 rounded-xl bg-soft-meadow border border-border-warm text-on-surface font-body-md text-body-md focus:outline-none focus:ring-2 focus:ring-primary shadow-xs"></textarea>
          </div>
          <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
              <label class="block font-label-md text-label-md text-deep-forest mb-1 font-semibold"><?= e(ps_text('आपका शुभ नाम:', 'Your Full Name:')) ?></label>
              <input type="text" required class="w-full px-4 py-2.5 rounded-xl bg-soft-meadow border border-border-warm text-on-surface font-body-md text-body-md focus:outline-none focus:ring-2 focus:ring-primary shadow-xs">
            </div>
            <div>
              <label class="block font-label-md text-label-md text-deep-forest mb-1 font-semibold"><?= e(ps_text('ईमेल पता (अप्रकाशित रहेगा):', 'Email Address (Kept Private):')) ?></label>
              <input type="email" required class="w-full px-4 py-2.5 rounded-xl bg-soft-meadow border border-border-warm text-on-surface font-body-md text-body-md focus:outline-none focus:ring-2 focus:ring-primary shadow-xs">
            </div>
          </div>
          <div class="flex items-center justify-between pt-1">
            <div class="flex items-center gap-2">
              <input type="checkbox" id="save-info" class="rounded text-primary focus:ring-primary border-border-warm">
              <label for="save-info" class="font-label-sm text-label-sm text-text-muted"><?= e(ps_text('अगली बार टिप्पणी के लिए मेरा विवरण सुरक्षित रखें', 'Save details for future comments')) ?></label>
            </div>
            <button type="submit" class="px-6 py-2.5 rounded-lg bg-primary text-on-primary font-title-md text-body-sm hover:bg-deep-forest transition-all shadow-sm font-semibold cursor-pointer">
              <?= e(ps_text('संस्मरण भेजें', 'Submit Reflection')) ?>
            </button>
          </div>
        </form>
      </div>

      <!-- Published Reader Comments -->
      <div class="space-y-4">
        <article class="p-5 sm:p-6 rounded-2xl bg-pure-white border border-border-warm shadow-xs space-y-2">
          <div class="flex items-center justify-between">
            <div class="flex items-center gap-3">
              <div class="w-10 h-10 rounded-full bg-soft-meadow text-deep-forest font-bold flex items-center justify-center font-serif text-title-md shadow-inner border border-border-warm">
                वि
              </div>
              <div>
                <h4 class="font-title-md text-body-md font-bold text-on-surface">विनोद कुमार मिश्र</h4>
                <span class="font-label-sm text-label-sm text-text-muted">हैदरगढ़, बाराबंकी • 20 May 2026</span>
              </div>
            </div>
            <span class="material-symbols-outlined text-fresh-sprout text-[20px]" title="<?= e(ps_text('सत्यापित पाठक', 'Verified Reader')) ?>">verified</span>
          </div>
          <p class="font-body-md text-body-md text-on-surface-variant leading-relaxed">
            "सारंग दादा! आपने 'झरिहख' शब्द के साथ पूरे बचपन को आँगन में ला खड़ा किया। वह टीनशेड पर बूँदों का शोर, अम्मा का चूल्हे की बची आग बाहर निकाल कर कपड़े सेंकना... आज सीमेंट के कमरों में वह सोंधी खुशबू और वह अपनापा कहीं खो गया है। अवधी गद्य में ऐसा प्रामाणिक चित्रण विरले ही मिलता है।"
          </p>
        </article>

        <article class="p-5 sm:p-6 rounded-2xl bg-pure-white border border-border-warm shadow-xs space-y-2">
          <div class="flex items-center justify-between">
            <div class="flex items-center gap-3">
              <div class="w-10 h-10 rounded-full bg-[#fdf3ef] text-secondary font-bold flex items-center justify-center font-serif text-title-md shadow-inner border border-border-warm">
                डॉ
              </div>
              <div>
                <h4 class="font-title-md text-body-md font-bold text-on-surface">डॉ. सुधीर शुक्ला</h4>
                <span class="font-label-sm text-label-sm text-text-muted">लखनऊ विश्वविद्यालय • 21 May 2026</span>
              </div>
            </div>
            <span class="material-symbols-outlined text-secondary text-[20px]">format_quote</span>
          </div>
          <p class="font-body-md text-body-md text-on-surface-variant leading-relaxed">
            "श्रद्धेय डॉ. भगवान वत्स जी के प्रति व्यक्त आदर और राष्ट्रीय सेवा योजना की वह दृष्टि आज भी आपकी जीवनशैली में झलकती है। रात को 1 बजे तक अखबार का संपादन और सुबह पक्षियों का कलरव—यह संस्मरण मात्र एक आलेख नहीं, ग्रामीण जीवन का सांस्कृतिक दस्तावेज है।"
          </p>
        </article>
      </div>
    </div>
  </section>
</div>

<!-- Interactive 3D Page Flip, Soundwave & Reader Micro-Interactions Script -->
<script>
  (function() {
    // 1. Spreads data and state
    const spreads = document.querySelectorAll('.spread-slide');
    const totalSpreads = spreads.length;
    let currentSpreadIndex = <?= (int)$currentIndex ?>;
    let isAnimating = false;

    // Dynamically generated metadata for all chapters
    const spreadMetadata = <?= json_encode(array_map(function($idx, $art) use ($totalArticles) {
        return [
            'crumbCat' => $art['category_name'] ?? $art['category'] ?? 'आलेख',
            'crumbTitle' => $art['title'] ?? '',
            'slug' => $art['slug'] ?? '',
            'pagesDisplay' => to_hindi_num($idx + 1) . ' / ' . to_hindi_num($totalArticles),
            'footerDesc' => 'प्रदीप सारंग संस्मरण डिजिटल ग्रंथावली (संस्करण 2026)',
            'readingTime' => $art['reading_time'] ?? '12 min read'
        ];
    }, array_keys($allArticles), $allArticles), JSON_UNESCAPED_UNICODE) ?>;

    const btnPrev = document.getElementById('btn-prev-page');
    const btnNext = document.getElementById('btn-next-page');
    const btnTopPrev = document.getElementById('btn-top-prev-page');
    const btnTopNext = document.getElementById('btn-top-next-page');
    const btnBinderPrev = document.getElementById('btn-binder-prev-page');
    const btnBinderNext = document.getElementById('btn-binder-next-page');
    const pageBadge = document.getElementById('page-counter-badge');
    const topPageBadge = document.getElementById('top-page-counter-badge');
    const binderPageBadge = document.getElementById('binder-page-counter-badge');
    const crumbCat = document.getElementById('crumb-category');
    const crumbTitle = document.getElementById('crumb-title');
    const footerTitle = document.getElementById('book-footer-title');
    const readingBadge = document.getElementById('reading-time-badge');
    const progressBar = document.getElementById('read-progress-fill');
    const hotzoneLeft = document.getElementById('hotzone-left');
    const hotzoneRight = document.getElementById('hotzone-right');

    function updateControls() {
      const isFirst = currentSpreadIndex === 0;
      const isLast = currentSpreadIndex === totalSpreads - 1;

      if (btnPrev) btnPrev.disabled = isFirst;
      if (btnNext) btnNext.disabled = isLast;
      if (btnTopPrev) btnTopPrev.disabled = isFirst;
      if (btnTopNext) btnTopNext.disabled = isLast;
      if (btnBinderPrev) btnBinderPrev.disabled = isFirst;
      if (btnBinderNext) btnBinderNext.disabled = isLast;

      const meta = spreadMetadata[currentSpreadIndex] || spreadMetadata[0];
      if (pageBadge) pageBadge.textContent = meta.pagesDisplay;
      if (topPageBadge) topPageBadge.textContent = meta.pagesDisplay;
      if (binderPageBadge) binderPageBadge.textContent = meta.pagesDisplay;

      if (crumbCat) crumbCat.textContent = meta.crumbCat;
      if (crumbTitle) crumbTitle.textContent = meta.crumbTitle;
      if (footerTitle) footerTitle.textContent = meta.footerDesc;
      if (readingBadge) readingBadge.textContent = meta.readingTime;

      // Update document title
      if (meta.crumbTitle) {
        document.title = meta.crumbTitle + ' | <?= e(app_config('name')) ?>';
      }

      // Update comment prompt
      const commentStoryPrompt = document.getElementById('comment-story-prompt');
      if (commentStoryPrompt && meta.crumbTitle) {
        commentStoryPrompt.textContent = meta.crumbTitle;
      }

      // Update active lexicon deck
      document.querySelectorAll('[data-lex-spread]').forEach(deck => {
        const sIdx = parseInt(deck.getAttribute('data-lex-spread'), 10);
        if (sIdx === currentSpreadIndex) {
          deck.classList.remove('hidden');
          deck.classList.add('grid');
        } else {
          deck.classList.remove('grid');
          deck.classList.add('hidden');
        }
      });

      // update reading progress
      const percent = Math.round(((currentSpreadIndex + 1) / totalSpreads) * 100);
      if (progressBar) progressBar.style.width = percent + '%';

      // Update URL and social share URLs without reloading page
      if (meta.slug) {
        const baseBlogUrl = '<?= base_url('/blog/') ?>';
        const newUrl = baseBlogUrl + meta.slug;
        if (window.history.replaceState) {
          window.history.replaceState({ spread: currentSpreadIndex }, meta.crumbTitle, newUrl);
        }

        const shareText = encodeURIComponent(meta.crumbTitle + ' - श्री प्रदीप सारंग संस्मरण\n\n' + newUrl);
        const waBtn = document.querySelector('a[href*="whatsapp.com"]');
        if (waBtn) waBtn.href = 'https://api.whatsapp.com/send?text=' + shareText;

        const fbBtn = document.querySelector('a[href*="facebook.com/sharer"]');
        if (fbBtn) fbBtn.href = 'https://www.facebook.com/sharer/sharer.php?u=' + encodeURIComponent(newUrl);

        const twBtn = document.querySelector('a[href*="twitter.com/intent/tweet"]');
        if (twBtn) twBtn.href = 'https://twitter.com/intent/tweet?text=' + encodeURIComponent(meta.crumbTitle) + '&url=' + encodeURIComponent(newUrl) + '&hashtags=PradeepSarang,AwadhiLiterature';

        const inBtn = document.querySelector('a[href*="linkedin.com/sharing"]');
        if (inBtn) inBtn.href = 'https://www.linkedin.com/sharing/share-offsite/?url=' + encodeURIComponent(newUrl);
      }
    }

    function flipToSpread(targetIndex, direction) {
      if (isAnimating || targetIndex < 0 || targetIndex >= totalSpreads || targetIndex === currentSpreadIndex) return;
      isAnimating = true;

      const currentSpread = spreads[currentSpreadIndex];
      const nextSpread = spreads[targetIndex];

      // Animate out current page slowly like opening a book
      if (direction === 'forward') {
        currentSpread.style.transformOrigin = 'left center';
        nextSpread.style.transformOrigin = 'left center';

        currentSpread.classList.remove('active');
        currentSpread.classList.add('flip-next');
        
        setTimeout(() => {
          currentSpread.classList.add('hidden');
          currentSpread.classList.remove('flip-next');
        }, 1100);

        // Animate in target page
        nextSpread.classList.remove('hidden');
        nextSpread.classList.add('flip-prev');
        void nextSpread.offsetWidth; // force reflow
        setTimeout(() => {
          nextSpread.classList.remove('flip-prev');
          nextSpread.classList.add('active');
        }, 50);
      } else {
        currentSpread.style.transformOrigin = 'right center';
        nextSpread.style.transformOrigin = 'right center';

        // Backward slow flip
        currentSpread.classList.remove('active');
        currentSpread.classList.add('flip-prev');
        
        setTimeout(() => {
          currentSpread.classList.add('hidden');
          currentSpread.classList.remove('flip-prev');
        }, 1100);

        nextSpread.classList.remove('hidden');
        nextSpread.classList.add('flip-next');
        void nextSpread.offsetWidth;
        setTimeout(() => {
          nextSpread.classList.remove('flip-next');
          nextSpread.classList.add('active');
        }, 50);
      }

      currentSpreadIndex = targetIndex;
      updateControls();

      setTimeout(() => {
        isAnimating = false;
      }, 1200);
    }

    // Next / Prev actions
    if (btnNext) btnNext.addEventListener('click', () => flipToSpread(currentSpreadIndex + 1, 'forward'));
    if (btnPrev) btnPrev.addEventListener('click', () => flipToSpread(currentSpreadIndex - 1, 'backward'));
    if (btnTopNext) btnTopNext.addEventListener('click', () => flipToSpread(currentSpreadIndex + 1, 'forward'));
    if (btnTopPrev) btnTopPrev.addEventListener('click', () => flipToSpread(currentSpreadIndex - 1, 'backward'));
    if (btnBinderNext) btnBinderNext.addEventListener('click', () => flipToSpread(currentSpreadIndex + 1, 'forward'));
    if (btnBinderPrev) btnBinderPrev.addEventListener('click', () => flipToSpread(currentSpreadIndex - 1, 'backward'));
    if (hotzoneRight) hotzoneRight.addEventListener('click', () => flipToSpread(currentSpreadIndex + 1, 'forward'));
    if (hotzoneLeft) hotzoneLeft.addEventListener('click', () => flipToSpread(currentSpreadIndex - 1, 'backward'));

    // Table of Contents Drawer Modal interactions
    const tocModal = document.getElementById('toc-modal');
    const tocDrawer = document.getElementById('toc-drawer');
    const btnOpenToc = document.getElementById('btn-open-toc');
    const btnCloseToc = document.getElementById('btn-close-toc');

    function openToc() {
      if (!tocModal || !tocDrawer) return;
      tocModal.classList.remove('opacity-0', 'pointer-events-none');
      tocDrawer.classList.remove('translate-x-full');
    }

    function closeToc() {
      if (!tocModal || !tocDrawer) return;
      tocModal.classList.add('opacity-0', 'pointer-events-none');
      tocDrawer.classList.add('translate-x-full');
    }

    if (btnOpenToc) btnOpenToc.addEventListener('click', openToc);
    if (btnCloseToc) btnCloseToc.addEventListener('click', closeToc);
    if (tocModal) {
      tocModal.addEventListener('click', (e) => {
        if (e.target === tocModal) closeToc();
      });
    }

    // Quick jumps from TOC cards & Related Story Cards
    const jumpButtons = document.querySelectorAll('.toc-item, .quick-spread-jump');
    jumpButtons.forEach(btn => {
      btn.addEventListener('click', () => {
        const target = parseInt(btn.getAttribute('data-jump'), 10);
        if (!isNaN(target)) {
          closeToc();
          const dir = target > currentSpreadIndex ? 'forward' : 'backward';
          flipToSpread(target, dir);
          const bookSpread = document.getElementById('book-spread-paper');
          if (bookSpread) {
            bookSpread.scrollIntoView({ behavior: 'smooth', block: 'start' });
          }
        }
      });
    });

    // Keyboard navigation (ArrowLeft & ArrowRight)
    window.addEventListener('keydown', (e) => {
      if (['INPUT', 'TEXTAREA'].includes(document.activeElement?.tagName)) return;
      if (e.key === 'ArrowRight') {
        flipToSpread(currentSpreadIndex + 1, 'forward');
      } else if (e.key === 'ArrowLeft') {
        flipToSpread(currentSpreadIndex - 1, 'backward');
      } else if (e.key === 'Escape') {
        closeToc();
      }
    });

    // 2. Font size adjustment for all book spreads
    const proseElements = document.querySelectorAll('.prose-book');
    const btnInc = document.getElementById('btn-font-inc');
    const btnDec = document.getElementById('btn-font-dec');
    let currentSize = 17;

    if (btnInc && btnDec) {
      btnInc.addEventListener('click', () => {
        if (currentSize < 22) {
          currentSize += 1;
          proseElements.forEach(el => el.style.fontSize = currentSize + 'px');
        }
      });
      btnDec.addEventListener('click', () => {
        if (currentSize > 14) {
          currentSize -= 1;
          proseElements.forEach(el => el.style.fontSize = currentSize + 'px');
        }
      });
    }

    // 3. Serif / Sans toggle across spreads
    const btnSerif = document.getElementById('btn-font-serif');
    const btnSans = document.getElementById('btn-font-sans');
    if (btnSerif && btnSans) {
      btnSerif.addEventListener('click', () => {
        proseElements.forEach(el => {
          el.classList.remove('font-body-md');
          el.classList.add('font-headline-sm');
        });
        btnSerif.classList.add('bg-surface', 'text-deep-forest', 'font-bold');
        btnSerif.classList.remove('text-on-surface-variant');
        btnSans.classList.remove('bg-surface', 'text-deep-forest', 'font-bold');
        btnSans.classList.add('text-on-surface-variant');
      });

      btnSans.addEventListener('click', () => {
        proseElements.forEach(el => {
          el.classList.remove('font-headline-sm');
          el.classList.add('font-body-md');
        });
        btnSans.classList.add('bg-surface', 'text-deep-forest', 'font-bold');
        btnSans.classList.remove('text-on-surface-variant');
        btnSerif.classList.remove('bg-surface', 'text-deep-forest', 'font-bold');
        btnSerif.classList.add('text-on-surface-variant');
      });
    }

    // 4. Paper tone switcher
    const bookSpread = document.getElementById('book-spread-paper');
    const toneButtons = document.querySelectorAll('[data-tone]');
    toneButtons.forEach(btn => {
      btn.addEventListener('click', () => {
        const tone = btn.getAttribute('data-tone');
        toneButtons.forEach(b => b.classList.remove('ring-2', 'ring-primary'));
        btn.classList.add('ring-2', 'ring-primary');
        
        if (!bookSpread) return;
        if (tone === 'tone-parchment') {
          bookSpread.style.backgroundColor = '#fdfaf3';
        } else if (tone === 'tone-ivory') {
          bookSpread.style.backgroundColor = '#fcf9f2';
        } else if (tone === 'tone-linen') {
          bookSpread.style.backgroundColor = '#f4ede1';
        }
      });
    });

    // 5. Audio Toggle with sound wave visualizer
    const audioBtn = document.getElementById('audio-toggle-btn');
    const visualizer = document.getElementById('audio-visualizer');
    const audioText = document.getElementById('audio-btn-text');
    let isPlaying = false;
    if (audioBtn && visualizer && audioText) {
      audioBtn.addEventListener('click', () => {
        isPlaying = !isPlaying;
        if (isPlaying) {
          audioBtn.classList.replace('bg-primary-container', 'bg-secondary');
          visualizer.innerHTML = `
            <span class="w-1 bg-pure-white rounded-full sound-bar"></span>
            <span class="w-1 bg-pure-white rounded-full sound-bar"></span>
            <span class="w-1 bg-pure-white rounded-full sound-bar"></span>
            <span class="w-1 bg-pure-white rounded-full sound-bar"></span>
          `;
          audioText.textContent = '<?= e(ps_text("सारंग जी का वाचन चल रहा है... [रोकें]", "Playing Audio Narration... [Stop]")) ?>';
        } else {
          audioBtn.classList.replace('bg-secondary', 'bg-primary-container');
          visualizer.innerHTML = '<span class="material-symbols-outlined text-[16px]">volume_up</span>';
          audioText.textContent = '<?= e(ps_text("सारंग जी के स्वर में सुनें (12:48)", "Listen in Sarang Ji's Voice (12:48)")) ?>';
        }
      });
    }

    // 6. Copy Link Button
    const copyBtn = document.getElementById('copy-link-btn');
    const copyLabel = document.getElementById('copy-text-label');
    if (copyBtn && copyLabel) {
      copyBtn.addEventListener('click', () => {
        navigator.clipboard.writeText(window.location.href);
        copyLabel.textContent = '<?= e(ps_text("लिंक कॉपी हो गया!", "Link Copied!")) ?>';
        setTimeout(() => {
          copyLabel.textContent = '<?= e(ps_text("लिंक कॉपी करें", "Copy Link")) ?>';
        }, 2500);
      });
    }

    // Initialize
    updateControls();
  })();
</script>
