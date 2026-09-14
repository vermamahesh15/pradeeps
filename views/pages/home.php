<?php
declare(strict_types=1);

// Helper to resolve images cleanly
if (!function_exists('ps_resolve_img')) {
    function ps_resolve_img(?string $dbPath, string $fallback): string {
        $root = realpath(__DIR__ . '/../..') ?: dirname(__DIR__, 2);
        if (!empty($dbPath)) {
            if (preg_match('#^https?://#i', $dbPath)) return $dbPath;
            $clean = ltrim($dbPath, '/');
            if (file_exists($root . '/' . $clean)) {
                return base_url($clean);
            }
            $webp = preg_replace('/\.(png|jpg|jpeg)$/i', '.webp', $clean);
            if (file_exists($root . '/' . $webp)) {
                return base_url($webp);
            }
        }
        if (preg_match('#^https?://#i', $fallback)) return $fallback;
        $cleanFallback = ltrim($fallback, '/');
        if (file_exists($root . '/' . $cleanFallback)) {
            return base_url($cleanFallback);
        }
        $webpFallback = preg_replace('/\.(png|jpg|jpeg)$/i', '.webp', $cleanFallback);
        if (file_exists($root . '/' . $webpFallback)) {
            return base_url($webpFallback);
        }
        return base_url($cleanFallback);
    }
}

$heroImg = ps_resolve_img($sliders[0]['image'] ?? '', 'assets/images/slider_final_1.jpg');
$phone = !empty($contact['phone']) ? $contact['phone'] : '+91 9919007190';
$phoneClean = preg_replace('/[^+0-9]/', '', $phone);
$email = !empty($contact['email']) ? $contact['email'] : 'contact@pradeepsarang.in';
$address = !empty($contact['address']) ? $contact['address'] : ps_text('ग्राम कमरावां, जिला बाराबंकी, उत्तर प्रदेश, भारत', 'Kamrawan, Barabanki, Uttar Pradesh, India');

// Green Gang campaign
$greenImg = base_url('assets/images/hariyali_abhiyan.webp');
$greenSlug = $green['slug'] ?? 'hariyali-campaign';

// Parinda campaign
$parindaImg = ps_resolve_img($parinda['image'] ?? '', 'assets/images/slider_final_2.webp');
$parindaSlug = $parinda['slug'] ?? 'bird-conservation-campaign';

// Awadhi campaign
$awadhiSlug = $awadhi['slug'] ?? 'language-and-literature-promotion-campaign';

// Patel campaign (Primary Campaign)
$patelImg = base_url('assets/images/sardar_patel.webp');
$patelSlug = $patel['slug'] ?? 'patel-campaign';

// Tulsi campaign
$tulsiSlug = $tulsi['slug'] ?? 'tulsi-abhiyan-16-31-2026';
?>
<div class="flex flex-col w-full">

<!-- 1. HERO SECTION -->
<section class="relative overflow-hidden px-4 sm:px-8 py-8 lg:py-12 bg-gradient-to-b from-[#FAF8F3] to-[#F1F7F2]">
  <div class="max-w-container-max mx-auto">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-12 items-center">
      <!-- Hero Text & Mission -->
      <div class="lg:col-span-7 flex flex-col space-y-6">
        <div class="inline-flex items-center gap-2 self-start bg-[#FAF8F3] px-3.5 py-1.5 rounded-full border border-[#C05632]/30 shadow-xs">
          <span class="w-2.5 h-2.5 rounded-full bg-[#C05632] animate-pulse"></span>
          <span class="font-label-sm text-label-sm text-[#14532D] uppercase tracking-wider font-semibold">
            <?= e(ps_text('समाजसेवी • पर्यावरण प्रेमी • साहित्यकार • जन-जागरूकता प्रेरक', 'Social Worker • Environmentalist • Writer • Public Awareness Catalyst')) ?>
          </span>
        </div>

        <h1 class="font-display-hero text-headline-lg lg:text-display-hero text-[#14532D] font-bold tracking-tight">
          <?= e(ps_text('समाज, संस्कृति और प्रकृति के लिए समर्पित एक जीवन', 'A Life Dedicated to Society, Culture and Nature')) ?>
        </h1>

        <p class="font-body-lg text-body-lg text-[#52606D] leading-relaxed">
          <?= e(ps_text('बाराबंकी के कमरावां गांव से शुरू होकर चार दशकों तक फैली निस्वार्थ जनसेवा — पर्यावरण संरक्षण, गौरैया व पक्षी संवर्धन, जल-सकोरा वितरण, अवधी भाषा उत्थान और युवाओं में सकारात्मक चेतना का निरंतर संचार।', 'Selfless community service spanning four decades from Kamrawan, Barabanki — environmental protection, sparrow and bird conservation, water bowl distribution, Awadhi language promotion and continuous youth empowerment.')) ?>
        </p>

        <!-- Green Greeting Pill -->
        <div class="bg-white rounded-xl p-4 flex items-center gap-3.5 border border-[#E5E7EB] shadow-xs">
          <div class="w-10 h-10 rounded-lg bg-[#15803D] text-white flex items-center justify-center shrink-0 shadow-sm">
            <span class="material-symbols-outlined text-2xl">spa</span>
          </div>
          <div class="flex flex-col">
            <span class="font-title-md text-title-md text-[#14532D] font-bold"><?= e(ps_text('ग्रीन मॉर्निंग की अनूठी पहल', 'Unique Initiative: Green Morning')) ?></span>
            <span class="font-body-sm text-body-sm text-[#667085]"><?= e(ps_text("दैनिक अभिवादन में 'गुड मॉर्निंग' के स्थान पर 'ग्रीन मॉर्निंग' बोलकर प्रकृति प्रेम का संचार", "Inspiring love for nature by greeting with 'Green Morning' instead of 'Good Morning'")) ?></span>
          </div>
        </div>

        <!-- Hero Actions -->
        <div class="flex flex-wrap items-center gap-4 pt-2">
          <a class="inline-flex items-center gap-2.5 bg-[#14532D] hover:bg-[#0F3D21] text-white font-label-md text-label-md px-6 py-3.5 rounded-lg shadow-md transition-all font-semibold" href="#story">
            <span><?= e(ps_text('मेरी यात्रा जानें', 'Explore My Journey')) ?></span>
            <span class="material-symbols-outlined text-[18px]">arrow_downward</span>
          </a>
          <a class="inline-flex items-center gap-2 bg-[#C05632] hover:bg-[#A9472B] text-white font-label-md text-label-md px-6 py-3.5 rounded-lg transition-all shadow-sm font-semibold" href="#campaigns">
            <span><?= e(ps_text('प्रमुख अभियान देखें', 'View Key Campaigns')) ?></span>
            <span class="material-symbols-outlined text-[18px]">explore</span>
          </a>
        </div>

        <!-- Social Proof Credentials -->
        <div class="flex flex-wrap items-center gap-6 pt-3 text-[#667085] font-body-sm text-body-sm">
          <div class="flex items-center gap-2">
            <span class="material-symbols-outlined text-[#B28A42] text-[18px]">verified</span>
            <span><?= e(ps_text('स्वामी विवेकानंद सम्मान (1989)', 'Swami Vivekananda Award (1989)')) ?></span>
          </div>
          <div class="flex items-center gap-2">
            <span class="material-symbols-outlined text-[#B28A42] text-[18px]">military_tech</span>
            <span><?= e(ps_text('गणतंत्र दिवस परेड प्रतिभागी (1987-88)', 'Republic Day Parade Participant (1987-88)')) ?></span>
          </div>
        </div>
      </div>

      <!-- Hero Documentary Photo Card -->
      <div class="lg:col-span-5 relative">
        <div class="relative rounded-2xl overflow-hidden shadow-xl bg-pure-white p-3 border border-border-warm">
          <div class="relative w-full h-[440px] sm:h-[480px] rounded-xl overflow-hidden bg-surface-container">
            <?= ps_responsive_img($heroImg, ps_text('श्री प्रदीप सारंग - समाजसेवी एवं पर्यावरणविद', 'Pradeep Sarang - Social Worker and Environmentalist'), 'w-full h-full object-cover', '(max-width: 1024px) 100vw, 40vw', 'eager') ?>
            <div class="absolute inset-0 bg-gradient-to-t from-deep-forest/90 via-deep-forest/30 to-transparent flex flex-col justify-end p-6 text-pure-white">
              <span class="font-label-sm text-label-sm uppercase tracking-widest text-primary-fixed mb-1 font-semibold"><?= e(ps_text('संस्थापक — ग्रीन गैंग (2019)', 'Founder — Green Gang (2019)')) ?></span>
              <h3 class="font-headline-sm text-headline-sm font-semibold"><?= e(ps_text('श्री प्रदीप सारंग', 'Shri Pradeep Sarang')) ?></h3>
              <p class="font-body-sm text-body-sm text-surface-container-high mt-1"><?= e(ps_text('बाराबंकी की माटी से उठकर जन-जन तक हरियाली का अलख जगाने वाले जनसेवक।', 'A grassroots changemaker inspiring community action for environment and culture.')) ?></p>
            </div>
          </div>
          <!-- Overlapping Float Badge -->
          <div class="absolute -bottom-4 -left-4 bg-pure-white rounded-xl shadow-lg p-3.5 flex items-center gap-3 max-w-[240px] border border-border-warm">
            <div class="w-10 h-10 rounded-full bg-secondary text-pure-white flex items-center justify-center shrink-0 shadow-sm">
              <span class="material-symbols-outlined text-[20px]">calendar_month</span>
            </div>
            <div class="flex flex-col">
              <span class="font-label-sm text-label-sm text-text-muted"><?= e(ps_text('सतत लोकसेवा', 'Continuous Service')) ?></span>
              <span class="font-title-md text-title-md font-bold text-deep-forest"><?= e(ps_text('1987 से अनवरत', 'Since 1987')) ?></span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- 2. IMPACT METRICS STRIP (जीवंत प्रभाव सांख्यिकी) -->
<section class="w-full px-4 sm:px-8 py-8" aria-label="<?= e(ps_text('जीवंत प्रभाव सांख्यिकी', 'Impact Statistics')) ?>">
  <div class="max-w-container-max mx-auto">
    <div class="bg-[#18392B] rounded-2xl p-6 sm:p-8 shadow-md border border-white/10 grid grid-cols-2 lg:grid-cols-4 gap-6">
      <div class="flex flex-col">
        <div class="flex items-center justify-between mb-3">
          <span class="font-display-hero text-headline-lg lg:text-display-hero text-[#F4C96B] font-bold leading-none">35+</span>
          <div class="w-10 h-10 rounded-lg bg-white/10 border border-white/15 flex items-center justify-center text-[#E67E57]">
            <span class="material-symbols-outlined">schedule</span>
          </div>
        </div>
        <span class="font-title-md text-title-md font-semibold text-[#FFFFFF]"><?= e(ps_text('वर्ष निरंतर जनसेवा', 'Years of Continuous Service')) ?></span>
        <span class="font-body-sm text-body-sm text-[#CBD5E1] mt-1"><?= e(ps_text('1987 से आज तक निस्वार्थ ग्रामीण व सामाजिक योगदान', 'Selfless rural and community contribution from 1987 to Present')) ?></span>
      </div>

      <div class="flex flex-col">
        <div class="flex items-center justify-between mb-3">
          <span class="font-display-hero text-headline-lg lg:text-display-hero text-[#F4C96B] font-bold leading-none">15+</span>
          <div class="w-10 h-10 rounded-lg bg-white/10 border border-white/15 flex items-center justify-center text-[#6FD08C]">
            <span class="material-symbols-outlined">campaign</span>
          </div>
        </div>
        <span class="font-title-md text-title-md font-semibold text-[#FFFFFF]"><?= e(ps_text('सक्रिय जन-अभियान', 'Active Movements')) ?></span>
        <span class="font-body-sm text-body-sm text-[#CBD5E1] mt-1"><?= e(ps_text('ग्रीन गैंग, परिंदा संरक्षण, जल-सकोरा अभियान, अवधी संवर्धन', 'Green Gang, Bird Protection, Water Bowl Campaign, Awadhi')) ?></span>
      </div>

      <div class="flex flex-col">
        <div class="flex items-center justify-between mb-3">
          <span class="font-display-hero text-headline-lg lg:text-display-hero text-[#F4C96B] font-bold leading-none">50+</span>
          <div class="w-10 h-10 rounded-lg bg-white/10 border border-white/15 flex items-center justify-center text-[#F0B45C]">
            <span class="material-symbols-outlined">emoji_events</span>
          </div>
        </div>
        <span class="font-title-md text-title-md font-semibold text-[#FFFFFF]"><?= e(ps_text('सम्मान एवं पुरस्कार', 'Honors & Awards')) ?></span>
        <span class="font-body-sm text-body-sm text-[#CBD5E1] mt-1"><?= e(ps_text('स्वामी विवेकानंद सम्मान (1989), राष्ट्रीय परेड सम्मान', 'Swami Vivekananda Award (1989), National Parade')) ?></span>
      </div>

      <div class="flex flex-col">
        <div class="flex items-center justify-between mb-3">
          <span class="font-display-hero text-headline-lg lg:text-display-hero text-[#F4C96B] font-bold leading-none">18k+</span>
          <div class="w-10 h-10 rounded-lg bg-white/10 border border-white/15 flex items-center justify-center text-[#76B7D8]">
            <span class="material-symbols-outlined">groups</span>
          </div>
        </div>
        <span class="font-title-md text-title-md font-semibold text-[#FFFFFF]"><?= e(ps_text('नागरिक सहभागिता', 'Citizen Engagements')) ?></span>
        <span class="font-body-sm text-body-sm text-[#CBD5E1] mt-1"><?= e(ps_text('बाराबंकी, सतरिख, लखनऊ व ग्रामीण क्षेत्रों में प्रत्यक्ष जुड़ाव', 'Active direct outreach in Barabanki, Satrikh & Lucknow')) ?></span>
      </div>
    </div>
  </div>
</section>

