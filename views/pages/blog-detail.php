<?php
declare(strict_types=1);

$post = $post ?? [];
$related = $related ?? [];

$postTitle = html_entity_decode(trim($post['title'] ?? '') ?: ps_text('झरिहख', 'Jharihakh'), ENT_QUOTES | ENT_HTML5, 'UTF-8');
$postCategory = html_entity_decode(trim($post['category_name'] ?? '') ?: ps_text('अवधी संस्मरण', 'Awadhi Memoir'), ENT_QUOTES | ENT_HTML5, 'UTF-8');
$postAuthor = html_entity_decode(trim(($post['author_name'] ?? '') ?: ($post['author'] ?? '')) ?: ps_text('श्री प्रदीप सारंग', 'Shri Pradeep Sarang'), ENT_QUOTES | ENT_HTML5, 'UTF-8');
$postDate = !empty($post['published_at']) ? date('d M Y', strtotime($post['published_at'])) : ps_text('१९ मई २०२६', '19 May 2026');
$postContent = trim($post['content'] ?? '');
$postExcerpt = html_entity_decode(trim($post['excerpt'] ?? '') ?: ps_text('"वर्षा, बचपन और गाँव की चौपाल के सजीव संस्मरण"', '"Evocative memories of rain, childhood and village chaupal"'), ENT_QUOTES | ENT_HTML5, 'UTF-8');

$postImage = !empty($post['featured_image']) ? $post['featured_image'] : (!empty($post['banner_image']) ? $post['banner_image'] : (!empty($post['image']) ? $post['image'] : (!empty($post['image_url']) ? $post['image_url'] : '')));

if ($postImage && !preg_match('#^https?://#i', $postImage)) {
    $postImage = base_url($postImage);
}

