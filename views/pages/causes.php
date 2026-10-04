<?php
declare(strict_types=1);

$rawDbItems = $items ?? [];
$phone = trim($settings['phone'] ?? '+91 9919007190');
$phoneClean = preg_replace('/[^+0-9]/', '', $phone);

// Default campaigns catalog definitions for fallback and metadata enrichment
$defaultCatalog = [
    'sardar-patel-ekta' => [
        'id' => 1,
        'title' => ps_text('सरदार पटेल अभियान (राष्ट्रीय एकता, समरसता व युवा प्रेरणा)', 'Sardar Patel Integration Drive (Primary Movement)'),
        'slug' => 'sardar-patel-ekta',
        'category' => 'unity',
        'is_primary' => 1,
        'excerpt' => ps_text('लौह पुरुष सरदार वल्लभभाई पटेल के अखंड भारत, राष्ट्रीय एकता और सामाजिक समरसता के संदेश को जन-जन तक पहुँचाने हेतु संचालित प्रमुख अभियान। इसके माध्यम से युवाओं को राष्ट्र निर्माण, निःस्वार्थ जनसेवा और सर्वधर्म सद्भाव के प्रति निरंतर प्रेरित किया जाता है।', 'The flagship national integration initiative promoting Iron Man Sardar Vallabhbhai Patel’s vision of a united India across Uttar Pradesh.'),
        'image' => 'assets/images/sardar_patel.webp',
        'highlights' => [ps_text('NSS 1987-88 प्रेरणा', 'NSS 1987 Legacy'), ps_text('31 अक्टूबर दीपोत्सव', '31 Oct Deepotsav'), ps_text('पटेल चेतना रथ', 'Chetna Rath Drive')]
    ],
    'hariyali-campaign' => [
        'id' => 2,
        'title' => ps_text('हरियाली-अभियान (\'ग्रीन गैंग\' एवं \'ग्रीन मॉर्निंग\')', 'Hariyali Abhiyan (\'Green Gang\' & \'Green Morning\')'),
        'slug' => 'hariyali-campaign',
        'category' => 'eco',
        'is_primary' => 0,
        'excerpt' => ps_text('50,000+ वृक्षारोपण एवं दैनिक जीवन में \'गुड मॉर्निंग\' की जगह \'ग्रीन-मॉर्निंग\' (Green Morning) बोलने का अभिनव शिष्टाचार आंदोलन।', '50,000+ Trees Planted & Green Morning Greetings across schools and rural panchayats.'),
        'image' => 'assets/images/hariyali_abhiyan.webp',
        'highlights' => [ps_text('50,000+ पौधरोपण', '50k+ Trees Planted'), ps_text('ग्रीन मॉर्निंग शिष्टाचार', 'Green Morning Greetings')]
    ],
    'bird-conservation-campaign' => [
        'id' => 3,
        'title' => ps_text('परिंदा संवर्धन व जल-सकोरा अभियान', 'Sparrow & Bird Conservation (Water Bowls)'),
        'slug' => 'bird-conservation-campaign',
        'category' => 'bird',
        'is_primary' => 0,
        'excerpt' => ps_text('भीषण गर्मी में बेजुबान पक्षियों हेतु 10,000+ मिट्टी के सकोरे, दाना-पानी प्रबंध एवं विलुप्त होती गौरैया के लिए घोंसला निर्माण अभियान।', 'Distributing 10,000+ clay water bowls and food shelters for sparrows and birds to survive blistering summers.'),
        'image' => 'assets/images/slider_final_2.webp',
        'highlights' => [ps_text('10,000+ जल-सकोरे', '10k+ Water Pots'), ps_text('गौरैया संरक्षण घोंसले', 'Sparrow Shelters')]
    ],
    'language-and-literature-promotion-campaign' => [
        'id' => 4,
        'title' => ps_text('अवधी भाषा व लोक-संस्कृति संवर्धन अभियान', 'Awadhi Language & Folk Culture Promotion'),
        'slug' => 'language-and-literature-promotion-campaign',
        'category' => 'culture',
        'is_primary' => 0,
        'excerpt' => ps_text('अवधी भाषा, लोकगीतों, सारंग-कुंडलियों और विस्मृत होते ग्रामीण साहित्यिक मूल्यों को सहेजने हेतु मासिक चौपाल संगोष्ठियों का आयोजन।', 'Preserving dying Awadhi idioms, folk songs, rural dialects, and poetic heritage through village chaupals.'),
        'image' => 'assets/images/slider_final_3.webp',
        'highlights' => [ps_text('सारंग-कुंडलियाँ', 'Sarang Kundaliyan'), ps_text('मासिक अवधी चौपाल', 'Awadhi Chaupal Gatherings')]
    ],
    'tulsi-pakhwara' => [
        'id' => 5,
        'title' => ps_text('तुलसी जयंती पखवारा (16 से 31 अगस्त)', 'Goswami Tulsidas Jayanti Fortnight'),
        'slug' => 'tulsi-pakhwara',
        'category' => 'culture',
        'is_primary' => 0,
        'excerpt' => ps_text('आँखे फाउंडेशन द्वारा समाज कल्याण, नैतिक मूल्यों और सामाजिक चेतना हेतु संचालित जन जागरण अभियान।', 'Jan Gajaran Abhiyan initiative by Ankhee Foundation for social awareness and welfare.'),
        'image' => 'assets/images/slider_final_1.webp',
        'highlights' => [ps_text('जन जागरण अभियान', 'Jan Gajaran Abhiyan'), ps_text('सामाजिक चेतना', 'Social Awareness')]
    ]
];

// Normalize campaigns list from database
$allCampaignsList = [];

