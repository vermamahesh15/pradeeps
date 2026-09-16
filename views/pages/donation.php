<?php
declare(strict_types=1);

$donation_settings = $donation_settings ?? [];
$accountName = trim($donation_settings['account_name'] ?? '') ?: ps_text('प्रदीप सारंग जनसेवा एवं पर्यावरण न्यास', 'Pradeep Sarang');
$bankName = trim($donation_settings['bank_name'] ?? '') ?: ps_text('State Bank of India (भारतीय स्टेट बैंक)', 'State Bank of India (SBI)');
$accountNumber = trim($donation_settings['account_number'] ?? '') ?: '38947291048';
$ifscCode = trim($donation_settings['ifsc'] ?? '') ?: 'SBIN0005471';
$upiId = trim($donation_settings['upi_id'] ?? '') ?: 'pradeepsarang@upi';
$contactPhone = trim($settings['phone'] ?? '+91 9919007190');
$contactEmail = trim($settings['email'] ?? 'contact@pradeepsarang.in');
?>

<div class="flex flex-col w-full">
  <!-- BREADCRUMB & INTRODUCTORY BANNER -->
  <section class="relative w-full bg-soft-meadow overflow-hidden border-b border-border-warm">
    <!-- Subtle Ambient Backdrop Accent -->
    <div class="absolute -top-32 -right-32 w-96 h-96 rounded-full bg-fresh-sprout/10 blur-3xl pointer-events-none"></div>
    <div class="absolute -bottom-24 -left-20 w-80 h-80 rounded-full bg-secondary-container/10 blur-2xl pointer-events-none"></div>
    
    <div class="max-w-container-max mx-auto px-4 sm:px-8 py-space-2xl md:py-space-3xl relative z-10">
      <!-- Breadcrumb Nav -->
      <nav class="flex items-center gap-2 font-label-md text-label-md text-text-muted mb-space-sm" aria-label="Breadcrumb">
        <a href="<?= e(base_url('/')) ?>" class="hover:text-primary transition-colors flex items-center gap-1">
          <span class="material-symbols-outlined text-[16px]">home</span>
          <span><?= e(ps_text('होम', 'Home')) ?></span>
        </a>
        <span class="opacity-40">/</span>
        <span class="text-deep-forest font-semibold"><?= e(ps_text('दान, लोक-सहयोग एवं वित्तीय शुचिता', 'Donation & Financial Transparency')) ?></span>
      </nav>

      <!-- Status Pill -->
      <div class="inline-flex items-center gap-2 bg-primary-fixed/40 text-deep-forest px-3.5 py-1 rounded-full font-label-sm text-label-sm mb-space-sm border border-border-warm font-semibold">
        <span class="w-2 h-2 rounded-full bg-fresh-sprout animate-pulse"></span>
        <span class="font-label-sm text-label-sm text-deep-forest font-semibold uppercase tracking-wider">
          <?= e(ps_text('माटी और मनुष्यता का ऋण • 100% पारदर्शी एवं जन-समर्पित सहयोग', '100% Transparent Community Contribution')) ?>
        </span>
      </div>

      <!-- Main Headline Grid -->
      <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
        <div class="lg:col-span-8 flex flex-col space-y-4">
          <h1 class="font-display-hero text-headline-lg md:text-display-hero text-deep-forest leading-tight tracking-tight font-bold">
            <?= ps_text('माटी के ऋण और बेजुबानों की रक्षा में हाथ बंटाएँ — <span class="text-primary">दान एवं लोक-सहयोग</span>', 'Support Land & Wildlife Conservation — <span class="text-primary">Donations & Public Support</span>') ?>
          </h1>
          <p class="font-body-lg text-body-lg text-text-muted max-w-3xl leading-relaxed">
            <?= e(ps_text('प्रदीप सारंग जी का चार दशकों का जीवन जनसेवा, पौधरोपण और अवधी संस्कृति के संवर्धन को समर्पित है। आपका प्रत्येक अंशदान बाराबंकी और ग्रामीण अंचलों में प्रत्यक्ष ज़मीनी बदलाव लाता है।', 'Shri Pradeep Sarang\'s four decades of dedication to environmental protection, Awadhi literature, and rural service. Every contribution drives direct grassroots impact.')) ?>
          </p>
        </div>

        <!-- Editorial Quote Card -->
        <div class="lg:col-span-4 bg-surface-container-lowest rounded-2xl p-6 shadow-sm border-l-4 border-l-secondary border border-border-warm relative">
          <span class="material-symbols-outlined text-secondary/30 text-4xl absolute top-3 right-3 select-none">format_quote</span>
          <p class="font-quote-editorial text-quote-editorial text-on-surface leading-snug italic mb-4">
            <?= ps_text('"जनसेवा कोई व्यापार नहीं, यह समाज का समाज को समर्पण है। हर पाई का हिसाब और हर पौधे की ज़िम्मेदारी हमारी निष्ठा है।"', '"Community service is not business; it is society\'s devotion to society. Accountability for every rupee and every tree is our vow."') ?>
          </p>
          <div class="flex items-center gap-3">
            <div class="w-9 h-9 rounded-full bg-primary-container flex items-center justify-center text-pure-white font-semibold text-xs shadow-sm">
              प.सा.
            </div>
            <div>
              <p class="font-title-md text-title-md text-deep-forest leading-tight font-bold"><?= e(ps_text('प्रदीप सारंग', 'Pradeep Sarang')) ?></p>
              <p class="font-label-sm text-label-sm text-text-muted"><?= e(ps_text('संस्थापक, ग्रीन मॉर्निंग अभियान व साहित्य मनीषी', 'Founder, Green Morning Movement')) ?></p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

<!-- Direct Field Impact Image Showcase -->
<section class="w-full py-space-xl bg-pure-white border-b border-border-warm">
  <div class="max-w-container-max mx-auto px-4 sm:px-8">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
      <div class="relative rounded-2xl overflow-hidden shadow-sm border border-border-warm group">
        <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuChrvMjaMrNe9mnv0wsNeczsA9QTsVBVexwNC6wWD2ITtZGUqAqC4rJlu14alM7uVOx3q6e6QMugj2k_SVptJFwJxqw4kgUmkZfc4oZSwOSInUiqwcST-ZVxWP0dQNinxgeGayBKo9MBnd0LReS_tvv8rW_e0uWQz8FI_1PBQ_sze_mt4-UezPUkio4HIFKvoUNP0kZ6gNLPilWihHeDYhJaX6ySBPHJHVKOu68a1dbF1aYaqyDO7Db" alt="Tree Distribution" class="w-full h-56 object-cover group-hover:scale-105 transition-transform duration-300">
        <div class="absolute bottom-0 inset-x-0 bg-gradient-to-t from-deep-forest/90 via-deep-forest/50 to-transparent p-4 text-pure-white">
          <span class="font-label-sm text-label-sm uppercase tracking-wider text-fresh-sprout font-bold"><?= e(ps_text('100% पारदर्शी पौधरोपण', '100% Transparent Tree Planting')) ?></span>
          <p class="font-title-md text-title-md font-bold mt-0.5"><?= e(ps_text('आपके सहयोग से रोपित बरगद, पीपल व नीम के जीवित वृक्ष', 'Tree Planting Supported Directly by Community Donations')) ?></p>
        </div>
      </div>
      <div class="relative rounded-2xl overflow-hidden shadow-sm border border-border-warm group">
        <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuCIdMQwsnVo2dk4ut7g6q_cAP6eTxbCJ79UEWEL6LMYJP9Bzoa711KY0DUcQDKRXxuQ_6LQhxi0vQ2STd8MG_7M8PMwLDKDbl4rkN0NWnrSqVTvaAamPZA23ot4DWOtvh7QMTvSKjQWd4KHteII-UyAePIVzkOU6Kjt18WGSoV63V45Zxnm-uJxCWTIYBFdLiZQTIIpMJ2BicU3nJOrp9TW5wTXMOaNdUj57zI1cu2Z0PJgk4oP02r7" alt="Water Bowl Distribution" class="w-full h-56 object-cover group-hover:scale-105 transition-transform duration-300">
        <div class="absolute bottom-0 inset-x-0 bg-gradient-to-t from-deep-forest/90 via-deep-forest/50 to-transparent p-4 text-pure-white">
          <span class="font-label-sm text-label-sm uppercase tracking-wider text-tertiary-fixed font-bold"><?= e(ps_text('सकोरा बैंक सेवा', 'Sakora Distribution Drive')) ?></span>
          <p class="font-title-md text-title-md font-bold mt-0.5"><?= e(ps_text('पक्षियों हेतु मिट्टी के सकोरे व दाना-पानी वितरण', 'Bird Water Bowl & Grain Distribution Across Awadh')) ?></p>
        </div>
      </div>
    </div>
  </div>
