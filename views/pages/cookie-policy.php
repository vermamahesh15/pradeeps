<?php
declare(strict_types=1);

$phone = !empty($contact['phone']) ? $contact['phone'] : '+91 9919007190';
$email = !empty($contact['email']) ? $contact['email'] : 'contact@pradeepsarang.in';
$privacyEmail = 'privacy@pradeepsarang.in';
$siteName = ps_text('प्रदीप सारंग', 'Pradeep Sarang');
$siteUrl = base_url('/');
$lastUpdated = '06 सितंबर 2026';
?>

<div class="flex flex-col w-full bg-surface-container-lowest text-on-surface">
  <!-- Top Editorial Header & Glow Banner -->
  <div class="relative w-full bg-soft-meadow overflow-hidden py-space-2xl md:py-space-3xl border-b border-border-warm">
    <div class="absolute -top-32 -left-20 w-96 h-96 bg-primary-fixed/30 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute top-10 right-0 w-80 h-80 bg-secondary-fixed/20 rounded-full blur-3xl pointer-events-none"></div>

    <div class="max-w-container-max mx-auto px-4 sm:px-8 relative z-10">
      <!-- Breadcrumb -->
      <nav class="flex items-center gap-2 font-label-md text-label-md text-text-muted mb-space-sm" aria-label="Breadcrumb">
        <a class="hover:text-primary transition-colors flex items-center gap-1" href="<?= e(base_url('/')) ?>">
          <span class="material-symbols-outlined text-[16px]">home</span>
          <span><?= e(ps_text('मुख्य पृष्ठ', 'Home')) ?></span>
        </a>
        <span class="opacity-40">/</span>
        <span class="text-deep-forest font-semibold"><?= e(ps_text('कुकी नीति', 'Cookie Policy')) ?></span>
      </nav>

      <div class="flex flex-col space-y-3 max-w-4xl">
        <div class="inline-flex items-center gap-2 self-start bg-primary-fixed/40 text-deep-forest px-3.5 py-1 rounded-full font-label-sm text-label-sm border border-border-warm font-semibold">
          <span class="material-symbols-outlined text-[16px] text-primary-container">cookie</span>
          <span><?= e(ps_text('पारदर्शिता एवं गोपनीयता', 'Transparency & Privacy')) ?></span>
        </div>
        <h1 class="font-display-hero text-headline-lg md:text-display-hero text-deep-forest font-bold tracking-tight">
          <?= e(ps_text('कुकी नीति (Cookie Policy)', 'Cookie Policy')) ?>
        </h1>
        <p class="font-body-lg text-body-lg text-text-muted leading-relaxed">
          <?= e(ps_text('यह कुकी नीति स्पष्ट करती है कि वेबसाइट (' . $siteUrl . ') पर कुकीज़, गूगल एडसेंस (AdSense), एनालिटिक्स एवं संबंधित तकनीकों का उपयोग किस प्रकार किया जाता है।', 'This Cookie Policy explains how ' . $siteName . ' (' . $siteUrl . ') uses cookies, Google AdSense, analytics and similar technologies.')) ?>
        </p>
        <div class="pt-2 text-label-md text-label-md text-text-muted flex items-center gap-2">
          <span class="material-symbols-outlined text-[18px] text-tertiary-fixed">event_available</span>
          <span><?= e(ps_text('अंतिम अद्यतन: ' . $lastUpdated, 'Last Updated: ' . $lastUpdated)) ?></span>
        </div>
      </div>
    </div>
  </div>

  <!-- Content Container -->
  <section class="max-w-container-max mx-auto px-4 sm:px-8 py-space-3xl">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
      
      <!-- Sticky Quick Navigation Sidebar -->
      <aside class="lg:col-span-4 hidden lg:block">
        <div class="sticky top-28 bg-pure-white p-6 rounded-2xl border border-border-warm shadow-xs space-y-3">
          <h3 class="font-title-md text-title-md text-deep-forest font-bold pb-2 border-b border-border-warm flex items-center gap-2">
            <span class="material-symbols-outlined text-primary-container text-[20px]">list_alt</span>
            <span><?= e(ps_text('विषय सूची', 'Table of Contents')) ?></span>
          </h3>
          <nav class="flex flex-col space-y-2 font-body-sm text-body-sm text-text-muted">
            <a href="#what-are-cookies" class="hover:text-primary transition-colors py-1 flex items-center gap-2"><span>1.</span> <span>कुकीज़ क्या हैं?</span></a>
            <a href="#types-of-cookies" class="hover:text-primary transition-colors py-1 flex items-center gap-2"><span>2.</span> <span>कुकीज़ के प्रकार</span></a>
            <a href="#adsense" class="hover:text-primary transition-colors py-1 flex items-center gap-2"><span>3.</span> <span>गूगल एडसेंस व विज्ञापन</span></a>
            <a href="#analytics" class="hover:text-primary transition-colors py-1 flex items-center gap-2"><span>4.</span> <span>गूगल एनालिटिक्स</span></a>
            <a href="#third-party" class="hover:text-primary transition-colors py-1 flex items-center gap-2"><span>5.</span> <span>तृतीय-पक्ष कुकीज़</span></a>
            <a href="#consent" class="hover:text-primary transition-colors py-1 flex items-center gap-2"><span>6.</span> <span>सहमति प्रबंधन (CMP)</span></a>
            <a href="#browser-management" class="hover:text-primary transition-colors py-1 flex items-center gap-2"><span>7.</span> <span>ब्राउज़र से कुकीज़ प्रबंधन</span></a>
            <a href="#changes" class="hover:text-primary transition-colors py-1 flex items-center gap-2"><span>8.</span> <span>नीति में बदलाव</span></a>
            <a href="#contact" class="hover:text-primary transition-colors py-1 flex items-center gap-2"><span>9.</span> <span>संपर्क सूत्र</span></a>
          </nav>
        </div>
      </aside>

      <!-- Main Policy Body -->
      <main class="lg:col-span-8 flex flex-col space-y-10 font-body-md text-body-md text-on-surface leading-relaxed">
        
        <!-- Intro Note Box -->
        <div class="bg-soft-meadow border border-border-warm p-6 rounded-2xl flex items-start gap-4">
          <span class="material-symbols-outlined text-primary-container text-[28px] shrink-0">privacy_tip</span>
          <p class="font-body-md text-deep-forest">
            <?= e(ps_text('इस कुकी नीति को हमारी गोपनीयता नीति (Privacy Policy) के साथ पढ़ा जाना चाहिए। वेबसाइट का उपयोग करने पर आप इस नीति में वर्णित कुकी तकनीकों के उपयोग से सहमत होते हैं।', 'This Cookie Policy should be read together with our Privacy Policy. By using this website, you consent to the use of cookies described herein.')) ?>
          </p>
        </div>

        <!-- Section 1 -->
        <article id="what-are-cookies" class="space-y-4 pt-2 border-b border-border-warm/60 pb-8">
          <h2 class="font-headline-md text-headline-md text-deep-forest font-bold flex items-center gap-2.5">
            <span class="w-8 h-8 rounded-lg bg-primary-fixed/50 text-deep-forest font-mono text-sm flex items-center justify-center font-bold">1</span>
            <span><?= e(ps_text('कुकीज़ क्या हैं? (What Are Cookies?)', 'What Are Cookies?')) ?></span>
          </h2>
          <p>
            <?= e(ps_text('कुकीज़ छोटी टेक्स्ट फाइलें होती हैं जिन्हें वेबसाइटें उपयोगकर्ता के कंप्यूटर, मोबाइल, टैब या ब्राउज़र पर स्टोर करती हैं। कुकीज़ के माध्यम से वेबसाइटें आपके प्राथमिकताओं को याद रखती हैं और आपको एक सहज अनुभव प्रदान करती हैं।', 'Cookies are small text files that websites store on a user\'s computer, mobile device, tablet, or browser to remember preferences and enhance user experience.')) ?>
          </p>
          <p class="font-semibold text-deep-forest"><?= e(ps_text('कुकीज़ वेबसाइट की सहायता करती हैं:', 'Cookies help websites to:')) ?></p>
          <ul class="list-disc pl-6 space-y-2 text-text-muted">
            <li><?= e(ps_text('उपयोगकर्ता की प्राथमिकताओं (भाषा, फ़ॉन्ट आकार आदि) को याद रखना', 'Remember user preferences (language, text size, etc.)')) ?></li>
            <li><?= e(ps_text('लॉगिन सत्र और खाता सुरक्षा को बनाए रखना', 'Maintain secure login sessions and account safety')) ?></li>
            <li><?= e(ps_text('वेबसाइट की सुरक्षा और धोखाधड़ी से बचाव सुनिश्चित करना', 'Enhance overall website security and prevent fraud')) ?></li>
            <li><?= e(ps_text('आगंतुकों के व्यवहार और उपयोग पैटर्न को समझना', 'Understand visitor behaviour and traffic movement')) ?></li>
            <li><?= e(ps_text('वेबसाइट के प्रदर्शन और लोडिंग गति को मापना', 'Measure overall performance and load speeds')) ?></li>
            <li><?= e(ps_text('विज्ञापन प्रदर्शित करना और उनकी प्रभावशीलता मापना', 'Display and measure advertisement performance')) ?></li>
          </ul>
        </article>

        <!-- Section 2 -->
        <article id="types-of-cookies" class="space-y-4 border-b border-border-warm/60 pb-8">
          <h2 class="font-headline-md text-headline-md text-deep-forest font-bold flex items-center gap-2.5">
            <span class="w-8 h-8 rounded-lg bg-primary-fixed/50 text-deep-forest font-mono text-sm flex items-center justify-center font-bold">2</span>
            <span><?= e(ps_text('हमारे द्वारा उपयोग की जाने वाली कुकीज़ के प्रकार (Types of Cookies We Use)', 'Types of Cookies We Use')) ?></span>
          </h2>
          
          <div class="space-y-6">
            <div class="bg-pure-white p-5 rounded-xl border border-border-warm">
              <h3 class="font-title-md text-title-md text-deep-forest font-bold mb-2 flex items-center gap-2">
                <span class="material-symbols-outlined text-primary-container text-[20px]">lock</span>
                <span><?= e(ps_text('1. अत्यंत आवश्यक कुकीज़ (Strictly Necessary Cookies)', '1. Strictly Necessary Cookies')) ?></span>
              </h3>
              <p class="text-text-muted">
                <?= e(ps_text('ये कुकीज़ वेबसाइट के मुख्य कार्यों (जैसे लॉगिन, प्रमाणीकरण, लेखक डैशबोर्ड, फ़ॉर्म सबमिशन, सुरक्षा जाँच) के लिए अनिवार्य हैं। इन्हें अक्षम करने पर वेबसाइट के कुछ हिस्से कार्य नहीं करेंगे।', 'These cookies are required for essential website functions such as login, author dashboard, form submissions, and fraud prevention.')) ?>
              </p>
            </div>

            <div class="bg-pure-white p-5 rounded-xl border border-border-warm">
              <h3 class="font-title-md text-title-md text-deep-forest font-bold mb-2 flex items-center gap-2">
                <span class="material-symbols-outlined text-primary-container text-[20px]">tune</span>
                <span><?= e(ps_text('2. वरीयता कुकीज़ (Preference Cookies)', '2. Preference Cookies')) ?></span>
              </h3>
              <p class="text-text-muted">
                <?= e(ps_text('ये कुकीज़ आपकी चुनी हुई भाषा (हिंदी/अंग्रेजी), थीम या प्रदर्शन प्राथमिकताओं को याद रखती हैं।', 'These cookies remember options such as language (Hindi/English), display theme, and reading preferences.')) ?>
              </p>
            </div>

            <div class="bg-pure-white p-5 rounded-xl border border-border-warm">
              <h3 class="font-title-md text-title-md text-deep-forest font-bold mb-2 flex items-center gap-2">
                <span class="material-symbols-outlined text-primary-container text-[20px]">analytics</span>
                <span><?= e(ps_text('3. विश्लेषण कुकीज़ (Analytics Cookies)', '3. Analytics Cookies')) ?></span>
              </h3>
              <p class="text-text-muted">
                <?= e(ps_text('हम Google Analytics का उपयोग वेबसाइट पर आने वाले पाठकों की संख्या, सबसे लोकप्रिय आलेखों और ट्रैफ़िक स्रोतों को समझने के लिए करते हैं।', 'We use analytics tools to measure visitor counts, top articles, session durations, and traffic sources.')) ?>
              </p>
            </div>

            <div class="bg-pure-white p-5 rounded-xl border border-border-warm">
              <h3 class="font-title-md text-title-md text-deep-forest font-bold mb-2 flex items-center gap-2">
                <span class="material-symbols-outlined text-primary-container text-[20px]">ads_click</span>
                <span><?= e(ps_text('4. विज्ञापन कुकीज़ (Advertising Cookies)', '4. Advertising Cookies')) ?></span>
              </h3>
              <p class="text-text-muted">
                <?= e(ps_text('गूगल एडसेंस और तृतीय-पक्ष विज्ञापन भागीदार कुकीज़ के माध्यम से विज्ञापनों की प्रासंगिकता और प्रदर्शन का आकलन करते हैं।', 'Google AdSense and partners use advertising cookies to serve relevant ads and detect invalid traffic.')) ?>
              </p>
            </div>
          </div>
        </article>

        <!-- Section 3: AdSense & Policies -->
        <article id="adsense" class="space-y-4 border-b border-border-warm/60 pb-8">
          <h2 class="font-headline-md text-headline-md text-deep-forest font-bold flex items-center gap-2.5">
            <span class="w-8 h-8 rounded-lg bg-primary-fixed/50 text-deep-forest font-mono text-sm flex items-center justify-center font-bold">3</span>
            <span><?= e(ps_text('गूगल एडसेंस एवं विज्ञापन नीति (Google AdSense & Advertising)', 'Google AdSense & Advertising')) ?></span>
          </h2>
          <p>
            <?= e(ps_text('हमारी वेबसाइट गूगल एडसेंस (Google AdSense) और गूगल एड मैनेजर (Google Ad Manager) नेटवर्क का उपयोग कर सकती है। गूगल उपयोगकर्ताओं की पिछली विज़िट के आधार पर प्रासंगिक विज्ञापन प्रदर्शित करने के लिए कुकीज़ का उपयोग करता है।', 'We may use Google AdSense or Google Ad Manager. Google uses cookies to serve ads based on user visits to this or other websites.')) ?>
          </p>
          <div class="p-5 rounded-xl bg-soft-meadow border border-border-warm space-y-2">
            <h4 class="font-title-md text-title-md text-deep-forest font-bold flex items-center gap-2">
              <span class="material-symbols-outlined text-primary-container text-[20px]">policy</span>
              <span><?= e(ps_text('गूगल प्रकाशक नीतियों का अनुपालन (Google Publisher Policies)', 'Google Publisher Policy Standard')) ?></span>
            </h4>
            <p class="text-body-sm text-text-muted">
              <?= e(ps_text('गूगल की नीतियों के अनुसार, हम आलेख पृष्ठों पर अत्यधिक विज्ञापन नहीं लगाते हैं। सम्पादकीय सामग्री सदैव प्राथमिक बनी रहती है। उपयोगकर्ता अपनी विज्ञापन प्राथमिकताओं को गूगल के विज्ञापन सेटिंग टूल द्वारा नियंत्रित कर सकते हैं।', 'In accordance with Google Publisher Policies, editorial content remains the primary focus. Users can manage ad settings via Google Ads Settings.')) ?>
            </p>
          </div>
        </article>

        <!-- Section 4: Analytics -->
        <article id="analytics" class="space-y-4 border-b border-border-warm/60 pb-8">
          <h2 class="font-headline-md text-headline-md text-deep-forest font-bold flex items-center gap-2.5">
            <span class="w-8 h-8 rounded-lg bg-primary-fixed/50 text-deep-forest font-mono text-sm flex items-center justify-center font-bold">4</span>
            <span><?= e(ps_text('गूगल एनालिटिक्स (Google Analytics)', 'Google Analytics')) ?></span>
          </h2>
          <p>
            <?= e(ps_text('हम पाठकों की रुचि और वेबसाइट की लोडिंग क्षमता का विश्लेषण करने के लिए गूगल एनालिटिक्स का उपयोग करते हैं। एनालिटिक्स डेटा में IP पता, डिवाइस का प्रकार, ब्राउज़र का प्रकार, विज़िट किए गए पृष्ठ और सत्र की अवधि शामिल हो सकती है।', 'Google Analytics helps us analyze visitor engagement, device types, pages viewed, and session durations.')) ?>
          </p>
        </article>

        <!-- Section 5: Third Party Cookies -->
        <article id="third-party" class="space-y-4 border-b border-border-warm/60 pb-8">
          <h2 class="font-headline-md text-headline-md text-deep-forest font-bold flex items-center gap-2.5">
            <span class="w-8 h-8 rounded-lg bg-primary-fixed/50 text-deep-forest font-mono text-sm flex items-center justify-center font-bold">5</span>
            <span><?= e(ps_text('तृतीय-पक्ष कुकीज़ (Third-Party Cookies)', 'Third-Party Cookies')) ?></span>
          </h2>
          <p>
            <?= e(ps_text('हमारी वेबसाइट पर एम्बेडेड सामग्री (जैसे यूट्यूब वीडियो, सोशल मीडिया शेयर बटन, फ़ॉन्ट सर्वर या सुरक्षा उपकरण) अपनी स्वतंत्र कुकीज़ सेट कर सकते हैं। इन पर हमारा सीधा नियंत्रण नहीं होता है।', 'Embedded tools (YouTube videos, social buttons, font servers, or security services) may place independent third-party cookies.')) ?>
          </p>
        </article>

        <!-- Section 6: Consent Management -->
        <article id="consent" class="space-y-4 border-b border-border-warm/60 pb-8">
          <h2 class="font-headline-md text-headline-md text-deep-forest font-bold flex items-center gap-2.5">
            <span class="w-8 h-8 rounded-lg bg-primary-fixed/50 text-deep-forest font-mono text-sm flex items-center justify-center font-bold">6</span>
            <span><?= e(ps_text('सहमति प्रबंधन (Consent Management Platform - CMP)', 'Consent Management Platform')) ?></span>
          </h2>
          <p>
            <?= e(ps_text('जहाँ कानूनी रूप से आवश्यक हो (जैसे EEA/UK/Swiss या गूगल की प्रमाणित CMP आवश्यकताएं), आगंतुकों को कुकी सहमति बैनर प्रस्तुत किया जाता है जिसके माध्यम से वे कुकीज़ स्वीकार, अस्वीकार या अनुकूलित कर सकते हैं।', 'Where required by applicable law or Google CMP certification requirements, visitors can accept, reject, or customize cookie preferences via our consent interface.')) ?>
          </p>
        </article>

        <!-- Section 7: Browser Management -->
        <article id="browser-management" class="space-y-4 border-b border-border-warm/60 pb-8">
          <h2 class="font-headline-md text-headline-md text-deep-forest font-bold flex items-center gap-2.5">
            <span class="w-8 h-8 rounded-lg bg-primary-fixed/50 text-deep-forest font-mono text-sm flex items-center justify-center font-bold">7</span>
            <span><?= e(ps_text('अपने ब्राउज़र से कुकीज़ नियंत्रित करना (Managing Cookies Through Browser)', 'Managing Cookies Through Browser')) ?></span>
          </h2>
          <p>
            <?= e(ps_text('अधिकांश ब्राउज़र आपको स्टोर की गई कुकीज़ देखने, हटाने या ब्लॉक करने का विकल्प देते हैं। ध्यान दें कि कुकीज़ ब्लॉक करने से वेबसाइट की कुछ सुविधाएँ प्रभावित हो सकती हैं।', 'Most web browsers allow users to view, delete, or block cookies. Disabling cookies may affect website functionality.')) ?>
          </p>
        </article>

        <!-- Section 8: Changes -->
        <article id="changes" class="space-y-4 border-b border-border-warm/60 pb-8">
          <h2 class="font-headline-md text-headline-md text-deep-forest font-bold flex items-center gap-2.5">
            <span class="w-8 h-8 rounded-lg bg-primary-fixed/50 text-deep-forest font-mono text-sm flex items-center justify-center font-bold">8</span>
            <span><?= e(ps_text('नीति में संशोधन (Changes to This Cookie Policy)', 'Changes to This Cookie Policy')) ?></span>
          </h2>
          <p>
            <?= e(ps_text('हम अपनी सेवाओं, तकनीक या कानूनी आवश्यकताओं के अनुसार समय-समय पर इस कुकी नीति को अपडेट कर सकते हैं। नई तिथि इस पृष्ठ पर प्रदर्शित की जाएगी।', 'We may update this policy periodically to reflect technology updates, legal requirements, or new features.')) ?>
          </p>
        </article>

        <!-- Section 9: Contact -->
        <article id="contact" class="space-y-4 bg-pure-white p-7 rounded-2xl border border-border-warm shadow-sm">
          <h2 class="font-headline-md text-headline-md text-deep-forest font-bold flex items-center gap-2">
            <span class="material-symbols-outlined text-primary-container text-[24px]">mail</span>
            <span><?= e(ps_text('संपर्क सूत्र (Contact Us)', 'Contact Us')) ?></span>
          </h2>
          <p><?= e(ps_text('यदि आपके पास हमारी कुकी नीति के संबंध में कोई प्रश्न या जिज्ञासा है, तो कृपया हमसे संपर्क करें:', 'If you have any questions about our Cookie Policy, please contact us:')) ?></p>
          <div class="space-y-2 font-body-md text-deep-forest pt-2">
            <div><strong>वेबसाइट:</strong> <?= e($siteName) ?> (<?= e($siteUrl) ?>)</div>
            <div><strong>गोपनीयता ईमेल:</strong> <a href="mailto:<?= e($privacyEmail) ?>" class="text-primary hover:underline"><?= e($privacyEmail) ?></a></div>
            <div><strong>सामान्य संपर्क:</strong> <a href="mailto:<?= e($email) ?>" class="text-primary hover:underline"><?= e($email) ?></a></div>
          </div>
        </article>

      </main>

    </div>
  </section>
</div>
