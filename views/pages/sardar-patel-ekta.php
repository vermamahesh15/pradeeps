<?php
declare(strict_types=1);

$campaigns = $campaigns ?? [];
$phone = trim($settings['phone'] ?? '+91 9919007190');
$phoneClean = preg_replace('/[^+0-9]/', '', $phone);
$email = trim($settings['email'] ?? 'contact@pradeepsarang.in');

// Exact verbatim charter and text provided for Sardar Patel Samajotthan Trust
$trustName = "सरदार पटेल समाजोत्थान ट्रस्ट";
$campaignTitle = "सरदार पटेल अभियान";

// 12 Core Objectives (उद्देश्य)
$objectives = [
    [
        'id' => 1,
        'title' => 'लौह पुरुष के सिद्धांतों व किसान आंदोलन से जन-परिचय',
        'desc' => 'अखण्ड भारत के निर्माता भारत रत्न लौह पुरुष सरदार वल्लभ भाई पटेल के सिद्धांतों, उनकी ईमानदारी, उनके चरित्र की दृढ़ता, सदाशयता, संकल्प शक्ति, किसान आंदोलन इत्यादि से जन-जन को परिचित कराना।',
        'icon' => 'history_edu',
        'category' => 'legacy',
        'tag' => 'सिद्धांत व इतिहास'
    ],
    [
        'id' => 2,
        'title' => 'एकता-अखण्डता व आपसी भाईचारे का सुदृढ़ीकरण',
        'desc' => 'सरदार पटेल द्वारा निर्मित भारत की एकता अखण्डता को अक्षुण बनाये रखने हेतु जन-जन में समझदारी तथा आपसी भाईचारा प्रबल बनाना।',
        'icon' => 'diversity_1',
        'category' => 'unity',
        'tag' => 'राष्ट्रीय एकता'
    ],
    [
        'id' => 3,
        'title' => 'साहित्य, संगीत, काव्य सृजन एवं विशेषांक प्रकाशन',
        'desc' => 'सरदार पटेल के जीवन चरित्र सम्बन्धी साहित्य, संगीत, काव्य, सृजित करना/कराना एवं पुस्तक/पत्र/पत्रिका विशेषांक के प्रकाशन करना कराना।',
        'icon' => 'menu_book',
        'category' => 'culture',
        'tag' => 'साहित्य व प्रकाशन'
    ],
    [
        'id' => 4,
        'title' => 'समग्र उन्नयन व पटेल-स्वाभिमान का उच्चीकरण',
        'desc' => 'पटेल अनुयायियों के शैक्षिक, सामाजिक, आर्थिक, राजनैतिक, व्यावसायिक, साहित्यिक, बौद्धिक, सांस्कृतिक उन्नयन एवं पटेल-स्वाभिमान को उच्चतम शिखर तक ले जाने हेतु अनेकानेक जागरूकता गतिविधियों/कार्यक्रमों/परियोजनाओं के संचालन करना, कराना।',
        'icon' => 'workspace_premium',
        'category' => 'empowerment',
        'tag' => 'स्वाभिमान व प्रगति'
    ],
    [
        'id' => 5,
        'title' => 'संस्कारित, तर्कशील व वैज्ञानिक दृष्टिकोण से संपन्न भावी पीढ़ी',
        'desc' => 'पटेल अनुयायियों/ भावी पीढ़ी को कर्मठ, ईमानदार, जागरूक, सुशिक्षित, संस्कारित, कौशल-सम्पन्न, तर्कशील बनाने, सामाजिक कुरीतियों तथा अंधविश्वास से मुक्ति दिलाने तथा वैज्ञानिक-दृष्टिकोण अपनाने हेतु जागरूकता व प्रेणात्मक अनेकानेक कार्यक्रमों, गतिविधियों के आयोजन करना, कराना।',
        'icon' => 'psychology',
        'category' => 'education',
        'tag' => 'वैज्ञानिक दृष्टिकोण'
    ],
    [
        'id' => 6,
        'title' => 'पिछड़ेपन के कारकों की पहचान व उपचारात्मक समाधान',
        'desc' => 'पटेल अनुयायियों/भावी पीढ़ी को आर्थिक पिछड़ेपन के, तथा साहित्यिक एवं राजनैतिक पिछड़ेपन के जिम्मेदार कारकों की पहचान कर, कराकर उन्नयन हेतु उपचारात्मक कार्यक्रमों/गतिविधियों के आयोजन करना कराना।',
        'icon' => 'insights',
        'category' => 'empowerment',
        'tag' => 'उपचारात्मक उन्नयन'
    ],
    [
        'id' => 7,
        'title' => 'समयदान, धन-दान, श्रमदान व स्वैच्छिक योगदान',
        'desc' => 'पटेल-मान-सम्मान-स्वाभिमान के निरन्तर-उच्चीकरण हेतु स्वैच्छिक आधार पर समयदान, धन-दान, श्रमदान एवं वांछनीय योगदान प्राप्त करना।',
        'icon' => 'volunteer_activism',
        'category' => 'service',
        'tag' => 'स्वैच्छिक योगदान'
    ],
    [
        'id' => 8,
        'title' => 'उत्कृष्ट कार्य व प्रेरणात्मक आदर्शों का सम्मान व प्रोत्साहन',
        'desc' => 'समाज में उत्कृष्ट कार्य करने वालों, प्रेरणात्मक आदर्श प्रस्तुत करने वालों को समय समय प्रोत्साहन/सम्मान/पुरस्कार/मानदेय/ प्रेरणा-वृत्ति इत्यादि प्रदान करना।',
        'icon' => 'military_tech',
        'category' => 'recognition',
        'tag' => 'सम्मान व पुरस्कार'
    ],
    [
        'id' => 9,
        'title' => 'संगोष्ठी, मेला, प्रशिक्षण एवं शोध केन्द्रों की स्थापना',
        'desc' => 'उद्देश्यों की पूर्ति, प्राप्ति हेतु संगोष्ठी, कार्यशाला, उत्सव, मेला, प्रदर्शनी, प्रतियोगिता, प्रशिक्षण इत्यादि के आयोजन करना, कराना तथा यथावश्यक संस्थान, प्रशिक्षण केंद्र, शोध केन्द्र, आदि इत्यादि की स्थापना एवं संचालन करना/ कराना।',
        'icon' => 'account_balance',
        'category' => 'institution',
        'tag' => 'प्रशिक्षण व शोध'
    ],
    [
        'id' => 10,
        'title' => 'पृथ्वी एवं मानव स्वास्थ्य संवर्धन अभियान',
        'desc' => 'पृथ्वी और मानव स्वास्थ्य को उत्कृष्ट बनाने तथा बेहतर बनाये रखने हेतु अनेक कार्यक्रम, गतिविधियों के आयोजन करना कराना।',
        'icon' => 'eco',
        'category' => 'health',
        'tag' => 'पर्यावरण व स्वास्थ्य'
    ],
    [
        'id' => 11,
        'title' => 'शासन-प्रशासन, संस्थाओं व समाज से सहयोग व अनुदान',
        'desc' => 'उद्देश्यों की पूर्ति प्राप्ति हेतु केंद्र/प्रान्त सरकार से, शासन-प्रशासन से, ग्राम/क्षेत्र/जिला पंचायत से, सरकारी व गैर सरकारी विभागों/अभिकरणों/परियोजनाओं/संस्थाओं/व्यक्तियों से, दान/अनुदान प्राप्त करना।',
        'icon' => 'handshake',
        'category' => 'governance',
        'tag' => 'सहयोग व अनुदान'
    ],
    [
        'id' => 12,
        'title' => 'निर्बल, असहाय व अशक्त जनों की सेवा व सहयोग',
        'desc' => 'सरदार पटेल समाजोत्थान संगठन द्वारा समाज के अशक्त, असहाय, निर्बल, को सेवा, सहायता, सहयोग, वृत्ति, प्रदान करना/कराना।',
        'icon' => 'healing',
        'category' => 'welfare',
        'tag' => 'अंत्योदय व सेवा'
    ],
];

// Ideology & Principles (परिचय एवं वैचारिकी)
$ideologyPoints = [
    [
        'num' => 1,
        'title' => 'पूर्णतया अराजनैतिक स्वरूप एवं सामूहिक शक्ति',
        'text' => 'यह संगठन पूर्णतया अराजनैतिक रहेगा यानी कभी भी किसी राजनैतिक दल अथवा किसी राजनेता का न ही समर्थन करेगा न ही विरोध करेगा। यह संगठन सिर्फ पटेल अनुयायियों की व भावी पीढ़ी की समस्त प्रकार की उन्नति को समर्पित रहेगा। एकीकरण के द्वारा सामूहिक शक्ति का एहसास कराना संगठन का प्रमुख लक्ष्य है।',
        'highlight' => 'पूर्णतया अराजनैतिक • केवल समाज व भावी पीढ़ी के उत्थान को समर्पित',
        'icon' => 'policy',
        'badge' => 'अराजनैतिक सिद्धांत'
    ],
    [
        'num' => 2,
        'title' => '“न अन्याय करेंगे, न अन्याय सहेंगे” — 31 अक्तूबर दीपोत्सव',
        'text' => '"न अन्याय करेंगे, न अन्याय सहेंगे"। हमें विश्वास है कि आप सभी पटेल अनुयायीगण हमारे अनुरोध को स्वीकार कर संगठन के उद्देश्य से सहमत होकर सरदार पटेल समाजोत्थान संगठन की सदस्यता प्राप्त करेंगे और हम सबके गौरव, देश के स्वाभिमान, भारत रत्न सरदार वल्लभ भाई पटेल जी की जयंती पर 31 अक्तूबर को प्रतिवर्ष अपने घरों में पूड़ी पकवान बनवाए जाएं, तथा शाम को कम से कम "पाँच-दीप" जलाकर दीपोत्सव मनाएं। संगठन का ये भी आव्हान है कि 31 अक्टूबर को हर वर्ष प्रत्येक इकाई द्वारा पटेल जी के चित्र पर माला-फूल के जरिये पुष्पांजलि अर्पित की जाए। ट्रस्ट का संकल्प दुहराया जाए, और पटेल जी के जीवन के प्रेरणास्पद संस्मरणों पर चर्चा हो।',
        'highlight' => '31 अक्तूबर: घरों में पूड़ी-पकवान, शाम को \'पाँच-दीप\' प्रज्वलन व सामूहिक संस्मरण चर्चा',
        'icon' => 'flare',
        'badge' => 'वार्षिक पर्व व दीपोत्सव'
    ],
    [
        'num' => 3,
        'title' => 'संविधान सम्मत न्याय व स्वाभिमान रक्षा',
        'text' => 'किसी पटेल अनुयायी के साथ अन्याय होने पर अपमान होने पर ट्रस्ट संविधान सम्मत प्रतिक्रिया व्यक्त करने का आवाहन करता है।',
        'highlight' => 'संविधान के दायरे में रहकर अन्याय व अपमान के विरुद्ध अडिग प्रतिकार',
        'icon' => 'gavel',
        'badge' => 'संवैधानिक मर्यादा'
    ],
    [
        'num' => 4,
        'title' => 'महापुरुष सर्व समाज की खुशहाली के प्रतीक',
        'text' => 'कोई भी महापुरुष तभी कहलाता है जब किसी एक जाति धर्म की बात न करके सर्व समाज की खुशहाली और उन्नति की बात करता है। प्रत्येक जाति में महापुरुष हुए हैं। सभी अपने महापुरुष को जानें और उनके बताए रास्ते पर चलकर उन्हें सच्ची श्रद्धांजलि अर्पित करें।',
        'highlight' => 'महापुरुष किसी एक जाति के नहीं, बल्कि सर्व समाज के पथ-प्रदर्शक होते हैं',
        'icon' => 'public',
        'badge' => 'सर्व-समावेशी दर्शन'
    ],
    [
        'num' => 5,
        'title' => 'कुर्मी समाज की अगुवाई एवं विराट राष्ट्रीय व्यक्तित्व',
        'text' => 'सरदार पटेल कुर्मी जाति में जन्मे हैं। इसलिए कुर्मी जाति वालों को गर्व का अनुभव होना स्वाभाविक है। किंतु पटेल जी के नाम पर सिर्फ जाति की बात करना उनके विराट व्यक्तित्व के साथ अन्याय है। कुर्मी जाति के लोगों को अगुवाई करना चाहिए कि पटेल के कृतित्व व्यक्तित्व से जनजन को सुपरिचित कराया जाए।',
        'highlight' => 'जातिगत सीमाओं से ऊपर उठकर पटेल जी के विराट राष्ट्रीय स्वरूप का जन-जन में प्रचार',
        'icon' => 'flag',
        'badge' => 'विराट व्यक्तित्व'
    ],
    [
        'num' => 6,
        'title' => 'विश्व में प्रथम पटेल आरती एवं 20-दिवसीय चेतना रथ यात्रा',
        'text' => 'सरदार पटेल समाजोत्थान ट्रस्ट द्वारा पटेल जी को देवता या ईश्वर मानकर नहीं बल्कि महामानव महापुरुष मानकर श्री वल्लभ पटेल की आरती का विधान विश्व में पहली बार सजाया और सँवारा गया है। उत्तर प्रदेश के जनपद बाराबंकी में पहली बार सामूहिक आरती की गई। प्रति वर्ष 20 दिन लगातार संचालित पटेल चेतना रथ के दौरान जगह-जगह सामूहिक पटेल आरती होती है।',
        'highlight' => 'महामानव रूप में विश्व की प्रथम \'पटेल आरती\' एवं 20-दिवसीय अनवरत चेतना रथ यात्रा',
        'icon' => 'directions_car',
        'badge' => 'ऐतिहासिक नवाचार'
    ]
];

