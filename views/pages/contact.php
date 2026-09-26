<?php
declare(strict_types=1);

$contactPhone = $settings['phone'] ?? '+91 9919007190';
$contactEmail = $settings['email'] ?? 'contact@pradeepsarang.in';
$contactAddress = $settings['address'] ?? 'ग्राम कमरावां, जिला बाराबंकी, उत्तर प्रदेश, भारत';
?>

<div class="flex flex-col w-full">
<!-- Top Heritage Breadcrumb & Editorial Header Band -->
<section class="relative w-full bg-soft-meadow overflow-hidden py-space-2xl md:py-space-3xl border-b border-border-warm">
  <div class="max-w-container-max mx-auto px-4 sm:px-8 relative z-10">
    <!-- Breadcrumb -->
    <nav aria-label="Breadcrumb" class="flex items-center gap-2 font-label-md text-label-md text-text-muted mb-space-sm">
      <a class="hover:text-primary transition-colors flex items-center gap-1" data-path="home" href="<?= e(base_url('/')) ?>">
        <span class="material-symbols-outlined text-[16px]">home</span>
        <span><?= e(ps_text('गृह (Home)', 'Home')) ?></span>
      </a>
      <span class="opacity-40">/</span>
      <span class="text-deep-forest font-semibold"><?= e(ps_text('संपर्क व संवाद (Contact & Dialogue)', 'Contact & Direct Dialogue')) ?></span>
    </nav>
    <!-- Badge Pill -->
    <div class="inline-flex items-center gap-2 bg-primary-fixed/40 text-deep-forest px-3.5 py-1 rounded-full font-label-sm text-label-sm mb-space-sm border border-border-warm font-semibold">
      <span class="material-symbols-outlined text-[15px] text-primary-container" style="font-variation-settings: 'FILL' 1;">nature_people</span>
      <span><?= e(ps_text('माटी से संवाद • खुला मंच • चौपाल से सचिवालय तक', 'Dialogue with Soil • Open Forum • Village Chaupal to Secretariat')) ?></span>
    </div>
    <!-- Grid Header & Signature Quote -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center mt-2">
      <div class="lg:col-span-8 flex flex-col space-y-3">
        <h1 class="font-display-hero text-headline-lg md:text-display-hero text-deep-forest leading-tight tracking-tight font-bold">
          <?= ps_text('माटी, सरोकार और सेवा से जुड़ें — <span class="text-primary-container">संपर्क व जन-संवाद</span>', 'Connect with Soil, Concerns & Service — <span class="text-primary-container">Contact & Direct Dialogue</span>') ?>
        </h1>
        <p class="font-body-lg text-body-lg text-text-muted mt-space-sm max-w-3xl leading-relaxed">
          <?= e(ps_text('पर्यावरण संवर्धन, गाँव की चौपाल में हरित आयोजन, अवधी साहित्य विमर्श अथवा ज़मीनी समस्याओं के यथार्थ समाधान हेतु सीधे संवाद करें। हर नागरिक की आवाज़ और हर विचार हमारे लिए माटी के समान अनमोल है।', 'Direct dialogue for environmental conservation, green events in village chaupals, Awadhi literature discussions or ground-level problem resolution. Every citizen voice is priceless like the soil.')) ?>
        </p>
      </div>
      <!-- Signature Editorial Card -->
      <div class="lg:col-span-4">
        <div class="bg-cream-canvas rounded-2xl p-6 border-l-4 border-secondary shadow-[0_8px_24px_-4px_rgba(23,34,27,0.06)] relative overflow-hidden">
          <div class="absolute -right-4 -bottom-4 opacity-5 pointer-events-none">
            <span class="material-symbols-outlined text-[120px] text-deep-forest">format_quote</span>
          </div>
          <div class="flex items-center gap-2 text-secondary mb-2">
            <span class="material-symbols-outlined text-[18px]">menu_book</span>
            <span class="font-label-sm text-label-sm uppercase tracking-wider font-bold"><?= e(ps_text('लोककवि सारंग संकल्प', 'Poetic Resolution')) ?></span>
          </div>
          <p class="font-quote-editorial text-title-lg text-deep-forest leading-relaxed italic mb-3">
            <?= ps_text('"हारना सीखा नहीं है, जीत का मैं गीत हूँ।<br/>जुगनुओं का संग है, इंसानियत का मीत हूँ।"', '"I have not learned to lose; I am a song of victory.<br/>Accompanied by fireflies, I am a friend to humanity."') ?>
          </p>
          <div class="flex items-center justify-between pt-2 border-t border-border-warm font-label-md text-label-md">
            <span class="text-deep-forest font-semibold"><?= e(ps_text('— प्रदीप सारंग', '— Pradeep Sarang')) ?></span>
            <span class="text-text-muted text-label-sm"><?= e(ps_text('ग्राम कमरावां, जिला बाराबंकी, उत्तर प्रदेश, भारत', 'Gram Kamrawan, District Barabanki, Uttar Pradesh, India')) ?></span>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Metric Strip: 4 Reassurance Pillars -->
<section class="w-full bg-pure-white border-b border-border-warm py-space-lg">
  <div class="max-w-container-max mx-auto px-4 sm:px-8">
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6">
      <!-- Pillar 1 -->
      <div class="flex items-center gap-4 p-4 rounded-xl bg-soft-meadow border border-border-warm">
        <div class="w-12 h-12 rounded-xl bg-primary-container/10 flex items-center justify-center text-primary-container shrink-0">
          <span class="material-symbols-outlined text-[26px]">timer</span>
        </div>
        <div>
          <div class="font-title-lg text-title-lg text-deep-forest font-bold">24-48 <?= e(ps_text('घंटे', 'Hours')) ?></div>
          <div class="font-body-sm text-body-sm text-text-muted"><?= e(ps_text('त्वरित प्रतिपुष्टि व संवाद प्रतिज्ञान', 'Quick Response & Dialogue Confirmation')) ?></div>
        </div>
      </div>
      <!-- Pillar 2 -->
      <div class="flex items-center gap-4 p-4 rounded-xl bg-soft-meadow border border-border-warm">
        <div class="w-12 h-12 rounded-xl bg-primary-container/10 flex items-center justify-center text-primary-container shrink-0">
          <span class="material-symbols-outlined text-[26px]">hub</span>
        </div>
        <div>
          <div class="font-title-lg text-title-lg text-deep-forest font-bold">120+ <?= e(ps_text('गाँव', 'Villages')) ?></div>
          <div class="font-body-sm text-body-sm text-text-muted"><?= e(ps_text('सक्रिय चौपाल व जनसंपर्क नेटवर्क', 'Active Chaupal & Outreach Network')) ?></div>
        </div>
      </div>
      <!-- Pillar 3 -->
      <div class="flex items-center gap-4 p-4 rounded-xl bg-soft-meadow border border-border-warm">
        <div class="w-12 h-12 rounded-xl bg-primary-container/10 flex items-center justify-center text-primary-container shrink-0">
          <span class="material-symbols-outlined text-[26px]">volunteer_activism</span>
        </div>
        <div>
          <div class="font-title-lg text-title-lg text-deep-forest font-bold">100% <?= e(ps_text('निःशुल्क', 'Free')) ?></div>
          <div class="font-body-sm text-body-sm text-text-muted"><?= e(ps_text('निःस्वार्थ जनसेवा व सामाजिक मार्गदर्शन', 'Selfless Public Service & Social Guidance')) ?></div>
        </div>
      </div>
      <!-- Pillar 4 -->
      <div class="flex items-center gap-4 p-4 rounded-xl bg-soft-meadow border border-border-warm">
        <div class="w-12 h-12 rounded-xl bg-primary-container/10 flex items-center justify-center text-primary-container shrink-0">
          <span class="material-symbols-outlined text-[26px]">verified_user</span>
        </div>
        <div>
          <div class="font-title-lg text-title-lg text-deep-forest font-bold"><?= e(ps_text('सीधा संवाद', 'Direct Dialogue')) ?></div>
          <div class="font-body-sm text-body-sm text-text-muted"><?= e(ps_text('कोई बिचौलिया नहीं, ज़मीनी कार्यकर्ता टीम', 'No Middlemen, Ground Worker Team')) ?></div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Field Headquarters & Outreach Image Showcase -->
