<?php
declare(strict_types=1);

$items = $items ?? [];
$phone = trim($settings['phone'] ?? '+91 9919007190');
$phoneClean = preg_replace('/[^+0-9]/', '', $phone);

// Image assets with reliable fallbacks
$patelImg = ps_resolve_img('assets/images/sardar_patel.webp', 'uploads/69ee19ac9dac4_sardar_patel_optimized.webp');
$greenImg = ps_resolve_img('assets/images/hariyali_abhiyan.webp', 'uploads/slider_final_1.webp');
$parindaImg = ps_resolve_img('assets/images/slider_final_2.webp', 'uploads/69edd6098e3e2_slider_final_2.webp');
$awadhiImg = ps_resolve_img('assets/images/slider_final_3.webp', 'uploads/69edd6098de58_slider_final_3.webp');
$tulsiImg = ps_resolve_img('assets/images/slider_final_1.webp', 'uploads/slider_final_1.webp');
?>

<div class="flex flex-col w-full bg-[#FAF8F3]">
  <!-- 1. HERO MASTHEAD SECTION -->
  <section class="relative w-full overflow-hidden bg-gradient-to-b from-[#FAF8F3] via-[#F3F7F4] to-[#FAF8F3] py-10 lg:py-16 border-b border-[#E5E7EB]">
    <!-- Ambient Blur Background -->
    <div class="absolute -top-20 -right-20 w-96 h-96 rounded-full bg-[#15803D]/10 blur-3xl pointer-events-none"></div>
    <div class="absolute -bottom-20 -left-20 w-80 h-80 rounded-full bg-[#C05632]/10 blur-3xl pointer-events-none"></div>

    <div class="max-w-container-max mx-auto px-4 sm:px-8 relative z-10">
      <!-- Breadcrumb Bar -->
      <nav aria-label="Breadcrumb" class="flex items-center gap-2 text-sm text-[#64748B] mb-6">
        <a href="<?= e(base_url('/')) ?>" class="hover:text-[#14532D] transition-colors flex items-center gap-1 font-medium">
          <span class="material-symbols-outlined text-[16px]">home</span>
          <span><?= e(ps_text('गृह (Home)', 'Home')) ?></span>
        </a>
        <span class="opacity-40">/</span>
        <span class="text-[#14532D] font-bold"><?= e(ps_text('प्रमुख जन-अभियान (Campaigns)', 'Campaigns & Initiatives')) ?></span>
      </nav>

      <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-center">
        <div class="lg:col-span-8 flex flex-col items-start space-y-5">
          <!-- Floating Pill -->
          <div class="inline-flex items-center gap-2 bg-white px-3.5 py-1.5 rounded-full border border-[#C05632]/30 shadow-xs">
            <span class="w-2.5 h-2.5 rounded-full bg-[#C05632] animate-pulse"></span>
            <span class="text-xs text-[#14532D] uppercase tracking-wider font-bold">
              <?= e(ps_text('चार दशकों की अनवरत साधना • 1987 से निरंतर जनसेवा', 'Four Decades of Dedicated Grassroots Service • Since 1987')) ?>
            </span>
          </div>

          <!-- Hero Headline -->
          <h1 class="font-display-hero text-3xl sm:text-4xl lg:text-5xl text-[#14532D] font-bold leading-tight tracking-tight">
            <?= ps_text('प्रकृति, संस्कृति, राष्ट्र और समाज को समर्पित प्रमुख जन-अभियान', 'Major Environmental, Cultural & National Movements') ?>
          </h1>

          <p class="text-base sm:text-lg text-[#475467] leading-relaxed max-w-3xl">
            <?= e(ps_text('प्रदीप सारंग द्वारा बाराबंकी (अवध) की पावन माटी से संचालित राष्ट्रव्यापी व ग्रामीण जन-आंदोलन — पर्यावरण संरक्षण, गौरैया व पक्षी संवर्धन, राष्ट्रीय एकता, अवधी भाषा उत्थान और युवाओं में सकारात्मक चेतना का निरंतर संचार।', 'Grassroots public-interest initiatives led by Pradeep Sarang for environmental regeneration, bird conservation, national integration, and Awadhi cultural preservation.')) ?>
          </p>

          <!-- Signature Poetic Quote Card -->
          <div class="bg-white rounded-2xl p-5 shadow-xs border-l-4 border-[#C05632] border-t border-r border-b border-[#E5E7EB] max-w-2xl w-full">
            <p class="font-quote-editorial text-base sm:text-lg text-[#1E293B] italic leading-relaxed">
              "<?= e(ps_text('हारना सीखा नहीं है, जीत का मैं गीत हूँ। जुगनुओं का संग है, इंसानियत का मीत हूँ।', 'I have not learned to lose; I am a song of victory. With fireflies as companions, I am a friend to humanity.')) ?>"
            </p>
            <div class="mt-2 flex items-center justify-between text-xs text-[#64748B] pt-2 border-t border-[#F1F5F9]">
              <span class="font-bold text-[#14532D] uppercase tracking-wider">— <?= e(ps_text('प्रदीप सारंग, बाराबंकी', 'Pradeep Sarang, Barabanki')) ?></span>
              <span><?= e(ps_text('कवि, पर्यावरणविद् एवं समाजसेवी', 'Poet, Environmentalist & Social Worker')) ?></span>
            </div>
          </div>

          <!-- Actions -->
          <div class="flex flex-wrap items-center gap-4 pt-2">
            <a href="#campaigns-grid-container" class="inline-flex items-center gap-2 bg-[#14532D] hover:bg-[#0F3D21] text-white px-6 py-3.5 rounded-xl text-base font-semibold transition-all shadow-md">
              <span class="material-symbols-outlined text-[20px]">explore</span>
              <span><?= e(ps_text('सभी अभियान देखें', 'Explore All Campaigns')) ?></span>
            </a>
            <a href="<?= e(base_url('/volunteer')) ?>" class="inline-flex items-center gap-2 bg-[#C05632] hover:bg-[#A9472B] text-white px-6 py-3.5 rounded-xl text-base font-semibold transition-all shadow-sm">
              <span class="material-symbols-outlined text-[20px]">groups</span>
              <span><?= e(ps_text('स्वयंसेवक बनें', 'Join as Volunteer')) ?></span>
            </a>
            <a href="<?= e(base_url('/donation')) ?>" class="inline-flex items-center gap-2 bg-white hover:bg-[#F8FAFC] text-[#14532D] px-5 py-3.5 rounded-xl text-base font-semibold transition-all shadow-xs border border-[#E2E8F0]">
              <span class="material-symbols-outlined text-[20px] text-[#C05632]">volunteer_activism</span>
              <span><?= e(ps_text('अभियान सहयोग', 'Support a Cause')) ?></span>
            </a>
          </div>
        </div>

        <!-- Right Side Embellished Emblem / Legacy Card -->
        <div class="lg:col-span-4 flex justify-center lg:justify-end w-full">
          <div class="w-full max-w-sm bg-white rounded-2xl p-6 shadow-md border border-[#E5E7EB] relative overflow-hidden">
            <div class="w-full flex justify-center py-6 bg-[#F1F7F2] rounded-xl mb-5 border border-[#E2E8F0]">
              <img src="<?= e(ps_resolve_img(setting('logo', 'assets/images/logonew.webp'))) ?>" onerror="this.src='<?= e(base_url('assets/images/home/icon.svg')) ?>'" alt="<?= e(app_config('name')) ?>" class="h-28 w-auto object-contain drop-shadow-sm">
            </div>
            <div class="space-y-3">
              <div class="flex items-center gap-2 text-[#14532D]">
                <span class="material-symbols-outlined text-[22px] text-[#15803D]">psychology_alt</span>
                <span class="text-sm font-bold uppercase tracking-wider"><?= e(ps_text('लोक सेवा की वैचारिक नींव', 'Philosophical Foundation')) ?></span>
              </div>
              <p class="text-xs text-[#64748B] leading-relaxed">
                <?= e(ps_text('अवध की माटी से उठकर समाज के अंतिम व्यक्ति तक संवेदना, हरियाली व राष्ट्रप्रेम का संकल्प पहुंचाने वाले जीवंत जन-आंदोलन।', 'Transforming environmental consciousness, bird protection, and Awadhi heritage across Uttar Pradesh.')) ?>
              </p>
              <div class="pt-3 flex items-center justify-between text-xs text-[#475467] font-semibold border-t border-[#E5E7EB]">
                <span class="flex items-center gap-1.5"><span class="w-2 h-2 rounded-full bg-[#15803D]"></span> <?= e(ps_text('पूर्णतः पारदर्शी', '100% Transparent')) ?></span>
                <span class="flex items-center gap-1.5"><span class="w-2 h-2 rounded-full bg-[#C05632]"></span> <?= e(ps_text('जन-सहयोग आधारित', 'Community Driven')) ?></span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- 2. IMPACT METRICS STRIP -->
  <section class="w-full bg-[#18392B] text-white py-8 relative shadow-md">
    <div class="max-w-container-max mx-auto px-4 sm:px-8">
      <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-6 text-center">
        <!-- Metric 1 -->
        <div class="flex flex-col items-center p-3 rounded-xl hover:bg-white/5 transition-colors">
          <span class="material-symbols-outlined text-[#F4C96B] text-[30px] mb-1">history_edu</span>
          <span class="text-3xl lg:text-4xl text-[#F4C96B] font-bold leading-tight">35+ <?= e(ps_text('वर्ष', 'Yrs')) ?></span>
          <span class="text-xs text-[#CBD5E1] mt-1"><?= e(ps_text('अनवरत जनसेवा (1987 से)', 'Continuous Service')) ?></span>
        </div>
        <!-- Metric 2 -->
        <div class="flex flex-col items-center p-3 rounded-xl hover:bg-white/5 transition-colors">
          <span class="material-symbols-outlined text-[#6FD08C] text-[30px] mb-1">forest</span>
          <span class="text-3xl lg:text-4xl text-white font-bold leading-tight">50,000+</span>
          <span class="text-xs text-[#CBD5E1] mt-1"><?= e(ps_text('ग्रीन गैंग पौधरोपण', 'Trees Planted')) ?></span>
        </div>
        <!-- Metric 3 -->
        <div class="flex flex-col items-center p-3 rounded-xl hover:bg-white/5 transition-colors">
          <span class="material-symbols-outlined text-[#F0B45C] text-[30px] mb-1">nest_cam_wired_stand</span>
          <span class="text-3xl lg:text-4xl text-[#F0B45C] font-bold leading-tight">10,000+</span>
          <span class="text-xs text-[#CBD5E1] mt-1"><?= e(ps_text('परिंदा जल-सकोरे वितरण', 'Bird Water Bowls')) ?></span>
        </div>
        <!-- Metric 4 -->
        <div class="flex flex-col items-center p-3 rounded-xl hover:bg-white/5 transition-colors">
          <span class="material-symbols-outlined text-[#76B7D8] text-[30px] mb-1">domain</span>
          <span class="text-3xl lg:text-4xl text-white font-bold leading-tight">150+ <?= e(ps_text('गाँव', 'Villages')) ?></span>
          <span class="text-xs text-[#CBD5E1] mt-1"><?= e(ps_text('बाराबंकी व अवध अंचल', 'Barabanki & Awadh')) ?></span>
        </div>
        <!-- Metric 5 -->
        <div class="col-span-2 md:col-span-1 flex flex-col items-center p-3 rounded-xl hover:bg-white/5 transition-colors">
          <span class="material-symbols-outlined text-[#E67E57] text-[30px] mb-1">handshake</span>
          <span class="text-3xl lg:text-4xl text-[#E67E57] font-bold leading-tight">100%</span>
          <span class="text-xs text-[#CBD5E1] mt-1"><?= e(ps_text('पूर्णतः जन-भागीदारी', 'Community Driven')) ?></span>
        </div>
      </div>
    </div>
  </section>

  <!-- 3. INTERACTIVE CATEGORY FILTER -->
  <section class="w-full bg-[#FAF8F3] pt-10 pb-4 border-b border-[#E5E7EB]" id="campaign-filter-anchor">
    <div class="max-w-container-max mx-auto px-4 sm:px-8">
      <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-4 pb-2">
        <div>
          <span class="text-xs uppercase tracking-widest text-[#C05632] font-bold"><?= e(ps_text('जन-आंदोलन संवर्ग', 'Campaign Themes')) ?></span>
          <h2 class="text-2xl sm:text-3xl text-[#14532D] font-bold mt-0.5"><?= e(ps_text('सक्रिय अभियानों की सूची', 'Active Campaigns & Movements')) ?></h2>
        </div>

        <!-- Filter Tabs -->
        <div class="flex flex-wrap items-center gap-2 p-1.5 bg-white rounded-2xl border border-[#E5E7EB] shadow-xs" id="campaign-tabs">
          <button type="button" data-filter="all" class="campaign-tab-btn px-4 py-2 rounded-xl text-xs sm:text-sm bg-[#14532D] text-white shadow-xs transition-all font-bold cursor-pointer">
            <?= e(ps_text('सभी अभियान', 'All Campaigns')) ?>
          </button>
          <button type="button" data-filter="unity" class="campaign-tab-btn px-4 py-2 rounded-xl text-xs sm:text-sm text-[#475467] hover:text-[#14532D] hover:bg-[#F1F7F2] transition-all font-semibold cursor-pointer">
            <?= e(ps_text('राष्ट्रीय चेतना (सरदार पटेल)', 'National Integration')) ?>
          </button>
          <button type="button" data-filter="eco" class="campaign-tab-btn px-4 py-2 rounded-xl text-xs sm:text-sm text-[#475467] hover:text-[#14532D] hover:bg-[#F1F7F2] transition-all font-semibold cursor-pointer">
            <?= e(ps_text('पर्यावरण व हरियाली', 'Environment & Green Gang')) ?>
          </button>
          <button type="button" data-filter="bird" class="campaign-tab-btn px-4 py-2 rounded-xl text-xs sm:text-sm text-[#475467] hover:text-[#14532D] hover:bg-[#F1F7F2] transition-all font-semibold cursor-pointer">
            <?= e(ps_text('परिंदा व जीव-दया', 'Bird Protection')) ?>
          </button>
          <button type="button" data-filter="culture" class="campaign-tab-btn px-4 py-2 rounded-xl text-xs sm:text-sm text-[#475467] hover:text-[#14532D] hover:bg-[#F1F7F2] transition-all font-semibold cursor-pointer">
            <?= e(ps_text('अवधी संस्कृति व साहित्य', 'Culture & Literature')) ?>
          </button>
        </div>
      </div>
    </div>
  </section>

  <!-- 4. CAMPAIGNS LISTING GRID -->
  <section class="w-full bg-[#FAF8F3] py-10 lg:py-14">
    <div class="max-w-container-max mx-auto px-4 sm:px-8">
      <div class="grid grid-cols-1 lg:grid-cols-12 gap-8" id="campaigns-grid-container">
        
        <!-- ==============================================
             FEATURED PRIMARY CAMPAIGN: सरदार पटेल अभियान
             ============================================== -->
        <article class="campaign-card lg:col-span-12 bg-white rounded-3xl shadow-md hover:shadow-xl border-2 border-[#C05632]/40 transition-all overflow-hidden flex flex-col lg:flex-row" data-category="unity">
          <!-- Visual Column -->
          <div class="lg:w-5/12 relative min-h-[340px] lg:min-h-[460px] bg-[#1E293B] flex items-center justify-center p-3">
            <img src="<?= e($patelImg) ?>" alt="<?= e(ps_text('सरदार पटेल अभियान — राष्ट्रीय एकता व अखंडता', 'Sardar Patel Campaign - National Integration')) ?>" class="w-full h-full object-contain rounded-2xl">
            <!-- Badges -->
            <div class="absolute top-4 left-4 flex flex-col gap-2 z-10">
              <span class="inline-flex items-center gap-1.5 bg-[#14532D] text-white px-3 py-1 rounded-full text-xs font-bold shadow-md">
                <span class="material-symbols-outlined text-[15px] text-[#F4C96B]">flag</span>
                <span><?= e(ps_text('प्राथमिक मुख्य जन-अभियान', 'Primary Flagship Campaign')) ?></span>
              </span>
              <span class="inline-flex items-center gap-1.5 bg-white/95 backdrop-blur-md text-[#14532D] px-3 py-1 rounded-full text-xs font-bold shadow-sm border border-[#E5E7EB]">
                <span class="material-symbols-outlined text-[15px] text-[#C05632]">military_tech</span>
                <span><?= e(ps_text('1987 से राष्ट्रीय चेतना व अखंड भारत संकल्प', 'Since 1987 — National Unity Mission')) ?></span>
              </span>
            </div>
          </div>

          <!-- Content Column -->
          <div class="lg:w-7/12 p-6 sm:p-10 flex flex-col justify-between">
            <div>
              <div class="flex flex-wrap items-center justify-between gap-3 mb-3">
                <div class="inline-flex items-center gap-1.5 text-xs uppercase font-bold text-[#C05632] tracking-wider bg-[#FAF8F3] px-3 py-1 rounded-full border border-[#C05632]/30">
                  <span class="material-symbols-outlined text-[15px]">verified</span>
                  <span><?= e(ps_text('सरदार पटेल समाजोत्थान ट्रस्ट • राष्ट्रीय एकता संकल्प', 'Sardar Patel Trust • National Unity Drive')) ?></span>
                </div>
                <span class="text-xs font-bold text-[#15803D] bg-[#F1F7F2] px-2.5 py-1 rounded-md border border-[#15803D]/20">
                  <?= e(ps_text('वार्षिक 20-दिवसीय चेतना रथ', 'Annual 20-Day Chetna Rath')) ?>
                </span>
              </div>

              <h3 class="font-headline-md text-2xl sm:text-3xl text-[#14532D] font-bold leading-snug mb-3">
                <?= e(ps_text('सरदार पटेल अभियान (राष्ट्रीय एकता, समरसता व युवा प्रेरणा)', 'Sardar Patel Integration Drive (Primary Movement)')) ?>
              </h3>

              <p class="text-base text-[#475467] leading-relaxed mb-6">
                <?= e(ps_text('लौह पुरुष सरदार वल्लभभाई पटेल के अखंड भारत, राष्ट्रीय एकता और सामाजिक समरसता के संदेश को जन-जन तक पहुँचाने हेतु संचालित प्रमुख अभियान। इसके माध्यम से युवाओं को राष्ट्र निर्माण, निःस्वार्थ जनसेवा, सर्वधर्म सद्भाव, पंच-दीप दीपोत्सव और सामाजिक बंधुत्व के प्रति निरंतर प्रेरित किया जाता है।', 'The flagship national integration initiative promoting Iron Man Sardar Vallabhbhai Patel’s vision of a united India, civic leadership, and youth harmony across Uttar Pradesh.')) ?>
              </p>

              <!-- Key Highlights Feature Box -->
              <div class="grid grid-cols-1 sm:grid-cols-3 gap-3.5 p-4 bg-[#F1F7F2] rounded-2xl mb-6 border border-[#E5E7EB]">
                <div class="flex items-start gap-2.5">
                  <span class="material-symbols-outlined text-[#C05632] text-[22px] mt-0.5">military_tech</span>
                  <div>
                    <span class="block text-sm font-bold text-[#14532D]">NSS 1987-88</span>
                    <span class="text-xs text-[#64748B]"><?= e(ps_text('गणतंत्र दिवस परेड प्रेरणा', 'Republic Day Parade Legacy')) ?></span>
                  </div>
                </div>
                <div class="flex items-start gap-2.5">
                  <span class="material-symbols-outlined text-[#15803D] text-[22px] mt-0.5">festival</span>
                  <div>
                    <span class="block text-sm font-bold text-[#14532D]">31 <?= e(ps_text('अक्टूबर दीपोत्सव', 'Oct Deepotsav')) ?></span>
                    <span class="text-xs text-[#64748B]"><?= e(ps_text('घर-घर पंच-दीप प्रज्वलन', 'Panch-Deep Celebration')) ?></span>
                  </div>
                </div>
                <div class="flex items-start gap-2.5">
                  <span class="material-symbols-outlined text-[#C05632] text-[22px] mt-0.5">diversity_3</span>
                  <div>
                    <span class="block text-sm font-bold text-[#14532D]"><?= e(ps_text('पटेल चेतना रथ', 'Chetna Rath Drive')) ?></span>
                    <span class="text-xs text-[#64748B]"><?= e(ps_text('विश्व की प्रथम पटेल आरती', 'Historic Patel Aarti')) ?></span>
                  </div>
                </div>
              </div>
            </div>

            <!-- Footer Actions -->
            <div class="flex flex-wrap items-center justify-between gap-4 pt-5 border-t border-[#E5E7EB]">
              <div class="flex flex-wrap items-center gap-3">
                <a href="<?= e(base_url('/campaigns/sardar-patel-ekta')) ?>" class="inline-flex items-center gap-2 bg-[#14532D] hover:bg-[#0F3D21] text-white px-5 py-3 rounded-xl text-sm font-bold transition-all shadow-sm">
                  <span><?= e(ps_text('अभियान इतिहास व विस्तृत विवरण', 'Explore Sardar Patel Campaign')) ?></span>
                  <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
                </a>
                <a href="<?= e(base_url('/volunteer')) ?>" class="inline-flex items-center gap-2 bg-white hover:bg-[#F8FAFC] text-[#14532D] px-4 py-3 rounded-xl text-sm font-bold transition-all border border-[#CBD5E1]">
                  <span class="material-symbols-outlined text-[16px] text-[#C05632]">flag</span>
                  <span><?= e(ps_text('एकता दल से जुड़ें', 'Join Unity Wing')) ?></span>
                </a>
              </div>
              <span class="text-xs text-[#94A3B8] font-medium hidden sm:inline-block">#SardarPatelAbhiyan #NationalUnity #AkhandBharat</span>
            </div>
          </div>
        </article>

        <!-- ==============================================
             CARD 2: हरियाली-अभियान (ग्रीन गैंग व ग्रीन मॉर्निंग)
             ============================================== -->
        <article class="campaign-card lg:col-span-6 bg-white rounded-3xl shadow-sm hover:shadow-xl border border-[#E5E7EB] transition-all overflow-hidden flex flex-col justify-between" data-category="eco">
          <div>
            <div class="relative h-64 sm:h-72 w-full bg-[#18392B] overflow-hidden flex items-center justify-center p-3">
              <img src="<?= e($greenImg) ?>" alt="<?= e(ps_text('हरियाली-अभियान (ग्रीन गैंग)', 'Green Gang Movement')) ?>" class="w-full h-full object-contain rounded-2xl">
              <div class="absolute top-4 left-4">
                <span class="inline-flex items-center gap-1.5 bg-[#14532D] text-white px-3 py-1 rounded-full text-xs font-bold shadow-md">
                  <span class="material-symbols-outlined text-[14px] text-[#6FD08C]">eco</span>
                  <span><?= e(ps_text('स्थापना: 05 जून 2019 (पर्यावरण दिवस)', 'Founded: 05 June 2019')) ?></span>
                </span>
              </div>
            </div>

            <div class="p-6 sm:p-8">
              <div class="flex items-center gap-2 mb-2 text-xs font-bold uppercase tracking-wider text-[#15803D]">
                <span class="material-symbols-outlined text-[16px]">park</span>
                <span><?= e(ps_text('प्रकृति-केंद्रित जीवन शैली आंदोलन', 'Nature Lifestyle Movement')) ?></span>
              </div>
              <h3 class="text-xl sm:text-2xl font-bold text-[#14532D] mb-2">
                <?= e(ps_text('हरियाली-अभियान (\'ग्रीन गैंग\' एवं \'ग्रीन मॉर्निंग\')', 'Hariyali Abhiyan (\'Green Gang\' & \'Green Morning\')')) ?>
              </h3>
              <p class="text-sm font-semibold text-[#C05632] mb-3">
                <?= e(ps_text('50,000+ वृक्षारोपण एवं दैनिक अभिवादन में \'ग्रीन मॉर्निंग\' का शिष्टाचार', '50,000+ Trees Planted & Green Morning Greetings')) ?>
              </p>
              <p class="text-sm text-[#475467] leading-relaxed mb-6">
                <?= e(ps_text('धरती पर हरियाली बढ़ाने तथा जन-जन की जीवनशैली में प्रकृति प्रेम को शामिल कराने के उद्देश्य से स्थापित क्रांतिकारी पहल। अभिवादन में \'गुड मॉर्निंग\' की जगह \'ग्रीन-मॉर्निंग\' (Green Morning) बोलने का अभिनव शिष्टाचार।', 'A revolutionary initiative transforming morning greetings into ecological awareness across schools and rural panchayats.')) ?>
              </p>
              
              <div class="space-y-2 mb-6 bg-[#F1F7F2] p-4 rounded-2xl border border-[#E5E7EB]">
                <div class="flex items-center gap-2.5 text-[#14532D] text-xs sm:text-sm font-medium">
                  <span class="material-symbols-outlined text-[18px] text-[#15803D]">check_circle</span>
                  <span>50,000+ <?= e(ps_text('वृक्षारोपण एवं सतत संरक्षण संकल्प', 'Trees Planted & Protected')) ?></span>
                </div>
                <div class="flex items-center gap-2.5 text-[#14532D] text-xs sm:text-sm font-medium">
                  <span class="material-symbols-outlined text-[18px] text-[#15803D]">check_circle</span>
                  <span><?= e(ps_text('ग्रीन चौपाल, हरित प्रभात संवाद व युवा पौध दस्ता', 'Green Chaupal & Youth Squads')) ?></span>
                </div>
              </div>
            </div>
          </div>

          <div class="px-6 sm:px-8 pb-6 pt-3 border-t border-[#F1F5F9] flex items-center justify-between gap-3">
            <a href="<?= e(base_url('/green-gang')) ?>" class="inline-flex items-center gap-1.5 bg-[#14532D] hover:bg-[#0F3D21] text-white px-4 py-2.5 rounded-xl text-sm font-bold transition-all shadow-xs">
              <span><?= e(ps_text('विस्तृत विवरण देखें', 'Explore Green Gang')) ?></span>
              <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
            </a>
            <a href="<?= e(base_url('/volunteer')) ?>" class="inline-flex items-center gap-1.5 bg-[#FAF8F3] hover:bg-[#F1F7F2] text-[#14532D] px-3.5 py-2.5 rounded-xl text-sm font-semibold transition-all border border-[#CBD5E1]">
              <span class="material-symbols-outlined text-[16px] text-[#15803D]">nature</span>
              <span><?= e(ps_text('पौधा गोद लें', 'Sponsor Tree')) ?></span>
            </a>
          </div>
        </article>

        <!-- ==============================================
             CARD 3: परिंदा संवर्धन व जल-सकोरा अभियान
             ============================================== -->
        <article class="campaign-card lg:col-span-6 bg-white rounded-3xl shadow-sm hover:shadow-xl border border-[#E5E7EB] transition-all overflow-hidden flex flex-col justify-between" data-category="bird">
          <div>
            <div class="relative h-64 sm:h-72 w-full bg-[#FAF8F3] overflow-hidden flex items-center justify-center p-3">
              <img src="<?= e($parindaImg) ?>" alt="<?= e(ps_text('परिंदा संवर्धन व जल-सकोरा अभियान', 'Bird Conservation Campaign')) ?>" class="w-full h-full object-contain rounded-2xl">
              <div class="absolute top-4 left-4">
                <span class="inline-flex items-center gap-1.5 bg-[#C05632] text-white px-3 py-1 rounded-full text-xs font-bold shadow-md">
                  <span class="material-symbols-outlined text-[14px]">nest_cam_wired_stand</span>
                  <span><?= e(ps_text('मूक पक्षी रक्षा एवं जीव-दया', 'Bird Care & Compassion')) ?></span>
                </span>
              </div>
            </div>

            <div class="p-6 sm:p-8">
              <div class="flex items-center gap-2 mb-2 text-xs font-bold uppercase tracking-wider text-[#C05632]">
                <span class="material-symbols-outlined text-[16px]">water_drop</span>
                <span><?= e(ps_text('गर्मी में मूक पक्षियों हेतु अमृत धारा', 'Summer Water Lifeline for Birds')) ?></span>
              </div>
              <h3 class="text-xl sm:text-2xl font-bold text-[#14532D] mb-2">
                <?= e(ps_text('परिंदा संवर्धन व जल-सकोरा अभियान', 'Sparrow & Bird Conservation (Water Bowls)')) ?>
              </h3>
              <p class="text-sm font-semibold text-[#15803D] mb-3">
                <?= e(ps_text('10,000+ मिट्टी के सकोरे, दाना-पानी प्रबंध एवं गौरैया संरक्षण', '10,000+ Earthen Water Pots & Sparrow Shelters')) ?>
              </p>
              <p class="text-sm text-[#475467] leading-relaxed mb-6">
                <?= e(ps_text('भीषण गर्मी में प्यास से तड़पते बेजुबान पक्षियों हेतु घर-घर, छतों व सार्वजनिक वृक्षों पर मिट्टी के जलपात्र (सकोरे) रखने और दाना चुगाने की जन-जागरूकता मुहिम। विलुप्त होती गौरैया के लिए घोंसले और सुरक्षित आश्रय स्थल का निर्माण।', 'Distributing clay water bowls and food shelters for sparrows and birds to survive blistering summers.')) ?>
              </p>
              
              <div class="space-y-2 mb-6 bg-[#FAF8F3] p-4 rounded-2xl border border-[#E5E7EB]">
                <div class="flex items-center gap-2.5 text-[#14532D] text-xs sm:text-sm font-medium">
                  <span class="material-symbols-outlined text-[18px] text-[#C05632]">check_circle</span>
                  <span>10,000+ <?= e(ps_text('मिट्टी के जल-सकोरे एवं दानापात्र निशुल्क वितरित', 'Earthen Bowls Distributed')) ?></span>
                </div>
                <div class="flex items-center gap-2.5 text-[#14532D] text-xs sm:text-sm font-medium">
                  <span class="material-symbols-outlined text-[18px] text-[#C05632]">check_circle</span>
                  <span><?= e(ps_text('गौरैया दिवस चेतना व काष्ठ/मिट्टी घोंसला निर्माण', 'Sparrow Day Awareness & Nesting Drives')) ?></span>
                </div>
              </div>
            </div>
          </div>

          <div class="px-6 sm:px-8 pb-6 pt-3 border-t border-[#F1F5F9] flex items-center justify-between gap-3">
            <a href="<?= e(base_url('/volunteer')) ?>" class="inline-flex items-center gap-1.5 bg-[#14532D] hover:bg-[#0F3D21] text-white px-4 py-2.5 rounded-xl text-sm font-bold transition-all shadow-xs">
              <span><?= e(ps_text('सकोरा मुहिम से जुड़ें', 'Join Water Pot Drive')) ?></span>
              <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
            </a>
            <a href="<?= e(base_url('/donation')) ?>" class="inline-flex items-center gap-1.5 bg-[#FAF8F3] hover:bg-[#F1F7F2] text-[#14532D] px-3.5 py-2.5 rounded-xl text-sm font-semibold transition-all border border-[#CBD5E1]">
              <span class="material-symbols-outlined text-[16px] text-[#C05632]">volunteer_activism</span>
              <span><?= e(ps_text('सकोरे प्रायोजित करें', 'Sponsor Pots')) ?></span>
            </a>
          </div>
        </article>

        <!-- ==============================================
             CARD 4: अवधी भाषा व लोक-संस्कृति संवर्धन
             ============================================== -->
        <article class="campaign-card lg:col-span-6 bg-white rounded-3xl shadow-sm hover:shadow-xl border border-[#E5E7EB] transition-all overflow-hidden flex flex-col justify-between" data-category="culture">
          <div>
            <div class="relative h-64 sm:h-72 w-full bg-[#F1F7F2] overflow-hidden flex items-center justify-center p-3">
              <img src="<?= e($awadhiImg) ?>" alt="<?= e(ps_text('अवधी भाषा व साहित्य संवर्धन अभियान', 'Awadhi Language & Literature Campaign')) ?>" class="w-full h-full object-contain rounded-2xl">
              <div class="absolute top-4 left-4">
                <span class="inline-flex items-center gap-1.5 bg-[#14532D] text-white px-3 py-1 rounded-full text-xs font-bold shadow-md">
                  <span class="material-symbols-outlined text-[14px]">auto_stories</span>
                  <span><?= e(ps_text('मातृभाषा व लोक-संस्कृति संरक्षण', 'Awadhi Language Heritage')) ?></span>
                </span>
              </div>
            </div>

            <div class="p-6 sm:p-8">
              <div class="flex items-center gap-2 mb-2 text-xs font-bold uppercase tracking-wider text-[#15803D]">
                <span class="material-symbols-outlined text-[16px]">history_edu</span>
                <span><?= e(ps_text('साहित्यिक अस्मिता एवं शब्दकोश संकलन', 'Literary Identity & Lexicon Drive')) ?></span>
              </div>
              <h3 class="text-xl sm:text-2xl font-bold text-[#14532D] mb-2">
                <?= e(ps_text('अवधी भाषा व लोक-संस्कृति संवर्धन अभियान', 'Awadhi Language & Folk Culture Promotion')) ?>
              </h3>
              <p class="text-sm font-semibold text-[#C05632] mb-3">
                <?= e(ps_text('काव्य-गोष्ठियाँ, अवधी शब्दकोश एवं ग्रामीण चौपाल साहित्य', 'Poetic Chaupals, Lexicon & Folk Literature')) ?>
              </p>
              <p class="text-sm text-[#475467] leading-relaxed mb-6">
                <?= e(ps_text('हिंदी एवं अवधी भाषा के विस्मृत होते शब्दों, मुहावरों, लोकगीतों और ग्रामीण सांस्कृतिक मूल्यों को सहेजने के लिए निरंतर काव्य-गोष्ठियों, अवधी गद्य लेखन, सारंग-कुंडलियाँ और शोध पत्रिकाओं का जन-प्रसार।', 'Preserving dying Awadhi idioms, folk songs, rural dialects, and poetic heritage through village chaupals.')) ?>
              </p>
              
              <div class="space-y-2 mb-6 bg-[#F1F7F2] p-4 rounded-2xl border border-[#E5E7EB]">
                <div class="flex items-center gap-2.5 text-[#14532D] text-xs sm:text-sm font-medium">
                  <span class="material-symbols-outlined text-[18px] text-[#15803D]">check_circle</span>
                  <span><?= e(ps_text('काव्य-मंजरी, सारंग-कुंडलियाँ व अवधी लोक शोध प्रकाशन', 'Sarang-Kundaliyan & Awadhi Publications')) ?></span>
                </div>
                <div class="flex items-center gap-2.5 text-[#14532D] text-xs sm:text-sm font-medium">
                  <span class="material-symbols-outlined text-[18px] text-[#15803D]">check_circle</span>
                  <span><?= e(ps_text('मासिक अवधी चौपाल संगोष्ठी एवं ग्रामीण युवा कवि मंच', 'Monthly Rural Poet Gatherings')) ?></span>
                </div>
              </div>
            </div>
          </div>

          <div class="px-6 sm:px-8 pb-6 pt-3 border-t border-[#F1F5F9] flex items-center justify-between gap-3">
            <a href="<?= e(base_url('/blog')) ?>" class="inline-flex items-center gap-1.5 bg-[#14532D] hover:bg-[#0F3D21] text-white px-4 py-2.5 rounded-xl text-sm font-bold transition-all shadow-xs">
              <span><?= e(ps_text('अवधी साहित्य व रचनाएं पढ़ें', 'Read Awadhi Works')) ?></span>
              <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
            </a>
            <a href="<?= e(base_url('/contact')) ?>" class="inline-flex items-center gap-1.5 bg-[#FAF8F3] hover:bg-[#F1F7F2] text-[#14532D] px-3.5 py-2.5 rounded-xl text-sm font-semibold transition-all border border-[#CBD5E1]">
              <span class="material-symbols-outlined text-[16px] text-[#15803D]">mic</span>
              <span><?= e(ps_text('गोष्ठी में शामिल हों', 'Join Symposium')) ?></span>
            </a>
          </div>
        </article>

        <!-- ==============================================
             CARD 5: तुलसी जयंती पखवारा (16 से 31 अगस्त)
             ============================================== -->
        <article class="campaign-card lg:col-span-6 bg-white rounded-3xl shadow-sm hover:shadow-xl border border-[#E5E7EB] transition-all overflow-hidden flex flex-col justify-between" data-category="culture">
          <div>
            <div class="relative h-64 sm:h-72 w-full bg-[#FAF8F3] overflow-hidden flex items-center justify-center p-3">
              <img src="<?= e($tulsiImg) ?>" alt="<?= e(ps_text('तुलसी जयंती पखवारा', 'Tulsi Jayanti Fortnight')) ?>" class="w-full h-full object-contain rounded-2xl">
              <div class="absolute top-4 left-4">
                <span class="inline-flex items-center gap-1.5 bg-[#C05632] text-white px-3 py-1 rounded-full text-xs font-bold shadow-md">
                  <span class="material-symbols-outlined text-[14px]">menu_book</span>
                  <span>16-31 <?= e(ps_text('अगस्त वार्षिक उत्सव', 'August Annual Festival')) ?></span>
                </span>
              </div>
            </div>

            <div class="p-6 sm:p-8">
              <div class="flex items-center gap-2 mb-2 text-xs font-bold uppercase tracking-wider text-[#C05632]">
                <span class="material-symbols-outlined text-[16px]">import_contacts</span>
                <span><?= e(ps_text('रामचरितमानस के सामाजिक समरसता मूल्य', 'Social Harmony of Ramcharitmanas')) ?></span>
              </div>
              <h3 class="text-xl sm:text-2xl font-bold text-[#14532D] mb-2">
                <?= e(ps_text('तुलसी जयंती पखवारा (16 से 31 अगस्त)', 'Goswami Tulsidas Jayanti Fortnight')) ?>
              </h3>
              <p class="text-sm font-semibold text-[#15803D] mb-3">
                <?= e(ps_text('16-दिवसीय विचार व्याख्यानमाला, मानस गोष्ठी एवं जीवन-मूल्य प्रसार', '16-Day Cultural Lecture Series & Moral Education')) ?>
              </p>
              <p class="text-sm text-[#475467] leading-relaxed mb-6">
                <?= e(ps_text('महाकवि गोस्वामी तुलसीदास जी के जीवन दर्शन, रामचरितमानस की सामाजिक समरसता, नैतिक सदाचार एवं अवधी भाषा की मिठास को नई पीढ़ी तक पहुंचाने हेतु प्रतिवर्ष आयोजित होने वाला भव्य 16-दिवसीय सांस्कृतिक उत्सव।', 'An annual 16-day cultural fest honoring Goswami Tulsidas, moral living, and social fraternity.')) ?>
              </p>
              
              <div class="space-y-2 mb-6 bg-[#FAF8F3] p-4 rounded-2xl border border-[#E5E7EB]">
                <div class="flex items-center gap-2.5 text-[#14532D] text-xs sm:text-sm font-medium">
                  <span class="material-symbols-outlined text-[18px] text-[#C05632]">check_circle</span>
                  <span><?= e(ps_text('प्रतिवर्ष 16 से 31 अगस्त निरंतर सारंग सदन व अंचलों में आयोजन', 'Annual 16-31 August Celebrations')) ?></span>
                </div>
                <div class="flex items-center gap-2.5 text-[#14532D] text-xs sm:text-sm font-medium">
                  <span class="material-symbols-outlined text-[18px] text-[#C05632]">check_circle</span>
                  <span><?= e(ps_text('विद्यार्थी मानस प्रतियोगिताएं, वक्तृत्व व अवधी गायन', 'Youth Recitation & Awadhi Hymn Contests')) ?></span>
                </div>
              </div>
            </div>
          </div>

          <div class="px-6 sm:px-8 pb-6 pt-3 border-t border-[#F1F5F9] flex items-center justify-between gap-3">
            <a href="<?= e(base_url('/campaigns/tulsi-abhiyan-16-31-2026')) ?>" class="inline-flex items-center gap-1.5 bg-[#14532D] hover:bg-[#0F3D21] text-white px-4 py-2.5 rounded-xl text-sm font-bold transition-all shadow-xs">
              <span><?= e(ps_text('पखवारा विवरण देखें', 'View Event Details')) ?></span>
              <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
            </a>
            <a href="<?= e(base_url('/contact')) ?>" class="inline-flex items-center gap-1.5 bg-[#FAF8F3] hover:bg-[#F1F7F2] text-[#14532D] px-3.5 py-2.5 rounded-xl text-sm font-semibold transition-all border border-[#CBD5E1]">
              <span class="material-symbols-outlined text-[16px] text-[#C05632]">calendar_month</span>
              <span><?= e(ps_text('सहभागी बनें', 'Participate')) ?></span>
            </a>
          </div>
        </article>

        <?php
        // Filter out dynamic campaigns matching standard builtin slugs
        $builtinSlugs = ['hariyali-campaign', 'bird-conservation-campaign', 'tulsi-pakhwara', 'language-and-literature-promotion-campaign', 'patel-campaign', 'hariyali', 'parinda', 'tulsi', 'awadhi', 'patel', 'sardar-patel-ekta'];
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
            $cImage = ps_resolve_img($c['image'] ?? '', 'uploads/slider_final_1.webp');
            $cExcerpt = ps_excerpt($c, 200);
            $cCategory = strtolower($c['category'] ?? 'eco');
        ?>
        <!-- Dynamic Campaign Card (Added via Admin Database) -->
        <article class="campaign-card lg:col-span-6 bg-white rounded-3xl shadow-sm hover:shadow-xl border border-[#E5E7EB] transition-all overflow-hidden flex flex-col justify-between" data-category="<?= e($cCategory) ?>">
          <div>
            <div class="relative h-64 sm:h-72 w-full bg-[#18392B] overflow-hidden flex items-center justify-center p-3">
              <img src="<?= e($cImage) ?>" alt="<?= e($cTitle) ?>" class="w-full h-full object-contain rounded-2xl">
              <div class="absolute top-4 left-4">
                <span class="inline-flex items-center gap-1.5 bg-[#14532D] text-white px-3 py-1 rounded-full text-xs font-bold shadow-md">
                  <span class="material-symbols-outlined text-[14px] text-[#6FD08C]">campaign</span>
                  <span><?= e(ps_text('जन-सरोकार अभियान', 'Community Drive')) ?></span>
                </span>
              </div>
            </div>

            <div class="p-6 sm:p-8">
              <h3 class="text-xl sm:text-2xl font-bold text-[#14532D] mb-3">
                <?= e($cTitle) ?>
              </h3>
              <p class="text-sm text-[#475467] leading-relaxed mb-6">
                <?= e($cExcerpt) ?>
              </p>
            </div>
          </div>

          <div class="px-6 sm:px-8 pb-6 pt-3 border-t border-[#F1F5F9] flex items-center justify-between gap-3">
            <a href="<?= e(base_url('/campaigns/' . $cSlug)) ?>" class="inline-flex items-center gap-1.5 bg-[#14532D] hover:bg-[#0F3D21] text-white px-4 py-2.5 rounded-xl text-sm font-bold transition-all shadow-xs">
              <span><?= e(ps_text('अभियान विवरण देखें', 'View Campaign Details')) ?></span>
              <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
            </a>
            <a href="<?= e(base_url('/volunteer')) ?>" class="inline-flex items-center gap-1.5 bg-[#FAF8F3] hover:bg-[#F1F7F2] text-[#14532D] px-3.5 py-2.5 rounded-xl text-sm font-semibold transition-all border border-[#CBD5E1]">
              <span class="material-symbols-outlined text-[16px] text-[#15803D]">handshake</span>
              <span><?= e(ps_text('सहभागिता करें', 'Participate')) ?></span>
            </a>
          </div>
        </article>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <!-- 5. "अभियानों में कैसे जुड़ें?" (How to Get Involved - 3 Pillars) -->
  <section class="w-full bg-[#F1F7F2] py-12 lg:py-16 border-t border-b border-[#E5E7EB]" id="volunteer-involvement">
    <div class="max-w-container-max mx-auto px-4 sm:px-8">
      <div class="text-center max-w-2xl mx-auto mb-10">
        <span class="text-xs uppercase tracking-widest text-[#C05632] font-bold"><?= e(ps_text('सहभागिता के तीन सशक्त मार्ग', 'Three Ways to Participate')) ?></span>
        <h2 class="text-2xl sm:text-3xl text-[#14532D] font-bold mt-1"><?= e(ps_text('अभियानों में आप कैसे जुड़ सकते हैं?', 'How You Can Get Involved')) ?></h2>
        <p class="text-sm text-[#475467] mt-2 leading-relaxed">
          <?= e(ps_text('प्रत्येक नागरिक का छोटा सा योगदान धरती और समाज में एक बड़ी क्रांति ला सकता है। आप अपनी रुचि और सुविधानुसार सीधे सहभागी बन सकते हैं।', 'Every small contribution drives lasting impact. Participate according to your passion and availability.')) ?>
        </p>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-3 gap-6 sm:gap-8">
        <!-- Pillar 1 -->
        <div class="bg-white rounded-3xl p-8 shadow-xs hover:shadow-lg border border-[#E5E7EB] transition-all flex flex-col justify-between">
          <div>
            <div class="w-14 h-14 rounded-2xl bg-[#F1F7F2] flex items-center justify-center text-[#15803D] mb-6 border border-[#E2E8F0]">
              <span class="material-symbols-outlined text-[32px]">diversity_1</span>
            </div>
            <span class="text-xs font-bold uppercase tracking-wider text-[#15803D]"><?= e(ps_text('स्तम्भ १ • प्रत्यक्ष सेवा', 'Pillar 1 • Direct Service')) ?></span>
            <h3 class="text-xl font-bold text-[#14532D] mt-1 mb-3"><?= e(ps_text('\'ग्रीन गैंग\' के स्वयंसेवक बनें', 'Become a Green Gang Volunteer')) ?></h3>
            <p class="text-sm text-[#475467] leading-relaxed mb-6">
              <?= e(ps_text('वृक्षारोपण, परिंदा जलपात्र वितरण और गाँव की पर्यावरण सुरक्षा में अपना सक्रिय समय दें। अपने क्षेत्र में प्रकृति मित्रों का दस्ता तैयार करें।', 'Dedicate your time for tree planting, bird water pot distribution, and environmental youth squads in your village.')) ?>
            </p>
          </div>
          <a href="<?= e(base_url('/volunteer')) ?>" class="inline-flex items-center gap-2 text-[#15803D] hover:text-[#14532D] text-sm font-bold transition-colors">
            <span><?= e(ps_text('स्वयंसेवक फॉर्म भरें', 'Fill Volunteer Form')) ?></span>
            <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
          </a>
        </div>

        <!-- Pillar 2 -->
        <div class="bg-white rounded-3xl p-8 shadow-xs hover:shadow-lg border border-[#E5E7EB] transition-all flex flex-col justify-between">
          <div>
            <div class="w-14 h-14 rounded-2xl bg-[#FAF8F3] flex items-center justify-center text-[#C05632] mb-6 border border-[#E2E8F0]">
              <span class="material-symbols-outlined text-[32px]">campaign</span>
            </div>
            <span class="text-xs font-bold uppercase tracking-wider text-[#C05632]"><?= e(ps_text('स्तम्भ २ • सामुदायिक संवाद', 'Pillar 2 • Community Outreach')) ?></span>
            <h3 class="text-xl font-bold text-[#14532D] mt-1 mb-3"><?= e(ps_text('गाँव / विद्यालय में \'ग्रीन चौपाल\'', 'Host a Green Chaupal')) ?></h3>
            <p class="text-sm text-[#475467] leading-relaxed mb-6">
              <?= e(ps_text('अपने संस्थान, पंचायत या विद्यालय में प्रदीप सारंग जी को जन-संवाद, मानस विचार गोष्ठी, एकता चेतना अथवा पर्यावरण जागरूकता हेतु आमंत्रित करें।', 'Invite Pradeep Sarang to conduct environmental awareness or Awadhi literature sessions in your community.')) ?>
            </p>
          </div>
          <a href="<?= e(base_url('/contact')) ?>" class="inline-flex items-center gap-2 text-[#C05632] hover:text-[#A9472B] text-sm font-bold transition-colors">
            <span><?= e(ps_text('कार्यक्रम का आमंत्रण भेजें', 'Send Event Invite')) ?></span>
            <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
          </a>
        </div>

        <!-- Pillar 3 -->
        <div class="bg-white rounded-3xl p-8 shadow-xs hover:shadow-lg border border-[#E5E7EB] transition-all flex flex-col justify-between">
          <div>
            <div class="w-14 h-14 rounded-2xl bg-[#F1F7F2] flex items-center justify-center text-[#14532D] mb-6 border border-[#E2E8F0]">
              <span class="material-symbols-outlined text-[32px]">volunteer_activism</span>
            </div>
            <span class="text-xs font-bold uppercase tracking-wider text-[#14532D]"><?= e(ps_text('स्तम्भ ३ • साधन सहयोग', 'Pillar 3 • Resource Support')) ?></span>
            <h3 class="text-xl font-bold text-[#14532D] mt-1 mb-3"><?= e(ps_text('सकोरे व पौध संरक्षण प्रायोजित करें', 'Sponsor Water Bowls & Saplings')) ?></h3>
            <p class="text-sm text-[#475467] leading-relaxed mb-6">
              <?= e(ps_text('गर्मी के मौसम में मिट्टी के सकोरे, दाना-पानी सामग्री अथवा फलदार व छायादार पौधे प्रायोजित कर मूक पक्षियों व धरा की सेवा में सहयोग दें।', 'Sponsor earthen water pots, bird grains, or tree guards to empower frontline conservation.')) ?>
            </p>
          </div>
          <a href="<?= e(base_url('/donation')) ?>" class="inline-flex items-center gap-2 text-[#14532D] hover:text-[#0F3D21] text-sm font-bold transition-colors">
            <span><?= e(ps_text('सहयोग राशि / सामग्री दान', 'Sponsor a Cause')) ?></span>
            <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
          </a>
        </div>
      </div>
    </div>
  </section>

  <!-- 6. QUOTE BANNER SECTION -->
  <section class="w-full bg-white py-12 lg:py-16 text-center border-b border-[#E5E7EB]">
    <div class="max-w-3xl mx-auto px-4">
      <div class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-[#F1F7F2] text-[#15803D] mb-4 shadow-xs border border-[#E2E8F0]">
        <span class="material-symbols-outlined text-[26px]">format_quote</span>
      </div>
      <p class="font-quote-editorial text-xl sm:text-2xl text-[#14532D] leading-relaxed italic font-medium">
        "<?= e(ps_text('धरती को हरी-भरी बनाना और बेज़ुबानों की प्यास बुझाना केवल कर्म नहीं, आत्मा का धर्म है।', 'Greening the Earth and slaking the thirst of wildlife is not merely duty; it is the soul\'s calling.')) ?>"
      </p>
      <div class="flex items-center justify-center gap-3 mt-5">
        <div class="w-8 h-0.5 bg-[#15803D]"></div>
        <span class="text-base font-bold text-[#14532D]"><?= e(ps_text('प्रदीप सारंग', 'Pradeep Sarang')) ?></span>
        <div class="w-8 h-0.5 bg-[#15803D]"></div>
      </div>
      <span class="text-xs text-[#64748B] mt-1 block"><?= e(ps_text('पर्यावरणविद्, लोकसेवक एवं साहित्यकार, बाराबंकी', 'Environmentalist, Social Worker & Author, Barabanki')) ?></span>
    </div>
  </section>

  <!-- 7. LEADERSHIP CTA BANNER -->
  <section class="w-full bg-[#FAF8F3] py-12 lg:py-16">
    <div class="max-w-container-max mx-auto px-4 sm:px-8">
      <div class="bg-gradient-to-r from-[#14532D] via-[#18392B] to-[#15803D] rounded-3xl p-8 sm:p-12 text-white shadow-xl flex flex-col lg:flex-row items-center justify-between gap-8 border border-white/10">
        <div class="max-w-2xl">
          <div class="inline-flex items-center gap-2 bg-white/10 px-3.5 py-1 rounded-full text-xs text-[#F4C96B] mb-3 font-bold border border-white/15">
            <span class="material-symbols-outlined text-[15px]">leaderboard</span>
            <span><?= e(ps_text('स्थानीय नेतृत्व एवं जन-पहल', 'Leadership & Local Outreach')) ?></span>
          </div>
          <h3 class="text-2xl sm:text-3xl text-white font-bold leading-tight mb-3">
            <?= e(ps_text('क्या आप अपने क्षेत्र में हमारे किसी अभियान का नेतृत्व करना चाहते हैं?', 'Would You Like to Lead a Campaign in Your Village or School?')) ?>
          </h3>
          <p class="text-sm sm:text-base text-white/80 leading-relaxed">
            <?= e(ps_text('यदि आप अपने गाँव, कस्बे, विद्यालय अथवा संस्था में हरियाली, परिंदा दाना-पानी या अवधी साहित्य गोष्ठी का आयोजन कराना चाहते हैं, तो हमसे सीधा संपर्क करें।', 'If you want to organize a Green Morning drive or Awadhi literature session in your institution, contact us directly.')) ?>
          </p>
        </div>

        <div class="flex flex-col sm:flex-row items-center gap-4 w-full lg:w-auto shrink-0">
          <a href="tel:<?= e($phoneClean) ?>" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 bg-[#F4C96B] hover:bg-[#E5BA5A] text-[#14532D] px-6 py-3.5 rounded-xl text-base font-bold transition-all shadow-md">
            <span class="material-symbols-outlined text-[20px]">call</span>
            <span><?= e(ps_text('सीधा संवाद (', 'Direct Call (')) ?><?= e($phone) ?>)</span>
          </a>
          <a href="<?= e(base_url('/contact')) ?>" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 bg-white/15 hover:bg-white/25 text-white px-6 py-3.5 rounded-xl text-base font-bold transition-all border border-white/20">
            <span class="material-symbols-outlined text-[20px]">edit_note</span>
            <span><?= e(ps_text('संपर्क प्रपत्र भरें', 'Fill Contact Form')) ?></span>
          </a>
        </div>
      </div>
    </div>
  </section>
</div>

<!-- Interactive Category Filter Script -->
<script>
  (function() {
    const tabs = document.querySelectorAll('.campaign-tab-btn');
    const cards = document.querySelectorAll('.campaign-card');

    tabs.forEach(tab => {
      tab.addEventListener('click', () => {
        const filter = tab.getAttribute('data-filter');

        // Toggle active tab styles
        tabs.forEach(t => {
          t.classList.remove('bg-[#14532D]', 'text-white', 'shadow-xs');
          t.classList.add('text-[#475467]');
        });
        tab.classList.add('bg-[#14532D]', 'text-white', 'shadow-xs');
        tab.classList.remove('text-[#475467]');

        // Filter cards smoothly
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
