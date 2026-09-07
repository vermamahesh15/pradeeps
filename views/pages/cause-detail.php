<?php
declare(strict_types=1);

$item = $item ?? [];
$campaigns = $campaigns ?? [];
$title = $item['title'] ?? ps_text('जन-अभियान विवरण', 'Campaign Detail');
$image = !empty($item['image']) ? base_url($item['image']) : 'https://lh3.googleusercontent.com/aida-public/AB6AXuAFhcCzDptvdawqahxIf_F6aewWLbhrElKpz8H_SdpdXpvfwrClJ3jd7GZ9s8IMoKni0nNxRMxekp5XwukPPAGZ8JiWIfTdqXGlZuQOtTWSqI1lEO2t8Caw2U_jqNH7qTboXJ3x8qKCEMJkrGgMZJ5LcJ0XXi5QpbeRqyXoboPm3gFtseM0-FLQdWUjpDTjNuI4kUaBCvQrklMOKag47XiVRg-6CA9onDFh_olHoLmOmWixtDFur5TN';
$excerpt = ps_excerpt($item, 250);
$contentHtml = !empty($item['content']) ? $item['content'] : '<p>' . e(ps_text('इस जन-अभियान के अंतर्गत अवध अंचल में निरंतर जन-जागरूकता, पौधरोपण, जल-सकोरे वितरण और सामुदायिक सहभागिता के कार्यक्रम संचालित किए जा रहे हैं।', 'Under this community initiative, awareness, tree planting, water bowl distribution and public participation programs are conducted across Awadh.')) . '</p>';

$isBird = preg_match('/পরিંદા|bird|parinda/iu', ($item['title'] ?? '') . ' ' . ($item['slug'] ?? ''));
$isGreen = preg_match('/हरियाली|green|hariyali/iu', ($item['title'] ?? '') . ' ' . ($item['slug'] ?? ''));
?>

