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
        <span class="text-deep-forest font-semibold"><?= e(ps_text('लेखक दिशा-निर्देश', 'Author Guidelines')) ?></span>
      </nav>

      <div class="flex flex-col space-y-3 max-w-4xl">
        <div class="inline-flex items-center gap-2 self-start bg-primary-fixed/40 text-deep-forest px-3.5 py-1 rounded-full font-label-sm text-label-sm border border-border-warm font-semibold">
          <span class="material-symbols-outlined text-[16px] text-primary-container">draw</span>
          <span><?= e(ps_text('लेखन एवं योगदान नियम', 'Writing & Contribution Standards')) ?></span>
        </div>
        <h1 class="font-display-hero text-headline-lg md:text-display-hero text-deep-forest font-bold tracking-tight">
          <?= e(ps_text('लेखक दिशा-निर्देश (Author Guidelines)', 'Author Guidelines')) ?>
        </h1>
        <p class="font-body-lg text-body-lg text-text-muted leading-relaxed">
          <?= e(ps_text('यह दिशा-निर्देश ' . $siteName . ' पर आलेख प्रस्तुत करने वाले सभी पंजीकृत लेखकों, अतिथि विचारकों और योगदानकर्ताओं पर लागू होते हैं।', 'These guidelines apply to registered authors, guest contributors, and writers submitting articles for publication.')) ?>
        </p>
        <div class="pt-2 text-label-md text-label-md text-text-muted flex items-center gap-2">
          <span class="material-symbols-outlined text-[18px] text-tertiary-fixed">event_available</span>
          <span><?= e(ps_text('अंतिम अद्यतन: ' . $lastUpdated, 'Last Updated: ' . $lastUpdated)) ?></span>
        </div>
      </div>
    </div>
  </div>

  <!-- Main Content -->
  <section class="max-w-container-max mx-auto px-4 sm:px-8 py-space-3xl">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
      
      <!-- Sidebar -->
      <aside class="lg:col-span-4 hidden lg:block">
        <div class="sticky top-28 bg-pure-white p-6 rounded-2xl border border-border-warm shadow-xs space-y-3">
          <h3 class="font-title-md text-title-md text-deep-forest font-bold pb-2 border-b border-border-warm flex items-center gap-2">
            <span class="material-symbols-outlined text-primary-container text-[20px]">edit_note</span>
            <span><?= e(ps_text('दिशा-निर्देश सूची', 'Guidelines Index')) ?></span>
          </h3>
          <nav class="flex flex-col space-y-2 font-body-sm text-body-sm text-text-muted">
            <a href="#standards" class="hover:text-primary transition-colors py-1">1. न्यूनतम आलेख मानक</a>
            <a href="#originality" class="hover:text-primary transition-colors py-1">2. मौलिकता की आवश्यकता</a>
            <a href="#structure" class="hover:text-primary transition-colors py-1">3. अनुशंसित आलेख संरचना</a>
            <a href="#headlines" class="hover:text-primary transition-colors py-1">4. शीर्षकों के नियम (No Clickbait)</a>
            <a href="#ai-guidelines" class="hover:text-primary transition-colors py-1">5. AI टूल्स का उपयोग</a>
            <a href="#adsense-rules" class="hover:text-primary transition-colors py-1">6. एडसेंस व विज्ञापन नियम</a>
            <a href="#checklist" class="hover:text-primary transition-colors py-1">7. सबमिशन चेकलिस्ट</a>
            <a href="#contact" class="hover:text-primary transition-colors py-1">8. सम्पादकीय संपर्क</a>
          </nav>
        </div>
      </aside>

      <!-- Main Body -->
      <main class="lg:col-span-8 flex flex-col space-y-10 font-body-md text-body-md text-on-surface leading-relaxed">

        <!-- Info Note Box -->
        <div class="bg-soft-meadow border border-border-warm p-6 rounded-2xl flex items-start gap-4">
          <span class="material-symbols-outlined text-primary-container text-[28px] shrink-0">edit</span>
          <p class="font-body-md text-deep-forest">
            <?= e(ps_text('साहित्य, अवधी संस्कृति, पर्यावरण और सामाजिक चेतना पर उच्च गुणवत्ता वाले लेखकों का स्वागत है। कृपया आलेख प्रस्तुत करने से पूर्व निम्नलिखित नियमों का ध्यानपूर्वक अध्ययन करें।', 'Thank you for contributing to Pradeep Sarang platform. Please read these minimum standards before submitting articles.')) ?>
          </p>
        </div>

        <!-- Section 1 -->
        <article id="standards" class="space-y-4 border-b border-border-warm/60 pb-8">
          <h2 class="font-headline-md text-headline-md text-deep-forest font-bold flex items-center gap-2.5">
            <span class="w-8 h-8 rounded-lg bg-primary-fixed/50 text-deep-forest font-mono text-sm flex items-center justify-center font-bold">1</span>
            <span><?= e(ps_text('न्यूनतम आलेख मानक (Minimum Article Standards)', 'Minimum Article Standards')) ?></span>
          </h2>
          <p class="font-semibold text-deep-forest">प्रत्येक प्रस्तुत आलेख में होना चाहिए:</p>
          <ul class="list-disc pl-6 space-y-2 text-text-muted">
            <li>स्पष्ट उद्देश्य और सुपाठ्य भाषा शैली</li>
            <li>मानव पाठकों के लिए स्वाभाविक और ज्ञानवर्धक प्रस्तुति</li>
            <li>सटीक एवं प्रासंगिक शीर्षक तथा उप-शीर्षक (Headings)</li>
            <li>तथ्यात्मक जिम्मेदारी और मौलिक विचार</li>
          </ul>
        </article>

        <!-- Section 2 -->
        <article id="originality" class="space-y-4 border-b border-border-warm/60 pb-8">
          <h2 class="font-headline-md text-headline-md text-deep-forest font-bold flex items-center gap-2.5">
            <span class="w-8 h-8 rounded-lg bg-primary-fixed/50 text-deep-forest font-mono text-sm flex items-center justify-center font-bold">2</span>
            <span><?= e(ps_text('मौलिकता की अनिवार्य शर्त (Originality Requirement)', 'Originality Requirement')) ?></span>
          </h2>
          <p>
            लेखकों को केवल अपनी मूल रचनाएँ प्रस्तुत करनी चाहिए। अन्य पत्र-पत्रिकाओं, वेबसाइटों या स्रोतों से बिना अनुमति कॉपी की गई सामग्री, स्पैनिंग या अनधिकृत अनुवाद प्रस्तुत न करें।
          </p>
        </article>

        <!-- Section 3 -->
        <article id="structure" class="space-y-4 border-b border-border-warm/60 pb-8">
          <h2 class="font-headline-md text-headline-md text-deep-forest font-bold flex items-center gap-2.5">
            <span class="w-8 h-8 rounded-lg bg-primary-fixed/50 text-deep-forest font-mono text-sm flex items-center justify-center font-bold">3</span>
            <span><?= e(ps_text('अनुशंसित आलेख संरचना (Recommended Article Structure)', 'Recommended Article Structure')) ?></span>
          </h2>
          <div class="space-y-3 font-body-sm bg-pure-white p-5 rounded-xl border border-border-warm">
            <div><strong class="text-deep-forest">1. शीर्षक (Title):</strong> स्पष्ट और आकर्षक विषय शीर्षक।</div>
            <div><strong class="text-deep-forest">2. भूमिका (Introduction):</strong> 2-3 पंक्तियों में आलेख का सार।</div>
            <div><strong class="text-deep-forest">3. मुख्य भाग (Main Body):</strong> तार्किक अनुच्छेदों और उप-शीर्षकों (Subheadings) में विभाजित विवरण।</div>
            <div><strong class="text-deep-forest">4. निष्कर्ष (Conclusion):</strong> आलेख का मुख्य संदेश।</div>
            <div><strong class="text-deep-forest">5. स्रोत (Sources):</strong> प्रयुक्त शोध, आंकड़ों या संदर्भों की सूची।</div>
          </div>
        </article>

        <!-- Section 4 -->
        <article id="headlines" class="space-y-4 border-b border-border-warm/60 pb-8">
          <h2 class="font-headline-md text-headline-md text-deep-forest font-bold flex items-center gap-2.5">
            <span class="w-8 h-8 rounded-lg bg-primary-fixed/50 text-deep-forest font-mono text-sm flex items-center justify-center font-bold">4</span>
            <span><?= e(ps_text('शीर्षकों के नियम (No Clickbait Headlines)', 'Headline Rules')) ?></span>
          </h2>
          <p>
            शीर्षक भ्रामक या क्लिकबेट (Clickbait) नहीं होने चाहिए। जो दाावे शीर्षक में किए जाएँ, उनका विवरण आलेख में प्रस्तुत होना चाहिए।
          </p>
        </article>

        <!-- Section 5 -->
        <article id="ai-guidelines" class="space-y-4 border-b border-border-warm/60 pb-8">
          <h2 class="font-headline-md text-headline-md text-deep-forest font-bold flex items-center gap-2.5">
            <span class="w-8 h-8 rounded-lg bg-primary-fixed/50 text-deep-forest font-mono text-sm flex items-center justify-center font-bold">5</span>
            <span><?= e(ps_text('AI टूल्स का उपयोग (AI Usage Guidelines)', 'AI Usage Guidelines')) ?></span>
          </h2>
          <p>
            AI टूल्स का उपयोग केवल व्याकरण सुधार या आउटलाइन संरचना के लिए किया जा सकता है। अंतिम जिम्मेदारी लेखक की होगी। काल्पनिक आंकड़े या फर्जी स्रोत प्रस्तुत करना प्रतिबंधित है।
          </p>
        </article>

        <!-- Section 6: AdSense Rules for Authors -->
        <article id="adsense-rules" class="space-y-4 border-b border-border-warm/60 pb-8">
          <h2 class="font-headline-md text-headline-md text-deep-forest font-bold flex items-center gap-2.5">
            <span class="w-8 h-8 rounded-lg bg-primary-fixed/50 text-deep-forest font-mono text-sm flex items-center justify-center font-bold">6</span>
            <span><?= e(ps_text('एडसेंस एवं विज्ञापन नियम (Google AdSense Rules for Authors)', 'Google AdSense Rules for Authors')) ?></span>
          </h2>
          <div class="p-5 rounded-xl bg-soft-meadow border border-border-warm space-y-2">
            <h4 class="font-title-md text-title-md text-deep-forest font-bold">कड़ा निषेध (Strict Prohibitions):</h4>
            <ul class="list-disc pl-6 space-y-1.5 text-text-muted text-body-sm">
              <li>पाठकों को विज्ञापनों पर क्लिक करने का आग्रह कभी न करें।</li>
              <li>विज्ञापनों के आसपास भ्रामक तीर या टेक्स्ट न लगाएं।</li>
              <li>कृत्रिम रूप से पेज रिफ्रेश या इंप्रेशन बढ़ाने का प्रयास न करें।</li>
              <li>गूगल प्रकाशक नीतियों का उल्लंघन करने वाले विषयों पर न लिखें।</li>
            </ul>
          </div>
        </article>

        <!-- Section 7: Submission Checklist -->
        <article id="checklist" class="space-y-4 border-b border-border-warm/60 pb-8">
          <h2 class="font-headline-md text-headline-md text-deep-forest font-bold flex items-center gap-2.5">
            <span class="w-8 h-8 rounded-lg bg-primary-fixed/50 text-deep-forest font-mono text-sm flex items-center justify-center font-bold">7</span>
            <span><?= e(ps_text('सबमिशन चेकलिस्ट (Pre-Submission Checklist)', 'Pre-Submission Checklist')) ?></span>
          </h2>
          <div class="space-y-2 bg-pure-white p-5 rounded-xl border border-border-warm font-body-sm text-deep-forest">
            <div class="flex items-center gap-2"><span class="material-symbols-outlined text-success text-[18px]">check_circle</span> <span>आलेख पूर्णतः मौलिक है।</span></div>
            <div class="flex items-center gap-2"><span class="material-symbols-outlined text-success text-[18px]">check_circle</span> <span>शीर्षक आलेख का सही वर्णन करता है।</span></div>
            <div class="flex items-center gap-2"><span class="material-symbols-outlined text-success text-[18px]">check_circle</span> <span>तथ्यों की पुष्टि कर ली गई है।</span></div>
            <div class="flex items-center gap-2"><span class="material-symbols-outlined text-success text-[18px]">check_circle</span> <span>इस्तेमाल की गई छवियों के अधिकार आपके पास हैं।</span></div>
            <div class="flex items-center gap-2"><span class="material-symbols-outlined text-success text-[18px]">check_circle</span> <span>व्यावसायिक या एफिलिएट संबंधों का प्रकटीकरण किया गया है।</span></div>
          </div>
        </article>

        <!-- Section 8: Contact -->
        <article id="contact" class="space-y-4 bg-pure-white p-7 rounded-2xl border border-border-warm shadow-sm">
          <h2 class="font-headline-md text-headline-md text-deep-forest font-bold flex items-center gap-2">
            <span class="material-symbols-outlined text-primary-container text-[24px]">send</span>
            <span><?= e(ps_text('सम्पादकीय टीम से संपर्क करें', 'Contact Editorial Team')) ?></span>
          </h2>
          <p>लेखन संबंधी प्रश्न या आलेख प्रस्ताव के लिए ईमेल करें:</p>
          <div class="space-y-1.5 font-body-md text-deep-forest pt-1">
            <div><strong>सम्पादकीय ईमेल:</strong> <a href="mailto:<?= e($editorialEmail) ?>" class="text-primary underline"><?= e($editorialEmail) ?></a></div>
          </div>
        </article>

      </main>

    </div>
  </section>
</div>
