<?php
declare(strict_types=1);

$items = $items ?? [];
$root = realpath(__DIR__ . '/../..') ?: dirname(__DIR__, 2);
$clips = array_values(array_filter($items, function($i) use ($root) {
    $img = trim($i['image'] ?? '');
    if ($img === '') return false;
    if (preg_match('#^https?://#i', $img)) return true;
    return file_exists($root . '/' . ltrim($img, '/'));
}));
$contactPhone = $settings['phone'] ?? '+91 9919007190';
$contactEmail = $settings['email'] ?? 'press@pradeepsarang.in';
$spotlightClip = !empty($clips) ? $clips[0] : null;
?>

<div class="flex flex-col w-full">
<!-- Breadcrumb & Top Banner -->
<section class="relative w-full bg-soft-meadow overflow-hidden py-space-2xl md:py-space-3xl border-b border-border-warm">
  <div class="max-w-container-max mx-auto px-4 sm:px-8 relative z-10">
    <!-- Breadcrumb -->
    <nav aria-label="Breadcrumb" class="flex items-center gap-2 font-label-md text-label-md text-text-muted mb-space-sm">
      <a class="hover:text-primary transition-colors flex items-center gap-1" data-path="home" href="<?= e(base_url('/')) ?>">
        <span class="material-symbols-outlined text-[16px]">home</span>
        <span><?= e(ps_text('गृह (Home)', 'Home')) ?></span>
      </a>
      <span class="opacity-40">/</span>
      <span class="text-deep-forest font-semibold"><?= e(ps_text('प्रेस एवं मीडिया कवरेज (Press & Media Coverage)', 'Press & Media Coverage')) ?></span>
    </nav>

    <!-- Editorial Header -->
    <div class="max-w-4xl">
      <div class="inline-flex items-center gap-2 bg-primary-fixed/40 text-deep-forest px-3.5 py-1 rounded-full font-label-sm text-label-sm mb-space-sm border border-border-warm font-semibold">
        <span class="material-symbols-outlined text-[15px] text-primary-container" style="font-variation-settings: 'FILL' 1;">newspaper</span>
        <span><?= e(ps_text('प्रेस मान्यता एवं जन-सरोकारों की गूंज', 'Press Recognition & Public Impact')) ?></span>
      </div>
      <h1 class="font-display-hero text-headline-lg md:text-display-hero text-deep-forest leading-tight tracking-tight font-bold">
        <?= ps_text('अखबारों के पन्नों में जनसेवा की दास्तान — <span class="text-primary-container">मीडिया में प्रदीप सारंग</span>', 'Tales of Service in Press Pages — <span class="text-primary-container">Pradeep Sarang in Media</span>') ?>
      </h1>
      <p class="font-body-lg text-body-lg text-text-muted mt-space-sm max-w-3xl leading-relaxed">
        <?= e(ps_text('चार दशकों से पर्यावरण, अवधी संस्कृति, गौरैया संरक्षण और सामाजिक सरोकारों को राष्ट्रीय व क्षेत्रीय समाचार पत्रों ने प्रमुखता से प्रकाशित कर जन-आंदोलन का रूप दिया।', 'For four decades, national and regional newspapers have featured environmental protection, Awadhi culture, bird conservation, and social initiatives.')) ?>
      </p>
    </div>

    <!-- Filter Tabs Bar -->
    <div class="mt-space-xl flex items-center gap-2 overflow-x-auto pb-2 -mx-4 px-4 sm:mx-0 sm:px-0 sm:flex-wrap shrink-0 cursor-grab" id="media-filters">
      <button type="button" data-filter="all" class="filter-btn active px-4 py-2 rounded-full bg-deep-forest text-pure-white font-label-md text-label-md transition-all shadow-sm">
        <?= e(ps_text('सभी कतरनें (All)', 'All Clippings')) ?>
      </button>
      <button type="button" data-filter="newspaper" class="filter-btn px-4 py-2 rounded-full bg-pure-white text-deep-forest border border-border-warm hover:bg-soft-meadow font-label-md text-label-md transition-all">
        <?= e(ps_text('दैनिक समाचार पत्र (Newspapers)', 'Newspapers')) ?>
      </button>
      <button type="button" data-filter="environment" class="filter-btn px-4 py-2 rounded-full bg-pure-white text-deep-forest border border-border-warm hover:bg-soft-meadow font-label-md text-label-md transition-all">
        <?= e(ps_text('पर्यावरण व ग्रीन गैंग (Environment)', 'Environment & Green Gang')) ?>
      </button>
      <button type="button" data-filter="literature" class="filter-btn px-4 py-2 rounded-full bg-pure-white text-deep-forest border border-border-warm hover:bg-soft-meadow font-label-md text-label-md transition-all">
        <?= e(ps_text('अवधी साहित्य व संस्कृति (Literature)', 'Awadhi Literature')) ?>
      </button>
      <button type="button" data-filter="broadcast" class="filter-btn px-4 py-2 rounded-full bg-pure-white text-deep-forest border border-border-warm hover:bg-soft-meadow font-label-md text-label-md transition-all">
        <?= e(ps_text('टीवी व डिजिटल साक्षात्कार (Broadcast)', 'Broadcast & Interviews')) ?>
      </button>
      <button type="button" data-filter="honors" class="filter-btn px-4 py-2 rounded-full bg-pure-white text-deep-forest border border-border-warm hover:bg-soft-meadow font-label-md text-label-md transition-all">
        <?= e(ps_text('सम्मान व राष्ट्रीय पर्व (Honors & NSS)', 'Honors & Archives')) ?>
      </button>
    </div>
  </div>