<section class="w-full py-space-xl bg-pure-white border-b border-border-warm">
  <div class="max-w-container-max mx-auto px-4 sm:px-8">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
      <div class="relative rounded-2xl overflow-hidden shadow-sm border border-border-warm group">
        <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuChrvMjaMrNe9mnv0wsNeczsA9QTsVBVexwNC6wWD2ITtZGUqAqC4rJlu14alM7uVOx3q6e6QMugj2k_SVptJFwJxqw4kgUmkZfc4oZSwOSInUiqwcST-ZVxWP0dQNinxgeGayBKo9MBnd0LReS_tvv8rW_e0uWQz8FI_1PBQ_sze_mt4-UezPUkio4HIFKvoUNP0kZ6gNLPilWihHeDYhJaX6ySBPHJHVKOu68a1dbF1aYaqyDO7Db" alt="Kamrawan Center" class="w-full h-56 object-cover group-hover:scale-105 transition-transform duration-300">
        <div class="absolute bottom-0 inset-x-0 bg-gradient-to-t from-deep-forest/90 via-deep-forest/50 to-transparent p-4 text-pure-white">
          <span class="font-label-sm text-label-sm uppercase tracking-wider text-fresh-sprout font-bold"><?= e(ps_text('सेवा केंद्र कमरावां', 'Kamrawan Service Center')) ?></span>
          <p class="font-title-md text-title-md font-bold mt-0.5"><?= e(ps_text('ग्राम कमरावां, जिला बाराबंकी, उत्तर प्रदेश, भारत', 'Gram Kamrawan, District Barabanki, Uttar Pradesh, India')) ?></p>
        </div>
      </div>
      <div class="relative rounded-2xl overflow-hidden shadow-sm border border-border-warm group">
        <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuCIdMQwsnVo2dk4ut7g6q_cAP6eTxbCJ79UEWEL6LMYJP9Bzoa711KY0DUcQDKRXxuQ_6LQhxi0vQ2STd8MG_7M8PMwLDKDbl4rkN0NWnrSqVTvaAamPZA23ot4DWOtvh7QMTvSKjQWd4KHteII-UyAePIVzkOU6Kjt18WGSoV63V45Zxnm-uJxCWTIYBFdLiZQTIIpMJ2BicU3nJOrp9TW5wTXMOaNdUj57zI1cu2Z0PJgk4oP02r7" alt="Village Chaupal Dialogue" class="w-full h-56 object-cover group-hover:scale-105 transition-transform duration-300">
        <div class="absolute bottom-0 inset-x-0 bg-gradient-to-t from-deep-forest/90 via-deep-forest/50 to-transparent p-4 text-pure-white">
          <span class="font-label-sm text-label-sm uppercase tracking-wider text-tertiary-fixed font-bold"><?= e(ps_text('ग्राम चौपाल व पर्यावरण संवाद', 'Village Green Chaupal')) ?></span>
          <p class="font-title-md text-title-md font-bold mt-0.5"><?= e(ps_text('अवध अंचल के गांवों में प्रत्यक्ष जन-संवाद', 'Direct Grassroots Dialogue in Awadh Villages')) ?></p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- 3 Primary Direct Connect Hubs (Featured Action Cards) -->
