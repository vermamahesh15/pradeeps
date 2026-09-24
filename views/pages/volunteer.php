<?php
declare(strict_types=1);

$contactPhone = $settings['phone'] ?? '+91 9919007190';
$contactEmail = $settings['email'] ?? 'volunteer@pradeepsarang.in';
$states = $states ?? [];
?>

<div class="flex flex-col w-full">
<!-- Top Breadcrumb & Page Introduction Banner -->
<section class="relative w-full bg-soft-meadow overflow-hidden py-space-2xl md:py-space-3xl border-b border-border-warm">
  <div class="max-w-container-max mx-auto px-4 sm:px-8 relative z-10">
    <!-- Breadcrumb -->
    <nav aria-label="Breadcrumb" class="flex items-center gap-2 font-label-md text-label-md text-text-muted mb-space-sm">
      <a class="hover:text-primary transition-colors flex items-center gap-1" data-path="home" href="<?= e(base_url('/')) ?>">
        <span class="material-symbols-outlined text-[16px]">home</span>
        <span><?= e(ps_text('गृह (Home)', 'Home')) ?></span>
      </a>
      <span class="opacity-40">/</span>
      <span class="text-deep-forest font-semibold"><?= e(ps_text('स्वयंसेवक पंजीकरण (Volunteer)', 'Volunteer Registration')) ?></span>
    </nav>
    <!-- Category Badges -->
    <div class="inline-flex items-center gap-2 bg-primary-fixed/40 text-deep-forest px-3.5 py-1 rounded-full font-label-sm text-label-sm mb-space-sm border border-border-warm font-semibold">
      <span class="material-symbols-outlined text-[15px] text-primary-container" style="font-variation-settings: 'FILL' 1;">volunteer_activism</span>
      <span><?= e(ps_text('माटी का ऋण और सामाजिक उत्तरदायित्व • ग्रीन गैंग स्वयंसेवक दल', 'Social Responsibility & Green Gang Volunteer Network')) ?></span>
    </div>
    <!-- Main Heading & Subtitle -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start mt-2">
      <div class="lg:col-span-8">
        <h1 class="font-display-hero text-headline-lg md:text-display-hero text-deep-forest leading-tight tracking-tight font-bold">
          <?= ps_text('गाँव की पगडंडियों से बदलाव की राह — <span class="text-primary-container">\'ग्रीन गैंग\'</span> एवं जनसेवा से जुड़ें', 'Path of Change from Village Trails — Join <span class="text-primary-container">\'Green Gang\'</span> & Public Service') ?>
        </h1>
        <p class="font-body-lg text-body-lg text-text-muted mt-space-sm leading-relaxed max-w-3xl">
          <?= e(ps_text('पर्यावरण संवर्धन, पक्षी सकोरा वितरण, अवधी भाषा संरक्षण और ग्रामीण जन-जागरूकता अभियानों में अपनी रुचि और समय के अनुसार निस्वार्थ सहभागिता दर्ज करें।', 'Participate in environmental protection, bird water bowl distribution, Awadhi heritage, and community empowerment.')) ?>
        </p>
      </div>
      <!-- Signature Quote Card -->
      <div class="lg:col-span-4">
        <div class="bg-surface-container-lowest rounded-xl p-5 shadow-sm border border-border-warm">
          <div class="flex items-start gap-3">
            <span class="material-symbols-outlined text-secondary text-[26px] shrink-0 mt-0.5">format_quote</span>
            <div>
              <p class="font-quote-editorial text-body-md text-deep-forest italic leading-relaxed mb-2">
                <?= ps_text('"हारना सीखा नहीं है, जीत का मैं गीत हूँ।<br/>जुगनुओं का संग है, इंसानियत का मीत हूँ।"', '"I have not learned to lose; I am a song of victory.<br/>Accompanied by fireflies, I am a friend to humanity."') ?>
              </p>
              <div class="flex items-center justify-between pt-2 border-t border-border-warm">
                <span class="font-label-sm text-label-sm text-text-muted font-bold tracking-wider"><?= e(ps_text('— प्रदीप सारंग', '— Pradeep Sarang')) ?></span>
                <span class="inline-flex items-center gap-1 text-[11px] font-label-sm text-primary font-semibold">
                  <span class="material-symbols-outlined text-[13px]">verified</span>
                  <?= e(ps_text('लोकसेवक, बाराबंकी', 'Social Worker, Barabanki')) ?>
                </span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Impact Metrics Ribbon (Volunteering at a Glance) -->
<section class="w-full bg-deep-forest text-on-primary py-8 px-4 sm:px-8">
  <div class="max-w-container-max mx-auto">
    <div class="grid grid-cols-2 md:grid-cols-4 gap-6 text-center">
      <!-- Metric 1 -->
      <div class="flex flex-col items-center p-3 rounded-lg bg-surface-container-low/10">
        <div class="flex items-center gap-1.5 text-primary-fixed mb-1">
          <span class="material-symbols-outlined text-[24px]">groups</span>
          <span class="font-display-hero-mobile text-display-hero-mobile font-bold text-pure-white leading-none">1,500+</span>
        </div>
        <span class="font-label-md text-label-md text-pure-white font-semibold"><?= e(ps_text('सक्रिय स्वयंसेवक', 'Active Volunteers')) ?></span>
        <span class="font-label-sm text-label-sm text-surface-container-high opacity-80 mt-0.5"><?= e(ps_text('गाँवों व नगरों में तत्पर', 'Ready across villages & towns')) ?></span>
      </div>
      <!-- Metric 2 -->
      <div class="flex flex-col items-center p-3 rounded-lg bg-surface-container-low/10">
        <div class="flex items-center gap-1.5 text-tertiary-fixed mb-1">
          <span class="material-symbols-outlined text-[24px]">pin_drop</span>
          <span class="font-display-hero-mobile text-display-hero-mobile font-bold text-pure-white leading-none">120+</span>
        </div>
        <span class="font-label-md text-label-md text-pure-white font-semibold"><?= e(ps_text('गाँव एवं कस्बे', 'Villages & Towns')) ?></span>
        <span class="font-label-sm text-label-sm text-surface-container-high opacity-80 mt-0.5"><?= e(ps_text('अवध अंचल में आच्छादित', 'Covered across Awadh region')) ?></span>
      </div>
      <!-- Metric 3 -->
      <div class="flex flex-col items-center p-3 rounded-lg bg-surface-container-low/10">
        <div class="flex items-center gap-1.5 text-fresh-sprout mb-1">
          <span class="material-symbols-outlined text-[24px]">nature</span>
          <span class="font-display-hero-mobile text-display-hero-mobile font-bold text-pure-white leading-none">50,000+</span>
        </div>
        <span class="font-label-md text-label-md text-pure-white font-semibold"><?= e(ps_text('रोपित पौधों की देखभाल', 'Trees Planted & Protected')) ?></span>
        <span class="font-label-sm text-label-sm text-surface-container-high opacity-80 mt-0.5"><?= e(ps_text('\'ग्रीन मॉर्निंग\' के तहत', 'Under Green Morning Drive')) ?></span>
      </div>
      <!-- Metric 4 -->
      <div class="flex flex-col items-center p-3 rounded-lg bg-surface-container-low/10">
        <div class="flex items-center gap-1.5 text-secondary-fixed mb-1">
          <span class="material-symbols-outlined text-[24px]">favorite</span>
          <span class="font-display-hero-mobile text-display-hero-mobile font-bold text-pure-white leading-none">04</span>
        </div>
        <span class="font-label-md text-label-md text-pure-white font-semibold"><?= e(ps_text('प्रमुख सेवा स्तम्भ', 'Core Pillars of Impact')) ?></span>
        <span class="font-label-sm text-label-sm text-surface-container-high opacity-80 mt-0.5"><?= e(ps_text('प्रकृति, जीव, भाषा, मानव सेवा', 'Nature, Birds, Heritage, Relief')) ?></span>
      </div>
    </div>
  </div>
</section>