</section>

<!-- Metrics Ribbon -->
<section class="w-full bg-deep-forest text-pure-white py-space-lg px-4 sm:px-8 shadow-sm">
  <div class="max-w-container-max mx-auto grid grid-cols-2 lg:grid-cols-4 gap-6">
    <div class="flex items-center gap-3.5">
      <div class="w-12 h-12 rounded-xl bg-surface-container-lowest/10 flex items-center justify-center text-primary-fixed">
        <span class="material-symbols-outlined text-[26px]">menu_book</span>
      </div>
      <div>
        <div class="font-headline-sm text-headline-sm font-bold text-primary-fixed">100+</div>
        <div class="font-body-sm text-body-sm text-surface-container-high"><?= e(ps_text('राष्ट्रीय व प्रादेशिक समाचार पत्र', 'National & Regional Dailies')) ?></div>
      </div>
    </div>
    <div class="flex items-center gap-3.5">
      <div class="w-12 h-12 rounded-xl bg-surface-container-lowest/10 flex items-center justify-center text-tertiary-fixed">
        <span class="material-symbols-outlined text-[26px]">history_edu</span>
      </div>
      <div>
        <div class="font-headline-sm text-headline-sm font-bold text-tertiary-fixed">35+ <?= e(ps_text('वर्ष', 'Years')) ?></div>
        <div class="font-body-sm text-body-sm text-surface-container-high"><?= e(ps_text('निरंतर मीडिया दस्तावेजीकरण (1987-)', 'Continuous Documentation (1987-)')) ?></div>
      </div>
    </div>
    <div class="flex items-center gap-3.5">
      <div class="w-12 h-12 rounded-xl bg-surface-container-lowest/10 flex items-center justify-center text-primary-fixed">
        <span class="material-symbols-outlined text-[26px]">article</span>
      </div>
      <div>
        <div class="font-headline-sm text-headline-sm font-bold text-primary-fixed">20+</div>
        <div class="font-body-sm text-body-sm text-surface-container-high"><?= e(ps_text('विशेष संपादकीय लेख व भेंटवार्ता', 'Special Editorials & Features')) ?></div>
      </div>
    </div>
    <div class="flex items-center gap-3.5">
      <div class="w-12 h-12 rounded-xl bg-surface-container-lowest/10 flex items-center justify-center text-tertiary-fixed">
        <span class="material-symbols-outlined text-[26px]">podcasts</span>
      </div>
      <div>
        <div class="font-headline-sm text-headline-sm font-bold text-tertiary-fixed">50+</div>
        <div class="font-body-sm text-body-sm text-surface-container-high"><?= e(ps_text('टीवी व आकाशवाणी परिचर्चा प्रसारण', 'TV & All India Radio Shows')) ?></div>
      </div>
    </div>
  </div>
</section>

