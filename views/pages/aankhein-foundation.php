<?php
declare(strict_types=1);

$campaigns = $campaigns ?? [];
$phone = trim($settings['phone'] ?? '+91 9919007190');
$phoneClean = preg_replace('/[^+0-9]/', '', $phone);
$email = trim($settings['email'] ?? 'contact@pradeepsarang.in');

// Official Foundation Meta & Verbatim Information
$foundationName = "आँखें फाउंडेशन";
$formerName = "आँखें इंडिया";
$regNumber = "BAB / 02650 / 2018-19";
$regDate = "31 जुलाई 2018";
$actName = "सोसायटी रजिस्ट्रेशन एक्ट 1860";
$regAuthority = "उपनिबंधक, फर्म समितियाँ तथा चिट्स, अयोध्या (फैजाबाद) मंडल, उत्तर प्रदेश";
$regOffice = "ग्राम व पोस्ट पाटमऊ, तहसील- नवाबगंज, जिला- बाराबंकी।";
$headOffice = "ग्रीन गैंग रोड, हजाराबाग, बाराबंकी। उत्तर प्रदेश, भारत।";
$founderName = "प्रदीप सारंग";
$founderPhone = "9919007190";

// 4 Rivers of Barabanki + Jamuriya Stream (जम्बू-नद)
$rivers = [
    [
        'id' => 1,
        'name' => 'गोमती नदी',
        'type' => 'गंगा नदी की प्रमुख सहायक नदी',
        'desc' => 'जनपद बाराबंकी की प्रमुख नदी, जो माँ गंगा की मुख्य सहायक नदी है। आँखें फाउंडेशन द्वारा इसके तटवर्ती क्षेत्रों में अविरल प्रवाह, जलीय जैव-विविधता व पर्यावरण संरक्षण की अलख जगाई जाती है।',
        'badge' => 'सहायक नदी (गंगा)',
        'icon' => 'water',
        'tag' => 'पवित्र सहायक नदी'
    ],
    [
        'id' => 2,
        'name' => 'घाघरा नदी (सरयू)',
        'type' => 'गंगा नदी की प्रमुख सहायक नदी',
        'desc' => 'बाराबंकी की उत्तरी सीमा पर बहने वाली विशाल एवं ऐतिहासिक नदी। इसके कछारों और तटवर्ती समुदायों में बाढ़ सुरक्षा, मृदा संरक्षण एवं वन संवर्धन हेतु जनजागरण अभियान संचालित हैं।',
        'badge' => 'सहायक नदी (गंगा)',
        'icon' => 'waves',
        'tag' => 'विशाल प्राकृतिक जलधारा'
    ],
    [
        'id' => 3,
        'name' => 'रेठ नदी',
        'type' => 'गंगा नदी की उप-नदी (Sub-tributary)',
        'desc' => 'बाराबंकी की सुरम्य उप-नदी। आँखें फाउंडेशन द्वारा रेठ नदी के किनारे बसे ग्रामों में नदी स्वच्छता, तटवर्ती सघन वृक्षारोपण और जलीय स्रोतों को प्रदूषण मुक्त रखने हेतु निरंतर चौपालें व श्रमदान आयोजित किए जाते हैं।',
        'badge' => 'उप-नदी (गंगा)',
        'icon' => 'nature',
        'tag' => 'तटवर्ती स्वच्छता व वृक्षारोपण'
    ],
    [
        'id' => 4,
        'name' => 'कल्याणी नदी',
        'type' => 'गंगा नदी की उप-नदी (Sub-tributary)',
        'desc' => 'जनपद बाराबंकी की जीवनदायिनी उप-नदी। कल्याणी नदी के किनारे के ग्रामों में नदी जल संरक्षण, तटवर्ती बंधों पर हरित पट्टी निर्माण एवं ग्रामीण जनमानस में नदी स्वच्छता चेतना का व्यापक प्रसार किया जाता है।',
        'badge' => 'उप-नदी (गंगा)',
        'icon' => 'forest',
        'tag' => 'नदी तट जनचेतना अभियान'
    ],
    [
        'id' => 5,
        'name' => 'जमुरिया नाला (प्राचीन जम्बू-नद) पुनरुद्धार',
        'type' => 'ऐतिहासिक नदी का पुनर्जीवन',
        'desc' => 'बाराबंकी नगर के बीच से गुजरने वाले जमुरिया नाले को जनपद के इतिहासकारों ने "जम्बू-नद" बताया कि यह कभी नदी थी, जो कालांतर में नाला व गंदगी का पर्याय बन गई। दोनों तटों पर अवैध कब्जे हो गए थे। संस्था ने जिला प्रशासन से लगातार वार्ताएं करके व जनता में वातावरण सृजित कर प्रशासन व नगर पालिका के संयुक्त प्रयासों से इसकी सफाई कराई। वर्तमान में यह पुनः नदी की शक्ल में है।',
        'badge' => 'ऐतिहासिक पुनरुद्धार',
        'icon' => 'cleaning_services',
        'tag' => 'धरातल पर ऐतिहासिक सफलता'
    ],
];

// Key Foundation Pillars & Movements (विस्तृत वैचारिकी व कार्य)
$initiatives = [
    [
        'num' => 1,
        'title' => 'विधिक पंजीकरण व "आँखें इंडिया" से "आँखें फाउंडेशन" का सफर',
        'subtitle' => 'पंजीकरण संख्या BAB/02650/2018-19 • सोसायटी रजिस्ट्रेशन एक्ट 1860',
        'text' => '"आँखें फाउंडेशन" का पंजीकरण दिनांक 31 जुलाई 2018 को उपनिबंधक, फर्म समितियाँ तथा चिट्स अयोध्या (फैजाबाद) उत्तर प्रदेश में हुआ। जिसका पंजीकरण संख्या BAB/02650/2018-2019 है।\n\nसंस्था पंजीकरण के 8 वर्षों पूर्व (वर्ष 2010) से ही अनवरत कार्यरत रही है। पंजीकरण से पूर्व संस्था का नाम "आँखें इंडिया" था। पंजीकरण के समय संस्था के नाम में \'इंडिया\' शब्द जुड़ा था अतः पंजीकरण से रोक दिया गया। तत्काल संस्था ने सर्वसम्मति से नाम में आंशिक संशोधन किया और इंडिया के स्थान पर फाउंडेशन कर दिया।\n\nशासनादेश के अनुसार पंजीकृत संस्था की वे समस्त गतिविधियों को संस्था की गतिविधियाँ आगणित की जाएंगी जो कि गठन से पंजीकरण तक पूर्व से संचालित की जाती रही हैं। इस प्रकार आँखें फाउंडेशन और आँखें इंडिया एक ही हैं। इस आशय का शपथ पत्र संलग्न है।',
        'highlight' => 'वर्ष 2010 से अनवरत सेवा • शासनादेश सम्मत विधिक निरंतरता एवं शपथ-पत्र संलग्न',
        'icon' => 'gavel',
        'badge' => 'विधिक पंजीकरण एवं इतिहास'
    ],
    [
        'num' => 2,
        'title' => 'बाराबंकी की 4 नदियाँ, जल और जंगल संरक्षण एवं जमुरिया पुनरुद्धार',
        'subtitle' => 'गोमती, घाघरा, रेठ व कल्याणी नदी संरक्षण तथा जम्बू-नद की निर्मल वापसी',
        'text' => 'उत्तर प्रदेश के जनपद बाराबंकी में चार प्रमुख नदियाँ हैं— गोमती नदी, घाघरा नदी, रेठ नदी, कल्याणी नदी। जिसमें से दो नदियाँ (गोमती नदी व घाघरा नदी) गंगा नदी की सहायक नदियाँ हैं तथा दो नदियाँ (रेठ नदी और कल्याणी नदी) गंगा की उप नदियाँ हैं।\n\nआँखें फाउंडेशन (आँखें इंडिया) अपने गठन के समय वर्ष 2010 से ही "जल और जंगल" के संरक्षण हेतु जनजागरण के कार्यक्रम संचालित करती रही है। कल्याणी नदी और रेठ नदी के किनारे के ग्रामों में नदी स्वच्छता, नदी तट पर वृक्षारोपण के लिए समय समय पर जनजागरूकता के अनेक कार्यक्रम आयोजित किये जाते रहे हैं।\n\nबाराबंकी नगर के बीच से गुजरने वाले जमुरिया नाले को जनपद के इतिहासकारों ने इसे जम्बू-नद बताया। और तर्क दिए कि यह कभी नदी थी कालांतर में नाला हो गयी है और गंदगी का पर्याय बन गयी। भौतिक स्वरूप भी बिगड़ चुका था। दोनों तटों पर जगह जगह अवैध कब्जे भी हो गए थे। जिला प्रशासन से लगातार वार्ताएं करके, जनता में वातावरण सृजित करके जमुरिया नाले के पुनरुद्धार में संस्था ने कार्य किया। परिणामस्वरूप जिला प्रशासन एवं नगर पालिका परिषद के संयुक्त प्रयासों से इस नाले की सफाई कराई गई। वर्तमान में यह नाला पुनः नदी की शक्ल में है।',
        'highlight' => '4 नदियों का संरक्षण • जमुरिया नाले (जम्बू-नद) की सफाई कराकर पुनः नदी स्वरूप बहाल',
        'icon' => 'waves',
        'badge' => 'नदियाँ व जल पुनरुद्धार'
    ],
    [
        'num' => 3,
        'title' => 'ग्रीन गैंग (पर्यावरण सेना) व "ग्रीन मॉर्निंग" अभिवादन क्रांति',
        'subtitle' => '5 जून 2019 स्थापना • Good Morning के स्थान पर Green Morning की ऐतिहासिक शुरुआत',
        'text' => 'संस्था द्वारा वर्ष 2013 से हरियाली मुहिम पर्यावरण संरक्षण अभियान की शुरुआत की गई। 5 जून 2019 विश्व पर्यावरण दिवस को शहीद उद्यान पार्क बाराबंकी में स्वयंसेवक गण एकत्रित होकर धरती पर हरियाली बढ़ाने हेतु ग्रीन गैंग/पर्यावरण सेना का गठन कर धरती पर हरियाली बढ़ाने की मुहिम संचालन का संकल्प लिया गया। इस अवसर पर संस्थापक श्री प्रदीप सारंग द्वारा अपने बालों को हरे रंग में रंगवाया गया। लोगों ने हाथों और गालों पर पोस्टर कलर से वृक्षों के टैटू बनवाये।\n\nसंस्था आँखें फाउंडेशन उर्फ आँखें इंडिया का पंजीकृत संस्था के माध्यम से संस्था की एक परियोजना (ग्रीन गैंग पर्यावरण सेना) का निर्माण करके जन-जन के दिल दिमाग में हरियाली के प्रति पसन्दगी का वातावरण-सृजन का कार्य एवं वृक्षारोपण करने-कराने के उद्देश्य को लेकर संस्था लगातार कार्यरत है।\n\nग्रीन गैंग/पर्यावरण सेना ने अभिवादन शैली में बदलाव किया। गुड मॉर्निंग, गुड आफ्टरनून, गुड इवनिंग, और गुड नाइट के स्थान पर ग्रीन मॉर्निंग, ग्रीन आफ्टरनून, ग्रीन इवनिंग, ग्रीन नाइट का विकल्प गढ़ा। और लोगों ने पसंद किया। आज हजारों लोग गुड मॉर्निंग आदि के स्थान पर ग्रीन मॉर्निंग बोल रहे हैं। ग्रीन शब्द के बार बार उच्चारण से दिल दिमाग में हरियाली के प्रति पसन्दगी (Greenery Liking) का वातावरण सृजित होता है।',
        'highlight' => 'शहीद उद्यान में ग्रीन गैंग गठन • गुड मॉर्निंग के स्थान पर "ग्रीन मॉर्निंग" की विश्वव्यापी पहल',
        'icon' => 'eco',
        'badge' => 'ग्रीन गैंग व अभिवादन क्रांति'
    ],
    [
        'num' => 4,
        'title' => 'परिंदा संरक्षण अभियान (2011 से) — मिट्टी के बर्तन व छत पर दाना-पानी',
        'subtitle' => 'निःशुल्क सकोरे वितरण • "थालियों में बची जूठन परिंदों का भोजन है"',
        'text' => 'वर्ष 2011 से बेजुबान पक्षियों को गर्मियों में पानी पिलाने हेतु परिंदा संरक्षण अभियान संस्था द्वारा चलाकर मिट्टी के बर्तन निःशुल्क वितरित कर आम जनमानस के घरों की छतों पर मिट्टी के बर्तनों में पानी भरकर रखने हेतु प्रेरित किया।\n\n"थालियों में बची हुई जूठन परिंदों का भोजन है। जूठन नालियों में न फेंक कर छत पर डालें।"\n\nनगर क्षेत्र में प्रतिवर्ष गर्मियों में घर-घर जाकर अभियान चलाया जाता है। जिसमें जनप्रतिनिधियों और प्रशासनिक अधिकारियों की गरिमामयी उपस्थिति भी निरंतर बनी रहती रही है। हजारों परिंदों को इससे जीवनदान मिला है।',
        'highlight' => '10,000+ मिट्टी के सकोरे • जूठन को नालियों में फेंकने के बजाय पक्षियों का भोजन बनाने का संदेश',
        'icon' => 'cruelty_free',
        'badge' => 'परिंदा संरक्षण अभियान'
    ],
    [
        'num' => 5,
        'title' => 'बदलाव की शुरुआत — स्वागत में माला-फूल की जगह "गमला व पौध" परम्परा',
        'subtitle' => 'सांस्कारिक, पारिवारिक व राजकीय अवसरों पर पौधरोपण व ईको-गिफ्टिंग',
        'text' => 'सरकारी व गैर-सरकारी आयोजनों में उपहार स्वरूप व स्वागत में माला-फूल की जगह गमला व पौध देने की स्वस्थ परम्परा की नींव डाली गई।\n\nप्रत्येक सांस्कारिक अवसर पर एवं उमंग, उत्साह व खुशी के मौकों (जन्मदिन, वैवाहिक वर्षगांठ, सम्मान समारोह) पर पौधरोपण तथा गिफ्ट रूप में पौध प्रदान करने की व्यापक शुरुआत करके समाज में पर्यावरण सम्मत बदलाव की एक नई बहार को गति प्रदान की गई। लोग अब प्लास्टिक व मुरझाने वाले फूलों के बजाय दीर्घायु पौधे भेंट करते हैं।',
        'highlight' => 'स्वागत में माला-फूल की जगह "गमला व पौध" • हर उत्सव पर पौधा रोपने व भेंट करने की संस्कृति',
        'icon' => 'potted_plant',
        'badge' => 'ईको-गिफ्टिंग परम्परा'
    ],
    [
        'num' => 6,
        'title' => 'ऐतिहासिक उपलब्धि — जिला गंगा समिति बाराबंकी में नामित सदस्य दायित्व',
        'subtitle' => 'जिलाधिकारी बाराबंकी द्वारा संस्थापक/संरक्षक श्री प्रदीप सारंग को विशेष दायित्व',
        'text' => 'धरातल पर बदलाव करने एवं लोगों में व्यावहारिक परिवर्तन (Behavioral Change) को ध्यान में रखकर व्यक्तिगत एवं सामूहिक रूप से अनेकानेक गतिविधियों ("जल और जंगल" यानी जलस्रोत तथा पर्यावरण) को संचालित करते रहने के कारण "आँखें फाउंडेशन" तथा आँखें फाउंडेशन की परियोजना "ग्रीन गैंग" के प्रतिनिधि के रूप में संस्थापक/संरक्षक श्री प्रदीप सारंग को जिलाधिकारी बाराबंकी द्वारा जिला गंगा समिति में नामित सदस्य के रूप दायित्व निर्वहन किया जा रहा है।\n\nयह दायित्व जनपद के जलस्रोतों, नदियों की स्वच्छता, तटवर्ती वनीकरण और जनभागीदारी को नीतिगत स्तर पर मजबूती प्रदान करता है।',
        'highlight' => 'जल व जंगल संरक्षण के सम्मान स्वरूप जिलाधिकारी बाराबंकी द्वारा जिला गंगा समिति में नामित सदस्य',
        'icon' => 'military_tech',
        'badge' => 'शासन-प्रशासन उपलब्धि'
    ]
];
?>