<!-- Volunteer Field Action Photo Showcase -->
<section class="w-full py-space-xl bg-pure-white border-b border-border-warm">
  <div class="max-w-container-max mx-auto px-4 sm:px-8">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
      <div class="relative rounded-2xl overflow-hidden shadow-sm border border-border-warm group">
        <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuChrvMjaMrNe9mnv0wsNeczsA9QTsVBVexwNC6wWD2ITtZGUqAqC4rJlu14alM7uVOx3q6e6QMugj2k_SVptJFwJxqw4kgUmkZfc4oZSwOSInUiqwcST-ZVxWP0dQNinxgeGayBKo9MBnd0LReS_tvv8rW_e0uWQz8FI_1PBQ_sze_mt4-UezPUkio4HIFKvoUNP0kZ6gNLPilWihHeDYhJaX6ySBPHJHVKOu68a1dbF1aYaqyDO7Db" alt="Green Gang Tree Planting" class="w-full h-56 object-cover group-hover:scale-105 transition-transform duration-300">
        <div class="absolute bottom-0 inset-x-0 bg-gradient-to-t from-deep-forest/90 via-deep-forest/50 to-transparent p-4 text-pure-white">
          <span class="font-label-sm text-label-sm uppercase tracking-wider text-fresh-sprout font-bold"><?= e(ps_text('ग्रीन गैंग कार्यदल', 'Green Gang Volunteer Squad')) ?></span>
          <p class="font-title-md text-title-md font-bold mt-0.5"><?= e(ps_text('ग्रामीण अंचलों में युवाओं की पौधारोपण सहभागिता', 'Youth Tree Plantation Squad in Rural Awadh')) ?></p>
        </div>
      </div>
      <div class="relative rounded-2xl overflow-hidden shadow-sm border border-border-warm group">
        <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuCIdMQwsnVo2dk4ut7g6q_cAP6eTxbCJ79UEWEL6LMYJP9Bzoa711KY0DUcQDKRXxuQ_6LQhxi0vQ2STd8MG_7M8PMwLDKDbl4rkN0NWnrSqVTvaAamPZA23ot4DWOtvh7QMTvSKjQWd4KHteII-UyAePIVzkOU6Kjt18WGSoV63V45Zxnm-uJxCWTIYBFdLiZQTIIpMJ2BicU3nJOrp9TW5wTXMOaNdUj57zI1cu2Z0PJgk4oP02r7" alt="Parinda Water Bowl Drive" class="w-full h-56 object-cover group-hover:scale-105 transition-transform duration-300">
        <div class="absolute bottom-0 inset-x-0 bg-gradient-to-t from-deep-forest/90 via-deep-forest/50 to-transparent p-4 text-pure-white">
          <span class="font-label-sm text-label-sm uppercase tracking-wider text-tertiary-fixed font-bold"><?= e(ps_text('परिंदा जल-सकोरा सेवा', 'Parinda Water Bowl Network')) ?></span>
          <p class="font-title-md text-title-md font-bold mt-0.5"><?= e(ps_text('पक्षियों हेतु जलदान व दाना-पानी संकल्प', 'Volunteers Distributing Water Bowls for Birds')) ?></p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Core Volunteer Pillars (4 Interactive Category Cards) -->