</section>

  <!-- IMPACT & TRANSPARENCY METRICS RIBBON -->
  <section class="w-full bg-cream-canvas py-10 border-b border-border-warm">
    <div class="max-w-container-max mx-auto px-4 sm:px-8">
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
        <!-- Metric 1 -->
        <div class="bg-surface-container-lowest rounded-2xl p-6 shadow-sm border border-border-warm flex flex-col justify-between hover:shadow-md transition-shadow">
          <div class="flex items-center justify-between mb-4">
            <span class="w-12 h-12 rounded-xl bg-soft-meadow text-primary flex items-center justify-center border border-border-warm">
              <span class="material-symbols-outlined text-2xl">verified_user</span>
            </span>
            <span class="font-label-sm text-label-sm text-primary font-bold bg-surface-container px-2.5 py-0.5 rounded-full"><?= e(ps_text('शत-प्रतिशत', '100% Direct')) ?></span>
          </div>
          <div>
            <div class="font-display-hero text-headline-lg text-deep-forest font-bold mb-1">100%</div>
            <h3 class="font-title-md text-title-md text-on-surface font-bold mb-1"><?= e(ps_text('प्रत्यक्ष ज़मीनी उपयोग', 'Grassroots Impact')) ?></h3>
            <p class="font-body-sm text-body-sm text-text-muted"><?= e(ps_text('शून्य प्रशासनिक कटौती, बिचौलियों से पूर्णतः मुक्त सीधी सेवा।', 'Zero administrative cuts, direct community execution.')) ?></p>
          </div>
        </div>

        <!-- Metric 2 -->
        <div class="bg-surface-container-lowest rounded-2xl p-6 shadow-sm border border-border-warm flex flex-col justify-between hover:shadow-md transition-shadow">
          <div class="flex items-center justify-between mb-4">
            <span class="w-12 h-12 rounded-xl bg-soft-meadow text-primary flex items-center justify-center border border-border-warm">
              <span class="material-symbols-outlined text-2xl">forest</span>
            </span>
            <span class="font-label-sm text-label-sm text-primary font-bold bg-surface-container px-2.5 py-0.5 rounded-full"><?= e(ps_text('ग्रीन गैंग', 'Green Gang')) ?></span>
          </div>
          <div>
            <div class="font-display-hero text-headline-lg text-deep-forest font-bold mb-1">50,000+</div>
            <h3 class="font-title-md text-title-md text-on-surface font-bold mb-1"><?= e(ps_text('वृक्ष व ट्री-गार्ड सुरक्षित', 'Trees Protected')) ?></h3>
            <p class="font-body-sm text-body-sm text-text-muted"><?= e(ps_text('पीपल, नीम, बरगद व फलदार पौधों की निरंतर देखरेख।', 'Protection of banyan, neem, peepal and native trees.')) ?></p>
          </div>
        </div>

        <!-- Metric 3 -->
        <div class="bg-surface-container-lowest rounded-2xl p-6 shadow-sm border border-border-warm flex flex-col justify-between hover:shadow-md transition-shadow">
          <div class="flex items-center justify-between mb-4">
            <span class="w-12 h-12 rounded-xl bg-secondary-fixed text-secondary flex items-center justify-center border border-border-warm">
              <span class="material-symbols-outlined text-2xl">water_drop</span>
            </span>
            <span class="font-label-sm text-label-sm text-secondary font-bold bg-secondary-fixed/50 px-2.5 py-0.5 rounded-full"><?= e(ps_text('परिंदा रक्षक', 'Bird Care')) ?></span>
          </div>
          <div>
            <div class="font-display-hero text-headline-lg text-secondary font-bold mb-1">25,000+</div>
            <h3 class="font-title-md text-title-md text-on-surface font-bold mb-1"><?= e(ps_text('मिट्टी सकोरे व दाना', 'Water Bowls & Feed')) ?></h3>
            <p class="font-body-sm text-body-sm text-text-muted"><?= e(ps_text('ग्रीष्म ऋतु में पक्षियों के लिए जल-पात्र एवं पोषण सुरक्षा।', 'Water bowls and grains for birds during summer heat.')) ?></p>
          </div>
        </div>

        <!-- Metric 4 -->
        <div class="bg-surface-container-lowest rounded-2xl p-6 shadow-sm border border-border-warm flex flex-col justify-between hover:shadow-md transition-shadow">
          <div class="flex items-center justify-between mb-4">
            <span class="w-12 h-12 rounded-xl bg-soft-meadow text-deep-forest flex items-center justify-center border border-border-warm">
              <span class="material-symbols-outlined text-2xl">account_balance</span>
            </span>
            <span class="font-label-sm text-label-sm text-deep-forest font-bold bg-surface-container px-2.5 py-0.5 rounded-full"><?= e(ps_text('सार्वजनिक लेखा', 'Public Ledger')) ?></span>
          </div>
          <div>
            <div class="font-display-hero text-headline-lg text-deep-forest font-bold mb-1"><?= e(ps_text('पब्लिक', 'Public')) ?></div>
            <h3 class="font-title-md text-title-md text-on-surface font-bold mb-1"><?= e(ps_text('वार्षिक ऑडिट रिपोर्ट', 'Annual Audits')) ?></h3>
            <p class="font-body-sm text-body-sm text-text-muted"><?= e(ps_text('प्रत्येक खर्च का सार्वजनिक बहीखाता व पीडीएफ प्रपत्र उपलब्ध।', 'Complete public financial reports and audit documentation.')) ?></p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- CONTRIBUTION CAUSES & TIERS -->
  <section class="w-full bg-soft-meadow py-16 border-b border-border-warm">
    <div class="max-w-container-max mx-auto px-4 sm:px-8">
      <!-- Section Header -->
      <div class="max-w-3xl mb-12">
        <div class="inline-flex items-center gap-1.5 text-primary font-label-md text-label-md font-bold mb-2">
          <span class="material-symbols-outlined text-[18px]">volunteer_activism</span>
          <span><?= e(ps_text('सहयोग के प्रमुख संकल्प क्षेत्र • Choose a Cause', 'Choose a Cause')) ?></span>
        </div>
        <h2 class="font-headline-lg text-headline-lg text-on-surface tracking-tight mb-3 font-bold">
          <?= e(ps_text('अपनी आत्मीयता और संकल्प से चुनें अपना सेवा क्षेत्र', 'Select a Dedicated Cause for Contribution')) ?>
        </h2>
        <p class="font-body-md text-body-md text-on-surface-variant">
          <?= e(ps_text('आप अपनी रुचि, माता-पिता की पुण्यतिथि या बच्चों के जन्मदिन के उपलक्ष्य में किसी भी विशिष्ट संकल्प का संबल बन सकते हैं।', 'Sponsor a cause in memory of loved ones, birthdays, or environmental milestones.')) ?>
        </p>
      </div>

      <!-- Grid of Tiers -->
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 items-stretch">
        <!-- Cause 1: Hariyali Sankalp -->
        <div class="bg-surface-container-lowest rounded-2xl shadow-sm border border-border-warm hover:shadow-lg transition-all p-6 flex flex-col justify-between">
          <div>
            <div class="h-44 rounded-xl mb-5 overflow-hidden relative border border-border-warm">
              <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuCxyiSrcSbYHiaf4Ejq0gwbgwwzGgE3K-jYzBqwdgxpO45Dbi9hDsM08Y8tflB1sryei2rVjj-kRBkvpWqFwKb6p-gnfOpyEoKQ4SpV6ZJ9ucKnGQslUfg-ZInT7oGyJVq4v76mXfHF2wO_gx-W9L4UxlWljhWHkbZa_b4oy9ewpw0eaaI-QJWxSEqfmIHCRjNBpwoBChuR8JwNd604-NYCKElXZYXVbKr8UbuNy_fnK2yEg--47u7w" alt="Plantation Drive" class="w-full h-full object-cover">
              <span class="absolute top-3 left-3 bg-deep-forest text-pure-white text-label-sm font-label-sm px-2.5 py-1 rounded-md shadow-sm font-semibold">
                <?= e(ps_text('पर्यावरण प्रथम', 'Environment')) ?>
              </span>
            </div>
            <h3 class="font-headline-sm text-headline-sm text-deep-forest mb-2 font-bold"><?= e(ps_text('हरियाली संकल्प', 'Hariyali Plantation')) ?></h3>
            <p class="font-body-sm text-body-sm text-text-muted mb-6">
              <?= e(ps_text('ग्रीन गैंग कार्यदल द्वारा बरगद, पीपल, नीम, जामुन के देसी पौधों का रोपण व दीर्घकालिक सुरक्षा।', 'Planting native shade trees like banyan, neem, and peepal with metal guards.')) ?>
            </p>
            <div class="space-y-3.5 mb-6">
              <div onclick="selectTier('₹501', 'हरियाली संकल्प: 5 पौधे')" class="bg-soft-meadow p-3.5 rounded-xl border border-border-warm flex items-start justify-between cursor-pointer hover:bg-surface-container transition-colors">
                <div>
                  <div class="font-title-md text-title-md font-bold text-primary">₹501</div>
                  <div class="font-body-sm text-body-sm text-on-surface"><?= e(ps_text('5 छायादार/फलदार पौधे व देसी खाद', '5 Native Saplings & Fertilizer')) ?></div>
                </div>
                <span class="material-symbols-outlined text-primary text-xl">add_circle</span>
              </div>
              <div onclick="selectTier('₹1,100', 'हरियाली संकल्प: 1 ट्री-गार्ड व 3 वर्षीय पोषण')" class="bg-soft-meadow p-3.5 rounded-xl border border-border-warm flex items-start justify-between cursor-pointer hover:bg-surface-container transition-colors">
                <div>
                  <div class="font-title-md text-title-md font-bold text-primary">₹1,100</div>
                  <div class="font-body-sm text-body-sm text-on-surface"><?= e(ps_text('1 मजबूत ट्री-गार्ड + 3 वर्षीय नियमित पोषण', '1 Tree-Guard + 3-Yr Maintenance')) ?></div>
                </div>
                <span class="material-symbols-outlined text-primary text-xl">add_circle</span>
              </div>
              <div onclick="selectTier('₹5,000', 'हरियाली संकल्प: ग्रीन चौपाल हरित वीथिका')" class="bg-soft-meadow p-3.5 rounded-xl border border-border-warm flex items-start justify-between cursor-pointer hover:bg-surface-container transition-colors">
                <div>
                  <div class="font-title-md text-title-md font-bold text-primary">₹5,000</div>
                  <div class="font-body-sm text-body-sm text-on-surface"><?= e(ps_text('\'ग्रीन चौपाल\' गाँव की सड़क पर 10 सुरक्षित वृक्ष', '10 Protected Trees on Village Road')) ?></div>
                </div>
                <span class="material-symbols-outlined text-primary text-xl">add_circle</span>
              </div>
            </div>
          </div>
          <a href="#pledge-desk" class="w-full bg-primary-container hover:bg-deep-forest text-on-primary py-3 rounded-xl font-label-md text-label-md text-center transition-all flex items-center justify-center gap-2 shadow-sm font-semibold">
            <span><?= e(ps_text('यह संकल्प चुनें', 'Pledge This')) ?></span>
            <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
          </a>
        </div>

        <!-- Cause 2: Parinda Sanrakshan -->
        <div class="bg-surface-container-lowest rounded-2xl shadow-sm border border-border-warm hover:shadow-lg transition-all p-6 flex flex-col justify-between">
          <div>
            <div class="h-44 rounded-xl mb-5 overflow-hidden relative border border-border-warm">
              <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuDJID16aBGU3r6G8EXZhOaeRBif-CxU4QoMNZRHCvbvFgWnZi9k7cpJudEibaJwe-rgijHKgpmJXgleRf_4HWPmTVUURsBLTr0zKekDGw0KHt_t0C2_VUylRkUwY62NaJgq10ldw5B0Oi6weYIyOTiiKLeJ3Pac_OahFofnoHxPuW0f5jT4Nd2LYhsJwRV99RSHsbMEIextguMPITTOwIZbeycIXn7lHLc6udUfjaXZwRxV9ZyyRWlL" alt="Bird Water Bowls" class="w-full h-full object-cover">
              <span class="absolute top-3 left-3 bg-secondary text-pure-white text-label-sm font-label-sm px-2.5 py-1 rounded-md shadow-sm font-semibold">
                <?= e(ps_text('जीव दया', 'Bird Care')) ?>
              </span>
            </div>
            <h3 class="font-headline-sm text-headline-sm text-secondary mb-2 font-bold"><?= e(ps_text('परिंदा संरक्षण', 'Bird Conservation')) ?></h3>
            <p class="font-body-sm text-body-sm text-text-muted mb-6">
              <?= e(ps_text('ग्रीष्म ऋतु में गौरैया व अन्य पक्षियों के प्राण रक्षा हेतु सकोरा, जल पात्र व पौष्टिक बाजरा दाना।', 'Clay water pots and grain feed for sparrows and local birds.')) ?>
            </p>
            <div class="space-y-3.5 mb-6">
              <div onclick="selectTier('₹251', 'परिंदा संरक्षण: 10 मिट्टी के सकोरे')" class="bg-secondary-fixed/30 p-3.5 rounded-xl border border-border-warm flex items-start justify-between cursor-pointer hover:bg-secondary-fixed/50 transition-colors">
                <div>
                  <div class="font-title-md text-title-md font-bold text-secondary">₹251</div>
                  <div class="font-body-sm text-body-sm text-on-surface"><?= e(ps_text('10 मिट्टी के पक्के सकोरे (कुम्हारों से)', '10 Earthen Water Bowls')) ?></div>
                </div>
                <span class="material-symbols-outlined text-secondary text-xl">add_circle</span>
              </div>
              <div onclick="selectTier('₹1,000', 'परिंदा संरक्षण: 50 सकोरे + 20 किग्रा दाना')" class="bg-secondary-fixed/30 p-3.5 rounded-xl border border-border-warm flex items-start justify-between cursor-pointer hover:bg-secondary-fixed/50 transition-colors">
                <div>
                  <div class="font-title-md text-title-md font-bold text-secondary">₹1,000</div>
                  <div class="font-body-sm text-body-sm text-on-surface"><?= e(ps_text('50 सकोरे + 20 किग्रा बाजरा/अनाज दाना', '50 Water Bowls + 20kg Feed')) ?></div>
                </div>
                <span class="material-symbols-outlined text-secondary text-xl">add_circle</span>
              </div>
              <div onclick="selectTier('₹2,500', 'परिंदा संरक्षण: परिंदा पोषण केंद्र')" class="bg-secondary-fixed/30 p-3.5 rounded-xl border border-border-warm flex items-start justify-between cursor-pointer hover:bg-secondary-fixed/50 transition-colors">
                <div>
                  <div class="font-title-md text-title-md font-bold text-secondary">₹2,500</div>
                  <div class="font-body-sm text-body-sm text-on-surface"><?= e(ps_text('1 गाँव/विद्यालय में स्थायी \'परिंदा पोषण केंद्र\'', '1 Permanent Village Bird Center')) ?></div>
                </div>
                <span class="material-symbols-outlined text-secondary text-xl">add_circle</span>
              </div>
            </div>
          </div>
          <a href="#pledge-desk" class="w-full bg-secondary hover:bg-on-secondary-container text-on-secondary py-3 rounded-xl font-label-md text-label-md text-center transition-all flex items-center justify-center gap-2 shadow-sm font-semibold">
            <span><?= e(ps_text('यह संकल्प चुनें', 'Pledge This')) ?></span>
            <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
          </a>
        </div>

        <!-- Cause 3: Awadhi Culture & Children Education -->
        <div class="bg-surface-container-lowest rounded-2xl shadow-sm border border-border-warm hover:shadow-lg transition-all p-6 flex flex-col justify-between">
          <div>
            <div class="h-44 rounded-xl mb-5 overflow-hidden relative border border-border-warm">
              <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuD6RQbUTM7snAvMrLilTsnRmUIYJi-23jcj4x3WNgidksK2pdE7sCM78EazjDohi89fnsUNVCQVqQkNZBSzCj_iEQhe2L3Hcq4g2age9F-aBVdDtm6FIoGBYVlhqk6S4XGliayYlRKLjYzt8rD3ANUxgPHqPLc3mmJkAEb8hjJi3gKsm05OKx38vEuX05Wiw-X-y3AVSNf6GZhhAz3DUosb_79lPbb2ca1nRF3ViRc_61GBjkC97yLs" alt="Awadhi Culture & Education" class="w-full h-full object-cover">
              <span class="absolute top-3 left-3 bg-tertiary text-pure-white text-label-sm font-label-sm px-2.5 py-1 rounded-md shadow-sm font-semibold">
                <?= e(ps_text('संस्कृति व ज्ञान', 'Awadhi Culture')) ?>
              </span>
            </div>
            <h3 class="font-headline-sm text-headline-sm text-tertiary mb-2 font-bold"><?= e(ps_text('अवधी लोक-संस्कृति व शिक्षा', 'Awadhi Culture & Education')) ?></h3>
            <p class="font-body-sm text-body-sm text-text-muted mb-6">
              <?= e(ps_text('ग्रामीण बच्चों में मातृभाषा का स्वाभिमान, पर्यावरण चेतना व दुर्लभ अवधी पांडुलिपियों का संचयन।', 'Fostering Awadhi literature and environmental literacy in rural schools.')) ?>
            </p>
            <div class="space-y-3.5 mb-6">
              <div onclick="selectTier('₹500', 'शिक्षा: तुलसी पौधा व बाल साहित्य किट')" class="bg-tertiary-fixed/30 p-3.5 rounded-xl border border-border-warm flex items-start justify-between cursor-pointer hover:bg-tertiary-fixed/50 transition-colors">
                <div>
                  <div class="font-title-md text-title-md font-bold text-tertiary">₹500</div>
                  <div class="font-body-sm text-body-sm text-on-surface"><?= e(ps_text('तुलसी का पौधा + 1 बाल साहित्य किट', 'Tulsi Plant + Children Literature Kit')) ?></div>
                </div>
                <span class="material-symbols-outlined text-tertiary text-xl">add_circle</span>
              </div>
              <div onclick="selectTier('₹2,100', 'संस्कृति: अवधी काव्य चौपाल संरक्षण')" class="bg-tertiary-fixed/30 p-3.5 rounded-xl border border-border-warm flex items-start justify-between cursor-pointer hover:bg-tertiary-fixed/50 transition-colors">
                <div>
                  <div class="font-title-md text-title-md font-bold text-tertiary">₹2,100</div>
                  <div class="font-body-sm text-body-sm text-on-surface"><?= e(ps_text('अवधी काव्य चौपाल व सारंग कुण्डलियों का संरक्षण', 'Awadhi Poetry Chaupal Archives')) ?></div>
                </div>
                <span class="material-symbols-outlined text-tertiary text-xl">add_circle</span>
              </div>
              <div onclick="selectTier('₹4,500', 'शिक्षा: ग्रामीण पुस्तकालय संवर्धन')" class="bg-tertiary-fixed/30 p-3.5 rounded-xl border border-border-warm flex items-start justify-between cursor-pointer hover:bg-tertiary-fixed/50 transition-colors">
                <div>
                  <div class="font-title-md text-title-md font-bold text-tertiary">₹4,500</div>
                  <div class="font-body-sm text-body-sm text-on-surface"><?= e(ps_text('गाँव के प्राथमिक केंद्र में लोक साहित्य कॉर्नर', 'Village School Library Corner')) ?></div>
                </div>
                <span class="material-symbols-outlined text-tertiary text-xl">add_circle</span>
              </div>
            </div>
          </div>
          <a href="#pledge-desk" class="w-full bg-tertiary-container hover:bg-tertiary text-pure-white py-3 rounded-xl font-label-md text-label-md text-center transition-all flex items-center justify-center gap-2 shadow-sm font-semibold">
            <span><?= e(ps_text('यह संकल्प चुनें', 'Pledge This')) ?></span>
            <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
          </a>
        </div>

        <!-- Cause 4: Emergency Winter Relief & Cloth Bank -->
        <div class="bg-surface-container-lowest rounded-2xl shadow-sm border border-border-warm hover:shadow-lg transition-all p-6 flex flex-col justify-between">
          <div>
            <div class="h-44 rounded-xl mb-5 overflow-hidden relative border border-border-warm">
              <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuBbLWl6DOT2a7fWGNKK3h3UM8Huiax7t3eVW0ykzlVFcQS3Wi1b2EMnPXm2yUdC6bTl7ae5z3-aRmjGzdSphgb4C5yke8j_utf56n2Y0M_48BkvdJB6UAkYYoAI0p8kE5VgzTIHTSSWginSlCV7UfaWuCo6nnD92McID9xY4wG2ynx-BI2EeLKXmGDkJFLvZdjDvxMp-Q3K7vi2hEGGzlf3Pn0u_tSQgs75RKpGl77fIKNQBaQrdExl" alt="Winter Relief & Cloth Bank" class="w-full h-full object-cover">
              <span class="absolute top-3 left-3 bg-deep-forest text-pure-white text-label-sm font-label-sm px-2.5 py-1 rounded-md shadow-sm font-semibold">
                <?= e(ps_text('सहानुभूति सेवा', 'Winter Relief')) ?>
              </span>
            </div>
            <h3 class="font-headline-sm text-headline-sm text-deep-forest mb-2 font-bold"><?= e(ps_text('आपात सेवा व कपड़ा बैंक', 'Winter Relief & Cloth Bank')) ?></h3>
            <p class="font-body-sm text-body-sm text-text-muted mb-6">
              <?= e(ps_text('कड़कड़ाती ठंड में असहाय वृद्धों, रिक्शा चालकों एवं ग्रामीण परिवारों को निःशुल्क कंबल व वस्त्र सुरक्षा।', 'Distributing warm blankets and clothing to homeless elders.')) ?>
            </p>
            <div class="space-y-3.5 mb-6">
              <div onclick="selectTier('₹600', 'कपड़ा बैंक: 2 गर्म कंबल')" class="bg-soft-meadow p-3.5 rounded-xl border border-border-warm flex items-start justify-between cursor-pointer hover:bg-surface-container transition-colors">
                <div>
                  <div class="font-title-md text-title-md font-bold text-deep-forest">₹600</div>
                  <div class="font-body-sm text-body-sm text-on-surface"><?= e(ps_text('2 मोटे ऊनी कंबल असहाय बुजुर्गों हेतु', '2 Woollen Blankets for Elders')) ?></div>
                </div>
                <span class="material-symbols-outlined text-deep-forest text-xl">add_circle</span>
              </div>
              <div onclick="selectTier('₹1,500', 'कपड़ा बैंक: 5 परिवारों को शीत सुरक्षा')" class="bg-soft-meadow p-3.5 rounded-xl border border-border-warm flex items-start justify-between cursor-pointer hover:bg-surface-container transition-colors">
                <div>
                  <div class="font-title-md text-title-md font-bold text-deep-forest">₹1,500</div>
                  <div class="font-body-sm text-body-sm text-on-surface"><?= e(ps_text('5 परिवारों को संपूर्ण शीत राहत किट', 'Winter Relief Kits for 5 Families')) ?></div>
                </div>
                <span class="material-symbols-outlined text-deep-forest text-xl">add_circle</span>
              </div>
              <div onclick="selectTier('₹3,100', 'कपड़ा बैंक: बस्ती स्तर पर राहत शिविर')" class="bg-soft-meadow p-3.5 rounded-xl border border-border-warm flex items-start justify-between cursor-pointer hover:bg-surface-container transition-colors">
                <div>
                  <div class="font-title-md text-title-md font-bold text-deep-forest">₹3,100</div>
                  <div class="font-body-sm text-body-sm text-on-surface"><?= e(ps_text('एक पूरी मलिन बस्ती में कपड़ा वितरण शिविर', 'Slum Winter Distribution Drive')) ?></div>
                </div>
                <span class="material-symbols-outlined text-deep-forest text-xl">add_circle</span>
              </div>
            </div>
          </div>
          <a href="#pledge-desk" class="w-full bg-deep-forest hover:bg-on-surface text-pure-white py-3 rounded-xl font-label-md text-label-md text-center transition-all flex items-center justify-center gap-2 shadow-sm font-semibold">
            <span><?= e(ps_text('यह संकल्प चुनें', 'Pledge This')) ?></span>
            <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
          </a>
        </div>
      </div>
    </div>
  </section>

  <!-- DIRECT BANK & UPI PAYMENT DESK + INTERACTIVE FORM -->
  <section class="w-full bg-cream-canvas py-16 scroll-mt-24 border-b border-border-warm" id="pledge-desk">
    <div class="max-w-container-max mx-auto px-4 sm:px-8">
      <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
        <!-- LEFT: Official Bank & UPI Details (5 Cols) -->
        <div class="lg:col-span-5 flex flex-col space-y-6">
          <div class="bg-surface-container-lowest rounded-2xl p-7 shadow-sm border border-border-warm">
            <div class="flex items-center justify-between mb-4">
              <span class="font-headline-sm text-headline-sm text-deep-forest font-bold"><?= e(ps_text('प्रत्यक्ष डिजिटल सहयोग', 'Direct UPI & Bank Payment')) ?></span>
              <span class="material-symbols-outlined text-fresh-sprout text-2xl">qr_code_scanner</span>
            </div>
            <p class="font-body-sm text-body-sm text-text-muted mb-6">
              <?= e(ps_text('Google Pay, PhonePe, Paytm, BHIM अथवा किसी भी बैंक UPI ऐप से तुरंत स्कैन कर सीधे न्यास खाते में सहयोग करें।', 'Scan via Google Pay, PhonePe, Paytm or BHIM UPI app directly into trust account.')) ?>
            </p>

            <!-- UPI QR Container -->
            <div class="bg-soft-meadow rounded-xl p-6 flex flex-col items-center justify-center text-center mb-6 border border-border-warm">
              <div class="bg-pure-white p-4 rounded-xl shadow-sm mb-4 border border-border-warm">
                <!-- SVG Vector QR Mockup -->
                <svg class="w-44 h-44 text-deep-forest" viewBox="0 0 100 100" fill="currentColor">
                  <path d="M0 0h36v36H0zM8 8h20v20H8zm56-8h36v36H64zM72 8h20v20H72zm-72 64h36v36H0zm8 8h20v20H8zm56 2h10v10H64zm16 0h16v16H80zm-16 16h16v10H64zm26 0h10v16H90zm-46-24h10v10H44zm16 0h8v8h-8zm-16 16h12v12H44zm-14-36h10v10H30zm14-16h12v12H44zm14 0h10v10H58zm-14 36h8v8h-8zm30-22h12v12H74z"/>
                </svg>
              </div>
              <p class="font-label-sm text-label-sm text-deep-forest font-bold uppercase tracking-wide mb-1"><?= e(ps_text('आधिकारिक UPI QR कोड', 'Official UPI QR Code')) ?></p>
              <p class="font-body-sm text-body-sm text-text-muted"><?= e($accountName) ?></p>
            </div>

            <!-- UPI ID Copy Row -->
            <div class="space-y-3 mb-6">
              <label class="font-label-sm text-label-sm text-deep-forest font-bold"><?= e(ps_text('प्रमुख UPI आईडी (क्लिक कर कॉपी करें):', 'Copy Official UPI ID:')) ?></label>
              <div class="bg-soft-meadow rounded-xl p-3 border border-border-warm flex items-center justify-between">
                <div class="flex items-center gap-2">
                  <span class="material-symbols-outlined text-primary text-sm">alternate_email</span>
                  <span class="font-title-md text-title-md text-on-surface font-mono font-bold" id="upi-id-1"><?= e($upiId) ?></span>
                </div>
                <button type="button" onclick="copyText('<?= e($upiId) ?>', this)" class="text-primary hover:text-deep-forest font-label-sm text-label-sm bg-pure-white px-2.5 py-1 rounded shadow-sm border border-border-warm flex items-center gap-1 transition-all font-semibold cursor-pointer">
                  <span class="material-symbols-outlined text-[14px]">content_copy</span>
                  <span><?= e(ps_text('कॉपी करें', 'Copy')) ?></span>
                </button>
              </div>
            </div>

            <!-- Official Bank Card Details -->
            <div class="bg-surface-container rounded-xl p-5 border border-border-warm space-y-2.5">
              <div class="flex items-center gap-2 mb-2">
                <span class="material-symbols-outlined text-deep-forest text-lg">account_balance</span>
                <span class="font-title-md text-title-md text-deep-forest font-bold"><?= e(ps_text('बैंक खाता विवरण (NEFT / RTGS)', 'Bank Account Details')) ?></span>
              </div>
              <div class="font-body-sm text-body-sm space-y-1.5 text-on-surface">
                <div class="flex justify-between">
                  <span class="text-text-muted"><?= e(ps_text('खाता धारक:', 'Account Name:')) ?></span>
                  <span class="font-semibold text-right"><?= e($accountName) ?></span>
                </div>
                <div class="flex justify-between">
                  <span class="text-text-muted"><?= e(ps_text('बैंक का नाम:', 'Bank Name:')) ?></span>
                  <span class="font-semibold text-right"><?= e($bankName) ?></span>
                </div>
                <div class="flex justify-between">
                  <span class="text-text-muted"><?= e(ps_text('खाता संख्या:', 'Account No:')) ?></span>
                  <span class="font-semibold text-right font-mono"><?= e($accountNumber) ?></span>
                </div>
                <div class="flex justify-between">
                  <span class="text-text-muted"><?= e(ps_text('IFSC कोड:', 'IFSC Code:')) ?></span>
                  <span class="font-semibold text-right font-mono"><?= e($ifscCode) ?></span>
                </div>
              </div>
            </div>

            <!-- Receipt & Transparency Note -->
            <div class="mt-6 flex items-start gap-3 bg-surface-container-high/40 p-4 rounded-xl border border-border-warm">
              <span class="material-symbols-outlined text-primary text-xl mt-0.5">verified</span>
              <p class="font-body-sm text-body-sm text-on-surface-variant">
                <strong><?= e(ps_text('पारदर्शिता प्रतिज्ञा:', 'Transparency Pledge:')) ?></strong> <?= e(ps_text('भुगतान के पश्चात प्रपत्र में UTR दर्ज करें। 24 घंटे के भीतर आपको डिजिटल पावती तथा रोपित पौधे/सकोरे की तस्वीर प्रेषित की जाती है।', 'Submit your UTR/Ref ID in the form. A digital receipt and photo will be sent within 24 hours.')) ?>
              </p>
            </div>
          </div>
        </div>

        <!-- RIGHT: Interactive Pledge & Submission Form (7 Cols) -->
        <div class="lg:col-span-7">
          <div class="bg-surface-container-lowest rounded-2xl p-6 sm:p-8 shadow-sm border border-border-warm">
            <div class="mb-6">
              <div class="inline-flex items-center gap-1.5 text-secondary font-label-md text-label-md font-bold mb-1">
                <span class="material-symbols-outlined text-[16px]">edit_note</span>
                <span><?= e(ps_text('सहयोग संकल्प प्रपत्र • Donation Registry', 'Pledge Form')) ?></span>
              </div>
              <h3 class="font-headline-sm text-headline-sm text-deep-forest font-bold">
                <?= e(ps_text('सहयोग विवरण दर्ज करें व रसीद प्राप्त करें', 'Register Contribution & Request Receipt')) ?>
              </h3>
              <p class="font-body-sm text-body-sm text-text-muted mt-1">
                <?= e(ps_text('यदि आपने ऑनलाइन भुगतान कर दिया है, अथवा आप प्रत्यक्ष संकल्प लेना चाहते हैं, तो विवरण भरें।', 'Submit details after online transfer to receive your official digital receipt.')) ?>
              </p>
            </div>

            <form id="donation-form" onsubmit="handleDonationSubmit(event)" class="space-y-5">
              <!-- Pre-selected Quick Amount Chips -->
              <div>
                <label class="block font-label-md text-label-md text-on-surface font-bold mb-2">
                  <?= e(ps_text('सहयोग राशि चुनें (Select Amount)', 'Select Contribution Amount')) ?>
                </label>
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-2.5 mb-3">
                  <button type="button" onclick="setFormAmount(501)" class="amount-btn py-2 px-3 rounded-xl font-title-md text-title-md bg-soft-meadow text-deep-forest hover:bg-primary hover:text-pure-white transition-all text-center border border-border-warm font-bold cursor-pointer">
                    ₹501
                  </button>
                  <button type="button" onclick="setFormAmount(1100)" class="amount-btn py-2 px-3 rounded-xl font-title-md text-title-md bg-soft-meadow text-deep-forest hover:bg-primary hover:text-pure-white transition-all text-center border border-border-warm font-bold cursor-pointer">
                    ₹1,100
                  </button>
                  <button type="button" onclick="setFormAmount(2100)" class="amount-btn py-2 px-3 rounded-xl font-title-md text-title-md bg-soft-meadow text-deep-forest hover:bg-primary hover:text-pure-white transition-all text-center border border-border-warm font-bold cursor-pointer">
                    ₹2,100
                  </button>
                  <button type="button" onclick="setFormAmount(5000)" class="amount-btn py-2 px-3 rounded-xl font-title-md text-title-md bg-soft-meadow text-deep-forest hover:bg-primary hover:text-pure-white transition-all text-center border border-border-warm font-bold cursor-pointer">
                    ₹5,000
                  </button>
                </div>
                <div class="relative">
                  <span class="absolute left-3.5 top-3.5 text-text-muted font-bold">₹</span>
                  <input type="number" id="custom-amount" name="amount" class="w-full pl-8 pr-4 py-3 rounded-xl bg-surface-container-low text-on-surface font-body-md text-body-md focus:outline-none focus:bg-pure-white focus:ring-2 focus:ring-primary-container border border-border-warm transition-all">
                </div>
              </div>

              <!-- Cause Selection Dropdown -->
              <div>
                <label for="cause-select" class="block font-label-md text-label-md text-on-surface font-bold mb-2">
                  <?= e(ps_text('अभियान व संकल्प क्षेत्र (Cause)', 'Target Campaign')) ?>
                </label>
                <select id="cause-select" name="purpose" required class="w-full px-4 py-3 rounded-xl bg-surface-container-low text-on-surface font-body-md text-body-md focus:outline-none focus:bg-pure-white focus:ring-2 focus:ring-primary-container border border-border-warm transition-all">
                  <option value=""><?= e(ps_text('-- संकल्प का चयन करें --', '-- Select Cause --')) ?></option>
                  <option value="hariyali"><?= e(ps_text('हरियाली संकल्प (वृक्षारोपण एवं ट्री-गार्ड पोषण)', 'Hariyali Plantation Drive')) ?></option>
                  <option value="parinda"><?= e(ps_text('परिंदा संरक्षण (सकोरा, जल-पात्र एवं ग्रीष्म दाना)', 'Bird Conservation & Water Bowls')) ?></option>
                  <option value="culture"><?= e(ps_text('अवधी लोक-संस्कृति व प्राथमिक बाल साहित्य', 'Awadhi Literature & Education')) ?></option>
                  <option value="cloth-bank"><?= e(ps_text('आपात शीतकालीन राहत व कपड़ा बैंक', 'Winter Relief & Cloth Bank')) ?></option>
                  <option value="general"><?= e(ps_text('सारंग जी की सामान्य सामाजिक लोकसेवा में', 'General Community Service Fund')) ?></option>
                </select>
              </div>

              <!-- Personal Information Two Columns -->
              <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                  <label class="block font-label-md text-label-md text-on-surface font-semibold mb-1.5">
                    <?= e(ps_text('आपका पूरा नाम (Full Name) *', 'Full Name *')) ?>
                  </label>
                  <input type="text" name="full_name" required class="w-full px-4 py-3 rounded-xl bg-surface-container-low text-on-surface font-body-md text-body-md focus:outline-none focus:bg-pure-white focus:ring-2 focus:ring-primary-container border border-border-warm transition-all">
                </div>
                <div>
                  <label class="block font-label-md text-label-md text-on-surface font-semibold mb-1.5">
                    <?= e(ps_text('व्हाट्सएप / मोबाइल नंबर *', 'WhatsApp / Mobile *')) ?>
                  </label>
                  <input type="tel" name="mobile" required class="w-full px-4 py-3 rounded-xl bg-surface-container-low text-on-surface font-body-md text-body-md focus:outline-none focus:bg-pure-white focus:ring-2 focus:ring-primary-container border border-border-warm transition-all">
                </div>
              </div>

              <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                  <label class="block font-label-md text-label-md text-on-surface font-semibold mb-1.5">
                    <?= e(ps_text('ईमेल पता (Email ID)', 'Email Address')) ?>
                  </label>
                  <input type="email" name="email" class="w-full px-4 py-3 rounded-xl bg-surface-container-low text-on-surface font-body-md text-body-md focus:outline-none focus:bg-pure-white focus:ring-2 focus:ring-primary-container border border-border-warm transition-all">
                </div>
                <div>
                  <label class="block font-label-md text-label-md text-on-surface font-semibold mb-1.5">
                    <?= e(ps_text('शहर / ज़िला (City & State)', 'City / District')) ?>
                  </label>
                  <input type="text" name="city" class="w-full px-4 py-3 rounded-xl bg-surface-container-low text-on-surface font-body-md text-body-md focus:outline-none focus:bg-pure-white focus:ring-2 focus:ring-primary-container border border-border-warm transition-all">
                </div>
              </div>

              <!-- Transaction Reference Number -->
              <div>
                <label class="block font-label-md text-label-md text-on-surface font-semibold mb-1.5">
                  <?= e(ps_text('UPI संदर्भ / UTR नंबर (यदि भुगतान कर चुके हों)', 'UPI Reference / UTR Number')) ?>
                </label>
                <input type="text" name="transaction_id" class="w-full px-4 py-3 rounded-xl bg-surface-container-low text-on-surface font-body-md text-body-md focus:outline-none focus:bg-pure-white focus:ring-2 focus:ring-primary-container font-mono border border-border-warm transition-all">
                <span class="text-[12px] text-text-muted mt-1 block"><?= e(ps_text('बैंक अथवा UPI ऐप में लेन-देन के बाद प्राप्त 12 अंकों का संदर्भ दर्ज करें।', 'Enter the 12-digit reference ID received after payment.')) ?></span>
              </div>

              <!-- Dedication / Memory Note -->
              <div>
                <label class="block font-label-md text-label-md text-on-surface font-semibold mb-1.5">
                  <?= e(ps_text('स्मृति संकल्प अथवा विशेष संदेश (Memorial / Dedication)', 'Dedications or Special Message')) ?>
                </label>
                <textarea rows="3" name="message" class="w-full px-4 py-3 rounded-xl bg-surface-container-low text-on-surface font-body-md text-body-md focus:outline-none focus:bg-pure-white focus:ring-2 focus:ring-primary-container border border-border-warm transition-all"></textarea>
              </div>

              <!-- Submit Button -->
              <button type="submit" class="w-full bg-primary-container hover:bg-deep-forest text-on-primary py-4 rounded-xl font-headline-sm text-headline-sm font-bold transition-all shadow-sm hover:shadow-md flex items-center justify-center gap-2 cursor-pointer">
                <span class="material-symbols-outlined text-2xl">task_alt</span>
                <span><?= e(ps_text('सहयोग विवरण दर्ज करें व डिजिटल पावती प्राप्त करें', 'Submit Pledge & Request Receipt')) ?></span>
              </button>

              <div id="form-feedback" class="hidden p-4 rounded-xl bg-surface-container text-deep-forest font-body-md text-body-md text-center border border-border-warm font-semibold">
                <?= e(ps_text('हार्दिक धन्यवाद! आपका सहयोग संकल्प ससम्मान दर्ज कर लिया गया है। 24 घंटे के भीतर पावती व तस्वीर आपके व्हाट्सएप पर प्रेषित होगी।', 'Thank you! Your pledge details have been registered. Receipt will be sent within 24 hours.')) ?>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- IN-KIND DONATION / वस्तु-रूप में सहयोग -->
  <section class="w-full bg-soft-meadow py-16 border-b border-border-warm">
    <div class="max-w-container-max mx-auto px-4 sm:px-8">
      <!-- Header -->
      <div class="text-center max-w-3xl mx-auto mb-12">
        <span class="font-label-md text-label-md text-secondary font-bold uppercase tracking-wider bg-secondary-fixed/50 px-3.5 py-1 rounded-full inline-block mb-3 border border-border-warm">
          <?= e(ps_text('धन ही नहीं, आपका समय और साधन भी बहुमूल्य हैं', 'In-Kind Contributions')) ?>
        </span>
        <h2 class="font-headline-lg text-headline-lg text-deep-forest tracking-tight mb-3 font-bold">
          <?= e(ps_text('वस्तु-दान आमंत्रण (In-Kind Contributions)', 'In-Kind Donations & Material Support')) ?>
        </h2>
        <p class="font-body-lg text-body-lg text-on-surface-variant">
          <?= e(ps_text('प्रदीप सारंग जी का मानना है कि हर नागरिक किसी न किसी रूप में धरती और मानवता को कुछ लौटा सकता है। आप निम्नलिखित वस्तुएं सीधे हमारे केंद्र पर भेज सकते हैं:', 'Every citizen can contribute to land and humanity. You can directly send materials to our Barabanki center:')) ?>
        </p>
      </div>

      <!-- In-kind 4 Cards Grid -->
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Item 1 -->
        <div class="bg-surface-container-lowest p-6 rounded-2xl shadow-sm border border-border-warm flex flex-col justify-between">
          <div>
            <div class="w-12 h-12 rounded-xl bg-surface-container text-deep-forest flex items-center justify-center mb-4 border border-border-warm">
              <span class="material-symbols-outlined text-2xl">checkroom</span>
            </div>
            <h3 class="font-title-lg text-title-lg text-deep-forest font-bold mb-2"><?= e(ps_text('वस्त्र व शीत राहत', 'Warm Clothing & Blankets')) ?></h3>
            <p class="font-body-sm text-body-sm text-text-muted mb-4">
              <?= e(ps_text('धुले हुए साफ़ पुराने अथवा नए कपड़े, गर्म शॉल, स्वेटर, और ऊनी कंबल। हमारा कपड़ा बैंक इन्हें गांव-गांव ज़रूरतमंदों तक पहुंचाता है।', 'Clean clothes, sweaters, woollen shawls and blankets for rural winter drives.')) ?>
            </p>
          </div>
          <div class="font-label-sm text-label-sm text-primary font-semibold bg-soft-meadow px-3 py-1.5 rounded-lg flex items-center gap-1.5 border border-border-warm">
            <span class="material-symbols-outlined text-[16px]">location_on</span>
            <span><?= e(ps_text('सतरिख कार्यालय में स्वीकार्य', 'Satrikh Center Accepted')) ?></span>
          </div>
        </div>

        <!-- Item 2 -->
        <div class="bg-surface-container-lowest p-6 rounded-2xl shadow-sm border border-border-warm flex flex-col justify-between">
          <div>
            <div class="w-12 h-12 rounded-xl bg-surface-container text-deep-forest flex items-center justify-center mb-4 border border-border-warm">
              <span class="material-symbols-outlined text-2xl">potted_plant</span>
            </div>
            <h3 class="font-title-lg text-title-lg text-deep-forest font-bold mb-2"><?= e(ps_text('देसी बीज व पौध', 'Native Seeds & Saplings')) ?></h3>
            <p class="font-body-sm text-body-sm text-text-muted mb-4">
              <?= e(ps_text('स्थानीय देसी वृक्षों—नीम, पीपल, बरगद, महुआ, जामुन, इमली और हरड़-बहेड़ा के सूखे बीज तथा जीवित पौध।', 'Dried seeds and saplings of banyan, neem, jamun, and peepal.')) ?>
            </p>
          </div>
          <div class="font-label-sm text-label-sm text-primary font-semibold bg-soft-meadow px-3 py-1.5 rounded-lg flex items-center gap-1.5 border border-border-warm">
            <span class="material-symbols-outlined text-[16px]">eco</span>
            <span><?= e(ps_text('ग्रीन गैंग नर्सरी इकाई', 'Green Gang Nursery')) ?></span>
          </div>
        </div>

        <!-- Item 3 -->
        <div class="bg-surface-container-lowest p-6 rounded-2xl shadow-sm border border-border-warm flex flex-col justify-between">
          <div>
            <div class="w-12 h-12 rounded-xl bg-secondary-fixed text-secondary flex items-center justify-center mb-4 border border-border-warm">
              <span class="material-symbols-outlined text-2xl">soup_kitchen</span>
            </div>
            <h3 class="font-title-lg text-title-lg text-secondary font-bold mb-2"><?= e(ps_text('मिट्टी के सकोरे व जल पात्र', 'Clay Bird Water Pots')) ?></h3>
            <p class="font-body-sm text-body-sm text-text-muted mb-4">
              <?= e(ps_text('स्थानीय प्रजापति/कुम्हार परिवारों से पक्के सकोरे बनवाकर सीधे हमारे परिंदा वितरण केंद्र पर पहुंचाएं या दाना उपलब्ध कराएं।', 'Earthen bird pots ordered directly from rural potter families.')) ?>
            </p>
          </div>
          <div class="font-label-sm text-label-sm text-secondary font-semibold bg-secondary-fixed/30 px-3 py-1.5 rounded-lg flex items-center gap-1.5 border border-border-warm">
            <span class="material-symbols-outlined text-[16px]">local_shipping</span>
            <span><?= e(ps_text('प्रत्यक्ष वितरण केंद्र', 'Distribution Center')) ?></span>
          </div>
        </div>

        <!-- Item 4 -->
        <div class="bg-surface-container-lowest p-6 rounded-2xl shadow-sm border border-border-warm flex flex-col justify-between">
          <div>
            <div class="w-12 h-12 rounded-xl bg-tertiary-fixed text-tertiary flex items-center justify-center mb-4 border border-border-warm">
              <span class="material-symbols-outlined text-2xl">menu_book</span>
            </div>
            <h3 class="font-title-lg text-title-lg text-tertiary font-bold mb-2"><?= e(ps_text('पुस्तकालय सामग्री व स्टेशनरी', 'Books & School Supplies')) ?></h3>
            <p class="font-body-sm text-body-sm text-text-muted mb-4">
              <?= e(ps_text('बाल साहित्य, अवधी व हिंदी कविता पुस्तकें, कॉपियां, कलम, और रंग। ग्रामीण प्राथमिक शालाओं में निःशुल्क वितरण हेतु।', 'Children folklore books, notebooks, pens, and Awadhi literature.')) ?>
            </p>
          </div>
          <div class="font-label-sm text-label-sm text-tertiary font-semibold bg-tertiary-fixed/30 px-3 py-1.5 rounded-lg flex items-center gap-1.5 border border-border-warm">
            <span class="material-symbols-outlined text-[16px]">school</span>
            <span><?= e(ps_text('बाल संस्कार संवर्धन', 'School Library Corners')) ?></span>
          </div>
        </div>
      </div>

      <!-- In-kind Drop-off Address Callout -->
      <div class="mt-8 bg-surface-container rounded-2xl p-6 flex flex-col sm:flex-row items-center justify-between gap-4 border border-border-warm">
        <div class="flex items-center gap-4">
          <div class="w-12 h-12 rounded-full bg-deep-forest text-pure-white flex items-center justify-center shrink-0 shadow-sm">
            <span class="material-symbols-outlined text-2xl">handshake</span>
          </div>
          <div>
            <h4 class="font-title-md text-title-md text-deep-forest font-bold"><?= e(ps_text('वस्तु-दान प्रेषण पता एवं सहायता संपर्क', 'Material Drop-off Address & Contact')) ?></h4>
            <p class="font-body-sm text-body-sm text-text-muted"><?= e(ps_text('कार्यालय: ग्राम कमरावां, जिला बाराबंकी, उत्तर प्रदेश, भारत', 'Office: Gram Kamrawan, District Barabanki, Uttar Pradesh, India')) ?></p>
          </div>
        </div>
        <a href="tel:<?= e(preg_replace('/[^+0-9]/', '', $contactPhone)) ?>" class="shrink-0 bg-deep-forest hover:bg-on-surface text-pure-white px-5 py-2.5 rounded-xl font-label-md text-label-md flex items-center gap-2 transition-all shadow-sm font-semibold">
          <span class="material-symbols-outlined text-[18px]">call</span>
          <span><?= e($contactPhone) ?></span>
        </a>
      </div>
    </div>
  </section>

  <!-- FINANCIAL TRANSPARENCY & PUBLIC AUDIT REPORTS -->
  <section class="w-full bg-cream-canvas py-16 border-b border-border-warm">
    <div class="max-w-container-max mx-auto px-4 sm:px-8">
      <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-center mb-12">
        <div class="lg:col-span-7">
          <div class="inline-flex items-center gap-1.5 text-primary font-label-md text-label-md font-bold mb-2">
            <span class="material-symbols-outlined text-[18px]">policy</span>
            <span><?= e(ps_text('वित्तीय शुचिता एवं पारदर्शी लेखा • Financial Transparency', 'Financial Audits')) ?></span>
          </div>
          <h2 class="font-headline-lg text-headline-lg text-on-surface tracking-tight mb-3 font-bold">
            <?= e(ps_text('हर पाई समाज की, हर पाई का हिसाब सार्वजनिक', 'Every Rupee Audited and Publicly Disclosed')) ?>
          </h2>
          <p class="font-body-lg text-body-lg text-on-surface-variant">
            <?= e(ps_text('हम किसी बहुराष्ट्रीय कॉर्पोरेट ग्रांट या विदेशी फंडिंग से नहीं, बल्कि स्थानीय जनमानस के स्वैच्छिक सहयोग और प्रदीप सारंग जी के व्यक्तिगत संसाधनों से कार्य करते हैं। जनविश्वास ही हमारी सबसे बड़ी पूँजी है।', 'We operate through voluntary community support and Shri Pradeep Sarang\'s personal dedication. Public trust is our ultimate asset.')) ?>
          </p>
        </div>

        <div class="lg:col-span-5 bg-surface-container rounded-2xl p-6 border border-border-warm">
          <h4 class="font-title-md text-title-md text-deep-forest font-bold mb-2 flex items-center gap-2">
            <span class="material-symbols-outlined text-primary">gavel</span>
            <span><?= e(ps_text('हमारी शुचिता प्रतिज्ञा', 'Our Financial Pledge')) ?></span>
          </h4>
          <ul class="space-y-2 font-body-sm text-body-sm text-on-surface">
            <li class="flex items-start gap-2">
              <span class="material-symbols-outlined text-primary text-base mt-0.5">check_circle</span>
              <span><?= e(ps_text('कोई प्रशासनिक वेतन या व्यक्तिगत उपभोग पर व्यय नहीं।', 'Zero administrative salaries or personal consumption.')) ?></span>
            </li>
            <li class="flex items-start gap-2">
              <span class="material-symbols-outlined text-primary text-base mt-0.5">check_circle</span>
              <span><?= e(ps_text('प्रत्येक खरीद की पक्की रसीद एवं ग्रामीण कुम्हारों को प्रत्यक्ष भुगतान।', 'Direct payments to potters and certified receipts.')) ?></span>
            </li>
            <li class="flex items-start gap-2">
              <span class="material-symbols-outlined text-primary text-base mt-0.5">check_circle</span>
              <span><?= e(ps_text('प्रतिवर्ष वित्तीय वर्ष की समाप्ति पर खुला सार्वजनिक ब्योरा।', 'Annual open-book audit reports published online.')) ?></span>
            </li>
          </ul>
        </div>
      </div>

      <!-- Downloadable Audit Cards -->
      <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Report 1 -->
        <div class="bg-surface-container-lowest rounded-2xl p-6 shadow-sm border border-border-warm hover:shadow-md transition-shadow flex flex-col justify-between">
          <div>
            <div class="flex items-center justify-between mb-4">
              <span class="w-10 h-10 rounded-lg bg-soft-meadow text-deep-forest flex items-center justify-center border border-border-warm">
                <span class="material-symbols-outlined text-xl">description</span>
              </span>
              <span class="font-label-sm text-label-sm text-primary bg-surface-container px-2.5 py-0.5 rounded-full font-bold">PDF</span>
            </div>
            <h3 class="font-title-lg text-title-lg text-on-surface font-bold mb-1">
              <?= e(ps_text('वार्षिक जनसेवा व्यय विवरण (2023-24)', 'Annual Service Expense Ledger (2023-24)')) ?>
            </h3>
            <p class="font-body-sm text-body-sm text-text-muted mb-6">
              <?= e(ps_text('वर्ष भर में प्राप्त सहयोग राशि, ट्री-गार्ड निर्माण, पौधा क्रय एवं वितरण का विस्तृत ब्योरा।', 'Detailed audit of contributions, tree-guards, and sapling drives.')) ?>
            </p>
          </div>
          <a href="#" onclick="alert('<?= e(ps_text('वार्षिक जनसेवा व्यय विवरण 2023-24 (PDF) डाउनलोड प्रारंभ हो रहा है...', 'Downloading Annual Audit Report 2023-24 (PDF)...')) ?>'); return false;" class="inline-flex items-center justify-between w-full bg-soft-meadow hover:bg-surface-container text-deep-forest font-label-md text-label-md px-4 py-3 rounded-xl transition-colors border border-border-warm font-semibold">
            <span class="flex items-center gap-1.5">
              <span class="material-symbols-outlined text-[18px]">download</span>
              <span><?= e(ps_text('ऑडिट रिपोर्ट डाउनलोड (PDF)', 'Download PDF Audit')) ?></span>
            </span>
            <span class="text-text-muted font-mono text-xs">2.4 MB</span>
          </a>
        </div>

        <!-- Report 2 -->
        <div class="bg-surface-container-lowest rounded-2xl p-6 shadow-sm border border-border-warm hover:shadow-md transition-shadow flex flex-col justify-between">
          <div>
            <div class="flex items-center justify-between mb-4">
              <span class="w-10 h-10 rounded-lg bg-secondary-fixed text-secondary flex items-center justify-center border border-border-warm">
                <span class="material-symbols-outlined text-xl">water_bottle</span>
              </span>
              <span class="font-label-sm text-label-sm text-secondary bg-secondary-fixed/50 px-2.5 py-0.5 rounded-full font-bold"><?= e(ps_text('व्यय सूची', 'Distribution')) ?></span>
            </div>
            <h3 class="font-title-lg text-title-lg text-on-surface font-bold mb-1">
              <?= e(ps_text('सकोरा व दाना वितरण लेखा (ग्रीष्म 2024)', 'Bird Water Pot & Feed Ledger (2024)')) ?>
            </h3>
            <p class="font-body-sm text-body-sm text-text-muted mb-6">
              <?= e(ps_text('25,000 सकोरे क्रय, कुम्हार मानदेय और 12 टन पक्षी दाना खरीद का प्रमाणित बिल पत्र।', 'Audit of 25,000 water pots and 12 tonnes bird grain purchases.')) ?>
            </p>
          </div>
          <a href="#" onclick="alert('<?= e(ps_text('सकोरा व दाना वितरण लेखा 2024 (PDF) डाउनलोड प्रारंभ हो रहा है...', 'Downloading Water Pot Audit 2024 (PDF)...')) ?>'); return false;" class="inline-flex items-center justify-between w-full bg-secondary-fixed/30 hover:bg-secondary-fixed/50 text-secondary font-label-md text-label-md px-4 py-3 rounded-xl transition-colors border border-border-warm font-semibold">
            <span class="flex items-center gap-1.5">
              <span class="material-symbols-outlined text-[18px]">download</span>
              <span><?= e(ps_text('वितरण रिपोर्ट डाउनलोड', 'Download Report')) ?></span>
            </span>
            <span class="text-text-muted font-mono text-xs">1.8 MB</span>
          </a>
        </div>

        <!-- Report 3 -->
        <div class="bg-surface-container-lowest rounded-2xl p-6 shadow-sm border border-border-warm hover:shadow-md transition-shadow flex flex-col justify-between">
          <div>
            <div class="flex items-center justify-between mb-4">
              <span class="w-10 h-10 rounded-lg bg-tertiary-fixed text-tertiary flex items-center justify-center border border-border-warm">
                <span class="material-symbols-outlined text-xl">receipt_long</span>
              </span>
              <span class="font-label-sm text-label-sm text-tertiary bg-tertiary-fixed/50 px-2.5 py-0.5 rounded-full font-bold"><?= e(ps_text('प्रमाणित', 'Verified')) ?></span>
            </div>
            <h3 class="font-title-lg text-title-lg text-on-surface font-bold mb-1">
              <?= e(ps_text('ग्रामीण कुम्हार प्रोत्साहन प्रत्यक्ष अंतरण', 'Potter Artisan Direct Transfer Log')) ?>
            </h3>
            <p class="font-body-sm text-body-sm text-text-muted mb-6">
              <?= e(ps_text('बाराबंकी के 42 स्थानीय पारंपरिक कुम्हार परिवारों को सीधे पारिश्रमिक भुगतान की सूची।', 'Direct wage transfer log to 42 rural potter artisan families.')) ?>
            </p>
          </div>
          <a href="#" onclick="alert('<?= e(ps_text('कुम्हार प्रोत्साहन प्रत्यक्ष अंतरण सूची डाउनलोड हो रही है...', 'Downloading Artisan Direct Transfer Log...')) ?>'); return false;" class="inline-flex items-center justify-between w-full bg-tertiary-fixed/30 hover:bg-tertiary-fixed/50 text-tertiary font-label-md text-label-md px-4 py-3 rounded-xl transition-colors border border-border-warm font-semibold">
            <span class="flex items-center gap-1.5">
              <span class="material-symbols-outlined text-[18px]">download</span>
              <span><?= e(ps_text('भुगतान सूची देखें', 'View Wage Transfer Log')) ?></span>
            </span>
            <span class="text-text-muted font-mono text-xs">950 KB</span>
          </a>
        </div>
      </div>
    </div>
  </section>

  <!-- FREQUENTLY ASKED QUESTIONS (FAQ) -->
  <section class="w-full bg-cream-canvas py-16">
    <div class="max-w-container-editorial mx-auto px-4 sm:px-8">
      <div class="text-center mb-12">
        <span class="font-label-md text-label-md text-primary font-bold uppercase tracking-wider bg-surface-container px-3.5 py-1 rounded-full inline-block mb-2 border border-border-warm">
          <?= e(ps_text('शंका समाधान • Frequently Asked Questions', 'FAQ')) ?>
        </span>
        <h2 class="font-headline-lg text-headline-lg text-on-surface tracking-tight font-bold">
          <?= e(ps_text('सहयोग से जुड़े मुख्य प्रश्न', 'Frequently Asked Questions')) ?>
        </h2>
      </div>

      <!-- Accordion Items -->
      <div class="space-y-4">
        <!-- FAQ 1 -->
        <div class="bg-surface-container-lowest rounded-xl p-5 shadow-sm border border-border-warm">
          <button type="button" onclick="toggleFaq(this)" class="w-full flex items-center justify-between text-left cursor-pointer">
            <span class="font-title-md text-title-md text-deep-forest font-bold">
              <?= e(ps_text('क्या मुझे मेरे दान की रसीद और पौधारोपण का प्रमाण मिलेगा?', 'Will I receive a receipt and proof of my sapling plantation?')) ?>
            </span>
            <span class="material-symbols-outlined text-primary transition-transform">expand_more</span>
          </button>
          <div class="faq-content hidden pt-3 font-body-md text-body-md text-on-surface-variant">
            <?= e(ps_text('जी हाँ, बिल्कुल! आपके द्वारा विवरण दर्ज करने के उपरांत 24 घंटे के भीतर आधिकारिक डिजिटल रसीद जारी की जाती है। यदि आपने पौधारोपण हेतु सहयोग किया है, तो रोपे गए पौधे, उसके ट्री-गार्ड पर आपकी स्मृति पट्टिका तथा सटीक लोकेशन की फोटो सीधे आपके WhatsApp नंबर पर भेजी जाएगी।', 'Yes! A digital receipt is issued within 24 hours. For tree plantations, a photo of your tree with your name tag and location coordinates will be sent to your WhatsApp.')) ?>
          </div>
        </div>

        <!-- FAQ 2 -->
        <div class="bg-surface-container-lowest rounded-xl p-5 shadow-sm border border-border-warm">
          <button type="button" onclick="toggleFaq(this)" class="w-full flex items-center justify-between text-left cursor-pointer">
            <span class="font-title-md text-title-md text-deep-forest font-bold">
              <?= e(ps_text('क्या मैं अपने माता-पिता की स्मृति अथवा बच्चों के नाम से वृक्ष लगवा सकता हूँ?', 'Can I sponsor trees in memory or honor of family members?')) ?>
            </span>
            <span class="material-symbols-outlined text-primary transition-transform">expand_more</span>
          </button>
          <div class="faq-content hidden pt-3 font-body-md text-body-md text-on-surface-variant">
            <?= e(ps_text('हाँ, यह हमारे मिशन की सबसे आत्मीय परंपरा है। आप \'स्मृति संकल्प\' के तहत अपने प्रियजनों के नाम से वृक्षारोपण करा सकते हैं। ट्री-गार्ड पर उनके नाम का सुंदर बोर्ड लगाया जाता है और ग्रीन गैंग के स्वयंसेवक कम से कम 3 वर्षों तक उसके जल-पोषण की ज़िम्मेदारी लेते हैं।', 'Yes! We install a custom name board on the protective tree guard, and Green Gang volunteers nurture the tree for 3 years.')) ?>
          </div>
        </div>

        <!-- FAQ 3 -->
        <div class="bg-surface-container-lowest rounded-xl p-5 shadow-sm border border-border-warm">
          <button type="button" onclick="toggleFaq(this)" class="w-full flex items-center justify-between text-left cursor-pointer">
            <span class="font-title-md text-title-md text-deep-forest font-bold">
              <?= e(ps_text('क्या मैं बाराबंकी आकर प्रत्यक्ष रूप से श्रमदान या सेवा में शामिल हो सकता हूँ?', 'Can I visit Barabanki and join the plantation drives in person?')) ?>
            </span>
            <span class="material-symbols-outlined text-primary transition-transform">expand_more</span>
          </button>
          <div class="faq-content hidden pt-3 font-body-md text-body-md text-on-surface-variant">
            <?= e(ps_text('आपका स्वागत है! प्रदीप सारंग जी का आश्रम एवं ग्रीन गैंग केंद्र सदैव समाज के लिए खुला है। आप रविवार सुबह हमारे \'ग्रीन मॉर्निंग\' पौधारोपण अभियान में सीधे शामिल हो सकते हैं और अपने हाथों से मिट्टी और पौधों की सेवा कर सकते हैं।', 'You are most welcome! You can join our Green Morning drives in Barabanki every Sunday.')) ?>
          </div>
        </div>

        <!-- FAQ 4 -->
        <div class="bg-surface-container-lowest rounded-xl p-5 shadow-sm border border-border-warm">
          <button type="button" onclick="toggleFaq(this)" class="w-full flex items-center justify-between text-left cursor-pointer">
            <span class="font-title-md text-title-md text-deep-forest font-bold">
              <?= e(ps_text('क्या यह सहयोग आयकर की धारा 80G के अंतर्गत कर-मुक्त है?', 'Is the donation eligible for 80G tax exemption?')) ?>
            </span>
            <span class="material-symbols-outlined text-primary transition-transform">expand_more</span>
          </button>
          <div class="faq-content hidden pt-3 font-body-md text-body-md text-on-surface-variant">
            <?= e(ps_text('प्रदीप सारंग जनसेवा एवं पर्यावरण न्यास एक पंजीकृत लोकोपकारी न्यास है। वैधानिक 80G पंजीकरण नवीनीकरण प्रक्रियाधीन है। वर्तमान में आपका सहयोग विशुद्ध सामाजिक, आत्मीय और ज़मीनी पर्यावरण रक्षा के स्वैच्छिक योगदान के रूप में स्वीकार किया जाता है।', 'Pradeep Sarang Trust is a registered public charitable trust. 80G renewal is in process; contributions directly fuel grassroots environmental protection.')) ?>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- BOTTOM CROSS-NAVIGATION -->
  <section class="w-full bg-soft-meadow py-14">
    <div class="max-w-container-max mx-auto px-4 sm:px-8">
      <div class="bg-deep-forest text-pure-white rounded-3xl p-8 sm:p-12 relative overflow-hidden shadow-xl border border-border-warm">
        <!-- Background Accent Graphic -->
        <div class="absolute right-0 bottom-0 opacity-10 pointer-events-none transform translate-x-12 translate-y-12 select-none">
          <span class="material-symbols-outlined text-[300px]">park</span>
        </div>

        <div class="relative z-10 max-w-2xl">
          <span class="font-label-md text-label-md text-tertiary-fixed font-bold uppercase tracking-wider block mb-2">
            <?= e(ps_text('माटी से जुड़ाव की निरंतर यात्रा', 'Join the Movement')) ?>
          </span>
          <h3 class="font-headline-lg text-headline-lg text-pure-white tracking-tight mb-4 font-bold">
            <?= e(ps_text('आर्थिक सहयोग के अतिरिक्त भी आप हमारे सारथी बन सकते हैं', 'Become a Partner in Our Community Initiatives')) ?>
          </h3>
          <p class="font-body-md text-body-md text-surface-container-high mb-8 leading-relaxed">
            <?= e(ps_text('ग्रीन गैंग के साथ मिलकर पौधे रोपें, अपने गांव में सकोरा अभियान का नेतृत्व करें या अवधी लोक-साहित्य के संरक्षण में अपना लेखनी-श्रम जोड़ें।', 'Plant trees with Green Gang, lead bird water bowl drives, or contribute Awadhi folklore writing.')) ?>
          </p>
          <div class="flex flex-wrap items-center gap-4">
            <a href="<?= e(base_url('/volunteer')) ?>" data-path="join-movement" class="bg-primary-container hover:bg-fresh-sprout hover:text-deep-forest text-pure-white px-6 py-3.5 rounded-xl font-headline-sm text-body-md font-bold transition-all flex items-center gap-2 shadow-sm">
              <span class="material-symbols-outlined text-xl">groups</span>
              <span><?= e(ps_text('स्वयंसेवक (Volunteer) बनें', 'Become a Volunteer')) ?></span>
            </a>
            <a href="<?= e(base_url('/campaigns')) ?>" data-path="campaigns" class="bg-surface-container-lowest/15 hover:bg-surface-container-lowest/25 text-pure-white px-6 py-3.5 rounded-xl font-headline-sm text-body-md font-bold transition-all flex items-center gap-2 border border-white/20">
              <span class="material-symbols-outlined text-xl">nature_people</span>
              <span><?= e(ps_text('पर्यावरण अभियान विस्तार', 'Explore Campaigns')) ?></span>
            </a>
            <a href="<?= e(base_url('/contact')) ?>" data-path="contact" class="hover:text-tertiary-fixed text-surface-container-high text-body-md font-label-md px-4 py-3.5 transition-colors flex items-center gap-1 font-semibold">
              <span><?= e(ps_text('कार्यालय पता व फोन देखें', 'Contact Office')) ?></span>
              <span class="material-symbols-outlined text-sm">arrow_forward</span>
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

