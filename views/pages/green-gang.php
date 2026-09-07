<?php
declare(strict_types=1);

$campaigns = $campaigns ?? [];
$phone = trim($settings['phone'] ?? '+91 9919007190');
$phoneClean = preg_replace('/[^+0-9]/', '', $phone);
$email = trim($settings['email'] ?? 'contact@pradeepsarang.in');
?>

<div class="flex flex-col w-full">
  <!-- Top Breadcrumb & Hero Header -->
  <section class="relative w-full bg-soft-meadow overflow-hidden py-space-2xl md:py-space-3xl border-b border-border-warm">
    <div class="max-w-container-max mx-auto px-4 sm:px-8 relative z-10">
      <!-- Breadcrumb -->
      <nav aria-label="Breadcrumb" class="flex items-center gap-2 font-label-md text-label-md text-text-muted mb-space-sm">
        <a class="hover:text-primary transition-colors flex items-center gap-1" data-path="home" href="<?= e(base_url('/')) ?>">
          <span class="material-symbols-outlined text-[16px]">home</span>
          <span><?= e(ps_text('गृह (Home)', 'Home')) ?></span>
        </a>
        <span class="opacity-40">/</span>
        <span class="text-deep-forest font-semibold"><?= e(ps_text('ग्रीन गैंग अभियान (Green Gang Movement)', 'Green Gang Movement')) ?></span>
      </nav>

      <!-- Badge & Main Title -->
      <div class="max-w-4xl">
        <div class="inline-flex items-center gap-2 bg-primary-fixed/40 text-deep-forest px-3.5 py-1 rounded-full font-label-sm text-label-sm mb-space-sm border border-border-warm font-semibold">
          <span class="material-symbols-outlined text-[15px] text-primary-container" style="font-variation-settings: 'FILL' 1;">eco</span>
          <span><?= e(ps_text('5 जून 2019 (विश्व पर्यावरण दिवस) से निरंतर गतिशील क्रांति', 'Grassroots Revolution Since 5th June 2019')) ?></span>
        </div>
        <h1 class="font-display-hero text-headline-lg md:text-display-hero text-deep-forest leading-tight tracking-tight font-bold">
          <?= e(ps_text('ग्रीन गैंग: हरियाली क्रांति, पौधरोपण एवं \'ग्रीन मॉर्निंग\' का अभिनव संस्कार', 'Green Gang: Grassroots Tree Protection & Green Morning Heritage')) ?>
        </h1>
        <p class="font-body-lg text-body-lg text-text-muted mt-space-sm max-w-3xl leading-relaxed">
          <?= e(ps_text('प्रदीप सारंग द्वारा संस्थापित \'ग्रीन गैंग\' आंदोलन — 50,000+ बरगद, पीपल, नीम और पाकड़ के वृक्षों का रोपण एवं 150+ गांवों व 100+ विद्यालयों में दैनिक प्रकृति-प्रेम का संस्कार।', 'A community-led movement transforming greetings into tree conservation, planting over 50,000 native shade trees across Awadh.')) ?>
        </p>
      </div>
    </div>
  </section>

  <!-- 4 High-Impact Metric Summary Ribbon -->
  <section class="w-full bg-deep-forest text-pure-white py-space-xl">
    <div class="max-w-container-max mx-auto px-4 sm:px-8">
      <div class="grid grid-cols-2 md:grid-cols-4 gap-6 text-center">
        <div class="flex flex-col p-5 rounded-2xl bg-surface-container-low/10 border border-surface-container-high/15">
          <span class="material-symbols-outlined text-fresh-sprout text-[36px] mb-2 mx-auto">park</span>
          <span class="font-headline-lg text-headline-lg text-primary-fixed leading-tight font-bold">50,000+</span>
          <span class="font-title-md text-title-md text-surface-container-high font-semibold mt-1"><?= e(ps_text('वृक्षारोपण व संरक्षण', 'Trees Planted')) ?></span>
          <span class="font-label-sm text-label-sm text-surface-container-high/80 mt-1"><?= e(ps_text('बरगद, पीपल, नीम व पाकड़', 'Native Banyan & Peepal')) ?></span>
        </div>

        <div class="flex flex-col p-5 rounded-2xl bg-surface-container-low/10 border border-surface-container-high/15">
          <span class="material-symbols-outlined text-primary-fixed text-[36px] mb-2 mx-auto">school</span>
          <span class="font-headline-lg text-headline-lg text-primary-fixed leading-tight font-bold">100+</span>
          <span class="font-title-md text-title-md text-surface-container-high font-semibold mt-1"><?= e(ps_text('स्कूलों में \'ग्रीन मॉर्निंग\'', 'Green Morning Schools')) ?></span>
          <span class="font-label-sm text-label-sm text-surface-container-high/80 mt-1"><?= e(ps_text('दैनिक पर्यावरण संस्कार', 'Daily Eco Ritual')) ?></span>
        </div>

        <div class="flex flex-col p-5 rounded-2xl bg-surface-container-low/10 border border-surface-container-high/15">
          <span class="material-symbols-outlined text-tertiary-fixed text-[36px] mb-2 mx-auto">cottage</span>
          <span class="font-headline-lg text-headline-lg text-tertiary-fixed leading-tight font-bold">150+</span>
          <span class="font-title-md text-title-md text-surface-container-high font-semibold mt-1"><?= e(ps_text('गाँव व पंचायतें', 'Villages Reached')) ?></span>
          <span class="font-label-sm text-label-sm text-surface-container-high/80 mt-1"><?= e(ps_text('बाराबंकी व फैज़ाबाद अंचल', 'Barabanki & Ayodhya')) ?></span>
        </div>

        <div class="flex flex-col p-5 rounded-2xl bg-surface-container-low/10 border border-surface-container-high/15">
          <span class="material-symbols-outlined text-secondary-fixed text-[36px] mb-2 mx-auto">verified_user</span>
          <span class="font-headline-lg text-headline-lg text-secondary-fixed leading-tight font-bold">85%+</span>
          <span class="font-title-md text-title-md text-surface-container-high font-semibold mt-1"><?= e(ps_text('पौध जीवित दर', 'Sapling Survival Rate')) ?></span>
          <span class="font-label-sm text-label-sm text-surface-container-high/80 mt-1"><?= e(ps_text('सुरक्षा ट्री-गार्ड एवं सिंचाई', 'Protected with Tree-Guards')) ?></span>
        </div>
      </div>
    </div>
  </section>

  <!-- Core Pillars of Green Gang Movement -->
  <section class="w-full bg-cream-canvas py-space-3xl border-b border-border-warm">
    <div class="max-w-container-max mx-auto px-4 sm:px-8">
      <div class="text-center max-w-3xl mx-auto mb-space-xl">
        <span class="font-label-sm text-label-sm text-secondary tracking-widest font-bold uppercase"><?= e(ps_text('वैचारिक आधार', 'Core Pillars')) ?></span>
        <h2 class="font-headline-lg text-headline-md md:text-headline-lg text-deep-forest font-bold mt-1">
          <?= e(ps_text('\'ग्रीन गैंग\' आंदोलन के चार मुख्य आधार स्तंभ', 'Four Fundamental Pillars of Green Gang')) ?>
        </h2>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <!-- Pillar 1 -->
        <div class="bg-pure-white rounded-3xl p-6 sm:p-8 shadow-sm border border-border-warm hover:shadow-md transition-all flex flex-col justify-between">
          <div>
            <div class="w-12 h-12 rounded-2xl bg-primary-fixed/40 text-primary-container flex items-center justify-center mb-5 border border-border-warm">
              <span class="material-symbols-outlined text-[28px]">waving_hand</span>
            </div>
            <h3 class="font-headline-sm text-headline-sm text-deep-forest font-bold mb-3">
              1. <?= e(ps_text('\'ग्रीन मॉर्निंग\' दैनिक अभिवादन संस्कार', 'The \'Green Morning\' Daily Greeting Ritual')) ?>
            </h3>
            <p class="font-body-md text-body-md text-on-surface-variant leading-relaxed mb-4">
              <?= e(ps_text('विद्यालयों, चौपालों और सार्वजनिक जीवन में \'गुड मॉर्निंग\' की जगह \'ग्रीन मॉर्निंग\' (Green Morning) बोलने का शिष्टाचार। यह शब्द प्रत्येक व्यक्ति को रोज़ सवेरे प्रकृति के प्रति अपने नैतिक कर्तव्य का स्मरण दिलाता है।', 'Replacing \'Good Morning\' with \'Green Morning\' across schools, village chaupals, and families as a daily reminder to nurture nature.')) ?>
            </p>
          </div>
          <div class="bg-soft-meadow p-3.5 rounded-xl border border-border-warm font-body-sm text-body-sm text-deep-forest font-semibold flex items-center gap-2">
            <span class="material-symbols-outlined text-primary-container text-[18px]">eco</span>
            <span><?= e(ps_text('100+ विद्यालयों में दैनिक प्रार्थना सत्र में शामिल', 'Practiced daily in 100+ school assemblies')) ?></span>
          </div>
        </div>

        <!-- Pillar 2 -->
        <div class="bg-pure-white rounded-3xl p-6 sm:p-8 shadow-sm border border-border-warm hover:shadow-md transition-all flex flex-col justify-between">
          <div>
            <div class="w-12 h-12 rounded-2xl bg-secondary-fixed text-secondary flex items-center justify-center mb-5 border border-border-warm">
              <span class="material-symbols-outlined text-[28px]">cake</span>
            </div>
            <h3 class="font-headline-sm text-headline-sm text-deep-forest font-bold mb-3">
              2. <?= e(ps_text('पारिवारिक मांगलिक अवसरों पर पौध संकल्प', 'Milestone Family Tree Pledges')) ?>
            </h3>
            <p class="font-body-md text-body-md text-on-surface-variant leading-relaxed mb-4">
              <?= e(ps_text('जन्मदिन, विवाह वर्षगांठ अथवा पूर्वजों की स्मृति में पौधा रोपने और उसका संरक्षण करने का पारिवारिक संकल्प। पर्यावरण संवर्धन को पारिवारिक उत्सव का पावन भाग बनाया गया।', 'Planting and adopting a tree on every birthday, anniversary, or memorial, transforming tree care into a family tradition.')) ?>
            </p>
          </div>
          <div class="bg-soft-meadow p-3.5 rounded-xl border border-border-warm font-body-sm text-body-sm text-deep-forest font-semibold flex items-center gap-2">
            <span class="material-symbols-outlined text-secondary text-[18px]">favorite</span>
            <span><?= e(ps_text('हजारों परिवारों द्वारा जीवन-अवसरों पर पौध रोपण', 'Thousands of families planting trees on special occasions')) ?></span>
          </div>
        </div>

        <!-- Pillar 3 -->
        <div class="bg-pure-white rounded-3xl p-6 sm:p-8 shadow-sm border border-border-warm hover:shadow-md transition-all flex flex-col justify-between">
          <div>
            <div class="w-12 h-12 rounded-2xl bg-tertiary-fixed text-tertiary flex items-center justify-center mb-5 border border-border-warm">
              <span class="material-symbols-outlined text-[28px]">forest</span>
            </div>
            <h3 class="font-headline-sm text-headline-sm text-deep-forest font-bold mb-3">
              3. <?= e(ps_text('देसी छायादार व फलदार वृक्षों को प्राथमिकता', 'Native Shade Trees (Banyan, Peepal, Neem)')) ?>
            </h3>
            <p class="font-body-md text-body-md text-on-surface-variant leading-relaxed mb-4">
              <?= e(ps_text('विदेशी सुबबूल या यूकेलिप्टस के बजाय अवध की जलवायु के अनुकूल बरगद, पीपल, नीम, पाकड़, महुआ और आम के देशी वृक्षों का रोपण, जो प्रचुर मात्रा में ऑक्सीजन और पक्षियों को प्राकृतिक आश्रय प्रदान करते हैं।', 'Prioritizing native species like Banyan, Peepal, Neem, Pakad, and Mango suited for Awadh climate over non-native trees.')) ?>
            </p>
          </div>
          <div class="bg-soft-meadow p-3.5 rounded-xl border border-border-warm font-body-sm text-body-sm text-deep-forest font-semibold flex items-center gap-2">
            <span class="material-symbols-outlined text-tertiary text-[18px]">nature</span>
            <span><?= e(ps_text('अधिकतम ऑक्सीजन एवं पक्षियों का प्राकृतिक बसेरा', 'Maximum oxygen & bird habitat preservation')) ?></span>
          </div>
        </div>

        <!-- Pillar 4 -->
        <div class="bg-pure-white rounded-3xl p-6 sm:p-8 shadow-sm border border-border-warm hover:shadow-md transition-all flex flex-col justify-between">
          <div>
            <div class="w-12 h-12 rounded-2xl bg-primary-fixed/40 text-primary-container flex items-center justify-center mb-5 border border-border-warm">
              <span class="material-symbols-outlined text-[28px]">groups</span>
            </div>
            <h3 class="font-headline-sm text-headline-sm text-deep-forest font-bold mb-3">
              4. <?= e(ps_text('ग्राम युवा दस्ता एवं ट्री-गार्ड सुरक्षा', 'Youth Green Guards & Tree-Guard Safety')) ?>
            </h3>
            <p class="font-body-md text-body-md text-on-surface-variant leading-relaxed mb-4">
              <?= e(ps_text('प्रत्येक गाँव में युवा स्वयंसेवकों का दस्ता गठित किया जाता है। प्रत्येक पौधे को ट्री-गार्ड से सुरक्षित कर 10 पौधों के नियमित जल व संरक्षण की जिम्मेदारी एक युवा प्रहरी को सौंपी जाती है।', 'Forming village youth squads where each volunteer adopts and waters 10 tree-guarded saplings daily.')) ?>
            </p>
          </div>
          <div class="bg-soft-meadow p-3.5 rounded-xl border border-border-warm font-body-sm text-body-sm text-deep-forest font-semibold flex items-center gap-2">
            <span class="material-symbols-outlined text-primary-container text-[18px]">shield</span>
            <span><?= e(ps_text('संरक्षण के बिना रोपण नहीं — 85% जीवित दर', 'No planting without protection guards')) ?></span>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- How Green Gang Works (3-Step Model) -->
  <section class="w-full bg-soft-meadow py-space-3xl border-b border-border-warm">
    <div class="max-w-container-max mx-auto px-4 sm:px-8">
      <div class="text-center max-w-3xl mx-auto mb-space-xl">
        <span class="font-label-sm text-label-sm text-secondary tracking-widest font-bold uppercase"><?= e(ps_text('कार्यप्रणाली', 'Operational Model')) ?></span>
        <h2 class="font-headline-lg text-headline-md md:text-headline-lg text-deep-forest font-bold mt-1">
          <?= e(ps_text('ग्रीन गैंग की पारदर्शी एवं सहभागी कार्यशैली', 'How Green Gang Operates in 3 Simple Steps')) ?>
        </h2>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Step 1 -->
        <div class="bg-pure-white rounded-3xl p-6 sm:p-8 shadow-sm border border-border-warm flex flex-col justify-between">
          <div>
            <span class="w-10 h-10 rounded-full bg-primary-container text-on-primary font-bold flex items-center justify-center mb-4">1</span>
            <h3 class="font-title-lg text-title-lg text-deep-forest font-bold mb-2"><?= e(ps_text('ग्राम चौपाल गठन', 'Village Chaupal Assembly')) ?></h3>
            <p class="font-body-md text-body-md text-on-surface-variant leading-relaxed">
              <?= e(ps_text('गांव में युवाओं, किसानों एवं विद्यार्थियों की बैठक कर पर्यावरण संरक्षण और ग्रीन गैंग शाखा का गठन किया जाता है।', 'Gathering villagers, farmers, and students to form a local Green Gang unit.')) ?>
            </p>
          </div>
        </div>

        <!-- Step 2 -->
        <div class="bg-pure-white rounded-3xl p-6 sm:p-8 shadow-sm border border-border-warm flex flex-col justify-between">
          <div>
            <span class="w-10 h-10 rounded-full bg-secondary text-on-secondary font-bold flex items-center justify-center mb-4">2</span>
            <h3 class="font-title-lg text-title-lg text-deep-forest font-bold mb-2"><?= e(ps_text('पौध गोद लेना व ट्री-गार्ड', 'Sapling Adoption & Tree-Guard')) ?></h3>
            <p class="font-body-md text-body-md text-on-surface-variant leading-relaxed">
              <?= e(ps_text('स्वयंसेवकों को देशी पौध एवं सुरक्षा ट्री-गार्ड वितरित किए जाते हैं। प्रत्येक पौधा किसी विशिष्ट व्यक्ति को गोद दिया जाता है।', 'Distributing saplings with protective guards and assigning them to individuals.')) ?>
            </p>
          </div>
        </div>

        <!-- Step 3 -->
        <div class="bg-pure-white rounded-3xl p-6 sm:p-8 shadow-sm border border-border-warm flex flex-col justify-between">
          <div>
            <span class="w-10 h-10 rounded-full bg-tertiary text-on-tertiary font-bold flex items-center justify-center mb-4">3</span>
            <h3 class="font-title-lg text-title-lg text-deep-forest font-bold mb-2"><?= e(ps_text('\'ग्रीन मॉर्निंग\' दैनिक देखभाल', 'Daily Green Morning Care')) ?></h3>
            <p class="font-body-md text-body-md text-on-surface-variant leading-relaxed">
              <?= e(ps_text('युवा प्रहरी प्रतिदिन प्रातः \'ग्रीन मॉर्निंग\' के साथ मिट्टी की नमी जांचते हैं तथा पौधों की सिंचाई व निराई सुनिश्चित करते हैं।', 'Youth guards greet each morning with Green Morning, ensuring daily watering.')) ?>
            </p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Green Gang Drive Photo Showcase -->
  <section class="w-full bg-cream-canvas py-space-3xl border-b border-border-warm">
    <div class="max-w-container-max mx-auto px-4 sm:px-8">
      <div class="flex flex-col md:flex-row md:items-end justify-between mb-space-xl gap-4">
        <div>
          <span class="font-label-sm text-label-sm text-secondary tracking-widest font-bold uppercase"><?= e(ps_text('सजीव झलकियाँ', 'Drive Spotlight')) ?></span>
          <h2 class="font-headline-lg text-headline-md md:text-headline-lg text-deep-forest font-bold mt-1">
            <?= e(ps_text('ग्रीन गैंग अभियानों के सजीव छायाचित्र', 'Green Gang Drives Field Photographs')) ?>
          </h2>
        </div>
        <a href="<?= e(base_url('/portfolio')) ?>" class="inline-flex items-center gap-1 font-label-md text-label-md text-primary hover:text-deep-forest font-bold">
          <span><?= e(ps_text('सम्पूर्ण दीर्घा देखें', 'View Full Gallery')) ?></span>
          <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
        </a>
      </div>

      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="group relative rounded-2xl overflow-hidden shadow-sm border border-border-warm aspect-[4/3] bg-surface-container">
          <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuChrvMjaMrNe9mnv0wsNeczsA9QTsVBVexwNC6wWD2ITtZGUqAqC4rJlu14alM7uVOx3q6e6QMugj2k_SVptJFwJxqw4kgUmkZfc4oZSwOSInUiqwcST-ZVxWP0dQNinxgeGayBKo9MBnd0LReS_tvv8rW_e0uWQz8FI_1PBQ_sze_mt4-UezPUkio4HIFKvoUNP0kZ6gNLPilWihHeDYhJaX6ySBPHJHVKOu68a1dbF1aYaqyDO7Db" alt="Green Gang Planting" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
          <a href="https://lh3.googleusercontent.com/aida-public/AB6AXuChrvMjaMrNe9mnv0wsNeczsA9QTsVBVexwNC6wWD2ITtZGUqAqC4rJlu14alM7uVOx3q6e6QMugj2k_SVptJFwJxqw4kgUmkZfc4oZSwOSInUiqwcST-ZVxWP0dQNinxgeGayBKo9MBnd0LReS_tvv8rW_e0uWQz8FI_1PBQ_sze_mt4-UezPUkio4HIFKvoUNP0kZ6gNLPilWihHeDYhJaX6ySBPHJHVKOu68a1dbF1aYaqyDO7Db" data-ps-lightbox data-caption="<?= e(ps_text('ग्रीन गैंग पौधारोपण — कमरावाँ', 'Green Gang Planting - Kamrawan')) ?>" class="absolute inset-0 bg-deep-forest/60 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center text-pure-white font-label-md text-label-md font-bold gap-1">
            <span class="material-symbols-outlined text-[20px]">zoom_in</span>
            <span><?= e(ps_text('चित्र देखें', 'View Photo')) ?></span>
          </a>
        </div>

        <div class="group relative rounded-2xl overflow-hidden shadow-sm border border-border-warm aspect-[4/3] bg-surface-container">
          <img src="https://picsum.photos/seed/greengang-2/900/700" alt="Village Tree Guard" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
          <a href="https://picsum.photos/seed/greengang-2/900/700" data-ps-lightbox data-caption="<?= e(ps_text('ट्री-गार्ड सुरक्षा अभियान', 'Tree Guard Safety Drive')) ?>" class="absolute inset-0 bg-deep-forest/60 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center text-pure-white font-label-md text-label-md font-bold gap-1">
            <span class="material-symbols-outlined text-[20px]">zoom_in</span>
            <span><?= e(ps_text('चित्र देखें', 'View Photo')) ?></span>
          </a>
        </div>

        <div class="group relative rounded-2xl overflow-hidden shadow-sm border border-border-warm aspect-[4/3] bg-surface-container">
          <img src="https://picsum.photos/seed/greengang-3/900/700" alt="School Green Morning" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
          <a href="https://picsum.photos/seed/greengang-3/900/700" data-ps-lightbox data-caption="<?= e(ps_text('स्कूलों में ग्रीन मॉर्निंग संस्कार', 'School Green Morning Assembly')) ?>" class="absolute inset-0 bg-deep-forest/60 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center text-pure-white font-label-md text-label-md font-bold gap-1">
            <span class="material-symbols-outlined text-[20px]">zoom_in</span>
            <span><?= e(ps_text('चित्र देखें', 'View Photo')) ?></span>
          </a>
        </div>

        <div class="group relative rounded-2xl overflow-hidden shadow-sm border border-border-warm aspect-[4/3] bg-surface-container">
          <img src="https://picsum.photos/seed/greengang-4/900/700" alt="Green Chaupal Assembly" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
          <a href="https://picsum.photos/seed/greengang-4/900/700" data-ps-lightbox data-caption="<?= e(ps_text('ग्राम ग्रीन चौपाल', 'Village Green Chaupal')) ?>" class="absolute inset-0 bg-deep-forest/60 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center text-pure-white font-label-md text-label-md font-bold gap-1">
            <span class="material-symbols-outlined text-[20px]">zoom_in</span>
            <span><?= e(ps_text('चित्र देखें', 'View Photo')) ?></span>
          </a>
        </div>
      </div>
    </div>
  </section>

  <!-- Join Green Gang Registration Form & Callout -->
  <section class="w-full bg-soft-meadow py-space-3xl">
    <div class="max-w-container-editorial mx-auto px-4 sm:px-8">
      <div class="text-center mb-8">
        <span class="inline-block bg-cream-canvas border border-border-warm text-primary-container px-3 py-1 rounded-md font-label-md text-label-md uppercase mb-2 font-semibold">
          <?= e(ps_text('अपने गाँव / विद्यालय में ग्रीन गैंग शाखा खोलें', 'Start a Green Gang Unit')) ?>
        </span>
        <h2 class="font-headline-lg text-headline-lg text-deep-forest mb-3 font-bold">
          <?= e(ps_text('ग्रीन गैंग में शामिल हों अथवा पौध मंगवाएं', 'Join Green Gang or Request Saplings')) ?>
        </h2>
        <p class="font-body-md text-body-md text-on-surface-variant">
          <?= e(ps_text('यदि आप अपने गाँव, पंचायत अथवा विद्यालय में ग्रीन गैंग की शाखा शुरू करना चाहते हैं, तो विवरण दर्ज करें।', 'Enroll to start a Green Gang chapter or request native tree saplings for your area.')) ?>
        </p>
      </div>

      <div class="bg-pure-white rounded-3xl p-6 sm:p-10 shadow-md border border-border-warm">
        <form method="post" action="<?= e(base_url('/contact')) ?>" class="space-y-5">
          <?= csrf_field() ?>
          <input type="hidden" name="form_type" value="contact">
          <input type="hidden" name="subject" value="ग्रीन गैंग शाखा पंजीकरण / पौध मांग">

          <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
            <div>
              <label class="block font-label-md text-label-md text-on-surface mb-1.5 font-semibold"><?= e(ps_text('आपका नाम *', 'Full Name *')) ?></label>
              <input type="text" name="name" required placeholder="<?= e(ps_text('उदा. विकास वर्मा', 'e.g. Vikas Verma')) ?>" class="w-full bg-soft-meadow border border-border-warm text-on-surface px-4 py-3 rounded-xl font-body-md text-body-md focus:outline-none focus:ring-2 focus:ring-primary-container">
            </div>
            <div>
              <label class="block font-label-md text-label-md text-on-surface mb-1.5 font-semibold"><?= e(ps_text('मोबाइल / WhatsApp *', 'Mobile / WhatsApp *')) ?></label>
              <input type="tel" name="phone" required placeholder="<?= e(ps_text('10 अंकों का मोबाइल नंबर', '10 digit mobile number')) ?>" class="w-full bg-soft-meadow border border-border-warm text-on-surface px-4 py-3 rounded-xl font-body-md text-body-md focus:outline-none focus:ring-2 focus:ring-primary-container">
            </div>
          </div>

          <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
            <div>
              <label class="block font-label-md text-label-md text-on-surface mb-1.5 font-semibold"><?= e(ps_text('गाँव / स्कूल / संस्था का नाम *', 'Village / School / Org Name *')) ?></label>
              <input type="text" name="address" required placeholder="<?= e(ps_text('उदा. ग्राम कमरावाँ / प्राथमिक विद्यालय', 'e.g. Kamrawan Primary School')) ?>" class="w-full bg-soft-meadow border border-border-warm text-on-surface px-4 py-3 rounded-xl font-body-md text-body-md focus:outline-none focus:ring-2 focus:ring-primary-container">
            </div>
            <div>
              <label class="block font-label-md text-label-md text-on-surface mb-1.5 font-semibold"><?= e(ps_text('कितने पौधों की आवश्यकता है?', 'Required Sapling Count')) ?></label>
              <select name="message" class="w-full bg-soft-meadow border border-border-warm text-on-surface px-4 py-3 rounded-xl font-body-md text-body-md focus:outline-none focus:ring-2 focus:ring-primary-container">
                <option value="10-50 पौध (छोटे स्तर पर)"><?= e(ps_text('10 — 50 पौध (छोटे स्तर पर)', '10 — 50 Saplings (Small Scale)')) ?></option>
                <option value="50-200 पौध (गाँव / स्कूल स्तर)"><?= e(ps_text('50 — 200 पौध (गाँव / स्कूल स्तर)', '50 — 200 Saplings (Village Level)')) ?></option>
                <option value="200+ पौध (पंचायत स्तर)"><?= e(ps_text('200+ पौध (पंचायत स्तर)', '200+ Saplings (Panchayat Scale)')) ?></option>
              </select>
            </div>
          </div>

          <button type="submit" class="w-full bg-primary-container hover:bg-deep-forest text-on-primary py-4 px-6 rounded-xl font-label-md text-label-md font-bold transition-colors flex items-center justify-center gap-2 shadow-sm">
            <span class="material-symbols-outlined text-[20px]">eco</span>
            <span><?= e(ps_text('ग्रीन गैंग पंजीकरण जमा करें (Submit Enrollment)', 'Submit Enrollment')) ?></span>
          </button>
        </form>
      </div>
    </div>
  </section>
</div>