<div class="flex flex-col w-full">
<!-- Editorial Campaign Hero -->
<section class="relative w-full bg-soft-meadow overflow-hidden py-space-2xl md:py-space-3xl border-b border-border-warm">
  <div class="max-w-container-max mx-auto px-4 sm:px-8 relative z-10">
    <!-- Breadcrumb -->
    <nav aria-label="Breadcrumb" class="flex items-center gap-2 font-label-md text-label-md text-text-muted mb-space-sm">
      <a class="hover:text-primary transition-colors flex items-center gap-1" data-path="home" href="<?= e(base_url('/')) ?>">
        <span class="material-symbols-outlined text-[16px]">home</span>
        <span><?= e(ps_text('गृह (Home)', 'Home')) ?></span>
      </a>
      <span class="opacity-40">/</span>
      <a class="hover:text-primary transition-colors" data-path="campaigns" href="<?= e(base_url('/campaigns')) ?>">
        <span><?= e(ps_text('अभियान (Campaigns)', 'Campaigns')) ?></span>
      </a>
      <span class="opacity-40">/</span>
      <span class="text-deep-forest font-semibold"><?= e($title) ?></span>
    </nav>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-12 items-center mt-6">
      <!-- Left Editorial Content -->
      <div class="lg:col-span-7 flex flex-col">
        <div class="inline-flex items-center gap-2 bg-primary-fixed/40 text-deep-forest px-3.5 py-1 rounded-full font-label-sm text-label-sm mb-space-sm border border-border-warm font-semibold w-fit">
          <span class="material-symbols-outlined text-[15px] text-primary-container" style="font-variation-settings: 'FILL' 1;">eco</span>
          <span><?= e(!empty($item['category_name']) ? ($item['category_name'] . ' • ' . ps_text('प्रदीप सारंग की पहल', 'Pradeep Sarang Initiative')) : ps_text('जन-सरोकार व पर्यावरण संरक्षण • प्रदीप सारंग की पहल', 'Environmental & Social Initiative • Pradeep Sarang')) ?></span>
        </div>
        <h1 class="font-display-hero text-headline-lg md:text-display-hero text-deep-forest mb-5 leading-tight tracking-tight font-bold">
          <?= e($title) ?>
        </h1>
        <p class="font-body-lg text-body-lg text-text-muted mb-6 leading-relaxed">
          <?= e($excerpt) ?>
        </p>

        <!-- Pradeep Sarang Emotive Quote Box -->
        <div class="bg-soft-meadow rounded-xl p-5 sm:p-6 mb-8 relative border border-border-warm shadow-sm">
          <div class="absolute left-0 top-0 bottom-0 w-1.5 bg-secondary rounded-l-xl"></div>
          <span class="material-symbols-outlined text-secondary/30 text-4xl absolute right-4 top-3 select-none">format_quote</span>
          <p class="font-quote-editorial text-quote-editorial text-deep-forest italic mb-3 pr-6">
            <?= ps_text('"जब भीषण गर्मी में नदियां और तालाब सूख जाते हैं, तब हमारे आंगन और छतों पर रखे मिट्टी के सकोरे ही परिंदों के लिए जीवन बन जाते हैं। यह केवल जलदान नहीं, मानवता का संवेदनशील कर्तव्य है।"', '"When rivers and ponds dry up in summer heat, earthen water bowls on our roofs become life for birds. This is a sensitive duty of humanity."') ?>
          </p>
          <div class="flex items-center gap-3">
            <div class="w-8 h-8 rounded-full bg-primary-container flex items-center justify-center text-on-primary font-bold">
              <span class="material-symbols-outlined text-[17px]">eco</span>
            </div>
            <div class="flex flex-col">
              <span class="font-title-md text-title-md text-deep-forest font-semibold leading-none"><?= e(ps_text('प्रदीप सारंग', 'Pradeep Sarang')) ?></span>
              <span class="font-label-sm text-label-sm text-text-muted mt-0.5"><?= e(ps_text('संस्थापक, परिंदा व हरियाली अभियान', 'Founder, Parinda & Hariyali Campaign')) ?></span>
            </div>
          </div>
        </div>

        <!-- Quick Action Buttons -->
        <div class="flex flex-wrap items-center gap-3.5">
          <a href="#volunteer-form" class="inline-flex items-center gap-2 bg-primary-container hover:bg-deep-forest text-on-primary px-6 py-3 rounded-xl font-label-md text-label-md transition-all shadow-sm font-bold">
            <span class="material-symbols-outlined text-[18px]">water_drop</span>
            <span><?= e(ps_text('सकोरा बैंक से जुड़ें', 'Join Sakora Network')) ?></span>
          </a>
          <a href="<?= e(base_url('/contact')) ?>" class="inline-flex items-center gap-2 bg-secondary hover:bg-on-secondary-container text-on-secondary px-6 py-3 rounded-xl font-label-md text-label-md transition-all shadow-sm font-bold">
            <span class="material-symbols-outlined text-[18px]">favorite</span>
            <span><?= e(ps_text('दाना-पानी मित्र बनें', 'Become a Bird Friend')) ?></span>
          </a>
          <a href="#upcoming-drive" class="inline-flex items-center gap-2 bg-surface-container hover:bg-surface-container-high text-on-surface px-5 py-3 rounded-xl font-label-md text-label-md transition-colors border border-border-warm">
            <span class="material-symbols-outlined text-[18px]">calendar_month</span>
            <span><?= e(ps_text('महा-अभियान 2026', 'Drive 2026')) ?></span>
          </a>
        </div>
      </div>

      <!-- Right Hero Visual Collage -->
      <div class="lg:col-span-5 relative flex flex-col gap-4">
        <div class="relative rounded-2xl overflow-hidden shadow-md bg-surface-container border border-border-warm">
          <img src="<?= e($image) ?>" alt="<?= e($title) ?>" class="w-full h-80 object-cover">
          <div class="absolute bottom-0 inset-x-0 bg-gradient-to-t from-deep-forest/90 via-deep-forest/40 to-transparent p-4 text-pure-white">
            <span class="font-label-sm text-label-sm uppercase tracking-wider text-primary-fixed"><?= e(ps_text('सकोरा सेवा • ग्राम सतरिख', 'Sakora Service • Satrikh Village')) ?></span>
            <p class="font-body-sm text-body-sm font-medium"><?= e(ps_text('ग्रीष्म ऋतु में प्यास से व्याकुल परिंदों को निरंतर अमृत-जल उपलब्ध कराना', 'Providing fresh water to thirsty birds during peak summer')) ?></p>
          </div>
        </div>
        <!-- Supporting Small Documentary Pill -->
        <div class="grid grid-cols-2 gap-3">
          <div class="bg-soft-meadow rounded-xl p-3 border border-border-warm flex items-center gap-3">
            <div class="w-10 h-10 rounded-lg bg-surface-container-highest flex items-center justify-center text-primary shrink-0">
              <span class="material-symbols-outlined text-[22px]">nest_multi_room</span>
            </div>
            <div class="flex flex-col min-w-0">
              <span class="font-label-md text-label-md text-deep-forest font-semibold truncate"><?= e(ps_text('गौरैया बसेरा', 'Sparrow Shelter')) ?></span>
              <span class="font-label-sm text-label-sm text-text-muted truncate"><?= e(ps_text('पारंपरिक काष्ठ घोंसले', 'Wooden Nests')) ?></span>
            </div>
          </div>
          <div class="bg-soft-meadow rounded-xl p-3 border border-border-warm flex items-center gap-3">
            <div class="w-10 h-10 rounded-lg bg-surface-container-highest flex items-center justify-center text-secondary shrink-0">
              <span class="material-symbols-outlined text-[22px]">diversity_3</span>
            </div>
            <div class="flex flex-col min-w-0">
              <span class="font-label-md text-label-md text-deep-forest font-semibold truncate"><?= e(ps_text('बाल-चेतना टोली', 'Student Squad')) ?></span>
              <span class="font-label-sm text-label-sm text-text-muted truncate"><?= e(ps_text('स्कूली छात्रों की सेवा', 'School Drive')) ?></span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Impact Metrics Ribbon (सांख्यिकी एवं ज़मीनी आंकड़े) -->
