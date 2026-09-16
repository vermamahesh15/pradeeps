<?php
declare(strict_types=1);

$item = $item ?? [];
$events = $events ?? [];
$title = $item['title'] ?? ps_text('कार्यक्रम विवरण', 'Event Detail');
$eventDateStr = $item['event_date'] ?? date('Y-m-d');
$stamp = strtotime($eventDateStr);
$todayStr = date('Y-m-d');
$isPast = $eventDateStr < $todayStr;

$image = ps_resolve_img($item['image'] ?? '', 'assets/images/slider_final_1.webp');
$excerpt = !empty($item['excerpt']) ? $item['excerpt'] : ps_text('राष्ट्रनायक सरदार वल्लभभाई पटेल जयंती के अवसर पर ग्रामीण स्वावलंबन, किसान सम्मान एवं सामाजिक सद्भाव महारैली।', 'A grand rally for rural self-reliance, farmer honor, and social harmony on the occasion of Sardar Vallabhbhai Patel Jayanti.');
$location = !empty($item['location']) ? $item['location'] : ps_text('बाराबंकी (उ.प्र.)', 'Barabanki (U.P.)');

$contentHtml = !empty($item['content']) ? ps_rich_text($item['content']) : null;
?>

<div class="flex flex-col w-full bg-surface-bright text-on-surface min-h-screen">

  <!-- HERO SECTION -->
  <section class="relative w-full bg-gradient-to-b from-soft-meadow via-soft-meadow/60 to-surface-bright border-b border-border-warm py-8 md:py-12">
    <div class="max-w-container-max mx-auto px-4 sm:px-6 lg:px-8">
      
      <!-- Breadcrumb Navigation -->
      <nav aria-label="Breadcrumb" class="flex items-center gap-2 text-sm text-text-muted mb-4 font-medium flex-wrap">
        <a href="<?= e(base_url('/')) ?>" class="hover:text-primary transition-colors flex items-center gap-1">
          <span class="material-symbols-outlined text-[18px]">home</span>
          <span><?= e(ps_text('गृह', 'Home')) ?></span>
        </a>
        <span class="opacity-40">/</span>
        <a href="<?= e(base_url('/events')) ?>" class="hover:text-primary transition-colors">
          <span><?= e(ps_text('कार्यक्रम व गतिविधियाँ', 'Events')) ?></span>
        </a>
        <span class="opacity-40">/</span>
        <span class="text-deep-forest font-semibold truncate max-w-[200px] sm:max-w-xs"><?= e($title) ?></span>
      </nav>

      <!-- Event Header Box -->
      <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
        <div class="lg:col-span-8 flex flex-col">
          
          <!-- Badges -->
          <div class="flex flex-wrap items-center gap-2.5 mb-3">
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider <?= $isPast ? 'bg-amber-100 text-amber-900 border border-amber-300' : 'bg-emerald-100 text-emerald-900 border border-emerald-300' ?>">
              <span class="w-2 h-2 rounded-full <?= $isPast ? 'bg-amber-600' : 'bg-emerald-600 animate-pulse' ?>"></span>
              <?= e($isPast ? ps_text('संपन्न कार्यक्रम', 'Completed Event') : ps_text('आगामी कार्यक्रम', 'Upcoming Event')) ?>
            </span>
            <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-semibold bg-primary-fixed/40 text-deep-forest border border-border-warm">
              <span class="material-symbols-outlined text-[15px]">campaign</span>
              <span><?= e(ps_text('प्रदीप सारंग की पहल', 'Pradeep Sarang Initiative')) ?></span>
            </span>
          </div>

          <!-- Main Title -->
          <h1 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-bold text-deep-forest leading-tight tracking-tight mb-4 font-display-hero">
            <?= e($title) ?>
          </h1>

          <!-- Summary Excerpt -->
          <p class="text-base sm:text-lg text-text-muted leading-relaxed mb-6 font-body-lg">
            <?= e($excerpt) ?>
          </p>

          <!-- Key Metadata Pills -->
          <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 p-4 bg-white/80 backdrop-blur-sm rounded-xl border border-border-warm shadow-sm mb-6">
            <div class="flex items-center gap-3">
              <div class="w-10 h-10 rounded-lg bg-primary/10 text-primary flex items-center justify-center shrink-0">
                <span class="material-symbols-outlined">calendar_month</span>
              </div>
              <div class="flex flex-col">
                <span class="text-xs text-text-muted uppercase font-semibold tracking-wider"><?= e(ps_text('दिनांक', 'Date')) ?></span>
                <span class="text-sm font-bold text-deep-forest"><?= e(date('d F Y', $stamp)) ?></span>
              </div>
            </div>

            <div class="flex items-center gap-3">
              <div class="w-10 h-10 rounded-lg bg-secondary/10 text-secondary flex items-center justify-center shrink-0">
                <span class="material-symbols-outlined">location_on</span>
              </div>
              <div class="flex flex-col min-w-0">
                <span class="text-xs text-text-muted uppercase font-semibold tracking-wider"><?= e(ps_text('स्थान', 'Location')) ?></span>
                <span class="text-sm font-bold text-deep-forest truncate"><?= e($location) ?></span>
              </div>
            </div>

            <div class="flex items-center gap-3">
              <div class="w-10 h-10 rounded-lg bg-emerald-50 text-emerald-700 flex items-center justify-center shrink-0">
                <span class="material-symbols-outlined">person</span>
              </div>
              <div class="flex flex-col">
                <span class="text-xs text-text-muted uppercase font-semibold tracking-wider"><?= e(ps_text('आयोजक', 'Organizer')) ?></span>
                <span class="text-sm font-bold text-deep-forest"><?= e(ps_text('प्रदीप सारंग व सहयोगी', 'Pradeep Sarang & Team')) ?></span>
              </div>
            </div>
          </div>

          <!-- Hero Action Buttons -->
          <div class="flex flex-wrap items-center gap-3">
            <a href="https://api.whatsapp.com/send?phone=919919007190&text=<?= urlencode('नमस्कार प्रदीप सारंग जी, मैं कार्यक्रम "' . $title . '" के संबंध में जानकारी व सहभागिता दर्ज कराना चाहता/चाहती हूँ।') ?>" target="_blank" rel="noopener" class="inline-flex items-center gap-2 bg-[#25D366] hover:bg-[#1DA851] text-white px-5 py-2.5 rounded-xl font-bold text-sm shadow-sm transition-all transform hover:-translate-y-0.5">
              <i class="fa-brands fa-whatsapp text-lg"></i>
              <span><?= e(ps_text('WhatsApp पर सहभागिता दर्ज करें', 'Join via WhatsApp')) ?></span>
            </a>

            <a href="#event-content" class="inline-flex items-center gap-2 bg-deep-forest hover:bg-deep-forest/90 text-white px-5 py-2.5 rounded-xl font-semibold text-sm shadow-sm transition-colors">
              <span class="material-symbols-outlined text-[18px]">menu_book</span>
              <span><?= e(ps_text('विस्तृत विवरण पढ़ें', 'Read Event Details')) ?></span>
            </a>
          </div>

        </div>

        <!-- Right Quick Highlight Box -->
        <div class="lg:col-span-4">
          <div class="bg-white rounded-2xl p-5 border border-border-warm shadow-md flex flex-col gap-4">
            <div class="flex items-center gap-3 pb-3 border-b border-border-warm">
              <div class="w-12 h-12 rounded-xl bg-amber-50 text-amber-700 border border-amber-200 flex flex-col items-center justify-center shrink-0 font-bold">
                <span class="text-xs uppercase tracking-tight leading-none"><?= e(date('M', $stamp)) ?></span>
                <span class="text-lg leading-none mt-0.5"><?= e(date('d', $stamp)) ?></span>
              </div>
              <div class="flex flex-col min-w-0">
                <span class="text-xs text-amber-800 font-semibold uppercase tracking-wider"><?= e(date('l', $stamp)) ?></span>
                <h3 class="text-sm font-bold text-deep-forest truncate"><?= e($title) ?></h3>
              </div>
            </div>

            <div class="space-y-2.5 text-xs">
              <div class="flex items-start gap-2.5 text-text-muted">
                <span class="material-symbols-outlined text-primary text-[18px] shrink-0 mt-0.5">verified</span>
                <span><?= e(ps_text('सामाजिक समरसता, किसान सम्मान एवं लोक कला प्रोत्साहन अभियान।', 'Social harmony, farmer honor, and folk art promotion initiative.')) ?></span>
              </div>
              <div class="flex items-start gap-2.5 text-text-muted">
                <span class="material-symbols-outlined text-secondary text-[18px] shrink-0 mt-0.5">groups</span>
                <span><?= e(ps_text('ग्रामीण प्रतिनिधि, साहित्य प्रेमी एवं युवा साथी आमंत्रित।', 'Rural representatives, literature lovers, and youth invitees.')) ?></span>
              </div>
              <div class="flex items-start gap-2.5 text-text-muted">
                <span class="material-symbols-outlined text-emerald-600 text-[18px] shrink-0 mt-0.5">call</span>
                <span><?= e(ps_text('हेल्पलाइन: +91 9919007190', 'Helpline: +91 9919007190')) ?></span>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>
  </section>

  <!-- MAIN BODY CONTENT & SIDEBAR -->
  <section id="event-content" class="py-10 md:py-16">
    <div class="max-w-container-max mx-auto px-4 sm:px-6 lg:px-8">
      
      <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">

        <!-- Left Column: Detailed Content (8 cols) -->
        <div class="lg:col-span-8 space-y-8">
          
          <!-- HD Cover Image Container -->
          <div class="relative rounded-2xl overflow-hidden shadow-lg bg-surface-container border border-border-warm group">
            <img src="<?= e($image) ?>" alt="<?= e($title) ?>" class="w-full max-h-[480px] object-cover transition-transform duration-500 group-hover:scale-105">
            <div class="absolute bottom-0 inset-x-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent p-4 text-white flex justify-between items-end">
              <div>
                <p class="font-bold text-sm sm:text-base leading-snug"><?= e($title) ?></p>
                <p class="text-xs text-white/80"><i class="fa-solid fa-location-dot me-1 text-amber-400"></i><?= e($location) ?></p>
              </div>
              <a href="<?= e($image) ?>" target="_blank" class="inline-flex items-center gap-1 text-xs bg-white/20 hover:bg-white/40 backdrop-blur-md text-white px-3 py-1.5 rounded-lg border border-white/30 transition-colors">
                <span class="material-symbols-outlined text-[15px]">fullscreen</span>
                <span><?= e(ps_text('बड़ा देखें', 'Zoom Image')) ?></span>
              </a>
            </div>
          </div>

          <!-- Emotive Quote Banner by Pradeep Sarang -->
          <div class="relative bg-soft-meadow rounded-2xl p-6 border border-border-warm shadow-sm">
            <div class="absolute left-0 top-0 bottom-0 w-2 bg-primary rounded-l-2xl"></div>
            <span class="material-symbols-outlined text-primary/20 text-5xl absolute right-4 top-3 select-none">format_quote</span>
            <p class="text-deep-forest font-serif italic text-base sm:text-lg leading-relaxed mb-4 pr-6">
              <?= ps_text('"ग्रामीण जीवन की चेतना, किसानों की आत्मनिर्भरता और राष्ट्रनायकों का विचार ही हमारे समाज की असली शक्ति है। इस यात्रा के माध्यम से हम हर गांव में सद्भाव और स्वावलंबन का दीप प्रज्वलित कर रहे हैं।"', '"The consciousness of rural life, the self-reliance of farmers, and the ideology of national heroes are the true strength of our society. Through this yatra, we are lighting the lamp of harmony in every village."') ?>
            </p>
            <div class="flex items-center gap-3">
              <div class="w-10 h-10 rounded-full bg-primary text-white font-bold flex items-center justify-center shadow-sm">
                <span>PS</span>
              </div>
              <div class="flex flex-col">
                <span class="font-bold text-deep-forest text-sm"><?= e(ps_text('प्रदीप सारंग', 'Pradeep Sarang')) ?></span>
                <span class="text-xs text-text-muted"><?= e(ps_text('संयोजक व कवि, अवध भारती', 'Convenor & Poet, Awadh Bharati')) ?></span>
              </div>
            </div>
          </div>

          <!-- Rich Text Narrative -->
          <div class="bg-white rounded-2xl p-6 sm:p-8 border border-border-warm shadow-sm space-y-6">
            <h2 class="text-xl sm:text-2xl font-bold text-deep-forest border-b border-border-warm pb-3 flex items-center gap-2">
              <span class="material-symbols-outlined text-primary">description</span>
              <span><?= e(ps_text('कार्यक्रम का मुख्य उद्देश्य व रूपरेखा', 'Event Overview & Objectives')) ?></span>
            </h2>

            <?php if ($contentHtml): ?>
              <div class="prose prose-emerald max-w-none text-text-muted leading-relaxed font-body-lg">
                <?= $contentHtml ?>
              </div>
            <?php else: ?>
              <div class="space-y-4 text-text-muted leading-relaxed">
                <p>
                  <?= e(ps_text('राष्ट्रनायक सरदार वल्लभभाई पटेल जी की अमर स्मृति और उनके विचारों को जन-जन तक पहुँचाने के उद्देश्य से बाराबंकी अंचल में भव्य चेतना यात्रा एवं ग्राम चौपाल का आयोजन किया जा रहा है।', 'A grand awareness rally and village assembly (Gram Chaupal) is being organized across Barabanki region to propagate the ideology of Sardar Vallabhbhai Patel.')) ?>
                </p>
                <p>
                  <?= e(ps_text('इस कार्यक्रम के अंतर्गत ग्रामीण क्षेत्रों में किसानों का अभिनंदन, पौधरोपण संदेश, अवधी लोक साहित्य चर्चा एवं सामाजिक समरसता की दिशा में सार्थक संवाद स्थापित किया जाएगा। प्रदीप सारंग एवं प्रबुद्ध नागरिक इस जन-चौपाल के माध्यम से ग्रामीण स्वावलंबन और पर्यावरण चेतना पर अपने विचार साझा करेंगे।', 'This initiative features farmer felicitations, tree-planting drives, Awadhi folk literature discussions, and social harmony dialogues led by Pradeep Sarang and esteemed community leaders.')) ?>
                </p>
              </div>
            <?php endif; ?>



          </div>

          <!-- Social Share Bar -->
          <div class="bg-white rounded-2xl p-5 border border-border-warm shadow-sm flex flex-col sm:flex-row items-center justify-between gap-4">
            <span class="font-bold text-sm text-deep-forest flex items-center gap-2">
              <span class="material-symbols-outlined text-primary">share</span>
              <span><?= e(ps_text('इस कार्यक्रम को साझा करें:', 'Share this Event:')) ?></span>
            </span>

            <div class="flex items-center gap-2">
              <a href="https://api.whatsapp.com/send?text=<?= urlencode($title . ' - ' . base_url('/events/' . $item['slug'])) ?>" target="_blank" rel="noopener" class="w-9 h-9 rounded-full bg-[#25D366] text-white flex items-center justify-center hover:opacity-90 transition-opacity" title="WhatsApp">
                <i class="fa-brands fa-whatsapp text-lg"></i>
              </a>
              <a href="https://www.facebook.com/sharer/sharer.php?u=<?= urlencode(base_url('/events/' . $item['slug'])) ?>" target="_blank" rel="noopener" class="w-9 h-9 rounded-full bg-[#1877F2] text-white flex items-center justify-center hover:opacity-90 transition-opacity" title="Facebook">
                <i class="fa-brands fa-facebook-f text-base"></i>
              </a>
              <a href="https://twitter.com/intent/tweet?url=<?= urlencode(base_url('/events/' . $item['slug'])) ?>&text=<?= urlencode($title) ?>" target="_blank" rel="noopener" class="w-9 h-9 rounded-full bg-[#1DA1F2] text-white flex items-center justify-center hover:opacity-90 transition-opacity" title="Twitter / X">
                <i class="fa-brands fa-x-twitter text-base"></i>
              </a>
              <button onclick="navigator.clipboard.writeText(window.location.href); alert('<?= e(ps_text('लिंक कॉपी हो गया!', 'Link copied to clipboard!')) ?>');" class="w-9 h-9 rounded-full bg-gray-100 text-gray-700 hover:bg-gray-200 flex items-center justify-center transition-colors" title="Copy Link">
                <span class="material-symbols-outlined text-[18px]">link</span>
              </button>
            </div>
          </div>

        </div>

        <!-- Right Column: Sticky Sidebar (4 cols) -->
        <div class="lg:col-span-4 space-y-6">
          
          <div class="sticky top-24 space-y-6">

            <!-- Card 1: Event Summary Badge -->
            <div class="bg-white rounded-2xl p-6 border border-border-warm shadow-md space-y-5">
              <h3 class="text-base font-bold text-deep-forest border-b border-border-warm pb-3 flex items-center justify-between">
                <span><?= e(ps_text('आयोजन संक्षेप', 'Event Summary')) ?></span>
                <span class="text-xs font-normal px-2.5 py-0.5 rounded-full <?= $isPast ? 'bg-amber-100 text-amber-900' : 'bg-emerald-100 text-emerald-900' ?>">
                  <?= e($isPast ? ps_text('संपन्न', 'Past') : ps_text('आगामी', 'Upcoming')) ?>
                </span>
              </h3>

              <div class="space-y-4 text-sm">
                
                <div class="flex items-start gap-3">
                  <div class="w-8 h-8 rounded-lg bg-primary/10 text-primary flex items-center justify-center shrink-0 mt-0.5">
                    <span class="material-symbols-outlined text-[20px]">calendar_today</span>
                  </div>
                  <div>
                    <span class="block text-xs text-text-muted font-semibold uppercase"><?= e(ps_text('तारीख', 'Date')) ?></span>
                    <span class="font-bold text-deep-forest"><?= e(date('d F Y', $stamp)) ?></span>
                  </div>
                </div>

                <div class="flex items-start gap-3">
                  <div class="w-8 h-8 rounded-lg bg-secondary/10 text-secondary flex items-center justify-center shrink-0 mt-0.5">
                    <span class="material-symbols-outlined text-[20px]">pin_drop</span>
                  </div>
                  <div>
                    <span class="block text-xs text-text-muted font-semibold uppercase"><?= e(ps_text('स्थान व पता', 'Venue Address')) ?></span>
                    <span class="font-bold text-deep-forest block"><?= e($location) ?></span>
                  </div>
                </div>

                <div class="flex items-start gap-3">
                  <div class="w-8 h-8 rounded-lg bg-emerald-100 text-emerald-800 flex items-center justify-center shrink-0 mt-0.5">
                    <span class="material-symbols-outlined text-[20px]">person_pin</span>
                  </div>
                  <div>
                    <span class="block text-xs text-text-muted font-semibold uppercase"><?= e(ps_text('मुख्य संयोजक', 'Chief Organizer')) ?></span>
                    <span class="font-bold text-deep-forest"><?= e(ps_text('प्रदीप सारंग (बाराबंकी)', 'Pradeep Sarang (Barabanki)')) ?></span>
                  </div>
                </div>

              </div>

              <!-- Direct Call / WhatsApp Buttons -->
              <div class="pt-2 flex flex-col gap-2">
                <a href="https://api.whatsapp.com/send?phone=919919007190&text=<?= urlencode('नमस्कार, मुझे कार्यक्रम "' . $title . '" के विषय में जानकारी चाहिए।') ?>" target="_blank" rel="noopener" class="w-full inline-flex items-center justify-center gap-2 bg-[#25D366] hover:bg-[#1DA851] text-white font-bold py-2.5 px-4 rounded-xl text-sm transition-colors shadow-sm">
                  <i class="fa-brands fa-whatsapp text-lg"></i>
                  <span><?= e(ps_text('WhatsApp पर संपर्क करें', 'Chat on WhatsApp')) ?></span>
                </a>

                <a href="tel:+919919007190" class="w-full inline-flex items-center justify-center gap-2 bg-surface-container hover:bg-surface-container-high text-deep-forest font-semibold py-2.5 px-4 rounded-xl text-sm border border-border-warm transition-colors">
                  <span class="material-symbols-outlined text-[18px]">call</span>
                  <span>+91 9919007190</span>
                </a>
              </div>
            </div>

            <!-- Card 2: Quick RSVP / Registration Form -->
            <div class="bg-soft-meadow rounded-2xl p-6 border border-border-warm shadow-sm">
              <h3 class="text-base font-bold text-deep-forest mb-1 flex items-center gap-2">
                <span class="material-symbols-outlined text-primary">edit_note</span>
                <span><?= e(ps_text('सहभागिता पंजीयन', 'Quick Registration')) ?></span>
              </h3>
              <p class="text-xs text-text-muted mb-4"><?= e(ps_text('कार्यक्रम में उपस्थिति या जानकारी हेतु अपना विवरण दर्ज करें:', 'Fill your details to register or ask questions:')) ?></p>

              <form action="<?= e(base_url('/contact')) ?>" method="post" class="space-y-3">
                <input type="hidden" name="form_type" value="contact">
                <input type="hidden" name="subject" value="Event RSVP: <?= e($title) ?>">

                <div>
                  <input type="text" name="name" required class="w-full px-3.5 py-2 text-xs rounded-xl border border-border-warm bg-white focus:outline-none focus:border-primary">
                </div>

                <div>
                  <input type="tel" name="phone" required class="w-full px-3.5 py-2 text-xs rounded-xl border border-border-warm bg-white focus:outline-none focus:border-primary">
                </div>

                <div>
                  <textarea name="message" rows="2" class="w-full px-3.5 py-2 text-xs rounded-xl border border-border-warm bg-white focus:outline-none focus:border-primary"></textarea>
                </div>

                <button type="submit" class="w-full bg-primary hover:bg-deep-forest text-white font-bold py-2.5 px-4 rounded-xl text-xs shadow-sm transition-colors flex items-center justify-center gap-1.5">
                  <span class="material-symbols-outlined text-[16px]">send</span>
                  <span><?= e(ps_text('पंजीयन प्रेषित करें', 'Submit RSVP')) ?></span>
                </button>
              </form>
            </div>

            <!-- Card 3: Location / Venue Banner -->
            <div class="bg-white rounded-2xl p-5 border border-border-warm shadow-sm flex items-center gap-3">
              <div class="w-10 h-10 rounded-xl bg-amber-50 text-amber-700 flex items-center justify-center shrink-0">
                <span class="material-symbols-outlined text-[22px]">map</span>
              </div>
              <div class="flex flex-col min-w-0">
                <span class="text-xs font-bold text-deep-forest truncate"><?= e($location) ?></span>
                <a href="https://maps.google.com/?q=<?= urlencode($location) ?>" target="_blank" rel="noopener" class="text-xs text-primary hover:underline font-semibold flex items-center gap-0.5 mt-0.5">
                  <span><?= e(ps_text('गूगल मैप पर देखें', 'Open in Google Maps')) ?></span>
                  <span class="material-symbols-outlined text-[14px]">open_in_new</span>
                </a>
              </div>
            </div>

          </div>

        </div>

      </div>

    </div>
  </section>

  <!-- RELATED EVENTS SECTION -->
  <?php
  $otherEvents = array_values(array_filter($events, fn($e) => ($e['slug'] ?? '') !== ($item['slug'] ?? '')));
  if (!empty($otherEvents)):
  ?>
  <section class="py-12 bg-soft-meadow/60 border-t border-border-warm">
    <div class="max-w-container-max mx-auto px-4 sm:px-6 lg:px-8">
      
      <div class="flex items-center justify-between mb-8">
        <div>
          <span class="text-xs font-bold uppercase tracking-wider text-primary"><?= e(ps_text('अन्य गतिविधियाँ', 'More Events')) ?></span>
          <h2 class="text-xl sm:text-2xl font-bold text-deep-forest mt-1"><?= e(ps_text('हाल के अन्य जन-समारोह व अभियान', 'Recent Events & Campaigns')) ?></h2>
        </div>
        <a href="<?= e(base_url('/events')) ?>" class="inline-flex items-center gap-1 text-sm font-bold text-primary hover:text-deep-forest transition-colors">
          <span><?= e(ps_text('सभी देखें', 'View All')) ?></span>
          <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
        </a>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <?php foreach (array_slice($otherEvents, 0, 3) as $rel): 
          $relImg = ps_resolve_img($rel['image'] ?? '', 'assets/images/slider_final_1.webp');
          $relStamp = strtotime($rel['event_date'] ?? date('Y-m-d'));
        ?>
          <article class="bg-white rounded-2xl overflow-hidden border border-border-warm shadow-sm hover:shadow-md transition-shadow flex flex-col group">
            <div class="relative h-44 overflow-hidden bg-surface-container">
              <img src="<?= e($relImg) ?>" alt="<?= e($rel['title']) ?>" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
              <div class="absolute top-3 left-3 bg-white/90 backdrop-blur-md px-2.5 py-1 rounded-lg text-xs font-bold text-deep-forest border border-border-warm shadow-sm">
                <?= e(date('d M Y', $relStamp)) ?>
              </div>
            </div>
            <div class="p-5 flex flex-col flex-grow">
              <h3 class="font-bold text-base text-deep-forest group-hover:text-primary transition-colors line-clamp-2 mb-2">
                <a href="<?= e(base_url('/events/' . $rel['slug'])) ?>">
                  <?= e($rel['title']) ?>
                </a>
              </h3>
              <p class="text-xs text-text-muted line-clamp-2 mb-4 flex-grow">
                <?= e(ps_excerpt($rel, 120)) ?>
              </p>
              <div class="pt-3 border-t border-border-warm flex items-center justify-between text-xs font-semibold">
                <span class="text-text-muted flex items-center gap-1">
                  <span class="material-symbols-outlined text-[15px] text-amber-600">location_on</span>
                  <span class="truncate max-w-[120px]"><?= e($rel['location'] ?? 'Barabanki') ?></span>
                </span>
                <a href="<?= e(base_url('/events/' . $rel['slug'])) ?>" class="text-primary hover:text-deep-forest flex items-center gap-0.5">
                  <span><?= e(ps_text('विवरण', 'Details')) ?></span>
                  <span class="material-symbols-outlined text-[15px]">east</span>
                </a>
              </div>
            </div>
          </article>
        <?php endforeach; ?>
      </div>

    </div>
  </section>
  <?php endif; ?>

  <!-- BOTTOM COMMUNITY CALL TO ACTION -->
  <section class="py-12 bg-gradient-to-r from-deep-forest via-deep-forest/95 to-deep-forest text-white relative overflow-hidden">
    <div class="max-w-container-max mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
      <h2 class="text-2xl sm:text-3xl font-bold font-display-hero mb-3">
        <?= e(ps_text('प्रदीप सारंग के सामाजिक अभियानों से जुड़ें', 'Join Pradeep Sarang\'s Social Initiatives')) ?>
      </h2>
      <p class="text-sm sm:text-base text-white/80 max-w-2xl mx-auto mb-6">
        <?= e(ps_text('पर्यावरण संरक्षण, जल-सकोरा वितरण, अवधी साहित्य संवर्धन और ग्राम विकास चेतना यात्रा में अपनी सहभागिता निभाएं।', 'Contribute to environmental conservation, water bowl distribution, Awadhi literature promotion, and rural development yatras.')) ?>
      </p>
      
      <div class="flex flex-wrap items-center justify-center gap-4">
        <a href="https://api.whatsapp.com/send?phone=919919007190&text=<?= urlencode('नमस्कार प्रदीप सारंग जी, मैं सामाजिक व साहित्यिक गतिविधियों से जुड़ना चाहता/चाहती हूँ।') ?>" target="_blank" rel="noopener" class="inline-flex items-center gap-2 bg-[#25D366] hover:bg-[#1DA851] text-white px-6 py-3 rounded-xl font-bold text-sm shadow-md transition-all transform hover:-translate-y-0.5">
          <i class="fa-brands fa-whatsapp text-lg"></i>
          <span><?= e(ps_text('WhatsApp पर मैसेज करें', 'Message on WhatsApp')) ?></span>
        </a>

        <a href="<?= e(base_url('/contact')) ?>" class="inline-flex items-center gap-2 bg-amber-500 hover:bg-amber-600 text-slate-950 px-6 py-3 rounded-xl font-bold text-sm shadow-md transition-all">
          <span class="material-symbols-outlined text-[18px]">handshake</span>
          <span><?= e(ps_text('संपर्क एवं वॉलंटियर बनें', 'Become a Volunteer')) ?></span>
        </a>
      </div>
    </div>
  </section>

</div>
