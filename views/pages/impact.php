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
        <span class="text-deep-forest font-semibold"><?= e(ps_text('सामुदायिक प्रभाव (Community Impact)', 'Community Impact')) ?></span>
      </nav>

      <!-- Badge & Main Title -->
      <div class="max-w-4xl">
        <div class="inline-flex items-center gap-2 bg-primary-fixed/40 text-deep-forest px-3.5 py-1 rounded-full font-label-sm text-label-sm mb-space-sm border border-border-warm font-semibold">
          <span class="material-symbols-outlined text-[15px] text-primary-container" style="font-variation-settings: 'FILL' 1;">analytics</span>
          <span><?= e(ps_text('100% पारदर्शी एवं प्रत्यक्ष ज़मीनी प्रभाव (1987 से आज तक)', '100% Transparent Grassroots Impact (1987 — Present)')) ?></span>
        </div>
        <h1 class="font-display-hero text-headline-lg md:text-display-hero text-deep-forest leading-tight tracking-tight font-bold">
          <?= e(ps_text('चार दशकों की साधना: पारदर्शी और सजीव सामुदायिक प्रभाव', 'Grassroots Impact & Ground Transformation Across Awadh')) ?>
        </h1>
        <p class="font-body-lg text-body-lg text-text-muted mt-space-sm max-w-3xl leading-relaxed">
          <?= e(ps_text('बाराबंकी और अवध अंचल के गांवों, चौपालों और विद्यालयों में 50,000+ पौधरोपण, 10,000+ परिंदा जल-सकोरा सेवा और जन-जागरूकता का प्रामाणिक आंकड़ेवार लेखा-जोखा।', 'Measurable ground-level impact across environment, bird conservation, Awadhi culture, and public health.')) ?>
        </p>
      </div>
    </div>
  </section>

  <!-- 5 High-Impact Metric Summary Ribbon -->
  <section class="w-full bg-deep-forest text-pure-white py-space-2xl">
    <div class="max-w-container-max mx-auto px-4 sm:px-8">
      <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-6 text-center">
        <!-- Metric 1 -->
        <div class="flex flex-col p-5 rounded-2xl bg-surface-container-low/10 border border-surface-container-high/15">
          <span class="material-symbols-outlined text-fresh-sprout text-[36px] mb-2 mx-auto">forest</span>
          <span class="font-headline-lg text-headline-lg text-primary-fixed leading-tight font-bold">50,000+</span>
          <span class="font-title-md text-title-md text-surface-container-high font-semibold mt-1"><?= e(ps_text('पौधरोपण व संरक्षण', 'Trees Planted')) ?></span>
          <span class="font-label-sm text-label-sm text-surface-container-high/80 mt-1"><?= e(ps_text('85% से अधिक जीवित दर', '85%+ Survival Rate')) ?></span>
        </div>

        <!-- Metric 2 -->
        <div class="flex flex-col p-5 rounded-2xl bg-surface-container-low/10 border border-surface-container-high/15">
          <span class="material-symbols-outlined text-tertiary-fixed text-[36px] mb-2 mx-auto">nest_cam_wired_stand</span>
          <span class="font-headline-lg text-headline-lg text-tertiary-fixed leading-tight font-bold">10,000+</span>
          <span class="font-title-md text-title-md text-surface-container-high font-semibold mt-1"><?= e(ps_text('परिंदा जल-सकोरे', 'Water Bowls')) ?></span>
          <span class="font-label-sm text-label-sm text-surface-container-high/80 mt-1"><?= e(ps_text('भीषण ग्रीष्म में जलदान', 'Summer Bird Relief')) ?></span>
        </div>

        <!-- Metric 3 -->
        <div class="flex flex-col p-5 rounded-2xl bg-surface-container-low/10 border border-surface-container-high/15">
          <span class="material-symbols-outlined text-secondary-fixed text-[36px] mb-2 mx-auto">cottage</span>
          <span class="font-headline-lg text-headline-lg text-secondary-fixed leading-tight font-bold">150+</span>
          <span class="font-title-md text-title-md text-surface-container-high font-semibold mt-1"><?= e(ps_text('ग्राम चौपालें व पंचायतें', 'Villages Reached')) ?></span>
          <span class="font-label-sm text-label-sm text-surface-container-high/80 mt-1"><?= e(ps_text('बाराबंकी व फैज़ाबाद अंचल', 'Barabanki & Ayodhya')) ?></span>
        </div>

        <!-- Metric 4 -->
        <div class="flex flex-col p-5 rounded-2xl bg-surface-container-low/10 border border-surface-container-high/15">
          <span class="material-symbols-outlined text-primary-fixed text-[36px] mb-2 mx-auto">groups</span>
          <span class="font-headline-lg text-headline-lg text-primary-fixed leading-tight font-bold">5,000+</span>
          <span class="font-title-md text-title-md text-surface-container-high font-semibold mt-1"><?= e(ps_text('ग्रीन व परिंदा मित्र', 'Active Volunteers')) ?></span>
          <span class="font-label-sm text-label-sm text-surface-container-high/80 mt-1"><?= e(ps_text('नियमित दाना-पानी संकल्प', 'Daily Bird Care Pledges')) ?></span>
        </div>

        <!-- Metric 5 -->
        <div class="flex flex-col p-5 rounded-2xl bg-surface-container-low/10 border border-surface-container-high/15 col-span-2 sm:col-span-1 lg:col-span-1">
          <span class="material-symbols-outlined text-tertiary-fixed text-[36px] mb-2 mx-auto">workspace_premium</span>
          <span class="font-headline-lg text-headline-lg text-tertiary-fixed leading-tight font-bold">100+</span>
          <span class="font-title-md text-title-md text-surface-container-high font-semibold mt-1"><?= e(ps_text('राष्ट्रीय व राज्य सम्मान', 'Awards & Honors')) ?></span>
          <span class="font-label-sm text-label-sm text-surface-container-high/80 mt-1"><?= e(ps_text('राजभवन व शासन प्रशस्ति', 'Govt & State Citations')) ?></span>
        </div>
      </div>
    </div>
  </section>

  <!-- Detailed Impact Pillars Section -->
  <section class="w-full bg-cream-canvas py-space-3xl border-b border-border-warm">
    <div class="max-w-container-max mx-auto px-4 sm:px-8">
      <div class="text-center max-w-3xl mx-auto mb-space-xl">
        <span class="font-label-sm text-label-sm text-secondary tracking-widest font-bold uppercase"><?= e(ps_text('चार प्रमुख आयाम', 'Four Core Pillars')) ?></span>
        <h2 class="font-headline-lg text-headline-md md:text-headline-lg text-deep-forest font-bold mt-1">
          <?= e(ps_text('क्षेत्रवार सजीव बदलाव एवं दीर्घकालिक प्रभाव', 'Domain-Wise Grassroots Transformation')) ?>
        </h2>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <!-- Pillar 1: Environment -->
        <div class="bg-pure-white rounded-3xl p-6 sm:p-8 shadow-sm border border-border-warm hover:shadow-md transition-all flex flex-col justify-between">
          <div>
            <div class="w-12 h-12 rounded-2xl bg-primary-fixed/40 text-primary-container flex items-center justify-center mb-5 border border-border-warm">
              <span class="material-symbols-outlined text-[28px]">forest</span>
            </div>
            <h3 class="font-headline-sm text-headline-sm text-deep-forest font-bold mb-3">
              1. <?= e(ps_text('पर्यावरण संवर्धन व \'ग्रीन गैंग\' आंदोलन', 'Environment & Green Gang Revolution')) ?>
            </h3>
            <p class="font-body-md text-body-md text-on-surface-variant leading-relaxed mb-4">
              <?= e(ps_text('5 जून 2019 से स्थापित \'ग्रीन गैंग\' के माध्यम से जनपद बाराबंकी के 150 से अधिक गांवों में 50,000 बरगद, पीपल, नीम और पाकड़ के वृक्षों का रोपण किया गया। अभिवादन में \'ग्रीन मॉर्निंग\' का संस्कार अब विद्यालयों व चौपालों की जीवनशैली बन चुका है।', 'Planted over 50,000 native shade trees across 150+ villages in Barabanki. Instituted the Green Morning greeting in schools and village councils.')) ?>
            </p>
            <div class="space-y-2 bg-soft-meadow p-4 rounded-xl border border-border-warm font-body-sm text-body-sm text-deep-forest">
              <div class="flex items-center gap-2"><span class="material-symbols-outlined text-primary-container text-[18px]">check_circle</span> <span><strong>85%+</strong> <?= e(ps_text('वृक्ष जीवित दर (सुरक्षा ट्री-गार्ड)', 'Tree Survival Rate')) ?></span></div>
              <div class="flex items-center gap-2"><span class="material-symbols-outlined text-primary-container text-[18px]">check_circle</span> <span><strong>100+</strong> <?= e(ps_text('स्कूलों में \'ग्रीन मॉर्निंग\' दैनिक संस्कार', 'Schools Practicing Green Morning')) ?></span></div>
            </div>
          </div>
        </div>

        <!-- Pillar 2: Bird Conservation -->
        <div class="bg-pure-white rounded-3xl p-6 sm:p-8 shadow-sm border border-border-warm hover:shadow-md transition-all flex flex-col justify-between">
          <div>
            <div class="w-12 h-12 rounded-2xl bg-tertiary-fixed text-tertiary flex items-center justify-center mb-5 border border-border-warm">
              <span class="material-symbols-outlined text-[28px]">nest_cam_wired_stand</span>
            </div>
            <h3 class="font-headline-sm text-headline-sm text-deep-forest font-bold mb-3">
              2. <?= e(ps_text('परिंदा व वन्यजीव संरक्षण अभियान', 'Parinda & Bird Conservation Drive')) ?>
            </h3>
            <p class="font-body-md text-body-md text-on-surface-variant leading-relaxed mb-4">
              <?= e(ps_text('ग्रीष्म ऋतु में पक्षियों के जीवन की रक्षा हेतु 10,000 से अधिक मिट्टी के सकोरे व दाना पात्र वितरित किए गए। 2016 में उत्तर प्रदेश शासन के वन मंत्री द्वारा \'वन्य जीव संरक्षण विशिष्ट प्रशस्ति पत्र\' से अलंकृत।', 'Distributed 10,000+ clay water bowls and grain feeders. Honored with UP State Wildlife Conservation Citation.')) ?>
            </p>
            <div class="space-y-2 bg-soft-meadow p-4 rounded-xl border border-border-warm font-body-sm text-body-sm text-deep-forest">
              <div class="flex items-center gap-2"><span class="material-symbols-outlined text-tertiary text-[18px]">check_circle</span> <span><strong>10,000+</strong> <?= e(ps_text('मिट्टी के सकोरे छतों पर स्थापित', 'Water Bowls Installed')) ?></span></div>
              <div class="flex items-center gap-2"><span class="material-symbols-outlined text-tertiary text-[18px]">check_circle</span> <span><strong>500+</strong> <?= e(ps_text('काष्ठ गौरैया घोंसले वितरित', 'Wooden Sparrow Nests Installed')) ?></span></div>
            </div>
          </div>
        </div>

        <!-- Pillar 3: Awadhi Literature -->
        <div class="bg-pure-white rounded-3xl p-6 sm:p-8 shadow-sm border border-border-warm hover:shadow-md transition-all flex flex-col justify-between">
          <div>
            <div class="w-12 h-12 rounded-2xl bg-secondary-fixed text-secondary flex items-center justify-center mb-5 border border-border-warm">
              <span class="material-symbols-outlined text-[28px]">auto_stories</span>
            </div>
            <h3 class="font-headline-sm text-headline-sm text-deep-forest font-bold mb-3">
              3. <?= e(ps_text('अवधी भाषा, साहित्य व लोक-सांस्कृतिक चेतना', 'Awadhi Language & Heritage Protection')) ?>
            </h3>
            <p class="font-body-md text-body-md text-on-surface-variant leading-relaxed mb-4">
              <?= e(ps_text('अवधी भाषा के संरक्षण हेतु संस्मरण संकलन \'झरिहख\', 151 छन्दबद्ध कुंडलियों का ग्रन्थ \'सारंग-हुण्डलियाँ\' तथा प्रतिवर्ष 16 से 31 अगस्त तक आयोजित \'तुलसी जयंती पखवारा\'। जनकवि बंशीधर शुक्ल व तुलसी सम्मान से अलंकृत।', 'Author of Awadhi memoirs Jharihakh and 151 Sarang Kundaliyan poetic verses. Organizer of annual Tulsi Jayanti Pakhwara.')) ?>
            </p>
            <div class="space-y-2 bg-soft-meadow p-4 rounded-xl border border-border-warm font-body-sm text-body-sm text-deep-forest">
              <div class="flex items-center gap-2"><span class="material-symbols-outlined text-secondary text-[18px]">check_circle</span> <span><strong>151</strong> <?= e(ps_text('अवधी कुंडलियाँ एवं काव्य ग्रन्थ', 'Awadhi Poetic Verses')) ?></span></div>
              <div class="flex items-center gap-2"><span class="material-symbols-outlined text-secondary text-[18px]">check_circle</span> <span><strong>25+</strong> <?= e(ps_text('वार्षिक तुलसी जयंती पखवारा गोष्ठियाँ', 'Annual Tulsi Pakhwara Meets')) ?></span></div>
            </div>
          </div>
        </div>

        <!-- Pillar 4: Public Health & Disaster Relief -->
        <div class="bg-pure-white rounded-3xl p-6 sm:p-8 shadow-sm border border-border-warm hover:shadow-md transition-all flex flex-col justify-between">
          <div>
            <div class="w-12 h-12 rounded-2xl bg-surface-container-highest text-deep-forest flex items-center justify-center mb-5 border border-border-warm">
              <span class="material-symbols-outlined text-[28px]">medical_services</span>
            </div>
            <h3 class="font-headline-sm text-headline-sm text-deep-forest font-bold mb-3">
              4. <?= e(ps_text('लोक स्वास्थ्य, रक्तदान व कोरोना योद्धा सेवा', 'Blood Donation & Crisis Disaster Relief')) ?>
            </h3>
            <p class="font-body-md text-body-md text-on-surface-variant leading-relaxed mb-4">
              <?= e(ps_text('सैकड़ों रक्तदान शिविरों का आयोजन व रेडक्रॉस सोसाइटी सम्मान। 2020 की वैश्विक महामारी में अग्रिम मोर्चे पर रहकर ग्रामीण असहायों को भोजन, दवा, मास्क वितरण एवं आपातकालीन राहत।', 'Organized blood donation camps. Conferred Red Cross Award and Corona Warrior Emergency Relief Citation.')) ?>
            </p>
            <div class="space-y-2 bg-soft-meadow p-4 rounded-xl border border-border-warm font-body-sm text-body-sm text-deep-forest">
              <div class="flex items-center gap-2"><span class="material-symbols-outlined text-primary-container text-[18px]">check_circle</span> <span><strong>100+</strong> <?= e(ps_text('रक्तदान शिविर व आपातकालीन रक्त सहायता', 'Blood Donation Drives')) ?></span></div>
              <div class="flex items-center gap-2"><span class="material-symbols-outlined text-primary-container text-[18px]">check_circle</span> <span><strong>2020</strong> <?= e(ps_text('कोरोना योद्धा विशिष्ट अलंकरण', 'Corona Warrior Citation')) ?></span></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Before vs After Transformation Case Study -->
  <section class="w-full bg-soft-meadow py-space-3xl border-b border-border-warm">
    <div class="max-w-container-max mx-auto px-4 sm:px-8">
      <div class="text-center max-w-3xl mx-auto mb-space-xl">
        <span class="font-label-sm text-label-sm text-secondary tracking-widest font-bold uppercase"><?= e(ps_text('प्रत्यक्ष परिवर्तन अध्ययन', 'Transformation Case Study')) ?></span>
        <h2 class="font-headline-lg text-headline-md md:text-headline-lg text-deep-forest font-bold mt-1">
          <?= e(ps_text('ग्राम कमरावाँ एवं बाराबंकी में आए सजीव बदलाव का तुलनात्मक ब्योरा', 'Ground Transformation in Village Kamrawan & Barabanki')) ?>
        </h2>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <!-- Before -->
        <div class="bg-pure-white rounded-3xl p-6 sm:p-8 shadow-sm border border-border-warm flex flex-col justify-between">
          <div>
            <div class="inline-flex items-center gap-2 bg-error-container text-error px-3.5 py-1 rounded-full font-label-sm text-label-sm font-bold mb-4">
              <span class="material-symbols-outlined text-[16px]">history</span>
              <span><?= e(ps_text('पूर्व की स्थिति (1987 से पूर्व)', 'Before 1987')) ?></span>
            </div>
            <ul class="space-y-3 font-body-md text-body-md text-on-surface-variant">
              <li class="flex items-start gap-2.5">
                <span class="material-symbols-outlined text-error text-[20px] mt-0.5">close</span>
                <span><?= e(ps_text('ग्रामीण पगडंडियों और सड़कों के किनारे छायादार वृक्षों का अभाव।', 'Lack of shade trees along rural trails and village roads.')) ?></span>
              </li>
              <li class="flex items-start gap-2.5">
                <span class="material-symbols-outlined text-error text-[20px] mt-0.5">close</span>
                <span><?= e(ps_text('गर्मी के दिनों में पक्षियों के लिए पीने का पानी न होने से भारी मृत्यु-दर।', 'High bird mortality during peak summer heatwaves due to lack of water.')) ?></span>
              </li>
              <li class="flex items-start gap-2.5">
                <span class="material-symbols-outlined text-error text-[20px] mt-0.5">close</span>
                <span><?= e(ps_text('अवधी लोक-साहित्य और ग्रामीण कहावतों का लुप्तप्राय होना।', 'Fading away of Awadhi folklore, memoirs, and traditional proverbs.')) ?></span>
              </li>
            </ul>
          </div>
        </div>

        <!-- After -->
        <div class="bg-pure-white rounded-3xl p-6 sm:p-8 shadow-sm border border-border-warm flex flex-col justify-between">
          <div>
            <div class="inline-flex items-center gap-2 bg-primary-fixed/40 text-primary-container px-3.5 py-1 rounded-full font-label-sm text-label-sm font-bold mb-4 border border-border-warm">
              <span class="material-symbols-outlined text-[16px]">verified</span>
              <span><?= e(ps_text('वर्तमान सजीव बदलाव (2026)', 'Current Transformation (2026)')) ?></span>
            </div>
            <ul class="space-y-3 font-body-md text-body-md text-deep-forest font-medium">
              <li class="flex items-start gap-2.5">
                <span class="material-symbols-outlined text-primary-container text-[20px] mt-0.5">check_circle</span>
                <span><?= e(ps_text('50,000+ सुरक्षित बरगद, पीपल व नीम वृक्षों से लहलहाते हरित गलियारे।', '50,000+ thriving Banyan, Peepal, and Neem shade corridors.')) ?></span>
              </li>
              <li class="flex items-start gap-2.5">
                <span class="material-symbols-outlined text-primary-container text-[20px] mt-0.5">check_circle</span>
                <span><?= e(ps_text('10,000+ सकोरे स्थापित; 5,000+ पंजीकृत \'परिंदा मित्र\' रोज पानी भरते हैं।', '10,000+ clay bowls installed with 5,000+ active bird care volunteers.')) ?></span>
              </li>
              <li class="flex items-start gap-2.5">
                <span class="material-symbols-outlined text-primary-container text-[20px] mt-0.5">check_circle</span>
                <span><?= e(ps_text('अवधी ग्रन्थ \'झरिहख\' व 151 कुण्डलियाँ प्रकाशित; विद्यालयों में \'ग्रीन मॉर्निंग\' का संस्कार।', 'Awadhi memoirs published; Green Morning practiced in 100+ schools.')) ?></span>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Grassroots Testimonials & Voice of Community -->
  <section class="w-full bg-cream-canvas py-space-3xl border-b border-border-warm">
    <div class="max-w-container-max mx-auto px-4 sm:px-8">
      <div class="text-center max-w-3xl mx-auto mb-space-xl">
        <span class="font-label-sm text-label-sm text-secondary tracking-widest font-bold uppercase"><?= e(ps_text('जन-गण का विश्वास', 'Voice of Community')) ?></span>
        <h2 class="font-headline-lg text-headline-md md:text-headline-lg text-deep-forest font-bold mt-1">
          <?= e(ps_text('ग्रामीणों, शिक्षकों एवं स्वयंसेवक युवाओं के विचार', 'Voices from Village Elders, Teachers & Youth Volunteers')) ?>
        </h2>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-pure-white rounded-3xl p-6 sm:p-7 shadow-sm border border-border-warm flex flex-col justify-between">
          <p class="font-quote-editorial text-body-md text-deep-forest italic mb-4 leading-relaxed">
            "<?= e(ps_text('सारंग जी के ग्रीन गैंग अभियान से हमारे गाँव की सड़क के दोनों ओर अब घने बरगद और नीम की छाया है। बच्चे सुबह विद्यालय में \'गुड मॉर्निंग\' की जगह \'ग्रीन मॉर्निंग\' बोलते हैं। यह एक नया संस्कार है।', 'Thanks to Sarang Ji\'s Green Gang, our village road is lined with dense Banyan trees. Children now say Green Morning in school.')) ?>"
          </p>
          <div class="pt-3 border-t border-border-warm flex items-center gap-3">
            <div class="w-9 h-9 rounded-full bg-primary-container text-on-primary flex items-center justify-center font-bold">
              <span class="material-symbols-outlined text-[18px]">person</span>
            </div>
            <div class="flex flex-col">
              <span class="font-title-md text-title-md text-deep-forest font-bold leading-none"><?= e(ps_text('राम औतार वर्मा', 'Ram Autar Verma')) ?></span>
              <span class="font-label-sm text-label-sm text-text-muted mt-0.5"><?= e(ps_text('ग्राम प्रधान, कमरावाँ (बाराबंकी)', 'Gram Pradhan, Kamrawan')) ?></span>
            </div>
          </div>
        </div>

        <div class="bg-pure-white rounded-3xl p-6 sm:p-7 shadow-sm border border-border-warm flex flex-col justify-between">
          <p class="font-quote-editorial text-body-md text-deep-forest italic mb-4 leading-relaxed">
            "<?= e(ps_text('गर्मी के दिनों में जब हम लोग छतों पर सकोरे में पानी भरते हैं, तो दर्जनों गौरैया और बुलबुल पानी पीने आती हैं। सारंग जी ने हमें बेज़ुबान पक्षियों के प्रति संवेदनशील बनाया है।', 'During summer, sparrows flock to drink from water bowls on our roofs. Sarang Ji made us sensitive to bird life.')) ?>"
          </p>
          <div class="pt-3 border-t border-border-warm flex items-center gap-3">
            <div class="w-9 h-9 rounded-full bg-secondary text-on-secondary flex items-center justify-center font-bold">
              <span class="material-symbols-outlined text-[18px]">person</span>
            </div>
            <div class="flex flex-col">
              <span class="font-title-md text-title-md text-deep-forest font-bold leading-none"><?= e(ps_text('श्रीमती सुनीता देवी', 'Smt. Sunita Devi')) ?></span>
              <span class="font-label-sm text-label-sm text-text-muted mt-0.5"><?= e(ps_text('पंजीकृत परिंदा मित्र, सतरिख', 'Registered Bird Friend, Satrikh')) ?></span>
            </div>
          </div>
        </div>

        <div class="bg-pure-white rounded-3xl p-6 sm:p-7 shadow-sm border border-border-warm flex flex-col justify-between">
          <p class="font-quote-editorial text-body-md text-deep-forest italic mb-4 leading-relaxed">
            "<?= e(ps_text('अवधी साहित्य में सारंग जी की \'सारंग-हुण्डलियाँ\' और \'झरिहख\' ग्रन्थ हमारी लोक-सांस्कृतिक पहचान को अमर बना रहे हैं। उनकी रचनाशीलता युवा पीढ़ी के लिए अनुपम प्रेरणा है।', 'Sarang Ji\'s Awadhi Kundaliyan and memoirs immortalize our cultural identity for the youth.')) ?>"
          </p>
          <div class="pt-3 border-t border-border-warm flex items-center gap-3">
            <div class="w-9 h-9 rounded-full bg-tertiary text-on-tertiary flex items-center justify-center font-bold">
              <span class="material-symbols-outlined text-[18px]">person</span>
            </div>
            <div class="flex flex-col">
              <span class="font-title-md text-title-md text-deep-forest font-bold leading-none"><?= e(ps_text('डॉ. अशोक अवस्थी', 'Dr. Ashok Awasthi')) ?></span>
              <span class="font-label-sm text-label-sm text-text-muted mt-0.5"><?= e(ps_text('अवधी साहित्य शोधार्थी, लखनऊ', 'Awadhi Scholar, Lucknow')) ?></span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Support & Volunteer Action CTA -->
  <section class="w-full bg-soft-meadow py-space-3xl">
    <div class="max-w-container-editorial mx-auto px-4 sm:px-8">
      <div class="bg-pure-white rounded-3xl p-6 sm:p-10 shadow-sm border border-border-warm text-center">
        <span class="material-symbols-outlined text-[44px] text-primary-container mb-3 inline-block">volunteer_activism</span>
        <h3 class="font-headline-md text-headline-md text-deep-forest font-bold mb-2">
          <?= e(ps_text('इस सामुदायिक प्रभाव को और आगे बढ़ाएं', 'Support and Amplify This Grassroots Impact')) ?>
        </h3>
        <p class="font-body-md text-body-md text-on-surface-variant max-w-xl mx-auto mb-6">
          <?= e(ps_text('चाहे आप पौधा गोद लेना चाहें, सकोरा बैंक स्पॉन्सर करना चाहें या स्वयंसेवक बनना चाहें — आपका हर प्रयास समाज को समृद्ध बनाता है।', 'Sponsor tree saplings, donate bird water bowls, or join our active Green Gang volunteer squad.')) ?>
        </p>

        <div class="flex flex-wrap items-center justify-center gap-3">
          <a href="<?= e(base_url('/donation')) ?>" class="inline-flex items-center gap-2 bg-primary-container hover:bg-deep-forest text-on-primary px-6 py-3.5 rounded-xl font-label-md text-label-md transition-colors shadow-sm font-bold">
            <span class="material-symbols-outlined text-[18px]">favorite</span>
            <span><?= e(ps_text('अभियान में सहयोग करें (Donate / Support)', 'Support Campaign')) ?></span>
          </a>
          <a href="<?= e(base_url('/volunteer')) ?>" class="inline-flex items-center gap-2 bg-cream-canvas hover:bg-surface-container text-deep-forest px-6 py-3.5 rounded-xl font-label-md text-label-md transition-colors border border-border-warm font-semibold">
            <span class="material-symbols-outlined text-[18px]">group_add</span>
            <span><?= e(ps_text('स्वयंसेवक बनें', 'Become a Volunteer')) ?></span>
          </a>
        </div>
      </div>
    </div>
  </section>
</div>
