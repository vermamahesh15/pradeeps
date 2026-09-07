<?php
declare(strict_types=1);

$items = $items ?? [];
$phone = trim($settings['phone'] ?? '+91 9919007190');
$phoneClean = preg_replace('/[^+0-9]/', '', $phone);
$email = trim($settings['email'] ?? 'contact@pradeepsarang.in');

// Default authentic gallery items if DB is sparse
$defaultPhotos = [
    [
        'title' => ps_text('ग्रीन गैंग पौधारोपण अभियान — ग्राम कमरावाँ', 'Green Gang Tree Planting Drive — Kamrawan Village'),
        'category' => 'eco',
        'category_name' => ps_text('पर्यावरण व हरियाली', 'Environment & Green Gang'),
        'location' => ps_text('कमरावाँ, बाराबंकी', 'Kamrawan, Barabanki'),
        'year' => '2024',
        'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuChrvMjaMrNe9mnv0wsNeczsA9QTsVBVexwNC6wWD2ITtZGUqAqC4rJlu14alM7uVOx3q6e6QMugj2k_SVptJFwJxqw4kgUmkZfc4oZSwOSInUiqwcST-ZVxWP0dQNinxgeGayBKo9MBnd0LReS_tvv8rW_e0uWQz8FI_1PBQ_sze_mt4-UezPUkio4HIFKvoUNP0kZ6gNLPilWihHeDYhJaX6ySBPHJHVKOu68a1dbF1aYaqyDO7Db',
        'featured' => true,
    ],
    [
        'title' => ps_text('भीषण ग्रीष्म में परिंदा सकोरा जल-वितरण अभियान', 'Summer Bird Water Bowl Distribution Campaign'),
        'category' => 'bird',
        'category_name' => ps_text('परिंदा व पक्षी सेवा', 'Bird Care'),
        'location' => ps_text('सतरिख, बाराबंकी', 'Satrikh, Barabanki'),
        'year' => '2023',
        'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuCIdMQwsnVo2dk4ut7g6q_cAP6eTxbCJ79UEWEL6LMYJP9Bzoa711KY0DUcQDKRXxuQ_6LQhxi0vQ2STd8MG_7M8PMwLDKDbl4rkN0NWnrSqVTvaAamPZA23ot4DWOtvh7QMTvSKjQWd4KHteII-UyAePIVzkOU6Kjt18WGSoV63V45Zxnm-uJxCWTIYBFdLiZQTIIpMJ2BicU3nJOrp9TW5wTXMOaNdUj57zI1cu2Z0PJgk4oP02r7',
        'featured' => true,
    ],
    [
        'title' => ps_text('महामहिम राज्यपाल द्वारा स्वामी विवेकानंद युवा पुरस्कार (1991)', 'Governor Youth Award Presentation (1991)'),
        'category' => 'awards',
        'category_name' => ps_text('राष्ट्रीय व राज्य सम्मान', 'Awards & Honors'),
        'location' => ps_text('राजभवन, लखनऊ', 'Raj Bhavan, Lucknow'),
        'year' => '1991',
        'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuAFhcCzDptvdawqahxIf_F6aewWLbhrElKpz8H_SdpdXpvfwrClJ3jd7GZ9s8IMoKni0nNxRMxekp5XwukPPAGZ8JiWIfTdqXGlZuQOtTWSqI1lEO2t8Caw2U_jqNH7qTboXJ3x8qKCEMJkrGgMZJ5LcJ0XXi5QpbeRqyXoboPm3gFtseM0-FLQdWUjpDTjNuI4kUaBCvQrklMOKag47XiVRg-6CA9onDFh_olHoLmOmWixtDFur5TN',
        'featured' => true,
    ],
    [
        'title' => ps_text('तुलसी जयंती पखवारा एवं अवधी काव्य संध्या', 'Tulsi Jayanti Pakhwara & Awadhi Poetic Evening'),
        'category' => 'literature',
        'category_name' => ps_text('अवधी साहित्य व मंच', 'Awadhi Literature'),
        'location' => ps_text('बाराबंकी', 'Barabanki'),
        'year' => '2025',
        'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuDNOtpSZS1SiMog6MZDa71DZSMfh6EnAA77Ymmt7zKpBOaoF2T1kWglq8Y53Zsa7euU3rS45qwNdtPbOCAvU8DxMXXSuSW8gAKL7TrAh3UL63gGDIxTMAgC3LukNGRs-_8I2A4TvGb7cVawrjP4eHZn4vCttQfvJgSJxC3lGfMoqJThtsk31BlhWfn-Tl3NqXbIas9Z_rC1JGQtFVyUukAuxzurqbr99QVnyPNLwWoq03MVbPtd27MK',
        'featured' => false,
    ],
    [
        'title' => ps_text('ग्रामीण चौपाल एवं \'ग्रीन मॉर्निंग\' अभिवादन गोष्ठी', 'Rural Chaupal & Green Morning Interactive Session'),
        'category' => 'community',
        'category_name' => ps_text('ग्राम चौपाल व लोक सेवा', 'Community Chaupals'),
        'location' => ps_text('नानमऊ, बाराबंकी', 'Nanmau, Barabanki'),
        'year' => '2024',
        'image' => 'https://picsum.photos/seed/gallery-comm-1/900/700',
        'featured' => false,
    ],
    [
        'title' => ps_text('जनकवि बंशीधर शुक्ल एवं गोस्वामी तुलसीदास सम्मान समारोह', 'Banshidhar Shukla & Tulsi Award Ceremony'),
        'category' => 'awards',
        'category_name' => ps_text('राष्ट्रीय व राज्य सम्मान', 'Awards & Honors'),
        'location' => ps_text('लखनऊ', 'Lucknow'),
        'year' => '2022',
        'image' => 'https://picsum.photos/seed/gallery-award-2/900/700',
        'featured' => false,
    ],
    [
        'title' => ps_text('स्कूली छात्रों संग \'परिंदा मित्र\' दाना-पानी संकल्प', 'School Students Bird Friend Water & Grain Pledge'),
        'category' => 'bird',
        'category_name' => ps_text('परिंदा व पक्षी सेवा', 'Bird Care'),
        'location' => ps_text('देवा शरीफ रोड, बाराबंकी', 'Dewa Road, Barabanki'),
        'year' => '2023',
        'image' => 'https://picsum.photos/seed/gallery-bird-2/900/700',
        'featured' => false,
    ],
    [
        'title' => ps_text('बरगद व नीम पौधरोपण अभियान — ग्रीन गैंग युवा दस्ता', 'Banyan & Neem Planting Drive by Green Gang Youth'),
        'category' => 'eco',
        'category_name' => ps_text('पर्यावरण व हरियाली', 'Environment & Green Gang'),
        'location' => ps_text('रामनगर, बाराबंकी', 'Ramnagar, Barabanki'),
        'year' => '2024',
        'image' => 'https://picsum.photos/seed/gallery-eco-2/900/700',
        'featured' => false,
    ],
    [
        'title' => ps_text('अवधी संस्मरण \'झरिहख\' एवं \'सारंग-हुण्डलियाँ\' ग्रन्थ विमोचन', 'Awadhi Book Launch Jharihakh & Sarang Hundliyan'),
        'category' => 'literature',
        'category_name' => ps_text('अवधी साहित्य व मंच', 'Awadhi Literature'),
        'location' => ps_text('उत्तर प्रदेश हिंदी संस्थान, लखनऊ', 'UP Hindi Sansthan, Lucknow'),
        'year' => '2024',
        'image' => 'https://picsum.photos/seed/gallery-lit-2/900/700',
        'featured' => false,
    ],
    [
        'title' => ps_text('कोरोना योद्धा आपातकालीन राहत एवं स्वास्थ्य शिविर (2020)', 'Corona Warrior Emergency Medical & Food Relief Drive'),
        'category' => 'community',
        'category_name' => ps_text('ग्राम चौपाल व लोक सेवा', 'Community Chaupals'),
        'location' => ps_text('बाराबंकी ग्रामीण अंचल', 'Barabanki Rural'),
        'year' => '2020',
        'image' => 'https://picsum.photos/seed/gallery-covid/900/700',
        'featured' => false,
    ],
    [
        'title' => ps_text('मुख्य निर्वाचन अधिकारी द्वारा मतदाता जागरूकता प्रशस्ति पत्र', 'UP Chief Electoral Officer Voter Awareness Citation'),
        'category' => 'awards',
        'category_name' => ps_text('राष्ट्रीय व राज्य सम्मान', 'Awards & Honors'),
        'location' => ps_text('जिला निर्वाचन कार्यालय, बाराबंकी', 'District Election Office, Barabanki'),
        'year' => '2019',
        'image' => 'https://picsum.photos/seed/gallery-voter/900/700',
        'featured' => false,
    ],
    [
        'title' => ps_text('गणतंत्र दिवस राष्ट्रीय परेड NSS शिविर (1988)', 'Republic Day NSS National Parade Camp (1988)'),
        'category' => 'awards',
        'category_name' => ps_text('राष्ट्रीय व राज्य सम्मान', 'Awards & Honors'),
        'location' => ps_text('इंडिया गेट, नई दिल्ली', 'India Gate, New Delhi'),
        'year' => '1988',
        'image' => 'https://picsum.photos/seed/gallery-nss/900/700',
        'featured' => false,
    ],
];

