<?php
declare(strict_types=1);

$todayStr = date('Y-m-d');
$rawEvents = $items ?? $events ?? [];

$upcoming = array_values(array_filter($rawEvents, fn($ev) => !empty($ev['event_date']) && $ev['event_date'] >= $todayStr));
$past = array_values(array_filter($rawEvents, fn($ev) => !empty($ev['event_date']) && $ev['event_date'] < $todayStr));

$contactPhone = $settings['phone'] ?? '+91 9919007190';
$contactEmail = $settings['email'] ?? 'contact@pradeepsarang.in';

$featuredUpcoming = !empty($upcoming) ? $upcoming[0] : [
    'title' => ps_text('अवधी लोक साहित्य महाकुंभ एवं कवि सम्मेलन', 'Awadhi Literature Conference & Kavi Sammelan'),
    'event_date' => '2026-10-18',
    'location' => ps_text('गांधी भवन प्रेक्षागृह, बाराबंकी (उ.प्र.)', 'Gandhi Bhawan Auditorium, Barabanki (U.P.)'),
    'excerpt' => ps_text('अवध के प्रतिष्ठित कवियों एवं मनीषियों की गरिमामयी उपस्थिति में अवधी भाषा प्रसार तथा भव्य काव्य गोष्ठी का आयोजन।', 'Awadhi literature symposium and poetry meet with distinguished Awadh scholars.'),
    'slug' => 'awadhi-literature-conference-2026',
    'image' => 'assets/images/slider_final_1.webp'
];
?>

<div class="flex flex-col w-full">
<!-- Top Breadcrumb & Editorial Header Band -->
<section class="relative w-full bg-soft-meadow overflow-hidden py-space-2xl md:py-space-3xl border-b border-border-warm">
  <div class="max-w-container-max mx-auto px-4 sm:px-8 relative z-10">
    <!-- Breadcrumb -->
    <nav aria-label="Breadcrumb" class="flex items-center gap-2 font-label-md text-label-md text-text-muted mb-space-sm">
      <a class="hover:text-primary transition-colors flex items-center gap-1" data-path="home" href="<?= e(base_url('/')) ?>">
        <span class="material-symbols-outlined text-[16px]">home</span>
        <span><?= e(ps_text('गृह (Home)', 'Home')) ?></span>
      </a>
      <span class="opacity-40">/</span>
      <span class="text-deep-forest font-semibold"><?= e(ps_text('आयोजन एवं लोक-गतिविधियाँ (Events)', 'Events & Community Gatherings')) ?></span>
    </nav>

    <!-- Main Headline Block -->
    <div class="max-w-4xl">
      <div class="inline-flex items-center gap-2 bg-primary-fixed/40 text-deep-forest px-3.5 py-1 rounded-full font-label-sm text-label-sm mb-space-sm border border-border-warm font-semibold">
        <span class="material-symbols-outlined text-[15px] text-primary-container" style="font-variation-settings: 'FILL' 1;">event</span>
        <span><?= e(ps_text('लोक-सरोकार • पर्यावरण चेतना • साहित्यिक संवाद', 'Community Welfare • Ecological Consciousness • Literary Dialogue')) ?></span>
      </div>
      <h1 class="font-display-hero text-headline-lg md:text-display-hero text-deep-forest leading-tight tracking-tight font-bold">
        <?= ps_text('गाँव की चौपाल से राष्ट्रीय मंचों तक — <br class="hidden sm:inline"/><span class="text-primary italic font-quote-editorial">सेवा और संवाद के जीवंत आयोजन</span>', 'From Village Trails to National Dais — <br class="hidden sm:inline"/><span class="text-primary italic font-quote-editorial">Gatherings of Service & Dialogue</span>') ?>
      </h1>
      <p class="font-body-lg text-body-lg text-text-muted mt-space-sm max-w-3xl leading-relaxed">
        <?= e(ps_text('श्री प्रदीप सारंग के नेतृत्व में आयोजित होने वाले आगामी जन-अभियान, ग्रीन चौपाल, काव्य-गोष्ठियां और ऐतिहासिक जनसेवा पड़ाव। जनचेतना और लोक-कल्याण के सामूहिक संकल्प का मंच।', 'Upcoming campaigns, Green Chaupals, poetry assemblies & historic social service milestones led by Shri Pradeep Sarang.')) ?>
      </p>
    </div>

    <!-- 2-Photo Event Gallery Spotlight -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-8">
      <div class="relative rounded-2xl overflow-hidden shadow-sm border border-border-warm group">
        <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuChrvMjaMrNe9mnv0wsNeczsA9QTsVBVexwNC6wWD2ITtZGUqAqC4rJlu14alM7uVOx3q6e6QMugj2k_SVptJFwJxqw4kgUmkZfc4oZSwOSInUiqwcST-ZVxWP0dQNinxgeGayBKo9MBnd0LReS_tvv8rW_e0uWQz8FI_1PBQ_sze_mt4-UezPUkio4HIFKvoUNP0kZ6gNLPilWihHeDYhJaX6ySBPHJHVKOu68a1dbF1aYaqyDO7Db" alt="Green Chaupal Gathering" class="w-full h-52 object-cover group-hover:scale-105 transition-transform duration-300">
        <div class="absolute bottom-0 inset-x-0 bg-gradient-to-t from-deep-forest/90 via-deep-forest/50 to-transparent p-4 text-pure-white">
          <span class="font-label-sm text-label-sm uppercase tracking-wider text-fresh-sprout font-bold"><?= e(ps_text('ग्रीन मॉर्निंग चौपाल', 'Green Morning Chaupal')) ?></span>
          <p class="font-title-md text-title-md font-bold mt-0.5"><?= e(ps_text('ग्रामीण चौपालों में पर्यावरण संकल्प एवं पौधरोपण', 'Environmental Pledge & Tree Planting in Village Chaupal')) ?></p>
        </div>
      </div>
      <div class="relative rounded-2xl overflow-hidden shadow-sm border border-border-warm group">
        <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuDNOtpSZS1SiMog6MZDa71DZSMfh6EnAA77Ymmt7zKpBOaoF2T1kWglq8Y53Zsa7euU3rS45qwNdtPbOCAvU8DxMXXSuSW8gAKL7TrAh3UL63gGDIxTMAgC3LukNGRs-_8I2A4TvGb7cVawrjP4eHZn4vCttQfvJgSJxC3lGfMoqJThtsk31BlhWfn-Tl3NqXbIas9Z_rC1JGQtFVyUukAuxzurqbr99QVnyPNLwWoq03MVbPtd27MK" alt="Tulsi Jayanti Meet" class="w-full h-52 object-cover group-hover:scale-105 transition-transform duration-300">
        <div class="absolute bottom-0 inset-x-0 bg-gradient-to-t from-deep-forest/90 via-deep-forest/50 to-transparent p-4 text-pure-white">
          <span class="font-label-sm text-label-sm uppercase tracking-wider text-tertiary-fixed font-bold"><?= e(ps_text('तुलसी जयंती काव्य मंच', 'Tulsi Jayanti Poetry Stage')) ?></span>
          <p class="font-title-md text-title-md font-bold mt-0.5"><?= e(ps_text('मानस जयंती पखवारा एवं अवधी साहित्य गोष्ठी', 'Ramcharitmanas Recital & Awadhi Literature Seminar')) ?></p>
        </div>
      </div>
    </div>
    <!-- Quick Filter Pills -->
    <div class="mt-8 flex items-center gap-2.5 overflow-x-auto pb-2 scrollbar-none" id="event-filters">
      <button type="button" data-filter="all" class="filter-btn active-filter px-4 py-2 rounded-full font-label-md text-label-md transition-all whitespace-nowrap bg-deep-forest text-pure-white shadow-sm flex items-center gap-1.5">
        <span class="material-symbols-outlined text-[18px]">calendar_month</span>
        <span><?= e(ps_text('सभी आयोजन', 'All Events')) ?></span>
      </button>
      <button type="button" data-filter="environment" class="filter-btn px-4 py-2 rounded-full font-label-md text-label-md transition-all whitespace-nowrap bg-surface-container-lowest text-on-surface hover:bg-soft-meadow border border-border-warm flex items-center gap-1.5">
        <span class="material-symbols-outlined text-[18px] text-primary">psychiatry</span>
        <span><?= e(ps_text('पर्यावरण व ग्रीन चौपाल', 'Environment & Green Chaupal')) ?></span>
      </button>
      <button type="button" data-filter="literature" class="filter-btn px-4 py-2 rounded-full font-label-md text-label-md transition-all whitespace-nowrap bg-surface-container-lowest text-on-surface hover:bg-soft-meadow border border-border-warm flex items-center gap-1.5">
        <span class="material-symbols-outlined text-[18px] text-secondary">menu_book</span>
        <span><?= e(ps_text('साहित्य व कवि सम्मेलन', 'Literature & Poetry Meet')) ?></span>
      </button>
      <button type="button" data-filter="bird" class="filter-btn px-4 py-2 rounded-full font-label-md text-label-md transition-all whitespace-nowrap bg-surface-container-lowest text-on-surface hover:bg-soft-meadow border border-border-warm flex items-center gap-1.5">
        <span class="material-symbols-outlined text-[18px] text-tertiary">water_drop</span>
        <span><?= e(ps_text('परिंदा संरक्षण व शिविर', 'Bird Protection Drives')) ?></span>
      </button>
      <button type="button" data-filter="social" class="filter-btn px-4 py-2 rounded-full font-label-md text-label-md transition-all whitespace-nowrap bg-surface-container-lowest text-on-surface hover:bg-soft-meadow border border-border-warm flex items-center gap-1.5">
        <span class="material-symbols-outlined text-[18px] text-secondary-container">volunteer_activism</span>
        <span><?= e(ps_text('सामाजिक व स्वास्थ्य पहल', 'Social & Health Relief')) ?></span>
      </button>
    </div>
  </div>
