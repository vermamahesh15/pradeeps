<?php
declare(strict_types=1);

$timeline = $timeline ?? [];
$phone = trim($settings['phone'] ?? '+91 9919007190');
$phoneClean = preg_replace('/[^+0-9]/', '', $phone);
$email = trim($settings['email'] ?? 'contact@pradeepsarang.in');

$defaultJourney = [
    [
        'year' => '2026',
        'decade' => '2020s',
        'title' => ps_text('चार दशकों का अविरल सेवा महोत्सव', 'Four Decades of Service Milestone'),
        'tag' => ps_text('वर्तमान दौर', 'Current Era'),
        'location' => ps_text('बाराबंकी व सम्पूर्ण अवध क्षेत्र', 'Barabanki & Awadh Region'),
        'description' => ps_text('1987 से आरंभ हुई निःस्वार्थ जनसेवा यात्रा आज 39वें वर्ष में प्रवेश कर चुकी है। 50,000+ वृक्षों का संरक्षण, 10,000+ मिट्टी के पक्षी जल-सकोरे एवं अवधी साहित्य की अनवरत रचनाशीलता जारी है।', 'Completing 39 years of dedicated community service, environmental conservation, bird care, and Awadhi literary creations.'),
        'icon' => 'verified',
        'badge' => ps_text('39 वर्ष साधना', '39th Year'),
    ],
    [
        'year' => '2025',
        'decade' => '2020s',
        'title' => ps_text('गंगा साहित्य रत्न व समाज गौरव सम्मान', 'Ganga Sahitya Ratna & Samaj Gaurav'),
        'tag' => ps_text('राष्ट्रीय सम्मान', 'National Honor'),
        'location' => ps_text('गंगा साहित्य मंच व NGO महासंघ', 'Ganga Sahitya Forum'),
        'description' => ps_text('लोक-कल्याणकारी पत्रकारिता, पर्यावरण संवर्धन तथा अवधी लोक-साहित्य के संरक्षण हेतु राष्ट्रीय स्तर के सामाजिक मंच द्वारा सर्वसम्मति से अलंकृत।', 'Conferred Ganga Sahitya Ratna & Samaj Gaurav for grassroots journalism, environment protection, and Awadhi prose.'),
        'icon' => 'military_tech',
        'badge' => ps_text('राष्ट्रीय अलंकरण', 'National Award'),
    ],
    [
        'year' => '2024',
        'decade' => '2020s',
        'title' => ps_text('अटल प्रतिभा एवं अवध ज्योति सृजन सम्मान', 'Atal Pratibha & Awadh Jyoti Srijan Honor'),
        'tag' => ps_text('हिंदी संस्थान मंच', 'Hindi Sansthan'),
        'location' => ps_text('लखनऊ, उत्तर प्रदेश', 'Lucknow, UP'),
        'description' => ps_text('उत्तर प्रदेश हिंदी संस्थान सहयोगी मंच द्वारा \'अटल प्रतिभा सम्मान\' तथा अवधी संस्मरण संकलन \'झरिहख\' हेतु विशेष सारस्वत सम्मान।', 'Conferred Atal Pratibha Honor by UP Hindi Sansthan partner forum for Awadhi literary works.'),
        'icon' => 'edit_note',
        'badge' => ps_text('साहित्य सृजन', 'Literary Honor'),
    ],
    [
        'year' => '2023',
        'decade' => '2020s',
        'title' => ps_text('राष्ट्रीय आदिवासी गौरव एवं अल्लामा इकबाल अवार्ड', 'National Tribal Pride & Iqbal Award'),
        'tag' => ps_text('सांस्कृतिक विरासत', 'Cultural Heritage'),
        'location' => ps_text('राष्ट्रीय सांस्कृतिक मंच', 'National Platform'),
        'description' => ps_text('वंचित व वनवासी समुदायों के सांस्कृतिक संरक्षण हेतु \'राष्ट्रीय आदिवासी गौरव सम्मान\' एवं भाषा उत्सव में प्रतिष्ठित \'अल्लामा इकबाल अवार्ड\'।', 'Conferred National Tribal Pride Award for native folk culture preservation.'),
        'icon' => 'workspace_premium',
        'badge' => ps_text('सांस्कृतिक एकता', 'Cultural Unity'),
    ],
    [
        'year' => '2022',
        'decade' => '2020s',
        'title' => ps_text('जनकवि बंशीधर शुक्ल व गोस्वामी तुलसीदास सम्मान', 'Banshidhar Shukla & Tulsi Award'),
        'tag' => ps_text('अवधी साहित्य त्रिवेणी', 'Awadhi Awards'),
        'location' => ps_text('अवधी साहित्य परिषद', 'Awadhi Sahitya Parishad'),
        'description' => ps_text('\'प्रकृति साहित्य रत्न\', सुप्रसिद्ध \'जनकवि बंशीधर शुक्ल पुरस्कार\' एवं अवधी भाषा की दीर्घकालिक सेवा हेतु प्रतिष्ठित \'गोस्वामी तुलसीदास सम्मान\' से विभूषित।', 'Honored with Banshidhar Shukla Award and Goswami Tulsidas Award for lifetime Awadhi literary service.'),
        'icon' => 'auto_stories',
        'badge' => ps_text('अवधी शिरोमणि', 'Awadhi Pinnacle'),
    ],
    [
        'year' => '2020',
        'decade' => '2020s',
        'title' => ps_text('कोरोना योद्धा विशिष्ट जनसेवा अभियान', 'Corona Warrior Emergency Service'),
        'tag' => ps_text('महामारी सेवा', 'COVID-19 Relief'),
        'location' => ps_text('बाराबंकी ग्रामीण अंचल', 'Barabanki Rural'),
        'description' => ps_text('कोविड-19 संकट के दौरान अग्रिम मोर्चे पर रहकर ग्रामीण असहायों को भोजन, दवा, मास्क वितरण एवं आपातकालीन जीवनरक्षक सुविधाएं पहुँचाईं।', 'Honored as Corona Warrior for frontline food, mask, and emergency medical relief drives.'),
        'icon' => 'shield',
        'badge' => ps_text('कोरोना योद्धा', 'Corona Warrior'),
    ],
    [
        'year' => '2019',
        'decade' => '2010s',
        'title' => ps_text('\'ग्रीन गैंग\' की स्थापना एवं \'ग्रीन मॉर्निंग\' का प्रदुर्भाव', 'Establishment of Green Gang & Green Morning'),
        'tag' => ps_text('पर्यावरण क्रांति', 'Eco Revolution'),
        'location' => ps_text('5 जून 2019 • विश्व पर्यावरण दिवस', '5 June 2019 • World Environment Day'),
        'description' => ps_text('पर्यावरण संरक्षण हेतु \'ग्रीन गैंग\' का गठन। अभिवादन में \'गुड मॉर्निंग\' की जगह \'ग्रीन मॉर्निंग\' (Green Morning) बोलने का अभिनव संस्कार अवध के चौपालों में रोपा।', 'Founded Green Gang on World Environment Day, popularizing Green Morning greetings across Awadh.'),
        'icon' => 'forest',
        'badge' => ps_text('ग्रीन गैंग जनक', 'Green Gang Founder'),
    ],
    [
        'year' => '2018',
        'decade' => '2010s',
        'title' => ps_text('सेवा रत्न एवं अवध ज्योति रजत जयंती समारोह', 'Seva Ratna & Awadh Jyoti Silver Jubilee'),
        'tag' => ps_text('बाल कल्याण व साहित्य', 'Child Welfare'),
        'location' => ps_text('अवध ज्योति संस्थान', 'Awadh Jyoti Institute'),
        'description' => ps_text('महिला एवं बाल कल्याण हेतु \'सेवा रत्न सम्मान\' तथा अवधी साहित्य में अनवरत योगदान हेतु अवध ज्योति पत्रिका के रजत जयंती समारोह में सम्मान।', 'Seva Ratna & Awadh Jyoti Silver Jubilee Honor for contributions to Awadhi prose.'),
        'icon' => 'menu_book',
        'badge' => ps_text('सेवा रत्न', 'Seva Ratna'),
    ],
    [
        'year' => '2016',
        'decade' => '2010s',
        'title' => ps_text('वन्य जीव व परिंदा संरक्षण सम्मान (वन मंत्री, उ.प्र.)', 'Wildlife & Bird Conservation Honor'),
        'tag' => ps_text('शासन स्तर', 'State Government'),
        'location' => ps_text('उत्तर प्रदेश शासन, लखनऊ', 'UP Govt, Lucknow'),
        'description' => ps_text('उत्तर प्रदेश शासन के तत्कालीन माननीय वन मंत्री द्वारा पर्यावरण, पक्षी संरक्षण और 10,000+ सकोरा अभियानों के लिए राज्य स्तरीय प्रशस्ति पत्र।', 'Awarded UP State Wildlife Conservation Citation by UP Forest Minister.'),
        'icon' => 'nature',
        'badge' => ps_text('राज्य प्रशस्ति पत्र', 'State Citation'),
    ],
    [
        'year' => '2015',
        'decade' => '2010s',
        'title' => ps_text('रेडक्रॉस सोसाइटी एवं जिला प्रशासन सम्मान', 'Red Cross & District Police Honor'),
        'tag' => ps_text('स्वास्थ्य व सुरक्षा', 'Health & Safety'),
        'location' => ps_text('रेडक्रॉस सोसाइटी, बाराबंकी', 'Red Cross Barabanki'),
        'description' => ps_text('रेडक्रॉस सोसाइटी तथा जिला प्रशासन एवं पुलिस उपाधीक्षक द्वारा सामाजिक सेवा शिविरों के सफल संचालन हेतु विशेष सम्मान पत्र।', 'Red Cross Society citation for blood donation camps and emergency assistance.'),
        'icon' => 'medical_services',
        'badge' => ps_text('रेडक्रॉस सम्मान', 'Red Cross'),
    ],
    [
        'year' => '2010',
        'decade' => '2010s',
        'title' => ps_text('नियमित रक्तदान शिविर एवं सार्वजनिक नागरिक अभिनंदन', 'Regular Blood Donation & Civic Honor'),
        'tag' => ps_text('रक्तदान चेतना', 'Blood Donation'),
        'location' => ps_text('बाराबंकी प्रबुद्ध मंच', 'Barabanki Citizens'),
        'description' => ps_text('सैकड़ों रक्तदान शिविरों के संचालन, आपातकालीन रक्त व्यवस्था एवं विश्वकर्मा जयंती पर जनपदवासियों द्वारा सार्वजनिक नागरिक अभिनंदन।', 'Honored by District Magistrate and citizens for regular emergency blood donation drives.'),
        'icon' => 'volunteer_activism',
        'badge' => ps_text('नागरिक अभिनंदन', 'Civic Honor'),
    ],
    [
        'year' => '1997',
        'decade' => '1990s',
        'title' => ps_text('आयुर्वेद रत्न उपाधि विभूषण', 'Ayurveda Ratna Conferred'),
        'tag' => ps_text('वानस्पतिक ज्ञान', 'Botanical Healing'),
        'location' => ps_text('आयुर्वेदिक चिकित्सा परिषद', 'Ayurvedic Medical Council'),
        'description' => ps_text('पारंपरिक भारतीय चिकित्सा पद्धति, वानस्पतिक जड़ी-बूटियों एवं लोक-स्वास्थ्य के गहन अध्ययन हेतु \'आयुर्वेद रत्न\' की प्रतिष्ठित उपाधि से विभूषित।', 'Conferred Ayurveda Ratna degree for traditional herbal and botanical healthcare studies.'),
        'icon' => 'psychiatry',
        'badge' => ps_text('आयुर्वेद रत्न', 'Ayurveda Ratna'),
    ],
    [
        'year' => '1992',
        'decade' => '1990s',
        'title' => ps_text('नेहरू युवा केन्द्र (NYK) जिला युवा पुरस्कार', 'Nehru Yuva Kendra District Youth Award'),
        'tag' => ps_text('युवा कार्यक्रम भारत सरकार', 'Govt of India'),
        'location' => ps_text('युवा कार्यक्रम एवं खेल मंत्रालय', 'Ministry of Youth Affairs'),
        'description' => ps_text('नेहरू युवा केन्द्र भारत सरकार द्वारा जनपद स्तर पर युवा जागरण, खेलकूद एवं ग्रामीण समाजसेवा में सर्वोत्कृष्ट कार्य के लिए प्रतिष्ठित पुरस्कार।', 'Awarded District Youth Award by Nehru Yuva Kendra, Ministry of Youth Affairs, Govt of India.'),
        'icon' => 'military_tech',
        'badge' => ps_text('भारत सरकार सम्मान', 'Govt of India'),
    ],
    [
        'year' => '1991',
        'decade' => '1990s',
        'title' => ps_text('महामहिम राज्यपाल द्वारा स्वामी विवेकानंद युवा पुरस्कार', 'Governor Youth Award (Raj Bhavan)'),
        'tag' => ps_text('राज्य का सर्वोच्च युवा पुरस्कार', 'Highest Youth Honor'),
        'location' => ps_text('राजभवन, लखनऊ', 'Raj Bhavan, Lucknow'),
        'description' => ps_text('युवाओं के सर्वांगीण विकास एवं सामाजिक सेवा में अप्रतिम योगदान हेतु तत्कालीन महामहिम राज्यपाल, उत्तर प्रदेश के कर-कमलों द्वारा राजभवन में सम्मानित।', 'Conferred UP\'s highest youth state award by the Governor of Uttar Pradesh at Raj Bhavan, Lucknow.'),
        'icon' => 'stars',
        'badge' => ps_text('राजभवन अलंकरण', 'Raj Bhavan Award'),
    ],
    [
        'year' => '1988',
        'decade' => '1980s',
        'title' => ps_text('गणतंत्र दिवस राष्ट्रीय परेड (NSS नई दिल्ली शिविर)', 'Republic Day National Parade Camp (NSS)'),
        'tag' => ps_text('राष्ट्रीय गौरव', 'National Flag Parade'),
        'location' => ps_text('राजपथ, नई दिल्ली', 'Rajpath, New Delhi'),
        'description' => ps_text('ऐतिहासिक क्षण: नई दिल्ली में इंडिया गेट पर 26 जनवरी गणतंत्र दिवस राष्ट्रीय परेड में उत्तर प्रदेश NSS दल के प्रतिनिधि के रूप में ऐतिहासिक मार्च-पास्ट।', 'Represented UP NSS contingent at 26th January Republic Day National Parade Camp at Rajpath, New Delhi.'),
        'icon' => 'flag',
        'badge' => ps_text('गणतंत्र दिवस परेड', 'Republic Day'),
    ],
    [
        'year' => '1987',
        'decade' => '1980s',
        'title' => ps_text('राष्ट्रीय सेवा योजना (NSS) व युवक मंगल दल से प्रथम संकल्प', 'First Pledge with NSS & Yuvak Mangal Dal'),
        'tag' => ps_text('जनसेवा का पावन प्रारंभ', 'Beginning of Service'),
        'location' => ps_text('ग्राम कमरावाँ, बाराबंकी', 'Kamrawan, Barabanki'),
        'description' => ps_text('1987 में राष्ट्रीय सेवा योजना (NSS) के नैतिक संस्कारों एवं स्वामी विवेकानंद के दर्शन से प्रेरित होकर लोक-सेवा का प्रथम दीप प्रज्वलित किया।', 'Began lifelong social service journey inspired by NSS ethics and Swami Vivekananda ideals.'),
        'icon' => 'sports_volleyball',
        'badge' => ps_text('प्रथम दीप', 'First Spark 1987'),
    ],
];