<section class="w-full bg-deep-forest text-pure-white py-space-xl">
  <div class="max-w-container-max mx-auto px-4 sm:px-8">
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-6 lg:gap-8">
      <div class="flex flex-col p-4 rounded-xl bg-surface-container-low/10 border border-surface-container-high/15">
        <div class="flex items-center justify-between mb-2">
          <span class="material-symbols-outlined text-primary-fixed text-[28px]">potted_plant</span>
          <span class="font-label-sm text-label-sm text-primary-fixed uppercase tracking-wider"><?= e(ps_text('निशुल्क वितरण', 'Free Distribution')) ?></span>
        </div>
        <span class="font-display-hero text-display-hero text-pure-white font-headline-lg leading-none mb-1">25,000+</span>
        <span class="font-title-md text-title-md text-surface-container-high font-semibold"><?= e(ps_text('मिट्टी के सकोरे (जल-पात्र)', 'Earthen Water Bowls')) ?></span>
        <p class="font-body-sm text-body-sm text-surface-container-high/80 mt-1"><?= e(ps_text('कुम्हारों से सीधे खरीद कर आमजन व विद्यालयों में वितरित', 'Procured directly from local potters and distributed')) ?></p>
      </div>

      <div class="flex flex-col p-4 rounded-xl bg-surface-container-low/10 border border-surface-container-high/15">
        <div class="flex items-center justify-between mb-2">
          <span class="material-symbols-outlined text-tertiary-fixed text-[28px]">domain</span>
          <span class="font-label-sm text-label-sm text-tertiary-fixed uppercase tracking-wider"><?= e(ps_text('क्षेत्रीय विस्तार', 'Coverage')) ?></span>
        </div>
        <span class="font-display-hero text-display-hero text-pure-white font-headline-lg leading-none mb-1">80+</span>
        <span class="font-title-md text-title-md text-surface-container-high font-semibold"><?= e(ps_text('गाँव एवं शिक्षण संस्थान', 'Villages & Schools')) ?></span>
        <p class="font-body-sm text-body-sm text-surface-container-high/80 mt-1"><?= e(ps_text('देवा, सतरिख, हैदरगढ़, रामनगर एवं फतेहपुर ब्लॉक आच्छादित', 'Covering Dewa, Satrikh, Haidergarh, Ramnagar & Fatehpur')) ?></p>
      </div>

      <div class="flex flex-col p-4 rounded-xl bg-surface-container-low/10 border border-surface-container-high/15">
        <div class="flex items-center justify-between mb-2">
          <span class="material-symbols-outlined text-secondary-fixed text-[28px]">history_edu</span>
          <span class="font-label-sm text-label-sm text-secondary-fixed uppercase tracking-wider"><?= e(ps_text('अविरल निष्ठा', 'Continuous Dedication')) ?></span>
        </div>
        <span class="font-display-hero text-display-hero text-pure-white font-headline-lg leading-none mb-1">12+ <?= e(ps_text('वर्ष', 'Years')) ?></span>
        <span class="font-title-md text-title-md text-surface-container-high font-semibold"><?= e(ps_text('निरंतर ज़मीनी सेवा', 'Ground Service')) ?></span>
        <p class="font-body-sm text-body-sm text-surface-container-high/80 mt-1"><?= e(ps_text('प्रत्येक वर्ष 45°C तापमान में विशेष सकोरा अभियान संचालन', 'Annual summer drives under 45°C heat')) ?></p>
      </div>

      <div class="flex flex-col p-4 rounded-xl bg-surface-container-low/10 border border-surface-container-high/15">
        <div class="flex items-center justify-between mb-2">
          <span class="material-symbols-outlined text-primary-fixed text-[28px]">volunteer_activism</span>
          <span class="font-label-sm text-label-sm text-primary-fixed uppercase tracking-wider"><?= e(ps_text('सक्रिय परिवार', 'Active Families')) ?></span>
        </div>
        <span class="font-display-hero text-display-hero text-pure-white font-headline-lg leading-none mb-1">5,000+</span>
        <span class="font-title-md text-title-md text-surface-container-high font-semibold"><?= e(ps_text('जागरूक \'परिंदा मित्र\'', 'Registered Bird Friends')) ?></span>
        <p class="font-body-sm text-body-sm text-surface-container-high/80 mt-1"><?= e(ps_text('जो रोज़ सवेरे अपनी छतों व आँगनों में दाना-पानी भरते हैं', 'Filling water and grain on roofs every morning')) ?></p>
      </div>
    </div>
  </div>
