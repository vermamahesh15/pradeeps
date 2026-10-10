<?php
declare(strict_types=1);

$title = ps_text('गौरैया बचाओ अभियान — "छत पर और आँगन में आओ सहेजें गौरैया"', 'Save Sparrows Campaign — Protect Sparrows in Courtyards & Rooftops');
$image = ps_resolve_img('uploads/campaigns/gauriya.webp', 'uploads/campaigns/gauriya.webp');
$pageUrl = base_url('/campaigns/gauraiya-bachao-abhiyan');
$waShareText = rawurlencode("गौरैया बचाओ अभियान — \"छत पर और आँगन में आओ सहेजें गौरैया\" रखें दाना और पानी।\n\nसमस्या: भीषण गर्मी में पानी और भोजन के अभाव में बेजुबान पक्षियों की असमय मृत्यु एवं विलुप्त होती गौरैया का संकट।\nपहल: प्रदीप सारंग द्वारा हरित स्वयं सेवकों की टीम बनाकर 10,000+ मिट्टी के जल-सकोरों का जनसहयोग से निःशुल्क वितरण एवं घर की छतों पर नियमित दाना-पानी व्यवस्था।\nपरिणाम: हजारों परिंदों को मिला जीवन।\n\nविस्तृत विवरण देखें:\n" . $pageUrl);
?>

