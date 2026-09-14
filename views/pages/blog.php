<?php
declare(strict_types=1);

$items = $items ?? [];
$categories = $categories ?? [];
?>

<div class="flex flex-col w-full">
<!-- Top Subtle Texture Glow -->
<div class="relative w-full bg-soft-meadow overflow-hidden py-space-2xl md:py-space-3xl border-b border-border-warm">
  <div class="absolute -top-32 -left-20 w-96 h-96 bg-primary-fixed/40 rounded-full blur-3xl pointer-events-none"></div>
  <div class="absolute top-10 right-0 w-80 h-80 bg-secondary-fixed/30 rounded-full blur-3xl pointer-events-none"></div>
  
  <!-- Editorial Header Section -->
  <div class="max-w-container-max mx-auto px-4 sm:px-8 relative z-10">
    <!-- Breadcrumb -->
    <nav class="flex items-center gap-2 font-label-md text-label-md text-text-muted mb-space-sm" aria-label="Breadcrumb">
      <a class="hover:text-primary transition-colors flex items-center gap-1" data-path="home" href="<?= e(base_url('/')) ?>">
        <span class="material-symbols-outlined text-[16px]">home</span>
        <span><?= e(ps_text('गृह (Home)', 'Home')) ?></span>
      </a>
      <span class="opacity-40">/</span>
      <span class="text-deep-forest font-semibold"><?= e(ps_text('ब्लॉग एवं आलेख (Blog)', 'Blog & Articles')) ?></span>
    </nav>
    
    <!-- Editorial Badges & Hero Content -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
      <div class="lg:col-span-8 flex flex-col space-y-4">
        <div class="inline-flex items-center gap-2 self-start bg-primary-fixed/40 text-deep-forest px-3.5 py-1 rounded-full font-label-sm text-label-sm mb-space-sm border border-border-warm font-semibold">
          <span class="material-symbols-outlined text-[15px] text-primary-container" style="font-variation-settings: 'FILL' 1;">nature_people</span>
          <span><?= e(ps_text('माटी की महक और वैचारिक चिंतन • प्रदीप सारंग के आलेख', 'Fragrance of Soil & Reflections • Essays by Pradeep Sarang')) ?></span>
        </div>
        <h1 class="font-display-hero text-headline-lg md:text-display-hero text-deep-forest leading-tight tracking-tight font-bold">
          <?= ps_text('गाँव की माटी, लोक-संस्कृति और पर्यावरण चेतना — <span class="text-primary-container">वैचारिक आलेख एवं संस्मरण</span>', 'Village Soil, Folk Culture & Ecological Consciousness — <span class="text-primary-container">Essays & Memoirs</span>') ?>
        </h1>
        <p class="font-body-lg text-body-lg text-text-muted mt-space-sm leading-relaxed max-w-3xl">
          <?= e(ps_text('चार दशकों के ज़मीनी अनुभवों, अवधी लोक-जीवन की सच्चाइयों, पर्यावरण के गंभीर सवालों और मानवीय संवेदनाओं को शब्दों में पिरोता आलेख व चिंतन संकलन। यहाँ शब्द मात्र विचार नहीं, बल्कि जन-सरोकारों का जीवंत दस्तावेज हैं।', 'A collection weaving four decades of ground experience, Awadhi folk realities, environmental questions, and human empathy into living words.')) ?>
        </p>

        <!-- Search & Filter Ribbon -->
        <div class="pt-4 flex flex-col sm:flex-row items-stretch sm:items-center gap-3">
          <div class="relative flex-1">
            <span class="material-symbols-outlined absolute left-3.5 top-1/2 -translate-y-1/2 text-text-muted text-[20px]">search</span>
            <input type="text" id="article-search" placeholder="<?= e(ps_text('शीर्षक, विषय या अवधी लोक-शब्द खोजें...', 'Search by title, topic or Awadhi words...')) ?>" class="w-full pl-11 pr-4 py-3 rounded-xl border border-border-warm bg-pure-white text-on-surface font-body-md text-body-md placeholder-text-muted shadow-sm focus:outline-none focus:ring-2 focus:ring-primary-container">
          </div>
          <div class="flex items-center gap-2">
            <a href="#patrika" class="inline-flex items-center justify-center gap-2 bg-primary-container text-on-primary hover:bg-deep-forest px-5 py-3 rounded-xl font-label-md text-label-md transition-colors shadow-sm">
              <span class="material-symbols-outlined text-[18px]">mark_email_read</span>
              <span><?= e(ps_text('पत्रिका सदस्यता', 'Magazine Subscribe')) ?></span>
            </a>
          </div>
        </div>
      </div>

      <!-- Sarang Ji Editorial Quote Inset -->
      <div class="lg:col-span-4 bg-pure-white p-6 sm:p-7 rounded-2xl border border-border-warm shadow-sm relative flex flex-col justify-between self-stretch">
        <div class="flex items-start justify-between mb-4">
          <span class="material-symbols-outlined text-secondary text-[36px] opacity-40 leading-none">format_quote</span>
          <span class="font-label-sm text-label-sm bg-soft-meadow text-deep-forest px-2.5 py-0.5 rounded-full font-semibold"><?= e(ps_text('चिंतन सूत्र', 'Editorial Thought')) ?></span>
        </div>
        <blockquote class="font-quote-editorial text-quote-editorial text-on-surface leading-relaxed italic mb-4">
          <?= ps_text('"जब तक गाँव की पगडंडियों की धूल और किसानों के पसीने की बात साहित्य में नहीं उतरेगी, तब तक समाज में कोई स्थायी बदलाव संभव नहीं है।"' , '"Until the dust of village trails and sweat of farmers enters literature, lasting social change is impossible."') ?>
        </blockquote>
        <div class="pt-3 flex items-center gap-3 bg-soft-meadow/60 -mx-6 -mb-6 p-4 rounded-b-2xl border-t border-border-warm">
          <div class="w-10 h-10 rounded-full bg-primary-container flex items-center justify-center text-on-primary font-headline-sm text-[16px]">
            प्र
          </div>
          <div class="flex flex-col">
            <span class="font-title-md text-title-md text-deep-forest leading-none"><?= e(ps_text('प्रदीप सारंग', 'Pradeep Sarang')) ?></span>
            <span class="font-label-sm text-label-sm text-text-muted mt-0.5"><?= e(ps_text('साहित्यकार एवं पर्यावरण कार्यकर्ता, बाराबंकी', 'Writer & Environmentalist, Barabanki')) ?></span>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Impact Metrics / Reading Stats Strip -->