</section>

<!-- Campaign Rich Description / Detailed Content -->
<section class="w-full bg-cream-canvas py-space-3xl border-b border-border-warm">
  <div class="max-w-container-editorial mx-auto px-4 sm:px-8">
    <div class="bg-pure-white rounded-2xl p-6 sm:p-10 shadow-sm border border-border-warm">
      <div class="inline-flex items-center gap-2 bg-soft-meadow border border-border-warm px-3.5 py-1.5 rounded-full text-deep-forest font-label-sm text-label-sm font-semibold mb-4">
        <span class="material-symbols-outlined text-primary text-[18px]">menu_book</span>
        <span><?= e(ps_text('अभियान का विस्तृत विवरण', 'Detailed Initiative Overview')) ?></span>
      </div>
      <h2 class="font-headline-md text-headline-md text-deep-forest font-bold mb-6"><?= e($title) ?> — <?= e(ps_text('विस्तृत विवरण व लक्ष्य', 'Detailed Overview & Objectives')) ?></h2>
      <div class="font-body-md text-body-md text-on-surface-variant leading-relaxed space-y-4">
        <?= ps_rich_text($contentHtml) ?>
      </div>
    </div>
  </div>
</section>

<!-- Background & Why Campaign Needed Section -->
<section class="w-full bg-soft-meadow py-space-3xl border-b border-border-warm">
  <div class="max-w-container-max mx-auto px-4 sm:px-8">
    <div class="max-w-container-editorial mx-auto text-center mb-space-2xl">
      <span class="inline-block bg-cream-canvas border border-border-warm text-deep-forest px-3 py-1 rounded-md font-label-md text-label-md uppercase mb-2.5 font-semibold">
        <?= e(ps_text('संकट एवं संवेदनशीलता', 'Crisis & Sensitivity')) ?>
      </span>
      <h2 class="font-headline-lg text-headline-lg text-deep-forest mb-4 font-bold">
        <?= e(ps_text('आखिर क्यों आवश्यक है यह जन-अभियान?', 'Why is this Initiative Crucial?')) ?>
      </h2>
      <p class="font-body-lg text-body-lg text-on-surface-variant">
        <?= e(ps_text('प्रकृति का संतुलन बनाए रखने वाले हमारे नन्हे जीव, पर्यावरण और ग्रामीण विरासत कंक्रीट के अंधाधुंध विस्तार से संकट में हैं। अवध की माटी से उठती यह एक सामूहिक पुकार है।', 'Nature\'s balance is threatened by urbanization. This is a collective call from the soil of Awadh.')) ?>
      </p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 lg:gap-8">
      <!-- Crisis 1 -->
      <div class="bg-pure-white rounded-2xl p-6 sm:p-8 shadow-sm border border-border-warm flex flex-col justify-between">
        <div>
          <div class="w-12 h-12 rounded-xl bg-error-container text-error flex items-center justify-center mb-5">
            <span class="material-symbols-outlined text-[26px]">wb_sunny</span>
          </div>
          <h3 class="font-headline-sm text-headline-sm text-deep-forest mb-3 font-bold"><?= e(ps_text('भीषण लू और सूखते जल-स्रोत', 'Severe Heatwaves & Drying Ponds')) ?></h3>
          <p class="font-body-md text-body-md text-on-surface-variant mb-4">
            <?= e(ps_text('मई-जून के प्रचंड ताप में गाँव के पुराने पोखर, ताल-तलैया और कुएँ सूख जाते हैं। पानी की एक बूंद की तलाश में उड़ते हुए दर्जनों परिंदे डिहाइड्रेशन से दम तोड़ देते हैं।', 'During peak summer, village ponds dry up. Birds collapse from dehydration seeking a drop of water.')) ?>
          </p>
        </div>
        <div class="bg-soft-meadow rounded-lg p-3 text-deep-forest font-label-sm text-label-sm flex items-center gap-2 border border-border-warm">
          <span class="material-symbols-outlined text-[16px] text-primary">check_circle</span>
          <span><?= e(ps_text('उपाय: हर छत पर 1 सकोरा पानी = जीवनदान', 'Solution: 1 water bowl on every roof')) ?></span>
        </div>
      </div>

      <!-- Crisis 2 -->
      <div class="bg-pure-white rounded-2xl p-6 sm:p-8 shadow-sm border border-border-warm flex flex-col justify-between">
        <div>
          <div class="w-12 h-12 rounded-xl bg-tertiary-fixed text-tertiary flex items-center justify-center mb-5">
            <span class="material-symbols-outlined text-[26px]">cottage</span>
          </div>
          <h3 class="font-headline-sm text-headline-sm text-deep-forest mb-3 font-bold"><?= e(ps_text('पारंपरिक घोंसलों का उजड़ना', 'Loss of Traditional Nests')) ?></h3>
          <p class="font-body-md text-body-md text-on-surface-variant mb-4">
            <?= e(ps_text('कच्चे खपरैल मकानों, छप्परों और पुराने रोशनदानों की जगह पक्के कंक्रीट के मकानों ने ले ली है। घरेलू गौरैया (Sparrow) और बुलबुल के लिए सुरक्षित घर समाप्त हो रहे हैं।', 'Concrete buildings replaced thatched roofs and mud houses, destroying sparrow breeding spots.')) ?>
          </p>
        </div>
        <div class="bg-soft-meadow rounded-lg p-3 text-deep-forest font-label-sm text-label-sm flex items-center gap-2 border border-border-warm">
          <span class="material-symbols-outlined text-[16px] text-primary">check_circle</span>
          <span><?= e(ps_text('उपाय: काष्ठ व मिट्टी के सुरक्षित कृत्रिम बसेरे', 'Solution: Wooden & clay artificial nests')) ?></span>
        </div>
      </div>

      <!-- Crisis 3 -->
      <div class="bg-pure-white rounded-2xl p-6 sm:p-8 shadow-sm border border-border-warm flex flex-col justify-between">
        <div>
          <div class="w-12 h-12 rounded-xl bg-secondary-fixed text-secondary flex items-center justify-center mb-5">
            <span class="material-symbols-outlined text-[26px]">agriculture</span>
          </div>
          <h3 class="font-headline-sm text-headline-sm text-deep-forest mb-3 font-bold"><?= e(ps_text('खाद्य संकट व कीटनाशकों का दुष्प्रभाव', 'Food Crisis & Pesticide Impact')) ?></h3>
          <p class="font-body-md text-body-md text-on-surface-variant mb-4">
            <?= e(ps_text('खेतों में रासायनिक खादों के प्रयोग से कीड़ों और प्राकृतिक बीजों में विषाक्तता बढ़ गई है, जिससे पक्षियों की प्रजनन क्षमता व जीवन-काल पर गहरा आघात पहुंचा है।', 'Chemical fertilizers reduce natural seeds and insects, impacting bird life and reproduction.')) ?>
          </p>
        </div>
        <div class="bg-soft-meadow rounded-lg p-3 text-deep-forest font-label-sm text-label-sm flex items-center gap-2 border border-border-warm">
          <span class="material-symbols-outlined text-[16px] text-primary">check_circle</span>
          <span><?= e(ps_text('उपाय: प्राकृतिक ज्वार, बाजरा व सत्तू दाना-पात्र', 'Solution: Natural millets & grain feeders')) ?></span>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Upcoming Drive 2026 Announcement Card -->