// 1. Convert DB items into standardized format
foreach ($rawDbItems as $item) {
    $slug = trim($item['slug'] ?? '');
    if (empty($slug)) {
        $slug = 'campaign-' . ($item['id'] ?? rand(100, 999));
    }
    
    // Check if matching catalog exists to preserve default images/highlights if not explicitly set
    $matchedCatalogKey = null;
    foreach ($defaultCatalog as $catKey => $catData) {
        if ($slug === $catKey || str_contains($slug, $catKey) || str_contains($catKey, $slug)) {
            $matchedCatalogKey = $catKey;
            break;
        }
    }
    $catDefaults = $matchedCatalogKey ? $defaultCatalog[$matchedCatalogKey] : [];

    $title = !empty($item['title']) ? $item['title'] : ($catDefaults['title'] ?? ps_text('जन-अभियान', 'Campaign'));
    $excerpt = !empty($item['excerpt']) ? $item['excerpt'] : (!empty($item['short_description']) ? $item['short_description'] : (!empty($item['content']) ? ps_excerpt($item['content'], 180) : ($catDefaults['excerpt'] ?? '')));
    $imageRaw = !empty($item['image']) ? $item['image'] : (!empty($item['banner_image']) ? $item['banner_image'] : ($catDefaults['image'] ?? 'assets/images/slider_final_1.webp'));
    $image = ps_resolve_img($imageRaw, $catDefaults['image'] ?? 'uploads/slider_final_1.webp');
    $category = !empty($item['category']) ? strtolower($item['category']) : ($catDefaults['category'] ?? 'unity');
    $isPrimary = isset($item['is_primary']) ? (int)$item['is_primary'] : ($catDefaults['is_primary'] ?? 0);
    $goalAmount = (float)($item['goal_amount'] ?? $item['target_amount'] ?? 0);
    $raisedAmount = (float)($item['raised_amount'] ?? 0);
    $highlights = !empty($catDefaults['highlights']) ? $catDefaults['highlights'] : [ps_text('जन-भागीदारी', 'Community Driven'), ps_text('सतत जनसेवा', 'Continuous Service')];

    $allCampaignsList[$slug] = [
        'id' => $item['id'] ?? 0,
        'title' => $title,
        'en_title' => $item['en_title'] ?? '',
        'slug' => $slug,
        'excerpt' => $excerpt,
        'image' => $image,
        'category' => $category,
        'is_primary' => $isPrimary,
        'goal_amount' => $goalAmount,
        'raised_amount' => $raisedAmount,
        'status' => $item['status'] ?? 'active',
        'highlights' => $highlights,
        'from_db' => true
    ];
}

// 2. If database table has no campaigns yet, use default catalog as fallback
if (empty($rawDbItems)) {
    foreach ($defaultCatalog as $catKey => $catData) {
        if (!isset($allCampaignsList[$catKey])) {
            $allCampaignsList[$catKey] = [
                'id' => $catData['id'],
                'title' => $catData['title'],
                'en_title' => $catData['en_title'] ?? '',
                'slug' => $catData['slug'],
                'excerpt' => $catData['excerpt'],
                'image' => ps_resolve_img($catData['image'], 'uploads/slider_final_1.webp'),
                'category' => $catData['category'],
                'is_primary' => $catData['is_primary'],
                'goal_amount' => 0,
                'raised_amount' => 0,
                'status' => 'active',
                'highlights' => $catData['highlights'],
                'from_db' => false
            ];
        }
    }
}

// Separate primary campaign from regular list
$primaryCampaign = null;
$regularCampaigns = [];

foreach ($allCampaignsList as $camp) {
    if ($camp['is_primary'] === 1 && $primaryCampaign === null) {
        $primaryCampaign = $camp;
    } else {
        $regularCampaigns[] = $camp;
    }
}

// Fallback if no campaign was marked primary
if ($primaryCampaign === null && !empty($regularCampaigns)) {
    $primaryCampaign = array_shift($regularCampaigns);
}
?>