<!-- 3. STORYTELLING BIOGRAPHY (एक परिचय — प्रदीप सारंग) -->
<section class="w-full px-4 sm:px-8 py-8 lg:py-12 bg-soft-meadow" id="story">
  <div class="max-w-container-max mx-auto">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-center">
      <!-- Collage / Visuals -->
      <div class="lg:col-span-5 relative">
        <div class="relative rounded-2xl overflow-hidden shadow-md border border-border-warm bg-pure-white">
          <img class="w-full h-72 sm:h-80 object-cover" 
               src="<?= e(base_url('assets/images/slider_final_3.webp')) ?>" 
               alt="<?= e(ps_text('प्रदीप सारंग सम्मान समारोह मंच पर', 'Pradeep Sarang at an official recognition dais')) ?>"/>
        </div>
        <!-- Origin Tag Badge -->
        <div class="mt-4 bg-pure-white rounded-xl p-4 shadow-sm flex items-center gap-3 border border-border-warm">
          <span class="material-symbols-outlined text-secondary text-[24px]">location_home</span>
          <div class="flex flex-col">
            <span class="font-label-sm text-label-sm uppercase text-text-muted font-bold"><?= e(ps_text('जन्म स्थान एवं कर्मभूमि', 'Birthplace & Roots')) ?></span>
            <span class="font-title-md text-title-md font-semibold text-deep-forest"><?= e(ps_text('20 अक्टूबर 1969 • कमरावां, बाराबंकी', '20 October 1969 • Kamrawan, Barabanki')) ?></span>
          </div>
        </div>
      </div>

      <!-- Narrative Content -->
      <div class="lg:col-span-7 flex flex-col space-y-6">
        <div class="inline-flex items-center gap-2 self-start bg-pure-white px-3 py-1 rounded-full shadow-sm border border-border-warm">
          <span class="material-symbols-outlined text-primary text-[16px]">menu_book</span>
          <span class="font-label-sm text-label-sm font-semibold text-deep-forest"><?= e(ps_text('एक परिचय — श्री प्रदीप सारंग', 'Biography — Shri Pradeep Sarang')) ?></span>
        </div>

        <h2 class="font-headline-lg text-headline-lg text-deep-forest font-bold">
          <?= e(ps_text('जनसेवा ही साधना: एक सतत संकल्प', 'Service as Sadhana: A Lifelong Commitment')) ?>
        </h2>

        <p class="font-body-md text-body-md text-on-surface leading-relaxed">
          <?= e(ps_text('वर्ष 1969 की 20 अक्टूबर को बाराबंकी के ग्राम कमरावां में जन्मे श्री प्रदीप सारंग एक समर्पित सामाजिक कार्यकर्ता, साहित्यकार एवं जनसेवक हैं, जो कि समाज के विभिन्न क्षेत्रों में अपने निरंतर सक्रिय योगदान से युवाओं में सकारात्मक एवं प्रेरणादायक वातावरण सृजित करते रहते हैं।', 'Born on 20 October 1969 in Kamrawan village, Barabanki, Shri Pradeep Sarang is a devoted social worker, writer and public servant who creates an inspiring, positive environment for youth through sustained grassroots leadership.')) ?>
        </p>

        <p class="font-body-md text-body-md text-on-surface-variant leading-relaxed">
          <?= e(ps_text('उनका जीवन समाज सेवा, शिक्षा, पर्यावरण-संरक्षण और जन-जागरूकता के कार्यों के लिए समर्पित है। ग्रामीण विकास, मतदाता जागरूकता, पर्यावरण संरक्षण, गौरैया व परिंदा संरक्षण, जल-सकोरा अभियान तथा अवधी-भाषा-संस्कृति के संरक्षण संवर्धन जैसे कार्यों में उनकी विशेष रुचि है।', 'His life is devoted to community upliftment, education, environmental conservation and civic awareness. Rural empowerment, voter mobilization, sparrow shelters, earthen water bowls and the preservation of Awadhi folk culture are central to his mission.')) ?>
        </p>

        <!-- Signature Poetic Quote -->
        <div class="bg-white rounded-xl p-6 shadow-sm border-l-4 border-[#C05632] border-t border-r border-b border-[#E5E7EB]">
          <div class="flex items-center gap-1.5 text-[#C05632] mb-2 font-bold text-[22px]">
            <span>“</span>
          </div>
          <p class="font-quote-editorial text-quote-editorial text-[#172033] italic leading-relaxed">
            <?= ps_text('"हारना सीखा नहीं है, जीत का मैं गीत हूँ।<br/>जुगनुओं का संग है, इंसानियत का मीत हूँ।"', '"I have not learned to lose; I am a song of victory.<br/>Accompanied by fireflies, I am a friend to humanity."') ?>
          </p>
          <div class="mt-3 flex items-center justify-between pt-2 border-t border-[#E5E7EB]">
            <span class="font-label-md text-label-md font-bold text-[#14532D] uppercase tracking-widest">— <?= e(ps_text('प्रदीप सारंग', 'Pradeep Sarang')) ?></span>
            <span class="font-label-sm text-label-sm text-[#667085]"><?= e(ps_text('कवि एवं सामाजिक विचारक', 'Poet & Social Thinker')) ?></span>
          </div>
        </div>

        <!-- Key Pillar Chips -->
        <div class="flex flex-wrap gap-2 pt-2">
          <span class="bg-pure-white text-deep-forest px-3 py-1.5 rounded-lg font-label-sm text-label-sm shadow-sm flex items-center gap-1.5 border border-border-warm">
            <span class="material-symbols-outlined text-[15px] text-primary">forest</span><?= e(ps_text('पर्यावरणविद', 'Environmentalist')) ?>
          </span>
          <span class="bg-pure-white text-deep-forest px-3 py-1.5 rounded-lg font-label-sm text-label-sm shadow-sm flex items-center gap-1.5 border border-border-warm">
            <span class="material-symbols-outlined text-[15px] text-secondary">history_edu</span><?= e(ps_text('साहित्यकार व कवि', 'Writer & Poet')) ?>
          </span>
          <span class="bg-pure-white text-deep-forest px-3 py-1.5 rounded-lg font-label-sm text-label-sm shadow-sm flex items-center gap-1.5 border border-border-warm">
            <span class="material-symbols-outlined text-[15px] text-tertiary">cottage</span><?= e(ps_text('ग्रामीण विकास प्रेरक', 'Rural Catalyst')) ?>
          </span>
          <span class="bg-pure-white text-deep-forest px-3 py-1.5 rounded-lg font-label-sm text-label-sm shadow-sm flex items-center gap-1.5 border border-border-warm">
            <span class="material-symbols-outlined text-[15px] text-fresh-sprout">translate</span><?= e(ps_text('अवधी भाषा संरक्षक', 'Awadhi Advocate')) ?>
          </span>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- 4. FLAGSHIP CAMPAIGNS (प्रमुख जन-अभियान) -->
<section class="w-full px-4 sm:px-8 py-8 lg:py-12" id="campaigns">
  <div class="max-w-container-max mx-auto">
    <!-- Section Header -->
    <div class="flex flex-col md:flex-row md:items-end justify-between mb-12 gap-4">
      <div>
        <span class="font-label-sm text-label-sm uppercase tracking-widest text-secondary font-bold"><?= e(ps_text('जन-आंदोलन एवं पहल', 'Grassroots Movements')) ?></span>
        <h2 class="font-headline-lg text-headline-lg text-deep-forest font-bold mt-1"><?= e(ps_text('प्रमुख अभियान', 'Key Campaigns')) ?></h2>
        <p class="font-body-md text-body-md text-text-muted mt-2 max-w-2xl">
          <?= e(ps_text('प्रदीप सारंग द्वारा समाज के समग्र विकास के लिए विभिन्न जन-जागरूकता एवं सेवा-आधारित अभियानों का संचालन किया जा रहा है।', 'Sustained public-interest movements for social upliftment, green awareness and cultural heritage.')) ?>
        </p>
      </div>
      <a class="inline-flex items-center gap-2 text-primary hover:text-deep-forest font-label-md text-label-md transition-colors font-bold" href="<?= e(base_url('/campaigns')) ?>">
        <span><?= e(ps_text('सभी अभियानों से जुड़ें', 'Explore All Campaigns')) ?></span>
        <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
      </a>
    </div>

    <!-- Alternating Feature Campaigns -->
    <div class="space-y-8 mb-12">
      <!-- Feature 1: Sardar Patel Abhiyan (Primary Flagship Campaign) -->
      <div class="bg-pure-white rounded-2xl p-6 lg:p-10 shadow-sm border border-border-warm grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
        <div class="lg:col-span-6 rounded-xl overflow-hidden shadow-sm h-72 lg:h-96 bg-surface-variant flex items-center justify-center p-2">
          <?= ps_responsive_img($patelImg, ps_text('सरदार पटेल अभियान — राष्ट्रीय एकता व अखंडता', 'Sardar Patel Campaign - National Integration'), 'w-full h-full object-contain rounded-lg', '(max-width: 1024px) 100vw, 50vw', 'lazy') ?>
        </div>
        <div class="lg:col-span-6 flex flex-col space-y-4">
          <div class="inline-flex items-center gap-2 self-start bg-secondary-fixed/40 px-3 py-1 rounded-full text-secondary font-label-sm text-label-sm border border-secondary/20">
            <span class="material-symbols-outlined text-[16px] text-secondary">flag</span>
            <span><?= e(ps_text('प्राथमिक मुख्य जन-अभियान (राष्ट्रीय एकता)', 'Primary Flagship Campaign (National Integration)')) ?></span>
          </div>
          <h3 class="font-headline-md text-headline-md font-bold text-deep-forest">
            <?= e($patel['title'] ?? ps_text('सरदार पटेल अभियान (राष्ट्रीय चेतना)', 'Sardar Patel Campaign (National Integration)')) ?>
          </h3>
          <p class="font-body-md text-body-md text-on-surface-variant leading-relaxed">
            <?= e(ps_text('लौह पुरुष सरदार वल्लभभाई पटेल के अखंड भारत, राष्ट्रीय अखंडता और सामाजिक समरसता के विचारों को युवाओं तक पहुँचाने हेतु संचालित प्रमुख अभियान। इसके माध्यम से समाज को जाति-धर्म की संकीर्णताओं से ऊपर उठाकर एक सशक्त राष्ट्र निर्माण के लिए प्रेरित किया जाता है।', 'The primary national integration campaign advancing Sardar Vallabhbhai Patel’s message of a united India, youth empowerment, civic responsibility, and social harmony across rural regions.')) ?>
          </p>
          <div class="flex flex-wrap items-center gap-4 text-deep-forest font-body-sm text-body-sm py-2">
            <div class="flex items-center gap-1.5"><span class="material-symbols-outlined text-secondary text-[18px]">verified</span> <?= e(ps_text('अखंड भारत चेतना यात्रा', 'Unity Consciousness Drive')) ?></div>
            <div class="flex items-center gap-1.5"><span class="material-symbols-outlined text-secondary text-[18px]">verified</span> <?= e(ps_text('युवा नेतृत्व संवाद', 'Youth Leadership Forums')) ?></div>
          </div>
          <div>
            <a class="inline-flex items-center gap-2 bg-primary-container text-on-primary hover:bg-deep-forest px-5 py-2.5 rounded-lg font-label-md text-label-md shadow transition-colors font-semibold" href="<?= e(base_url('/campaigns/' . $patelSlug)) ?>">
              <span><?= e(ps_text('सरदार पटेल अभियान से जुड़ें', 'Explore Sardar Patel Campaign')) ?></span>
              <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
            </a>
          </div>
        </div>
      </div>

      <!-- Feature 2: Hariyali Abhiyan (Green Gang) -->
      <div class="bg-pure-white rounded-2xl p-6 lg:p-10 shadow-sm border border-border-warm grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
        <div class="lg:col-span-6 order-2 lg:order-1 flex flex-col space-y-4">
          <div class="inline-flex items-center gap-2 self-start bg-soft-meadow px-3 py-1 rounded-full text-deep-forest font-label-sm text-label-sm border border-primary/10">
            <span class="material-symbols-outlined text-[16px] text-primary">eco</span>
            <span><?= e(ps_text('स्थापना: 05 जून 2019 (विश्व पर्यावरण दिवस)', 'Founded: 05 June 2019 (World Environment Day)')) ?></span>
          </div>
          <h3 class="font-headline-md text-headline-md font-bold text-deep-forest">
            <?= e($green['title'] ?? ps_text('हरियाली-अभियान (ग्रीन गैंग)', 'Hariyali Campaign (Green Gang)')) ?>
          </h3>
          <p class="font-body-md text-body-md text-on-surface-variant leading-relaxed">
            <?= e(ps_text("“ग्रीन गैंग” प्रदीप सारंग द्वारा शुरू किया गया एक प्रेरक हरियाली अभियान है, जिसका उद्देश्य जनमानस में पर्यावरण प्रेम विकसित करना है। हर दिन के अभिवादन में 'ग्रीन मॉर्निंग' का प्रयोग जन-जन के स्वभाव में प्रकृति बोध जगाता है।", "“Green Gang” is an inspiring environmental movement founded by Pradeep Sarang to instill a love for greenery in daily life. Greeting everyone with 'Green Morning' keeps environmental consciousness alive.")) ?>
          </p>
          <div class="flex items-center gap-4 text-deep-forest font-body-sm text-body-sm py-2">
            <div class="flex items-center gap-1.5"><span class="material-symbols-outlined text-primary text-[18px]">check_circle</span> <?= e(ps_text('50,000+ पौधे रोपित', '50,000+ Saplings Planted')) ?></div>
            <div class="flex items-center gap-1.5"><span class="material-symbols-outlined text-primary text-[18px]">check_circle</span> <?= e(ps_text('ग्रीन चौपाल संवाद', 'Green Chaupal Dialogues')) ?></div>
          </div>
          <div>
            <a class="inline-flex items-center gap-2 bg-secondary text-on-secondary hover:bg-deep-forest px-5 py-2.5 rounded-lg font-label-md text-label-md shadow transition-colors font-semibold" href="<?= e(base_url('/campaigns/' . $greenSlug)) ?>">
              <span><?= e(ps_text('ग्रीन गैंग का विस्तार देखें', 'Discover Green Gang')) ?></span>
              <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
            </a>
          </div>
        </div>
        <div class="lg:col-span-6 order-1 lg:order-2 rounded-xl overflow-hidden shadow-sm h-72 lg:h-96 bg-surface-variant flex items-center justify-center p-2">
          <?= ps_responsive_img($greenImg, ps_text('हरियाली-अभियान (ग्रीन गैंग) पौधरोपण', 'Hariyali Abhiyan Green Gang Plantation'), 'w-full h-full object-contain rounded-lg', '(max-width: 1024px) 100vw, 50vw', 'lazy') ?>
        </div>
      </div>
    </div>

    <!-- Campaign Grid (4 Pillars) -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
      <!-- Sardar Patel Abhiyan (Card 1) -->
      <div class="bg-pure-white rounded-xl p-6 shadow-sm border-2 border-secondary/30 flex flex-col justify-between hover:shadow-md transition-shadow relative overflow-hidden">
        <div class="absolute top-0 right-0 bg-secondary text-pure-white px-3 py-0.5 rounded-bl-lg font-label-sm text-[10px] font-bold uppercase tracking-wider">
          <?= e(ps_text('मुख्य संकल्प', 'Primary')) ?>
        </div>
        <div>
          <div class="w-12 h-12 rounded-xl bg-secondary-fixed/50 flex items-center justify-center text-secondary mb-4">
            <span class="material-symbols-outlined text-2xl">diversity_3</span>
          </div>
          <h4 class="font-headline-sm text-headline-sm font-semibold text-deep-forest">
            <a href="<?= e(base_url('/campaigns/' . $patelSlug)) ?>" class="hover:text-secondary transition-colors">
              <?= e(ps_text('सरदार पटेल अभियान', 'Sardar Patel Campaign')) ?>
            </a>
          </h4>
          <p class="font-body-sm text-body-sm text-text-muted mt-2 leading-relaxed">
            <?= e(ps_text('राष्ट्रीय एकता और अखंडता के संदेश को जन-जन तक पहुँचाने हेतु संचालित अभियान, जिससे युवाओं में राष्ट्रप्रेम जागृत हो सके।', 'Spreading ideals of national integrity, unity and civic leadership among youth.')) ?>
          </p>
        </div>
        <div class="mt-6 pt-4 border-t border-surface-container flex items-center justify-between">
          <span class="font-label-sm text-label-sm text-secondary font-bold"><?= e(ps_text('राष्ट्रीय एकता व सद्भाव', 'National Integration')) ?></span>
          <a href="<?= e(base_url('/campaigns/' . $patelSlug)) ?>" class="text-secondary hover:text-deep-forest">↗</a>
        </div>
      </div>

      <!-- Awadhi Abhiyan (Card 2) -->
      <div class="bg-pure-white rounded-xl p-6 shadow-sm border border-border-warm flex flex-col justify-between hover:shadow-md transition-shadow">
        <div>
          <div class="w-12 h-12 rounded-xl bg-tertiary-fixed flex items-center justify-center text-tertiary mb-4">
            <span class="material-symbols-outlined text-2xl">auto_stories</span>
          </div>
          <h4 class="font-headline-sm text-headline-sm font-semibold text-deep-forest">
            <a href="<?= e(base_url('/campaigns/' . $awadhiSlug)) ?>" class="hover:text-primary transition-colors">
              <?= e(ps_text('अवधी अभियान', 'Awadhi Campaign')) ?>
            </a>
          </h4>
          <p class="font-body-sm text-body-sm text-text-muted mt-2 leading-relaxed">
            <?= e(ps_text('हिंदी एवं अवधी भाषा, साहित्य और लोक संस्कृति के संवर्धन के लिए निरंतर काव्य-गोष्ठियों और अवधी गद्य लेखन का जन-प्रसार।', 'Promotion of Hindi & Awadhi language, folk culture, and poetic symposiums across rural regions.')) ?>
          </p>
        </div>
        <div class="mt-6 pt-4 border-t border-surface-container flex items-center justify-between">
          <span class="font-label-sm text-label-sm text-tertiary font-bold"><?= e(ps_text('साहित्यिक धरोहर संरक्षण', 'Literary Preservation')) ?></span>
          <a href="<?= e(base_url('/campaigns/' . $awadhiSlug)) ?>" class="text-tertiary hover:text-deep-forest">↗</a>
        </div>
      </div>

      <!-- Tulsi Jayanti -->
      <div class="bg-pure-white rounded-xl p-6 shadow-sm border border-border-warm flex flex-col justify-between hover:shadow-md transition-shadow">
        <div>
          <div class="w-12 h-12 rounded-xl bg-soft-meadow flex items-center justify-center text-deep-forest mb-4">
            <span class="material-symbols-outlined text-2xl">menu_book</span>
          </div>
          <h4 class="font-headline-sm text-headline-sm font-semibold text-deep-forest">
            <a href="<?= e(base_url('/campaigns/' . $tulsiSlug)) ?>" class="hover:text-primary transition-colors">
              <?= e(ps_text('तुलसी जयंती पखवारा', 'Tulsi Jayanti Fortnight')) ?>
            </a>
          </h4>
          <p class="font-body-sm text-body-sm text-text-muted mt-2 leading-relaxed">
            <?= e(ps_text('16 से 31 अगस्त 2026: गोस्वामी तुलसीदास जी के जीवन मूल्यों, रामचरितमानस की सामाजिक समरसता और अवधी संस्कृति का आयोजन।', '16-31 August 2026: Celebrations honoring Goswami Tulsidas and the social harmony of Ramcharitmanas.')) ?>
          </p>
        </div>
        <div class="mt-6 pt-4 border-t border-surface-container flex items-center justify-between">
          <span class="font-label-sm text-label-sm text-deep-forest font-bold"><?= e(ps_text('वार्षिक सांस्कृतिक उत्सव', 'Annual Cultural Event')) ?></span>
          <a href="<?= e(base_url('/campaigns/' . $tulsiSlug)) ?>" class="text-deep-forest hover:text-primary">↗</a>
        </div>
      </div>

      <!-- Bird & Sparrow Conservation -->
      <div class="bg-pure-white rounded-xl p-6 shadow-sm border border-border-warm flex flex-col justify-between hover:shadow-md transition-shadow">
        <div>
          <div class="w-12 h-12 rounded-xl bg-soft-meadow flex items-center justify-center text-deep-forest mb-4">
            <span class="material-symbols-outlined text-2xl">nest_cam_iq_outdoor</span>
          </div>
          <h4 class="font-headline-sm text-headline-sm font-semibold text-deep-forest">
            <?= e(ps_text('परिंदा संवर्धन व जल-सकोरा अभियान', 'Sparrow & Bird Conservation')) ?>
          </h4>
          <p class="font-body-sm text-body-sm text-text-muted mt-2 leading-relaxed">
            <?= e(ps_text('गर्मी के दिनों में बेजुबान पक्षियों हेतु मिट्टी के जल-सकोरे का वितरण, दाना-पानी प्रबंध और गौरैया संरक्षण जागरूकता।', 'Distributing clay water bowls and food shelters for sparrows and birds during hot summer months.')) ?>
          </p>
        </div>
        <div class="mt-6 pt-4 border-t border-surface-container flex items-center justify-between">
          <span class="font-label-sm text-label-sm text-deep-forest font-bold"><?= e(ps_text('जीव-दया व प्रकृति प्रेम', 'Animal Compassion')) ?></span>
          <a href="<?= e(base_url('/volunteer')) ?>" class="text-deep-forest hover:text-primary">↗</a>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- 5. FEATURED GREEN GANG SPOTLIGHT (ग्रीन गैंग विशेष खंड) -->