<section class="w-full py-space-3xl bg-cream-canvas">
  <div class="max-w-container-max mx-auto px-4 sm:px-8">
    <div class="flex flex-col sm:flex-row sm:items-end justify-between mb-space-xl gap-4">
      <div>
        <span class="font-label-sm text-label-sm uppercase tracking-wider text-primary-container font-bold"><?= e(ps_text('प्राथमिक संवाद केंद्र', 'Primary Connect Hubs')) ?></span>
        <h2 class="font-headline-md text-headline-md text-deep-forest font-bold mt-1"><?= e(ps_text('सीधे संपर्क के तीन सशक्त माध्यम', 'Three Channels for Direct Contact')) ?></h2>
      </div>
      <p class="font-body-sm text-body-sm text-text-muted max-w-md">
        <?= e(ps_text('अपनी सुविधा अनुसार कॉल, डिजिटल संदेश अथवा बाराबंकी स्थित चौपाल केंद्र पर पधारकर संवाद स्थापित करें।', 'Connect via phone call, digital message, or visit our Barabanki chaupal center.')) ?>
      </p>
    </div>
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
      <!-- Hub 1: Call & WhatsApp -->
      <div class="bg-pure-white rounded-2xl p-7 border border-border-warm flex flex-col justify-between shadow-[0_4px_20px_-2px_rgba(23,34,27,0.04)] hover:shadow-md transition-all group">
        <div>
          <div class="flex items-center justify-between mb-5">
            <div class="w-14 h-14 rounded-2xl bg-surface-container flex items-center justify-center text-primary-container group-hover:scale-105 transition-transform">
              <span class="material-symbols-outlined text-[32px]">perm_phone_msg</span>
            </div>
            <span class="bg-surface-container-high text-deep-forest font-label-sm text-label-sm px-3 py-1 rounded-full font-semibold"><?= e(ps_text('प्रातः 8 - सायं 8', '8:00 AM - 8:00 PM')) ?></span>
          </div>
          <h3 class="font-headline-sm text-headline-sm text-deep-forest font-bold mb-1"><?= e(ps_text('सीधा दूरभाष व WhatsApp संवाद', 'Direct Phone & WhatsApp')) ?></h3>
          <p class="font-body-sm text-body-sm text-text-muted mb-4">
            <?= e(ps_text('प्रातः 8:00 से सायं 8:00 बजे तक (हरियाली व जनसेवा हेतु तत्पर)', '8:00 AM to 8:00 PM (Ready for green & community service)')) ?>
          </p>
          <div class="bg-soft-meadow rounded-xl p-4 border border-border-warm mb-5">
            <div class="font-label-sm text-label-sm text-text-muted mb-1"><?= e(ps_text('आधिकारिक हेल्पलाइन नंबर', 'Official Helpline Number')) ?></div>
            <a class="font-headline-sm text-headline-sm text-primary-container font-bold tracking-tight hover:underline flex items-center gap-2" href="tel:<?= e(preg_replace('/[^0-9+]/', '', $contactPhone)) ?>">
              <span><?= e($contactPhone) ?></span>
              <span class="material-symbols-outlined text-[20px]">call_made</span>
            </a>
          </div>
          <div class="flex flex-wrap gap-2 mb-6">
            <span class="inline-flex items-center gap-1 font-label-sm text-label-sm bg-primary-fixed/30 text-deep-forest px-2.5 py-1 rounded-md">
              <span class="material-symbols-outlined text-[14px]">eco</span>
              <?= e(ps_text('ग्रीन मॉर्निंग हेल्पलाइन', 'Green Morning Helpline')) ?>
            </span>
            <span class="inline-flex items-center gap-1 font-label-sm text-label-sm bg-tertiary-fixed/40 text-tertiary px-2.5 py-1 rounded-md">
              <span class="material-symbols-outlined text-[14px]">chat</span>
              <?= e(ps_text('त्वरित WhatsApp समाधान', 'Quick WhatsApp Chat')) ?>
            </span>
          </div>
        </div>
        <div class="flex flex-col sm:flex-row gap-3 pt-2">
          <a class="flex-1 inline-flex items-center justify-center gap-2 bg-primary-container hover:bg-deep-forest text-on-primary font-label-md text-label-md px-4 py-3 rounded-xl transition-all shadow-sm" href="https://wa.me/<?= preg_replace('/[^0-9]/', '', $contactPhone) ?>" target="_blank" rel="noopener noreferrer">
            <span class="material-symbols-outlined text-[18px]">chat</span>
            <span>WhatsApp <?= e(ps_text('संदेश', 'Message')) ?></span>
          </a>
          <a class="inline-flex items-center justify-center gap-2 bg-soft-meadow hover:bg-surface-container text-deep-forest font-label-md text-label-md px-4 py-3 rounded-xl border border-border-warm transition-all" href="tel:<?= e(preg_replace('/[^0-9+]/', '', $contactPhone)) ?>">
            <span class="material-symbols-outlined text-[18px]">call</span>
            <span><?= e(ps_text('कॉल करें', 'Call Now')) ?></span>
          </a>
        </div>
      </div>

      <!-- Hub 2: Email Communication -->
      <div class="bg-pure-white rounded-2xl p-7 border border-border-warm flex flex-col justify-between shadow-[0_4px_20px_-2px_rgba(23,34,27,0.04)] hover:shadow-md transition-all group">
        <div>
          <div class="flex items-center justify-between mb-5">
            <div class="w-14 h-14 rounded-2xl bg-tertiary-fixed/30 flex items-center justify-center text-tertiary group-hover:scale-105 transition-transform">
              <span class="material-symbols-outlined text-[32px]">mark_email_read</span>
            </div>
            <span class="bg-soft-meadow text-deep-forest font-label-sm text-label-sm px-3 py-1 rounded-full border border-border-warm font-semibold"><?= e(ps_text('लिखित संवाद', 'Written Inquiry')) ?></span>
          </div>
          <h3 class="font-headline-sm text-headline-sm text-deep-forest font-bold mb-1"><?= e(ps_text('आधिकारिक ईमेल डेस्क', 'Official Email Desk')) ?></h3>
          <p class="font-body-sm text-body-sm text-text-muted mb-4">
            <?= e(ps_text('औपचारिक आमंत्रण, शोध पत्र, अवधी साहित्य पांडुलिपि व संपादकीय सुझावों हेतु।', 'For formal invitations, research papers, Awadhi literary manuscripts & editorial suggestions.')) ?>
          </p>
          <div class="bg-soft-meadow rounded-xl p-4 border border-border-warm mb-4">
            <div class="font-label-sm text-label-sm text-text-muted mb-1"><?= e(ps_text('मुख्य जनसंपर्क डेस्क', 'Main Desk Email')) ?></div>
            <a class="font-title-md text-title-md text-deep-forest font-bold hover:underline block truncate" href="mailto:<?= e($contactEmail) ?>">
              <?= e($contactEmail) ?>
            </a>
          </div>
          <div class="space-y-2 text-body-sm text-body-sm mb-6">
            <div class="flex items-center justify-between text-on-surface-variant p-2 rounded-lg bg-cream-canvas">
              <span class="flex items-center gap-1.5 font-label-sm text-label-sm text-deep-forest">
                <span class="material-symbols-outlined text-[16px] text-tertiary">newspaper</span>
                <?= e(ps_text('प्रेस व मीडिया:', 'Press & Media:')) ?>
              </span>
              <a class="text-primary font-medium hover:underline text-body-sm" href="mailto:contact@pradeepsarang.in">contact@pradeepsarang.in</a>
            </div>
            <div class="flex items-center justify-between text-on-surface-variant p-2 rounded-lg bg-cream-canvas">
              <span class="flex items-center gap-1.5 font-label-sm text-label-sm text-deep-forest">
                <span class="material-symbols-outlined text-[16px] text-primary-container">groups</span>
                <?= e(ps_text('ग्रीन गैंग स्वयंसेवक:', 'Green Gang Volunteers:')) ?>
              </span>
              <a class="text-primary font-medium hover:underline text-body-sm" href="mailto:contact@pradeepsarang.in">contact@pradeepsarang.in</a>
            </div>
          </div>
        </div>
        <a class="w-full inline-flex items-center justify-center gap-2 bg-deep-forest hover:bg-on-background text-on-primary font-label-md text-label-md px-4 py-3 rounded-xl transition-all shadow-sm" href="mailto:<?= e($contactEmail) ?>">
          <span class="material-symbols-outlined text-[18px]">send</span>
          <span><?= e(ps_text('ईमेल प्रेषित करें', 'Send Email')) ?></span>
        </a>
      </div>

      <!-- Hub 3: Chaupal & Village Address -->
      <div class="bg-pure-white rounded-2xl p-7 border border-border-warm flex flex-col justify-between shadow-[0_4px_20px_-2px_rgba(23,34,27,0.04)] hover:shadow-md transition-all group">
        <div>
          <div class="flex items-center justify-between mb-5">
            <div class="w-14 h-14 rounded-2xl bg-secondary-fixed/40 flex items-center justify-center text-secondary group-hover:scale-105 transition-transform">
              <span class="material-symbols-outlined text-[32px]">cottage</span>
            </div>
            <span class="bg-secondary-fixed/30 text-secondary font-label-sm text-label-sm px-3 py-1 rounded-full font-semibold"><?= e(ps_text('माटी की चौपाल', 'Chaupal Location')) ?></span>
          </div>
          <h3 class="font-headline-sm text-headline-sm text-deep-forest font-bold mb-1"><?= e(ps_text('पैतृक आवास व चौपाल केंद्र', 'Residence & Chaupal Center')) ?></h3>
          <p class="font-body-sm text-body-sm text-text-muted mb-4">
            <?= e(ps_text('ग्रामीण जनसुनवाई, वृक्ष-पंचायत एवं अनौपचारिक साहित्य-गोष्ठी केंद्र।', 'Rural community hearings, tree assemblies & informal literary gatherings.')) ?>
          </p>
          <div class="space-y-3 mb-5">
            <div class="p-3.5 rounded-xl bg-soft-meadow border border-border-warm">
              <div class="flex items-start gap-2.5">
                <span class="material-symbols-outlined text-[18px] text-primary-container shrink-0 mt-0.5">location_on</span>
                <div class="text-body-sm text-body-sm">
                  <strong class="text-deep-forest font-semibold block"><?= e(ps_text('पैतृक आवास:', 'Ancestral Residence:')) ?></strong>
                  <?= e($contactAddress) ?> — 225122
                </div>
              </div>
            </div>
            <div class="p-3.5 rounded-xl bg-soft-meadow border border-border-warm">
              <div class="flex items-start gap-2.5">
                <span class="material-symbols-outlined text-[18px] text-secondary shrink-0 mt-0.5">apartment</span>
                <div class="text-body-sm text-body-sm">
                  <strong class="text-deep-forest font-semibold block"><?= e(ps_text('नगर संवाद केंद्र:', 'City Dialogue Center:')) ?></strong>
                  <?= e(ps_text('छाया चौराहा / गांधी भवन मार्ग, बाराबंकी, उत्तर प्रदेश', 'Chhaya Chauraha / Gandhi Bhawan Road, Barabanki, UP')) ?>
                </div>
              </div>
            </div>
          </div>
        </div>
        <a class="w-full inline-flex items-center justify-center gap-2 bg-soft-meadow hover:bg-surface-container text-deep-forest font-label-md text-label-md px-4 py-3 rounded-xl border border-border-warm transition-all" href="#reach-guide">
          <span class="material-symbols-outlined text-[18px]">map</span>
          <span><?= e(ps_text('पहुँचने का मार्ग व मानचित्र देखें', 'View Map & Directions')) ?></span>
        </a>
      </div>
    </div>
  </div>
</section>