<?php if ($spotlightClip): ?>
<!-- Featured Archival Showcase Spotlight -->
<section class="w-full py-space-3xl px-4 sm:px-8 bg-cream-canvas">
  <div class="max-w-container-max mx-auto">
    <div class="flex flex-col md:flex-row md:items-end justify-between mb-space-xl gap-4">
      <div>
        <div class="flex items-center gap-2 font-label-md text-label-md text-secondary uppercase tracking-wider mb-1 font-semibold">
          <span class="material-symbols-outlined text-[18px]">verified</span>
          <span><?= e(ps_text('विशिष्ट मुख्य कवरेज (Featured Press Archive)', 'Featured Press Archive')) ?></span>
        </div>
        <h2 class="font-headline-md text-headline-md text-deep-forest font-bold">
          <?= e($spotlightClip['title'] ?: ps_text('समाचार पत्रों में जनसेवा एवं पर्यावरण चेतना की गूंज', 'Public Service & Environmental Drives in Press')) ?>
        </h2>
      </div>
      <div class="flex items-center gap-2 text-text-muted font-body-sm text-body-sm">
        <span class="material-symbols-outlined text-[16px] text-primary-container">archive</span>
        <span><?= e(ps_text('अभिलेख सं.: PS/MED/' . ($spotlightClip['id'] ?? '1'), 'Archive Ref: PS/MED/' . ($spotlightClip['id'] ?? '1'))) ?></span>
      </div>
    </div>

    <!-- Spotlight Editorial Card -->
    <div class="bg-surface-container-lowest rounded-2xl shadow-sm border border-border-warm overflow-hidden grid grid-cols-1 lg:grid-cols-12 gap-0">
      <!-- Visual Column -->
      <div class="lg:col-span-6 relative bg-surface-container-low min-h-[380px] lg:min-h-full flex flex-col justify-between p-6 sm:p-8">
        <img src="<?= e(base_url($spotlightClip['image'])) ?>" alt="<?= e($spotlightClip['title'] ?: ps_text('समाचार पत्र कवरेज', 'Newspaper Coverage')) ?>" class="absolute inset-0 w-full h-full object-cover mix-blend-multiply opacity-40">
        <div class="relative z-10 flex items-center justify-between">
          <span class="px-3 py-1 rounded-full bg-primary-container text-pure-white font-label-sm text-label-sm shadow-sm font-semibold">
            <?= e(ps_text('समाचार पत्र विशेष फीचर', 'Newspaper Feature')) ?>
          </span>
          <span class="font-label-sm text-label-sm text-text-muted bg-pure-white/90 px-2.5 py-0.5 rounded shadow-sm font-semibold">
            <?= e(date('d M Y', strtotime($spotlightClip['created_at'] ?? 'now'))) ?>
          </span>
        </div>
        <div class="relative z-10 bg-pure-white/95 rounded-xl p-5 shadow-sm mt-12 backdrop-blur-sm border border-border-warm">
          <div class="flex items-center gap-2 text-secondary font-label-sm text-label-sm font-semibold mb-1">
            <span class="material-symbols-outlined text-[16px]">format_quote</span>
            <span><?= e(ps_text('अखबार की मूल सुर्खी', 'Original Press Headline')) ?></span>
          </div>
          <p class="font-headline-sm text-headline-sm text-deep-forest leading-snug font-bold">
            <?= e($spotlightClip['title'] ?: ps_text('‘ग्रीन मॉर्निंग’ के जनक: बाराबंकी से उठी पर्यावरण चेतना की आवाज़', 'Green Morning Movement: Environmental Consciousness in Media')) ?>
          </p>
        </div>
        <div class="relative z-10 flex items-center gap-3 pt-4 text-deep-forest font-label-sm text-label-sm">
          <span class="inline-flex items-center gap-1 font-semibold">
            <span class="material-symbols-outlined text-[15px] text-primary">location_on</span>
            <?= e(ps_text('बाराबंकी ब्यूरो (उ.प्र.)', 'Barabanki Bureau (U.P.)')) ?>
          </span>
          <span class="opacity-30">•</span>
          <span><?= e(ps_text('ऐतिहासिक प्रेस पुरालेख', 'Historical Press Archive')) ?></span>
        </div>
      </div>

      <!-- Text / Context Column -->
      <div class="lg:col-span-6 p-6 sm:p-10 flex flex-col justify-between bg-surface-container-lowest">
        <div>
          <div class="flex items-center gap-2 mb-3 font-label-md text-label-md text-primary-container font-semibold">
            <span class="material-symbols-outlined text-[18px]">auto_stories</span>
            <span><?= e(ps_text('संपादकीय समीक्षा एवं सारांश', 'Editorial Overview')) ?></span>
          </div>
          <p class="font-body-lg text-body-lg text-on-surface leading-relaxed mb-4">
            <?= e(ps_text('ग्रामीण जनजीवन में सुबह के सामान्य अभिवादन को धरती के प्रति आदर में बदलने वाले प्रदीप सारंग के ‘ग्रीन मॉर्निंग’ अभियान ने उत्तर प्रदेश के सैकड़ों गाँवों को प्रेरित किया है। रिपोर्ट में रेखांकित किया गया कि कैसे व्यक्तिगत संकल्प 50,000+ पौधों की जीवंत हरियाली में रूपांतरित हुआ।', 'Pradeep Sarang\'s Green Morning movement transformed ordinary morning greetings into ecological consciousness across hundreds of villages.')) ?>
          </p>
          <div class="bg-soft-meadow rounded-xl p-4 mb-6 border border-border-warm">
            <p class="font-quote-editorial text-body-md text-deep-forest italic">
              <?= ps_text('"प्रदीप सारंग ने पर्यावरण संरक्षण को सरकारी फाइलों से निकाल कर जन-मानस की रोजमर्रा की बोली और संस्कृति का अभिन्न हिस्सा बना दिया।"', '"Pradeep Sarang took environmental protection out of government files into everyday culture."') ?>
            </p>
            <div class="mt-2 font-label-sm text-label-sm text-text-muted">
              <?= e(ps_text('— मुख्य विकास अधिकारी (CDO) द्वारा प्रेस वक्तव्य', '— Press Statement by Chief Development Officer (CDO)')) ?>
            </div>
          </div>
          <div class="grid grid-cols-2 gap-4 py-2 mb-4 font-body-sm text-body-sm text-on-surface-variant">
            <div class="flex items-center gap-2">
              <span class="material-symbols-outlined text-primary text-[18px]">check_circle</span>
              <span>50,000+ <?= e(ps_text('पौधे संरक्षित', 'Trees Protected')) ?></span>
            </div>
            <div class="flex items-center gap-2">
              <span class="material-symbols-outlined text-primary text-[18px]">check_circle</span>
              <span>120+ <?= e(ps_text('ग्रीन ग्राम पंचायतें', 'Green Panchayats')) ?></span>
            </div>
            <div class="flex items-center gap-2">
              <span class="material-symbols-outlined text-primary text-[18px]">check_circle</span>
              <span><?= e(ps_text('ग्रीन गैंग में 1,500+ युवा', '1,500+ Green Gang Youth')) ?></span>
            </div>
            <div class="flex items-center gap-2">
              <span class="material-symbols-outlined text-primary text-[18px]">check_circle</span>
              <span><?= e(ps_text('जल-पात्र \'सकोरा\' वितरण अभियान', 'Bird Water Bowl Drive')) ?></span>
            </div>
          </div>
        </div>
        <!-- Actions -->
        <div class="flex flex-wrap items-center gap-3 pt-4">
          <a href="<?= e(base_url($spotlightClip['image'])) ?>" data-ps-lightbox data-caption="<?= e($spotlightClip['title'] ?: ps_text('समाचार पत्र की कतरन', 'Newspaper Clipping')) ?>" class="px-5 py-2.5 rounded-xl bg-primary-container text-pure-white hover:bg-deep-forest font-label-md text-label-md transition-colors flex items-center gap-2 shadow-sm font-semibold">
            <span class="material-symbols-outlined text-[18px]">zoom_in</span>
            <span><?= e(ps_text('पूरी कतरन देखें (Open Lightbox)', 'Open Full Clipping')) ?></span>
          </a>
        </div>
      </div>
    </div>
  </div>