// Dedicated Image resolution for Sughari (matching listing page image uploads/blogs/6aa7bcfb1d48c_mela.webp)
$sughariImg = '';
if (!empty($post['title']) && str_contains(mb_strtolower($post['title']), 'सुघरी')) {
    $sughariImg = $postImage;
}
if (empty($sughariImg)) {
    foreach ($related as $relItem) {
        if (!empty($relItem['title']) && str_contains(mb_strtolower($relItem['title']), 'सुघरी')) {
            $relImg = !empty($relItem['featured_image']) ? $relItem['featured_image'] : ($relItem['banner_image'] ?? '');
            if ($relImg) {
                $sughariImg = preg_match('#^https?://#i', $relImg) ? $relImg : base_url($relImg);
                break;
            }
        }
    }
}
if (empty($sughariImg)) {
    $sughariImg = base_url('uploads/blogs/6aa7bcfb1d48c_mela.webp');
}
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
  <section class="w-full bg-soft-meadow border-b border-border-warm py-1.5 relative z-30 shadow-xs">
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
      <div class="flex flex-wrap items-center gap-2.5 sm:gap-3">
        <!-- Top Page Nav Pill -->
        <div class="inline-flex items-center gap-1.5 bg-pure-white border border-border-warm rounded-lg p-0.5 shadow-xs">
          <button type="button" class="px-2.5 py-1 rounded-md bg-surface text-deep-forest hover:bg-primary-container hover:text-pure-white font-label-sm text-label-sm font-semibold transition-colors flex items-center gap-1 disabled:opacity-40 disabled:cursor-not-allowed cursor-pointer" id="btn-top-prev-page" title="<?= e(ps_text('पिछला पृष्ठ', 'Previous Page')) ?>">
            <span class="material-symbols-outlined text-[16px]">arrow_back</span>
            <span class="hidden sm:inline"><?= e(ps_text('पिछला', 'Prev')) ?></span>
          </button>
          <span class="text-deep-forest font-mono font-bold text-xs px-2" id="top-page-counter-badge">१ / ३</span>
          <button type="button" class="px-2.5 py-1 rounded-md bg-primary-container text-pure-white hover:bg-deep-forest font-label-sm text-label-sm font-semibold transition-colors flex items-center gap-1 disabled:opacity-40 disabled:cursor-not-allowed cursor-pointer shadow-xs" id="btn-top-next-page" title="<?= e(ps_text('अगला पृष्ठ', 'Next Page')) ?>">
            <span><?= e(ps_text('अगला पृष्ठ', 'Next Page')) ?></span>
            <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
          </button>
        </div>



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
          <span id="reading-time-badge">12 min read</span>
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
    <div class="h-full bg-fresh-sprout transition-all duration-300" id="read-progress-fill" style="width: 33%;"></div>
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
            <button type="button" class="px-3 py-1.5 rounded-lg bg-deep-forest/90 hover:bg-deep-forest disabled:opacity-40 disabled:cursor-not-allowed text-pure-white flex items-center gap-1 transition-all shadow-sm active:scale-95 cursor-pointer font-semibold" id="btn-binder-prev-page">
              <span class="material-symbols-outlined text-[16px]">arrow_back</span>
              <span class="hidden sm:inline"><?= e(ps_text('पिछला पृष्ठ', 'Previous Page')) ?></span>
            </button>
            <span class="text-surface-variant font-mono text-xs px-2.5 py-1 rounded bg-black/40 border border-white/10" id="binder-page-counter-badge">१ / ३</span>
            <button type="button" class="px-3 py-1.5 rounded-lg bg-primary-container hover:bg-deep-forest disabled:opacity-40 disabled:cursor-not-allowed text-pure-white flex items-center gap-1 transition-all shadow-sm active:scale-95 cursor-pointer font-semibold" id="btn-binder-next-page">
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

            <!-- ================= STORY 1 (Spread 0): झरिहख ================= -->
            <div class="spread-slide active min-h-full" data-spread="0">
              <article class="p-6 sm:p-10 md:p-12 lg:p-14 max-w-4xl mx-auto flex flex-col justify-between min-h-full bg-[#faf8f2] book-page-content">
                <div>
                  <!-- Page Archival Header -->
                  <header class="flex items-center justify-between pb-3 mb-5 border-b border-[#e2dacf]">
                    <span class="font-label-sm text-[11px] uppercase tracking-widest text-[#795548] font-bold">
                      <?= e(ps_text('प्रदीप सारंग संस्मरण संकलन • अध्याय १ / ३', 'Pradeep Sarang Memoir Collection • Story 1 of 3')) ?>
                    </span>
                    <div class="flex items-center gap-1 text-on-surface-variant font-label-sm text-label-sm">
                      <span class="font-serif"><?= e(ps_text('अध्याय १', 'Story 1')) ?></span>
                    </div>
                  </header>

                  <!-- Chapter Decorative Motif / Emblem -->
                  <div class="flex items-center justify-center my-3">
                    <div class="w-12 h-px bg-secondary/40"></div>
                    <span class="material-symbols-outlined text-secondary mx-3 text-[20px]" style="font-variation-settings: 'FILL' 1;">spa</span>
                    <div class="w-12 h-px bg-secondary/40"></div>
                  </div>

                  <!-- 2-COLUMN TOP HEADER LAYOUT (Image Left, Text Right) -->
                  <div class="grid grid-cols-1 md:grid-cols-12 gap-6 sm:gap-8 items-center mb-8 pb-6 border-b border-[#e2dacf]">
                    <!-- Left Column: Featured Cover Image or Symbol Image -->
                    <div class="md:col-span-5 flex justify-center items-center">
                      <div class="w-full overflow-hidden rounded-2xl shadow-md border border-[#e2dacf] bg-white p-1.5 group">
                        <?php if (!empty($postImage)): ?>
                          <img src="<?= e($postImage) ?>" alt="<?= e($postTitle) ?>" class="w-full h-auto max-h-[380px] object-cover rounded-xl group-hover:scale-[1.02] transition-transform duration-500" loading="eager" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';" />
                          <div class="w-full min-h-[220px] rounded-xl bg-gradient-to-br from-emerald-900 via-deep-forest to-emerald-950 text-white flex flex-col items-center justify-center p-6 text-center" style="display:none;">
                            <img src="<?= e(asset('images/home/icon.svg')) ?>" alt="Symbol" class="w-16 h-16 object-contain mb-2 filter drop-shadow">
                            <span class="font-serif font-bold text-base text-amber-300"><?= e($postTitle) ?></span>
                          </div>
                        <?php else: ?>
                          <!-- Symbol Image Emblem Placeholder -->
                          <div class="w-full min-h-[220px] rounded-xl bg-gradient-to-br from-emerald-900 via-deep-forest to-emerald-950 text-white flex flex-col items-center justify-center p-6 text-center shadow-inner relative overflow-hidden">
                            <div class="absolute inset-0 bg-white/5 bg-[radial-gradient(#fff_1px,transparent_1px)] [background-size:12px_12px] opacity-30"></div>
                            <img src="<?= e(asset('images/home/icon.svg')) ?>" alt="Literary Emblem Symbol" class="w-20 h-20 object-contain relative z-10 mb-2 filter drop-shadow-md">
                            <span class="font-serif font-bold text-sm tracking-wider text-amber-300 relative z-10 uppercase"><?= e($postCategory) ?></span>
                            <span class="font-serif text-xs text-emerald-200 mt-1 relative z-10"><?= e($postTitle) ?></span>
                          </div>
                        <?php endif; ?>
                      </div>
                    </div>

                    <!-- Right Column: Title, Subtitle, Category & Metadata -->
                    <div class="md:col-span-7 flex flex-col justify-center">
                      <div>
                        <span class="inline-block px-3 py-1 rounded-full bg-[#f4ebd9] text-secondary font-label-sm text-label-sm font-semibold mb-2.5">
                          <?= e($postCategory) ?>
                        </span>
                        <h1 class="font-headline-lg text-[28px] sm:text-[36px] lg:text-[40px] leading-tight text-deep-forest tracking-tight font-bold mb-3">
                          <?= e($postTitle) ?>
                        </h1>
                        <?php if (!empty($postExcerpt)): ?>
                        <p class="font-serif italic text-[#614b3d] text-body-md sm:text-title-md leading-relaxed mb-5">
                          <?= e($postExcerpt) ?>
                        </p>
                        <?php endif; ?>
                      </div>

                      <!-- Memoir Metadata Stamp -->
                      <div class="p-3 bg-[#f7f3ea] border border-[#ebe0d0] rounded-lg flex flex-wrap items-center justify-between text-label-sm font-label-sm text-on-surface-variant gap-2 mt-1">
                        <div class="flex items-center gap-1.5">
                          <span class="material-symbols-outlined text-primary text-[17px]">account_circle</span>
                          <span><?= e(ps_text('लेखक:', 'Author:')) ?> <strong><?= e($postAuthor) ?></strong></span>
                        </div>
                        <div class="flex items-center gap-1.5">
                          <span class="material-symbols-outlined text-secondary text-[17px]">event</span>
                          <span><?= e($postDate) ?></span>
                        </div>
                        <div class="flex items-center gap-1.5">
                          <span class="material-symbols-outlined text-deep-forest text-[17px]">pin_drop</span>
                          <span><?= e(ps_text('ग्राम कमरावां, सतरिख (बाराबंकी)', 'Village Kamrawan, Satrikh (Barabanki)')) ?></span>
                        </div>
                      </div>
                    </div>
                  </div>

                  <?php else: ?>
                  <!-- CENTERED SINGLE-COLUMN TOP HEADER LAYOUT (When No Image) -->
                  <div class="text-center mb-5">
                    <span class="inline-block px-3 py-1 rounded-full bg-[#f4ebd9] text-secondary font-label-sm text-label-sm font-semibold mb-2">
                      <?= e($postCategory) ?>
                    </span>
                    <h1 class="font-headline-lg text-[34px] sm:text-[42px] leading-tight text-deep-forest tracking-tight mt-1 mb-2 font-bold">
                      <?= e($postTitle) ?>
                    </h1>
                    <?php if (!empty($postExcerpt)): ?>
                    <p class="font-serif italic text-[#614b3d] text-body-md sm:text-title-md max-w-2xl mx-auto">
                      <?= e($postExcerpt) ?>
                    </p>
                    <?php endif; ?>
                  </div>

                  <!-- Memoir Metadata Stamp -->
                  <div class="p-3 bg-[#f7f3ea] border border-[#ebe0d0] rounded-lg mb-6 flex flex-wrap items-center justify-between text-label-sm font-label-sm text-on-surface-variant gap-2">
                    <div class="flex items-center gap-1.5">
                      <span class="material-symbols-outlined text-primary text-[17px]">account_circle</span>
                      <span><?= e(ps_text('लेखक:', 'Author:')) ?> <strong><?= e($postAuthor) ?></strong></span>
                    </div>
                    <div class="flex items-center gap-1.5">
                      <span class="material-symbols-outlined text-secondary text-[17px]">event</span>
                      <span><?= e($postDate) ?></span>
                    </div>
                    <div class="flex items-center gap-1.5">
                      <span class="material-symbols-outlined text-deep-forest text-[17px]">pin_drop</span>
                      <span><?= e(ps_text('ग्राम कमरावां, सतरिख (बाराबंकी)', 'Village Kamrawan, Satrikh (Barabanki)')) ?></span>
                    </div>
                  </div>
                  <?php endif; ?>

                  <!-- Complete Unified Narrative Prose -->
                  <?php if (!empty($postContent)): ?>
                    <div class="space-y-4 prose-book font-headline-sm font-normal text-[16px] sm:text-[17px] leading-[1.8] text-justify text-[#2b302c]">
                      <?= ps_rich_text($postContent) ?>
                    </div>
                  <?php else: ?>
                    <div class="space-y-4 prose-book font-headline-sm font-normal text-[16px] sm:text-[17px] leading-[1.8] text-justify text-[#2b302c]">
                      <p>
                        <span class="float-left text-[56px] leading-[46px] font-headline-lg font-bold text-secondary mr-3 mt-1 pb-1">आ</span>जु जब हम सोय कै जागेन, तौ झमाझम बारिस होत रही। झमाझम मतलब वाकई झम-झम, झम-झम कै आवाज कानन मा सुनाय परत रही। ईका येकु कारन इहौ रहा कि हम घर की छत पर बने सीमेंटेड-टीन सेट के नीचे सोइत है। पानी की बड़ी बड़ी बूँदन के टीनसेट पर गिरै से यही तिना केर, झमझम-झमझम आवाज निकरत रही। आजु कुछ अलग तिना केरी आवाज से कुछ अटपट लाग और जल्दिन खुमारी भागिगै। हमका लाग कि आजु जानौ झरिहख परि जाई।
                      </p>
                      <p>
                        हमरी घरैतिन रोजै छत पर याक बरतन मा पानी भरि देती हैं अउर राति केर बची बासी चावल, रोटी रखि दियत हैं। जौन दिन बासी नहीं बचत है उइ दिन चावल के खंढा यानी कनकी रखि दियत हैं। जेहिका चुगै मेर-मेर की चिरई अउती हैं। नाश्ता भोजन करती हैं अउर जलपान करती हैं। दाना चुगै मा लगातार चह-चहावा करती हैं।
                      </p>
                      <p>
                        सबै ग्रंथन मा बखान है कि ब्रम्ह मुहूरत मा जागै और उठै का चाही। मुला कइव सालन से हम ग्रंथन केर बातै मानब बन्द करिकै जौन हमरे तईं सही लागत है हम उहै करित है। ईका मतलब ई बिलकुलै नहीं है कि हम ग्रंथन केर अपमान या अवमानना करित है। हमार जरुरतै अइस है कि हमका घंटा भरि दिन चढ़े तक सोवै का परत है।
                      </p>
                      <p>
                        हमरे पास हिंदी दैनिक समाचार पत्र <em>सन्दौली टाइम्स</em> मा सह संपादक का दायित्व है। प्रूफ देखै मा, हेडिंग सुधारै मा, रोजै राति के बारह-साढ़े बारह बजिन जात है, अउर सोवत सोवत येकु। अब येकु बजे सोये के बादि जल्दिन जागब न सम्भव है न उचित।
                      </p>
                      <p>
                        हमका या समझ मिली है गुरुवर <strong>डॉ भगवान वत्स जी</strong> से। राष्ट्रीय सेवा योजना अउर डॉ वत्स जी की बातन का असर आजु चारि दशक साल बीते के बादिव अगली पीढ़ी तक देखाय परत है। जनपद बाराबंकी सहित आसपास के जनपदन के तमाम लोगन के जीवन पर डॉ भगवान वत्स जी की यही तिना की तमाम सारी बातन का असर है।
                      </p>
                      <p>
                        आजु सबेरेन से बारिस होय रही है। 10 बजि रहा है। अबहीं तक देखे से तौ इहै अनुमान है कि आजु झरिहख परी। पिछले कइव दिनन मा आंशिक-झरिहख जइस मौसम रहा है। हम लोगन के छुटपने मा तीन-तीन दिन के झरिहख परत रहैं। हमका ठीक से यादि है कि चिरइन का दाना चुनै भर का समय नहीं मिलत रहा कि निकरि सकैं।
                      </p>
                      <p>
                        गाँव से न जुड़े रहै वाले अउर अवधी न बोलै समझै वाले लोगन तईं झरिहख नवा शब्द आही। झरिहख मतलब न पानी बन्द हुवै न बरसबै करै। हल्की हल्की फुहार परा करै। यानी धीमी बारिस होत रहत है। जब ई तिना कै बारिस चारि छः घण्टा होत रहत है तब ई तिना की हल्की बारिस का झरिहख कहा जात है।
                      </p>

                      <!-- Editorial Pull-Quote -->
                      <div class="my-5 p-4 rounded-lg bg-[#f3ede1] border-l-4 border-secondary shadow-inner">
                        <p class="font-quote-editorial italic text-secondary text-[18px] leading-relaxed text-center">
                          "याक बात अउर कि अगर कोऊ के घर मा कौनिव व्याधि आई तौ लोगन का पता रहत रहा कि कहाँ कहाँ कीके द्वारे लोग इकट्ठा रहत हैं... तुरन्ते दस-पंद्रह लोग मदद तईं चलि परैं।"
                        </p>
                      </div>

                      <p>
                        झरिहख मा सबका दिक्कत होइन जात है। हमरे छुटपने मा गाँव भर मा दुई चारि घर छोड़ि कै सबके घर कच्चेन हुवत रहे। जब जब झरिहख परत रहा तब तब हर गाँव मा दुई चारि दीवालै जरूर गिरि जाती रहैं। दुई-तीनि दिन के झरिहख मा लोग घर से निकरै न पावैं तब लोग ऊबि जात रहे।
                      </p>
                      <p>
                        तब गैस चूल्हा केर ईजाद नहीं भवा रहै यहिसे सबके घरन मा खाना चूल्हे पर बनत रहा। झरिहख मा सूखि लकड़ी खतम होइ जाय। अम्मा जब खाना बनाय चुकैं तब चूल्हे कै आगि बाहर निकारि कै रखि दियैं तब हम सब आपनि आपनि कपड़ा सेंकि कै सुखाइत रहै।
                      </p>

                      <div class="my-4 p-4 rounded-lg bg-[#efe7d8] border border-[#decbb4]">
                        <p class="font-bold text-deep-forest text-[16px] leading-relaxed">
                          "झरिहख मा अतना पानी गिरत रहा कि बाढ़ जइस हालात बनि जात रहे। का मनई का जानवर ई झरिहख से सबै ऊबि जाँय। गरीबन केर तौ दुश्मनै आही झरिहखु।"
                        </p>
                        <span class="block text-right font-serif italic text-secondary text-sm font-semibold mt-1">— प्रदीप सारंग</span>
                      </div>
                    </div>
                  <?php endif; ?>
                </div>

                <!-- Footnote & Author Signoff -->
                <footer class="mt-8 pt-4 border-t border-[#e2dacf]">
                  <div class="bg-[#f8f5ed] border border-[#ebe4d5] p-3 rounded-md text-[13px] font-serif text-[#5f6861] mb-4">
                    <div class="flex items-start gap-2">
                      <span class="material-symbols-outlined text-secondary text-[16px] mt-0.5">menu_book</span>
                      <p><strong>*<?= e(ps_text('पादटिप्पणी संदर्भ:', 'Footnote Reference:')) ?></strong> <em>झरिहख</em> (अवधी संज्ञा) — बिना रुके अनवरत चलने वाली धीमी रिमझिम व मूसलाधार फुहार, जो दिन-रात आकाश को घेरे रखती है।</p>
                    </div>
                  </div>
                  <div class="flex flex-col items-center justify-center text-center">
                    <div class="flex items-center gap-2 text-secondary opacity-80 mb-1">
                      <span class="w-8 h-px bg-secondary"></span>
                      <span class="material-symbols-outlined text-[20px]">auto_stories</span>
                      <span class="w-8 h-px bg-secondary"></span>
                    </div>
                    <p class="font-serif italic text-title-md text-deep-forest font-semibold">— श्री प्रदीप सारंग</p>
                    <span class="font-label-sm text-[11px] text-text-muted"><?= e(ps_text('कमरवाँ, सतरिख (बाराबंकी) • संस्मरण सम्पूर्ण', 'Kamrawan, Satrikh (Barabanki) • Complete Memoir')) ?></span>
                  </div>
                </footer>
              </article>
            </div>

            <!-- ================= STORY 2 (Spread 1): सुघरी ================= -->
            <div class="spread-slide hidden min-h-full" data-spread="1">
              <article class="p-6 sm:p-10 md:p-12 lg:p-14 max-w-4xl mx-auto flex flex-col justify-between min-h-full bg-[#faf8f2] book-page-content">
                <div>
                  <header class="flex items-center justify-between pb-3 mb-5 border-b border-[#e2dacf]">
                    <span class="font-label-sm text-[11px] uppercase tracking-widest text-[#795548] font-bold">
                      <?= e(ps_text('प्रदीप सारंग संकलन • अध्याय २ / ३', 'Pradeep Sarang Collection • Story 2 of 3')) ?>
                    </span>
                    <div class="flex items-center gap-1 text-on-surface-variant font-label-sm text-label-sm">
                      <span class="font-serif"><?= e(ps_text('अध्याय २', 'Story 2')) ?></span>
                    </div>
                  </header>

                  <div class="flex items-center justify-center my-3">
                    <div class="w-12 h-px bg-primary/40"></div>
                    <span class="material-symbols-outlined text-primary mx-3 text-[20px]" style="font-variation-settings: 'FILL' 1;">local_florist</span>
                    <div class="w-12 h-px bg-primary/40"></div>
                  </div>

                  <!-- STORY 2 (Spread 1): सुघरी Header Layout (Image Left, Text Right) -->
                  <div class="grid grid-cols-1 md:grid-cols-12 gap-6 sm:gap-8 items-center mb-8 pb-6 border-b border-[#e2dacf]">
                    <!-- Left Column: Featured Cover Image -->
                    <div class="md:col-span-5 flex justify-center items-center">
                      <div class="w-full overflow-hidden rounded-2xl shadow-md border border-[#e2dacf] bg-white p-1.5 group">
                        <img src="<?= e($sughariImg) ?>" alt="<?= e(ps_text('सुघरी', 'Sughari')) ?>" class="w-full h-auto max-h-[380px] object-cover rounded-xl group-hover:scale-[1.02] transition-transform duration-500" loading="eager" />
                      </div>
                    </div>

                    <!-- Right Column: Title, Subtitle, Category & Metadata -->
                    <div class="md:col-span-7 flex flex-col justify-center">
                      <div>
                        <span class="inline-block px-3 py-1 rounded-full bg-[#e8f5e9] text-primary font-label-sm text-label-sm font-semibold mb-2.5">
                          <?= e(ps_text('अवधी लोक-गद्य कथा • ग्राम्य जीवन', 'Awadhi Folk Story • Village Life')) ?>
                        </span>
                        <h1 class="font-headline-lg text-[28px] sm:text-[36px] lg:text-[40px] leading-tight text-deep-forest tracking-tight font-bold mb-3">
                          <?= e(ps_text('सुघरी', 'Sughari')) ?>
                        </h1>
                        <p class="font-serif italic text-[#614b3d] text-body-md sm:text-title-md leading-relaxed mb-5">
                          <?= e(ps_text('"मेले जाने की खुशी और गोबर की खेप"', '"Joy of Village Fair & Cowdung Duty"')) ?>
                        </p>
                      </div>

                      <!-- Memoir Metadata Stamp -->
                      <div class="p-3 bg-[#f7f3ea] border border-[#ebe0d0] rounded-lg flex flex-wrap items-center justify-between text-label-sm font-label-sm text-on-surface-variant gap-2 mt-1">
                        <div class="flex items-center gap-1.5">
                          <span class="material-symbols-outlined text-primary text-[17px]">account_circle</span>
                          <span><?= e(ps_text('रचनाकार:', 'Author:')) ?> <strong><?= e(ps_text('श्री प्रदीप सारंग', 'Shri Pradeep Sarang')) ?></strong></span>
                        </div>
                        <div class="flex items-center gap-1.5">
                          <span class="material-symbols-outlined text-secondary text-[17px]">event</span>
                          <span>१४ अप्रैल २०२६</span>
                        </div>
                        <div class="flex items-center gap-1.5">
                          <span class="material-symbols-outlined text-deep-forest text-[17px]">yard</span>
                          <span><?= e(ps_text('सतरिख देहात, अवध', 'Satrikh Countryside, Awadh')) ?></span>
                        </div>
                      </div>
                    </div>
                  </div>

                  <!-- Complete Unified Narrative Prose -->
                  <div class="space-y-4 prose-book font-headline-sm font-normal text-[16px] sm:text-[17px] leading-[1.8] text-justify text-[#2b302c]">
                    <p>
                      <span class="float-left text-[56px] leading-[46px] font-headline-lg font-bold text-primary mr-3 mt-1 pb-1">मे</span>ला जाय की खुशी मा, गोबर की खेप लइकै जाय रही सुघरी। आठ-नौ बरस केर उमर, बिखरे केस, फटल छींट केर घाँघरा अउर माथे पर गोबर भरी तसली। सबेरे से गाँव मा हल्ला रहा कि आजु गढ़ी वाले मेला मा झूला परिगा है, सर्कस आवा है अउर रंग-बिरंगी फिरकी मिलि रही है।
                    </p>
                    <p>
                      सुघरी के मन मा मेला समावा रहा। उ तौ गोबर उठाय मा अइस फुर्ती देखावै मानौ बथान मा गोबर नहीं, मोती बिखरे हुवैं। गँवई गलियन मा नंगे पाँव दउड़त, गोड़ मा काँटा चुभै केर परवाह नाहिं। जब चारि तसला गोबर खेतन की ओसारा पहुँचाई लिहिस, तब माई हँसि कै आँचर के खूँट से दुइ रुपिया केर सिक्का निकारि के सुघरी के हथेली पर धरि दिहिस।
                    </p>
                    <p>
                      सुघरी आपन दूनौ हाथ धोइकै, मुँह पर तनिक तेल पोति कै, चमकीला काँच के चूड़ी पहिनै का सपना देखै लागी। उ अपने लँगोटिया यारन का आवाज दिहिस—"अरे सुमितरा! अरे मंगला! चलो हो, देर होय रही है!" बचपन मा अभाव के बीचिव जौन आह्लाद मिलत है, उ आजु बड़े-बड़े महलन के वातानुकूलित कमरन मा ढूँढ़े नाहिं मिलत।
                    </p>
                    <p>
                      मेला पहुँचत-पहुँचत सूरज माथे पर चढ़ि आवा रहा। धूलि उड़त रही, पिपिहरी बाजत रही, अउर जलेबी छानै वाले हलवाई के कड़ाह से मीठी महक उठि रही। सुघरी सबसे पहिले लाल-पीरी टिकुली वाले दूकान पर रुकि गई। दुइ रुपिया मा उका एक जोड़ी टिकुली अउर चारि ठी रबर वाली चूड़ी मिलि सकी।
                    </p>

                    <div class="my-5 p-4 rounded-lg bg-[#f3ede1] border-l-4 border-primary shadow-inner">
                      <p class="font-quote-editorial italic text-deep-forest text-[18px] leading-relaxed text-center">
                        "गाँव की मिट्टी मा पलै वाली बेटियन के हँसने मा जौन गंगा-यमुनी मिठास है, उ पूरे अवध की संस्कृति के आत्मा आही... थोड़े मा सन्तुष्ट रहब इनकर सबसे बड़ा संस्कार है।"
                      </p>
                    </div>

                    <p>
                      साँझ ढलै लागी। आसमान पर सुनहला धूप सिमिटै लाग। सुघरी घर लौटी तौ ओकरे चेहरे पर न थकावट रही, न गोड़ मा दर्द। बस आँखिन मा मेला के झूले घूम रहे थे। अम्मा पुछिस—"का बिटिया, मेला देखि आयौ?" सुघरी अपनी कलाई मा सजी कांच की हरी चूड़ी झनकावत बोलिस—"अम्मा! हमरा मेला बहुतै नीक लाग।"
                    </p>
                    <p>
                      ई बात सुनिकै माई के आँखिन मा आँसू छलकि आये। उ बिटिया का छाती से लगाय लिहिस। गाँव के अभाव मा भी स्नेह के जौन बीज अंकुरित हुवत हैं, उहै भारतीय संस्कृति का असली प्राण आही।
                    </p>

                    <div class="my-4 p-4 rounded-lg bg-[#efe7d8] border border-[#decbb4]">
                      <p class="font-bold text-deep-forest text-[16px] leading-relaxed">
                        "सुघरी सिरफ याक लरिकी नाहिं, ई समूचे भारतवर्ष के उस हर देहाती बचपन केर प्रतीक आही जौन सीमित साधन मा भी असीम प्रसन्नता खोजि लेत है।"
                      </p>
                      <span class="block text-right font-serif italic text-secondary text-sm font-semibold mt-1">— प्रदीप सारंग</span>
                    </div>
                  </div>
                </div>

                <!-- Footnote & Author Signoff -->
                <footer class="mt-8 pt-4 border-t border-[#e2dacf]">
                  <div class="bg-[#f8f5ed] border border-[#ebe4d5] p-3 rounded-md text-[13px] font-serif text-[#5f6861] mb-4">
                    <div class="flex items-start gap-2">
                      <span class="material-symbols-outlined text-primary text-[16px] mt-0.5">menu_book</span>
                      <p><strong>*<?= e(ps_text('शब्दावली संदर्भ:', 'Vocabulary:')) ?></strong> <em>बथान</em> — मवेशियों के बाँधने की जगह; <em>तसला</em> — लोहे की परात।</p>
                    </div>
                  </div>
                  <div class="flex flex-col items-center justify-center text-center">
                    <div class="flex items-center gap-2 text-primary opacity-80 mb-1">
                      <span class="w-8 h-px bg-primary"></span>
                      <span class="material-symbols-outlined text-[20px]">local_activity</span>
                      <span class="w-8 h-px bg-primary"></span>
                    </div>
                    <p class="font-serif italic text-title-md text-deep-forest font-semibold">— श्री प्रदीप सारंग</p>
                    <span class="font-label-sm text-[11px] text-text-muted"><?= e(ps_text('कथा संग्रह: माटी के गीत • सतरिख, बाराबंकी', 'Story Anthology: Songs of the Soil')) ?></span>
                  </div>
                </footer>
              </article>
            </div>

            <!-- ================= STORY 3 (Spread 2): सारंग-कुंडलियाँ ================= -->
            <div class="spread-slide hidden min-h-full" data-spread="2">
              <article class="p-6 sm:p-10 md:p-12 lg:p-14 max-w-4xl mx-auto flex flex-col justify-between min-h-full bg-[#faf8f2] book-page-content">
                <div>
                  <header class="flex items-center justify-between pb-3 mb-5 border-b border-[#e2dacf]">
                    <span class="font-label-sm text-[11px] uppercase tracking-widest text-[#795548] font-bold">
                      <?= e(ps_text('प्रदीप सारंग ग्रंथावली • अध्याय ३ / ३', 'Pradeep Sarang Collected Works • Story 3 of 3')) ?>
                    </span>
                    <div class="flex items-center gap-1 text-on-surface-variant font-label-sm text-label-sm">
                      <span class="font-serif"><?= e(ps_text('अध्याय ३', 'Story 3')) ?></span>
                    </div>
                  </header>

                  <div class="flex items-center justify-center my-3">
                    <div class="w-12 h-px bg-secondary/40"></div>
                    <span class="material-symbols-outlined text-secondary mx-3 text-[20px]" style="font-variation-settings: 'FILL' 1;">stylus_note</span>
                    <div class="w-12 h-px bg-secondary/40"></div>
                  </div>

                  <div class="text-center mb-5">
                    <span class="inline-block px-3 py-1 rounded-full bg-[#fdf3ef] text-secondary font-label-sm text-label-sm font-semibold mb-2">
                      <?= e(ps_text('अवधी काव्य-चिन्तन • कुण्डलिया छंद', 'Awadhi Poetic Verses')) ?>
                    </span>
                    <h1 class="font-headline-lg text-[32px] sm:text-[38px] leading-tight text-deep-forest tracking-tight mt-1 mb-2 font-bold">
                      <?= e(ps_text('सारंग-कुण्डलियाँ', 'Sarang Kundaliyan')) ?>
                    </h1>
                    <p class="font-serif italic text-[#614b3d] text-body-md sm:text-title-md">
                      <?= e(ps_text('"पेड़, पखेरू, नदियाँ और मनुष्य की अस्मिता"', '"Trees, Birds, Rivers & Human Dignity"')) ?>
                    </p>
                  </div>

                  <div class="p-3 bg-[#f7f3ea] border border-[#ebe0d0] rounded-lg mb-5 flex flex-wrap items-center justify-between text-label-sm font-label-sm text-on-surface-variant gap-2">
                    <div class="flex items-center gap-1.5">
                      <span class="material-symbols-outlined text-primary text-[17px]">auto_stories</span>
                      <span><?= e(ps_text('रचना:', 'Verses:')) ?> <strong><?= e(ps_text('श्री प्रदीप सारंग', 'Shri Pradeep Sarang')) ?></strong></span>
                    </div>
                    <div class="flex items-center gap-1.5">
                      <span class="material-symbols-outlined text-secondary text-[17px]">event</span>
                      <span>२ मई २०२६</span>
                    </div>
                    <div class="flex items-center gap-1.5">
                      <span class="material-symbols-outlined text-deep-forest text-[17px]">forest</span>
                      <span><?= e(ps_text('ग्रीन गैंग पर्यावरण काव्य', 'Green Gang Eco Verses')) ?></span>
                    </div>
                  </div>

                  <div class="space-y-5 prose-book font-headline-sm font-normal text-[16px] sm:text-[17px] leading-[1.8] text-justify text-[#2b302c]">
                    <!-- Poetry Block 1 -->
                    <div class="p-4 rounded-xl bg-[#fdfbf6] border border-[#e5dccf] shadow-xs">
                      <p class="font-serif font-semibold text-deep-forest text-center leading-relaxed">
                        रूख-बिरिछ सब काटिके, बनल शहर महान।<br/>
                        पखेरू ढूँढत घोंसला, रोवत आजु विहान॥<br/>
                        रोवत आजु विहान, कहाँ अब सुआ बसेरा?<br/>
                        सीमेंट के जंगलन मा, भवा साँझि-सवेरा॥<br/>
                        कह सारंग कविराय, सुनो ओ बुद्धि निधाना।<br/>
                        बिना रूख के सांसु का, मोल न कबहूँ जाना॥
                      </p>
                    </div>

                    <!-- Poetry Block 2 -->
                    <div class="p-4 rounded-xl bg-[#fdfbf6] border border-[#e5dccf] shadow-xs">
                      <p class="font-serif font-semibold text-secondary text-center leading-relaxed">
                        ताल-तलइया पाटिके, रच्यो भवन चौताल।<br/>
                        बूँद-बूँद तरसत धरा, बिगड़ि गवा सब हाल॥<br/>
                        बिगड़ि गवा सब हाल, नदी कल्याणी सूखै।<br/>
                        मछरी जल बिन तड़पै, तृष्णा जग मा भूखै॥<br/>
                        जागौ नवयुवकन सब, माटी धरम निबाहौ।<br/>
                        गाँव-गाँव मा हरियर, अमराई महकाहौ॥
                      </p>
                    </div>

                    <p class="text-[15px] text-[#4a554d] italic text-center">
                      <?= e(ps_text('कुण्डलिया अवध का प्राण-छंद है, जहाँ प्रथम दोहे का अंतिम चरण रोला का प्रथम चरण बनकर लोक-कंठ का स्वर बन जाता है।', 'Kundaliya is the soul-verse of Awadh where the last line of the couplet becomes the first line of Rola.')) ?>
                    </p>
                  </div>
                </div>

                <footer class="mt-8 pt-3 bg-[#f8f5ed] border border-[#ebe4d5] p-3 rounded-md text-[13px] font-serif text-[#5f6861]">
                  <div class="flex items-start gap-2">
                    <span class="material-symbols-outlined text-secondary text-[16px] mt-0.5">format_quote</span>
                    <p><strong>*<?= e(ps_text('छंद विधान:', 'Prosody:')) ?></strong> <?= e(ps_text('कुण्डलिया छंद में ६ चरण होते हैं—दो चरण दोहा और चार चरण रोला।', 'Kundaliya verse comprises 6 lines—2 lines Doha and 4 lines Rola.')) ?></p>
                  </div>
                </footer>
              </article>

              <!-- Right Page: Spread 3 (पृष्ठ ३९) -->
              <article class="relative p-6 sm:p-10 md:p-12 lg:p-14 lg:pl-16 flex flex-col justify-between overflow-hidden bg-[#faf8f2] book-right-page">
                <div>
                  <header class="flex items-center justify-between pb-3 mb-5 border-b border-[#e2dacf]">
                    <div class="flex items-center gap-1 text-on-surface-variant font-label-sm text-label-sm">
                      <span class="font-serif"><?= e(ps_text('पृष्ठ ३९', 'Page 39')) ?></span>
                    </div>
                    <span class="font-label-sm text-[11px] uppercase tracking-widest text-[#795548] font-bold">
                      <?= e(ps_text('पृष्ठ ३९ • संकल्प दोहावली व जीवन-गीत', 'Page 39 • Anthem & Couplets')) ?>
                    </span>
                  </header>

                  <div class="space-y-4 prose-book font-headline-sm font-normal text-[16px] sm:text-[17px] leading-[1.8] text-justify text-[#2b302c]">
                    <!-- Master Anthem Quote -->
                    <div class="p-5 rounded-2xl bg-[#0d3b1f] text-[#f0fdf1] shadow-md border border-[#1e6138] text-center my-3">
                      <span class="block font-label-sm text-fresh-sprout uppercase tracking-widest font-bold mb-2">
                        — <?= e(ps_text('सारंग जी का संकल्प-गीत', 'Sarang Ji\'s Anthem')) ?> —
                      </span>
                      <blockquote class="font-serif text-[20px] sm:text-[22px] leading-relaxed italic">
                        “हारना सीखा नहीं है, जीत का मैं गीत हूँ।<br/>
                        जुगनुओं का संग है, इंसानियत का मीत हूँ।”
                      </blockquote>
                      <span class="block text-xs text-primary-fixed mt-3"><?= e(ps_text('अवधी व जन-संघर्ष के चार दशक (1986 - 2026)', 'Four Decades of Service & Awadhi Literature (1986 - 2026)')) ?></span>
                    </div>

                    <div class="space-y-3 pt-2">
                      <h4 class="font-title-md text-title-md text-deep-forest font-bold border-b border-[#e2dacf] pb-1">
                        <?= e(ps_text('पर्यावरण व सामाजिक दोहावली:', 'Environmental & Social Couplets:')) ?>
                      </h4>
                      <div class="p-3.5 bg-[#f5efe4] rounded-lg border-l-4 border-secondary font-serif text-[16px] leading-relaxed">
                        <p class="font-bold text-[#3c2f27]">
                          "याक पेड़ जे रोपिहै, दस पुरखन का त्राण।<br/>
                          छाँह देइ अउर फल देइ, माटी का कल्यान॥"
                        </p>
                      </div>
                      <div class="p-3.5 bg-[#f5efe4] rounded-lg border-l-4 border-primary font-serif text-[16px] leading-relaxed">
                        <p class="font-bold text-deep-forest">
                          "साँच कहै मा डर नहीं, चाहे होइ विरोध।<br/>
                          सत्यमेव की राह पर, मिटि जात सब क्रोध॥"
                        </p>
                      </div>
                      <div class="p-3.5 bg-[#f5efe4] rounded-lg border-l-4 border-[#b45309] font-serif text-[16px] leading-relaxed">
                        <p class="font-bold text-[#78350f]">
                          "गाँव बचिहै तब देश बचिहै, सुनहु कान लगाय।<br/>
                          अवधी भाषा मा अमृत, जो पियै सो तर जाय॥"
                        </p>
                      </div>
                    </div>
                  </div>
                </div>

                <footer class="mt-8 pt-4 flex flex-col items-center justify-center text-center border-t border-[#e2dacf]">
                  <div class="flex items-center gap-2 text-secondary opacity-80 mb-2">
                    <span class="w-8 h-px bg-secondary"></span>
                    <span class="material-symbols-outlined text-[20px]">verified</span>
                    <span class="w-8 h-px bg-secondary"></span>
                  </div>
                  <p class="font-serif italic text-title-md text-deep-forest font-semibold">
                    — श्री प्रदीप सारंग
                  </p>
                  <span class="font-label-sm text-[11px] text-text-muted"><?= e(ps_text('संपादक: सन्दौली टाइम्स • संस्थापक: ग्रीन गैंग बाराबंकी', 'Editor: Sandauli Times • Founder: Green Gang Barabanki')) ?></span>
                </footer>
              </article>
            </div>
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
          <button type="button" class="px-3.5 py-2 rounded-lg bg-deep-forest/90 hover:bg-deep-forest disabled:opacity-40 disabled:cursor-not-allowed text-pure-white flex items-center gap-1.5 transition-all shadow-sm active:scale-95 cursor-pointer" id="btn-prev-page">
            <span class="material-symbols-outlined text-[18px]">arrow_back</span>
            <span><?= e(ps_text('पिछला पृष्ठ', 'Previous Page')) ?></span>
          </button>
          <span class="text-surface-variant font-mono text-sm px-2 py-1 rounded bg-black/40 border border-white/10" id="page-counter-badge">१ / ३</span>
          <button type="button" class="px-3.5 py-2 rounded-lg bg-deep-forest/90 hover:bg-deep-forest disabled:opacity-40 disabled:cursor-not-allowed text-pure-white flex items-center gap-1.5 transition-all shadow-sm active:scale-95 cursor-pointer" id="btn-next-page">
            <span><?= e(ps_text('अगला पृष्ठ', 'Next Page')) ?></span>
            <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
          </button>
        </div>
      </div>
    </div>
  </section>

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

      <!-- Vocabulary Grid: Dynamically Scanned & Generated for Article -->
      <?php 
      $lexiconItems = get_awadhi_lexicon_for_post($postTitle, $postContent);
      ?>
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-6 gap-3.5">
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
  $authorLocVal = !empty($settings['author_location']) ? $settings['author_location'] : ps_text('कमरावां, सतरिख, बाराबंकी (उ० प्र०)', 'Kamrawan, Satrikh, Barabanki (U.P.)');
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
          <div class="relative group">
            <div class="w-36 h-36 sm:w-44 sm:h-44 p-1.5 bg-gradient-to-tr from-amber-600 via-emerald-700 to-emerald-500 rounded-2xl shadow-lg transform group-hover:scale-[1.02] transition-all duration-300">
              <div class="w-full h-full rounded-[14px] overflow-hidden bg-white flex items-center justify-center relative">
                <?php if (!empty($authorImgUrl)): ?>
                  <img src="<?= e($authorImgUrl) ?>" alt="<?= e($postAuthor) ?>" class="w-full h-full object-cover" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                  <div class="w-full h-full bg-gradient-to-br from-emerald-800 via-deep-forest to-emerald-950 text-white flex flex-col items-center justify-center p-3 text-center" style="display:none;">
                    <img src="<?= e(asset('images/home/icon.svg')) ?>" alt="Emblem Symbol" class="w-12 h-12 object-contain mb-1 filter drop-shadow">
                    <span class="font-serif font-bold text-xs text-amber-300"><?= e($postAuthor) ?></span>
                  </div>
                <?php else: ?>
                  <!-- Symbol Image Emblem Placeholder when no image is present -->
                  <div class="w-full h-full bg-gradient-to-br from-emerald-800 via-emerald-900 to-emerald-950 text-white flex flex-col items-center justify-center p-3 text-center relative overflow-hidden group">
                    <div class="absolute inset-0 bg-white/5 bg-[radial-gradient(#fff_1px,transparent_1px)] [background-size:12px_12px] opacity-40"></div>
                    <img src="<?= e(asset('images/home/icon.svg')) ?>" alt="Author Symbol Emblem" class="w-14 h-14 object-contain relative z-10 mb-1 filter drop-shadow-md">
                    <span class="font-serif font-bold text-[11px] tracking-wider text-amber-300 relative z-10 uppercase"><?= e(ps_text('साहित्य प्रतीक', 'Literary Symbol')) ?></span>
                  </div>
                <?php endif; ?>
              </div>
            </div>
            <div class="absolute -bottom-2 -right-2 bg-emerald-700 text-white p-2 rounded-xl shadow-md border-2 border-white flex items-center justify-center" title="<?= e(ps_text('सत्यापित लेखक', 'Verified Author')) ?>">
              <span class="material-symbols-outlined text-[18px]">verified</span>
            </div>
          </div>

          <h3 class="font-serif text-2xl font-bold text-emerald-950 mt-5 mb-1 tracking-tight"><?= e($authorNameVal) ?></h3>
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

  <!-- 4D. Related Literary Posts -->
  <section class="w-full bg-soft-meadow py-space-3xl border-t border-b border-border-warm">
    <div class="max-w-container-max mx-auto px-4 sm:px-8 space-y-6">
      <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-3">
        <div>
          <span class="font-label-sm text-label-sm text-secondary uppercase font-bold tracking-wider"><?= e(ps_text('साहित्य संचयन', 'Literary Collection')) ?></span>
          <h2 class="font-headline-md text-headline-sm sm:text-headline-md text-deep-forest font-bold mt-1">
            <?= e(ps_text('संबंधित अवधी कृतियाँ व अन्य आलेख', 'Related Awadhi Works & Articles')) ?>
          </h2>
        </div>
        <a href="<?= e(base_url('/blog')) ?>" data-path="blog-and-thoughts" class="inline-flex items-center gap-1 text-primary font-title-md text-body-sm hover:underline font-semibold">
          <span><?= e(ps_text('सभी आलेख देखें', 'View All Articles')) ?></span>
          <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
        </a>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Card 1: Sughari -->
        <article class="bg-pure-white border border-border-warm rounded-2xl overflow-hidden shadow-xs hover:shadow-md transition-all flex flex-col justify-between group">
          <div>
            <div class="relative h-48 overflow-hidden bg-surface-container">
              <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuDrKtLSe64AU488fJTZBuM65tcMgcT9hnPZL_iAs2EWbWOp3JQDyCSCxGdBw40e3KQzfN6d1CVDlPEsGuW11Dl-4zXnoHuthTcsWKAZnvSy1a1vn4ZwNYLQXSZjkahLGPolIV3eJXioN7Sdz2ziNY7egXAbvfvgCACNNSB-HUKL0wAqsgajWeTU2ZAr99tBSTxlzwGA2ueC6GiiJ09c2jjjcwCWGXU2wFLxWRe6795Pg3ox4uCQZLSt" alt="Sughari Story" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
              <span class="absolute top-3 left-3 px-2.5 py-1 rounded bg-deep-forest/90 text-pure-white font-label-sm text-label-sm shadow-sm font-semibold">
                <?= e(ps_text('अवधी लोक-गद्य कथा', 'Folk Story')) ?>
              </span>
            </div>
            <div class="p-5 space-y-2">
              <span class="font-label-sm text-label-sm text-text-muted">14 April 2026 • 8 min read</span>
              <h3 class="font-headline-sm text-title-md text-on-surface group-hover:text-deep-forest transition-colors font-bold">
                <?= e(ps_text('सुघरी: मेले जाने की खुशी और गोबर की खेप', 'Sughari: Fair Day & Cowdung Duty')) ?>
              </h3>
              <p class="font-body-sm text-body-sm text-on-surface-variant line-clamp-2">
                <?= e(ps_text('गाँव की नन्ही बालिका सुघरी का मेला देखने का सहज उल्लास और ग्रामीण परिवार की आर्थिक जद्दोजहद की मर्मस्पर्शी दास्तान।', 'A touching tale of young Sughari\'s innocent excitement for the village fair despite rural poverty.')) ?>
              </p>
            </div>
          </div>
          <div class="p-5 pt-0">
            <button type="button" data-jump="1" class="inline-flex items-center gap-1 font-title-md text-body-sm text-primary group-hover:text-deep-forest font-semibold quick-spread-jump cursor-pointer">
              <span><?= e(ps_text('यह कथा अभी पढ़ें (पृष्ठ ३६)', 'Read Story (Page 36)')) ?></span>
              <span class="material-symbols-outlined text-[16px]">auto_stories</span>
            </button>
          </div>
        </article>

        <!-- Card 2: Sarang Kundaliyan -->
        <article class="bg-pure-white border border-border-warm rounded-2xl overflow-hidden shadow-xs hover:shadow-md transition-all flex flex-col justify-between group">
          <div>
            <div class="relative h-48 overflow-hidden bg-surface-container">
              <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuAL8aKhU1T9o4laEJQkm-Vy4ETDmuC7wsFdZu7NniuUZZAvdmRhc4w_waeferG7LsBy8pSLnoDcmmJYbpxxdNvcC1E01DyqhzpymAjhPL4xQnivsS_7mcBhsPbzfnI_kbhO8E2-LbQx3A78S8uWBhIq2-RnCZtYuMJ1j3y6lF5kIF4rmiSBMgzak9LduBrj4XcaLANgA6RJejL9gjGlNPpY_XdovtTLY5uvL1k8fvLlEC225PeC8fmV" alt="Sarang Kundaliyan" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
              <span class="absolute top-3 left-3 px-2.5 py-1 rounded bg-secondary/90 text-pure-white font-label-sm text-label-sm shadow-sm font-semibold">
                <?= e(ps_text('सारंग-कुण्डलियाँ', 'Kundaliyan')) ?>
              </span>
            </div>
            <div class="p-5 space-y-2">
              <span class="font-label-sm text-label-sm text-text-muted">02 May 2026 • 15 min read</span>
              <h3 class="font-headline-sm text-title-md text-on-surface group-hover:text-deep-forest transition-colors font-bold">
                <?= e(ps_text('सारंग-कुण्डलियों की रचना यात्रा', 'Sarang Kundaliyan Composition')) ?>
              </h3>
              <p class="font-body-sm text-body-sm text-on-surface-variant line-clamp-2">
                <?= e(ps_text('अवधी छंदशास्त्र की कुण्डलिया विधा में जन-आंदोलन, पर्यावरण चेतना और सामाजिक विसंगतियों पर सारंग जी की मौलिक सर्जना।', 'Sarang Ji\'s original Kundaliyan poetic verses on environmental protection and Awadhi heritage.')) ?>
              </p>
            </div>
          </div>
          <div class="p-5 pt-0">
            <button type="button" data-jump="2" class="inline-flex items-center gap-1 font-title-md text-body-sm text-primary group-hover:text-deep-forest font-semibold quick-spread-jump cursor-pointer">
              <span><?= e(ps_text('यह कुण्डलियाँ पढ़ें (पृष्ठ ३८)', 'Read Verses (Page 38)')) ?></span>
              <span class="material-symbols-outlined text-[16px]">auto_stories</span>
            </button>
          </div>
        </article>

        <!-- Card 3: Paryavaran -->
        <article class="bg-pure-white border border-border-warm rounded-2xl overflow-hidden shadow-xs hover:shadow-md transition-all flex flex-col justify-between group">
          <div>
            <div class="relative h-48 overflow-hidden bg-surface-container">
              <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuBxhfUdnkye5LYd0dWYqemLO-3XrnY5wk_cajgF7G0aq3jUl_vLXXcqX9lHUVBtcX6FqNDUKh-OhvAPL1TtrtIx-WbyJeJFWlONFde93aKzqWWYgfhsCaYBMuB06PM4dddy5rDZFH7a0tdTM-vWFWezWdJo1aRIDiVmJNTHonikM2b2SkrWQ9tbzhKnA1kUK9k_nPcnIdu1E8CrO_u3NAaZ0RSsK9wbf6Cw0HWdN0tMReGUZidzVt9K" alt="Paryavaran" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
              <span class="absolute top-3 left-3 px-2.5 py-1 rounded bg-[#b45309]/90 text-pure-white font-label-sm text-label-sm shadow-sm font-semibold">
                <?= e(ps_text('पर्यावरण एवं नदियाँ', 'Environment & Rivers')) ?>
              </span>
            </div>
            <div class="p-5 space-y-2">
              <span class="font-label-sm text-label-sm text-text-muted">28 April 2026 • 10 min read</span>
              <h3 class="font-headline-sm text-title-md text-on-surface group-hover:text-deep-forest transition-colors font-bold">
                <?= e(ps_text('सूखते ताल और बेजुबान परिंदों की पुकार', 'Drying Ponds & Plight of Birds')) ?>
              </h3>
              <p class="font-body-sm text-body-sm text-on-surface-variant line-clamp-2">
                <?= e(ps_text('बाराबंकी के ऐतिहासिक वेटलैंड्स, कल्याणी नदी के जल-प्रवाह और सिमटते जलीय पारितंत्र के पुनर्जीवन की जमीनी पड़ताल।', 'A ground investigation into Barabanki wetlands and Kalyani river revival.')) ?>
              </p>
            </div>
          </div>
          <div class="p-5 pt-0">
            <a href="<?= e(base_url('/campaigns')) ?>" class="inline-flex items-center gap-1 font-title-md text-body-sm text-primary group-hover:text-deep-forest font-semibold">
              <span><?= e(ps_text('जाँच रिपोर्ट पढ़ें', 'Read Field Report')) ?></span>
              <span class="material-symbols-outlined text-[16px]">arrow_right_alt</span>
            </a>
          </div>
        </article>
      </div>
    </div>
  </section>

  <!-- 4E. Community Comments & Reflections Section -->
  <section class="max-w-container-editorial mx-auto px-4 sm:px-6 w-full py-space-3xl">
    <div class="space-y-6">
      <div class="flex items-center justify-between pb-2 border-b border-border-warm">
        <div>
          <h3 class="font-headline-sm text-title-lg sm:text-headline-sm text-deep-forest font-bold">
            <?= e(ps_text('पाठक प्रतिक्रिया व संस्मरण (Comments)', 'Reader Reflections & Comments')) ?>
          </h3>
          <p class="font-body-sm text-body-sm text-text-muted">
            <?= e(ps_text('झरिहख और अपने गाँव के बचपन की बारिश की स्मृतियाँ साझा करें', 'Share your memories of village rain and Awadhi heritage')) ?>
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
            <textarea rows="4" required placeholder="<?= e(ps_text('झरिहख पढ़कर आपको अपने गाँव या बचपन की कौन सी बात याद आई? यहाँ लिखें...', 'Write your reflections or village memories here...')) ?>" class="w-full px-4 py-3 rounded-xl bg-soft-meadow border border-border-warm text-on-surface font-body-md text-body-md focus:outline-none focus:ring-2 focus:ring-primary shadow-xs"></textarea>
          </div>
          <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
              <label class="block font-label-md text-label-md text-deep-forest mb-1 font-semibold"><?= e(ps_text('आपका शुभ नाम:', 'Your Full Name:')) ?></label>
              <input type="text" required placeholder="<?= e(ps_text('उदा. रामनारायण वर्मा', 'e.g. Ramnarayan Verma')) ?>" class="w-full px-4 py-2.5 rounded-xl bg-soft-meadow border border-border-warm text-on-surface font-body-md text-body-md focus:outline-none focus:ring-2 focus:ring-primary shadow-xs">
            </div>
            <div>
              <label class="block font-label-md text-label-md text-deep-forest mb-1 font-semibold"><?= e(ps_text('ईमेल पता (अप्रकाशित रहेगा):', 'Email Address (Kept Private):')) ?></label>
              <input type="email" required placeholder="name@domain.com" class="w-full px-4 py-2.5 rounded-xl bg-soft-meadow border border-border-warm text-on-surface font-body-md text-body-md focus:outline-none focus:ring-2 focus:ring-primary shadow-xs">
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
    let currentSpreadIndex = 0;
    let isAnimating = false;

    const spreadMetadata = [
      {
        crumbCat: '<?= e(addslashes($postCategory)) ?>',
        crumbTitle: '<?= e(addslashes($postTitle)) ?>',
        pagesDisplay: '१ / ३',
        footerDesc: '<?= e(ps_text("प्रदीप सारंग संस्मरण डिजिटल ग्रंथावली (संस्करण 2026)", "Pradeep Sarang Memoir Digital Archives (2026 Edition)")) ?>',
        readingTime: '12 min read'
      },
      {
        crumbCat: '<?= e(ps_text("अवधी लोक-गद्य कथा", "Awadhi Folk Story")) ?>',
        crumbTitle: '<?= e(ps_text("सुघरी: मेला और गोबर की खेप", "Sughari: Fair & Cowdung Duty")) ?>',
        pagesDisplay: '२ / ३',
        footerDesc: '<?= e(ps_text("कथा संचयन: ग्रामीण बाल-जीवन व लोक-अनुभव", "Story Collection: Rural Childhood Experience")) ?>',
        readingTime: '8 min read'
      },
      {
        crumbCat: '<?= e(ps_text("काव्य-चिन्तन व छंद", "Awadhi Verses")) ?>',
        crumbTitle: '<?= e(ps_text("सारंग-कुण्डलियाँ व संकल्प-गीत", "Sarang Kundaliyan & Anthem")) ?>',
        pagesDisplay: '३ / ३',
        footerDesc: '<?= e(ps_text("पर्यावरण व लोक-सरोकार कुण्डलियाँ (ग्रीन गैंग बाराबंकी)", "Eco Verses (Green Gang Barabanki)")) ?>',
        readingTime: '10 min read'
      }
    ];

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

      // update reading progress
      const percent = Math.round(((currentSpreadIndex + 1) / totalSpreads) * 100);
      if (progressBar) progressBar.style.width = percent + '%';
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

    // Quick jumps from cards
    const quickJumps = document.querySelectorAll('.quick-spread-jump');
    quickJumps.forEach(btn => {
      btn.addEventListener('click', () => {
        const target = parseInt(btn.getAttribute('data-jump'), 10);
        if (!isNaN(target)) {
          const dir = target > currentSpreadIndex ? 'forward' : 'backward';
          flipToSpread(target, dir);
          window.scrollTo({ top: 180, behavior: 'smooth' });
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
          audioText.textContent = '<?= e(ps_text("सारंग जी के स्वर में सुनें (12:48)", "Listen in Sarang Ji\'s Voice (12:48)")) ?>';
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