<section class="w-full bg-deep-forest text-pure-white py-6 shadow-sm">
  <div class="max-w-container-max mx-auto px-4 sm:px-8">
    <div class="grid grid-cols-2 md:grid-cols-4 gap-6 md:gap-8 divide-y-0">
      <div class="flex items-center gap-3.5">
        <div class="w-12 h-12 rounded-xl bg-primary-container/60 flex items-center justify-center shrink-0">
          <span class="material-symbols-outlined text-primary-fixed text-[26px]">menu_book</span>
        </div>
        <div class="flex flex-col">
          <span class="font-headline-lg text-headline-md sm:text-headline-lg text-primary-fixed font-bold leading-none">45+</span>
          <span class="font-label-sm text-label-sm text-surface-container-high mt-1"><?= e(ps_text('प्रकाशित आलेख व संस्मरण', 'Published Essays & Memoirs')) ?></span>
        </div>
      </div>
      <div class="flex items-center gap-3.5">
        <div class="w-12 h-12 rounded-xl bg-primary-container/60 flex items-center justify-center shrink-0">
          <span class="material-symbols-outlined text-primary-fixed text-[26px]">category</span>
        </div>
        <div class="flex flex-col">
          <span class="font-headline-lg text-headline-md sm:text-headline-lg text-primary-fixed font-bold leading-none">04</span>
          <span class="font-label-sm text-label-sm text-surface-container-high mt-1"><?= e(ps_text('प्रमुख वैचारिक श्रेणियाँ', 'Core Essay Categories')) ?></span>
        </div>
      </div>
      <div class="flex items-center gap-3.5">
        <div class="w-12 h-12 rounded-xl bg-primary-container/60 flex items-center justify-center shrink-0">
          <span class="material-symbols-outlined text-primary-fixed text-[26px]">history_edu</span>
        </div>
        <div class="flex flex-col">
          <span class="font-headline-lg text-headline-md sm:text-headline-lg text-primary-fixed font-bold leading-none">35+</span>
          <span class="font-label-sm text-label-sm text-surface-container-high mt-1"><?= e(ps_text('वर्षों का अनवरत लेखन', 'Years of Continuous Writing')) ?></span>
        </div>
      </div>
      <div class="flex items-center gap-3.5">
        <div class="w-12 h-12 rounded-xl bg-primary-container/60 flex items-center justify-center shrink-0">
          <span class="material-symbols-outlined text-primary-fixed text-[26px]">groups</span>
        </div>
        <div class="flex flex-col">
          <span class="font-headline-lg text-headline-md sm:text-headline-lg text-primary-fixed font-bold leading-none">15,000+</span>
          <span class="font-label-sm text-label-sm text-surface-container-high mt-1"><?= e(ps_text('प्रबुद्ध पाठक व ग्रामीण अध्येता', 'Engaged Readers & Scholars')) ?></span>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Featured Editorial Spotlight -->
<section class="max-w-container-max mx-auto px-4 sm:px-8 py-12 bg-cream-canvas">
  <div class="flex items-center justify-between mb-6">
    <div class="flex items-center gap-2.5">
      <span class="w-2.5 h-6 bg-secondary rounded-full"></span>
      <h2 class="font-headline-md text-headline-md text-deep-forest font-bold"><?= e(ps_text('मुख्य संपादकीय आलेख (Featured Editorial)', 'Featured Editorial Essay')) ?></h2>
    </div>
    <span class="font-label-sm text-label-sm text-text-muted hidden sm:inline-flex items-center gap-1">
      <span class="material-symbols-outlined text-[16px] text-primary">verified</span>
      <span><?= e(ps_text('संपादक की विशेष अनुशंसा', 'Editor\'s Pick')) ?></span>
    </span>
  </div>

  <div class="bg-pure-white rounded-2xl p-6 lg:p-10 shadow-md border border-border-warm transition-all hover:shadow-xl relative overflow-hidden">
    <div class="flex flex-col space-y-4">
      <div class="flex flex-wrap items-center gap-2.5">
        <span class="bg-soft-meadow text-deep-forest font-label-sm text-label-sm px-3 py-1 rounded-md font-semibold border border-border-warm">
          <?= e(ps_text('पर्यावरण एवं समाज', 'Environment & Society')) ?>
        </span>
        <span class="text-text-muted text-label-sm flex items-center gap-1">
          <span class="material-symbols-outlined text-[16px]">schedule</span> 12 <?= e(ps_text('मिनट पठन', 'min read')) ?>
        </span>
        <span class="text-text-muted text-label-sm flex items-center gap-1">
          <span class="material-symbols-outlined text-[16px]">person</span> <?= e(ps_text('प्रदीप सारंग', 'Pradeep Sarang')) ?>
        </span>
        <span class="text-text-muted text-label-sm flex items-center gap-1">
          <span class="material-symbols-outlined text-[16px]">calendar_month</span> 14 <?= e(ps_text('जनवरी 2026', 'Jan 2026')) ?>
        </span>
      </div>

      <h3 class="font-headline-lg text-headline-sm lg:text-headline-md text-deep-forest leading-snug font-bold">
        <a href="<?= !empty($items[0]['slug']) ? e(base_url('/blog/' . $items[0]['slug'])) : e(base_url('/blog/green-morning')) ?>" class="hover:text-primary transition-colors">
          <?= e(ps_text('कमरावां से उठी \'ग्रीन मॉर्निंग\' की गूँज — जब एक गाँव ने बदला सुबह का अभिवादन', 'The Echo of Green Morning from Kamrawan — When a Village Transformed Morning Greetings')) ?>
        </a>
      </h3>

      <p class="font-body-md text-body-md text-on-surface-variant leading-relaxed">
        <?= e(ps_text('गाँव की चौपाल पर जब सुबह-सवेरे \'नमस्ते\' या विदेशी औपचारिकता की जगह \'ग्रीन मॉर्निंग\' (हरित प्रभात) का घोष गूंजता है, तो यह केवल शब्दों का फेरबदल नहीं होता। यह प्रकृति के प्रति हमारी जिम्मेदारी और धरती माँ के प्रति कृतज्ञता का सहज स्वीकार है। 1980 के दशक से शुरू हुई यह पहल आज बाराबंकी के दर्जनों गाँवों में जन-आंदोलन का रूप ले चुकी है...', 'When village chaupals echo with Green Morning instead of foreign formalities, it is a conscious acceptance of responsibility toward nature...')) ?>
      </p>

      <div class="bg-soft-meadow p-4 rounded-xl border border-border-warm">
        <p class="font-quote-editorial text-body-lg text-deep-forest italic">
          <?= ps_text('"हरियाली कोई सरकारी योजना नहीं, हमारे संस्कारों की साँस है। जब तक हर सुबह पेड़-पौधों के नाम नहीं होगी, दिन की शुरुआत अधूरी है।"' , '"Greenery is not a government scheme, but the breath of our values. Every morning belongs to mother nature."') ?>
        </p>
      </div>

      <div class="pt-2 flex flex-wrap items-center gap-4">
        <a href="<?= !empty($items[0]['slug']) ? e(base_url('/blog/' . $items[0]['slug'])) : e(base_url('/blog/green-morning')) ?>" class="bg-primary-container hover:bg-deep-forest text-on-primary px-6 py-3 rounded-xl font-label-md text-label-md flex items-center gap-2 transition-all shadow-sm">
          <span><?= e(ps_text('पूरा आलेख पढ़ें (Read Full Essay)', 'Read Full Essay')) ?></span>
          <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
        </a>
      </div>
    </div>
  </div>