<section class="w-full py-space-3xl px-4 sm:px-8 bg-cream-canvas">
  <div class="max-w-container-max mx-auto">
    <div class="text-center max-w-2xl mx-auto mb-10">
      <span class="inline-block px-3 py-1 rounded-md bg-surface-container text-deep-forest font-label-sm text-label-sm font-semibold mb-2">
        <?= e(ps_text('सहभागिता के चार आयाम', 'Four Pillars of Service')) ?>
      </span>
      <h2 class="font-headline-lg text-headline-lg text-deep-forest"><?= e(ps_text('अपनी रुचि और समय अनुसार कार्यक्षेत्र चुनें', 'Choose Domain by Interest & Time')) ?></h2>
      <p class="font-body-md text-body-md text-text-muted mt-2">
        <?= e(ps_text('प्रत्येक स्वयंसेवक अपने कौशल, दिनचर्या और आवासीय क्षेत्र के अनुसार कार्यदल से जुड़ सकता है। कोई भी प्रयास छोटा नहीं होता।', 'Every volunteer can join according to skills, routine and location. No effort is small.')) ?>
      </p>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
      <!-- Pillar 1: Hariali Sanrakshak -->
      <div class="bg-surface-container-lowest rounded-xl p-6 shadow-sm border border-border-warm flex flex-col justify-between hover:shadow-md transition-shadow">
        <div>
          <div class="w-12 h-12 rounded-lg bg-soft-meadow flex items-center justify-center text-primary mb-4">
            <span class="material-symbols-outlined text-[28px]">potted_plant</span>
          </div>
          <span class="inline-block px-2.5 py-0.5 rounded bg-surface-container text-deep-forest font-label-sm text-label-sm font-semibold mb-2">
            <?= e(ps_text('स्तम्भ १ : पर्यावरण', 'Pillar 1: Environment')) ?>
          </span>
          <h3 class="font-title-lg text-title-lg text-deep-forest mb-2"><?= e(ps_text('हरियाली संरक्षक (Green Gang)', 'Hariyali Protector (Green Gang)')) ?></h3>
          <p class="font-body-sm text-body-sm text-on-surface-variant mb-4">
            <?= e(ps_text('प्रभातकालीन \'ग्रीन मॉर्निंग\' पौधारोपण, ग्रामीण सड़कों पर वृक्ष सुरक्षा बाड़ (ट्री-गार्ड) निर्माण और \'एक छात्र, एक पौधा\' संकल्प का नेतृत्व।', 'Morning Green Morning tree planting drives, tree guard construction along village roads & student tree adoption.')) ?>
          </p>
          <div class="space-y-2 mb-6">
            <div class="flex items-center gap-2 font-label-sm text-label-sm text-deep-forest">
              <span class="material-symbols-outlined text-[16px] text-primary">schedule</span>
              <span><strong><?= e(ps_text('समय:', 'Time:')) ?></strong> <?= e(ps_text('2-3 घंटे / सप्ताह (रविवार प्रभात)', '2-3 hrs / week (Sunday Morning)')) ?></span>
            </div>
            <div class="flex items-center gap-2 font-label-sm text-label-sm text-deep-forest">
              <span class="material-symbols-outlined text-[16px] text-primary">person_check</span>
              <span><strong><?= e(ps_text('आदर्श:', 'Ideal:')) ?></strong> <?= e(ps_text('युवा, किसान, छात्र, प्रकृति प्रेमी', 'Youth, Farmers, Students, Nature Lovers')) ?></span>
            </div>
          </div>
        </div>
        <button type="button" onclick="selectPillar('हरियाली अभियान एवं ग्रीन गैंग')" class="w-full py-2 px-3 rounded-lg bg-surface-container text-deep-forest hover:bg-primary hover:text-on-primary font-label-md text-label-md transition-colors flex items-center justify-center gap-1.5">
          <span><?= e(ps_text('यह स्तम्भ चुनें', 'Select this pillar')) ?></span>
          <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
        </button>
      </div>

      <!-- Pillar 2: Parinda Sanrakshak -->
      <div class="bg-surface-container-lowest rounded-xl p-6 shadow-sm border border-border-warm flex flex-col justify-between hover:shadow-md transition-shadow">
        <div>
          <div class="w-12 h-12 rounded-lg bg-tertiary-fixed/30 flex items-center justify-center text-tertiary mb-4">
            <span class="material-symbols-outlined text-[28px]">nest_cam_wired_stand</span>
          </div>
          <span class="inline-block px-2.5 py-0.5 rounded bg-tertiary-fixed/40 text-tertiary font-label-sm text-label-sm font-semibold mb-2">
            <?= e(ps_text('स्तम्भ २ : बेजुबान सेवा', 'Pillar 2: Bird Welfare')) ?>
          </span>
          <h3 class="font-title-lg text-title-lg text-deep-forest mb-2"><?= e(ps_text('परिंदा व जीव रक्षक', 'Bird & Wildlife Protector')) ?></h3>
          <p class="font-body-sm text-body-sm text-on-surface-variant mb-4">
            <?= e(ps_text('भीषण गर्मी में मिट्टी के सकोरे वितरण, जल-पात्रों की नियमित निगरानी और छतों, दुकानों व खेतों पर दाना-पानी की निरंतर व्यवस्था।', 'Earthen water bowl distribution in summer, water bowl refills & maintaining seed-water feeders on roofs/farms.')) ?>
          </p>
          <div class="space-y-2 mb-6">
            <div class="flex items-center gap-2 font-label-sm text-label-sm text-deep-forest">
              <span class="material-symbols-outlined text-[16px] text-tertiary">schedule</span>
              <span><strong><?= e(ps_text('समय:', 'Time:')) ?></strong> <?= e(ps_text('15 मिनट प्रतिदिन (घर/दुकान में)', '15 mins daily (Home/Shop)')) ?></span>
            </div>
            <div class="flex items-center gap-2 font-label-sm text-label-sm text-deep-forest">
              <span class="material-symbols-outlined text-[16px] text-tertiary">person_check</span>
              <span><strong><?= e(ps_text('आदर्श:', 'Ideal:')) ?></strong> <?= e(ps_text('गृहणियाँ, दुकानदार, बुजुर्ग, बच्चे', 'Homemakers, Shopkeepers, Elders')) ?></span>
            </div>
          </div>
        </div>
        <button type="button" onclick="selectPillar('परिंदा संरक्षण अभियान')" class="w-full py-2 px-3 rounded-lg bg-surface-container text-deep-forest hover:bg-primary hover:text-on-primary font-label-md text-label-md transition-colors flex items-center justify-center gap-1.5">
          <span><?= e(ps_text('यह स्तम्भ चुनें', 'Select this pillar')) ?></span>
          <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
        </button>
      </div>

      <!-- Pillar 3: Awadhi Sanskriti Doot -->
      <div class="bg-surface-container-lowest rounded-xl p-6 shadow-sm border border-border-warm flex flex-col justify-between hover:shadow-md transition-shadow">
        <div>
          <div class="w-12 h-12 rounded-lg bg-secondary-fixed/40 flex items-center justify-center text-secondary mb-4">
            <span class="material-symbols-outlined text-[28px]">menu_book</span>
          </div>
          <span class="inline-block px-2.5 py-0.5 rounded bg-secondary-fixed/50 text-secondary font-label-sm text-label-sm font-semibold mb-2">
            <?= e(ps_text('स्तम्भ ३ : भाषा व संस्कृति', 'Pillar 3: Culture & Language')) ?>
          </span>
          <h3 class="font-title-lg text-title-lg text-deep-forest mb-2"><?= e(ps_text('अवधी भाषा व संस्कृति दूत', 'Awadhi Culture Ambassador')) ?></h3>
          <p class="font-body-sm text-body-sm text-on-surface-variant mb-4">
            <?= e(ps_text('गाँव चौपालों में अवधी काव्य-वाचन, लुप्तप्राय लोक कहावतों व शब्दों का संग्रह, तुलसी जयंती पखवारा में सहयोग और सांस्कृतिक प्रलेखन।', 'Awadhi poetry readings in village chaupals, collecting folk proverbs & organizing Tulsi Jayanti events.')) ?>
          </p>
          <div class="space-y-2 mb-6">
            <div class="flex items-center gap-2 font-label-sm text-label-sm text-deep-forest">
              <span class="material-symbols-outlined text-[16px] text-secondary">schedule</span>
              <span><strong><?= e(ps_text('समय:', 'Time:')) ?></strong> <?= e(ps_text('पाक्षिक या मासिक आयोजनों में', 'Fortnightly / Monthly events')) ?></span>
            </div>
            <div class="flex items-center gap-2 font-label-sm text-label-sm text-deep-forest">
              <span class="material-symbols-outlined text-[16px] text-secondary">person_check</span>
              <span><strong><?= e(ps_text('आदर्श:', 'Ideal:')) ?></strong> <?= e(ps_text('शिक्षक, साहित्य प्रेमी, शोधार्थी, कवि', 'Teachers, Scholars, Poets')) ?></span>
            </div>
          </div>
        </div>
        <button type="button" onclick="selectPillar('अवधी भाषा, साहित्य व तुलसी जयंती')" class="w-full py-2 px-3 rounded-lg bg-surface-container text-deep-forest hover:bg-primary hover:text-on-primary font-label-md text-label-md transition-colors flex items-center justify-center gap-1.5">
          <span><?= e(ps_text('यह स्तम्भ चुनें', 'Select this pillar')) ?></span>
          <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
        </button>
      </div>

      <!-- Pillar 4: Aapat Seva Dal -->
      <div class="bg-surface-container-lowest rounded-xl p-6 shadow-sm border border-border-warm flex flex-col justify-between hover:shadow-md transition-shadow">
        <div>
          <div class="w-12 h-12 rounded-lg bg-error-container/40 flex items-center justify-center text-error mb-4">
            <span class="material-symbols-outlined text-[28px]">emergency_share</span>
          </div>
          <span class="inline-block px-2.5 py-0.5 rounded bg-soft-meadow text-deep-forest font-label-sm text-label-sm font-semibold mb-2 border border-border-warm">
            <?= e(ps_text('स्तम्भ ४ : पक्षी व परिंदा संरक्षण', 'Pillar 4: Bird Conservation')) ?>
          </span>
          <h3 class="font-title-lg text-title-lg text-deep-forest mb-2"><?= e(ps_text('जल-सकोरा व पक्षी संरक्षण दल', 'Water Bowl & Bird Protection Taskforce')) ?></h3>
          <p class="font-body-sm text-body-sm text-on-surface-variant mb-4">
            <?= e(ps_text('भीषण गर्मी में मिट्टी के जल-सकोरे वितरण, दाना-पानी प्रबंध, पक्षी आश्रय निर्माण और गौरैया संरक्षण जागरूकता में सहभागिता।', 'Participating in clay water bowl distribution, grain-feed setup, and sparrow protection drives.')) ?>
          </p>
          <div class="space-y-2 mb-6">
            <div class="flex items-center gap-2 font-label-sm text-label-sm text-deep-forest">
              <span class="material-symbols-outlined text-[16px] text-deep-forest">schedule</span>
              <span><strong><?= e(ps_text('समय:', 'Time:')) ?></strong> <?= e(ps_text('ग्रीष्म ऋतु / नियमित साप्ताहिक', 'Summer Season / Weekly')) ?></span>
            </div>
            <div class="flex items-center gap-2 font-label-sm text-label-sm text-deep-forest">
              <span class="material-symbols-outlined text-[16px] text-deep-forest">person_check</span>
              <span><strong><?= e(ps_text('आदर्श:', 'Ideal:')) ?></strong> <?= e(ps_text('युवा, प्रकृति प्रेमी, छात्र, सामाजिक कार्यकर्ता', 'Youth, Nature Lovers, Students')) ?></span>
            </div>
          </div>
        </div>
        <button type="button" onclick="selectPillar('जल-सकोरा व परिंदा संरक्षण अभियान')" class="w-full py-2 px-3 rounded-lg bg-surface-container text-deep-forest hover:bg-primary hover:text-on-primary font-label-md text-label-md transition-colors flex items-center justify-center gap-1.5">
          <span><?= e(ps_text('यह स्तम्भ चुनें', 'Select this pillar')) ?></span>
          <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
        </button>
      </div>
    </div>
  </div>
</section>

