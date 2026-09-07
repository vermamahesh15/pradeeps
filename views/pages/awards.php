<?php
declare(strict_types=1);

$items = $items ?? [];
$phone = trim($settings['phone'] ?? '+91 9919007190');
$phoneClean = preg_replace('/[^+0-9]/', '', $phone);
$email = trim($settings['email'] ?? 'contact@pradeepsarang.in');

// Pre-defined authentic historical honors timeline
$defaultHonors = [
    [
        'year' => '2025',
        'decade' => '2020s',
        'title' => ps_text('समाज गौरव एवं गंगा साहित्य रत्न', 'Samaj Gaurav & Ganga Sahitya Ratna'),
        'authority' => ps_text('गंगा साहित्य मंच एवं NGO महासंघ', 'Ganga Sahitya Forum & NGO Federation'),
        'category' => 'national',
        'badge' => ps_text('राष्ट्रीय सम्मान', 'National Honor'),
        'description' => ps_text('लोक-कल्याणकारी पत्रकारिता, पर्यावरण संरक्षण एवं अवधी साहित्य की चार दशकों की अनवरत सेवा हेतु राष्ट्रीय स्तर पर सर्वोच्च अलंकरण प्रदान किया गया।', 'Conferred Ganga Sahitya Ratna & Samaj Gaurav for grassroots journalism, environment protection, and Awadhi prose.'),
        'icon' => 'military_tech',
    ],
    [
        'year' => '2024',
        'decade' => '2020s',
        'title' => ps_text('अटल प्रतिभा एवं अवध ज्योति सृजन सम्मान', 'Atal Pratibha & Awadh Jyoti Srijan Honor'),
        'authority' => ps_text('उत्तर प्रदेश हिंदी संस्थान मंच', 'UP Hindi Sansthan Forum'),
        'category' => 'literary',
        'badge' => ps_text('साहित्य सम्मान', 'Literary Award'),
        'description' => ps_text('उत्तर प्रदेश हिंदी संस्थान सहयोगी मंच द्वारा \'अटल प्रतिभा सम्मान\' तथा अवधी साहित्य में विशिष्ट शोधपरक योगदान हेतु सारस्वत सम्मान।', 'Conferred Atal Pratibha Honor by UP Hindi Sansthan partner forum for Awadhi literary works.'),
        'icon' => 'edit_note',
    ],
    [
        'year' => '2023',
        'decade' => '2020s',
        'title' => ps_text('राष्ट्रीय आदिवासी गौरव एवं अल्लामा इकबाल अवार्ड', 'National Tribal Pride & Iqbal Award'),
        'authority' => ps_text('राष्ट्रीय सांस्कृतिक मंच', 'National Cultural Platform'),
        'category' => 'national',
        'badge' => ps_text('राष्ट्रीय सम्मान', 'National Award'),
        'description' => ps_text('वंचित व वनवासी समुदायों के सांस्कृतिक संरक्षण हेतु \'राष्ट्रीय आदिवासी गौरव सम्मान\' एवं भाषा उत्सव में प्रतिष्ठित \'अल्लामा इकबाल अवार्ड\'।', 'Conferred National Tribal Pride Award for native folk culture preservation.'),
        'icon' => 'workspace_premium',
    ],
    [
        'year' => '2022',
        'decade' => '2020s',
        'title' => ps_text('प्रकृति साहित्य रत्न, जनकवि बंशीधर शुक्ल व तुलसी सम्मान', 'Prakriti Sahitya, Banshidhar Shukla & Tulsi Award'),
        'authority' => ps_text('अवधी भाषा एवं साहित्य परिषद', 'Awadhi Sahitya Parishad'),
        'category' => 'literary',
        'badge' => ps_text('अवधी साहित्य', 'Awadhi Honor'),
        'description' => ps_text('\'प्रकृति साहित्य रत्न\', सुप्रसिद्ध \'जनकवि बंशीधर शुक्ल पुरस्कार\' एवं अवधी भाषा की दीर्घकालिक सेवा हेतु प्रतिष्ठित \'गोस्वामी तुलसीदास सम्मान\' से विभूषित।', 'Honored with Banshidhar Shukla Award and Goswami Tulsidas Award for lifetime Awadhi literary service.'),
        'icon' => 'auto_stories',
    ],
    [
        'year' => '2020',
        'decade' => '2020s',
        'title' => ps_text('कोरोना योद्धा विशिष्ट सम्मान', 'Corona Warrior Citation'),
        'authority' => ps_text('जिला प्रशासन एवं समाज सेवी महासंघ', 'District Administration & NGOs'),
        'category' => 'social',
        'badge' => ps_text('महामारी सेवा', 'COVID-19 Service'),
        'description' => ps_text('कोविड-19 वैश्विक संकट के दौरान ग्रामीण व अर्ध-शहरी अंचलों में असहायों को भोजन, दवा, मास्क वितरण एवं राहत पहुंचाने हेतु अलंकृत।', 'Honored as Corona Warrior for frontline food, mask, and emergency medical relief drives.'),
        'icon' => 'shield',
    ],
    [
        'year' => '2019',
        'decade' => '2010s',
        'title' => ps_text('लोकसभा सामान्य निर्वाचन मतदाता जागरूकता सम्मान', 'Lok Sabha Voter Awareness Citation'),
        'authority' => ps_text('मुख्य निर्वाचन अधिकारी, उत्तर प्रदेश', 'Chief Electoral Officer, UP'),
        'category' => 'national',
        'badge' => ps_text('निर्वाचन आयोग', 'Election Commission'),
        'description' => ps_text('मुख्य निर्वाचन अधिकारी एवं जिला निर्वाचन अधिकारी (बाराबंकी) द्वारा लोकसभा निर्वाचन में शत-प्रतिशत मतदान हेतु सघन अभियान चलाने पर सम्मानित।', 'Awarded Voter Awareness Citation by UP Chief Electoral Officer.'),
        'icon' => 'how_to_vote',
    ],
    [
        'year' => '2018',
        'decade' => '2010s',
        'title' => ps_text('सेवा रत्न एवं अवध ज्योति रजत जयंती सम्मान', 'Seva Ratna & Awadh Jyoti Honor'),
        'authority' => ps_text('अवध ज्योति साहित्य संस्थान', 'Awadh Jyoti Literary Institute'),
        'category' => 'literary',
        'badge' => ps_text('रजत जयंती सम्मान', 'Silver Jubilee'),
        'description' => ps_text('महिला एवं बाल कल्याण हेतु \'सेवा रत्न सम्मान\' तथा अवधी साहित्य में अनवरत योगदान हेतु अवध ज्योति पत्रिका के रजत जयंती समारोह में सारस्वत सम्मान।', 'Seva Ratna & Awadh Jyoti Silver Jubilee Honor for contributions to Awadhi prose.'),
        'icon' => 'menu_book',
    ],
    [
        'year' => '2016',
        'decade' => '2010s',
        'title' => ps_text('वन्य जीव व परिंदा संरक्षण विशिष्ट प्रशस्ति पत्र', 'Wildlife & Bird Conservation Citation'),
        'authority' => ps_text('माननीय वन मंत्री, उत्तर प्रदेश शासन', 'Forest Minister, UP Government'),
        'category' => 'national',
        'badge' => ps_text('राज्य स्तरीय सम्मान', 'State Level'),
        'description' => ps_text('उत्तर प्रदेश शासन के तत्कालीन माननीय वन मंत्री द्वारा पर्यावरण, पक्षी संरक्षण और 10,000+ सकोरा वितरण अभियानों के लिए राज्य स्तरीय प्रशस्ति पत्र प्रदान किया गया।', 'Awarded UP State Wildlife Conservation Citation by UP Forest Minister.'),
        'icon' => 'nature',
    ],
    [
        'year' => '2015',
        'decade' => '2010s',
        'title' => ps_text('भारतीय रेडक्रॉस सोसाइटी सम्मान', 'Indian Red Cross Society Honor'),
        'authority' => ps_text('रेडक्रॉस सोसाइटी एवं जिला पुलिस प्रशासन', 'Red Cross & District Police'),
        'category' => 'social',
        'badge' => ps_text('लोक स्वास्थ्य', 'Public Health'),
        'description' => ps_text('रेडक्रॉस सोसाइटी तथा जिला प्रशासन एवं पुलिस उपाधीक्षक द्वारा सामाजिक सेवा शिविरों व नियमित रक्तदान के सफल संचालन हेतु विशेष सम्मान पत्र।', 'Red Cross Society citation for blood donation camps and disaster response.'),
        'icon' => 'medical_services',
    ],
    [
        'year' => '2010',
        'decade' => '2010s',
        'title' => ps_text('रक्तदान व नागरिक अभिनंदन पत्र', 'Blood Donation & Civic Honor'),
        'authority' => ps_text('जिलाधिकारी एवं प्रबुद्ध नागरिक मंच', 'District Magistrate & Citizens Forum'),
        'category' => 'social',
        'badge' => ps_text('रक्तदान सेवा', 'Blood Donation'),
        'description' => ps_text('नियमित रक्तदान, आपातकालीन रक्त व्यवस्था एवं विश्वकर्मा जयंती के अवसर पर जनपद के प्रबुद्ध नागरिकों द्वारा सार्वजनिक नागरिक अभिनंदन।', 'Honored by District Magistrate for organizing regular emergency blood donation drives.'),
        'icon' => 'volunteer_activism',
    ],
    [
        'year' => '1997',
        'decade' => '1990s',
        'title' => ps_text('आयुर्वेद रत्न उपाधि', 'Ayurveda Ratna Degree'),
        'authority' => ps_text('आयुर्वेदिक चिकित्सा परिषद', 'Ayurvedic Medical Council'),
        'category' => 'literary',
        'badge' => ps_text('पारंपरिक ज्ञान', 'Ayurvedic Medical Science'),
        'description' => ps_text('पारंपरिक भारतीय चिकित्सा पद्धति, वानस्पतिक ज्ञान एवं लोक-स्वास्थ्य के गहन अध्ययन हेतु \'आयुर्वेद रत्न\' की प्रतिष्ठित उपाधि से विभूषित।', 'Conferred Ayurveda Ratna degree for traditional herbal and botanical healthcare studies.'),
        'icon' => 'psychiatry',
    ],
    [
        'year' => '1992',
        'decade' => '1990s',
        'title' => ps_text('जिला युवा पुरस्कार (NYK)', 'District Youth Award (NYK)'),
        'authority' => ps_text('नेहरू युवा केन्द्र, युवा कार्यक्रम एवं खेल मंत्रालय भारत सरकार', 'Nehru Yuva Kendra, Govt of India'),
        'category' => 'national',
        'badge' => ps_text('भारत सरकार', 'Govt of India'),
        'description' => ps_text('नेहरू युवा केन्द्र भारत सरकार द्वारा जनपद स्तर पर युवा जागरण, खेल एवं ग्रामीण समाजसेवा में सर्वश्रेष्ठ कार्य के लिए प्रतिष्ठित पुरस्कार।', 'Awarded District Youth Award by Nehru Yuva Kendra, Ministry of Youth Affairs, Govt of India.'),
        'icon' => 'military_tech',
    ],
    [
        'year' => '1991',
        'decade' => '1990s',
        'title' => ps_text('स्वामी विवेकानंद युवा पुरस्कार', 'Swami Vivekananda Youth Award'),
        'authority' => ps_text('माननीय महामहिम राज्यपाल, उत्तर प्रदेश', 'Governor of Uttar Pradesh'),
        'category' => 'national',
        'badge' => ps_text('राजभवन अलंकरण', 'Raj Bhavan Award'),
        'description' => ps_text('युवाओं के सर्वांगीण विकास एवं सामाजिक सेवा में अप्रतिम योगदान हेतु तत्कालीन महामहिम राज्यपाल, उत्तर प्रदेश के कर-कमलों द्वारा राज्य का सर्वोच्च युवा सम्मान प्रदान किया गया।', 'Conferred UP\'s highest youth state award by the Governor of Uttar Pradesh at Raj Bhavan, Lucknow.'),
        'icon' => 'stars',
    ],
    [
        'year' => '1989',
        'decade' => '1980s',
        'title' => ps_text('रंगमंच अभिनय एवं नेत्र चिकित्सा सेवा सम्मान', 'Theatre Acting & Eye Care Service Award'),
        'authority' => ps_text('संस्कृतिक मंच एवं नेत्र सेवा समिति', 'Cultural Platform & Eye Care Committee'),
        'category' => 'social',
        'badge' => ps_text('रंगमंच व स्वास्थ्य', 'Theatre & Health'),
        'description' => ps_text('पारंपरिक लोक-नाटक एवं एकांकी अभिनय प्रशिक्षण तथा ग्रामीण नेत्र चिकित्सा शिविरों में अनवरत स्वयंसेवी सेवा कार्यों हेतु प्रशस्ति पत्र।', 'Folk drama performance certification and eye camp volunteer service citation.'),
        'icon' => 'theater_comedy',
    ],
    [
        'year' => '1988',
        'decade' => '1980s',
        'title' => ps_text('गणतंत्र दिवस राष्ट्रीय परेड (NSS शिविर)', 'Republic Day NSS National Parade Camp'),
        'authority' => ps_text('राष्ट्रीय सेवा योजना (NSS), नई दिल्ली', 'National Service Scheme, New Delhi'),
        'category' => 'national',
        'badge' => ps_text('राष्ट्रीय गौरव', 'National Flag Parade'),
        'description' => ps_text('ऐतिहासिक क्षण: नई दिल्ली में इंडिया गेट पर 26 जनवरी गणतंत्र दिवस राष्ट्रीय परेड में NSS दल के प्रतिनिधि के रूप में प्रतिभागिता एवं जिलाधिकारी द्वारा विशेष सम्मान।', 'Represented UP NSS contingent at 26th January Republic Day National Parade Camp at Rajpath, New Delhi.'),
        'icon' => 'flag',
    ],
    [
        'year' => '1987',
        'decade' => '1980s',
        'title' => ps_text('अनुशासित युवक एवं खेलकूद पुरस्कार', 'Disciplined Youth & Sports Award'),
        'authority' => ps_text('प्रादेशिक विकास दल एवं युवा कल्याण विभाग', 'Pradeshik Vikas Dal & Youth Welfare Dept'),
        'category' => 'social',
        'badge' => ps_text('युवक मंगल दल', 'Youth Club'),
        'description' => ps_text('क्षेत्रीय खेलकूद में वॉलीबॉल में द्वितीय व 800 मी. दौड़ में तृतीय। युवा कल्याण विभाग द्वारा \'अनुशासित युवक\' अलंकरण।', 'Regional volleyball 2nd & 800m run 3rd place. Awarded Disciplined Youth by Youth Welfare Dept.'),
        'icon' => 'sports_volleyball',
    ],
];

