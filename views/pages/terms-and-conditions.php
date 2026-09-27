<?php
declare(strict_types=1);

$phone = !empty($contact['phone']) ? $contact['phone'] : '+91 9919007190';
$email = !empty($contact['email']) ? $contact['email'] : 'contact@pradeepsarang.in';
$copyrightEmail = 'copyright@pradeepsarang.in';
$address = !empty($contact['address']) ? $contact['address'] : ps_text('ग्राम कमरावां, जिला बाराबंकी, उत्तर प्रदेश, भारत', 'Kamrawan, Barabanki, Uttar Pradesh, India');
$siteName = ps_text('प्रदीप सारंग', 'Pradeep Sarang');
$siteUrl = base_url('/');
$lastUpdated = '06 सितंबर 2026';
?>

<div class="flex flex-col w-full bg-surface-container-lowest text-on-surface">
  <!-- Header Banner -->
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
        <span class="text-deep-forest font-semibold"><?= e(ps_text('नियम एवं शर्तें', 'Terms & Conditions')) ?></span>
      </nav>

      <div class="flex flex-col space-y-3 max-w-4xl">
        <div class="inline-flex items-center gap-2 self-start bg-primary-fixed/40 text-deep-forest px-3.5 py-1 rounded-full font-label-sm text-label-sm border border-border-warm font-semibold">
          <span class="material-symbols-outlined text-[16px] text-primary-container">gavel</span>
          <span><?= e(ps_text('उपयोग शर्तें एवं कानूनी अनुबंध', 'Terms of Use & Legal Agreement')) ?></span>
        </div>
        <h1 class="font-display-hero text-headline-lg md:text-display-hero text-deep-forest font-bold tracking-tight">
          <?= e(ps_text('नियम एवं शर्तें (Terms & Conditions)', 'Terms & Conditions')) ?>
        </h1>
        <p class="font-body-lg text-body-lg text-text-muted leading-relaxed">
          <?= e(ps_text('ये नियम और शर्तें ' . $siteName . ' (' . $siteUrl . ') की वेबसाइट, आलेखों, पोर्टफोलियो, लेखक खातों और सेवाओं के उपयोग के कानूनी नियम निर्धारित करती हैं।', 'These Terms and Conditions govern your access to and use of the Website, including articles, services, and author features.')) ?>
        </p>
        <div class="pt-2 text-label-md text-label-md text-text-muted flex items-center gap-2">
          <span class="material-symbols-outlined text-[18px] text-tertiary-fixed">event_available</span>
          <span><?= e(ps_text('अंतिम अद्यतन: ' . $lastUpdated, 'Last Updated: ' . $lastUpdated)) ?></span>
        </div>
      </div>
    </div>
  </div>

  <!-- Main Section -->
  <section class="max-w-container-max mx-auto px-4 sm:px-8 py-space-3xl">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
      
      <!-- Sidebar -->
      <aside class="lg:col-span-4 hidden lg:block">
        <div class="sticky top-28 bg-pure-white p-6 rounded-2xl border border-border-warm shadow-xs space-y-3">
          <h3 class="font-title-md text-title-md text-deep-forest font-bold pb-2 border-b border-border-warm flex items-center gap-2">
            <span class="material-symbols-outlined text-primary-container text-[20px]">toc</span>
            <span><?= e(ps_text('नियम अनुभाग', 'Terms Sections')) ?></span>
          </h3>
          <nav class="flex flex-col space-y-2 font-body-sm text-body-sm text-text-muted">
            <a href="#about" class="hover:text-primary transition-colors py-1">1. वेबसाइट परिचय</a>
            <a href="#accounts" class="hover:text-primary transition-colors py-1">2. लेखक एवं उपयोगकर्ता खाते</a>
            <a href="#license" class="hover:text-primary transition-colors py-1">3. लेखक सामग्री एवं लाइसेंस</a>
            <a href="#warranties" class="hover:text-primary transition-colors py-1">4. लेखक वारंटी</a>
            <a href="#copyright" class="hover:text-primary transition-colors py-1">5. कॉपीराइट व प्लेगियारिज़्म</a>
            <a href="#prohibited" class="hover:text-primary transition-colors py-1">6. निषिद्ध सामग्री व कार्य</a>
            <a href="#editorial" class="hover:text-primary transition-colors py-1">7. संपादकीय नियंत्रण</a>
            <a href="#adsense" class="hover:text-primary transition-colors py-1">8. विज्ञापन एवं एडसेंस नियम</a>
            <a href="#liability" class="hover:text-primary transition-colors py-1">9. दायित्व की सीमा</a>
            <a href="#law" class="hover:text-primary transition-colors py-1">10. लागू कानून व क्षेत्राधिकार</a>
            <a href="#contact" class="hover:text-primary transition-colors py-1">11. संपर्क सूत्र</a>
          </nav>
        </div>
      </aside>

      <!-- Main Body -->
      <main class="lg:col-span-8 flex flex-col space-y-10 font-body-md text-body-md text-on-surface leading-relaxed">
        
        <!-- Intro Note -->
        <div class="bg-soft-meadow border border-border-warm p-6 rounded-2xl flex items-start gap-4">
          <span class="material-symbols-outlined text-primary-container text-[28px] shrink-0">fact_check</span>
          <p class="font-body-md text-deep-forest">
            <?= e(ps_text('वेबसाइट का उपयोग करके आप इन नियमों और शर्तों से सहमत होते हैं। यदि आप इन नियमों से सहमत नहीं हैं, तो कृपया वेबसाइट का उपयोग न करें।', 'By accessing or using the Website, you agree to these Terms. If you do not agree, please discontinue use of the Website.')) ?>
          </p>
        </div>

        <!-- Section 1 -->
        <article id="about" class="space-y-4 pt-2 border-b border-border-warm/60 pb-8">
          <h2 class="font-headline-md text-headline-md text-deep-forest font-bold flex items-center gap-2.5">
            <span class="w-8 h-8 rounded-lg bg-primary-fixed/50 text-deep-forest font-mono text-sm flex items-center justify-center font-bold">1</span>
            <span><?= e(ps_text('वेबसाइट परिचय (About the Website)', 'About the Website')) ?></span>
          </h2>
          <p>
            <?= e(ps_text($siteName . ' एक पोर्टफोलियो, जन-अभियान और प्रकाशन मंच है जिसमें शामिल हैं:', $siteName . ' is a portfolio and publishing platform containing:')) ?>
          </p>
          <ul class="list-disc pl-6 space-y-1.5 text-text-muted">
            <li>व्यक्तिगत पोर्टफोलियो और सामाजिक अभियानों का विवरण</li>
            <li>वैचारिक ब्लॉग आलेख, संस्मरण और लोक-साहित्य</li>
            <li>अतिथि विचारकों और पंजीकृत लेखकों की रचनाएँ</li>
            <li>पर्यावरण संरक्षण, अवधी साहित्य और जन-सेवा संबंधी मीडिया</li>
          </ul>
        </article>

        <!-- Section 2 -->
        <article id="accounts" class="space-y-4 border-b border-border-warm/60 pb-8">
          <h2 class="font-headline-md text-headline-md text-deep-forest font-bold flex items-center gap-2.5">
            <span class="w-8 h-8 rounded-lg bg-primary-fixed/50 text-deep-forest font-mono text-sm flex items-center justify-center font-bold">2</span>
            <span><?= e(ps_text('उपयोगकर्ता एवं लेखक खाते (User & Author Accounts)', 'User & Author Accounts')) ?></span>
          </h2>
          <p>
            पंजीकृत लेखकों को अपने खाते की सुरक्षा और पासवर्ड की गोपनीयता बनाए रखनी होगी। खाते का दुरुपयोग होने पर प्रशासनिक स्तर पर निलंबन या निरस्तीकरण किया जा सकता है।
          </p>
        </article>

        <!-- Section 3 -->
        <article id="license" class="space-y-4 border-b border-border-warm/60 pb-8">
          <h2 class="font-headline-md text-headline-md text-deep-forest font-bold flex items-center gap-2.5">
            <span class="w-8 h-8 rounded-lg bg-primary-fixed/50 text-deep-forest font-mono text-sm flex items-center justify-center font-bold">3</span>
            <span><?= e(ps_text('लेखक सामग्री एवं लाइसेंस (Author Content & License)', 'Author Content & License')) ?></span>
          </h2>
          <p>
            लेखक अपनी मूल सामग्री का स्वामित्व बनाए रखते हैं। आलेख सबमिट करने पर लेखक वेबसाइट को सामग्री को प्रकाशित करने, प्रदर्शित करने, स्वरूपित करने और प्रचारित करने का गैर-अनन्य, वैश्विक लाइसेंस प्रदान करता है।
          </p>
        </article>

        <!-- Section 4 -->
        <article id="warranties" class="space-y-4 border-b border-border-warm/60 pb-8">
          <h2 class="font-headline-md text-headline-md text-deep-forest font-bold flex items-center gap-2.5">
            <span class="w-8 h-8 rounded-lg bg-primary-fixed/50 text-deep-forest font-mono text-sm flex items-center justify-center font-bold">4</span>
            <span><?= e(ps_text('लेखक वारंटी (Author Warranties)', 'Author Warranties')) ?></span>
          </h2>
          <p>
            सामग्री जमा करके लेखक यह पुष्टि करता है कि प्रस्तुत सामग्री मौलिक है, किसी तृतीय-पक्ष कॉपीराइट या पेटेंट का उल्लंघन नहीं करती है और कानूनी रूप से वैध है।
          </p>
        </article>

        <!-- Section 5 -->
        <article id="copyright" class="space-y-4 border-b border-border-warm/60 pb-8">
          <h2 class="font-headline-md text-headline-md text-deep-forest font-bold flex items-center gap-2.5">
            <span class="w-8 h-8 rounded-lg bg-primary-fixed/50 text-deep-forest font-mono text-sm flex items-center justify-center font-bold">5</span>
            <span><?= e(ps_text('कॉपीराइट एवं प्लेगियारिज़्म (Copyright & Plagiarism)', 'Copyright & Plagiarism')) ?></span>
          </h2>
          <p>
            साहित्यिक चोरी पूर्णतः निषिद्ध है। कॉपीराइट उल्लंघन के मामलों में सामग्री को तुरंत हटाया जाएगा। शिकायत के लिए 
            <a href="mailto:<?= e($copyrightEmail) ?>" class="text-primary underline font-semibold"><?= e($copyrightEmail) ?></a> पर संपर्क करें।
          </p>
        </article>

        <!-- Section 6 -->
        <article id="prohibited" class="space-y-4 border-b border-border-warm/60 pb-8">
          <h2 class="font-headline-md text-headline-md text-deep-forest font-bold flex items-center gap-2.5">
            <span class="w-8 h-8 rounded-lg bg-primary-fixed/50 text-deep-forest font-mono text-sm flex items-center justify-center font-bold">6</span>
            <span><?= e(ps_text('निषिद्ध सामग्री एवं कार्य (Prohibited Content)', 'Prohibited Content')) ?></span>
          </h2>
          <p>
            वेबसाइट पर गैर-कानूनी गतिविधियां, मालवेयर, धोखाधड़ी, घृणात्मक सामग्री, फर्जी क्लिक मैनिपुलेशन या गूगल एडसेंस नीतियों के उल्लंघन संबंधी आलेख पोस्ट करना सख्त मना है।
          </p>
        </article>

        <!-- Section 7 -->
        <article id="editorial" class="space-y-4 border-b border-border-warm/60 pb-8">
          <h2 class="font-headline-md text-headline-md text-deep-forest font-bold flex items-center gap-2.5">
            <span class="w-8 h-8 rounded-lg bg-primary-fixed/50 text-deep-forest font-mono text-sm flex items-center justify-center font-bold">7</span>
            <span><?= e(ps_text('संपादकीय नियंत्रण (Editorial Control)', 'Editorial Control')) ?></span>
          </h2>
          <p>
            आलेख सबमिट करने से स्वतः प्रकाशन की गारंटी नहीं मिलती। मुख्य प्रशासक (प्रदीप सारंग) को सामग्री की समीक्षा, अस्वीकृति या अनुमोदन का पूर्ण अधिकार है।
          </p>
        </article>

        <!-- Section 8: AdSense Rules -->
        <article id="adsense" class="space-y-4 border-b border-border-warm/60 pb-8">
          <h2 class="font-headline-md text-headline-md text-deep-forest font-bold flex items-center gap-2.5">
            <span class="w-8 h-8 rounded-lg bg-primary-fixed/50 text-deep-forest font-mono text-sm flex items-center justify-center font-bold">8</span>
            <span><?= e(ps_text('विज्ञापन एवं एडसेंस नियम (Advertisements & AdSense Rules)', 'Advertisements & AdSense Rules')) ?></span>
          </h2>
          <p>
            वेबसाइट पर गूगल एडसेंस के विज्ञापन प्रदर्शित हो सकते हैं। उपयोगकर्ताओं द्वारा विज्ञापनों पर कृत्रिम रूप से क्लिक करना या धोखे से इंप्रेशन बढ़ाना सख्त वर्जित है।
          </p>
        </article>

        <!-- Section 9 -->
        <article id="liability" class="space-y-4 border-b border-border-warm/60 pb-8">
          <h2 class="font-headline-md text-headline-md text-deep-forest font-bold flex items-center gap-2.5">
            <span class="w-8 h-8 rounded-lg bg-primary-fixed/50 text-deep-forest font-mono text-sm flex items-center justify-center font-bold">9</span>
            <span><?= e(ps_text('दायित्व की सीमा (Limitation of Liability)', 'Limitation of Liability')) ?></span>
          </h2>
          <p>
            लागू कानून द्वारा अनुमत अधिकतम सीमा तक, <?= e($siteName) ?> और इसके संचालक वेबसाइट के उपयोग या उपयोग करने की असमर्थता से उत्पन्न किसी भी अप्रत्यक्ष क्षति के लिए उत्तरदायी नहीं होंगे।
          </p>
        </article>

        <!-- Section 10 -->
        <article id="law" class="space-y-4 border-b border-border-warm/60 pb-8">
          <h2 class="font-headline-md text-headline-md text-deep-forest font-bold flex items-center gap-2.5">
            <span class="w-8 h-8 rounded-lg bg-primary-fixed/50 text-deep-forest font-mono text-sm flex items-center justify-center font-bold">10</span>
            <span><?= e(ps_text('लागू कानून व क्षेत्राधिकार (Governing Law & Jurisdiction)', 'Governing Law & Jurisdiction')) ?></span>
          </h2>
          <p>
            ये नियम भारत गणराज्य (Republic of India) और उत्तर प्रदेश राज्य के कानूनों द्वारा शासित होंगे। किसी भी कानूनी विवाद का क्षेत्राधिकार बाराबंकी / लखनऊ, उत्तर प्रदेश होगा।
          </p>
        </article>

        <!-- Section 11: Contact -->
        <article id="contact" class="space-y-4 bg-pure-white p-7 rounded-2xl border border-border-warm shadow-sm">
          <h2 class="font-headline-md text-headline-md text-deep-forest font-bold flex items-center gap-2">
            <span class="material-symbols-outlined text-primary-container text-[24px]">mail</span>
            <span><?= e(ps_text('संपर्क सूत्र (Contact Us)', 'Contact Us')) ?></span>
          </h2>
          <p><?= e(ps_text('नियमों एवं शर्तों से संबंधित प्रश्नों के लिए संपर्क करें:', 'For questions regarding these Terms & Conditions, please contact us:')) ?></p>
          <div class="space-y-2 font-body-md text-deep-forest pt-2">
            <div><strong>वेबसाइट:</strong> <?= e($siteName) ?> (<?= e($siteUrl) ?>)</div>
            <div><strong>ईमेल:</strong> <a href="mailto:<?= e($email) ?>" class="text-primary hover:underline"><?= e($email) ?></a></div>
            <div><strong>पता:</strong> <?= e($address) ?></div>
          </div>
        </article>

      </main>

    </div>
  </section>
</div>