<script>
  function selectTier(amountStr, causeName) {
    const num = amountStr.replace(/[^0-9]/g, '');
    const customInput = document.getElementById('custom-amount');
    if (customInput) customInput.value = num;

    const select = document.getElementById('cause-select');
    if (select) {
      if (causeName.includes('हरियाली')) select.value = 'hariyali';
      else if (causeName.includes('परिंदा')) select.value = 'parinda';
      else if (causeName.includes('शिक्षा') || causeName.includes('साहित्य')) select.value = 'culture';
      else if (causeName.includes('कपड़ा') || causeName.includes('कंबल')) select.value = 'cloth-bank';
    }

    const desk = document.getElementById('pledge-desk');
    if (desk) desk.scrollIntoView({ behavior: 'smooth' });
  }

  function setFormAmount(val) {
    const customInput = document.getElementById('custom-amount');
    if (customInput) customInput.value = val;
  }

  function copyText(text, btnElement) {
    navigator.clipboard.writeText(text).then(() => {
      const originalHtml = btnElement.innerHTML;
      btnElement.innerHTML = '<span class="material-symbols-outlined text-[14px]">check</span><span><?= e(ps_text('कॉपी हुआ!', 'Copied!')) ?></span>';
      setTimeout(() => {
        btnElement.innerHTML = originalHtml;
      }, 2000);
    });
  }

  function toggleFaq(btn) {
    const content = btn.nextElementSibling;
    const icon = btn.querySelector('.material-symbols-outlined');
    if (content.classList.contains('hidden')) {
      content.classList.remove('hidden');
      icon.classList.add('rotate-180');
    } else {
      content.classList.add('hidden');
      icon.classList.remove('rotate-180');
    }
  }

  function handleDonationSubmit(e) {
    e.preventDefault();
    const form = document.getElementById('donation-form');
    const feedback = document.getElementById('form-feedback');

    const formData = new FormData(form);
    fetch('<?= e(base_url('/ajax-submit.php')) ?>', {
      method: 'POST',
      body: formData
    })
    .then(r => r.json())
    .then(j => {
      if (feedback) {
        feedback.classList.remove('hidden');
        feedback.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
      }
      form.reset();
    })
    .catch(() => {
      if (feedback) {
        feedback.classList.remove('hidden');
        feedback.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
      }
      form.reset();
    });
  }
</script>