<style>
/* ========================================================================= */
/* SCOPED CONTRAST, TYPOGRAPHY & BULLETPROOF VISIBILITY ENFORCEMENT          */
/* ========================================================================= */
#aankhein-foundation-root {
  color: #172033;
}
#aankhein-foundation-root a {
  text-decoration: none;
}

/* Force crystal-clear high contrast for all dark emerald/green cards & sections */
#aankhein-foundation-root .jamuriya-card,
#aankhein-foundation-root .green-morning-card,
#aankhein-foundation-root .contact-card,
#aankhein-foundation-root .metric-ribbon {
  color: #ffffff !important;
}

#aankhein-foundation-root .jamuriya-card h3,
#aankhein-foundation-root .jamuriya-card h4,
#aankhein-foundation-root .green-morning-card h3,
#aankhein-foundation-root .green-morning-card h4,
#aankhein-foundation-root .contact-card h3,
#aankhein-foundation-root .contact-card h4 {
  color: #ffffff !important;
}

#aankhein-foundation-root .jamuriya-card p,
#aankhein-foundation-root .jamuriya-card p * {
  color: #ecfdf5 !important;
}

#aankhein-foundation-root .jamuriya-card .callout-box,
#aankhein-foundation-root .jamuriya-card .callout-box *,
#aankhein-foundation-root .jamuriya-card .callout-box p {
  color: #ffffff !important;
  background-color: rgba(255, 255, 255, 0.16) !important;
}

#aankhein-foundation-root .jamuriya-card .highlight-text,
#aankhein-foundation-root .jamuriya-card .highlight-text * {
  color: #a7f3d0 !important;
}

/* Force Jamuriya Action Button: dark green text on white button */
#aankhein-foundation-root .jamuriya-card .btn-share-jamuriya,
#aankhein-foundation-root .jamuriya-card .btn-share-jamuriya *,
#aankhein-foundation-root .jamuriya-card .btn-share-jamuriya span {
  color: #064e3b !important;
  background-color: #ffffff !important;
}
#aankhein-foundation-root .jamuriya-card .btn-share-jamuriya:hover {
  background-color: #ecfdf5 !important;
}

/* Force Green Morning Greeting card text and buttons */
#aankhein-foundation-root .green-morning-card p,
#aankhein-foundation-root .green-morning-card p * {
  color: #ecfdf5 !important;
}
#aankhein-foundation-root .green-morning-card .callout-box,
#aankhein-foundation-root .green-morning-card .callout-box *,
#aankhein-foundation-root .green-morning-card .callout-box p {
  color: #ffffff !important;
  background-color: rgba(255, 255, 255, 0.16) !important;
}
#aankhein-foundation-root .green-morning-card .btn-white-action,
#aankhein-foundation-root .green-morning-card .btn-white-action *,
#aankhein-foundation-root .green-morning-card .btn-white-action span {
  color: #064e3b !important;
  background-color: #ffffff !important;
}

/* Force Contact Card text and buttons */
#aankhein-foundation-root .contact-card p,
#aankhein-foundation-root .contact-card p * {
  color: #ecfdf5 !important;
}
#aankhein-foundation-root .contact-card .btn-white-contact,
#aankhein-foundation-root .contact-card .btn-white-contact *,
#aankhein-foundation-root .contact-card .btn-white-contact span {
  color: #064e3b !important;
  background-color: #ffffff !important;
}

/* Force Metric Ribbon text */
#aankhein-foundation-root .metric-ribbon,
#aankhein-foundation-root .metric-ribbon * {
  color: #ffffff !important;
}
#aankhein-foundation-root .metric-ribbon .metric-num {
  color: #6ee7b7 !important;
}

/* Primary Green Buttons */
.green-btn-primary, 
.green-btn-primary *,
.green-btn-primary span { 
  color: #ffffff !important; 
}

.green-btn-dark, 
.green-btn-dark *,
.green-btn-dark span { 
  color: #ffffff !important; 
}
.green-btn-dark .icon-accent { 
  color: #34d399 !important; 
}

.green-btn-light, 
.green-btn-light *,
.green-btn-light span { 
  color: #064e3b !important; 
}

.green-hero-badge {
  background-color: #d1fae5;
  color: #064e3b;
  border: 1px solid #6ee7b7;
}

.green-watermark {
  color: #ecfdf5;
}

.active-river-card {
  border-color: #059669 !important;
  background-color: #f0fdf4 !important;
}

/* Digital Green Pledge */
#greenPledgeFullText p {
  color: #1c1917 !important;
}
</style>