<section class="w-full px-4 sm:px-8 py-8 lg:py-12 bg-deep-forest text-on-primary" id="greengang">
  <div class="max-w-container-max mx-auto">
    <div class="max-w-3xl mx-auto text-center mb-14">
      <div class="inline-flex items-center gap-2 bg-primary-container px-3.5 py-1 rounded-full text-on-primary font-label-sm text-label-sm mb-4">
        <span class="material-symbols-outlined text-[16px] text-primary-fixed">psychiatry</span>
        <span><?= e(ps_text('प्रकृति-केंद्रित जीवन शैली आंदोलन', 'Nature-Centric Lifestyle Movement')) ?></span>
      </div>
      <h2 class="font-headline-lg text-headline-lg font-bold text-pure-white">
        <?= e(ps_text('ग्रीन गैंग — हरियाली को जन-आंदोलन बनाने की ऐतिहासिक पहल', 'Green Gang — A Historic Initiative Turning Greenery into a Movement')) ?>
      </h2>
      <p class="font-body-md text-body-md text-surface-container-high mt-3 leading-relaxed">
        <?= e(ps_text('विश्व पर्यावरण दिवस 05 जून 2019 को स्थापित। प्रदीप सारंग का विचार है कि जब हमारी जुबां पर हरियाली होगी, तभी हमारे आंगन और धरा पर हरियाली टिकेगी।', 'Founded on World Environment Day, 05 June 2019. Pradeep Sarang believes when greenery lives in our words, it thrives in our courtyards and earth.')) ?>
      </p>
    </div>

    <!-- The 4 Green Greetings Interactive Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
      <div class="bg-surface-container-low/10 backdrop-blur rounded-2xl p-6 border-b-4 border-primary-fixed flex flex-col items-center text-center">
        <div class="w-14 h-14 rounded-full bg-white/15 border border-white/20 text-primary-fixed flex items-center justify-center mb-4">
          <span class="material-symbols-outlined text-3xl">wb_twilight</span>
        </div>
        <span class="font-headline-sm text-headline-sm text-pure-white font-semibold"><?= e(ps_text('ग्रीन-मॉर्निंग', 'Green-Morning')) ?></span>
        <span class="font-label-sm text-label-sm text-primary-fixed mt-0.5 font-bold">Green Morning</span>
        <p class="font-body-sm text-body-sm text-surface-container-high mt-3">
          <?= e(ps_text("'गुड मॉर्निंग' का हरित विकल्प। सुबह की पहली किरण के साथ धरती के प्रति कृतज्ञता और पौधे लगाने का संकल्प।", "The green greeting to start the day with gratitude to mother earth and a commitment to plant.")) ?>
        </p>
      </div>

      <div class="bg-surface-container-low/10 backdrop-blur rounded-2xl p-6 border-b-4 border-tertiary-fixed flex flex-col items-center text-center">
        <div class="w-14 h-14 rounded-full bg-white/15 border border-white/20 text-tertiary-fixed flex items-center justify-center mb-4">
          <span class="material-symbols-outlined text-3xl">light_mode</span>
        </div>
        <span class="font-headline-sm text-headline-sm text-pure-white font-semibold"><?= e(ps_text('ग्रीन-आफ्टरनून', 'Green-Afternoon')) ?></span>
        <span class="font-label-sm text-label-sm text-tertiary-fixed mt-0.5 font-bold">Green Afternoon</span>
        <p class="font-body-sm text-body-sm text-surface-container-high mt-3">
          <?= e(ps_text('दोपहर के श्रम में छायादार वृक्षों और पक्षियों के लिए पानी की व्यवस्था की याद दिलाता हरित अभिवादन।', 'A midday reminder of shade-giving trees and providing fresh water for birds in summer.')) ?>
        </p>
      </div>

      <div class="bg-surface-container-low/10 backdrop-blur rounded-2xl p-6 border-b-4 border-secondary-fixed flex flex-col items-center text-center">
        <div class="w-14 h-14 rounded-full bg-white/15 border border-white/20 text-secondary-fixed flex items-center justify-center mb-4">
          <span class="material-symbols-outlined text-3xl">wb_sunny</span>
        </div>
        <span class="font-headline-sm text-headline-sm text-pure-white font-semibold"><?= e(ps_text('ग्रीन-इवनिंग', 'Green-Evening')) ?></span>
        <span class="font-label-sm text-label-sm text-secondary-fixed mt-0.5 font-bold">Green Evening</span>
        <p class="font-body-sm text-body-sm text-surface-container-high mt-3">
          <?= e(ps_text('शाम के वक्त चौपालों और परिवारों में हरियाली, स्वच्छता व पर्यावरण संवाद को प्रेरित करता संवाद।', 'Evening chaupal discussions encouraging cleanliness, tree care and ecological stewardship.')) ?>
        </p>
      </div>

      <div class="bg-surface-container-low/10 backdrop-blur rounded-2xl p-6 border-b-4 border-on-primary-container flex flex-col items-center text-center">
        <div class="w-14 h-14 rounded-full bg-white/15 border border-white/20 text-on-primary-container flex items-center justify-center mb-4">
          <span class="material-symbols-outlined text-3xl">dark_mode</span>
        </div>
        <span class="font-headline-sm text-headline-sm text-pure-white font-semibold"><?= e(ps_text('ग्रीन-नाइट', 'Green-Night')) ?></span>
        <span class="font-label-sm text-label-sm text-on-primary-container mt-0.5 font-bold">Green Night</span>
        <p class="font-body-sm text-body-sm text-surface-container-high mt-3">
          <?= e(ps_text('दिन के समापन पर प्रकृति के संतुलन और आने वाले कल को और अधिक हरा-भरा बनाने का शांत संकल्प।', 'A peaceful evening resolution to sustain nature balance and nurture tomorrow greenery.')) ?>
        </p>
      </div>
    </div>

    <!-- Action Box -->
    <div class="bg-surface-container-low/15 rounded-2xl p-8 max-w-2xl mx-auto text-center flex flex-col items-center border border-white/10">
      <h3 class="font-title-lg text-title-lg font-bold text-pure-white"><?= e(ps_text('आप भी बनें "ग्रीन गैंग" के हरित साथी', 'Become a Green Gang Partner')) ?></h3>
      <p class="font-body-sm text-body-sm text-surface-container-high mt-2 mb-6 max-w-md">
        <?= e(ps_text('अपने दैनिक संवाद में ग्रीन मॉर्निंग अपनाएं और अपने गांव/मोहल्ले में कम से कम 5 फलदार अथवा छायादार पौधे अवश्य लगाएं।', 'Adopt Green Morning in daily greetings and plant at least 5 shade or fruit trees in your community.')) ?>
      </p>
      <a class="inline-flex items-center gap-2 bg-fresh-sprout text-deep-forest font-label-md text-label-md px-8 py-3 rounded-lg font-bold hover:bg-pure-white transition-colors shadow-lg" href="<?= e(base_url('/volunteer')) ?>">
        <span class="material-symbols-outlined text-[18px]">group_add</span>
        <span><?= e(ps_text('ग्रीन गैंग सदस्यता फॉर्म भरें', 'Fill Green Gang Membership Form')) ?></span>
      </a>
    </div>
  </div>
</section>

<!-- 6. SOCIAL IMPACT AREAS (कार्यक्षेत्र मैट्रिक्स) -->
<section class="w-full px-4 sm:px-8 py-8 lg:py-12" id="impact">
  <div class="max-w-container-max mx-auto">
    <div class="text-center max-w-2xl mx-auto mb-12">
      <span class="font-label-sm text-label-sm uppercase tracking-widest text-primary font-bold"><?= e(ps_text('समग्र समाज-सुधार', 'Holistic Social Reforms')) ?></span>
      <h2 class="font-headline-lg text-headline-lg text-deep-forest font-bold mt-1"><?= e(ps_text('कार्यक्षेत्र मैट्रिक्स', 'Impact Areas Matrix')) ?></h2>
      <p class="font-body-md text-body-md text-text-muted mt-2">
        <?= e(ps_text('पर्यावरण से लेकर मानवीय गरिमा तक — प्रदीप सारंग की सक्रियता के 8 प्रमुख स्तंभ', 'From ecological conservation to human dignity — 8 key pillars of active community engagement')) ?>
      </p>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
      <div class="bg-pure-white rounded-xl p-6 shadow-sm border border-border-warm flex flex-col items-start hover:shadow-md transition-shadow">
        <div class="w-12 h-12 rounded-xl bg-soft-meadow text-primary flex items-center justify-center mb-4">
          <span class="material-symbols-outlined text-2xl">park</span>
        </div>
        <h3 class="font-headline-sm text-headline-sm text-deep-forest font-semibold"><?= e(ps_text('पर्यावरण एवं पौधरोपण', 'Environment & Plantation')) ?></h3>
        <p class="font-body-sm text-body-sm text-text-muted mt-2"><?= e(ps_text('सघन ग्रामीण सरोकार, बंजर भूमि पर हरियाली और सतरिख क्षेत्र में सघन ग्रीन चौपाल।', 'Grassroots afforestation, green cover revival and regular Chaupal sessions.')) ?></p>
      </div>

      <div class="bg-pure-white rounded-xl p-6 shadow-sm border border-border-warm flex flex-col items-start hover:shadow-md transition-shadow">
        <div class="w-12 h-12 rounded-xl bg-soft-meadow text-tertiary flex items-center justify-center mb-4">
          <span class="material-symbols-outlined text-2xl">agriculture</span>
        </div>
        <h3 class="font-headline-sm text-headline-sm text-deep-forest font-semibold"><?= e(ps_text('ग्रामीण विकास व स्वावलंबन', 'Rural Development & Self-Reliance')) ?></h3>
        <p class="font-body-sm text-body-sm text-text-muted mt-2"><?= e(ps_text('कमरावां व समीपवर्ती गांवों में स्व-सहायता, स्वच्छता और पंचायती जन-जागरूकता।', 'Sanitation drives, self-help facilitation and active panchayat participation in Kamrawan.')) ?></p>
      </div>

      <div class="bg-pure-white rounded-xl p-6 shadow-sm border border-border-warm flex flex-col items-start hover:shadow-md transition-shadow">
        <div class="w-12 h-12 rounded-xl bg-soft-meadow text-deep-forest flex items-center justify-center mb-4">
          <span class="material-symbols-outlined text-2xl">water_drop</span>
        </div>
        <h3 class="font-headline-sm text-headline-sm text-deep-forest font-semibold"><?= e(ps_text('जल-सकोरा व पक्षी संरक्षण', 'Bird & Water Conservation')) ?></h3>
        <p class="font-body-sm text-body-sm text-text-muted mt-2"><?= e(ps_text('गर्मी में पक्षियों के लिए 10,000+ मिट्टी के जल-सकोरों का वितरण और बेजुबान परिंदों का संरक्षण।', 'Free distribution of 10,000+ earthen water bowls for birds and sparrow protection.')) ?></p>
      </div>

      <div class="bg-pure-white rounded-xl p-6 shadow-sm border border-border-warm flex flex-col items-start hover:shadow-md transition-shadow">
        <div class="w-12 h-12 rounded-xl bg-soft-meadow text-secondary flex items-center justify-center mb-4">
          <span class="material-symbols-outlined text-2xl">how_to_vote</span>
        </div>
        <h3 class="font-headline-sm text-headline-sm text-deep-forest font-semibold"><?= e(ps_text('मतदाता जागरूकता अभियान', 'Voter Awareness')) ?></h3>
        <p class="font-body-sm text-body-sm text-text-muted mt-2"><?= e(ps_text('शत-प्रतिशत निष्पक्ष मतदान और ग्रामीण अंचलों में लोकतंत्र के अधिकार का शिक्षण।', 'Mobilizing ethical voter turnout and constitutional awareness in rural hamlets.')) ?></p>
      </div>

      <div class="bg-pure-white rounded-xl p-6 shadow-sm border border-border-warm flex flex-col items-start hover:shadow-md transition-shadow">
        <div class="w-12 h-12 rounded-xl bg-soft-meadow text-primary flex items-center justify-center mb-4">
          <span class="material-symbols-outlined text-2xl">nest_multi_room</span>
        </div>
        <h3 class="font-headline-sm text-headline-sm text-deep-forest font-semibold"><?= e(ps_text('परिंदा व गौरैया संरक्षण', 'Bird & Sparrow Protection')) ?></h3>
        <p class="font-body-sm text-body-sm text-text-muted mt-2"><?= e(ps_text('घोंसला निर्माण, सुरक्षित जल सकोरे और ग्रीष्मकाल में पक्षी-मित्र स्वयंसेवक दल।', 'Nest creation, earthen water pots and summer volunteer squads for birds.')) ?></p>
      </div>

      <div class="bg-pure-white rounded-xl p-6 shadow-sm border border-border-warm flex flex-col items-start hover:shadow-md transition-shadow">
        <div class="w-12 h-12 rounded-xl bg-soft-meadow text-deep-forest flex items-center justify-center mb-4">
          <span class="material-symbols-outlined text-2xl">sports_gymnastics</span>
        </div>
        <h3 class="font-headline-sm text-headline-sm text-deep-forest font-semibold"><?= e(ps_text('युवा प्रेरणा व नशामुक्ति', 'Youth Motivation & Anti-Addiction')) ?></h3>
        <p class="font-body-sm text-body-sm text-text-muted mt-2"><?= e(ps_text('स्वामी विवेकानंद के आदर्शों पर आधारित युवा गोष्ठियां और नशामुक्त समाज संकल्प।', 'Youth conclaves inspired by Swami Vivekananda and de-addiction campaigns.')) ?></p>
      </div>

      <div class="bg-pure-white rounded-xl p-6 shadow-sm border border-border-warm flex flex-col items-start hover:shadow-md transition-shadow">
        <div class="w-12 h-12 rounded-xl bg-soft-meadow text-tertiary flex items-center justify-center mb-4">
          <span class="material-symbols-outlined text-2xl">history_edu</span>
        </div>
        <h3 class="font-headline-sm text-headline-sm text-deep-forest font-semibold"><?= e(ps_text('अवधी भाषा एवं साहित्य', 'Awadhi Language & Literature')) ?></h3>
        <p class="font-body-sm text-body-sm text-text-muted mt-2"><?= e(ps_text('लोक मुहावरे, कुंडलियाँ छंद, अवधी पत्रिकाएं और क्षेत्रीय कवियों का मंचन।', 'Preserving Awadhi idioms, Kundaliyan meters and hosting regional poetic meets.')) ?></p>
      </div>

      <div class="bg-pure-white rounded-xl p-6 shadow-sm border border-border-warm flex flex-col items-start hover:shadow-md transition-shadow">
        <div class="w-12 h-12 rounded-xl bg-soft-meadow text-secondary flex items-center justify-center mb-4">
          <span class="material-symbols-outlined text-2xl">public</span>
        </div>
        <h3 class="font-headline-sm text-headline-sm text-deep-forest font-semibold"><?= e(ps_text('राष्ट्रीय एकता व सद्भाव', 'National Unity & Harmony')) ?></h3>
        <p class="font-body-sm text-body-sm text-text-muted mt-2"><?= e(ps_text('सरदार पटेल जयंती आयोजन और सर्वधर्म सद्भावना यात्राओं का नेतृत्व।', 'Sardar Patel Jayanti commemorative programs and inter-community goodwill walks.')) ?></p>
      </div>
    </div>
  </div>