</section>

<!-- Metric Impact Counter Bar -->
<section class="w-full bg-deep-forest text-pure-white py-6 shadow-sm">
  <div class="max-w-container-max mx-auto px-4 sm:px-8">
    <div class="grid grid-cols-2 md:grid-cols-4 gap-6 md:gap-8 divide-y-0 md:divide-x divide-surface-container-high/15">
      <div class="flex items-center gap-3.5 pl-0 md:pl-2">
        <div class="w-11 h-11 rounded-xl bg-surface-container-lowest/10 flex items-center justify-center shrink-0">
          <span class="material-symbols-outlined text-fresh-sprout text-[24px]">event_note</span>
        </div>
        <div>
          <div class="font-headline-md text-headline-md font-bold leading-tight text-pure-white">120+</div>
          <div class="font-label-sm text-label-sm text-primary-fixed-dim tracking-wide"><?= e(ps_text('कुल सामाजिक व सांस्कृतिक आयोजन', 'Social & Cultural Events')) ?></div>
        </div>
      </div>
      <div class="flex items-center gap-3.5 pl-0 md:pl-6">
        <div class="w-11 h-11 rounded-xl bg-surface-container-lowest/10 flex items-center justify-center shrink-0">
          <span class="material-symbols-outlined text-tertiary-fixed text-[24px]">forest</span>
        </div>
        <div>
          <div class="font-headline-md text-headline-md font-bold leading-tight text-pure-white">45+</div>
          <div class="font-label-sm text-label-sm text-tertiary-fixed tracking-wide"><?= e(ps_text('गाँव-कस्बों में ग्रीन चौपाल', 'Green Chaupals Organized')) ?></div>
        </div>
      </div>
      <div class="flex items-center gap-3.5 pl-0 md:pl-6">
        <div class="w-11 h-11 rounded-xl bg-surface-container-lowest/10 flex items-center justify-center shrink-0">
          <span class="material-symbols-outlined text-secondary-fixed-dim text-[24px]">history_edu</span>
        </div>
        <div>
          <div class="font-headline-md text-headline-md font-bold leading-tight text-pure-white">35+</div>
          <div class="font-label-sm text-label-sm text-secondary-fixed-dim tracking-wide"><?= e(ps_text('वर्ष निरंतर जन-संवाद', 'Years of Community Outreach')) ?></div>
        </div>
      </div>
      <div class="flex items-center gap-3.5 pl-0 md:pl-6">
        <div class="w-11 h-11 rounded-xl bg-surface-container-lowest/10 flex items-center justify-center shrink-0">
          <span class="material-symbols-outlined text-primary-fixed text-[24px]">diversity_3</span>
        </div>
        <div>
          <div class="font-headline-md text-headline-md font-bold leading-tight text-pure-white">25,000+</div>
          <div class="font-label-sm text-label-sm text-primary-fixed-dim tracking-wide"><?= e(ps_text('नागरिकों की प्रत्यक्ष सहभागिता', 'Direct Citizen Participants')) ?></div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Featured Upcoming Event Hero Card -->
