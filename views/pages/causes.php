<?php
declare(strict_types=1);

$items = $items ?? [];
$phone = trim($settings['phone'] ?? '+91 9919007190');
$phoneClean = preg_replace('/[^+0-9]/', '', $phone);
?>

<div class="flex flex-col w-full">
  <!-- Top Breadcrumb & Hero Masthead -->
  <section class="relative w-full bg-soft-meadow overflow-hidden py-space-2xl md:py-space-3xl border-b border-border-warm">
    <!-- Earthen Ambient Background Accents -->
    <div class="absolute -top-24 -right-24 w-96 h-96 rounded-full bg-fresh-sprout/10 blur-3xl pointer-events-none"></div>
    <div class="absolute -bottom-24 -left-20 w-80 h-80 rounded-full bg-tertiary-fixed-dim/20 blur-3xl pointer-events-none"></div>

    <div class="max-w-container-max mx-auto px-4 sm:px-8 relative z-10">
      <!-- Breadcrumb Bar -->
      <nav aria-label="Breadcrumb" class="flex items-center gap-2 font-label-md text-label-md text-text-muted mb-space-sm">
        <a href="<?= e(base_url('/')) ?>" class="hover:text-primary transition-colors flex items-center gap-1">
          <span class="material-symbols-outlined text-[16px]">home</span>
          <span><?= e(ps_text('गृह (Home)', 'Home')) ?></span>
        </a>
        <span class="opacity-40">/</span>
        <span class="text-deep-forest font-semibold"><?= e(ps_text('प्रमुख जन-अभियान (Campaigns)', 'Campaigns & Initiatives')) ?></span>
      </nav>

      <!-- Asymmetrical Editorial Header Layout -->
      <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
        <div class="lg:col-span-8 flex flex-col items-start">
          <div class="inline-flex items-center gap-2 bg-primary-fixed/40 text-deep-forest px-3.5 py-1 rounded-full font-label-sm text-label-sm mb-space-sm border border-border-warm font-semibold">
            <span class="material-symbols-outlined text-[15px] text-primary-container" style="font-variation-settings: 'FILL' 1;">verified</span>
            <span><?= e(ps_text('चार दशकों की सतत ज़मीनी साधना (1987 — 2026)', 'Four Decades of Community Dedication (1987 — 2026)')) ?></span>
          </div>

          <h1 class="font-display-hero text-headline-lg md:text-display-hero text-deep-forest leading-tight tracking-tight font-bold">
            <?= ps_text('प्रमुख जन-अभियान एवं जन-सरोकार आंदोलन', 'Major Environmental & Cultural Movements') ?>
          </h1>

          <p class="font-body-lg text-body-lg text-text-muted mt-space-sm max-w-3xl leading-relaxed mb-6">
            <?= e(ps_text('प्रदीप सारंग द्वारा समाज के समग्र विकास, पर्यावरण संवर्धन, सांस्कृतिक अस्मिता व जन-चेतना हेतु संचालित सेवा-आधारित एवं जन-जागरूकता अभियान।', 'Ground-level initiatives led by Shri Pradeep Sarang for environmental protection, Awadhi heritage, and community empowerment.')) ?>
          </p>

          <div class="p-4 bg-cream-canvas rounded-xl shadow-sm border border-border-warm max-w-2xl mb-8 relative">
            <div class="absolute left-0 top-0 bottom-0 w-1.5 bg-secondary rounded-l-xl"></div>
            <p class="font-quote-editorial text-quote-editorial text-secondary leading-snug pl-3 italic">
              "<?= e(ps_text('हारना सीखा नहीं है, जीत का मैं गीत हूँ। जुगनुओं का संग है, इंसानियत का मीत हूँ।', 'I have not learned to lose; I am a song of victory. With fireflies as companions, I am a friend of humanity.')) ?>"
            </p>
            <span class="block text-right font-label-sm text-label-sm text-text-muted mt-2 tracking-wide uppercase">— <?= e(ps_text('प्रदीप सारंग, बाराबंकी', 'Pradeep Sarang, Barabanki')) ?></span>
          </div>

          <div class="flex flex-wrap items-center gap-4">
            <a href="<?= e(base_url('/volunteer')) ?>" class="inline-flex items-center gap-2 bg-primary-container text-on-primary hover:bg-deep-forest px-6 py-3.5 rounded-xl font-title-md text-title-md transition-all shadow-md font-bold">
              <span class="material-symbols-outlined text-[20px]">groups</span>
              <span><?= e(ps_text('स्वयंसेवक बनें (Join as Volunteer)', 'Join as Volunteer')) ?></span>
            </a>
            <a href="<?= e(base_url('/donation')) ?>" class="inline-flex items-center gap-2 bg-cream-canvas text-deep-forest hover:bg-surface-container px-6 py-3.5 rounded-xl font-title-md text-title-md transition-all shadow-sm border border-border-warm font-semibold">
              <span class="material-symbols-outlined text-[20px]">volunteer_activism</span>
              <span><?= e(ps_text('अभियान सहयोग (Support a Cause)', 'Support a Cause')) ?></span>
            </a>
          </div>
        </div>

        <!-- Right Side Embellished Emblem / Legacy Card -->
        <div class="lg:col-span-4 flex justify-center lg:justify-end w-full">
          <div class="w-full max-w-sm bg-cream-canvas rounded-2xl p-6 shadow-md border border-border-warm relative overflow-hidden">
            <div class="w-full flex justify-center py-4 bg-soft-meadow rounded-xl mb-4 border border-border-warm">
              <img src="<?= e(base_url('assets/images/logo.png')) ?>" onerror="this.src='<?= e(base_url('assets/images/home/icon.svg')) ?>'" alt="<?= e(app_config('name')) ?>" class="h-28 w-auto object-contain drop-shadow-sm">
            </div>
            <div class="space-y-3">
              <div class="flex items-center gap-2">
                <span class="material-symbols-outlined text-primary-container text-[20px]">psychology_alt</span>
                <span class="font-label-md text-label-md font-bold text-deep-forest"><?= e(ps_text('लोक सेवा की वैचारिक नींव', 'Philosophical Pillars')) ?></span>
              </div>
              <p class="font-body-sm text-body-sm text-text-muted leading-relaxed">
                <?= e(ps_text('अवध की माटी से उठकर समाज के अंतिम व्यक्ति तक संवेदना, हरियाली व राष्ट्रप्रेम का संकल्प पहुंचाने वाले जीवंत जन-आंदोलन।', 'Transforming environmental consciousness, bird protection, and Awadhi heritage from Barabanki to all of Uttar Pradesh.')) ?>
              </p>
              <div class="pt-2 flex items-center justify-between text-text-muted font-label-sm text-label-sm border-t border-border-warm">
                <span class="flex items-center gap-1"><span class="w-2 h-2 rounded-full bg-fresh-sprout"></span> <?= e(ps_text('पूर्णतः पारदर्शी', '100% Transparent')) ?></span>
                <span class="flex items-center gap-1"><span class="w-2 h-2 rounded-full bg-secondary"></span> <?= e(ps_text('लोक-भागीदारी', 'Community Driven')) ?></span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Impact Metrics Summary Bar -->
  <section class="w-full bg-deep-forest text-pure-white py-space-xl relative shadow-lg">
    <div class="max-w-container-max mx-auto px-4 sm:px-8">
      <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-6 text-center divide-x-0">
        <!-- Metric 1 -->
        <div class="flex flex-col items-center p-3 rounded-lg hover:bg-surface-container-low/5 transition-colors">
          <span class="material-symbols-outlined text-fresh-sprout text-[32px] mb-1">history_edu</span>
          <span class="font-headline-lg text-headline-lg text-primary-fixed leading-tight font-bold">35+ <?= e(ps_text('वर्ष', 'Years')) ?></span>
          <span class="font-body-sm text-body-sm text-surface-container-high mt-0.5"><?= e(ps_text('अनवरत जनसेवा', 'Continuous Service')) ?></span>
        </div>
        <!-- Metric 2 -->
        <div class="flex flex-col items-center p-3 rounded-lg hover:bg-surface-container-low/5 transition-colors">
          <span class="material-symbols-outlined text-fresh-sprout text-[32px] mb-1">forest</span>
          <span class="font-headline-lg text-headline-lg text-pure-white leading-tight font-bold">50,000+</span>
          <span class="font-body-sm text-body-sm text-surface-container-high mt-0.5"><?= e(ps_text('ग्रीन गैंग पौधारोपण', 'Trees Planted')) ?></span>
        </div>
        <!-- Metric 3 -->
        <div class="flex flex-col items-center p-3 rounded-lg hover:bg-surface-container-low/5 transition-colors">
          <span class="material-symbols-outlined text-tertiary-fixed text-[32px] mb-1">nest_cam_wired_stand</span>
          <span class="font-headline-lg text-headline-lg text-tertiary-fixed leading-tight font-bold">10,000+</span>
          <span class="font-body-sm text-body-sm text-surface-container-high mt-0.5"><?= e(ps_text('परिंदा दाना-पानी सकोरे', 'Bird Water Bowls')) ?></span>
        </div>
        <!-- Metric 4 -->
        <div class="flex flex-col items-center p-3 rounded-lg hover:bg-surface-container-low/5 transition-colors">
          <span class="material-symbols-outlined text-fresh-sprout text-[32px] mb-1">domain</span>
          <span class="font-headline-lg text-headline-lg text-pure-white leading-tight font-bold">150+ <?= e(ps_text('गाँव', 'Villages')) ?></span>
          <span class="font-body-sm text-body-sm text-surface-container-high mt-0.5"><?= e(ps_text('बाराबंकी व अवध अंचल', 'Barabanki & Awadh')) ?></span>
        </div>
        <!-- Metric 5 -->
        <div class="col-span-2 md:col-span-1 flex flex-col items-center p-3 rounded-lg hover:bg-surface-container-low/5 transition-colors">
          <span class="material-symbols-outlined text-secondary-fixed-dim text-[32px] mb-1">handshake</span>
          <span class="font-headline-lg text-headline-lg text-secondary-fixed-dim leading-tight font-bold">100%</span>
          <span class="font-body-sm text-body-sm text-surface-container-high mt-0.5"><?= e(ps_text('पूर्णतः जन-सहयोग', 'Community Funded')) ?></span>
        </div>
      </div>
    </div>
  </section>

  <!-- Interactive Filter Controls & Section Anchor -->
  <section class="w-full bg-cream-canvas pt-space-2xl pb-space-lg border-b border-border-warm" id="campaign-filter-anchor">
    <div class="max-w-container-max mx-auto px-4 sm:px-8">
      <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-4 pb-4">
        <div>
          <span class="font-label-sm text-label-sm uppercase tracking-widest text-secondary font-bold"><?= e(ps_text('जन-आंदोलन संवर्ग', 'Movement Categories')) ?></span>
          <h2 class="font-headline-md text-headline-md text-deep-forest font-bold"><?= e(ps_text('सक्रिय अभियानों की सूची', 'Active Campaigns List')) ?></h2>
        </div>

        <!-- Filter Tabs -->
        <div class="flex flex-wrap items-center gap-2 p-1.5 bg-soft-meadow rounded-xl border border-border-warm" id="campaign-tabs">
          <button type="button" data-filter="all" class="campaign-tab-btn px-4 py-2 rounded-lg font-label-md text-label-md bg-primary-container text-on-primary shadow-sm transition-all font-semibold cursor-pointer">
            <?= e(ps_text('सभी अभियान (5)', 'All Campaigns (5)')) ?>
          </button>
          <button type="button" data-filter="unity" class="campaign-tab-btn px-4 py-2 rounded-lg font-label-md text-label-md text-on-surface-variant hover:text-deep-forest hover:bg-cream-canvas transition-all font-medium cursor-pointer">
            <?= e(ps_text('राष्ट्रीय चेतना व सरदार पटेल अभियान', 'National Integration & Sardar Patel Drive')) ?>
          </button>
          <button type="button" data-filter="eco" class="campaign-tab-btn px-4 py-2 rounded-lg font-label-md text-label-md text-on-surface-variant hover:text-deep-forest hover:bg-cream-canvas transition-all font-medium cursor-pointer">
            <?= e(ps_text('पर्यावरण एवं जैव-विविधता', 'Environment & Biodiversity')) ?>
          </button>
          <button type="button" data-filter="culture" class="campaign-tab-btn px-4 py-2 rounded-lg font-label-md text-label-md text-on-surface-variant hover:text-deep-forest hover:bg-cream-canvas transition-all font-medium cursor-pointer">
            <?= e(ps_text('संस्कृति व अवधी भाषा', 'Culture & Awadhi Language')) ?>
          </button>
        </div>
      </div>
    </div>
  </section>

  <!-- Campaigns Listing Grid -->
  <section class="w-full bg-cream-canvas py-space-3xl">
    <div class="max-w-container-max mx-auto px-4 sm:px-8">
      <div class="grid grid-cols-1 lg:grid-cols-12 gap-8" id="campaigns-grid-container">
        
        <!-- Card 1: सरदार पटेल अभियान (राष्ट्रीय एकता व चेतना) - Featured Large Primary Campaign -->
        <article class="campaign-card lg:col-span-12 bg-pure-white rounded-2xl shadow-sm border border-border-warm hover:shadow-md transition-all overflow-hidden flex flex-col lg:flex-row" data-category="unity">
          <div class="lg:w-5/12 relative min-h-[320px] lg:min-h-full">
            <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuDAOc4i9Cb2VjM79mjezJCpudnHfiDO3eypcROFKyBmdEIdVRKmDtbuGCNhiMd91Y_R3WA5ShPNtU2qpynVq_9X9SauqvqnsaHFcSif4HjpcluLDdVj4X9LSrag69kOjlnE1fpZaRp-JanhslkRn9lem5w51HY9jy_1vnUORrc7QJ956-mLTOozQwtLsmrdunjblUVDPTWxOrx4DASFFfukLpjvXG2ItdY2f3h8GLbD2_dQGwl48vbN" alt="Sardar Patel Abhiyan" class="w-full h-full object-cover">
            <div class="absolute top-4 left-4 flex flex-col gap-2">
              <span class="inline-flex items-center gap-1.5 bg-deep-forest text-on-primary px-3 py-1 rounded-full font-label-sm text-label-sm shadow-sm font-semibold">
                <span class="material-symbols-outlined text-[14px] text-tertiary-fixed">flag</span>
                <span><?= e(ps_text('राष्ट्रीय एकता, समरसता व युवा प्रेरणा | प्रमुख अभियान', 'National Integration & Unity | Primary Campaign')) ?></span>
              </span>
              <span class="inline-flex items-center gap-1.5 bg-cream-canvas/90 backdrop-blur-sm text-deep-forest px-3 py-1 rounded-full font-label-sm text-label-sm shadow-sm font-semibold">
                <span class="material-symbols-outlined text-[14px]">military_tech</span>
                <span><?= e(ps_text('1987 से राष्ट्रीय चेतना व अखंड भारत संकल्प', 'Since 1987 — National Unity Mission')) ?></span>
              </span>
            </div>
          </div>

          <div class="lg:w-7/12 p-6 sm:p-8 flex flex-col justify-between">
            <div>
              <div class="flex items-center justify-between gap-4 mb-2">
                <h3 class="font-headline-sm text-headline-sm text-deep-forest font-bold">
                  <?= e(ps_text('सरदार पटेल अभियान (राष्ट्रीय एकता व अखंडता)', 'Sardar Patel Integration Drive (Primary Movement)')) ?>
                </h3>
                <span class="hidden sm:inline-flex items-center gap-1 bg-soft-meadow text-tertiary font-label-sm text-label-sm px-2.5 py-1 rounded-md font-semibold border border-border-warm">
                  <span class="material-symbols-outlined text-[16px]">verified</span>
                  <span><?= e(ps_text('प्राथमिक मुख्य अभियान', 'Primary Campaign')) ?></span>
                </span>
              </div>

              <p class="font-body-md text-body-md text-on-surface-variant mb-4 leading-relaxed">
                <?= e(ps_text('लौह पुरुष सरदार वल्लभभाई पटेल के अखंड भारत, राष्ट्रीय एकता और सामाजिक समरसता के संदेश को जन-जन तक पहुँचाने हेतु संचालित प्रमुख अभियान। इसके माध्यम से युवाओं को राष्ट्र निर्माण, निःस्वार्थ जनसेवा, सर्वधर्म सद्भाव और सामाजिक बंधुत्व के प्रति निरंतर प्रेरित किया जाता है।', 'The flagship national integration initiative promoting Iron Man Sardar Vallabhbhai Patel’s vision of a united India, civic leadership, and youth harmony across Uttar Pradesh.')) ?>
              </p>

              <!-- Key Highlights Box -->
              <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 p-4 bg-soft-meadow rounded-xl mb-6 border border-border-warm">
                <div class="flex items-start gap-2.5">
                  <span class="material-symbols-outlined text-tertiary text-[20px] mt-0.5">military_tech</span>
                  <div>
                    <span class="block font-title-md text-title-md font-bold text-deep-forest">NSS 1987-88</span>
                    <span class="font-body-sm text-body-sm text-text-muted"><?= e(ps_text('गणतंत्र दिवस परेड प्रेरणा', 'Republic Day Parade Legacy')) ?></span>
                  </div>
                </div>
                <div class="flex items-start gap-2.5">
                  <span class="material-symbols-outlined text-tertiary text-[20px] mt-0.5">diversity_3</span>
                  <div>
                    <span class="block font-title-md text-title-md font-bold text-deep-forest"><?= e(ps_text('युवा संवाद', 'Youth Dialogue')) ?></span>
                    <span class="font-body-sm text-body-sm text-text-muted"><?= e(ps_text('अखंड भारत चेतना यात्रा', 'Unity Consciousness Walk')) ?></span>
                  </div>
                </div>
                <div class="flex items-start gap-2.5">
                  <span class="material-symbols-outlined text-tertiary text-[20px] mt-0.5">handshake</span>
                  <div>
                    <span class="block font-title-md text-title-md font-bold text-deep-forest"><?= e(ps_text('सर्वधर्म सद्भाव', 'Harmony Pledge')) ?></span>
                    <span class="font-body-sm text-body-sm text-text-muted"><?= e(ps_text('जाति-धर्म से ऊपर राष्ट्र', 'Nation Above Divisions')) ?></span>
                  </div>
                </div>
              </div>
            </div>

            <div class="flex flex-wrap items-center justify-between gap-4 pt-4 border-t border-border-warm">
              <div class="flex items-center gap-3">
                <a href="<?= e(base_url('/campaigns/sardar-patel-ekta')) ?>" class="inline-flex items-center gap-2 bg-primary-container text-on-primary hover:bg-deep-forest px-5 py-2.5 rounded-lg font-label-md text-label-md transition-colors shadow-sm font-semibold">
                  <span><?= e(ps_text('अभियान इतिहास व विस्तृत विवरण', 'Explore Sardar Patel Campaign')) ?></span>
                  <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
                </a>
                <a href="<?= e(base_url('/volunteer')) ?>" class="inline-flex items-center gap-2 bg-soft-meadow text-deep-forest hover:bg-surface-container px-4 py-2.5 rounded-lg font-label-md text-label-md transition-colors border border-border-warm font-semibold">
                  <span class="material-symbols-outlined text-[16px] text-tertiary">flag</span>
                  <span><?= e(ps_text('एकता दल से जुड़ें', 'Join Unity Wing')) ?></span>
                </a>
              </div>
              <span class="font-label-sm text-label-sm text-text-muted">#SardarPatelAbhiyan #NationalUnity #AkhandBharat</span>
            </div>
          </div>
        </article>

        <!-- Card 2: हरियाली-अभियान ('ग्रीन गैंग' एवं 'ग्रीन मॉर्निंग') -->
        <article class="campaign-card lg:col-span-6 bg-pure-white rounded-2xl shadow-sm border border-border-warm hover:shadow-md transition-all overflow-hidden flex flex-col" data-category="eco">
          <div class="relative h-64 w-full">
            <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuChrvMjaMrNe9mnv0wsNeczsA9QTsVBVexwNC6wWD2ITtZGUqAqC4rJlu14alM7uVOx3q6e6QMugj2k_SVptJFwJxqw4kgUmkZfc4oZSwOSInUiqwcST-ZVxWP0dQNinxgeGayBKo9MBnd0LReS_tvv8rW_e0uWQz8FI_1PBQ_sze_mt4-UezPUkio4HIFKvoUNP0kZ6gNLPilWihHeDYhJaX6ySBPHJHVKOu68a1dbF1aYaqyDO7Db" alt="Green Gang Movement" class="w-full h-full object-cover">
            <div class="absolute top-4 left-4">
              <span class="inline-flex items-center gap-1.5 bg-deep-forest text-on-primary px-3 py-1 rounded-full font-label-sm text-label-sm shadow-sm font-semibold">
                <span class="material-symbols-outlined text-[14px] text-fresh-sprout">eco</span>
                <span><?= e(ps_text('पर्यावरण व वृक्षारोपण', 'Environment & Forestry')) ?></span>
              </span>
            </div>
          </div>

          <div class="p-6 sm:p-7 flex flex-col justify-between flex-1">
            <div>
              <div class="flex items-baseline justify-between mb-2">
                <h3 class="font-headline-sm text-headline-sm text-deep-forest font-bold">
                  <?= e(ps_text('हरियाली-अभियान (\'ग्रीन गैंग\' एवं \'ग्रीन मॉर्निंग\')', 'Hariyali Abhiyan (\'Green Gang\' & \'Green Morning\')')) ?>
                </h3>
              </div>
              <p class="font-label-md text-label-md text-primary-container font-semibold mb-3">
                <?= e(ps_text('50,000+ वृक्षारोपण एवं दैनिक संवाद में \'ग्रीन मॉर्निंग\' का शिष्टाचार', '50,000+ Trees Planted & Green Morning Greetings')) ?>
              </p>
              <p class="font-body-md text-body-md text-on-surface-variant mb-4 leading-relaxed">
                <?= e(ps_text('धरती पर हरियाली बढ़ाने तथा जन-जन की जीवनशैली में प्रकृति प्रेम को शामिल कराने के उद्देश्य से स्थापित क्रांतिकारी पहल। अभिवादन में \'गुड मॉर्निंग\' की जगह \'ग्रीन-मॉर्निंग\' (Green Morning) बोलने का शिष्टाचार।', 'A revolutionary initiative transforming morning greetings into ecological awareness across schools and panchayats.')) ?>
              </p>
              <div class="space-y-2 mb-6 bg-soft-meadow p-3.5 rounded-xl border border-border-warm">
                <div class="flex items-center gap-2 text-deep-forest font-body-sm text-body-sm">
                  <span class="material-symbols-outlined text-[18px] text-primary-container">check_circle</span>
                  <span>50,000+ <?= e(ps_text('वृक्षारोपण एवं संरक्षण संकल्प', 'Trees Planted & Protected')) ?></span>
                </div>
                <div class="flex items-center gap-2 text-deep-forest font-body-sm text-body-sm">
                  <span class="material-symbols-outlined text-[18px] text-primary-container">check_circle</span>
                  <span><?= e(ps_text('ग्रीन गैंग युवा दस्ता व पौध शपथ संस्कार', 'Green Gang Youth Squad')) ?></span>
                </div>
              </div>
            </div>

            <div class="flex items-center gap-3 pt-2 border-t border-border-warm">
              <a href="<?= e(base_url('/campaigns/hariyali-sanrakshan')) ?>" class="inline-flex items-center gap-1.5 bg-primary-container text-on-primary hover:bg-deep-forest px-4 py-2.5 rounded-lg font-label-md text-label-md transition-colors shadow-sm font-semibold">
                <span><?= e(ps_text('विस्तृत विवरण देखें', 'Explore Campaign')) ?></span>
                <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
              </a>
              <a href="<?= e(base_url('/volunteer')) ?>" class="inline-flex items-center gap-1.5 bg-soft-meadow text-deep-forest hover:bg-surface-container px-3.5 py-2.5 rounded-lg font-label-md text-label-md transition-colors border border-border-warm font-semibold">
                <span class="material-symbols-outlined text-[16px] text-primary-container">nature</span>
                <span><?= e(ps_text('पौधा गोद लें', 'Sponsor Sapling')) ?></span>
              </a>
            </div>
          </div>
        </article>

        <!-- Card 5: सरदार पटेल अभियान (राष्ट्रीय एकता व अखंडता) -->
        <article class="campaign-card lg:col-span-6 bg-pure-white rounded-2xl shadow-sm border border-border-warm hover:shadow-md transition-all overflow-hidden flex flex-col" data-category="unity">
          <div class="relative h-64 w-full">
            <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuDAOc4i9Cb2VjM79mjezJCpudnHfiDO3eypcROFKyBmdEIdVRKmDtbuGCNhiMd91Y_R3WA5ShPNtU2qpynVq_9X9SauqvqnsaHFcSif4HjpcluLDdVj4X9LSrag69kOjlnE1fpZaRp-JanhslkRn9lem5w51HY9jy_1vnUORrc7QJ956-mLTOozQwtLsmrdunjblUVDPTWxOrx4DASFFfukLpjvXG2ItdY2f3h8GLbD2_dQGwl48vbN" alt="Sardar Patel Abhiyan" class="w-full h-full object-cover">
            <div class="absolute top-4 left-4">
              <span class="inline-flex items-center gap-1.5 bg-tertiary text-on-tertiary px-3 py-1 rounded-full font-label-sm text-label-sm shadow-sm font-semibold">
                <span class="material-symbols-outlined text-[14px]">flag</span>
                <span><?= e(ps_text('राष्ट्रीय एकता, समरसता व युवा प्रेरणा', 'National Integration')) ?></span>
              </span>
            </div>
          </div>

          <div class="p-6 sm:p-7 flex flex-col justify-between flex-1">
            <div>
              <div class="flex items-baseline justify-between mb-2">
                <h3 class="font-headline-sm text-headline-sm text-deep-forest font-bold">
                  <?= e(ps_text('सरदार पटेल अभियान (राष्ट्रीय चेतना)', 'Sardar Patel Integration Drive')) ?>
                </h3>
              </div>
              <p class="font-label-md text-label-md text-tertiary font-semibold mb-3">
                <?= e(ps_text('लौह पुरुष सरदार वल्लभभाई पटेल के अखंड भारत के विचारों का संचार', 'Promoting Iron Man Sardar Patel\'s Unity Vision')) ?>
              </p>
              <p class="font-body-md text-body-md text-on-surface-variant mb-4 leading-relaxed">
                <?= e(ps_text('राष्ट्रीय एकता, अखंडता और सामाजिक समरसता के संदेश को जन-जन तक पहुँचाने हेतु संचालित अभियान। युवाओं को राष्ट्र निर्माण, निःस्वार्थ सेवा और सामाजिक बंधुत्व के प्रति प्रेरित करना ताकि जाति-धर्म से ऊपर उठकर एक भारत का निर्माण हो सके।', 'Fostering national unity, social harmony, and youth service inspired by Sardar Patel.')) ?>
              </p>
              <div class="space-y-2 mb-6 bg-soft-meadow p-3.5 rounded-xl border border-border-warm">
                <div class="flex items-center gap-2 text-deep-forest font-body-sm text-body-sm">
                  <span class="material-symbols-outlined text-[18px] text-tertiary">check_circle</span>
                  <span><?= e(ps_text('राष्ट्रीय सेवा योजना (NSS 1987-88) गणतंत्र दिवस परेड आदर्शों का विस्तार', 'NSS Republic Day Camp 1987-88 Legacy')) ?></span>
                </div>
                <div class="flex items-center gap-2 text-deep-forest font-body-sm text-body-sm">
                  <span class="material-symbols-outlined text-[18px] text-tertiary">check_circle</span>
                  <span><?= e(ps_text('ग्रामीण युवा संवाद यात्रा व अखंड भारत समरसता गोष्ठियाँ', 'Rural Youth Harmony Dialogues')) ?></span>
                </div>
              </div>
            </div>

            <div class="flex items-center gap-3 pt-2 border-t border-border-warm">
              <a href="<?= e(base_url('/campaigns/sardar-patel-ekta')) ?>" class="inline-flex items-center gap-1.5 bg-primary-container text-on-primary hover:bg-deep-forest px-4 py-2.5 rounded-lg font-label-md text-label-md transition-colors shadow-sm font-semibold">
                <span><?= e(ps_text('अभियान इतिहास व विवरण', 'Campaign History')) ?></span>
                <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
              </a>
              <a href="<?= e(base_url('/volunteer')) ?>" class="inline-flex items-center gap-1.5 bg-soft-meadow text-tertiary hover:bg-surface-container px-3.5 py-2.5 rounded-lg font-label-md text-label-md transition-colors border border-border-warm font-semibold">
                <span class="material-symbols-outlined text-[16px]">military_tech</span>
                <span><?= e(ps_text('एकता दल से जुड़ें', 'Join Unity Wing')) ?></span>
              </a>
            </div>
          </div>
        </article>

        <?php
        $builtinSlugs = ['hariyali-campaign', 'bird-conservation-campaign', 'tulsi-pakhwara', 'language-and-literature-promotion-campaign', 'patel-campaign', 'hariyali', 'parinda', 'tulsi', 'awadhi', 'patel'];
        $customCampaigns = array_filter($items ?? [], function($c) use ($builtinSlugs) {
            $s = strtolower($c['slug'] ?? '');
            foreach ($builtinSlugs as $b) {
                if ($s === $b || str_contains($s, $b)) return false;
            }
            return true;
        });

        foreach ($customCampaigns as $c):
            $cTitle = $c['title'] ?? ps_text('नवीन जन-अभियान', 'New Campaign');
            $cSlug = $c['slug'] ?? 'campaign-' . ($c['id'] ?? rand(100, 999));
            $cImage = !empty($c['image']) ? (str_starts_with($c['image'], 'http') ? $c['image'] : base_url($c['image'])) : 'https://picsum.photos/seed/' . md5($cSlug) . '/900/600';
            $cExcerpt = ps_excerpt($c, 200);
            $cCategory = strtolower($c['category'] ?? 'eco');
        ?>
        <!-- Dynamic Campaign Card (Added via Admin Database) -->
        <article class="campaign-card lg:col-span-6 bg-pure-white rounded-2xl shadow-sm border border-border-warm hover:shadow-md transition-all overflow-hidden flex flex-col" data-category="<?= e($cCategory) ?>">
          <div class="relative h-64 w-full">
            <img src="<?= e($cImage) ?>" alt="<?= e($cTitle) ?>" class="w-full h-full object-cover">
            <div class="absolute top-4 left-4">
              <span class="inline-flex items-center gap-1.5 bg-deep-forest text-on-primary px-3 py-1 rounded-full font-label-sm text-label-sm shadow-sm font-semibold">
                <span class="material-symbols-outlined text-[14px] text-fresh-sprout">eco</span>
                <span><?= e(ps_text('जन-सरोकार व पर्यावरण अभियान', 'Community Campaign')) ?></span>
              </span>
            </div>
          </div>

          <div class="p-6 sm:p-7 flex flex-col justify-between flex-1">
            <div>
              <div class="flex items-baseline justify-between mb-2">
                <h3 class="font-headline-sm text-headline-sm text-deep-forest font-bold">
                  <?= e($cTitle) ?>
                </h3>
              </div>
              <p class="font-body-md text-body-md text-on-surface-variant mb-4 leading-relaxed">
                <?= e($cExcerpt) ?>
              </p>
            </div>

            <div class="flex items-center gap-3 pt-2 border-t border-border-warm">
              <a href="<?= e(base_url('/campaigns/' . $cSlug)) ?>" class="inline-flex items-center gap-1.5 bg-primary-container text-on-primary hover:bg-deep-forest px-4 py-2.5 rounded-lg font-label-md text-label-md transition-colors shadow-sm font-semibold">
                <span><?= e(ps_text('अभियान विवरण देखें', 'View Campaign Details')) ?></span>
                <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
              </a>
              <a href="<?= e(base_url('/volunteer')) ?>" class="inline-flex items-center gap-1.5 bg-soft-meadow text-deep-forest hover:bg-surface-container px-3.5 py-2.5 rounded-lg font-label-md text-label-md transition-colors border border-border-warm font-semibold">
                <span class="material-symbols-outlined text-[16px]">handshake</span>
                <span><?= e(ps_text('सहभागिता करें', 'Participate')) ?></span>
              </a>
            </div>
          </div>
        </article>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <!-- "अभियानों में कैसे जुड़ें?" (How to Get Involved - 3 Pillars Section) -->
  <section class="w-full bg-soft-meadow py-space-4xl border-b border-border-warm" id="volunteer-involvement">
    <div class="max-w-container-max mx-auto px-4 sm:px-8">
      <div class="text-center max-w-2xl mx-auto mb-space-2xl">
        <span class="font-label-sm text-label-sm uppercase tracking-widest text-primary-container font-bold"><?= e(ps_text('सहभागिता के तीन मार्ग', 'Three Ways to Participate')) ?></span>
        <h2 class="font-headline-lg text-headline-lg text-deep-forest mt-1 font-bold"><?= e(ps_text('अभियानों में कैसे जुड़ें?', 'How to Get Involved')) ?></h2>
        <p class="font-body-md text-body-md text-on-surface-variant mt-2">
          <?= e(ps_text('प्रत्येक नागरिक का छोटा सा योगदान धरती और समाज में एक बड़ी क्रांति ला सकता है। आप अपनी क्षमता और रुचि के अनुसार सीधे सहभागी बन सकते हैं।', 'Every small contribution drives lasting impact. Participate according to your passion.')) ?>
        </p>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <!-- Pillar 1 -->
        <div class="bg-pure-white rounded-2xl p-8 shadow-sm border border-border-warm hover:shadow-md transition-all flex flex-col justify-between">
          <div>
            <div class="w-14 h-14 rounded-xl bg-surface-container flex items-center justify-center text-primary-container mb-6 border border-border-warm">
              <span class="material-symbols-outlined text-[32px]">diversity_1</span>
            </div>
            <span class="font-label-sm text-label-sm text-primary-container font-bold uppercase tracking-wider"><?= e(ps_text('स्तम्भ १', 'Pillar 1')) ?></span>
            <h3 class="font-title-lg text-title-lg text-deep-forest mt-1 mb-3 font-bold"><?= e(ps_text('\'ग्रीन गैंग\' के स्वयंसेवक बनें', 'Become a Green Gang Volunteer')) ?></h3>
            <p class="font-body-md text-body-md text-on-surface-variant leading-relaxed mb-6">
              <?= e(ps_text('वृक्षारोपण, परिंदा जलपात्र वितरण और गाँव की पर्यावरण सुरक्षा में अपना सक्रिय समय दें। अपने क्षेत्र में प्रकृति मित्रों का समूह तैयार करें।', 'Give your time for tree planting, bird water pot distribution, and environmental drives.')) ?>
            </p>
          </div>
          <a href="<?= e(base_url('/volunteer')) ?>" class="inline-flex items-center gap-2 text-primary-container font-label-md text-label-md hover:text-deep-forest transition-colors font-bold">
            <span><?= e(ps_text('स्वयंसेवक फॉर्म भरें', 'Fill Volunteer Form')) ?></span>
            <span class="material-symbols-outlined text-[16px]">east</span>
          </a>
        </div>

        <!-- Pillar 2 -->
        <div class="bg-pure-white rounded-2xl p-8 shadow-sm border border-border-warm hover:shadow-md transition-all flex flex-col justify-between">
          <div>
            <div class="w-14 h-14 rounded-xl bg-surface-container flex items-center justify-center text-secondary mb-6 border border-border-warm">
              <span class="material-symbols-outlined text-[32px]">campaign</span>
            </div>
            <span class="font-label-sm text-label-sm text-secondary font-bold uppercase tracking-wider"><?= e(ps_text('स्तम्भ २', 'Pillar 2')) ?></span>
            <h3 class="font-title-lg text-title-lg text-deep-forest mt-1 mb-3 font-bold"><?= e(ps_text('गाँव / विद्यालय में \'ग्रीन चौपाल\'', 'Host Green Chaupal')) ?></h3>
            <p class="font-body-md text-body-md text-on-surface-variant leading-relaxed mb-6">
              <?= e(ps_text('अपने संस्थान, पंचायत या विद्यालय में प्रदीप सारंग जी को जन-संवाद, तुलसी मानस विचार गोष्ठी अथवा पर्यावरण जागरूकता हेतु आमंत्रित करें।', 'Invite Shri Pradeep Sarang to conduct environmental or Awadhi literature sessions.')) ?>
            </p>
          </div>
          <a href="<?= e(base_url('/contact')) ?>" class="inline-flex items-center gap-2 text-secondary font-label-md text-label-md hover:text-deep-forest transition-colors font-bold">
            <span><?= e(ps_text('कार्यक्रम का आमंत्रण भेजें', 'Invite for Event')) ?></span>
            <span class="material-symbols-outlined text-[16px]">east</span>
          </a>
        </div>

        <!-- Pillar 3 -->
        <div class="bg-pure-white rounded-2xl p-8 shadow-sm border border-border-warm hover:shadow-md transition-all flex flex-col justify-between">
          <div>
            <div class="w-14 h-14 rounded-xl bg-surface-container flex items-center justify-center text-tertiary mb-6 border border-border-warm">
              <span class="material-symbols-outlined text-[32px]">volunteer_activism</span>
            </div>
            <span class="font-label-sm text-label-sm text-tertiary font-bold uppercase tracking-wider"><?= e(ps_text('स्तम्भ ३', 'Pillar 3')) ?></span>
            <h3 class="font-title-lg text-title-lg text-deep-forest mt-1 mb-3 font-bold"><?= e(ps_text('सकोरे व पौध संरक्षण प्रायोजित करें', 'Sponsor Water Bowls & Saplings')) ?></h3>
            <p class="font-body-md text-body-md text-on-surface-variant leading-relaxed mb-6">
              <?= e(ps_text('गर्मी के मौसम में मिट्टी के सकोरे, दाना-पानी सामग्री अथवा फलदार व छायादार पौधे प्रायोजित कर मूक पक्षियों व धरा की सेवा में सहयोग दें।', 'Sponsor earthen water pots, bird grains, or tree-guards for environmental initiatives.')) ?>
            </p>
          </div>
          <a href="<?= e(base_url('/donation')) ?>" class="inline-flex items-center gap-2 text-tertiary font-label-md text-label-md hover:text-deep-forest transition-colors font-bold">
            <span><?= e(ps_text('सहयोग राशि / सामग्री दान', 'Sponsor a Cause')) ?></span>
            <span class="material-symbols-outlined text-[16px]">east</span>
          </a>
        </div>
      </div>
    </div>
  </section>

  <!-- Quote Banner Section -->
  <section class="w-full bg-cream-canvas py-space-3xl relative overflow-hidden border-b border-border-warm">
    <div class="max-w-container-editorial mx-auto px-4 text-center">
      <div class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-soft-meadow text-primary-container mb-4 shadow-xs border border-border-warm">
        <span class="material-symbols-outlined text-[28px]">format_quote</span>
      </div>
      <p class="font-quote-editorial text-headline-sm md:text-headline-md text-deep-forest leading-relaxed italic">
        "<?= e(ps_text('धरती को हरी-भरी बनाना और बेज़ुबानों की प्यास बुझाना केवल कर्म नहीं, आत्मा का धर्म है।', 'Greening the Earth and slaking the thirst of wildlife is not merely duty; it is the soul\'s calling.')) ?>"
      </p>
      <div class="flex items-center justify-center gap-3 mt-6">
        <div class="w-10 h-0.5 bg-fresh-sprout"></div>
        <span class="font-title-md text-title-md text-deep-forest font-bold"><?= e(ps_text('प्रदीप सारंग', 'Pradeep Sarang')) ?></span>
        <div class="w-10 h-0.5 bg-fresh-sprout"></div>
      </div>
      <span class="font-label-sm text-label-sm text-text-muted mt-1 block"><?= e(ps_text('पर्यावरणविद्, लोकसेवक एवं साहित्यकार, बाराबंकी', 'Environmentalist, Social Worker & Author, Barabanki')) ?></span>
    </div>
  </section>

  <!-- Call-to-Action Box & Outreach Form Trigger -->
  <section class="w-full bg-cream-canvas py-space-4xl">
    <div class="max-w-container-max mx-auto px-4 sm:px-8">
      <div class="bg-gradient-to-r from-deep-forest to-primary-container rounded-3xl p-8 sm:p-12 text-pure-white shadow-xl flex flex-col lg:flex-row items-center justify-between gap-8 border border-border-warm">
        <div class="max-w-2xl">
          <div class="inline-flex items-center gap-2 bg-pure-white/10 px-3 py-1 rounded-full font-label-sm text-label-sm text-primary-fixed mb-4 font-semibold border border-white/10">
            <span class="material-symbols-outlined text-[16px]">leaderboard</span>
            <span><?= e(ps_text('नेतृत्व एवं स्थानीय पहल', 'Leadership & Local Outreach')) ?></span>
          </div>
          <h3 class="font-headline-md text-headline-md text-pure-white font-bold leading-tight mb-3">
            <?= e(ps_text('क्या आप अपने क्षेत्र में हमारे किसी अभियान का नेतृत्व करना चाहते हैं?', 'Would You Like to Lead a Campaign in Your Village or School?')) ?>
          </h3>
          <p class="font-body-md text-body-md text-surface-container-high leading-relaxed">
            <?= e(ps_text('यदि आप अपने गाँव, कस्बे, विद्यालय अथवा संस्था में हरियाली, परिंदा दाना-पानी या अवधी साहित्य गोष्ठी का आयोजन करना चाहते हैं, तो हमसे सीधा संपर्क करें।', 'If you want to organize a Green Morning drive or Awadhi literature session in your institution, contact us directly.')) ?>
          </p>
        </div>

        <div class="flex flex-col sm:flex-row items-center gap-4 w-full lg:w-auto shrink-0">
          <a href="tel:<?= e($phoneClean) ?>" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 bg-cream-canvas text-deep-forest hover:bg-pure-white px-6 py-3.5 rounded-xl font-title-md text-title-md font-bold transition-all shadow-md">
            <span class="material-symbols-outlined text-primary-container text-[20px]">call</span>
            <span><?= e(ps_text('सीधा संवाद (', 'Direct Call (')) ?><?= e($phone) ?>)</span>
          </a>
          <a href="<?= e(base_url('/contact')) ?>" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 bg-deep-forest/80 text-pure-white hover:bg-deep-forest px-6 py-3.5 rounded-xl font-title-md text-title-md transition-all shadow-sm border border-white/20 font-semibold">
            <span class="material-symbols-outlined text-[20px]">edit_note</span>
            <span><?= e(ps_text('ऑनलाइन आवेदन प्रपत्र भरें', 'Fill Outreach Form')) ?></span>
          </a>
        </div>
      </div>
    </div>
  </section>
</div>

<!-- Interactive Filter Logic (Vanilla JS) -->
<script>
  (function() {
    const tabs = document.querySelectorAll('.campaign-tab-btn');
    const cards = document.querySelectorAll('.campaign-card');

    tabs.forEach(tab => {
      tab.addEventListener('click', () => {
        const filter = tab.getAttribute('data-filter');

        // Style tabs
        tabs.forEach(t => {
          t.classList.remove('bg-primary-container', 'text-on-primary', 'shadow-sm');
          t.classList.add('text-on-surface-variant');
        });
        tab.classList.add('bg-primary-container', 'text-on-primary', 'shadow-sm');
        tab.classList.remove('text-on-surface-variant');

        // Filter cards
        cards.forEach(card => {
          const category = card.getAttribute('data-category');
          if (filter === 'all' || category === filter) {
            card.style.display = 'flex';
          } else {
            card.style.display = 'none';
          }
        });
      });
    });
  })();
</script>