</section>

<!-- 7. IMPACT STORIES / FIELD CASE STUDIES (बदलाव की कहानियाँ) -->
<section class="w-full px-4 sm:px-8 py-8 lg:py-12 bg-soft-meadow">
  <div class="max-w-container-max mx-auto">
    <div class="mb-12">
      <span class="font-label-sm text-label-sm uppercase tracking-widest text-secondary font-bold"><?= e(ps_text('धरातल पर परिणाम', 'Real Ground Results')) ?></span>
      <h2 class="font-headline-lg text-headline-lg text-deep-forest font-bold mt-1"><?= e(ps_text('बदलाव की कहानियाँ (Case Studies)', 'Stories of Change (Case Studies)')) ?></h2>
      <p class="font-body-md text-body-md text-text-muted mt-2 max-w-2xl">
        <?= e(ps_text('समस्या से समाधान तक की वास्तविक जन-यात्रा — कैसे छोटे-छोटे सामूहिक कदमों ने बाराबंकी में बड़े बदलाव रचे।', 'Real journeys from challenges to community solutions in Barabanki.')) ?>
      </p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
      <!-- Case 1 -->
      <div class="bg-pure-white rounded-2xl p-6 lg:p-8 shadow-sm border border-border-warm flex flex-col justify-between">
        <div>
          <div class="inline-flex items-center gap-1.5 bg-soft-meadow text-primary px-3 py-1 rounded-full font-label-sm text-label-sm mb-4 border border-primary/10">
            <span class="material-symbols-outlined text-[15px]">forest</span>
            <span><?= e(ps_text('पर्यावरण संवाद', 'Ecological Dialogue')) ?></span>
          </div>
          <h3 class="font-title-lg text-title-lg text-deep-forest font-bold"><?= e(ps_text('सतरिख व बाराबंकी में ग्रीन चौपाल', 'Green Chaupal in Satrikh & Barabanki')) ?></h3>
          <div class="mt-4 space-y-3 font-body-sm text-body-sm">
            <div class="bg-surface-container-low p-3 rounded-lg">
              <span class="font-bold text-error"><?= e(ps_text('समस्या:', 'Challenge:')) ?></span>
              <p class="text-on-surface mt-0.5"><?= e(ps_text('गाँव की सड़कों और सार्वजनिक स्थलों पर कटते पेड़ और घटता हरित आवरण।', 'Shrinking tree cover and cutting of shade trees along rural pathways.')) ?></p>
            </div>
            <div class="bg-surface-container-low p-3 rounded-lg">
              <span class="font-bold text-secondary"><?= e(ps_text('पहल:', 'Initiative:')) ?></span>
              <p class="text-on-surface mt-0.5"><?= e(ps_text('माननीय वन मंत्री जी (उत्तर प्रदेश) की उपस्थिति में जनसंवाद व सामूहिक पौधा रोपण।', 'Community green chaupals in presence of UP Forest Minister and mass planting.')) ?></p>
            </div>
            <div class="bg-surface-container-low p-3 rounded-lg">
              <span class="font-bold text-primary"><?= e(ps_text('परिणाम:', 'Outcome:')) ?></span>
              <p class="text-on-surface mt-0.5"><?= e(ps_text("500+ ग्रामीण परिवारों ने स्वेच्छा से अपने घर के बाहर 'एक पौधा अपनी संतान के नाम' लगाया।", "500+ rural households pledged to plant and nurture a tree in their child's name.")) ?></p>
            </div>
          </div>
        </div>
        <div class="mt-6 pt-4 border-t border-surface-container flex items-center justify-between text-text-muted font-label-sm text-label-sm">
          <span><?= e(ps_text('स्थान: सतरिख, बाराबंकी', 'Location: Satrikh, Barabanki')) ?></span>
          <span class="text-primary font-bold"><?= e(ps_text('सफलता दर: 92%', 'Survival Rate: 92%')) ?></span>
        </div>
      </div>

      <!-- Case 2 -->
      <div class="bg-pure-white rounded-2xl p-6 lg:p-8 shadow-sm border border-border-warm flex flex-col justify-between">
        <div>
          <div class="inline-flex items-center gap-1.5 bg-secondary-fixed/40 text-secondary px-3 py-1 rounded-full font-label-sm text-label-sm mb-4">
            <span class="material-symbols-outlined text-[15px]">water_drop</span>
            <span><?= e(ps_text('परिंदा रक्षक', 'Bird Care')) ?></span>
          </div>
          <h3 class="font-title-lg text-title-lg text-deep-forest font-bold"><?= e(ps_text('भीषण ग्रीष्म में जल-पात्र वितरण', 'Summer Bird Water Feeder Drive')) ?></h3>
          <div class="mt-4 space-y-3 font-body-sm text-body-sm">
            <div class="bg-surface-container-low p-3 rounded-lg">
              <span class="font-bold text-error"><?= e(ps_text('समस्या:', 'Challenge:')) ?></span>
              <p class="text-on-surface mt-0.5"><?= e(ps_text('मई-जून की 45°C गर्मी में जलस्रोतों के सूखने से परिंदों और गौरैयों की असामयिक मृत्यु।', 'Extreme 45°C summer causing dehydration and death among local bird populations.')) ?></p>
            </div>
            <div class="bg-surface-container-low p-3 rounded-lg">
              <span class="font-bold text-secondary"><?= e(ps_text('पहल:', 'Initiative:')) ?></span>
              <p class="text-on-surface mt-0.5"><?= e(ps_text('कमरावां और निकटवर्ती बाजारों में स्वयं सहायता समूहों द्वारा मिट्टी के 2,500 सकोरे निशुल्क वितरित।', 'Free distribution of 2,500 earthen bowls with community pledge in Kamrawan.')) ?></p>
            </div>
            <div class="bg-surface-container-low p-3 rounded-lg">
              <span class="font-bold text-primary"><?= e(ps_text('परिणाम:', 'Outcome:')) ?></span>
              <p class="text-on-surface mt-0.5"><?= e(ps_text('सैकड़ों पक्षी प्रेमियों का नेटवर्क बना जो प्रतिदिन प्रातः सकोरों में ताजा पानी भरते हैं।', 'A self-sustaining network of volunteers refilling fresh water bowls daily.')) ?></p>
            </div>
          </div>
        </div>
        <div class="mt-6 pt-4 border-t border-surface-container flex items-center justify-between text-text-muted font-label-sm text-label-sm">
          <span><?= e(ps_text('स्थान: ग्रामीण अंचल', 'Location: Rural Belt')) ?></span>
          <span class="text-secondary font-bold"><?= e(ps_text('2500+ सकोरे सक्रिय', '2,500+ Active Feeders')) ?></span>
        </div>
      </div>

      <!-- Case 3 -->
      <div class="bg-pure-white rounded-2xl p-6 lg:p-8 shadow-sm border border-border-warm flex flex-col justify-between">
        <div>
          <div class="inline-flex items-center gap-1.5 bg-soft-meadow text-deep-forest px-3 py-1 rounded-full font-label-sm text-label-sm mb-4 border border-border-warm font-semibold">
            <span class="material-symbols-outlined text-[15px]">water_drop</span>
            <span><?= e(ps_text('परिंदा संरक्षण', 'Bird Protection')) ?></span>
          </div>
          <h3 class="font-title-lg text-title-lg text-deep-forest font-bold"><?= e(ps_text('मिट्टी के जल-सकोरे व गौरैया बचाओ अभियान', 'Sparrow & Bird Protection Drive')) ?></h3>
          <div class="mt-4 space-y-3 font-body-sm text-body-sm">
            <div class="bg-surface-container-low p-3 rounded-lg">
              <span class="font-bold text-deep-forest"><?= e(ps_text('समस्या:', 'Challenge:')) ?></span>
              <p class="text-on-surface mt-0.5"><?= e(ps_text('भीषण गर्मी में पानी और भोजन के अभाव में बेजुबान पक्षियों एवं विलुप्त होती गौरैया का संकट।', 'Shortage of water and food causing severe decline in local sparrows and birds during summer.')) ?></p>
            </div>
            <div class="bg-surface-container-low p-3 rounded-lg">
              <span class="font-bold text-secondary"><?= e(ps_text('पहल:', 'Initiative:')) ?></span>
              <p class="text-on-surface mt-0.5"><?= e(ps_text('प्रदीप सारंग द्वारा 10,000+ मिट्टी के जल-सकोरों का वितरण एवं युवाओं द्वारा नियमित दाना-पानी व्यवस्था।', 'Distribution of 10,000+ earthen water bowls and establishing grain feeds across villages.')) ?></p>
            </div>
            <div class="bg-surface-container-low p-3 rounded-lg">
              <span class="font-bold text-primary"><?= e(ps_text('परिणाम:', 'Outcome:')) ?></span>
              <p class="text-on-surface mt-0.5"><?= e(ps_text('हजारों परिंदों को मिला जीवन और ग्रामीण युवाओं में बेजुबानों के प्रति करुणा का प्रसार।', 'Thousands of birds saved and compassion fostered among village youth.')) ?></p>
            </div>
          </div>
        </div>
        <div class="mt-6 pt-4 border-t border-surface-container flex items-center justify-between text-text-muted font-label-sm text-label-sm">
          <span><?= e(ps_text('स्थान: बाराबंकी (कमरावां व ग्रामीण अंचल)', 'Location: Barabanki Rural')) ?></span>
          <span class="text-deep-forest font-bold"><?= e(ps_text('10,000+ जल-सकोरे वितरित', '10,000+ Bowls Distributed')) ?></span>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- 8. JOURNEY TIMELINE (चार दशकों की सेवा यात्रा: 1987 से आज तक) -->