<section class="w-full bg-cream-canvas py-12 sm:py-16">
  <div class="max-w-container-max mx-auto px-4 sm:px-8">
    <div class="flex items-center justify-between mb-6">
      <div class="flex items-center gap-2">
        <span class="material-symbols-outlined text-secondary text-[22px]">star</span>
        <span class="font-label-md text-label-md text-secondary uppercase tracking-wider font-bold"><?= e(ps_text('आगामी प्रमुख आयोजन • Featured Milestone', 'Featured Upcoming Event')) ?></span>
      </div>
      <span class="font-label-sm text-label-sm text-text-muted hidden sm:inline"><?= e(ps_text('प्रवेश निःशुल्क एवं सभी के लिए खुला', 'Free Entry & Open to All')) ?></span>
    </div>
    <div class="bg-surface-container-lowest rounded-2xl border border-border-warm shadow-md overflow-hidden grid grid-cols-1 lg:grid-cols-12 transition-all">
      <!-- Visual Column -->
      <div class="lg:col-span-5 relative min-h-[320px] lg:min-h-full">
        <img src="<?= e(ps_resolve_img($featuredUpcoming['image'] ?? '', 'assets/images/slider_final_1.webp')) ?>" alt="<?= e($featuredUpcoming['title']) ?>" class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-gradient-to-t from-deep-forest/90 via-deep-forest/30 to-transparent"></div>
        <div class="absolute top-4 left-4">
          <span class="bg-secondary text-pure-white px-3 py-1 rounded-md font-label-sm text-label-sm font-semibold shadow-sm flex items-center gap-1.5">
            <span class="material-symbols-outlined text-[14px]">local_fire_department</span>
            <span><?= e(ps_text('विमोचन एवं समागम', 'Book Launch & Meet')) ?></span>
          </span>
        </div>
        <div class="absolute bottom-6 left-6 right-6 text-pure-white">
          <div class="font-label-sm text-label-sm text-primary-fixed uppercase tracking-wider mb-1"><?= e(ps_text('विशेष आकर्षण', 'Special Feature')) ?></div>
          <div class="font-title-md text-title-md font-semibold leading-snug"><?= e(ps_text('अवध के 50+ ख्यातिलब्ध रचनाकार व चिंतक एक मंच पर', '50+ Senior Writers & Scholars of Awadh')) ?></div>
        </div>
      </div>
      <!-- Details Column -->
      <div class="lg:col-span-7 p-6 sm:p-10 flex flex-col justify-between">
        <div>
          <!-- Date & Badge Header -->
          <div class="flex flex-wrap items-center justify-between gap-3 mb-4">
            <div class="inline-flex items-center gap-2 bg-soft-meadow text-deep-forest px-3 py-1.5 rounded-lg border border-border-warm font-label-md text-label-md font-semibold">
              <span class="material-symbols-outlined text-primary text-[18px]">calendar_today</span>
              <span><?= e(date('l, d F Y', strtotime($featuredUpcoming['event_date'] ?? '2026-07-05'))) ?></span>
            </div>
            <div class="flex items-center gap-1.5 text-text-muted font-label-sm text-label-sm">
              <span class="material-symbols-outlined text-[16px] text-fresh-sprout">schedule</span>
              <span><?= e(ps_text('प्रातः 10:00 बजे से अपराह्न 2:00 बजे तक', '10:00 AM to 02:00 PM')) ?></span>
            </div>
          </div>
          <!-- Title -->
          <h2 class="font-headline-md text-headline-md text-deep-forest font-bold leading-tight mb-3">
            <?= e($featuredUpcoming['title']) ?>
          </h2>
          <p class="font-body-md text-body-md text-on-surface-variant leading-relaxed mb-6">
            <?= e(ps_excerpt($featuredUpcoming, 240)) ?>
          </p>
          <!-- Metadata Pills Box -->
          <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 mb-8 bg-soft-meadow p-4 rounded-xl border border-border-warm">
            <div class="flex items-start gap-2.5">
              <span class="material-symbols-outlined text-primary mt-0.5 text-[20px]">pin_drop</span>
              <div>
                <div class="font-label-sm text-label-sm text-text-muted uppercase"><?= e(ps_text('आयोजन स्थल', 'Venue')) ?></div>
                <div class="font-body-sm text-body-sm font-semibold text-deep-forest"><?= e($featuredUpcoming['location'] ?? ps_text('गांधी भवन प्रेक्षागृह, बाराबंकी (उ.प्र.)', 'Gandhi Bhawan, Barabanki')) ?></div>
              </div>
            </div>
            <div class="flex items-start gap-2.5">
              <span class="material-symbols-outlined text-secondary mt-0.5 text-[20px]">workspace_premium</span>
              <div>
                <div class="font-label-sm text-label-sm text-text-muted uppercase"><?= e(ps_text('मुख्य मंच एवं अध्यक्षता', 'Chaired By')) ?></div>
                <div class="font-body-sm text-body-sm font-semibold text-deep-forest"><?= e(ps_text('वरिष्ठ साहित्यकार एवं प्रबुद्ध समाज मनीषी', 'Senior Scholars & Intellectuals')) ?></div>
              </div>
            </div>
          </div>
        </div>
        <!-- CTAs -->
        <div class="flex flex-wrap items-center gap-3 pt-2">
          <button type="button" onclick="document.getElementById('rsvp-modal').classList.remove('hidden')" class="bg-primary-container hover:bg-deep-forest text-on-primary font-label-md text-label-md px-6 py-3 rounded-xl font-semibold transition-all shadow-sm flex items-center gap-2">
            <span class="material-symbols-outlined text-[18px]">how_to_reg</span>
            <span><?= e(ps_text('सहभागिता दर्ज करें (RSVP)', 'RSVP / Register Attendance')) ?></span>
          </button>
          <a href="https://maps.google.com/?q=Gandhi+Bhawan+Barabanki" target="_blank" rel="noopener noreferrer" class="bg-surface-container-lowest hover:bg-soft-meadow text-on-surface font-label-md text-label-md px-4 py-3 rounded-xl border border-border-warm transition-colors flex items-center gap-1.5">
            <span class="material-symbols-outlined text-primary text-[18px]">map</span>
            <span><?= e(ps_text('स्थल का नक्शा देखें', 'View Location Map')) ?></span>
          </a>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Upcoming Events Grid -->