<div id="aankhein-foundation-root" class="w-full bg-[#fbfdfb] text-stone-900 font-sans antialiased selection:bg-emerald-600 selection:text-white">

  <!-- ========================================================================= -->
  <!-- HERO SECTION: OFFICIAL REGISTRATION & GRAND CHARTER                       -->
  <!-- ========================================================================= -->
  <section class="relative w-full bg-gradient-to-b from-[#ecfdf5] via-[#f0fdf4] to-[#fbfdfb] overflow-hidden py-10 md:py-16 border-b border-[#d1fae5]">
    <!-- Ambient Green Leaf Pattern Overlay -->
    <div class="absolute inset-0 opacity-[0.03] pointer-events-none" style="background-image: radial-gradient(#059669 1px, transparent 1px); background-size: 28px 28px;"></div>
    
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
      
      <!-- Breadcrumb Bar -->
      <nav aria-label="Breadcrumb" class="flex items-center gap-2 text-xs md:text-sm text-stone-600 mb-6 font-medium">
        <a class="hover:text-emerald-800 transition-colors flex items-center gap-1" href="<?= e(base_url('/')) ?>">
          <span class="material-symbols-outlined text-[16px]">home</span>
          <span><?= e(ps_text('गृह (Home)', 'Home')) ?></span>
        </a>
        <span class="opacity-40">/</span>
        <a class="hover:text-emerald-800 transition-colors" href="<?= e(base_url('/campaigns')) ?>">
          <span><?= e(ps_text('प्रमुख जन-अभियान', 'Campaigns')) ?></span>
        </a>
        <span class="opacity-40">/</span>
        <span class="text-stone-900 font-bold"><?= e(ps_text('आँखें फाउंडेशन', 'Aankhein Foundation')) ?></span>
      </nav>

      <!-- Grid Layout: Left Content, Right Hero Visual -->
      <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-center">
        
        <!-- Left Column -->
        <div class="lg:col-span-7 flex flex-col">
          
          <!-- Official Trust/Society Badge -->
          <div class="inline-flex items-center gap-2 green-hero-badge px-4 py-1.5 rounded-full text-xs md:text-sm font-bold tracking-wide shadow-sm self-start mb-4">
            <span class="material-symbols-outlined text-[16px] text-emerald-700" style="font-variation-settings: 'FILL' 1;">verified</span>
            <span>सोसायटी रजिस्ट्रेशन एक्ट 1860 • पंजी. सं. <?= e($regNumber) ?></span>
          </div>

          <h1 class="font-serif text-3xl sm:text-4xl md:text-5xl lg:text-5xl text-stone-900 font-extrabold leading-tight tracking-tight mb-4">
            <?= e($foundationName) ?>
            <span class="block text-xl sm:text-2xl md:text-3xl text-emerald-800 font-semibold mt-2 font-sans">
              "जल और जंगल" संरक्षण, बाराबंकी नदी पुनरुद्धार एवं ग्रीन गैंग पर्यावरण सेना
            </span>
          </h1>

          <p class="text-stone-700 text-base md:text-lg leading-relaxed mb-6 font-normal">
            उप रजिस्ट्रार अयोध्या मंडल से अधिकृत पंजीकृत संस्था (गठन वर्ष 2010 से अनवरत सेवारत, पूर्व नाम "आँखें इंडिया")। बाराबंकी की चार प्रमुख नदियों का संवर्धन, जमुरिया नाला (जम्बू-नद) की ऐतिहासिक सफाई, परिंदा संरक्षण एवं 'ग्रीन मॉर्निंग' अभिवादन क्रांति की संवाहक।
          </p>

          <!-- Grand Statement / Motto Box -->
          <div class="bg-white/95 backdrop-blur-sm rounded-2xl p-5 md:p-6 border-l-4 border-emerald-600 border-t border-r border-b border-stone-200 shadow-sm mb-8 relative">
            <div>
              <p class="font-serif text-base sm:text-lg text-stone-900 italic font-semibold leading-snug mb-2">
                "सरकारी व गैर-सरकारी आयोजनों में स्वागत में माला-फूल की जगह गमला व पौध भेंट करने की स्वस्थ परम्परा — जल और जंगल का संरक्षण ही धरती का जीवन है।"
              </p>
              <div class="flex items-center justify-between flex-wrap gap-2 text-xs text-stone-600 border-t border-stone-100 pt-2 mt-2">
                <span class="font-bold text-emerald-950">आँखें फाउंडेशन (पंजीकृत संस्था)</span>
                <span class="text-stone-500 font-medium">— <span style="color: #047857 !important; font-weight: bold;"><?= e($founderName) ?></span> (संस्थापक • मो. <?= e($founderPhone) ?>)</span>
              </div>
            </div>
          </div>

          <!-- Quick Interactive Navigation CTAs with Guaranteed Visibility -->
          <div class="flex flex-wrap items-center gap-3">
            <a href="#foundation-registration" class="green-btn-primary inline-flex items-center gap-2 px-5 py-3 rounded-xl text-sm font-bold shadow-md hover:shadow-lg transition-all transform hover:-translate-y-0.5" style="background-color: #047857 !important; color: #ffffff !important;">
              <span class="material-symbols-outlined text-[19px]" style="color: #ffffff !important;">history_edu</span>
              <span style="color: #ffffff !important;"><?= e(ps_text('विधिक पंजीकरण व इतिहास', 'Registration & History')) ?></span>
            </a>
            <a href="#foundation-rivers" class="green-btn-dark inline-flex items-center gap-2 px-5 py-3 rounded-xl text-sm font-bold shadow-md transition-all transform hover:-translate-y-0.5" style="background-color: #064e3b !important; color: #ffffff !important;">
              <span class="icon-accent material-symbols-outlined text-[19px]" style="color: #34d399 !important;">waves</span>
              <span style="color: #ffffff !important;"><?= e(ps_text('4 नदियाँ व जमुरिया उद्धार', '4 Rivers & Jamuriya')) ?></span>
            </a>
            <a href="#foundation-greengang" class="green-btn-light inline-flex items-center gap-2 border border-emerald-300 px-4 py-3 rounded-xl text-sm font-bold transition-all shadow-sm hover:bg-emerald-50" style="background-color: #ffffff !important; color: #064e3b !important;">
              <span class="material-symbols-outlined text-[19px]" style="color: #059669 !important;">eco</span>
              <span style="color: #064e3b !important;"><?= e(ps_text('ग्रीन गैंग व "ग्रीन मॉर्निंग"', 'Green Gang & Greeting')) ?></span>
            </a>
            <a href="#foundation-birds" class="inline-flex items-center gap-2 border border-emerald-200 px-4 py-3 rounded-xl text-sm font-bold transition-all shadow-sm hover:bg-emerald-100/60" style="background-color: #ecfdf5 !important; color: #065f46 !important;">
              <span class="material-symbols-outlined text-[19px]" style="color: #059669 !important;">cruelty_free</span>
              <span style="color: #065f46 !important;"><?= e(ps_text('परिंदा संरक्षण व गमला-पौध', 'Bird Care & Eco-Gift')) ?></span>
            </a>
          </div>

        </div>

        <!-- Right Column: Grand Portrait Card & Official Foundation Badge -->
        <div class="lg:col-span-5 flex flex-col items-center">
          <div class="w-full max-w-md bg-white rounded-3xl p-5 shadow-xl border border-emerald-100 relative overflow-hidden">
            
            <!-- Decorative Green Leaf Gradient Accent Line -->
            <div class="h-2 w-full bg-gradient-to-r from-emerald-600 via-emerald-400 to-teal-500 absolute top-0 left-0 right-0"></div>

            <!-- Portrait / Movement Photo Frame -->
            <div class="relative rounded-2xl overflow-hidden bg-emerald-950 mb-5 group border border-stone-200 shadow-inner">
              <img 
                src="<?= e(base_url('assets/images/hariyali_abhiyan.webp')) ?>" 
                alt="आँखें फाउंडेशन एवं ग्रीन गैंग पर्यावरण सेना - बाराबंकी" 
                class="w-full h-80 sm:h-96 object-cover object-center filter brightness-[1.02] contrast-[1.02] transition-transform duration-500 group-hover:scale-105"
                onerror="this.src='<?= e(base_url('uploads/69eddd34de768_pradeepsarang.webp')) ?>'"
              >
              <div class="absolute inset-0 bg-gradient-to-t from-stone-950 via-stone-950/40 to-transparent flex flex-col justify-end p-5 text-white">
                <span class="text-xs font-bold uppercase tracking-wider flex items-center gap-1 mb-1" style="color: #6ee7b7 !important;">
                  <span class="material-symbols-outlined text-[15px]" style="color: #6ee7b7 !important;">nature_people</span>
                  <span style="color: #6ee7b7 !important;">संस्थापक: श्री प्रदीप सारंग</span>
                </span>
                <h3 class="font-serif text-2xl font-bold leading-tight" style="color: #ffffff !important;">
                  आँखें फाउंडेशन
                </h3>
                <p class="text-xs mt-1 font-medium" style="color: #d1fae5 !important;">
                  पंजीकरण सं: <?= e($regNumber) ?> • उप रजिस्ट्रार अयोध्या मंडल
                </p>
              </div>
            </div>

            <!-- 3 Quick Live Fact Highlights -->
            <div class="grid grid-cols-3 gap-2 text-center pt-1">
              <div class="bg-emerald-50 p-3 rounded-xl border border-emerald-100">
                <span class="block text-lg font-bold text-emerald-900 font-serif">2010 से</span>
                <span class="text-[11px] text-emerald-800 font-medium leading-tight block">अनवरत जनसेवा</span>
              </div>
              <div class="bg-teal-50 p-3 rounded-xl border border-teal-100">
                <span class="block text-lg font-bold text-teal-900 font-serif">4 नदियाँ</span>
                <span class="text-[11px] text-teal-800 font-medium leading-tight block">जल व तट संरक्षण</span>
              </div>
              <div class="bg-stone-50 p-3 rounded-xl border border-stone-200">
                <span class="block text-lg font-bold text-stone-900 font-serif">जम्बू-नद</span>
                <span class="text-[11px] text-stone-700 font-medium leading-tight block">जमुरिया पुनरुद्धार</span>
              </div>
            </div>

            <!-- Share & Action Micro Bar -->
            <div class="mt-4 pt-3 border-t border-stone-100 flex items-center justify-between text-xs text-stone-600">
              <span class="flex items-center gap-1 font-semibold text-emerald-800">
                <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                पंजीकृत गैर-सरकारी संस्था (NGO)
              </span>
              <button onclick="shareFoundationPage()" class="inline-flex items-center gap-1 text-emerald-800 hover:text-emerald-950 font-bold transition-colors">
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
  <section class="metric-ribbon w-full py-8 shadow-inner border-y" style="background-color: #064e3b !important; border-color: #047857 !important; color: #ffffff !important;">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="grid grid-cols-2 md:grid-cols-4 gap-6 text-center">
        
        <!-- Metric 1 -->
        <div class="flex flex-col items-center p-3 rounded-xl border transition-colors" style="background-color: rgba(255, 255, 255, 0.08) !important; border-color: rgba(255, 255, 255, 0.15) !important;">
          <span class="material-symbols-outlined text-3xl mb-1" style="color: #6ee7b7 !important;">verified_user</span>
          <span class="metric-num font-serif text-xl sm:text-2xl font-bold" style="color: #6ee7b7 !important;"><?= e($regNumber) ?></span>
          <span class="text-sm font-semibold mt-1" style="color: #ffffff !important;">अधिकृत विधिक पंजीकरण</span>
          <span class="text-xs mt-0.5" style="color: #d1fae5 !important;">31 जुलाई 2018 (उपनिबंधक अयोध्या)</span>
        </div>

        <!-- Metric 2 -->
        <div class="flex flex-col items-center p-3 rounded-xl border transition-colors" style="background-color: rgba(255, 255, 255, 0.08) !important; border-color: rgba(255, 255, 255, 0.15) !important;">
          <span class="material-symbols-outlined text-3xl mb-1" style="color: #6ee7b7 !important;">waves</span>
          <span class="metric-num font-serif text-2xl md:text-3xl font-bold" style="color: #6ee7b7 !important;">4 नदियाँ + जम्बू नद</span>
          <span class="text-sm font-semibold mt-1" style="color: #ffffff !important;">गोमती, घाघरा, रेठ व कल्याणी</span>
          <span class="text-xs mt-0.5" style="color: #d1fae5 !important;">जमुरिया नाले का ऐतिहासिक पुनरुद्धार</span>
        </div>

        <!-- Metric 3 -->
        <div class="flex flex-col items-center p-3 rounded-xl border transition-colors" style="background-color: rgba(255, 255, 255, 0.08) !important; border-color: rgba(255, 255, 255, 0.15) !important;">
          <span class="material-symbols-outlined text-3xl mb-1" style="color: #fde047 !important;">eco</span>
          <span class="metric-num font-serif text-2xl md:text-3xl font-bold" style="color: #fde047 !important;">ग्रीन मॉर्निंग</span>
          <span class="text-sm font-semibold mt-1" style="color: #ffffff !important;">अभिवादन शैली में क्रांति</span>
          <span class="text-xs mt-0.5" style="color: #fef08a !important;">ग्रीन गैंग पर्यावरण सेना (5 जून 2019)</span>
        </div>

        <!-- Metric 4 -->
        <div class="flex flex-col items-center p-3 rounded-xl border transition-colors" style="background-color: rgba(255, 255, 255, 0.08) !important; border-color: rgba(255, 255, 255, 0.15) !important;">
          <span class="material-symbols-outlined text-3xl mb-1" style="color: #6ee7b7 !important;">military_tech</span>
          <span class="metric-num font-serif text-2xl md:text-3xl font-bold" style="color: #6ee7b7 !important;">जिला गंगा समिति</span>
          <span class="text-sm font-semibold mt-1" style="color: #ffffff !important;">नामित सदस्य दायित्व</span>
          <span class="text-xs mt-0.5" style="color: #d1fae5 !important;">जिलाधिकारी बाराबंकी द्वारा नामित</span>
        </div>

      </div>
    </div>
  </section>

  <!-- ========================================================================= -->
  <!-- SECTION 1: विधिक पंजीकरण, कार्यालय पते एवं संस्था का इतिहास               -->
  <!-- ========================================================================= -->
  <section id="foundation-registration" class="w-full py-16 md:py-24 bg-[#f8fdf9] border-b border-[#d1fae5] scroll-mt-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      
      <!-- Section Header -->
      <div class="text-center max-w-3xl mx-auto mb-12">
        <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-emerald-100 text-emerald-950 text-xs md:text-sm font-bold tracking-wider uppercase mb-3 border border-emerald-300">
          <span class="material-symbols-outlined text-[16px] text-emerald-700">account_balance</span>
          <span>आँखें फाउंडेशन • अधिकृत विधिक विवरण</span>
        </div>
        <h2 class="font-serif text-3xl sm:text-4xl text-stone-900 font-extrabold tracking-tight">
          संस्था का आधिकारिक पंजीकरण एवं कार्यालय विवरण
        </h2>
        <div class="w-24 h-1 bg-gradient-to-r from-emerald-600 to-teal-400 mx-auto mt-4 mb-4 rounded-full"></div>
        <p class="text-stone-700 text-base leading-relaxed">
          सोसायटी रजिस्ट्रेशन एक्ट 1860 के अंतर्गत उप रजिस्ट्रार अयोध्या मंडल अयोध्या कार्यालय से विधिवत पंजीकृत संस्था।
        </p>
      </div>

      <!-- 4 Legal Cards Grid -->
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
        
        <!-- Card 1: Registration Number -->
        <div class="bg-white rounded-2xl p-6 border border-emerald-200 shadow-sm flex flex-col justify-between hover:shadow-md transition-shadow">
          <div>
            <div class="w-12 h-12 rounded-xl bg-emerald-100 text-emerald-800 flex items-center justify-center font-bold mb-4">
              <span class="material-symbols-outlined text-2xl">badge</span>
            </div>
            <span class="text-xs font-bold uppercase text-emerald-800 tracking-wider block">पंजीकरण संख्या</span>
            <h3 class="font-serif text-lg font-bold text-stone-900 mt-1"><?= e($regNumber) ?></h3>
            <p class="text-xs text-stone-600 mt-2">दिनांक: <strong>31 जुलाई 2018</strong></p>
          </div>
          <div class="mt-4 pt-3 border-t border-stone-100 text-[11px] text-emerald-800 font-semibold flex items-center gap-1">
            <span class="material-symbols-outlined text-[14px]">check_circle</span>
            सत्यापित पंजीकरण
          </div>
        </div>

        <!-- Card 2: Registration Authority -->
        <div class="bg-white rounded-2xl p-6 border border-emerald-200 shadow-sm flex flex-col justify-between hover:shadow-md transition-shadow">
          <div>
            <div class="w-12 h-12 rounded-xl bg-emerald-100 text-emerald-800 flex items-center justify-center font-bold mb-4">
              <span class="material-symbols-outlined text-2xl">apartment</span>
            </div>
            <span class="text-xs font-bold uppercase text-emerald-800 tracking-wider block">पंजीयन प्राधिकारी</span>
            <h3 class="font-serif text-sm font-bold text-stone-900 mt-1">उपनिबंधक, फर्म समितियाँ तथा चिट्स</h3>
            <p class="text-xs text-stone-600 mt-1">अयोध्या (फैजाबाद) मंडल, उत्तर प्रदेश</p>
          </div>
          <div class="mt-4 pt-3 border-t border-stone-100 text-[11px] text-emerald-800 font-semibold flex items-center gap-1">
            <span class="material-symbols-outlined text-[14px]">verified</span>
            सोसायटी एक्ट 1860
          </div>
        </div>

        <!-- Card 3: Registered Office Address -->
        <div class="bg-white rounded-2xl p-6 border border-emerald-200 shadow-sm flex flex-col justify-between hover:shadow-md transition-shadow">
          <div>
            <div class="w-12 h-12 rounded-xl bg-teal-100 text-teal-800 flex items-center justify-center font-bold mb-4">
              <span class="material-symbols-outlined text-2xl">pin_drop</span>
            </div>
            <span class="text-xs font-bold uppercase text-teal-800 tracking-wider block">पंजीकृत कार्यालय पता</span>
            <h3 class="font-serif text-sm font-bold text-stone-900 mt-1">ग्राम व पोस्ट पाटमऊ</h3>
            <p class="text-xs text-stone-600 mt-1">तहसील- नवाबगंज, जिला- बाराबंकी (उ.प्र.)</p>
          </div>
          <div class="mt-4 pt-3 border-t border-stone-100 text-[11px] text-teal-800 font-semibold flex items-center gap-1">
            <span class="material-symbols-outlined text-[14px]">location_on</span>
            पंजीकृत अभिलेख पता
          </div>
        </div>

        <!-- Card 4: Head Office Address -->
        <div class="bg-white rounded-2xl p-6 border border-emerald-200 shadow-sm flex flex-col justify-between hover:shadow-md transition-shadow">
          <div>
            <div class="w-12 h-12 rounded-xl bg-emerald-100 text-emerald-800 flex items-center justify-center font-bold mb-4">
              <span class="material-symbols-outlined text-2xl">domain</span>
            </div>
            <span class="text-xs font-bold uppercase text-emerald-800 tracking-wider block">प्रधान-कार्यालय पता</span>
            <h3 class="font-serif text-sm font-bold text-stone-900 mt-1">ग्रीन गैंग रोड, हजाराबाग</h3>
            <p class="text-xs text-stone-600 mt-1">बाराबंकी, उत्तर प्रदेश, भारत।</p>
          </div>
          <div class="mt-4 pt-3 border-t border-stone-100 text-[11px] text-emerald-800 font-semibold flex items-center gap-1">
            <span class="material-symbols-outlined text-[14px]">call</span>
            मो. <?= e($founderPhone) ?>
          </div>
        </div>

      </div>

      <!-- Verbatim Detailed History & Affidavit Note -->
      <div class="bg-white rounded-3xl p-6 sm:p-10 border border-emerald-200 shadow-md">
        <div class="flex items-center gap-3 border-b border-stone-200 pb-5 mb-6">
          <div class="w-12 h-12 rounded-2xl bg-emerald-700 text-white flex items-center justify-center shadow">
            <span class="material-symbols-outlined text-2xl">menu_book</span>
          </div>
          <div>
            <span class="text-xs font-bold uppercase tracking-wider text-emerald-800">विधिक संक्षित परिचय</span>
            <h3 class="font-serif text-2xl font-bold text-stone-900">
              संस्था का इतिहास: "आँखें इंडिया" से "आँखें फाउंडेशन" तक
            </h3>
          </div>
        </div>

        <div class="prose max-w-none text-stone-800 space-y-4 font-serif text-base sm:text-lg leading-relaxed text-justify">
          <p>
            <strong>"आँखें फाउंडेशन" का पंजीकरण दिनांक 31 जुलाई 2018 को उपनिबंधक, फर्म समितियाँ तथा चिट्स अयोध्या (फैजाबाद) उत्तर प्रदेश में हुआ।</strong> जिसका पंजीकरण संख्या- <strong>BAB/02650/2018-2019</strong> है।
          </p>
          <p class="bg-emerald-50/70 p-5 rounded-2xl border-l-4 border-emerald-700 text-stone-900">
            "आँखें फाउण्डेशन" संस्था पंजीकरण के 8 वर्षों पूर्व (वर्ष 2010) से ही अनवरत कार्यरत रही है। पंजीकरण से पूर्व संस्था का नाम <strong>"आँखें इंडिया"</strong> था। पंजीकरण के समय संस्था के नाम में 'इंडिया' शब्द जुड़ा था अतः पंजीकरण से रोक दिया गया। तत्काल संस्था ने सर्वसम्मति से नाम में आंशिक संशोधन किया और 'इंडिया' के स्थान पर 'फाउंडेशन' कर दिया। 
          </p>
          <p>
            शासनादेश के अनुसार पंजीकृत संस्था की वे समस्त गतिविधियों को संस्था की गतिविधियाँ आगणित की जाएंगी जो कि गठन से पंजीकरण तक पूर्व से संचालित की जाती रही हैं। <strong>इस प्रकार आँखें फाउंडेशन और आँखें इंडिया एक ही हैं। इस आशय का शपथ पत्र संलग्न है।</strong>
          </p>
          <p>
            संस्था द्वारा वर्ष 2013 से हरियाली मुहिम पर्यावरण संरक्षण अभियान की शुरुआत की गई। <strong>5 जून 2019 विश्व पर्यावरण दिवस को शहीद उद्यान पार्क बाराबंकी</strong> में स्वयंसेवक गण एकत्रित होकर धरती पर हरियाली बढ़ाने हेतु <strong>ग्रीन गैंग / पर्यावरण सेना</strong> का गठन कर धरती पर हरियाली बढ़ाने की मुहिम संचालन का संकल्प लिया गया। इस अवसर पर संस्थापक श्री प्रदीप सारंग द्वारा अपने बालों को हरे रंग में रंगवाया गया तथा उपस्थित लोगों ने हाथों और गालों पर पोस्टर कलर से वृक्षों के टैटू बनवाये।
          </p>
        </div>

        <!-- Action Bar -->
        <div class="mt-8 pt-6 border-t border-stone-200 flex flex-wrap items-center justify-between gap-4">
          <button onclick="copyRegistrationInfo()" class="inline-flex items-center gap-1.5 px-4 py-2.5 rounded-xl bg-stone-100 hover:bg-stone-200 text-stone-800 text-xs font-bold transition-colors border border-stone-300">
            <span class="material-symbols-outlined text-[16px]">content_copy</span>
            <span>पंजीकरण व पता विवरण कॉपी करें</span>
          </button>
          <a href="<?= e(base_url('/volunteer')) ?>" class="green-btn-primary inline-flex items-center gap-1.5 px-5 py-2.5 rounded-xl text-xs font-bold shadow transition-colors" style="background-color: #047857 !important; color: #ffffff !important;">
            <span class="material-symbols-outlined text-[16px]" style="color: #ffffff !important;">how_to_reg</span>
            <span style="color: #ffffff !important;">आँखें फाउंडेशन से जुड़ें</span>
          </a>
        </div>

      </div>

    </div>
  </section>

  <!-- ========================================================================= -->
  <!-- SECTION 2: बाराबंकी की 4 नदियाँ एवं जमुरिया नाला (जम्बू-नद) ऐतिहासिक पुनरुद्धार -->
  <!-- ========================================================================= -->
  <section id="foundation-rivers" class="w-full py-16 md:py-24 bg-white border-b border-[#d1fae5] scroll-mt-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      
      <!-- Section Header -->
      <div class="text-center max-w-3xl mx-auto mb-12">
        <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-teal-100 text-teal-950 text-xs md:text-sm font-bold tracking-wider uppercase mb-3 border border-teal-300">
          <span class="material-symbols-outlined text-[16px] text-teal-700">water</span>
          <span>विशेष — "जल और जंगल" संरक्षण</span>
        </div>
        <h2 class="font-serif text-3xl sm:text-4xl text-stone-900 font-extrabold tracking-tight">
          बाराबंकी की 4 प्रमुख नदियाँ एवं जमुरिया नाला (जम्बू-नद) पुनरुद्धार
        </h2>
        <div class="w-24 h-1 bg-gradient-to-r from-teal-600 to-emerald-400 mx-auto mt-4 mb-4 rounded-full"></div>
        <p class="text-stone-700 text-base leading-relaxed">
          उत्तर प्रदेश के जनपद बाराबंकी में चार प्रमुख नदियाँ हैं— दो गंगा की सहायक नदियाँ (गोमती व घाघरा) और दो गंगा की उप-नदियाँ (रेठ व कल्याणी)। गठन वर्ष 2010 से ही आँखें फाउंडेशन इनके संरक्षण हेतु समर्पित है।
        </p>
      </div>

      <!-- 4 Rivers Cards Grid -->
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
        <?php foreach (array_slice($rivers, 0, 4) as $river): ?>
          <div class="bg-[#fcfdfc] rounded-2xl p-6 border border-teal-200 shadow-sm hover:shadow-md transition-all flex flex-col justify-between group hover:border-teal-400">
            <div>
              <div class="flex items-center justify-between mb-3">
                <div class="w-10 h-10 rounded-xl bg-teal-100 text-teal-800 flex items-center justify-center font-bold">
                  <span class="material-symbols-outlined text-[22px]"><?= e($river['icon']) ?></span>
                </div>
                <span class="text-[10px] font-bold uppercase tracking-wider px-2 py-0.5 rounded bg-teal-50 text-teal-800 border border-teal-200">
                  <?= e($river['badge']) ?>
                </span>
              </div>
              <h3 class="font-serif text-xl font-bold text-stone-900 mt-2">
                <?= e($river['name']) ?>
              </h3>
              <span class="text-xs font-semibold text-teal-700 block mt-0.5"><?= e($river['type']) ?></span>
              <p class="text-stone-600 text-xs sm:text-sm mt-3 leading-relaxed">
                <?= e($river['desc']) ?>
              </p>
            </div>
            <div class="mt-4 pt-3 border-t border-stone-100 text-[11px] text-stone-500 font-medium">
              <?= e($river['tag']) ?>
            </div>
          </div>
        <?php endforeach; ?>
      </div>

      <!-- Grand Spotlight Card: Jamuriya Nala (Jambu-Nad) Historic Revival -->
      <div class="jamuriya-card rounded-3xl p-6 sm:p-10 md:p-12 shadow-2xl relative overflow-hidden" style="background: linear-gradient(135deg, #064e3b 0%, #065f46 100%) !important; color: #ffffff !important;">
        
        <!-- Background Ambient Water Waves Icon -->
        <span class="material-symbols-outlined absolute -right-6 -bottom-6 text-[180px] pointer-events-none select-none" style="color: rgba(255, 255, 255, 0.05) !important;">
          waves
        </span>

        <div class="relative z-10 max-w-4xl">
          <div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full text-xs font-bold uppercase tracking-wider mb-4 border" style="background-color: rgba(52, 211, 153, 0.15) !important; color: #a7f3d0 !important; border-color: rgba(52, 211, 153, 0.35) !important;">
            <span class="material-symbols-outlined text-[15px]" style="color: #a7f3d0 !important;">verified</span>
            <span style="color: #a7f3d0 !important;">धरातल पर ऐतिहासिक जन-सफलता • जम्बू-नद</span>
          </div>

          <h3 class="font-serif text-2xl sm:text-3xl md:text-4xl font-extrabold leading-tight mb-4" style="color: #ffffff !important;">
            जमुरिया नाले (जम्बू-नद) का ऐतिहासिक पुनरुद्धार — जब नाला पुनः बना नदी
          </h3>

          <div class="space-y-4 font-serif text-base sm:text-lg leading-relaxed text-justify">
            <p style="color: #ecfdf5 !important; margin-bottom: 1rem;">
              बाराबंकी नगर के बीच से गुजरने वाले जमुरिया नाले को जनपद के इतिहासकारों ने <strong style="color: #ffffff !important;">"जम्बू-नद"</strong> बताया और तर्क दिए कि यह कभी नदी थी, कालांतर में नाला हो गयी और गंदगी का पर्याय बन गयी।
            </p>
            <p style="color: #ecfdf5 !important; margin-bottom: 1rem;">
              इसका भौतिक स्वरूप भी बिगड़ चुका था और दोनों तटों पर जगह-जगह अवैध कब्जे भी हो गए थे।
            </p>
            <div class="callout-box p-5 rounded-2xl border-l-4" style="background-color: rgba(255, 255, 255, 0.16) !important; border-color: #6ee7b7 !important; border-left-width: 4px !important; margin-bottom: 1rem;">
              <p style="color: #ffffff !important; margin-bottom: 0; line-height: 1.75;">
                <strong style="color: #ffffff !important;">आँखें फाउंडेशन ने जिला प्रशासन से लगातार वार्ताएं करके, जनता में वातावरण सृजित करके जमुरिया नाले के पुनरुद्धार में निरंतर कार्य किया।</strong> परिणामस्वरूप जिला प्रशासन एवं नगर पालिका परिषद के संयुक्त प्रयासों से इस नाले की वृहद सफाई कराई गई।
              </p>
            </div>
            <p class="highlight-text font-semibold" style="color: #a7f3d0 !important; margin-bottom: 1rem;">
              ✨ <strong style="color: #a7f3d0 !important;">वर्तमान में यह नाला पुनः नदी की शक्ल में प्रवाहित है।</strong> यह आँखें फाउंडेशन के धरातलीय संघर्ष और जन-प्रशासन समन्वय का जीवंत प्रमाण है।
            </p>
          </div>

          <div class="mt-8 pt-6 border-t flex flex-wrap items-center gap-4" style="border-color: rgba(5, 150, 105, 0.4) !important;">
            <button onclick="shareJamuriyaRevival()" class="btn-share-jamuriya inline-flex items-center gap-2 px-5 py-2.5 rounded-xl font-bold text-xs sm:text-sm shadow transition-colors" style="background-color: #ffffff !important; color: #064e3b !important; border: none !important;">
              <span class="material-symbols-outlined text-[18px]" style="color: #064e3b !important;">share</span>
              <span style="color: #064e3b !important;">जम्बू-नद पुनरुद्धार गाथा शेयर करें</span>
            </button>
            <span class="text-xs font-medium" style="color: #a7f3d0 !important;">
              #JamuriyaRevival #JambuNad #AankheinFoundation #Barabanki
            </span>
          </div>
        </div>

      </div>

    </div>
  </section>

  <!-- ========================================================================= -->
  <!-- SECTION 3: प्रमुख जनअभियान — ग्रीन गैंग एवं "ग्रीन मॉर्निंग" क्रांति      -->
  <!-- ========================================================================= -->
  <section id="foundation-greengang" class="w-full py-16 md:py-24 bg-[#fbfdfb] border-b border-[#d1fae5] scroll-mt-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      
      <!-- Section Header -->
      <div class="text-center max-w-3xl mx-auto mb-12">
        <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-emerald-100 text-emerald-950 text-xs md:text-sm font-bold tracking-wider uppercase mb-3 border border-emerald-300">
          <span class="material-symbols-outlined text-[16px] text-emerald-700">eco</span>
          <span>आँखें फाउंडेशन की परियोजना</span>
        </div>
        <h2 class="font-serif text-3xl sm:text-4xl text-stone-900 font-extrabold tracking-tight">
          ग्रीन गैंग (पर्यावरण सेना) एवं "ग्रीन मॉर्निंग" अभिवादन क्रांति
        </h2>
        <div class="w-24 h-1 bg-gradient-to-r from-emerald-600 to-teal-400 mx-auto mt-4 mb-4 rounded-full"></div>
        <p class="text-stone-700 text-base leading-relaxed">
          5 जून 2019 विश्व पर्यावरण दिवस को शहीद उद्यान पार्क बाराबंकी से शुरू हुई अनूठी हरित क्रांति, जिसने लोगों की दिनचर्या और अभिवादन शैली को बदल दिया।
        </p>
      </div>

      <!-- Grid: Green Gang Origin & Green Morning Innovation -->
      <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-stretch mb-12">
        
        <!-- Column 1: Green Gang Origin Story -->
        <div class="lg:col-span-6 bg-white rounded-3xl p-6 sm:p-8 border border-emerald-200 shadow-sm flex flex-col justify-between">
          <div>
            <div class="flex items-center gap-3 mb-4">
              <div class="w-12 h-12 rounded-2xl bg-emerald-700 text-white flex items-center justify-center font-bold shadow">
                <span class="material-symbols-outlined text-2xl">groups</span>
              </div>
              <div>
                <span class="text-xs font-bold uppercase text-emerald-800 tracking-wider">5 जून 2019 • शहीद उद्यान पार्क</span>
                <h3 class="font-serif text-2xl font-bold text-stone-900">ग्रीन गैंग / पर्यावरण सेना का गठन</h3>
              </div>
            </div>

            <div class="space-y-3 font-serif text-stone-700 text-sm sm:text-base leading-relaxed text-justify">
              <p>
                संस्था द्वारा <strong>वर्ष 2013 से हरियाली मुहिम</strong> पर्यावरण संरक्षण अभियान की शुरुआत की गई थी।
              </p>
              <p>
                <strong>5 जून 2019 विश्व पर्यावरण दिवस</strong> को बाराबंकी के ऐतिहासिक <strong>शहीद उद्यान पार्क</strong> में स्वयंसेवक गण एकत्रित होकर धरती पर हरियाली बढ़ाने हेतु <strong>"ग्रीन गैंग / पर्यावरण सेना"</strong> का गठन कर धरती पर हरियाली बढ़ाने की मुहिम संचालन का संकल्प लिया गया।
              </p>
              <div class="bg-emerald-50 p-4 rounded-xl border border-emerald-200 text-emerald-950 font-sans text-sm">
                <strong>अभूतपूर्व संकल्प:</strong> इस अवसर पर संस्थापक <strong>श्री प्रदीप सारंग द्वारा अपने बालों को हरे रंग में रंगवाया गया</strong> तथा उपस्थित लोगों ने हाथों और गालों पर पोस्टर कलर से वृक्षों के टैटू बनवाये।
              </div>
              <p class="pt-2">
                संस्था की यह परियोजना जन-जन के दिल दिमाग में हरियाली के प्रति पसन्दगी का वातावरण-सृजन करने एवं वृक्षारोपण करने-कराने के उद्देश्य को लेकर लगातार कार्यरत है।
              </p>
            </div>
          </div>

          <div class="mt-6 pt-4 border-t border-stone-100 flex items-center justify-between text-xs text-stone-500">
            <span class="font-bold text-emerald-800">#GreenGang #ParyavaranSena</span>
            <a href="<?= e(base_url('/green-gang')) ?>" class="text-emerald-700 hover:text-emerald-900 font-bold flex items-center gap-1">
              <span>ग्रीन गैंग पेज देखें</span>
              <span class="material-symbols-outlined text-[14px]">arrow_forward</span>
            </a>
          </div>
        </div>

        <!-- Column 2: Green Morning Greeting Revolution -->
        <div class="green-morning-card lg:col-span-6 rounded-3xl p-6 sm:p-8 shadow-xl flex flex-col justify-between" style="background: linear-gradient(135deg, #047857 0%, #065f46 100%) !important; color: #ffffff !important;">
          <div>
            <div class="flex items-center gap-3 mb-4">
              <div class="w-12 h-12 rounded-2xl flex items-center justify-center font-bold shadow" style="background-color: #ffffff !important; color: #064e3b !important;">
                <span class="material-symbols-outlined text-2xl" style="color: #064e3b !important;">wb_sunny</span>
              </div>
              <div>
                <span class="text-xs font-bold uppercase tracking-wider block" style="color: #a7f3d0 !important;">अभिवादन शैली में ऐतिहासिक बदलाव</span>
                <h3 class="font-serif text-2xl font-bold" style="color: #ffffff !important;">"ग्रीन मॉर्निंग" अभिवादन क्रांति</h3>
              </div>
            </div>

            <div class="space-y-3 text-sm sm:text-base leading-relaxed text-justify font-serif" style="color: #ecfdf5 !important;">
              <p style="color: #ecfdf5 !important;">
                ग्रीन गैंग/पर्यावरण सेना ने अभिवादन शैली में विश्वस्तरीय व्यावहारिक बदलाव किया।
              </p>

              <!-- Greeting Table / Pills -->
              <div class="grid grid-cols-2 gap-2.5 my-4 font-sans text-xs sm:text-sm">
                <div class="p-2.5 rounded-xl border" style="background-color: rgba(255, 255, 255, 0.12) !important; border-color: rgba(255, 255, 255, 0.25) !important;">
                  <span class="block text-[11px] line-through" style="color: #cbd5e1 !important;">Good Morning</span>
                  <span class="font-bold text-base flex items-center gap-1" style="color: #6ee7b7 !important;">
                    <span class="material-symbols-outlined text-[16px]" style="color: #6ee7b7 !important;">eco</span>
                    ग्रीन मॉर्निंग
                  </span>
                </div>
                <div class="p-2.5 rounded-xl border" style="background-color: rgba(255, 255, 255, 0.12) !important; border-color: rgba(255, 255, 255, 0.25) !important;">
                  <span class="block text-[11px] line-through" style="color: #cbd5e1 !important;">Good Afternoon</span>
                  <span class="font-bold text-base flex items-center gap-1" style="color: #6ee7b7 !important;">
                    <span class="material-symbols-outlined text-[16px]" style="color: #6ee7b7 !important;">eco</span>
                    ग्रीन आफ्टरनून
                  </span>
                </div>
                <div class="p-2.5 rounded-xl border" style="background-color: rgba(255, 255, 255, 0.12) !important; border-color: rgba(255, 255, 255, 0.25) !important;">
                  <span class="block text-[11px] line-through" style="color: #cbd5e1 !important;">Good Evening</span>
                  <span class="font-bold text-base flex items-center gap-1" style="color: #6ee7b7 !important;">
                    <span class="material-symbols-outlined text-[16px]" style="color: #6ee7b7 !important;">eco</span>
                    ग्रीन इवनिंग
                  </span>
                </div>
                <div class="p-2.5 rounded-xl border" style="background-color: rgba(255, 255, 255, 0.12) !important; border-color: rgba(255, 255, 255, 0.25) !important;">
                  <span class="block text-[11px] line-through" style="color: #cbd5e1 !important;">Good Night</span>
                  <span class="font-bold text-base flex items-center gap-1" style="color: #6ee7b7 !important;">
                    <span class="material-symbols-outlined text-[16px]" style="color: #6ee7b7 !important;">eco</span>
                    ग्रीन नाइट
                  </span>
                </div>
              </div>

              <p style="color: #ffffff !important;">
                <strong style="color: #ffffff !important;">लोगों ने इसे खूब पसंद किया। आज हजारों लोग गुड मॉर्निंग आदि के स्थान पर "ग्रीन मॉर्निंग" बोल रहे हैं।</strong>
              </p>
              <div class="callout-box p-3 rounded-xl border-l-4" style="background-color: rgba(255, 255, 255, 0.16) !important; border-color: #6ee7b7 !important;">
                <p style="color: #ffffff !important; margin-bottom: 0;">
                  💡 <strong style="color: #a7f3d0 !important;">वैज्ञानिक व मनोवैज्ञानिक आधार:</strong> 'ग्रीन' शब्द के बार-बार उच्चारण से मनुष्य के दिल और दिमाग में हरियाली के प्रति पसन्दगी <em>(Greenery Liking)</em> का एक सकारात्मक वातावरण स्वतः सृजित होता है।
                </p>
              </div>
            </div>
          </div>

          <div class="mt-6 pt-4 border-t flex items-center justify-between" style="border-color: rgba(255, 255, 255, 0.2) !important;">
            <span class="text-xs" style="color: #a7f3d0 !important;">अभिवादन में हरियाली घोलें</span>
            <button onclick="shareGreenMorningGreeting()" class="btn-white-action inline-flex items-center gap-1.5 px-4 py-2 rounded-xl font-bold text-xs shadow transition-colors" style="background-color: #ffffff !important; color: #064e3b !important; border: none !important;">
              <span class="material-symbols-outlined text-[16px]" style="color: #064e3b !important;">send</span>
              <span style="color: #064e3b !important;">'ग्रीन मॉर्निंग' विश भेजें</span>
            </button>
          </div>
        </div>

      </div>

    </div>
  </section>

  <!-- ========================================================================= -->
  <!-- SECTION 4: परिंदा संरक्षण एवं स्वागत में "गमला व पौध" परम्परा            -->
  <!-- ========================================================================= -->
  <section id="foundation-birds" class="w-full py-16 md:py-24 bg-white border-b border-[#d1fae5] scroll-mt-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      
      <!-- Section Header -->
      <div class="text-center max-w-3xl mx-auto mb-12">
        <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-emerald-100 text-emerald-950 text-xs md:text-sm font-bold tracking-wider uppercase mb-3 border border-emerald-300">
          <span class="material-symbols-outlined text-[16px] text-emerald-700">cruelty_free</span>
          <span>अन्य प्रमुख गतिविधियाँ व सामाजिक बदलाव</span>
        </div>
        <h2 class="font-serif text-3xl sm:text-4xl text-stone-900 font-extrabold tracking-tight">
          परिंदा संरक्षण अभियान एवं ईको-गिफ्टिंग परम्परा
        </h2>
        <div class="w-24 h-1 bg-gradient-to-r from-emerald-600 to-teal-400 mx-auto mt-4 mb-4 rounded-full"></div>
        <p class="text-stone-700 text-base leading-relaxed">
          वर्ष 2011 से बेजुबान पक्षियों के लिए मिट्टी के सकोरों का निःशुल्क वितरण और स्वागत में माला-फूल के स्थान पर गमला व पौध भेंट करने की स्वस्थ परम्परा की शुरुआत।
        </p>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-stretch mb-12">
        
        <!-- Activity 1: Bird Protection Campaign -->
        <div class="bg-[#fcfdfc] rounded-3xl p-6 sm:p-8 border border-emerald-200 shadow-sm flex flex-col justify-between">
          <div>
            <div class="flex items-center gap-3 mb-4">
              <div class="w-12 h-12 rounded-2xl bg-amber-600 text-white flex items-center justify-center font-bold shadow">
                <span class="material-symbols-outlined text-2xl">water_bottle</span>
              </div>
              <div>
                <span class="text-xs font-bold uppercase text-amber-800 tracking-wider">वर्ष 2011 से अनवरत</span>
                <h3 class="font-serif text-2xl font-bold text-stone-900">परिंदा संरक्षण अभियान</h3>
              </div>
            </div>

            <div class="space-y-4 font-serif text-stone-700 text-base leading-relaxed text-justify">
              <p>
                वर्ष 2011 से बेजुबान पक्षियों को भीषण गर्मियों में पानी पिलाने हेतु परिंदा संरक्षण अभियान संस्था द्वारा चलाकर मिट्टी के बर्तन निःशुल्क वितरित किए जा रहे हैं।
              </p>
              <div class="p-4 bg-amber-50 rounded-2xl border-l-4 border-amber-600 font-sans text-stone-900">
                <p class="font-bold text-base text-amber-950 mb-1">📢 जन-संदेश:</p>
                <p class="italic text-sm">
                  "थालियों में बची हुई जूठन परिंदों का भोजन है। जूठन नालियों में न फेंक कर छत पर डालें।"
                </p>
              </div>
              <p>
                आम जनमानस के घरों की छतों पर मिट्टी के बर्तनों में पानी भरकर रखने हेतु प्रेरित किया जाता है। नगर क्षेत्र में प्रतिवर्ष गर्मियों में घर-घर जाकर अभियान चलाया जाता है, जिसमें जनप्रतिनिधियों और प्रशासनिक अधिकारियों की निरंतर उपस्थिति भी रहती रही है।
              </p>
            </div>
          </div>

          <div class="mt-6 pt-4 border-t border-stone-200 flex items-center justify-between text-xs text-stone-600">
            <span class="font-semibold text-amber-800">10,000+ मिट्टी सकोरा वितरण</span>
            <a href="<?= e(base_url('/gauraiya-bachao-abhiyan')) ?>" class="text-amber-800 hover:text-amber-950 font-bold flex items-center gap-1">
              <span>गौरैया बचाओ अभियान</span>
              <span class="material-symbols-outlined text-[14px]">arrow_forward</span>
            </a>
          </div>
        </div>

        <!-- Activity 2: Eco-Gifting & Sapling Welcoming Tradition -->
        <div id="foundation-ecogifting" class="bg-[#fcfdfc] rounded-3xl p-6 sm:p-8 border border-emerald-200 shadow-sm flex flex-col justify-between scroll-mt-16">
          <div>
            <div class="flex items-center gap-3 mb-4">
              <div class="w-12 h-12 rounded-2xl bg-emerald-700 text-white flex items-center justify-center font-bold shadow">
                <span class="material-symbols-outlined text-2xl">potted_plant</span>
              </div>
              <div>
                <span class="text-xs font-bold uppercase text-emerald-800 tracking-wider">बदलाव की नई बहार</span>
                <h3 class="font-serif text-2xl font-bold text-stone-900">स्वागत में माला-फूल नहीं, "गमला व पौध"</h3>
              </div>
            </div>

            <div class="space-y-4 font-serif text-stone-700 text-base leading-relaxed text-justify">
              <p>
                सरकारी व गैर-सरकारी आयोजनों में उपहार स्वरूप व स्वागत में प्लास्टिक व मुरझाने वाले <strong>माला-फूल की जगह गमला व पौध देने की स्वस्थ परम्परा की नींव</strong> आँखें फाउंडेशन द्वारा डाली गई।
              </p>
              <div class="p-4 bg-emerald-50 rounded-2xl border-l-4 border-emerald-700 font-sans text-stone-900">
                <p class="font-bold text-base text-emerald-950 mb-1">🌱 स्थायी संस्कार:</p>
                <p class="text-sm">
                  प्रत्येक सांस्कारिक अवसर पर एवं उमंग, उत्साह व खुशी के मौकों (जन्मदिन, सालगिरह, सम्मान समारोह) पर पौधरोपण तथा गिफ्ट रूप में पौध प्रदान करने की व्यापक शुरुआत करके बदलाव की एक नई बहार को गति प्रदान की गई।
                </p>
              </div>
              <p>
                इस पहल से न केवल पर्यावरण का संवर्धन हुआ, बल्कि समाज में फिजूलखर्ची पर रोक लगकर स्थायी हरियाली की संस्कृति विकसित हुई।
              </p>
            </div>
          </div>

          <div class="mt-6 pt-4 border-t border-stone-200 flex items-center justify-between text-xs text-stone-600">
            <span class="font-semibold text-emerald-800">ईको-फ्रेंडली स्वागत परम्परा</span>
            <button onclick="copyEcoGiftingMessage()" class="text-emerald-800 hover:text-emerald-950 font-bold flex items-center gap-1">
              <span>संदेश कॉपी करें</span>
              <span class="material-symbols-outlined text-[14px]">content_copy</span>
            </button>
          </div>
        </div>

      </div>

    </div>
  </section>

  <!-- ========================================================================= -->
  <!-- SECTION 5: बड़ी उपलब्धि — जिला गंगा समिति बाराबंकी में नामित सदस्य        -->
  <!-- ========================================================================= -->
  <section id="foundation-achievement" class="w-full py-16 md:py-24 bg-[#f8fdf9] border-b border-[#d1fae5] scroll-mt-16">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
      
      <div class="bg-white rounded-3xl p-6 sm:p-10 md:p-12 border-2 border-emerald-300 shadow-xl relative overflow-hidden">
        
        <!-- Corner Medallion -->
        <div class="absolute -right-6 -top-6 w-32 h-32 rounded-full bg-emerald-50 border border-emerald-200 flex items-center justify-center pointer-events-none select-none">
          <span class="material-symbols-outlined text-emerald-200 text-6xl">military_tech</span>
        </div>

        <div class="relative z-10">
          
          <div class="inline-flex items-center gap-2 px-4 py-1 rounded-full bg-emerald-100 text-emerald-900 text-xs font-bold uppercase tracking-wider mb-4 border border-emerald-300">
            <span class="material-symbols-outlined text-[16px] text-emerald-700">workspace_premium</span>
            <span>धरातल पर बदलाव का आधिकारिक सम्मान</span>
          </div>

          <h3 class="font-serif text-2xl sm:text-3xl md:text-4xl font-extrabold text-stone-900 leading-tight mb-4">
            उपलब्धि: जिलाधिकारी बाराबंकी द्वारा "जिला गंगा समिति" में नामित सदस्य दायित्व
          </h3>

          <div class="prose max-w-none text-stone-800 font-serif text-base sm:text-lg leading-relaxed text-justify space-y-4">
            <p>
              धरातल पर बदलाव करने एवं लोगों में व्यवहारिक परिवर्तन (विहैविरल चेंज) को ध्यान में रखकर व्यक्तिगत एवं सामूहिक रूप से अनेकानेक गतिविधियों <strong>("जल और जंगल" यानी जलस्रोत तथा पर्यावरण)</strong> को संचालित करते रहने के कारण:
            </p>
            <div class="bg-emerald-50 p-5 rounded-2xl border-l-4 border-emerald-700 font-sans text-stone-900">
              <p class="font-bold text-lg text-emerald-950 mb-1">
                "आँखें फाउंडेशन" तथा आँखें फाउंडेशन की परियोजना "ग्रीन गैंग" के प्रतिनिधि के रूप में:
              </p>
              <p class="text-base font-semibold text-emerald-900">
                संस्थापक / संरक्षक <strong>श्री प्रदीप सारंग</strong> को <strong>जिलाधिकारी बाराबंकी द्वारा जिला गंगा समिति में नामित सदस्य</strong> के रूप दायित्व निर्वहन किया जा रहा है।
              </p>
            </div>
            <p>
              यह मान्यता बाराबंकी की चार प्रमुख नदियों (गोमती, घाघरा, रेठ व कल्याणी) तथा जमुरिया नाला (जम्बू-नद) के पुनरुद्धार में संस्था के निस्वार्थ और सतत योगदान की शासकीय स्वीकृति है।
            </p>
          </div>

          <!-- Authority Card Details -->
          <div class="mt-8 pt-6 border-t border-stone-200 flex flex-col sm:flex-row items-center justify-between gap-4">
            <div class="flex items-center gap-3">
              <div class="w-12 h-12 rounded-full bg-emerald-800 text-white flex items-center justify-center font-bold text-lg shadow">
                प.सा.
              </div>
              <div>
                <h4 class="font-serif font-bold text-base text-stone-900"><?= e($founderName) ?></h4>
                <p class="text-xs text-stone-600 font-medium">संस्थापक, आँखें फाउण्डेशन • नामित सदस्य, जिला गंगा समिति (बाराबंकी)</p>
                <p class="text-[11px] text-emerald-800 font-bold mt-0.5">मो. <?= e($founderPhone) ?></p>
              </div>
            </div>

            <button onclick="shareAchievementNotice()" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-emerald-800 text-white font-bold text-xs shadow hover:bg-emerald-900 transition-colors">
              <span class="material-symbols-outlined text-[16px]">share</span>
              <span>उपलब्धि सूचना शेयर करें</span>
            </button>
          </div>

        </div>

      </div>

    </div>
  </section>

  <!-- ========================================================================= -->
  <!-- SECTION 6: पावन हरित संकल्प पत्र (THE SACRED GREEN RESOLUTION)            -->
  <!-- ========================================================================= -->
  <section id="foundation-pledge" class="relative w-full py-16 md:py-24 bg-gradient-to-b from-[#ecfdf5] via-[#f0fdf4] to-[#ecfdf5] border-b border-[#a7f3d0] scroll-mt-16 overflow-hidden">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 relative z-10">
      
      <!-- Section Intro -->
      <div class="text-center max-w-2xl mx-auto mb-10">
        <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-emerald-800 text-emerald-100 text-xs md:text-sm font-bold tracking-wider uppercase mb-3 shadow-sm">
          <span class="material-symbols-outlined text-[16px] text-emerald-300">eco</span>
          <span>आँखें फाउंडेशन • पावन हरित संकल्प</span>
        </div>
        <h2 class="font-serif text-3xl sm:text-4xl text-stone-900 font-extrabold flex items-center justify-center gap-2">
          <span class="material-symbols-outlined text-emerald-700 text-3xl sm:text-4xl" style="font-variation-settings: 'FILL' 1;">auto_stories</span>
          <span>जल, जंगल एवं जन-जीवन संरक्षण संकल्प-पत्र</span>
        </h2>
        <p class="text-stone-600 text-sm mt-2">
          प्रत्येक नागरिक एवं प्रकृति-प्रेमी द्वारा स्वीकार करने योग्य पावन प्रतिज्ञा
        </p>
      </div>

      <!-- Sacred Certificate / Scroll Container -->
      <div class="relative bg-[#ffffff] rounded-3xl p-6 sm:p-10 md:p-12 shadow-2xl border-4 border-emerald-700/80 text-stone-900">
        
        <!-- Corner Ornaments -->
        <div class="absolute top-3 left-3 w-8 h-8 border-t-2 border-l-2 border-emerald-700"></div>
        <div class="absolute top-3 right-3 w-8 h-8 border-t-2 border-r-2 border-emerald-700"></div>
        <div class="absolute bottom-3 left-3 w-8 h-8 border-b-2 border-l-2 border-emerald-700"></div>
        <div class="absolute bottom-3 right-3 w-8 h-8 border-b-2 border-r-2 border-emerald-700"></div>

        <!-- Scroll Header with Emblem -->
        <div class="text-center border-b-2 border-emerald-200 pb-6 mb-8">
          <div class="w-16 h-16 mx-auto rounded-full bg-emerald-100 border-2 border-emerald-600 text-emerald-900 flex items-center justify-center mb-3 shadow-inner">
            <span class="material-symbols-outlined text-3xl" style="font-variation-settings: 'FILL' 1;">eco</span>
          </div>
          <span class="text-xs font-bold uppercase tracking-widest text-emerald-800 block">
            आँखें फाउंडेशन • ग्रीन गैंग पर्यावरण सेना
          </span>
          <h3 class="font-serif text-2xl sm:text-3xl font-bold text-stone-900 mt-1">
            हरित संकल्प-पत्र
          </h3>
          <p class="text-xs text-stone-500 mt-1 italic">
            "हम धरती पर हरियाली बढ़ाने और नदियों को निर्मल रखने हेतु पूर्ण निष्ठा से कार्य करेंगे"
          </p>
        </div>

        <!-- Verbatim Pledge Paragraphs -->
        <div id="greenPledgeFullText" class="space-y-5 font-serif text-base sm:text-lg leading-relaxed text-stone-800 text-justify">
          
          <div class="p-4 bg-emerald-50/80 rounded-xl border-l-4 border-emerald-700">
            <p class="font-semibold text-stone-900">
              1. हम "जल और जंगल" के संरक्षण को अपना नैतिक एवं राष्ट्रीय कर्तव्य मानकर जीवन पर्यंत प्रकृति संवर्धन हेतु सक्रिय रहेंगे।
            </p>
          </div>

          <p class="pl-2 border-l-2 border-stone-200">
            2. बाराबंकी की नदियों (गोमती, घाघरा, रेठ, कल्याणी) तथा जमुरिया जैसे जलस्रोतों को स्वच्छ, अविरल एवं प्रदूषण-मुक्त रखने में स्वयं भी सहयोग करेंगे और समाज को भी जागरूक करेंगे।
          </p>

          <p class="pl-2 border-l-2 border-stone-200">
            3. हम अपनी दिनचर्या में अभिवादन के रूप में "ग्रीन मॉर्निंग", "ग्रीन आफ्टरनून", "ग्रीन इवनिंग", "ग्रीन नाइट" का प्रयोग करेंगे ताकि दिल-दिमाग में हरियाली के प्रति प्रेम (Greenery Liking) का संचार हो।
          </p>

          <p class="pl-2 border-l-2 border-stone-200">
            4. गर्मियों में बेजुबान पक्षियों के लिए छत पर मिट्टी के सकोरों में जल रखेंगे और थालियों की बची जूठन नालियों में न फेंक कर परिंदों के भोजन हेतु छत पर डालेंगे।
          </p>

          <p class="pl-2 border-l-2 border-stone-200">
            5. सरकारी व सामाजिक आयोजनों में स्वागत में माला-फूल के स्थान पर "गमला व पौध" भेंट करने की स्वस्थ परम्परा को अपनाएंगे और हर उमंग-उत्साह पर पौधरोपण करेंगे।
          </p>

          <!-- Grand Slogan Finale -->
          <div class="text-center pt-6 border-t-2 border-emerald-200">
            <div class="inline-block px-8 py-3 bg-gradient-to-r from-emerald-800 via-emerald-700 to-emerald-800 text-emerald-100 rounded-2xl shadow-lg border border-emerald-400">
              <span class="font-serif text-2xl sm:text-3xl font-extrabold tracking-wide block">
                ग्रीन मॉर्निंग • जय हिंद • जय प्रकृति
              </span>
            </div>
          </div>
        </div>

        <!-- Interactive Action Toolbar inside Scroll -->
        <div class="mt-10 pt-6 border-t border-stone-200 flex flex-wrap items-center justify-between gap-4">
          <button 
            id="takeGreenPledgeBtn"
            onclick="takeDigitalGreenPledge()" 
            class="inline-flex items-center gap-2 px-6 py-3 rounded-xl text-sm font-bold shadow-md transition-all transform hover:scale-[1.02]"
            style="background-color: #047857 !important; color: #ffffff !important;"
          >
            <span class="material-symbols-outlined text-[20px]" style="color: #ffffff !important;">how_to_reg</span>
            <span id="greenPledgeBtnLabel" style="color: #ffffff !important;">मैं यह हरित संकल्प लेता / लेती हूँ</span>
          </button>

          <div class="flex items-center gap-2">
            <button 
              onclick="copyGreenPledgeText()" 
              class="inline-flex items-center gap-1.5 px-4 py-2.5 rounded-xl bg-stone-100 hover:bg-stone-200 text-stone-800 text-xs font-bold transition-colors border border-stone-300"
            >
              <span class="material-symbols-outlined text-[16px]">content_copy</span>
              <span>संकल्प कॉपी करें</span>
            </button>
            <button 
              onclick="shareGreenPledgeWhatsApp()" 
              class="inline-flex items-center gap-1.5 px-4 py-2.5 rounded-xl text-xs font-bold transition-colors shadow-sm"
              style="background-color: #16a34a !important; color: #ffffff !important;"
            >
              <i class="fa-brands fa-whatsapp text-sm" style="color: #ffffff !important;"></i>
              <span style="color: #ffffff !important;">WhatsApp पर भेजें</span>
            </button>
          </div>
        </div>

        <!-- Digital Pledge Confirmation Banner (Hidden by default) -->
        <div id="greenPledgeSuccessCard" class="hidden mt-6 p-4 bg-emerald-50 border border-emerald-300 rounded-2xl text-emerald-900 text-center animate-fadeIn">
          <div class="flex items-center justify-center gap-2 font-bold text-sm">
            <span class="material-symbols-outlined text-emerald-600 text-xl">verified</span>
            <span>हार्दिक बधाई! आपने आँखें फाउंडेशन का पावन हरित संकल्प स्वीकार कर लिया है।</span>
          </div>
          <p class="text-xs text-emerald-800 mt-1">
            आइए अपने दैनिक जीवन में 'ग्रीन मॉर्निंग' बोलें, परिंदों को दाना-पानी दें और स्वागत में 'गमला व पौध' भेंट करें!
          </p>
        </div>

      </div>

    </div>
  </section>

  <!-- ========================================================================= -->
  <!-- SECTION 7: संस्थापक संपर्क एवं सहभागिता                                   -->
  <!-- ========================================================================= -->
  <section id="foundation-contact" class="w-full py-16 md:py-24 bg-white border-b border-[#d1fae5]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      
      <div class="contact-card rounded-3xl p-8 sm:p-12 shadow-2xl relative overflow-hidden" style="background: linear-gradient(135deg, #064e3b 0%, #047857 50%, #065f46 100%) !important; color: #ffffff !important;">
        
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
          
          <div class="lg:col-span-8 space-y-4">
            <span class="inline-block text-xs font-bold uppercase tracking-wider px-3.5 py-1 rounded-full border" style="background-color: rgba(255, 255, 255, 0.16) !important; color: #a7f3d0 !important; border-color: rgba(255, 255, 255, 0.3) !important;">
              संस्थापक एवं प्रधान कार्यालय संपर्क
            </span>
            <h3 class="font-serif text-3xl sm:text-4xl font-extrabold leading-tight" style="color: #ffffff !important;">
              आँखें फाउंडेशन के साथ जुड़ें और बदलाव के भागीदार बनें
            </h3>
            <p class="text-sm sm:text-base leading-relaxed max-w-2xl" style="color: #ecfdf5 !important;">
              वृक्षारोपण, नदी संरक्षण, परिंदा सेवा अथवा 'ग्रीन मॉर्निंग' जनअभियान में स्वयंसेवक के रूप में सम्मिलित होने हेतु सादर आमंत्रित हैं।
            </p>

            <!-- Office Coordinates -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-4 text-xs sm:text-sm font-sans">
              <div class="p-4 rounded-xl border" style="background-color: rgba(255, 255, 255, 0.12) !important; border-color: rgba(255, 255, 255, 0.25) !important;">
                <span class="font-bold block text-xs uppercase mb-1" style="color: #a7f3d0 !important;">प्रधान कार्यालय:</span>
                <p style="color: #ffffff !important; margin-bottom: 0;"><?= e($headOffice) ?></p>
              </div>
              <div class="p-4 rounded-xl border" style="background-color: rgba(255, 255, 255, 0.12) !important; border-color: rgba(255, 255, 255, 0.25) !important;">
                <span class="font-bold block text-xs uppercase mb-1" style="color: #a7f3d0 !important;">संस्थापक संपर्क:</span>
                <p style="color: #ffffff !important; margin-bottom: 0;"><strong style="color: #ffffff !important;"><?= e($founderName) ?></strong> (संस्थापक, आँखें फाउण्डेशन)</p>
                <p class="mt-1" style="color: #a7f3d0 !important; margin-bottom: 0;">मो. <a href="tel:<?= e($founderPhone) ?>" class="underline font-bold" style="color: #ffffff !important;"><?= e($founderPhone) ?></a></p>
              </div>
            </div>
          </div>

          <div class="lg:col-span-4 flex flex-col gap-3 justify-center items-stretch">
            <a href="<?= e(base_url('/volunteer')) ?>" class="btn-white-contact inline-flex items-center justify-center gap-2 px-6 py-3.5 rounded-2xl font-bold text-sm shadow-md transition-all text-center" style="background-color: #ffffff !important; color: #064e3b !important; text-decoration: none !important;">
              <span class="material-symbols-outlined text-[18px]" style="color: #064e3b !important;">how_to_reg</span>
              <span style="color: #064e3b !important;">स्वयंसेवक के रूप में पंजीकरण</span>
            </a>
            <a href="tel:<?= e($founderPhone) ?>" class="inline-flex items-center justify-center gap-2 px-6 py-3.5 rounded-2xl font-bold text-sm border shadow-sm transition-all text-center" style="background-color: rgba(6, 78, 59, 0.85) !important; color: #ffffff !important; border-color: #34d399 !important; text-decoration: none !important;">
              <span class="material-symbols-outlined text-[18px]" style="color: #ffffff !important;">call</span>
              <span style="color: #ffffff !important;">सीधे कॉल करें (<?= e($founderPhone) ?>)</span>
            </a>
            <a href="https://api.whatsapp.com/send?phone=91<?= e($founderPhone) ?>&text=<?= urlencode('ग्रीन मॉर्निंग! मैं आँखें फाउंडेशन एवं ग्रीन गैंग अभियान से जुड़ना चाहता/चाहती हूँ।') ?>" target="_blank" class="inline-flex items-center justify-center gap-2 px-6 py-3.5 rounded-2xl font-bold text-sm shadow-sm transition-all text-center" style="background-color: #16a34a !important; color: #ffffff !important; text-decoration: none !important;">
              <i class="fa-brands fa-whatsapp text-lg" style="color: #ffffff !important;"></i>
              <span style="color: #ffffff !important;">WhatsApp पर संवाद करें</span>
            </a>
          </div>

        </div>

      </div>

    </div>
  </section>

  <!-- ========================================================================= -->
  <!-- SECTION 8: अन्य संबंधित अभियान (RELATED CAMPAIGNS)                        -->
  <!-- ========================================================================= -->
  <section class="w-full py-14 bg-[#f8fdf9] border-b border-[#d1fae5]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      
      <div class="flex flex-col sm:flex-row sm:items-end justify-between mb-8 gap-4">
        <div>
          <span class="text-xs font-bold uppercase tracking-wider text-emerald-800">सहयोगी प्रयास</span>
          <h3 class="font-serif text-2xl font-bold text-stone-900 mt-1">अन्य प्रमुख जन-अभियान</h3>
        </div>
        <a href="<?= e(base_url('/campaigns')) ?>" class="text-xs font-bold text-emerald-800 hover:text-emerald-950 flex items-center gap-1">
          <span>सभी अभियान देखें</span>
          <span class="material-symbols-outlined text-[14px]">arrow_forward</span>
        </a>
      </div>

      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        
        <!-- Related 1: Green Gang -->
        <a href="<?= e(base_url('/green-gang')) ?>" class="group bg-white rounded-2xl p-5 border border-stone-200 hover:border-emerald-400 shadow-sm hover:shadow-md transition-all flex flex-col justify-between">
          <div>
            <span class="text-[10px] font-bold uppercase text-emerald-800 bg-emerald-50 px-2 py-0.5 rounded border border-emerald-200">पर्यावरण सेना</span>
            <h4 class="font-serif text-base font-bold text-stone-900 mt-2 group-hover:text-emerald-800 transition-colors">
              हरियाली अभियान ('ग्रीन गैंग' एवं 'ग्रीन मॉर्निंग')
            </h4>
            <p class="text-xs text-stone-600 mt-1.5 line-clamp-2">
              विश्व पर्यावरण दिवस पर गठित पर्यावरण सेना, वृक्षारोपण और ग्रीन अभिवादन संस्कृति।
            </p>
          </div>
          <span class="text-xs font-bold text-emerald-700 flex items-center gap-1 mt-4 group-hover:translate-x-1 transition-transform">
            <span>विस्तार से पढ़ें</span>
            <span class="material-symbols-outlined text-[14px]">arrow_forward</span>
          </span>
        </a>

        <!-- Related 2: Sardar Patel Abhiyan -->
        <a href="<?= e(base_url('/sardar-patel-ekta')) ?>" class="group bg-white rounded-2xl p-5 border border-stone-200 hover:border-amber-400 shadow-sm hover:shadow-md transition-all flex flex-col justify-between">
          <div>
            <span class="text-[10px] font-bold uppercase text-amber-800 bg-amber-50 px-2 py-0.5 rounded border border-amber-200">राष्ट्रीय एकता</span>
            <h4 class="font-serif text-base font-bold text-stone-900 mt-2 group-hover:text-amber-800 transition-colors">
              सरदार पटेल अभियान (सरदार पटेल समाजोत्थान ट्रस्ट)
            </h4>
            <p class="text-xs text-stone-600 mt-1.5 line-clamp-2">
              लौह पुरुष सरदार पटेल के सिद्धांतों, 31 अक्टूबर दीपोत्सव, 12 उद्देश्य एवं अखंड भारत संकल्प।
            </p>
          </div>
          <span class="text-xs font-bold text-amber-800 flex items-center gap-1 mt-4 group-hover:translate-x-1 transition-transform">
            <span>विस्तार से पढ़ें</span>
            <span class="material-symbols-outlined text-[14px]">arrow_forward</span>
          </span>
        </a>

        <!-- Related 3: Gauraiya Bachao Abhiyan -->
        <a href="<?= e(base_url('/gauraiya-bachao-abhiyan')) ?>" class="group bg-white rounded-2xl p-5 border border-stone-200 hover:border-amber-400 shadow-sm hover:shadow-md transition-all flex flex-col justify-between">
          <div>
            <span class="text-[10px] font-bold uppercase text-amber-800 bg-amber-50 px-2 py-0.5 rounded border border-amber-200">पक्षी संवर्धन</span>
            <h4 class="font-serif text-base font-bold text-stone-900 mt-2 group-hover:text-amber-800 transition-colors">
              गौरैया बचाओ अभियान ("छत पर और आँगन में")
            </h4>
            <p class="text-xs text-stone-600 mt-1.5 line-clamp-2">
              मिट्टी के सकोरे, काष्ठ घोंसले एवं बाराबंकी के गांवों-नगरों में परिंदा संरक्षण अलख।
            </p>
          </div>
          <span class="text-xs font-bold text-amber-800 flex items-center gap-1 mt-4 group-hover:translate-x-1 transition-transform">
            <span>विस्तार से पढ़ें</span>
            <span class="material-symbols-outlined text-[14px]">arrow_forward</span>
          </span>
        </a>

      </div>

    </div>
  </section>