// Merge DB photos if present
$dbPhotos = [];
foreach ($items as $idx => $dbItem) {
    if (!empty($dbItem['image'])) {
        $dbPhotos[] = [
            'title' => $dbItem['title'] ?? ps_text('छायाचित्र', 'Archival Photo'),
            'category' => 'community',
            'category_name' => ps_text('सामुदायिक सेवा', 'Community Service'),
            'location' => ps_text('बाराबंकी', 'Barabanki'),
            'year' => '2024',
            'image' => base_url($dbItem['image']),
            'featured' => ($idx === 0),
        ];
    }
}

$allPhotos = !empty($dbPhotos) ? array_merge($dbPhotos, $defaultPhotos) : $defaultPhotos;
$featuredPhotos = array_filter($allPhotos, fn($p) => !empty($p['featured']));
if (count($featuredPhotos) < 3) {
    $featuredPhotos = array_slice($allPhotos, 0, 3);
}
?>

<div class="flex flex-col w-full">
  <!-- Top Breadcrumb & Hero Banner Header -->
  <section class="relative w-full bg-soft-meadow overflow-hidden py-space-2xl md:py-space-3xl border-b border-border-warm">
    <div class="max-w-container-max mx-auto px-4 sm:px-8 relative z-10">
      <!-- Breadcrumb -->
      <nav aria-label="Breadcrumb" class="flex items-center gap-2 font-label-md text-label-md text-text-muted mb-space-sm">
        <a class="hover:text-primary transition-colors flex items-center gap-1" data-path="home" href="<?= e(base_url('/')) ?>">
          <span class="material-symbols-outlined text-[16px]">home</span>
          <span><?= e(ps_text('गृह (Home)', 'Home')) ?></span>
        </a>
        <span class="opacity-40">/</span>
        <span class="text-deep-forest font-semibold"><?= e(ps_text('गैलरी व छायाचित्र दीर्घा (Gallery)', 'Gallery & Photo Archive')) ?></span>
      </nav>
      
      <!-- Badge & Editorial Title -->
      <div class="max-w-4xl">
        <div class="inline-flex items-center gap-2 bg-primary-fixed/40 text-deep-forest px-3.5 py-1 rounded-full font-label-sm text-label-sm mb-space-sm border border-border-warm font-semibold">
          <span class="material-symbols-outlined text-[15px] text-primary-container" style="font-variation-settings: 'FILL' 1;">photo_library</span>
          <span><?= e(ps_text('100+ प्रामाणिक छायाचित्र अभिलेखागार (1987 — 2026)', '100+ Authentic Photo Archives (1987 — 2026)')) ?></span>
        </div>
        <h1 class="font-display-hero text-headline-lg md:text-display-hero text-deep-forest leading-tight tracking-tight font-bold">
          <?= e(ps_text('चार दशकों की ऐतिहासिक सेवा यात्रा के सजीव छायाचित्र', 'Visual Legacy of Four Decades of Community Dedication')) ?>
        </h1>
        <p class="font-body-lg text-body-lg text-text-muted mt-space-sm max-w-3xl leading-relaxed">
          <?= e(ps_text('ग्राम चौपाल, पौधरोपण अभियान, परिंदा जल-सकोरा वितरण, अवधी काव्य मंच एवं महामहिम राज्यपाल से प्राप्त दुर्लभ ऐतिहासिक तस्वीरों की दीर्घा।', 'Archival moments capturing Green Gang drives, bird water bowl distribution, Awadhi literature meets, and state honors.')) ?>
        </p>
      </div>

      <!-- Category Filter Pills -->
      <div class="flex items-center gap-2 mt-8 overflow-x-auto pb-2 -mx-4 px-4 sm:mx-0 sm:px-0 sm:flex-wrap shrink-0 cursor-grab" id="gallery-filter-tabs">
        <button type="button" data-filter="all" class="gallery-filter-btn px-4 py-2 rounded-full font-label-sm text-label-sm bg-primary-container text-on-primary shadow-sm font-semibold transition-all cursor-pointer">
          <?= e(ps_text('सभी चित्र (All)', 'All Photos')) ?>
        </button>
        <button type="button" data-filter="eco" class="gallery-filter-btn px-4 py-2 rounded-full font-label-sm text-label-sm bg-pure-white text-on-surface-variant hover:bg-surface-container border border-border-warm font-medium transition-all cursor-pointer">
          🌿 <?= e(ps_text('पर्यावरण व \'ग्रीन गैंग\'', 'Environment & Green Gang')) ?>
        </button>
        <button type="button" data-filter="bird" class="gallery-filter-btn px-4 py-2 rounded-full font-label-sm text-label-sm bg-pure-white text-on-surface-variant hover:bg-surface-container border border-border-warm font-medium transition-all cursor-pointer">
          🕊️ <?= e(ps_text('परिंदा व पक्षी सेवा', 'Bird Care')) ?>
        </button>
        <button type="button" data-filter="literature" class="gallery-filter-btn px-4 py-2 rounded-full font-label-sm text-label-sm bg-pure-white text-on-surface-variant hover:bg-surface-container border border-border-warm font-medium transition-all cursor-pointer">
          📖 <?= e(ps_text('अवधी साहित्य व मंच', 'Awadhi Literature')) ?>
        </button>
        <button type="button" data-filter="awards" class="gallery-filter-btn px-4 py-2 rounded-full font-label-sm text-label-sm bg-pure-white text-on-surface-variant hover:bg-surface-container border border-border-warm font-medium transition-all cursor-pointer">
          🏆 <?= e(ps_text('राष्ट्रीय व राज्य सम्मान', 'Awards & Honors')) ?>
        </button>
        <button type="button" data-filter="community" class="gallery-filter-btn px-4 py-2 rounded-full font-label-sm text-label-sm bg-pure-white text-on-surface-variant hover:bg-surface-container border border-border-warm font-medium transition-all cursor-pointer">
          🤝 <?= e(ps_text('ग्राम चौपाल व लोक सेवा', 'Community Service')) ?>
        </button>
      </div>
    </div>
  </section>

  <!-- Featured Spotlight Section -->
  <section class="w-full bg-cream-canvas py-space-2xl border-b border-border-warm">
    <div class="max-w-container-max mx-auto px-4 sm:px-8">
      <div class="flex items-center justify-between mb-6">
        <div>
          <span class="font-label-sm text-label-sm text-secondary font-bold uppercase tracking-wider block mb-1"><?= e(ps_text('मुख्य आकर्षण', 'Featured Spotlight')) ?></span>
          <h2 class="font-headline-md text-headline-md text-deep-forest font-bold"><?= e(ps_text('ऐतिहासिक सेवा यात्रा की मुख्य झलकियाँ', 'Archival Service Highlights')) ?></h2>
        </div>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <?php foreach (array_slice($featuredPhotos, 0, 3) as $fPhoto): ?>
          <div class="group relative rounded-2xl overflow-hidden shadow-md border border-border-warm bg-surface-container aspect-[4/3] flex flex-col justify-end">
            <img src="<?= e($fPhoto['image']) ?>" alt="<?= e($fPhoto['title']) ?>" class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
            <div class="absolute inset-0 bg-gradient-to-t from-deep-forest/95 via-deep-forest/40 to-transparent"></div>
            
            <div class="relative z-10 p-5 flex flex-col justify-between h-full">
              <div class="flex justify-between items-start">
                <span class="bg-primary-container text-on-primary font-label-sm text-label-sm px-2.5 py-1 rounded-full font-semibold shadow-sm">
                  <?= e($fPhoto['category_name']) ?>
                </span>
                <span class="bg-cream-canvas/90 text-deep-forest font-label-sm text-label-sm px-2.5 py-0.5 rounded-full font-bold shadow-sm">
                  <?= e($fPhoto['year']) ?>
                </span>
              </div>

              <div>
                <h3 class="font-title-lg text-title-lg text-pure-white font-bold mb-1 leading-snug drop-shadow-sm">
                  <?= e($fPhoto['title']) ?>
                </h3>
                <div class="flex items-center justify-between pt-2 border-t border-pure-white/20">
                  <span class="font-label-sm text-label-sm text-surface-container-high flex items-center gap-1">
                    <span class="material-symbols-outlined text-[15px] text-tertiary-fixed">location_on</span>
                    <?= e($fPhoto['location']) ?>
                  </span>
                  <a href="<?= e($fPhoto['image']) ?>" data-ps-lightbox data-caption="<?= e($fPhoto['title']) ?>" class="inline-flex items-center gap-1 text-primary-fixed hover:text-pure-white font-label-sm text-label-sm font-bold transition-colors">
                    <span class="material-symbols-outlined text-[16px]">zoom_in</span>
                    <span><?= e(ps_text('बड़ा करें', 'Enlarge')) ?></span>
                  </a>
                </div>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <!-- Dynamic Gallery Grid Section -->
  <section class="w-full bg-cream-canvas py-space-3xl">
    <div class="max-w-container-max mx-auto px-4 sm:px-8">
      <div class="flex flex-col md:flex-row md:items-end justify-between mb-space-xl gap-4">
        <div>
          <span class="font-label-sm text-label-sm text-secondary tracking-widest font-bold uppercase"><?= e(ps_text('सम्पूर्ण दीर्घा', 'Complete Gallery')) ?></span>
          <h2 class="font-headline-lg text-headline-md md:text-headline-lg text-deep-forest font-bold mt-1">
            <?= e(ps_text('सामाजिक एवं सांस्कृतिक गतिविधि दीर्घा', 'Social & Cultural Activity Archive')) ?>
          </h2>
        </div>
        <p class="font-body-sm text-body-sm text-text-muted max-w-md">
          <?= e(ps_text('किसी भी चित्र पर क्लिक करके उच्च-गुणवत्ता (High Resolution) में देखें या डाउनलोड करें।', 'Click any photograph to view in high-resolution lightbox or download.')) ?>
        </p>
      </div>

      <!-- Photo Grid -->
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6" id="gallery-grid">
        <?php foreach ($allPhotos as $photo): ?>
          <div class="gallery-card group bg-pure-white rounded-2xl shadow-sm border border-border-warm overflow-hidden hover:shadow-md transition-all flex flex-col justify-between" data-category="<?= e($photo['category']) ?>">
            <div class="relative overflow-hidden aspect-[4/3] bg-surface-container">
              <img src="<?= e($photo['image']) ?>" alt="<?= e($photo['title']) ?>" loading="lazy" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
              
              <!-- Hover Overlay Button -->
              <a href="<?= e($photo['image']) ?>" data-ps-lightbox data-caption="<?= e($photo['title']) ?>" class="absolute inset-0 bg-deep-forest/60 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center text-pure-white font-label-md text-label-md font-bold gap-2">
                <span class="w-10 h-10 rounded-full bg-pure-white/20 backdrop-blur-md flex items-center justify-center border border-pure-white/40">
                  <span class="material-symbols-outlined text-[22px]">zoom_in</span>
                </span>
                <span><?= e(ps_text('चित्र देखें', 'View Photo')) ?></span>
              </a>

              <!-- Category Badge Tag -->
              <span class="absolute top-3 left-3 bg-deep-forest/90 backdrop-blur-sm text-pure-white font-label-sm text-label-sm px-2.5 py-0.5 rounded-full font-semibold">
                <?= e($photo['category_name']) ?>
              </span>
            </div>

            <div class="p-4 sm:p-5 flex flex-col justify-between flex-1">
              <h4 class="font-title-md text-title-md text-deep-forest font-bold mb-2 line-clamp-2 leading-snug group-hover:text-primary transition-colors">
                <?= e($photo['title']) ?>
              </h4>
              
              <div class="mt-3 pt-3 border-t border-border-warm flex items-center justify-between text-text-muted font-label-sm text-label-sm">
                <span class="flex items-center gap-1">
                  <span class="material-symbols-outlined text-[14px] text-secondary">location_on</span>
                  <?= e($photo['location']) ?>
                </span>
                <span class="font-semibold text-deep-forest"><?= e($photo['year']) ?></span>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <!-- Submit Archival Photo Callout -->
  <section class="w-full bg-soft-meadow py-space-2xl border-t border-border-warm">
    <div class="max-w-container-editorial mx-auto px-4 sm:px-8">
      <div class="bg-pure-white rounded-3xl p-6 sm:p-10 shadow-sm border border-border-warm text-center">
        <span class="material-symbols-outlined text-[40px] text-primary-container mb-3 inline-block">add_a_photo</span>
        <h3 class="font-headline-md text-headline-md text-deep-forest font-bold mb-2">
          <?= e(ps_text('क्या आपके पास सारंग जी की ऐतिहासिक तस्वीरें हैं?', 'Do You Have Archival Photos of Pradeep Sarang Ji?')) ?>
        </h3>
        <p class="font-body-md text-body-md text-on-surface-variant max-w-xl mx-auto mb-6">
          <?= e(ps_text('यदि आपके पास 1987 से 2026 के मध्य किसी कार्यक्रम, पौधारोपण, सकोरा वितरण या कवि सम्मेलन की पुरानी तस्वीरें हैं, तो कृपया हमारे आधिकारिक डिजिटल अभिलेखागार में साझा करें।', 'If you possess old photographs of past campaigns, poetry meets, or village drives, please share them for our digital archive.')) ?>
        </p>

        <div class="flex flex-wrap items-center justify-center gap-3">
          <a href="https://wa.me/919919007190" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-2 bg-primary-container hover:bg-deep-forest text-on-primary px-6 py-3 rounded-xl font-label-md text-label-md transition-colors shadow-sm font-bold">
            <span class="material-symbols-outlined text-[18px]">chat</span>
            <span><?= e(ps_text('WhatsApp पर भेजें (+91 9919007190)', 'Send on WhatsApp')) ?></span>
          </a>
          <a href="mailto:<?= e($email) ?>" class="inline-flex items-center gap-2 bg-cream-canvas hover:bg-surface-container text-deep-forest px-6 py-3 rounded-xl font-label-md text-label-md transition-colors border border-border-warm font-semibold">
            <span class="material-symbols-outlined text-[18px]">mail</span>
            <span><?= e(ps_text('ईमेल से साझा करें', 'Share via Email')) ?></span>
          </a>
        </div>
      </div>
    </div>
  </section>
</div>

<!-- Interactive Client-side Filter Script -->
<script>
  (function() {
    const filterBtns = document.querySelectorAll('.gallery-filter-btn');
    const photoCards = document.querySelectorAll('#gallery-grid .gallery-card');

    filterBtns.forEach(btn => {
      btn.addEventListener('click', () => {
        const filter = btn.getAttribute('data-filter');

        // Toggle active button style
        filterBtns.forEach(b => {
          b.classList.remove('bg-primary-container', 'text-on-primary', 'shadow-sm');
          b.classList.add('bg-pure-white', 'text-on-surface-variant');
        });
        btn.classList.remove('bg-pure-white', 'text-on-surface-variant');
        btn.classList.add('bg-primary-container', 'text-on-primary', 'shadow-sm');

        // Filter cards
        photoCards.forEach(card => {
          const category = card.getAttribute('data-category');
          if (filter === 'all' || category === filter) {
            card.style.display = 'flex';
          } else {
            card.style.display = 'none';
          }
        });
      });
    });
  })();
</script>
