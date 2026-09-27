<?php
declare(strict_types=1);

$phone = !empty($contact['phone']) ? $contact['phone'] : '+91 9919007190';
$email = !empty($contact['email']) ? $contact['email'] : 'contact@pradeepsarang.in';
$privacyEmail = 'privacy@pradeepsarang.in';
$address = !empty($contact['address']) ? $contact['address'] : ps_text('ग्राम कमरावां, जिला बाराबंकी, उत्तर प्रदेश, भारत', 'Kamrawan, Barabanki, Uttar Pradesh, India');
$siteName = ps_text('प्रदीप सारंग', 'Pradeep Sarang');
$siteUrl = base_url('/');
$lastUpdated = '06 सितंबर 2026';
?>

<div class="flex flex-col w-full bg-surface-container-lowest text-on-surface">
  <!-- Top Editorial Header & Banner -->
  <div class="relative w-full bg-soft-meadow overflow-hidden py-space-2xl md:py-space-3xl border-b border-border-warm">
    <div class="absolute -top-32 -left-20 w-96 h-96 bg-primary-fixed/30 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute top-10 right-0 w-80 h-80 bg-secondary-fixed/20 rounded-full blur-3xl pointer-events-none"></div>

    <div class="max-w-container-max mx-auto px-4 sm:px-8 relative z-10">
      <nav class="flex items-center gap-2 font-label-md text-label-md text-text-muted mb-space-sm" aria-label="Breadcrumb">
        <a class="hover:text-primary transition-colors flex items-center gap-1" href="<?= e(base_url('/')) ?>">
          <span class="material-symbols-outlined text-[16px]">home</span>
          <span><?= e(ps_text('मुख्य पृष्ठ', 'Home')) ?></span>
        </a>
        <span class="opacity-40">/</span>
        <span class="text-deep-forest font-semibold"><?= e(ps_text('गोपनीयता नीति', 'Privacy Policy')) ?></span>
      </nav>

      <div class="flex flex-col space-y-3 max-w-4xl">
        <div class="inline-flex items-center gap-2 self-start bg-primary-fixed/40 text-deep-forest px-3.5 py-1 rounded-full font-label-sm text-label-sm border border-border-warm font-semibold">
          <span class="material-symbols-outlined text-[16px] text-primary-container">shield</span>
          <span><?= e(ps_text('डेटा सुरक्षा एवं निजता अधिकार', 'Data Protection & Privacy Rights')) ?></span>
        </div>
        <h1 class="font-display-hero text-headline-lg md:text-display-hero text-deep-forest font-bold tracking-tight">
          <?= e(ps_text('गोपनीयता नीति (Privacy Policy)', 'Privacy Policy')) ?>
        </h1>
        <p class="font-body-lg text-body-lg text-text-muted leading-relaxed">
          <?= e(ps_text('हम आपकी निजता का सम्मान करते हैं। यह नीति स्पष्ट करती है कि वेबसाइट (' . $siteUrl . ') पर पाठकों, लेखकों, स्वयंसेवकों और उपयोगकर्ताओं के व्यक्तिगत विवरण का संग्रहण, उपयोग और सुरक्षा किस प्रकार की जाती है।', 'We respect your privacy. This policy explains what information we collect, how we use it, how it may be shared, and your privacy rights.')) ?>
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
            <a href="#collect" class="hover:text-primary transition-colors py-1">1. एकत्र की जाने वाली जानकारी</a>
            <a href="#use" class="hover:text-primary transition-colors py-1">2. जानकारी का उपयोग</a>
            <a href="#cookies" class="hover:text-primary transition-colors py-1">3. कुकीज़ एवं तकनीक</a>
            <a href="#google" class="hover:text-primary transition-colors py-1">4. गूगल सेवाएं एवं एडसेंस</a>
            <a href="#ads" class="hover:text-primary transition-colors py-1">5. तृतीय-पक्ष विज्ञापन</a>
            <a href="#analytics" class="hover:text-primary transition-colors py-1">6. गूगल एनालिटिक्स</a>
            <a href="#authors" class="hover:text-primary transition-colors py-1">7. लेखक खाते व सार्वजनिक जानकारी</a>
            <a href="#sharing" class="hover:text-primary transition-colors py-1">8. डेटा साझाकरण</a>
            <a href="#security" class="hover:text-primary transition-colors py-1">9. डेटा सुरक्षा व प्रतिधारण</a>
            <a href="#rights" class="hover:text-primary transition-colors py-1">10. आपके निजता अधिकार</a>
            <a href="#contact" class="hover:text-primary transition-colors py-1">11. संपर्क सूत्र</a>
          </nav>
        </div>
      </aside>

      <!-- Main Body -->
      <main class="lg:col-span-8 flex flex-col space-y-10 font-body-md text-body-md text-on-surface leading-relaxed">
        
        <!-- Intro Note Box -->
        <div class="bg-soft-meadow border border-border-warm p-6 rounded-2xl flex items-start gap-4">
          <span class="material-symbols-outlined text-primary-container text-[28px] shrink-0">verified_user</span>
          <p class="font-body-md text-deep-forest">
            <?= e(ps_text('वेबसाइट ' . $siteName . ' का उपयोग करके आप इस गोपनीयता नीति में वर्णित डेटा प्रथाओं से अपनी सहमति व्यक्त करते हैं। हम उपयोगकर्ताओं की जानकारी का विक्रय नहीं करते हैं।', 'By using this Website, you acknowledge the practices described in this Privacy Policy. We do not sell your personal information.')) ?>
          </p>
        </div>

        <!-- Section 1 -->
        <article id="collect" class="space-y-4 pt-2 border-b border-border-warm/60 pb-8">
          <h2 class="font-headline-md text-headline-md text-deep-forest font-bold flex items-center gap-2.5">
            <span class="w-8 h-8 rounded-lg bg-primary-fixed/50 text-deep-forest font-mono text-sm flex items-center justify-center font-bold">1</span>
            <span><?= e(ps_text('हम कौन सी जानकारी एकत्र करते हैं? (Information We Collect)', 'Information We Collect')) ?></span>
          </h2>
          
          <div class="space-y-4">
            <div class="bg-pure-white p-5 rounded-xl border border-border-warm space-y-2">
              <h3 class="font-title-md text-title-md text-deep-forest font-bold">क. आपके द्वारा स्वेच्छा से प्रदान की गई जानकारी:</h3>
              <ul class="list-disc pl-6 space-y-1.5 text-text-muted text-body-sm">
                <li>नाम, ईमेल पता, फोन नंबर (संपर्क या स्वयंसेवक फॉर्म भरते समय)</li>
                <li>लेखक प्रोफ़ाइल जानकारी (नाम, चित्र, जीवनी, सोशल मीडिया लिंक्स)</li>
                <li>न्यूज़लेटर सदस्यता या संदेश फ़ॉर्म सबमिशन</li>
                <li>प्रस्तुत किए गए आलेख, विचार या टिप्पणियाँ</li>
              </ul>
            </div>

            <div class="bg-pure-white p-5 rounded-xl border border-border-warm space-y-2">
              <h3 class="font-title-md text-title-md text-deep-forest font-bold">ख. स्वतः एकत्र की जाने वाली जानकारी:</h3>
              <ul class="list-disc pl-6 space-y-1.5 text-text-muted text-body-sm">
                <li>IP पता, डिवाइस का प्रकार और ऑपरेटिंग सिस्टम</li>
                <li>ब्राउज़र का प्रकार और भाषा प्राथमिकताएँ</li>
                <li>आगमन पृष्ठ (Referring website) और विज़िट का समय</li>
                <li>कुकीज़, वेब बीकन और सर्वर लॉग डेटा</li>
              </ul>
            </div>
          </div>
        </article>

        <!-- Section 2 -->
        <article id="use" class="space-y-4 border-b border-border-warm/60 pb-8">
          <h2 class="font-headline-md text-headline-md text-deep-forest font-bold flex items-center gap-2.5">
            <span class="w-8 h-8 rounded-lg bg-primary-fixed/50 text-deep-forest font-mono text-sm flex items-center justify-center font-bold">2</span>
            <span><?= e(ps_text('हम जानकारी का उपयोग कैसे करते हैं? (How We Use Information)', 'How We Use Information')) ?></span>
          </h2>
          <p class="font-semibold text-deep-forest">एकत्रित जानकारी का उपयोग निम्नलिखित उद्देश्यों के लिए किया जाता है:</p>
          <ul class="list-disc pl-6 space-y-2 text-text-muted">
            <li>वेबसाइट का संचालन, रखरखाव और सुरक्षा सुनिश्चित करना</li>
            <li>लेखक खातों का प्रबंधन और आलेखों का संपादन व प्रकाशन</li>
            <li>उपयोगकर्ताओं के संदेशों, पूछताछों और फ़ॉर्म सबमिशन का उत्तर देना</li>
            <li>न्यूज़लेटर, सांस्कृतिक व पर्यावरण अपडेट भेजना (यदि सब्सक्राइब किया गया हो)</li>
            <li>वेबसाइट के प्रदर्शन, लोडिंग स्पीड और पाठकों की रुचि का विश्लेषण करना</li>
            <li>स्पैम, सुरक्षा खतरों, धोखाधड़ी और अनुचित गतिविधि को रोकना</li>
            <li>कानूनी दायित्वों का अनुपालन और प्रासंगिक विज्ञापनों का मापन</li>
          </ul>
        </article>

        <!-- Section 3 -->
        <article id="cookies" class="space-y-4 border-b border-border-warm/60 pb-8">
          <h2 class="font-headline-md text-headline-md text-deep-forest font-bold flex items-center gap-2.5">
            <span class="w-8 h-8 rounded-lg bg-primary-fixed/50 text-deep-forest font-mono text-sm flex items-center justify-center font-bold">3</span>
            <span><?= e(ps_text('कुकीज़ एवं ट्रैकिंग तकनीकें (Cookies & Tracking)', 'Cookies & Tracking')) ?></span>
          </h2>
          <p>
            हमारी वेबसाइट कुकीज़, स्थानीय स्टोरेज और संबंधित तकनीकों का उपयोग करती है। विस्तृत विवरण के लिए कृपया हमारी 
            <a href="<?= e(base_url('/cookie-policy')) ?>" class="text-primary font-semibold underline">कुकी नीति (Cookie Policy)</a> देखें।
          </p>
        </article>

        <!-- Section 4 -->
        <article id="google" class="space-y-4 border-b border-border-warm/60 pb-8">
          <h2 class="font-headline-md text-headline-md text-deep-forest font-bold flex items-center gap-2.5">
            <span class="w-8 h-8 rounded-lg bg-primary-fixed/50 text-deep-forest font-mono text-sm flex items-center justify-center font-bold">4</span>
            <span><?= e(ps_text('गूगल सेवाएं एवं गूगल एडसेंस (Google Services & AdSense)', 'Google Services & AdSense')) ?></span>
          </h2>
          <p>
            हम गूगल सेवाओं जैसे Google Analytics, Google AdSense और Google Ad Manager का उपयोग कर सकते हैं।
          </p>
          <div class="p-5 rounded-xl bg-soft-meadow border border-border-warm space-y-2">
            <h4 class="font-title-md text-title-md text-deep-forest font-bold">गूगल विज्ञापन कुकीज़ और आपकी पसंद:</h4>
            <p class="text-body-sm text-text-muted">
              गूगल और उसके भागीदार उपयोगकर्ता की पिछली विज़िट के आधार पर प्रासंगिक विज्ञापन प्रदर्शित करने के लिए कुकीज़ का उपयोग करते हैं। पाठक गूगल के <a href="https://adssettings.google.com" target="_blank" rel="noopener" class="text-primary underline">Ads Settings</a> टूल के माध्यम से व्यक्तिगत विज्ञापनों को नियंत्रित या अक्षम कर सकते हैं।
            </p>
          </div>
        </article>

        <!-- Section 5 -->
        <article id="ads" class="space-y-4 border-b border-border-warm/60 pb-8">
          <h2 class="font-headline-md text-headline-md text-deep-forest font-bold flex items-center gap-2.5">
            <span class="w-8 h-8 rounded-lg bg-primary-fixed/50 text-deep-forest font-mono text-sm flex items-center justify-center font-bold">5</span>
            <span><?= e(ps_text('तृतीय-पक्ष विज्ञापन नेटवर्क (Third-Party Advertising)', 'Third-Party Advertising')) ?></span>
          </h2>
          <p>
            तृतीय-पक्ष विज्ञापनदाता अपनी नीतियों के अनुसार कुकीज़ या पहचानकर्ताओं का उपयोग करके विज्ञापनों की प्रभावशीलता माप सकते हैं और धोखाधड़ी को रोक सकते हैं।
          </p>
        </article>

        <!-- Section 7 -->
        <article id="authors" class="space-y-4 border-b border-border-warm/60 pb-8">
          <h2 class="font-headline-md text-headline-md text-deep-forest font-bold flex items-center gap-2.5">
            <span class="w-8 h-8 rounded-lg bg-primary-fixed/50 text-deep-forest font-mono text-sm flex items-center justify-center font-bold">7</span>
            <span><?= e(ps_text('लेखक खाते व सार्वजनिक जानकारी (Author Accounts & Public Data)', 'Author Accounts & Public Data')) ?></span>
          </h2>
          <p>
            लेखकों द्वारा अपनी प्रोफ़ाइल (नाम, जीवनी, फ़ोटो, सोशल लिंक्स) में स्वेच्छा से प्रदान की गई जानकारी सार्वजनिक रूप से दिखाई दे सकती है। ऐसी जानकारी न जोड़ें जिसे आप सार्वजनिक नहीं करना चाहते।
          </p>
        </article>

        <!-- Section 8 -->
        <article id="sharing" class="space-y-4 border-b border-border-warm/60 pb-8">
          <h2 class="font-headline-md text-headline-md text-deep-forest font-bold flex items-center gap-2.5">
            <span class="w-8 h-8 rounded-lg bg-primary-fixed/50 text-deep-forest font-mono text-sm flex items-center justify-center font-bold">8</span>
            <span><?= e(ps_text('डेटा साझाकरण एवं प्रकटीकरण (Data Sharing)', 'Data Sharing')) ?></span>
          </h2>
          <p>
            हम केवल विश्वसनीय सेवा प्रदाताओं (होस्टिंग, ईमेल वितरण, सुरक्षा, एनालिटिक्स) के साथ या कानूनी बाध्यता, न्यायालय के आदेश या सार्वजनिक सुरक्षा के उद्देश्यों से ही जानकारी साझा करते हैं।
          </p>
        </article>

        <!-- Section 9 -->
        <article id="security" class="space-y-4 border-b border-border-warm/60 pb-8">
          <h2 class="font-headline-md text-headline-md text-deep-forest font-bold flex items-center gap-2.5">
            <span class="w-8 h-8 rounded-lg bg-primary-fixed/50 text-deep-forest font-mono text-sm flex items-center justify-center font-bold">9</span>
            <span><?= e(ps_text('डेटा सुरक्षा एवं प्रतिधारण (Data Security & Retention)', 'Data Security & Retention')) ?></span>
          </h2>
          <p>
            हम डेटा की सुरक्षा के लिए उचित तकनीकी और संगठनात्मक उपाय करते हैं। व्यक्तिगत जानकारी को केवल आवश्यक अवधि तक ही बनाए रखा जाता है।
          </p>
        </article>

        <!-- Section 10 -->
        <article id="rights" class="space-y-4 border-b border-border-warm/60 pb-8">
          <h2 class="font-headline-md text-headline-md text-deep-forest font-bold flex items-center gap-2.5">
            <span class="w-8 h-8 rounded-lg bg-primary-fixed/50 text-deep-forest font-mono text-sm flex items-center justify-center font-bold">10</span>
            <span><?= e(ps_text('आपके निजता अधिकार (Your Privacy Rights)', 'Your Privacy Rights')) ?></span>
          </h2>
          <p>
            आपको अपनी जानकारी तक पहुँच प्राप्त करने, त्रुटि सुधारने, सहमति वापस लेने या डेटा हटाने का अनुरोध करने का अधिकार है। इसके लिए आप हमें 
            <a href="mailto:<?= e($privacyEmail) ?>" class="text-primary underline font-semibold"><?= e($privacyEmail) ?></a> पर लिख सकते हैं।
          </p>
        </article>

        <!-- Section 11: Contact -->
        <article id="contact" class="space-y-4 bg-pure-white p-7 rounded-2xl border border-border-warm shadow-sm">
          <h2 class="font-headline-md text-headline-md text-deep-forest font-bold flex items-center gap-2">
            <span class="material-symbols-outlined text-primary-container text-[24px]">contact_support</span>
            <span><?= e(ps_text('संपर्क सूत्र (Contact Us)', 'Contact Us')) ?></span>
          </h2>
          <p><?= e(ps_text('गोपनीयता नीति से संबंधित प्रश्नों के लिए संपर्क करें:', 'For questions regarding this Privacy Policy, please contact us:')) ?></p>
          <div class="space-y-2 font-body-md text-deep-forest pt-2">
            <div><strong>वेबसाइट:</strong> <?= e($siteName) ?> (<?= e($siteUrl) ?>)</div>
            <div><strong>गोपनीयता ईमेल:</strong> <a href="mailto:<?= e($privacyEmail) ?>" class="text-primary hover:underline"><?= e($privacyEmail) ?></a></div>
            <div><strong>सामान्य संपर्क:</strong> <a href="mailto:<?= e($email) ?>" class="text-primary hover:underline"><?= e($email) ?></a></div>
            <div><strong>पता:</strong> <?= e($address) ?></div>
          </div>
        </article>

      </main>

    </div>
  </section>
</div>