<!-- Categorized Query Desks -->
<section class="w-full py-space-2xl bg-soft-meadow border-y border-border-warm">
  <div class="max-w-container-max mx-auto px-4 sm:px-8">
    <div class="max-w-2xl mb-space-xl">
      <span class="font-label-sm text-label-sm uppercase tracking-wider text-primary-container font-bold"><?= e(ps_text('कार्यक्षेत्र अनुसार समन्वय', 'Domain Coordination')) ?></span>
      <h2 class="font-headline-md text-headline-md text-deep-forest font-bold mt-1"><?= e(ps_text('विषयवार संवाद एवं सहयोग डेस्क', 'Categorized Coordination Desks')) ?></h2>
      <p class="font-body-md text-body-md text-on-surface-variant mt-2">
        <?= e(ps_text('जिस उद्देश्य हेतु आप जुड़ना चाहते हैं, सीधे उस विशेष दल से संपर्क करें ताकि आपके निवेदन पर अविलंब कार्य आरंभ हो सके।', 'Select the relevant domain desk to quickly submit your request.')) ?>
      </p>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5">
      <!-- Desk 1 -->
      <div class="bg-pure-white p-6 rounded-2xl border border-border-warm hover:border-primary-container/40 transition-all flex flex-col justify-between">
        <div>
          <div class="w-11 h-11 rounded-xl bg-primary-container text-on-primary flex items-center justify-center mb-4">
            <span class="material-symbols-outlined text-[24px]">forest</span>
          </div>
          <div class="font-label-sm text-label-sm text-primary font-semibold mb-1"><?= e(ps_text('अभियान 01', 'Campaign 01')) ?></div>
          <h3 class="font-title-md text-title-md text-deep-forest font-bold mb-2"><?= e(ps_text('हरियाली व ग्रीन गैंग', 'Hariyali & Green Gang')) ?></h3>
          <p class="font-body-sm text-body-sm text-on-surface-variant leading-relaxed mb-4">
            <?= e(ps_text('अपने गाँव, विद्यालय अथवा सार्वजनिक स्थल पर निःशुल्क पौधारोपण, ट्री-गार्ड व \'ग्रीन मॉर्निंग\' टोली गठन हेतु।', 'For tree plantation drives, tree guards & Green Morning squad formation.')) ?>
          </p>
        </div>
        <button type="button" onclick="selectSubject('पौधारोपण व \'ग्रीन गैंग\' सहयोग')" class="text-left font-label-md text-label-md text-primary-container hover:text-deep-forest flex items-center gap-1 group font-semibold">
          <span><?= e(ps_text('प्रपत्र में यह विषय चुनें', 'Select in form')) ?></span>
          <span class="material-symbols-outlined text-[16px] group-hover:translate-x-1 transition-transform">arrow_forward</span>
        </button>
      </div>
      <!-- Desk 2 -->
      <div class="bg-pure-white p-6 rounded-2xl border border-border-warm hover:border-primary-container/40 transition-all flex flex-col justify-between">
        <div>
          <div class="w-11 h-11 rounded-xl bg-secondary text-on-secondary flex items-center justify-center mb-4">
            <span class="material-symbols-outlined text-[24px]">flutter_dash</span>
          </div>
          <div class="font-label-sm text-label-sm text-secondary font-semibold mb-1"><?= e(ps_text('अभियान 02', 'Campaign 02')) ?></div>
          <h3 class="font-title-md text-title-md text-deep-forest font-bold mb-2"><?= e(ps_text('परिंदा संरक्षण व सकोरा', 'Bird Conservation & Sakora')) ?></h3>
          <p class="font-body-sm text-body-sm text-on-surface-variant leading-relaxed mb-4">
            <?= e(ps_text('ग्रीष्म ऋतु में पक्षियों के लिए मिट्टी के पात्र (सकोरे), दाना-पानी वितरण केंद्र एवं परिंदा बचाओ चौपाल।', 'For earthen water bowls (sakoras), seed-water feeder distribution & bird rescue chaupals.')) ?>
          </p>
        </div>
        <button type="button" onclick="selectSubject('परिंदा संरक्षण (सकोरा आवश्यकता)')" class="text-left font-label-md text-label-md text-secondary hover:text-deep-forest flex items-center gap-1 group font-semibold">
          <span><?= e(ps_text('प्रपत्र में यह विषय चुनें', 'Select in form')) ?></span>
          <span class="material-symbols-outlined text-[16px] group-hover:translate-x-1 transition-transform">arrow_forward</span>
        </button>
      </div>
      <!-- Desk 3 -->
      <div class="bg-pure-white p-6 rounded-2xl border border-border-warm hover:border-primary-container/40 transition-all flex flex-col justify-between">
        <div>
          <div class="w-11 h-11 rounded-xl bg-tertiary-container text-on-tertiary flex items-center justify-center mb-4">
            <span class="material-symbols-outlined text-[24px]">ink_pen</span>
          </div>
          <div class="font-label-sm text-label-sm text-tertiary font-semibold mb-1"><?= e(ps_text('सांस्कृतिक विमर्श', 'Cultural Desk')) ?></div>
          <h3 class="font-title-md text-title-md text-deep-forest font-bold mb-2"><?= e(ps_text('अवधी साहित्य व गोष्ठी', 'Awadhi Literature & Meet')) ?></h3>
          <p class="font-body-sm text-body-sm text-on-surface-variant leading-relaxed mb-4">
            <?= e(ps_text('\'सारंग-कुण्डलियाँ\', तुलसी जयंती पखवारा, अवधी भाषा शोधार्थी संवाद अथवा लोककाव्य गोष्ठी में सहभागिता।', 'For Sarang-Kundaliyan poetry, Tulsi Jayanti fortnight & Awadhi research.')) ?>
          </p>
        </div>
        <button type="button" onclick="selectSubject('अवधी साहित्य व काव्य गोष्ठी')" class="text-left font-label-md text-label-md text-tertiary hover:text-deep-forest flex items-center gap-1 group font-semibold">
          <span><?= e(ps_text('प्रपत्र में यह विषय चुनें', 'Select in form')) ?></span>
          <span class="material-symbols-outlined text-[16px] group-hover:translate-x-1 transition-transform">arrow_forward</span>
        </button>
      </div>
      <!-- Desk 4 -->
      <div class="bg-pure-white p-6 rounded-2xl border border-border-warm hover:border-primary-container/40 transition-all flex flex-col justify-between">
        <div>
          <div class="w-11 h-11 rounded-xl bg-deep-forest text-pure-white flex items-center justify-center mb-4">
            <span class="material-symbols-outlined text-[24px]">newspaper</span>
          </div>
          <div class="font-label-sm text-label-sm text-deep-forest font-semibold mb-1"><?= e(ps_text('आधिकारिक माध्यम', 'Official Media')) ?></div>
          <h3 class="font-title-md text-title-md text-deep-forest font-bold mb-2"><?= e(ps_text('मीडिया व साक्षात्कार', 'Media & Interviews')) ?></h3>
          <p class="font-body-sm text-body-sm text-on-surface-variant leading-relaxed mb-4">
            <?= e(ps_text('पत्रकारों, वृत्तचित्र निर्माताओं व अकादमिक शोधकर्ताओं के लिए सारंग जी का साक्षात्कार एवं सामाजिक आंकड़े।', 'For journalist inquiries, documentary interviews & academic research.')) ?>
          </p>
        </div>
        <button type="button" onclick="selectSubject('मीडिया व साक्षात्कार')" class="text-left font-label-md text-label-md text-deep-forest hover:text-primary flex items-center gap-1 group font-semibold">
          <span><?= e(ps_text('प्रपत्र में यह विषय चुनें', 'Select in form')) ?></span>
          <span class="material-symbols-outlined text-[16px] group-hover:translate-x-1 transition-transform">arrow_forward</span>
        </button>
      </div>
    </div>
  </div>
</section>