<section class="w-full bg-soft-meadow/50 py-12 sm:py-16 border-t border-border-warm">
  <div class="max-w-container-max mx-auto px-4 sm:px-8">
    <div class="flex flex-col sm:flex-row sm:items-end justify-between mb-10 gap-4">
      <div>
        <div class="font-label-md text-label-md text-primary font-semibold uppercase tracking-wider mb-2"><?= e(ps_text('अभियान कैलेंडर • 2026', 'Initiative Calendar 2026')) ?></div>
        <h2 class="font-headline-md text-headline-md text-deep-forest font-bold"><?= e(ps_text('आगामी जन-कार्यक्रम एवं चौपालें', 'Upcoming Public Events & Chaupals')) ?></h2>
      </div>
      <p class="font-body-sm text-body-sm text-text-muted max-w-md">
        <?= e(ps_text('ग्राम स्तर से नगर केंद्र तक होने वाली चौपालों एवं साहित्यानुष्ठानों की समय-सारणी। हर आयोजन में जन-भागीदारी सादर आमंत्रित है।', 'Schedule of upcoming village chaupals and literary gathers.')) ?>
      </p>
    </div>

    <!-- Events Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
      <?php if (!empty($upcoming)): foreach ($upcoming as $idx => $ev): ?>
        <div class="event-card literature bg-surface-container-lowest rounded-2xl border border-border-warm overflow-hidden shadow-sm hover:shadow-md transition-all flex flex-col justify-between">
          <div>
            <div class="relative h-48 w-full overflow-hidden bg-surface-container">
              <img src="<?= e(ps_resolve_img($ev['image'] ?? '', 'assets/images/slider_final_1.webp')) ?>" alt="<?= e($ev['title']) ?>" class="w-full h-full object-cover transition-transform duration-500 hover:scale-105">
              <div class="absolute top-3 left-3 bg-secondary text-pure-white px-2.5 py-1 rounded font-label-sm text-label-sm font-semibold">
                <?= e(ps_text('आगामी आयोजन', 'Upcoming Event')) ?>
              </div>
              <div class="absolute bottom-3 right-3 bg-deep-forest/90 text-pure-white px-2.5 py-1 rounded font-label-sm text-label-sm flex items-center gap-1 backdrop-blur-sm">
                <span class="material-symbols-outlined text-[14px]">event</span>
                <span><?= e(date('d M Y', strtotime($ev['event_date']))) ?></span>
              </div>
            </div>
            <div class="p-6">
              <div class="flex items-center gap-2 text-text-muted font-label-sm text-label-sm mb-2.5">
                <span class="material-symbols-outlined text-[16px] text-primary">location_on</span>
                <span><?= e($ev['location'] ?: ps_text('बाराबंकी, उत्तर प्रदेश', 'Barabanki, UP')) ?></span>
              </div>
              <h3 class="font-title-lg text-title-lg text-deep-forest font-semibold mb-2.5 leading-snug">
                <a href="<?= e(base_url('/events/' . $ev['slug'])) ?>" class="hover:text-primary transition-colors font-bold"><?= e($ev['title']) ?></a>
              </h3>
              <p class="font-body-sm text-body-sm text-on-surface-variant line-clamp-3 leading-relaxed mb-4">
                <?= e(ps_excerpt($ev, 140)) ?>
              </p>
            </div>
          </div>
          <div class="p-6 pt-0 border-t border-border-warm/60 mt-auto flex items-center justify-between">
            <a href="<?= e(base_url('/events/' . $ev['slug'])) ?>" class="text-primary hover:text-deep-forest font-label-md text-label-md font-bold">
              <?= e(ps_text('विवरण देखें', 'View Details')) ?>
            </a>
            <button type="button" onclick="document.getElementById('rsvp-modal').classList.remove('hidden')" class="bg-soft-meadow hover:bg-deep-forest hover:text-pure-white text-deep-forest px-3 py-1.5 rounded-lg border border-border-warm font-label-sm text-label-sm font-semibold transition-colors">
              <?= e(ps_text('सहभागिता दें', 'RSVP Now')) ?>
            </button>
          </div>
        </div>
      <?php endforeach; else: ?>
        <!-- Curated Fallback Event 1 -->
        <div class="event-card literature bg-surface-container-lowest rounded-2xl border border-border-warm overflow-hidden shadow-sm hover:shadow-md transition-all flex flex-col justify-between">
          <div>
            <div class="relative h-48 w-full overflow-hidden bg-surface-container">
              <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuCJza7S46WFFJSwNs0D5xs_ecbeULhv-3IjFXCftYNpanTdkVmilHSu2T3axctN7k1ZsUHMl6s56TDlC9IxIsEKx_KkKqa1Y1s_z6i1nznKifKUeXptt2aFbTg5RGE608Dn7YB4z_qrcOtufJvoCLCRmIu6KC96mDSfYw-dsjHHnNt5stQZVNG-eCAjJpkJgBwjJODXq5y-VyrglqJbW2iYk0k5X-7FTGXxSknDn3Fnan23REwhkvhE" alt="Kavya Manjari Meet" class="w-full h-full object-cover transition-transform duration-500 hover:scale-105">
              <div class="absolute top-3 left-3 bg-secondary text-pure-white px-2.5 py-1 rounded font-label-sm text-label-sm font-semibold">
                <?= e(ps_text('साहित्य व विमर्श', 'Literature Meet')) ?>
              </div>
              <div class="absolute bottom-3 right-3 bg-deep-forest/90 text-pure-white px-2.5 py-1 rounded font-label-sm text-label-sm flex items-center gap-1 backdrop-blur-sm">
                <span class="material-symbols-outlined text-[14px]">event</span>
                <span>05 Jul 2026</span>
              </div>
            </div>
            <div class="p-6">
              <div class="flex items-center gap-2 text-text-muted font-label-sm text-label-sm mb-2.5">
                <span class="material-symbols-outlined text-[16px] text-primary">location_on</span>
                <span><?= e(ps_text('बाराबंकी, उत्तर प्रदेश', 'Barabanki, UP')) ?></span>
              </div>
              <h3 class="font-title-lg text-title-lg text-deep-forest font-semibold mb-2.5 leading-snug">
                <?= e(ps_text('साझा काव्य संकलन "काव्य-मंजरी" का संपादन एवं समीक्षा विमर्श', 'Release & Review of "Kavya-Manjari" Anthology')) ?>
              </h3>
              <p class="font-body-sm text-body-sm text-on-surface-variant line-clamp-3 leading-relaxed mb-4">
                <?= e(ps_text('अवध अंचल के नवोदित एवं स्थापित रचनाकारों की चुनिंदा रचनाओं का संग्रह एवं समीक्षात्मक सत्र।', 'Anthology of contemporary Awadhi poets and critical essay sessions.')) ?>
              </p>
            </div>
          </div>
          <div class="p-6 pt-0 border-t border-border-warm/60 mt-auto flex items-center justify-between">
            <span class="font-label-sm text-label-sm text-text-muted"><?= e(ps_text('संयोजक: साहित्य मंडल', 'Literature Cell')) ?></span>
            <button type="button" onclick="document.getElementById('rsvp-modal').classList.remove('hidden')" class="bg-soft-meadow hover:bg-deep-forest hover:text-pure-white text-deep-forest px-3 py-1.5 rounded-lg border border-border-warm font-label-sm text-label-sm font-semibold transition-colors">
              <?= e(ps_text('स्थान आरक्षित करें', 'RSVP Now')) ?>
            </button>
          </div>
        </div>

        <!-- Curated Fallback Event 2 -->
        <div class="event-card environment bg-surface-container-lowest rounded-2xl border border-border-warm overflow-hidden shadow-sm hover:shadow-md transition-all flex flex-col justify-between">
          <div>
            <div class="relative h-48 w-full overflow-hidden bg-surface-container">
              <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuBA-BKsZLzuyc5-y4hcmmvOzTbj55RfalZmkO3OgoI4DwJMMmZ6beQztXQXRoj7FSX-RtaUwGHAI1CzvhUZeJcsJ6rNRXIiFfjbtjfpp8yyZam87Krr_kbtwJSv1toH1PvLAXHGqxU64sUiZVlOn-uyVjnbeUtZPrzO9U0n9O0NMepCah9RKA0oj5NdIjd7eBc9d1Rkc9LcKPreLQCekxLcprgNs60gkMM6V9iw4Q0WFK0-SzgtW41I" alt="Tree Plantation Drive" class="w-full h-full object-cover transition-transform duration-500 hover:scale-105">
              <div class="absolute top-3 left-3 bg-primary-container text-pure-white px-2.5 py-1 rounded font-label-sm text-label-sm font-semibold">
                <?= e(ps_text('पर्यावरण व जनसेवा', 'Environment Drive')) ?>
              </div>
              <div class="absolute bottom-3 right-3 bg-deep-forest/90 text-pure-white px-2.5 py-1 rounded font-label-sm text-label-sm flex items-center gap-1 backdrop-blur-sm">
                <span class="material-symbols-outlined text-[14px]">event</span>
                <span>15 Jul 2026</span>
              </div>
            </div>
            <div class="p-6">
              <div class="flex items-center gap-2 text-text-muted font-label-sm text-label-sm mb-2.5">
                <span class="material-symbols-outlined text-[16px] text-primary">location_on</span>
                <span><?= e(ps_text('सतरिख एवं कमरावां ब्लॉक, बाराबंकी', 'Satrikh & Kamrawan Block')) ?></span>
              </div>
              <h3 class="font-title-lg text-title-lg text-deep-forest font-semibold mb-2.5 leading-snug">
                <?= e(ps_text('मानसून सघन पौधारोपण महा-अभियान एवं ग्रीन चौपाल 2026', 'Monsoon Tree Plantation & Green Chaupal 2026')) ?>
              </h3>
              <p class="font-body-sm text-body-sm text-on-surface-variant line-clamp-3 leading-relaxed mb-4">
                <?= e(ps_text('10,000 देशी फलदार (नीम, पीपल, जामुन, बरगद) पौधों का निःशुल्क वितरण व संकल्प।', 'Free distribution & planting of 10,000 native Banyan, Peepal & Neem saplings.')) ?>
              </p>
            </div>
          </div>
          <div class="p-6 pt-0 border-t border-border-warm/60 mt-auto flex items-center justify-between">
            <span class="font-label-sm text-label-sm text-text-muted"><?= e(ps_text('ग्रीन गैंग बाराबंकी', 'Green Gang Barabanki')) ?></span>
            <button type="button" onclick="document.getElementById('volunteer-modal').classList.remove('hidden')" class="bg-primary-container hover:bg-deep-forest text-on-primary px-3 py-1.5 rounded-lg font-label-sm text-label-sm font-semibold transition-colors">
              <?= e(ps_text('स्वयंसेवक बनें', 'Join as Volunteer')) ?>
            </button>
          </div>
        </div>

        <!-- Curated Fallback Event 3 -->
        <div class="event-card literature bg-surface-container-lowest rounded-2xl border border-border-warm overflow-hidden shadow-sm hover:shadow-md transition-all flex flex-col justify-between">
          <div>
            <div class="relative h-48 w-full overflow-hidden bg-surface-container">
              <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuCUYU8_Q80ikOHIfn6kPw-jcptH9jriRA6pp1pNfI_0o7S5jvKXzRsFDrYRPNP_6bVGZsJmPhnY0ZN8bz_kzhCAUuu6jT7qL59mHf0Avf5hM85iDsDOpY1TykHzpvcwnBAQfUOI9r2hnEciOgZjQXYJRAIpt35IdunY4NWCf0wsyXc6ogpopKDkQMIppkQ9jEFNCc2ZcJxAu2nUfK4R4TfFReePr7Osko-p5QyGcB8jREUixlLQ0gyy" alt="Tulsi Jayanti Fortnight" class="w-full h-full object-cover transition-transform duration-500 hover:scale-105">
              <div class="absolute top-3 left-3 bg-tertiary text-pure-white px-2.5 py-1 rounded font-label-sm text-label-sm font-semibold">
                <?= e(ps_text('संस्कृति व बाल-चेतना', 'Culture & Students')) ?>
              </div>
              <div class="absolute bottom-3 right-3 bg-deep-forest/90 text-pure-white px-2.5 py-1 rounded font-label-sm text-label-sm flex items-center gap-1 backdrop-blur-sm">
                <span class="material-symbols-outlined text-[14px]">event</span>
                <span>16 - 31 Aug 2026</span>
              </div>
            </div>
            <div class="p-6">
              <div class="flex items-center gap-2 text-text-muted font-label-sm text-label-sm mb-2.5">
                <span class="material-symbols-outlined text-[16px] text-primary">location_on</span>
                <span><?= e(ps_text('विभिन्न विद्यालय एवं ग्राम चौपालें', 'School & Village Chaupals')) ?></span>
              </div>
              <h3 class="font-title-lg text-title-lg text-deep-forest font-semibold mb-2.5 leading-snug">
                <?= e(ps_text('तुलसी जयंती पखवारा 2026 — \'घर-घर तुलसी, घर-घर अवधी\'', 'Tulsi Jayanti Fortnight 2026 — Tulsi in Every Home')) ?>
              </h3>
              <p class="font-body-sm text-body-sm text-on-surface-variant line-clamp-3 leading-relaxed mb-4">
                <?= e(ps_text('छात्र-छात्राओं के मध्य अवधी चौपाई गायन, दोहा वाचन एवं 5,000 तुलसी पौधों का घर-घर वितरण।', 'Awadhi chaupai singing competitions & distribution of 5,000 Tulsi saplings.')) ?>
              </p>
            </div>
          </div>
          <div class="p-6 pt-0 border-t border-border-warm/60 mt-auto flex items-center justify-between">
            <span class="font-label-sm text-label-sm text-text-muted"><?= e(ps_text('15 दिवसीय पखवारा', '15 Day Fortnight')) ?></span>
            <button type="button" onclick="alert('<?= e(ps_text('तुलसी जयंती पखवारा 16 से 31 अगस्त 2026 तक संचालित होगा।', 'Tulsi Jayanti Fortnight runs Aug 16-31.')) ?>');" class="bg-soft-meadow hover:bg-deep-forest hover:text-pure-white text-deep-forest px-4 py-1.5 rounded-lg border border-border-warm font-label-sm text-label-sm font-semibold transition-colors">
              <?= e(ps_text('विवरण देखें', 'View Details')) ?>
            </button>
          </div>
        </div>
      <?php endif; ?>
    </div>
  </div>