// Trustees & Leadership (संस्थापक एवं ट्रस्टी गण)
$trustees = [
    [
        'id' => 1,
        'name' => 'विक्रम सिंह',
        'designation' => 'संस्थापक प्रधान ट्रस्टी / संस्थापक अध्यक्ष',
        'role' => 'Founder Chief Trustee & President',
        'icon' => 'military_tech',
        'badge' => 'प्रधान ट्रस्टी'
    ],
    [
        'id' => 2,
        'name' => 'प्रदीप सारंग',
        'designation' => 'संस्थापक ट्रस्टी / संस्थापक सचिव',
        'role' => 'Founder Trustee & General Secretary',
        'icon' => 'person_pin',
        'badge' => 'संस्थापक सचिव'
    ],
    [
        'id' => 3,
        'name' => 'टी.आर. वर्मा',
        'designation' => 'संस्थापक ट्रस्टी / कोषाध्यक्ष',
        'role' => 'Founder Trustee & Treasurer',
        'icon' => 'account_balance_wallet',
        'badge' => 'कोषाध्यक्ष'
    ],
    [
        'id' => 4,
        'name' => 'राम किशोर पटेल',
        'designation' => 'संस्थापक ट्रस्टी / समन्वयक',
        'role' => 'Founder Trustee & Coordinator',
        'icon' => 'hub',
        'badge' => 'समन्वयक'
    ],
    [
        'id' => 5,
        'name' => 'सुभाष चंद्र वर्मा',
        'designation' => 'ट्रस्टी / संगठन प्रभारी',
        'role' => 'Trustee & Organization In-charge',
        'icon' => 'groups',
        'badge' => 'संगठन प्रभारी'
    ],
    [
        'id' => 6,
        'name' => 'सदानंद वर्मा',
        'designation' => 'ट्रस्टी / कार्यालय प्रभारी',
        'role' => 'Trustee & Office In-charge',
        'icon' => 'domain',
        'badge' => 'कार्यालय प्रभारी'
    ]
];
?>

<style>
/* ========================================================================= */
/* SCOPED CONTRAST, TYPOGRAPHY & VISIBILITY ENFORCEMENT                      */
/* ========================================================================= */
#sardar-patel-page-root a {
  text-decoration: none;
}

/* Global button color resets to prevent Bootstrap/master theme link color hijacking */
.patel-btn-primary, 
.patel-btn-primary *,
.patel-btn-primary span { 
  color: #ffffff !important; 
}

.patel-btn-dark, 
.patel-btn-dark *,
.patel-btn-dark span { 
  color: #ffffff !important; 
}
.patel-btn-dark .icon-accent { 
  color: #f59e0b !important; 
}

.patel-btn-light, 
.patel-btn-light *,
.patel-btn-light span { 
  color: #1c1917 !important; 
}
.patel-btn-light .material-symbols-outlined {
  color: #b45309 !important;
}

.patel-btn-warm, 
.patel-btn-warm *,
.patel-btn-warm span { 
  color: #78350f !important; 
}