<!-- Comprehensive Interactive Contact & Inquiry Form -->
<section class="w-full py-space-4xl bg-cream-canvas" id="dialogue-form">
  <div class="max-w-container-max mx-auto px-4 sm:px-8">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-start">
      <!-- Left Column: Guidance, Field Reassurance & Sarang Image -->
      <div class="lg:col-span-5 space-y-6">
        <div class="bg-pure-white rounded-2xl p-7 border border-border-warm shadow-sm">
          <span class="font-label-sm text-label-sm uppercase tracking-wider text-primary-container font-bold"><?= e(ps_text('पारदर्शी कार्यप्रणाली', 'Transparent Process')) ?></span>
          <h2 class="font-headline-sm text-headline-sm text-deep-forest font-bold mt-1 mb-4"><?= e(ps_text('संवाद कैसे काम करता है?', 'How Dialogue Works')) ?></h2>
          <!-- Stepper -->
          <div class="space-y-4">
            <div class="flex items-start gap-3.5">
              <div class="w-7 h-7 rounded-full bg-primary-container text-on-primary flex items-center justify-center font-bold text-label-sm shrink-0 mt-0.5">1</div>
              <div>
                <div class="font-title-md text-title-md text-deep-forest font-semibold"><?= e(ps_text('संदेश प्राप्ति एवं पंजीकरण', 'Message Received & Registered')) ?></div>
                <p class="font-body-sm text-body-sm text-text-muted mt-0.5">
                  <?= e(ps_text('आपका संदेश सीधे प्रदीप सारंग जी के बाराबंकी समन्वय दल के केंद्रीय पटल पर दर्ज होता है।', 'Your message is registered directly at the Barabanki coordination desk.')) ?>
                </p>
              </div>
            </div>
            <div class="flex items-start gap-3.5">
              <div class="w-7 h-7 rounded-full bg-primary-container text-on-primary flex items-center justify-center font-bold text-label-sm shrink-0 mt-0.5">2</div>
              <div>
                <div class="font-title-md text-title-md text-deep-forest font-semibold"><?= e(ps_text('व्यक्तिगत सत्यापन व संवाद', 'Personal Verification & Contact')) ?></div>
                <p class="font-body-sm text-body-sm text-text-muted mt-0.5">
                  <?= e(ps_text('आपकी सुविधानुसार 24 से 48 घंटे के भीतर फोन अथवा WhatsApp पर पुष्टि की जाती है।', 'Confirmation within 24-48 hours via phone or WhatsApp.')) ?>
                </p>
              </div>
            </div>
            <div class="flex items-start gap-3.5">
              <div class="w-7 h-7 rounded-full bg-primary-container text-on-primary flex items-center justify-center font-bold text-label-sm shrink-0 mt-0.5">3</div>
              <div>
                <div class="font-title-md text-title-md text-deep-forest font-semibold"><?= e(ps_text('स्थानीय कार्यदल सक्रियण', 'Field Team Activation')) ?></div>
                <p class="font-body-sm text-body-sm text-text-muted mt-0.5">
                  <?= e(ps_text('गाँव चौपाल, पौधा वितरण अथवा साहित्यिक संगोष्ठी हेतु स्थानीय \'ग्रीन गैंग\' समन्वयक सीधे आपसे जुड़ते हैं।', 'Local Green Gang coordinators connect directly for plantation or event organizing.')) ?>
                </p>
              </div>
            </div>
          </div>
          <!-- Privacy Guarantee Note -->
          <div class="mt-6 pt-5 border-t border-border-warm flex items-start gap-3 bg-soft-meadow p-4 rounded-xl">
            <span class="material-symbols-outlined text-fresh-sprout text-[22px] shrink-0 mt-0.5">verified</span>
            <p class="font-body-sm text-body-sm text-on-surface-variant">
              <strong><?= e(ps_text('गोपनीयता संकल्प:', 'Privacy Pledge:')) ?></strong> <?= e(ps_text('आपकी व्यक्तिगत जानकारी पूर्णतः सुरक्षित है और इसका उपयोग केवल सामाजिक व जनहितकारी संवाद हेतु किया जाएगा।', 'Your personal info is strictly safe and used solely for public welfare communication.')) ?>
            </p>
          </div>
        </div>
        <!-- Documentary Photo Vignette -->
        <div class="bg-pure-white rounded-2xl overflow-hidden border border-border-warm shadow-sm">
          <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuD5yEVBa9xPh0ZhvNwEIN6MFAA461yPM0C5P0168tLZRuQXxFDN71kQMx04vTPD77ud8LcHlTFU5xdOCG-jHHY2AqMBZvmNXNVOXffienT-oK6c9oGoz-H98k5JxO7-xYs3iS-cpSvJ6oGgplnRI3LlMs8XzfgTnona1tEzA1ujnEIpBv5nT6CH498HxfkZfIOvLu-tpCdzecqGlbYGXtY3RBl0WhQO01YBJzmfwjOcrTtgnRK6X29l" alt="<?= e(ps_text('प्रदीप सारंग ग्रामीण चौपाल में संवाद करते हुए', 'Pradeep Sarang interacting during village chaupal')) ?>" class="w-full h-52 object-cover">
          <div class="p-5 bg-cream-canvas border-t border-border-warm">
            <div class="flex items-center gap-2 text-deep-forest font-semibold text-body-sm mb-1">
              <span class="material-symbols-outlined text-[18px] text-primary-container">groups</span>
              <span><?= e(ps_text('गाँव की चौपाल में सीधा जन-संवाद', 'Grassroots Village Chaupal Dialogue')) ?></span>
            </div>
            <p class="font-body-sm text-body-sm text-text-muted">
              <?= e(ps_text('कमरावां व आसपास के 120+ ग्रामों में नियमित साप्ताहिक बैठकों के माध्यम से पर्यावरण एवं नशामुक्ति पर निरंतर कार्य।', 'Continuous environmental awareness across 120+ villages in Barabanki district.')) ?>
            </p>
          </div>
        </div>
      </div>

      <!-- Right Column: Accessible Structured Form -->
      <div class="lg:col-span-7 bg-pure-white rounded-2xl p-7 sm:p-9 border border-border-warm shadow-[0_8px_30px_rgb(0,0,0,0.04)]">
        <div class="mb-6">
          <span class="font-label-sm text-label-sm uppercase tracking-wider text-secondary font-bold"><?= e(ps_text('सीधा प्रपत्र • जन-संवाद', 'Direct Form • Dialogue')) ?></span>
          <h3 class="font-headline-sm text-headline-sm text-deep-forest font-bold mt-1"><?= e(ps_text('अपना संदेश अथवा आमंत्रण भेजें', 'Send Message or Invitation')) ?></h3>
          <p class="font-body-sm text-body-sm text-text-muted mt-1">
            <?= e(ps_text('कृपया नीचे दिए गए विवरण भरें। तारांकित (<span class="text-error font-bold">*</span>) फ़ील्ड अनिवार्य हैं।', 'Please fill in details below. Starred (<span class="text-error font-bold">*</span>) fields are required.')) ?>
          </p>
        </div>

        <form id="contact-inquiry-form" method="post" action="<?= e(base_url('/contact')) ?>" class="space-y-5">
          <?= csrf_field() ?>
          <input type="hidden" name="form_type" value="contact">

          <!-- Row 1: Name & Phone -->
          <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
            <div class="space-y-1.5">
              <label for="user-name" class="block font-label-md text-label-md text-deep-forest font-semibold">
                <?= e(ps_text('पूरा नाम (Full Name)', 'Full Name')) ?> <span class="text-error">*</span>
              </label>
              <input type="text" id="user-name" name="name" required class="w-full px-4 py-3 rounded-xl border border-border-warm bg-pure-white text-on-surface font-body-md text-body-md focus:border-primary-container focus:outline-none focus:ring-2 focus:ring-fresh-sprout/20 transition-all placeholder:text-text-muted">
            </div>
            <div class="space-y-1.5">
              <label for="user-phone" class="block font-label-md text-label-md text-deep-forest font-semibold">
                <?= e(ps_text('मोबाइल / WhatsApp नंबर', 'Mobile / WhatsApp Number')) ?> <span class="text-error">*</span>
              </label>
              <input type="tel" id="user-phone" name="phone" required class="w-full px-4 py-3 rounded-xl border border-border-warm bg-pure-white text-on-surface font-body-md text-body-md focus:border-primary-container focus:outline-none focus:ring-2 focus:ring-fresh-sprout/20 transition-all placeholder:text-text-muted">
            </div>
          </div>

          <!-- Row 2: Email & District -->
          <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
            <div class="space-y-1.5">
              <label for="user-email" class="block font-label-md text-label-md text-deep-forest font-semibold">
                <?= e(ps_text('ईमेल पता (Email Address)', 'Email Address')) ?> <span class="text-text-muted font-normal text-label-sm">(<?= e(ps_text('ऐच्छिक', 'Optional')) ?>)</span>
              </label>
              <input type="email" id="user-email" name="email" class="w-full px-4 py-3 rounded-xl border border-border-warm bg-pure-white text-on-surface font-body-md text-body-md focus:border-primary-container focus:outline-none focus:ring-2 focus:ring-fresh-sprout/20 transition-all placeholder:text-text-muted">
            </div>
            <div class="space-y-1.5">
              <label for="user-district" class="block font-label-md text-label-md text-deep-forest font-semibold">
                <?= e(ps_text('ज़िला एवं राज्य (District & State)', 'District & State')) ?>
              </label>
              <input type="text" id="user-district" name="districtState" value="<?= e(ps_text('बाराबंकी, उत्तर प्रदेश', 'Barabanki, Uttar Pradesh')) ?>" class="w-full px-4 py-3 rounded-xl border border-border-warm bg-pure-white text-on-surface font-body-md text-body-md focus:border-primary-container focus:outline-none focus:ring-2 focus:ring-fresh-sprout/20 transition-all placeholder:text-text-muted">
            </div>
          </div>

          <!-- Row 3: Village / Town & Category -->
          <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
            <div class="space-y-1.5">
              <label for="user-village" class="block font-label-md text-label-md text-deep-forest font-semibold">
                <?= e(ps_text('गाँव / कस्बा / मोहल्ला (Village/Town)', 'Village / Town / Locality')) ?>
              </label>
              <input type="text" id="user-village" name="villageTown" class="w-full px-4 py-3 rounded-xl border border-border-warm bg-pure-white text-on-surface font-body-md text-body-md focus:border-primary-container focus:outline-none focus:ring-2 focus:ring-fresh-sprout/20 transition-all placeholder:text-text-muted">
            </div>
            <div class="space-y-1.5">
              <label for="subject-category" class="block font-label-md text-label-md text-deep-forest font-semibold">
                <?= e(ps_text('संवाद का मुख्य विषय', 'Subject Category')) ?> <span class="text-error">*</span>
              </label>
              <select id="subject-category" name="subject" required class="w-full px-4 py-3 rounded-xl border border-border-warm bg-pure-white text-on-surface font-body-md text-body-md focus:border-primary-container focus:outline-none focus:ring-2 focus:ring-fresh-sprout/20 transition-all">
                <option value="" disabled selected><?= e(ps_text('विषय का चयन करें...', 'Select subject category...')) ?></option>
                <option value="सामान्य जनसेवा संवाद"><?= e(ps_text('सामान्य जनसेवा संवाद (General Dialogue)', 'General Public Service Dialogue')) ?></option>
                <option value="अपने गाँव में \'ग्रीन चौपाल\' आमंत्रण"><?= e(ps_text('अपने गाँव में \'ग्रीन चौपाल\' आमंत्रण', 'Invite Green Chaupal in Village')) ?></option>
                <option value="पौधारोपण व \'ग्रीन गैंग\' सहयोग"><?= e(ps_text('पौधारोपण व \'ग्रीन गैंग\' सहयोग', 'Plantation & Green Gang Support')) ?></option>
                <option value="परिंदा संरक्षण (सकोरा आवश्यकता)"><?= e(ps_text('परिंदा संरक्षण (सकोरा व दाना-पानी आवश्यकता)', 'Bird Conservation (Sakora Request)')) ?></option>
                <option value="अवधी साहित्य व काव्य गोष्ठी"><?= e(ps_text('अवधी साहित्य व काव्य गोष्ठी (Literature Desk)', 'Awadhi Literature & Poetry Meet')) ?></option>
                <option value="मीडिया व साक्षात्कार"><?= e(ps_text('मीडिया, प्रेस व शोध साक्षात्कार (Media Desk)', 'Media & Research Interview')) ?></option>
                <option value="जल-सकोरा व पक्षी संरक्षण"><?= e(ps_text('जल-सकोरा वितरण व परिंदा संरक्षण', 'Water Bowl & Bird Protection Drive')) ?></option>
                <option value="अन्य"><?= e(ps_text('अन्य विशिष्ट विषय (Other)', 'Other Specific Inquiry')) ?></option>
              </select>
            </div>
          </div>

          <!-- Row 4: Detailed Message -->
          <div class="space-y-1.5">
            <label for="user-message" class="block font-label-md text-label-md text-deep-forest font-semibold">
              <?= e(ps_text('विस्तृत संदेश या विचार (Detailed Message)', 'Detailed Message')) ?> <span class="text-error">*</span>
            </label>
            <textarea id="user-message" name="message" rows="4" required class="w-full px-4 py-3 rounded-xl border border-border-warm bg-pure-white text-on-surface font-body-md text-body-md focus:border-primary-container focus:outline-none focus:ring-2 focus:ring-fresh-sprout/20 transition-all placeholder:text-text-muted"></textarea>
          </div>

          <!-- Agreement Checkbox -->
          <div class="pt-1">
            <label class="flex items-start gap-3 cursor-pointer">
              <input type="checkbox" required class="mt-1 w-4 h-4 rounded border-border-warm text-primary-container focus:ring-fresh-sprout/30">
              <span class="font-body-sm text-body-sm text-on-surface-variant">
                <?= e(ps_text('मैं \'ग्रीन मॉर्निंग\' हरित अभिवादन का समर्थन करता हूँ तथा जनहित व रचनात्मक संवाद के लिए अपना विवरण साझा करने हेतु सहमत हूँ।', 'I support the \'Green Morning\' green greeting and agree to share my details for constructive dialogue.')) ?>
              </span>
            </label>
          </div>

          <!-- Action Submit Button -->
          <div class="pt-2">
            <button type="submit" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 bg-primary-container hover:bg-deep-forest text-on-primary font-label-md text-label-md px-8 py-3.5 rounded-xl transition-all shadow-[0_4px_12px_rgba(20,83,45,0.15)] hover:shadow-lg">
              <span class="material-symbols-outlined text-[20px]">send</span>
              <span><?= e(ps_text('संदेश प्रेषित करें (Send Message)', 'Send Message')) ?></span>
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>