// Merge DB timeline entries if present
$dbJourney = [];
foreach ($timeline as $tItem) {
    if (!empty($tItem['year']) && !empty($tItem['title'])) {
        $yr = (string)$tItem['year'];
        $dec = preg_match('/^(19|20)\d{2}$/', $yr) ? substr($yr, 0, 3) . '0s' : '2020s';
        $isAward = ($tItem['entry_type'] ?? '') === 'award' || preg_match('/सम्मान|पुरस्कार|प्रशस्ति|award|recognition/iu', $tItem['title']);
        $dbJourney[] = [
            'year' => $yr,
            'decade' => $dec,
            'title' => $tItem['title'],
            'tag' => $isAward ? ps_text('सम्मान व पुरस्कार', 'Award & Honor') : ps_text('सेवा यात्रा पड़ाव', 'Seva Yatra Milestone'),
            'location' => ps_text('बाराबंकी, उ.प्र.', 'Barabanki, UP'),
            'description' => $tItem['description'] ?? '',
            'icon' => $isAward ? 'emoji_events' : 'verified',
            'badge' => $isAward ? ps_text('राष्ट्रीय सम्मान', 'Honor & Recognition') : ps_text('आधिकारिक पड़ाव', 'Official Entry'),
            'image' => $tItem['image'] ?? '',
        ];
    }
}