/* 31st October Deepotsav Grand Banner */
.deepotsav-card {
  background: linear-gradient(135deg, #78350f 0%, #451a03 50%, #1c1917 100%) !important;
  color: #ffffff !important;
}
.deepotsav-card h3,
.deepotsav-card h4 { 
  color: #ffffff !important; 
}
.deepotsav-card p,
.deepotsav-card p.desc-text,
.deepotsav-card .sub-card-text { 
  color: #fef3c7 !important; 
}
.deepotsav-card .badge-gold,
.deepotsav-card .badge-gold * { 
  color: #fde68a !important; 
}
.deepotsav-card .steps-gold, 
.deepotsav-card .steps-gold span { 
  color: #fde68a !important; 
}
.deepotsav-card .btn-gold-action, 
.deepotsav-card .btn-gold-action * { 
  color: #1c1917 !important; 
  background-color: #f59e0b !important;
}

/* Participation Stream Action Buttons */
.stream-btn-1, .stream-btn-1 * { 
  color: #ffffff !important; 
}
.stream-btn-2, .stream-btn-2 * { 
  color: #ffffff !important; 
}
.stream-btn-3, .stream-btn-3 * { 
  color: #ffffff !important; 
}

/* Final CTA Section Action Buttons */
.patel-cta-btn-1, 
.patel-cta-btn-1 *, 
.patel-cta-btn-1 span { 
  color: #ffffff !important; 
}

.patel-cta-btn-2, 
.patel-cta-btn-2 *, 
.patel-cta-btn-2 span,
.patel-cta-btn-2 i { 
  color: #ffffff !important; 
}

.patel-action-btn,
.patel-action-btn *,
.patel-action-btn span {
  color: #ffffff !important;
}

/* Ideology Tabs Active State Enforcement */
.ideology-tab-btn.is-active,
.ideology-tab-btn.is-active .tab-title-text {
  color: #ffffff !important;
  background-color: #78350f !important;
}
.ideology-tab-btn.is-active .tab-num-badge {
  color: #fde68a !important;
  background-color: #92400e !important;
}
.ideology-tab-btn.is-active .tab-badge-text {
  color: #fde68a !important;
  background-color: rgba(254, 243, 199, 0.2) !important;
}
.ideology-tab-btn.is-active .tab-arrow-icon {
  color: #fde68a !important;
}

/* Smooth micro-interactions */
.objective-card:hover {
  transform: translateY(-2px);
}
</style>

<div id="sardar-patel-page-root" class="flex flex-col w-full bg-[#fcfaf7]">

  <!-- ========================================================================= -->
  <!-- HERO & MASTHEAD SECTION                                                   -->
  <!-- ========================================================================= -->
  <section class="relative w-full bg-gradient-to-b from-[#fbf4eb] via-[#f7eee1] to-[#fcfaf7] overflow-hidden py-10 md:py-16 border-b border-[#e8ded1]">
    <!-- Heritage Architectural Pattern & Ambient Glows -->
    <div class="absolute -top-24 -right-24 w-96 h-96 rounded-full bg-amber-500/10 blur-3xl pointer-events-none"></div>
    <div class="absolute -bottom-24 -left-20 w-80 h-80 rounded-full bg-emerald-700/10 blur-3xl pointer-events-none"></div>
    <div class="absolute inset-0 opacity-[0.03] pointer-events-none" style="background-image: radial-gradient(#9a3412 1px, transparent 1px); background-size: 20px 20px;"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
      <!-- Breadcrumb Bar -->
      <nav aria-label="Breadcrumb" class="flex items-center gap-2 text-xs md:text-sm text-stone-600 mb-6 font-medium">
        <a class="hover:text-amber-800 transition-colors flex items-center gap-1" href="<?= e(base_url('/')) ?>">
          <span class="material-symbols-outlined text-[16px]">home</span>
          <span><?= e(ps_text('गृह (Home)', 'Home')) ?></span>
        </a>
        <span class="opacity-40">/</span>
        <a class="hover:text-amber-800 transition-colors" href="<?= e(base_url('/campaigns')) ?>">
          <span><?= e(ps_text('प्रमुख जन-अभियान', 'Campaigns')) ?></span>
        </a>
        <span class="opacity-40">/</span>
        <span class="text-stone-900 font-bold"><?= e(ps_text('सरदार पटेल अभियान', 'Sardar Patel Campaign')) ?></span>
      </nav>

      <!-- Grid Layout: Left Content, Right Hero Visual -->
      <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-center">
        <!-- Left Column -->
        <div class="lg:col-span-7 flex flex-col">
          <!-- Official Trust Badge -->
          <div class="inline-flex items-center gap-2 bg-amber-100/90 text-amber-950 px-4 py-1.5 rounded-full text-xs md:text-sm font-bold tracking-wide border border-amber-300 shadow-sm self-start mb-4">
            <span class="material-symbols-outlined text-[16px] text-amber-700" style="font-variation-settings: 'FILL' 1;">workspace_premium</span>
            <span><?= e($trustName) ?></span>
          </div>

          <h1 class="font-serif text-3xl sm:text-4xl md:text-5xl lg:text-5xl text-stone-900 font-extrabold leading-tight tracking-tight mb-4">
            <?= e($campaignTitle) ?>
            <span class="block text-xl sm:text-2xl md:text-3xl text-amber-800 font-semibold mt-2 font-sans">
              लौह पुरुष की वैचारिकी, अखण्ड भारत संकल्प एवं सामाजिक उत्थान
            </span>
          </h1>

          <p class="text-stone-700 text-base md:text-lg leading-relaxed mb-6 font-normal">
            अखण्ड भारत के निर्माता, भारत रत्न लौह पुरुष सरदार वल्लभभाई पटेल के सिद्धांतों, राष्ट्रभक्ति, सामाजिक समरसता, निर्भीकता एवं कृषक चेतना को जन-जन तक पहुँचाने हेतु समर्पित एक पवित्र जन-आंदोलन।
          </p>

          <!-- Grand Statement / Motto Box -->
          <div class="bg-white/90 backdrop-blur-sm rounded-2xl p-5 md:p-6 border-l-4 border-amber-600 border-t border-r border-b border-stone-200 shadow-sm mb-8 relative">
            <div>
                <p class="font-serif text-base sm:text-lg text-stone-900 italic font-semibold leading-snug mb-2">
                  "न अन्याय करेंगे, न अन्याय सहेंगे — एकीकरण के द्वारा सामूहिक शक्ति का एहसास कराना ही हमारा प्रमुख लक्ष्य है।"
                </p>
                <div class="flex items-center justify-between flex-wrap gap-2 text-xs text-stone-600 border-t border-stone-100 pt-2 mt-2">
                  <span class="font-bold text-amber-900">सरदार पटेल समाजोत्थान ट्रस्ट</span>
                  <span class="text-stone-500 font-medium">— <span style="color: #ef4444 !important; font-weight: bold;">प्रदीप सारंग</span> (सचिव)</span>
                </div>
              </div>
            </div>
          </div>

          <!-- Quick Interactive Navigation CTAs with Guaranteed Visibility -->
          <div class="flex flex-wrap items-center gap-3.5">
            <a href="#patel-sankalp" class="patel-btn-primary inline-flex items-center gap-2 px-5 py-3 rounded-xl text-sm font-bold shadow-md hover:shadow-lg transition-all transform hover:-translate-y-0.5" style="background-color: #b45309 !important; color: #ffffff !important;">
              <span class="material-symbols-outlined text-[19px]" style="color: #ffffff !important;">verified</span>
              <span style="color: #ffffff !important;"><?= e(ps_text('संकल्प पढ़ें व लें', 'Read & Take Pledge')) ?></span>
            </a>
            <a href="#patel-objectives" class="patel-btn-dark inline-flex items-center gap-2 px-5 py-3 rounded-xl text-sm font-bold shadow-md transition-all transform hover:-translate-y-0.5" style="background-color: #1c1917 !important; color: #ffffff !important;">
              <span class="icon-accent material-symbols-outlined text-[19px]" style="color: #f59e0b !important;">task_alt</span>
              <span style="color: #ffffff !important;"><?= e(ps_text('12 प्रमुख उद्देश्य', '12 Core Objectives')) ?></span>
            </a>
            <a href="#patel-ideology" class="patel-btn-light inline-flex items-center gap-2 border border-stone-300 px-4 py-3 rounded-xl text-sm font-bold transition-all shadow-sm hover:bg-stone-50" style="background-color: #ffffff !important; color: #1c1917 !important;">
              <span class="material-symbols-outlined text-[19px]" style="color: #b45309 !important;">psychology</span>
              <span style="color: #1c1917 !important;"><?= e(ps_text('परिचय एवं वैचारिकी', 'Ideology & Pillars')) ?></span>
            </a>
            <a href="#patel-trustees" class="patel-btn-warm inline-flex items-center gap-2 border border-amber-300 px-4 py-3 rounded-xl text-sm font-bold transition-all shadow-sm hover:bg-amber-100" style="background-color: #fef3c7 !important; color: #78350f !important;">
              <span class="material-symbols-outlined text-[19px]" style="color: #78350f !important;">groups</span>
              <span style="color: #78350f !important;"><?= e(ps_text('ट्रस्टी मंडल', 'Founders & Trustees')) ?></span>
            </a>
          </div>
        </div>

        <!-- Right Column: Grand Portrait Card & Key Badges -->
        <div class="lg:col-span-5 flex flex-col items-center">
          <div class="w-full max-w-md bg-white rounded-3xl p-5 shadow-xl border border-stone-200 relative overflow-hidden">
            <!-- Decorative Tricolor Gradient Accent Line -->
            <div class="h-2 w-full bg-gradient-to-r from-orange-500 via-white to-emerald-600 absolute top-0 left-0 right-0"></div>

            <!-- Portrait Frame -->
            <div class="relative rounded-2xl overflow-hidden bg-stone-900 mb-5 group border border-stone-200 shadow-inner">
              <img 
                src="<?= e(ps_resolve_img('assets/images/sardar_patel.webp', 'uploads/69ee19ac9dac4_sardar_patel_optimized.webp')) ?>" 
                alt="भारत रत्न लौह पुरुष सरदार वल्लभ भाई पटेल" 
                class="w-full h-80 sm:h-96 object-cover object-top filter brightness-[1.02] contrast-[1.03] transition-transform duration-500 group-hover:scale-105"
              >
              <div class="absolute inset-0 bg-gradient-to-t from-stone-950 via-stone-950/30 to-transparent flex flex-col justify-end p-5 text-white">
                <span class="text-xs font-bold uppercase tracking-wider flex items-center gap-1 mb-1" style="color: #fde68a !important;">
                  <span class="material-symbols-outlined text-[15px]" style="color: #fde68a !important;">stars</span>
                  <span style="color: #fde68a !important;">भारत रत्न • लौह पुरुष</span>
                </span>
                <h3 class="font-serif text-2xl font-bold leading-tight" style="color: #ffffff !important;">
                  सरदार वल्लभ भाई पटेल
                </h3>
                <p class="text-xs mt-1 font-medium" style="color: #e7e5e4 !important;">
                  31 अक्टूबर 1875 — 15 दिसम्बर 1950 • अखण्ड भारत के अमर शिल्पी
                </p>
              </div>
            </div>

            <!-- 3 Quick Live Fact Highlights -->
            <div class="grid grid-cols-3 gap-2 text-center pt-1">
              <div class="bg-amber-50 p-3 rounded-xl border border-amber-100">
                <span class="block text-lg font-bold text-amber-900 font-serif">31 अक्तू.</span>
                <span class="text-[11px] text-amber-800 font-medium leading-tight block">पंच-दीप दीपोत्सव</span>
              </div>
              <div class="bg-emerald-50 p-3 rounded-xl border border-emerald-100">
                <span class="block text-lg font-bold text-emerald-900 font-serif">20 दिन</span>
                <span class="text-[11px] text-emerald-800 font-medium leading-tight block">पटेल चेतना रथ</span>
              </div>
              <div class="bg-stone-50 p-3 rounded-xl border border-stone-200">
                <span class="block text-lg font-bold text-stone-900 font-serif">प्रथम</span>
                <span class="text-[11px] text-stone-700 font-medium leading-tight block">श्री पटेल आरती</span>
              </div>
            </div>

            <!-- Share & Action Micro Bar -->
            <div class="mt-4 pt-3 border-t border-stone-100 flex items-center justify-between text-xs text-stone-600">
              <span class="flex items-center gap-1 font-semibold text-stone-700">
                <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                पूर्णतया अराजनैतिक ट्रस्ट
              </span>
              <button onclick="sharePatelPage()" class="inline-flex items-center gap-1 text-amber-800 hover:text-amber-950 font-bold transition-colors">
                <span class="material-symbols-outlined text-[15px]">share</span>
                <span>शेयर करें</span>
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ========================================================================= -->
  <!-- 4 STATS / IMPACT METRICS RIBBON                                           -->
  <!-- ========================================================================= -->
  <section class="w-full bg-stone-900 text-white py-8 shadow-inner border-y border-stone-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="grid grid-cols-2 md:grid-cols-4 gap-6 text-center">
        <!-- Metric 1 -->
        <div class="flex flex-col items-center p-3 rounded-xl bg-white/5 border border-white/10 hover:bg-white/10 transition-colors">
          <span class="material-symbols-outlined text-amber-400 text-3xl mb-1">flare</span>
          <span class="font-serif text-2xl md:text-3xl font-bold text-amber-400">31 अक्तूबर</span>
          <span class="text-sm font-semibold text-stone-200 mt-1">पाँच-दीप दीपोत्सव पर्व</span>
          <span class="text-xs text-stone-400 mt-0.5">जयंती पर घर-घर उत्सव व संस्मरण</span>
        </div>

        <!-- Metric 2 -->
        <div class="flex flex-col items-center p-3 rounded-xl bg-white/5 border border-white/10 hover:bg-white/10 transition-colors">
          <span class="material-symbols-outlined text-emerald-400 text-3xl mb-1">directions_car</span>
          <span class="font-serif text-2xl md:text-3xl font-bold text-emerald-400">20-दिवसीय</span>
          <span class="text-sm font-semibold text-stone-200 mt-1">पटेल चेतना रथ यात्रा</span>
          <span class="text-xs text-stone-400 mt-0.5">प्रतिवर्ष जन-जन तक सामूहिक चेतना</span>
        </div>

        <!-- Metric 3 -->
        <div class="flex flex-col items-center p-3 rounded-xl bg-white/5 border border-white/10 hover:bg-white/10 transition-colors">
          <span class="material-symbols-outlined text-amber-300 text-3xl mb-1">menu_book</span>
          <span class="font-serif text-2xl md:text-3xl font-bold text-amber-300">12 उद्देश्य</span>
          <span class="text-sm font-semibold text-stone-200 mt-1">समाज के समग्र उत्थान</span>
          <span class="text-xs text-stone-400 mt-0.5">शिक्षा, संस्कार, स्वाभिमान व सेवा</span>
        </div>

        <!-- Metric 4 -->
        <div class="flex flex-col items-center p-3 rounded-xl bg-white/5 border border-white/10 hover:bg-white/10 transition-colors">
          <span class="material-symbols-outlined text-blue-400 text-3xl mb-1">diversity_3</span>
          <span class="font-serif text-2xl md:text-3xl font-bold text-blue-400">100% अराजनैतिक</span>
          <span class="text-sm font-semibold text-stone-200 mt-1">एकता एवं सर्व-समरसता</span>
          <span class="text-xs text-stone-400 mt-0.5">संविधान सम्मत न्याय व बंधुत्व</span>
        </div>
      </div>
    </div>
  </section>

  <!-- ========================================================================= -->
  <!-- SECTION 1: 12 CORE OBJECTIVES (उद्देश्य)                                  -->
  <!-- ========================================================================= -->
  <section id="patel-objectives" class="w-full py-16 md:py-24 bg-[#fbf8f3] border-b border-[#e8ded1] scroll-mt-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      
      <!-- Section Header -->
      <div class="text-center max-w-3xl mx-auto mb-12">
        <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-amber-100 text-amber-950 text-xs md:text-sm font-bold tracking-wider uppercase mb-3 border border-amber-300">
          <span class="material-symbols-outlined text-[16px] text-amber-700">checklist</span>
          <span>सरदार पटेल समाजोत्थान ट्रस्ट • अधिकृत घोषणा</span>
        </div>
        <h2 class="font-serif text-3xl sm:text-4xl text-stone-900 font-extrabold tracking-tight">
          ट्रस्ट के 12 आधारभूत उद्देश्य
        </h2>
        <div class="w-24 h-1 bg-gradient-to-r from-amber-600 to-amber-400 mx-auto mt-4 mb-4 rounded-full"></div>
        <p class="text-stone-700 text-base leading-relaxed">
          पटेल अनुयायियों, कृषक समाज, भावी पीढ़ी एवं राष्ट्र की एकता-अखंडता के सतत उन्नयन हेतु निर्धारित 12 मूल संकल्प एवं कार्ययोजनाएं।
        </p>
      </div>

      <!-- Live Search & Filter Bar -->
      <div class="max-w-2xl mx-auto mb-10">
        <div class="relative flex items-center">
          <span class="material-symbols-outlined absolute left-4 text-stone-400 text-2xl pointer-events-none">search</span>
          <input 
            type="text" 
            id="objectiveSearchInput" 
            oninput="filterObjectives()" 
            placeholder="उद्देश्य खोजें (उदा. शिक्षा, साहित्य, एकता, स्वास्थ्य, चेतना, अनुदान...)"
            class="w-full pl-12 pr-10 py-3.5 bg-white rounded-2xl border border-stone-300 shadow-sm focus:outline-none focus:ring-2 focus:ring-amber-600 focus:border-amber-600 text-stone-800 text-sm font-medium transition-all"
          >
          <button 
            id="clearObjectiveSearch" 
            onclick="clearObjectiveSearchBox()" 
            class="hidden absolute right-3 text-stone-400 hover:text-stone-600 p-1.5"
            title="Clear"
          >
            <span class="material-symbols-outlined text-[18px]">close</span>
          </button>
        </div>
      </div>

      <!-- 12 Objectives Grid -->
      <div id="objectivesGrid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <?php foreach ($objectives as $obj): ?>
          <article 
            class="objective-card bg-white rounded-2xl p-6 border border-stone-200 shadow-sm hover:shadow-md transition-all duration-300 flex flex-col justify-between group hover:border-amber-400 relative overflow-hidden"
            data-text="<?= e(mb_strtolower($obj['title'] . ' ' . $obj['desc'] . ' ' . $obj['tag'])) ?>"
          >
            <!-- Top Watermark Number -->
            <div class="absolute -right-3 -top-3 w-16 h-16 rounded-full bg-amber-50 text-amber-200 font-serif font-bold text-3xl flex items-center justify-center pointer-events-none select-none group-hover:text-amber-300 group-hover:bg-amber-100/60 transition-colors">
              <?= $obj['id'] ?>
            </div>

            <div>
              <!-- Header with Icon & Tag -->
              <div class="flex items-center gap-3 mb-4">
                <div class="w-12 h-12 rounded-xl bg-amber-100 text-amber-800 flex items-center justify-center font-bold shadow-inner group-hover:bg-amber-600 group-hover:text-white transition-colors">
                  <span class="material-symbols-outlined text-[24px]"><?= e($obj['icon']) ?></span>
                </div>
                <div>
                  <span class="inline-block text-[11px] font-bold text-amber-800 bg-amber-50 px-2.5 py-0.5 rounded-md border border-amber-200">
                    उद्देश्य <?= $obj['id'] ?> • <?= e($obj['tag']) ?>
                  </span>
                  <h3 class="font-serif text-lg font-bold text-stone-900 leading-snug mt-1">
                    <?= e($obj['title']) ?>
                  </h3>
                </div>
              </div>

              <!-- Main Description (Verbatim Text) -->
              <p class="text-stone-700 text-sm leading-relaxed mb-4">
                <?= e($obj['desc']) ?>
              </p>
            </div>

            <!-- Footer Micro Actions -->
            <div class="pt-3 border-t border-stone-100 flex items-center justify-between text-xs text-stone-500">
              <span class="flex items-center gap-1 text-amber-800 font-medium">
                <span class="material-symbols-outlined text-[14px]">check_circle</span>
                अधिकृत ध्येय
              </span>
              <button onclick="copyObjectiveText(<?= $obj['id'] ?>)" class="hover:text-stone-800 flex items-center gap-1 transition-colors text-stone-500 font-semibold" title="कॉपी करें">
                <span class="material-symbols-outlined text-[14px]">content_copy</span>
                <span>कॉपी</span>
              </button>
            </div>
          </article>
        <?php endforeach; ?>
      </div>

      <!-- No Results Found Indicator -->
      <div id="noObjectiveResults" class="hidden text-center py-12 bg-white rounded-2xl border border-stone-200 max-w-md mx-auto">
        <span class="material-symbols-outlined text-4xl text-stone-400 mb-2">search_off</span>
        <h4 class="font-serif text-lg font-bold text-stone-800">कोई उद्देश्य नहीं मिला</h4>
        <p class="text-xs text-stone-500 mt-1">कृपया कोई दूसरा शब्द खोजें या सभी उद्देश्य देखें।</p>
        <button onclick="clearObjectiveSearchBox()" class="mt-4 px-4 py-1.5 bg-amber-700 text-white rounded-lg text-xs font-bold hover:bg-amber-800">
          सभी 12 उद्देश्य दिखाएं
        </button>
      </div>

      <!-- Official Authority Sign-Off Card -->
      <div class="mt-12 bg-white rounded-2xl p-6 border border-stone-200 shadow-sm flex flex-col sm:flex-row items-center justify-between gap-6 max-w-4xl mx-auto">
        <div class="flex items-center gap-4">
          <div class="w-14 h-14 rounded-full bg-amber-800 text-white flex items-center justify-center font-serif text-xl font-bold shadow-md shrink-0">
            प.सा.
          </div>
          <div>
            <h4 class="font-serif text-lg font-bold leading-tight" style="color: #ef4444 !important;">
              प्रदीप सारंग
            </h4>
            <p class="text-xs sm:text-sm text-stone-600 font-medium mt-0.5">
              संस्थापक ट्रस्टी / सचिव — सरदार पटेल समाजोत्थान ट्रस्ट
            </p>
            <p class="text-[11px] text-stone-500 mt-0.5">
              पर्यावरणविद्, अवधी साहित्यकार एवं सामाजिक कार्यकर्ता (बाराबंकी, उ.प्र.)
            </p>
          </div>
        </div>

        <div class="flex items-center gap-3 w-full sm:w-auto justify-end">
          <button onclick="copyAllObjectives()" class="inline-flex items-center gap-1.5 px-4 py-2.5 rounded-xl bg-stone-100 hover:bg-stone-200 text-stone-800 text-xs font-bold transition-colors">
            <span class="material-symbols-outlined text-[16px]">content_copy</span>
            <span>समस्त 12 उद्देश्य कॉपी करें</span>
          </button>
          <a href="<?= e(base_url('/volunteer')) ?>" class="patel-action-btn inline-flex items-center gap-1.5 px-4 py-2.5 rounded-xl text-xs font-bold shadow transition-colors" style="background-color: #b45309 !important; color: #ffffff !important; text-decoration: none;">
            <span class="material-symbols-outlined text-[16px]" style="color: #ffffff !important;">handshake</span>
            <span style="color: #ffffff !important; font-weight: 700;">सहभागी बनें</span>
          </a>
        </div>
      </div>

    </div>
  </section>

  <!-- ========================================================================= -->
  <!-- SECTION 2: पावन संकल्प (THE SACRED PLEDGE & RESOLUTION SCROLL)           -->
  <!-- ========================================================================= -->
  <section id="patel-sankalp" class="relative w-full py-16 md:py-24 bg-gradient-to-b from-[#f5ede0] via-[#fbf7ee] to-[#f5ede0] border-b border-[#e2d5c3] scroll-mt-16 overflow-hidden">
    <!-- Ambient Heritage Background -->
    <div class="absolute inset-0 opacity-[0.035] pointer-events-none" style="background-image: radial-gradient(#78350f 1px, transparent 1px); background-size: 24px 24px;"></div>
    
    <div class="max-w-4xl mx-auto px-4 sm:px-6 relative z-10">
      <!-- Section Intro -->
      <div class="text-center max-w-2xl mx-auto mb-10">
        <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-amber-800 text-amber-100 text-xs md:text-sm font-bold tracking-wider uppercase mb-3 shadow-sm">
          <span class="material-symbols-outlined text-[16px] text-amber-300">verified</span>
          <span>सरदार पटेल समाजोत्थान ट्रस्ट • आधिकारिक संकल्प</span>
        </div>
        <h2 class="font-serif text-3xl sm:text-4xl text-stone-900 font-extrabold flex items-center justify-center gap-2">
          <span class="material-symbols-outlined text-amber-700 text-3xl sm:text-4xl" style="font-variation-settings: 'FILL' 1;">auto_stories</span>
          <span>पावन संकल्प</span>
        </h2>
        <p class="text-stone-600 text-sm mt-2">
          प्रत्येक पटेल अनुयायी एवं राष्ट्र-भक्त द्वारा हृदयंगम करने योग्य पावन प्रतिज्ञा
        </p>
      </div>

      <!-- Sacred Certificate / Scroll Container -->
      <div class="relative bg-[#fffdf9] rounded-3xl p-6 sm:p-10 md:p-12 shadow-2xl border-4 border-amber-700/80 text-stone-900">
        <!-- Corner Ornaments -->
        <div class="absolute top-3 left-3 w-8 h-8 border-t-2 border-l-2 border-amber-700"></div>
        <div class="absolute top-3 right-3 w-8 h-8 border-t-2 border-r-2 border-amber-700"></div>
        <div class="absolute bottom-3 left-3 w-8 h-8 border-b-2 border-l-2 border-amber-700"></div>
        <div class="absolute bottom-3 right-3 w-8 h-8 border-b-2 border-r-2 border-amber-700"></div>

        <!-- Scroll Header with Emblem -->
        <div class="text-center border-b-2 border-amber-200 pb-6 mb-8">
          <div class="w-16 h-16 mx-auto rounded-full bg-amber-100 border-2 border-amber-600 text-amber-900 flex items-center justify-center mb-3 shadow-inner">
            <span class="material-symbols-outlined text-3xl" style="font-variation-settings: 'FILL' 1;">military_tech</span>
          </div>
          <span class="text-xs font-bold uppercase tracking-widest text-amber-800 block">
            सरदार पटेल समाजोत्थान ट्रस्ट
          </span>
          <h3 class="font-serif text-2xl sm:text-3xl font-bold text-stone-900 mt-1">
            राष्ट्रीय एकता एवं समाजोत्थान संकल्प-पत्र
          </h3>
          <p class="text-xs text-stone-500 mt-1 italic">
            "हम भारत की एकता अखंडता के लिए वह सब करेंगे जो संविधान सम्मत है"
          </p>
        </div>

        <!-- Verbatim Pledge Paragraphs -->
        <div id="pledgeFullText" class="space-y-6 font-serif text-base sm:text-lg leading-relaxed text-stone-800 text-justify">
          
          <div class="p-4 bg-amber-50/70 rounded-xl border-l-4 border-amber-700">
            <p class="font-semibold text-stone-900">
              हमें गर्व है कि हम, अखण्ड भारत के निर्माता भारत रत्न लौह पुरुष सरदार वल्लभ भाई पटेल के अनुयायी हैं, हम भारत की एकता अखण्डता के लिए वह सब करेंगे जो संविधान सम्मत है।
            </p>
          </div>

          <p class="pl-2 border-l-2 border-stone-200">
            पटेल अनुयायियों के शैक्षिक, सामाजिक, आर्थिक, राजनैतिक, व्यावसायिक, साहित्यिक, बौद्धिक, सांस्कृतिक उन्नयन एवं स्व-स्वाभिमान को उच्चतम शिखर तक ले जाने हेतु अनेकानेक जागरूकता गतिविधियों में सम्मिलित होकर, समाज को सामाजिक कुरीतियों से मुक्त बनाने में सामूहिक योगदान करेंगे।
          </p>

          <p class="pl-2 border-l-2 border-stone-200">
            भावी पीढ़ी को कर्मठ, ईमानदार, जागरूक, सुशिक्षित, संस्कारित, तर्कशील एवं अंधविश्वास-मुक्त बनाने के लिए तथा वैज्ञानिक दृष्टिकोण अपनाने हेतु अनवरत प्रयास करेंगे।
          </p>

          <p class="pl-2 border-l-2 border-stone-200">
            पटेल अनुयायियों के आर्थिक, सामाजिक, राजनैतिक, साहित्यिक एवं सांस्कृतिक पिछड़ेपन के जिम्मेदार कारकों की पहचान कर उन्नयन हेतु समुचित उपाय अपनाएंगे।
          </p>

          <p class="pl-2 border-l-2 border-stone-200">
            पृथ्वी और मानव स्वास्थ्य के सम्वर्धन हेतु न सिर्फ सतर्क रहेंगे बल्कि निरन्तर बेहतरी की स्थिति बनाने हेतु वांछित कदम भी उठाएंगे।
          </p>

          <p class="pl-2 border-l-2 border-stone-200">
            पटेल जी के मान-सम्मान-स्वाभिमान के निरन्तर-उच्चीकरण हेतु यथाशक्ति समयदान, धनदान, श्रमदान एवं वांछनीय योगदान करते रहेंगे।
          </p>

          <!-- Grand Slogan Finale -->
          <div class="text-center pt-6 border-t-2 border-amber-200">
            <div class="inline-block px-8 py-3 bg-gradient-to-r from-amber-800 via-amber-700 to-amber-800 text-amber-100 rounded-2xl shadow-lg border border-amber-400">
              <span class="font-serif text-2xl sm:text-3xl font-extrabold tracking-wide block">
                जय हिंद, जय पटेल
              </span>
            </div>
          </div>
        </div>

        <!-- Interactive Action Toolbar inside Scroll -->
        <div class="mt-10 pt-6 border-t border-stone-200 flex flex-wrap items-center justify-between gap-4">
          <button 
            id="takePledgeBtn"
            onclick="takeDigitalPledge()" 
            class="inline-flex items-center gap-2 px-6 py-3 rounded-xl text-sm font-bold shadow-md transition-all transform hover:scale-[1.02]"
            style="background-color: #047857 !important; color: #ffffff !important;"
          >
            <span class="material-symbols-outlined text-[20px]" style="color: #ffffff !important;">how_to_reg</span>
            <span id="pledgeBtnLabel" style="color: #ffffff !important;">मैं यह संकल्प लेता / लेती हूँ</span>
          </button>

          <div class="flex items-center gap-2">
            <button 
              onclick="copyPledgeText()" 
              class="inline-flex items-center gap-1.5 px-4 py-2.5 rounded-xl bg-stone-100 hover:bg-stone-200 text-stone-800 text-xs font-bold transition-colors border border-stone-300"
              style="background-color: #f5f5f4 !important; color: #1c1917 !important;"
            >
              <span class="material-symbols-outlined text-[16px]">content_copy</span>
              <span>संकल्प कॉपी करें</span>
            </button>
            <button 
              onclick="sharePledgeWhatsApp()" 
              class="inline-flex items-center gap-1.5 px-4 py-2.5 rounded-xl text-xs font-bold transition-colors shadow-sm"
              style="background-color: #16a34a !important; color: #ffffff !important;"
            >
              <i class="fa-brands fa-whatsapp text-sm" style="color: #ffffff !important;"></i>
              <span style="color: #ffffff !important;">WhatsApp पर भेजें</span>
            </button>
          </div>
        </div>

        <!-- Digital Pledge Confirmation Banner (Hidden by default) -->
        <div id="pledgeSuccessCard" class="hidden mt-6 p-4 bg-emerald-50 border border-emerald-300 rounded-2xl text-emerald-900 text-center animate-fadeIn">
          <div class="flex items-center justify-center gap-2 font-bold text-sm">
            <span class="material-symbols-outlined text-emerald-600 text-xl">verified</span>
            <span>हार्दिक बधाई! आपने सरदार पटेल समाजोत्थान ट्रस्ट का पावन संकल्प स्वीकार कर लिया है।</span>
          </div>
          <p class="text-xs text-emerald-800 mt-1">
            आइए अपने परिवार एवं समाज में 31 अक्तूबर को "पाँच-दीप" प्रज्वलित कर दीपोत्सव मनाएं व सरदार पटेल के विचारों का प्रचार करें।
          </p>
        </div>

      </div>

    </div>
  </section>

  <!-- ========================================================================= -->
  <!-- SECTION 3: परिचय एवं वैचारिकी (IDEOLOGY & 6 CORE PILLARS)                  -->
  <!-- ========================================================================= -->
  <section id="patel-ideology" class="w-full py-16 md:py-24 bg-white border-b border-[#e8ded1] scroll-mt-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      
      <!-- Section Header -->
      <div class="text-center max-w-3xl mx-auto mb-12">
        <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-stone-100 text-stone-800 text-xs md:text-sm font-bold tracking-wider uppercase mb-3 border border-stone-300">
          <span class="material-symbols-outlined text-[16px] text-amber-700">psychology</span>
          <span>सरदार पटेल समाजोत्थान ट्रस्ट</span>
        </div>
        <h2 class="font-serif text-3xl sm:text-4xl text-stone-900 font-extrabold tracking-tight flex items-center justify-center gap-2">
          <span class="material-symbols-outlined text-amber-700 text-3xl sm:text-4xl" style="font-variation-settings: 'FILL' 1;">psychology</span>
          <span>परिचय एवं वैचारिकी</span>
        </h2>
        <div class="w-24 h-1 bg-gradient-to-r from-amber-600 to-amber-400 mx-auto mt-4 mb-4 rounded-full"></div>
        <p class="text-stone-700 text-base leading-relaxed">
          संगठन की दार्शनिक आधारशिला, अराजनैतिक स्वरूप, दीपोत्सव पर्व एवं विश्व में प्रथम "पटेल आरती" का प्रामाणिक विधान।
        </p>
      </div>

      <!-- Interactive Tabbed Principle Showcase (Solves Uneven Height & Highlights Each Principle) -->
      <div class="bg-[#fcfaf7] rounded-3xl p-6 sm:p-8 md:p-10 border border-stone-200 shadow-sm mb-12">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
          
          <!-- Left: 6 Principle Selectors / Pills -->
          <div class="lg:col-span-5 flex flex-col space-y-2.5">
            <span class="text-xs font-bold uppercase tracking-wider text-amber-900 mb-1 flex items-center gap-1.5">
              <span class="material-symbols-outlined text-[16px] text-amber-700">touch_app</span>
              <span>वैचारिकी के 6 आधार स्तंभ (क्लिक करके पढ़ें)</span>
            </span>

            <?php foreach ($ideologyPoints as $idx => $item): ?>
              <button 
                type="button"
                onclick="selectIdeologyTab(<?= $idx ?>)" 
                id="ideologyTabBtn-<?= $idx ?>"
                class="ideology-tab-btn w-full text-left p-3.5 rounded-2xl border transition-all duration-200 flex items-center gap-3.5 <?= $idx === 0 ? 'bg-amber-900 text-white border-amber-950 shadow-md ring-2 ring-amber-700/30' : 'bg-white text-stone-800 border-stone-200 hover:border-amber-300 hover:bg-amber-50/50' ?>"
              >
                <!-- Number Badge -->
                <span class="tab-num-badge w-8 h-8 rounded-xl flex items-center justify-center font-serif font-bold text-sm shrink-0 transition-colors <?= $idx === 0 ? 'bg-amber-800 text-amber-200' : 'bg-stone-100 text-stone-700' ?>">
                  <?= $item['num'] ?>
                </span>

                <!-- Text Info -->
                <div class="flex-1 min-w-0">
                  <div class="flex items-center gap-2">
                    <span class="tab-badge-text text-[10px] uppercase font-bold tracking-wider px-2 py-0.5 rounded transition-colors <?= $idx === 0 ? 'bg-amber-800/80 text-amber-200' : 'bg-amber-100 text-amber-900' ?>">
                      <?= e($item['badge']) ?>
                    </span>
                  </div>
                  <h4 class="tab-title-text font-serif text-sm font-bold truncate mt-1 transition-colors <?= $idx === 0 ? 'text-white' : 'text-stone-900' ?>">
                    <?= e($item['title']) ?>
                  </h4>
                </div>

                <span class="tab-arrow-icon material-symbols-outlined text-[18px] transition-transform <?= $idx === 0 ? 'text-amber-300 translate-x-1' : 'text-stone-400' ?>">
                  chevron_right
                </span>
              </button>
            <?php endforeach; ?>
          </div>

          <!-- Right: Spotlight Display Panel (Active Principle) -->
          <div class="lg:col-span-7">
            <div id="ideologySpotlightCard" class="bg-white rounded-3xl p-6 sm:p-8 border-2 border-amber-200 shadow-md flex flex-col min-h-[380px] justify-between relative overflow-hidden transition-all duration-300 scroll-mt-24">
              <!-- Decorative Ambient Accent -->
              <div class="absolute -right-12 -bottom-12 w-48 h-48 rounded-full bg-amber-500/10 blur-2xl pointer-events-none"></div>

              <div>
                <!-- Top Meta Bar -->
                <div class="flex items-center justify-between gap-3 border-b border-stone-100 pb-4 mb-5">
                  <div class="flex items-center gap-2.5">
                    <div id="spotlightIconBox" class="w-12 h-12 rounded-2xl bg-amber-100 text-amber-900 flex items-center justify-center font-bold shadow-inner">
                      <span id="spotlightIcon" class="material-symbols-outlined text-2xl"><?= e($ideologyPoints[0]['icon']) ?></span>
                    </div>
                    <div>
                      <span id="spotlightBadge" class="text-xs font-bold text-amber-800 bg-amber-50 px-2.5 py-0.5 rounded-full border border-amber-200">
                        <?= e($ideologyPoints[0]['badge']) ?>
                      </span>
                      <span class="text-xs text-stone-500 ml-2 font-medium">बिंदु संख्या: <strong id="spotlightNum" class="text-stone-800 font-serif">1</strong></span>
                    </div>
                  </div>

                  <!-- Share / Copy Micro button -->
                  <button onclick="copyCurrentIdeologyText()" class="inline-flex items-center gap-1 text-xs text-stone-500 hover:text-amber-800 font-semibold p-2 rounded-lg hover:bg-stone-50 transition-colors" title="यह बिंदु कॉपी करें">
                    <span class="material-symbols-outlined text-[16px]">content_copy</span>
                    <span class="hidden sm:inline">कॉपी</span>
                  </button>
                </div>

                <!-- Spotlight Title -->
                <h3 id="spotlightTitle" class="font-serif text-2xl sm:text-2xl font-bold text-stone-900 leading-snug mb-4">
                  <?= e($ideologyPoints[0]['title']) ?>
                </h3>

                <!-- Spotlight Verbatim Description -->
                <div id="spotlightText" class="font-sans text-stone-700 text-base leading-relaxed mb-6 space-y-3">
                  <?= nl2br(e($ideologyPoints[0]['text'])) ?>
                </div>
              </div>

              <!-- Spotlight Footer Callout Box -->
              <div class="mt-4 pt-4 border-t border-stone-100">
                <div class="p-4 bg-amber-50/80 rounded-2xl border border-amber-200/80 flex items-start gap-3">
                  <span class="material-symbols-outlined text-amber-700 text-xl shrink-0 mt-0.5" style="font-variation-settings: 'FILL' 1;">lightbulb</span>
                  <div>
                    <span class="text-xs font-bold uppercase tracking-wider text-amber-900 block">मूल वैचारिकी सार:</span>
                    <p id="spotlightHighlight" class="text-xs sm:text-sm text-stone-800 font-semibold mt-0.5 leading-snug">
                      <?= e($ideologyPoints[0]['highlight']) ?>
                    </p>
                  </div>
                </div>

                <!-- Navigation Controls -->
                <div class="flex items-center justify-between mt-4 text-xs text-stone-500">
                  <button type="button" onclick="prevIdeologyTab()" class="inline-flex items-center gap-1 hover:text-stone-900 font-bold p-1">
                    <span class="material-symbols-outlined text-[16px]">arrow_back</span>
                    <span>पिछला बिंदु</span>
                  </button>
                  <span id="spotlightProgress" class="font-serif font-bold text-stone-700">1 / 6</span>
                  <button type="button" onclick="nextIdeologyTab()" class="inline-flex items-center gap-1 hover:text-stone-900 font-bold p-1">
                    <span>अगला बिंदु</span>
                    <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
                  </button>
                </div>
              </div>

            </div>
          </div>

        </div>
      </div>

      <!-- Collapsible / Full View: All 6 Principles in Balanced Vertical Grid Cards -->
      <div class="mb-14">
        <div class="flex items-center justify-between mb-6 pb-2 border-b border-stone-200">
          <h3 class="font-serif text-xl font-bold text-stone-900 flex items-center gap-2">
            <span class="material-symbols-outlined text-amber-700 text-xl">view_agenda</span>
            <span>समस्त 6 वैचारिकी बिंदु (विस्तृत प्रारूप)</span>
          </h3>
          <span class="text-xs text-stone-500">स्वाभाविक प्रवाह प्रारूप</span>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          <?php foreach ($ideologyPoints as $item): ?>
            <article class="bg-[#fcfaf7] rounded-2xl p-6 border border-stone-200 shadow-sm hover:border-amber-300 transition-all flex flex-col">
              <!-- Top Row -->
              <div class="flex items-center justify-between mb-3">
                <span class="inline-flex items-center gap-1 bg-amber-100 text-amber-900 text-xs font-bold px-3 py-1 rounded-full border border-amber-200">
                  <span class="material-symbols-outlined text-[14px]"><?= e($item['icon']) ?></span>
                  <span><?= e($item['badge']) ?></span>
                </span>
                <span class="w-7 h-7 rounded-full bg-stone-200 text-stone-700 font-serif font-bold text-xs flex items-center justify-center">
                  <?= $item['num'] ?>
                </span>
              </div>

              <!-- Title -->
              <h4 class="font-serif text-lg font-bold text-stone-900 leading-snug mb-3">
                <?= e($item['title']) ?>
              </h4>

              <!-- Text Content (Natural auto height) -->
              <p class="text-stone-700 text-sm leading-relaxed mb-4 flex-1">
                <?= nl2br(e($item['text'])) ?>
              </p>

              <!-- Attached Essence Callout -->
              <div class="pt-3 border-t border-stone-200 bg-white p-3 rounded-xl border border-stone-100 mt-auto">
                <span class="text-[11px] font-bold text-amber-900 uppercase tracking-wide flex items-center gap-1 mb-0.5">
                  <span class="material-symbols-outlined text-[13px] text-amber-700">lightbulb</span>
                  मूल सार:
                </span>
                <p class="text-xs text-stone-700 font-medium leading-normal">
                  <?= e($item['highlight']) ?>
                </p>
              </div>
            </article>
          <?php endforeach; ?>
        </div>
      </div>

      <!-- Special Highlight Box: 31st October Deepotsav Guide -->
      <div class="deepotsav-card rounded-3xl p-8 md:p-10 shadow-xl border border-amber-500/30 relative overflow-hidden" style="background: linear-gradient(135deg, #78350f 0%, #451a03 50%, #1c1917 100%) !important; color: #ffffff !important;">
        <div class="absolute -right-16 -bottom-16 w-64 h-64 rounded-full bg-amber-500/20 blur-2xl pointer-events-none"></div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center relative z-10">
          <div class="lg:col-span-8">
            <div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full text-xs font-bold uppercase tracking-wider mb-3 border border-amber-400/40" style="background-color: rgba(245, 158, 11, 0.2) !important; color: #fde68a !important;">
              <span class="material-symbols-outlined text-[16px]" style="color: #fde68a !important;">flare</span>
              <span class="badge-gold" style="color: #fde68a !important;">31 अक्तूबर • राष्ट्रीय दीपोत्सव आह्वान</span>
            </div>
            <h3 class="font-serif text-2xl sm:text-3xl font-bold leading-tight mb-3" style="color: #ffffff !important;">
              प्रतिवर्ष 31 अक्टूबर को घर-घर "पाँच-दीप" प्रज्वलन एवं संस्मरण चर्चा
            </h3>
            <p class="desc-text text-sm md:text-base leading-relaxed mb-4" style="color: #fef3c7 !important; font-size: 15px !important; line-height: 1.7 !important;">
              हम सबके गौरव, भारत रत्न सरदार वल्लभ भाई पटेल जी की जयंती पर प्रत्येक घर में पूड़ी-पकवान बनवाएं, शाम को कम से कम <strong style="color: #ffffff !important; text-decoration: underline;">"पाँच-दीप"</strong> जलाकर दीपोत्सव मनाएं, चित्र पर पुष्पांजलि अर्पित करें, ट्रस्ट का संकल्प दोहराएं तथा प्रेरणास्पद संस्मरणों पर चर्चा करें।
            </p>
            <div class="steps-gold flex flex-wrap items-center gap-4 text-xs font-semibold" style="color: #fde68a !important;">
              <span class="flex items-center gap-1.5" style="color: #fde68a !important;"><span class="w-2.5 h-2.5 rounded-full bg-amber-400 inline-block"></span> 1. पूड़ी-पकवान निर्माण</span>
              <span class="flex items-center gap-1.5" style="color: #fde68a !important;"><span class="w-2.5 h-2.5 rounded-full bg-amber-400 inline-block"></span> 2. पाँच-दीप दीपोत्सव</span>
              <span class="flex items-center gap-1.5" style="color: #fde68a !important;"><span class="w-2.5 h-2.5 rounded-full bg-amber-400 inline-block"></span> 3. पुष्पांजलि व आरती</span>
              <span class="flex items-center gap-1.5" style="color: #fde68a !important;"><span class="w-2.5 h-2.5 rounded-full bg-amber-400 inline-block"></span> 4. संकल्प व संस्मरण</span>
            </div>
          </div>

          <div class="lg:col-span-4 flex justify-center">
            <div class="p-6 rounded-2xl border border-white/20 text-center w-full max-w-xs shadow-lg" style="background-color: rgba(255, 255, 255, 0.12) !important; backdrop-filter: blur(8px);">
              <span class="material-symbols-outlined text-5xl mb-2" style="color: #fbbf24 !important;">hotel_class</span>
              <h4 class="font-serif text-lg font-bold" style="color: #ffffff !important;">20-दिवसीय चेतना रथ</h4>
              <p class="sub-card-text text-xs mt-1.5 leading-relaxed" style="color: #fef3c7 !important;">
                उत्तर प्रदेश के जनपद बाराबंकी व विभिन्न अंचलों में प्रतिवर्ष अनवरत 20 दिन गतिशील पटेल चेतना रथ एवं सामूहिक आरती।
              </p>
              <a href="#patel-sankalp" class="btn-gold-action inline-block mt-4 w-full py-2.5 font-bold text-xs rounded-xl transition-colors shadow-md" style="background-color: #f59e0b !important; color: #1c1917 !important;">
                <span style="color: #1c1917 !important; font-weight: 700;">संकल्प दोहराएं</span>
              </a>
            </div>
          </div>
        </div>
      </div>

    </div>
  </section>

  <!-- ========================================================================= -->
  <!-- SECTION 4: संस्थापक एवं ट्रस्टी गण (FOUNDERS & TRUSTEES)                   -->
  <!-- ========================================================================= -->
  <section id="patel-trustees" class="w-full py-16 md:py-24 bg-[#fbf8f3] border-b border-[#e8ded1] scroll-mt-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      
      <!-- Section Header -->
      <div class="text-center max-w-3xl mx-auto mb-14">
        <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-amber-100 text-amber-950 text-xs md:text-sm font-bold tracking-wider uppercase mb-3 border border-amber-300">
          <span class="material-symbols-outlined text-[16px] text-amber-700">badge</span>
          <span>सरदार पटेल समाजोत्थान ट्रस्ट</span>
        </div>
        <h2 class="font-serif text-3xl sm:text-4xl text-stone-900 font-extrabold tracking-tight flex items-center justify-center gap-2">
          <span class="material-symbols-outlined text-amber-700 text-3xl sm:text-4xl" style="font-variation-settings: 'FILL' 1;">groups</span>
          <span>संस्थापक एवं ट्रस्टी गण</span>
        </h2>
        <div class="w-24 h-1 bg-gradient-to-r from-amber-600 to-amber-400 mx-auto mt-4 mb-4 rounded-full"></div>
        <p class="text-stone-700 text-base leading-relaxed">
          ट्रस्ट के मार्गदर्शक, संस्थापक पदाधिकारी एवं कार्यसमिति सदस्य जो समाजोत्थान के इस पुनीत महा-अभियान का नेतृत्व कर रहे हैं।
        </p>
      </div>

      <!-- Trustees 6 Cards Grid -->
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        <?php foreach ($trustees as $t): ?>
          <div class="bg-white rounded-2xl p-6 border border-stone-200 shadow-sm hover:shadow-md transition-all duration-300 flex items-start gap-4 group hover:border-amber-400">
            <!-- Icon / Avatar Badge -->
            <div class="w-14 h-14 rounded-2xl bg-amber-100 text-amber-800 flex items-center justify-center font-bold text-xl shrink-0 group-hover:bg-amber-700 group-hover:text-white transition-colors shadow-inner">
              <span class="material-symbols-outlined text-2xl"><?= e($t['icon']) ?></span>
            </div>

            <!-- Details -->
            <div class="flex-1 min-w-0">
              <div class="flex items-center justify-between gap-2">
                <span class="text-[11px] font-bold text-amber-800 bg-amber-50 px-2 py-0.5 rounded border border-amber-200">
                  <?= $t['id'] ?> • <?= e($t['badge']) ?>
                </span>
              </div>
              <h3 class="font-serif text-xl font-bold text-stone-900 leading-tight mt-1.5 truncate">
                <?= e($t['name']) ?>
              </h3>
              <p class="text-xs sm:text-sm font-semibold text-amber-900 mt-1 leading-snug">
                <?= e($t['designation']) ?>
              </p>
              <p class="text-[11px] text-stone-500 mt-0.5 font-medium">
                <?= e($t['role']) ?>
              </p>
            </div>
          </div>
        <?php endforeach; ?>
      </div>

      <!-- Trust Registration & Working Area Note -->
      <div class="mt-12 p-6 bg-white rounded-2xl border border-stone-200 shadow-sm text-center max-w-3xl mx-auto">
        <div class="flex items-center justify-center gap-2 text-stone-800 font-bold text-sm mb-1">
          <span class="material-symbols-outlined text-amber-700 text-lg">shield</span>
          <span>सरदार पटेल समाजोत्थान ट्रस्ट — पंजीकृत एवं अधिकृत निकाय</span>
        </div>
        <p class="text-xs text-stone-600 leading-relaxed">
          मुख्यालय: जनपद बाराबंकी, उत्तर प्रदेश • कार्यक्षेत्र: उत्तर प्रदेश एवं सम्पूर्ण भारतवर्ष। समस्त पटेल अनुयायियों एवं राष्ट्र-निर्माताओं के स्वाभिमान व उत्थान को समर्पित।
        </p>
      </div>

    </div>
  </section>

  <!-- ========================================================================= -->
  <!-- SECTION 5: HOW TO PARTICIPATE (समयदान, धनदान, श्रमदान)                    -->
  <!-- ========================================================================= -->
  <section id="patel-participate" class="w-full py-16 md:py-24 bg-white border-b border-[#e8ded1]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      
      <div class="text-center max-w-3xl mx-auto mb-14">
        <span class="text-xs font-bold uppercase tracking-widest text-amber-800 bg-amber-100 px-3.5 py-1 rounded-full border border-amber-200">
          सहभागिता के तीन मार्ग
        </span>
        <h2 class="font-serif text-3xl sm:text-4xl text-stone-900 font-extrabold mt-3">
          सरदार पटेल अभियान में आपका योगदान
        </h2>
        <p class="text-stone-600 text-sm mt-2">
          "पटेल-मान-सम्मान-स्वाभिमान के निरन्तर-उच्चीकरण हेतु स्वैच्छिक आधार पर समयदान, धन-दान, श्रमदान एवं वांछनीय योगदान करें।"
        </p>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <!-- Stream 1: समयदान -->
        <div class="bg-[#fcfaf7] rounded-3xl p-7 border border-stone-200 shadow-sm flex flex-col justify-between hover:border-amber-400 transition-colors">
          <div>
            <div class="w-12 h-12 rounded-xl bg-amber-100 text-amber-800 flex items-center justify-center mb-4">
              <span class="material-symbols-outlined text-2xl">schedule</span>
            </div>
            <h3 class="font-serif text-xl font-bold text-stone-900 mb-2">1. समयदान</h3>
            <p class="text-stone-700 text-sm leading-relaxed mb-4">
              प्रति सप्ताह या प्रति माह कुछ घंटे समाज के युवाओं को शिक्षित करने, जागरूकता संगोष्ठियों के आयोजन एवं 31 अक्तूबर दीपोत्सव अभियान के प्रचार हेतु समर्पित करें।
            </p>
          </div>
          <a href="<?= e(base_url('/volunteer')) ?>" class="stream-btn-1 inline-flex items-center justify-center gap-1.5 w-full py-2.5 rounded-xl text-xs font-bold transition-colors shadow-sm" style="background-color: #b45309 !important; color: #ffffff !important;">
            <span style="color: #ffffff !important;">समयदानी स्वयंसेवक बनें</span>
            <span class="material-symbols-outlined text-[16px]" style="color: #ffffff !important;">arrow_forward</span>
          </a>
        </div>

        <!-- Stream 2: श्रमदान -->
        <div class="bg-[#fcfaf7] rounded-3xl p-7 border border-stone-200 shadow-sm flex flex-col justify-between hover:border-amber-400 transition-colors">
          <div>
            <div class="w-12 h-12 rounded-xl bg-emerald-100 text-emerald-800 flex items-center justify-center mb-4">
              <span class="material-symbols-outlined text-2xl">handyman</span>
            </div>
            <h3 class="font-serif text-xl font-bold text-stone-900 mb-2">2. श्रमदान</h3>
            <p class="text-stone-700 text-sm leading-relaxed mb-4">
              20-दिवसीय पटेल चेतना रथ यात्रा, सामाजिक आयोजनों, पौधरोपण, चिकित्सा शिविरों एवं अशक्त-असहाय जनों की प्रत्यक्ष सेवा में अपना सक्रिय शारीरिक योगदान दें।
            </p>
          </div>
          <a href="<?= e(base_url('/volunteer')) ?>" class="stream-btn-2 inline-flex items-center justify-center gap-1.5 w-full py-2.5 rounded-xl text-xs font-bold transition-colors shadow-sm" style="background-color: #1c1917 !important; color: #ffffff !important;">
            <span style="color: #ffffff !important;">श्रमदान दल से जुड़ें</span>
            <span class="material-symbols-outlined text-[16px]" style="color: #ffffff !important;">arrow_forward</span>
          </a>
        </div>

        <!-- Stream 3: धनदान व सहयोग -->
        <div class="bg-[#fcfaf7] rounded-3xl p-7 border border-stone-200 shadow-sm flex flex-col justify-between hover:border-amber-400 transition-colors">
          <div>
            <div class="w-12 h-12 rounded-xl bg-blue-100 text-blue-800 flex items-center justify-center mb-4">
              <span class="material-symbols-outlined text-2xl">volunteer_activism</span>
            </div>
            <h3 class="font-serif text-xl font-bold text-stone-900 mb-2">3. धनदान व सहयोग</h3>
            <p class="text-stone-700 text-sm leading-relaxed mb-4">
              साहित्य प्रकाशन, पत्र-पत्रिका विशेषांक, छात्र-छात्राओं हेतु प्रेरणा-वृत्ति (छात्रवृत्ति), निर्बल परिवारों की सहायता एवं शोध केन्द्रों के निर्माण हेतु स्वैच्छिक आर्थिक सहयोग करें।
            </p>
          </div>
          <a href="<?= e(base_url('/donation')) ?>" class="stream-btn-3 inline-flex items-center justify-center gap-1.5 w-full py-2.5 rounded-xl text-xs font-bold transition-colors shadow-sm" style="background-color: #78350f !important; color: #ffffff !important;">
            <span style="color: #ffffff !important;">सहयोग राशि दान करें</span>
            <span class="material-symbols-outlined text-[16px]" style="color: #ffffff !important;">arrow_forward</span>
          </a>
        </div>
      </div>

    </div>
  </section>

  <!-- ========================================================================= -->
  <!-- SECTION 6: FAQ & TRUST INQUIRIES                                          -->
  <!-- ========================================================================= -->
  <section class="w-full py-14 bg-[#fbf8f3] border-b border-[#e8ded1]">
    <div class="max-w-4xl mx-auto px-4 sm:px-6">
      <div class="text-center mb-10">
        <h3 class="font-serif text-2xl font-bold text-stone-900">
          अक्सर पूछे जाने वाले प्रश्न (FAQs)
        </h3>
        <p class="text-xs sm:text-sm text-stone-600 mt-1">
          सरदार पटेल समाजोत्थान ट्रस्ट एवं अभियान संबंधी प्रमुख जिज्ञासाएं
        </p>
      </div>

      <div class="space-y-4">
        <!-- Q1 -->
        <details class="bg-white rounded-2xl p-5 border border-stone-200 shadow-sm group">
          <summary class="font-serif text-base font-bold text-stone-900 cursor-pointer flex items-center justify-between select-none">
            <span>1. क्या सरदार पटेल समाजोत्थान ट्रस्ट किसी राजनीतिक दल से जुड़ा है?</span>
            <span class="material-symbols-outlined text-stone-400 group-open:rotate-180 transition-transform">expand_more</span>
          </summary>
          <div class="text-sm text-stone-700 mt-3 pt-3 border-t border-stone-100 leading-relaxed">
            नहीं। यह संगठन पूर्णतया अराजनैतिक है। यह कभी भी किसी राजनैतिक दल अथवा राजनेता का न समर्थन करेगा न विरोध करेगा। यह केवल पटेल अनुयायियों व भावी पीढ़ी की समस्त उन्नति एवं राष्ट्रीय एकता को समर्पित है।
          </div>
        </details>

        <!-- Q2 -->
        <details class="bg-white rounded-2xl p-5 border border-stone-200 shadow-sm group">
          <summary class="font-serif text-base font-bold text-stone-900 cursor-pointer flex items-center justify-between select-none">
            <span>2. 31 अक्टूबर को क्या विशेष कार्यक्रम आयोजित किए जाते हैं?</span>
            <span class="material-symbols-outlined text-stone-400 group-open:rotate-180 transition-transform">expand_more</span>
          </summary>
          <div class="text-sm text-stone-700 mt-3 pt-3 border-t border-stone-100 leading-relaxed">
            31 अक्टूबर को सरदार पटेल जयंती पर घर-घर पूड़ी-पकवान बनवाए जाते हैं, शाम को कम से कम "पाँच-दीप" जलाकर दीपोत्सव मनाया जाता है, पटेल जी के चित्र पर पुष्पांजलि अर्पित की जाती है, ट्रस्ट का संकल्प दुहराया जाता है और उनके जीवन के प्रेरणास्पद संस्मरणों पर गोष्ठी होती है।
          </div>
        </details>

        <!-- Q3 -->
        <details class="bg-white rounded-2xl p-5 border border-stone-200 shadow-sm group">
          <summary class="font-serif text-base font-bold text-stone-900 cursor-pointer flex items-center justify-between select-none">
            <span>3. पटेल आरती का क्या विधान है और यह कब शुरू हुई?</span>
            <span class="material-symbols-outlined text-stone-400 group-open:rotate-180 transition-transform">expand_more</span>
          </summary>
          <div class="text-sm text-stone-700 mt-3 pt-3 border-t border-stone-100 leading-relaxed">
            सरदार पटेल समाजोत्थान ट्रस्ट द्वारा पटेल जी को देवता या ईश्वर न मानकर बल्कि 'महामानव महापुरुष' मानकर श्री वल्लभ पटेल की आरती का विधान विश्व में पहली बार बाराबंकी (उ.प्र.) में सजाया और संवारा गया है। प्रतिवर्ष 20-दिवसीय पटेल चेतना रथ यात्रा के दौरान सामूहिक आरती की जाती है।
          </div>
        </details>

        <!-- Q4 -->
        <details class="bg-white rounded-2xl p-5 border border-stone-200 shadow-sm group">
          <summary class="font-serif text-base font-bold text-stone-900 cursor-pointer flex items-center justify-between select-none">
            <span>4. ट्रस्ट की सदस्यता अथवा सहयोग कैसे प्राप्त करें?</span>
            <span class="material-symbols-outlined text-stone-400 group-open:rotate-180 transition-transform">expand_more</span>
          </summary>
          <div class="text-sm text-stone-700 mt-3 pt-3 border-t border-stone-100 leading-relaxed">
            आप वेबसाइट के माध्यम से स्वयंसेवक पंजीकरण भर सकते हैं या संस्थापक सचिव प्रदीप सारंग जी से <strong><?= e($phone) ?></strong> अथवा <strong><?= e($email) ?></strong> पर संपर्क कर सकते हैं।
          </div>
        </details>
      </div>

    </div>
  </section>

  <!-- ========================================================================= -->
  <!-- SECTION 7: FINAL CALL TO ACTION                                           -->
  <!-- ========================================================================= -->
  <section class="w-full bg-gradient-to-b from-[#fbf4eb] to-[#f4e8d8] py-14 border-b border-[#e2d5c3]">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 text-center">
      <div class="w-16 h-16 rounded-full bg-amber-800 text-white flex items-center justify-center mx-auto mb-4 shadow-lg">
        <span class="material-symbols-outlined text-3xl">flag</span>
      </div>
      <h2 class="font-serif text-2xl sm:text-3xl font-extrabold text-stone-900 leading-tight">
        "एकता ही हमारी शक्ति है, स्वाभिमान ही हमारा जीवन है"
      </h2>
      <p class="text-stone-700 text-sm sm:text-base mt-2 max-w-2xl mx-auto">
        आइए सरदार पटेल समाजोत्थान ट्रस्ट के साथ जुड़कर एक सुशिक्षित, संस्कारित, आत्मनिर्भर एवं अखंड भारत के निर्माण में अपना अमूल्य योगदान दें।
      </p>

      <div class="flex flex-wrap items-center justify-center gap-4 mt-6">
        <a href="<?= e(base_url('/volunteer')) ?>" class="patel-cta-btn-1 inline-flex items-center gap-2 px-6 py-3.5 rounded-xl text-sm font-bold shadow-md transition-all transform hover:-translate-y-0.5" style="background-color: #9a3412 !important; color: #ffffff !important; text-decoration: none;">
          <span class="material-symbols-outlined text-[19px]" style="color: #ffffff !important;">how_to_reg</span>
          <span style="color: #ffffff !important; font-weight: 700;">सदस्यता / स्वयंसेवक पंजीकरण</span>
        </a>
        <a href="https://wa.me/<?= e($phoneClean) ?>?text=<?= urlencode('नमस्ते, मैं सरदार पटेल समाजोत्थान ट्रस्ट और सरदार पटेल अभियान से जुड़ना चाहता/चाहती हूँ।') ?>" target="_blank" rel="noopener noreferrer" class="patel-cta-btn-2 inline-flex items-center gap-2 px-6 py-3.5 rounded-xl text-sm font-bold shadow-md transition-all transform hover:-translate-y-0.5" style="background-color: #15803d !important; color: #ffffff !important; text-decoration: none;">
          <i class="fa-brands fa-whatsapp text-base" style="color: #ffffff !important;"></i>
          <span style="color: #ffffff !important; font-weight: 700;">WhatsApp पर संपर्क करें</span>
        </a>
      </div>
    </div>
  </section>

</div>

<!-- Interactive Client-side Script for Filtering, Copying, and Digital Pledge -->
<script>
function filterObjectives() {
  const query = (document.getElementById('objectiveSearchInput').value || '').toLowerCase().trim();
  const cards = document.querySelectorAll('.objective-card');
  const clearBtn = document.getElementById('clearObjectiveSearch');
  const noResults = document.getElementById('noObjectiveResults');
  let visibleCount = 0;

  if (clearBtn) {
    clearBtn.classList.toggle('hidden', query.length === 0);
  }

  cards.forEach(card => {
    const text = card.getAttribute('data-text') || '';
    if (!query || text.includes(query)) {
      card.classList.remove('hidden');
      visibleCount++;
    } else {
      card.classList.add('hidden');
    }
  });

  if (noResults) {
    noResults.classList.toggle('hidden', visibleCount > 0);
  }
}

function clearObjectiveSearchBox() {
  const input = document.getElementById('objectiveSearchInput');
  if (input) {
    input.value = '';
    filterObjectives();
    input.focus();
  }
}

function copyObjectiveText(id) {
  const objectives = <?= json_encode($objectives, JSON_UNESCAPED_UNICODE) ?>;
  const target = objectives.find(o => o.id === id);
  if (!target) return;

  const textToCopy = `उद्देश्य ${target.id}: ${target.title}\n\n${target.desc}\n\n— सरदार पटेल समाजोत्थान ट्रस्ट (प्रदीप सारंग, सचिव)`;
  navigator.clipboard.writeText(textToCopy).then(() => {
    showToastNotification('उद्देश्य ' + id + ' कॉपी कर लिया गया!');
  }).catch(() => {
    prompt('कृपया इसे कॉपी करें:', textToCopy);
  });
}

function copyAllObjectives() {
  const objectives = <?= json_encode($objectives, JSON_UNESCAPED_UNICODE) ?>;
  let fullText = "सरदार पटेल समाजोत्थान ट्रस्ट — 12 आधारभूत उद्देश्य\n====================================\n\n";
  objectives.forEach(o => {
    fullText += `${o.id}- ${o.desc}\n\n`;
  });
  fullText += "(प्रदीप सारंग, सचिव- सरदार पटेल समाजोत्थान ट्रस्ट)\nhttps://pradeepsarang.in/campaigns/sardar-patel-ekta";

  navigator.clipboard.writeText(fullText).then(() => {
    showToastNotification('समस्त 12 उद्देश्य क्लिपबोर्ड पर कॉपी हो गए!');
  }).catch(() => {
    prompt('कृपया इसे कॉपी करें:', fullText);
  });
}

function takeDigitalPledge() {
  const successCard = document.getElementById('pledgeSuccessCard');
  const btnLabel = document.getElementById('pledgeBtnLabel');
  const btn = document.getElementById('takePledgeBtn');

  if (successCard) {
    successCard.classList.remove('hidden');
    successCard.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
  }

  if (btnLabel && btn) {
    btnLabel.textContent = 'संकल्प स्वीकृत (जय हिंद, जय पटेल!)';
    btn.classList.remove('bg-emerald-700', 'hover:bg-emerald-800');
    btn.classList.add('bg-stone-900', 'hover:bg-stone-950');
  }

  showToastNotification('जय हिंद, जय पटेल! आपका संकल्प दर्ज हुआ।');
}

function copyPledgeText() {
  const pledgeText = `सरदार पटेल समाजोत्थान ट्रस्ट — पावन संकल्प
=======================================

1. हमें गर्व है कि हम, अखण्ड भारत के निर्माता भारत रत्न लौह पुरुष सरदार वल्लभ भाई पटेल के अनुयायी हैं, हम भारत की एकता अखण्डता के लिए वह सब करेंगे जो संविधान सम्मत है।

2. पटेल अनुयायियों के शैक्षिक, सामाजिक, आर्थिक, राजनैतिक, व्यावसायिक, साहित्यिक, बौद्धिक, सांस्कृतिक उन्नयन एवं स्व-स्वाभिमान को उच्चतम शिखर तक ले जाने हेतु अनेकानेक जागरूकता गतिविधियों में सम्मिलित होकर, समाज को सामाजिक कुरीतियों से मुक्त बनाने में सामूहिक योगदान करेंगे।

3. भावी पीढ़ी को कर्मठ, ईमानदार, जागरूक, सुशिक्षित, संस्कारित, तर्कशील एवं अंधविश्वास-मुक्त बनाने के लिए तथा वैज्ञानिक दृष्टिकोण अपनाने हेतु अनवरत प्रयास करेंगे।

4. पटेल अनुयायियों के आर्थिक, सामाजिक, राजनैतिक, साहित्यिक एवं सांस्कृतिक पिछड़ेपन के जिम्मेदार कारकों की पहचान कर उन्नयन हेतु समुचित उपाय अपनाएंगे।

5. पृथ्वी और मानव स्वास्थ्य के सम्वर्धन हेतु न सिर्फ सतर्क रहेंगे बल्कि निरन्तर बेहतरी की स्थिति बनाने हेतु वांछित कदम भी उठाएंगे।

6. पटेल जी के मान-सम्मान-स्वाभिमान के निरन्तर-उच्चीकरण हेतु यथाशक्ति समयदान, धनदान, श्रमदान एवं वांछनीय योगदान करते रहेंगे।

जय हिंद, जय पटेल

सरदार पटेल समाजोत्थान ट्रस्ट (प्रदीप सारंग, सचिव)
https://pradeepsarang.in/campaigns/sardar-patel-ekta`;

  navigator.clipboard.writeText(pledgeText).then(() => {
    showToastNotification('संकल्प-पत्र कॉपी कर लिया गया!');
  }).catch(() => {
    prompt('कृपया संकल्प कॉपी करें:', pledgeText);
  });
}

function sharePledgeWhatsApp() {
  const msg = encodeURIComponent(`*सरदार पटेल समाजोत्थान ट्रस्ट — पावन संकल्प*\n\n"हमें गर्व है कि हम, अखण्ड भारत के निर्माता भारत रत्न लौह पुरुष सरदार वल्लभ भाई पटेल के अनुयायी हैं, हम भारत की एकता अखण्डता के लिए वह सब करेंगे जो संविधान सम्मत है।"\n\n31 अक्तूबर को घर-घर मनाएं दीपोत्सव, जलाएं कम से कम पाँच-दीप!\n\nविस्तृत विवरण व 12 उद्देश्य पढ़ें:\nhttps://pradeepsarang.in/campaigns/sardar-patel-ekta`);
  window.open(`https://api.whatsapp.com/send?text=${msg}`, '_blank');
}

function sharePatelPage() {
  if (navigator.share) {
    navigator.share({
      title: 'सरदार पटेल अभियान — सरदार पटेल समाजोत्थान ट्रस्ट',
      text: 'सरदार पटेल समाजोत्थान ट्रस्ट के 12 उद्देश्य, संकल्प व वैचारिकी',
      url: window.location.href,
    }).catch(() => {});
  } else {
    sharePledgeWhatsApp();
  }
}

// Ideology & Principles Interactive Tab Switcher
const ideologyPointsData = <?= json_encode($ideologyPoints, JSON_UNESCAPED_UNICODE) ?>;
let currentIdeologyIdx = 0;

function selectIdeologyTab(idx, shouldScroll = true) {
  if (idx < 0 || idx >= ideologyPointsData.length) return;
  currentIdeologyIdx = idx;
  const item = ideologyPointsData[idx];

  // Update Buttons styling
  document.querySelectorAll('.ideology-tab-btn').forEach((btn, i) => {
    const isSelected = (i === idx);
    btn.className = `ideology-tab-btn w-full text-left p-3.5 rounded-2xl border transition-all duration-200 flex items-center gap-3.5 ${
      isSelected 
        ? 'is-active bg-amber-900 text-white border-amber-950 shadow-md ring-2 ring-amber-700/30' 
        : 'bg-white text-stone-800 border-stone-200 hover:border-amber-300 hover:bg-amber-50/50'
    }`;
    
    const numBadge = btn.querySelector('.tab-num-badge');
    if (numBadge) {
      numBadge.className = `tab-num-badge w-8 h-8 rounded-xl flex items-center justify-center font-serif font-bold text-sm shrink-0 transition-colors ${
        isSelected ? 'bg-amber-800 text-amber-200' : 'bg-stone-100 text-stone-700'
      }`;
    }

    const badgeText = btn.querySelector('.tab-badge-text');
    if (badgeText) {
      badgeText.className = `tab-badge-text text-[10px] uppercase font-bold tracking-wider px-2 py-0.5 rounded transition-colors ${
        isSelected ? 'bg-amber-800/80 text-amber-200' : 'bg-amber-100 text-amber-900'
      }`;
    }

    const titleText = btn.querySelector('.tab-title-text');
    if (titleText) {
      titleText.className = `tab-title-text font-serif text-sm font-bold truncate mt-1 transition-colors ${
        isSelected ? 'text-white' : 'text-stone-900'
      }`;
      titleText.style.color = isSelected ? '#ffffff' : '#1c1917';
    }

    const arrowIcon = btn.querySelector('.tab-arrow-icon');
    if (arrowIcon) {
      arrowIcon.className = `tab-arrow-icon material-symbols-outlined text-[18px] transition-transform ${
        isSelected ? 'text-amber-300 translate-x-1' : 'text-stone-400'
      }`;
    }
  });

  // Update Spotlight Card content
  const spotlightCard = document.getElementById('ideologySpotlightCard');
  if (spotlightCard) {
    spotlightCard.classList.add('opacity-60', 'scale-[0.99]');
    setTimeout(() => {
      document.getElementById('spotlightIcon').textContent = item.icon || 'psychology';
      document.getElementById('spotlightBadge').textContent = item.badge || '';
      document.getElementById('spotlightNum').textContent = item.num;
      document.getElementById('spotlightTitle').textContent = item.title || '';
      document.getElementById('spotlightText').innerHTML = (item.text || '').replace(/\n/g, '<br>');
      document.getElementById('spotlightHighlight').textContent = item.highlight || '';
      document.getElementById('spotlightProgress').textContent = `${idx + 1} / ${ideologyPointsData.length}`;
      
      spotlightCard.classList.remove('opacity-60', 'scale-[0.99]');

      // On mobile view (< 1024px), automatically scroll smoothly to the description card
      if (shouldScroll && window.innerWidth < 1024) {
        const navOffset = 80;
        const cardTop = spotlightCard.getBoundingClientRect().top + window.pageYOffset - navOffset;
        window.scrollTo({
          top: cardTop,
          behavior: 'smooth'
        });
      }
    }, 100);
  }
}

function prevIdeologyTab() {
  const newIdx = (currentIdeologyIdx - 1 + ideologyPointsData.length) % ideologyPointsData.length;
  selectIdeologyTab(newIdx, false);
}

function nextIdeologyTab() {
  const newIdx = (currentIdeologyIdx + 1) % ideologyPointsData.length;
  selectIdeologyTab(newIdx, false);
}

function copyCurrentIdeologyText() {
  const item = ideologyPointsData[currentIdeologyIdx];
  if (!item) return;

  const textToCopy = `सरदार पटेल समाजोत्थान ट्रस्ट — वैचारिकी बिंदु ${item.num}: ${item.title}\n\n${item.text}\n\nमूल सार: ${item.highlight}\n\nhttps://pradeepsarang.in/campaigns/sardar-patel-ekta`;
  navigator.clipboard.writeText(textToCopy).then(() => {
    showToastNotification(`बिंदु ${item.num} कॉपी कर लिया गया!`);
  }).catch(() => {
    prompt('कृपया इसे कॉपी करें:', textToCopy);
  });
}

function showToastNotification(msg) {
  let toast = document.getElementById('patelToastNotification');
  if (!toast) {
    toast = document.createElement('div');
    toast.id = 'patelToastNotification';
    toast.className = 'fixed bottom-6 right-6 bg-stone-900 text-white px-5 py-3 rounded-2xl shadow-2xl text-xs font-bold z-[9999] border border-amber-500/50 flex items-center gap-2 transform transition-all duration-300 translate-y-10 opacity-0 pointer-events-none';
    document.body.appendChild(toast);
  }
  toast.innerHTML = `<span class="material-symbols-outlined text-amber-400 text-base">check_circle</span><span>${msg}</span>`;
  toast.classList.remove('translate-y-10', 'opacity-0', 'pointer-events-none');
  setTimeout(() => {
    toast.classList.add('translate-y-10', 'opacity-0', 'pointer-events-none');
  }, 3000);
}
</script>