<section class="w-full bg-cream-canvas py-space-2xl" id="upcoming-drive">
  <div class="max-w-container-max mx-auto px-4 sm:px-8">
    <div class="bg-gradient-to-r from-deep-forest to-primary-container rounded-3xl p-6 sm:p-10 text-pure-white shadow-md">
      <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-center">
        <div class="lg:col-span-8 flex flex-col">
          <div class="inline-flex items-center gap-2 bg-primary-fixed text-deep-forest font-label-sm text-label-sm px-3 py-1 rounded-full font-semibold w-fit mb-3">
            <span class="material-symbols-outlined text-[15px]">campaign</span>
            <span><?= e(ps_text('आगामी महा-अभियान', 'Upcoming Drive 2026')) ?></span>
          </div>
          <h3 class="font-headline-md text-headline-md text-pure-white mb-2 font-bold">
            <?= e(ps_text('ग्रीष्मकालीन सकोरा एवं पौधा वितरण महा-अभियान 2026', 'Summer Water Bowl & Sapling Distribution Drive 2026')) ?>
          </h3>
          <p class="font-body-md text-body-md text-surface-container-high mb-4">
            <?= e(ps_text('आगामी ग्रीष्म ऋतु में बाराबंकी ज़िले के प्रत्येक न्याय पंचायत तक 5,000 नए सकोरे एवं 500 सुरक्षित घोंसले पहुंचाने का दृढ़ संकल्प। अपने क्षेत्र में वितरण केंद्र स्थापित करने या स्वयंसेवक बनने हेतु आज ही पंजीकरण करें।', 'A firm resolution to reach every village panchayat with 5,000 water bowls and 500 nests across Barabanki.')) ?>
          </p>
          <div class="flex flex-wrap gap-4 font-label-md text-label-md text-surface-container-low">
            <div class="flex items-center gap-1.5">
              <span class="material-symbols-outlined text-tertiary-fixed text-[18px]">calendar_today</span>
              <span><?= e(ps_text('प्रारंभ: 15 अप्रैल 2026 (विश्व पृथ्वी दिवस से पूर्व)', 'Starts: April 15, 2026 (Before Earth Day)')) ?></span>
            </div>
            <div class="flex items-center gap-1.5">
              <span class="material-symbols-outlined text-tertiary-fixed text-[18px]">location_on</span>
              <span><?= e(ps_text('बाराबंकी, फतेहपुर, रामनगर, देवा, हैदरगढ़', 'Barabanki, Fatehpur, Ramnagar, Dewa, Haidergarh')) ?></span>
            </div>
          </div>
        </div>
        <div class="lg:col-span-4 flex flex-col sm:flex-row lg:flex-col gap-3 justify-center">
          <a href="<?= e(base_url('/volunteer')) ?>" class="inline-flex items-center justify-center gap-2 bg-pure-white hover:bg-soft-meadow text-deep-forest font-label-md text-label-md px-6 py-3.5 rounded-xl font-bold shadow-sm transition-colors text-center">
            <span class="material-symbols-outlined text-[18px] text-primary">add_circle</span>
            <span><?= e(ps_text('सकोरा वितरण केंद्र खोलें', 'Open Distribution Center')) ?></span>
          </a>
          <a href="tel:+919919007190" class="inline-flex items-center justify-center gap-2 bg-surface-container-low/20 hover:bg-surface-container-low/30 text-pure-white font-label-md text-label-md px-6 py-3.5 rounded-xl transition-colors text-center">
            <span class="material-symbols-outlined text-[18px]">call</span>
            <span><?= e(ps_text('हेल्पलाइन: +91 9919007190', 'Helpline: +91 9919007190')) ?></span>
          </a>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Pledge & Volunteer Form Section -->