<section class="w-full px-4 sm:px-8 py-8 lg:py-12" id="journey">
  <div class="max-w-container-max mx-auto">
    <div class="text-center max-w-2xl mx-auto mb-14">
      <span class="font-label-sm text-label-sm uppercase tracking-widest text-primary font-bold"><?= e(ps_text('इतिहास एवं पड़ाव', 'Milestones & History')) ?></span>
      <h2 class="font-headline-lg text-headline-lg text-deep-forest font-bold mt-1"><?= e(ps_text('चार दशकों की सेवा यात्रा (1987 से आज तक)', 'Four Decades of Service (1987 — Present)')) ?></h2>
      <p class="font-body-md text-body-md text-text-muted mt-2">
        <?= e(ps_text('कमरावां के एक संवेदनशील किशोर से लेकर राष्ट्रीय मंचों तक समाज व पर्यावरण की अथक साधना', 'From Kamrawan youth leadership to statewide recognition in social service and literature')) ?>
      </p>
    </div>

    <div class="relative border-l-2 border-surface-container-highest max-w-3xl mx-auto pl-6 sm:pl-8 space-y-10">
      <!-- Milestone 1 -->
      <div class="relative">
        <div class="absolute -left-[35px] sm:-left-[43px] top-1 w-6 h-6 rounded-full bg-primary-container text-on-primary flex items-center justify-center shadow">
          <span class="w-2 h-2 rounded-full bg-pure-white"></span>
        </div>
        <span class="font-label-md text-label-md font-bold text-secondary">1987 – 1988</span>
        <h3 class="font-title-lg text-title-lg font-bold text-deep-forest mt-1">
          <?= e(ps_text('इंडिया गेट राष्ट्रीय गणतंत्र दिवस परेड में सहभागिता', 'Participation in National Republic Day Parade at India Gate')) ?>
        </h3>
        <p class="font-body-md text-body-md text-on-surface-variant mt-2 leading-relaxed">
          <?= e(ps_text('नई दिल्ली में 26 जनवरी गणतंत्र दिवस राष्ट्रीय परेड में युवा दल के रूप में शामिल होकर अनुशासन, राष्ट्रीय सेवा और लोक कल्याण का सर्वोच्च पाठ सीखा।', 'Represented the youth contingent at the 26 January National Republic Day Parade at India Gate, New Delhi.')) ?>
        </p>
      </div>

      <!-- Milestone 2 -->
      <div class="relative">
        <div class="absolute -left-[35px] sm:-left-[43px] top-1 w-6 h-6 rounded-full bg-primary-container text-on-primary flex items-center justify-center shadow">
          <span class="w-2 h-2 rounded-full bg-pure-white"></span>
        </div>
        <span class="font-label-md text-label-md font-bold text-tertiary">1989</span>
        <h3 class="font-title-lg text-title-lg font-bold text-deep-forest mt-1">
          <?= e(ps_text("माननीय राज्यपाल (उ.प्र.) द्वारा 'स्वामी विवेकानंद सम्मान'", "Conferred 'Swami Vivekananda Award' by Hon'ble Governor of UP")) ?>
        </h3>
        <p class="font-body-md text-body-md text-on-surface-variant mt-2 leading-relaxed">
          <?= e(ps_text('उत्कृष्ट समाज सेवा, युवा नेतृत्व और ग्रामीण विकास कार्यों के लिए उत्तर प्रदेश के तत्कालीन राज्यपाल महोदय द्वारा स्वामी विवेकानंद पुरस्कार प्रदान किया गया।', 'Honored for outstanding rural youth leadership and community welfare by the Governor of Uttar Pradesh at Raj Bhavan.')) ?>
        </p>
      </div>

      <!-- Milestone 3 -->
      <div class="relative">
        <div class="absolute -left-[35px] sm:-left-[43px] top-1 w-6 h-6 rounded-full bg-primary-container text-on-primary flex items-center justify-center shadow">
          <span class="w-2 h-2 rounded-full bg-pure-white"></span>
        </div>
        <span class="font-label-md text-label-md font-bold text-primary">2010 – 2018</span>
        <h3 class="font-title-lg text-title-lg font-bold text-deep-forest mt-1">
          <?= e(ps_text('कपड़ा-बैंक, गौरैया संवर्धन व मतदाता चेतना विस्तार', 'Cloth Bank, Sparrow Protection & Voter Awareness Rallies')) ?>
        </h3>
        <p class="font-body-md text-body-md text-on-surface-variant mt-2 leading-relaxed">
          <?= e(ps_text('ग्रामीण बाराबंकी में जरूरतमंदों के लिए कपड़ा बैंक की स्थापना, परिंदों के लिए दाना-पानी अभियान और लोकतंत्र सुदृढ़ीकरण हेतु व्यापक मतदाता जागरूकता रैलियां।', 'Establishment of community cloth bank in rural Barabanki, bird grain-water drives and extensive voter education rallies.')) ?>
        </p>
      </div>

      <!-- Milestone 4 -->
      <div class="relative">
        <div class="absolute -left-[35px] sm:-left-[43px] top-1 w-6 h-6 rounded-full bg-fresh-sprout text-deep-forest flex items-center justify-center shadow">
          <span class="w-2 h-2 rounded-full bg-deep-forest"></span>
        </div>
        <span class="font-label-md text-label-md font-bold text-primary">05 जून 2019</span>
        <h3 class="font-title-lg text-title-lg font-bold text-deep-forest mt-1">
          <?= e(ps_text("'ग्रीन गैंग' की ऐतिहासिक स्थापना व 'ग्रीन मॉर्निंग' सूत्रपात", "Historic Foundation of 'Green Gang' & 'Green Morning' Initiation")) ?>
        </h3>
        <p class="font-body-md text-body-md text-on-surface-variant mt-2 leading-relaxed">
          <?= e(ps_text("विश्व पर्यावरण दिवस पर धरती पर हरियाली बढ़ाने और जनमानस के दैनिक अभिवादन में 'ग्रीन मॉर्निंग' की वैज्ञानिक और भावनात्मक नींव रखी गई।", "Laying the emotional and scientific foundation of 'Green Morning' greetings on World Environment Day to scale community afforestation.")) ?>
        </p>
      </div>

      <!-- Milestone 5 -->
      <div class="relative">
        <div class="absolute -left-[35px] sm:-left-[43px] top-1 w-6 h-6 rounded-full bg-secondary text-pure-white flex items-center justify-center shadow">
          <span class="w-2 h-2 rounded-full bg-pure-white"></span>
        </div>
        <span class="font-label-md text-label-md font-bold text-secondary">2026 (वर्तमान)</span>
        <h3 class="font-title-lg text-title-lg font-bold text-deep-forest mt-1">
          <?= e(ps_text("स्वरचित 'सारंग-कुंडलियाँ' एवं साझा संग्रह 'काव्य-मंजरी'", "Publication of 'Sarang-Kundaliyan' & Anthology 'Kavya-Manjari'")) ?>
        </h3>
        <p class="font-body-md text-body-md text-on-surface-variant mt-2 leading-relaxed">
          <?= e(ps_text('151 स्वरचित कुंडलियों के काव्य संग्रह का ऐतिहासिक प्रकाशन और अवधी लोक संस्कृति के संरक्षण हेतु साहित्यकारों का वृहद समागम।', 'Publication of 151 original Kundaliyan verses and editing representative poetic anthology celebrating Awadhi heritage.')) ?>
        </p>
      </div>
    </div>
  </div>
</section>

<!-- 9. FIELD WORK PHOTO STORY (सेवा के क्षण - सचित्र दीर्घा) -->
<section class="w-full px-4 sm:px-8 py-8 lg:py-12 bg-soft-meadow" id="gallery">
  <div class="max-w-container-max mx-auto">
    <div class="flex flex-col md:flex-row md:items-end justify-between mb-10 gap-4">
      <div>
        <span class="font-label-sm text-label-sm uppercase tracking-widest text-primary font-bold"><?= e(ps_text('चित्र दीर्घा', 'Photo Gallery')) ?></span>
        <h2 class="font-headline-lg text-headline-lg text-deep-forest font-bold mt-1"><?= e(ps_text('सेवा के क्षण - सचित्र दीर्घा (Impact in Pictures)', 'Impact in Pictures (Photo Gallery)')) ?></h2>
        <p class="font-body-md text-body-md text-text-muted mt-2">
          <?= e(ps_text('धरातल पर हुए पर्यावरण कार्यक्रमों, सम्मान समारोहों और जनसेवा के जीवंत छायाचित्र', 'Photographs of environmental drives, literary symposia and community events')) ?>
        </p>
      </div>
      <!-- Category Filter Tabs -->
      <div class="flex items-center gap-2 overflow-x-auto pb-2" id="gallery-filters">
        <button class="gallery-filter-btn px-3.5 py-1.5 rounded-lg bg-primary-container text-on-primary font-label-sm text-label-sm font-semibold transition-all" data-category="all" type="button"><?= e(ps_text('सभी छायाचित्र', 'All Photos')) ?></button>
        <button class="gallery-filter-btn px-3.5 py-1.5 rounded-lg bg-pure-white text-on-surface-variant hover:text-deep-forest font-label-sm text-label-sm shadow-sm transition-all border border-border-warm" data-category="env" type="button"><?= e(ps_text('पर्यावरण', 'Environment')) ?></button>
        <button class="gallery-filter-btn px-3.5 py-1.5 rounded-lg bg-pure-white text-on-surface-variant hover:text-deep-forest font-label-sm text-label-sm shadow-sm transition-all border border-border-warm" data-category="lit" type="button"><?= e(ps_text('काव्य गोष्ठी', 'Literature')) ?></button>
        <button class="gallery-filter-btn px-3.5 py-1.5 rounded-lg bg-pure-white text-on-surface-variant hover:text-deep-forest font-label-sm text-label-sm shadow-sm transition-all border border-border-warm" data-category="award" type="button"><?= e(ps_text('सम्मान', 'Honors')) ?></button>
      </div>
    </div>

    <!-- Photo Grid -->
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 sm:gap-6" id="gallery-grid">
      <?php 
      // Curated gallery items combining DB items and project assets
      $displayGallery = [];
      if (!empty($gallery)) {
          $displayGallery = array_slice($gallery, 0, 8);
      }
      $samplePhotos = [
          ['title' => ps_text('ग्रीन चौपाल सतरिख • 2026', 'Green Chaupal Satrikh 2026'), 'image' => 'assets/images/slider_final_1.webp', 'cat' => 'env'],
          ['title' => ps_text('काव्य-मंजरी संपादन • बाराबंकी', 'Kavya-Manjari Release Barabanki'), 'image' => 'assets/images/slider_final_3.webp', 'cat' => 'lit'],
          ['title' => ps_text('परिंदा जलपात्र वितरण • ग्रीष्म', 'Bird Water Feeder Distribution'), 'image' => 'assets/images/slider_final_2.webp', 'cat' => 'env'],
          ['title' => ps_text('सारंग-कुंडलियाँ विमोचन मंच', 'Sarang-Kundaliyan Book Launch'), 'image' => 'assets/images/slider_final_3.webp', 'cat' => 'award'],
          ['title' => ps_text('नाट्य अभिनय कार्यशाला • बाराबंकी', 'Theatre Workshop Barabanki'), 'image' => 'assets/images/slider_final_4.webp', 'cat' => 'lit'],
          ['title' => ps_text('मा. वन मंत्री जी के संग चौपाल', 'Chaupal with UP Forest Minister'), 'image' => 'assets/images/slider_final_1.webp', 'cat' => 'env'],
          ['title' => ps_text('युवा चेतना संवाद', 'Youth Motivation Session'), 'image' => 'assets/images/slider_final_5.webp', 'cat' => 'lit'],
          ['title' => ps_text('रंगमंच फाउंडेशन बाराबंकी', 'Rangmanch Foundation Barabanki'), 'image' => 'assets/images/slider_final_2.webp', 'cat' => 'award'],
      ];

      foreach ($samplePhotos as $idx => $photo): 
          $imgSrc = ps_resolve_img($displayGallery[$idx]['image'] ?? $photo['image'], $photo['image']);
          $caption = !empty($displayGallery[$idx]['title']) && $displayGallery[$idx]['title'] !== 'erer' ? $displayGallery[$idx]['title'] : $photo['title'];
          $cat = $photo['cat'];
      ?>
        <div class="gallery-item relative group rounded-xl overflow-hidden shadow-sm bg-pure-white aspect-square border border-border-warm cursor-pointer" 
             data-category="<?= e($cat) ?>"
             onclick="openLightbox('<?= e($imgSrc) ?>', '<?= e($caption) ?>')">
          <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" 
               src="<?= e($imgSrc) ?>" 
               alt="<?= e($caption) ?>"/>
          <div class="absolute inset-0 bg-gradient-to-t from-deep-forest/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity flex items-end p-3 text-pure-white font-label-sm text-label-sm">
            <span><?= e($caption) ?></span>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- 10. AWARDS & ACHIEVEMENTS (सम्मान एवं उपलब्धियाँ) -->
<section class="w-full px-4 sm:px-8 py-8 lg:py-12" id="awards">
  <div class="max-w-container-max mx-auto">
    <div class="text-center max-w-2xl mx-auto mb-14">
      <span class="font-label-sm text-label-sm uppercase tracking-widest text-tertiary font-bold"><?= e(ps_text('राष्ट्रीय व राजकीय मान्यता', 'State & National Recognition')) ?></span>
      <h2 class="font-headline-lg text-headline-lg text-deep-forest font-bold mt-1"><?= e(ps_text('सम्मान एवं उपलब्धियाँ', 'Honors & Achievements')) ?></h2>
      <p class="font-body-md text-body-md text-text-muted mt-2">
        <?= e(ps_text('समाज, संस्कृति और पर्यावरण के क्षेत्र में अद्वितीय योगदान के लिए मिले प्रमुख अलंकरण', 'Major awards received for distinguished contributions in environment, literature and social work')) ?>
      </p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
      <div class="bg-pure-white rounded-2xl p-6 shadow-sm border border-border-warm flex flex-col justify-between border-t-4 border-tertiary-container hover:shadow-md transition-shadow">
        <div>
          <span class="material-symbols-outlined text-tertiary text-4xl mb-3">military_tech</span>
          <span class="font-label-sm text-label-sm text-tertiary font-bold uppercase"><?= e(ps_text('वर्ष 1989 • राजभवन', 'Year 1989 • Raj Bhavan')) ?></span>
          <h3 class="font-title-lg text-title-lg font-bold text-deep-forest mt-1"><?= e(ps_text('स्वामी विवेकानंद सम्मान', 'Swami Vivekananda Award')) ?></h3>
          <p class="font-body-sm text-body-sm text-text-muted mt-2">
            <?= e(ps_text('तत्कालीन माननीय राज्यपाल उत्तर प्रदेश द्वारा उत्कृष्ट समाज सेवा व युवा चेतना सृजन हेतु प्रदान किया गया सर्वोच्च सम्मान।', 'Presented by the Hon\'ble Governor of Uttar Pradesh for exemplary grassroots service.')) ?>
          </p>
        </div>
        <div class="mt-6 pt-3 border-t border-surface-container text-text-muted font-label-sm text-label-sm">
          <?= e(ps_text('प्रदाता: उत्तर प्रदेश शासन', 'Conferred by: Govt. of Uttar Pradesh')) ?>
        </div>
      </div>

      <div class="bg-pure-white rounded-2xl p-6 shadow-sm border border-border-warm flex flex-col justify-between border-t-4 border-secondary hover:shadow-md transition-shadow">
        <div>
          <span class="material-symbols-outlined text-secondary text-4xl mb-3">flag</span>
          <span class="font-label-sm text-label-sm text-secondary font-bold uppercase"><?= e(ps_text('1987 – 1988 • नई दिल्ली', '1987 – 1988 • New Delhi')) ?></span>
          <h3 class="font-title-lg text-title-lg font-bold text-deep-forest mt-1"><?= e(ps_text('गणतंत्र दिवस परेड सम्मान', 'Republic Day Parade Honor')) ?></h3>
          <p class="font-body-sm text-body-sm text-text-muted mt-2">
            <?= e(ps_text('इंडिया गेट पर 26 जनवरी राष्ट्रीय गणतंत्र दिवस परेड में राष्ट्रीय सेवा कार्यों के प्रतिनिधित्व हेतु प्रशस्ति पत्र।', 'Certificate of honor for representing youth social service contingent at India Gate.')) ?>
          </p>
        </div>
        <div class="mt-6 pt-3 border-t border-surface-container text-text-muted font-label-sm text-label-sm">
          <?= e(ps_text('स्थल: इंडिया गेट, नई दिल्ली', 'Venue: India Gate, New Delhi')) ?>
        </div>
      </div>

      <div class="bg-pure-white rounded-2xl p-6 shadow-sm border border-border-warm flex flex-col justify-between border-t-4 border-primary hover:shadow-md transition-shadow">
        <div>
          <span class="material-symbols-outlined text-primary text-4xl mb-3">forest</span>
          <span class="font-label-sm text-label-sm text-primary font-bold uppercase"><?= e(ps_text('हरित क्रांति सम्मान', 'Green Revolution Honor')) ?></span>
          <h3 class="font-title-lg text-title-lg font-bold text-deep-forest mt-1"><?= e(ps_text('पर्यावरण गौरव सम्मान', 'Paryavaran Gaurav Honor')) ?></h3>
          <p class="font-body-sm text-body-sm text-text-muted mt-2">
            <?= e(ps_text('ग्रीन चौपाल अभियान तथा बाराबंकी व सतरिख में वृहद जनसहभागिता पौधरोपण मुहिम हेतु वन विभाग व नागरिक मंचों द्वारा प्रदत्त।', 'Conferred for community afforestation and public Green Chaupal dialogues.')) ?>
          </p>
        </div>
        <div class="mt-6 pt-3 border-t border-surface-container text-text-muted font-label-sm text-label-sm">
          <?= e(ps_text('पहल: ग्रीन गैंग अभियान', 'Initiative: Green Gang')) ?>
        </div>
      </div>

      <div class="bg-pure-white rounded-2xl p-6 shadow-sm border border-border-warm flex flex-col justify-between border-t-4 border-tertiary hover:shadow-md transition-shadow">
        <div>
          <span class="material-symbols-outlined text-tertiary text-4xl mb-3">history_edu</span>
          <span class="font-label-sm text-label-sm text-tertiary font-bold uppercase"><?= e(ps_text('साहित्यिक संवर्धन', 'Literary Enrichment')) ?></span>
          <h3 class="font-title-lg text-title-lg font-bold text-deep-forest mt-1"><?= e(ps_text('अवधी भाषा शिरोमणि सम्मान', 'Awadhi Bhasha Shiromani')) ?></h3>
          <p class="font-body-sm text-body-sm text-text-muted mt-2">
            <?= e(ps_text("'सारंग-कुंडलियाँ' एवं अवधी लोक-गद्य के संरक्षण तथा ग्रामीण नवोदित कवियों को मंच प्रदान करने हेतु विशेष सारस्वत सम्मान।", "Special Saraswat recognition for 'Sarang-Kundaliyan' and preserving Awadhi dialect heritage.")) ?>
          </p>
        </div>
        <div class="mt-6 pt-3 border-t border-surface-container text-text-muted font-label-sm text-label-sm">
          <?= e(ps_text('मंच: अवधी साहित्य परिषद', 'Platform: Awadhi Sahitya Parishad')) ?>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- 11. MEDIA COVERAGE & PRESS ARCHIVE (अखबारों के पन्नों से) -->