<!-- Split Section: Why Volunteer & Visual Highlight -->
<section class="w-full bg-soft-meadow py-space-3xl px-4 sm:px-8 border-y border-border-warm">
  <div class="max-w-container-max mx-auto">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-center">
      <!-- Visual Column -->
      <div class="lg:col-span-5 relative">
        <div class="relative rounded-2xl overflow-hidden shadow-md">
          <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuB35tR_pZ7AZzjgZ8O5JlP_sx8z9ydz5pE5MQuDVCesMq0jHByqzXV75UIgDh4UmGy6kW9_RalwFqez--7oIaDq09wP5-6tDXjPWtMrkesh_1Rfp3SCMildiHmJh0gDWFQRXj1FpI_RQQae_ENfDvjOqd9RIPzWzOfTNSyPmD0G-jn4NwyBPxrZxa3gUiFOYTBPg1o_60Wctd2VxLSQ9eL0SyB1QBL-DBXGcpFtjxtDnZ6cRJiDz8JZ" alt="<?= e(ps_text('प्रदीप सारंग युवाओं के साथ पौधारोपण करते हुए', 'Pradeep Sarang planting trees with youth volunteers')) ?>" class="w-full h-96 object-cover">
          <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-deep-forest/90 via-deep-forest/40 to-transparent p-5 text-pure-white">
            <span class="inline-flex items-center gap-1 text-primary-fixed text-label-sm font-semibold mb-1">
              <span class="material-symbols-outlined text-[14px]">eco</span>
              <?= e(ps_text('फील्ड रिपोर्ट — बाराबंकी', 'Field Report — Barabanki')) ?>
            </span>
            <p class="font-headline-sm text-headline-sm leading-snug"><?= ps_text('"जब एक हाथ पौधा रोपता है, और सौ हाथ उसे सींचते हैं — तब क्रांति होती है।"', '"When one hand plants a tree and a hundred hands nurture it — revolution happens."') ?></p>
          </div>
        </div>
        <!-- Stamp Overlap -->
        <div class="absolute -bottom-5 -right-4 bg-secondary text-pure-white p-3.5 rounded-xl shadow-lg hidden sm:flex items-center gap-3">
          <span class="material-symbols-outlined text-[28px]">military_tech</span>
          <div class="flex flex-col">
            <span class="font-label-sm text-label-sm uppercase tracking-wider font-bold"><?= e(ps_text('100% निस्वार्थ भाव', '100% Volunteer Driven')) ?></span>
            <span class="font-body-sm text-body-sm opacity-90"><?= e(ps_text('कोई शुल्क नहीं, केवल सेवा', 'No fees, pure service')) ?></span>
          </div>
        </div>
      </div>

      <!-- Content Column: 4 Value Principles -->
      <div class="lg:col-span-7">
        <span class="inline-block px-3 py-1 rounded-md bg-surface-container text-deep-forest font-label-sm text-label-sm font-semibold mb-2">
          <?= e(ps_text('हमारे सिद्धांत व लाभ', 'Our Principles & Benefits')) ?>
        </span>
        <h2 class="font-headline-lg text-headline-lg text-deep-forest mb-4">
          <?= e(ps_text('सारंग जी के जन-आंदोलन से क्यों जुड़ें?', 'Why Join Shri Sarang’s Movement?')) ?>
        </h2>
        <p class="font-body-md text-body-md text-on-surface-variant mb-6 leading-relaxed">
          <?= e(ps_text('यह केवल एक डिजिटल पंजीकरण नहीं, बल्कि अपनी माटी, गाँव और समाज के प्रति निष्ठा का जीवित संकल्प है। यहाँ कोई औपचारिकता नहीं, सिर्फ ज़मीनी कर्म की प्रधानता है।', 'This is a living pledge towards soil, village & society. No empty formalities, only real ground action.')) ?>
        </p>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
          <div class="bg-surface-container-lowest p-4 rounded-xl shadow-sm border border-border-warm flex items-start gap-3.5">
            <span class="material-symbols-outlined text-primary text-[24px] shrink-0 mt-0.5">nature_people</span>
            <div>
              <h4 class="font-title-md text-title-md text-deep-forest font-bold mb-1"><?= e(ps_text('ज़मीनी प्रत्यक्ष प्रभाव', 'Direct Grassroots Impact')) ?></h4>
              <p class="font-body-sm text-body-sm text-text-muted leading-relaxed">
                <?= e(ps_text('कागज़ी या सोशल मीडिया तक सीमित नहीं; हर कार्य बाराबंकी व अवध के गाँवों में आँखों के सामने घटित होता है।', 'Not limited to social media; work happens right before your eyes in Barabanki villages.')) ?>
              </p>
            </div>
          </div>

          <div class="bg-surface-container-lowest p-4 rounded-xl shadow-sm border border-border-warm flex items-start gap-3.5">
            <span class="material-symbols-outlined text-secondary text-[24px] shrink-0 mt-0.5">sentiment_satisfied</span>
            <div>
              <h4 class="font-title-md text-title-md text-deep-forest font-bold mb-1"><?= e(ps_text('\'ग्रीन मॉर्निंग\' पहचान', '\'Green Morning\' Identity')) ?></h4>
              <p class="font-body-sm text-body-sm text-text-muted leading-relaxed">
                <?= e(ps_text('एक-दूसरे को \'ग्रीन मॉर्निंग\' कह कर प्रकृति चेतना जगाने वाले अनूठे समुदाय का सम्मानजनक हिस्सा बनें।', 'Become part of a unique community greeting each other with Green Morning.')) ?>
              </p>
            </div>
          </div>

          <div class="bg-surface-container-lowest p-4 rounded-xl shadow-sm border border-border-warm flex items-start gap-3.5">
            <span class="material-symbols-outlined text-tertiary text-[24px] shrink-0 mt-0.5">workspace_premium</span>
            <div>
              <h4 class="font-title-md text-title-md text-deep-forest font-bold mb-1"><?= e(ps_text('सेवा प्रमाण पत्र व सम्मान', 'Certificate & Recognition')) ?></h4>
              <p class="font-body-sm text-body-sm text-text-muted leading-relaxed">
                <?= e(ps_text('सक्रिय स्वयंसेवकों को वार्षिक सामाजिक उत्सव में लोक सम्मान और विद्यार्थियों को सेवा-अनुभव प्रमाण पत्र।', 'Active volunteers receive public honors and students receive service experience certificates.')) ?>
              </p>
            </div>
          </div>

          <div class="bg-surface-container-lowest p-4 rounded-xl shadow-sm border border-border-warm flex items-start gap-3.5">
            <span class="material-symbols-outlined text-deep-forest text-[24px] shrink-0 mt-0.5">history_edu</span>
            <div>
              <h4 class="font-title-md text-title-md text-deep-forest font-bold mb-1"><?= e(ps_text('लोक-संस्कृति से सीधा जुड़ाव', 'Connection with Folk Culture')) ?></h4>
              <p class="font-body-sm text-body-sm text-text-muted leading-relaxed">
                <?= e(ps_text('बुजुर्गों के सान्निध्य में अवधी बोलियों, लोकगीतों, पारंपरिक जल-संरक्षण और वानिकी का व्यावहारिक ज्ञान।', 'Practical learning of Awadhi dialects, folk wisdom, water harvesting & forestry.')) ?>
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Step-by-Step Onboarding Journey -->
<section class="w-full py-space-3xl px-4 sm:px-8 bg-cream-canvas">
  <div class="max-w-container-max mx-auto">
    <div class="text-center max-w-2xl mx-auto mb-10">
      <span class="inline-block px-3 py-1 rounded-md bg-surface-container text-deep-forest font-label-sm text-label-sm font-semibold mb-2">
        <?= e(ps_text('सरल एवं पारदर्शी प्रक्रिया', 'Simple & Transparent Process')) ?>
      </span>
      <h2 class="font-headline-lg text-headline-lg text-deep-forest"><?= e(ps_text('स्वयंसेवक बनने की चार-चरणीय यात्रा', 'Four Steps to Become a Volunteer')) ?></h2>
      <p class="font-body-md text-body-md text-text-muted mt-2">
        <?= e(ps_text('आवेदन से लेकर ज़मीनी सेवा तक — हमारा तंत्र आपको पूर्ण सहयोग और मार्गदर्शन प्रदान करता है।', 'From application to field work — our network provides complete guidance.')) ?>
      </p>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 relative">
      <!-- Step 1 -->
      <div class="bg-surface-container-lowest rounded-xl p-5 shadow-sm border border-border-warm relative">
        <div class="w-10 h-10 rounded-full bg-primary text-on-primary font-title-lg flex items-center justify-center font-bold mb-4">
          १
        </div>
        <h4 class="font-title-md text-title-md text-deep-forest font-bold mb-1"><?= e(ps_text('प्रपत्र भरें', 'Fill Application')) ?></h4>
        <p class="font-body-sm text-body-sm text-text-muted">
          <?= e(ps_text('नीचे दिए गए सरल फॉर्म में अपनी रुचि, गाँव/कस्बा और समय की उपलब्धता दर्ज करें।', 'Enter your interests, village/town and time availability below.')) ?>
        </p>
      </div>

      <!-- Step 2 -->
      <div class="bg-surface-container-lowest rounded-xl p-5 shadow-sm border border-border-warm relative">
        <div class="w-10 h-10 rounded-full bg-primary text-on-primary font-title-lg flex items-center justify-center font-bold mb-4">
          २
        </div>
        <h4 class="font-title-md text-title-md text-deep-forest font-bold mb-1"><?= e(ps_text('परिचयात्मक संवाद', 'Introductory Contact')) ?></h4>
        <p class="font-body-sm text-body-sm text-text-muted">
          <?= e(ps_text('तहसील स्तर के स्वयंसेवक समन्वयक द्वारा WhatsApp या फोन पर सौहार्दपूर्ण स्वागत व मार्गदर्शन।', 'Welcome call/WhatsApp message from your local block volunteer coordinator.')) ?>
        </p>
      </div>

      <!-- Step 3 -->
      <div class="bg-surface-container-lowest rounded-xl p-5 shadow-sm border border-border-warm relative">
        <div class="w-10 h-10 rounded-full bg-primary text-on-primary font-title-lg flex items-center justify-center font-bold mb-4">
          ३
        </div>
        <h4 class="font-title-md text-title-md text-deep-forest font-bold mb-1"><?= e(ps_text('ग्रीन गैंग किट व बैज', 'Green Gang Badge')) ?></h4>
        <p class="font-body-sm text-body-sm text-text-muted">
          <?= e(ps_text('\'ग्रीन मॉर्निंग\' बैज, पौधा सुरक्षा पुस्तिका, सकोरा सामग्री और आपात संपर्क निर्देशिका की प्राप्ति।', 'Receive Green Morning badge, tree protection guide & emergency donor contacts.')) ?>
        </p>
      </div>

      <!-- Step 4 -->
      <div class="bg-surface-container-lowest rounded-xl p-5 shadow-sm border border-border-warm relative">
        <div class="w-10 h-10 rounded-full bg-secondary text-on-secondary font-title-lg flex items-center justify-center font-bold mb-4">
          ४
        </div>
        <h4 class="font-title-md text-title-md text-deep-forest font-bold mb-1"><?= e(ps_text('ज़मीनी सेवा आरंभ', 'Start Ground Service')) ?></h4>
        <p class="font-body-sm text-body-sm text-text-muted">
          <?= e(ps_text('अपने मोहल्ले, खेत या चौपाल में पौधारोपण, परिंदा जलपात्र अथवा सांस्कृतिक अभियान का शुभारम्भ।', 'Begin tree planting, bird feeding or cultural outreach in your area.')) ?>
        </p>
      </div>
    </div>
  </div>