</section>

<!-- Category Filter Tabs with Item Counts -->
<section class="max-w-container-max mx-auto px-4 sm:px-8 pt-6 pb-4 bg-cream-canvas">
  <div class="flex items-center justify-between border-b border-border-warm pb-4 mb-8 overflow-x-auto">
    <div class="flex items-center gap-2 sm:gap-3 flex-nowrap" id="category-filters">
      <button type="button" data-cat="all" class="cat-filter-btn px-4 py-2 rounded-full bg-deep-forest text-pure-white font-label-md text-label-md whitespace-nowrap shadow-sm">
        <?= e(ps_text('सभी आलेख', 'All Articles')) ?>
      </button>
      <?php if (!empty($categories)): foreach ($categories as $cat): ?>
        <button type="button" data-cat="<?= e((string)$cat['id']) ?>" class="cat-filter-btn px-4 py-2 rounded-full bg-pure-white text-on-surface border border-border-warm hover:bg-soft-meadow font-label-md text-label-md whitespace-nowrap shadow-sm transition-colors">
          <?= e($cat['name']) ?>
        </button>
      <?php endforeach; else: ?>
        <button type="button" data-cat="awadhi" class="cat-filter-btn px-4 py-2 rounded-full bg-pure-white text-on-surface border border-border-warm hover:bg-soft-meadow font-label-md text-label-md whitespace-nowrap shadow-sm transition-colors">
          <?= e(ps_text('अवधी लोक-गद्य व संस्मरण', 'Awadhi Prose & Memoirs')) ?>
        </button>
        <button type="button" data-cat="green" class="cat-filter-btn px-4 py-2 rounded-full bg-pure-white text-on-surface border border-border-warm hover:bg-soft-meadow font-label-md text-label-md whitespace-nowrap shadow-sm transition-colors">
          <?= e(ps_text('पर्यावरण एवं \'ग्रीन गैंग\'', 'Environment & Green Gang')) ?>
        </button>
        <button type="button" data-cat="rural" class="cat-filter-btn px-4 py-2 rounded-full bg-pure-white text-on-surface border border-border-warm hover:bg-soft-meadow font-label-md text-label-md whitespace-nowrap shadow-sm transition-colors">
          <?= e(ps_text('ग्रामीण संस्कृति व जीवन-दर्शन', 'Rural Culture & Philosophy')) ?>
        </button>
        <button type="button" data-cat="youth" class="cat-filter-btn px-4 py-2 rounded-full bg-pure-white text-on-surface border border-border-warm hover:bg-soft-meadow font-label-md text-label-md whitespace-nowrap shadow-sm transition-colors">
          <?= e(ps_text('युवा चेतना व समाज-सेवा', 'Youth Consciousness')) ?>
        </button>
      <?php endif; ?>
    </div>
    <div class="hidden md:flex items-center gap-2 text-text-muted font-label-sm text-label-sm pl-4 shrink-0">
      <span class="material-symbols-outlined text-[18px]">tune</span>
      <span><?= e(ps_text('क्रम: नवीनतम प्रथम', 'Sort: Latest First')) ?></span>
    </div>
  </div>

  <!-- Curated Articles Grid -->
  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-7" id="articles-grid">
    <?php if (!empty($items)): foreach ($items as $idx => $post): 
      $img = ps_resolve_img($post['banner_image'] ?: ($post['featured_image'] ?? ''), 'assets/images/slider_final_1.webp');
      $cleanTitle = html_entity_decode((string)$post['title'], ENT_QUOTES, 'UTF-8');
      $cleanExcerpt = html_entity_decode((string)($post['excerpt'] ?: ps_excerpt($post['content'] ?? '', 120)), ENT_QUOTES, 'UTF-8');
    ?>
      <article class="article-card flex flex-col bg-pure-white rounded-2xl shadow-sm border border-border-warm hover:shadow-lg transition-all overflow-hidden group" data-cat="<?= e((string)($post['category_id'] ?? 'all')) ?>">
        <!-- Card Cover Image Container -->
        <div class="relative w-full h-48 sm:h-52 overflow-hidden bg-surface-container">
          <img src="<?= e($img) ?>" alt="<?= e($cleanTitle) ?>" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
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
                <span>8 <?= e(ps_text('मिनट पठन', '8 min read')) ?></span>
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
      <!-- Curated Fallback Articles with Cover Images -->
      <!-- Card 1: Sughari -->
      <article class="article-card flex flex-col bg-pure-white rounded-2xl shadow-sm border border-border-warm hover:shadow-lg transition-all overflow-hidden group" data-cat="awadhi">
        <div class="relative w-full h-48 sm:h-52 overflow-hidden bg-surface-container">
          <img src="<?= e(base_url('uploads/6a0c9561a4f1b_headerbackground.webp')) ?>" alt="Sughari" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
          <div class="absolute top-3 left-3">
            <span class="bg-white/95 backdrop-blur-md text-deep-forest font-label-sm text-label-sm px-3 py-1 rounded-md font-bold border border-border-warm shadow-xs">
              <?= e(ps_text('अवधी गद्य', 'Awadhi Prose')) ?>
            </span>
          </div>
        </div>

        <div class="p-6 flex-1 flex flex-col justify-between space-y-4">
          <div>
            <div class="flex items-center justify-between text-text-muted font-label-sm text-label-sm mb-2.5">
              <span class="flex items-center gap-1 font-medium">
                <span class="material-symbols-outlined text-[15px] text-primary">schedule</span>
                <span>8 <?= e(ps_text('मिनट पठन', '8 min read')) ?></span>
              </span>
              <span class="flex items-center gap-1 font-medium">
                <span class="material-symbols-outlined text-[15px]">calendar_month</span>
                <span>18 Dec 2025</span>
              </span>
            </div>

            <h3 class="font-headline-sm text-headline-sm text-deep-forest leading-snug font-bold">
              <a href="<?= e(base_url('/blog/sughari')) ?>" class="hover:text-primary transition-colors">
                <?= e(ps_text('सुघरी (अवधी लोक-गद्य कथा)', 'Sughari (Awadhi Folk Tale)')) ?>
              </a>
            </h3>

            <p class="font-body-sm text-body-sm text-on-surface-variant mt-2.5 line-clamp-3 leading-relaxed">
              <?= e(ps_text("मेला जाय की खुशी मा, गोबर की खेप लइकै जाय रही 'सुघरी' के कदमन की चाल आजु अपने आपै कुछ बढ़ी हुई है। माथे पर पसीने की बूंदें चमक रही हैं और मन मा रामलीला मैदान की रंग-बिरंगी चकरी घूम रही है...", "Happy about going to the village fair, Sughari walks with energetic steps carrying her basket...")) ?>
            </p>
          </div>

          <div class="pt-3 flex items-center justify-between bg-soft-meadow -mx-6 -mb-6 px-6 py-3.5 border-t border-border-warm">
            <span class="font-label-sm text-label-sm text-secondary font-semibold">
              <span><?= e(ps_text('प्रदीप सारंग', 'Pradeep Sarang')) ?></span>
            </span>
            <a href="<?= e(base_url('/blog/sughari')) ?>" class="text-primary hover:text-deep-forest font-label-md text-label-md inline-flex items-center gap-1 font-bold">
              <span><?= e(ps_text('पढ़ें', 'Read')) ?></span>
              <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
            </a>
          </div>
        </div>
      </article>

      <!-- Card 2: Jharihakh -->
      <article class="article-card flex flex-col bg-pure-white rounded-2xl shadow-sm border border-border-warm hover:shadow-lg transition-all overflow-hidden group" data-cat="awadhi">
        <div class="relative w-full h-48 sm:h-52 overflow-hidden bg-surface-container">
          <img src="<?= e(base_url('uploads/69edd6098e8c2_slider_final_1.webp')) ?>" alt="Jharihakh" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
          <div class="absolute top-3 left-3">
            <span class="bg-white/95 backdrop-blur-md text-deep-forest font-label-sm text-label-sm px-3 py-1 rounded-md font-bold border border-border-warm shadow-xs">
              <?= e(ps_text('साक्षात्कार व संस्मरण', 'Interview & Memoir')) ?>
            </span>
          </div>
        </div>

        <div class="p-6 flex-1 flex flex-col justify-between space-y-4">
          <div>
            <div class="flex items-center justify-between text-text-muted font-label-sm text-label-sm mb-2.5">
              <span class="flex items-center gap-1 font-medium">
                <span class="material-symbols-outlined text-[15px] text-primary">schedule</span>
                <span>6 <?= e(ps_text('मिनट पठन', '6 min read')) ?></span>
              </span>
              <span class="flex items-center gap-1 font-medium">
                <span class="material-symbols-outlined text-[15px]">calendar_month</span>
                <span>05 Nov 2025</span>
              </span>
            </div>

            <h3 class="font-headline-sm text-headline-sm text-deep-forest leading-snug font-bold">
              <a href="<?= e(base_url('/blog/jharihakh')) ?>" class="hover:text-primary transition-colors">
                <?= e(ps_text('झरिहख (बरसात और बचपन का संस्मरण)', 'Jharihakh (Monsoon & Childhood Memory)')) ?>
              </a>
            </h3>

            <p class="font-body-sm text-body-sm text-on-surface-variant mt-2.5 line-clamp-3 leading-relaxed">
              <?= e(ps_text("आजु जब हम सोय कै जागेन, तौ झमाझम बारिस होत रही। बादलों की गड़गड़ाहट और मिट्टी की सोंधी खुशबू के बीच पुरानी चौपाल की यादें, जब छत से टपकते पानी के नीचे थालियाँ लगा दी जाती थीं...", "Waking up to heavy monsoon rains, clouds rumbling and fragrance of damp soil...")) ?>
            </p>
          </div>

          <div class="pt-3 flex items-center justify-between bg-soft-meadow -mx-6 -mb-6 px-6 py-3.5 border-t border-border-warm">
            <span class="font-label-sm text-label-sm text-secondary font-semibold">
              <span><?= e(ps_text('प्रदीप सारंग', 'Pradeep Sarang')) ?></span>
            </span>
            <a href="<?= e(base_url('/blog/jharihakh')) ?>" class="text-primary hover:text-deep-forest font-label-md text-label-md inline-flex items-center gap-1 font-bold">
              <span><?= e(ps_text('पढ़ें', 'Read')) ?></span>
              <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
            </a>
          </div>
        </div>
      </article>

      <!-- Card 3: Sukhte Taal aur Parinde -->
      <article class="article-card flex flex-col bg-pure-white rounded-2xl shadow-sm border border-border-warm hover:shadow-lg transition-all overflow-hidden group" data-cat="green">
        <div class="relative w-full h-48 sm:h-52 overflow-hidden bg-surface-container">
          <img src="<?= e(base_url('uploads/69edd6098de58_slider_final_3.webp')) ?>" alt="Sukhte Taal" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
          <div class="absolute top-3 left-3">
            <span class="bg-white/95 backdrop-blur-md text-deep-forest font-label-sm text-label-sm px-3 py-1 rounded-md font-bold border border-border-warm shadow-xs">
              <?= e(ps_text('पर्यावरण व जीव-दया', 'Ecology & Bird Compassion')) ?>
            </span>
          </div>
        </div>

        <div class="p-6 flex-1 flex flex-col justify-between space-y-4">
          <div>
            <div class="flex items-center justify-between text-text-muted font-label-sm text-label-sm mb-2.5">
              <span class="flex items-center gap-1 font-medium">
                <span class="material-symbols-outlined text-[15px] text-primary">schedule</span>
                <span>10 <?= e(ps_text('मिनट पठन', '10 min read')) ?></span>
              </span>
              <span class="flex items-center gap-1 font-medium">
                <span class="material-symbols-outlined text-[15px]">calendar_month</span>
                <span>24 Oct 2025</span>
              </span>
            </div>

            <h3 class="font-headline-sm text-headline-sm text-deep-forest leading-snug font-bold">
              <a href="<?= e(base_url('/blog/sukhte-taal')) ?>" class="hover:text-primary transition-colors">
                <?= e(ps_text('सूखते ताल और बेजुबान परिंदों की पुकार — ग्रीष्म में मानवीय परीक्षा', 'Drying Ponds & Call of Birds — A Human Test in Summer')) ?>
              </a>
            </h3>

            <p class="font-body-sm text-body-sm text-on-surface-variant mt-2.5 line-clamp-3 leading-relaxed">
              <?= e(ps_text('गाँवों के तालाब अब केवल जल-स्रोत नहीं रहे, वे हमारे संवेदनहीन होते समाज का आईना हैं। हर ग्रीष्म में जब सकोरों में पानी रखने का अभियान शुरू होता है, तो यह केवल चिड़ियों को बचाने का नहीं, मनुष्य के भीतर की करुणा को जीवित रखने का उपक्रम है।', 'Village ponds are mirrors of our society. Hanging water bowls is an exercise to keep human empathy alive.')) ?>
            </p>
          </div>

          <div class="pt-3 flex items-center justify-between bg-soft-meadow -mx-6 -mb-6 px-6 py-3.5 border-t border-border-warm">
            <span class="font-label-sm text-label-sm text-primary font-semibold">
              <span><?= e(ps_text('प्रदीप सारंग', 'Pradeep Sarang')) ?></span>
            </span>
            <a href="<?= e(base_url('/blog/sukhte-taal')) ?>" class="text-primary hover:text-deep-forest font-label-md text-label-md inline-flex items-center gap-1 font-bold">
              <span><?= e(ps_text('पढ़ें', 'Read')) ?></span>
              <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
            </a>
          </div>
        </div>
      </article>
    <?php endif; ?>
  </div>