<section class="w-full bg-soft-meadow py-space-3xl border-t border-border-warm" id="volunteer-form">
  <div class="max-w-container-editorial mx-auto px-4 sm:px-8">
    <div class="text-center mb-8">
      <span class="inline-block bg-cream-canvas border border-border-warm text-secondary px-3 py-1 rounded-md font-label-md text-label-md uppercase mb-2 font-semibold">
        <?= e(ps_text('एक मुट्ठी दाना • एक सकोरा पानी', 'A Grain of Food • A Bowl of Water')) ?>
      </span>
      <h2 class="font-headline-lg text-headline-lg text-deep-forest mb-3 font-bold">
        <?= e(ps_text('अभियान संकल्प एवं सहयोग पत्र', 'Initiative Pledge & Support Form')) ?>
      </h2>
      <p class="font-body-md text-body-md text-on-surface-variant">
        <?= e(ps_text('अपने घर की छत या बालकनी में एक सकोरा पानी और मुट्ठी भर दाना रखने का पवित्र संकल्प लें।', 'Pledge to place a water bowl and grain on your roof or balcony daily.')) ?>
      </p>
    </div>

    <div class="bg-pure-white rounded-3xl p-6 sm:p-10 shadow-md border border-border-warm">
      <form id="pledgeForm" method="post" action="<?= e(base_url('/contact')) ?>" class="space-y-5">
        <?= csrf_field() ?>
        <input type="hidden" name="form_type" value="contact">
        <input type="hidden" name="subject" value="<?= e($title) ?>">

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
          <div>
            <label class="block font-label-md text-label-md text-on-surface mb-1.5 font-semibold"><?= e(ps_text('आपका पूरा नाम *', 'Full Name *')) ?></label>
            <input type="text" name="name" required placeholder="<?= e(ps_text('उदा. अमित कुमार वर्मा', 'e.g. Amit Kumar')) ?>" class="w-full bg-soft-meadow border border-border-warm text-on-surface px-4 py-3 rounded-xl font-body-md text-body-md focus:outline-none focus:ring-2 focus:ring-primary-container">
          </div>
          <div>
            <label class="block font-label-md text-label-md text-on-surface mb-1.5 font-semibold"><?= e(ps_text('व्हाट्सएप / मोबाइल नंबर *', 'Mobile / WhatsApp Number *')) ?></label>
            <input type="tel" name="phone" required placeholder="<?= e(ps_text('10 अंकों का मोबाइल नंबर', '10 digit mobile number')) ?>" class="w-full bg-soft-meadow border border-border-warm text-on-surface px-4 py-3 rounded-xl font-body-md text-body-md focus:outline-none focus:ring-2 focus:ring-primary-container">
          </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
          <div>
            <label class="block font-label-md text-label-md text-on-surface mb-1.5 font-semibold"><?= e(ps_text('ईमेल पता', 'Email Address')) ?></label>
            <input type="email" name="email" placeholder="name@example.com" class="w-full bg-soft-meadow border border-border-warm text-on-surface px-4 py-3 rounded-xl font-body-md text-body-md focus:outline-none focus:ring-2 focus:ring-primary-container">
          </div>
          <div>
            <label class="block font-label-md text-label-md text-on-surface mb-1.5 font-semibold"><?= e(ps_text('गाँव / कस्बा / ज़िला', 'Village / Town / District')) ?></label>
            <input type="text" name="districtState" value="<?= e(ps_text('बाराबंकी, उत्तर प्रदेश', 'Barabanki, Uttar Pradesh')) ?>" class="w-full bg-soft-meadow border border-border-warm text-on-surface px-4 py-3 rounded-xl font-body-md text-body-md focus:outline-none focus:ring-2 focus:ring-primary-container">
          </div>
        </div>

        <div>
          <label class="block font-label-md text-label-md text-on-surface mb-1.5 font-semibold"><?= e(ps_text('आपका विचार या संदेश (वैकल्पिक)', 'Message / Proposal')) ?></label>
          <textarea name="message" rows="3" placeholder="<?= e(ps_text('अपने विचार या सहयोग के बारे में लिखें...', 'Write your thoughts or proposal here...')) ?>" class="w-full bg-soft-meadow border border-border-warm text-on-surface px-4 py-3 rounded-xl font-body-md text-body-md focus:outline-none focus:ring-2 focus:ring-primary-container"></textarea>
        </div>

        <div class="flex items-start gap-3 p-3.5 bg-surface-container-low rounded-xl border border-border-warm">
          <input type="checkbox" required id="pledgeCheck" class="w-5 h-5 mt-0.5 accent-primary text-primary shrink-0 rounded">
          <label for="pledgeCheck" class="font-body-sm text-body-sm text-deep-forest cursor-pointer">
            <?= e(ps_text('मैं सत्यनिष्ठा से संकल्प लेता/लेती हूँ कि इस अभियान में सक्रिय भूमिका निभाऊँगा/निभाऊँगी और प्रकृति व जीव-रक्षा हेतु प्रतिबद्ध रहूँगा/रहूँगी।', 'I pledge commitment to support this initiative actively and protect nature.')) ?>
          </label>
        </div>

        <button type="submit" class="w-full bg-primary-container hover:bg-deep-forest text-on-primary py-4 px-6 rounded-xl font-label-md text-label-md font-semibold transition-colors flex items-center justify-center gap-2 shadow-sm">
          <span class="material-symbols-outlined text-[20px]">volunteer_activism</span>
          <span><?= e(ps_text('संकल्प पत्र जमा करें (Submit Pledge)', 'Submit Pledge')) ?></span>
        </button>
      </form>
    </div>
  </div>
