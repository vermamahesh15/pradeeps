<?php
declare(strict_types=1);

$campaigns = $campaigns ?? [];
$phone = trim($settings['phone'] ?? '+91 9919007190');
$phoneClean = preg_replace('/[^+0-9]/', '', $phone);
$email = trim($settings['email'] ?? 'contact@pradeepsarang.in');

// Exact verbatim charter text provided by user - completely unmodified
$rawCharterText = <<<'CHARTER_TEXT'
 ग्रीन गैंग जानकारी, नियम, निर्देश
◆◆◆◆◆◆◆◆◆◆◆◆◆◆◆◆

1- विश्व पर्यावरण दिवस 5 जून 2019 को शहीद उद्यान, बाराबंकी, उत्तर प्रदेश में आँखें फाउण्डेशन (राष्ट्रीय पुनर्जागरण अभियान- आँखें इण्डिया) द्वारा धरती पर कम हो रही प्राणवायु बढ़ाने के लिए एक सामूहिक प्रयास "ग्रीन-गैंग/पर्यावरण सेना" की संकल्पना को साकार किया गया। संस्थापक प्रदीप सारंग जी द्वारा श्री रजत बहादुर वर्मा जी, श्री हरिप्रसाद वर्मा जी, श्री सदानन्द जी, श्री अब्दुल खालिक जी संस्थापक सदस्य/ संचालक सदस्य बनाया गया। यही संचालक मण्डल कहलायेगा।

2- धरती और धरती वासियों के लिए हरियाली संवर्धन से महत्वपूर्ण कोई अभियान नहीं है। धरती पर हरियाली बढ़ेगी तो मनुष्य सहित समस्त प्राणियों के लिए सुखद एवं स्वास्थ्य वातावरण बनेगा और यदि धरती पर हरियाली घटेगी तो मनुष्य सहित समस्त प्राणियों के लिये संकट ही संकट का वातावरण बनेगा।

3- धरती पर हरियाली बढ़ाने हेतु आमजन को आकृष्ट करने के लिए विश्व पर्यावरण दिवस 5 जून 2019 के अवसर पर  सोशल एक्टिविस्ट प्रदीप सारंग जी ने अपने बालों को हरे रंग से रंगवाया। अनेक लोगों ने विशेष कर महिला सदस्यों ने अपने हाथों पर हरे पेड़ के टैटू बनवाये।

 4- शहीद पार्क, देवा रोड, बाराबंकी उत्तर प्रदेश में बैठकर 111 लोगों ने सर्व सहमति से "ग्रीन गैंग/ पर्यावरण सेना" बनाकर धरती पर हरियाली बढ़ाने का संकल्प लिया। एक पेड़ लगाकर शुरुआत की गई। 

5- जून 2026 में निर्णय लिया गया कि ग्रीन गैंग/पर्यावरण सेना का नाम बदलकर सिर्फ "ग्रीन गैंग" किया जाए। यानी अब आगे से सिर्फ ग्रीन गैंग लिखा जाएगा।

6- आप सभी सज्जनों से  विनम्र निवेदन है कि आप भी धरती पर हरियाली बढ़ाने की इस मुहिम "ग्रीन-गैंग" में शामिल होकर हरियाली वातारण बनाने में सहयोग करें। साथ ही हरियाली के इस सामूहिक प्रयास में हिस्सेदार बनें।
 
7- "ग्रीन गैंग" कुछ संकल्पवान साथियों का एक समूह है। जो धरती पर हरियाली बढ़ाने के लिए कुछ काम कर रहा है। इसमें किसी भी को जोड़ा जा सकेगा जो निम्न 5 बातों पर पूर्णतया सहमत होता हो-

8- जो संकल्प ले कि "पेड़ लगाएंगे, पेड़ लगवाएंगे, पेड़ बचाएंगे"

9- जो प्रेरित होकर मन से स्वीकार कर ले कि धरती पर हरियाली घटेगी तो मनुष्य सहित समस्त प्राणियों के लिए संकट और दुखद वातावरण तैयार होगा। और अगर धरती पर हरियाली बढ़ेगी तो मनुष्य सहित समस्त प्राणियों के लिए सुखद व स्वास्थ्य परक वातावरण तैयार होगा।

10- जो यह संकल्प ले कि देश के प्रधानमंत्री जी से लेकर ग्राम प्रधान जी तक, पुलिस से लेकर वन विभाग तक कोई क्या करता है हम विचलित नहीं होंगे, और न ही इनसे लड़ाई लड़ेंगे न ही शिकायत करेंगे। सिर्फ इन्हें  प्रेरित करने की कोशिश की जाएगी। असल ये है कि धरती पर हरियाली बढ़ाने के लिए हम स्वयं क्या कर सकते हैं सिर्फ वही करेंगे।

11- जो ये संकल्प ले कि पर्यावरण सेना अथवा ग्रीन गैंग व्हाट्सएप ग्रुप अथवा एप में स्वयं अथवा पर्यावरण सैनिकों की सिर्फ पर्यावरण गतिविधियों व उसकी निजी गतिविधियों के अतिरिक्त अन्य कोई भी कटपेस्ट जैसे ज्ञानवर्धक मेसेज सेंड नहीं करेंगे।

12- जो अपने जन्मदिन पर कम से कम एक वृक्ष जरूर रोपित करने का संकल्प ले सके।

13- "पेड़ लगाएंगे, पेड़ लगवाएंगे, पेड़ बचाएंगे" का संकल्प लेने वाला कोई भी, "ग्रीन-गैंग" का सदस्य बनकर, अपने एकल अथवा सामूहिक प्रयासों से धरती को हर भरा बना सकेगा।
सरकारी/अर्धसरकारी विभाग, सामाजिक संस्था, संगठन, ट्रेड यूनियन, स्कूल, कालेज, अस्पताल, एन एस एस, स्काउट, एन सी सी, युवक मंगल दल, एन वाई के,  साहित्य, पत्रकारिता, किसान सहित किसी भी पेशा/कार्य व्यवसाय से जुड़े लोग "उद्देश्य" से प्रेरित होकर तथा नियम/निर्देश से सहमत होकर, हरियाली बढ़ाने की इस मुहिम "ग्रीन-गैंग" का हिस्सा बन सकेंगे।

14- ग्रीन गैंग संसार की पहली ऐसी सेना है जिसके पर्यावरण-सैनिक पूर्णतया प्रतिबन्धों से मुक्त है और उसकी पहली जंग खुद से है।
ग्रीन गैंग एक मूवमेंट है इसलिए इसमें समय का कोई प्रतिबन्ध नहीं है जिसके पास जब जितना समय हो उतना काम करे। जब न हो समय, तो कोई शिकवा शिकायत नहीं। दरअसल इस मुहिम की कुछ अलग तरह की  विशेषताएं हैं।

15- हर एक को अपना लक्ष्य स्वयं ही तय करना है फिर उसे पाने की कोशिश करनी है। लोग सहयोग करेंगे।

16- ग्रीन गैंग का उद्देश्य समस्त पृथ्वी वासियों में हरियाली को लेकर पसंदगी और आदत में बदलाव लाना है। हरियाली को लेकर जिम्मेदारी का एहसास कराकर धरती पर हरियाली बढ़ाने के लिए स्वयं-संकल्पित कराना है।

17- सक्रिय सदस्य की ऊर्जा-शक्ति और ज्ञान-शक्ति का निरन्तर सकारात्मक व रचनात्मक उपयोग हेतु मार्ग प्रशस्त करना है।

18- सक्रिय सदस्य के आचरण व्यवहार और मन मस्तिष्क से नकारात्मक/निगेटिव तत्वों को शून्य स्थिति तक पहुँचाना है।

19- सक्रिय सदस्य के मन, मष्तिष्क में अवस्थित "राँग -अण्डर-स्टैंडिग्स/भ्रामक समझ" को समाप्त कर "राइट-अण्डर-स्टैंडिग्स/सर्वोचित समझ" स्थापित करना है। 

 20- सच में "ग्रीन गैंग" एक हरियाली मुहिम है, एक बहुत बड़ा जन-आंदोलन है। इस मुहिम का सदस्य स्वयं अपना लक्ष्य तय करेगा। 

       21- ग्रीन गैंग के उद्देश्य, अथवा लक्ष्य से प्रेरित होकर, नियम निर्देश अनुशासन, स्वीकार कर, स्वेच्छा से हर एक को जुड़ना है। सदस्य को कार्य करने के लिए कोई समय निर्धारित नहीं है। जब जिसे समय मिले कार्य करे। 

       22- जो नेतृत्व संभालेंगे यानी समन्वयक होंगे उनके दायित्व कुछ बढ़ जाएंगे। उन्हें अन्य से अधिक समय देना रहेगा।
       
       23- विशेष ध्यान कराना होगा कि ग्रीन गैंग के किसी भी आयोजन, बैठक, कार्यक्रम में कतई आना-जाना अनिवार्य नहीं है किन्तु आने या न आने की सूचना "ग्रीन गैंग" ग्रुप /पेज पर अवश्य पोस्ट करें। जो जितना अधिक समय देगा वह उतना ही अधिक मुहिम को समझ सकेगा, और इसी अनुरूप उतना ही अधिक योगदान हो सकेगा।
       
 24- ग्रीन गैंग के किसी ग्रुप पर अपनी गतिविधियों और अपने विचारों के अलावा कटपेस्ट जैसे कोई भी मैसेज भेजना मना रहेगा। सिर्फ ग्रीन गैंग की गतिविधियों से सम्बन्धित मैसेज, फोटो ही पोस्ट करने की अनुमति रहेगी। आपको कोई मैसेज बहुत अच्छा लगता है तो पर्सनल व्हाट्सएप पर भेजिए, किन्तु ग्रीन गैंग ग्रुप पर बिल्कुल नहीं। अपेक्षा है आप अच्छे व सच्चे सदस्य की तरह कार्य करेंगे। आप खुश हो जाइए कि आप पृथ्वी ग्रह की सबसे महत्वपूर्ण मुहिम से जुड़े हैं। 

25-  हम सदस्य-गण अपने द्वारा किये गए पर्यावरणीय कार्य अपने द्वारा लिखे गए पर्यावरणीय लेख/गीत/कहानी/आलेखन/गतिविधियाँ/अखबार कतरन इत्यादि की ही पोस्ट ग्रीन गैंग व्हाट्सएप ग्रुप पर डालेंगें। पेड़ में पानी डालते हुए, निराई करते हुए, ऐसे ही कार्य की फोटो पोस्ट कर सकते हैं। किसी को पर्यावरण  सेना के बारे में समझाते हुए/ योजना बनाते हुए फोटो पोस्ट कर सकते हैं।

26- ध्यान रखने योग्य दूसरी बात ये है कि जिस प्रकार आपको ग्रीन गैंग के बारे में समझाने के बाद आप द्वारा स्वीकार कर लिए जाने के बाद ही ग्रीन गैंग से जोड़ा गया है उसी प्रकार किसी को भी बिना पढ़ाये, समझाए, तथा उसके द्वारा बिना स्वीकार किये, न जोड़ा जाए।

27- ग्रीन गैंग/पर्यावरण सेना को भीड़ नहीं चाहिए,,, चाहिए पर्यावरण प्रेमी। जो भी सज्जन जुड़ेंगे वो पर्यावरण प्रेमी बन जाएंगे। 

  28- बिना अनुमति कोई भी ग्रीन गैंग का व्हाट्सएप ग्रुप नहीं बनाएगा। 

  29- "ग्रीन गैंग" का हर स्तर पर व्हाट्सएप ग्रुप बनाया जाना है। इन ग्रुप में अपने द्वारा किये जाने वाले हरियाली सम्बन्धी कार्यों का विवरण फोटो आदि पोस्ट करनी है।