</section>

<!-- Awadhi Linguistic Glossary Highlight Section -->
<section class="w-full bg-soft-meadow py-14 border-t border-border-warm">
  <div class="max-w-container-max mx-auto px-4 sm:px-8">
    <div class="flex flex-col md:flex-row md:items-end justify-between mb-8 gap-4">
      <div>
        <div class="inline-flex items-center gap-2 bg-cream-canvas border border-border-warm px-3 py-1 rounded-md text-secondary font-label-sm text-label-sm font-semibold mb-2">
          <span class="material-symbols-outlined text-[16px]">translate</span>
          <span><?= e(ps_text('भाषा-संस्कृति धरोहर', 'Linguistic Heritage')) ?></span>
        </div>
        <h2 class="font-headline-md text-headline-md text-deep-forest font-bold"><?= e(ps_text('अवधी लोक-शब्दावली कॉर्नर (Awadhi Cultural Lexicon)', 'Awadhi Cultural Lexicon Corner')) ?></h2>
        <p class="font-body-md text-body-md text-text-muted mt-1"><?= e(ps_text('सारंग जी के आलेखों व गद्य में प्रयुक्त ठेठ अवधी शब्दों की मिठास और उनका सांस्कृतिक संदर्भ', 'Rich local Awadhi terms used across Pradeep Sarang’s literature')) ?></p>
      </div>
    </div>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
      <!-- Word 1 -->
      <div class="bg-pure-white p-6 rounded-xl border border-border-warm shadow-sm relative overflow-hidden group hover:shadow-md transition-shadow">
        <div class="w-2 h-full bg-primary-container absolute left-0 top-0"></div>
        <div class="flex items-baseline justify-between mb-2">
          <h4 class="font-headline-sm text-headline-sm text-deep-forest font-bold"><?= e(ps_text('झरिहख', 'Jharihakh')) ?></h4>
          <span class="font-label-sm text-label-sm bg-soft-meadow text-deep-forest px-2 py-0.5 rounded font-semibold"><?= e(ps_text('संज्ञा', 'Noun')) ?></span>
        </div>
        <p class="font-body-sm text-body-sm text-secondary font-medium mb-2"><?= e(ps_text('अर्थ: मूसलाधार, अनवरत वर्षा', 'Meaning: Torrential continuous rain')) ?></p>
        <p class="font-body-sm text-body-sm text-on-surface-variant leading-relaxed">
          <?= e(ps_text('जब सावन-भादों में आकाश से कई दिनों तक लगातार पानी गिरता है और पगडंडियाँ जलमग्न हो जाती हैं, अवध में उसे \'झरिहख\' कहा जाता है।', 'Continuous rain during monsoon days when village trails overflow.')) ?>
        </p>
      </div>
      <!-- Word 2 -->
      <div class="bg-pure-white p-6 rounded-xl border border-border-warm shadow-sm relative overflow-hidden group hover:shadow-md transition-shadow">
        <div class="w-2 h-full bg-secondary absolute left-0 top-0"></div>
        <div class="flex items-baseline justify-between mb-2">
          <h4 class="font-headline-sm text-headline-sm text-deep-forest font-bold"><?= e(ps_text('सुघरी', 'Sughari')) ?></h4>
          <span class="font-label-sm text-label-sm bg-soft-meadow text-deep-forest px-2 py-0.5 rounded font-semibold"><?= e(ps_text('विशेषण', 'Adjective')) ?></span>
        </div>
        <p class="font-body-sm text-body-sm text-secondary font-medium mb-2"><?= e(ps_text('अर्थ: सलीकेदार, सुघड़ व कर्मठ स्त्री', 'Meaning: Graceful, industrious woman')) ?></p>
        <p class="font-body-sm text-body-sm text-on-surface-variant leading-relaxed">
          <?= e(ps_text('ग्रामीण परिवेश में घर-आँगन और समाज के दायित्वों को पूरी शालीनता व कुशलता से निभाने वाली स्त्री को आदरपूर्वक \'सुघरी\' कहा जाता है।', 'A respectful term for a diligent and graceful village woman handling duties.')) ?>
        </p>
      </div>
      <!-- Word 3 -->
      <div class="bg-pure-white p-6 rounded-xl border border-border-warm shadow-sm relative overflow-hidden group hover:shadow-md transition-shadow">
        <div class="w-2 h-full bg-primary-container absolute left-0 top-0"></div>
        <div class="flex items-baseline justify-between mb-2">
          <h4 class="font-headline-sm text-headline-sm text-deep-forest font-bold"><?= e(ps_text('सकोरा', 'Sakora')) ?></h4>
          <span class="font-label-sm text-label-sm bg-soft-meadow text-deep-forest px-2 py-0.5 rounded font-semibold"><?= e(ps_text('संज्ञा', 'Noun')) ?></span>
        </div>
        <p class="font-body-sm text-body-sm text-secondary font-medium mb-2"><?= e(ps_text('अर्थ: मिट्टी का खुला उथला पात्र', 'Meaning: Earthen clay water bowl')) ?></p>
        <p class="font-body-sm text-body-sm text-on-surface-variant leading-relaxed">
          <?= e(ps_text('कुम्हार के चाक से बना पक्का मिट्टी का बर्तन, जिसमें गर्मियों में परिंदों के लिए पानी भरकर पेड़ों की शाखाओं पर टांगा जाता है।', 'Clay bowl hung on tree branches filled with fresh water for birds in summer.')) ?>
        </p>
      </div>
      <!-- Word 4 -->
      <div class="bg-pure-white p-6 rounded-xl border border-border-warm shadow-sm relative overflow-hidden group hover:shadow-md transition-shadow">
        <div class="w-2 h-full bg-secondary absolute left-0 top-0"></div>
        <div class="flex items-baseline justify-between mb-2">
          <h4 class="font-headline-sm text-headline-sm text-deep-forest font-bold"><?= e(ps_text('ओसारा', 'Osara')) ?></h4>
          <span class="font-label-sm text-label-sm bg-soft-meadow text-deep-forest px-2 py-0.5 rounded font-semibold"><?= e(ps_text('संज्ञा', 'Noun')) ?></span>
        </div>
        <p class="font-body-sm text-body-sm text-secondary font-medium mb-2"><?= e(ps_text('अर्थ: दालान, खुला बरामदा', 'Meaning: Open village verandah')) ?></p>
        <p class="font-body-sm text-body-sm text-on-surface-variant leading-relaxed">
          <?= e(ps_text('गाँव के घर के आगे की वह खुली छतदार जगह जहाँ चौपाल जमती है, पड़ोसी बैठते हैं और सुख-दुख की \'बातकही\' होती है।', 'Roof-covered front courtyard where neighbors gather for chaupal talks.')) ?>
        </p>
      </div>
    </div>
  </div>