</section>
<?php endif; ?>

<!-- Interactive Newspaper Clippings Grid -->
<section class="w-full py-space-3xl px-4 sm:px-8 bg-soft-meadow border-t border-border-warm">
  <div class="max-w-container-max mx-auto">
    <div class="flex flex-col sm:flex-row sm:items-end justify-between mb-space-2xl gap-4">
      <div>
        <span class="font-label-md text-label-md text-primary-container font-semibold uppercase tracking-wider">
          <?= e(ps_text('अभिलेखीय समाचार संग्रह', 'Archival Press Collection')) ?>
        </span>
        <h2 class="font-headline-md text-headline-md text-deep-forest font-bold mt-1">
          <?= e(ps_text('प्रमुख समाचार पत्रों में प्रकाशित आलेख एवं कतरनें', 'Articles & Newspaper Cutouts in Media')) ?>
        </h2>
        <p class="font-body-md text-body-md text-text-muted mt-1">
          <?= e(ps_text('विगत दशकों में राष्ट्रीय व क्षेत्रीय पत्रिकाओं में प्रकाशित प्रामाणिक प्रेस रिपोर्ट', 'Authentic press coverage published across national and regional newspapers.')) ?>
        </p>
      </div>
    </div>

    <!-- Grid Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6" id="clipping-grid">
      <?php if (!empty($clips)): foreach ($clips as $idx => $clip): ?>
        <?php $cap = trim($clip['title'] ?? '') ?: ps_text('समाचार पत्र की कतरन', 'Newspaper Clipping'); ?>
        <article class="clipping-card group bg-surface-container-lowest rounded-2xl p-5 shadow-sm border border-border-warm hover:shadow-md transition-all flex flex-col justify-between" data-category="newspaper">
          <div>
            <div class="relative overflow-hidden rounded-xl bg-surface-container aspect-[16/10] mb-4 border border-border-warm">
              <img src="<?= e(base_url($clip['image'])) ?>" alt="<?= e($cap) ?>" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
              <span class="absolute top-2.5 left-2.5 bg-tertiary-container text-pure-white px-2.5 py-0.5 rounded font-label-sm text-label-sm shadow-sm font-semibold">
                <?= e(ps_text('प्रेस कतरन', 'Press Clipping')) ?>
              </span>
            </div>
            <div class="flex items-center justify-between text-text-muted font-label-sm text-label-sm mb-2">
              <span><?= e(date('d M Y', strtotime($clip['created_at'] ?? 'now'))) ?></span>
              <span><?= e(ps_text('समाचार पत्र', 'Newspaper')) ?></span>
            </div>
            <h3 class="font-headline-sm text-headline-sm text-deep-forest leading-snug mb-2 group-hover:text-primary transition-colors font-bold">
              <?= e($cap) ?>
            </h3>
          </div>
          <div class="pt-3 flex items-center justify-between border-t border-border-warm">
            <span class="px-2 py-0.5 rounded bg-surface-container text-deep-forest font-label-sm text-label-sm font-semibold"><?= e(ps_text('मीडिया कवरेज', 'Media')) ?></span>
            <a href="<?= e(base_url($clip['image'])) ?>" data-ps-lightbox data-caption="<?= e($cap) ?>" class="text-primary-container font-label-sm text-label-sm font-semibold hover:text-deep-forest flex items-center gap-1">
              <span><?= e(ps_text('कतरन देखें', 'View Image')) ?></span>
              <span class="material-symbols-outlined text-[15px]">arrow_forward</span>
            </a>
          </div>
        </article>
      <?php endforeach; else: ?>
        <div class="col-span-full py-16 text-center bg-surface-container-lowest rounded-2xl border border-border-warm p-8">
          <span class="material-symbols-outlined text-5xl text-text-muted mb-3 inline-block">newspaper</span>
          <h3 class="font-headline-sm text-headline-sm text-deep-forest font-bold mb-2">
            <?= e(ps_text('वर्तमान में कोई प्रेस कतरन उपलब्ध नहीं है', 'No Press Clippings Available')) ?>
          </h3>
          <p class="font-body-md text-body-md text-text-muted max-w-md mx-auto">
            <?= e(ps_text('डेटाबेस में नई प्रेस कतरनें जोड़े जाने पर वे यहाँ प्रदर्शित होंगी।', 'Newspaper clippings stored in database will appear here once added.')) ?>
          </p>
        </div>
      <?php endif; ?>
    </div>
  </div>
</section>