<div class="flex flex-col w-full bg-[#FAF8F3]">
  <!-- 1. HERO MASTHEAD SECTION -->
  <section class="relative w-full overflow-hidden bg-gradient-to-b from-[#FAF8F3] via-[#F3F7F4] to-[#FAF8F3] py-12 lg:py-18 border-b border-[#E5E7EB]">
    <!-- Ambient Blur Background Gradients -->
    <div class="absolute -top-20 -right-20 w-96 h-96 rounded-full bg-[#15803D]/10 blur-3xl pointer-events-none"></div>
    <div class="absolute -bottom-20 -left-20 w-80 h-80 rounded-full bg-[#C05632]/10 blur-3xl pointer-events-none"></div>

    <div class="max-w-container-max mx-auto px-4 sm:px-8 relative z-10">
      <!-- Breadcrumb Bar -->
      <nav aria-label="Breadcrumb" class="flex items-center gap-2 text-sm text-[#64748B] mb-6">
        <a href="<?= e(base_url('/')) ?>" class="hover:text-[#14532D] transition-colors flex items-center gap-1 font-medium">
          <span class="material-symbols-outlined text-[18px]">home</span>
          <span><?= e(ps_text('गृह (Home)', 'Home')) ?></span>
        </a>
        <span class="opacity-40">/</span>
        <span class="text-[#14532D] font-bold"><?= e(ps_text('प्रमुख जन-अभियान (Campaigns)', 'Campaigns & Movements')) ?></span>
      </nav>

      <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
        <div class="lg:col-span-8 flex flex-col items-start space-y-5">
          <!-- Floating Live Badge -->
          <div class="inline-flex items-center gap-2.5 bg-white px-4 py-1.5 rounded-full border border-[#C05632]/30 shadow-xs">
            <span class="w-2.5 h-2.5 rounded-full bg-[#C05632] animate-pulse"></span>
            <span class="text-xs sm:text-sm text-[#14532D] uppercase tracking-wider font-bold">
              <?= e(ps_text('चार दशकों की अनवरत साधना • 1987 से निरंतर जनसेवा', 'Four Decades of Grassroots Service • Since 1987')) ?>
            </span>
          </div>

          <!-- Hero Headline -->
          <h1 class="font-display-hero text-3xl sm:text-4xl lg:text-5xl text-[#14532D] font-extrabold leading-tight tracking-tight">
            <?= ps_text('प्रकृति, संस्कृति, राष्ट्र और समाज को समर्पित प्रमुख जन-अभियान', 'Major Environmental, Cultural & National Movements') ?>
          </h1>

          <p class="text-base sm:text-lg text-[#475467] leading-relaxed max-w-3xl font-normal">
            <?= e(ps_text('प्रदीप सारंग द्वारा बाराबंकी (अवध) की पावन माटी से संचालित राष्ट्रव्यापी व ग्रामीण जन-आंदोलन — पर्यावरण संरक्षण, गौरैया व पक्षी संवर्धन, राष्ट्रीय एकता, अवधी भाषा उत्थान और युवाओं में सकारात्मक चेतना का निरंतर संचार।', 'Grassroots public-interest initiatives led by Pradeep Sarang for environmental regeneration, bird conservation, national integration, and Awadhi cultural preservation.')) ?>
          </p>

          <!-- Action Buttons -->
          <div class="flex flex-wrap items-center gap-4 pt-2">
            <a href="#campaigns-grid-container" class="inline-flex items-center gap-2.5 bg-[#14532D] hover:bg-[#0F3D21] text-white px-7 py-3.5 rounded-2xl text-base font-bold transition-all shadow-md hover:shadow-xl transform hover:-translate-y-0.5">
              <span class="material-symbols-outlined text-[20px]">explore</span>
              <span><?= e(ps_text('सभी अभियान देखें', 'Explore All Campaigns')) ?></span>
            </a>
            <a href="<?= e(base_url('/volunteer')) ?>" class="inline-flex items-center gap-2.5 bg-[#C05632] hover:bg-[#A9472B] text-white px-7 py-3.5 rounded-2xl text-base font-bold transition-all shadow-sm hover:shadow-md transform hover:-translate-y-0.5">
              <span class="material-symbols-outlined text-[20px]">groups</span>
              <span><?= e(ps_text('स्वयंसेवक बनें', 'Join as Volunteer')) ?></span>
            </a>
            <a href="<?= e(base_url('/donation')) ?>" class="inline-flex items-center gap-2 bg-white hover:bg-[#F8FAFC] text-[#14532D] px-6 py-3.5 rounded-2xl text-base font-bold transition-all shadow-xs border border-[#E2E8F0] hover:border-[#14532D]/30">
              <span class="material-symbols-outlined text-[20px] text-[#C05632]">volunteer_activism</span>
              <span><?= e(ps_text('अभियान सहयोग', 'Support a Cause')) ?></span>
            </a>
          </div>
        </div>

        <!-- Signature Poetic Quote Card Column -->
        <div class="lg:col-span-4 flex justify-center">
          <div class="bg-white rounded-3xl p-6 sm:p-7 shadow-md hover:shadow-xl border-l-4 border-[#C05632] border-t border-r border-b border-[#E5E7EB] w-full max-w-md transition-all relative overflow-hidden">
            <div class="absolute -right-6 -bottom-6 w-32 h-32 bg-[#F1F7F2] rounded-full pointer-events-none -z-0"></div>
            <div class="relative z-10">
              <p class="font-quote-editorial text-lg text-[#1E293B] italic leading-snug font-medium mb-4">
                "<?= e(ps_text('हारना सीखा नहीं है, जीत का मैं गीत हूँ। जुगनुओं का संग है, इंसानियत का मीत हूँ।', 'I have not learned to lose; I am a song of victory. With fireflies as companions, I am a friend to humanity.')) ?>"
              </p>
              <div class="flex items-center justify-between text-xs text-[#64748B] pt-3 border-t border-[#F1F5F9]">
                <span class="font-bold text-[#14532D] uppercase tracking-wider">— <?= e(ps_text('प्रदीप सारंग', 'Pradeep Sarang')) ?></span>
                <span class="text-[#94A3B8]"><?= e(ps_text('कवि व पर्यावरणविद्', 'Poet & Environmentalist')) ?></span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- 2. IMPACT METRICS STRIP -->
  <section class="w-full bg-[#18392B] text-white py-8 relative shadow-md">
    <div class="max-w-container-max mx-auto px-4 sm:px-8">
      <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-6 text-center">
        <!-- Metric 1 -->
        <div class="flex flex-col items-center p-3 rounded-2xl hover:bg-white/5 transition-colors">
          <span class="material-symbols-outlined text-[#F4C96B] text-[32px] mb-1">history_edu</span>
          <span class="text-3xl lg:text-4xl text-[#F4C96B] font-extrabold leading-tight">35+ <?= e(ps_text('वर्ष', 'Yrs')) ?></span>
          <span class="text-xs text-[#CBD5E1] mt-1 font-medium"><?= e(ps_text('अनवरत जनसेवा (1987 से)', 'Continuous Service')) ?></span>
        </div>
        <!-- Metric 2 -->
        <div class="flex flex-col items-center p-3 rounded-2xl hover:bg-white/5 transition-colors">
          <span class="material-symbols-outlined text-[#6FD08C] text-[32px] mb-1">forest</span>
          <span class="text-3xl lg:text-4xl text-white font-extrabold leading-tight">50,000+</span>
          <span class="text-xs text-[#CBD5E1] mt-1 font-medium"><?= e(ps_text('ग्रीन गैंग पौधरोपण', 'Trees Planted')) ?></span>
        </div>
        <!-- Metric 3 -->
        <div class="flex flex-col items-center p-3 rounded-2xl hover:bg-white/5 transition-colors">
          <span class="material-symbols-outlined text-[#F0B45C] text-[32px] mb-1">nest_cam_wired_stand</span>
          <span class="text-3xl lg:text-4xl text-[#F0B45C] font-extrabold leading-tight">10,000+</span>
          <span class="text-xs text-[#CBD5E1] mt-1 font-medium"><?= e(ps_text('परिंदा जल-सकोरे वितरण', 'Bird Water Bowls')) ?></span>
        </div>
        <!-- Metric 4 -->
        <div class="flex flex-col items-center p-3 rounded-2xl hover:bg-white/5 transition-colors">
          <span class="material-symbols-outlined text-[#76B7D8] text-[32px] mb-1">domain</span>
          <span class="text-3xl lg:text-4xl text-white font-extrabold leading-tight">150+ <?= e(ps_text('गाँव', 'Villages')) ?></span>
          <span class="text-xs text-[#CBD5E1] mt-1 font-medium"><?= e(ps_text('बाराबंकी व अवध अंचल', 'Barabanki & Awadh')) ?></span>
        </div>
        <!-- Metric 5 -->
        <div class="col-span-2 md:col-span-1 flex flex-col items-center p-3 rounded-2xl hover:bg-white/5 transition-colors">
          <span class="material-symbols-outlined text-[#E67E57] text-[32px] mb-1">handshake</span>
          <span class="text-3xl lg:text-4xl text-[#E67E57] font-extrabold leading-tight">100%</span>
          <span class="text-xs text-[#CBD5E1] mt-1 font-medium"><?= e(ps_text('पूर्णतः जन-भागीदारी', 'Community Driven')) ?></span>
        </div>
      </div>
    </div>
  </section>

  <!-- 3. INTERACTIVE CATEGORY FILTER -->
  <section class="w-full bg-[#FAF8F3] pt-10 pb-4 border-b border-[#E5E7EB]" id="campaign-filter-anchor">
    <div class="max-w-container-max mx-auto px-4 sm:px-8">
      <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-4 pb-2">
        <div>
          <span class="text-xs uppercase tracking-widest text-[#C05632] font-bold"><?= e(ps_text('जन-आंदोलन संवर्ग', 'Campaign Themes')) ?></span>
          <h2 class="text-2xl sm:text-3xl text-[#14532D] font-extrabold mt-0.5"><?= e(ps_text('सक्रिय अभियानों की सूची', 'Active Campaigns & Movements')) ?></h2>
        </div>

        <!-- Filter Tabs Bar -->
        <div class="flex flex-wrap items-center gap-2 p-1.5 bg-white rounded-2xl border border-[#E5E7EB] shadow-xs" id="campaign-tabs">
          <button type="button" data-filter="all" class="campaign-tab-btn px-4 py-2 rounded-xl text-xs sm:text-sm bg-[#14532D] text-white shadow-xs transition-all font-bold cursor-pointer">
            <?= e(ps_text('सभी अभियान', 'All Campaigns')) ?>
          </button>
          <button type="button" data-filter="unity" class="campaign-tab-btn px-4 py-2 rounded-xl text-xs sm:text-sm text-[#475467] hover:text-[#14532D] hover:bg-[#F1F7F2] transition-all font-semibold cursor-pointer">
            <?= e(ps_text('राष्ट्रीय चेतना (सरदार पटेल)', 'National Integration')) ?>
          </button>
          <button type="button" data-filter="eco" class="campaign-tab-btn px-4 py-2 rounded-xl text-xs sm:text-sm text-[#475467] hover:text-[#14532D] hover:bg-[#F1F7F2] transition-all font-semibold cursor-pointer">
            <?= e(ps_text('पर्यावरण व हरियाली', 'Environment & Green Gang')) ?>
          </button>
          <button type="button" data-filter="bird" class="campaign-tab-btn px-4 py-2 rounded-xl text-xs sm:text-sm text-[#475467] hover:text-[#14532D] hover:bg-[#F1F7F2] transition-all font-semibold cursor-pointer">
            <?= e(ps_text('परिंदा व जीव-दया', 'Bird Protection')) ?>
          </button>
          <button type="button" data-filter="culture" class="campaign-tab-btn px-4 py-2 rounded-xl text-xs sm:text-sm text-[#475467] hover:text-[#14532D] hover:bg-[#F1F7F2] transition-all font-semibold cursor-pointer">
            <?= e(ps_text('अवधी संस्कृति व साहित्य', 'Culture & Literature')) ?>
          </button>
        </div>
      </div>
    </div>
  </section>

  <!-- 4. CAMPAIGNS LISTING GRID (DYNAMIC DATABASE DRIVEN) -->
  <section class="w-full bg-[#FAF8F3] py-10 lg:py-16">
    <div class="max-w-container-max mx-auto px-4 sm:px-8">
      <div class="grid grid-cols-1 lg:grid-cols-12 gap-10" id="campaigns-grid-container">
        
        <!-- ==============================================
             PRIMARY FEATURED FLAGSHIP CAMPAIGN CARD (HIGH-END 2-COLUMN SPLIT)
             ============================================== -->
        <?php if ($primaryCampaign): ?>
        <article class="campaign-card lg:col-span-12 bg-white rounded-3xl shadow-xl hover:shadow-2xl border-2 border-[#C05632]/40 transition-all duration-300 overflow-hidden" data-category="<?= e($primaryCampaign['category']) ?>">
          <div class="grid grid-cols-1 lg:grid-cols-12 items-stretch">
            
            <!-- Left Media Column (100% Uncropped Image Container with Flagship Badge on the RIGHT) -->
            <div class="lg:col-span-6 relative bg-[#F8FAFC] p-5 sm:p-7 border-b lg:border-b-0 lg:border-r border-[#E5E7EB] flex flex-col justify-between min-h-[360px] sm:min-h-[420px] lg:min-h-[500px]">
              <!-- Floating Flagship Badge (Positioned on the RIGHT) -->
              <div class="flex justify-end w-full z-10 mb-2">
                <span class="inline-flex items-center gap-1.5 bg-[#14532D] text-white px-4 py-1.5 rounded-full text-xs sm:text-sm font-bold shadow-md border border-[#14532D]/20">
                  <span class="material-symbols-outlined text-[16px] text-[#F4C96B]">flag</span>
                  <span><?= e(ps_text('प्राथमिक मुख्य जन-अभियान', 'Primary Flagship Campaign')) ?></span>
                </span>
              </div>

              <!-- 100% Uncropped Poster Graphic -->
              <div class="relative w-full my-auto flex items-center justify-center py-2 z-10">
                <div class="w-full rounded-2xl overflow-hidden shadow-xs border border-[#E5E7EB] bg-white p-1.5">
                  <img src="<?= e($primaryCampaign['image']) ?>" alt="<?= e($primaryCampaign['title']) ?>" class="w-full h-auto max-h-[440px] object-contain rounded-xl block mx-auto">
                </div>
              </div>

              <!-- Bottom Trust Label Overlay -->
              <div class="pt-3 z-10 flex items-center justify-between text-xs text-[#64748B] border-t border-[#E5E7EB] mt-2">
                <span class="flex items-center gap-1.5 font-bold text-[#14532D]">
                  <span class="material-symbols-outlined text-[#C05632] text-[18px]">verified</span>
                  <span>सरदार पटेल समाजोत्थान ट्रस्ट • 1987</span>
                </span>
                <span class="font-bold text-[#14532D] bg-[#F1F7F2] px-2.5 py-1 rounded-md border border-[#15803D]/20"><?= e(ps_text('पटेल चेतना रथ यात्रा', 'Patel Chetna Rath Yatra')) ?></span>
              </div>
            </div>

            <!-- Right Content Details Column -->
            <div class="lg:col-span-6 p-6 sm:p-10 lg:p-12 flex flex-col justify-between bg-white">
              <div>
                <!-- Subtitle Badge -->
                <div class="inline-flex items-center gap-2 text-xs uppercase font-bold text-[#C05632] tracking-wider bg-[#FAF8F3] px-3.5 py-1.5 rounded-full border border-[#C05632]/30 mb-4">
                  <span class="material-symbols-outlined text-[16px]">stars</span>
                  <span><?= e(ps_text('सरदार पटेल समाजोत्थान ट्रस्ट • मुख्य जनसेवा', 'Sardar Patel Trust • Flagship Drive')) ?></span>
                </div>

                <!-- Headline -->
                <h3 class="font-display-hero text-2xl sm:text-3xl lg:text-4xl text-[#14532D] font-extrabold leading-snug mb-4">
                  <?= e($primaryCampaign['title']) ?>
                </h3>

                <!-- Narrative Excerpt -->
                <p class="text-base sm:text-lg text-[#334155] leading-relaxed mb-6 font-normal">
                  <?= e($primaryCampaign['excerpt']) ?>
                </p>

                <?php if ($primaryCampaign['goal_amount'] > 0): 
                  $pct = min(100, round(($primaryCampaign['raised_amount'] / $primaryCampaign['goal_amount']) * 100));
                ?>
                <!-- Goal Progress Bar -->
                <div class="mb-6 p-4 bg-[#F1F7F2] rounded-2xl border border-[#E5E7EB]">
                  <div class="flex items-center justify-between text-xs font-bold text-[#14532D] mb-1.5">
                    <span><?= e(ps_text('सहयोग प्रगति:', 'Funding Progress:')) ?> <?= $pct ?>%</span>
                    <span>₹<?= number_format($primaryCampaign['raised_amount']) ?> / ₹<?= number_format($primaryCampaign['goal_amount']) ?></span>
                  </div>
                  <div class="w-full bg-[#CBD5E1] h-3 rounded-full overflow-hidden">
                    <div class="bg-[#15803D] h-full rounded-full" style="width: <?= $pct ?>%;"></div>
                  </div>
                </div>
                <?php endif; ?>

                <!-- Key Feature Highlights -->
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 p-4 bg-[#F1F7F2] rounded-2xl mb-8 border border-[#E5E7EB]">
                  <?php foreach ($primaryCampaign['highlights'] as $hl): ?>
                  <div class="flex items-start gap-2">
                    <span class="material-symbols-outlined text-[#15803D] text-[18px] mt-0.5">check_circle</span>
                    <span class="text-xs sm:text-sm font-bold text-[#14532D]"><?= e($hl) ?></span>
                  </div>
                  <?php endforeach; ?>
                </div>
              </div>

              <!-- Footer Call-to-Actions -->
              <div class="flex flex-wrap items-center justify-between gap-4 pt-6 border-t border-[#E5E7EB]">
                <div class="flex flex-wrap items-center gap-3">
                  <?php 
                    $pSlugLower = strtolower($primaryCampaign['slug']);
                    $primaryLink = base_url('/campaigns/' . $primaryCampaign['slug']);
                    if ($pSlugLower === 'sardar-patel-ekta' || str_contains($pSlugLower, 'patel') || str_contains($pSlugLower, 'sardar')) {
                        $primaryLink = base_url('/sardar-patel-ekta');
                    } elseif ($pSlugLower === 'hariyali-campaign' || str_contains($pSlugLower, 'green') || str_contains($pSlugLower, 'hariyali')) {
                        $primaryLink = base_url('/green-gang');
                    }
                  ?>
                  <a href="<?= e($primaryLink) ?>" class="inline-flex items-center gap-2 bg-[#14532D] hover:bg-[#0F3D21] text-white px-6 py-3.5 rounded-2xl text-sm font-bold transition-all shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                    <span><?= e(ps_text('अभियान विस्तृत विवरण', 'Explore Campaign Details')) ?></span>
                    <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
                  </a>
                  <a href="<?= e(base_url('/volunteer')) ?>" class="inline-flex items-center gap-2 bg-white hover:bg-[#F8FAFC] text-[#14532D] px-5 py-3.5 rounded-2xl text-sm font-bold transition-all border border-[#CBD5E1] hover:border-[#14532D]">
                    <span class="material-symbols-outlined text-[18px] text-[#C05632]">flag</span>
                    <span><?= e(ps_text('एकता दल से जुड़ें', 'Join Campaign')) ?></span>
                  </a>
                  <a href="<?= e(base_url('/donation')) ?>" class="inline-flex items-center gap-2 bg-[#C05632] hover:bg-[#A9472B] text-white px-5 py-3.5 rounded-2xl text-sm font-bold transition-all shadow-sm">
                    <span class="material-symbols-outlined text-[18px]">volunteer_activism</span>
                    <span><?= e(ps_text('अभियान सहयोग', 'Support Cause')) ?></span>
                  </a>
                </div>
                <span class="text-xs text-[#94A3B8] font-medium hidden xl:inline-block">#PradeepSarang #Barabanki</span>
              </div>
            </div>

          </div>
        </article>
        <?php endif; ?>

        <!-- ==============================================
             SECONDARY CAMPAIGNS GRID (100% UNIFORM FULL-FILL IMAGE CARDS)
             ============================================== -->
        <?php foreach ($regularCampaigns as $c): 
          $catBadgeColor = 'text-[#15803D] bg-[#F1F7F2] border-[#15803D]/20';
          if ($c['category'] === 'bird') $catBadgeColor = 'text-[#C05632] bg-[#FAF8F3] border-[#C05632]/20';
          if ($c['category'] === 'culture') $catBadgeColor = 'text-[#78350F] bg-[#FFFBEB] border-[#F59E0B]/20';

          $cSlugLower = strtolower($c['slug']);
          $campaignLink = base_url('/campaigns/' . $c['slug']);
          if ($cSlugLower === 'hariyali-campaign' || str_contains($cSlugLower, 'green') || str_contains($cSlugLower, 'hariyali')) {
              $campaignLink = base_url('/green-gang');
          } elseif ($cSlugLower === 'sardar-patel-ekta' || str_contains($cSlugLower, 'patel') || str_contains($cSlugLower, 'sardar')) {
              $campaignLink = base_url('/sardar-patel-ekta');
          }
        ?>
        <article class="campaign-card lg:col-span-6 bg-white rounded-3xl shadow-sm hover:shadow-xl border border-[#E5E7EB] transition-all duration-300 overflow-hidden flex flex-col justify-between hover:-translate-y-1" data-category="<?= e($c['category']) ?>">
          <div>
            <!-- Full Edge-to-Edge Image Header (Uniform Dimensions across all cards) -->
            <div class="relative w-full h-64 sm:h-72 bg-[#18392B] overflow-hidden border-b border-[#E5E7EB] group">
              <a href="<?= e($campaignLink) ?>" class="block w-full h-full">
                <img src="<?= e($c['image']) ?>" alt="<?= e($c['title']) ?>" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent to-black/20 pointer-events-none"></div>
              </a>

              <!-- Top Floating Status Badge -->
              <?php if (!empty($c['status'])): ?>
              <div class="absolute top-4 right-4 z-10 pointer-events-none">
                <span class="text-xs font-semibold text-white bg-black/40 backdrop-blur-md px-2.5 py-0.5 rounded-md border border-white/20 capitalize">● <?= e($c['status']) ?></span>
              </div>
              <?php endif; ?>
            </div>

            <!-- Content Area -->
            <div class="p-6 sm:p-8">
              <h3 class="text-xl sm:text-2xl font-extrabold text-[#14532D] mb-3 leading-snug">
                <a href="<?= e($campaignLink) ?>" class="hover:text-[#C05632] transition-colors">
                  <?= e($c['title']) ?>
                </a>
              </h3>

              <p class="text-sm text-[#475467] leading-relaxed mb-5">
                <?= e($c['excerpt']) ?>
              </p>

              <?php if ($c['goal_amount'] > 0): 
                $pct = min(100, round(($c['raised_amount'] / $c['goal_amount']) * 100));
              ?>
              <!-- Goal Progress Bar -->
              <div class="mb-5 p-3.5 bg-[#FAF8F3] rounded-2xl border border-[#E5E7EB]">
                <div class="flex items-center justify-between text-xs font-bold text-[#14532D] mb-1">
                  <span><?= e(ps_text('सहयोग:', 'Goal:')) ?> <?= $pct ?>%</span>
                  <span>₹<?= number_format($c['raised_amount']) ?> / ₹<?= number_format($c['goal_amount']) ?></span>
                </div>
                <div class="w-full bg-[#E2E8F0] h-2.5 rounded-full overflow-hidden">
                  <div class="bg-[#C05632] h-full rounded-full" style="width: <?= $pct ?>%;"></div>
                </div>
              </div>
              <?php endif; ?>

              <!-- Highlights Checklist -->
              <div class="space-y-2 mb-2 bg-[#F1F7F2] p-3.5 rounded-2xl border border-[#E5E7EB]">
                <?php foreach ($c['highlights'] as $hl): ?>
                <div class="flex items-center gap-2.5 text-[#14532D] text-xs sm:text-sm font-semibold">
                  <span class="material-symbols-outlined text-[18px] text-[#15803D]">check_circle</span>
                  <span><?= e($hl) ?></span>
                </div>
                <?php endforeach; ?>
              </div>
            </div>
          </div>

          <!-- Card Footer Actions -->
          <div class="px-6 sm:px-8 pb-6 pt-4 border-t border-[#F1F5F9] flex flex-wrap items-center justify-between gap-3 bg-[#FAFAFA]">
            <div class="flex flex-wrap items-center gap-2">
              <a href="<?= e($campaignLink) ?>" class="inline-flex items-center gap-1.5 bg-[#14532D] hover:bg-[#0F3D21] text-white px-4 py-2.5 rounded-xl text-xs sm:text-sm font-bold transition-all shadow-xs">
                <span><?= e(ps_text('अभियान विवरण देखें', 'View Campaign')) ?></span>
                <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
              </a>
              <a href="<?= e(base_url('/volunteer')) ?>" class="inline-flex items-center gap-1.5 bg-white hover:bg-[#F1F7F2] text-[#14532D] px-3.5 py-2.5 rounded-xl text-xs sm:text-sm font-bold transition-all border border-[#CBD5E1]">
                <span class="material-symbols-outlined text-[16px] text-[#15803D]">handshake</span>
                <span><?= e(ps_text('सहभागिता करें', 'Participate')) ?></span>
              </a>
            </div>
            <a href="<?= e(base_url('/donation')) ?>" class="inline-flex items-center gap-1.5 bg-[#C05632] hover:bg-[#A9472B] text-white px-4 py-2.5 rounded-xl text-xs sm:text-sm font-bold transition-all shadow-xs">
              <span class="material-symbols-outlined text-[16px]">volunteer_activism</span>
              <span><?= e(ps_text('सहयोग करें (Donate)', 'Donate Now')) ?></span>
            </a>
          </div>
        </article>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <!-- 5. "अभियानों में कैसे जुड़ें?" (How to Get Involved - 3 Pillars) -->
  <section class="w-full bg-[#F1F7F2] py-14 lg:py-20 border-t border-b border-[#E5E7EB]" id="volunteer-involvement">
    <div class="max-w-container-max mx-auto px-4 sm:px-8">
      <div class="text-center max-w-2xl mx-auto mb-12">
        <span class="text-xs uppercase tracking-widest text-[#C05632] font-bold"><?= e(ps_text('सहभागिता के तीन सशक्त मार्ग', 'Three Ways to Participate')) ?></span>
        <h2 class="text-2xl sm:text-3xl lg:text-4xl text-[#14532D] font-extrabold mt-1"><?= e(ps_text('अभियानों में आप कैसे जुड़ सकते हैं?', 'How You Can Get Involved')) ?></h2>
        <p class="text-base text-[#475467] mt-3 leading-relaxed">
          <?= e(ps_text('प्रत्येक नागरिक का छोटा सा योगदान धरती और समाज में एक बड़ी क्रांति ला सकता है। आप अपनी रुचि और सुविधानुसार सीधे सहभागी बन सकते हैं।', 'Every small contribution drives lasting impact. Participate according to your passion and availability.')) ?>
        </p>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-3 gap-6 sm:gap-8">
        <!-- Pillar 1 -->
        <div class="bg-white rounded-3xl p-8 shadow-sm hover:shadow-xl border border-[#E5E7EB] transition-all duration-300 flex flex-col justify-between hover:-translate-y-1">
          <div>
            <div class="w-16 h-16 rounded-2xl bg-[#F1F7F2] flex items-center justify-center text-[#15803D] mb-6 border border-[#E2E8F0] shadow-inner">
              <span class="material-symbols-outlined text-[36px]">diversity_1</span>
            </div>
            <span class="text-xs font-bold uppercase tracking-wider text-[#15803D]"><?= e(ps_text('स्तम्भ १ • प्रत्यक्ष सेवा', 'Pillar 1 • Direct Service')) ?></span>
            <h3 class="text-xl font-bold text-[#14532D] mt-1 mb-3"><?= e(ps_text('\'ग्रीन गैंग\' के स्वयंसेवक बनें', 'Become a Green Gang Volunteer')) ?></h3>
            <p class="text-sm text-[#475467] leading-relaxed mb-6">
              <?= e(ps_text('वृक्षारोपण, परिंदा जलपात्र वितरण और गाँव की पर्यावरण सुरक्षा में अपना सक्रिय समय दें। अपने क्षेत्र में प्रकृति मित्रों का दस्ता तैयार करें।', 'Dedicate your time for tree planting, bird water pot distribution, and environmental youth squads in your village.')) ?>
            </p>
          </div>
          <a href="<?= e(base_url('/volunteer')) ?>" class="inline-flex items-center gap-2 text-[#15803D] hover:text-[#14532D] text-sm font-bold transition-colors">
            <span><?= e(ps_text('स्वयंसेवक फॉर्म भरें', 'Fill Volunteer Form')) ?></span>
            <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
          </a>
        </div>

        <!-- Pillar 2 -->
        <div class="bg-white rounded-3xl p-8 shadow-sm hover:shadow-xl border border-[#E5E7EB] transition-all duration-300 flex flex-col justify-between hover:-translate-y-1">
          <div>
            <div class="w-16 h-16 rounded-2xl bg-[#FAF8F3] flex items-center justify-center text-[#C05632] mb-6 border border-[#E2E8F0] shadow-inner">
              <span class="material-symbols-outlined text-[36px]">campaign</span>
            </div>
            <span class="text-xs font-bold uppercase tracking-wider text-[#C05632]"><?= e(ps_text('स्तम्भ २ • सामुदायिक संवाद', 'Pillar 2 • Community Outreach')) ?></span>
            <h3 class="text-xl font-bold text-[#14532D] mt-1 mb-3"><?= e(ps_text('गाँव / विद्यालय में \'ग्रीन चौपाल\'', 'Host a Green Chaupal')) ?></h3>
            <p class="text-sm text-[#475467] leading-relaxed mb-6">
              <?= e(ps_text('अपने संस्थान, पंचायत या विद्यालय में प्रदीप सारंग जी को जन-संवाद, मानस विचार गोष्ठी, एकता चेतना अथवा पर्यावरण जागरूकता हेतु आमंत्रित करें।', 'Invite Pradeep Sarang to conduct environmental awareness or Awadhi literature sessions in your community.')) ?>
            </p>
          </div>
          <a href="<?= e(base_url('/contact')) ?>" class="inline-flex items-center gap-2 text-[#C05632] hover:text-[#A9472B] text-sm font-bold transition-colors">
            <span><?= e(ps_text('कार्यक्रम का आमंत्रण भेजें', 'Send Event Invite')) ?></span>
            <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
          </a>
        </div>

        <!-- Pillar 3 -->
        <div class="bg-white rounded-3xl p-8 shadow-sm hover:shadow-xl border border-[#E5E7EB] transition-all duration-300 flex flex-col justify-between hover:-translate-y-1">
          <div>
            <div class="w-16 h-16 rounded-2xl bg-[#F1F7F2] flex items-center justify-center text-[#14532D] mb-6 border border-[#E2E8F0] shadow-inner">
              <span class="material-symbols-outlined text-[36px]">volunteer_activism</span>
            </div>
            <span class="text-xs font-bold uppercase tracking-wider text-[#14532D]"><?= e(ps_text('स्तम्भ ३ • साधन सहयोग', 'Pillar 3 • Resource Support')) ?></span>
            <h3 class="text-xl font-bold text-[#14532D] mt-1 mb-3"><?= e(ps_text('सकोरे व पौध संरक्षण प्रायोजित करें', 'Sponsor Water Bowls & Saplings')) ?></h3>
            <p class="text-sm text-[#475467] leading-relaxed mb-6">
              <?= e(ps_text('गर्मी के मौसम में मिट्टी के सकोरे, दाना-पानी सामग्री अथवा फलदार व छायादार पौधे प्रायोजित कर मूक पक्षियों व धरा की सेवा में सहयोग दें।', 'Sponsor earthen water pots, bird grains, or tree guards to empower frontline conservation.')) ?>
            </p>
          </div>
          <a href="<?= e(base_url('/donation')) ?>" class="inline-flex items-center gap-2 text-[#14532D] hover:text-[#0F3D21] text-sm font-bold transition-colors">
            <span><?= e(ps_text('सहयोग राशि / सामग्री दान', 'Sponsor a Cause')) ?></span>
            <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
          </a>
        </div>
      </div>
    </div>
  </section>

  <!-- 6. QUOTE BANNER SECTION -->
  <section class="w-full bg-white py-14 lg:py-18 text-center border-b border-[#E5E7EB]">
    <div class="max-w-3xl mx-auto px-4">
      <p class="font-quote-editorial text-xl sm:text-2xl text-[#14532D] leading-relaxed italic font-medium">
        "<?= e(ps_text('धरती को हरी-भरी बनाना और बेज़ुबानों की प्यास बुझाना केवल कर्म नहीं, आत्मा का धर्म है।', 'Greening the Earth and slaking the thirst of wildlife is not merely duty; it is the soul\'s calling.')) ?>"
      </p>
      <div class="flex items-center justify-center gap-3 mt-6">
        <div class="w-10 h-0.5 bg-[#15803D]"></div>
        <span class="text-base font-bold text-[#14532D]"><?= e(ps_text('प्रदीप सारंग', 'Pradeep Sarang')) ?></span>
        <div class="w-10 h-0.5 bg-[#15803D]"></div>
      </div>
      <span class="text-xs text-[#64748B] mt-1.5 block font-medium"><?= e(ps_text('पर्यावरणविद्, लोकसेवक एवं साहित्यकार, बाराबंकी', 'Environmentalist, Social Worker & Author, Barabanki')) ?></span>
    </div>
  </section>

  <!-- 7. LEADERSHIP CTA BANNER -->
  <section class="w-full bg-[#FAF8F3] py-14 lg:py-18">
    <div class="max-w-container-max mx-auto px-4 sm:px-8">
      <div class="bg-gradient-to-r from-[#14532D] via-[#18392B] to-[#15803D] rounded-3xl p-8 sm:p-12 text-white shadow-2xl flex flex-col lg:flex-row items-center justify-between gap-8 border border-white/10">
        <div class="max-w-2xl">
          <div class="inline-flex items-center gap-2 bg-white/10 px-3.5 py-1 rounded-full text-xs text-[#F4C96B] mb-3 font-bold border border-white/15">
            <span class="material-symbols-outlined text-[16px]">leaderboard</span>
            <span><?= e(ps_text('स्थानीय नेतृत्व एवं जन-पहल', 'Leadership & Local Outreach')) ?></span>
          </div>
          <h3 class="text-2xl sm:text-3xl lg:text-4xl text-white font-bold leading-tight mb-3">
            <?= e(ps_text('क्या आप अपने क्षेत्र में हमारे किसी अभियान का नेतृत्व करना चाहते हैं?', 'Would You Like to Lead a Campaign in Your Village or School?')) ?>
          </h3>
          <p class="text-sm sm:text-base text-white/80 leading-relaxed font-normal">
            <?= e(ps_text('यदि आप अपने गाँव, कस्बे, विद्यालय अथवा संस्था में हरियाली, परिंदा दाना-पानी या अवधी साहित्य गोष्ठी का आयोजन कराना चाहते हैं, तो हमसे सीधा संपर्क करें।', 'If you want to organize a Green Morning drive or Awadhi literature session in your institution, contact us directly.')) ?>
          </p>
        </div>

        <div class="flex flex-col sm:flex-row items-center gap-4 w-full lg:w-auto shrink-0">
          <a href="tel:<?= e($phoneClean) ?>" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 bg-[#F4C96B] hover:bg-[#E5BA5A] text-[#14532D] px-7 py-3.5 rounded-2xl text-base font-bold transition-all shadow-lg transform hover:-translate-y-0.5">
            <span class="material-symbols-outlined text-[20px]">call</span>
            <span><?= e(ps_text('सीधा संवाद (', 'Direct Call (')) ?><?= e($phone) ?>)</span>
          </a>
          <a href="<?= e(base_url('/contact')) ?>" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 bg-white/15 hover:bg-white/25 text-white px-7 py-3.5 rounded-2xl text-base font-bold transition-all border border-white/20">
            <span class="material-symbols-outlined text-[20px]">edit_note</span>
            <span><?= e(ps_text('संपर्क प्रपत्र भरें', 'Fill Contact Form')) ?></span>
          </a>
        </div>
      </div>
    </div>
  </section>
</div>

<!-- Interactive Category Filter Script -->
<script>
  (function() {
    const tabs = document.querySelectorAll('.campaign-tab-btn');
    const cards = document.querySelectorAll('.campaign-card');

    tabs.forEach(tab => {
      tab.addEventListener('click', () => {
        const filter = tab.getAttribute('data-filter');

        // Toggle active tab styles
        tabs.forEach(t => {
          t.classList.remove('bg-[#14532D]', 'text-white', 'shadow-xs');
          t.classList.add('text-[#475467]');
        });
        tab.classList.add('bg-[#14532D]', 'text-white', 'shadow-xs');
        tab.classList.remove('text-[#475467]');

        // Filter cards smoothly
        cards.forEach(card => {
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