</section>

<!-- Reader Feedback & Newsletter Dual Section -->
<section class="max-w-container-max mx-auto px-4 sm:px-8 py-14 bg-cream-canvas" id="patrika">
  <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-stretch">
    <!-- Reader Feedback Form -->
    <div class="lg:col-span-7 bg-pure-white p-6 sm:p-9 rounded-2xl shadow-sm border border-border-warm flex flex-col justify-between">
      <div>
        <div class="inline-flex items-center gap-2 bg-soft-meadow border border-border-warm px-3 py-1 rounded-md text-primary font-label-sm text-label-sm font-semibold mb-3">
          <span class="material-symbols-outlined text-[16px]">rate_review</span>
          <span><?= e(ps_text('पाठक संवाद एवं रचना प्रतिक्रिया', 'Reader Feedback & Reflection')) ?></span>
        </div>
        <h3 class="font-headline-md text-headline-sm sm:text-headline-md text-deep-forest font-bold leading-snug">
          <?= e(ps_text('आपकी वैचारिक प्रतिक्रिया — आलेखों पर अपनी राय व संस्मरण साझा करें', 'Share Your Thoughts & Memories on Essays')) ?>
        </h3>
        <p class="font-body-md text-body-md text-text-muted mt-2">
          <?= e(ps_text('सारंग जी के किसी आलेख ने आपके गाँव की याद ताज़ा की हो, या पर्यावरण संबंधी कोई प्रश्न हो—अपने विचार सीधे साझा करें।', 'Share your thoughts, village memories or environmental questions directly.')) ?>
        </p>
        <form class="mt-6 space-y-4" onsubmit="event.preventDefault(); alert('<?= e(ps_text('आपकी विचारपूर्ण प्रतिक्रिया प्राप्त हुई। धन्यवाद!', 'Feedback received. Thank you!')) ?>');">
          <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
              <label class="block font-label-sm text-label-sm text-deep-forest mb-1.5 font-semibold"><?= e(ps_text('आपका नाम *', 'Your Name *')) ?></label>
              <input type="text" required placeholder="<?= e(ps_text('उदा. रामेश्वर सिंह', 'e.g. Rameshwar Singh')) ?>" class="w-full px-4 py-2.5 rounded-xl bg-soft-meadow border border-border-warm text-on-surface font-body-md text-body-md focus:bg-pure-white focus:outline-none focus:ring-2 focus:ring-primary-container">
            </div>
            <div>
              <label class="block font-label-sm text-label-sm text-deep-forest mb-1.5 font-semibold"><?= e(ps_text('ईमेल या मोबाइल नंबर *', 'Email or Phone *')) ?></label>
              <input type="text" required placeholder="contact@example.com" class="w-full px-4 py-2.5 rounded-xl bg-soft-meadow border border-border-warm text-on-surface font-body-md text-body-md focus:bg-pure-white focus:outline-none focus:ring-2 focus:ring-primary-container">
            </div>
          </div>
          <div>
            <label class="block font-label-sm text-label-sm text-deep-forest mb-1.5 font-semibold"><?= e(ps_text('संबंधित आलेख या विषय', 'Related Article or Topic')) ?></label>
            <select class="w-full px-4 py-2.5 rounded-xl bg-soft-meadow border border-border-warm text-on-surface font-body-md text-body-md focus:bg-pure-white focus:outline-none focus:ring-2 focus:ring-primary-container">
              <option><?= e(ps_text('कमरावां से उठी \'ग्रीन मॉर्निंग\' की गूँज', 'Echo of Green Morning from Kamrawan')) ?></option>
              <option><?= e(ps_text('सुघरी (अवधी लोक-गद्य कथा)', 'Sughari (Awadhi Folk Tale)')) ?></option>
              <option><?= e(ps_text('झरिहख (बरसात और बचपन का संस्मरण)', 'Jharihakh Monsoon Memoir')) ?></option>
              <option><?= e(ps_text('सूखते ताल और बेजुबान परिंदों की पुकार', 'Drying Ponds & Call of Birds')) ?></option>
              <option><?= e(ps_text('अन्य सामान्य वैचारिक प्रतिक्रिया', 'Other General Feedback')) ?></option>
            </select>
          </div>
          <div>
            <label class="block font-label-sm text-label-sm text-deep-forest mb-1.5 font-semibold"><?= e(ps_text('आपकी प्रतिक्रिया या ग्रामीण संस्मरण *', 'Your Feedback or Village Memory *')) ?></label>
            <textarea rows="3" required placeholder="<?= e(ps_text('आलेख पर अपने विचार, अनुभव अथवा अवधी भाषा व गाँव से जुड़ा कोई संस्मरण लिखें...', 'Write your thoughts or village memories...')) ?>" class="w-full px-4 py-2.5 rounded-xl bg-soft-meadow border border-border-warm text-on-surface font-body-md text-body-md focus:bg-pure-white focus:outline-none focus:ring-2 focus:ring-primary-container"></textarea>
          </div>
          <div class="flex items-center justify-between pt-2">
            <button type="submit" class="bg-primary-container hover:bg-deep-forest text-on-primary px-6 py-2.5 rounded-xl font-label-md text-label-md transition-colors flex items-center gap-2 shadow-sm font-semibold">
              <span><?= e(ps_text('प्रतिक्रिया भेजें', 'Submit Feedback')) ?></span>
              <span class="material-symbols-outlined text-[16px]">send</span>
            </button>
          </div>
        </form>
      </div>
    </div>

    <!-- Newsletter / Patrika Subscription Card -->
    <div class="lg:col-span-5 bg-deep-forest text-pure-white p-6 sm:p-9 rounded-2xl shadow-sm flex flex-col justify-between relative overflow-hidden">
      <div>
        <div class="w-12 h-12 rounded-xl bg-primary-fixed/20 flex items-center justify-center mb-4">
          <span class="material-symbols-outlined text-primary-fixed text-[28px]">mark_email_read</span>
        </div>
        <span class="font-label-sm text-label-sm text-tertiary-fixed tracking-wider uppercase font-semibold"><?= e(ps_text('निःशुल्क वैचारिक पत्रिका', 'Free Fortnightly E-Magazine')) ?></span>
        <h3 class="font-headline-md text-headline-sm sm:text-headline-md text-pure-white mt-1 leading-snug font-bold">
          <?= e(ps_text('"माटी और मनुष्य" पाक्षिक ई-पत्रिका', '"Mati & Manushya" E-Magazine')) ?>
        </h3>
        <p class="font-body-md text-body-md text-surface-container-high mt-3 leading-relaxed">
          <?= e(ps_text('हर पखवाड़े प्रदीप सारंग जी के ताज़ा आलेख, अप्रकाशित संस्मरण, अवधी रचनाएँ और \'ग्रीन गैंग\' की ज़मीनी रिपोर्ट सीधे अपने इनबॉक्स अथवा WhatsApp पर प्राप्त करें।', 'Receive bi-monthly essays, unpublished memoirs, Awadhi writings and Green Gang field reports directly.')) ?>
        </p>
      </div>
      <form method="post" action="<?= e(base_url('/')) ?>" class="mt-8 pt-6 border-t border-surface-container-high/20 space-y-3">
        <?= csrf_field() ?>
        <input type="hidden" name="form_type" value="newsletter">
        <input type="email" name="email" required placeholder="<?= e(ps_text('आपका ईमेल पता या व्हाट्सएप नंबर', 'Your email address or WhatsApp number')) ?>" class="w-full px-4 py-3 rounded-xl bg-surface-container-lowest text-on-surface font-body-md text-body-md focus:outline-none focus:ring-2 focus:ring-primary-fixed">
        <button type="submit" class="w-full bg-secondary hover:bg-secondary/90 text-pure-white font-label-md text-label-md py-3 rounded-xl transition-colors flex items-center justify-center gap-2 font-semibold shadow-sm">
          <span class="material-symbols-outlined text-[18px]">local_florist</span>
          <span><?= e(ps_text('निःशुल्क सदस्यता लें (Subscribe Free)', 'Subscribe Free')) ?></span>
        </button>
      </form>
    </div>
  </div>