</div>

<!-- ========================================================================= -->
<!-- JAVASCRIPT: COPY, SHARE, DIGITAL PLEDGE & INTERACTION                      -->
<!-- ========================================================================= -->
<script>
function copyRegistrationInfo() {
  const regText = `◆ संस्था का नाम: आँखें फाउंडेशन
◆ पंजीकरण संख्या: BAB / 02650 / 2018-19
◆ पंजीकरण दिनांक: 31 जुलाई 2018 (उपनिबंधक, फर्म समितियाँ तथा चिट्स, अयोध्या मंडल, उ.प्र.)
◆ सोसायटी रजिस्ट्रेशन एक्ट 1860 के अंतर्गत पंजीकृत।
◆ पंजीकृत कार्यालय: ग्राम व पोस्ट पाटमऊ, तहसील- नवाबगंज, जिला- बाराबंकी।
◆ प्रधान-कार्यालय: ग्रीन गैंग रोड, हजाराबाग, बाराबंकी। उत्तर प्रदेश, भारत।
◆ संस्थापक: प्रदीप सारंग (मो. 9919007190)
◆ पूर्व नाम: आँखें इंडिया (शासनादेश सम्मत पूर्ववर्ती गतिविधियों का आगणन व शपथ-पत्र संलग्न)`;

  navigator.clipboard.writeText(regText).then(() => {
    showToastNotification('आँखें फाउंडेशन पंजीकरण व कार्यालय विवरण कॉपी हो गया!');
  }).catch(() => {
    prompt('कृपया विवरण कॉपी करें:', regText);
  });
}

