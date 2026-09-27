<?php
declare(strict_types=1);

$timeline = $timeline ?? [];
$personalPhotos = $personalPhotos ?? [];
$phone = trim($settings['phone'] ?? '+91 9919007190');
$phoneClean = preg_replace('/[^+0-9]/', '', $phone);
$email = trim($settings['email'] ?? 'contact@pradeepsarang.in');
?>

<div class="flex flex-col w-full">
  <!-- Top Breadcrumb & Page Banner Header -->
  <section class="relative w-full bg-soft-meadow overflow-hidden py-space-2xl md:py-space-3xl border-b border-border-warm">
    <div class="max-w-container-max mx-auto px-4 sm:px-8">
      <!-- Breadcrumb -->
      <nav aria-label="Breadcrumb" class="flex items-center gap-2 font-label-md text-label-md text-text-muted mb-space-sm">
        <a class="hover:text-primary transition-colors flex items-center gap-1" data-path="home" href="<?= e(base_url('/')) ?>">
          <span class="material-symbols-outlined text-[16px]">home</span>
          <span><?= e(ps_text('गृह (Home)', 'Home')) ?></span>
        </a>
        <span class="opacity-40">/</span>
        <span class="text-deep-forest font-semibold"><?= e(ps_text('परिचय एवं जीवन-दर्शन (About Pradeep Sarang)', 'About Pradeep Sarang')) ?></span>
      </nav>
      
      <!-- Badge & Main Editorial Title with Quick Section Navigator -->
      <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
        <!-- Left: Title & Mission Subtitle -->
        <div class="lg:col-span-7 flex flex-col">
          <div class="inline-flex items-center gap-2 bg-primary-fixed/40 text-deep-forest px-3.5 py-1 rounded-full font-label-sm text-label-sm mb-3 border border-border-warm font-semibold self-start">
            <span class="material-symbols-outlined text-[15px] text-primary-container" style="font-variation-settings: 'FILL' 1;">verified</span>
            <span><?= e(ps_text('चार दशकों की अविरल जनसेवा एवं लोक-चेतना (1987 से आज तक)', 'Four Decades of Community Dedication (1987 — Present)')) ?></span>
          </div>
          <h1 class="font-display-hero text-headline-lg md:text-display-hero text-deep-forest leading-tight tracking-tight font-bold">
            <?= e(ps_text('माटी का सरोकार, जनसेवा का संकल्प और अवधी की मिठास', 'Rooted in Service, Nature & Awadhi Heritage')) ?>
          </h1>
          <p class="font-body-lg text-body-lg text-text-muted mt-3 leading-relaxed">
            <?= e(ps_text('प्रदीप सारंग — एक बहुआयामी सामाजिक कार्यकर्ता, ग्रीन गैंग के प्रणेता और संवेदनशील साहित्यकार का सम्पूर्ण जीवन परिचय।', 'Pradeep Sarang — Social worker, founder of Green Gang, and Awadhi litterateur.')) ?>
          </p>
        </div>

        <!-- Right: Quick Navigation Card -->
        <div class="lg:col-span-5 bg-pure-white rounded-2xl p-5 border border-border-warm shadow-sm flex flex-col space-y-3.5">
          <span class="font-label-sm text-xs font-bold text-secondary uppercase tracking-wider flex items-center gap-1.5">
            <span class="material-symbols-outlined text-[16px]">explore</span>
            <span><?= e(ps_text('त्वरित अनुभाग मार्गदर्शिका', 'Quick Navigation')) ?></span>
          </span>
          
          <div class="grid grid-cols-1 sm:grid-cols-2 gap-2.5">
            <a href="#biography" class="flex items-center gap-2.5 bg-soft-meadow p-2.5 rounded-xl border border-border-warm hover:border-primary transition-colors group">
              <div class="w-8 h-8 rounded-lg bg-pure-white text-deep-forest flex items-center justify-center shrink-0 shadow-xs group-hover:scale-105 transition-transform">
                <span class="material-symbols-outlined text-[18px]">person</span>
              </div>
              <div class="flex flex-col">
                <span class="font-title-sm text-xs font-bold text-deep-forest"><?= e(ps_text('जीवन परिचय', 'Biography')) ?></span>
                <span class="font-label-sm text-[10px] text-text-muted"><?= e(ps_text('व्यक्तिगत यात्रा', 'Personal Vita')) ?></span>
              </div>
            </a>

            <a href="#life-planning" class="flex items-center gap-2.5 bg-soft-meadow p-2.5 rounded-xl border border-border-warm hover:border-primary transition-colors group">
              <div class="w-8 h-8 rounded-lg bg-pure-white text-primary-container flex items-center justify-center shrink-0 shadow-xs group-hover:scale-105 transition-transform">
                <span class="material-symbols-outlined text-[18px]">event_note</span>
              </div>
              <div class="flex flex-col">
                <span class="font-title-sm text-xs font-bold text-deep-forest"><?= e(ps_text('जीवन का नियोजन', 'Life Planning')) ?></span>
                <span class="font-label-sm text-[10px] text-text-muted"><?= e(ps_text('3 दायित्व • 5 आयाम', '3 Duties & 5 Dimensions')) ?></span>
              </div>
            </a>

            <a href="#philosophy" class="flex items-center gap-2.5 bg-soft-meadow p-2.5 rounded-xl border border-border-warm hover:border-primary transition-colors group">
              <div class="w-8 h-8 rounded-lg bg-pure-white text-secondary flex items-center justify-center shrink-0 shadow-xs group-hover:scale-105 transition-transform">
                <span class="material-symbols-outlined text-[18px]">psychology</span>
              </div>
              <div class="flex flex-col">
                <span class="font-title-sm text-xs font-bold text-deep-forest"><?= e(ps_text('दृष्टि व दर्शन', 'Philosophy')) ?></span>
                <span class="font-label-sm text-[10px] text-text-muted"><?= e(ps_text('मूल सिद्धान्त', 'Core Values')) ?></span>
              </div>
            </a>

            <a href="#awards" class="flex items-center gap-2.5 bg-soft-meadow p-2.5 rounded-xl border border-border-warm hover:border-primary transition-colors group">
              <div class="w-8 h-8 rounded-lg bg-pure-white text-tertiary flex items-center justify-center shrink-0 shadow-xs group-hover:scale-105 transition-transform">
                <span class="material-symbols-outlined text-[18px]">military_tech</span>
              </div>
              <div class="flex flex-col">
                <span class="font-title-sm text-xs font-bold text-deep-forest"><?= e(ps_text('सम्मान व पुरस्कार', 'Awards')) ?></span>
                <span class="font-label-sm text-[10px] text-text-muted"><?= e(ps_text('राज्यपाल पुरस्कार', 'State Honors')) ?></span>
              </div>
            </a>

            <a href="#archives" class="flex items-center gap-2.5 bg-soft-meadow p-2.5 rounded-xl border border-border-warm hover:border-primary transition-colors group">
              <div class="w-8 h-8 rounded-lg bg-pure-white text-primary flex items-center justify-center shrink-0 shadow-xs group-hover:scale-105 transition-transform">
                <span class="material-symbols-outlined text-[18px]">collections</span>
              </div>
              <div class="flex flex-col">
                <span class="font-title-sm text-xs font-bold text-deep-forest"><?= e(ps_text('अभिलेखागार', 'Archives')) ?></span>
                <span class="font-label-sm text-[10px] text-text-muted"><?= e(ps_text('1987 से आज तक', '1987 — Present')) ?></span>
              </div>
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- अभिरुचि एवं पसंदगी अनुरूप जीवन का नियोजन (LIFE & TIME PLANNING & SWAYAM UDGHOSH) -->
  <section class="w-full bg-gradient-to-b from-pure-white via-soft-meadow/50 to-pure-white py-space-2xl md:py-space-4xl border-b border-border-warm relative overflow-hidden scroll-mt-24" id="life-planning">
    <div class="max-w-container-max mx-auto px-4 sm:px-8">
      
      <!-- Section Title & Subheading -->
      <div class="text-center max-w-3xl mx-auto mb-space-xl">
        <div class="inline-flex items-center gap-2 bg-primary-container text-on-primary px-4 py-1.5 rounded-full font-label-sm text-label-sm font-bold mb-3 shadow-xs">
          <span class="material-symbols-outlined text-[16px]">schedule</span>
          <span><?= e(ps_text('जीवन-दर्शन एवं समय प्रबंधन', 'Life Philosophy & Time Management')) ?></span>
        </div>
        <h2 class="font-headline-lg text-headline-md md:text-headline-lg text-deep-forest font-bold tracking-tight">
          <?= e(ps_text('अभिरुचि एवं पसंदगी अनुरूप जीवन का नियोजन', 'Life & Time Planning According to Aptitude & Passion')) ?>
        </h2>
        <div class="w-24 h-1 bg-gradient-to-r from-primary-container via-secondary to-tertiary mx-auto mt-3 rounded-full"></div>
      </div>

      <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-start">
        
        <!-- Left Column: The Uploaded Poster Showcase Card (स्व-उद्घोष) -->
        <div class="lg:col-span-5 flex flex-col">
          <div class="bg-pure-white rounded-3xl p-5 sm:p-6 shadow-md border border-border-warm relative overflow-hidden group hover:shadow-xl transition-all duration-300">
            <!-- Header Tag -->
            <div class="flex items-center justify-between pb-4 mb-4 border-b border-border-warm">
              <div class="flex items-center gap-2 text-deep-forest">
                <span class="material-symbols-outlined text-primary-container text-[24px]">workspace_premium</span>
                <div>
                  <span class="font-title-md text-title-md font-bold block leading-tight"><?= e(ps_text('स्व-उद्घोष', 'Swayam Udghosh')) ?></span>
                  <span class="font-label-sm text-[11px] text-text-muted"><?= e(ps_text('श्री प्रदीप सारंग का जीवन-संकल्प पत्र', 'Life Vow Poster by Pradeep Sarang')) ?></span>
                </div>
              </div>
              <button type="button" onclick="openSwayUdghoshModal()" class="px-3 py-1 rounded-full bg-soft-meadow hover:bg-primary-container hover:text-on-primary text-deep-forest font-label-sm text-xs transition-colors border border-border-warm font-semibold flex items-center gap-1 cursor-pointer">
                <span class="material-symbols-outlined text-[14px]">fullscreen</span>
                <span><?= e(ps_text('ज़ूम करें', 'Zoom')) ?></span>
              </button>
            </div>

            <!-- Poster Image Container -->
            <div class="relative rounded-2xl overflow-hidden border border-border-warm shadow-inner group/img cursor-pointer bg-surface-container" onclick="openSwayUdghoshModal()">
              <img src="<?= e(base_url('assets/images/swayudghosh.jpg')) ?>" 
                   alt="<?= e(ps_text('स्व-उद्घोष - अभिरुचि एवं पसंदगी अनुरूप जीवन का नियोजन', 'Swayam Udghosh - Life Planning Poster')) ?>" 
                   class="w-full h-auto max-h-[580px] object-cover object-top group-hover/img:scale-105 transition-transform duration-500">
              
              <!-- Hover Overlay -->
              <div class="absolute inset-0 bg-deep-forest/40 opacity-0 group-hover/img:opacity-100 transition-opacity duration-300 flex flex-col items-center justify-center p-6 text-pure-white text-center">
                <div class="w-14 h-14 rounded-full bg-pure-white/20 backdrop-blur-md flex items-center justify-center mb-2 text-pure-white shadow-lg">
                  <span class="material-symbols-outlined text-[32px]">zoom_in</span>
                </div>
                <span class="font-title-md text-base font-bold"><?= e(ps_text('स्व-उद्घोष कविता व पोस्टर विस्तार से पढ़ें', 'Click to read full Swayam Udghosh poster')) ?></span>
              </div>
            </div>

            <!-- Poster Caption Banner -->
            <div class="mt-4 p-3.5 bg-soft-meadow rounded-xl border border-border-warm text-center">
              <span class="font-quote-editorial text-sm italic text-deep-forest block font-semibold">
                "असंभव को संभव, बनाने चले हैं। मरुस्थल में उपवन उगाने चले हैं॥"
              </span>
              <span class="font-label-sm text-[11px] text-text-muted mt-1 block">
                <?= e(ps_text('— ' . 'हरे पेड़ एक बेहतर कल • प्रकृति है तो भविष्य है', 'Green Trees Better Tomorrow')) ?>
              </span>
            </div>

            <!-- Quick Vita Table under Image -->
            <div class="mt-5 pt-4 border-t border-border-warm space-y-3 font-body-sm text-body-sm">
              <div class="flex justify-between items-start py-2 border-b border-border-warm/60">
                <span class="text-text-muted font-medium w-36 flex items-center gap-1.5">
                  <span class="material-symbols-outlined text-[16px] text-secondary">badge</span>
                  <span><?= e(ps_text('पूरा नाम:', 'Full Name:')) ?></span>
                </span>
                <span class="text-on-surface font-semibold text-right flex-1"><?= e(ps_text('प्रदीप सारंग (Pradeep Sarang)', 'Pradeep Sarang')) ?></span>
              </div>
              <div class="flex justify-between items-start py-2 border-b border-border-warm/60">
                <span class="text-text-muted font-medium w-36 flex items-center gap-1.5">
                  <span class="material-symbols-outlined text-[16px] text-secondary">person</span>
                  <span><?= e(ps_text('पिता:', 'Father:')) ?></span>
                </span>
                <span class="text-on-surface text-right flex-1"><?= e(ps_text('श्री गोविंद प्रसाद', 'Shri Govind Prasad')) ?></span>
              </div>
              <div class="flex justify-between items-start py-2 border-b border-border-warm/60">
                <span class="text-text-muted font-medium w-36 flex items-center gap-1.5">
                  <span class="material-symbols-outlined text-[16px] text-secondary">family_restroom</span>
                  <span><?= e(ps_text('माता:', 'Mother:')) ?></span>
                </span>
                <span class="text-on-surface text-right flex-1"><?= e(ps_text('श्रीमती कृष्णावती (कृष्णादेवी)', 'Smt. Krishnavati')) ?></span>
              </div>
              <div class="flex justify-between items-start py-2 border-b border-border-warm/60">
                <span class="text-text-muted font-medium w-36 flex items-center gap-1.5">
                  <span class="material-symbols-outlined text-[16px] text-secondary">cake</span>
                  <span><?= e(ps_text('जन्म:', 'Date of Birth:')) ?></span>
                </span>
                <span class="text-on-surface text-right flex-1"><?= e(ps_text('20 अक्टूबर 1969 (दीपावली की पावन भोर)', '20 October 1969')) ?></span>
              </div>
              <div class="flex justify-between items-start py-2 border-b border-border-warm/60">
                <span class="text-text-muted font-medium w-36 flex items-center gap-1.5">
                  <span class="material-symbols-outlined text-[16px] text-secondary">location_on</span>
                  <span><?= e(ps_text('जन्मस्थान:', 'Birthplace:')) ?></span>
                </span>
                <span class="text-on-surface text-right flex-1"><?= e(ps_text('ग्राम कमरावां, जिला बाराबंकी, उत्तर प्रदेश, भारत', 'Gram Kamrawan, District Barabanki, Uttar Pradesh, India')) ?></span>
              </div>
              <div class="flex justify-between items-start py-2 border-b border-border-warm/60">
                <span class="text-text-muted font-medium w-36 flex items-center gap-1.5">
                  <span class="material-symbols-outlined text-[16px] text-secondary">school</span>
                  <span><?= e(ps_text('शैक्षणिक योग्यता:', 'Education:')) ?></span>
                </span>
                <span class="text-on-surface text-right flex-1"><?= e(ps_text('बी.ए., बी.एड., पी.जी. डिप्लोमा (अवधी भाषा व साहित्य), आयुर्वेद रत्न (1997)', 'B.A., B.Ed., PG Dip (Awadhi), Ayurveda Ratna')) ?></span>
              </div>
              <div class="flex justify-between items-start py-2">
                <span class="text-text-muted font-medium w-36 flex items-center gap-1.5">
                  <span class="material-symbols-outlined text-[16px] text-secondary">work</span>
                  <span><?= e(ps_text('प्रमुख दायित्व:', 'Roles:')) ?></span>
                </span>
                <span class="text-on-surface text-right flex-1"><?= e(ps_text('सह-संपादक \'सन्दौली टाइम्स\', संस्थापक \'ग्रीन गैंग\', जनक \'ग्रीन मॉर्निंग\' अभियान', 'Co-Editor Sandauli Times, Founder Green Gang')) ?></span>
              </div>

              <!-- Mini Callout in Vita Table -->
              <div class="mt-4 bg-soft-meadow rounded-xl p-3.5 flex items-center gap-3 border border-border-warm">
                <span class="material-symbols-outlined text-primary-container text-[24px]">workspace_premium</span>
                <div class="flex flex-col">
                  <span class="font-label-sm text-xs font-bold text-deep-forest"><?= e(ps_text('माननीय राज्यपाल द्वारा सम्मानित', 'Governor State Awardee')) ?></span>
                  <span class="font-body-sm text-xs text-text-muted"><?= e(ps_text('स्वामी विवेकानंद युवा पुरस्कार (1991)', 'Swami Vivekananda Youth Award (1991)')) ?></span>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Right Column: Narrative, 3 Duties & 5 Dimensions -->
        <div class="lg:col-span-7 flex flex-col space-y-6">

          <!-- Main Philosophy Intro Card -->
          <div class="bg-pure-white rounded-3xl p-6 sm:p-8 shadow-sm border border-border-warm">
            <span class="material-symbols-outlined text-primary-container text-[36px] mb-2 block opacity-80">format_quote</span>
            <p class="font-quote-editorial text-headline-sm md:text-title-lg text-deep-forest leading-relaxed font-bold mb-4">
              <?= e(ps_text('समय ही जीवन है, ऐसा मानकर अपने जीवन का यानी समय का नियोजन कर रखा है। श्री प्रदीप सारंग ने तीन दायित्व मानकर, पाँच आयाम निर्धारित करके जीवन समर्पित किया हुआ है—', 'Believing time to be life itself, Shri Pradeep Sarang has planned his life across 3 obligations and 5 dimensions.')) ?>
            </p>

            <!-- 3 Responsibilities Section -->
            <div class="mt-6 pt-6 border-t border-border-warm">
              <span class="font-label-sm text-xs font-bold text-secondary uppercase tracking-widest block mb-3.5 flex items-center gap-1.5">
                <span class="material-symbols-outlined text-[16px]">military_tech</span>
                <span><?= e(ps_text('तीन प्रमुख दायित्व (3 Key Responsibilities)', '3 Key Responsibilities')) ?></span>
              </span>

              <div class="grid grid-cols-1 sm:grid-cols-3 gap-3.5">
                <!-- 1. स्वयं -->
                <div class="bg-soft-meadow p-4 rounded-2xl border border-border-warm flex flex-col hover:border-primary transition-all">
                  <div class="w-8 h-8 rounded-xl bg-pure-white text-primary-container flex items-center justify-center font-mono font-bold text-sm mb-2 shadow-xs border border-border-warm">
                    1
                  </div>
                  <span class="font-title-sm text-sm font-bold text-deep-forest"><?= e(ps_text('स्वयं के प्रति दायित्व', 'Duty to Self')) ?></span>
                  <span class="font-body-sm text-[11px] text-text-muted mt-1"><?= e(ps_text('आत्म-अनुशासन, स्वास्थ्य व नैतिक निष्ठा', 'Self-discipline & ethics')) ?></span>
                </div>

                <!-- 2. परिवार -->
                <div class="bg-soft-meadow p-4 rounded-2xl border border-border-warm flex flex-col hover:border-secondary transition-all">
                  <div class="w-8 h-8 rounded-xl bg-pure-white text-secondary flex items-center justify-center font-mono font-bold text-sm mb-2 shadow-xs border border-border-warm">
                    2
                  </div>
                  <span class="font-title-sm text-sm font-bold text-deep-forest"><?= e(ps_text('परिवार के प्रति दायित्व', 'Duty to Family')) ?></span>
                  <span class="font-body-sm text-[11px] text-text-muted mt-1"><?= e(ps_text('गृहस्थ धर्म, संस्कार व परिजन देखभाल', 'Domestic duties & family ethics')) ?></span>
                </div>

                <!-- 3. देश और समाज -->
                <div class="bg-soft-meadow p-4 rounded-2xl border border-border-warm flex flex-col hover:border-tertiary transition-all">
                  <div class="w-8 h-8 rounded-xl bg-pure-white text-tertiary flex items-center justify-center font-mono font-bold text-sm mb-2 shadow-xs border border-border-warm">
                    3
                  </div>
                  <span class="font-title-sm text-sm font-bold text-deep-forest"><?= e(ps_text('देश और समाज के प्रति दायित्व', 'Duty to Nation & Society')) ?></span>
                  <span class="font-body-sm text-[11px] text-text-muted mt-1"><?= e(ps_text('निःस्वार्थ जनसेवा व पर्यावरण रक्षा', 'Selfless service & eco-drives')) ?></span>
                </div>
              </div>
            </div>

            <!-- Transition Text -->
            <div class="mt-6 p-4 rounded-2xl bg-surface-container-low border border-border-warm font-body-md text-sm text-on-surface-variant leading-relaxed">
              <?= e(ps_text('गृहस्थ जीवन में अपने और परिवार के प्रति दायित्व का निर्वहन करते हुए देश और समाज के निमित्त पाँच आयाम सुनिश्चित कर सम्पूर्ण-जीवन यानी समय को योजित किया हुआ है। जो निम्नवत है—', 'Fulfilling duties towards self and family in household life, he dedicated his whole life-time to 5 nation-building dimensions:')) ?>
            </div>
          </div>

          <!-- 5 Dimensions Grid (पाँच आयाम) -->
          <div class="space-y-3.5">
            <span class="font-label-sm text-xs font-bold text-primary-container uppercase tracking-widest block mb-1 flex items-center gap-1.5 px-1">
              <span class="material-symbols-outlined text-[16px]">grid_view</span>
              <span><?= e(ps_text('पाँच आयाम एवं लोक-कल्याणकारी योजनाएँ (5 Dimensions & Plans)', '5 Dimensions of Life Service')) ?></span>
            </span>

            <!-- Dimension 1: पृथ्वी संरक्षण -->
            <div class="bg-pure-white p-4 sm:p-5 rounded-2xl border border-border-warm shadow-xs hover:shadow-md transition-all flex items-start gap-4 group">
              <div class="w-12 h-12 rounded-2xl bg-soft-meadow text-primary-container flex items-center justify-center shrink-0 border border-border-warm group-hover:scale-105 transition-transform">
                <span class="material-symbols-outlined text-[24px]">nature</span>
              </div>
              <div class="flex-1">
                <div class="flex items-center justify-between flex-wrap gap-2">
                  <h4 class="font-title-md text-base font-bold text-deep-forest">
                    1- <?= e(ps_text('जन्मभूमि यानी पृथ्वी संरक्षण', '1- Motherland & Earth Conservation')) ?>
                  </h4>
                  <span class="inline-flex items-center gap-1 bg-primary-fixed/40 text-deep-forest px-3 py-0.5 rounded-full text-xs font-bold border border-border-warm">
                    <span class="material-symbols-outlined text-[13px] text-primary-container">park</span>
                    <?= e(ps_text('योजना: ग्रीन गैंग', 'Plan: Green Gang')) ?>
                  </span>
                </div>
                <p class="font-body-sm text-xs sm:text-sm text-text-muted mt-1 leading-relaxed">
                  <?= e(ps_text('पर्यावरण संतुलन, 50,000+ वृक्षारोपण, पक्षियों हेतु जल-सकोरा वितरण और नित्य \'ग्रीन मॉर्निंग\' अभिवादन के माध्यम से प्रकृति संरक्षण।', 'Environmental protection through tree planting, bird water bowls, and daily Green Morning greetings.')) ?>
                </p>
              </div>
            </div>

            <!-- Dimension 2: अवधी एवं हिंदी -->
            <div class="bg-pure-white p-4 sm:p-5 rounded-2xl border border-border-warm shadow-xs hover:shadow-md transition-all flex items-start gap-4 group">
              <div class="w-12 h-12 rounded-2xl bg-soft-meadow text-secondary flex items-center justify-center shrink-0 border border-border-warm group-hover:scale-105 transition-transform">
                <span class="material-symbols-outlined text-[24px]">translate</span>
              </div>
              <div class="flex-1">
                <div class="flex items-center justify-between flex-wrap gap-2">
                  <h4 class="font-title-md text-base font-bold text-deep-forest">
                    2- <?= e(ps_text('मातृ भाषा अवधी एवं हिंदी', '2- Mother Tongue Awadhi & Hindi')) ?>
                  </h4>
                  <span class="inline-flex items-center gap-1 bg-secondary-fixed/40 text-secondary px-3 py-0.5 rounded-full text-xs font-bold border border-border-warm">
                    <span class="material-symbols-outlined text-[13px]">menu_book</span>
                    <?= e(ps_text('योजना: भाषा साहित्य संस्कृति का संवर्धन, संरक्षण', 'Plan: Language & Cultural Heritage')) ?>
                  </span>
                </div>
                <p class="font-body-sm text-xs sm:text-sm text-text-muted mt-1 leading-relaxed">
                  <?= e(ps_text('अवधी कहावतों, लोक साहित्य व अवधी छंदों (सारंग-कुंडलियाँ) का दस्तावेजीकरण और भावी पीढ़ियों के लिए भाषाई समृद्धता का यत्न।', 'Preserving Awadhi proverbs, folk literature, and poetic heritage for future generations.')) ?>
                </p>
              </div>
            </div>

            <!-- Dimension 3: सरदार पटेल -->
            <div class="bg-pure-white p-4 sm:p-5 rounded-2xl border border-border-warm shadow-xs hover:shadow-md transition-all flex items-start gap-4 group">
              <div class="w-12 h-12 rounded-2xl bg-soft-meadow text-tertiary flex items-center justify-center shrink-0 border border-border-warm group-hover:scale-105 transition-transform">
                <span class="material-symbols-outlined text-[24px]">flag</span>
              </div>
              <div class="flex-1">
                <div class="flex items-center justify-between flex-wrap gap-2">
                  <h4 class="font-title-md text-base font-bold text-deep-forest">
                    3- <?= e(ps_text('आधुनिक भारत के शिल्पी सरदार वल्लभ भाई पटेल', '3- Architect of India Sardar Vallabhbhai Patel')) ?>
                  </h4>
                  <span class="inline-flex items-center gap-1 bg-tertiary-fixed/40 text-tertiary px-3 py-0.5 rounded-full text-xs font-bold border border-border-warm">
                    <span class="material-symbols-outlined text-[13px]">directions_bus</span>
                    <?= e(ps_text('योजना: पटेल चेतना रथ के माध्यम से पटेल के योगदान की चर्चा', 'Plan: Patel Chetna Rath')) ?>
                  </span>
                </div>
                <p class="font-body-sm text-xs sm:text-sm text-text-muted mt-1 leading-relaxed">
                  <?= e(ps_text('पटेल चेतना रथ के माध्यम से लौह पुरुष सरदार पटेल के राष्ट्र-एकता के अविस्मरणीय योगदान एवं आदर्शों पर परिचर्चा व जन-जागरण।', 'Spreading Sardar Patel\'s legacy of national unity through the Patel Chetna Rath awareness drive.')) ?>
                </p>
              </div>
            </div>

            <!-- Dimension 4: साहित्य सृजन -->
            <div class="bg-pure-white p-4 sm:p-5 rounded-2xl border border-border-warm shadow-xs hover:shadow-md transition-all flex items-start gap-4 group">
              <div class="w-12 h-12 rounded-2xl bg-soft-meadow text-deep-forest flex items-center justify-center shrink-0 border border-border-warm group-hover:scale-105 transition-transform">
                <span class="material-symbols-outlined text-[24px]">draw</span>
              </div>
              <div class="flex-1">
                <div class="flex items-center justify-between flex-wrap gap-2">
                  <h4 class="font-title-md text-base font-bold text-deep-forest">
                    4- <?= e(ps_text('साहित्य सृजन', '4- Literary Creation')) ?>
                  </h4>
                  <span class="inline-flex items-center gap-1 bg-soft-meadow text-deep-forest px-3 py-0.5 rounded-full text-xs font-bold border border-border-warm">
                    <span class="material-symbols-outlined text-[13px] text-primary-container">edit_note</span>
                    <?= e(ps_text('योजना: कविता कहानी इत्यादि लेखन, संपादन, काव्यपाठ, पत्रकारिता', 'Plan: Creative Writing & Journalism')) ?>
                  </span>
                </div>
                <p class="font-body-sm text-xs sm:text-sm text-text-muted mt-1 leading-relaxed">
                  <?= e(ps_text('कविता, कहानी, लोक-पत्रकारिता, \'सन्दौली टाइम्स\' का संपादन तथा ग्रामीण संवेदनाओं पर निरन्तर रचना-सृजन।', 'Poetry, short stories, editing of Sandauli Times, and grassroots journalism.')) ?>
                </p>
              </div>
            </div>

            <!-- Dimension 5: युवा मार्गदर्शन -->
            <div class="bg-pure-white p-4 sm:p-5 rounded-2xl border border-border-warm shadow-xs hover:shadow-md transition-all flex items-start gap-4 group">
              <div class="w-12 h-12 rounded-2xl bg-soft-meadow text-primary-container flex items-center justify-center shrink-0 border border-border-warm group-hover:scale-105 transition-transform">
                <span class="material-symbols-outlined text-[24px]">school</span>
              </div>
              <div class="flex-1">
                <div class="flex items-center justify-between flex-wrap gap-2">
                  <h4 class="font-title-md text-base font-bold text-deep-forest">
                    5- <?= e(ps_text('युवाओं का मार्गदर्शन एवं सहयोग', '5- Youth Guidance & Support')) ?>
                  </h4>
                  <span class="inline-flex items-center gap-1 bg-primary-fixed/40 text-primary-container px-3 py-0.5 rounded-full text-xs font-bold border border-border-warm">
                    <span class="material-symbols-outlined text-[13px]">groups</span>
                    <?= e(ps_text('योजना: संगोष्ठी सेमिनार, मोटिवेशनल क्लासेस, प्रशिक्षण शिविर, सेवा सहायता सहयोग शिविर', 'Plan: Seminars & Mentorship Camps')) ?>
                  </span>
                </div>
                <p class="font-body-sm text-xs sm:text-sm text-text-muted mt-1 leading-relaxed">
                  <?= e(ps_text('युवाओं हेतु संगोष्ठी, सेमिनार, मोटिवेशनल क्लासेस, कौशल प्रशिक्षण शिविर और निःशुल्क सहायता व सेवा शिविर।', 'Empowering youth through seminars, motivational classes, skill training camps, and service workshops.')) ?>
                </p>
              </div>
            </div>
          </div>

          <!-- Organization Credit Tag -->
          <div class="bg-gradient-to-r from-deep-forest via-primary-container to-deep-forest text-pure-white p-4 sm:p-5 rounded-2xl shadow-sm flex flex-col sm:flex-row items-center justify-between gap-3 text-center sm:text-left">
            <div class="flex items-center gap-3">
              <div class="w-10 h-10 rounded-full bg-pure-white/20 backdrop-blur-sm flex items-center justify-center shrink-0">
                <span class="material-symbols-outlined text-[22px] text-fresh-sprout">verified</span>
              </div>
              <div>
                <span class="font-title-md text-sm sm:text-base font-bold block"><?= e(ps_text('(द्वारा- आँखें फाउंडेशन एवं ग्रीन गैंग)', '(By - Aankhen Foundation & Green Gang)')) ?></span>
                <span class="font-label-sm text-xs text-surface-container-high opacity-90"><?= e(ps_text('प्रकृति, साहित्य एवं समाज सेवा को समर्पित अभियान', 'Dedicated to nature, literature and social service')) ?></span>
              </div>
            </div>
            <a href="<?= e(base_url('/contact')) ?>" class="bg-pure-white text-deep-forest hover:bg-soft-meadow px-4 py-2 rounded-xl font-label-sm text-xs font-bold transition-colors shrink-0 shadow-xs">
              <?= e(ps_text('अभियान से जुड़ें', 'Join Drives')) ?>
            </a>
          </div>

        </div>
      </div>

    </div>
  </section>

  <!-- Hero Biography & Narrative Persona -->
  <section class="w-full py-space-2xl md:py-space-3xl border-b border-border-warm scroll-mt-24" id="biography">
    <div class="max-w-container-max mx-auto px-4 sm:px-8">
      <div class="w-full">
        <!-- Full Width: Narrative & Biography Spotlight -->
        <div class="w-full flex flex-col space-y-6">




          <!-- Narrative Prose -->
          <div class="space-y-4 font-body-md text-body-md text-on-surface-variant leading-relaxed">
            <p>
              <?= ps_text('बाराबंकी की उर्वर माटी और ग्रामीण परिवेश में जन्मे <strong class="text-deep-forest font-semibold">प्रदीप सारंग</strong> ने अपने जीवन के चार दशक वंचितों के अधिकार, पर्यावरण संरक्षण, अवधी साहित्य और जन-जागरण को समर्पित कर दिए। 1987 में राष्ट्रीय सेवा योजना (NSS) और स्वामी विवेकानंद के विचारों से प्रेरित होकर शुरू हुई यह यात्रा आज एक सशक्त वटवृक्ष बन चुकी है।', 'Born in Barabanki, <strong class="text-deep-forest font-semibold">Pradeep Sarang</strong> has dedicated four decades to social service, environmental protection, and Awadhi literature since his NSS days in 1987.') ?>
            </p>
            <p>
              <?= e(ps_text('ग्रामीण परिवेश के अभावों और संघर्षों को उन्होंने कभी अवरोध नहीं माना, अपितु उसे लोक-उत्थान का प्रेरक माध्यम बनाया। उनका मानना है कि वास्तविक समाज सेवा महलों की गोष्ठियों में नहीं, बल्कि खेतों की मेड़ों, परिंदों के सकोरों और ग्रामवासियों की चौपालों में प्रत्यक्ष पसीने के रूप में प्रकट होती है।', 'He transformed rural struggles into motivation. True social work happens not in luxury halls, but on farm edges and village chaupals.')) ?>
            </p>
          </div>

          <!-- Quick Metrics Ribbon -->
          <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 pt-2">
            <div class="bg-pure-white p-4 rounded-xl shadow-sm border border-border-warm flex flex-col text-center">
              <span class="font-headline-lg text-headline-md text-primary-container leading-tight font-bold">35+</span>
              <span class="font-label-sm text-label-sm text-text-muted mt-1"><?= e(ps_text('वर्ष अनवरत सेवा', 'Years Service')) ?></span>
            </div>
            <div class="bg-pure-white p-4 rounded-xl shadow-sm border border-border-warm flex flex-col text-center">
              <span class="font-headline-lg text-headline-md text-deep-forest leading-tight font-bold">50k+</span>
              <span class="font-label-sm text-label-sm text-text-muted mt-1"><?= e(ps_text('पौधरोपण अभियान', 'Trees Planted')) ?></span>
            </div>
            <div class="bg-pure-white p-4 rounded-xl shadow-sm border border-border-warm flex flex-col text-center">
              <span class="font-headline-lg text-headline-md text-secondary leading-tight font-bold">100+</span>
              <span class="font-label-sm text-label-sm text-text-muted mt-1"><?= e(ps_text('सम्मान व प्रशस्ति पत्र', 'State Honors')) ?></span>
            </div>
            <div class="bg-pure-white p-4 rounded-xl shadow-sm border border-border-warm flex flex-col text-center">
              <span class="font-headline-lg text-headline-md text-tertiary leading-tight font-bold">151</span>
              <span class="font-label-sm text-label-sm text-text-muted mt-1"><?= e(ps_text('कुंडलियों के रचयिता', 'Awadhi Verses')) ?></span>
            </div>
          </div>
        </div>
      </div>
    </div>


  <!-- दृष्टि और जीवन-दर्शन (VISION, MISSION & PRINCIPLES) -->
  <section class="w-full bg-soft-meadow py-space-2xl md:py-space-3xl border-b border-border-warm scroll-mt-24" id="philosophy">
    <div class="max-w-container-max mx-auto px-4 sm:px-8">
      <div class="text-center max-w-2xl mx-auto mb-space-xl">
        <span class="font-label-sm text-label-sm text-secondary tracking-widest font-semibold uppercase"><?= e(ps_text('दार्शनिक आधारशिला', 'Philosophical Pillars')) ?></span>
        <h2 class="font-headline-lg text-headline-md md:text-headline-lg text-deep-forest mt-1 font-bold">
          <?= e(ps_text('दृष्टि, कार्यशैली और वैचारिक प्रेरणा', 'Vision, Methodology & Lineage')) ?>
        </h2>
        <p class="font-body-sm text-body-sm text-text-muted mt-2">
          <?= e(ps_text('किसी भी लोक-आंदोलन की सार्थकता उसके मूल चिंतन और निस्वार्थ कर्मठता पर टिकी होती है।', 'The true worth of a movement lies in its selfless commitment.')) ?>
        </p>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Card 1: Vision -->
        <div class="bg-pure-white rounded-2xl p-7 shadow-sm border border-border-warm hover:shadow-md transition-shadow flex flex-col justify-between">
          <div>
            <div class="w-12 h-12 rounded-xl bg-primary-fixed/40 text-primary-container flex items-center justify-center mb-5 border border-border-warm">
              <span class="material-symbols-outlined text-[26px]">visibility</span>
            </div>
            <h3 class="font-title-lg text-title-lg text-deep-forest mb-3 font-bold">
              <?= e(ps_text('दूरगामी दृष्टिकोण (Vision)', 'Far-reaching Vision')) ?>
            </h3>
            <p class="font-body-md text-body-md text-on-surface-variant leading-relaxed">
              "<?= e(ps_text('एक ऐसे समतामूलक, जागरूक और स्वावलंबी ग्रामीण समाज का निर्माण जहाँ पर्यावरण सुरक्षित हो, पक्षियों और मूक जीवों का संरक्षण हो और सांस्कृतिक धरोहर की अस्मिता जीवंत रहे।', 'Building an aware, self-reliant rural society where nature and bird life are protected, and Awadhi culture thrives.')) ?>"
            </p>
          </div>
          <div class="mt-6 pt-4 border-t border-border-warm flex items-center gap-2 text-primary font-label-sm text-label-sm font-semibold">
            <span class="material-symbols-outlined text-[16px]">nature</span>
            <span><?= e(ps_text('पर्यावरण एवं लोक-सशक्तिकरण', 'Ecology & Community')) ?></span>
          </div>
        </div>

        <!-- Card 2: Methodology -->
        <div class="bg-pure-white rounded-2xl p-7 shadow-sm border border-border-warm hover:shadow-md transition-shadow flex flex-col justify-between">
          <div>
            <div class="w-12 h-12 rounded-xl bg-secondary-fixed/50 text-secondary flex items-center justify-center mb-5 border border-border-warm">
              <span class="material-symbols-outlined text-[26px]">handshake</span>
            </div>
            <h3 class="font-title-lg text-title-lg text-deep-forest mb-3 font-bold">
              <?= e(ps_text('कार्यशैली व निष्ठा (Methodology)', 'Methodology & Ethics')) ?>
            </h3>
            <p class="font-body-md text-body-md text-on-surface-variant leading-relaxed">
              "<?= e(ps_text('पारदर्शी जन-सहभागिता, \'ग्रीन मॉर्निंग\' के जरिए प्रकृति प्रेम का दैनिक संस्कार, और सत्ता या आडंबर से कोसों दूर रहकर ज़मीनी स्तर पर मिट्टी से जुड़कर प्रत्यक्ष सेवा।', 'Transparent community participation, daily Green Morning etiquette, and direct field service.')) ?>"
            </p>
          </div>
          <div class="mt-6 pt-4 border-t border-border-warm flex items-center gap-2 text-secondary font-label-sm text-label-sm font-semibold">
            <span class="material-symbols-outlined text-[16px]">groups</span>
            <span><?= e(ps_text('सहभागी व प्रत्यक्ष ग्रामीण सेवा', 'Direct Grassroots Service')) ?></span>
          </div>
        </div>

        <!-- Card 3: Inspiration -->
        <div class="bg-pure-white rounded-2xl p-7 shadow-sm border border-border-warm hover:shadow-md transition-shadow flex flex-col justify-between">
          <div>
            <div class="w-12 h-12 rounded-xl bg-tertiary-fixed/60 text-tertiary flex items-center justify-center mb-5 border border-border-warm">
              <span class="material-symbols-outlined text-[26px]">menu_book</span>
            </div>
            <h3 class="font-title-lg text-title-lg text-deep-forest mb-3 font-bold">
              <?= e(ps_text('प्रेरणा स्रोत व गुरु परंपरा', 'Inspiration & Mentorship')) ?>
            </h3>
            <p class="font-body-md text-body-md text-on-surface-variant leading-relaxed">
              "<?= e(ps_text('गुरुवर डॉ. भगवान वत्स जी का पावन मार्गदर्शन, राष्ट्रीय सेवा योजना (NSS) के नैतिक संस्कार और संत कबीर व गोस्वामी तुलसीदास की लोक-परंपरा से निःसृत आत्मबल।', 'Mentorship of Dr. Bhagwan Vats Ji, NSS ethics, and spiritual traditions of Saint Kabir and Tulsidas.')) ?>"
            </p>
          </div>
          <div class="mt-6 pt-4 border-t border-border-warm flex items-center gap-2 text-tertiary font-label-sm text-label-sm font-semibold">
            <span class="material-symbols-outlined text-[16px]">auto_stories</span>
            <span><?= e(ps_text('अवध चेतना व संत विचार', 'Awadh Heritage & Values')) ?></span>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- प्रमुख सामाजिक सरोकार व कार्यक्षेत्र (AREAS OF SOCIAL CONTRIBUTION) -->
  <section class="w-full py-space-2xl md:py-space-3xl border-b border-border-warm">
    <div class="max-w-container-max mx-auto px-4 sm:px-8">
      <div class="flex flex-col md:flex-row md:items-end justify-between mb-space-xl gap-4">
        <div>
          <span class="font-label-sm text-label-sm text-secondary tracking-widest font-semibold uppercase"><?= e(ps_text('सक्रिय कार्यक्षेत्र', 'Active Domains')) ?></span>
          <h2 class="font-headline-lg text-headline-md md:text-headline-lg text-deep-forest font-bold mt-1">
            <?= e(ps_text('प्रमुख सामाजिक सरोकार एवं लोक पहल', 'Key Areas of Commitment')) ?>
          </h2>
        </div>
        <p class="font-body-sm text-body-sm text-text-muted max-w-md">
          <?= e(ps_text('प्रदीप सारंग जी ने किसी एक परिधि में बंधने के बजाय जन-सरोकारों के विविध आयामों को छूकर स्थायी परिवर्तन का मार्ग प्रशस्त किया है।', 'Addressing multifaceted community challenges from environment to literacy.')) ?>
        </p>
      </div>

      <!-- 6 Categorized Structured Cards -->
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- 1. पर्यावरण व ग्रीन गैंग -->
        <div class="bg-pure-white rounded-2xl p-6 shadow-sm border border-border-warm hover:shadow-md transition-all flex flex-col justify-between">
          <div>
            <div class="w-10 h-10 rounded-xl bg-soft-meadow text-primary-container flex items-center justify-center mb-4 border border-border-warm">
              <span class="material-symbols-outlined">forest</span>
            </div>
            <h3 class="font-title-lg text-title-md text-deep-forest font-bold mb-2"><?= e(ps_text('पर्यावरण संरक्षण व \'ग्रीन गैंग\'', 'Environment & Green Gang')) ?></h3>
            <p class="font-body-sm text-body-sm text-on-surface-variant leading-relaxed mb-4">
              <?= e(ps_text('5 जून 2019 को \'ग्रीन गैंग\' की स्थापना। जनपद भर में 50,000 से अधिक पौधों का रोपण व संरक्षण। प्रत्येक प्रातः \'ग्रीन मॉर्निंग\' के अभिवादन से प्रकृति प्रेम का अभिनव संस्कार।', 'Planted 50,000+ trees with Green Gang, instilling daily Green Morning greetings across Barabanki.')) ?>
            </p>
          </div>
          <div class="bg-soft-meadow p-3 rounded-xl flex items-center gap-2 font-label-sm text-label-sm text-deep-forest border border-border-warm font-semibold">
            <span class="material-symbols-outlined text-[16px] text-primary-container">energy_savings_leaf</span>
            <span><?= e(ps_text('\'ग्रीन मॉर्निंग\' अभिवादन के प्रणेता', 'Founder of Green Morning')) ?></span>
          </div>
        </div>

        <!-- 2. परिंदा व वन्य जीव -->
        <div class="bg-pure-white rounded-2xl p-6 shadow-sm border border-border-warm hover:shadow-md transition-all flex flex-col justify-between">
          <div>
            <div class="w-10 h-10 rounded-xl bg-soft-meadow text-secondary flex items-center justify-center mb-4 border border-border-warm">
              <span class="material-symbols-outlined">cruelty_free</span>
            </div>
            <h3 class="font-title-lg text-title-md text-deep-forest font-bold mb-2"><?= e(ps_text('परिंदा व वन्य जीव संरक्षण', 'Bird & Wildlife Protection')) ?></h3>
            <p class="font-body-sm text-body-sm text-on-surface-variant leading-relaxed mb-4">
              <?= e(ps_text('ग्रीष्म ऋतु में पक्षियों के जीवन की रक्षा हेतु 10,000+ मिट्टी के सकोरे व दाना-पानी वितरण अभियान। 2016 में माननीय वन मंत्री, उ.प्र. शासन द्वारा \'वन्य जीव संरक्षण विशिष्ट प्रशस्ति पत्र\' से अलंकृत।', '10,000+ water pots for birds. Honored with State Wildlife Citation by UP Forest Minister.')) ?>
            </p>
          </div>
          <div class="bg-soft-meadow p-3 rounded-xl flex items-center gap-2 font-label-sm text-label-sm text-secondary border border-border-warm font-semibold">
            <span class="material-symbols-outlined text-[16px]">water_drop</span>
            <span><?= e(ps_text('सकोरा वितरण एवं प्यास मुक्ति अभियान', 'Bird Water Bowl Campaign')) ?></span>
          </div>
        </div>

        <!-- 3. अवधी साहित्य व संस्कृति -->
        <div class="bg-pure-white rounded-2xl p-6 shadow-sm border border-border-warm hover:shadow-md transition-all flex flex-col justify-between">
          <div>
            <div class="w-10 h-10 rounded-xl bg-soft-meadow text-tertiary flex items-center justify-center mb-4 border border-border-warm">
              <span class="material-symbols-outlined">history_edu</span>
            </div>
            <h3 class="font-title-lg text-title-md text-deep-forest font-bold mb-2"><?= e(ps_text('अवधी भाषा, साहित्य व संस्कृति', 'Awadhi Literature & Culture')) ?></h3>
            <p class="font-body-sm text-body-sm text-on-surface-variant leading-relaxed mb-4">
              <?= e(ps_text('अवधी संस्मरण संकलन \'झरिहख\' एवं 151 छन्दबद्ध कुंडलियों का ग्रन्थ \'सारंग-कुंडलियाँ\'। \'काव्य-मंजरी\' का कुशल संपादन। अवधी लोकगीत, कहावत एवं समृद्ध अवधी विरासत के संरक्षण के लिए सतत सृजन।', 'Author of Awadhi memoirs Jharihakh and 151 Sarang Kundaliyan poetic verses.')) ?>
            </p>
          </div>
          <div class="bg-soft-meadow p-3 rounded-xl flex items-center gap-2 font-label-sm text-label-sm text-tertiary border border-border-warm font-semibold">
            <span class="material-symbols-outlined text-[16px]">ink_pen</span>
            <span><?= e(ps_text('जनकवि बंशीधर शुक्ल व तुलसी सम्मान से सम्मानित', 'Banshidhar Shukla & Tulsi Awardee')) ?></span>
          </div>
        </div>

        <!-- 4. लोकतंत्र व मतदाता जागरूकता -->
        <div class="bg-pure-white rounded-2xl p-6 shadow-sm border border-border-warm hover:shadow-md transition-all flex flex-col justify-between">
          <div>
            <div class="w-10 h-10 rounded-xl bg-soft-meadow text-deep-forest flex items-center justify-center mb-4 border border-border-warm">
              <span class="material-symbols-outlined">how_to_vote</span>
            </div>
            <h3 class="font-title-lg text-title-md text-deep-forest font-bold mb-2"><?= e(ps_text('लोकतंत्र व मतदाता चेतना', 'Voter Awareness & Democracy')) ?></h3>
            <p class="font-body-sm text-body-sm text-on-surface-variant leading-relaxed mb-4">
              <?= e(ps_text('2019 लोकसभा निर्वाचन व त्रिस्तरीय पंचायत चुनावों में शत-प्रतिशत मतदान हेतु सघन जन-अभियान। जिला निर्वाचन अधिकारी एवं मुख्य निर्वाचन अधिकारी, उत्तर प्रदेश द्वारा विशेष नागरिक सम्मान।', 'Voter awareness drives during elections, honored by UP Chief Electoral Officer.')) ?>
            </p>
          </div>
          <div class="bg-soft-meadow p-3 rounded-xl flex items-center gap-2 font-label-sm text-label-sm text-deep-forest border border-border-warm font-semibold">
            <span class="material-symbols-outlined text-[16px] text-primary-container">how_to_reg</span>
            <span><?= e(ps_text('निर्वाचन आयोग व प्रशासन द्वारा सम्मानित', 'Election Commission Honoree')) ?></span>
          </div>
        </div>

        <!-- 5. পরিंदा व जल-सकोरा संवर्धन -->
        <div class="bg-pure-white rounded-2xl p-6 shadow-sm border border-border-warm hover:shadow-md transition-all flex flex-col justify-between">
          <div>
            <div class="w-10 h-10 rounded-xl bg-soft-meadow text-deep-forest flex items-center justify-center mb-4 border border-border-warm">
              <span class="material-symbols-outlined">nest_cam_iq_outdoor</span>
            </div>
            <h3 class="font-title-lg text-title-md text-deep-forest font-bold mb-2"><?= e(ps_text('परिंदा संवर्धन व जल-सकोरा अभियान', 'Sparrow & Bird Conservation')) ?></h3>
            <p class="font-body-sm text-body-sm text-on-surface-variant leading-relaxed mb-4">
              <?= e(ps_text('गर्मी के दिनों में 10,000+ मिट्टी के जल-सकोरों का निःशुल्क वितरण, दाना-पानी प्रबंध और विलुप्त होती गौरैया के संरक्षण हेतु युवाओं को प्रेरित करना।', 'Free distribution of 10,000+ earthen water bowls during summer and inspiring youth to protect local sparrows.')) ?>
            </p>
          </div>
          <div class="bg-soft-meadow p-3 rounded-xl flex items-center gap-2 font-label-sm text-label-sm text-deep-forest border border-border-warm font-semibold">
            <span class="material-symbols-outlined text-[16px]">water_drop</span>
            <span><?= e(ps_text('10,000+ मिट्टी के जल-सकोरे वितरित', '10,000+ Water Bowls Distributed')) ?></span>
          </div>
        </div>

        <!-- 6. युवा नेतृत्व व खेल संस्कृति -->
        <div class="bg-pure-white rounded-2xl p-6 shadow-sm border border-border-warm hover:shadow-md transition-all flex flex-col justify-between">
          <div>
            <div class="w-10 h-10 rounded-xl bg-soft-meadow text-primary-container flex items-center justify-center mb-4 border border-border-warm">
              <span class="material-symbols-outlined">sports_volleyball</span>
            </div>
            <h3 class="font-title-lg text-title-md text-deep-forest font-bold mb-2"><?= e(ps_text('युवा नेतृत्व व खेल-संस्कृति', 'Youth Leadership & Sports')) ?></h3>
            <p class="font-body-sm text-body-sm text-on-surface-variant leading-relaxed mb-4">
              <?= e(ps_text('1987 से युवक मंगल दल की अगुवाई। ग्रामीण क्षेत्रों में वॉलीबॉल, एथलेटिक्स एवं कबड्डी प्रतियोगिताओं का आयोजन। युवा कल्याण विभाग द्वारा \'अनुशासित युवक\' के रूप में चार दशकों का प्रेरक मार्गदर्शन।', 'Leading Yuvak Mangal Dal since 1987, organizing rural sports and youth leadership.')) ?>
            </p>
          </div>
          <div class="bg-soft-meadow p-3 rounded-xl flex items-center gap-2 font-label-sm text-label-sm text-primary-container border border-border-warm font-semibold">
            <span class="material-symbols-outlined text-[16px]">military_tech</span>
            <span><?= e(ps_text('नेहरू युवा केन्द्र व NYK जिला युवा पुरस्कार', 'Nehru Yuva Kendra District Award')) ?></span>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- चार दशकों का ऐतिहासिक पड़ाव व सम्मान अभिलेखागार (TIMELINE OF HONORS 1987 से आज तक) -->
  <section class="w-full bg-soft-meadow py-space-2xl md:py-space-4xl border-b border-border-warm scroll-mt-24" id="awards">
    <div class="max-w-container-max mx-auto px-4 sm:px-8">
      <!-- Section Header -->
      <div class="text-center max-w-3xl mx-auto mb-space-xl">
        <span class="font-label-sm text-label-sm text-secondary tracking-widest font-semibold uppercase"><?= e(ps_text('प्रामाणिक अभिलेखागार (Authentic Archive)', 'Authentic Honors Archive')) ?></span>
        <h2 class="font-headline-lg text-headline-md md:text-headline-lg text-deep-forest font-bold mt-1">
          <?= e(ps_text('चार दशकों की सेवा-यात्रा एवं प्रमुख सम्मान (1987 से आज तक)', 'Four Decades of Service & Honors (1987 — Present)')) ?>
        </h2>
        <p class="font-body-md text-body-md text-text-muted mt-2">
          <?= e(ps_text('महामहिम राज्यपाल से लेकर ग्राम चौपाल तक प्राप्त सम्मान व प्रशस्ति पत्रों की ऐतिहासिक शृंखला।', 'Honors from the UP Governor to village chaupals.')) ?>
        </p>

        <!-- Interactive Category Filters -->
        <div class="flex flex-wrap items-center justify-center gap-2 mt-6" id="timeline-filters">
          <button type="button" data-filter="all" class="timeline-filter-btn px-4 py-2 rounded-full font-label-sm text-label-sm bg-primary-container text-on-primary transition-all shadow-sm font-semibold cursor-pointer">
            <?= e(ps_text('सभी सम्मान (All)', 'All Honors')) ?>
          </button>
          <button type="button" data-filter="national" class="timeline-filter-btn px-4 py-2 rounded-full font-label-sm text-label-sm bg-pure-white text-on-surface-variant hover:bg-surface-container transition-all border border-border-warm cursor-pointer font-medium">
            <?= e(ps_text('राष्ट्रीय व राज्य स्तरीय (National/State)', 'National & State')) ?>
          </button>
          <button type="button" data-filter="literary" class="timeline-filter-btn px-4 py-2 rounded-full font-label-sm text-label-sm bg-pure-white text-on-surface-variant hover:bg-surface-container transition-all border border-border-warm cursor-pointer font-medium">
            <?= e(ps_text('साहित्य व अवधी (Literary)', 'Literature & Awadhi')) ?>
          </button>
          <button type="button" data-filter="social" class="timeline-filter-btn px-4 py-2 rounded-full font-label-sm text-label-sm bg-pure-white text-on-surface-variant hover:bg-surface-container transition-all border border-border-warm cursor-pointer font-medium">
            <?= e(ps_text('पर्यावरण व जनसेवा (Social)', 'Environment & Social')) ?>
          </button>
        </div>
      </div>

      <!-- Timeline Cards Container -->
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5" id="timeline-grid">
        <!-- 1987 (Social/Sports) -->
        <div class="timeline-item bg-pure-white rounded-2xl p-5 shadow-sm border border-border-warm hover:shadow-md transition-all flex flex-col justify-between" data-category="social">
          <div>
            <div class="flex items-center justify-between mb-3">
              <span class="font-headline-sm text-headline-sm text-secondary font-bold">1987</span>
              <span class="bg-secondary-fixed/50 text-secondary font-label-sm text-label-sm px-2.5 py-0.5 rounded-full font-semibold"><?= e(ps_text('युवक मंगल दल', 'Youth Club')) ?></span>
            </div>
            <h4 class="font-title-md text-title-md text-deep-forest font-bold mb-2"><?= e(ps_text('अनुशासित युवक एवं खेलकूद पुरस्कार', 'Disciplined Youth & Sports Award')) ?></h4>
            <p class="font-body-sm text-body-sm text-text-muted leading-relaxed">
              <?= e(ps_text('प्रादेशिक विकास दल द्वारा आयोजित क्षेत्रीय खेलकूद में वॉलीबॉल में द्वितीय व 800 मी. दौड़ में तृतीय। युवा कल्याण विभाग द्वारा \'अनुशासित युवक\' अलंकरण।', 'Regional volleyball 2nd & 800m run 3rd place. Awarded Disciplined Youth by Youth Welfare Dept.')) ?>
            </p>
          </div>
          <div class="mt-4 pt-3 border-t border-border-warm text-label-sm font-label-sm text-deep-forest flex items-center gap-1.5 font-semibold">
            <span class="material-symbols-outlined text-[15px] text-secondary">verified</span>
            <span><?= e(ps_text('खण्ड विकास अधिकारी द्वारा पुरस्कृत', 'Awarded by BDO')) ?></span>
          </div>
        </div>

        <!-- 1988 (National) -->
        <div class="timeline-item bg-pure-white rounded-2xl p-5 shadow-sm border border-border-warm hover:shadow-md transition-all flex flex-col justify-between" data-category="national">
          <div>
            <div class="flex items-center justify-between mb-3">
              <span class="font-headline-sm text-headline-sm text-primary-container font-bold">1988</span>
              <span class="bg-primary-fixed/40 text-primary-container font-label-sm text-label-sm px-2.5 py-0.5 rounded-full font-semibold"><?= e(ps_text('राष्ट्रीय गौरव', 'National Honor')) ?></span>
            </div>
            <h4 class="font-title-md text-title-md text-deep-forest font-bold mb-2"><?= e(ps_text('गणतंत्र दिवस राष्ट्रीय परेड (NSS)', 'Republic Day National Parade Camp')) ?></h4>
            <p class="font-body-sm text-body-sm text-text-muted leading-relaxed">
              <?= e(ps_text('ऐतिहासिक क्षण: नई दिल्ली में इंडिया गेट पर 26 जनवरी गणतंत्र दिवस राष्ट्रीय परेड में NSS दल के प्रतिनिधि के रूप में प्रतिभागिता एवं \'पॉवन माटी\' कार्यक्रम में सम्मान।', 'Represented UP NSS contingent at Republic Day National Parade Camp at Rajpath, New Delhi.')) ?>
            </p>
          </div>
          <div class="mt-4 pt-3 border-t border-border-warm text-label-sm font-label-sm text-primary-container flex items-center gap-1.5 font-semibold">
            <span class="material-symbols-outlined text-[15px]">flag</span>
            <span><?= e(ps_text('गणतंत्र दिवस राष्ट्रीय प्रमाण पत्र', 'Republic Day National Certificate')) ?></span>
          </div>
        </div>

        <!-- 1989 (Social/Culture) -->
        <div class="timeline-item bg-pure-white rounded-2xl p-5 shadow-sm border border-border-warm hover:shadow-md transition-all flex flex-col justify-between" data-category="social">
          <div>
            <div class="flex items-center justify-between mb-3">
              <span class="font-headline-sm text-headline-sm text-tertiary font-bold">1989</span>
              <span class="bg-soft-meadow text-deep-forest font-label-sm text-label-sm px-2.5 py-0.5 rounded-full font-semibold border border-border-warm"><?= e(ps_text('रंगमंच व सेवा', 'Theatre & Health')) ?></span>
            </div>
            <h4 class="font-title-md text-title-md text-deep-forest font-bold mb-2"><?= e(ps_text('रंगमंच अभिनय एवं नेत्र चिकित्सा सेवा', 'Theatre Acting & Eye Care Service')) ?></h4>
            <p class="font-body-sm text-body-sm text-text-muted leading-relaxed">
              <?= e(ps_text('पारंपरिक नाटक एवं एकांकी रंगमंच अभिनय प्रशिक्षण प्रमाण पत्र तथा नेत्र चिकित्सा शिविर में अनवरत स्वयंसेवी सेवा कार्यों हेतु प्रशस्ति पत्र।', 'Folk drama training & voluntary service citation for free eye care camps.')) ?>
            </p>
          </div>
          <div class="mt-4 pt-3 border-t border-border-warm text-label-sm font-label-sm text-text-muted flex items-center gap-1.5 font-semibold">
            <span class="material-symbols-outlined text-[15px]">theater_comedy</span>
            <span><?= e(ps_text('रंगमंच व स्वास्थ्य सेवा शिविर', 'Theatre & Health Camp')) ?></span>
          </div>
        </div>

        <!-- 1991 (National/State) -->
        <div class="timeline-item bg-pure-white rounded-2xl p-5 shadow-sm border border-border-warm hover:shadow-md transition-all flex flex-col justify-between" data-category="national">
          <div>
            <div class="flex items-center justify-between mb-3">
              <span class="font-headline-sm text-headline-sm text-primary-container font-bold">1991</span>
              <span class="bg-primary-fixed/40 text-primary-container font-label-sm text-label-sm px-2.5 py-0.5 rounded-full font-semibold"><?= e(ps_text('राजभवन अलंकरण', 'Raj Bhavan State Award')) ?></span>
            </div>
            <h4 class="font-title-md text-title-md text-deep-forest font-bold mb-2"><?= e(ps_text('स्वामी विवेकानंद युवा पुरस्कार', 'Swami Vivekananda Youth Award')) ?></h4>
            <p class="font-body-sm text-body-sm text-text-muted leading-relaxed">
              <?= e(ps_text('युवाओं के सर्वांगीण विकास एवं सामाजिक सेवा में अप्रतिम योगदान हेतु तत्कालीन महामहिम राज्यपाल, उत्तर प्रदेश के कर-कमलों द्वारा राज्य का सर्वोच्च युवा सम्मान प्रदान किया गया।', 'Conferred UP\'s highest youth state award by the Governor of Uttar Pradesh at Raj Bhavan.')) ?>
            </p>
          </div>
          <div class="mt-4 pt-3 border-t border-border-warm text-label-sm font-label-sm text-primary-container flex items-center gap-1.5 font-semibold">
            <span class="material-symbols-outlined text-[15px]">stars</span>
            <span><?= e(ps_text('महामहिम राज्यपाल द्वारा प्रदत्त', 'Conferred by UP Governor')) ?></span>
          </div>
        </div>

        <!-- 1992 (National) -->
        <div class="timeline-item bg-pure-white rounded-2xl p-5 shadow-sm border border-border-warm hover:shadow-md transition-all flex flex-col justify-between" data-category="national">
          <div>
            <div class="flex items-center justify-between mb-3">
              <span class="font-headline-sm text-headline-sm text-secondary font-bold">1992</span>
              <span class="bg-secondary-fixed/50 text-secondary font-label-sm text-label-sm px-2.5 py-0.5 rounded-full font-semibold"><?= e(ps_text('NYK सम्मान', 'NYK Award')) ?></span>
            </div>
            <h4 class="font-title-md text-title-md text-deep-forest font-bold mb-2"><?= e(ps_text('जिला युवा पुरस्कार (NYK)', 'District Youth Award (NYK)')) ?></h4>
            <p class="font-body-sm text-body-sm text-text-muted leading-relaxed">
              <?= e(ps_text('नेहरू युवा केन्द्र, युवा कार्यक्रम एवं खेल मंत्रालय भारत सरकार द्वारा जनपद स्तर पर युवा जागरण, खेल एवं समाजसेवा में सर्वश्रेष्ठ कार्य के लिए प्रतिष्ठित पुरस्कार।', 'Awarded District Youth Award by Nehru Yuva Kendra, Ministry of Youth Affairs, Govt of India.')) ?>
            </p>
          </div>
          <div class="mt-4 pt-3 border-t border-border-warm text-label-sm font-label-sm text-secondary flex items-center gap-1.5 font-semibold">
            <span class="material-symbols-outlined text-[15px]">military_tech</span>
            <span><?= e(ps_text('नेहरू युवा केन्द्र संगठन', 'Nehru Yuva Kendra Sangathan')) ?></span>
          </div>
        </div>

        <!-- 1997 (Literary/Health) -->
        <div class="timeline-item bg-pure-white rounded-2xl p-5 shadow-sm border border-border-warm hover:shadow-md transition-all flex flex-col justify-between" data-category="literary">
          <div>
            <div class="flex items-center justify-between mb-3">
              <span class="font-headline-sm text-headline-sm text-tertiary font-bold">1997</span>
              <span class="bg-tertiary-fixed/60 text-tertiary font-label-sm text-label-sm px-2.5 py-0.5 rounded-full font-semibold"><?= e(ps_text('पारंपरिक ज्ञान', 'Ayurveda')) ?></span>
            </div>
            <h4 class="font-title-md text-title-md text-deep-forest font-bold mb-2"><?= e(ps_text('आयुर्वेद रत्न उपाधि', 'Ayurveda Ratna Degree')) ?></h4>
            <p class="font-body-sm text-body-sm text-text-muted leading-relaxed">
              <?= e(ps_text('पारंपरिक भारतीय चिकित्सा पद्धति, वानस्पतिक ज्ञान एवं लोक-स्वास्थ्य के गहन अध्ययन हेतु \'आयुर्वेद रत्न\' की प्रतिष्ठित उपाधि से विभूषित।', 'Conferred Ayurveda Ratna for studies in native herbs and traditional Indian medicine.')) ?>
            </p>
          </div>
          <div class="mt-4 pt-3 border-t border-border-warm text-label-sm font-label-sm text-tertiary flex items-center gap-1.5 font-semibold">
            <span class="material-symbols-outlined text-[15px]">psychiatry</span>
            <span><?= e(ps_text('आयुर्वेदिक चिकित्सा परिषद', 'Ayurvedic Medical Council')) ?></span>
          </div>
        </div>

        <!-- 2010 (Bird Conservation) -->
        <div class="timeline-item bg-pure-white rounded-2xl p-5 shadow-sm border border-border-warm hover:shadow-md transition-all flex flex-col justify-between" data-category="social">
          <div>
            <div class="flex items-center justify-between mb-3">
              <span class="font-headline-sm text-headline-sm text-deep-forest font-bold">2010</span>
              <span class="bg-soft-meadow text-deep-forest font-label-sm text-label-sm px-2.5 py-0.5 rounded-full font-semibold border border-border-warm"><?= e(ps_text('परिंदा संरक्षण', 'Bird Protection')) ?></span>
            </div>
            <h4 class="font-title-md text-title-md text-deep-forest font-bold mb-2"><?= e(ps_text('जल-सकोरा वितरण एवं नागरिक अभिनंदन', 'Water Bowl Drive & Civic Honor')) ?></h4>
            <p class="font-body-sm text-body-sm text-text-muted leading-relaxed">
              <?= e(ps_text('मिट्टी के जल-सकोरों का बड़े पैमाने पर वितरण एवं बेजुबान परिंदों के संरक्षण हेतु जनपद के प्रबुद्ध नागरिकों द्वारा सार्वजनिक अभिनंदन।', 'Honored for organizing bird water bowl distribution drives across Barabanki villages.')) ?>
            </p>
          </div>
          <div class="mt-4 pt-3 border-t border-border-warm text-label-sm font-label-sm text-text-muted flex items-center gap-1.5 font-semibold">
            <span class="material-symbols-outlined text-[15px]">volunteer_activism</span>
            <span><?= e(ps_text('जनपदवासियों द्वारा अभिनंदन पत्र', 'Civic Citation of Honor')) ?></span>
          </div>
        </div>

        <!-- 2015 (Social/National) -->
        <div class="timeline-item bg-pure-white rounded-2xl p-5 shadow-sm border border-border-warm hover:shadow-md transition-all flex flex-col justify-between" data-category="social">
          <div>
            <div class="flex items-center justify-between mb-3">
              <span class="font-headline-sm text-headline-sm text-secondary font-bold">2015</span>
              <span class="bg-secondary-fixed/50 text-secondary font-label-sm text-label-sm px-2.5 py-0.5 rounded-full font-semibold"><?= e(ps_text('रेडक्रॉस', 'Red Cross')) ?></span>
            </div>
            <h4 class="font-title-md text-title-md text-deep-forest font-bold mb-2"><?= e(ps_text('भारतीय रेडक्रॉस सोसाइटी सम्मान', 'Red Cross Society Honor')) ?></h4>
            <p class="font-body-sm text-body-sm text-text-muted leading-relaxed">
              <?= e(ps_text('रेडक्रॉस सोसाइटी तथा जिला प्रशासन एवं पुलिस उपाधीक्षक द्वारा सामाजिक सेवा शिविरों के सफल संचालन हेतु विशेष सम्मान पत्र।', 'Awarded Special Service Citation by Indian Red Cross Society and District Administration.')) ?>
            </p>
          </div>
          <div class="mt-4 pt-3 border-t border-border-warm text-label-sm font-label-sm text-secondary flex items-center gap-1.5 font-semibold">
            <span class="material-symbols-outlined text-[15px]">medical_services</span>
            <span><?= e(ps_text('रेडक्रॉस सोसाइटी एवं जिला प्रशासन', 'Indian Red Cross Society')) ?></span>
          </div>
        </div>

        <!-- 2016 (Social/National) -->
        <div class="timeline-item bg-pure-white rounded-2xl p-5 shadow-sm border border-border-warm hover:shadow-md transition-all flex flex-col justify-between" data-category="national">
          <div>
            <div class="flex items-center justify-between mb-3">
              <span class="font-headline-sm text-headline-sm text-primary-container font-bold">2016</span>
              <span class="bg-primary-fixed/40 text-primary-container font-label-sm text-label-sm px-2.5 py-0.5 rounded-full font-semibold"><?= e(ps_text('शासन स्तर', 'State Forest Dept')) ?></span>
            </div>
            <h4 class="font-title-md text-title-md text-deep-forest font-bold mb-2"><?= e(ps_text('वन्य जीव व परिंदा संरक्षण सम्मान', 'State Wildlife Protection Honor')) ?></h4>
            <p class="font-body-sm text-body-sm text-text-muted leading-relaxed">
              <?= e(ps_text('उत्तर प्रदेश शासन के तत्कालीन माननीय वन मंत्री द्वारा पर्यावरण, पक्षी संरक्षण और जीव दया अभियानों के लिए राज्य स्तरीय प्रशस्ति पत्र।', 'Conferred State Level Wildlife Citation by UP Forest Minister for bird conservation.')) ?>
            </p>
          </div>
          <div class="mt-4 pt-3 border-t border-border-warm text-label-sm font-label-sm text-primary-container flex items-center gap-1.5 font-semibold">
            <span class="material-symbols-outlined text-[15px]">nature</span>
            <span><?= e(ps_text('माननीय वन मंत्री, उ.प्र. द्वारा प्रदत्त', 'Conferred by UP Forest Minister')) ?></span>
          </div>
        </div>

        <!-- 2018 (Literary/Social) -->
        <div class="timeline-item bg-pure-white rounded-2xl p-5 shadow-sm border border-border-warm hover:shadow-md transition-all flex flex-col justify-between" data-category="literary">
          <div>
            <div class="flex items-center justify-between mb-3">
              <span class="font-headline-sm text-headline-sm text-tertiary font-bold">2018</span>
              <span class="bg-tertiary-fixed/60 text-tertiary font-label-sm text-label-sm px-2.5 py-0.5 rounded-full font-semibold"><?= e(ps_text('अवध ज्योति', 'Awadh Jyoti')) ?></span>
            </div>
            <h4 class="font-title-md text-title-md text-deep-forest font-bold mb-2"><?= e(ps_text('सेवा रत्न एवं अवध ज्योति रजत जयंती', 'Seva Ratna & Awadh Jyoti Honor')) ?></h4>
            <p class="font-body-sm text-body-sm text-text-muted leading-relaxed">
              <?= e(ps_text('महिला एवं बाल कल्याण हेतु \'सेवा रत्न सम्मान\' तथा अवधी साहित्य में अनवरत योगदान हेतु अवध ज्योति पत्रिका के रजत जयंती समारोह में सम्मान।', 'Seva Ratna & Awadh Jyoti Silver Jubilee Honor for contributions to Awadhi prose.')) ?>
            </p>
          </div>
          <div class="mt-4 pt-3 border-t border-border-warm text-label-sm font-label-sm text-tertiary flex items-center gap-1.5 font-semibold">
            <span class="material-symbols-outlined text-[15px]">menu_book</span>
            <span><?= e(ps_text('अवधी साहित्य व समाज कल्याण', 'Awadhi Literary Society')) ?></span>
          </div>
        </div>

        <!-- 2019 (National/Social) -->
        <div class="timeline-item bg-pure-white rounded-2xl p-5 shadow-sm border border-border-warm hover:shadow-md transition-all flex flex-col justify-between" data-category="national">
          <div>
            <div class="flex items-center justify-between mb-3">
              <span class="font-headline-sm text-headline-sm text-primary-container font-bold">2019</span>
              <span class="bg-primary-fixed/40 text-primary-container font-label-sm text-label-sm px-2.5 py-0.5 rounded-full font-semibold"><?= e(ps_text('निर्वाचन आयोग', 'Election Commission')) ?></span>
            </div>
            <h4 class="font-title-md text-title-md text-deep-forest font-bold mb-2"><?= e(ps_text('लोकसभा मतदाता जागरूकता सम्मान', 'Chief Electoral Officer Award')) ?></h4>
            <p class="font-body-sm text-body-sm text-text-muted leading-relaxed">
              <?= e(ps_text('मुख्य निर्वाचन अधिकारी एवं जिला निर्वाचन अधिकारी (बाराबंकी) द्वारा लोकसभा सामान्य निर्वाचन में मतदाता जागरूकता के उत्कृष्ट प्रचार हेतु।', 'Awarded Voter Awareness Citation by UP Chief Electoral Officer.')) ?>
            </p>
          </div>
          <div class="mt-4 pt-3 border-t border-border-warm text-label-sm font-label-sm text-primary-container flex items-center gap-1.5 font-semibold">
            <span class="material-symbols-outlined text-[15px]">how_to_vote</span>
            <span><?= e(ps_text('मुख्य निर्वाचन अधिकारी, उ.प्र.', 'UP Chief Electoral Officer')) ?></span>
          </div>
        </div>

        <!-- 2020 (Social) -->
        <div class="timeline-item bg-pure-white rounded-2xl p-5 shadow-sm border border-border-warm hover:shadow-md transition-all flex flex-col justify-between" data-category="social">
          <div>
            <div class="flex items-center justify-between mb-3">
              <span class="font-headline-sm text-headline-sm text-secondary font-bold">2020</span>
              <span class="bg-secondary-fixed/50 text-secondary font-label-sm text-label-sm px-2.5 py-0.5 rounded-full font-semibold"><?= e(ps_text('महामारी सेवा', 'COVID-19')) ?></span>
            </div>
            <h4 class="font-title-md text-title-md text-deep-forest font-bold mb-2"><?= e(ps_text('कोरोना योद्धा विशिष्ट सम्मान', 'Corona Warrior Honor')) ?></h4>
            <p class="font-body-sm text-body-sm text-text-muted leading-relaxed">
              <?= e(ps_text('कोविड-19 संकट के दौरान ग्रामीण अंचलों में असहायों को भोजन, दवा, मास्क वितरण एवं राहत पहुंचाने हेतु अनेक प्रतिष्ठित संस्थाओं द्वारा अलंकृत।', 'Honored as Corona Warrior for frontline food, mask, and emergency medical relief drives.')) ?>
            </p>
          </div>
          <div class="mt-4 pt-3 border-t border-border-warm text-label-sm font-label-sm text-secondary flex items-center gap-1.5 font-semibold">
            <span class="material-symbols-outlined text-[15px]">shield</span>
            <span><?= e(ps_text('कोरोना योद्धा अलंकरण', 'Corona Warrior Citation')) ?></span>
          </div>
        </div>

        <!-- 2022 (Literary) -->
        <div class="timeline-item bg-pure-white rounded-2xl p-5 shadow-sm border border-border-warm hover:shadow-md transition-all flex flex-col justify-between" data-category="literary">
          <div>
            <div class="flex items-center justify-between mb-3">
              <span class="font-headline-sm text-headline-sm text-tertiary font-bold">2022</span>
              <span class="bg-tertiary-fixed/60 text-tertiary font-label-sm text-label-sm px-2.5 py-0.5 rounded-full font-semibold"><?= e(ps_text('साहित्य त्रिवेणी', 'Awadhi Awards')) ?></span>
            </div>
            <h4 class="font-title-md text-title-md text-deep-forest font-bold mb-2"><?= e(ps_text('प्रकृति साहित्य रत्न व तुलसी सम्मान', 'Prakriti Sahitya & Tulsi Award')) ?></h4>
            <p class="font-body-sm text-body-sm text-text-muted leading-relaxed">
              <?= e(ps_text('\'प्रकृति साहित्य रत्न\', सुप्रसिद्ध \'जनकवि बंशीधर शुक्ल पुरस्कार\' एवं अवधी भाषा की दीर्घकालिक सेवा हेतु प्रतिष्ठित \'गोस्वामी तुलसीदास सम्मान\'।', 'Honored with Banshidhar Shukla Award and Goswami Tulsidas Award for Awadhi literature.')) ?>
            </p>
          </div>
          <div class="mt-4 pt-3 border-t border-border-warm text-label-sm font-label-sm text-tertiary flex items-center gap-1.5 font-semibold">
            <span class="material-symbols-outlined text-[15px]">auto_stories</span>
            <span><?= e(ps_text('अवधी भाषा एवं साहित्य परिषद', 'Awadhi Sahitya Parishad')) ?></span>
          </div>
        </div>

        <!-- 2023 (National/Literary) -->
        <div class="timeline-item bg-pure-white rounded-2xl p-5 shadow-sm border border-border-warm hover:shadow-md transition-all flex flex-col justify-between" data-category="national">
          <div>
            <div class="flex items-center justify-between mb-3">
              <span class="font-headline-sm text-headline-sm text-primary-container font-bold">2023</span>
              <span class="bg-primary-fixed/40 text-primary-container font-label-sm text-label-sm px-2.5 py-0.5 rounded-full font-semibold"><?= e(ps_text('राष्ट्रीय सम्मान', 'National Award')) ?></span>
            </div>
            <h4 class="font-title-md text-title-md text-deep-forest font-bold mb-2"><?= e(ps_text('राष्ट्रीय आदिवासी गौरव एवं इकबाल अवार्ड', 'National Tribal Pride & Iqbal Award')) ?></h4>
            <p class="font-body-sm text-body-sm text-text-muted leading-relaxed">
              <?= e(ps_text('वंचित व वनवासी समुदायों के सांस्कृतिक संरक्षण हेतु \'राष्ट्रीय आदिवासी गौरव सम्मान\' एवं भाषा उत्सव में प्रतिष्ठित \'अल्लामा इकबाल अवार्ड\'।', 'Conferred National Tribal Pride Award for native folk culture preservation.')) ?>
            </p>
          </div>
          <div class="mt-4 pt-3 border-t border-border-warm text-label-sm font-label-sm text-primary-container flex items-center gap-1.5 font-semibold">
            <span class="material-symbols-outlined text-[15px]">workspace_premium</span>
            <span><?= e(ps_text('राष्ट्रीय सांस्कृतिक मंच', 'National Cultural Platform')) ?></span>
          </div>
        </div>

        <!-- 2024 (Literary/State) -->
        <div class="timeline-item bg-pure-white rounded-2xl p-5 shadow-sm border border-border-warm hover:shadow-md transition-all flex flex-col justify-between" data-category="literary">
          <div>
            <div class="flex items-center justify-between mb-3">
              <span class="font-headline-sm text-headline-sm text-deep-forest font-bold">2024</span>
              <span class="bg-soft-meadow text-deep-forest font-label-sm text-label-sm px-2.5 py-0.5 rounded-full font-semibold border border-border-warm"><?= e(ps_text('हिंदी संस्थान मंच', 'Hindi Sansthan')) ?></span>
            </div>
            <h4 class="font-title-md text-title-md text-deep-forest font-bold mb-2"><?= e(ps_text('अटल प्रतिभा एवं सृजन सम्मान', 'Atal Pratibha & Srijan Honor')) ?></h4>
            <p class="font-body-sm text-body-sm text-text-muted leading-relaxed">
              <?= e(ps_text('उत्तर प्रदेश हिंदी संस्थान सहयोगी मंच द्वारा \'अटल प्रतिभा सम्मान\' तथा अवधी साहित्य में विशिष्ट योगदान हेतु \'अवध ज्योति सृजन सम्मान\'।', 'Conferred Atal Pratibha Honor by UP Hindi Sansthan partner forum.')) ?>
            </p>
          </div>
          <div class="mt-4 pt-3 border-t border-border-warm text-label-sm font-label-sm text-deep-forest flex items-center gap-1.5 font-semibold">
            <span class="material-symbols-outlined text-[15px] text-primary-container">edit_note</span>
            <span><?= e(ps_text('उत्तर प्रदेश हिंदी संस्थान मंच', 'UP Hindi Sansthan Forum')) ?></span>
          </div>
        </div>

        <!-- 2025 (Literary/Social) -->
        <div class="timeline-item bg-pure-white rounded-2xl p-5 shadow-sm border border-border-warm hover:shadow-md transition-all flex flex-col justify-between" data-category="social">
          <div>
            <div class="flex items-center justify-between mb-3">
              <span class="font-headline-sm text-headline-sm text-secondary font-bold">2025</span>
              <span class="bg-secondary-fixed/50 text-secondary font-label-sm text-label-sm px-2.5 py-0.5 rounded-full font-semibold"><?= e(ps_text('गंगा साहित्य', 'Ganga Sahitya')) ?></span>
            </div>
            <h4 class="font-title-md text-title-md text-deep-forest font-bold mb-2"><?= e(ps_text('समाज गौरव एवं गंगा साहित्य रत्न', 'Samaj Gaurav & Ganga Sahitya Ratna')) ?></h4>
            <p class="font-body-sm text-body-sm text-text-muted leading-relaxed">
              <?= e(ps_text('लोक-कल्याणकारी पत्रकारिता, पर्यावरण संरक्षण एवं अवधी साहित्य की सेवा हेतु राष्ट्रीय स्तर के सामाजिक मंच द्वारा \'गंगा साहित्य रत्न\'।', 'Awarded Ganga Sahitya Ratna & Samaj Gaurav for grassroots journalism and eco-drives.')) ?>
            </p>
          </div>
          <div class="mt-4 pt-3 border-t border-border-warm text-label-sm font-label-sm text-secondary flex items-center gap-1.5 font-semibold">
            <span class="material-symbols-outlined text-[15px]">military_tech</span>
            <span><?= e(ps_text('गंगा साहित्य मंच एवं NGO संघ', 'Ganga Sahitya & NGO Federation')) ?></span>
          </div>
        </div>
      </div>
    </div>
  </section>

  <?php if (!empty($personalPhotos)): ?>
  <!-- जीवन के कुछ यादगार पल (PERSONAL MOMENTS GALLERY) -->
  <section class="w-full py-space-2xl md:py-space-4xl bg-pure-white border-b border-border-warm scroll-mt-24" id="archives">
    <div class="max-w-container-max mx-auto px-4 sm:px-8">
      <!-- Section Header -->
      <div class="text-center max-w-3xl mx-auto mb-space-xl">
        <span class="font-label-sm text-label-sm text-secondary tracking-widest font-semibold uppercase flex items-center justify-center gap-1.5 mb-1">
          <span class="material-symbols-outlined text-[18px]">photo_camera</span>
          <span><?= e(ps_text('स्मृतियों की पावन धरोहर', 'ARCHIVE OF PERSONAL MOMENTS')) ?></span>
        </span>
        <h2 class="font-headline-lg text-headline-md md:text-headline-lg text-deep-forest font-bold mt-1">
          <?= e(ps_text('जीवन के कुछ यादगार पल (Personal Moments)', 'Personal Moments & Life Journey')) ?>
        </h2>
        <p class="font-body-md text-body-md text-text-muted mt-2 leading-relaxed">
          <?= e(ps_text('प्रदीप सारंग जी के सामाजिक संघर्ष, आत्मीय जन-सरोकारों, पर्यावरण साधना और ऐतिहासिक प्रसंगों का सचित्र संकलन।', 'A curated photographic chronicle capturing Pradeep Sarang\'s grassroots dedication, social milestones, and memorable moments.')) ?>
        </p>
      </div>

      <!-- Gallery Grid -->
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6" id="personal-gallery-grid">
        <?php foreach ($personalPhotos as $idx => $photo): ?>
          <?php 
          $thumbImg = !empty($photo['thumbnail_path']) ? base_url($photo['thumbnail_path']) : base_url($photo['photo_path']);
          $fullImg = base_url($photo['photo_path']);
          $photoTitle = trim($photo['title'] ?? '');
          $photoCaption = trim($photo['caption'] ?? '');
          $photoYear = trim($photo['photo_year'] ?? '');
          $photoLoc = trim($photo['location'] ?? '');
          $isFeatured = ($idx === 0 && count($personalPhotos) >= 4);
          ?>
          <div class="<?= $isFeatured ? 'sm:col-span-2 lg:col-span-2' : '' ?> personal-photo-card group bg-surface-container-lowest rounded-2xl border border-border-warm overflow-hidden shadow-sm hover:shadow-md transition-all duration-300 flex flex-col justify-between cursor-pointer"
               onclick="openPersonalPhotoLightbox(<?= $idx ?>)"
               role="button"
               tabindex="0"
               onkeydown="if(event.key==='Enter'||event.key===' ') { event.preventDefault(); openPersonalPhotoLightbox(<?= $idx ?>); }"
               aria-label="<?= e($photoTitle ?: 'View photograph') ?>">
            
            <!-- Photo Frame with Hover Zoom & Gradient Badge Overlay -->
            <div class="relative overflow-hidden bg-surface-container <?= $isFeatured ? 'h-64 sm:h-80' : 'h-60' ?>">
              <img src="<?= e($thumbImg) ?>" 
                   alt="<?= e($photo['alt_text'] ?: ($photoTitle ?: 'Pradeep Sarang Photograph')) ?>" 
                   loading="lazy"
                   class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">

              <!-- Top Floating Pills -->
              <div class="absolute top-3 inset-x-3 flex items-center justify-between pointer-events-none">
                <?php if (!empty($photoYear)): ?>
                  <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full bg-deep-forest/85 backdrop-blur-sm text-pure-white text-xs font-semibold shadow-xs">
                    <span class="material-symbols-outlined text-[13px] text-fresh-sprout">calendar_today</span>
                    <span><?= e($photoYear) ?></span>
                  </span>
                <?php else: ?>
                  <span></span>
                <?php endif; ?>

                <?php if ($isFeatured): ?>
                  <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full bg-primary-container text-on-primary text-xs font-bold shadow-xs">
                    <span class="material-symbols-outlined text-[13px]">star</span>
                    <span><?= e(ps_text('विशेष स्मृति', 'Featured')) ?></span>
                  </span>
                <?php endif; ?>
              </div>

              <!-- Bottom Gradient Overlay with Location & Quick Expand Icon -->
              <div class="absolute bottom-0 inset-x-0 p-3.5 bg-gradient-to-t from-deep-forest/90 via-deep-forest/50 to-transparent flex items-end justify-between text-pure-white">
                <?php if (!empty($photoLoc)): ?>
                  <span class="inline-flex items-center gap-1 text-xs font-medium opacity-90 truncate max-w-[80%]">
                    <span class="material-symbols-outlined text-[14px] text-fresh-sprout">location_on</span>
                    <span class="truncate"><?= e($photoLoc) ?></span>
                  </span>
                <?php else: ?>
                  <span></span>
                <?php endif; ?>

                <div class="w-8 h-8 rounded-full bg-pure-white/20 backdrop-blur-sm group-hover:bg-primary group-hover:text-pure-white transition-colors flex items-center justify-center text-pure-white shadow-xs ml-auto shrink-0">
                  <span class="material-symbols-outlined text-[18px]">fullscreen</span>
                </div>
              </div>
            </div>

            <!-- Card Content -->
            <div class="p-4 sm:p-5 flex flex-col justify-between flex-1">
              <div>
                <h3 class="font-title-md text-title-md text-deep-forest font-bold mb-1 leading-snug group-hover:text-primary transition-colors">
                  <?= e($photoTitle ?: ps_text('व्यक्तिगत संस्मरण छायाचित्र', 'Personal Moment Photograph')) ?>
                </h3>
                <?php if (!empty($photoCaption)): ?>
                  <p class="font-body-sm text-body-sm text-text-muted line-clamp-2 leading-relaxed mt-1">
                    <?= e($photoCaption) ?>
                  </p>
                <?php endif; ?>
              </div>

              <div class="mt-3 pt-3 border-t border-border-warm/60 flex items-center justify-between text-xs text-secondary font-medium">
                <span class="flex items-center gap-1">
                  <span class="material-symbols-outlined text-[15px]">photo_library</span>
                  <span><?= e(ps_text('विस्तार से देखें', 'View details')) ?></span>
                </span>
                <span class="text-text-muted">#<?= $idx + 1 ?></span>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <!-- Interactive Lightbox / Gallery Viewer Component -->
  <div id="personal-photo-lightbox" class="fixed inset-0 z-[99999] bg-black/95 backdrop-blur-md hidden flex-col justify-between" role="dialog" aria-modal="true" aria-labelledby="lightbox-title">
    <!-- Lightbox Header -->
    <div class="p-4 sm:px-8 flex items-center justify-between text-pure-white border-b border-white/10 shrink-0 bg-black/40">
      <div class="flex items-center gap-3">
        <span class="inline-block px-3 py-1 rounded-full bg-white/10 text-white font-mono text-xs font-semibold" id="lightbox-counter">1 / 1</span>
        <span class="text-white/40 hidden sm:inline">•</span>
        <span class="text-sm font-medium text-white/80 hidden sm:inline" id="lightbox-header-title">Personal Moment</span>
      </div>
      <button type="button" onclick="closePersonalPhotoLightbox()" class="w-10 h-10 rounded-full bg-white/10 hover:bg-white/20 text-white flex items-center justify-center transition-all cursor-pointer border-0 text-xl font-bold" aria-label="<?= e(ps_text('बंद करें', 'Close viewer')) ?>">
        ✕
      </button>
    </div>

    <!-- Center Stage with Navigation Arrows and Large Image -->
    <div class="relative flex-1 flex items-center justify-center p-4 overflow-hidden select-none" id="lightbox-stage">
      <!-- Previous Arrow -->
      <button type="button" onclick="prevPersonalPhoto(event)" class="absolute left-3 sm:left-6 z-20 w-12 h-12 rounded-full bg-black/50 hover:bg-white text-white hover:text-black border border-white/20 flex items-center justify-center transition-all cursor-pointer shadow-lg" aria-label="<?= e(ps_text('पिछला चित्र', 'Previous photograph')) ?>">
        <span class="material-symbols-outlined text-[28px]">chevron_left</span>
      </button>

      <!-- Main Photo Image -->
      <div class="max-w-[92vw] max-h-[72vh] flex items-center justify-center">
        <img id="lightbox-main-img" src="" alt="" class="max-w-full max-h-[72vh] object-contain rounded-xl shadow-2xl transition-opacity duration-200">
      </div>

      <!-- Next Arrow -->
      <button type="button" onclick="nextPersonalPhoto(event)" class="absolute right-3 sm:right-6 z-20 w-12 h-12 rounded-full bg-black/50 hover:bg-white text-white hover:text-black border border-white/20 flex items-center justify-center transition-all cursor-pointer shadow-lg" aria-label="<?= e(ps_text('अगला चित्र', 'Next photograph')) ?>">
        <span class="material-symbols-outlined text-[28px]">chevron_right</span>
      </button>
    </div>

    <!-- Lightbox Footer Details Bar -->
    <div class="p-5 sm:px-8 bg-black/70 border-t border-white/10 text-pure-white shrink-0">
      <div class="max-w-4xl mx-auto flex flex-col md:flex-row md:items-center justify-between gap-3">
        <div>
          <div class="flex flex-wrap items-center gap-2 mb-1.5">
            <h3 class="font-headline-sm text-base sm:text-lg font-bold text-pure-white leading-snug m-0" id="lightbox-title"></h3>
            <span id="lightbox-year-badge" class="px-2.5 py-0.5 rounded-full bg-[#15803d] text-white text-xs font-semibold hidden"></span>
            <span id="lightbox-loc-badge" class="px-2.5 py-0.5 rounded-full bg-white/10 text-white text-xs font-medium flex items-center gap-1 hidden">
              <span class="material-symbols-outlined text-[13px] text-fresh-sprout">location_on</span>
              <span id="lightbox-loc-text"></span>
            </span>
          </div>
          <p class="font-body-sm text-xs sm:text-sm text-white/80 m-0 leading-relaxed max-w-2xl" id="lightbox-caption"></p>
        </div>
        <div class="text-white/40 text-xs flex items-center gap-3 shrink-0">
          <span>← / → Keyboard Arrows</span>
          <span>•</span>
          <span>Esc to Close</span>
        </div>
      </div>
    </div>
  </div>

  <script>
  (function initPersonalPhotosLightbox() {
    const photosData = <?= json_encode(array_map(function($p) {
      return [
        'src'      => base_url($p['photo_path']),
        'title'    => trim($p['title'] ?? ''),
        'caption'  => trim($p['caption'] ?? ''),
        'year'     => trim($p['photo_year'] ?? ''),
        'location' => trim($p['location'] ?? ''),
        'alt'      => trim($p['alt_text'] ?? '') ?: ($p['title'] ?? 'Pradeep Sarang Photograph')
      ];
    }, $personalPhotos), JSON_UNESCAPED_UNICODE) ?>;

    let currentIndex = 0;
    const lightbox = document.getElementById('personal-photo-lightbox');
    const mainImg = document.getElementById('lightbox-main-img');
    const titleEl = document.getElementById('lightbox-title');
    const headerTitleEl = document.getElementById('lightbox-header-title');
    const captionEl = document.getElementById('lightbox-caption');
    const counterEl = document.getElementById('lightbox-counter');
    const yearBadge = document.getElementById('lightbox-year-badge');
    const locBadge = document.getElementById('lightbox-loc-badge');
    const locText = document.getElementById('lightbox-loc-text');

    function updateSlide(idx) {
      if (!photosData || !photosData.length) return;
      if (idx < 0) idx = photosData.length - 1;
      if (idx >= photosData.length) idx = 0;
      currentIndex = idx;

      const cur = photosData[currentIndex];
      mainImg.style.opacity = '0.3';
      mainImg.src = cur.src;
      mainImg.alt = cur.alt || cur.title || '';
      mainImg.onload = function() {
        mainImg.style.opacity = '1';
      };

      titleEl.textContent = cur.title || 'Personal Moment';
      headerTitleEl.textContent = cur.title || 'Personal Moment';
      captionEl.textContent = cur.caption || '';
      counterEl.textContent = (currentIndex + 1) + ' / ' + photosData.length;

      if (cur.year) {
        yearBadge.textContent = cur.year;
        yearBadge.classList.remove('hidden');
      } else {
        yearBadge.classList.add('hidden');
      }

      if (cur.location) {
        locText.textContent = cur.location;
        locBadge.classList.remove('hidden');
      } else {
        locBadge.classList.add('hidden');
      }
    }

    window.openPersonalPhotoLightbox = function(index) {
      if (!lightbox) return;
      lightbox.classList.remove('hidden');
      lightbox.classList.add('flex');
      document.body.style.overflow = 'hidden';
      updateSlide(index);
    };

    window.closePersonalPhotoLightbox = function() {
      if (!lightbox) return;
      lightbox.classList.add('hidden');
      lightbox.classList.remove('flex');
      document.body.style.overflow = '';
    };

    window.prevPersonalPhoto = function(e) {
      if (e) e.stopPropagation();
      updateSlide(currentIndex - 1);
    };

    window.nextPersonalPhoto = function(e) {
      if (e) e.stopPropagation();
      updateSlide(currentIndex + 1);
    };

    // Keyboard navigation
    document.addEventListener('keydown', function(e) {
      if (!lightbox || lightbox.classList.contains('hidden')) return;
      if (e.key === 'Escape') {
        closePersonalPhotoLightbox();
      } else if (e.key === 'ArrowLeft') {
        prevPersonalPhoto();
      } else if (e.key === 'ArrowRight') {
        nextPersonalPhoto();
      }
    });

    // Touch swipe navigation for mobile
    let touchStartX = 0;
    let touchEndX = 0;
    const stage = document.getElementById('lightbox-stage');
    if (stage) {
      stage.addEventListener('touchstart', function(e) {
        touchStartX = e.changedTouches[0].screenX;
      }, { passive: true });

      stage.addEventListener('touchend', function(e) {
        touchEndX = e.changedTouches[0].screenX;
        const deltaX = touchEndX - touchStartX;
        if (Math.abs(deltaX) > 45) {
          if (deltaX > 0) {
            prevPersonalPhoto();
          } else {
            nextPersonalPhoto();
          }
        }
      }, { passive: true });
    }

    // Close on clicking backdrop
    if (lightbox) {
      lightbox.addEventListener('click', function(e) {
        if (e.target === lightbox || e.target === stage) {
          closePersonalPhotoLightbox();
        }
      });
    }
  })();
  </script>
  <?php endif; ?>

  <!-- वाणी व वैचारिक चिंतन (MEMORABLE QUOTE BANNER) -->
  <section class="w-full bg-deep-forest text-on-primary py-space-2xl md:py-space-3xl relative overflow-hidden">
    <!-- Subtle Ambient Leaf Ornament via SVG -->
    <div class="absolute right-0 top-0 bottom-0 opacity-10 flex items-center pointer-events-none pr-12">
      <svg class="w-96 h-96 text-on-primary fill-current" viewBox="0 0 24 24">
        <path d="M17,8C8,10 5.9,16.17 3.82,21.34L5.71,22L6.66,19.7C7.14,19.87 7.64,20 8,20C19,20 22,3 22,3C21,5 14,5.25 9,6.25C4,7.25 2,11.5 2,13.5C2,15.5 3.75,17.25 3.75,17.25C7,8 17,8 17,8Z"/>
      </svg>
    </div>
    <div class="max-w-4xl mx-auto px-4 sm:px-8 text-center relative z-10">
      <span class="material-symbols-outlined text-[36px] text-tertiary-fixed mb-4 inline-block">nature_people</span>
      <blockquote class="font-quote-editorial text-title-lg md:text-quote-editorial text-tertiary-fixed italic leading-relaxed max-w-3xl mx-auto">
        "<?= e(ps_text('हारना सीखा नहीं है, जीत का मैं गीत हूँ। जुगनुओं का संग है, इंसानियत का मीत हूँ।', 'I have not learned to lose; I am a song of victory. With fireflies as companions, I am a friend of humanity.')) ?>"
      </blockquote>
      <div class="mt-6 flex flex-col items-center">
        <span class="font-headline-sm text-headline-sm text-pure-white font-serif font-bold"><?= e(ps_text('प्रदीप सारंग', 'Pradeep Sarang')) ?></span>
        <span class="font-label-sm text-label-sm text-primary-fixed mt-1"><?= e(ps_text('पर्यावरणविद • जनक \'ग्रीन गैंग\' • बाराबंकी (उ.प्र.)', 'Environmentalist • Founder Green Gang • Barabanki (U.P.)')) ?></span>
      </div>
    </div>
  </section>

  <!-- संवाद एवं जनसेवा कार्यालय संपर्क (GET IN TOUCH / OFFICE REACH) -->
  <section class="w-full py-space-2xl md:py-space-3xl">
    <div class="max-w-container-max mx-auto px-4 sm:px-8">
      <div class="bg-pure-white rounded-3xl shadow-sm border border-border-warm p-8 sm:p-12">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
          <div class="lg:col-span-7">
            <span class="font-label-sm text-label-sm text-secondary tracking-wider font-bold uppercase"><?= e(ps_text('सीधा संवाद एवं सहयोग', 'Direct Outreach')) ?></span>
            <h3 class="font-headline-lg text-headline-md md:text-headline-lg text-deep-forest font-bold mt-1.5 mb-4">
              <?= e(ps_text('प्रदीप सारंग जी से संवाद, पर्यावरण अभियान अथवा साहित्यिक विमर्श हेतु संपर्क करें', 'Connect for Environmental Drives or Awadhi Literature Dialogues')) ?>
            </h3>
            <p class="font-body-md text-body-md text-on-surface-variant leading-relaxed mb-6">
              <?= e(ps_text('चाहे आपके क्षेत्र में ग्रीन गैंग की शाखा शुरू करनी हो, पौधारोपण हेतु मिट्टी के सकोरे व पौधे चाहिए हों, अथवा अवधी साहित्य शोध — सारंग जी का द्वार जनसेवा के लिए सदैव खुला है।', 'Whether starting a Green Gang wing, requesting bird water pots, or conducting Awadhi research — feel free to reach out.')) ?>
            </p>
            <div class="space-y-3 font-body-sm text-body-sm text-on-surface">
              <div class="flex items-start gap-3">
                <span class="material-symbols-outlined text-primary-container text-[20px] mt-0.5">home_pin</span>
                <span><strong><?= e(ps_text('स्थायी कार्यालय पता:', 'Permanent Office Address:')) ?></strong> <?= e(ps_text('ग्राम कमरावां, जिला बाराबंकी, उत्तर प्रदेश, भारत', 'Gram Kamrawan, District Barabanki, Uttar Pradesh, India')) ?></span>
              </div>
              <div class="flex items-center gap-3">
                <span class="material-symbols-outlined text-primary-container text-[20px]">call</span>
                <span><strong><?= e(ps_text('सीधा संपर्क / WhatsApp:', 'Phone / WhatsApp:')) ?></strong> <a href="tel:<?= e($phoneClean) ?>" class="hover:text-primary-container underline font-bold"><?= e($phone) ?></a></span>
              </div>
              <div class="flex items-center gap-3">
                <span class="material-symbols-outlined text-primary-container text-[20px]">mail</span>
                <span><strong><?= e(ps_text('आधिकारिक ई-मेल:', 'Official Email:')) ?></strong> <a href="mailto:<?= e($email) ?>" class="hover:text-primary-container underline font-semibold"><?= e($email) ?></a></span>
              </div>
            </div>
          </div>

          <div class="lg:col-span-5 flex flex-col gap-4 bg-soft-meadow rounded-2xl p-6 sm:p-8 border border-border-warm">
            <h4 class="font-title-md text-title-md text-deep-forest font-bold"><?= e(ps_text('आप कैसे सहभागिता कर सकते हैं?', 'How You Can Contribute')) ?></h4>
            <ul class="space-y-2.5 font-body-sm text-body-sm text-on-surface-variant">
              <li class="flex items-center gap-2">
                <span class="material-symbols-outlined text-primary-container text-[18px]">check_circle</span>
                <span><?= e(ps_text('\'ग्रीन गैंग\' में वॉलंटियर के रूप में जुड़ें', 'Join Green Gang as a volunteer')) ?></span>
              </li>
              <li class="flex items-center gap-2">
                <span class="material-symbols-outlined text-primary-container text-[18px]">check_circle</span>
                <span><?= e(ps_text('ग्रामीण चौपाल व पर्यावरण व्याख्यान आयोजित करें', 'Host rural Green Chaupals & sessions')) ?></span>
              </li>
              <li class="flex items-center gap-2">
                <span class="material-symbols-outlined text-primary-container text-[18px]">check_circle</span>
                <span><?= e(ps_text('अवधी संस्मरण व लोक-साहित्य साझा करें', 'Share Awadhi folklore & memoirs')) ?></span>
              </li>
            </ul>
            <div class="pt-4 flex flex-col sm:flex-row gap-3">
              <a href="tel:<?= e($phoneClean) ?>" class="inline-flex items-center justify-center gap-2 bg-primary-container hover:bg-deep-forest text-on-primary font-label-md text-label-md px-5 py-3 rounded-xl transition-colors shadow-sm text-center font-bold">
                <span class="material-symbols-outlined text-[18px]">phone_in_talk</span>
                <span><?= e(ps_text('सीधा संवाद करें', 'Call Directly')) ?></span>
              </a>
              <a href="<?= e(base_url('/contact')) ?>" data-path="contact" class="inline-flex items-center justify-center gap-2 bg-pure-white hover:bg-surface-container text-deep-forest font-label-md text-label-md px-5 py-3 rounded-xl transition-colors shadow-sm text-center border border-border-warm font-semibold">
                <span class="material-symbols-outlined text-[18px]">volunteer_activism</span>
                <span><?= e(ps_text('अभियान से जुड़ें', 'Join Movement')) ?></span>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  <!-- Dedicated Lightbox Modal for Swayam Udghosh Poster -->
  <div id="sway-udghosh-modal" class="fixed inset-0 z-[99999] bg-black/95 backdrop-blur-md hidden items-center justify-center p-4 sm:p-6" role="dialog" aria-modal="true" aria-label="Swayam Udghosh Poster">
    <button type="button" onclick="closeSwayUdghoshModal()" class="absolute top-4 right-4 z-50 w-11 h-11 rounded-full bg-white/20 hover:bg-white/40 text-white flex items-center justify-center transition-all cursor-pointer text-xl font-bold border-0" aria-label="<?= e(ps_text('बंद करें', 'Close')) ?>">
      ✕
    </button>

    <div class="relative max-w-4xl max-h-[92vh] w-full flex flex-col items-center justify-center">
      <img src="<?= e(base_url('assets/images/swayudghosh.jpg')) ?>" 
           alt="<?= e(ps_text('स्व-उद्घोष - श्री प्रदीप सारंग', 'Swayam Udghosh Poster')) ?>" 
           class="max-w-full max-h-[82vh] object-contain rounded-2xl shadow-2xl border border-white/20">
      
      <div class="mt-3 text-center text-pure-white">
        <span class="font-headline-sm text-base sm:text-lg font-bold block"><?= e(ps_text('स्व-उद्घोष • अभिरुचि एवं पसंदगी अनुरूप जीवन का नियोजन', 'Swayam Udghosh - Life Planning')) ?></span>
        <span class="font-label-sm text-xs text-white/70 block mt-0.5"><?= e(ps_text('श्री प्रदीप सारंग (द्वारा— आँखें फाउंडेशन एवं ग्रीन गैंग)', 'Shri Pradeep Sarang')) ?></span>
      </div>
    </div>
  </div>

  <script>
    function openSwayUdghoshModal() {
      const modal = document.getElementById('sway-udghosh-modal');
      if (!modal) return;
      modal.classList.remove('hidden');
      modal.classList.add('flex');
      document.body.style.overflow = 'hidden';
    }

    function closeSwayUdghoshModal() {
      const modal = document.getElementById('sway-udghosh-modal');
      if (!modal) return;
      modal.classList.add('hidden');
      modal.classList.remove('flex');
      document.body.style.overflow = '';
    }

    document.addEventListener('keydown', function(e) {
      if (e.key === 'Escape') {
        closeSwayUdghoshModal();
      }
    });

    document.getElementById('sway-udghosh-modal')?.addEventListener('click', function(e) {
      if (e.target === this) {
        closeSwayUdghoshModal();
      }
    });
  </script>
</div>

<!-- Interactive Filter JavaScript for Timeline -->
<script>
  (function() {
    const filterButtons = document.querySelectorAll('.timeline-filter-btn');
    const timelineCards = document.querySelectorAll('.timeline-item');

    filterButtons.forEach(btn => {
      btn.addEventListener('click', () => {
        const filterValue = btn.getAttribute('data-filter');

        // Reset styles
        filterButtons.forEach(b => {
          b.classList.remove('bg-primary-container', 'text-on-primary');
          b.classList.add('bg-pure-white', 'text-on-surface-variant');
        });

        // Active style
        btn.classList.remove('bg-pure-white', 'text-on-surface-variant');
        btn.classList.add('bg-primary-container', 'text-on-primary');

        // Filter cards
        timelineCards.forEach(card => {
          const cardCategory = card.getAttribute('data-category');
          if (filterValue === 'all' || cardCategory === filterValue) {
            card.style.display = 'flex';
          } else {
            card.style.display = 'none';
          }
        });
      });
    });
  })();
</script>
