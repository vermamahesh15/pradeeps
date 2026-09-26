<?php
declare(strict_types=1);

$items = $items ?? [];
$categories = $categories ?? [];
?>

<div class="flex flex-col w-full">
  <!-- Editorial Header Section -->
  <div class="relative w-full bg-soft-meadow overflow-hidden py-10 md:py-14 border-b border-border-warm">
    <div class="absolute -top-32 -left-20 w-96 h-96 bg-primary-fixed/40 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute top-10 right-0 w-80 h-80 bg-secondary-fixed/30 rounded-full blur-3xl pointer-events-none"></div>
    
    <div class="max-w-container-max mx-auto px-4 sm:px-8 relative z-10">
      <!-- Breadcrumb -->
      <nav class="flex items-center gap-2 font-label-md text-label-md text-text-muted mb-4" aria-label="Breadcrumb">
        <a class="hover:text-primary transition-colors flex items-center gap-1" data-path="home" href="<?= e(base_url('/')) ?>">
          <span class="material-symbols-outlined text-[16px]">home</span>
          <span><?= e(ps_text('गृह (Home)', 'Home')) ?></span>
        </a>
        <span class="opacity-40">/</span>
        <span class="text-deep-forest font-semibold"><?= e(ps_text('ब्लॉग एवं आलेख (Blog)', 'Blog & Articles')) ?></span>
      </nav>
      
      <div class="flex flex-col space-y-4 max-w-4xl">
        <div class="inline-flex items-center gap-2 self-start bg-primary-fixed/40 text-deep-forest px-3.5 py-1 rounded-full font-label-sm text-label-sm border border-border-warm font-semibold">
          <span class="material-symbols-outlined text-[15px] text-primary-container" style="font-variation-settings: 'FILL' 1;">nature_people</span>
          <span><?= e(ps_text('माटी की महक और वैचारिक चिंतन • प्रदीप सारंग के आलेख', 'Fragrance of Soil & Reflections • Essays by Pradeep Sarang')) ?></span>
        </div>
        <h1 class="font-display-hero text-headline-lg md:text-display-hero text-deep-forest leading-tight tracking-tight font-bold">
          <?= ps_text('गाँव की माटी, लोक-संस्कृति और पर्यावरण चेतना — <span class="text-primary-container">वैचारिक आलेख एवं संस्मरण</span>', 'Village Soil, Folk Culture & Ecological Consciousness — <span class="text-primary-container">Essays & Memoirs</span>') ?>
        </h1>
        <p class="font-body-lg text-body-lg text-text-muted leading-relaxed">
          <?= e(ps_text('चार दशकों के ज़मीनी अनुभवों, अवधी लोक-जीवन की सच्चाइयों, पर्यावरण के गंभीर सवालों और मानवीय संवेदनाओं को शब्दों में पिरोता आलेख व चिंतन संकलन। यहाँ शब्द मात्र विचार नहीं, बल्कि जन-सरोकारों का जीवंत दस्तावेज हैं।', 'A collection weaving four decades of ground experience, Awadhi folk realities, environmental questions, and human empathy into living words.')) ?>
        </p>

        <!-- Search Bar -->
        <div class="pt-2 max-w-xl">
          <div class="relative w-full">
            <span class="material-symbols-outlined absolute left-3.5 top-1/2 -translate-y-1/2 text-text-muted text-[20px]">search</span>
            <input type="text" id="article-search" placeholder="<?= e(ps_text('आलेख, संस्मरण या शीर्षक खोजें...', 'Search articles, memoirs or topics...')) ?>" class="w-full pl-11 pr-4 py-3 rounded-xl border border-border-warm bg-pure-white text-on-surface font-body-md text-body-md placeholder-text-muted shadow-sm focus:outline-none focus:ring-2 focus:ring-primary-container">
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Category Filter Tabs & Blog Articles Grid -->
  <section class="max-w-container-max mx-auto px-4 sm:px-8 py-8 md:py-12 bg-cream-canvas w-full">
    <div class="flex items-center justify-between border-b border-border-warm pb-4 mb-8 overflow-x-auto">
      <div class="flex items-center gap-2 sm:gap-3 flex-nowrap" id="category-filters">
        <button type="button" data-cat="all" class="cat-filter-btn px-4 py-2 rounded-full bg-deep-forest text-pure-white font-label-md text-label-md whitespace-nowrap shadow-sm cursor-pointer">
          <?= e(ps_text('सभी आलेख', 'All Articles')) ?>
        </button>
        <?php if (!empty($categories)): foreach ($categories as $cat): ?>
          <button type="button" data-cat="<?= e((string)$cat['id']) ?>" class="cat-filter-btn px-4 py-2 rounded-full bg-pure-white text-on-surface border border-border-warm hover:bg-soft-meadow font-label-md text-label-md whitespace-nowrap shadow-sm transition-colors cursor-pointer">
            <?= e($cat['name']) ?>
          </button>
        <?php endforeach; else: ?>
          <button type="button" data-cat="awadhi" class="cat-filter-btn px-4 py-2 rounded-full bg-pure-white text-on-surface border border-border-warm hover:bg-soft-meadow font-label-md text-label-md whitespace-nowrap shadow-sm transition-colors cursor-pointer">
            <?= e(ps_text('अवधी लोक-गद्य व संस्मरण', 'Awadhi Prose & Memoirs')) ?>
          </button>
          <button type="button" data-cat="green" class="cat-filter-btn px-4 py-2 rounded-full bg-pure-white text-on-surface border border-border-warm hover:bg-soft-meadow font-label-md text-label-md whitespace-nowrap shadow-sm transition-colors cursor-pointer">
            <?= e(ps_text('पर्यावरण एवं \'ग्रीन गैंग\'', 'Environment & Green Gang')) ?>
          </button>
          <button type="button" data-cat="rural" class="cat-filter-btn px-4 py-2 rounded-full bg-pure-white text-on-surface border border-border-warm hover:bg-soft-meadow font-label-md text-label-md whitespace-nowrap shadow-sm transition-colors cursor-pointer">
            <?= e(ps_text('ग्रामीण संस्कृति व जीवन-दर्शन', 'Rural Culture & Philosophy')) ?>
          </button>
          <button type="button" data-cat="youth" class="cat-filter-btn px-4 py-2 rounded-full bg-pure-white text-on-surface border border-border-warm hover:bg-soft-meadow font-label-md text-label-md whitespace-nowrap shadow-sm transition-colors cursor-pointer">
            <?= e(ps_text('युवा चेतना व समाज-सेवा', 'Youth Consciousness')) ?>
          </button>
        <?php endif; ?>
      </div>
      <div class="hidden md:flex items-center gap-2 text-text-muted font-label-sm text-label-sm pl-4 shrink-0">
        <span class="material-symbols-outlined text-[18px]">tune</span>
        <span><?= e(ps_text('क्रम: नवीनतम प्रथम', 'Sort: Latest First')) ?></span>
      </div>
    </div>

    <!-- Articles Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-7" id="articles-grid">
      <?php if (!empty($items)): foreach ($items as $idx => $post): 
        $rawImg = !empty($post['featured_image']) ? $post['featured_image'] : (!empty($post['banner_image']) ? $post['banner_image'] : (!empty($post['image']) ? $post['image'] : ''));
        $img = ps_resolve_img($rawImg, 'assets/images/slider_final_1.webp');
        $cleanTitle = html_entity_decode((string)($post['title'] ?? ''), ENT_QUOTES, 'UTF-8');
        $cleanExcerpt = html_entity_decode((string)(!empty($post['excerpt']) ? $post['excerpt'] : ps_excerpt($post['content'] ?? '', 120)), ENT_QUOTES, 'UTF-8');
      ?>
        <article class="article-card flex flex-col bg-pure-white rounded-2xl shadow-sm border border-border-warm hover:shadow-lg transition-all overflow-hidden group" data-cat="<?= e((string)($post['category_id'] ?? 'all')) ?>">
          <!-- Card Cover Image Container -->
          <div class="relative w-full h-48 sm:h-52 overflow-hidden bg-surface-container">
            <img src="<?= e($img) ?>" alt="<?= e($cleanTitle) ?>" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" loading="lazy" onerror="this.onerror=null; this.src='<?= e(base_url('assets/images/slider_final_1.webp')) ?>';">
            <div class="absolute top-3 left-3">
              <span class="bg-white/95 backdrop-blur-md text-deep-forest font-label-sm text-label-sm px-3 py-1 rounded-md font-bold border border-border-warm shadow-xs">
                <?= e($post['category_name'] ?? ps_text('वैचारिक आलेख', 'Article')) ?>
              </span>
            </div>
          </div>

          <div class="p-6 flex-1 flex flex-col justify-between space-y-4">
            <div>
              <div class="flex items-center justify-between text-text-muted font-label-sm text-label-sm mb-2.5">
                <span class="flex items-center gap-1 font-medium">
                  <span class="material-symbols-outlined text-[15px] text-primary">schedule</span>
                  <span><?= e($post['reading_time'] ?? '8 min read') ?></span>
                </span>
                <span class="flex items-center gap-1 font-medium">
                  <span class="material-symbols-outlined text-[15px] text-text-muted">calendar_month</span>
                  <span><?= e(date('d M Y', strtotime($post['published_at'] ?? $post['created_at'] ?? 'now'))) ?></span>
                </span>
              </div>

              <h3 class="font-headline-sm text-headline-sm text-deep-forest leading-snug font-bold">
                <a href="<?= e(base_url('/blog/' . $post['slug'])) ?>" class="hover:text-primary transition-colors">
                  <?= e($cleanTitle) ?>
                </a>
              </h3>

              <p class="font-body-sm text-body-sm text-on-surface-variant mt-2.5 line-clamp-3 leading-relaxed">
                <?= e($cleanExcerpt) ?>
              </p>
            </div>

            <div class="pt-3 flex items-center justify-between bg-soft-meadow -mx-6 -mb-6 px-6 py-3.5 border-t border-border-warm">
              <span class="font-label-sm text-label-sm text-secondary font-semibold">
                <span><?= e(($post['author'] ?? '') ?: ($post['author_name'] ?? ps_text('प्रदीप सारंग', 'Pradeep Sarang'))) ?></span>
              </span>
              <a href="<?= e(base_url('/blog/' . $post['slug'])) ?>" class="text-primary hover:text-deep-forest font-label-md text-label-md inline-flex items-center gap-1 font-bold">
                <span><?= e(ps_text('पढ़ें', 'Read')) ?></span>
                <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
              </a>
            </div>
          </div>
        </article>
      <?php endforeach; else: ?>
        <div class="col-span-full py-16 text-center text-text-muted">
          <span class="material-symbols-outlined text-4xl text-stone-400 mb-2">article</span>
          <p><?= e(ps_text('वर्तमान में कोई आलेख उपलब्ध नहीं है।', 'No articles currently available.')) ?></p>
        </div>
      <?php endif; ?>
    </div>
  </section>