function copyEcoGiftingMessage() {
  const msg = `🌱 स्वागत में माला-फूल नहीं, "गमला व पौध" दें!
सरकारी व गैर-सरकारी आयोजनों तथा मांगलिक अवसरों पर पौधरोपण व ईको-गिफ्टिंग की स्वस्थ परम्परा अपनाएं।
— आँखें फाउंडेशन एवं ग्रीन गैंग (प्रदीप सारंग, मो. 9919007190)
https://pradeepsarang.in/aankhein-foundation`;

  navigator.clipboard.writeText(msg).then(() => {
    showToastNotification('गमला व पौध संदेश कॉपी कर लिया गया!');
  }).catch(() => {
    prompt('कृपया संदेश कॉपी करें:', msg);
  });
}

function takeDigitalGreenPledge() {
  const successCard = document.getElementById('greenPledgeSuccessCard');
  const btnLabel = document.getElementById('greenPledgeBtnLabel');
  const btn = document.getElementById('takeGreenPledgeBtn');

  if (successCard) {
    successCard.classList.remove('hidden');
    successCard.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
  }

  if (btnLabel && btn) {
    btnLabel.textContent = 'हरित संकल्प स्वीकृत (ग्रीन मॉर्निंग!)';
    btn.style.backgroundColor = '#064e3b';
  }

  showToastNotification('ग्रीन मॉर्निंग! आपका हरित संकल्प दर्ज हुआ।');
}