</section>

<!-- Interactive Volunteer Registration Form Section -->
<section class="w-full bg-soft-meadow py-space-3xl px-4 sm:px-8 border-t border-border-warm" id="registration-form">
  <div class="max-w-4xl mx-auto">
    <div class="bg-surface-container-lowest rounded-2xl shadow-md p-6 sm:p-10 border border-border-warm">
      <!-- Form Header -->
      <div class="border-b border-border-warm pb-6 mb-8">
        <div class="flex flex-wrap items-center justify-between gap-3 mb-2">
          <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded bg-primary-container text-on-primary font-label-sm text-label-sm font-semibold">
            <span class="material-symbols-outlined text-[15px]">edit_note</span>
            <?= e(ps_text('निःशुल्क जनसेवा पंजीकरण २०२६', 'Free Volunteer Enrollment 2026')) ?>
          </span>
          <span class="font-label-sm text-label-sm text-text-muted flex items-center gap-1">
            <span class="material-symbols-outlined text-[15px] text-primary">lock</span>
            <?= e(ps_text('आपकी जानकारी पूर्णतः सुरक्षित है', 'Your details are strictly confidential')) ?>
          </span>
        </div>
        <h2 class="font-headline-lg text-headline-lg text-deep-forest">
          <?= e(ps_text('स्वयंसेवक सहभागिता प्रपत्र (Volunteer Enrollment Form)', 'Volunteer Registration Form')) ?>
        </h2>
        <p class="font-body-sm text-body-sm text-text-muted mt-1">
          <?= e(ps_text('कृपया अपनी सही जानकारी भरें ताकि आपके निकटतम क्षेत्र के ग्रीन गैंग समन्वयक आपसे संपर्क कर सकें।', 'Please enter your authentic details so your nearest Green Gang coordinator can reach out.')) ?>
        </p>
      </div>

      <!-- Form Body -->
      <form id="volunteerForm" method="post" action="<?= e(base_url('/volunteer')) ?>" enctype="multipart/form-data" class="space-y-6">
        <?= csrf_field() ?>
        <input type="hidden" name="form_type" value="volunteer">

        <!-- Row 1: Full Name & WhatsApp Number -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
          <div>
            <label for="fullName" class="block font-label-md text-label-md text-deep-forest font-semibold mb-2">
              <?= e(ps_text('पूरा नाम (Full Name)', 'Full Name')) ?> <span class="text-error">*</span>
            </label>
            <input type="text" id="fullName" name="full_name" required class="w-full px-4 py-3 rounded-xl border border-border-warm bg-pure-white text-on-surface font-body-md text-body-md focus:border-primary-container focus:outline-none focus:ring-2 focus:ring-fresh-sprout/20 transition-all">
          </div>
          <div>
            <label for="whatsappNumber" class="block font-label-md text-label-md text-deep-forest font-semibold mb-2">
              <?= e(ps_text('मोबाइल / WhatsApp नंबर', 'Mobile / WhatsApp Number')) ?> <span class="text-error">*</span>
            </label>
            <input type="tel" id="whatsappNumber" name="phone" required class="w-full px-4 py-3 rounded-xl border border-border-warm bg-pure-white text-on-surface font-body-md text-body-md focus:border-primary-container focus:outline-none focus:ring-2 focus:ring-fresh-sprout/20 transition-all">
          </div>
        </div>

        <!-- Row 2: Father Name & Email -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
          <div>
            <label for="fatherName" class="block font-label-md text-label-md text-deep-forest font-semibold mb-2">
              <?= e(ps_text('पिता / अभिभावक का नाम', 'Father / Guardian Name')) ?>
            </label>
            <input type="text" id="fatherName" name="father_name" class="w-full px-4 py-3 rounded-xl border border-border-warm bg-pure-white text-on-surface font-body-md text-body-md focus:border-primary-container focus:outline-none focus:ring-2 focus:ring-fresh-sprout/20 transition-all">
          </div>
          <div>
            <label for="emailAddress" class="block font-label-md text-label-md text-deep-forest font-semibold mb-2">
              <?= e(ps_text('ईमेल पता (Email Address)', 'Email Address')) ?> <span class="text-error">*</span>
            </label>
            <input type="email" id="emailAddress" name="email" required class="w-full px-4 py-3 rounded-xl border border-border-warm bg-pure-white text-on-surface font-body-md text-body-md focus:border-primary-container focus:outline-none focus:ring-2 focus:ring-fresh-sprout/20 transition-all">
          </div>
        </div>

        <!-- Row 3: Gender, DOB, Occupation -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
          <div>
            <label for="genderSelect" class="block font-label-md text-label-md text-deep-forest font-semibold mb-2">
              <?= e(ps_text('लिंग (Gender)', 'Gender')) ?>
            </label>
            <select id="genderSelect" name="gender" class="w-full px-4 py-3 rounded-xl border border-border-warm bg-pure-white text-on-surface font-body-md text-body-md focus:border-primary-container focus:outline-none focus:ring-2 focus:ring-fresh-sprout/20 transition-all">
              <option value="Male"><?= e(ps_text('पुरुष (Male)', 'Male')) ?></option>
              <option value="Female"><?= e(ps_text('महिला (Female)', 'Female')) ?></option>
              <option value="Other"><?= e(ps_text('अन्य (Other)', 'Other')) ?></option>
            </select>
          </div>
          <div>
            <label for="userDob" class="block font-label-md text-label-md text-deep-forest font-semibold mb-2">
              <?= e(ps_text('जन्म तिथि (Date of Birth)', 'Date of Birth')) ?>
            </label>
            <input type="date" id="userDob" name="dob" class="w-full px-4 py-3 rounded-xl border border-border-warm bg-pure-white text-on-surface font-body-md text-body-md focus:border-primary-container focus:outline-none focus:ring-2 focus:ring-fresh-sprout/20 transition-all">
          </div>
          <div>
            <label for="userOccupation" class="block font-label-md text-label-md text-deep-forest font-semibold mb-2">
              <?= e(ps_text('व्यवसाय / पेशा', 'Occupation')) ?>
            </label>
            <input type="text" id="userOccupation" name="occupation" class="w-full px-4 py-3 rounded-xl border border-border-warm bg-pure-white text-on-surface font-body-md text-body-md focus:border-primary-container focus:outline-none focus:ring-2 focus:ring-fresh-sprout/20 transition-all">
          </div>
        </div>

        <!-- Row 4: State, District, Pincode -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
          <div>
            <label for="stateSelect" class="block font-label-md text-label-md text-deep-forest font-semibold mb-2">
              <?= e(ps_text('राज्य (State)', 'State')) ?> <span class="text-error">*</span>
            </label>
            <select id="stateSelect" name="state" required class="w-full px-4 py-3 rounded-xl border border-border-warm bg-pure-white text-on-surface font-body-md text-body-md focus:border-primary-container focus:outline-none focus:ring-2 focus:ring-fresh-sprout/20 transition-all">
              <option value=""><?= e(ps_text('राज्य चुनें', 'Choose State')) ?></option>
              <?php foreach ($states as $st): ?>
                <option value="<?= e((string)$st['state_id']) ?>"><?= e($st['state_name']) ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div>
            <label for="districtSelect" class="block font-label-md text-label-md text-deep-forest font-semibold mb-2">
              <?= e(ps_text('जिला (District)', 'District')) ?> <span class="text-error">*</span>
            </label>
            <select id="districtSelect" name="district" disabled required class="w-full px-4 py-3 rounded-xl border border-border-warm bg-pure-white text-on-surface font-body-md text-body-md focus:border-primary-container focus:outline-none focus:ring-2 focus:ring-fresh-sprout/20 transition-all">
              <option value=""><?= e(ps_text('जिला चुनें', 'Choose District')) ?></option>
            </select>
          </div>
          <div>
            <label for="userPincode" class="block font-label-md text-label-md text-deep-forest font-semibold mb-2">
              <?= e(ps_text('पिनकोड (PIN Code)', 'PIN Code')) ?>
            </label>
            <input type="text" id="userPincode" name="pincode" inputmode="numeric" class="w-full px-4 py-3 rounded-xl border border-border-warm bg-pure-white text-on-surface font-body-md text-body-md focus:border-primary-container focus:outline-none focus:ring-2 focus:ring-fresh-sprout/20 transition-all">
          </div>
        </div>

        <!-- Selection: Domains of Contribution -->
        <div class="p-5 rounded-xl bg-soft-meadow border border-border-warm">
          <label class="block font-title-md text-title-md text-deep-forest font-bold mb-3">
            <?= e(ps_text('आप किस अभियान में सहभागिता करना चाहते हैं? (रुचि/कौशल)', 'Which initiatives interest you? (Interests & Skills)')) ?> <span class="text-error">*</span>
          </label>
          <input type="text" id="userInterests" name="interests" required class="w-full px-4 py-3 rounded-xl border border-border-warm bg-pure-white text-on-surface font-body-md text-body-md focus:border-primary-container focus:outline-none focus:ring-2 focus:ring-fresh-sprout/20 transition-all">
        </div>

        <!-- Selection: Time Availability -->
        <div class="p-5 rounded-xl bg-soft-meadow border border-border-warm">
          <label for="userAvailability" class="block font-title-md text-title-md text-deep-forest font-bold mb-3">
            <?= e(ps_text('समय की उपलब्धता (Time Availability)', 'Time Availability')) ?>
          </label>
          <select id="userAvailability" name="availability" class="w-full px-4 py-3 rounded-xl border border-border-warm bg-pure-white text-on-surface font-body-md text-body-md focus:border-primary-container focus:outline-none focus:ring-2 focus:ring-fresh-sprout/20 transition-all">
            <option value="Flexible"><?= e(ps_text('लचीला समय (Flexible Time)', 'Flexible')) ?></option>
            <option value="Weekends"><?= e(ps_text('सप्ताहांत (Saturday-Sunday)', 'Weekends')) ?></option>
            <option value="Weekdays"><?= e(ps_text('कार्यदिवस (Monday-Friday)', 'Weekdays')) ?></option>
            <option value="On-Call"><?= e(ps_text('आवश्यकतानुसार ऑन-कॉल (Emergency On-Call)', 'Emergency On-Call')) ?></option>
          </select>
        </div>

        <!-- Upload Passport Photo & Resume -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
          <div>
            <label for="userPhoto" class="block font-label-md text-label-md text-deep-forest font-semibold mb-2">
              <?= e(ps_text('पासपोर्ट साइज फोटो (Photo Upload)', 'Passport Photo')) ?>
            </label>
            <input type="file" id="userPhoto" name="photo" accept="image/*" class="w-full px-3 py-2 rounded-xl border border-border-warm bg-pure-white text-on-surface font-body-sm text-body-sm file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-label-sm file:font-semibold file:bg-primary-container file:text-on-primary hover:file:bg-deep-forest">
          </div>
          <div>
            <label for="userResume" class="block font-label-md text-label-md text-deep-forest font-semibold mb-2">
              <?= e(ps_text('रिज्यूमे / परिचय दस्तावेज़ (Optional Resume)', 'Optional Resume')) ?>
            </label>
            <input type="file" id="userResume" name="resume" accept=".pdf,.doc,.docx" class="w-full px-3 py-2 rounded-xl border border-border-warm bg-pure-white text-on-surface font-body-sm text-body-sm file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-label-sm file:font-semibold file:bg-soft-meadow file:text-deep-forest hover:file:bg-surface-container">
          </div>
        </div>

        <!-- Message / Motivation -->
        <div>
          <label for="userMessage" class="block font-label-md text-label-md text-deep-forest font-semibold mb-2">
            <?= e(ps_text('आप इस अभियान से क्यों जुड़ना चाहते हैं? (संदेश / विचार)', 'Message / Why do you want to join?')) ?>
          </label>
          <textarea id="userMessage" name="message" rows="3" class="w-full px-4 py-3 rounded-xl border border-border-warm bg-pure-white text-on-surface font-body-md text-body-md focus:border-primary-container focus:outline-none focus:ring-2 focus:ring-fresh-sprout/20 transition-all"></textarea>
        </div>

        <!-- Pledge Checkbox -->
        <div class="bg-tertiary-fixed/20 p-4 rounded-xl border border-tertiary-fixed/40">
          <label class="flex items-start gap-3 cursor-pointer">
            <input type="checkbox" required class="mt-1 w-5 h-5 rounded border-border-warm text-primary-container focus:ring-fresh-sprout/30 shrink-0">
            <span class="font-body-sm text-body-sm text-deep-forest leading-relaxed">
              <strong><?= e(ps_text('हमारा संकल्प:', 'Our Pledge:')) ?></strong> <?= e(ps_text('मैं \'ग्रीन मॉर्निंग\' की उदात्त भावना, निस्वार्थ समाजसेवा और पर्यावरण रक्षा के प्रति पूर्ण निष्ठावान रहने का वचन देता/देती हूँ।', 'I pledge commitment to Green Morning, selfless public service and environmental protection.')) ?>
            </span>
          </label>
        </div>

        <!-- Submit Button -->
        <div class="pt-2 flex flex-col sm:flex-row items-center gap-4">
          <button type="submit" class="w-full sm:w-auto px-8 py-3.5 rounded-xl font-title-md text-title-md font-bold shadow-md transition-all flex items-center justify-center gap-2 border-0 cursor-pointer" style="background-color: #14532d; color: #ffffff;">
            <span style="color: #ffffff;"><?= e(ps_text('स्वयंसेवक के रूप में पंजीकृत हों (Submit Application)', 'Submit Volunteer Application')) ?></span>
            <span class="material-symbols-outlined text-[20px]" style="color: #ffffff;">arrow_forward</span>
          </button>
          <span class="font-label-sm text-label-sm text-text-muted text-center sm:text-left">
            <?= e(ps_text('प्रदीप सारंग जन-अभियान सेल • बाराबंकी, उत्तर प्रदेश', 'Pradeep Sarang Volunteer Cell • Barabanki, UP')) ?>
          </span>
        </div>
      </form>
    </div>
  </div>