$allMilestones = !empty($dbJourney) ? array_merge($dbJourney, $defaultJourney) : $defaultJourney;
?>

<div class="flex flex-col w-full">
  <!-- Top Breadcrumb & Hero Header -->
  <section class="relative w-full bg-soft-meadow overflow-hidden py-space-2xl md:py-space-3xl border-b border-border-warm">
    <div class="max-w-container-max mx-auto px-4 sm:px-8 relative z-10">
      <!-- Breadcrumb -->
      <nav aria-label="Breadcrumb" class="flex items-center gap-2 font-label-md text-label-md text-text-muted mb-space-sm">
        <a class="hover:text-primary transition-colors flex items-center gap-1" data-path="home" href="<?= e(base_url('/')) ?>">
          <span class="material-symbols-outlined text-[16px]">home</span>
          <span><?= e(ps_text('गृह (Home)', 'Home')) ?></span>
        </a>
        <span class="opacity-40">/</span>
        <span class="text-deep-forest font-semibold"><?= e(ps_text('सेवा यात्रा एवं कालक्रम (Journey)', 'Service Journey')) ?></span>
      </nav>

      <!-- Badge & Main Title -->
      <div class="max-w-4xl">
        <div class="inline-flex items-center gap-2 bg-primary-fixed/40 text-deep-forest px-3.5 py-1 rounded-full font-label-sm text-label-sm mb-space-sm border border-border-warm font-semibold">
          <span class="material-symbols-outlined text-[15px] text-primary-container" style="font-variation-settings: 'FILL' 1;">timeline</span>
          <span><?= e(ps_text('चार दशकों की अनवरत लोक-सेवा यात्रा (1987 से आज तक)', 'Four Decades of Continuous Service Journey (1987 — Present)')) ?></span>
        </div>
        <h1 class="font-display-hero text-headline-lg md:text-display-hero text-deep-forest leading-tight tracking-tight font-bold">
          <?= e(ps_text('माटी का सरोकार, जनसेवा का संकल्प और चार दशकों की साधना', 'Rooted in Service, Nature & Awadhi Heritage Across 39 Years')) ?>
        </h1>
        <p class="font-body-lg text-body-lg text-text-muted mt-space-sm max-w-3xl leading-relaxed">
          <?= e(ps_text('1987 में राष्ट्रीय सेवा योजना (NSS) से शुरू हुई जनसेवा, 1991 का राजभवन स्वामी विवेकानंद पुरस्कार, 2019 का ग्रीन गैंग आंदोलन एवं आज तक अनवरत जारी 50,000+ पौधरोपण का सजीव इतिहास।', 'From the 1987 NSS pledge to the 1991 Raj Bhavan Youth Award, the 2019 Green Gang revolution, and ongoing 50,000+ tree planting.')) ?>
        </p>
      </div>

      <!-- 2-Photo Milestone Archive Showcase -->
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-8">
        <div class="relative rounded-2xl overflow-hidden shadow-sm border border-border-warm group">
          <img src="<?= e(base_url('assets/images/sardar_patel.webp')) ?>" alt="Raj Bhavan Award 1991" class="w-full h-52 object-cover group-hover:scale-105 transition-transform duration-300">
          <div class="absolute bottom-0 inset-x-0 bg-gradient-to-t from-deep-forest/90 via-deep-forest/50 to-transparent p-4 text-pure-white">
            <span class="font-label-sm text-label-sm uppercase tracking-wider text-tertiary-fixed font-bold"><?= e(ps_text('1991 राजभवन युवा पुरस्कार', '1991 Raj Bhavan Youth Award')) ?></span>
            <p class="font-title-md text-title-md font-bold mt-0.5"><?= e(ps_text('महामहिम राज्यपाल द्वारा स्वामी विवेकानंद युवा सम्मान', 'Governor State Award Presentation Ceremony')) ?></p>
          </div>
        </div>
        <div class="relative rounded-2xl overflow-hidden shadow-sm border border-border-warm group">
          <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuChrvMjaMrNe9mnv0wsNeczsA9QTsVBVexwNC6wWD2ITtZGUqAqC4rJlu14alM7uVOx3q6e6QMugj2k_SVptJFwJxqw4kgUmkZfc4oZSwOSInUiqwcST-ZVxWP0dQNinxgeGayBKo9MBnd0LReS_tvv8rW_e0uWQz8FI_1PBQ_sze_mt4-UezPUkio4HIFKvoUNP0kZ6gNLPilWihHeDYhJaX6ySBPHJHVKOu68a1dbF1aYaqyDO7Db" alt="Green Gang Launch 2019" class="w-full h-52 object-cover group-hover:scale-105 transition-transform duration-300">
          <div class="absolute bottom-0 inset-x-0 bg-gradient-to-t from-deep-forest/90 via-deep-forest/50 to-transparent p-4 text-pure-white">
            <span class="font-label-sm text-label-sm uppercase tracking-wider text-fresh-sprout font-bold"><?= e(ps_text('2019 ग्रीन गैंग आंदोलन', '2019 Green Gang Movement Launch')) ?></span>
            <p class="font-title-md text-title-md font-bold mt-0.5"><?= e(ps_text('विश्व पर्यावरण दिवस से शुरू हुआ हरित संकल्प', 'Green Morning & Tree Planting Movement Launch')) ?></p>
          </div>
        </div>
      </div>

      <!-- Filter Tabs by Decade -->
      <div class="flex items-center gap-2 mt-8 overflow-x-auto pb-2 -mx-4 px-4 sm:mx-0 sm:px-0 sm:flex-wrap shrink-0 cursor-grab" id="journey-filter-tabs">
        <button type="button" data-filter="all" class="journey-filter-btn px-4 py-2 rounded-full font-label-sm text-label-sm bg-primary-container text-on-primary shadow-sm font-semibold transition-all cursor-pointer">
          <?= e(ps_text('सभी पड़ाव (All)', 'All Milestones')) ?>
        </button>
        <button type="button" data-filter="2020s" class="journey-filter-btn px-4 py-2 rounded-full font-label-sm text-label-sm bg-pure-white text-on-surface-variant hover:bg-surface-container border border-border-warm font-medium transition-all cursor-pointer">
          🌿 <?= e(ps_text('2020 — 2026 (वर्तमान)', '2020 — 2026')) ?>
        </button>
        <button type="button" data-filter="2010s" class="journey-filter-btn px-4 py-2 rounded-full font-label-sm text-label-sm bg-pure-white text-on-surface-variant hover:bg-surface-container border border-border-warm font-medium transition-all cursor-pointer">
          🌱 <?= e(ps_text('2010 — 2019 (हरियाली)', '2010 — 2019')) ?>
        </button>
        <button type="button" data-filter="1990s" class="journey-filter-btn px-4 py-2 rounded-full font-label-sm text-label-sm bg-pure-white text-on-surface-variant hover:bg-surface-container border border-border-warm font-medium transition-all cursor-pointer">
          🏆 <?= e(ps_text('1990 — 1999 (युवा जागरण)', '1990 — 1999')) ?>
        </button>
        <button type="button" data-filter="1980s" class="journey-filter-btn px-4 py-2 rounded-full font-label-sm text-label-sm bg-pure-white text-on-surface-variant hover:bg-surface-container border border-border-warm font-medium transition-all cursor-pointer">
          🇮🇳 <?= e(ps_text('1987 — 1989 (प्रथम संकल्प)', '1987 — 1989')) ?>
        </button>
      </div>
    </div>
  </section>

  <!-- Key Milestone Metrics Banner -->
  <section class="w-full bg-deep-forest text-pure-white py-space-xl">
    <div class="max-w-container-max mx-auto px-4 sm:px-8">
      <div class="grid grid-cols-2 lg:grid-cols-4 gap-6 text-center">
        <div class="flex flex-col p-4 rounded-xl bg-surface-container-low/10 border border-surface-container-high/15">
          <span class="font-headline-lg text-headline-lg text-primary-fixed leading-none font-bold">1987</span>
          <span class="font-title-md text-title-md text-surface-container-high font-semibold mt-2"><?= e(ps_text('प्रथम जनसेवा संकल्प', 'First Service Pledge')) ?></span>
          <span class="font-label-sm text-label-sm text-surface-container-high/80 mt-1"><?= e(ps_text('NSS एवं युवक मंगल दल', 'NSS & Yuvak Mangal Dal')) ?></span>
        </div>

        <div class="flex flex-col p-4 rounded-xl bg-surface-container-low/10 border border-surface-container-high/15">
          <span class="font-headline-lg text-headline-lg text-tertiary-fixed leading-none font-bold">1991</span>
          <span class="font-title-md text-title-md text-surface-container-high font-semibold mt-2"><?= e(ps_text('राजभवन अलंकरण', 'Raj Bhavan Award')) ?></span>
          <span class="font-label-sm text-label-sm text-surface-container-high/80 mt-1"><?= e(ps_text('स्वामी विवेकानंद युवा पुरस्कार', 'Swami Vivekananda Award')) ?></span>
        </div>

        <div class="flex flex-col p-4 rounded-xl bg-surface-container-low/10 border border-surface-container-high/15">
          <span class="font-headline-lg text-headline-lg text-secondary-fixed leading-none font-bold">2019</span>
          <span class="font-title-md text-title-md text-surface-container-high font-semibold mt-2"><?= e(ps_text('ग्रीन गैंग क्रांति', 'Green Gang Revolution')) ?></span>
          <span class="font-label-sm text-label-sm text-surface-container-high/80 mt-1"><?= e(ps_text('\'ग्रीन मॉर्निंग\' अभिवादन', 'Green Morning Greetings')) ?></span>
        </div>

        <div class="flex flex-col p-4 rounded-xl bg-surface-container-low/10 border border-surface-container-high/15">
          <span class="font-headline-lg text-headline-lg text-primary-fixed leading-none font-bold">39 <?= e(ps_text('वर्ष', 'Yrs')) ?></span>
          <span class="font-title-md text-title-md text-surface-container-high font-semibold mt-2"><?= e(ps_text('अनवरत ज़मीनी साधना', 'Grassroots Dedication')) ?></span>
          <span class="font-label-sm text-label-sm text-surface-container-high/80 mt-1"><?= e(ps_text('50,000+ पौधरोपण संरक्षण', '50,000+ Trees Planted')) ?></span>
        </div>
      </div>
    </div>
  </section>

  <!-- Complete Chronological Vertical Journey Grid -->
  <section class="w-full bg-cream-canvas py-space-3xl">
    <div class="max-w-container-max mx-auto px-4 sm:px-8">
      <div class="flex flex-col md:flex-row md:items-end justify-between mb-space-xl gap-4">
        <div>
          <span class="font-label-sm text-label-sm text-secondary tracking-widest font-bold uppercase"><?= e(ps_text('ऐतिहासिक पड़ाव', 'Historical Timeline')) ?></span>
          <h2 class="font-headline-lg text-headline-md md:text-headline-lg text-deep-forest font-bold mt-1">
            <?= e(ps_text('सेवा यात्रा के सजीव पड़ाव एवं स्मरणीय मील के पत्थर', 'Milestones & Memories Across 39 Years')) ?>
          </h2>
        </div>
        <p class="font-body-sm text-body-sm text-text-muted max-w-md">
          <?= e(ps_text('प्रत्येक पड़ाव ग्रामीण सशक्तिकरण, पर्यावरण संवर्धन और अवधी संस्कृति का सजीव दस्तावेज है।', 'Each milestone documents rural empowerment, environmental care, and Awadhi heritage.')) ?>
        </p>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" id="journey-grid">
        <?php foreach ($allMilestones as $m): ?>
          <div class="journey-card group bg-pure-white rounded-3xl p-6 sm:p-7 shadow-sm border border-border-warm hover:shadow-md transition-all flex flex-col justify-between" data-category="<?= e($m['decade']) ?>">
            <div>
              <div class="flex items-center justify-between mb-4">
                <span class="font-headline-lg text-headline-md text-primary-container font-bold"><?= e($m['year']) ?></span>
                <span class="bg-primary-fixed/40 text-primary-container font-label-sm text-label-sm px-3 py-1 rounded-full font-bold border border-border-warm">
                  <?= e($m['badge']) ?>
                </span>
              </div>

              <div class="inline-flex items-center gap-1.5 text-secondary font-label-sm text-label-sm font-semibold uppercase mb-2">
                <span class="material-symbols-outlined text-[16px]"><?= e($m['icon'] ?? 'star') ?></span>
                <span><?= e($m['tag']) ?></span>
              </div>

              <h3 class="font-headline-sm text-headline-sm text-deep-forest font-bold mb-3 group-hover:text-primary transition-colors">
                <?= e($m['title']) ?>
              </h3>

              <p class="font-body-md text-body-md text-on-surface-variant leading-relaxed mb-6">
                <?= e($m['description']) ?>
              </p>
            </div>

            <div class="pt-4 border-t border-border-warm flex items-center justify-between text-text-muted font-label-sm text-label-sm font-semibold">
              <span class="flex items-center gap-1">
                <span class="material-symbols-outlined text-[15px] text-secondary">location_on</span>
                <?= e($m['location']) ?>
              </span>
              <span class="text-deep-forest font-bold"><?= e($m['decade']) ?></span>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <!-- Join the Journey CTA Section -->
  <section class="w-full bg-soft-meadow py-space-3xl border-t border-border-warm">
    <div class="max-w-container-editorial mx-auto px-4 sm:px-8">
      <div class="bg-pure-white rounded-3xl p-6 sm:p-10 shadow-sm border border-border-warm text-center">
        <span class="material-symbols-outlined text-[44px] text-primary-container mb-3 inline-block">handshake</span>
        <h3 class="font-headline-md text-headline-md text-deep-forest font-bold mb-2">
          <?= e(ps_text('2026 की जारी सेवा यात्रा का हिस्सा बनें', 'Become Part of the Ongoing 2026 Journey')) ?>
        </h3>
        <p class="font-body-md text-body-md text-on-surface-variant max-w-xl mx-auto mb-6">
          <?= e(ps_text('चाहे आपके क्षेत्र में ग्रीन गैंग की शाखा शुरू करनी हो, सकोरा बैंक स्थापित करना हो या अवधी साहित्य शोध — आपका स्वागत है।', 'Join as a Green Gang volunteer, request bird water bowls, or organize Awadhi literature sessions.')) ?>
        </p>

        <div class="flex flex-wrap items-center justify-center gap-3">
          <a href="<?= e(base_url('/volunteer')) ?>" class="inline-flex items-center gap-2 bg-primary-container hover:bg-deep-forest text-on-primary px-6 py-3.5 rounded-xl font-label-md text-label-md transition-colors shadow-sm font-bold">
            <span class="material-symbols-outlined text-[18px]">group_add</span>
            <span><?= e(ps_text('स्वयंसेवक के रूप में जुड़ें', 'Join as Volunteer')) ?></span>
          </a>
          <a href="tel:<?= e($phoneClean) ?>" class="inline-flex items-center gap-2 bg-cream-canvas hover:bg-surface-container text-deep-forest px-6 py-3.5 rounded-xl font-label-md text-label-md transition-colors border border-border-warm font-semibold">
            <span class="material-symbols-outlined text-[18px]">call</span>
            <span><?= e(ps_text('सीधा संवाद करें (' . $phone . ')', 'Call ' . $phone)) ?></span>
          </a>
        </div>
      </div>
    </div>
  </section>
</div>

<!-- Interactive Client-side Filter Script -->
<script>
  (function() {
    const filterBtns = document.querySelectorAll('.journey-filter-btn');
    const journeyCards = document.querySelectorAll('#journey-grid .journey-card');

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
        journeyCards.forEach(card => {
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