function copyGreenPledgeText() {
  const pledgeText = `आँखें फाउंडेशन — हरित संकल्प-पत्र
===================================
1. "जल और जंगल" के संरक्षण को अपना नैतिक एवं राष्ट्रीय कर्तव्य मानेंगे।
2. बाराबंकी की नदियों (गोमती, घाघरा, रेठ, कल्याणी) तथा जमुरिया जैसे जलस्रोतों को स्वच्छ व अविरल रखेंगे।
3. दैनिक जीवन में 'ग्रीन मॉर्निंग' बोलकर हरियाली के प्रति प्रेम (Greenery Liking) का संचार करेंगे।
4. परिंदों के लिए छतों पर मिट्टी के सकोरों में दाना-पानी रखेंगे।
5. स्वागत में माला-फूल के स्थान पर "गमला व पौध" भेंट करेंगे।

ग्रीन मॉर्निंग • जय प्रकृति
आँखें फाउंडेशन (प्रदीप सारंग, संस्थापक • 9919007190)
https://pradeepsarang.in/aankhein-foundation`;

  navigator.clipboard.writeText(pledgeText).then(() => {
    showToastNotification('हरित संकल्प-पत्र कॉपी कर लिया गया!');
  }).catch(() => {
    prompt('कृपया संकल्प कॉपी करें:', pledgeText);
  });
}