<!-- Location & How to Reach Map / Village Guide Section -->
<section class="w-full py-space-3xl bg-soft-meadow border-t border-border-warm" id="reach-guide">
  <div class="max-w-container-max mx-auto px-4 sm:px-8">
    <div class="flex flex-col md:flex-row md:items-end justify-between mb-space-xl gap-4">
      <div>
        <span class="font-label-sm text-label-sm uppercase tracking-wider text-primary-container font-bold"><?= e(ps_text('भौगोलिक अवस्थिति', 'Geographic Location')) ?></span>
        <h2 class="font-headline-md text-headline-md text-deep-forest font-bold mt-1"><?= e(ps_text('पहुँचने का मार्ग व चौपाल केंद्र', 'Route & Chaupal Directions')) ?></h2>
      </div>
      <div class="flex items-center gap-2 font-label-sm text-label-sm text-text-muted">
        <span class="material-symbols-outlined text-[18px] text-secondary">explore</span>
        <span><?= e(ps_text('अयोध्या राष्ट्रीय राजमार्ग (NH-27) से सतरिख मार्ग', 'Via Ayodhya National Highway (NH-27) to Satrikh Route')) ?></span>
      </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-stretch">
      <!-- Map Container -->
      <div class="lg:col-span-7 bg-pure-white rounded-2xl overflow-hidden border border-border-warm shadow-sm flex flex-col">
        <div class="p-4 bg-cream-canvas border-b border-border-warm flex items-center justify-between">
          <div class="flex items-center gap-2 font-label-md text-label-md text-deep-forest font-semibold">
            <span class="material-symbols-outlined text-[20px] text-primary-container">pin_drop</span>
            <span><?= e(ps_text('ग्राम कमरावां, जिला बाराबंकी, उत्तर प्रदेश, भारत', 'Gram Kamrawan, District Barabanki, Uttar Pradesh, India')) ?></span>
          </div>
          <span class="bg-primary-fixed/40 text-deep-forest font-label-sm text-label-sm px-2.5 py-0.5 rounded-full font-medium"><?= e(ps_text('लाइव नेविगेशन', 'Live Navigation')) ?></span>
        </div>
        <!-- Map View -->
        <div class="w-full h-80 lg:h-96 bg-cover bg-center" data-location="Kamrawan, Satrikh, Barabanki, Uttar Pradesh 225122" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuAkmnhbYjF19f5e5ETjiJA4EZeYopRrCLmIcpXOWoEP5u2fIbh_HSkFL1_Dws-oDPtvMxWgs-65QLHIh_iqCRDcpzOTbxrAgHMKUB4xVUtSRSCcK6jZxUn-6vy3P1f_2aUKIjBAUxfsKLK-hUpjS9xTCnaocYbwreddQe3w-r-bh4mZttHYPMwi3Fwdb7ByXZgTlgpRm9-HuIP5pxjEg6RCd_M3g00uV-Qwv3O4Z8bM8En5IPnsF5K6')"></div>
        <div class="p-4 bg-pure-white flex flex-wrap items-center justify-between gap-3 text-body-sm">
          <div class="flex items-center gap-2 text-text-muted">
            <span class="material-symbols-outlined text-[16px] text-primary-container">navigation</span>
            <span><?= e(ps_text('पिनकोड: 225122 | अक्षांश-देशांतर: बाराबंकी ग्रामीण अंचल', 'Pincode: 225122 | Barabanki Rural Region')) ?></span>
          </div>
          <a href="https://maps.google.com/?q=Satrikh+Barabanki" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-1 font-label-sm text-label-sm text-primary-container hover:underline font-semibold">
            <span><?= e(ps_text('गूगल मैप्स में खोलें', 'Open in Google Maps')) ?></span>
            <span class="material-symbols-outlined text-[14px]">open_in_new</span>
          </a>
        </div>
      </div>

      <!-- Distance Cards -->
      <div class="lg:col-span-5 flex flex-col justify-between space-y-4">
        <!-- Distance 1: Lucknow -->
        <div class="bg-pure-white p-5 rounded-2xl border border-border-warm shadow-sm">
          <div class="flex items-center justify-between mb-2">
            <div class="flex items-center gap-2.5">
              <div class="w-9 h-9 rounded-xl bg-primary-container/10 flex items-center justify-center text-primary-container">
                <span class="material-symbols-outlined text-[20px]">directions_car</span>
              </div>
              <div class="font-title-md text-title-md text-deep-forest font-bold"><?= e(ps_text('राजधानी लखनऊ से', 'From Lucknow Capital')) ?></div>
            </div>
            <span class="font-headline-sm text-headline-sm text-primary-container font-bold">~32 km</span>
          </div>
          <p class="font-body-sm text-body-sm text-on-surface-variant">
            <?= e(ps_text('लखनऊ चारबाग अथवा कमता (चिनहट) से अयोध्या राष्ट्रीय राजमार्ग पकड़ें। बाराबंकी सीमा में प्रवेश कर सतरिख मार्ग मुड़ें।', 'Take Ayodhya National Highway from Charbagh or Kamta (Chinhat), enter Barabanki and take Satrikh exit.')) ?>
          </p>
        </div>

        <!-- Distance 2: Barabanki Station -->
        <div class="bg-pure-white p-5 rounded-2xl border border-border-warm shadow-sm">
          <div class="flex items-center justify-between mb-2">
            <div class="flex items-center gap-2.5">
              <div class="w-9 h-9 rounded-xl bg-secondary/10 flex items-center justify-center text-secondary">
                <span class="material-symbols-outlined text-[20px]">train</span>
              </div>
              <div class="font-title-md text-title-md text-deep-forest font-bold"><?= e(ps_text('बाराबंकी रेलवे जंक्शन से', 'From Barabanki Jn.')) ?></div>
            </div>
            <span class="font-headline-sm text-headline-sm text-secondary font-bold">~12 km</span>
          </div>
          <p class="font-body-sm text-body-sm text-on-surface-variant">
            <?= e(ps_text('स्टेशन अथवा बस डिपो से छाया चौराहा होते हुए सतरिख तिराहे के लिए नियमित स्थानीय वाहन व ई-रिक्शा उपलब्ध हैं।', 'Regular local transport and e-rickshaws available from Railway Station/Bus Stand to Satrikh intersection.')) ?>
          </p>
        </div>

        <!-- Visiting Hours Advice -->
        <div class="bg-pure-white p-5 rounded-2xl border border-border-warm shadow-sm">
          <div class="flex items-center gap-2.5 mb-2">
            <div class="w-9 h-9 rounded-xl bg-tertiary-fixed/40 flex items-center justify-center text-tertiary">
              <span class="material-symbols-outlined text-[20px]">schedule</span>
            </div>
            <div class="font-title-md text-title-md text-deep-forest font-bold"><?= e(ps_text('मिलने का श्रेष्ठ समय', 'Best Time to Visit')) ?></div>
          </div>
          <p class="font-body-sm text-body-sm text-on-surface-variant leading-relaxed">
            <?= e(ps_text('सारंग जी अक्सर ग्रामीण पौधारोपण दौरों व चौपालों पर रहते हैं। कृपया आगमन से कम से कम <strong>24 घंटे पूर्व दूरभाष पर समय अवश्य सुनिश्चित कर लें</strong> ताकि आपकी भेंट सुगमता से हो सके।', 'Shri Sarang is frequently on field visits for Green Chaupals. Please confirm an appointment 24 hours prior via phone.')) ?>
          </p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Frequently Asked Questions (Accordion) -->