<section class="w-full px-4 sm:px-8 py-8 lg:py-12 bg-soft-meadow" id="media">
  <div class="max-w-container-max mx-auto">
    <div class="flex flex-col md:flex-row md:items-end justify-between mb-12 gap-4">
      <div>
        <span class="font-label-sm text-label-sm uppercase tracking-widest text-secondary font-bold"><?= e(ps_text('मीडिया कवरेज', 'Media Coverage')) ?></span>
        <h2 class="font-headline-lg text-headline-lg text-deep-forest font-bold mt-1"><?= e(ps_text('अखबारों के पन्नों से (Newspaper Cuttings)', 'From the Press (Newspaper Cuttings)')) ?></h2>
        <p class="font-body-md text-body-md text-text-muted mt-2 max-w-2xl">
          <?= e(ps_text('दैनिक जागरण, अमर उजाला, राष्ट्रीय सहारा आदि प्रमुख समाचार पत्रों में प्रकाशित प्रदीप सारंग के अभियानों की प्रामाणिक कतरनें', 'Authentic press clippings documenting campaigns across prominent newspapers')) ?>
        </p>
      </div>
      <div class="inline-flex items-center gap-2 text-text-muted font-label-sm text-label-sm">
        <span class="material-symbols-outlined text-[18px] text-primary">verified</span>
        <span><?= e(ps_text('आधिकारिक प्रेस अभिलेखागार', 'Official Press Archive')) ?></span>
      </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
      <?php 
      $displayMedia = array_slice($media, 0, 4);
      $sampleMedia = [
          ['date' => '13 अगस्त 2026', 'title' => ps_text('संस्थान मनायेगा गोस्वामी तुलसीदास पखवारा', 'Institute to Celebrate Tulsidas Fortnight'), 'sub' => ps_text('साहित्य सम्मेलन एवं अवधी गोष्ठी', 'Literature Meet & Awadhi Chaupal'), 'img' => 'uploads/newspaper/69edcfeb796bc_slider_final_1.jpg'],
          ['date' => '11 अगस्त 2026', 'title' => ps_text('पर्यावरण प्रेमी प्रदीप सारंग का जन्मदिन हरित संकल्प के संग', 'Pradeep Sarang Birthday with Green Pledge'), 'sub' => ps_text('ग्रीन मॉर्निंग अभियान को जन समर्थन', 'Public Support for Green Morning'), 'img' => 'uploads/newspaper/69eddb5769ec4_634831113_25846243011705368_3828941456166600751_n.jpg'],
          ['date' => '07 जुलाई 2026', 'title' => ps_text('लेखों और काव्य मंजरी का हुआ भव्य विमोचन', 'Grand Release of Articles and Kavya Manjari'), 'sub' => ps_text('साहित्यिक अनुष्ठान एवं परिचर्चा', 'Literary Discussion & Release'), 'img' => 'uploads/newspaper/69eddb576da83_642769315_25956675840662084_10802377396645739_n.jpg'],
          ['date' => '04 जुलाई 2026', 'title' => ps_text('सतरिख में सजी ग्रीन चौपाल, वन मंत्री ने की सराहना', 'Green Chaupal in Satrikh Praised by Forest Minister'), 'sub' => ps_text('पर्यावरण संवर्धन का अनूठा मॉडल', 'Unique Model of Environmental Care'), 'img' => 'uploads/newspaper/69eddb576e022_649190291_26047597464903254_9163711197671179365_n.jpg'],
      ];

      foreach ($sampleMedia as $mIdx => $mItem):
          $mediaImg = ps_resolve_img($displayMedia[$mIdx]['image'] ?? $mItem['img'], 'assets/images/slider_final_1.jpg');
          $rawTitle = trim($displayMedia[$mIdx]['title'] ?? '');
          $cleanRaw = preg_replace('/[^a-z0-9]/', '', strtolower($rawTitle));
          if (empty($rawTitle) || in_array($cleanRaw, ['newspaper', 'news', 'test', 'erer', 'sample'], true)) {
              $mediaTitle = $mItem['title'];
          } else {
              $mediaTitle = $rawTitle;
          }
      ?>
        <div class="bg-pure-white rounded-xl overflow-hidden shadow-sm border border-border-warm flex flex-col hover:shadow-md transition-shadow cursor-pointer"
             onclick="openLightbox('<?= e($mediaImg) ?>', '<?= e($mediaTitle) ?>')">
          <div class="h-60 bg-surface-container overflow-hidden">
            <img class="w-full h-full object-cover hover:scale-105 transition-transform duration-300" 
                 src="<?= e($mediaImg) ?>" 
                 alt="<?= e($mediaTitle) ?>"/>
          </div>
          <div class="p-4 flex flex-col flex-1 justify-between">
            <div>
              <span class="font-label-sm text-label-sm text-text-muted"><?= e($mItem['date']) ?></span>
              <h4 class="font-title-md text-title-md font-bold text-deep-forest mt-1"><?= e($mediaTitle) ?></h4>
            </div>
            <span class="font-body-sm text-body-sm text-text-muted mt-3"><?= e($mItem['sub']) ?></span>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- 12. UPCOMING & PAST EVENTS (कार्यक्रम व गतिविधियाँ) -->
<section class="w-full px-4 sm:px-8 py-8 lg:py-12" id="events">
  <div class="max-w-container-max mx-auto">
    <div class="flex flex-col md:flex-row md:items-end justify-between mb-12 gap-4">
      <div>
        <span class="font-label-sm text-label-sm uppercase tracking-widest text-primary font-bold"><?= e(ps_text('आयोजन एवं संगम', 'Gatherings & Events')) ?></span>
        <h2 class="font-headline-lg text-headline-lg text-deep-forest font-bold mt-1"><?= e(ps_text('कार्यक्रम व गतिविधियाँ (Events)', 'Events & Community Dialogues')) ?></h2>
        <p class="font-body-md text-body-md text-text-muted mt-2">
          <?= e(ps_text('आगामी व पूर्व में संपन्न हुए साहित्यिक, पर्यावरणीय एवं सामाजिक समागम', 'Upcoming and past literary, environmental and social programs')) ?>
        </p>
      </div>
      <a class="inline-flex items-center gap-2 text-primary hover:text-deep-forest font-label-md text-label-md font-bold transition-colors" href="<?= e(base_url('/events')) ?>">
        <span><?= e(ps_text('सभी कार्यक्रम देखें', 'View All Events')) ?></span>
        <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
      </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
      <!-- Upcoming Events Column (7 Cols) -->
      <div class="lg:col-span-7 space-y-6">
        <div class="flex items-center gap-2 pb-2">
          <span class="w-3 h-3 rounded-full bg-fresh-sprout animate-pulse"></span>
          <h3 class="font-title-lg text-title-lg font-bold text-deep-forest"><?= e(ps_text('आगामी कार्यक्रम (Upcoming Events)', 'Upcoming Events')) ?></h3>
        </div>

        <?php 
        $todayStr = date('Y-m-d');
        $dbEventsList = $events ?? [];

        $realUpcoming = array_values(array_filter($dbEventsList, fn($ev) => !empty($ev['event_date']) && $ev['event_date'] >= $todayStr));
        $realPast = array_values(array_filter($dbEventsList, fn($ev) => !empty($ev['event_date']) && $ev['event_date'] < $todayStr));

        if (empty($realUpcoming)) {
            $realUpcoming = [
                [
                    'title' => ps_text('अवधी लोक साहित्य महाकुंभ एवं कवि सम्मेलन', 'Awadhi Literature Conference & Kavi Sammelan'),
                    'event_date' => '2026-10-18',
                    'excerpt' => ps_text('अवध के प्रतिष्ठित कवियों एवं मनीषियों की गरिमामयी उपस्थिति में अवधी भाषा प्रसार तथा भव्य काव्य गोष्ठी का आयोजन।', 'Awadhi literature symposium and poetry meet with distinguished Awadh scholars.'),
                    'location' => ps_text('गांधी भवन प्रेक्षागृह, बाराबंकी (उ.प्र.)', 'Gandhi Bhawan Auditorium, Barabanki (U.P.)'),
                    'image' => 'uploads/6a471c1fedba6_Photo-20260702-074405-S-1079x1085.png',
                    'slug' => 'awadhi-literature-conference-2026'
                ],
                [
                    'title' => ps_text('सरदार पटेल स्मृति चेतना यात्रा व जन-चौपाल', 'Sardar Patel Chetna Yatra & Chaupal'),
                    'event_date' => '2026-10-31',
                    'excerpt' => ps_text('राष्ट्रनायक सरदार वल्लभभाई पटेल जयंती के अवसर पर ग्रामीण स्वावलंबन, किसान सम्मान एवं सामाजिक सद्भाव महारैली।', 'Rally & village dialogue celebrating Sardar Patel Jayanti.'),
                    'location' => ps_text('कमरावां, बाराबंकी (उ.प्र.)', 'Kamrawan, Barabanki (U.P.)'),
                    'image' => 'assets/images/slider_final_1.jpg',
                    'slug' => 'sardar-patel-chetna-yatra-2026'
                ],
                [
                    'title' => ps_text('शीतकालीन परिंदा संरक्षण व जल-सकोरा वितरण अभियान', 'Winter Bird Conservation Campaign'),
                    'event_date' => '2026-11-15',
                    'excerpt' => ps_text('पर्यावरण चेतना तथा शीतकालीन पक्षी संरक्षण एवं ग्रामीण विद्यालयों में विद्यार्थियों संग पौधरोपण व हरित संदेश।', 'Environmental awareness, bird feeder distribution, and tree planting.'),
                    'location' => ps_text('बाराबंकी व आसपास के सीमांचल क्षेत्र', 'Barabanki & Border Areas'),
                    'image' => 'uploads/69eddd5d31818_pradeepsarang.webp',
                    'slug' => 'winter-bird-conservation-campaign-2026'
                ]
            ];
        }

        foreach (array_slice($realUpcoming, 0, 3) as $uEvent):
            $uImg = ps_resolve_img($uEvent['image'] ?? '', 'assets/images/slider_final_1.jpg');
            $uTitle = $uEvent['title'];
            $uDateStr = format_date($uEvent['event_date'] ?? '2026-10-18');
            $uLoc = !empty($uEvent['location']) ? $uEvent['location'] : ps_text('बाराबंकी, उत्तर प्रदेश', 'Barabanki, UP');
            $uSlug = $uEvent['slug'] ?? 'events';
            $uDesc = !empty($uEvent['excerpt']) ? $uEvent['excerpt'] : (!empty($uEvent['content']) ? ps_excerpt($uEvent, 140) : '');
        ?>
          <div class="bg-pure-white rounded-xl p-6 shadow-sm border border-border-warm hover:shadow-md transition-shadow flex flex-col sm:flex-row gap-5 items-start">
            <div class="w-full sm:w-36 h-36 rounded-lg overflow-hidden shrink-0 bg-surface-container">
              <img class="w-full h-full object-cover" 
                   src="<?= e($uImg) ?>" 
                   alt="<?= e($uTitle) ?>"/>
            </div>
            <div class="flex flex-col flex-1">
              <div class="flex items-center gap-2">
                <span class="bg-primary-container text-on-primary text-[11px] font-bold px-2 py-0.5 rounded"><?= e(ps_text('आगामी', 'Upcoming')) ?></span>
                <span class="font-label-sm text-label-sm text-text-muted"><?= e($uDateStr) ?></span>
              </div>
              <h4 class="font-title-lg text-title-lg font-bold text-deep-forest mt-1.5">
                <a href="<?= e(base_url('/events/' . $uSlug)) ?>" class="hover:text-primary transition-colors"><?= e($uTitle) ?></a>
              </h4>
              <p class="font-body-sm text-body-sm text-text-muted mt-1"><?= e($uDesc) ?></p>
              <div class="mt-3 flex items-center gap-1.5 text-text-muted font-body-sm text-body-sm">
                <span class="material-symbols-outlined text-[16px] text-primary">location_on</span>
                <span><?= e($uLoc) ?></span>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>

      <!-- Past Events Column (5 Cols) -->
      <div class="lg:col-span-5 space-y-6">
        <div class="flex items-center gap-2 pb-2">
          <span class="w-3 h-3 rounded-full bg-text-muted"></span>
          <h3 class="font-title-lg text-title-lg font-bold text-deep-forest"><?= e(ps_text('सम्पन्न आयोजन (Past Events)', 'Past Events')) ?></h3>
        </div>

        <?php 
        if (empty($realPast)) {
            $realPast = [
                [
                    'title' => ps_text('स्वरचित 151 कुंडलियों का संग्रह "सारंग-कुंडलियाँ" का प्रकाशन', 'Publication of 151 Kundaliyan Anthology "Sarang-Kundaliyan"'),
                    'event_date' => '2026-07-05',
                    'excerpt' => ps_text('काव्य-कार्यशाला एवं सारस्वत विमोचन समारोह। अवधी व हिंदी के सुधी साहित्यकारों का समागम।', 'Poetic symposium and book release with distinguished Hindi & Awadhi scholars.'),
                    'location' => ps_text('बाराबंकी, उत्तर प्रदेश, भारत', 'Barabanki, Uttar Pradesh, India'),
                    'slug' => '151'
                ],
                [
                    'title' => ps_text('नाट्य अभिनय कार्यशाला बाराबंकी', 'Theatre Acting Workshop Barabanki'),
                    'event_date' => '2026-06-10',
                    'excerpt' => ps_text('वरिष्ठ रंगकर्मी चंद्रभाष सिंह जी के निर्देशन में ग्रामीण युवाओं हेतु 7-दिवसीय नाट्य एवं लोक-संवाद प्रशिक्षण।', '7-day rural youth theatre & dialogue training directed by senior artist Chandra Bhash Singh.'),
                    'location' => ps_text('बाराबंकी में', 'Barabanki'),
                    'slug' => 'event'
                ]
            ];
        }

        foreach (array_slice($realPast, 0, 3) as $pEvent):
            $pTitle = $pEvent['title'];
            $pDateStr = format_date($pEvent['event_date'] ?? '2026-07-05');
            $pLoc = !empty($pEvent['location']) ? $pEvent['location'] : ps_text('बाराबंकी', 'Barabanki');
            $pSlug = $pEvent['slug'] ?? 'events';
            $pDesc = !empty($pEvent['excerpt']) ? $pEvent['excerpt'] : (!empty($pEvent['content']) ? ps_excerpt($pEvent, 120) : '');
        ?>
        <div class="bg-pure-white rounded-xl p-5 shadow-sm border border-border-warm">
          <div class="flex items-center justify-between">
            <span class="bg-surface-container text-on-surface-variant text-[11px] font-semibold px-2 py-0.5 rounded"><?= e(ps_text('सम्पन्न', 'Past')) ?></span>
            <span class="font-label-sm text-label-sm text-text-muted"><?= e($pDateStr) ?></span>
          </div>
          <h4 class="font-headline-sm text-headline-sm font-semibold text-deep-forest mt-2">
            <a href="<?= e(base_url('/events/' . $pSlug)) ?>" class="hover:text-primary transition-colors">
              <?= e($pTitle) ?>
            </a>
          </h4>
          <p class="font-body-sm text-body-sm text-text-muted mt-1">
            <?= e($pDesc) ?>
          </p>
          <div class="mt-3 flex items-center gap-1 text-text-muted font-label-sm text-label-sm">
            <span class="material-symbols-outlined text-[15px]">location_on</span>
            <span><?= e($pLoc) ?></span>
          </div>
        </div>
        <?php endforeach; ?>

        <!-- Mini Calendar Highlight Card -->
        <div class="bg-soft-meadow rounded-xl p-5 border-l-4 border-primary border border-border-warm">
          <div class="flex items-center gap-3">
            <span class="material-symbols-outlined text-primary text-3xl shrink-0">event_available</span>
            <div>
              <h5 class="font-title-md text-title-md font-bold text-deep-forest"><?= e(ps_text('अपने गाँव में चौपाल कराएं', 'Host a Green Chaupal')) ?></h5>
              <p class="font-body-sm text-body-sm text-text-muted mt-0.5"><?= e(ps_text('प्रदीप सारंग को अपने क्षेत्र में पर्यावरण या साहित्य सभा हेतु आमंत्रित करें।', 'Invite Pradeep Sarang for environmental dialogues or literary gatherings in your village.')) ?></p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- 13. LITERARY & AWADHI HERITAGE (साहित्य और अवधी संस्कृति) -->
