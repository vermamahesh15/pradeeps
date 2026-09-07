<?php
declare(strict_types=1);

$phone = !empty($contact['phone']) ? $contact['phone'] : '+91 9919007190';
$email = !empty($contact['email']) ? $contact['email'] : 'contact@pradeepsarang.in';
$editorialEmail = 'editorial@pradeepsarang.in';
$siteName = ps_text('प्रदीप सारंग', 'Pradeep Sarang');
$siteUrl = base_url('/');
$lastUpdated = '06 सितंबर 2026';
?>

<div class="flex flex-col w-full bg-surface-container-lowest text-on-surface">
  <!-- Top Banner -->
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
        <span class="text-deep-forest font-semibold"><?= e(ps_text('संपादकीय नीति', 'Editorial Policy')) ?></span>
      </nav>

      <div class="flex flex-col space-y-3 max-w-4xl">
        <div class="inline-flex items-center gap-2 self-start bg-primary-fixed/40 text-deep-forest px-3.5 py-1 rounded-full font-label-sm text-label-sm border border-border-warm font-semibold">
          <span class="material-symbols-outlined text-[16px] text-primary-container">auto_stories</span>
          <span><?= e(ps_text('उच्चतम साहित्यिक मानक एवं निष्पक्षता', 'Editorial Integrity & Standards')) ?></span>
        </div>
        <h1 class="font-display-hero text-headline-lg md:text-display-hero text-deep-forest font-bold tracking-tight">
          <?= e(ps_text('संपादकीय नीति (Editorial Policy)', 'Editorial Policy')) ?>
        </h1>
        <p class="font-body-lg text-body-lg text-text-muted leading-relaxed">
          <?= e(ps_text('यह संपादकीय नीति ' . $siteName . ' (' . $siteUrl . ') पर प्रकाशित होने वाली सामग्री की मौलिकता, सत्यता, निष्पक्षता और संपादकीय मानकों के दिशा-निर्देश निर्धारित करती है।', 'This Editorial Policy describes our standards for publishing original, trustworthy, and engaging content across multiple contributors.')) ?>
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
      
      <!-- Sticky Navigation Sidebar -->
      <aside class="lg:col-span-4 hidden lg:block">
        <div class="sticky top-28 bg-pure-white p-6 rounded-2xl border border-border-warm shadow-xs space-y-3">
          <h3 class="font-title-md text-title-md text-deep-forest font-bold pb-2 border-b border-border-warm flex items-center gap-2">
            <span class="material-symbols-outlined text-primary-container text-[20px]">menu_book</span>
            <span><?= e(ps_text('संपादकीय अध्याय', 'Editorial Chapters')) ?></span>
          </h3>
          <nav class="flex flex-col space-y-2 font-body-sm text-body-sm text-text-muted">
            <a href="#principles" class="hover:text-primary transition-colors py-1">1. मुख्य संपादकीय सिद्धांत</a>
            <a href="#independence" class="hover:text-primary transition-colors py-1">2. संपादकीय स्वतंत्रता</a>
            <a href="#originality" class="hover:text-primary transition-colors py-1">3. मौलिक सामग्री एवं प्लेगियारिज़्म</a>
            <a href="#ai-content" class="hover:text-primary transition-colors py-1">4. कृत्रिम बुद्धिमत्ता (AI) नीति</a>
            <a href="#sources" class="hover:text-primary transition-colors py-1">5. विश्वसनीय स्रोत व संदर्भ</a>
            <a href="#corrections" class="hover:text-primary transition-colors py-1">6. संशोधन एवं सुधार नीति</a>
            <a href="#author-id" class="hover:text-primary transition-colors py-1">7. लेखक पहचान एवं पारदर्शिता</a>
            <a href="#separation" class="hover:text-primary transition-colors py-1">8. विज्ञापन व सामग्री पृथक्करण</a>
            <a href="#prohibited" class="hover:text-primary transition-colors py-1">9. निषिद्ध सामग्री</a>
            <a href="#complaints" class="hover:text-primary transition-colors py-1">10. शिकायतें व संपर्क</a>
          </nav>
        </div>
      </aside>

      <!-- Main Body -->
      <main class="lg:col-span-8 flex flex-col space-y-10 font-body-md text-body-md text-on-surface leading-relaxed">

        <!-- Banner Box -->
        <div class="bg-soft-meadow border border-border-warm p-6 rounded-2xl flex items-start gap-4">
          <span class="material-symbols-outlined text-primary-container text-[28px] shrink-0">verified</span>
          <p class="font-body-md text-deep-forest">
            <?= e(ps_text('हमारा ध्येय पाठकों को प्रमाणिक, जन-सरोकारों से जुड़ी और विचारोत्तेजक सामग्री प्रदान करना है। हमारा सम्पादकीय मण्डल प्रत्येक आलेख की गुणवत्ता और विश्वसनीयता के लिए प्रतिबद्ध है।', 'Our goal is to provide authentic, community-centric, and engaging information while supporting multi-author contributions under strict quality standards.')) ?>
          </p>
        </div>

        <!-- Section 1 -->
        <article id="principles" class="space-y-4 border-b border-border-warm/60 pb-8">
          <h2 class="font-headline-md text-headline-md text-deep-forest font-bold flex items-center gap-2.5">
            <span class="w-8 h-8 rounded-lg bg-primary-fixed/50 text-deep-forest font-mono text-sm flex items-center justify-center font-bold">1</span>
            <span><?= e(ps_text('मुख्य संपादकीय सिद्धांत (Editorial Principles)', 'Editorial Principles')) ?></span>
          </h2>
          <div class="grid grid-cols-1 md:grid-cols-2 gap-4 pt-2">
            <div class="bg-pure-white p-5 rounded-xl border border-border-warm">
              <h3 class="font-title-md text-title-md text-deep-forest font-bold mb-1">सत्यता एवं सटीकता (Accuracy)</h3>
              <p class="text-text-muted text-body-sm">लेखकों से अपेक्षा की जाती है कि वे प्रस्तुत किए गए तथ्यों और आंकड़ों की जमा करने से पूर्व उचित पुष्टि करें।</p>
            </div>
            <div class="bg-pure-white p-5 rounded-xl border border-border-warm">
              <h3 class="font-title-md text-title-md text-deep-forest font-bold mb-1">मौलिकता (Originality)</h3>
              <p class="text-text-muted text-body-sm">आलेखों में मौलिक विचार और गुणवत्ता होनी चाहिए। किसी अन्य प्रकाशन से सीधे कॉपी करना पूर्णतः वर्जित है।</p>
            </div>
            <div class="bg-pure-white p-5 rounded-xl border border-border-warm">
              <h3 class="font-title-md text-title-md text-deep-forest font-bold mb-1">पारदर्शिता (Transparency)</h3>
              <p class="text-text-muted text-body-sm">प्रायोजित आलेखों, व्यावसायिक संबंधों या एफिलिएट लिंक्स का स्पष्ट उल्लेख किया जाना अनिवार्य है।</p>
            </div>
            <div class="bg-pure-white p-5 rounded-xl border border-border-warm">
              <h3 class="font-title-md text-title-md text-deep-forest font-bold mb-1">पाठक मूल्य (Reader Value)</h3>
              <p class="text-text-muted text-body-sm">सामग्री का मुख्य उद्देश्य पाठकों को जागरूक, शिक्षित और लाभान्वित करना होना चाहिए, न कि केवल विज्ञापनों के लिए।</p>
            </div>
          </div>
        </article>

        <!-- Section 2 -->
        <article id="independence" class="space-y-4 border-b border-border-warm/60 pb-8">
          <h2 class="font-headline-md text-headline-md text-deep-forest font-bold flex items-center gap-2.5">
            <span class="w-8 h-8 rounded-lg bg-primary-fixed/50 text-deep-forest font-mono text-sm flex items-center justify-center font-bold">2</span>
            <span><?= e(ps_text('संपादकीय स्वतंत्रता (Editorial Independence)', 'Editorial Independence')) ?></span>
          </h2>
          <p>
            <?= e(ps_text('विज्ञापनदाता, प्रायोजक या व्यावसायिक भागीदार हमारी स्वतंत्र संपादकीय राय को नियंत्रित नहीं कर सकते। विज्ञापन का भुगतान करने मात्र से अनुकूल संपादकीय समीक्षा की गारंटी नहीं मिलती।', 'Advertisers or sponsors do not control our independent editorial opinions. Commercial arrangements will not dictate favorable coverage.')) ?>
          </p>
        </article>

        <!-- Section 3 -->
        <article id="originality" class="space-y-4 border-b border-border-warm/60 pb-8">
          <h2 class="font-headline-md text-headline-md text-deep-forest font-bold flex items-center gap-2.5">
            <span class="w-8 h-8 rounded-lg bg-primary-fixed/50 text-deep-forest font-mono text-sm flex items-center justify-center font-bold">3</span>
            <span><?= e(ps_text('मौलिक सामग्री एवं साहित्यिक चोरी (Original Content & Plagiarism)', 'Original Content & Plagiarism')) ?></span>
          </h2>
          <p>
            <?= e(ps_text('हम साहित्यिक चोरी (Plagiarism), स्पिनिंग या अनधिकृत प्रतिलिपि के प्रति शून्य-सहनशीलता (Zero Tolerance) की नीति अपनाते हैं। किसी भी तृतीय-पक्ष आलेख या संदर्भ का उचित क्रेडिट दिया जाना आवश्यक है।', 'We maintain zero tolerance for plagiarism, unauthorized copying, or article spinning. Proper attribution is mandatory.')) ?>
          </p>
        </article>

        <!-- Section 4 -->
        <article id="ai-content" class="space-y-4 border-b border-border-warm/60 pb-8">
          <h2 class="font-headline-md text-headline-md text-deep-forest font-bold flex items-center gap-2.5">
            <span class="w-8 h-8 rounded-lg bg-primary-fixed/50 text-deep-forest font-mono text-sm flex items-center justify-center font-bold">4</span>
            <span><?= e(ps_text('कृत्रिम बुद्धिमत्ता नीति (AI-Assisted Content Policy)', 'AI-Assisted Content Policy')) ?></span>
          </h2>
          <p>
            <?= e(ps_text('लेखक अनुसंधान सहायता या भाषा सुधार हेतु AI टूल्स का उपयोग कर सकते हैं। हालांकि, सभी AI-जनरेटेड तथ्यों की मानव द्वारा पुष्टि की जानी चाहिए। काल्पनिक संदर्भ या झूठे उद्धरण पूर्णतः निषिद्ध हैं।', 'AI tools may assist with research or formatting, but all facts must be verified by a human author. Fabricated AI sources are strictly prohibited.')) ?>
          </p>
        </article>

        <!-- Section 5 -->
        <article id="sources" class="space-y-4 border-b border-border-warm/60 pb-8">
          <h2 class="font-headline-md text-headline-md text-deep-forest font-bold flex items-center gap-2.5">
            <span class="w-8 h-8 rounded-lg bg-primary-fixed/50 text-deep-forest font-mono text-sm flex items-center justify-center font-bold">5</span>
            <span><?= e(ps_text('स्रोत एवं संदर्भ (Sources and Attribution)', 'Sources and Attribution')) ?></span>
          </h2>
          <p>
            <?= e(ps_text('महत्वपूर्ण आंकड़ों, सरकारी शोधों या संस्थागत दावों के लिए प्रामाणिक स्रोतों का संदर्भ दिया जाना चाहिए। अफवाहों या असत्यापित सोशल मीडिया दावों को तथ्य के रूप में प्रस्तुत न करें।', 'Articles relying on research or statistics must cite credible sources such as official documents, academic studies, or recognized institutions.')) ?>
          </p>
        </article>

        <!-- Section 6 -->
        <article id="corrections" class="space-y-4 border-b border-border-warm/60 pb-8">
          <h2 class="font-headline-md text-headline-md text-deep-forest font-bold flex items-center gap-2.5">
            <span class="w-8 h-8 rounded-lg bg-primary-fixed/50 text-deep-forest font-mono text-sm flex items-center justify-center font-bold">6</span>
            <span><?= e(ps_text('त्रुटि सुधार नीति (Corrections Policy)', 'Corrections Policy')) ?></span>
          </h2>
          <p>
            <?= e(ps_text('यदि किसी आलेख में कोई गंभीर तथ्यात्मक त्रुटि पाई जाती है, तो हम तुरंत आलेख को अद्यतन करेंगे और आवश्यक होने पर सुधार टिप्पणी (Correction Note) जोड़ेंगे।', 'When a material factual error is identified, we promptly update the article and add a correction note where appropriate.')) ?>
          </p>
        </article>

        <!-- Section 8: Advertising Separation -->
        <article id="separation" class="space-y-4 border-b border-border-warm/60 pb-8">
          <h2 class="font-headline-md text-headline-md text-deep-forest font-bold flex items-center gap-2.5">
            <span class="w-8 h-8 rounded-lg bg-primary-fixed/50 text-deep-forest font-mono text-sm flex items-center justify-center font-bold">8</span>
            <span><?= e(ps_text('विज्ञापन और संपादकीय का पृथक्करण (Advertising Separation - Google AdSense)', 'Advertising & Editorial Separation')) ?></span>
          </h2>
          <p>
            <?= e(ps_text('गूगल एडसेंस नीतियों के अनुपालन में, विज्ञापन और सम्पादकीय सामग्री स्पष्ट रूप से भिन्न रहती है। विज्ञापनों को इस प्रकार नहीं रखा जाता जिससे पाठक भ्रमित होकर उन्हें नेविगेशन बटन या सम्पादकीय सिफारिश समझ लें।', 'In compliance with Google Publisher Policies, advertisements are distinctly separated from editorial content to prevent misleading clicks.')) ?>
          </p>
        </article>

        <!-- Section 9: Prohibited -->
        <article id="prohibited" class="space-y-4 border-b border-border-warm/60 pb-8">
          <h2 class="font-headline-md text-headline-md text-deep-forest font-bold flex items-center gap-2.5">
            <span class="w-8 h-8 rounded-lg bg-primary-fixed/50 text-deep-forest font-mono text-sm flex items-center justify-center font-bold">9</span>
            <span><?= e(ps_text('निषिद्ध संपादकीय सामग्री (Prohibited Content)', 'Prohibited Content')) ?></span>
          </h2>
          <p>
            <?= e(ps_text('हम प्लेगियारिज़्म, घृणास्पद भाषा, भ्रामक दावों, गैर-कानूनी गतिविधियों या गूगल प्रकाशक नीतियों का उल्लंघन करने वाली किसी भी सामग्री को तुरंत अस्वीकृत या निरस्त कर देते हैं।', 'We reject or remove content involving copyright infringement, hate speech, illegal services, or Google Publisher Policy violations.')) ?>
          </p>
        </article>

        <!-- Section 10: Complaints -->
        <article id="complaints" class="space-y-4 bg-pure-white p-7 rounded-2xl border border-border-warm shadow-sm">
          <h2 class="font-headline-md text-headline-md text-deep-forest font-bold flex items-center gap-2">
            <span class="material-symbols-outlined text-primary-container text-[24px]">mark_email_unread</span>
            <span><?= e(ps_text('संपादकीय प्रतिक्रिया व शिकायतें (Editorial Feedback & Complaints)', 'Editorial Complaints')) ?></span>
          </h2>
          <p><?= e(ps_text('संपादकीय चिंताओं या त्रुटि रिपोर्ट के लिए सम्पादकीय टीम से संपर्क करें:', 'For editorial concerns, corrections, or complaints, please reach out to our editorial desk:')) ?></p>
          <div class="space-y-2 font-body-md text-deep-forest pt-2">
            <div><strong>संपादकीय डेस्क:</strong> <a href="mailto:<?= e($editorialEmail) ?>" class="text-primary font-semibold underline"><?= e($editorialEmail) ?></a></div>
            <div><strong>सामान्य संपर्क:</strong> <a href="mailto:<?= e($email) ?>" class="text-primary underline"><?= e($email) ?></a></div>
          </div>
        </article>

      </main>

    </div>
  </section>
</div>