</div>

<script>
  (function() {
    const filterButtons = document.querySelectorAll('.cat-filter-btn');
    const articleCards = document.querySelectorAll('.article-card');
    const searchInput = document.getElementById('article-search');

    function filterArticles() {
      const query = (searchInput ? searchInput.value.toLowerCase().trim() : '');
      const activeBtn = document.querySelector('.cat-filter-btn.bg-deep-forest');
      const activeCategory = activeBtn ? activeBtn.getAttribute('data-cat') : 'all';

      articleCards.forEach(card => {
        const cardCat = card.getAttribute('data-cat');
        const cardText = card.innerText.toLowerCase();

        const matchesCat = (activeCategory === 'all' || cardCat === activeCategory);
        const matchesQuery = (!query || cardText.includes(query));

        if (matchesCat && matchesQuery) {
          card.style.display = 'flex';
        } else {
          card.style.display = 'none';
        }
      });
    }

    filterButtons.forEach(btn => {
      btn.addEventListener('click', function() {
        filterButtons.forEach(b => {
          b.classList.remove('bg-deep-forest', 'text-pure-white');
          b.classList.add('bg-pure-white', 'text-on-surface');
        });
        this.classList.remove('bg-pure-white', 'text-on-surface');
        this.classList.add('bg-deep-forest', 'text-pure-white');
        filterArticles();
      });
    });

    if (searchInput) {
      searchInput.addEventListener('input', filterArticles);
    }
  })();
</script>