<!-- Broadcast & Digital Interviews -->
<section class="w-full py-space-3xl px-4 sm:px-8 bg-cream-canvas border-t border-border-warm">
  <div class="max-w-container-max mx-auto">
    <div class="mb-space-2xl">
      <div class="flex items-center gap-2 font-label-md text-label-md text-secondary uppercase tracking-wider mb-1 font-semibold">
        <span class="material-symbols-outlined text-[18px]">mic</span>
        <span><?= e(ps_text('श्रव्य एवं दृश्य प्रसारण (Broadcast & Audio-Visual Media)', 'Broadcast & Audio-Visual Media')) ?></span>
      </div>
      <h2 class="font-headline-md text-headline-md text-deep-forest font-bold">
        <?= e(ps_text('दूरदर्शन, आकाशवाणी और डिजिटल मंचों पर विशेष संवाद', 'Special Broadcasts on Doordarshan & All India Radio')) ?>
      </h2>
      <p class="font-body-md text-body-md text-text-muted mt-1">
        <?= e(ps_text('प्रसार भारती और प्रमुख संचार माध्यमों पर प्रदीप सारंग के वैचारिक उद्बोधन और वार्ताएं', 'Key addresses and discussions broadcast across Prasar Bharati networks.')) ?>
      </p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
      <!-- Broadcast 1 -->
      <div class="bg-surface-container-lowest rounded-2xl p-6 shadow-sm border border-border-warm flex flex-col justify-between">
        <div>
          <div class="flex items-center justify-between mb-4">
            <span class="px-3 py-1 rounded-full bg-surface-container text-deep-forest font-label-sm text-label-sm font-semibold">
              <?= e(ps_text('आकाशवाणी लखनऊ', 'All India Radio Lucknow')) ?>
            </span>
            <span class="text-text-muted font-label-sm text-label-sm flex items-center gap-1">
              <span class="material-symbols-outlined text-[15px] text-tertiary">schedule</span>
              <span>25 <?= e(ps_text('मिनट प्रसारण', 'min broadcast')) ?></span>
            </span>
          </div>
          <!-- Audio Player Mockup -->
          <div class="bg-soft-meadow rounded-xl p-4 mb-5 border border-border-warm">
            <div class="flex items-center gap-3 mb-2">
              <div class="w-10 h-10 rounded-full bg-primary-container text-pure-white flex items-center justify-center">
                <span class="material-symbols-outlined text-[20px]">radio</span>
              </div>
              <div>
                <div class="font-label-sm text-label-sm text-text-muted"><?= e(ps_text('प्राइम टाइम वाणी कार्यक्रम', 'AIR Prime Time')) ?></div>
                <div class="font-title-md text-title-md text-deep-forest font-semibold"><?= e(ps_text('अवधी लोक-संस्कृति विशेष', 'Awadhi Culture Special')) ?></div>
              </div>
            </div>
            <div class="w-full bg-surface-container-high rounded-full h-1.5 my-2 overflow-hidden">
              <div class="bg-primary-container h-full w-2/3"></div>
            </div>
            <div class="flex items-center justify-between text-label-sm font-label-sm text-text-muted">
              <span>16:40</span>
              <span>25:00</span>
            </div>
          </div>
          <h3 class="font-title-lg text-title-lg text-deep-forest mb-2 font-bold">
            <?= e(ps_text('"अवधी लोक-संस्कृति और सारंग-कुंडलियों पर विशेष परिचर्चा"', '"Discussion on Awadhi Folk Culture & Sarang-Kundaliyan"')) ?>
          </h3>
          <p class="font-body-sm text-body-sm text-on-surface-variant mb-4">
            <?= e(ps_text('आकाशवाणी पर अवधी भाषा की मिठास, छंद विधान और ग्रामीण लोकरंग के संरक्षण पर सारंग जी का सारगर्भित वक्तव्य।', 'Discussion on AIR regarding Awadhi linguistic preservation & folk metres.')) ?>
          </p>
        </div>
        <button type="button" onclick="alert('<?= e(ps_text('आकाशवाणी रिकॉर्डिंग शीघ्र स्ट्रीम हेतु उपलब्ध होगी।', 'Audio recording will be available soon.')) ?>');" class="w-full py-2.5 rounded-xl bg-surface-container hover:bg-surface-container-high text-deep-forest font-label-md text-label-md transition-colors flex items-center justify-center gap-2 border border-border-warm">
          <span class="material-symbols-outlined text-[18px]">play_circle</span>
          <span><?= e(ps_text('ऑडियो रिकॉर्डिंग सुनें', 'Listen to Audio')) ?></span>
        </button>
      </div>

      <!-- Broadcast 2 -->
      <div class="bg-surface-container-lowest rounded-2xl p-6 shadow-sm border border-border-warm flex flex-col justify-between">
        <div>
          <div class="flex items-center justify-between mb-4">
            <span class="px-3 py-1 rounded-full bg-surface-container text-deep-forest font-label-sm text-label-sm font-semibold">
              <?= e(ps_text('दूरदर्शन उत्तर प्रदेश', 'Doordarshan UP')) ?>
            </span>
            <span class="text-text-muted font-label-sm text-label-sm flex items-center gap-1">
              <span class="material-symbols-outlined text-[15px] text-tertiary">tv</span>
              <span><?= e(ps_text('डीडी यूपी विशेष', 'DD UP Feature')) ?></span>
            </span>
          </div>
          <div class="relative overflow-hidden rounded-xl bg-gradient-to-br from-forest-canopy to-deep-forest aspect-video mb-5 group border border-border-warm flex items-center justify-center p-6 text-center">
            <div class="flex flex-col items-center gap-2">
              <div class="w-12 h-12 rounded-full bg-pure-white/15 text-primary-fixed flex items-center justify-center backdrop-blur-sm border border-pure-white/20">
                <span class="material-symbols-outlined text-[26px]">play_arrow</span>
              </div>
              <span class="text-pure-white/90 font-label-sm text-label-sm font-semibold tracking-wide"><?= e(ps_text('दूरदर्शन विशेष ग्राउंड रिपोर्ट', 'Doordarshan Ground Report')) ?></span>
            </div>
          </div>
          <h3 class="font-title-lg text-title-lg text-deep-forest mb-2 font-bold">
            <?= e(ps_text('"\'ग्रीन गैंग\' और पर्यावरण संरक्षण की ज़मीनी कहानी"', '"Ground Reality of Green Gang Movement"')) ?>
          </h3>
          <p class="font-body-sm text-body-sm text-on-surface-variant mb-4">
            <?= e(ps_text('कैसे ग्रामीण युवाओं की टोली ने बंजर भूमि को उपवन में बदला — दूरदर्शन की 18 मिनट की विशेष ग्राउंड रिपोर्ट।', '18 minute Doordarshan ground report on how Green Gang converted barren lands into green sanctuaries.')) ?>
          </p>
        </div>
        <button type="button" onclick="alert('<?= e(ps_text('दूरदर्शन वीडियो प्रसारण शीघ्र स्ट्रीम हेतु उपलब्ध होगा।', 'DD UP video feature will be streamable soon.')) ?>');" class="w-full py-2.5 rounded-xl bg-surface-container hover:bg-surface-container-high text-deep-forest font-label-md text-label-md transition-colors flex items-center justify-center gap-2 border border-border-warm">
          <span class="material-symbols-outlined text-[18px]">videocam</span>
          <span><?= e(ps_text('वीडियो साक्षात्कार देखें', 'Watch Video Feature')) ?></span>
        </button>
      </div>

      <!-- Broadcast 3 -->
      <div class="bg-surface-container-lowest rounded-2xl p-6 shadow-sm border border-border-warm flex flex-col justify-between">
        <div>
          <div class="flex items-center justify-between mb-4">
            <span class="px-3 py-1 rounded-full bg-surface-container text-deep-forest font-label-sm text-label-sm font-semibold">
              <?= e(ps_text('डिजिटल पॉडकास्ट', 'Digital Podcast')) ?>
            </span>
            <span class="text-text-muted font-label-sm text-label-sm flex items-center gap-1">
              <span class="material-symbols-outlined text-[15px] text-tertiary">graphic_eq</span>
              <span><?= e(ps_text('विशेष वृत्तचित्र', 'Documentary')) ?></span>
            </span>
          </div>
          <div class="relative overflow-hidden rounded-xl bg-gradient-to-br from-deep-forest via-primary-container to-earth-brown aspect-video mb-5 group border border-border-warm flex items-center justify-center p-6 text-center">
            <div class="flex flex-col items-center gap-2">
              <div class="w-12 h-12 rounded-full bg-pure-white/15 text-tertiary-fixed flex items-center justify-center backdrop-blur-sm border border-pure-white/20">
                <span class="material-symbols-outlined text-[26px]">headphones</span>
              </div>
              <span class="text-pure-white/90 font-label-sm text-label-sm font-semibold tracking-wide"><?= e(ps_text('डिजिटल पॉडकास्ट एवं वृत्तचित्र', 'Digital Podcast & Documentary')) ?></span>
            </div>
          </div>
          <h3 class="font-title-lg text-title-lg text-deep-forest mb-2 font-bold">
            <?= e(ps_text('"35 वर्षों की निःस्वार्थ सेवा यात्रा — प्रदीप सारंग के साथ खुला संवाद"', '"35 Years of Public Service — In Dialogue with Pradeep Sarang"')) ?>
          </h3>
          <p class="font-body-sm text-body-sm text-on-surface-variant mb-4">
            <?= e(ps_text('1988 के राष्ट्रीय सेवा शिविर से 2024 की ग्रीन मॉर्निंग तक के संघर्ष, संकल्प और अवधी साहित्य सृजन का सजीव आख्यान।', 'In-depth podcast recounting struggles, tree planting campaigns & Awadhi writing.')) ?>
          </p>
        </div>
        <button type="button" onclick="alert('<?= e(ps_text('पॉडकास्ट कड़ी शीघ्र उपलब्ध होगी।', 'Podcast link will be available soon.')) ?>');" class="w-full py-2.5 rounded-xl bg-surface-container hover:bg-surface-container-high text-deep-forest font-label-md text-label-md transition-colors flex items-center justify-center gap-2 border border-border-warm">
          <span class="material-symbols-outlined text-[18px]">podcasts</span>
          <span><?= e(ps_text('पूरा पॉडकास्ट सुनें', 'Listen to Podcast')) ?></span>
        </button>
      </div>
    </div>
  </div>