</section>

<!-- Past Events Archive & Legacy Milestones -->
<section class="w-full bg-soft-meadow/70 py-12 sm:py-16 border-t border-border-warm">
  <div class="max-w-container-max mx-auto px-4 sm:px-8">
    <div class="flex flex-col md:flex-row md:items-end justify-between mb-10 gap-4">
      <div>
        <span class="font-label-md text-label-md text-secondary font-semibold uppercase tracking-wider"><?= e(ps_text('इतिहास व कीर्तिमान • Milestones', 'Historic Milestones')) ?></span>
        <h2 class="font-headline-md text-headline-md text-deep-forest font-bold mt-1"><?= e(ps_text('सफलतापूर्वक संपन्न ऐतिहासिक आयोजन', 'Past Events & Legacy Milestones')) ?></h2>
      </div>
      <p class="font-body-sm text-body-sm text-text-muted max-w-md">
        <?= e(ps_text('विगत वर्षों में समाज, पर्यावरण और साहित्य के क्षेत्र में मील का पत्थर साबित हुए महत्वपूर्ण सम्मेलन एवं शिविर।', 'Milestones in social work, environment and Awadhi literature.')) ?>
      </p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
      <?php if (!empty($past)): foreach (array_slice($past, 0, 4) as $pastEv): ?>
        <div class="bg-surface-container-lowest p-6 sm:p-7 rounded-2xl border border-border-warm shadow-sm flex flex-col justify-between">
          <div>
            <div class="flex items-center justify-between gap-2 mb-3">
              <span class="bg-primary-container/10 text-primary px-2.5 py-1 rounded font-label-sm text-label-sm font-semibold">
                <?= e(ps_text('संपन्न आयोजन', 'Completed Event')) ?>
              </span>
              <span class="text-text-muted font-label-sm text-label-sm"><?= e(date('d M Y', strtotime($pastEv['event_date']))) ?></span>
            </div>
            <h3 class="font-title-lg text-title-lg text-deep-forest font-bold mb-2">
              <a href="<?= e(base_url('/events/' . $pastEv['slug'])) ?>" class="hover:text-primary transition-colors"><?= e($pastEv['title']) ?></a>
            </h3>
            <p class="font-body-sm text-body-sm text-on-surface-variant leading-relaxed mb-4">
              <?= e(ps_excerpt($pastEv, 180)) ?>
            </p>
          </div>
          <div class="text-text-muted font-label-sm text-label-sm flex items-center gap-1.5 pt-3 border-t border-border-warm">
            <span class="material-symbols-outlined text-[16px] text-primary">pin_drop</span>
            <span><?= e($pastEv['location'] ?: ps_text('बाराबंकी, उत्तर प्रदेश', 'Barabanki, UP')) ?></span>
          </div>
        </div>
      <?php endforeach; else: ?>
        <!-- Curated Past Event 1 -->
        <div class="bg-surface-container-lowest p-6 sm:p-7 rounded-2xl border border-border-warm shadow-sm flex flex-col justify-between">
          <div>
            <div class="flex items-center justify-between gap-2 mb-3">
              <span class="bg-primary-container/10 text-primary px-2.5 py-1 rounded font-label-sm text-label-sm font-semibold">
                <?= e(ps_text('ग्रीन चौपाल', 'Green Chaupal')) ?>
              </span>
              <span class="text-text-muted font-label-sm text-label-sm">03 Jul 2025</span>
            </div>
            <h3 class="font-title-lg text-title-lg text-deep-forest font-bold mb-2"><?= e(ps_text('सतरिख ग्रीन चौपाल एवं वृक्ष मित्र संवाद', 'Satrikh Green Chaupal & Tree Friends Dialogue')) ?></h3>
            <p class="font-body-sm text-body-sm text-on-surface-variant leading-relaxed mb-4">
              <?= e(ps_text('सतरिख ग्राम पंचायत में 400 से अधिक किसानों व ग्रामीणों की संगति में पर्यावरण पंचायत का आयोजन।', 'Environmental panchayat organized with over 400 farmers in Satrikh.')) ?>
            </p>
          </div>
          <div class="text-text-muted font-label-sm text-label-sm flex items-center gap-1.5 pt-3 border-t border-border-warm">
            <span class="material-symbols-outlined text-[16px] text-primary">pin_drop</span>
            <span><?= e(ps_text('सतरिख ग्राम पंचायत, बाराबंकी', 'Satrikh Gram Panchayat, Barabanki')) ?></span>
          </div>
        </div>

        <!-- Curated Past Event 2 -->
        <div class="bg-surface-container-lowest p-6 sm:p-7 rounded-2xl border border-border-warm shadow-sm flex flex-col justify-between">
          <div>
            <div class="flex items-center justify-between gap-2 mb-3">
              <span class="bg-secondary-fixed text-on-secondary-fixed-variant px-2.5 py-1 rounded font-label-sm text-label-sm font-semibold">
                <?= e(ps_text('रंगमंच व भाषा', 'Theatre & Language')) ?>
              </span>
              <span class="text-text-muted font-label-sm text-label-sm">10 Jun 2025</span>
            </div>
            <h3 class="font-title-lg text-title-lg text-deep-forest font-bold mb-2"><?= e(ps_text('नाट्य अभिनय एवं अवधी संवाद कार्यशाला', 'Theatre Acting & Awadhi Dialogue Workshop')) ?></h3>
            <p class="font-body-sm text-body-sm text-on-surface-variant leading-relaxed mb-4">
              <?= e(ps_text('छाया प्रेक्षागृह बाराबंकी में वरिष्ठ रंगकर्मी चंद्रभाष सिंह के मुख्य प्रशिक्षण में अवधी नाटक प्रस्तुति।', 'Awadhi theatre workshop conducted by senior artist Chandra Bhash Singh.')) ?>
            </p>
          </div>
          <div class="text-text-muted font-label-sm text-label-sm flex items-center gap-1.5 pt-3 border-t border-border-warm">
            <span class="material-symbols-outlined text-[16px] text-secondary">pin_drop</span>
            <span><?= e(ps_text('छाया प्रेक्षागृह, बाराबंकी', 'Chhaya Auditorium, Barabanki')) ?></span>
          </div>
        </div>
      <?php endif; ?>
    </div>
  </div>