</section>

<!-- Cross-Navigation Links -->
<section class="max-w-container-max mx-auto px-4 sm:px-8 pb-16 bg-cream-canvas">
  <div class="flex items-center gap-2.5 mb-6">
    <span class="w-2.5 h-6 bg-primary-container rounded-full"></span>
    <h3 class="font-headline-sm text-headline-sm text-deep-forest font-bold"><?= e(ps_text('संबंधित अनुभाग व शोध सामग्री (Related Portals)', 'Related Portals & Literature')) ?></h3>
  </div>
  <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    <a href="<?= e(base_url('/portfolio')) ?>" data-path="literature" class="p-6 bg-pure-white rounded-xl shadow-sm border border-border-warm hover:shadow-md transition-all group flex flex-col justify-between">
      <div>
        <div class="w-10 h-10 rounded-lg bg-soft-meadow text-deep-forest flex items-center justify-center mb-4 group-hover:bg-primary-container group-hover:text-on-primary transition-colors">
          <span class="material-symbols-outlined text-[22px]">auto_stories</span>
        </div>
        <h4 class="font-title-lg text-title-lg text-deep-forest group-hover:text-primary transition-colors font-bold">
          <?= e(ps_text('अवधी साहित्य व काव्य धरोहर', 'Awadhi Literature & Poetry')) ?>
        </h4>
        <p class="font-body-sm text-body-sm text-text-muted mt-2">
          <?= e(ps_text('सारंग-कुंडलियों, लोक छंदों और अवधी कविताओं का प्रामाणिक संग्रह एवं ऑडियो रिकॉर्डिंग्स।', 'Collection of Sarang-Kundaliyan, folk metres & audio recordings.')) ?>
        </p>
      </div>
      <div class="mt-4 pt-3 flex items-center text-primary font-label-sm text-label-sm font-semibold">
        <span><?= e(ps_text('साहित्य अनुभाग देखें', 'Explore Literature')) ?></span>
        <span class="material-symbols-outlined text-[16px] ml-1 group-hover:translate-x-1 transition-transform">arrow_forward</span>
      </div>
    </a>

    <a href="<?= e(base_url('/media')) ?>" data-path="media" class="p-6 bg-pure-white rounded-xl shadow-sm border border-border-warm hover:shadow-md transition-all group flex flex-col justify-between">
      <div>
        <div class="w-10 h-10 rounded-lg bg-soft-meadow text-deep-forest flex items-center justify-center mb-4 group-hover:bg-primary-container group-hover:text-on-primary transition-colors">
          <span class="material-symbols-outlined text-[22px]">newspaper</span>
        </div>
        <h4 class="font-title-lg text-title-lg text-deep-forest group-hover:text-primary transition-colors font-bold">
          <?= e(ps_text('अखबारों की कतरनें व मीडिया कवरेज', 'Newspaper Clippings & Media')) ?>
        </h4>
        <p class="font-body-sm text-body-sm text-text-muted mt-2">
          <?= e(ps_text('राष्ट्रीय व प्रांतीय समाचार-पत्रों में प्रकाशित प्रदीप सारंग के अभियानों की ऐतिहासिक रिपोर्ट।', 'Press reports & newspaper cutouts from national dailies.')) ?>
        </p>
      </div>
      <div class="mt-4 pt-3 flex items-center text-primary font-label-sm text-label-sm font-semibold">
        <span><?= e(ps_text('मीडिया संकलन देखें', 'Explore Media Archive')) ?></span>
        <span class="material-symbols-outlined text-[16px] ml-1 group-hover:translate-x-1 transition-transform">arrow_forward</span>
      </div>
    </a>

    <a href="<?= e(base_url('/events')) ?>" data-path="events" class="p-6 bg-pure-white rounded-xl shadow-sm border border-border-warm hover:shadow-md transition-all group flex flex-col justify-between">
      <div>
        <div class="w-10 h-10 rounded-lg bg-soft-meadow text-deep-forest flex items-center justify-center mb-4 group-hover:bg-primary-container group-hover:text-on-primary transition-colors">
          <span class="material-symbols-outlined text-[22px]">campaign</span>
        </div>
        <h4 class="font-title-lg text-title-lg text-deep-forest group-hover:text-primary transition-colors font-bold">
          <?= e(ps_text('आगामी आयोजन व ग्रामीण चौपालें', 'Upcoming Events & Chaupals')) ?>
        </h4>
        <p class="font-body-sm text-body-sm text-text-muted mt-2">
          <?= e(ps_text('हरियाली संकल्प बैठकें, रक्तदान शिविर और आगामी साहित्यिक संगोष्ठियों की तिथियाँ।', 'Green resolution meetings, blood donation drives & literary meets.')) ?>
        </p>
      </div>
      <div class="mt-4 pt-3 flex items-center text-primary font-label-sm text-label-sm font-semibold">
        <span><?= e(ps_text('कार्यक्रम विवरण देखें', 'Explore Events')) ?></span>
        <span class="material-symbols-outlined text-[16px] ml-1 group-hover:translate-x-1 transition-transform">arrow_forward</span>
      </div>
    </a>
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