</section>

<!-- Volunteer Voices & Testimonials -->
<section class="w-full py-space-3xl px-4 sm:px-8 bg-cream-canvas">
  <div class="max-w-container-max mx-auto">
    <div class="text-center max-w-2xl mx-auto mb-10">
      <span class="inline-block px-3 py-1 rounded-md bg-surface-container text-deep-forest font-label-sm text-label-sm font-semibold mb-2">
        <?= e(ps_text('ज़मीनी साथियों के अनुभव', 'Volunteer Stories')) ?>
      </span>
      <h2 class="font-headline-lg text-headline-lg text-deep-forest"><?= e(ps_text('जो राह में साथ चले, वही परिवार बने', 'Together on the Path of Change')) ?></h2>
      <p class="font-body-md text-body-md text-text-muted mt-2">
        <?= e(ps_text('ग्रीन गैंग और जनसेवा अभियानों से जुड़े स्वयंसेवकों की ज़ुबानी, उनकी प्रेरणा की सच्ची कहानियाँ।', 'Real stories of volunteers actively serving across Barabanki.')) ?>
      </p>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
      <!-- Testimonial 1 -->
      <div class="bg-surface-container-lowest rounded-xl p-6 shadow-sm border border-border-warm flex flex-col justify-between">
        <div>
          <div class="flex items-center gap-1 text-tertiary mb-3">
            <span class="material-symbols-outlined text-[18px]">star</span>
            <span class="material-symbols-outlined text-[18px]">star</span>
            <span class="material-symbols-outlined text-[18px]">star</span>
            <span class="material-symbols-outlined text-[18px]">star</span>
            <span class="material-symbols-outlined text-[18px]">star</span>
          </div>
          <p class="font-quote-editorial text-body-md text-deep-forest italic leading-relaxed mb-6">
            <?= ps_text('"कॉलेज के बाद रविवार को जब हम सतरिख मार्ग पर रोपे गए पौधों की रखवाली और बाड़ लगाते हैं, तो दिल को गहरा सुकून मिलता है कि हम अपनी धरती के लिए कुछ कर रहे हैं।"', '"Protecting saplings on Satrikh road every Sunday gives immense joy that we are serving our mother earth."') ?>
          </p>
        </div>
        <div class="flex items-center gap-3 pt-4 border-t border-border-warm">
          <div class="w-10 h-10 rounded-full bg-primary-container text-on-primary flex items-center justify-center font-bold text-label-md">
            <?= e(ps_text('रा.व.', 'R.V.')) ?>
          </div>
          <div>
            <h4 class="font-title-md text-title-md text-deep-forest font-bold leading-tight"><?= e(ps_text('राहुल वर्मा', 'Rahul Verma')) ?></h4>
            <span class="font-label-sm text-label-sm text-text-muted"><?= e(ps_text('युवा समन्वयक, कमरावां (बाराबंकी)', 'Youth Coordinator, Kamrawan')) ?></span>
          </div>
        </div>
      </div>
      <!-- Testimonial 2 -->
      <div class="bg-surface-container-lowest rounded-xl p-6 shadow-sm border border-border-warm flex flex-col justify-between">
        <div>
          <div class="flex items-center gap-1 text-tertiary mb-3">
            <span class="material-symbols-outlined text-[18px]">star</span>
            <span class="material-symbols-outlined text-[18px]">star</span>
            <span class="material-symbols-outlined text-[18px]">star</span>
            <span class="material-symbols-outlined text-[18px]">star</span>
            <span class="material-symbols-outlined text-[18px]">star</span>
          </div>
          <p class="font-quote-editorial text-body-md text-deep-forest italic leading-relaxed mb-6">
            <?= ps_text('"सकोरा वितरण अभियान से जुड़ने के बाद मेरी पूरी गली के लोग अब अपनी-अपनी छतों पर पक्षियों के लिए पानी व दाना रखने लगे हैं। नन्हे परिंदों की चहचहाहट ही हमारा पारितोषिक है।"', '"After joining Sakora distribution, our entire lane puts water bowls on roofs for birds. Chirping birds are our reward."') ?>
          </p>
        </div>
        <div class="flex items-center gap-3 pt-4 border-t border-border-warm">
          <div class="w-10 h-10 rounded-full bg-secondary-fixed text-secondary flex items-center justify-center font-bold text-label-md">
            <?= e(ps_text('सु.या.', 'S.Y.')) ?>
          </div>
          <div>
            <h4 class="font-title-md text-title-md text-deep-forest font-bold leading-tight"><?= e(ps_text('सुमनलता यादव', 'Sumanlata Yadav')) ?></h4>
            <span class="font-label-sm text-label-sm text-text-muted"><?= e(ps_text('परिंदा सहेली, नगर क्षेत्र बाराबंकी', 'Bird Conservation Lead, Barabanki')) ?></span>
          </div>
        </div>
      </div>
      <!-- Testimonial 3 -->
      <div class="bg-surface-container-lowest rounded-xl p-6 shadow-sm border border-border-warm flex flex-col justify-between">
        <div>
          <div class="flex items-center gap-1 text-tertiary mb-3">
            <span class="material-symbols-outlined text-[18px]">star</span>
            <span class="material-symbols-outlined text-[18px]">star</span>
            <span class="material-symbols-outlined text-[18px]">star</span>
            <span class="material-symbols-outlined text-[18px]">star</span>
            <span class="material-symbols-outlined text-[18px]">star</span>
          </div>
          <p class="font-quote-editorial text-body-md text-deep-forest italic leading-relaxed mb-6">
            <?= ps_text('"सारंग जी के साथ अवधी चौपालों में जाना और बुजुर्गों के लोक संस्मरणों को सहेजना एक नई चेतना जगाता है। हमारी भाषा ही हमारी अस्मिता है।"', '"Attending Awadhi chaupals with Shri Sarang & documenting elder folk wisdom awakens cultural pride."') ?>
          </p>
        </div>
        <div class="flex items-center gap-3 pt-4 border-t border-border-warm">
          <div class="w-10 h-10 rounded-full bg-tertiary-fixed text-tertiary flex items-center justify-center font-bold text-label-md">
            <?= e(ps_text('अ.अ.', 'A.A.')) ?>
          </div>
          <div>
            <h4 class="font-title-md text-title-md text-deep-forest font-bold leading-tight"><?= e(ps_text('डॉ. अमित अवस्थी', 'Dr. Amit Awasthi')) ?></h4>
            <span class="font-label-sm text-label-sm text-text-muted"><?= e(ps_text('सांस्कृतिक शोधार्थी व भाषा दूत', 'Cultural Scholar')) ?></span>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- FAQ Section (Accordions) -->