</section>

<!-- Organize an Event with Us / Invitation Section -->
<section class="w-full bg-soft-meadow py-12 sm:py-20 border-t border-border-warm" id="invite-section">
  <div class="max-w-container-max mx-auto px-4 sm:px-8">
    <div class="bg-surface-container-lowest rounded-3xl border border-border-warm p-6 sm:p-12 shadow-md">
      <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-12">
        <!-- Left Pitch -->
        <div class="lg:col-span-5 flex flex-col justify-between">
          <div>
            <div class="inline-flex items-center gap-1.5 bg-primary-container/10 text-primary px-3 py-1 rounded-full font-label-sm text-label-sm font-semibold mb-4">
              <span class="material-symbols-outlined text-[16px]">campaign</span>
              <span><?= e(ps_text('सहकार एवं आमंत्रण', 'Collaboration & Invitation')) ?></span>
            </div>
            <h2 class="font-headline-md text-headline-md text-deep-forest font-bold leading-tight mb-4">
              <?= e(ps_text('अपने गाँव, विद्यालय अथवा संस्था में \'ग्रीन चौपाल\' आयोजित करें', 'Organize Green Chaupal in Your Village / School')) ?>
            </h2>
            <p class="font-body-md text-body-md text-on-surface-variant leading-relaxed mb-6">
              <?= e(ps_text('यदि आप अपनी ग्राम पंचायत, शैक्षिक संस्थान, सामाजिक संस्था अथवा युवा संगठन में पर्यावरण चेतना, अवधी साहित्य संगोष्ठी अथवा रक्तदान शिविर आयोजित करना चाहते हैं, तो हमें आमंत्रण भेजें।', 'Invite us to organize Green Chaupals, Awadhi literary meets or blood donation drives in your institution.')) ?>
            </p>
            <div class="bg-soft-meadow p-5 rounded-xl border-l-4 border-secondary mb-6">
              <p class="font-quote-editorial text-body-md text-deep-forest italic leading-relaxed">
                <?= ps_text('"गाँव जगेगा तभी देश संवरेगा, जब तक अंतिम छोर के पेड़ और परिंदे सुरक्षित नहीं होंगे, विकास अधूरा है।"', '"When villages awaken, nation prospers. Until trees and birds are safe, progress remains incomplete."') ?>
              </p>
              <div class="font-label-sm text-label-sm text-secondary font-bold uppercase tracking-wider mt-2">
                <?= e(ps_text('— प्रदीप सारंग', '— Pradeep Sarang')) ?>
              </div>
            </div>
          </div>
          <div class="space-y-2 font-body-sm text-body-sm text-text-muted pt-4 border-t border-border-warm">
            <div class="flex items-center gap-2">
              <span class="material-symbols-outlined text-[18px] text-primary">call</span>
              <span><?= e(ps_text('सीधा फोन समन्वय:', 'Phone Direct:')) ?> <a href="tel:<?= e(preg_replace('/[^0-9+]/', '', $contactPhone)) ?>" class="font-semibold text-deep-forest hover:text-primary"><?= e($contactPhone) ?></a></span>
            </div>
            <div class="flex items-center gap-2">
              <span class="material-symbols-outlined text-[18px] text-primary">mail</span>
              <span><?= e(ps_text('आयोजन सेल:', 'Events Cell:')) ?> <a href="mailto:<?= e($contactEmail) ?>" class="font-semibold text-deep-forest hover:text-primary"><?= e($contactEmail) ?></a></span>
            </div>
          </div>
        </div>
        <!-- Right Form -->
        <div class="lg:col-span-7 bg-cream-canvas p-6 sm:p-8 rounded-2xl border border-border-warm">
          <h3 class="font-title-lg text-title-lg text-deep-forest font-bold mb-2"><?= e(ps_text('आयोजन हेतु आमंत्रण पत्र (Event Invitation Form)', 'Event Invitation Form')) ?></h3>
          <p class="font-body-sm text-body-sm text-text-muted mb-6"><?= e(ps_text('कृपया प्रस्तावित कार्यक्रम का विवरण साझा करें। हमारी टीम 48 घंटों में संपर्क करेगी।', 'Share details of proposed event. Our team will contact within 48 hours.')) ?></p>
          <form id="inviteForm" method="post" action="<?= e(base_url('/contact')) ?>" class="space-y-4">
            <?= csrf_field() ?>
            <input type="hidden" name="form_type" value="contact">
            <input type="hidden" name="subject" value="Event Invitation Request">

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
              <div>
                <label class="block font-label-md text-label-md text-on-surface mb-1.5 font-semibold"><?= e(ps_text('आयोजक / संपर्क व्यक्ति का नाम *', 'Organizer Name *')) ?></label>
                <input type="text" name="name" required placeholder="<?= e(ps_text('उदा. रामेश्वर वर्मा', 'e.g. Rameshwar Verma')) ?>" class="w-full bg-surface-container-lowest border border-border-warm rounded-xl px-4 py-3 font-body-sm text-body-sm text-on-surface focus:outline-none focus:border-primary">
              </div>
              <div>
                <label class="block font-label-md text-label-md text-on-surface mb-1.5 font-semibold"><?= e(ps_text('संस्था / गाँव / विद्यालय का नाम *', 'School / Gram Panchayat *')) ?></label>
                <input type="text" name="districtState" required placeholder="<?= e(ps_text('उदा. ग्राम पंचायत सतरिख', 'e.g. Gram Panchayat Satrikh')) ?>" class="w-full bg-surface-container-lowest border border-border-warm rounded-xl px-4 py-3 font-body-sm text-body-sm text-on-surface focus:outline-none focus:border-primary">
              </div>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
              <div>
                <label class="block font-label-md text-label-md text-on-surface mb-1.5 font-semibold"><?= e(ps_text('मोबाइल नंबर *', 'Mobile Number *')) ?></label>
                <input type="tel" name="phone" required placeholder="+91 XXXXX XXXXX" class="w-full bg-surface-container-lowest border border-border-warm rounded-xl px-4 py-3 font-body-sm text-body-sm text-on-surface focus:outline-none focus:border-primary">
              </div>
              <div>
                <label class="block font-label-md text-label-md text-on-surface mb-1.5 font-semibold"><?= e(ps_text('ईमेल पता (यदि उपलब्ध हो)', 'Email Address')) ?></label>
                <input type="email" name="email" placeholder="aapka-email@domain.com" class="w-full bg-surface-container-lowest border border-border-warm rounded-xl px-4 py-3 font-body-sm text-body-sm text-on-surface focus:outline-none focus:border-primary">
              </div>
            </div>
            <div>
              <label class="block font-label-md text-label-md text-on-surface mb-1.5 font-semibold"><?= e(ps_text('कार्यक्रम का विवरण एवं स्थान *', 'Event Details & Venue *')) ?></label>
              <textarea name="message" rows="3" required placeholder="<?= e(ps_text('कृपया कार्यक्रम का स्वरूप, स्थान तथा अपेक्षित उपस्थिति लिखें...', 'Write event details, venue and expected attendance...')) ?>" class="w-full bg-surface-container-lowest border border-border-warm rounded-xl px-4 py-3 font-body-sm text-body-sm text-on-surface focus:outline-none focus:border-primary"></textarea>
            </div>
            <button type="submit" class="w-full bg-primary-container hover:bg-deep-forest text-on-primary font-label-md text-label-md font-semibold py-3.5 px-6 rounded-xl transition-colors flex items-center justify-center gap-2 shadow-sm">
              <span class="material-symbols-outlined text-[18px]">send</span>
              <span><?= e(ps_text('आयोजन हेतु आमंत्रण पत्र भेजें (Submit Invitation)', 'Submit Invitation')) ?></span>
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Interactive RSVP Modal -->
<div id="rsvp-modal" class="fixed inset-0 z-50 flex items-center justify-center bg-deep-forest/60 backdrop-blur-sm p-4 hidden">
  <div class="bg-surface-container-lowest rounded-2xl max-w-lg w-full p-6 sm:p-8 shadow-xl border border-border-warm relative">
    <button type="button" onclick="document.getElementById('rsvp-modal').classList.add('hidden')" class="absolute top-4 right-4 text-text-muted hover:text-on-surface">
      <span class="material-symbols-outlined text-[24px]">close</span>
    </button>
    <div class="flex items-center gap-2 mb-2 text-primary font-label-sm text-label-sm font-semibold uppercase">
      <span class="material-symbols-outlined text-[16px]">how_to_reg</span>
      <span><?= e(ps_text('सहभागिता पंजीकरण', 'RSVP Registration')) ?></span>
    </div>
    <h3 class="font-headline-sm text-headline-sm text-deep-forest font-bold mb-2"><?= e(ps_text('आयोजन में अपनी उपस्थिति दर्ज करें', 'Confirm Attendance')) ?></h3>
    <p class="font-body-sm text-body-sm text-text-muted mb-6"><?= e($featuredUpcoming['title']) ?></p>
    <form method="post" action="<?= e(base_url('/contact')) ?>" class="space-y-4" onsubmit="alert('<?= e(ps_text('धन्यवाद! आपका स्थान आरक्षित कर लिया गया है।', 'Thank you! Attendance confirmed.')) ?>'); document.getElementById('rsvp-modal').classList.add('hidden');">
      <?= csrf_field() ?>
      <input type="hidden" name="form_type" value="contact">
      <input type="hidden" name="subject" value="RSVP for <?= e($featuredUpcoming['title']) ?>">
      <div>
        <label class="block font-label-md text-label-md text-on-surface mb-1 font-semibold"><?= e(ps_text('आपका पूरा नाम *', 'Full Name *')) ?></label>
        <input type="text" name="name" required placeholder="<?= e(ps_text('उदा. कुलदीप शुक्ल', 'e.g. Kuldeep Shukla')) ?>" class="w-full border border-border-warm rounded-xl px-4 py-2.5 font-body-sm text-body-sm focus:outline-none focus:border-primary">
      </div>
      <div>
        <label class="block font-label-md text-label-md text-on-surface mb-1 font-semibold"><?= e(ps_text('व्हाट्सएप / मोबाइल नंबर *', 'Mobile Number *')) ?></label>
        <input type="tel" name="phone" required placeholder="+91 98XXXXXXXX" class="w-full border border-border-warm rounded-xl px-4 py-2.5 font-body-sm text-body-sm focus:outline-none focus:border-primary">
      </div>
      <button type="submit" class="w-full bg-primary-container hover:bg-deep-forest text-on-primary font-label-md text-label-md font-semibold py-3 rounded-xl transition-colors mt-2">
        <?= e(ps_text('पंजीकरण पूर्ण करें (Confirm RSVP)', 'Confirm RSVP')) ?>
      </button>
    </form>
  </div>