<div class="flex flex-col w-full">
<!-- 1. HERO SECTION -->
<section class="relative w-full bg-gradient-to-b from-soft-meadow via-surface-container-low to-pure-white overflow-hidden py-10 sm:py-16 border-b border-border-warm">
  <div class="max-w-container-max mx-auto px-4 sm:px-8 relative z-10">
    <!-- Breadcrumb -->
    <nav aria-label="Breadcrumb" class="flex items-center gap-2 font-label-md text-label-md text-text-muted mb-6">
      <a class="hover:text-primary transition-colors flex items-center gap-1" href="<?= e(base_url('/')) ?>">
        <span class="material-symbols-outlined text-[16px]">home</span>
        <span><?= e(ps_text('गृह', 'Home')) ?></span>
      </a>
      <span class="opacity-40">/</span>
      <a class="hover:text-primary transition-colors" href="<?= e(base_url('/campaigns')) ?>">
        <span><?= e(ps_text('प्रमुख अभियान', 'Campaigns')) ?></span>
      </a>
      <span class="opacity-40">/</span>
      <span class="text-deep-forest font-semibold"><?= e(ps_text('गौरैया बचाओ अभियान', 'Save Sparrows Campaign')) ?></span>
    </nav>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-12 items-center">
      <!-- Left Content Column -->
      <div class="lg:col-span-7 flex flex-col">
        <div class="inline-flex items-center gap-2 bg-primary-fixed/40 text-deep-forest px-4 py-1.5 rounded-full font-label-sm text-label-sm mb-4 border border-border-warm font-semibold w-fit">
          <span class="material-symbols-outlined text-[16px] text-secondary" style="font-variation-settings: 'FILL' 1;">nest_cam_iq_outdoor</span>
          <span><?= e(ps_text('जीव-दया व गौरैया संरक्षण • प्रदीप सारंग की जन-पहल', 'Bird Compassion & Sparrow Protection • Pradeep Sarang Initiative')) ?></span>
        </div>

        <h1 class="font-display-hero text-headline-lg sm:text-display-hero text-deep-forest mb-4 leading-tight tracking-tight font-bold">
          <?= e(ps_text('गौरैया बचाओ अभियान', 'Save Sparrows Campaign')) ?>
        </h1>

        <!-- Subtitle/Tagline Banner (Attractively Styled Premium Banner) -->
        <div class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-[#14532D] via-[#15803D] to-[#0F3D21] p-6 sm:p-7 shadow-lg mb-8 border border-[#22C55E]/30 group">
          <!-- Background Decorative Watermark & Floating Glow -->
          <div class="absolute -right-6 -bottom-6 text-white/10 pointer-events-none group-hover:scale-110 group-hover:rotate-6 transition-transform duration-700">
            <span class="material-symbols-outlined text-[140px]" style="font-variation-settings: 'FILL' 1;">nest_cam_iq_outdoor</span>
          </div>
          <div class="absolute top-0 right-1/4 w-32 h-32 bg-amber-400/10 rounded-full blur-2xl pointer-events-none"></div>

          <div class="relative z-10 flex flex-col space-y-3">
            <div class="inline-flex items-center gap-2 bg-white/20 backdrop-blur-md border border-white/30 px-3.5 py-1 rounded-full font-label-sm text-xs font-extrabold uppercase tracking-wider w-fit shadow-xs">
              <span class="material-symbols-outlined text-[15px]" style="color: #fef08a !important;">spa</span>
              <span style="color: #ffffff !important;"><?= e(ps_text('जन-चेतना संकल्प', 'Public Pledge')) ?></span>
            </div>

            <h2 class="font-headline-md text-xl sm:text-2xl lg:text-3xl font-extrabold tracking-tight leading-snug drop-shadow-xs" style="color: #ffffff !important;">
              <?= e(ps_text('"छत पर और आँगन में आओ सहेजें गौरैया"', '"Protect Sparrows in Courtyards and Rooftops"')) ?>
            </h2>

            <div class="flex items-center gap-2 pt-1">
              <span class="w-8 h-8 rounded-xl bg-amber-400/25 border border-amber-300/40 flex items-center justify-center shrink-0 shadow-xs">
                <span class="material-symbols-outlined text-[18px]" style="color: #fef08a !important;">water_drop</span>
              </span>
              <span class="font-title-lg text-lg sm:text-xl font-extrabold tracking-wide" style="color: #fef08a !important;">
                <?= e(ps_text('रखें दाना और पानी।', 'Provide food and fresh water.')) ?>
              </span>
            </div>
          </div>
        </div>

        <!-- Emotive Quote from Pradeep Sarang -->
        <div class="bg-soft-meadow rounded-2xl p-5 sm:p-6 mb-8 relative border border-border-warm shadow-xs">
          <p class="font-quote-editorial text-body-lg text-deep-forest italic mb-3 leading-relaxed">
            <?= e(ps_text('"भीषण गर्मी में जब जलस्रोत सूख जाते हैं, तब हमारी छतों पर रखे मिट्टी के सकोरे ही परिंदों के लिए जीवनदायी सिद्ध होते हैं। थालियों की जूठन और अन्न के दाने नालियों में न बहाकर परिंदों को समर्पित करना ही सच्ची जीव-दया है।"', '"When water sources dry up in scorching summer, earthen water bowls on our roofs become life-savers for birds. Preserving leftover food and grains for birds rather than wasting them is true compassion for nature."')) ?>
          </p>
          <div class="flex items-center gap-3">
            <div class="w-9 h-9 rounded-full bg-primary-container flex items-center justify-center text-on-primary font-bold">
              <span class="material-symbols-outlined text-[18px]">eco</span>
            </div>
            <div class="flex flex-col">
              <span class="font-title-md text-title-md font-bold" style="color: #ef4444 !important;"><?= e(ps_text('प्रदीप सारंग', 'Pradeep Sarang')) ?></span>
              <span class="font-label-sm text-label-sm text-text-muted"><?= e(ps_text('प्रणेता — गौरैया संरक्षण एवं जल-सकोरा अभियान', 'Founder — Save Sparrows & Water Bowls Movement')) ?></span>
            </div>
          </div>
        </div>

        <!-- Action CTAs -->
        <div class="flex flex-wrap items-center gap-3.5">
          <a href="<?= e(base_url('/volunteer')) ?>" class="inline-flex items-center gap-2 bg-[#14532D] hover:bg-[#0F3D21] !text-white px-6 py-3.5 rounded-xl font-label-md text-sm font-bold shadow-md transition-all" style="color: #ffffff !important;">
            <span class="material-symbols-outlined text-[20px]" style="color: #ffffff !important;">water_drop</span>
            <span style="color: #ffffff !important;"><?= e(ps_text('सकोरा मित्र बनें', 'Join as Sakora Friend')) ?></span>
          </a>
        </div>
      </div>

      <!-- Right Visual Column -->
      <div class="lg:col-span-5 relative">
        <div class="relative rounded-3xl overflow-hidden shadow-xl bg-pure-white p-3.5 sm:p-4 border border-border-warm flex flex-col gap-3">
          <div class="relative w-full rounded-2xl overflow-hidden bg-surface-container-high border border-border-warm shadow-xs">
            <img src="<?= e($image) ?>" alt="<?= e($title) ?>" class="w-full h-auto object-contain">
          </div>
          <div class="p-3.5 bg-surface-container-low rounded-2xl border border-border-warm flex flex-col gap-1.5">
            <div class="flex items-center justify-between gap-2">
              <span class="font-label-sm text-xs text-secondary font-bold uppercase tracking-wider"><?= e(ps_text('गौरैया एवं परिंदा संरक्षण', 'Sparrow & Bird Conservation')) ?></span>
              <span class="font-label-sm text-xs text-text-muted font-semibold"><?= e(ps_text('जन-अभियान', 'Public Drive')) ?></span>
            </div>
            <h3 class="font-title-md text-title-md font-bold text-deep-forest mt-1">
              <?= e(ps_text('बेजुबानों की रक्षा, हमारा पावन कर्तव्य', 'Protecting Innocent Birds')) ?>
            </h3>
            <p class="font-body-sm text-xs text-text-muted leading-relaxed">
              <?= e(ps_text('बाराबंकी व आसपास के ग्रामीण अंचलों में नि:शुल्क मिट्टी के सकोरों का वितरण व दाना-पानी संकल्प।', 'Free earthen bowl distribution and daily bird feeding pledge across rural Barabanki.')) ?>
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- 2. CAMPAIGN CORE NARRATIVE (समस्या, पहल, परिणाम GRID) -->
<section class="py-12 sm:py-16 bg-pure-white border-b border-border-warm">
  <div class="max-w-container-max mx-auto px-4 sm:px-8">
    <div class="text-center max-w-3xl mx-auto mb-12">
      <span class="font-label-md text-label-md text-secondary uppercase font-bold tracking-wider">
        <?= e(ps_text('अभियान की त्रिवेणी', 'Campaign Pillars')) ?>
      </span>
      <h2 class="font-display-hero text-headline-md sm:text-headline-lg text-deep-forest font-bold mt-1">
        <?= e(ps_text('समस्या, पहल और प्रेरणादायी परिणाम', 'Challenge, Initiative & Impact')) ?>
      </h2>
      <p class="font-body-md text-text-muted mt-2">
        <?= e(ps_text('गौरैया बचाओ अभियान के तहत जमीनी स्तर पर किए गए प्रयास और उनके सकारात्मक प्रभाव', 'Grassroots efforts and positive impact created under Save Sparrows Initiative')) ?>
      </p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
      <!-- Problem Card -->
      <div class="bg-surface-container-low rounded-3xl p-6 sm:p-8 border border-border-warm flex flex-col justify-between shadow-xs hover:shadow-md transition-shadow relative overflow-hidden group">
        <div class="absolute top-0 left-0 right-0 h-2 bg-error"></div>
        <div>
          <div class="w-14 h-14 rounded-2xl bg-error/10 text-error flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
            <span class="material-symbols-outlined text-3xl">warning</span>
          </div>
          <span class="inline-block px-3 py-1 rounded-full bg-error/10 text-error font-label-sm text-xs font-bold uppercase mb-3">
            <?= e(ps_text('1. समस्या (The Challenge)', '1. Challenge')) ?>
          </span>
          <h3 class="font-headline-sm text-headline-sm text-deep-forest font-bold mb-3">
            <?= e(ps_text('जल-अन्न संकट व विलुप्त होती गौरैया', 'Water Crisis & Endangered Sparrows')) ?>
          </h3>
          <p class="font-body-md text-body-md text-text-muted leading-relaxed">
            <?= e(ps_text('भीषण गर्मी में पानी और भोजन के अभाव में बेजुबान पक्षियों की असमय मृत्यु एवं विलुप्त होती गौरैया का संकट।', 'The crisis of premature deaths among innocent birds and dwindling sparrow populations due to severe lack of food and water in harsh summer heat.')) ?>
          </p>
        </div>
        <div class="mt-6 pt-4 border-t border-surface-container flex items-center gap-2 text-error font-label-sm text-xs font-bold">
          <span class="material-symbols-outlined text-[16px]">thermostat</span>
          <span><?= e(ps_text('45°C ग्रीष्म ताप व सूखा संकट', 'Severe Summer Dehydration')) ?></span>
        </div>
      </div>

      <!-- Initiative Card -->
      <div class="bg-surface-container-low rounded-3xl p-6 sm:p-8 border border-border-warm flex flex-col justify-between shadow-xs hover:shadow-md transition-shadow relative overflow-hidden group">
        <div class="absolute top-0 left-0 right-0 h-2 bg-secondary"></div>
        <div>
          <div class="w-14 h-14 rounded-2xl bg-secondary-fixed/40 text-secondary flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
            <span class="material-symbols-outlined text-3xl">water_drop</span>
          </div>
          <span class="inline-block px-3 py-1 rounded-full bg-secondary-fixed/40 text-secondary font-label-sm text-xs font-bold uppercase mb-3">
            <?= e(ps_text('2. पहल (The Initiative)', '2. Initiative')) ?>
          </span>
          <h3 class="font-headline-sm text-headline-sm text-deep-forest font-bold mb-3">
            <?= e(ps_text('10,000+ सकोरे व दाना-पानी संकल्प', '10,000+ Water Bowls & Daily Feeding')) ?>
          </h3>
          <p class="font-body-md text-body-md text-text-muted leading-relaxed">
            <?= e(ps_text('प्रदीप सारंग द्वारा हरित स्वयं सेवकों की टीम बनाकर 10,000+ मिट्टी के जल-सकोरों का जनसहयोग से निःशुल्क वितरण एवं घर की छतों पर सुबह शाम थालियों की बची हुई झूठन को नालियों में न फेंककर, छत पर रखना यानी नियमित दाना-पानी व्यवस्था।', 'Pradeep Sarang formed a dedicated Green Volunteer Team to distribute 10,000+ clay water bowls free of cost, encouraging households to place leftover food and grains on rooftops instead of wasting them.')) ?>
          </p>
        </div>
        <div class="mt-6 pt-4 border-t border-surface-container flex items-center gap-2 text-secondary font-label-sm text-xs font-bold">
          <span class="material-symbols-outlined text-[16px]">volunteer_activism</span>
          <span><?= e(ps_text('10,000+ सकोरे • नि:शुल्क वितरण', '10k+ Bowls Free Distribution')) ?></span>
        </div>
      </div>

      <!-- Outcome Card -->
      <div class="bg-surface-container-low rounded-3xl p-6 sm:p-8 border border-border-warm flex flex-col justify-between shadow-xs hover:shadow-md transition-shadow relative overflow-hidden group">
        <div class="absolute top-0 left-0 right-0 h-2 bg-primary"></div>
        <div>
          <div class="w-14 h-14 rounded-2xl bg-primary-fixed/50 text-deep-forest flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
            <span class="material-symbols-outlined text-3xl">pets</span>
          </div>
          <span class="inline-block px-3 py-1 rounded-full bg-primary-fixed/50 text-deep-forest font-label-sm text-xs font-bold uppercase mb-3">
            <?= e(ps_text('3. परिणाम (The Outcome)', '3. Outcome')) ?>
          </span>
          <h3 class="font-headline-sm text-headline-sm text-deep-forest font-bold mb-3">
            <?= e(ps_text('हजारों परिंदों को जीवन व करुणा प्रसार', 'Thousands of Bird Lives Saved')) ?>
          </h3>
          <p class="font-body-md text-body-md text-text-muted leading-relaxed">
            <?= e(ps_text('हजारों परिंदों को मिला जीवन और आम जनमानस में बेजुबानों के प्रति करुणा का प्रसार।', 'Thousands of bird lives saved and a widespread wave of compassion fostered among local families and communities for innocent creatures.')) ?>
          </p>
        </div>
        <div class="mt-6 pt-4 border-t border-surface-container flex items-center gap-2 text-deep-forest font-label-sm text-xs font-bold">
          <span class="material-symbols-outlined text-[16px]">verified</span>
          <span><?= e(ps_text('सामुदायिक करुणा नेटवर्क', 'Community Compassion Network')) ?></span>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- 3. HOW TO PARTICIPATE / SAKORA PLEDGE -->
<section class="py-12 sm:py-16 bg-soft-meadow">
  <div class="max-w-container-max mx-auto px-4 sm:px-8">
    <div class="bg-pure-white rounded-3xl p-8 sm:p-12 border border-border-warm shadow-md flex flex-col md:flex-row items-center justify-between gap-8">
      <div class="flex-1 space-y-4">
        <span class="inline-block px-3 py-1 rounded-full bg-primary-fixed/40 text-deep-forest font-label-sm text-xs font-bold uppercase">
          <?= e(ps_text('हर घर दाना-पानी संकल्प', 'Every Household Bird Pledge')) ?>
        </span>
        <h3 class="font-display-hero text-headline-md sm:text-headline-lg text-deep-forest font-bold">
          <?= e(ps_text('आज ही अपने घर की छत पर रखें मिट्टी का सकोरा!', 'Place a Clay Water Bowl on Your Roof Today!')) ?>
        </h3>
        <p class="font-body-md text-text-muted leading-relaxed max-w-2xl">
          <?= e(ps_text('प्रकृति संरक्षण की शुरुआत अपने घर के आँगन और छत से करें। प्रातः व सायं थाली की बची भोजन सामग्री व ताज़ा जल परिंदों के लिए रखें।', 'Start environmental conservation right from your home. Keep fresh water and leftover food grains for sparrows every morning and evening.')) ?>
        </p>
      </div>

      <div class="flex flex-col sm:flex-row items-center gap-4 shrink-0">
        <a href="<?= e(base_url('/campaigns')) ?>" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 bg-deep-forest hover:bg-forest-night !text-white px-7 py-4 rounded-xl font-label-md text-sm font-bold shadow-md transition-all" style="color: #ffffff !important;">
          <span class="material-symbols-outlined text-[20px]" style="color: #ffffff !important;">arrow_back</span>
          <span style="color: #ffffff !important;"><?= e(ps_text('सभी अभियान देखें', 'All Campaigns')) ?></span>
        </a>
      </div>
    </div>
  </div>
</section>
</div>