</section>

<!-- Related Campaigns Carousel/Grid -->
<section class="w-full bg-cream-canvas py-space-3xl border-t border-border-warm">
  <div class="max-w-container-max mx-auto px-4 sm:px-8">
    <div class="flex items-center justify-between mb-8">
      <div>
        <span class="font-label-sm text-label-sm text-secondary font-semibold uppercase block mb-1"><?= e(ps_text('सारंग जी के अन्य जन-आंदोलन', 'Other Initiatives')) ?></span>
        <h3 class="font-headline-md text-headline-md text-deep-forest font-bold"><?= e(ps_text('अन्य सक्रिय अभियान देखें', 'Related Active Initiatives')) ?></h3>
      </div>
      <a href="<?= e(base_url('/campaigns')) ?>" data-path="campaigns" class="inline-flex items-center gap-1 font-label-md text-label-md text-primary hover:text-deep-forest transition-colors font-bold">
        <span><?= e(ps_text('सभी अभियान', 'All Campaigns')) ?></span>
        <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
      </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
      <?php 
      $otherCampaigns = array_values(array_filter($campaigns, fn($c) => ($c['slug'] ?? '') !== ($item['slug'] ?? '')));
      if (!empty($otherCampaigns)): 
        foreach (array_slice($otherCampaigns, 0, 3) as $rel): 
      ?>
        <a href="<?= e(base_url('/campaigns/' . $rel['slug'])) ?>" class="group bg-pure-white rounded-2xl p-6 shadow-sm border border-border-warm hover:shadow-md transition-all flex flex-col justify-between">
          <div>
            <div class="w-10 h-10 rounded-lg bg-surface-container-high text-primary flex items-center justify-center mb-4">
              <span class="material-symbols-outlined text-[24px]">forest</span>
            </div>
            <h4 class="font-title-lg text-title-lg text-deep-forest font-semibold mb-2 group-hover:text-primary transition-colors">
              <?= e($rel['title']) ?>
            </h4>
            <p class="font-body-sm text-body-sm text-text-muted mb-4 line-clamp-3">
              <?= e(ps_excerpt($rel, 130)) ?>
            </p>
          </div>
          <div class="flex items-center gap-1.5 font-label-sm text-label-sm text-primary font-medium">
            <span><?= e(ps_text('विस्तार से जानें', 'Learn More')) ?></span>
            <span class="material-symbols-outlined text-[14px]">arrow_forward</span>
          </div>
        </a>
      <?php endforeach; else: ?>
        <a href="<?= e(base_url('/volunteer')) ?>" class="group bg-pure-white rounded-2xl p-6 shadow-sm border border-border-warm hover:shadow-md transition-all flex flex-col justify-between">
          <div>
            <div class="w-10 h-10 rounded-lg bg-surface-container-high text-primary flex items-center justify-center mb-4">
              <span class="material-symbols-outlined text-[24px]">forest</span>
            </div>
            <h4 class="font-title-lg text-title-lg text-deep-forest font-semibold mb-2 group-hover:text-primary transition-colors">
              <?= e(ps_text('हरियाली अभियान (ग्रीन गैंग)', 'Hariyali Campaign (Green Gang)')) ?>
            </h4>
            <p class="font-body-sm text-body-sm text-text-muted mb-4">
              <?= e(ps_text('बाराबंकी के बंजर किनारों और ग्रामीण पगडंडियों पर 50,000+ बरगद, पीपल, नीम और पाकड़ के वृक्षारोपण की सजीव मुहिम।', 'Over 50,000 Banyan, Peepal, Neem saplings planted across Barabanki trails.')) ?>
            </p>
          </div>
          <div class="flex items-center gap-1.5 font-label-sm text-label-sm text-primary font-medium">
            <span><?= e(ps_text('विस्तार से जानें', 'Learn More')) ?></span>
            <span class="material-symbols-outlined text-[14px]">arrow_forward</span>
          </div>
        </a>
      <?php endif; ?>
    </div>
  </div>
</section>
</div>