<section class="w-full px-4 sm:px-8 py-8 lg:py-12 bg-soft-meadow" id="literature">
  <div class="max-w-container-max mx-auto">
    <div class="flex flex-col md:flex-row md:items-end justify-between mb-12 gap-4">
      <div>
        <span class="font-label-sm text-label-sm uppercase tracking-widest text-tertiary font-bold"><?= e(ps_text('माटी की बोली • अवधी संपदा', 'Folk Tongue • Awadhi Treasure')) ?></span>
        <h2 class="font-headline-lg text-headline-lg text-deep-forest font-bold mt-1"><?= e(ps_text('साहित्य और अवधी संस्कृति (Literary Works)', 'Literature & Awadhi Heritage')) ?></h2>
        <p class="font-body-md text-body-md text-text-muted mt-2 max-w-2xl">
          <?= e(ps_text('अवधी गद्य, आंचलिक रेखाचित्र और लोकजीवन की सजीव अभिव्यक्ति — प्रदीप सारंग की लेखनी से सीधे', 'Awadhi prose, regional sketches and vivid folk expressions penned by Pradeep Sarang')) ?>
        </p>
      </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-10">
      <!-- Awadhi Prose: Sughari -->
      <div class="bg-pure-white rounded-2xl p-8 shadow-sm border border-border-warm flex flex-col justify-between">
        <div>
          <div class="flex items-center justify-between mb-4">
            <span class="bg-tertiary-fixed text-tertiary font-label-sm text-label-sm font-semibold px-3 py-1 rounded-full"><?= e(ps_text('अवधी गद्य', 'Awadhi Prose')) ?></span>
            <span class="material-symbols-outlined text-tertiary">menu_book</span>
          </div>
          <h3 class="font-headline-md text-headline-md font-bold text-deep-forest"><?= e(ps_text('सुघरी', 'Sughari')) ?></h3>
          <div class="mt-4 p-4 rounded-xl bg-soft-meadow border-l-4 border-tertiary">
            <p class="font-quote-editorial text-body-lg text-deep-forest italic leading-relaxed">
              "मेला जाय की खुशी मा, गोबर की खेप लइकै जाय रही 'सुघरी' के कदमन की चाल आजु अपने आपै कुछ बढ़ी हुई है..."
            </p>
          </div>
          <p class="font-body-sm text-body-sm text-text-muted mt-4 leading-relaxed">
            <?= e(ps_text('अवधी ग्रामीण समाज में एक मेहनतकश स्त्री के स्वाभिमान, सहज उल्लास और आंचलिक पर्व-संस्कृति का अत्यंत मार्मिक व यथार्थवादी शब्द-चित्र।', 'A moving portrait of self-respect, joy and festive culture of a hardworking rural woman in Awadh.')) ?>
          </p>
        </div>
        <div class="mt-6 pt-4 border-t border-surface-container flex items-center justify-between">
          <span class="font-label-sm text-label-sm text-text-muted"><?= e(ps_text('लेखक: प्रदीप सारंग', 'Author: Pradeep Sarang')) ?></span>
          <a class="font-label-md text-label-md text-primary hover:text-deep-forest font-bold flex items-center gap-1" href="<?= e(base_url('/campaigns/' . $awadhiSlug)) ?>">
            <span><?= e(ps_text('पूरी रचना पढ़ें', 'Read Full Piece')) ?></span>
            <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
          </a>
        </div>
      </div>

      <!-- Awadhi Interview/Reflection: Jharihakh -->
      <div class="bg-pure-white rounded-2xl p-8 shadow-sm border border-border-warm flex flex-col justify-between">
        <div>
          <div class="flex items-center justify-between mb-4">
            <span class="bg-secondary-fixed/50 text-secondary font-label-sm text-label-sm font-semibold px-3 py-1 rounded-full"><?= e(ps_text('साक्षात्कार व संस्मरण', 'Memoir & Reflection')) ?></span>
            <span class="material-symbols-outlined text-secondary">record_voice_over</span>
          </div>
          <h3 class="font-headline-md text-headline-md font-bold text-deep-forest"><?= e(ps_text('झरिहख (वर्षा ऋतु का ग्रामीण दृश्य)', 'Jharihakh (Rural Monsoon Sketch)')) ?></h3>
          <div class="mt-4 p-4 rounded-xl bg-soft-meadow border-l-4 border-secondary">
            <p class="font-quote-editorial text-body-lg text-deep-forest italic leading-relaxed">
              "आजु जब हम सोय कै जागेन, तौ झमाझम बारिस होत रही। झमाझम मतलब वाकई झम-झम, झम-झम कै आवाज कानन मा सुनाय परत रही..."
            </p>
          </div>
          <p class="font-body-sm text-body-sm text-text-muted mt-4 leading-relaxed">
            <?= e(ps_text('बारिश की पहली झड़ी, खपरैल से गिरती जलधाराएं, कीचड़ से भरी पगडंडियां और किसान के मन की उमंग का खालिस अवधी जुबान में सजीव प्रवाह।', 'The pure melodic rhythm of early rural monsoon rain, tiled roofs and peasant joy expressed in authentic Awadhi.')) ?>
          </p>
        </div>
        <div class="mt-6 pt-4 border-t border-surface-container flex items-center justify-between">
          <span class="font-label-sm text-label-sm text-text-muted"><?= e(ps_text('संस्मरण: प्रदीप सारंग', 'Memoir: Pradeep Sarang')) ?></span>
          <a class="font-label-md text-label-md text-secondary hover:text-deep-forest font-bold flex items-center gap-1" href="<?= e(base_url('/campaigns/' . $awadhiSlug)) ?>">
            <span><?= e(ps_text('पूरा संस्मरण पढ़ें', 'Read Memoir')) ?></span>
            <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
          </a>
        </div>
      </div>
    </div>

    <!-- Kundaliyan Poetry Feature Strip -->
    <div class="bg-pure-white rounded-2xl p-6 lg:p-8 shadow-sm border border-border-warm grid grid-cols-1 lg:grid-cols-12 gap-6 items-center">
      <div class="lg:col-span-8">
        <div class="inline-flex items-center gap-1 text-secondary font-label-sm text-label-sm font-semibold mb-2">
          <span class="material-symbols-outlined text-[16px]">edit_note</span>
          <span><?= e(ps_text('स्वरचित 151 कुंडलियों का संकलन', 'Collection of 151 Original Kundaliyan')) ?></span>
        </div>
        <h4 class="font-headline-sm text-headline-sm font-bold text-deep-forest"><?= e(ps_text('"सारंग-कुंडलियाँ" — लोक जीवन के छंदबद्ध सरोकार', '"Sarang-Kundaliyan" — Verses of Folk Life')) ?></h4>
        <p class="font-body-sm text-body-sm text-text-muted mt-2 leading-relaxed">
          <?= e(ps_text('कुण्डलियाँ छंद की प्राचीन समृद्ध परंपरा को जीवित रखते हुए समकालीन सामाजिक विद्रूपताओं, प्रकृति-प्रेम और मानवीय मूल्यों पर आधारित 151 मौलिक कुंडलियाँ।', 'Preserving ancient metrical traditions while engaging modern environmental and humanitarian themes in 151 poetic verses.')) ?>
        </p>
      </div>
      <div class="lg:col-span-4 flex justify-start lg:justify-end">
        <a class="inline-flex items-center gap-2 bg-primary-container hover:bg-deep-forest text-on-primary font-label-md text-label-md px-5 py-3 rounded-lg shadow transition-colors font-semibold" href="https://api.whatsapp.com/send?phone=<?= urlencode(preg_replace('/[^0-9]/', '', $phoneClean)) ?>&amp;text=<?= urlencode(ps_text('नमस्ते श्री सारंग जी, मुझे "सारंग-कुंडलियाँ" पुस्तक प्रति हेतु जानकारी चाहिए।', 'Hello Shri Sarang ji, I would like to request a copy of the "Sarang-Kundaliyan" book.')) ?>" target="_blank" rel="noopener noreferrer">
          <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M12.031 0C5.394 0 0 5.392 0 12.029c0 2.122.553 4.195 1.604 6.015L.03 24l6.096-1.599c1.761.96 3.75 1.464 5.905 1.464 6.637 0 12.031-5.393 12.031-12.031C24.062 5.392 18.668 0 12.031 0zm6.654 17.002c-.276.776-1.365 1.424-2.235 1.611-.595.127-1.372.228-3.987-.856-3.346-1.386-5.502-4.786-5.669-5.008-.166-.222-1.36-1.808-1.36-3.448 0-1.64 0.858-2.449 1.162-2.781.304-.333.664-.416.885-.416.221 0 .443.002.637.011.206.01.482-.078.753.573.277.665.941 2.296 1.024 2.463.083.167.139.36.028.582-.11.222-.166.36-.332.554-.166.194-.349.433-.498.582-.166.166-.339.347-.146.679.194.332.862 1.414 1.848 2.292 1.267 1.129 2.336 1.479 2.668 1.645.332.166.526.139.72-.083.194-.222.831-.97 1.052-1.302.221-.332.443-.277.747-.166.304.111 1.936.914 2.268 1.08.332.166.554.249.637.388.083.139.083.804-.193 1.58z"/></svg>
          <span><?= e(ps_text('पुस्तक प्रति हेतु संपर्क करें', 'Request Book Copy')) ?></span>
        </a>
      </div>
    </div>
  </div>
</section>

<!-- 14. INSPIRATIONAL QUOTE BANNER -->
<section class="w-full px-4 sm:px-8 py-14 bg-deep-forest text-pure-white text-center relative overflow-hidden">
  <div class="max-w-3xl mx-auto relative z-10 flex flex-col items-center">
    <span class="material-symbols-outlined text-fresh-sprout text-4xl mb-3">format_quote</span>
    <h3 class="font-headline-lg text-headline-sm sm:text-headline-lg font-bold leading-tight">
      <?= ps_text('"पेड़ केवल लकड़ी नहीं, हमारी सांसों का ऋण हैं।<br class="hidden sm:inline"/> हर दिन की शुरुआत ग्रीन मॉर्निंग से करें।"', '"Trees are not merely wood; they are our debt of breath.<br class="hidden sm:inline"/> Begin each day with Green Morning."') ?>
    </h3>
    <div class="mt-4 flex items-center gap-3">
      <span class="w-8 h-0.5 bg-fresh-sprout"></span>
      <span class="font-label-md text-label-md text-primary-fixed uppercase tracking-wider font-semibold"><?= e(ps_text('प्रदीप सारंग • बाराबंकी', 'Pradeep Sarang • Barabanki')) ?></span>
      <span class="w-8 h-0.5 bg-fresh-sprout"></span>
    </div>
  </div>
</section>