function shareGreenPledgeWhatsApp() {
  const msg = encodeURIComponent(`*आँखें फाउंडेशन — हरित संकल्प*\n\n"जल और जंगल का संरक्षण ही धरती का जीवन है"\n\n• स्वागत में माला-फूल नहीं, गमला व पौध भेंट करें!\n• 'ग्रीन मॉर्निंग' बोलें व हरियाली के प्रति प्रेम जगाएं!\n• 4 नदियों व जमुरिया नाला (जम्बू-नद) पुनरुद्धार की अधिकृत गाथा पढ़ें:\nhttps://pradeepsarang.in/aankhein-foundation\n\n— प्रदीप सारंग (संस्थापक, आँखें फाउंडेशन | 9919007190)`);
  window.open(`https://api.whatsapp.com/send?text=${msg}`, '_blank');
}

function shareJamuriyaRevival() {
  const msg = encodeURIComponent(`*जमुरिया नाला (जम्बू-नद) ऐतिहासिक पुनरुद्धार*\n\nबाराबंकी के इतिहासकारों ने जिसे जम्बू-नद बताया, उस जमुरिया नाले की आँखें फाउंडेशन द्वारा जिला प्रशासन व नगर पालिका परिषद के सहयोग से वृहद सफाई कराई गई। आज यह नाला पुनः नदी की शक्ल में बह रहा है!\n\nविस्तृत पढ़ें:\nhttps://pradeepsarang.in/aankhein-foundation`);
  window.open(`https://api.whatsapp.com/send?text=${msg}`, '_blank');
}