<section class="w-full py-space-3xl bg-cream-canvas">
  <div class="max-w-container-editorial mx-auto px-4 sm:px-8">
    <div class="text-center mb-space-xl">
      <span class="font-label-sm text-label-sm uppercase tracking-wider text-primary-container font-bold"><?= e(ps_text('अक्सर पूछे जाने वाले प्रश्न', 'Frequently Asked Questions')) ?></span>
      <h2 class="font-headline-md text-headline-md text-deep-forest font-bold mt-1"><?= e(ps_text('संवाद व सहयोग संबंधी जिज्ञासाएँ', 'Dialogue & Inquiry Details')) ?></h2>
      <p class="font-body-sm text-body-sm text-text-muted mt-1">
        <?= e(ps_text('किसी भी संशय के समाधान हेतु सामान्य प्रश्नों के उत्तर नीचे दिए गए हैं।', 'Common questions and answers regarding contact & participation.')) ?>
      </p>
    </div>
    <div class="space-y-3.5" id="faq-accordion">
      <!-- FAQ 1 -->
      <div class="bg-pure-white rounded-2xl border border-border-warm overflow-hidden shadow-sm">
        <button type="button" onclick="toggleFaq('faq-1')" class="w-full p-5 text-left flex items-center justify-between gap-4 hover:bg-soft-meadow transition-colors">
          <span class="font-title-md text-title-md text-deep-forest font-bold flex items-center gap-3">
            <span class="w-2 h-2 rounded-full bg-primary-container shrink-0"></span>
            <?= e(ps_text('क्या सारंग जी से मिलने के लिए पूर्व अनुमति या समय लेना आवश्यक है?', 'Is an advance appointment required to meet Shri Sarang?')) ?>
          </span>
          <span id="icon-faq-1" class="material-symbols-outlined text-[22px] text-text-muted transition-transform">expand_more</span>
        </button>
        <div id="faq-1" class="hidden px-5 pb-5 pt-1 text-on-surface-variant font-body-md text-body-md border-t border-border-warm bg-soft-meadow/50 leading-relaxed">
          <?= e(ps_text('हाँ, सारंग जी ज़मीनी समाजसेवक हैं और निरंतर गाँवों में \'ग्रीन चौपाल\' तथा सकोरा वितरण यात्राओं में रहते हैं। असुविधा से बचने के लिए दूरभाष (+91 9919007190) अथवा WhatsApp पर समय निर्धारित कर आना सर्वथा उचित है।', 'Yes, Shri Sarang is actively in the field for village chaupals. Prior appointment via phone (+91 9919007190) or WhatsApp is highly recommended.')) ?>
        </div>
      </div>
      <!-- FAQ 2 -->
      <div class="bg-pure-white rounded-2xl border border-border-warm overflow-hidden shadow-sm">
        <button type="button" onclick="toggleFaq('faq-2')" class="w-full p-5 text-left flex items-center justify-between gap-4 hover:bg-soft-meadow transition-colors">
          <span class="font-title-md text-title-md text-deep-forest font-bold flex items-center gap-3">
            <span class="w-2 h-2 rounded-full bg-primary-container shrink-0"></span>
            <?= e(ps_text('अपने गाँव या विद्यालय में \'ग्रीन चौपाल\' अथवा पौधारोपण कैसे आयोजित करवाएं?', 'How to organize a Green Chaupal or tree drive in our village/school?')) ?>
          </span>
          <span id="icon-faq-2" class="material-symbols-outlined text-[22px] text-text-muted transition-transform">expand_more</span>
        </button>
        <div id="faq-2" class="hidden px-5 pb-5 pt-1 text-on-surface-variant font-body-md text-body-md border-t border-border-warm bg-soft-meadow/50 leading-relaxed">
          <?= e(ps_text('आप इस पृष्ठ पर दिए गए फॉर्म में विषय श्रेणी \'अपने गाँव में ग्रीन चौपाल आमंत्रण\' चुनकर विवरण भेजें या सीधे हेल्पलाइन पर कॉल करें। स्थानीय ग्रीन गैंग समन्वयक 48 घंटे में संपर्क कर तिथि व पौधों की व्यवस्था सुनिश्चित करेंगे।', 'Select \'Invite Green Chaupal\' in the form or call our helpline. Our local coordinators will respond within 48 hours.')) ?>
        </div>
      </div>
      <!-- FAQ 3 -->
      <div class="bg-pure-white rounded-2xl border border-border-warm overflow-hidden shadow-sm">
        <button type="button" onclick="toggleFaq('faq-3')" class="w-full p-5 text-left flex items-center justify-between gap-4 hover:bg-soft-meadow transition-colors">
          <span class="font-title-md text-title-md text-deep-forest font-bold flex items-center gap-3">
            <span class="w-2 h-2 rounded-full bg-primary-container shrink-0"></span>
            <?= e(ps_text('क्या परिंदा संरक्षण के लिए सकोरे (मिट्टी के पात्र) निःशुल्क उपलब्ध होते हैं?', 'Are Sakoras (earthen water bowls) available for free?')) ?>
          </span>
          <span id="icon-faq-3" class="material-symbols-outlined text-[22px] text-text-muted transition-transform">expand_more</span>
        </button>
        <div id="faq-3" class="hidden px-5 pb-5 pt-1 text-on-surface-variant font-body-md text-body-md border-t border-border-warm bg-soft-meadow/50 leading-relaxed">
          <?= e(ps_text('जी हाँ! ग्रीष्म ऋतु में पक्षियों के लिए सकोरा वितरण पूर्णतः निःशुल्क जनसेवा के रूप में किया जाता है। विद्यालय, सामाजिक संस्थाएं या ग्रामीण युवा अपने क्षेत्र के लिए सकोरे प्राप्त करने हेतु संपर्क कर सकते हैं।', 'Yes! Earthen bird water feeders are distributed 100% free of charge during summer for bird conservation.')) ?>
        </div>
      </div>
      <!-- FAQ 4 -->
      <div class="bg-pure-white rounded-2xl border border-border-warm overflow-hidden shadow-sm">
        <button type="button" onclick="toggleFaq('faq-4')" class="w-full p-5 text-left flex items-center justify-between gap-4 hover:bg-soft-meadow transition-colors">
          <span class="font-title-md text-title-md text-deep-forest font-bold flex items-center gap-3">
            <span class="w-2 h-2 rounded-full bg-primary-container shrink-0"></span>
            <?= e(ps_text('क्या कोई भी व्यक्ति या संस्था उनसे सामाजिक परामर्श ले सकती है?', 'Can any individual or institution consult on social initiatives?')) ?>
          </span>
          <span id="icon-faq-4" class="material-symbols-outlined text-[22px] text-text-muted transition-transform">expand_more</span>
        </button>
        <div id="faq-4" class="hidden px-5 pb-5 pt-1 text-on-surface-variant font-body-md text-body-md border-t border-border-warm bg-soft-meadow/50 leading-relaxed">
          <?= e(ps_text('अवश्य। ग्रामीण विकास, वृक्ष संरक्षण, नशामुक्ति, अवधी लोकसंस्कृति और युवा चेतना पर उनका मार्गदर्शन सभी के लिए सुलभ और निःस्वार्थ है।', 'Absolutely! Guidance on rural development, tree conservation, addiction-free movement & Awadhi culture is open to all.')) ?>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Cross Navigation / Related Action Banners -->