<!-- 15. COMMUNITY ENGAGEMENT & VOLUNTEER (बदलाव का हिस्सा बनें) -->
<section class="w-full px-4 sm:px-8 py-8 lg:py-12" id="volunteer">
  <div class="max-w-container-max mx-auto">
    <div class="text-center max-w-2xl mx-auto mb-14">
      <span class="font-label-sm text-label-sm uppercase tracking-widest text-primary font-bold"><?= e(ps_text('नागरिक सहभागिता', 'Citizen Engagement')) ?></span>
      <h2 class="font-headline-lg text-headline-lg text-deep-forest font-bold mt-1"><?= e(ps_text('बदलाव का हिस्सा बनें', 'Be Part of the Change')) ?></h2>
      <p class="font-body-md text-body-md text-text-muted mt-2">
        <?= e(ps_text('पर्यावरण और समाज सेवा केवल एक व्यक्ति की नहीं, हम सबकी साझी जिम्मेदारी है।', 'Environmental and social service is a collective responsibility for all of us.')) ?>
      </p>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
      <!-- Card 1 -->
      <div class="bg-pure-white rounded-2xl p-6 shadow-sm border border-border-warm flex flex-col justify-between hover:shadow-md transition-shadow">
        <div>
          <div class="w-12 h-12 rounded-xl bg-soft-meadow text-primary flex items-center justify-center mb-4">
            <span class="material-symbols-outlined text-2xl">person_add</span>
          </div>
          <h3 class="font-headline-sm text-headline-sm font-semibold text-deep-forest"><?= e(ps_text('स्वयंसेवक (Volunteer) बनें', 'Become a Volunteer')) ?></h3>
          <p class="font-body-sm text-body-sm text-text-muted mt-2">
            <?= e(ps_text('अपने गाँव या शहर में ग्रीन गैंग व परिंदा संरक्षण अभियानों में सक्रिय भागीदारी दें।', 'Take active part in tree plantation and bird conservation initiatives in your locality.')) ?>
          </p>
        </div>
        <div class="mt-6">
          <a class="inline-flex items-center gap-1.5 font-label-md text-label-md text-primary font-bold hover:text-deep-forest" href="<?= e(base_url('/volunteer')) ?>">
            <span><?= e(ps_text('पंजीकरण करें', 'Register Now')) ?></span>
            <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
          </a>
        </div>
      </div>

      <!-- Card 2 -->
      <div class="bg-pure-white rounded-2xl p-6 shadow-sm border border-border-warm flex flex-col justify-between hover:shadow-md transition-shadow">
        <div>
          <div class="w-12 h-12 rounded-xl bg-secondary-fixed/50 text-secondary flex items-center justify-center mb-4">
            <span class="material-symbols-outlined text-2xl">volunteer_activism</span>
          </div>
          <h3 class="font-headline-sm text-headline-sm font-semibold text-deep-forest"><?= e(ps_text('अभियान में सहयोग दें', 'Contribute Resources')) ?></h3>
          <p class="font-body-sm text-body-sm text-text-muted mt-2">
            <?= e(ps_text('सकोरा वितरण, पौधरोपण या कपड़ा-बैंक के लिए आवश्यक सामग्री व संसाधन साझा करें।', 'Contribute saplings, earthen bird water pots or warm clothes for winter cloth banks.')) ?>
          </p>
        </div>
        <div class="mt-6">
          <a class="inline-flex items-center gap-1.5 font-label-md text-label-md text-secondary font-bold hover:text-deep-forest" href="#contact">
            <span><?= e(ps_text('सहयोग हेतु लिखें', 'Contact to Support')) ?></span>
            <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
          </a>
        </div>
      </div>

      <!-- Card 3 -->
      <div class="bg-pure-white rounded-2xl p-6 shadow-sm border border-border-warm flex flex-col justify-between hover:shadow-md transition-shadow">
        <div>
          <div class="w-12 h-12 rounded-xl bg-soft-meadow text-deep-forest flex items-center justify-center mb-4">
            <span class="material-symbols-outlined text-2xl">groups</span>
          </div>
          <h3 class="font-headline-sm text-headline-sm font-semibold text-deep-forest"><?= e(ps_text('ग्रीन चौपाल आयोजित करें', 'Host Green Chaupal')) ?></h3>
          <p class="font-body-sm text-body-sm text-text-muted mt-2">
            <?= e(ps_text('अपने विद्यालय, ग्राम पंचायत या संस्थान में हरियाली चौपाल का आयोजन करवाएं।', 'Organize environmental dialogues in your school, village panchayat or campus.')) ?>
          </p>
        </div>
        <div class="mt-6">
          <a class="inline-flex items-center gap-1.5 font-label-md text-label-md text-deep-forest font-bold hover:text-primary" href="#contact">
            <span><?= e(ps_text('आयोजन अनुरोध भेजें', 'Request Session')) ?></span>
            <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
          </a>
        </div>
      </div>

      <!-- Card 4 -->
      <div class="bg-pure-white rounded-2xl p-6 shadow-sm border border-border-warm flex flex-col justify-between hover:shadow-md transition-shadow">
        <div>
          <div class="w-12 h-12 rounded-xl bg-tertiary-fixed text-tertiary flex items-center justify-center mb-4">
            <span class="material-symbols-outlined text-2xl">mail</span>
          </div>
          <h3 class="font-headline-sm text-headline-sm font-semibold text-deep-forest"><?= e(ps_text('कार्यक्रम हेतु आमंत्रित करें', 'Invite for Events')) ?></h3>
          <p class="font-body-sm text-body-sm text-text-muted mt-2">
            <?= e(ps_text('साहित्यिक गोष्ठियों, कवि सम्मेलनों या युवा प्रेरणा सत्रों में वक्तव्य हेतु।', 'Invite as a keynote speaker for literary symposiums or youth guidance conferences.')) ?>
          </p>
        </div>
        <div class="mt-6">
          <a class="inline-flex items-center gap-1.5 font-label-md text-label-md text-tertiary font-bold hover:text-deep-forest" href="#contact">
            <span><?= e(ps_text('आमंत्रण पत्र भेजें', 'Send Invitation')) ?></span>
            <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
          </a>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- 16. ACCESSIBLE CONTACT & DIALOGUE FORM (संपर्क एवं संवाद) -->
<section class="w-full px-4 sm:px-8 py-8 lg:py-12 bg-soft-meadow" id="contact">
  <div class="max-w-container-max mx-auto">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
      <!-- Contact Info & Direct Access -->
      <div class="lg:col-span-5 flex flex-col justify-between space-y-8">
        <div>
          <span class="font-label-sm text-label-sm uppercase tracking-widest text-secondary font-bold"><?= e(ps_text('सीधा संवाद', 'Direct Communication')) ?></span>
          <h2 class="font-headline-lg text-headline-lg text-deep-forest font-bold mt-1">
            <?= e(ps_text('संपर्क करें', 'Get in Touch')) ?>
          </h2>
          <p class="font-body-md text-body-md text-text-muted mt-3 leading-relaxed">
            <?= e(ps_text('पर्यावरण, अवधी साहित्य या सामाजिक कार्य से जुड़े किसी भी विचार, आमंत्रण अथवा सहयोग हेतु प्रदीप सारंग से सीधे संपर्क स्थापित करें।', 'Connect directly for collaborations, environmental campaigns, literary meets or community initiatives.')) ?>
          </p>

          <!-- Details List -->
          <div class="mt-8 space-y-5">
            <div class="flex items-start gap-4">
              <div class="w-11 h-11 rounded-xl bg-pure-white text-primary flex items-center justify-center shrink-0 shadow-sm border border-border-warm">
                <span class="material-symbols-outlined text-2xl">location_on</span>
              </div>
              <div>
                <span class="font-label-sm text-label-sm text-text-muted font-bold"><?= e(ps_text('निवास एवं कार्यक्षेत्र', 'Address & Roots')) ?></span>
                <p class="font-title-md text-title-md font-semibold text-deep-forest"><?= e($address) ?></p>
              </div>
            </div>

            <div class="flex items-start gap-4">
              <div class="w-11 h-11 rounded-xl bg-pure-white text-secondary flex items-center justify-center shrink-0 shadow-sm border border-border-warm">
                <span class="material-symbols-outlined text-2xl">call</span>
              </div>
              <div>
                <span class="font-label-sm text-label-sm text-text-muted font-bold"><?= e(ps_text('सीधा दूरभाष नंबर', 'Phone Contact')) ?></span>
                <p class="font-title-md text-title-md font-semibold text-deep-forest">
                  <a class="hover:text-primary transition-colors" href="tel:<?= e($phoneClean) ?>"><?= e($phone) ?></a>
                </p>
              </div>
            </div>

            <div class="flex items-start gap-4">
              <div class="w-11 h-11 rounded-xl bg-pure-white text-tertiary flex items-center justify-center shrink-0 shadow-sm border border-border-warm">
                <span class="material-symbols-outlined text-2xl">mail</span>
              </div>
              <div>
                <span class="font-label-sm text-label-sm text-text-muted font-bold"><?= e(ps_text('ईमेल पत्र-व्यवहार', 'Email Address')) ?></span>
                <p class="font-title-md text-title-md font-semibold text-deep-forest">
                  <a class="hover:text-primary transition-colors" href="mailto:<?= e($email) ?>"><?= e($email) ?></a>
                </p>
              </div>
            </div>
          </div>
        </div>

        <!-- Location Snapshot Card -->
        <div class="rounded-2xl overflow-hidden shadow-sm bg-pure-white p-4 border border-border-warm">
          <div class="w-full h-32 rounded-xl bg-cover bg-center flex items-center justify-center bg-surface-container" 
               style="background-image: linear-gradient(rgba(20,83,45,0.45), rgba(20,83,45,0.45)), url('<?= e(base_url('assets/images/slider_final_1.jpg')) ?>');">
            <span class="text-pure-white font-title-lg text-title-lg font-bold drop-shadow">कमरावां • सतरिख • बाराबंकी</span>
          </div>
          <div class="p-2 flex items-center justify-between text-text-muted font-label-sm text-label-sm mt-1">
            <span><?= e(ps_text('बाराबंकी जनपद (अवध अंचल)', 'Barabanki District, Awadh Region')) ?></span>
            <span class="text-primary font-bold flex items-center gap-1">
              <span class="material-symbols-outlined text-[14px]">my_location</span><?= e(ps_text('सक्रिय केंद्र', 'Active Hub')) ?>
            </span>
          </div>
        </div>
      </div>

      <!-- Interactive Form -->
      <div class="lg:col-span-7">
        <div class="bg-pure-white rounded-2xl p-8 lg:p-10 shadow-sm border border-border-warm">
          <h3 class="font-headline-sm text-headline-sm font-bold text-deep-forest mb-2">
            <?= e(ps_text('अपना संदेश या विचार साझा करें', 'Share Your Message or Proposal')) ?>
          </h3>
          <p class="font-body-sm text-body-sm text-text-muted mb-6">
            <?= e(ps_text('हम आपके संदेश का 24–48 घंटों में यथोचित उत्तर देने का प्रयास करेंगे।', 'We endeavor to respond to all inquiries within 24 to 48 hours.')) ?>
          </p>

          <form id="home-contact-form" method="post" action="<?= e(base_url('/')) ?>" class="space-y-4" onsubmit="handleContactSubmit(event, this)">
            <?= csrf_field() ?>
            <input type="hidden" name="form_type" value="contact">

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
              <div class="flex flex-col space-y-1">
                <label class="font-label-md text-label-md text-deep-forest font-semibold"><?= e(ps_text('आपका पूरा नाम *', 'Your Full Name *')) ?></label>
                <input class="w-full bg-soft-meadow border border-border-warm rounded-lg p-3 text-on-surface font-body-md text-body-md focus:outline-none focus:ring-2 focus:ring-primary-container" 
                       name="name" 
                       placeholder="<?= e(ps_text('उदा. रमेश कुमार वर्मा', 'e.g. Ramesh Kumar Verma')) ?>" 
                       required type="text"/>
              </div>
              <div class="flex flex-col space-y-1">
                <label class="font-label-md text-label-md text-deep-forest font-semibold"><?= e(ps_text('मोबाइल नंबर *', 'Mobile Number *')) ?></label>
                <input class="w-full bg-soft-meadow border border-border-warm rounded-lg p-3 text-on-surface font-body-md text-body-md focus:outline-none focus:ring-2 focus:ring-primary-container" 
                       name="phone" 
                       placeholder="<?= e(ps_text('+91 XXXXX XXXXX', '+91 XXXXX XXXXX')) ?>" 
                       required type="tel"/>
              </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
              <div class="flex flex-col space-y-1">
                <label class="font-label-md text-label-md text-deep-forest font-semibold"><?= e(ps_text('ईमेल पता', 'Email Address')) ?></label>
                <input class="w-full bg-soft-meadow border border-border-warm rounded-lg p-3 text-on-surface font-body-md text-body-md focus:outline-none focus:ring-2 focus:ring-primary-container" 
                       name="email" 
                       placeholder="<?= e(ps_text('aapka-email@example.com', 'your-email@example.com')) ?>" 
                       type="email"/>
              </div>
              <div class="flex flex-col space-y-1">
                <label class="font-label-md text-label-md text-deep-forest font-semibold"><?= e(ps_text('संपर्क का उद्देश्य *', 'Purpose of Contact *')) ?></label>
                <select class="w-full bg-soft-meadow border border-border-warm rounded-lg p-3 text-on-surface font-body-md text-body-md focus:outline-none focus:ring-2 focus:ring-primary-container" 
                        name="subject" required>
                  <option value=""><?= e(ps_text('-- उद्देश्य चुनें --', '-- Select Purpose --')) ?></option>
                  <option value="greengang"><?= e(ps_text('ग्रीन गैंग / पौधरोपण अभियान से जुड़ना', 'Join Green Gang / Tree Plantation')) ?></option>
                  <option value="volunteer"><?= e(ps_text('स्वयंसेवक के रूप में योगदान', 'Volunteer Contribution')) ?></option>
                  <option value="invite"><?= e(ps_text('कार्यक्रम / चौपाल में आमंत्रित करना', 'Invite for Event / Chaupal')) ?></option>
                  <option value="literature"><?= e(ps_text('साहित्यिक कृति / कुंडलियाँ प्रति हेतु', 'Literary Work / Book Copy')) ?></option>
                  <option value="bird_conservation"><?= e(ps_text('परिंदा संरक्षण व जल-सकोरा अभियान', 'Bird Conservation & Water Bowl Campaign')) ?></option>
                  <option value="media"><?= e(ps_text('मीडिया व साक्षात्कार संवाद', 'Media & Interview Inquiries')) ?></option>
                </select>
              </div>
            </div>

            <div class="flex flex-col space-y-1">
              <label class="font-label-md text-label-md text-deep-forest font-semibold"><?= e(ps_text('संदेश अथवा प्रस्ताव विवरण *', 'Message or Proposal Details *')) ?></label>
              <textarea class="w-full bg-soft-meadow border border-border-warm rounded-lg p-3 text-on-surface font-body-md text-body-md focus:outline-none focus:ring-2 focus:ring-primary-container" 
                        name="message" 
                        placeholder="<?= e(ps_text('कृपया अपना संदेश, आयोजन का स्थल अथवा अपने विचार यहाँ लिखें...', 'Please write your message, venue of event or thoughts here...')) ?>" 
                        required rows="4"></textarea>
            </div>

            <div class="pt-2">
              <button class="w-full sm:w-auto inline-flex items-center justify-center gap-2 bg-primary-container hover:bg-deep-forest text-on-primary font-label-md text-label-md px-8 py-3.5 rounded-lg shadow-md transition-all font-semibold" type="submit">
                <span class="material-symbols-outlined text-[18px]">send</span>
                <span><?= e(ps_text('संदेश प्रेषित करें', 'Send Message')) ?></span>
              </button>
            </div>

            <!-- Inline Success Feedback -->
            <div class="hidden mt-4 p-4 rounded-xl bg-surface-container-low text-deep-forest font-body-sm text-body-sm flex items-center gap-2.5 border border-primary/20" id="form-feedback">
              <span class="material-symbols-outlined text-primary text-xl">check_circle</span>
              <span><?= e(ps_text('धन्यवाद! आपका संदेश सफलतापूर्वक प्राप्त हुआ। हम शीघ्र ही आपसे संवाद करेंगे।', 'Thank you! Your message has been received successfully. We will reach out to you shortly.')) ?></span>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>

</div>

<script>
// Lightbox utility
function openLightbox(src, caption) {
    const dialog = document.getElementById('ps-lightbox');
    const img = document.getElementById('ps-lightbox-img');
    const cap = document.getElementById('ps-lightbox-caption');
    const orig = document.getElementById('ps-lightbox-original');
    if (dialog && img) {
        img.src = src;
        if (cap) cap.textContent = caption || '';
        if (orig) orig.href = src;
        dialog.showModal();
    }
}

document.addEventListener('DOMContentLoaded', function() {
    // Lightbox close button
    const closeBtn = document.querySelector('.ps-lightbox-close');
    const dialog = document.getElementById('ps-lightbox');
    if (closeBtn && dialog) {
        closeBtn.addEventListener('click', () => dialog.close());
        dialog.addEventListener('click', (e) => {
            if (e.target === dialog) dialog.close();
        });
    }

    // Gallery category filter tabs
    const filterBtns = document.querySelectorAll('.gallery-filter-btn');
    const galleryItems = document.querySelectorAll('.gallery-item');

    filterBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            filterBtns.forEach(b => {
                b.classList.remove('bg-primary-container', 'text-on-primary', 'font-semibold');
                b.classList.add('bg-pure-white', 'text-on-surface-variant');
            });
            this.classList.add('bg-primary-container', 'text-on-primary', 'font-semibold');
            this.classList.remove('bg-pure-white', 'text-on-surface-variant');

            const cat = this.getAttribute('data-category');
            galleryItems.forEach(item => {
                if (cat === 'all' || item.getAttribute('data-category') === cat) {
                    item.style.display = '';
                } else {
                    item.style.display = 'none';
                }
            });
        });
    });
});

// Contact form submission handling
function handleContactSubmit(event, form) {
    // Normal browser POST or AJAX submission
    const feedback = document.getElementById('form-feedback');
    if (feedback) {
        feedback.classList.remove('hidden');
    }
}
</script>