// Merge DB items if timeline table has custom rows
$dbHonors = [];
foreach ($items as $dbItem) {
    if (!empty($dbItem['title'])) {
        $year = (string)($dbItem['year'] ?? '2024');
        $decade = preg_match('/^(19|20)\d{2}$/', $year) ? substr($year, 0, 3) . '0s' : '2020s';
        $dbHonors[] = [
            'year' => $year,
            'decade' => $decade,
            'title' => $dbItem['title'],
            'authority' => ps_text('आधिकारिक अभिलेख', 'Official Record'),
            'category' => 'social',
            'badge' => ps_text('समयरेखा अभिलेख', 'Timeline Record'),
            'description' => $dbItem['description'] ?? '',
            'icon' => 'verified',
        ];
    }
}

$allHonors = !empty($dbHonors) ? array_merge($dbHonors, $defaultHonors) : $defaultHonors;
?>

<div class="flex flex-col w-full">
  <!-- Top Breadcrumb & Page Banner Header -->
  <section class="relative w-full bg-soft-meadow overflow-hidden py-space-2xl md:py-space-3xl border-b border-border-warm">
    <div class="max-w-container-max mx-auto px-4 sm:px-8 relative z-10">
      <!-- Breadcrumb -->
      <nav aria-label="Breadcrumb" class="flex items-center gap-2 font-label-md text-label-md text-text-muted mb-space-sm">
        <a class="hover:text-primary transition-colors flex items-center gap-1" data-path="home" href="<?= e(base_url('/')) ?>">
          <span class="material-symbols-outlined text-[16px]">home</span>
          <span><?= e(ps_text('गृह (Home)', 'Home')) ?></span>
        </a>
        <span class="opacity-40">/</span>
        <span class="text-deep-forest font-semibold"><?= e(ps_text('सम्मान व राष्ट्रीय अलंकरण (Awards & Honors)', 'Awards & Honors')) ?></span>
      </nav>

      <!-- Badge & Main Title -->
      <div class="max-w-4xl">
        <div class="inline-flex items-center gap-2 bg-primary-fixed/40 text-deep-forest px-3.5 py-1 rounded-full font-label-sm text-label-sm mb-space-sm border border-border-warm font-semibold">
          <span class="material-symbols-outlined text-[15px] text-primary-container" style="font-variation-settings: 'FILL' 1;">workspace_premium</span>
          <span><?= e(ps_text('100+ प्रामाणिक प्रशस्ति पत्र व राज्यस्तरीय सम्मान (1987 — 2026)', '100+ Authenticated Honors & State Citations (1987 — 2026)')) ?></span>
        </div>
        <h1 class="font-display-hero text-headline-lg md:text-display-hero text-deep-forest leading-tight tracking-tight font-bold">
          <?= e(ps_text('महामहिम राज्यपाल से लेकर ग्राम चौपाल तक प्राप्त ऐतिहासिक सम्मान', 'Honors & Citations from the UP Governor to Village Chaupals')) ?>
        </h1>
        <p class="font-body-lg text-body-lg text-text-muted mt-space-sm max-w-3xl leading-relaxed">
          <?= e(ps_text('श्री प्रदीप सारंग जी की चार दशकों की अनवरत जनसेवा, पर्यावरण संवर्धन, परिंदा संरक्षण एवं अवधी साहित्य साधना का प्रामाणिक वर्षवार अभिलेखागार।', 'Historical timeline of awards conferred by Governors, Ministers, Election Officers, and cultural academies.')) ?>
        </p>
      </div>

      <!-- 2-Photo Governor Award & Citation Showcase -->
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-8">
        <div class="relative rounded-2xl overflow-hidden shadow-sm border border-border-warm group">
          <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuDAOc4i9Cb2VjM79mjezJCpudnHfiDO3eypcROFKyBmdEIdVRKmDtbuGCNhiMd91Y_R3WA5ShPNtU2qpynVq_9X9SauqvqnsaHFcSif4HjpcluLDdVj4X9LSrag69kOjlnE1fpZaRp-JanhslkRn9lem5w51HY9jy_1vnUORrc7QJ956-mLTOozQwtLsmrdunjblUVDPTWxOrx4DASFFfukLpjvXG2ItdY2f3h8GLbD2_dQGwl48vbN" alt="Governor Award Presentation" class="w-full h-52 object-cover group-hover:scale-105 transition-transform duration-300">
          <div class="absolute bottom-0 inset-x-0 bg-gradient-to-t from-deep-forest/90 via-deep-forest/50 to-transparent p-4 text-pure-white">
            <span class="font-label-sm text-label-sm uppercase tracking-wider text-tertiary-fixed font-bold"><?= e(ps_text('राजभवन लखनऊ (1991)', 'Raj Bhavan Lucknow (1991)')) ?></span>
            <p class="font-title-md text-title-md font-bold mt-0.5"><?= e(ps_text('स्वामी विवेकानंद युवा पुरस्कार - महामहिम राज्यपाल अलंकरण', 'Swami Vivekananda State Youth Award Presentation')) ?></p>
          </div>
        </div>
        <div class="relative rounded-2xl overflow-hidden shadow-sm border border-border-warm group">
          <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuCIdMQwsnVo2dk4ut7g6q_cAP6eTxbCJ79UEWEL6LMYJP9Bzoa711KY0DUcQDKRXxuQ_6LQhxi0vQ2STd8MG_7M8PMwLDKDbl4rkN0NWnrSqVTvaAamPZA23ot4DWOtvh7QMTvSKjQWd4KHteII-UyAePIVzkOU6Kjt18WGSoV63V45Zxnm-uJxCWTIYBFdLiZQTIIpMJ2BicU3nJOrp9TW5wTXMOaNdUj57zI1cu2Z0PJgk4oP02r7" alt="State Wildlife Citation" class="w-full h-52 object-cover group-hover:scale-105 transition-transform duration-300">
          <div class="absolute bottom-0 inset-x-0 bg-gradient-to-t from-deep-forest/90 via-deep-forest/50 to-transparent p-4 text-pure-white">
            <span class="font-label-sm text-label-sm uppercase tracking-wider text-fresh-sprout font-bold"><?= e(ps_text('उ.प्र. शासन प्रशस्ति (2016)', 'UP State Govt Citation (2016)')) ?></span>
            <p class="font-title-md text-title-md font-bold mt-0.5"><?= e(ps_text('माननीय वन मंत्री द्वारा परिंदा एवं वन्यजीव संरक्षण सम्मान', 'State Environment & Bird Conservation Award')) ?></p>
          </div>
        </div>
      </div>

      <!-- Filter Tabs -->
      <div class="flex flex-wrap items-center gap-2 mt-8" id="awards-filter-tabs">
        <button type="button" data-filter="all" class="award-filter-btn px-4 py-2 rounded-full font-label-sm text-label-sm bg-primary-container text-on-primary shadow-sm font-semibold transition-all cursor-pointer">
          <?= e(ps_text('सभी सम्मान (All)', 'All Honors')) ?>
        </button>
        <button type="button" data-filter="national" class="award-filter-btn px-4 py-2 rounded-full font-label-sm text-label-sm bg-pure-white text-on-surface-variant hover:bg-surface-container border border-border-warm font-medium transition-all cursor-pointer">
          🏛️ <?= e(ps_text('राष्ट्रीय व राज्य स्तरीय', 'National & State')) ?>
        </button>
        <button type="button" data-filter="literary" class="award-filter-btn px-4 py-2 rounded-full font-label-sm text-label-sm bg-pure-white text-on-surface-variant hover:bg-surface-container border border-border-warm font-medium transition-all cursor-pointer">
          📖 <?= e(ps_text('साहित्य व अवधी', 'Literary & Awadhi')) ?>
        </button>
        <button type="button" data-filter="social" class="award-filter-btn px-4 py-2 rounded-full font-label-sm text-label-sm bg-pure-white text-on-surface-variant hover:bg-surface-container border border-border-warm font-medium transition-all cursor-pointer">
          🌱 <?= e(ps_text('पर्यावरण व जनसेवा', 'Environment & Service')) ?>
        </button>
      </div>
    </div>
  </section>

  <!-- Metrics Ribbon -->
  <section class="w-full bg-deep-forest text-pure-white py-space-xl">
    <div class="max-w-container-max mx-auto px-4 sm:px-8">
      <div class="grid grid-cols-2 lg:grid-cols-4 gap-6 text-center">
        <div class="flex flex-col p-4 rounded-xl bg-surface-container-low/10 border border-surface-container-high/15">
          <span class="font-headline-lg text-headline-lg text-primary-fixed leading-none font-bold">1991</span>
          <span class="font-title-md text-title-md text-surface-container-high font-semibold mt-2"><?= e(ps_text('स्वामी विवेकानंद युवा पुरस्कार', 'Swami Vivekananda Award')) ?></span>
          <span class="font-label-sm text-label-sm text-surface-container-high/80 mt-1"><?= e(ps_text('महामहिम राज्यपाल, उ.प्र. द्वारा', 'Conferred by UP Governor')) ?></span>
        </div>

        <div class="flex flex-col p-4 rounded-xl bg-surface-container-low/10 border border-surface-container-high/15">
          <span class="font-headline-lg text-headline-lg text-tertiary-fixed leading-none font-bold">1988</span>
          <span class="font-title-md text-title-md text-surface-container-high font-semibold mt-2"><?= e(ps_text('गणतंत्र दिवस राष्ट्रीय परेड', 'Republic Day Parade NSS')) ?></span>
          <span class="font-label-sm text-label-sm text-surface-container-high/80 mt-1"><?= e(ps_text('इंडिया गेट, नई दिल्ली', 'India Gate, New Delhi')) ?></span>
        </div>

        <div class="flex flex-col p-4 rounded-xl bg-surface-container-low/10 border border-surface-container-high/15">
          <span class="font-headline-lg text-headline-lg text-secondary-fixed leading-none font-bold">100+</span>
          <span class="font-title-md text-title-md text-surface-container-high font-semibold mt-2"><?= e(ps_text('प्रशस्ति व सम्मान पत्र', 'Citations & Trophies')) ?></span>
          <span class="font-label-sm text-label-sm text-surface-container-high/80 mt-1"><?= e(ps_text('शासन, प्रशासन व सामाजिक संस्थाएं', 'Govt, Admin & NGOs')) ?></span>
        </div>

        <div class="flex flex-col p-4 rounded-xl bg-surface-container-low/10 border border-surface-container-high/15">
          <span class="font-headline-lg text-headline-lg text-primary-fixed leading-none font-bold">2016</span>
          <span class="font-title-md text-title-md text-surface-container-high font-semibold mt-2"><?= e(ps_text('वन्य जीव संरक्षण सम्मान', 'Wildlife Protection Citation')) ?></span>
          <span class="font-label-sm text-label-sm text-surface-container-high/80 mt-1"><?= e(ps_text('माननीय वन मंत्री, उ.प्र. द्वारा', 'UP Forest Minister')) ?></span>
        </div>
      </div>
    </div>
  </section>

  <!-- Featured Top Honors Spotlight -->
  <section class="w-full bg-cream-canvas py-space-3xl border-b border-border-warm">
    <div class="max-w-container-max mx-auto px-4 sm:px-8">
      <div class="flex flex-col md:flex-row md:items-end justify-between mb-space-xl gap-4">
        <div>
          <span class="font-label-sm text-label-sm text-secondary tracking-widest font-bold uppercase"><?= e(ps_text('शीर्ष अलंकरण', 'Top Honors Spotlight')) ?></span>
          <h2 class="font-headline-lg text-headline-md md:text-headline-lg text-deep-forest font-bold mt-1">
            <?= e(ps_text('प्रमुख ऐतिहासिक पुरस्कार एवं राजभवन अलंकरण', 'Major Prestigious Awards & State Honors')) ?>
          </h2>
        </div>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Spotlight Card 1 -->
        <div class="bg-pure-white rounded-3xl p-6 sm:p-8 shadow-sm border border-border-warm hover:shadow-md transition-all flex flex-col justify-between">
          <div>
            <div class="flex items-center justify-between mb-4">
              <span class="font-headline-lg text-headline-md text-primary-container font-bold">1991</span>
              <span class="bg-primary-fixed/40 text-primary-container font-label-sm text-label-sm px-3 py-1 rounded-full font-bold border border-border-warm">
                <?= e(ps_text('राजभवन सर्वोच्च युवा सम्मान', 'Governor State Award')) ?>
              </span>
            </div>
            <h3 class="font-headline-sm text-headline-sm text-deep-forest font-bold mb-3">
              <?= e(ps_text('स्वामी विवेकानंद युवा पुरस्कार', 'Swami Vivekananda Youth Award')) ?>
            </h3>
            <p class="font-body-md text-body-md text-on-surface-variant leading-relaxed mb-6">
              <?= e(ps_text('युवाओं के सर्वांगीण विकास, साक्षरता एवं सामाजिक चेतना में अप्रतिम योगदान हेतु तत्कालीन महामहिम राज्यपाल, उत्तर प्रदेश के कर-कमलों द्वारा राज्य का सर्वोच्च युवा सम्मान प्रदान किया गया।', 'Conferred UP\'s highest youth state award by the Governor of Uttar Pradesh at Raj Bhavan, Lucknow.')) ?>
            </p>
          </div>
          <div class="pt-4 border-t border-border-warm flex items-center justify-between font-label-sm text-label-sm text-deep-forest font-semibold">
            <span class="flex items-center gap-1.5"><span class="material-symbols-outlined text-[16px] text-primary-container">stars</span> <?= e(ps_text('माननीय महामहिम राज्यपाल, उ.प्र.', 'Governor of Uttar Pradesh')) ?></span>
            <span class="text-text-muted"><?= e(ps_text('राजभवन, लखनऊ', 'Raj Bhavan, Lucknow')) ?></span>
          </div>
        </div>

        <!-- Spotlight Card 2 -->
        <div class="bg-pure-white rounded-3xl p-6 sm:p-8 shadow-sm border border-border-warm hover:shadow-md transition-all flex flex-col justify-between">
          <div>
            <div class="flex items-center justify-between mb-4">
              <span class="font-headline-lg text-headline-md text-secondary font-bold">1988</span>
              <span class="bg-secondary-fixed/50 text-secondary font-label-sm text-label-sm px-3 py-1 rounded-full font-bold border border-border-warm">
                <?= e(ps_text('राष्ट्रीय गणतंत्र दिवस परेड', 'Republic Day National Parade')) ?>
              </span>
            </div>
            <h3 class="font-headline-sm text-headline-sm text-deep-forest font-bold mb-3">
              <?= e(ps_text('गणतंत्र दिवस राष्ट्रीय परेड (NSS दल)', 'Republic Day National Parade Certificate')) ?>
            </h3>
            <p class="font-body-md text-body-md text-on-surface-variant leading-relaxed mb-6">
              <?= e(ps_text('नई दिल्ली में राजपथ पर 26 जनवरी गणतंत्र दिवस राष्ट्रीय परेड में उत्तर प्रदेश NSS दल के प्रतिनिधि के रूप में ऐतिहासिक प्रतिभागिता एवं जिलाधिकारी द्वारा विशेष सम्मान।', 'Represented UP NSS contingent at 26th January Republic Day National Parade Camp at Rajpath, New Delhi.')) ?>
            </p>
          </div>
          <div class="pt-4 border-t border-border-warm flex items-center justify-between font-label-sm text-label-sm text-secondary font-semibold">
            <span class="flex items-center gap-1.5"><span class="material-symbols-outlined text-[16px]">flag</span> <?= e(ps_text('राष्ट्रीय सेवा योजना (NSS), नई दिल्ली', 'NSS, New Delhi')) ?></span>
            <span class="text-text-muted"><?= e(ps_text('राजपथ, नई दिल्ली', 'Rajpath, New Delhi')) ?></span>
          </div>
        </div>

        <!-- Spotlight Card 3 -->
        <div class="bg-pure-white rounded-3xl p-6 sm:p-8 shadow-sm border border-border-warm hover:shadow-md transition-all flex flex-col justify-between">
          <div>
            <div class="flex items-center justify-between mb-4">
              <span class="font-headline-lg text-headline-md text-tertiary font-bold">2016</span>
              <span class="bg-tertiary-fixed/60 text-tertiary font-label-sm text-label-sm px-3 py-1 rounded-full font-bold border border-border-warm">
                <?= e(ps_text('शासन स्तर', 'State Government')) ?>
              </span>
            </div>
            <h3 class="font-headline-sm text-headline-sm text-deep-forest font-bold mb-3">
              <?= e(ps_text('वन्य जीव व परिंदा संरक्षण विशिष्ट सम्मान', 'Wildlife & Bird Protection Honor')) ?>
            </h3>
            <p class="font-body-md text-body-md text-on-surface-variant leading-relaxed mb-6">
              <?= e(ps_text('उत्तर प्रदेश शासन के तत्कालीन माननीय वन मंत्री द्वारा पर्यावरण, पक्षी संरक्षण और 10,000+ मिट्टी के सकोरा अभियानों के लिए राज्य स्तरीय प्रशस्ति पत्र प्रदान किया गया।', 'Awarded UP State Wildlife Conservation Citation by UP Forest Minister.')) ?>
            </p>
          </div>
          <div class="pt-4 border-t border-border-warm flex items-center justify-between font-label-sm text-label-sm text-tertiary font-semibold">
            <span class="flex items-center gap-1.5"><span class="material-symbols-outlined text-[16px]">nature</span> <?= e(ps_text('माननीय वन मंत्री, उत्तर प्रदेश शासन', 'Forest Minister, UP')) ?></span>
            <span class="text-text-muted"><?= e(ps_text('लखनऊ', 'Lucknow')) ?></span>
          </div>
        </div>

        <!-- Spotlight Card 4 -->
        <div class="bg-pure-white rounded-3xl p-6 sm:p-8 shadow-sm border border-border-warm hover:shadow-md transition-all flex flex-col justify-between">
          <div>
            <div class="flex items-center justify-between mb-4">
              <span class="font-headline-lg text-headline-md text-primary-container font-bold">2022</span>
              <span class="bg-soft-meadow text-deep-forest font-label-sm text-label-sm px-3 py-1 rounded-full font-bold border border-border-warm">
                <?= e(ps_text('अवधी साहित्य', 'Awadhi Literature')) ?>
              </span>
            </div>
            <h3 class="font-headline-sm text-headline-sm text-deep-forest font-bold mb-3">
              <?= e(ps_text('जनकवि बंशीधर शुक्ल व तुलसी सम्मान', 'Banshidhar Shukla & Tulsi Award')) ?>
            </h3>
            <p class="font-body-md text-body-md text-on-surface-variant leading-relaxed mb-6">
              <?= e(ps_text('\'प्रकृति साहित्य रत्न\', सुप्रसिद्ध \'जनकवि बंशीधर शुक्ल पुरस्कार\' एवं अवधी भाषा की दीर्घकालिक सेवा हेतु प्रतिष्ठित \'गोस्वामी तुलसीदास सम्मान\' से विभूषित।', 'Honored with Banshidhar Shukla Award and Goswami Tulsidas Award for lifetime Awadhi literary service.')) ?>
            </p>
          </div>
          <div class="pt-4 border-t border-border-warm flex items-center justify-between font-label-sm text-label-sm text-deep-forest font-semibold">
            <span class="flex items-center gap-1.5"><span class="material-symbols-outlined text-[16px] text-primary-container">auto_stories</span> <?= e(ps_text('अवधी भाषा एवं साहित्य परिषद', 'Awadhi Sahitya Parishad')) ?></span>
            <span class="text-text-muted"><?= e(ps_text('उत्तर प्रदेश', 'Uttar Pradesh')) ?></span>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Complete Chronological Timeline Archive -->
  <section class="w-full bg-soft-meadow py-space-3xl border-b border-border-warm">
    <div class="max-w-container-max mx-auto px-4 sm:px-8">
      <div class="text-center max-w-3xl mx-auto mb-space-xl">
        <span class="font-label-sm text-label-sm text-secondary tracking-widest font-bold uppercase"><?= e(ps_text('कालक्रमानुसार अभिलेखागार', 'Chronological Honors Timeline')) ?></span>
        <h2 class="font-headline-lg text-headline-md md:text-headline-lg text-deep-forest font-bold mt-1">
          <?= e(ps_text('सम्पूर्ण वर्षवार सम्मान तालिका (1987 — 2026)', 'Complete Year-by-Year Honors Archive')) ?>
        </h2>
        <p class="font-body-md text-body-md text-text-muted mt-2">
          <?= e(ps_text('चार दशकों में प्राप्त सभी प्रमुख राष्ट्रीय, राज्य स्तरीय, साहित्यिक एवं सामाजिक सम्मान।', 'All authenticated national, state, literary, and social awards over four decades.')) ?>
        </p>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" id="awards-grid">
        <?php foreach ($allHonors as $honor): ?>
          <div class="award-card bg-pure-white rounded-2xl p-6 shadow-sm border border-border-warm hover:shadow-md transition-all flex flex-col justify-between" data-category="<?= e($honor['category']) ?>">
            <div>
              <div class="flex items-center justify-between mb-3">
                <span class="font-headline-sm text-headline-sm text-primary-container font-bold"><?= e($honor['year']) ?></span>
                <span class="bg-soft-meadow text-deep-forest font-label-sm text-label-sm px-2.5 py-0.5 rounded-full font-semibold border border-border-warm">
                  <?= e($honor['badge']) ?>
                </span>
              </div>
              <h4 class="font-title-md text-title-md text-deep-forest font-bold mb-2 leading-snug">
                <?= e($honor['title']) ?>
              </h4>
              <p class="font-body-sm text-body-sm text-text-muted leading-relaxed mb-4">
                <?= e($honor['description']) ?>
              </p>
            </div>
            
            <div class="pt-3 border-t border-border-warm text-label-sm font-label-sm text-deep-forest flex items-center justify-between font-semibold">
              <span class="flex items-center gap-1.5">
                <span class="material-symbols-outlined text-[16px] text-secondary"><?= e($honor['icon'] ?? 'verified') ?></span>
                <?= e($honor['authority']) ?>
              </span>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <!-- Official Media & Verification Desk Callout -->
  <section class="w-full bg-cream-canvas py-space-3xl">
    <div class="max-w-container-editorial mx-auto px-4 sm:px-8">
      <div class="bg-pure-white rounded-3xl p-6 sm:p-10 shadow-sm border border-border-warm text-center">
        <span class="material-symbols-outlined text-[40px] text-primary-container mb-3 inline-block">verified_user</span>
        <h3 class="font-headline-md text-headline-md text-deep-forest font-bold mb-2">
          <?= e(ps_text('प्रशस्ति पत्र एवं आधिकारिक प्रमाण-पत्र सत्यापन', 'Citation & Official Certification Verification')) ?>
        </h3>
        <p class="font-body-md text-body-md text-on-surface-variant max-w-xl mx-auto mb-6">
          <?= e(ps_text('शोधार्थियों, पत्रकारों अथवा सरकारी संस्थाओं हेतु मूल प्रशस्ति पत्रों, समाचार पत्र कतरनों एवं राजभवन पत्राचार के सत्यापन हेतु संपर्क करें।', 'For researchers, journalists, or institutional verification of original citations, news clippings, or Raj Bhavan award letters.')) ?>
        </p>

        <div class="flex flex-wrap items-center justify-center gap-3">
          <a href="<?= e(base_url('/media')) ?>" class="inline-flex items-center gap-2 bg-primary-container hover:bg-deep-forest text-on-primary px-6 py-3 rounded-xl font-label-md text-label-md transition-colors shadow-sm font-bold">
            <span class="material-symbols-outlined text-[18px]">newspaper</span>
            <span><?= e(ps_text('अखबार कतरनें देखें (Media Coverage)', 'Explore Media Coverage')) ?></span>
          </a>
          <a href="<?= e(base_url('/contact')) ?>" class="inline-flex items-center gap-2 bg-cream-canvas hover:bg-surface-container text-deep-forest px-6 py-3 rounded-xl font-label-md text-label-md transition-colors border border-border-warm font-semibold">
            <span class="material-symbols-outlined text-[18px]">mail</span>
            <span><?= e(ps_text('सीधा संवाद करें', 'Contact Directly')) ?></span>
          </a>
        </div>
      </div>
    </div>
  </section>
</div>

<!-- Interactive Client-side Filter Script -->
<script>
  (function() {
    const filterBtns = document.querySelectorAll('.award-filter-btn');
    const awardCards = document.querySelectorAll('#awards-grid .award-card');

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
        awardCards.forEach(card => {
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