30- इस ग्रुप का उपयोग सिर्फ निम्न कार्य में ही करें--
 निर्देश प्राप्त करने के लिए। सुझाव देने के लिए। राय मशविरा के लिए। एक दूसरे को विशेष मौकों पर बधाई देने के लिए।

31- विशेष निर्देश है कि प्रत्येक स्तर के समन्यवयक गण उच्च ग्रुप से जरूरी मैसेज या स्टिकर्स कॉपी करेंगें तथा अपने ग्रुप पर पेस्ट करेंगें। ताकि प्रशासनिक अथवा राज्य स्तर से भेजे जाने वाले मेसेज आदि ग्राम और मुहल्ला स्तर  के ग्रुप तक पहुँच सकें।

32- प्रत्येक स्तर पर अध्यक्ष नामित किया जाना है। अध्यक्ष का दायित्व है कि अपने कार्य क्षेत्र में सदस्य बनाता रहे। लोगों को प्रेरित करता रहे। प्रत्येक अध्यक्ष एक व्हाट्सएप ग्रुप चलाएगा। जिसमें कार्यक्षेत्र के सदस्यों को जोड़ा जाएगा। प्रत्येक सदस्य तक जरुरी सन्देश, जरूरी जानकारी पहुँच सकें, इस हेतु अध्यक्ष अपने उच्च व्हाट्सएप ग्रुप से उपयोगी सामग्री कॉपी करके अपने द्वारा संचालित ग्रुप में पोस्ट करेगा।

 33- अध्यक्ष गण सभी को जानकारी देंगे कि ग्रीन मॉर्निंग/हरित प्रभात, ग्रीन इवनिंग, ग्रीन नाईट आदि के मैसेज या बनाये गए चित्र भेज सकते हैं। किसी को जन्मदिन इत्यादि खुशी उल्लास या यादगार पलो में शुभकामनाएं दी जा सकती हैं।

34- अध्यक्ष गण सभी को जानकारी देंगें कि जब भी व्हाट्सएप पर  मेसेज भेजें तो अपना नाम, पद नाम पता जरूर लिखें क्योंकि सभी ने आपके नाम नम्बर फीड नही किये जा सकते हैं। बिना नाम पदनाम पता के पहचान नही मिल पाता है कि किसने क्या भेजा है।

35- अध्यक्ष गण सभी को जानकारी देंगे कि अपने द्वारा पेड़ लगाते हुए, पेड़ गिफ्ट देते, लेते हुए चित्र,  पूर्व से लगाये गए पेड़ों की देखभाल करते हुए, निराई करते हुए, पानी देते हुए आदि फोटो पोस्ट करते रहें।

36- ग्रीन गैंग का प्रत्येक सदस्य गुड मॉर्निंग के स्थान पर ग्रीन मॉर्निंग, सुप्रभात या शुभ प्रभात के स्थान पर हरित प्रात व हरित प्रभात, लिखेगा बोलेगा। यही ग्रीन गैंग के कल्चर की अपनी विशेष पहचान होगी।

37- ग्रीन=हरा और हरा का अर्थ होता है खुशहाली और सुख समृद्धि संपन्नता। भारत देश के राष्ट्रीय ध्वज में प्रयुक्त हरा रंग भी यही अर्थ देता है।

38- बिहारी जी का एक दोहा है-
मेरी भव बाधा हरो, राधा नागरि सोय।
जा तन की झाईं पड़े, श्याम हरित दुति होय।।
     हिंदी के प्रसिद्ध लेखक बिहारी जी ने भी हरित-दुति का अर्थ प्रसन्न मुद्रा से लगाया है।
     राधा गोरी है यानी पीली हैं। श्याम नीले, सांवरे रँग के हैं। बिहारी जी ने लिखा है कि जब राधा की परछाई पड़ती है तो श्याम यानी कृष्ण भी प्रसत्र हो जाया करते हैं।  वैसे भी नीला+ पीला रंग मिलने पर हरा रंग बनकर तैयार होता है।

39- फूलों और पेड़ों की तरह मनुष्य के चेहरे के लिए भी "खिला है, मुरझाया है" बोला जाता है। इसका भी अर्थ खिला यानी हर भरा यानी प्रसन्न है। हरियाली कम यानी मुरझाया हुआ है, यानी प्रसन्नता कम।

40- अंग्रेजी में प्रायः बोला जाता है- एवरग्रीन/Evergreen. इसका अर्थ है सदाबहार यानी सदैव हरा भरा रहने वाला। मनुष्य के सदाबहार अथवा हरा भरा रहने से मतलब है खुशहाल/प्रसन्न रहना।

 41-ग्रीन गैंग/पर्यावरण सेना नियम निर्देश की धारा जे (38 से 43) द्वारा सिद्ध हो जाता है कि गुड मॉर्निंग का अर्थ सिर्फ सुप्रभात अथवा शुभ प्रभात होगा, जबकि ग्रीन मॉर्निंग का अर्थ हरित प्रभात यानी खुशहाल प्रात अथवा सुख सम्पन्न प्रात/प्रभात होगा।

42- हमें विश्वास है कि आप सभी जिम्मेदार हैं, जिम्मेदारी का परिचय देते हुए किसी व्हाट्सएप ग्रुप Green Gang  का दुरुपयोग नहीं करगें। नियम निर्देश का पालन करेंगे। अनुशासन उलंघन नहीं करेंगे।

43- ग्रीन गैंग की नियमावली (जनकारी, नियम, निर्देश) से पूर्णतया सहमत व्यक्ति ही ग्रीन गैंग का सदस्य हो सकता है। अतः यदि आप सहमत नहीं हैं तो आप स्वयं बाहर हो जाएं। क्योंकि बारम्बार अनुशासन उल्लंघन करने पर सदस्यता समाप्ति की कार्यवाही की जाएगी एवं आवश्यक होने पर पुलिस को भी सूचना दी जाएगी।
  
◆◆प्रदीप सारंग- संस्थापक◆◆
ग्रीन-गैंग/पर्यावरण सेना, भारत गणराज्य।
CHARTER_TEXT;