function shareGreenMorningGreeting() {
  const msg = encodeURIComponent(`🌱 *ग्रीन मॉर्निंग!* 🌿\n\nगुड मॉर्निंग के स्थान पर 'ग्रीन मॉर्निंग' बोलें और दिल-दिमाग में हरियाली के प्रति प्रेम जगाएं।\n\nआँखें फाउंडेशन व ग्रीन गैंग की हरित मुहिम:\nhttps://pradeepsarang.in/aankhein-foundation`);
  window.open(`https://api.whatsapp.com/send?text=${msg}`, '_blank');
}

function shareAchievementNotice() {
  const msg = encodeURIComponent(`🏆 *बड़ी उपलब्धि: जिला गंगा समिति बाराबंकी में नामित सदस्य*\n\n"जल और जंगल" संरक्षण के कार्यों के आधार पर आँखें फाउंडेशन व ग्रीन गैंग प्रतिनिधि के रूप में संस्थापक श्री प्रदीप सारंग को जिलाधिकारी बाराबंकी द्वारा जिला गंगा समिति में नामित सदस्य का दायित्व सौंपा गया।\n\nhttps://pradeepsarang.in/aankhein-foundation`);
  window.open(`https://api.whatsapp.com/send?text=${msg}`, '_blank');
}

function shareFoundationPage() {
  if (navigator.share) {
    navigator.share({
      title: 'आँखें फाउंडेशन — पंजीकरण, इतिहास व नदी पुनरुद्धार अभियान',
      text: 'आँखें फाउंडेशन: बाराबंकी की 4 नदियाँ, जमुरिया पुनरुद्धार एवं ग्रीन गैंग',
      url: window.location.href,
    }).catch(() => {});
  } else {
    shareGreenPledgeWhatsApp();
  }
}

function showToastNotification(msg) {
  let toast = document.getElementById('greenToastNotification');
  if (!toast) {
    toast = document.createElement('div');
    toast.id = 'greenToastNotification';
    toast.className = 'fixed bottom-6 right-6 bg-emerald-950 text-white px-5 py-3 rounded-2xl shadow-2xl text-xs font-bold z-[9999] border border-emerald-500/50 flex items-center gap-2 transform transition-all duration-300 translate-y-10 opacity-0 pointer-events-none';
    document.body.appendChild(toast);
  }
  toast.innerHTML = `<span class="material-symbols-outlined text-emerald-400 text-base">check_circle</span><span>${msg}</span>`;
  toast.classList.remove('translate-y-10', 'opacity-0', 'pointer-events-none');
  setTimeout(() => {
    toast.classList.add('translate-y-10', 'opacity-0', 'pointer-events-none');
  }, 3000);
}
</script>

