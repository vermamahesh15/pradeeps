<?php
declare(strict_types=1);

$phone = !empty($contact['phone']) ? $contact['phone'] : '+91 9919007190';
$email = !empty($contact['email']) ? $contact['email'] : 'contact@pradeepsarang.in';
$copyrightEmail = 'copyright@pradeepsarang.in';
$siteName = ps_text('प्रदीप सारंग', 'Pradeep Sarang');
$siteUrl = base_url('/');
$lastUpdated = '06 सितंबर 2026';
?>

<div class="flex flex-col w-full bg-surface-container-lowest text-on-surface">
  <!-- Top Header Banner -->
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
        <span class="text-deep-forest font-semibold"><?= e(ps_text('अस्वीकरण (Disclaimer)', 'Disclaimer')) ?></span>
      </nav>

      <div class="flex flex-col space-y-3 max-w-4xl">
        <div class="inline-flex items-center gap-2 self-start bg-primary-fixed/40 text-deep-forest px-3.5 py-1 rounded-full font-label-sm text-label-sm border border-border-warm font-semibold">
          <span class="material-symbols-outlined text-[16px] text-primary-container">gavel</span>
          <span><?= e(ps_text('कानूनी सूचना एवं दायरा', 'Legal & Disclosure')) ?></span>
        </div>
        <h1 class="font-display-hero text-headline-lg md:text-display-hero text-deep-forest font-bold tracking-tight">
          <?= e(ps_text('अस्वीकरण (Disclaimer)', 'Disclaimer')) ?>
        </h1>
        <p class="font-body-lg text-body-lg text-text-muted leading-relaxed">
          <?= e(ps_text('यह अस्वीकरण पत्र ' . $siteName . ' (' . $siteUrl . ') पर उपलब्ध सामग्री, बहु-लेखक आलेखों, विज्ञापनों और बाह्य लिंक्स के उपयोग के संबंध में महत्वपूर्ण शर्तें स्पष्ट करता है।', 'This Disclaimer details the terms regarding content accuracy, multi-author opinions, advertising, and limitation of responsibility.')) ?>
        </p>
        <div class="pt-2 text-label-md text-label-md text-text-muted flex items-center gap-2">
          <span class="material-symbols-outlined text-[18px] text-tertiary-fixed">event_available</span>
          <span><?= e(ps_text('अंतिम अद्यतन: ' . $lastUpdated, 'Last Updated: ' . $lastUpdated)) ?></span>
        </div>
      </div>
    </div>
  </div>

  <!-- Content Section -->
  <section class="max-w-container-max mx-auto px-4 sm:px-8 py-space-3xl">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
      
      <!-- Sticky Sidebar Navigation -->
      <aside class="lg:col-span-4 hidden lg:block">
        <div class="sticky top-28 bg-pure-white p-6 rounded-2xl border border-border-warm shadow-xs space-y-3">
          <h3 class="font-title-md text-title-md text-deep-forest font-bold pb-2 border-b border-border-warm flex items-center gap-2">
            <span class="material-symbols-outlined text-primary-container text-[20px]">toc</span>
            <span><?= e(ps_text('विषय सूची', 'Table of Contents')) ?></span>
          </h3>
          <nav class="flex flex-col space-y-2 font-body-sm text-body-sm text-text-muted">
            <a href="#general" class="hover:text-primary transition-colors py-1">1. सामान्य सूचना अस्वीकरण</a>
            <a href="#multi-author" class="hover:text-primary transition-colors py-1">2. बहु-लेखक सामग्री</a>
            <a href="#professional-advice" class="hover:text-primary transition-colors py-1">3. पेशेवर सलाह का अभाव</a>
            <a href="#tech-tutorial" class="hover:text-primary transition-colors py-1">4. तकनीकी एवं ट्यूटोरियल सामग्री</a>
            <a href="#external-links" class="hover:text-primary transition-colors py-1">5. बाहरी लिंक्स (External Links)</a>
            <a href="#advertising" class="hover:text-primary transition-colors py-1">6. विज्ञापन अस्वीकरण (AdSense)</a>
            <a href="#sponsored" class="hover:text-primary transition-colors py-1">7. प्रायोजित सामग्री</a>
            <a href="#affiliate" class="hover:text-primary transition-colors py-1">8. एफिलिएट लिंक्स</a>
            <a href="#copyright" class="hover:text-primary transition-colors py-1">9. कॉपीराइट व सर्वाधिकार</a>
            <a href="#contact" class="hover:text-primary transition-colors py-1">10. दायरा व संपर्क</a>
          </nav>
        </div>
      </aside>

      <!-- Main Body -->
      <main class="lg:col-span-8 flex flex-col space-y-10 font-body-md text-body-md text-on-surface leading-relaxed">

        <!-- Intro Warning Box -->
        <div class="bg-soft-meadow border border-border-warm p-6 rounded-2xl flex items-start gap-4">
          <span class="material-symbols-outlined text-tertiary-fixed text-[28px] shrink-0">info</span>
          <p class="font-body-md text-deep-forest">
            <?= e(ps_text('वेबसाइट पर उपलब्ध समस्त जानकारी सामान्य जानकारी, जन-जागरूकता, लोक-साहित्य, पर्यावरण संवाद और शैक्षणिक उद्देश्यों के लिए प्रदान की जाती है। किसी भी सूचना पर कार्य करने से पूर्व उसकी स्वतंत्र पुष्टि अवश्य करें।', 'All information is provided for general informational, educational, and public awareness purposes. Users should independently verify important information before relying upon it.')) ?>
          </p>
        </div>

        <!-- Section 1 -->
        <article id="general" class="space-y-4 border-b border-border-warm/60 pb-8">
          <h2 class="font-headline-md text-headline-md text-deep-forest font-bold flex items-center gap-2.5">
            <span class="w-8 h-8 rounded-lg bg-primary-fixed/50 text-deep-forest font-mono text-sm flex items-center justify-center font-bold">1</span>
            <span><?= e(ps_text('सामान्य सूचना अस्वीकरण (General Information Disclaimer)', 'General Information Disclaimer')) ?></span>
          </h2>
          <p>
            <?= e(ps_text('यद्यपि हम वेबसाइट पर सही, उपयोगी और अद्यतन जानकारी बनाए रखने के हर संभव प्रयास करते हैं, तथापि हम यह पूर्ण गारंटी नहीं देते हैं कि प्रकाशित प्रत्येक सामग्री पूर्ण, त्रुटिहीन, सटीक या वर्तमान परिस्थितियों के अनुसार शत-प्रतिशत सटीक है।', 'Although reasonable efforts are made to maintain accurate information, we make no guarantees regarding absolute completeness, currency, or error-free content.')) ?>
          </p>
        </article>

        <!-- Section 2 -->
        <article id="multi-author" class="space-y-4 border-b border-border-warm/60 pb-8">
          <h2 class="font-headline-md text-headline-md text-deep-forest font-bold flex items-center gap-2.5">
            <span class="w-8 h-8 rounded-lg bg-primary-fixed/50 text-deep-forest font-mono text-sm flex items-center justify-center font-bold">2</span>
            <span><?= e(ps_text('बहु-लेखक सामग्री एवं विचार (Multi-Author Content)', 'Multi-Author Content')) ?></span>
          </h2>
          <p>
            <?= e(ps_text('हमारी वेबसाइट पर मूल लेखक (प्रदीप सारंग), अतिथि लेखक, पंजीकृत लेखक और विषय विशेषज्ञों द्वारा तैयार आलेख प्रकाशित किए जाते हैं। किसी भी आलेख में व्यक्त विचार मुख्य रूप से उस आलेख के संबंधित लेखक के व्यक्तिगत विचार हैं।', 'Articles may be written by the website owner, guest authors, or registered contributors. Views expressed belong to the respective author and do not necessarily represent site endorsement.')) ?>
          </p>
        </article>

        <!-- Section 3 -->
        <article id="professional-advice" class="space-y-4 border-b border-border-warm/60 pb-8">
          <h2 class="font-headline-md text-headline-md text-deep-forest font-bold flex items-center gap-2.5">
            <span class="w-8 h-8 rounded-lg bg-primary-fixed/50 text-deep-forest font-mono text-sm flex items-center justify-center font-bold">3</span>
            <span><?= e(ps_text('पेशेवर/कानूनी सलाह का अभाव (Professional Advice Disclaimer)', 'Professional Advice Disclaimer')) ?></span>
          </h2>
          <p>
            <?= e(ps_text('जब तक कि विशेष रूप से उल्लेख न किया जाए, वेबसाइट की सामग्री कानूनी सलाह (Legal advice), चिकित्सीय सलाह (Medical advice), वित्तीय/कर सलाह (Financial/Tax advice) या आधिकारिक परामर्श का विकल्प नहीं है। गंभीर मामलों में संबंधित योग्य पेशेवर की सलाह लें।', 'Unless specifically stated, website content does not constitute legal, medical, financial, tax, or professional counselling advice.')) ?>
          </p>
        </article>

        <!-- Section 4 -->
        <article id="tech-tutorial" class="space-y-4 border-b border-border-warm/60 pb-8">
          <h2 class="font-headline-md text-headline-md text-deep-forest font-bold flex items-center gap-2.5">
            <span class="w-8 h-8 rounded-lg bg-primary-fixed/50 text-deep-forest font-mono text-sm flex items-center justify-center font-bold">4</span>
            <span><?= e(ps_text('तकनीकी और निर्देश सामग्री (Technology & Tutorial Disclaimer)', 'Technology & Tutorial Disclaimer')) ?></span>
          </h2>
          <p>
            <?= e(ps_text('प्रौद्योगिकी, सर्वर, डिजिटल मार्केटिंग, सॉफ्टवेयर या एआई ट्यूटोरियल से संबंधित लेख शैक्षणिक उद्देश्यों के लिए प्रदान किए जाते हैं। उपयोगकर्ता अपनी प्रणाली पर कोई भी कमान चलाने से पहले बैकअप बनाए रखें। किसी भी डेटा हानि या प्रणाली क्षति के लिए वेबसाइट उत्तरदायी नहीं होगी।', 'Technology tutorials are provided for educational purposes. Users should verify commands and maintain backups. We are not liable for data loss or system issues.')) ?>
          </p>
        </article>

        <!-- Section 5 -->
        <article id="external-links" class="space-y-4 border-b border-border-warm/60 pb-8">
          <h2 class="font-headline-md text-headline-md text-deep-forest font-bold flex items-center gap-2.5">
            <span class="w-8 h-8 rounded-lg bg-primary-fixed/50 text-deep-forest font-mono text-sm flex items-center justify-center font-bold">5</span>
            <span><?= e(ps_text('बाहरी वेबसाइटों के लिंक्स (External Links Disclaimer)', 'External Links Disclaimer')) ?></span>
          </h2>
          <p>
            <?= e(ps_text('हमारी वेबसाइट में बाहरी वेबसाइटों के संदर्भ या लिंक्स हो सकते हैं। हम तृतीय-पक्ष वेबसाइटों की सामग्री, उपलब्धता, सुरक्षा या गोपनीयता नीतियों की जिम्मेदारी नहीं लेते हैं।', 'External links are provided for convenience. We do not guarantee the security, legality, or availability of third-party websites.')) ?>
          </p>
        </article>

        <!-- Section 6: AdSense & Advertising -->
        <article id="advertising" class="space-y-4 border-b border-border-warm/60 pb-8">
          <h2 class="font-headline-md text-headline-md text-deep-forest font-bold flex items-center gap-2.5">
            <span class="w-8 h-8 rounded-lg bg-primary-fixed/50 text-deep-forest font-mono text-sm flex items-center justify-center font-bold">6</span>
            <span><?= e(ps_text('विज्ञापन अस्वीकरण (Advertising Disclaimer & Google AdSense)', 'Advertising & AdSense Disclaimer')) ?></span>
          </h2>
          <p>
            <?= e(ps_text('वेबसाइट पर गूगल एडसेंस (Google AdSense), गूगल एड मैनेजर (Ad Manager) या प्रत्यक्ष प्रायोजकों के विज्ञापन प्रदर्शित किए जा सकते हैं। किसी विज्ञापन का प्रदर्शित होना उस उत्पाद या सेवा का आधिकारिक समर्थन नहीं माना जाएगा। पाठकों को सलाह दी जाती है कि वे खरीदारी से पूर्व स्वयं जाँच करें।', 'Advertisements served by Google AdSense or networks appear automatically. An ad display does not imply website endorsement of the product or service.')) ?>
          </p>
        </article>

        <!-- Section 7: Sponsored Content -->
        <article id="sponsored" class="space-y-4 border-b border-border-warm/60 pb-8">
          <h2 class="font-headline-md text-headline-md text-deep-forest font-bold flex items-center gap-2.5">
            <span class="w-8 h-8 rounded-lg bg-primary-fixed/50 text-deep-forest font-mono text-sm flex items-center justify-center font-bold">7</span>
            <span><?= e(ps_text('प्रायोजित एवं साझेदार सामग्री (Sponsored Content)', 'Sponsored Content')) ?></span>
          </h2>
          <p>
            <?= e(ps_text('यदि कोई आलेख प्रायोजित या व्यावसायिक संबंध के तहत प्रकाशित किया जाता है, तो उसे "प्रायोजित (Sponsored)" या "साझेदार आलेख" टैग के साथ पारदर्शी रूप से चिन्हित किया जाएगा।', 'Sponsored or partner material will be clearly identified with tags such as Sponsored, Partner Content, or Paid Partnership.')) ?>
          </p>
        </article>

        <!-- Section 8: Affiliate Links -->
        <article id="affiliate" class="space-y-4 border-b border-border-warm/60 pb-8">
          <h2 class="font-headline-md text-headline-md text-deep-forest font-bold flex items-center gap-2.5">
            <span class="w-8 h-8 rounded-lg bg-primary-fixed/50 text-deep-forest font-mono text-sm flex items-center justify-center font-bold">8</span>
            <span><?= e(ps_text('एफिलिएट लिंक्स (Affiliate Links)', 'Affiliate Links')) ?></span>
          </h2>
          <p>
            <?= e(ps_text('कुछ आलेखों में एफिलिएट लिंक्स हो सकते हैं। यदि आप किसी एफिलिएट लिंक के माध्यम से खरीदारी करते हैं, तो वेबसाइट को एक छोटा कमीशन प्राप्त हो सकता है, जिससे आपके लिए कोई अतिरिक्त लागत नहीं होती।', 'If a user follows an affiliate link and purchases a product, the website may receive commission compensation.')) ?>
          </p>
        </article>

        <!-- Section 9: Copyright -->
        <article id="copyright" class="space-y-4 border-b border-border-warm/60 pb-8">
          <h2 class="font-headline-md text-headline-md text-deep-forest font-bold flex items-center gap-2.5">
            <span class="w-8 h-8 rounded-lg bg-primary-fixed/50 text-deep-forest font-mono text-sm flex items-center justify-center font-bold">9</span>
            <span><?= e(ps_text('कॉपीराइट एवं डीएमसीए (Copyright & DMCA)', 'Copyright & DMCA')) ?></span>
          </h2>
          <p>
            <?= e(ps_text('सभी लेखक अपने द्वारा प्रस्तुत पाठ, छवियों और मीडिया के अधिकारों के लिए स्वयं उत्तरदायी हैं। यदि आपको लगता है कि हमारी वेबसाइट पर प्रकाशित कोई सामग्री आपके कॉपीराइट का उल्लंघन करती है, तो कृपया तुरंत ', 'Authors are responsible for obtaining image and text rights. If you believe published content infringes your copyright, please notify: ')) ?>
            <a href="mailto:<?= e($copyrightEmail) ?>" class="text-primary font-semibold underline"><?= e($copyrightEmail) ?></a> पर सूचित करें।
          </p>
        </article>

        <!-- Section 10: Contact -->
        <article id="contact" class="space-y-4 bg-pure-white p-7 rounded-2xl border border-border-warm shadow-sm">
          <h2 class="font-headline-md text-headline-md text-deep-forest font-bold flex items-center gap-2">
            <span class="material-symbols-outlined text-primary-container text-[24px]">contact_support</span>
            <span><?= e(ps_text('संपर्क सूत्र (Contact Us)', 'Contact Us')) ?></span>
          </h2>
          <p><?= e(ps_text('अस्वीकरण के संबंध में किसी भी प्रश्न के लिए संपर्क करें:', 'For questions regarding this Disclaimer, please contact:')) ?></p>
          <div class="space-y-2 font-body-md text-deep-forest pt-2">
            <div><strong>वेबसाइट:</strong> <?= e($siteName) ?> (<?= e($siteUrl) ?>)</div>
            <div><strong>ईमेल:</strong> <a href="mailto:<?= e($email) ?>" class="text-primary hover:underline"><?= e($email) ?></a></div>
          </div>
        </article>

      </main>

    </div>
  </section>
</div>