<section class="w-full bg-soft-meadow py-space-3xl px-4 sm:px-8 border-t border-border-warm">
  <div class="max-w-container-editorial mx-auto">
    <div class="text-center mb-10">
      <span class="inline-block px-3 py-1 rounded-md bg-surface-container text-deep-forest font-label-sm text-label-sm font-semibold mb-2">
        <?= e(ps_text('शंका-समाधान', 'FAQ')) ?>
      </span>
      <h2 class="font-headline-lg text-headline-lg text-deep-forest"><?= e(ps_text('अक्सर पूछे जाने वाले प्रश्न (FAQ)', 'Frequently Asked Questions')) ?></h2>
    </div>
    <div class="space-y-4" id="faq-accordion-volunteer">
      <!-- FAQ 1 -->
      <div class="bg-surface-container-lowest rounded-xl border border-border-warm overflow-hidden shadow-sm">
        <button type="button" onclick="toggleVolunteerFaq('vfaq-1')" class="w-full p-5 text-left flex items-center justify-between gap-4 hover:bg-soft-meadow transition-colors">
          <span class="font-title-md text-title-md text-deep-forest font-bold">
            <?= e(ps_text('क्या स्वयंसेवक बनने के लिए बाराबंकी का निवासी होना अनिवार्य है?', 'Is it mandatory to live in Barabanki to become a volunteer?')) ?>
          </span>
          <span id="icon-vfaq-1" class="material-symbols-outlined text-[22px] text-text-muted transition-transform">expand_more</span>
        </button>
        <div id="vfaq-1" class="hidden px-5 pb-5 pt-1 text-on-surface-variant font-body-md text-body-md border-t border-border-warm bg-soft-meadow/50 leading-relaxed">
          <?= e(ps_text('नहीं। यद्यपि हमारे प्रत्यक्ष मैदानी अभियान बाराबंकी और अवध क्षेत्र में केंद्रित हैं, किंतु डिजिटल संवाद, अवधी साहित्य संकलन और \'परिंदा संरक्षण\' (अपने घर/छत पर सकोरा लगाना) जैसे कार्य आप किसी भी शहर या गाँव से संचालित कर सकते हैं।', 'No! While ground drives focus on Barabanki, you can join bird protection and digital/literary drives from anywhere.')) ?>
        </div>
      </div>
      <!-- FAQ 2 -->
      <div class="bg-surface-container-lowest rounded-xl border border-border-warm overflow-hidden shadow-sm">
        <button type="button" onclick="toggleVolunteerFaq('vfaq-2')" class="w-full p-5 text-left flex items-center justify-between gap-4 hover:bg-soft-meadow transition-colors">
          <span class="font-title-md text-title-md text-deep-forest font-bold">
            <?= e(ps_text('क्या इस अभियान से जुड़ने का कोई सदस्यता शुल्क है?', 'Is there any membership fee to join?')) ?>
          </span>
          <span id="icon-vfaq-2" class="material-symbols-outlined text-[22px] text-text-muted transition-transform">expand_more</span>
        </button>
        <div id="vfaq-2" class="hidden px-5 pb-5 pt-1 text-on-surface-variant font-body-md text-body-md border-t border-border-warm bg-soft-meadow/50 leading-relaxed">
          <?= e(ps_text('बिल्कुल नहीं। यह शत-प्रतिशत निःशुल्क, लोक-सरोकारी और जनहितैषी अभियान है। यहाँ किसी भी प्रकार का आर्थिक अंशदान अनिवार्य नहीं है; आपका समय, निष्ठा और सेवाभाव ही सबसे बड़ा योगदान है।', 'None at all. 100% free public initiative. Your time and service spirit is the only contribution.')) ?>
        </div>
      </div>
      <!-- FAQ 3 -->
      <div class="bg-surface-container-lowest rounded-xl border border-border-warm overflow-hidden shadow-sm">
        <button type="button" onclick="toggleVolunteerFaq('vfaq-3')" class="w-full p-5 text-left flex items-center justify-between gap-4 hover:bg-soft-meadow transition-colors">
          <span class="font-title-md text-title-md text-deep-forest font-bold">
            <?= e(ps_text('क्या कॉलेज के विद्यार्थियों को सामाजिक सेवा प्रमाण पत्र प्राप्त होता है?', 'Do students get social service experience certificates?')) ?>
          </span>
          <span id="icon-vfaq-3" class="material-symbols-outlined text-[22px] text-text-muted transition-transform">expand_more</span>
        </button>
        <div id="vfaq-3" class="hidden px-5 pb-5 pt-1 text-on-surface-variant font-body-md text-body-md border-t border-border-warm bg-soft-meadow/50 leading-relaxed">
          <?= e(ps_text('हाँ। कम से कम ३० घंटे या किसी विशेष अभियान (जैसे तुलसी जयंती पखवाड़ा, हरियाली पखवाड़ा, या रक्त सेवा) में सक्रिय सहभागिता निभाने वाले छात्र-छात्राओं को प्रदीप सारंग जी के हस्ताक्षरयुक्त सामाजिक अनुभव प्रमाण पत्र प्रदान किया जाता है।', 'Yes! Students participating actively receive a signed social service experience certificate.')) ?>
        </div>
      </div>
      <!-- FAQ 4 -->
      <div class="bg-surface-container-lowest rounded-xl border border-border-warm overflow-hidden shadow-sm">
        <button type="button" onclick="toggleVolunteerFaq('vfaq-4')" class="w-full p-5 text-left flex items-center justify-between gap-4 hover:bg-soft-meadow transition-colors">
          <span class="font-title-md text-title-md text-deep-forest font-bold">
            <?= e(ps_text('\'ग्रीन गैंग\' की विशेष पहचान और दिनचर्या क्या है?', 'What is the Green Gang routine & identity?')) ?>
          </span>
          <span id="icon-vfaq-4" class="material-symbols-outlined text-[22px] text-text-muted transition-transform">expand_more</span>
        </button>
        <div id="vfaq-4" class="hidden px-5 pb-5 pt-1 text-on-surface-variant font-body-md text-body-md border-t border-border-warm bg-soft-meadow/50 leading-relaxed">
          <?= e(ps_text('ग्रीन गैंग के सदस्य प्रभात में परस्पर मिलते समय \'गुड मॉर्निंग\' की जगह \'ग्रीन मॉर्निंग!\' का उद्घोष करते हैं। उनका मुख्य धर्म अपने आसपास कम से कम पाँच नए पौधों को जीवित रखना और एक बेजुबान जीव के दाने-पानी की चिंता करना है।', 'Green Gang members greet with \'Green Morning!\' and commit to keeping 5 trees alive and feeding local birds.')) ?>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Direct Coordinator Contact & Cross-Links Footer Banner -->