</section>

<!-- Press Kit & Media Resources -->
<section class="w-full py-space-3xl px-4 sm:px-8 bg-soft-meadow border-t border-border-warm">
  <div class="max-w-container-max mx-auto">
    <div class="bg-surface-container-lowest rounded-2xl p-6 sm:p-10 shadow-sm border border-border-warm">
      <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
        <!-- Left: Information -->
        <div class="lg:col-span-6">
          <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-surface-container text-deep-forest font-label-sm text-label-sm mb-3 font-semibold border border-border-warm">
            <span class="material-symbols-outlined text-[16px] text-primary-container">download_for_offline</span>
            <span><?= e(ps_text('पत्रकार एवं मीडिया बंधुओं हेतु सामग्री', 'Press & Journalist Resources')) ?></span>
          </div>
          <h2 class="font-headline-md text-headline-md text-deep-forest mb-3 font-bold">
            <?= e(ps_text('आधिकारिक प्रेस किट एवं मीडिया संसाधन', 'Official Press Kit & Media Resources')) ?>
          </h2>
          <p class="font-body-md text-body-md text-on-surface-variant mb-6 leading-relaxed">
            <?= e(ps_text('समाचार संपादकों, शोधकर्ताओं एवं पत्रकारों के लिए आधिकारिक जीवन-वृत्त, उच्च-रिज़ॉल्यूशन छायाचित्र एवं अभियान संबंधी अधिकृत आंकड़े उपलब्ध हैं।', 'Official biography, high-resolution photographs and campaign factsheets for editors and researchers.')) ?>
          </p>

          <div class="bg-surface-container-low rounded-xl p-5 mb-6 border border-border-warm">
            <h4 class="font-title-md text-title-md text-deep-forest mb-2 font-bold flex items-center gap-2">
              <span class="material-symbols-outlined text-[20px] text-primary-container">contact_phone</span>
              <span><?= e(ps_text('प्रेस संपर्क एवं मीडिया पूछताछ डेस्क', 'Press Contact Desk')) ?></span>
            </h4>
            <p class="font-body-sm text-body-sm text-text-muted mb-3">
              <?= e(ps_text('साक्षात्कार, आलेख अनुमति अथवा वृत्तचित्र सहयोग हेतु सीधे संपर्क करें:', 'For interviews, article permissions or documentary assistance:')) ?>
            </p>
            <div class="space-y-1.5 font-body-sm text-body-sm">
              <div class="flex items-center gap-2 text-deep-forest">
                <span class="material-symbols-outlined text-[16px] text-primary">call</span>
                <a href="tel:<?= e(preg_replace('/[^0-9+]/', '', $contactPhone)) ?>" class="hover:underline font-semibold"><?= e($contactPhone) ?></a>
                <span class="text-text-muted">(<?= e(ps_text('सारंग मीडिया सेल', 'Media Cell')) ?>)</span>
              </div>
              <div class="flex items-center gap-2 text-deep-forest">
                <span class="material-symbols-outlined text-[16px] text-primary">mail</span>
                <a href="mailto:<?= e($contactEmail) ?>" class="hover:underline"><?= e($contactEmail) ?></a>
              </div>
            </div>
          </div>
        </div>

        <!-- Right: Download Cards -->
        <div class="lg:col-span-6 space-y-3.5">
          <!-- Resource 1 -->
          <div class="p-4 rounded-xl bg-surface-container hover:bg-surface-container-high transition-colors flex items-center justify-between gap-4 border border-border-warm">
            <div class="flex items-center gap-3">
              <div class="w-11 h-11 rounded-lg bg-primary-container text-pure-white flex items-center justify-center">
                <span class="material-symbols-outlined text-[22px]">picture_as_pdf</span>
              </div>
              <div>
                <div class="font-title-md text-title-md text-deep-forest font-bold"><?= e(ps_text('आधिकारिक जीवन-परिचय (Official Bio)', 'Official Biography (PDF)')) ?></div>
                <div class="font-body-sm text-body-sm text-text-muted">PDF • 4.2 MB • <?= e(ps_text('हिंदी व अंग्रेजी संस्करण', 'Hindi & English Edition')) ?></div>
              </div>
            </div>
            <a href="#" onclick="alert('<?= e(ps_text('आधिकारिक बायो डाउनलोड लिंक अद्यतन हो रहा है।', 'Download link updating.')) ?>'); return false;" class="p-2.5 rounded-lg bg-surface-container-lowest text-deep-forest hover:bg-primary-container hover:text-pure-white transition-colors border border-border-warm" title="Download">
              <span class="material-symbols-outlined text-[20px]">download</span>
            </a>
          </div>

          <!-- Resource 2 -->
          <div class="p-4 rounded-xl bg-surface-container hover:bg-surface-container-high transition-colors flex items-center justify-between gap-4 border border-border-warm">
            <div class="flex items-center gap-3">
              <div class="w-11 h-11 rounded-lg bg-secondary text-pure-white flex items-center justify-center">
                <span class="material-symbols-outlined text-[22px]">folder_zip</span>
              </div>
              <div>
                <div class="font-title-md text-title-md text-deep-forest font-bold"><?= e(ps_text('उच्च-रिज़ॉल्यूशन प्रेस फोटोग्राफ्स (Archive ZIP)', 'High-Res Press Photos (ZIP)')) ?></div>
                <div class="font-body-sm text-body-sm text-text-muted">ZIP • 38.5 MB • <?= e(ps_text('24 अधिकृत चित्र व कतरनें', '24 High Res Photos & Scans')) ?></div>
              </div>
            </div>
            <a href="#" onclick="alert('<?= e(ps_text('प्रेस फोटो किट डाउनलोड लिंक अद्यतन हो रहा है।', 'Photo kit download link updating.')) ?>'); return false;" class="p-2.5 rounded-lg bg-surface-container-lowest text-deep-forest hover:bg-primary-container hover:text-pure-white transition-colors border border-border-warm" title="Download">
              <span class="material-symbols-outlined text-[20px]">download</span>
            </a>
          </div>

          <!-- Resource 3 -->
          <div class="p-4 rounded-xl bg-surface-container hover:bg-surface-container-high transition-colors flex items-center justify-between gap-4 border border-border-warm">
            <div class="flex items-center gap-3">
              <div class="w-11 h-11 rounded-lg bg-tertiary text-pure-white flex items-center justify-center">
                <span class="material-symbols-outlined text-[22px]">insights</span>
              </div>
              <div>
                <div class="font-title-md text-title-md text-deep-forest font-bold"><?= e(ps_text('अभियान आँकड़े एवं प्रभाव रिपोर्ट (2024-25)', 'Campaign Impact Report')) ?></div>
                <div class="font-body-sm text-body-sm text-text-muted">PDF • 8.1 MB • <?= e(ps_text('50k वृक्षारोपण व जल-संरक्षण फैक्टशीट', '50k Reforestation Factsheet')) ?></div>
              </div>
            </div>
            <a href="#" onclick="alert('<?= e(ps_text('प्रभाव रिपोर्ट डाउनलोड लिंक अद्यतन हो रहा है।', 'Impact report download link updating.')) ?>'); return false;" class="p-2.5 rounded-lg bg-surface-container-lowest text-deep-forest hover:bg-primary-container hover:text-pure-white transition-colors border border-border-warm" title="Download">
              <span class="material-symbols-outlined text-[20px]">download</span>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Cross Navigation Strip -->