</div>

<!-- Inline Script for Filter and Month Tabs -->
<script>
  (function() {
    const filterBtns = document.querySelectorAll('#event-filters .filter-btn');
    const cards = document.querySelectorAll('.event-card');

    filterBtns.forEach(btn => {
      btn.addEventListener('click', () => {
        filterBtns.forEach(b => {
          b.classList.remove('bg-deep-forest', 'text-pure-white');
          b.classList.add('bg-surface-container-lowest', 'text-on-surface');
        });
        btn.classList.remove('bg-surface-container-lowest', 'text-on-surface');
        btn.classList.add('bg-deep-forest', 'text-pure-white');

        const filter = btn.getAttribute('data-filter');
        cards.forEach(card => {
          if (filter === 'all' || card.classList.contains(filter)) {
            card.style.display = 'flex';
          } else {
            card.style.display = 'none';
          }
        });
      });
    });

    const monthTabs = document.querySelectorAll('.month-tab');
    const monthPanels = document.querySelectorAll('.month-panel');

    monthTabs.forEach(tab => {
      tab.addEventListener('click', () => {
        monthTabs.forEach(t => {
          t.classList.remove('bg-deep-forest', 'text-pure-white');
          t.classList.add('bg-surface-container-lowest', 'text-on-surface');
        });
        tab.classList.remove('bg-surface-container-lowest', 'text-on-surface');
        tab.classList.add('bg-deep-forest', 'text-pure-white');

        const target = 'month-content-' + tab.getAttribute('data-month');
        monthPanels.forEach(panel => {
          if (panel.id === target) {
            panel.classList.remove('hidden');
          } else {
            panel.classList.add('hidden');
          }
        });
      });
    });
  })();
</script>