<section class="w-full py-space-2xl px-4 sm:px-8 border-t border-border-warm bg-cream-canvas">
  <div class="max-w-container-max mx-auto">
    <div class="bg-surface-container rounded-2xl p-6 sm:p-8 flex flex-col md:flex-row items-center justify-between gap-6">
      <div class="flex items-center gap-4">
        <div class="w-12 h-12 rounded-xl bg-deep-forest text-pure-white flex items-center justify-center shrink-0">
          <span class="material-symbols-outlined text-[26px]">support_agent</span>
        </div>
        <div>
          <h4 class="font-title-md text-title-md text-deep-forest font-bold"><?= e(ps_text('सीधे स्वयंसेवक समन्वयक से बात करें', 'Speak Directly with Volunteer Coordinator')) ?></h4>
          <p class="font-body-sm text-body-sm text-text-muted">
            <?= e(ps_text('किसी भी प्रश्न, सामूहिक पंजीकरण या स्कूल-कॉलेज ड्राइव हेतु संपर्क करें।', 'Contact for group enrollment, school/college drives or questions.')) ?>
          </p>
        </div>
      </div>
      <div class="flex flex-wrap items-center gap-4">
        <a href="tel:<?= e(preg_replace('/[^0-9+]/', '', $contactPhone)) ?>" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-lg bg-surface-container-lowest text-deep-forest font-label-md text-label-md font-bold shadow-sm hover:bg-pure-white transition-colors">
          <span class="material-symbols-outlined text-[18px] text-primary">call</span>
          <span><?= e($contactPhone) ?></span>
        </a>
        <a href="mailto:<?= e($contactEmail) ?>" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-lg bg-surface-container-lowest text-deep-forest font-label-md text-label-md font-bold shadow-sm hover:bg-pure-white transition-colors">
          <span class="material-symbols-outlined text-[18px] text-secondary">mail</span>
          <span><?= e($contactEmail) ?></span>
        </a>
        <a href="#registration-form" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-lg bg-primary-container text-on-primary font-label-md text-label-md font-bold hover:bg-deep-forest transition-colors shadow-sm">
          <span><?= e(ps_text('पंजीकरण प्रपत्र पर जाएँ', 'Go to Form')) ?></span>
          <span class="material-symbols-outlined text-[16px]">arrow_upward</span>
        </a>
      </div>
    </div>
  </div>
</section>
</div>

<script>
  // State & City Dynamic Dropdown AJAX Handler
  document.addEventListener('DOMContentLoaded', () => {
    const s = document.getElementById('stateSelect');
    const d = document.getElementById('districtSelect');
    s?.addEventListener('change', async () => {
      d.innerHTML = '<option value=""><?= e(ps_text('जिला चुनें', 'Choose district')) ?></option>';
      d.disabled = true;
      if (!s.value) return;
      try {
        const r = await fetch('<?= e(base_url('/api/cities')) ?>?state_id=' + encodeURIComponent(s.value));
        const j = await r.json();
        if (j.status === 'success') {
          j.data.forEach(c => d.add(new Option(c.city_name, c.city_name)));
          d.disabled = !j.data.length;
        }
      } catch {
        d.disabled = true;
      }
    });
  });

  function selectPillar(pillarName) {
    const input = document.getElementById('userInterests');
    if (input) {
      input.value = pillarName;
      const formElem = document.getElementById('registration-form');
      if (formElem) {
        formElem.scrollIntoView({ behavior: 'smooth' });
      }
    }
  }

  function toggleVolunteerFaq(id) {
    const el = document.getElementById(id);
    const icon = document.getElementById('icon-' + id);
    if (!el) return;
    if (el.classList.contains('hidden')) {
      el.classList.remove('hidden');
      if (icon) icon.style.transform = 'rotate(180deg)';
    } else {
      el.classList.add('hidden');
      if (icon) icon.style.transform = 'rotate(0deg)';
    }
  }
</script>