<section class="w-full py-space-2xl bg-deep-forest text-on-primary">
  <div class="max-w-container-max mx-auto px-4 sm:px-8">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 items-center">
      <!-- Action 1 -->
      <a href="<?= e(base_url('/volunteer')) ?>" data-path="green-gang" class="group bg-surface-container-low/10 hover:bg-surface-container-low/15 p-6 rounded-2xl border border-surface-container-high/20 transition-all flex items-start gap-4">
        <div class="w-12 h-12 rounded-xl bg-primary-container text-on-primary flex items-center justify-center shrink-0 group-hover:scale-105 transition-transform">
          <span class="material-symbols-outlined text-[24px]">diversity_3</span>
        </div>
        <div>
          <div class="font-title-md text-title-md text-pure-white font-bold group-hover:text-tertiary-fixed transition-colors">
            <?= e(ps_text('स्वयंसेवक बनें (Join Green Gang)', 'Become a Volunteer')) ?>
          </div>
          <p class="font-body-sm text-body-sm text-surface-container-high mt-1">
            <?= e(ps_text('गाँव-गाँव हरियाली और पक्षी रक्षा के लिए हमारी युवा ब्रिगेड का हिस्सा बनें।', 'Join our youth brigade for village tree planting and bird protection.')) ?>
          </p>
        </div>
      </a>
      <!-- Action 2 -->
      <a href="<?= e(base_url('/events')) ?>" data-path="events" class="group bg-surface-container-low/10 hover:bg-surface-container-low/15 p-6 rounded-2xl border border-surface-container-high/20 transition-all flex items-start gap-4">
        <div class="w-12 h-12 rounded-xl bg-secondary text-on-secondary flex items-center justify-center shrink-0 group-hover:scale-105 transition-transform">
          <span class="material-symbols-outlined text-[24px]">event_note</span>
        </div>
        <div>
          <div class="font-title-md text-title-md text-pure-white font-bold group-hover:text-tertiary-fixed transition-colors">
            <?= e(ps_text('आगामी चौपाल व कार्यक्रम', 'Upcoming Events & Chaupals')) ?>
          </div>
          <p class="font-body-sm text-body-sm text-surface-container-high mt-1">
            <?= e(ps_text('बाराबंकी व अवध क्षेत्र में होने वाली आगामी बैठकों व सम्मेलनों की तिथियां देखें।', 'Explore upcoming meeting dates across Barabanki & Awadh.')) ?>
          </p>
        </div>
      </a>
      <!-- Action 3 -->
      <a href="<?= e(base_url('/media')) ?>" data-path="media" class="group bg-surface-container-low/10 hover:bg-surface-container-low/15 p-6 rounded-2xl border border-surface-container-high/20 transition-all flex items-start gap-4">
        <div class="w-12 h-12 rounded-xl bg-tertiary text-on-tertiary flex items-center justify-center shrink-0 group-hover:scale-105 transition-transform">
          <span class="material-symbols-outlined text-[24px]">auto_stories</span>
        </div>
        <div>
          <div class="font-title-md text-title-md text-pure-white font-bold group-hover:text-tertiary-fixed transition-colors">
            <?= e(ps_text('अखबार कतरनें व मीडिया', 'Press Clippings & Media')) ?>
          </div>
          <p class="font-body-sm text-body-sm text-surface-container-high mt-1">
            <?= e(ps_text('राष्ट्रीय व प्रादेशिक समाचार पत्रों में प्रकाशित पर्यावरण व सामाजिक रिपोर्ट।', 'Read news clippings published in national and regional newspapers.')) ?>
          </p>
        </div>
      </a>
    </div>
  </div>
</section>
</div>

<script>
  function toggleFaq(id) {
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

  function selectSubject(categoryText) {
    const select = document.getElementById('subject-category');
    if (select) {
      for (let i = 0; i < select.options.length; i++) {
        if (select.options[i].text.includes(categoryText) || select.options[i].value.includes(categoryText)) {
          select.selectedIndex = i;
          break;
        }
      }
      const formSection = document.getElementById('dialogue-form');
      if (formSection) {
        formSection.scrollIntoView({ behavior: 'smooth' });
      }
    }
  }
</script>