// Parse the 43 individual points exactly as written for structured presentation
preg_match_all("/(?:\r?\n|^)\s*(\d+)\s*[-–]\s*([\s\S]*?)(?=(?:\r?\n\s*\d+\s*[-–])|(?:\r?\n\s*◆◆)|$)/u", $rawCharterText, $parsedCharterPoints, PREG_SET_ORDER);
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
        <span class="text-deep-forest font-semibold"><?= e(ps_text('ग्रीन गैंग अभियान (Green Gang Movement)', 'Green Gang Movement')) ?></span>
      </nav>

      <!-- Badge & Main Title -->
      <div class="max-w-4xl">
        <div class="inline-flex items-center gap-2 bg-primary-fixed/40 text-deep-forest px-3.5 py-1 rounded-full font-label-sm text-label-sm mb-space-sm border border-border-warm font-semibold">
          <span class="material-symbols-outlined text-[15px] text-primary-container" style="font-variation-settings: 'FILL' 1;">eco</span>
          <span><?= e(ps_text('5 जून 2019 (विश्व पर्यावरण दिवस) से निरंतर गतिशील क्रांति', 'Grassroots Revolution Since 5th June 2019')) ?></span>
        </div>
        <h1 class="font-display-hero text-headline-lg md:text-display-hero text-deep-forest leading-tight tracking-tight font-bold">
          <?= e(ps_text('ग्रीन गैंग: हरियाली क्रांति, पौधरोपण एवं \'ग्रीन मॉर्निंग\' का अभिनव संस्कार', 'Green Gang: Grassroots Tree Protection & Green Morning Heritage')) ?>
        </h1>
        <p class="font-body-lg text-body-lg text-text-muted mt-space-sm max-w-3xl leading-relaxed">
          <?= e(ps_text('प्रदीप सारंग द्वारा संस्थापित \'ग्रीन गैंग\' आंदोलन — 50,000+ बरगद, पीपल, नीम और पाकड़ के वृक्षों का रोपण एवं 150+ गांवों व 100+ विद्यालयों में दैनिक प्रकृति-प्रेम का संस्कार।', 'A community-led movement transforming greetings into tree conservation, planting over 50,000 native shade trees across Awadh.')) ?>
        </p>

        <!-- Quick Jump Buttons -->
        <div class="flex flex-wrap items-center gap-3 mt-6">
          <a href="#charter-scroll-section" class="inline-flex items-center gap-2 px-6 py-3 rounded-full bg-deep-forest hover:bg-forest-night text-pure-white font-label-md text-label-md font-bold shadow-md hover:shadow-lg transition-all transform hover:-translate-y-0.5">
            <span class="material-symbols-outlined text-[20px] text-gold">history_edu</span>
            <span><?= e(ps_text('📜 सम्पूर्ण संकल्प-पत्र व नियमावली पढ़ें', 'Read Official Charter')) ?></span>
          </a>
          <a href="#green-morning-philosophy" class="inline-flex items-center gap-2 px-6 py-3 rounded-full bg-primary hover:bg-primary-hover text-pure-white font-label-md text-label-md font-bold shadow-md transition-all transform hover:-translate-y-0.5">
            <span class="material-symbols-outlined text-[18px] text-primary-fixed">spa</span>
            <span><?= e(ps_text('ग्रीन मॉर्निंग वैचारिकी व 6 तर्क', 'Green Morning Ethos & 6 Arguments')) ?></span>
          </a>
          <a href="#join-green-gang-section" class="inline-flex items-center gap-2 px-6 py-3 rounded-full bg-surface-container-low hover:bg-pure-white text-deep-forest border border-border-warm font-label-md text-label-md font-semibold transition-all">
            <span class="material-symbols-outlined text-[18px] text-primary">group_add</span>
            <span><?= e(ps_text('ग्रीन गैंग से जुड़ें', 'Join Green Gang')) ?></span>
          </a>
        </div>
      </div>
    </div>
  </section>

  <!-- 4 High-Impact Metric Summary Ribbon -->
  <section class="w-full bg-deep-forest text-pure-white py-space-xl">
    <div class="max-w-container-max mx-auto px-4 sm:px-8">
      <div class="grid grid-cols-2 md:grid-cols-4 gap-6 text-center">
        <div class="flex flex-col p-5 rounded-2xl bg-surface-container-low/10 border border-surface-container-high/15">
          <span class="material-symbols-outlined text-fresh-sprout text-[36px] mb-2 mx-auto">park</span>
          <span class="font-headline-lg text-headline-lg text-primary-fixed leading-tight font-bold">50,000+</span>
          <span class="font-title-md text-title-md text-surface-container-high font-semibold mt-1"><?= e(ps_text('वृक्षारोपण व संरक्षण', 'Trees Planted')) ?></span>
          <span class="font-label-sm text-label-sm text-surface-container-high/80 mt-1"><?= e(ps_text('बरगद, पीपल, नीम व पाकड़', 'Native Banyan & Peepal')) ?></span>
        </div>

        <div class="flex flex-col p-5 rounded-2xl bg-surface-container-low/10 border border-surface-container-high/15">
          <span class="material-symbols-outlined text-primary-fixed text-[36px] mb-2 mx-auto">school</span>
          <span class="font-headline-lg text-headline-lg text-primary-fixed leading-tight font-bold">100+</span>
          <span class="font-title-md text-title-md text-surface-container-high font-semibold mt-1"><?= e(ps_text('स्कूलों में \'ग्रीन मॉर्निंग\'', 'Green Morning Schools')) ?></span>
          <span class="font-label-sm text-label-sm text-surface-container-high/80 mt-1"><?= e(ps_text('दैनिक पर्यावरण संस्कार', 'Daily Eco Ritual')) ?></span>
        </div>

        <div class="flex flex-col p-5 rounded-2xl bg-surface-container-low/10 border border-surface-container-high/15">
          <span class="material-symbols-outlined text-tertiary-fixed text-[36px] mb-2 mx-auto">cottage</span>
          <span class="font-headline-lg text-headline-lg text-tertiary-fixed leading-tight font-bold">150+</span>
          <span class="font-title-md text-title-md text-surface-container-high font-semibold mt-1"><?= e(ps_text('गाँव व पंचायतें', 'Villages Reached')) ?></span>
          <span class="font-label-sm text-label-sm text-surface-container-high/80 mt-1"><?= e(ps_text('बाराबंकी व फैज़ाबाद अंचल', 'Barabanki & Ayodhya')) ?></span>
        </div>

        <div class="flex flex-col p-5 rounded-2xl bg-surface-container-low/10 border border-surface-container-high/15">
          <span class="material-symbols-outlined text-secondary-fixed text-[36px] mb-2 mx-auto">verified_user</span>
          <span class="font-headline-lg text-headline-lg text-secondary-fixed leading-tight font-bold">85%+</span>
          <span class="font-title-md text-title-md text-surface-container-high font-semibold mt-1"><?= e(ps_text('पौध जीवित दर', 'Sapling Survival Rate')) ?></span>
          <span class="font-label-sm text-label-sm text-surface-container-high/80 mt-1"><?= e(ps_text('सुरक्षा ट्री-गार्ड एवं सिंचाई', 'Protected with Tree-Guards')) ?></span>
        </div>
      </div>
    </div>
  </section>

  <!-- ========================================================================= -->
  <!-- SPECIAL SECTION: LETTER ROLL TIED TO RIBBON (OFFICIAL CHARTER & RULES)   -->
  <!-- ========================================================================= -->
  <section id="charter-scroll-section" class="relative w-full bg-gradient-to-b from-[#f4eee1] via-[#faf6ed] to-[#f4eee1] py-16 md:py-24 border-b border-border-warm overflow-hidden">
    <!-- Ambient Heritage Background Flourish -->
    <div class="absolute inset-0 opacity-[0.035] pointer-events-none" style="background-image: radial-gradient(#14532d 1px, transparent 1px); background-size: 24px 24px;"></div>
    
    <div class="max-w-5xl mx-auto px-4 sm:px-6 relative z-10">
      <!-- Section Title & Narrative Intro -->
      <div class="text-center max-w-3xl mx-auto mb-10 md:mb-12">
        <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-deep-forest/10 text-deep-forest font-label-sm text-xs md:text-sm font-bold tracking-wider uppercase mb-3 border border-deep-forest/20">
          <span class="material-symbols-outlined text-[17px] text-primary">history_edu</span>
          <span>आधिकारिक घोषणा-पत्र • OFFICIAL CHARTER & RULES</span>
        </div>
        <h2 class="font-display-hero text-headline-md md:text-headline-lg text-deep-forest font-bold tracking-tight">
          ग्रीन गैंग: जानकारी, नियम एवं निर्देश संकल्प-पत्र
        </h2>
        <p class="font-body-md text-body-md text-text-muted mt-3 leading-relaxed">
          5 जून 2019 को शहीद उद्यान बाराबंकी में 111 संकल्पवान साथियों द्वारा अंगीकृत एवं संस्थापक प्रदीप सारंग जी द्वारा प्रख्यापित 43 स्वर्णिम नियम।
        </p>
      </div>

      <!-- MAIN COMPONENT: SACRED CHARTER SCROLL (ALWAYS OPEN) -->
      <div id="ps-letter-scroll-wrapper" class="w-full">
        
        <!-- Sticky / Prominent Control Toolbar -->
        <div class="sticky top-20 z-40 mb-6 bg-pure-white/95 backdrop-blur-md rounded-2xl p-3 sm:p-4 shadow-lg border border-border-warm flex flex-wrap items-center justify-between gap-3">
          <div class="flex items-center gap-2">
            <button type="button" onclick="copyFullCharterText()" class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl bg-primary-fixed/40 hover:bg-primary-fixed text-deep-forest font-label-md text-sm font-bold transition-all border border-border-warm cursor-pointer" title="सम्पूर्ण मूल पाठ कॉपी करें">
              <span class="material-symbols-outlined text-[18px]">content_copy</span>
              <span id="ps-copy-btn-text">पूरा पाठ कॉपी करें</span>
            </button>

            <button type="button" onclick="window.print()" class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl bg-surface-container hover:bg-border-warm text-deep-forest font-label-md text-sm font-semibold transition-all border border-border-warm cursor-pointer" title="प्रिंट करें">
              <span class="material-symbols-outlined text-[18px]">print</span>
              <span>प्रिंट (Print)</span>
            </button>
          </div>

          <div class="flex items-center gap-2">
            <!-- Quick Rule Search Input -->
            <div class="relative w-56 sm:w-72">
              <span class="material-symbols-outlined absolute left-2.5 top-1/2 -translate-y-1/2 text-[18px] text-text-muted">search</span>
              <input type="text" id="charter-rule-search" oninput="filterCharterRules(this.value)" placeholder="नियम खोजें (उदा. 38, जन्मदिन, व्हाट्सएप)..." class="w-full bg-soft-meadow border border-border-warm text-on-surface pl-8 pr-3 py-1.5 rounded-xl text-xs sm:text-sm font-body-md focus:outline-none focus:ring-2 focus:ring-primary-container">
            </div>
          </div>
        </div>

        <!-- The Majestic Parchment Document Container (Always Open) -->
        <div class="ps-unrolled-scroll-paper relative bg-[#fffdf7] rounded-3xl p-6 sm:p-12 md:p-16 shadow-2xl border-4 border-[#b48a3c] overflow-hidden">
            
            <!-- Traditional Ornate Corner Borders (SVG) -->
            <div class="ps-corner-ornament ps-corner-tl pointer-events-none"></div>
            <div class="ps-corner-ornament ps-corner-tr pointer-events-none"></div>
            <div class="ps-corner-ornament ps-corner-bl pointer-events-none"></div>
            <div class="ps-corner-ornament ps-corner-br pointer-events-none"></div>

            <!-- Top Decorative Wooden Scroll Bar -->
            <div class="ps-scroll-top-bar flex items-center justify-between mb-8 pb-4 border-b-2 border-[#d4af37]/40">
              <div class="w-8 sm:w-12 h-3 bg-gradient-to-r from-[#5a3818] via-[#ca8a04] to-[#5a3818] rounded-full"></div>
              <div class="flex items-center gap-2 text-[#78350f] font-serif text-xs sm:text-sm font-semibold tracking-wider">
                <span>✦</span>
                <span>श्री गणेशाय नमः • हरियाली ही जीवन है</span>
                <span>✦</span>
              </div>
              <div class="w-8 sm:w-12 h-3 bg-gradient-to-r from-[#5a3818] via-[#ca8a04] to-[#5a3818] rounded-full"></div>
            </div>

            <!-- Document Official Letterhead Header (EXACT UNMODIFIED TEXT) -->
            <div class="text-center max-w-2xl mx-auto mb-10">
              <div class="w-16 h-16 sm:w-20 sm:h-20 mx-auto mb-4 rounded-full bg-[#14532d] text-[#fef08a] flex flex-col items-center justify-center shadow-lg border-2 border-[#b48a3c]">
                <span class="material-symbols-outlined text-[32px] sm:text-[38px]" style="font-variation-settings: 'FILL' 1;">park</span>
              </div>
              
              <!-- Verbatim Document Title Header -->
              <h1 class="font-display-hero text-2xl sm:text-3xl md:text-4xl text-[#14532d] font-black tracking-tight leading-snug">
                ग्रीन गैंग जानकारी, नियम, निर्देश
              </h1>
              
              <!-- Verbatim Diamonds Motif -->
              <div class="text-[#b48a3c] text-lg sm:text-xl font-bold tracking-[0.3em] my-2 select-none">
                ◆◆◆◆◆◆◆◆◆◆◆◆◆◆◆◆
              </div>
              
              <div class="inline-block bg-[#14532d]/10 border border-[#14532d]/30 text-[#14532d] px-4 py-1 rounded-full text-xs font-serif font-bold mt-1">
                मूल आधिकारिक विधान व आचार संहिता • 43 सूत्र
              </div>
            </div>

            <!-- Verbatim Rules & Directives (Points 1 to 43) -->
            <div id="charter-rules-list" class="space-y-4 font-serif text-[#292524] leading-relaxed text-sm sm:text-base md:text-[17px]">
              <?php foreach ($parsedCharterPoints as $index => $item): 
                $ruleNum = (int)$item[1];
                $ruleBody = trim($item[2]);
                $isVerse = ($ruleNum === 38);
              ?>
                <div class="charter-rule-card group relative p-4 sm:p-5 rounded-2xl transition-all duration-200 border bg-[#fffdf9] border-[#e7dbbe]/70 hover:bg-[#faf5e8]" data-rule-num="<?= $ruleNum ?>">
                  
                  <?php if ($isVerse): ?>
                    <!-- Special Poetic Stanza Styling for Rule 38 (Bihari ji's doha) with uniform colors -->
                    <div class="rule-content-text leading-relaxed">
                      <strong class="font-bold text-[#292524]">38- </strong>बिहारी जी का एक दोहा है-
                      <div class="bg-[#f7efe1] p-4 sm:p-5 rounded-xl border-l-4 border-[#b48a3c] my-3 text-center sm:text-left">
                        <p class="font-bold text-base sm:text-lg text-[#78350f] leading-loose tracking-wide">
                          मेरी भव बाधा हरो, राधा नागरि सोय।<br>
                          जा तन की झाईं पड़े, श्याम हरित दुति होय।।
                        </p>
                      </div>
                      <p class="text-sm sm:text-base text-[#292524] mt-2 leading-relaxed">
                        हिंदी के प्रसिद्ध लेखक बिहारी जी ने भी हरित-दुति का अर्थ प्रसन्न मुद्रा से लगाया है।
                      </p>
                      <p class="text-sm sm:text-base text-[#292524] mt-1.5 leading-relaxed">
                        राधा गोरी है यानी पीली हैं। श्याम नीले, सांवरे रँग के हैं। बिहारी जी ने लिखा है कि जब राधा की परछाई पड़ती है तो श्याम यानी कृष्ण भी प्रसत्र हो जाया करते हैं।  वैसे भी नीला+ पीला रंग मिलने पर हरा रंग बनकर तैयार होता है।
                      </p>
                    </div>
                  <?php else: ?>
                    <!-- Verbatim paragraph with single clean number prefix and uniform ink styling -->
                    <div class="rule-content-text leading-relaxed">
                      <strong class="font-bold text-[#292524]"><?= $ruleNum ?>- </strong><?= nl2br(e($ruleBody)) ?>
                    </div>
                  <?php endif; ?>

                </div>
              <?php endforeach; ?>
            </div>

            <!-- Verbatim Sign-Off & Official Founder Stamp (EXACT UNMODIFIED TEXT) -->
            <div class="mt-12 pt-8 border-t-2 border-[#b48a3c]/40 text-center relative">
              
              <!-- Official Stamp Emblem -->
              <div class="inline-flex flex-col items-center justify-center p-6 sm:p-8 rounded-3xl bg-[#fcf7ec] border-2 border-[#b48a3c] shadow-md max-w-lg mx-auto">
                <div class="text-[#b48a3c] text-base font-bold tracking-widest mb-1">
                  ◆◆◆
                </div>
                
                <!-- Verbatim Sign-Off Line 1 -->
                <div class="font-display-hero text-xl sm:text-2xl text-[#14532d] font-black tracking-wide">
                  ◆◆प्रदीप सारंग- संस्थापक◆◆
                </div>
                
                <!-- Verbatim Sign-Off Line 2 -->
                <div class="font-serif text-sm sm:text-base text-[#78350f] font-bold mt-1.5 tracking-wider">
                  ग्रीन-गैंग/पर्यावरण सेना, भारत गणराज्य।
                </div>

                <div class="mt-4 pt-3 border-t border-[#b48a3c]/30 text-xs text-text-muted font-sans flex items-center justify-center gap-2">
                  <span class="material-symbols-outlined text-[16px] text-primary">verified</span>
                  <span>5 जून 2019 (विश्व पर्यावरण दिवस) • शहीद उद्यान, बाराबंकी</span>
                </div>
              </div>

            </div>

            <!-- Bottom Decorative Wooden Scroll Bar -->
            <div class="ps-scroll-bottom-bar flex items-center justify-between mt-10 pt-4 border-t-2 border-[#d4af37]/40">
              <div class="w-8 sm:w-12 h-3 bg-gradient-to-r from-[#5a3818] via-[#ca8a04] to-[#5a3818] rounded-full"></div>
              <a href="#charter-scroll-section" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-full bg-deep-forest hover:bg-forest-night text-pure-white text-xs sm:text-sm font-bold shadow-md hover:shadow-lg transition-all cursor-pointer">
                <span class="material-symbols-outlined text-[18px]">arrow_upward</span>
                <span>संकल्प-पत्र के शीर्ष पर जाएं (Back to Top)</span>
              </a>
              <div class="w-8 sm:w-12 h-3 bg-gradient-to-r from-[#5a3818] via-[#ca8a04] to-[#5a3818] rounded-full"></div>
            </div>

          </div>

      </div>

      </div>

    </div>
  </section>

  <!-- Dedicated Deep Dive: Green Morning Ideology & The 6 Philosophical Arguments -->
  <section id="green-morning-philosophy" class="w-full bg-soft-meadow py-16 md:py-24 border-b border-border-warm scroll-mt-12">
    <div class="max-w-container-max mx-auto px-4 sm:px-8">
      
      <!-- Section Header -->
      <div class="text-center max-w-3xl mx-auto mb-12 sm:mb-16">
        <div class="inline-flex items-center gap-2 bg-primary-fixed/40 text-deep-forest px-3.5 py-1.5 rounded-full font-label-sm text-label-sm border border-border-warm font-semibold mb-3">
          <span class="material-symbols-outlined text-[18px] text-primary-container">eco</span>
          <span><?= e(ps_text('वैचारिक दर्शन • एक अभिनव अभिवादन क्रांति', 'Ideological Ethos • The Green Greeting Revolution')) ?></span>
        </div>
        <h2 class="font-headline-lg text-headline-md md:text-headline-lg text-deep-forest font-bold tracking-tight">
          <?= e(ps_text('गुड मॉर्निंग की जगह \'ग्रीन मॉर्निंग\' और \'हरित प्रभात\' क्यों...?', 'Why \'Green Morning\' & \'Harit Prabhat\' Instead of \'Good Morning\'...?')) ?>
        </h2>
        <p class="font-body-md text-body-md text-text-muted mt-3 leading-relaxed">
          <?= e(ps_text('विश्व पर्यावरण दिवस 05 जून 2019 से आरम्भ हुई चिंतन यात्रा, संस्थापक सदस्य स्व. हरिप्रसाद वर्मा जी से ऐतिहासिक संवाद और प्रदीप सारंग जी द्वारा खोजे गए 6 अकाट्य दार्शनिक तर्क।', 'The journey of reflection that began on World Environment Day 2019, the dialogue with Late Hari Prasad Verma, and the 6 foundational rationale pillars discovered by Pradeep Sarang.')) ?>
        </p>
      </div>

      <!-- Part 1: Origin & Universal Inclusivity -->
      <div class="bg-pure-white rounded-3xl p-6 sm:p-10 shadow-sm border border-border-warm mb-10">
        <div class="flex items-center gap-3 mb-5 border-b border-border-warm pb-4">
          <div class="w-10 h-10 rounded-xl bg-primary-fixed/30 text-deep-forest flex items-center justify-center shrink-0">
            <span class="material-symbols-outlined text-2xl">spa</span>
          </div>
          <div>
            <h3 class="font-headline-sm text-headline-sm text-deep-forest font-bold">
              <?= e(ps_text('1. उत्पत्ति एवं सर्वसमावेशी अभिवादन की खोज', '1. Inception & The Search for an Inclusive Greeting')) ?>
            </h3>
            <span class="text-xs text-secondary font-semibold uppercase tracking-wider">
              <?= e(ps_text('5 जून 2019 • विश्व पर्यावरण दिवस पर वैचारिक मंथन', '5 June 2019 • World Environment Day Ideation')) ?>
            </span>
          </div>
        </div>

        <div class="space-y-4 font-body-md text-body-md text-on-surface-variant leading-relaxed">
          <p>
            <?= e(ps_text('धरती पर हरियाली बढ़ाने के उद्देश्य से 05 जून 2019 को विश्व पर्यावरण दिवस पर ग्रीन गैंग की स्थापना हो जाने के बाद, इसकी वैचारिकी का साहित्य सृजित करना था। इसी चिन्तन में श्री सारंग के मन मे विचार आया कि क्यों न हरियाली पर काम करने वालों के लिए अलग अभिवादन शैली का विकास किया जाए। जितने धर्म, सम्प्रदाय, वैचारिकी, अस्तित्व और प्रचलन में हैं सभी के अनुयायी स्वतः एक अलग अभिवादन शैली अपनाते हैं। जैसे— जै राम, जै श्रीराम, ऊँ नमः शिवाय, राधे राधे, जय गुरुदेव, आदाब अर्ज, अस्सलाम वालेकुम, सत श्री अकाल, गुड मॉर्निंग, जय जिनेन्द्र, नमो बुद्धाय, जय हिंद, जय सरदार, जय पटेल, जय भीम आदि इत्यादि।', 'Following the foundation of Green Gang on World Environment Day, 05 June 2019 to enhance greenery on earth, shaping its ideological literature was essential. In this contemplation, Pradeep Sarang conceived that environmental champions must possess a unique greeting. Across all faiths, traditions, and ideologies, communities embrace their own distinctive greetings.')) ?>
          </p>
          <p>
            <?= e(ps_text('महीनों चिंतन के बाद यह सुपरिणाम मिला कि एक अलग तरह की अभिवादन शैली का आविष्कार हो। चूँकि हरियाली संवृद्धि में संलग्न लोग विभिन्न लिंग, जाति, धर्म, सम्प्रदाय, राष्ट्रीयता के लोग हैं अतः अभिवादन में एक ऐसा शब्द अपनाया जाए जिससे किसी को अनुचित और असुविधाजनक न लगे। और इस प्रकार प्रदीप सारंग जी द्वारा एक अनूठी अभिवादन शैली— ', 'After months of contemplation, a breakthrough emerged: an all-inclusive greeting was invented. Since people dedicated to greening represent diverse backgrounds, faiths, and nationalities, the greeting needed to be universally comfortable and welcoming. Thus, Pradeep Sarang pioneered the unique greeting — ')) ?><strong class="font-bold text-deep-forest"><?= e(ps_text('ग्रीन मॉर्निंग', 'Green Morning')) ?></strong> <?= e(ps_text('और', 'and')) ?> <strong class="font-bold text-deep-forest"><?= e(ps_text('हरित प्रभात', 'Harit Prabhat')) ?></strong> <?= e(ps_text('का आविष्कार किया गया।', 'was born.')) ?>
          </p>
          <div class="bg-soft-meadow rounded-2xl p-5 border-l-4 border-primary text-deep-forest">
            <p class="font-body-md text-body-md italic leading-relaxed">
              <?= e(ps_text('“श्री सारंग का कहना है कि निरंतर चिंतन का परिणाम रहा कि अभिनव अभिवादन शैली का आविष्कार हो गया। गुड मॉर्निंग के स्थान पर ग्रीन मॉर्निंग का चयन किया। हमको अपनी बुद्धि पर इस नई खोज पर स्वयं को बहुत अच्छा लग रहा है कि हमने एक नया शब्द अभिवादन के लिए खोज लिया है।”', '“Shri Sarang reflects that sustained contemplation bore fruit in this innovative greeting. Choosing Green Morning in place of Good Morning gave deep inner fulfillment — discovering a universal word of greeting for humanity and mother earth.”')) ?>
            </p>
          </div>
        </div>
      </div>

      <!-- Part 2: Dialogue with Late Hari Prasad Verma ji -->
      <div class="bg-gradient-to-br from-[#FFFDF7] to-[#F5EFE1] rounded-3xl p-6 sm:p-10 shadow-sm border border-[#E3D7C3] mb-10">
        <div class="flex items-center gap-3 mb-5 border-b border-[#E3D7C3] pb-4">
          <div class="w-10 h-10 rounded-xl bg-secondary/15 text-secondary flex items-center justify-center shrink-0">
            <span class="material-symbols-outlined text-2xl">record_voice_over</span>
          </div>
          <div>
            <h3 class="font-headline-sm text-headline-sm text-deep-forest font-bold">
              <?= e(ps_text('2. संस्थापक सदस्य स्व. हरिप्रसाद वर्मा जी से संवाद एवं तर्कों की खोज', '2. Dialogue with Late Hari Prasad Verma & The Search for Rationale')) ?>
            </h3>
            <span class="text-xs text-secondary font-semibold uppercase tracking-wider">
              <?= e(ps_text('एक विचार की परीक्षा • संशय से समाधान तक', 'Testing the Concept • From Doubt to Conviction')) ?>
            </span>
          </div>
        </div>

        <div class="space-y-4 font-body-md text-body-md text-on-surface-variant leading-relaxed">
          <p>
            <?= e(ps_text('श्री सारंग ने अनेक तर्क खोजे कि क्यों ग्रीन मॉर्निंग, क्यों हरित प्रभात या हरित प्रात? हम किसी को हर सुबह गुड मॉर्निंग बोलकर विश करते हैं कि आपकी सुबह शुभ हो। यहाँ श्री सारंग जी का तर्क है कि ', 'Sarang explored numerous dimensions: Why Green Morning? Why Harit Prabhat? Greeting someone with \'Good Morning\' simply wishes a good day. But between \'Good\' and \'Green\', there lies a vast philosophical difference: ')) ?><strong class="font-bold text-deep-forest"><?= e(ps_text('गुड शब्द के अर्थ और ग्रीन शब्द के अर्थ में जमीन-आसमान जैसा अंतर है', 'there lies an immense philosophical difference between the meaning of Good and Green')) ?></strong><?= e(ps_text('। गुड शब्द का अर्थ सिर्फ शुभ है, अच्छा है जबकि ग्रीन शब्द के अर्थ में बहुत आयाम हैं।', '. \'Good\' only means fine or auspicious, whereas \'Green\' embodies multidimensional life and cosmic vitality.')) ?>
          </p>

          <div class="bg-white/80 rounded-2xl p-5 sm:p-6 border border-[#E3D7C3] my-4">
            <p class="font-body-md text-body-md text-deep-forest leading-relaxed">
              <?= e(ps_text('श्री सारंग जी बताते हैं कि जब पहली बार ग्रीन गैंग के संस्थापक सदस्य स्मृति शेष बड़े भाई ', 'When first discussing \'Green Morning\' with Green Gang founding member Late brother ')) ?><strong class="font-bold"><?= e(ps_text('हरिप्रसाद वर्मा जी', 'Hari Prasad Verma')) ?></strong><?= e(ps_text(' से इस नई अभिवादन शब्द— "ग्रीन मॉर्निंग" पर बात हुई तो श्री वर्मा जी का पहला सवाल था कि ', ', his immediate question was: ')) ?><span class="italic font-semibold"><?= e(ps_text('"गुड मॉर्निंग की जगह ग्रीन मॉर्निंग क्यों?"', '"Why Green Morning instead of Good Morning?"')) ?></span>
            </p>
            <p class="font-body-md text-body-md text-deep-forest mt-3 leading-relaxed">
              <?= e(ps_text('श्री वर्मा जी को तत्काल समुचित उत्तर नहीं दिया जा सका किन्तु उन्हें संतुष्ट करने की हमने भरपूर कोशिश की। हमें लगा कि श्री वर्मा जी संतुष्ट नहीं हुए। उन्होंने हमारी भावनाओं को समझा और यह कहकर चर्चा को समाप्त किया कि—', 'He could not be given an exhaustive answer immediately, though we tried our best. Understanding our heartfelt sentiment, he concluded with wisdom:')) ?>
            </p>
            <blockquote class="my-3 pl-4 border-l-4 border-secondary text-base sm:text-lg font-serif italic text-secondary font-semibold">
              <?= e(ps_text('“समाज किसी नए प्रयोग को बहुत जल्दी स्वीकार नहीं करता है। अभी इस पर और चिंतन करो।”', '“Society does not adopt new experiments hastily. Reflect on this further.”')) ?>
            </blockquote>
            <p class="font-body-sm text-body-sm text-text-muted mt-2 leading-relaxed">
              <?= e(ps_text('श्री सारंग जी के अनुसार— हमारी चिंता बढ़ गयी और जो उत्साह बना हुआ था उसमें कुछ कमी भी आई। लेकिन आदतन हमने हार नहीं मानी। कुछ तर्क गढ़ने लगे कि परम्परागत रूप से चले आ रहे गुड मॉर्निंग के स्थान पर ग्रीन मॉर्निंग क्यों? हमने कुछ निम्नलिखित 6 तर्क खोजकर इकट्ठा किये:', 'According to Shri Sarang: "Our concern grew and initial excitement dipped slightly. But characteristically, we never conceded defeat. We set out to discover profound, undeniable logic for replacing traditional Good Morning with Green Morning. This led to the 6 pillars of rationale:"')) ?>
            </p>
          </div>
        </div>
      </div>

      <!-- Part 3: The 6 Rationale Pillars (6 अकाट्य तर्क) -->
      <div class="mb-12">
        <div class="text-center mb-8">
          <span class="font-label-sm text-label-sm text-secondary tracking-widest font-bold uppercase"><?= e(ps_text('दार्शनिक एवं भाषाई आधार', 'Philosophical & Linguistic Foundations')) ?></span>
          <h3 class="font-headline-md text-headline-md text-deep-forest font-bold mt-1">
            <?= e(ps_text('प्रदीप सारंग द्वारा प्रतिपादित 6 अकाट्य तर्क', 'The 6 Undeniable Rationale Pillars by Pradeep Sarang')) ?>
          </h3>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
          
          <!-- Argument 1 -->
          <div class="bg-pure-white rounded-2xl p-6 shadow-sm border border-border-warm flex flex-col justify-between hover:shadow-md transition-all">
            <div>
              <div class="flex items-center justify-between mb-4">
                <span class="inline-flex items-center justify-center w-10 h-10 rounded-xl bg-primary text-pure-white font-bold text-base">1</span>
                <span class="text-xs font-bold uppercase tracking-wider text-secondary flex items-center gap-1">
                  <span class="material-symbols-outlined text-[16px]">psychiatry</span>
                  <?= e(ps_text('चैतन्य वैचारिकी', 'Conscious Ethos')) ?>
                </span>
              </div>
              <h4 class="font-title-md text-title-md text-deep-forest font-bold mb-2">
                <?= e(ps_text('चैतन्य रूप में जीवन में अपनाने की जरूरत', 'Living Consciousness')) ?>
              </h4>
              <p class="font-body-sm text-body-sm text-on-surface-variant leading-relaxed">
                <?= e(ps_text('ग्रीन गैंग एक नई विचारधारा को चैतन्य रूप में जीवन में अपनाने की जरूरत है। किसी के द्वारा वृक्षारोपण करना एक उत्कृष्ट कार्य है किन्तु हरियाली की चैतन्य वैचारिकी को धारण करके वृक्षारोपण करना एक अलग प्रभावकारी स्थिति उत्पन्न करेगा। यह चैतन्यता ग्रीन गैंग के कल्चर की पहचान होगी।', 'Tree planting is noble, but planting trees while embodying a living green consciousness creates a profoundly transformative impact. This living consciousness is the defining culture of Green Gang.')) ?>
              </p>
            </div>
          </div>

          <!-- Argument 2 -->
          <div class="bg-pure-white rounded-2xl p-6 shadow-sm border border-border-warm flex flex-col justify-between hover:shadow-md transition-all">
            <div>
              <div class="flex items-center justify-between mb-4">
                <span class="inline-flex items-center justify-center w-10 h-10 rounded-xl bg-primary text-pure-white font-bold text-base">2</span>
                <span class="text-xs font-bold uppercase tracking-wider text-secondary flex items-center gap-1">
                  <span class="material-symbols-outlined text-[16px]">format_quote</span>
                  <?= e(ps_text('अर्थ की व्यापकता', 'Depth of Meaning')) ?>
                </span>
              </div>
              <h4 class="font-title-md text-title-md text-deep-forest font-bold mb-2">
                <?= e(ps_text('\'गुड\' बनाम \'ग्रीन\' — आयामों का अंतर', 'Good vs Green Semantics')) ?>
              </h4>
              <p class="font-body-sm text-body-sm text-on-surface-variant leading-relaxed">
                <?= e(ps_text('गुड का अर्थ होता है शुभ और अच्छा। हम हर सुबह किसी को गुड मॉर्निंग बोलकर उसे विश करते हैं शुभकामनाएं प्रदान करते हैं कि आपकी यह सुबह यह प्रातः शुभ हो अच्छी हो। जबकि ग्रीन का अर्थ बहुत व्यापक है। इसमें अनेक आयाम समाहित हैं।', 'Good merely denotes \'fine\' or \'auspicious\'. Green, however, is cosmic and expansive — encapsulating environmental vitality, clean air, life-support systems, and collective well-being.')) ?>
              </p>
            </div>
          </div>

          <!-- Argument 3 -->
          <div class="bg-pure-white rounded-2xl p-6 shadow-sm border border-border-warm flex flex-col justify-between hover:shadow-md transition-all">
            <div>
              <div class="flex items-center justify-between mb-4">
                <span class="inline-flex items-center justify-center w-10 h-10 rounded-xl bg-primary text-pure-white font-bold text-base">3</span>
                <span class="text-xs font-bold uppercase tracking-wider text-secondary flex items-center gap-1">
                  <span class="material-symbols-outlined text-[16px]">flag</span>
                  <?= e(ps_text('राष्ट्रीय ध्वज व समृद्धि', 'National Flag & Prosperity')) ?>
                </span>
              </div>
              <h4 class="font-title-md text-title-md text-deep-forest font-bold mb-2">
                <?= e(ps_text('तिरंगे का हरा रंग: सुख व कृषि संपन्नता', 'Tricolor\'s Green Band')) ?>
              </h4>
              <p class="font-body-sm text-body-sm text-on-surface-variant leading-relaxed">
                <?= e(ps_text('ग्रीन = हरा। हरा रंग भारत के राष्ट्रीय ध्वज तिरंगे में है। यहाँ हरा रंग सुख, कृषि गत संपन्नता और समृद्धता तथा हरियाली संवर्धन का अर्थ देता है। यानी ग्रीन शब्द में ये भाव संपदा समाहित है।', 'Green represents the lower band of India\'s national tricolor — symbolizing agriculture, flourishing soil, happiness, and ecological abundance. This rich heritage is packed in the word Green.')) ?>
              </p>
            </div>
          </div>

          <!-- Argument 4 -->
          <div class="bg-pure-white rounded-2xl p-6 shadow-sm border border-border-warm flex flex-col justify-between hover:shadow-md transition-all md:col-span-2 lg:col-span-1">
            <div>
              <div class="flex items-center justify-between mb-4">
                <span class="inline-flex items-center justify-center w-10 h-10 rounded-xl bg-primary text-pure-white font-bold text-base">4</span>
                <span class="text-xs font-bold uppercase tracking-wider text-secondary flex items-center gap-1">
                  <span class="material-symbols-outlined text-[16px]">auto_stories</span>
                  <?= e(ps_text('साहित्यिक प्रमाण', 'Literary & Optical Logic')) ?>
                </span>
              </div>
              <h4 class="font-title-md text-title-md text-deep-forest font-bold mb-2">
                <?= e(ps_text('महाकवि बिहारी जी का दोहा व हरित-दुति', 'Bihari\'s Poetic Evidence')) ?>
              </h4>
              <div class="bg-soft-meadow rounded-xl p-3 border-l-2 border-primary mb-3 text-center">
                <p class="font-serif italic font-semibold text-deep-forest text-xs sm:text-sm leading-relaxed">
                  “मेरी भव बाधा हरो, राधा नागरि सोय।<br>
                  जा तन की झाईं पड़े, श्याम हरित दुति होय।।”
                </p>
                <span class="text-[11px] text-text-muted block mt-1"><?= e(ps_text('— महाकवि बिहारी', '— Mahakavi Bihari')) ?></span>
              </div>
              <p class="font-body-xs text-xs text-on-surface-variant leading-relaxed">
                <?= e(ps_text('हिंदी के प्रसिद्ध लेखक बिहारी जी ने भी हरित-दुति का अर्थ प्रसन्न मुद्रा से लगाया है। राधा गोरी (पीली) हैं, श्याम नीले/सांवरे रंग के हैं। राधा की परछाई पड़ने पर श्याम आह्लादित हो जाते हैं। वैसे भी नीला+पीला रंग मिलने पर हरा रंग बनता है। यहाँ सिद्ध है कि ग्रीन के अर्थ में ऐसी प्रसन्नता और ऐसा आह्लाद भी समाहित है।', 'Bihari associated \'Harit-Duti\' with sheer joy. When Radha\'s golden complexion reflects upon Shyam (Krishna), he lights up with bliss. Optically too, blue and yellow produce green.')) ?>
              </p>
            </div>
          </div>

          <!-- Argument 5 -->
          <div class="bg-pure-white rounded-2xl p-6 shadow-sm border border-border-warm flex flex-col justify-between hover:shadow-md transition-all">
            <div>
              <div class="flex items-center justify-between mb-4">
                <span class="inline-flex items-center justify-center w-10 h-10 rounded-xl bg-primary text-pure-white font-bold text-base">5</span>
                <span class="text-xs font-bold uppercase tracking-wider text-secondary flex items-center gap-1">
                  <span class="material-symbols-outlined text-[16px]">sentiment_satisfied</span>
                  <?= e(ps_text('मानवीय भाव', 'Human Emotions')) ?>
                </span>
              </div>
              <h4 class="font-title-md text-title-md text-deep-forest font-bold mb-2">
                <?= e(ps_text('खिला बनाम मुरझाया: चेहरे का भाव', 'Blooming vs Withering')) ?>
              </h4>
              <p class="font-body-sm text-body-sm text-on-surface-variant leading-relaxed">
                <?= e(ps_text('फूलों और पेड़ों की तरह मनुष्य के चेहरे के लिए भी "खिला है, मुरझाया है" बोला जाता है। इसका भी अर्थ खिला यानी हरा-भरा यानी प्रसन्न है। हरियाली कम यानी मुरझाया हुआ है, यानी प्रसन्नता कम।', 'Just like trees and blossoms, a human countenance is described as \'blooming\' (fresh, green, joyful) or \'withered\' (devoid of greenery, sad). Green is synonymous with human happiness.')) ?>
              </p>
            </div>
          </div>

          <!-- Argument 6 -->
          <div class="bg-pure-white rounded-2xl p-6 shadow-sm border border-border-warm flex flex-col justify-between hover:shadow-md transition-all">
            <div>
              <div class="flex items-center justify-between mb-4">
                <span class="inline-flex items-center justify-center w-10 h-10 rounded-xl bg-primary text-pure-white font-bold text-base">6</span>
                <span class="text-xs font-bold uppercase tracking-wider text-secondary flex items-center gap-1">
                  <span class="material-symbols-outlined text-[16px]">all_inclusive</span>
                  <?= e(ps_text('सदाबहार जीवन', 'Evergreen Vibrancy')) ?>
                </span>
              </div>
              <h4 class="font-title-md text-title-md text-deep-forest font-bold mb-2">
                <?= e(ps_text('एवरग्रीन (Evergreen): सदैव खुशहाल', 'Evergreen: Perennially Joyful')) ?>
              </h4>
              <p class="font-body-sm text-body-sm text-on-surface-variant leading-relaxed">
                <?= e(ps_text('अंग्रेजी में प्रायः बोला जाता है— एवरग्रीन/Evergreen. इसका अर्थ है सदाबहार यानी सदैव हरा भरा रहने वाला। मनुष्य के सदाबहार अथवा हरा भरा रहने से मतलब है सदैव खुशहाल रहना, सदैव प्रसन्न रहना।', 'The global term \'Evergreen\' stands for eternal vitality and verdance. Applied to human life, staying evergreen means maintaining perpetual joy and unwaning optimism.')) ?>
              </p>
            </div>
          </div>

        </div>
      </div>

      <!-- Part 4: The Proven Conclusion & The 4 Daily Prahar Expansion -->
      <div class="bg-deep-forest text-pure-white rounded-3xl p-6 sm:p-10 shadow-xl relative overflow-hidden">
        <div class="relative z-10">
          <div class="max-w-3xl mb-8">
            <span class="text-xs font-bold uppercase tracking-widest text-primary-fixed block mb-2">
              <?= e(ps_text('स्वतः सिद्ध निष्कर्ष • भाव संपदा की श्रेष्ठता', 'Self-Evident Conclusion • Superiority of Emotional Wealth')) ?>
            </span>
            <h3 class="font-headline-md text-headline-md font-bold text-pure-white mb-4">
              <?= e(ps_text('गुड शब्द की अपेक्षा ग्रीन शब्द कई गुना उत्तम व श्रेष्ठ है', 'Green is Incomparably Superior to Good in Meaning')) ?>
            </h3>
            <p class="font-body-md text-body-md text-surface-container-high leading-relaxed mb-4">
              <?= e(ps_text('इस प्रकार श्री सारंग जी के द्वारा खोजे गए उपरोक्त तर्कों से स्वतः सिद्ध हो जाता है कि गुड मॉर्निंग का अर्थ सिर्फ सुप्रभात अथवा शुभ प्रभात होगा, जबकि ग्रीन मॉर्निंग का अर्थ— हरित प्रभात यानी खुशहाल प्रात अथवा सुख सम्पन्न, समृद्ध प्रात/प्रभात होगा। यहाँ ग्रीन मॉर्निंग की इस विश में हृदय की भावनाओं में आह्लाद की उपस्थिति की स्थिति से भी है। भाव संपदा की दृष्टि से गुड शब्द की अपेक्षा ग्रीन शब्द कई गुना उत्तम है, श्रेष्ठ है।', 'Thus, Shri Sarang\'s rationale conclusively establishes that while Good Morning simply means an auspicious morning, Green Morning implies a flourishing, joyful, and ecologically enriched dawn. In emotional wealth and depth, Green is vastly superior to Good.')) ?>
            </p>
            <p class="font-body-sm text-body-sm text-surface-container-high/90 leading-relaxed">
              <?= e(ps_text('प्रेरणादायक चर्चाओं का परिणाम है कि आज हजारों लोग अभिवादन शैली में गुड मॉर्निंग के स्थान पर ग्रीन मॉर्निंग, गुड अफ्टरनून के स्थान पर ग्रीन आफ्टरनून, गुड इवनिंग के स्थान पर ग्रीन इवनिंग और गुड नाइट के स्थान पर ग्रीन नाइट को अपना रहे हैं। इसी प्रकार सुप्रभात या शुभ प्रात के स्थान पर हरित प्रभात, हरित प्रात, हरित सुबह तथा क्रमशः हरित दोपहर, हरित संध्या, हरित साँझ, हरित रात्रि आदि।', 'As a result of these inspiring dialogues, thousands have embraced Green greetings across the four times of day: Green Morning, Green Afternoon, Green Evening, and Green Night (Harit Prabhat, Harit Dopahar, Harit Sandhya, Harit Ratri).')) ?>
            </p>
          </div>

          <!-- The 4 Daily Greetings Cards -->
          <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 pt-4 border-t border-white/10">
            <div class="bg-white/10 rounded-2xl p-4 border border-white/15">
              <div class="text-primary-fixed font-bold text-xs uppercase mb-1"><?= e(ps_text('प्रातः काल • Morning', 'Morning')) ?></div>
              <div class="text-lg font-bold text-pure-white">ग्रीन मॉर्निंग</div>
              <div class="text-xs text-primary-fixed/80 mt-1">हरित प्रभात • हरित प्रात • हरित सुबह</div>
            </div>
            <div class="bg-white/10 rounded-2xl p-4 border border-white/15">
              <div class="text-tertiary-fixed font-bold text-xs uppercase mb-1"><?= e(ps_text('दोपहर काल • Afternoon', 'Afternoon')) ?></div>
              <div class="text-lg font-bold text-pure-white">ग्रीन आफ्टरनून</div>
              <div class="text-xs text-tertiary-fixed/80 mt-1">हरित दोपहर</div>
            </div>
            <div class="bg-white/10 rounded-2xl p-4 border border-white/15">
              <div class="text-secondary-fixed font-bold text-xs uppercase mb-1"><?= e(ps_text('सायं काल • Evening', 'Evening')) ?></div>
              <div class="text-lg font-bold text-pure-white">ग्रीन इवनिंग</div>
              <div class="text-xs text-secondary-fixed/80 mt-1">हरित संध्या • हरित साँझ</div>
            </div>
            <div class="bg-white/10 rounded-2xl p-4 border border-white/15">
              <div class="text-on-primary-container font-bold text-xs uppercase mb-1"><?= e(ps_text('रात्रि काल • Night', 'Night')) ?></div>
              <div class="text-lg font-bold text-pure-white">ग्रीन नाइट</div>
              <div class="text-xs text-on-primary-container/80 mt-1">हरित रात्रि</div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </section>

  <!-- Core Pillars of Green Gang Movement -->
  <section class="w-full bg-cream-canvas py-space-3xl border-b border-border-warm">
    <div class="max-w-container-max mx-auto px-4 sm:px-8">
      <div class="text-center max-w-3xl mx-auto mb-space-xl">
        <span class="font-label-sm text-label-sm text-secondary tracking-widest font-bold uppercase"><?= e(ps_text('वैचारिक आधार', 'Core Pillars')) ?></span>
        <h2 class="font-headline-lg text-headline-md md:text-headline-lg text-deep-forest font-bold mt-1">
          <?= e(ps_text('\'ग्रीन गैंग\' आंदोलन के चार मुख्य आधार स्तंभ', 'Four Fundamental Pillars of Green Gang')) ?>
        </h2>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <!-- Pillar 1 -->
        <div class="bg-pure-white rounded-3xl p-6 sm:p-8 shadow-sm border border-border-warm hover:shadow-md transition-all flex flex-col justify-between">
          <div>
            <div class="w-12 h-12 rounded-2xl bg-primary-fixed/40 text-primary-container flex items-center justify-center mb-5 border border-border-warm">
              <span class="material-symbols-outlined text-[28px]">waving_hand</span>
            </div>
            <h3 class="font-headline-sm text-headline-sm text-deep-forest font-bold mb-3">
              1. <?= e(ps_text('\'ग्रीन मॉर्निंग\' दैनिक अभिवादन संस्कार', 'The \'Green Morning\' Daily Greeting Ritual')) ?>
            </h3>
            <p class="font-body-md text-body-md text-on-surface-variant leading-relaxed mb-4">
              <?= e(ps_text('विद्यालयों, चौपालों और सार्वजनिक जीवन में \'गुड मॉर्निंग\' की जगह \'ग्रीन मॉर्निंग\' (Green Morning) बोलने का शिष्टाचार। यह शब्द प्रत्येक व्यक्ति को रोज़ सवेरे प्रकृति के प्रति अपने नैतिक कर्तव्य का स्मरण दिलाता है।', 'Replacing \'Good Morning\' with \'Green Morning\' across schools, village chaupals, and families as a daily reminder to nurture nature.')) ?>
            </p>
          </div>
          <div class="bg-soft-meadow p-3.5 rounded-xl border border-border-warm font-body-sm text-body-sm text-deep-forest font-semibold flex flex-col gap-1.5">
            <div class="flex items-center gap-2">
              <span class="material-symbols-outlined text-primary-container text-[18px]">eco</span>
              <span><?= e(ps_text('100+ विद्यालयों में दैनिक प्रार्थना सत्र में शामिल', 'Practiced daily in 100+ school assemblies')) ?></span>
            </div>
            <a href="#green-morning-philosophy" class="text-xs text-secondary hover:text-primary font-bold inline-flex items-center gap-1 transition-colors">
              <span><?= e(ps_text('विस्तृत वैचारिकी व 6 दार्शनिक तर्क ऊपर पढ़ें ↑', 'Read Full Philosophy & 6 Arguments Above ↑')) ?></span>
            </a>
          </div>
        </div>

        <!-- Pillar 2 -->
        <div class="bg-pure-white rounded-3xl p-6 sm:p-8 shadow-sm border border-border-warm hover:shadow-md transition-all flex flex-col justify-between">
          <div>
            <div class="w-12 h-12 rounded-2xl bg-secondary-fixed text-secondary flex items-center justify-center mb-5 border border-border-warm">
              <span class="material-symbols-outlined text-[28px]">cake</span>
            </div>
            <h3 class="font-headline-sm text-headline-sm text-deep-forest font-bold mb-3">
              2. <?= e(ps_text('पारिवारिक मांगलिक अवसरों पर पौध संकल्प', 'Milestone Family Tree Pledges')) ?>
            </h3>
            <p class="font-body-md text-body-md text-on-surface-variant leading-relaxed mb-4">
              <?= e(ps_text('जन्मदिन, विवाह वर्षगांठ अथवा पूर्वजों की स्मृति में पौधा रोपने और उसका संरक्षण करने का पारिवारिक संकल्प। पर्यावरण संवर्धन को पारिवारिक उत्सव का पावन भाग बनाया गया।', 'Planting and adopting a tree on every birthday, anniversary, or memorial, transforming tree care into a family tradition.')) ?>
            </p>
          </div>
          <div class="bg-soft-meadow p-3.5 rounded-xl border border-border-warm font-body-sm text-body-sm text-deep-forest font-semibold flex items-center gap-2">
            <span class="material-symbols-outlined text-secondary text-[18px]">favorite</span>
            <span><?= e(ps_text('हजारों परिवारों द्वारा जीवन-अवसरों पर पौध रोपण', 'Thousands of families planting trees on special occasions')) ?></span>
          </div>
        </div>

        <!-- Pillar 3 -->
        <div class="bg-pure-white rounded-3xl p-6 sm:p-8 shadow-sm border border-border-warm hover:shadow-md transition-all flex flex-col justify-between">
          <div>
            <div class="w-12 h-12 rounded-2xl bg-tertiary-fixed text-tertiary flex items-center justify-center mb-5 border border-border-warm">
              <span class="material-symbols-outlined text-[28px]">forest</span>
            </div>
            <h3 class="font-headline-sm text-headline-sm text-deep-forest font-bold mb-3">
              3. <?= e(ps_text('देसी छायादार व फलदार वृक्षों को प्राथमिकता', 'Native Shade Trees (Banyan, Peepal, Neem)')) ?>
            </h3>
            <p class="font-body-md text-body-md text-on-surface-variant leading-relaxed mb-4">
              <?= e(ps_text('विदेशी सुबबूल या यूकेलिप्टस के बजाय अवध की जलवायु के अनुकूल बरगद, पीपल, नीम, पाकड़, महुआ और आम के देशी वृक्षों का रोपण, जो प्रचुर मात्रा में ऑक्सीजन और पक्षियों को प्राकृतिक आश्रय प्रदान करते हैं।', 'Prioritizing native species like Banyan, Peepal, Neem, Pakad, and Mango suited for Awadh climate over non-native trees.')) ?>
            </p>
          </div>
          <div class="bg-soft-meadow p-3.5 rounded-xl border border-border-warm font-body-sm text-body-sm text-deep-forest font-semibold flex items-center gap-2">
            <span class="material-symbols-outlined text-tertiary text-[18px]">nature</span>
            <span><?= e(ps_text('अधिकतम ऑक्सीजन एवं पक्षियों का प्राकृतिक बसेरा', 'Maximum oxygen & bird habitat preservation')) ?></span>
          </div>
        </div>

        <!-- Pillar 4 -->
        <div class="bg-pure-white rounded-3xl p-6 sm:p-8 shadow-sm border border-border-warm hover:shadow-md transition-all flex flex-col justify-between">
          <div>
            <div class="w-12 h-12 rounded-2xl bg-primary-fixed/40 text-primary-container flex items-center justify-center mb-5 border border-border-warm">
              <span class="material-symbols-outlined text-[28px]">groups</span>
            </div>
            <h3 class="font-headline-sm text-headline-sm text-deep-forest font-bold mb-3">
              4. <?= e(ps_text('ग्राम युवा दस्ता एवं ट्री-गार्ड सुरक्षा', 'Youth Green Guards & Tree-Guard Safety')) ?>
            </h3>
            <p class="font-body-md text-body-md text-on-surface-variant leading-relaxed mb-4">
              <?= e(ps_text('प्रत्येक गाँव में युवा स्वयंसेवकों का दस्ता गठित किया जाता है। प्रत्येक पौधे को ट्री-गार्ड से सुरक्षित कर 10 पौधों के नियमित जल व संरक्षण की जिम्मेदारी एक युवा प्रहरी को सौंपी जाती है।', 'Forming village youth squads where each volunteer adopts and waters 10 tree-guarded saplings daily.')) ?>
            </p>
          </div>
          <div class="bg-soft-meadow p-3.5 rounded-xl border border-border-warm font-body-sm text-body-sm text-deep-forest font-semibold flex items-center gap-2">
            <span class="material-symbols-outlined text-primary-container text-[18px]">shield</span>
            <span><?= e(ps_text('संरक्षण के बिना रोपण नहीं — 85% जीवित दर', 'No planting without protection guards')) ?></span>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- How Green Gang Works (3-Step Model) -->
  <section class="w-full bg-soft-meadow py-space-3xl border-b border-border-warm">
    <div class="max-w-container-max mx-auto px-4 sm:px-8">
      <div class="text-center max-w-3xl mx-auto mb-space-xl">
        <span class="font-label-sm text-label-sm text-secondary tracking-widest font-bold uppercase"><?= e(ps_text('कार्यप्रणाली', 'Operational Model')) ?></span>
        <h2 class="font-headline-lg text-headline-md md:text-headline-lg text-deep-forest font-bold mt-1">
          <?= e(ps_text('ग्रीन गैंग की पारदर्शी एवं सहभागी कार्यशैली', 'How Green Gang Operates in 3 Simple Steps')) ?>
        </h2>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Step 1 -->
        <div class="bg-pure-white rounded-3xl p-6 sm:p-8 shadow-sm border border-border-warm flex flex-col justify-between">
          <div>
            <span class="w-10 h-10 rounded-full bg-primary-container text-on-primary font-bold flex items-center justify-center mb-4">1</span>
            <h3 class="font-title-lg text-title-lg text-deep-forest font-bold mb-2"><?= e(ps_text('ग्राम चौपाल गठन', 'Village Chaupal Assembly')) ?></h3>
            <p class="font-body-md text-body-md text-on-surface-variant leading-relaxed">
              <?= e(ps_text('गांव में युवाओं, किसानों एवं विद्यार्थियों की बैठक कर पर्यावरण संरक्षण और ग्रीन गैंग शाखा का गठन किया जाता है।', 'Gathering villagers, farmers, and students to form a local Green Gang unit.')) ?>
            </p>
          </div>
        </div>

        <!-- Step 2 -->
        <div class="bg-pure-white rounded-3xl p-6 sm:p-8 shadow-sm border border-border-warm flex flex-col justify-between">
          <div>
            <span class="w-10 h-10 rounded-full bg-secondary text-on-secondary font-bold flex items-center justify-center mb-4">2</span>
            <h3 class="font-title-lg text-title-lg text-deep-forest font-bold mb-2"><?= e(ps_text('पौध गोद लेना व ट्री-गार्ड', 'Sapling Adoption & Tree-Guard')) ?></h3>
            <p class="font-body-md text-body-md text-on-surface-variant leading-relaxed">
              <?= e(ps_text('स्वयंसेवकों को देशी पौध एवं सुरक्षा ट्री-गार्ड वितरित किए जाते हैं। प्रत्येक पौधा किसी विशिष्ट व्यक्ति को गोद दिया जाता है।', 'Distributing saplings with protective guards and assigning them to individuals.')) ?>
            </p>
          </div>
        </div>

        <!-- Step 3 -->
        <div class="bg-pure-white rounded-3xl p-6 sm:p-8 shadow-sm border border-border-warm flex flex-col justify-between">
          <div>
            <span class="w-10 h-10 rounded-full bg-tertiary text-on-tertiary font-bold flex items-center justify-center mb-4">3</span>
            <h3 class="font-title-lg text-title-lg text-deep-forest font-bold mb-2"><?= e(ps_text('\'ग्रीन मॉर्निंग\' दैनिक देखभाल', 'Daily Green Morning Care')) ?></h3>
            <p class="font-body-md text-body-md text-on-surface-variant leading-relaxed">
              <?= e(ps_text('युवा प्रहरी प्रतिदिन प्रातः \'ग्रीन मॉर्निंग\' के साथ मिट्टी की नमी जांचते हैं तथा पौधों की सिंचाई व निराई सुनिश्चित करते हैं।', 'Youth guards greet each morning with Green Morning, ensuring daily watering.')) ?>
            </p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Green Gang Drive Photo Showcase -->
  <section class="w-full bg-cream-canvas py-space-3xl border-b border-border-warm">
    <div class="max-w-container-max mx-auto px-4 sm:px-8">
      <div class="flex flex-col md:flex-row md:items-end justify-between mb-space-xl gap-4">
        <div>
          <span class="font-label-sm text-label-sm text-secondary tracking-widest font-bold uppercase"><?= e(ps_text('सजीव झलकियाँ', 'Drive Spotlight')) ?></span>
          <h2 class="font-headline-lg text-headline-md md:text-headline-lg text-deep-forest font-bold mt-1">
            <?= e(ps_text('ग्रीन गैंग अभियानों के सजीव छायाचित्र', 'Green Gang Drives Field Photographs')) ?>
          </h2>
        </div>
        <a href="<?= e(base_url('/portfolio')) ?>" class="inline-flex items-center gap-1 font-label-md text-label-md text-primary hover:text-deep-forest font-bold">
          <span><?= e(ps_text('सम्पूर्ण दीर्घा देखें', 'View Full Gallery')) ?></span>
          <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
        </a>
      </div>

      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="group relative rounded-2xl overflow-hidden shadow-sm border border-border-warm aspect-[4/3] bg-surface-container">
          <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuChrvMjaMrNe9mnv0wsNeczsA9QTsVBVexwNC6wWD2ITtZGUqAqC4rJlu14alM7uVOx3q6e6QMugj2k_SVptJFwJxqw4kgUmkZfc4oZSwOSInUiqwcST-ZVxWP0dQNinxgeGayBKo9MBnd0LReS_tvv8rW_e0uWQz8FI_1PBQ_sze_mt4-UezPUkio4HIFKvoUNP0kZ6gNLPilWihHeDYhJaX6ySBPHJHVKOu68a1dbF1aYaqyDO7Db" alt="Green Gang Planting" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
          <a href="https://lh3.googleusercontent.com/aida-public/AB6AXuChrvMjaMrNe9mnv0wsNeczsA9QTsVBVexwNC6wWD2ITtZGUqAqC4rJlu14alM7uVOx3q6e6QMugj2k_SVptJFwJxqw4kgUmkZfc4oZSwOSInUiqwcST-ZVxWP0dQNinxgeGayBKo9MBnd0LReS_tvv8rW_e0uWQz8FI_1PBQ_sze_mt4-UezPUkio4HIFKvoUNP0kZ6gNLPilWihHeDYhJaX6ySBPHJHVKOu68a1dbF1aYaqyDO7Db" data-ps-lightbox data-caption="<?= e(ps_text('ग्रीन गैंग पौधारोपण — कमरावाँ', 'Green Gang Planting - Kamrawan')) ?>" class="absolute inset-0 bg-deep-forest/60 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center text-pure-white font-label-md text-label-md font-bold gap-1">
            <span class="material-symbols-outlined text-[20px]">zoom_in</span>
            <span><?= e(ps_text('चित्र देखें', 'View Photo')) ?></span>
          </a>
        </div>

        <div class="group relative rounded-2xl overflow-hidden shadow-sm border border-border-warm aspect-[4/3] bg-surface-container">
          <img src="https://picsum.photos/seed/greengang-2/900/700" alt="Village Tree Guard" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
          <a href="https://picsum.photos/seed/greengang-2/900/700" data-ps-lightbox data-caption="<?= e(ps_text('ट्री-गार्ड सुरक्षा अभियान', 'Tree Guard Safety Drive')) ?>" class="absolute inset-0 bg-deep-forest/60 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center text-pure-white font-label-md text-label-md font-bold gap-1">
            <span class="material-symbols-outlined text-[20px]">zoom_in</span>
            <span><?= e(ps_text('चित्र देखें', 'View Photo')) ?></span>
          </a>
        </div>

        <div class="group relative rounded-2xl overflow-hidden shadow-sm border border-border-warm aspect-[4/3] bg-surface-container">
          <img src="https://picsum.photos/seed/greengang-3/900/700" alt="School Green Morning" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
          <a href="https://picsum.photos/seed/greengang-3/900/700" data-ps-lightbox data-caption="<?= e(ps_text('स्कूलों में ग्रीन मॉर्निंग संस्कार', 'School Green Morning Assembly')) ?>" class="absolute inset-0 bg-deep-forest/60 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center text-pure-white font-label-md text-label-md font-bold gap-1">
            <span class="material-symbols-outlined text-[20px]">zoom_in</span>
            <span><?= e(ps_text('चित्र देखें', 'View Photo')) ?></span>
          </a>
        </div>

        <div class="group relative rounded-2xl overflow-hidden shadow-sm border border-border-warm aspect-[4/3] bg-surface-container">
          <img src="https://picsum.photos/seed/greengang-4/900/700" alt="Green Chaupal Assembly" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
          <a href="https://picsum.photos/seed/greengang-4/900/700" data-ps-lightbox data-caption="<?= e(ps_text('ग्राम ग्रीन चौपाल', 'Village Green Chaupal')) ?>" class="absolute inset-0 bg-deep-forest/60 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center text-pure-white font-label-md text-label-md font-bold gap-1">
            <span class="material-symbols-outlined text-[20px]">zoom_in</span>
            <span><?= e(ps_text('चित्र देखें', 'View Photo')) ?></span>
          </a>
        </div>
      </div>
    </div>
  </section>

  <!-- Join Green Gang Registration Form & Callout -->
  <section id="join-green-gang-section" class="w-full bg-soft-meadow py-space-3xl">
    <div class="max-w-container-editorial mx-auto px-4 sm:px-8">
      <div class="text-center mb-8">
        <span class="inline-block bg-cream-canvas border border-border-warm text-primary-container px-3 py-1 rounded-md font-label-md text-label-md uppercase mb-2 font-semibold">
          <?= e(ps_text('अपने गाँव / विद्यालय में ग्रीन गैंग शाखा खोलें', 'Start a Green Gang Unit')) ?>
        </span>
        <h2 class="font-headline-lg text-headline-lg text-deep-forest mb-3 font-bold">
          <?= e(ps_text('ग्रीन गैंग में शामिल हों अथवा पौध मंगवाएं', 'Join Green Gang or Request Saplings')) ?>
        </h2>
        <p class="font-body-md text-body-md text-on-surface-variant">
          <?= e(ps_text('यदि आप अपने गाँव, पंचायत अथवा विद्यालय में ग्रीन गैंग की शाखा शुरू करना चाहते हैं, तो विवरण दर्ज करें।', 'Enroll to start a Green Gang chapter or request native tree saplings for your area.')) ?>
        </p>
      </div>

      <div class="bg-pure-white rounded-3xl p-6 sm:p-10 shadow-md border border-border-warm">
        <form method="post" action="<?= e(base_url('/contact')) ?>" class="space-y-5">
          <?= csrf_field() ?>
          <input type="hidden" name="form_type" value="contact">
          <input type="hidden" name="subject" value="ग्रीन गैंग शाखा पंजीकरण / पौध मांग">

          <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
            <div>
              <label class="block font-label-md text-label-md text-on-surface mb-1.5 font-semibold"><?= e(ps_text('आपका नाम *', 'Full Name *')) ?></label>
              <input type="text" name="name" required class="w-full bg-soft-meadow border border-border-warm text-on-surface px-4 py-3 rounded-xl font-body-md text-body-md focus:outline-none focus:ring-2 focus:ring-primary-container">
            </div>
            <div>
              <label class="block font-label-md text-label-md text-on-surface mb-1.5 font-semibold"><?= e(ps_text('मोबाइल / WhatsApp *', 'Mobile / WhatsApp *')) ?></label>
              <input type="tel" name="phone" required class="w-full bg-soft-meadow border border-border-warm text-on-surface px-4 py-3 rounded-xl font-body-md text-body-md focus:outline-none focus:ring-2 focus:ring-primary-container">
            </div>
          </div>

          <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
            <div>
              <label class="block font-label-md text-label-md text-on-surface mb-1.5 font-semibold"><?= e(ps_text('गाँव / स्कूल / संस्था का नाम *', 'Village / School / Org Name *')) ?></label>
              <input type="text" name="address" required class="w-full bg-soft-meadow border border-border-warm text-on-surface px-4 py-3 rounded-xl font-body-md text-body-md focus:outline-none focus:ring-2 focus:ring-primary-container">
            </div>
            <div>
              <label class="block font-label-md text-label-md text-on-surface mb-1.5 font-semibold"><?= e(ps_text('कितने पौधों की आवश्यकता है?', 'Required Sapling Count')) ?></label>
              <select name="message" class="w-full bg-soft-meadow border border-border-warm text-on-surface px-4 py-3 rounded-xl font-body-md text-body-md focus:outline-none focus:ring-2 focus:ring-primary-container">
                <option value="10-50 पौध (छोटे स्तर पर)"><?= e(ps_text('10 — 50 पौध (छोटे स्तर पर)', '10 — 50 Saplings (Small Scale)')) ?></option>
                <option value="50-200 पौध (गाँव / स्कूल स्तर)"><?= e(ps_text('50 — 200 पौध (गाँव / स्कूल स्तर)', '50 — 200 Saplings (Village Level)')) ?></option>
                <option value="200+ पौध (पंचायत स्तर)"><?= e(ps_text('200+ पौध (पंचायत स्तर)', '200+ Saplings (Panchayat Scale)')) ?></option>
              </select>
            </div>
          </div>

          <button type="submit" class="w-full bg-primary-container hover:bg-deep-forest text-on-primary py-4 px-6 rounded-xl font-label-md text-label-md font-bold transition-colors flex items-center justify-center gap-2 shadow-sm">
            <span class="material-symbols-outlined text-[20px]">eco</span>
            <span><?= e(ps_text('ग्रीन गैंग पंजीकरण जमा करें (Submit Enrollment)', 'Submit Enrollment')) ?></span>
          </button>
        </form>
      </div>
    </div>
  </section>
</div>

<!-- ========================================================================= -->
<!-- COMPONENT STYLES & INTERACTIVE SCRIPT FOR ALWAYS-OPEN PARCHMENT SCROLL     -->
<!-- ========================================================================= -->
<style>
/* Unrolled Paper Styling */
.ps-unrolled-scroll-paper {
  background: #fffdf7;
  background-image: 
    radial-gradient(#b48a3c 0.6px, transparent 0.6px),
    radial-gradient(#b48a3c 0.6px, #fffdf7 0.6px);
  background-size: 24px 24px;
  background-position: 0 0, 12px 12px;
  box-shadow: 
    0 25px 50px -12px rgba(20, 83, 45, 0.25),
    inset 0 0 70px rgba(180, 138, 60, 0.12);
}

/* Ornate Corner SVG Accents */
.ps-corner-ornament {
  position: absolute;
  width: 48px;
  height: 48px;
  background-repeat: no-repeat;
  background-size: contain;
  opacity: 0.75;
}

@media (min-width: 640px) {
  .ps-corner-ornament {
    width: 64px;
    height: 64px;
  }
}

.ps-corner-tl {
  top: 14px;
  left: 14px;
  background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100' fill='%23b48a3c'%3E%3Cpath d='M0 0 L50 0 C25 10 10 25 0 50 Z'/%3E%3Ccircle cx='25' cy='25' r='10' fill='none' stroke='%23b48a3c' stroke-width='3'/%3E%3Cpath d='M10 90 L10 10 L90 10' fill='none' stroke='%23b48a3c' stroke-width='4'/%3E%3C/svg%3E");
}

.ps-corner-tr {
  top: 14px;
  right: 14px;
  transform: scaleX(-1);
  background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100' fill='%23b48a3c'%3E%3Cpath d='M0 0 L50 0 C25 10 10 25 0 50 Z'/%3E%3Ccircle cx='25' cy='25' r='10' fill='none' stroke='%23b48a3c' stroke-width='3'/%3E%3Cpath d='M10 90 L10 10 L90 10' fill='none' stroke='%23b48a3c' stroke-width='4'/%3E%3C/svg%3E");
}

.ps-corner-bl {
  bottom: 14px;
  left: 14px;
  transform: scaleY(-1);
  background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100' fill='%23b48a3c'%3E%3Cpath d='M0 0 L50 0 C25 10 10 25 0 50 Z'/%3E%3Ccircle cx='25' cy='25' r='10' fill='none' stroke='%23b48a3c' stroke-width='3'/%3E%3Cpath d='M10 90 L10 10 L90 10' fill='none' stroke='%23b48a3c' stroke-width='4'/%3E%3C/svg%3E");
}

.ps-corner-br {
  bottom: 14px;
  right: 14px;
  transform: scale(-1, -1);
  background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100' fill='%23b48a3c'%3E%3Cpath d='M0 0 L50 0 C25 10 10 25 0 50 Z'/%3E%3Ccircle cx='25' cy='25' r='10' fill='none' stroke='%23b48a3c' stroke-width='3'/%3E%3Cpath d='M10 90 L10 10 L90 10' fill='none' stroke='%23b48a3c' stroke-width='4'/%3E%3C/svg%3E");
}

/* Print Specific Rules */
@media print {
  .sticky,
  details {
    display: none !important;
  }
  .ps-unrolled-scroll-paper {
    box-shadow: none !important;
    border: 2px solid #b48a3c !important;
  }
}
</style>

<script>
// Exact verbatim text stored for programmatic copy & print
const PS_RAW_CHARTER_TEXT = <?= json_encode($rawCharterText, JSON_UNESCAPED_UNICODE) ?>;

function copyFullCharterText() {
  const onSuccess = () => {
    const btnText = document.getElementById('ps-copy-btn-text');
    if (btnText) {
      const orig = btnText.textContent;
      btnText.textContent = '✓ सम्पूर्ण पाठ कॉपी हो गया!';
      setTimeout(() => {
        btnText.textContent = orig;
      }, 3000);
    }
  };

  if (navigator.clipboard && navigator.clipboard.writeText) {
    navigator.clipboard.writeText(PS_RAW_CHARTER_TEXT).then(onSuccess).catch(() => {
      fallbackCopyText(PS_RAW_CHARTER_TEXT, onSuccess);
    });
  } else {
    fallbackCopyText(PS_RAW_CHARTER_TEXT, onSuccess);
  }
}

function fallbackCopyText(text, callback) {
  const el = document.createElement('textarea');
  el.value = text;
  el.setAttribute('readonly', '');
  el.style.position = 'absolute';
  el.style.left = '-9999px';
  document.body.appendChild(el);
  el.select();
  document.execCommand('copy');
  document.body.removeChild(el);
  if (callback) callback();
}

function filterCharterRules(query) {
  const q = (query || '').trim().toLowerCase();
  const ruleCards = document.querySelectorAll('.charter-rule-card');

  ruleCards.forEach(card => {
    if (!q) {
      card.style.display = '';
      return;
    }
    const ruleNum = card.getAttribute('data-rule-num') || '';
    const text = card.textContent.toLowerCase();

    if (ruleNum === q || text.includes(q)) {
      card.style.display = '';
    } else {
      card.style.display = 'none';
    }
  });
}
</script>