<section class="w-full py-space-2xl px-4 sm:px-8 bg-cream-canvas border-t border-border-warm">
  <div class="max-w-container-max mx-auto">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
      <a href="<?= e(base_url('/volunteer')) ?>" data-path="green-gang" class="group p-6 rounded-2xl bg-surface-container-lowest shadow-sm border border-border-warm hover:shadow-md transition-all flex items-center justify-between">
        <div class="flex items-center gap-4">
          <div class="w-12 h-12 rounded-xl bg-primary-container text-pure-white flex items-center justify-center group-hover:scale-105 transition-transform">
            <span class="material-symbols-outlined text-[24px]">forest</span>
          </div>
          <div>
            <span class="font-label-sm text-label-sm text-primary font-semibold"><?= e(ps_text('अगला अनुभाग', 'Next Section')) ?></span>
            <h4 class="font-title-md text-title-md text-deep-forest font-bold group-hover:text-primary transition-colors"><?= e(ps_text('ग्रीन गैंग कार्यदल', 'Green Gang Taskforce')) ?></h4>
          </div>
        </div>
        <span class="material-symbols-outlined text-deep-forest group-hover:translate-x-1 transition-transform">chevron_right</span>
      </a>

      <a href="<?= e(base_url('/portfolio')) ?>" data-path="literature" class="group p-6 rounded-2xl bg-surface-container-lowest shadow-sm border border-border-warm hover:shadow-md transition-all flex items-center justify-between">
        <div class="flex items-center gap-4">
          <div class="w-12 h-12 rounded-xl bg-tertiary text-pure-white flex items-center justify-center group-hover:scale-105 transition-transform">
            <span class="material-symbols-outlined text-[24px]">auto_stories</span>
          </div>
          <div>
            <span class="font-label-sm text-label-sm text-tertiary font-semibold"><?= e(ps_text('रचना संसार', 'Literary Works')) ?></span>
            <h4 class="font-title-md text-title-md text-deep-forest font-bold group-hover:text-tertiary transition-colors"><?= e(ps_text('अवधी साहित्य संग्रह', 'Awadhi Literature')) ?></h4>
          </div>
        </div>
        <span class="material-symbols-outlined text-deep-forest group-hover:translate-x-1 transition-transform">chevron_right</span>
      </a>

      <a href="<?= e(base_url('/events')) ?>" data-path="events" class="group p-6 rounded-2xl bg-surface-container-lowest shadow-sm border border-border-warm hover:shadow-md transition-all flex items-center justify-between">
        <div class="flex items-center gap-4">
          <div class="w-12 h-12 rounded-xl bg-secondary text-pure-white flex items-center justify-center group-hover:scale-105 transition-transform">
            <span class="material-symbols-outlined text-[24px]">calendar_month</span>
          </div>
          <div>
            <span class="font-label-sm text-label-sm text-secondary font-semibold"><?= e(ps_text('आगामी कार्यक्रम', 'Upcoming Events')) ?></span>
            <h4 class="font-title-md text-title-md text-deep-forest font-bold group-hover:text-secondary transition-colors"><?= e(ps_text('आयोजन एवं गतिविधियाँ', 'Events & Activities')) ?></h4>
          </div>
        </div>
        <span class="material-symbols-outlined text-deep-forest group-hover:translate-x-1 transition-transform">chevron_right</span>
      </a>
    </div>
  </div>
</section>

<script>
  (function() {
    const filterButtons = document.querySelectorAll('#media-filters .filter-btn');
    const cards = document.querySelectorAll('#clipping-grid .clipping-card');

    filterButtons.forEach(button => {
      button.addEventListener('click', () => {
        filterButtons.forEach(btn => {
          btn.classList.remove('active', 'bg-deep-forest', 'text-pure-white');
          btn.classList.add('bg-pure-white', 'text-deep-forest', 'border', 'border-border-warm');
        });

        button.classList.add('active', 'bg-deep-forest', 'text-pure-white');
        button.classList.remove('bg-pure-white', 'text-deep-forest', 'border', 'border-border-warm');

        const filter = button.getAttribute('data-filter');

        cards.forEach(card => {
          const category = card.getAttribute('data-category');
          if (filter === 'all' || category === filter || (filter === 'newspaper' && category !== '')) {
            card.style.display = 'flex';
          } else {
            card.style.display = 'none';
          }
        });
      });
    });
  })();
</script>
