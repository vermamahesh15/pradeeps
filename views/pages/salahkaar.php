<?php
declare(strict_types=1);
$currentLang = current_lang();
$contactPhone = $settings['phone'] ?? '+91 9919007190';
$phone = !empty($contactPhone) ? $contactPhone : '+91 9919007190';
$phoneClean = preg_replace('/[^+0-9]/', '', $phone);
$whatsappUrl = "https://api.whatsapp.com/send?phone=" . urlencode($phoneClean) . "&text=" . urlencode(ps_text('नमस्ते श्री सारंग जी, मुझे मार्गदर्शन व सलाह की आवश्यकता है।', 'Hello Shri Sarang ji, I need guidance and counselling.'));
?>

<div class="flex flex-col w-full">
    <!-- Top Ambient Scrim & Hero Banner Section -->
    <section class="relative w-full overflow-hidden bg-surface-container-lowest border-b border-border-warm/50">
        <div class="absolute inset-0 bg-gradient-to-b from-surface-container-low/60 via-cream-canvas to-pure-white pointer-events-none"></div>
        
        <div class="relative max-w-container-max mx-auto px-4 sm:px-8 pt-6 pb-12">
            <!-- Breadcrumb Navigation -->
            <nav aria-label="<?= e(ps_text('ब्रेडक्रंब', 'Breadcrumb')) ?>" class="flex items-center gap-2 font-label-md text-label-md text-text-muted mb-6">
                <a class="hover:text-primary transition-colors flex items-center gap-1" href="<?= e(base_url('/')) ?>">
                    <span class="material-symbols-outlined text-[16px]">home</span>
                    <span><?= e(ps_text('गृह (Home)', 'Home')) ?></span>
                </a>
                <span class="material-symbols-outlined text-[14px] text-outline-variant">chevron_right</span>
                <span class="text-deep-forest font-semibold"><?= e(ps_text('सलाहकार एवं मार्गदर्शन (Counsellor & Guidance)', 'Counsellor & Guidance')) ?></span>
            </nav>

            <!-- Hero Header Content Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-center">
                <div class="lg:col-span-7 flex flex-col items-start">
                    <div class="inline-flex items-center gap-2 px-3.5 py-1.5 bg-surface-container-high rounded-full font-label-md text-label-md text-deep-forest mb-5 shadow-xs border border-border-warm/60">
                        <span class="material-symbols-outlined text-[18px] text-primary" style="font-variation-settings: 'FILL' 1;">volunteer_activism</span>
                        <span><?= e(ps_text('नि:स्वार्थ जन-मार्गदर्शन एवं सामाजिक चिंतन', 'Compassionate Life & Social Guidance')) ?></span>
                    </div>

                    <h1 class="font-headline-lg text-3xl sm:text-4xl lg:text-5xl text-deep-forest mb-5 tracking-tight leading-tight font-bold">
                        <?= e(ps_text('उलझ जाए मन, न दिखे कोई राह — संवेदनशीलता से सुनेंगे, व्यावहारिक राह दिखाएंगे', 'When the Mind Feels Clouded — Empathetic Listening & Practical Guidance')) ?>
                    </h1>

                    <p class="font-body-lg text-lg text-on-surface-variant mb-8 leading-relaxed">
                        <?= e(ps_text(
                            'श्री प्रदीप सारंग कोई व्यावसायिक ज्योतिषी या कर्मकांडी नहीं हैं; वे एक संवेदनशील सामाजिक चिंतक, अवधी साहित्यकार एवं चार दशकों के अनुभवी जनसेवक हैं। आपकी समस्याओं का गंभीर, निष्पक्ष, वैज्ञानिक व व्यावहारिक अध्ययन कर उचित दिशा प्रदान करना ही उनका ध्येय है।',
                            'Shri Pradeep Sarang is not a commercial astrologer or ritualist. He is a compassionate social thinker, Awadhi literary voice, and public servant with over 40 years of wisdom. His mission is to listen with patience and offer practical, rational life direction.'
                        )) ?>
                    </p>

                    <!-- Trust Badges Grid -->
                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 w-full mb-8">
                        <div class="flex flex-col p-3 rounded-xl bg-soft-meadow text-deep-forest shadow-xs border border-border-warm/50">
                            <span class="material-symbols-outlined text-primary text-[24px] mb-1">lock</span>
                            <span class="font-label-md text-label-md font-bold"><?= e(ps_text('शत-प्रतिशत गोपनीयता', '100% Confidential')) ?></span>
                            <span class="font-label-sm text-label-sm text-text-muted"><?= e(ps_text('100% Confidential', 'Private & Secure')) ?></span>
                        </div>
                        <div class="flex flex-col p-3 rounded-xl bg-soft-meadow text-deep-forest shadow-xs border border-border-warm/50">
                            <span class="material-symbols-outlined text-primary text-[24px] mb-1">favorite</span>
                            <span class="font-label-md text-label-md font-bold"><?= e(ps_text('नि:शुल्क व नि:स्वार्थ भाव', 'Pure Public Service')) ?></span>
                            <span class="font-label-sm text-label-sm text-text-muted"><?= e(ps_text('No Fee / No Charges', 'Zero Cost Service')) ?></span>
                        </div>
                        <div class="flex flex-col p-3 rounded-xl bg-soft-meadow text-deep-forest shadow-xs border border-border-warm/50">
                            <span class="material-symbols-outlined text-primary text-[24px] mb-1">history_edu</span>
                            <span class="font-label-md text-label-md font-bold"><?= e(ps_text('चार दशकों का अनुभव', '40+ Yrs Experience')) ?></span>
                            <span class="font-label-sm text-label-sm text-text-muted"><?= e(ps_text('40+ Yrs Public Wisdom', 'Social Leadership')) ?></span>
                        </div>
                        <div class="flex flex-col p-3 rounded-xl bg-soft-meadow text-deep-forest shadow-xs border border-border-warm/50">
                            <span class="material-symbols-outlined text-primary text-[24px] mb-1">record_voice_over</span>
                            <span class="font-label-md text-label-md font-bold"><?= e(ps_text('सीधा व्यक्तिगत संवाद', 'Direct Shri Sarang Call')) ?></span>
                            <span class="font-label-sm text-label-sm text-text-muted"><?= e(ps_text('Direct Personal Call', 'No Intermediaries')) ?></span>
                        </div>
                    </div>

                    <!-- Direct CTA Buttons -->
                    <div class="flex flex-wrap items-center gap-4 w-full">
                        <a class="inline-flex items-center gap-2 px-6 py-3 bg-primary-container text-on-primary rounded-xl font-title-md text-base shadow-md hover:bg-deep-forest transition-all" href="<?= e($whatsappUrl) ?>" rel="noopener noreferrer" target="_blank">
                            <span class="material-symbols-outlined text-[20px]" style="font-variation-settings: 'FILL' 1;">chat</span>
                            <span><?= e(ps_text('व्हाट्सएप पर सीधा संदेश भेजें (' . $phone . ')', 'Send Direct WhatsApp Message (' . $phone . ')')) ?></span>
                        </a>
                        <a class="inline-flex items-center gap-2 px-6 py-3 bg-surface-container text-deep-forest rounded-xl font-title-md text-base hover:bg-surface-container-high transition-all shadow-xs border border-border-warm" href="#consultation-form">
                            <span class="material-symbols-outlined text-[20px]">calendar_month</span>
                            <span><?= e(ps_text('कॉल समय हेतु फॉर्म भरें', 'Fill Request Form')) ?></span>
                        </a>
                    </div>
                </div>

                <!-- Hero Portrait Card -->
                <div class="lg:col-span-5 relative">
                    <div class="relative rounded-2xl overflow-hidden bg-surface-container-high shadow-xl border border-border-warm">
                        <img class="w-full h-[440px] sm:h-[480px] object-cover object-center" 
                             src="<?= e(asset('images/pradeepsarang.webp')) ?>" 
                             width="480" height="480" decoding="async" fetchpriority="high"
                             alt="<?= e(ps_text('श्री प्रदीप सारंग - सामाजिक कार्यकर्ता व साहित्यकार', 'Shri Pradeep Sarang - Social Worker & Scholar')) ?>" 
                             loading="eager" />
                        <div class="absolute inset-0 bg-gradient-to-t from-deep-forest/95 via-deep-forest/40 to-transparent flex flex-col justify-end p-6 text-pure-white">
                            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-md bg-pure-white/20 backdrop-blur-md text-primary-fixed font-label-sm text-xs mb-2.5 w-max border border-white/20">
                                <span class="material-symbols-outlined text-[14px]">verified</span>
                                <span><?= e(ps_text('सहानुभूतिपूर्ण व तार्किक दृष्टिकोण', 'Empathetic & Logical Life Guidance')) ?></span>
                            </div>
                            <p class="font-headline-sm text-2xl font-bold text-pure-white mb-1"><?= e(ps_text('श्री प्रदीप सारंग', 'Shri Pradeep Sarang')) ?></p>
                            <p class="font-body-sm text-sm text-surface-variant"><?= e(ps_text('सामाजिक कार्यकर्ता • आयुर्वेद रत्न (1997) • अवधी साहित्यकार', 'Social Leader • Ayurveda Ratna (1997) • Awadhi Scholar')) ?></p>
                            <div class="mt-4 pt-3 border-t border-white/20 flex items-center justify-between text-pure-white/90 font-label-sm text-xs">
                                <span>📍 <?= e(ps_text('बाराबंकी, अवध, उत्तर प्रदेश', 'Barabanki, Awadh, Uttar Pradesh')) ?></span>
                                <span class="text-fresh-sprout font-bold"><?= e(ps_text('निःशुल्क जन-परामर्श', 'Free Public Service')) ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Core Clarification & Ethical Manifesto -->
    <section class="w-full bg-soft-meadow py-12 md:py-16 border-b border-border-warm/60">
        <div class="max-w-container-editorial mx-auto px-4 sm:px-8">
            <div class="rounded-2xl bg-pure-white p-6 sm:p-10 shadow-md relative overflow-hidden border border-border-warm">
                <div class="absolute top-0 left-0 w-2.5 h-full bg-secondary"></div>
                <div class="flex items-start gap-4 sm:gap-6">
                    <span class="material-symbols-outlined text-secondary text-[44px] shrink-0" style="font-variation-settings: 'FILL' 1;">psychology_alt</span>
                    <div class="flex flex-col">
                        <div class="inline-block font-label-md text-xs font-bold text-secondary uppercase tracking-widest mb-2">
                            <?= e(ps_text('मार्गदर्शन सिद्धांत • स्पष्टता एवं शुचिता', 'Ethical Manifesto • Clarity & Purity')) ?>
                        </div>
                        <h2 class="font-headline-md text-2xl sm:text-3xl text-deep-forest mb-4 font-bold">
                            <?= e(ps_text('ज्योतिषी नहीं, संवेदनशील श्रोता व विश्लेषक', 'Not an Astrologer, But an Empathetic Listener & Counselor')) ?>
                        </h2>
                        <p class="font-quote-editorial text-lg sm:text-xl text-on-surface leading-relaxed mb-6 italic text-gray-800">
                            <?= e(ps_text(
                                '“श्री सारंग ज्योतिषी, तांत्रिक अथवा कोई कर्मकांडी नहीं हैं। वे किसी असंभव चमत्कार का मिथ्या दावा नहीं करते, बल्कि एक निष्पक्ष श्रोता बनकर आपकी बात को संपूर्ण धैर्य से सुनते हैं, समस्या की वैज्ञानिक व सामाजिक जड़ को समझते हैं और जीवन के व्यावहारिक, सामाजिक व नैतिक सिद्धांतों के आधार पर सर्वोत्तम समाधान सुझाते हैं।”',
                                '“Shri Sarang is not an astrologer, occult practitioner, or ritualist. He makes no false claims of miracles. Instead, he listens to your thoughts with complete patience, diagnoses the practical root cause of difficulties, and suggests dignified, ethical, and logical remedies.”'
                            )) ?>
                        </p>
                        <div class="flex items-center gap-2 text-primary font-title-md text-base sm:text-lg font-semibold">
                            <span class="material-symbols-outlined text-[22px]">hearing</span>
                            <span><?= e(ps_text('“सुनना ही आधी समस्या का समाधान है — धैर्य, शुचिता और आत्मीयता से समाधान की ओर।”', '“Listening is half the solution — patience and compassion lead the way.”')) ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 8 Comprehensive Pillars of Guidance -->
    <section class="w-full bg-cream-canvas py-14 md:py-20 border-b border-border-warm/60">
        <div class="max-w-container-max mx-auto px-4 sm:px-8">
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-12">
                <div class="max-w-2xl">
                    <div class="inline-flex items-center gap-1.5 text-secondary font-label-md text-xs font-bold uppercase tracking-wider mb-2">
                        <span class="material-symbols-outlined text-[18px]">tune</span>
                        <span><?= e(ps_text('सहयोग व मार्गदर्शन के क्षेत्र (Spheres of Guidance)', 'Spheres of Guidance')) ?></span>
                    </div>
                    <h2 class="font-headline-lg text-3xl sm:text-4xl text-deep-forest font-bold">
                        <?= e(ps_text('किन विषयों पर आप श्री सारंग जी से निःसंकोच सलाह ले सकते हैं?', 'What Areas Can You Seek Guidance On?')) ?>
                    </h2>
                </div>
                <p class="font-body-md text-base text-text-muted mt-3 md:mt-0 max-w-md">
                    <?= e(ps_text(
                        'व्यक्तिगत, मानसिक, सामाजिक अथवा पारिवारिक जीवन में उठने वाले द्वंद्वों को समझने व सुलझाने के लिए ४० वर्षों का व्यावहारिक अनुभव आपके साथ है।',
                        '40+ years of social wisdom available to help resolve personal, emotional, family, or community dilemmas.'
                    )) ?>
                </p>
            </div>

            <!-- 8-Card Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- 1. Mental Clarity -->
                <div class="flex flex-col bg-pure-white p-6 rounded-2xl shadow-xs hover:shadow-md transition-all border border-border-warm group">
                    <div class="w-12 h-12 rounded-xl bg-surface-container-high flex items-center justify-center text-primary mb-4 group-hover:bg-primary group-hover:text-on-primary transition-colors">
                        <span class="material-symbols-outlined text-[28px]">self_improvement</span>
                    </div>
                    <span class="font-label-sm text-xs text-secondary uppercase font-bold mb-1"><?= e(ps_text('०१ • मानसिक स्पष्टता', '01 • Mental Clarity')) ?></span>
                    <h3 class="font-title-md text-xl text-deep-forest font-bold mb-2"><?= e(ps_text('मानसिक व वैचारिक उलझन', 'Mental & Emotional Confusion')) ?></h3>
                    <p class="font-body-sm text-sm text-on-surface-variant leading-relaxed">
                        <?= e(ps_text('अनिर्णय की स्थिति, अत्यधिक तनाव, अंतर्द्वंद्व और जीवन के उद्देश्य व सही दिशा को लेकर उपजा भारी असमंजस।', 'Overcoming indecision, severe stress, inner conflicts, and discovering clarity regarding life goals.')) ?>
                    </p>
                </div>

                <!-- 2. Family Harmony -->
                <div class="flex flex-col bg-pure-white p-6 rounded-2xl shadow-xs hover:shadow-md transition-all border border-border-warm group">
                    <div class="w-12 h-12 rounded-xl bg-surface-container-high flex items-center justify-center text-primary mb-4 group-hover:bg-primary group-hover:text-on-primary transition-colors">
                        <span class="material-symbols-outlined text-[28px]">diversity_1</span>
                    </div>
                    <span class="font-label-sm text-xs text-secondary uppercase font-bold mb-1"><?= e(ps_text('०२ • पारिवारिक सद्भाव', '02 • Family Harmony')) ?></span>
                    <h3 class="font-title-md text-xl text-deep-forest font-bold mb-2"><?= e(ps_text('पारिवारिक एवं वैवाहिक समन्वय', 'Family & Marital Reconciliation')) ?></h3>
                    <p class="font-body-sm text-sm text-on-surface-variant leading-relaxed">
                        <?= e(ps_text('आपसी संवादहीनता, पारिवारिक कलह, पति-पत्नी में मतभेद, पीढ़ियों का अंतर (generation gap) एवं आत्मीय सुलह के सूत्र।', 'Communication breakdown, household disputes, marital differences, generation gap, and peaceful resolution.')) ?>
                    </p>
                </div>

                <!-- 3. Social Issues -->
                <div class="flex flex-col bg-pure-white p-6 rounded-2xl shadow-xs hover:shadow-md transition-all border border-border-warm group">
                    <div class="w-12 h-12 rounded-xl bg-surface-container-high flex items-center justify-center text-primary mb-4 group-hover:bg-primary group-hover:text-on-primary transition-colors">
                        <span class="material-symbols-outlined text-[28px]">groups</span>
                    </div>
                    <span class="font-label-sm text-xs text-secondary uppercase font-bold mb-1"><?= e(ps_text('०३ • जन-सहभागिता', '03 • Community Harmony')) ?></span>
                    <h3 class="font-title-md text-xl text-deep-forest font-bold mb-2"><?= e(ps_text('सामाजिक एवं सामुदायिक समस्याएँ', 'Community & Social Disputes')) ?></h3>
                    <p class="font-body-sm text-sm text-on-surface-variant leading-relaxed">
                        <?= e(ps_text('गाँव व टोला स्तर के विवाद, सामाजिक न्याय, पंचायती मध्यस्थता तथा सामुदायिक सहयोग द्वारा जटिल विवादों का शांतिपूर्ण निवारण।', 'Village disputes, social justice issues, panchayat mediation, and constructive community consensus building.')) ?>
                    </p>
                </div>

                <!-- 4. Youth Mentorship -->
                <div class="flex flex-col bg-pure-white p-6 rounded-2xl shadow-xs hover:shadow-md transition-all border border-border-warm group">
                    <div class="w-12 h-12 rounded-xl bg-surface-container-high flex items-center justify-center text-primary mb-4 group-hover:bg-primary group-hover:text-on-primary transition-colors">
                        <span class="material-symbols-outlined text-[28px]">school</span>
                    </div>
                    <span class="font-label-sm text-xs text-secondary uppercase font-bold mb-1"><?= e(ps_text('०४ • युवा मार्गदर्शन', '04 • Youth Mentorship')) ?></span>
                    <h3 class="font-title-md text-xl text-deep-forest font-bold mb-2"><?= e(ps_text('युवा प्रेरणा व करियर द्वंद्व', 'Youth Inspiration & Career Path')) ?></h3>
                    <p class="font-body-sm text-sm text-on-surface-variant leading-relaxed">
                        <?= e(ps_text('लक्ष्य निर्धारण, ग्रामीण व कस्बाई युवाओं में हीनभावना दूर करना, सेवा, कृषि-उद्यमिता व स्वरोजगार के अवसरों की सटीक समझ।', 'Goal setting, boosting confidence among rural youth, self-employment, and sustainable agricultural entrepreneurship.')) ?>
                    </p>
                </div>

                <!-- 5. Emotional Solitude -->
                <div class="flex flex-col bg-pure-white p-6 rounded-2xl shadow-xs hover:shadow-md transition-all border border-border-warm group">
                    <div class="w-12 h-12 rounded-xl bg-surface-container-high flex items-center justify-center text-primary mb-4 group-hover:bg-primary group-hover:text-on-primary transition-colors">
                        <span class="material-symbols-outlined text-[28px]">healing</span>
                    </div>
                    <span class="font-label-sm text-xs text-secondary uppercase font-bold mb-1"><?= e(ps_text('०५ • भावनात्मक सहारा', '05 • Emotional Healing')) ?></span>
                    <h3 class="font-title-md text-xl text-deep-forest font-bold mb-2"><?= e(ps_text('भावनात्मक आघात व अकेलापन', 'Emotional Trauma & Solitude')) ?></h3>
                    <p class="font-body-sm text-sm text-on-surface-variant leading-relaxed">
                        <?= e(ps_text('जीवन में असफलता, निराशा, अवसाद, विक्षोभ अथवा किसी आत्मीय जन को खो देने के उपरांत उपजे गहरे खालीपन से उबरना।', 'Coping with grief, loneliness, trauma, loss of loved ones, or recovery from personal failures.')) ?>
                    </p>
                </div>

                <!-- 6. Workplace Dynamics -->
                <div class="flex flex-col bg-pure-white p-6 rounded-2xl shadow-xs hover:shadow-md transition-all border border-border-warm group">
                    <div class="w-12 h-12 rounded-xl bg-surface-container-high flex items-center justify-center text-primary mb-4 group-hover:bg-primary group-hover:text-on-primary transition-colors">
                        <span class="material-symbols-outlined text-[28px]">work_history</span>
                    </div>
                    <span class="font-label-sm text-xs text-secondary uppercase font-bold mb-1"><?= e(ps_text('०६ • आजीविका व कार्य', '06 • Career & Ethics')) ?></span>
                    <h3 class="font-title-md text-xl text-deep-forest font-bold mb-2"><?= e(ps_text('व्यावसायिक चुनौतियाँ', 'Workplace & Financial Stress')) ?></h3>
                    <p class="font-body-sm text-sm text-on-surface-variant leading-relaxed">
                        <?= e(ps_text('सहकर्मियों संग तनाव, व्यावसायिक असहजता, ईमानदारी व आर्थिक दबावों के बीच संतुलन साधने की व्यावहारिक नीतियां।', 'Workplace ethics, conflict resolution with colleagues, financial strain, and maintaining personal integrity.')) ?>
                    </p>
                </div>

                <!-- 7. Wholesome Living / Ayurveda -->
                <div class="flex flex-col bg-pure-white p-6 rounded-2xl shadow-xs hover:shadow-md transition-all border border-border-warm group">
                    <div class="w-12 h-12 rounded-xl bg-surface-container-high flex items-center justify-center text-primary mb-4 group-hover:bg-primary group-hover:text-on-primary transition-colors">
                        <span class="material-symbols-outlined text-[28px]">spa</span>
                    </div>
                    <span class="font-label-sm text-xs text-secondary uppercase font-bold mb-1"><?= e(ps_text('०७ • प्राकृतिक दिनचर्या', '07 • Holistic Wellness')) ?></span>
                    <h3 class="font-title-md text-xl text-deep-forest font-bold mb-2"><?= e(ps_text('शारीरिक व प्राकृतिक स्वास्थ्य', 'Natural Lifestyle & Ayurveda')) ?></h3>
                    <p class="font-body-sm text-sm text-on-surface-variant leading-relaxed">
                        <?= e(ps_text('आयुर्वेद रत्न (1997) ज्ञान परंपरा पर आधारित सात्विक आहार-विहार, ऋतुचर्या, रोग-प्रतिरोधक क्षमता व प्राकृतिक संतुलन।', 'Ayurveda Ratna wisdom (1997) for holistic health, seasonal regimen, immunity, and natural lifestyle balance.')) ?>
                    </p>
                </div>

                <!-- 8. Spiritual / Kabirian Philosophy -->
                <div class="flex flex-col bg-pure-white p-6 rounded-2xl shadow-xs hover:shadow-md transition-all border border-border-warm group">
                    <div class="w-12 h-12 rounded-xl bg-surface-container-high flex items-center justify-center text-primary mb-4 group-hover:bg-primary group-hover:text-on-primary transition-colors">
                        <span class="material-symbols-outlined text-[28px]">menu_book</span>
                    </div>
                    <span class="font-label-sm text-xs text-secondary uppercase font-bold mb-1"><?= e(ps_text('०८ • सहज दर्शन', '08 • Practical Living')) ?></span>
                    <h3 class="font-title-md text-xl text-deep-forest font-bold mb-2"><?= e(ps_text('नैतिक व आध्यात्मिक जिज्ञासा', 'Ethical & Spiritual Queries')) ?></h3>
                    <p class="font-body-sm text-sm text-on-surface-variant leading-relaxed">
                        <?= e(ps_text('कबीर, तुलसी और महात्मा गांधी के सिद्धांतों पर आधारित व्यावहारिक जीवन-दर्शन, आंतरिक संतोष और सहज आचरण का पथ।', 'Living by the timeless wisdom of Kabir, Tulsi, and Gandhi for peace of mind, integrity, and spiritual contentment.')) ?>
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Process: 4-Step Confidential Workflow -->
    <section class="w-full bg-soft-meadow py-14 md:py-20 border-b border-border-warm/60">
        <div class="max-w-container-max mx-auto px-4 sm:px-8">
            <div class="text-center max-w-container-editorial mx-auto mb-12">
                <span class="font-label-md text-xs text-primary font-bold uppercase tracking-wider"><?= e(ps_text('पारदर्शी एवं सहज प्रक्रिया', 'Transparent & Simple Process')) ?></span>
                <h2 class="font-headline-lg text-3xl sm:text-4xl text-deep-forest mt-1 mb-2 font-bold">
                    <?= e(ps_text('परामर्श कैसे प्राप्त करें? ४ सरल व गोपनीय चरण', 'How to Seek Guidance? 4 Simple & Confidential Steps')) ?>
                </h2>
                <p class="font-body-md text-base text-on-surface-variant">
                    <?= e(ps_text('आपकी गोपनीयता हमारी सर्वोच्च मर्यादा है। किसी मध्यस्थ के बिना सीधा संवाद श्री प्रदीप सारंग जी से ही होता है।', 'Your privacy is our utmost priority. You connect directly with Shri Pradeep Sarang without third-party involvement.')) ?>
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 relative">
                <!-- Step 1 -->
                <div class="flex flex-col bg-pure-white rounded-2xl p-6 shadow-xs border border-border-warm relative z-10">
                    <div class="flex items-center justify-between mb-4">
                        <span class="text-4xl font-headline-lg text-primary-fixed-dim leading-none font-bold">०१</span>
                        <div class="w-10 h-10 rounded-full bg-soft-meadow flex items-center justify-center text-primary">
                            <span class="material-symbols-outlined text-[20px]">sms</span>
                        </div>
                    </div>
                    <h3 class="font-title-md text-lg text-deep-forest font-bold mb-2"><?= e(ps_text('अपनी समस्या संक्षेप में लिखें', 'Share Your Query Briefly')) ?></h3>
                    <p class="font-body-sm text-sm text-on-surface-variant leading-relaxed">
                        <?= e(ps_text('श्री सारंग जी के निजी व्हाट्सएप नंबर ' . $phone . ' पर अपनी परेशानी या संदेश संक्षेप में लिखकर भेजें।', 'Send a concise WhatsApp message outlining your concern to ' . $phone . '.')) ?>
                    </p>
                </div>

                <!-- Step 2 -->
                <div class="flex flex-col bg-pure-white rounded-2xl p-6 shadow-xs border border-border-warm relative z-10">
                    <div class="flex items-center justify-between mb-4">
                        <span class="text-4xl font-headline-lg text-primary-fixed-dim leading-none font-bold">०२</span>
                        <div class="w-10 h-10 rounded-full bg-soft-meadow flex items-center justify-center text-primary">
                            <span class="material-symbols-outlined text-[20px]">schedule</span>
                        </div>
                    </div>
                    <h3 class="font-title-md text-lg text-deep-forest font-bold mb-2"><?= e(ps_text('समय का निर्धारण', 'Slot Scheduling')) ?></h3>
                    <p class="font-body-sm text-sm text-on-surface-variant leading-relaxed">
                        <?= e(ps_text('यदि पूरा विवरण लिखना कठिन हो, तो बस संक्षिप्त संदेश भेजकर बात करने का उपयुक्त समय (कॉल स्लॉट) मांग लीजिए।', 'Or request a suitable callback slot if writing detailed messages feels overwhelming.')) ?>
                    </p>
                </div>

                <!-- Step 3 -->
                <div class="flex flex-col bg-pure-white rounded-2xl p-6 shadow-xs border border-border-warm relative z-10">
                    <div class="flex items-center justify-between mb-4">
                        <span class="text-4xl font-headline-lg text-primary-fixed-dim leading-none font-bold">०३</span>
                        <div class="w-10 h-10 rounded-full bg-soft-meadow flex items-center justify-center text-primary">
                            <span class="material-symbols-outlined text-[20px]">phone_callback</span>
                        </div>
                    </div>
                    <h3 class="font-title-md text-lg text-deep-forest font-bold mb-2"><?= e(ps_text('सारंग जी द्वारा व्यक्तिगत कॉल', 'Personal Call from Shri Sarang')) ?></h3>
                    <p class="font-body-sm text-sm text-on-surface-variant leading-relaxed">
                        <?= e(ps_text('नियत समय पर श्री सारंग जी स्वयं आपके दिए गए नंबर पर कॉल करेंगे और पूरे धैर्य तथा आत्मीयता से आपकी बात सुनेंगे।', 'At the scheduled time, Shri Sarang personally calls you to listen attentively.')) ?>
                    </p>
                </div>

                <!-- Step 4 -->
                <div class="flex flex-col bg-pure-white rounded-2xl p-6 shadow-xs border border-border-warm relative z-10">
                    <div class="flex items-center justify-between mb-4">
                        <span class="text-4xl font-headline-lg text-primary-fixed-dim leading-none font-bold">०४</span>
                        <div class="w-10 h-10 rounded-full bg-soft-meadow flex items-center justify-center text-primary">
                            <span class="material-symbols-outlined text-[20px]">verified</span>
                        </div>
                    </div>
                    <h3 class="font-title-md text-lg text-deep-forest font-bold mb-2"><?= e(ps_text('व्यावहारिक समाधान व दिशा', 'Practical Remedies & Path')) ?></h3>
                    <p class="font-body-sm text-sm text-on-surface-variant leading-relaxed">
                        <?= e(ps_text('समस्या के सभी आयामों का गंभीर व तार्किक विश्लेषण कर जीवन में स्थायी शांति और गरिमापूर्ण समाधान प्रदान किया जाएगा।', 'Receiving practical, dignified solutions to restore peace and direction.')) ?>
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Privacy Guarantee Banner & WhatsApp Connect -->
    <section class="w-full bg-deep-forest text-pure-white py-12 md:py-16">
        <div class="max-w-container-max mx-auto px-4 sm:px-8">
            <div class="rounded-3xl bg-surface-container-highest/10 p-6 sm:p-10 backdrop-blur-sm shadow-xl flex flex-col lg:flex-row items-center justify-between gap-8 border border-white/10">
                <div class="flex items-start gap-4 sm:gap-6 max-w-2xl">
                    <div class="w-14 h-14 sm:w-16 sm:h-16 rounded-2xl bg-primary-container flex items-center justify-center text-pure-white shrink-0 shadow-md">
                        <span class="material-symbols-outlined text-[36px]">security</span>
                    </div>
                    <div class="flex flex-col">
                        <div class="inline-flex items-center gap-1.5 text-fresh-sprout font-label-md text-xs uppercase font-bold tracking-wider mb-1">
                            <span class="material-symbols-outlined text-[16px]">verified_user</span>
                            <span><?= e(ps_text('पूर्ण व्यक्तिगत गोपनीयता की गारंटी', '100% Confidentiality Guarantee')) ?></span>
                        </div>
                        <h3 class="font-headline-md text-2xl sm:text-3xl text-pure-white mb-2 font-bold">
                            <?= e(ps_text('आपकी पहचान और चर्चा पूर्णतः सुरक्षित है', 'Your Identity & Conversations are Completely Private')) ?>
                        </h3>
                        <p class="font-body-md text-base text-surface-variant leading-relaxed">
                            <?= e(ps_text(
                                'यह श्री प्रदीप सारंग जी का निजी एवं व्यक्तिगत फोन/व्हाट्सएप नंबर है। आपकी व्यक्तिगत, पारिवारिक अथवा सामाजिक बातें किसी भी परिस्थिति में सार्वजनिक नहीं की जाती हैं। बिना किसी संकोच के अपनी बात साझा करें।',
                                'This is Shri Pradeep Sarang’s direct phone and WhatsApp number. Your personal or family concerns are strictly private and never shared.'
                            )) ?>
                        </p>
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row items-center gap-4 w-full lg:w-auto shrink-0">
                    <a class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-6 py-3.5 bg-fresh-sprout text-deep-forest font-title-md text-base rounded-xl hover:bg-pure-white transition-all shadow-md font-bold" href="<?= e($whatsappUrl) ?>" rel="noopener noreferrer" target="_blank">
                        <span class="material-symbols-outlined text-[22px]" style="font-variation-settings: 'FILL' 1;">chat</span>
                        <span><?= e($phone) ?></span>
                    </a>
                    <a class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-6 py-3.5 bg-pure-white/10 hover:bg-pure-white/20 text-pure-white font-title-md text-base rounded-xl transition-all border border-white/20" href="tel:<?= e($phoneClean) ?>">
                        <span class="material-symbols-outlined text-[20px]">call</span>
                        <span><?= e(ps_text('कॉल करें', 'Call Directly')) ?></span>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Interactive Form & Guidance Desk Layout -->
    <section class="w-full bg-cream-canvas py-14 md:py-20 border-b border-border-warm/60" id="consultation-form">
        <div class="max-w-container-max mx-auto px-4 sm:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-12 items-start">
                <!-- Left Column: Guidance Desk Context & Photo -->
                <div class="lg:col-span-5 flex flex-col">
                    <span class="font-label-md text-xs text-secondary font-bold uppercase tracking-widest mb-1"><?= e(ps_text('सीधा संपर्क मंच', 'Direct Contact Portal')) ?></span>
                    <h2 class="font-headline-lg text-3xl sm:text-4xl text-deep-forest mb-4 font-bold">
                        <?= e(ps_text('परामर्श व मार्गदर्शन हेतु अनुरोध प्रपत्र', 'Guidance Request Form')) ?>
                    </h2>
                    <p class="font-body-md text-base text-on-surface-variant mb-6 leading-relaxed">
                        <?= e(ps_text(
                            'यदि आप तुरंत फोन करने में असहज महसूस कर रहे हैं या अपनी बात को लिखकर साझा करना चाहते हैं, तो नीचे दिया गया प्रपत्र भरें। आपकी दी गई जानकारी सीधे श्री सारंग जी के व्यक्तिगत अवलोकन हेतु ही सुरक्षित रहेगी।',
                            'If you prefer to write down your concerns before speaking, please complete this form. Your submission goes directly to Shri Pradeep Sarang.'
                        )) ?>
                    </p>

                    <!-- Documentary Photo Card (Space for Images) -->
                    <div class="rounded-2xl overflow-hidden bg-surface-container-high shadow-md mb-6 border border-border-warm">
                        <img class="w-full h-56 sm:h-64 object-cover" 
                             src="<?= e(asset('images/slider_final_1.jpg')) ?>" 
                             alt="<?= e(ps_text('सारंग सेवा सदन - विचार एवं संवाद कुटीर', 'Sarang Seva Sadan - Barabanki')) ?>" 
                             loading="lazy" />
                        <div class="p-4 bg-pure-white">
                            <p class="font-title-md text-base font-bold text-deep-forest mb-0.5"><?= e(ps_text('सारंग सेवा सदन — विचार एवं संवाद कुटीर', 'Sarang Seva Sadan — Dialogue Center')) ?></p>
                            <p class="font-body-sm text-xs text-text-muted"><?= e(ps_text('जनपद बाराबंकी, उत्तर प्रदेश • शांति, सादगी और आत्मिक संतोष का परिवेश', 'District Barabanki, UP • Peaceful environment for sincere dialogue')) ?></p>
                        </div>
                    </div>

                    <!-- Quick Guidelines List -->
                    <div class="flex flex-col gap-3 bg-soft-meadow p-4 rounded-xl border border-border-warm/60">
                        <div class="flex items-start gap-2.5">
                            <span class="material-symbols-outlined text-primary text-[20px] shrink-0 mt-0.5">check_circle</span>
                            <span class="font-body-sm text-sm text-deep-forest font-medium"><?= e(ps_text('परामर्श पूर्णतः निःशुल्क है; कोई दक्षिणा या शुल्क स्वीकार नहीं किया जाता।', 'Guidance is completely free of charge. No fees or donations accepted.')) ?></span>
                        </div>
                        <div class="flex items-start gap-2.5">
                            <span class="material-symbols-outlined text-primary text-[20px] shrink-0 mt-0.5">check_circle</span>
                            <span class="font-body-sm text-sm text-deep-forest font-medium"><?= e(ps_text('कॉल का समय आपकी सुविधानुसार तय किया जाएगा ताकि एकांत में बात हो सके।', 'Call timings arranged as per your convenience for quiet conversation.')) ?></span>
                        </div>
                        <div class="flex items-start gap-2.5">
                            <span class="material-symbols-outlined text-primary text-[20px] shrink-0 mt-0.5">check_circle</span>
                            <span class="font-body-sm text-sm text-deep-forest font-medium"><?= e(ps_text('महिलाओं, युवाओं व वृद्धजनों के लिए विशेष संवेदनशीलता व धैर्य।', 'Special patience & empathy for women, youth, and senior citizens.')) ?></span>
                        </div>
                    </div>
                </div>

                <!-- Right Column: Interactive Appointment Request Form -->
                <div class="lg:col-span-7 bg-pure-white rounded-3xl p-6 sm:p-8 shadow-lg relative border border-border-warm">
                    <form class="flex flex-col gap-5" id="guidanceForm" onsubmit="handleGuidanceSubmit(event)">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div class="flex flex-col">
                                <label class="font-label-md text-xs font-bold text-deep-forest mb-1.5" for="fullName">
                                    <?= e(ps_text('आपका नाम (Full Name) *', 'Full Name *')) ?>
                                </label>
                                <input class="bg-surface-container-lowest p-3 rounded-xl font-body-md text-sm text-on-surface border border-border-warm focus:outline-none focus:ring-2 focus:ring-primary" id="fullName" placeholder="<?= e(ps_text('उदा. रमेश कुमार / अंजलि वर्मा', 'e.g. Ramesh Kumar')) ?>" required type="text"/>
                            </div>
                            <div class="flex flex-col">
                                <label class="font-label-md text-xs font-bold text-deep-forest mb-1.5" for="phoneNumber">
                                    <?= e(ps_text('मोबाइल नंबर / व्हाट्सएप (Phone Number) *', 'Phone / WhatsApp Number *')) ?>
                                </label>
                                <input class="bg-surface-container-lowest p-3 rounded-xl font-body-md text-sm text-on-surface border border-border-warm focus:outline-none focus:ring-2 focus:ring-primary" id="phoneNumber" placeholder="+91 98765 43210" required type="tel"/>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div class="flex flex-col">
                                <label class="font-label-md text-xs font-bold text-deep-forest mb-1.5" for="ageProfession">
                                    <?= e(ps_text('आयु एवं पेशा (Age & Occupation - ऐच्छिक)', 'Age & Occupation (Optional)')) ?>
                                </label>
                                <input class="bg-surface-container-lowest p-3 rounded-xl font-body-md text-sm text-on-surface border border-border-warm focus:outline-none focus:ring-2 focus:ring-primary" id="ageProfession" placeholder="<?= e(ps_text('उदा. २८ वर्ष, शिक्षक / छात्र / किसान', 'e.g. 28 Yrs, Teacher / Student')) ?>" type="text"/>
                            </div>
                            <div class="flex flex-col">
                                <label class="font-label-md text-xs font-bold text-deep-forest mb-1.5" for="consultTopic">
                                    <?= e(ps_text('परामर्श का मुख्य विषय (Area of Guidance) *', 'Area of Guidance *')) ?>
                                </label>
                                <select class="bg-surface-container-lowest p-3 rounded-xl font-body-md text-sm text-on-surface border border-border-warm focus:outline-none focus:ring-2 focus:ring-primary" id="consultTopic" required>
                                    <option value=""><?= e(ps_text('-- कृपया विषय चुनें --', '-- Select Consultation Topic --')) ?></option>
                                    <option value="पारिवारिक एवं वैवाहिक समन्वय"><?= e(ps_text('पारिवारिक एवं वैवाहिक समन्वय', 'Family & Marital Reconciliation')) ?></option>
                                    <option value="मानसिक व वैचारिक उलझन"><?= e(ps_text('मानसिक व वैचारिक उलझन / तनाव', 'Mental Confusion & Stress')) ?></option>
                                    <option value="युवा मार्गदर्शन व करियर द्वंद्व"><?= e(ps_text('युवा मार्गदर्शन व करियर द्वंद्व', 'Youth Mentorship & Career Guidance')) ?></option>
                                    <option value="भावनात्मक अकेलापन व आघात"><?= e(ps_text('भावनात्मक अकेलापन व आघात', 'Emotional Solitude & Healing')) ?></option>
                                    <option value="सामाजिक व पंचायती समस्याएँ"><?= e(ps_text('सामाजिक व पंचायती समस्याएँ', 'Community & Social Disputes')) ?></option>
                                    <option value="शारीरिक स्वास्थ्य व प्राकृतिक दिनचर्या"><?= e(ps_text('शारीरिक स्वास्थ्य व प्राकृतिक दिनचर्या (आयुर्वेद)', 'Natural Health & Ayurveda Regimen')) ?></option>
                                    <option value="नैतिक व आध्यात्मिक जिज्ञासा"><?= e(ps_text('नैतिक व आध्यात्मिक जिज्ञासा', 'Ethical & Spiritual Queries')) ?></option>
                                    <option value="अन्य विषय"><?= e(ps_text('अन्य व्यावहारिक विषय', 'Other Practical Concerns')) ?></option>
                                </select>
                            </div>
                        </div>

                        <div class="flex flex-col">
                            <label class="font-label-md text-xs font-bold text-deep-forest mb-2">
                                <?= e(ps_text('बात करने का सुविधाजनक समय (Preferred Time Slot) *', 'Preferred Callback Slot *')) ?>
                            </label>
                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                                <label class="flex items-center gap-2 p-3 rounded-xl bg-soft-meadow cursor-pointer hover:bg-surface-container transition-colors border border-border-warm/60">
                                    <input checked class="text-primary focus:ring-primary" name="timeSlot" type="radio" value="प्रातः ०८:०० से १०:००"/>
                                    <span class="font-body-sm text-xs font-medium text-on-surface"><?= e(ps_text('सुबह ०८:०० - १०:००', 'Morning 08:00 - 10:00')) ?></span>
                                </label>
                                <label class="flex items-center gap-2 p-3 rounded-xl bg-soft-meadow cursor-pointer hover:bg-surface-container transition-colors border border-border-warm/60">
                                    <input class="text-primary focus:ring-primary" name="timeSlot" type="radio" value="दोपहर ०२:०० से ०४:००"/>
                                    <span class="font-body-sm text-xs font-medium text-on-surface"><?= e(ps_text('दोपहर ०२:०० - ०४:००', 'Afternoon 02:00 - 04:00')) ?></span>
                                </label>
                                <label class="flex items-center gap-2 p-3 rounded-xl bg-soft-meadow cursor-pointer hover:bg-surface-container transition-colors border border-border-warm/60">
                                    <input class="text-primary focus:ring-primary" name="timeSlot" type="radio" value="सायं ०६:०० से ०८:३०"/>
                                    <span class="font-body-sm text-xs font-medium text-on-surface"><?= e(ps_text('शाम ०६:०० - ०८:३०', 'Evening 06:00 - 08:30')) ?></span>
                                </label>
                            </div>
                        </div>

                        <div class="flex flex-col">
                            <div class="flex items-center justify-between mb-1.5">
                                <label class="font-label-md text-xs font-bold text-deep-forest" for="problemNote">
                                    <?= e(ps_text('समस्या का संक्षिप्त विवरण (Brief Note - सुरक्षित एवं गोपनीय) *', 'Brief Note on Your Query *')) ?>
                                </label>
                                <span class="font-label-sm text-xs text-text-muted"><?= e(ps_text('संक्षेप में लिखें', 'Keep it brief')) ?></span>
                            </div>
                            <textarea class="bg-surface-container-lowest p-3 rounded-xl font-body-md text-sm text-on-surface border border-border-warm focus:outline-none focus:ring-2 focus:ring-primary" id="problemNote" placeholder="<?= e(ps_text('अपनी समस्या के मुख्य बिंदु संक्षेप में लिखें ताकि सारंग जी विषय को पहले से समझ सकें...', 'Briefly explain your concern so Shri Sarang can understand before calling...')) ?>" required rows="4"></textarea>
                        </div>

                        <div class="p-3 rounded-xl bg-soft-meadow text-deep-forest text-xs font-medium flex items-start gap-2 border border-border-warm/60">
                            <span class="material-symbols-outlined text-primary text-[18px] shrink-0 mt-0.5">verified_user</span>
                            <span><?= e(ps_text('आपकी दी गई समस्त जानकारी शत-प्रतिशत सुरक्षित है और केवल श्री प्रदीप सारंग जी के व्यक्तिगत अवलोकन हेतु ही सुरक्षित रहेगी।', 'All details provided remain strictly confidential and for Shri Pradeep Sarang’s eyes only.')) ?></span>
                        </div>

                        <button class="w-full inline-flex items-center justify-center gap-2 py-3.5 px-6 bg-primary-container text-on-primary font-title-md text-base font-bold rounded-xl shadow-md hover:bg-deep-forest transition-all" type="submit">
                            <span class="material-symbols-outlined text-[20px]">lock</span>
                            <span><?= e(ps_text('गोपनीय परामर्श अनुरोध भेजें (Submit Confidential Request)', 'Submit Confidential Request')) ?></span>
                        </button>
                    </form>

                    <!-- Success Notification Overlay -->
                    <div class="hidden absolute inset-0 bg-pure-white/98 rounded-3xl backdrop-blur-md flex flex-col items-center justify-center p-8 text-center z-20" id="formSuccessToast">
                        <div class="w-16 h-16 rounded-full bg-soft-meadow flex items-center justify-center text-primary mb-4 border border-border-warm">
                            <span class="material-symbols-outlined text-[36px]">task_alt</span>
                        </div>
                        <h3 class="font-headline-md text-2xl font-bold text-deep-forest mb-2"><?= e(ps_text('अनुरोध सफलतापूर्वक प्राप्त हुआ', 'Request Received Successfully')) ?></h3>
                        <p class="font-body-md text-sm text-on-surface-variant max-w-md mb-6 leading-relaxed">
                            <?= e(ps_text(
                                'धन्यवाद! आपकी समस्या का विवरण श्री प्रदीप सारंग जी तक सुरक्षित पहुँच गया है। चयनित समय स्लॉट के भीतर वे स्वयं आपसे संपर्क स्थापित करेंगे।',
                                'Thank you! Your request details have been securely sent to Shri Pradeep Sarang. He will reach out during your selected time slot.'
                            )) ?>
                        </p>
                        <div class="flex flex-wrap items-center justify-center gap-3">
                            <button class="px-5 py-2.5 bg-surface-container text-deep-forest font-label-md text-xs font-bold rounded-lg hover:bg-surface-container-high transition-colors border border-border-warm" onclick="resetGuidanceForm()">
                                <?= e(ps_text('नया अनुरोध भरें', 'Fill Another Request')) ?>
                            </button>
                            <a class="px-5 py-2.5 bg-primary text-on-primary font-label-md text-xs font-bold rounded-lg hover:bg-deep-forest transition-colors flex items-center gap-1.5" href="<?= e($whatsappUrl) ?>" target="_blank" rel="noopener noreferrer">
                                <span class="material-symbols-outlined text-[16px]">chat</span>
                                <span><?= e(ps_text('व्हाट्सएप पर सूचित करें', 'Notify via WhatsApp')) ?></span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Frequently Asked Questions (FAQ Accordion) -->
    <section class="w-full bg-soft-meadow py-14 md:py-20 border-b border-border-warm/60">
        <div class="max-w-container-editorial mx-auto px-4 sm:px-8">
            <div class="text-center mb-12">
                <span class="font-label-md text-xs text-secondary uppercase font-bold tracking-wider"><?= e(ps_text('जिज्ञासा व समाधान', 'Common Queries & Answers')) ?></span>
                <h2 class="font-headline-lg text-3xl sm:text-4xl text-deep-forest mt-1 font-bold">
                    <?= e(ps_text('मार्गदर्शन से संबंधित अक्सर पूछे जाने वाले प्रश्न', 'Frequently Asked Questions')) ?>
                </h2>
                <p class="font-body-md text-base text-text-muted mt-2">
                    <?= e(ps_text('परामर्श सत्र में भाग लेने से पूर्व आपके मन में उठने वाले स्वाभाविक प्रश्नों के स्पष्ट उत्तर', 'Clear answers to questions you may have before reaching out for guidance.')) ?>
                </p>
            </div>

            <div class="flex flex-col gap-4">
                <!-- FAQ 1 -->
                <div class="bg-pure-white rounded-2xl p-6 shadow-xs border border-border-warm">
                    <div class="flex items-start gap-3 sm:gap-4">
                        <span class="w-8 h-8 rounded-full bg-surface-container flex items-center justify-center text-primary font-bold shrink-0 text-sm">प्र</span>
                        <div class="flex flex-col">
                            <h3 class="font-title-md text-lg text-deep-forest font-bold mb-2">
                                <?= e(ps_text('क्या इस मार्गदर्शन अथवा परामर्श का कोई शुल्क या दक्षिणा है?', 'Is there any fee or donation charged for this guidance?')) ?>
                            </h3>
                            <div class="flex items-start gap-2 mt-1 text-on-surface-variant">
                                <span class="font-bold text-secondary text-sm shrink-0"><?= e(ps_text('उत्तर:', 'Answer:')) ?></span>
                                <p class="font-body-md text-sm leading-relaxed">
                                    <strong><?= e(ps_text('कदापि नहीं।', 'Absolutely NOT.')) ?></strong> <?= e(ps_text('यह पूर्णतः नि:स्वार्थ समाजसेवा, मानवीय सरोकार और जनकल्याण का संकल्प है। श्री प्रदीप सारंग जी किसी भी प्रकार का परामर्श शुल्क, दक्षिणा अथवा अप्रत्यक्ष भेंट स्वीकार नहीं करते हैं।', 'This is purely a non-commercial public service initiative. Shri Pradeep Sarang accepts no consultation fees, donations, or hidden charges.')) ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- FAQ 2 -->
                <div class="bg-pure-white rounded-2xl p-6 shadow-xs border border-border-warm">
                    <div class="flex items-start gap-3 sm:gap-4">
                        <span class="w-8 h-8 rounded-full bg-surface-container flex items-center justify-center text-primary font-bold shrink-0 text-sm">प्र</span>
                        <div class="flex flex-col">
                            <h3 class="font-title-md text-lg text-deep-forest font-bold mb-2">
                                <?= e(ps_text('क्या श्री सारंग जी जन्मपत्री, हस्तरेखा या ज्योतिषीय उपाय बताते हैं?', 'Does Shri Sarang prescribe astrological remedies or horoscopes?')) ?>
                            </h3>
                            <div class="flex items-start gap-2 mt-1 text-on-surface-variant">
                                <span class="font-bold text-secondary text-sm shrink-0"><?= e(ps_text('उत्तर:', 'Answer:')) ?></span>
                                <p class="font-body-md text-sm leading-relaxed">
                                    <strong><?= e(ps_text('बिल्कुल नहीं।', 'Not at all.')) ?></strong> <?= e(ps_text('श्री सारंग जी ज्योतिषी या तांत्रिक नहीं हैं। वे किसी चमत्कार अथवा टोटके का दावा नहीं करते। वे तार्किक, व्यावहारिक, सामाजिक और मनोवैज्ञानिक चिंतन के माध्यम से वास्तविक समस्या का मूल कारण पहचान कर समाधान प्रस्तुत करते हैं।', 'Shri Sarang is not an astrologer. He does not offer occult claims. Solutions are derived strictly through logical, practical, ethical, and psychological analysis.')) ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- FAQ 3 -->
                <div class="bg-pure-white rounded-2xl p-6 shadow-xs border border-border-warm">
                    <div class="flex items-start gap-3 sm:gap-4">
                        <span class="w-8 h-8 rounded-full bg-surface-container flex items-center justify-center text-primary font-bold shrink-0 text-sm">प्र</span>
                        <div class="flex flex-col">
                            <h3 class="font-title-md text-lg text-deep-forest font-bold mb-2">
                                <?= e(ps_text('क्या मेरी व्यक्तिगत बात या पहचान किसी तीसरे व्यक्ति को पता चलेगी?', 'Will my personal details or conversation be shared with anyone?')) ?>
                            </h3>
                            <div class="flex items-start gap-2 mt-1 text-on-surface-variant">
                                <span class="font-bold text-secondary text-sm shrink-0"><?= e(ps_text('उत्तर:', 'Answer:')) ?></span>
                                <p class="font-body-md text-sm leading-relaxed">
                                    <strong><?= e(ps_text('कतई नहीं।', 'Never.')) ?></strong> <?= e(ps_text('आपका फोन या व्हाट्सएप संदेश सीधे श्री सारंग जी के निजी फोन पर आता है। कोई सहायक अथवा मध्यस्थ इसे नहीं देखता। आपकी हर बात सौ प्रतिशत गोपनीय और मर्यादित रहती है।', 'Your call or message goes straight to Shri Sarang’s personal phone. No assistants or third parties access it. Complete privacy is guaranteed.')) ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- FAQ 4 -->
                <div class="bg-pure-white rounded-2xl p-6 shadow-xs border border-border-warm">
                    <div class="flex items-start gap-3 sm:gap-4">
                        <span class="w-8 h-8 rounded-full bg-surface-container flex items-center justify-center text-primary font-bold shrink-0 text-sm">प्र</span>
                        <div class="flex flex-col">
                            <h3 class="font-title-md text-lg text-deep-forest font-bold mb-2">
                                <?= e(ps_text('क्या व्यक्तिगत रूप से मिलकर बातचीत की जा सकती है?', 'Is an in-person meeting possible at Sarang Seva Sadan?')) ?>
                            </h3>
                            <div class="flex items-start gap-2 mt-1 text-on-surface-variant">
                                <span class="font-bold text-secondary text-sm shrink-0"><?= e(ps_text('उत्तर:', 'Answer:')) ?></span>
                                <p class="font-body-md text-sm leading-relaxed">
                                    <?= e(ps_text('हाँ, बाराबंकी स्थित \'सारंग सेवा सदन\' में पूर्व अनुमति व समय निर्धारित करके आत्मीय भेंट संभव है। पहले व्हाट्सएप अथवा फोन पर प्राथमिक चर्चा कर समय निश्चित कर लें।', 'Yes, personal meetings can be arranged at Sarang Seva Sadan in Barabanki after prior phone appointment.')) ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Final Compassionate Callout -->
    <section class="w-full bg-surface-container-high py-14 md:py-16">
        <div class="max-w-container-editorial mx-auto px-4 sm:px-8 text-center">
            <div class="w-12 h-12 mx-auto rounded-full bg-primary-container text-on-primary flex items-center justify-center mb-4 shadow-sm">
                <span class="material-symbols-outlined text-[24px]">support_agent</span>
            </div>
            <h3 class="font-headline-md text-2xl sm:text-3xl text-deep-forest mb-3 font-bold">
                <?= e(ps_text('“निराशा को मन पर भारी न होने दें, एक सार्थक संवाद नई दिशा रच सकता है”', '“Do Not Let Despair Burden Your Spirit — A Compassionate Dialogue Can Illuminate a New Path”')) ?>
            </h3>
            <p class="font-body-md text-base text-on-surface-variant mb-8 leading-relaxed max-w-2xl mx-auto">
                <?= e(ps_text(
                    'जीवन अनमोल है। किसी भी विपत्ति, पारिवारिक द्वंद्व अथवा मानसिक उथल-पुथल में स्वयं को अकेला न समझें। जब भी मन थके, निसंकोच संवाद करें।',
                    'Life is priceless. Never feel alone during times of stress, family disputes, or mental exhaustion. Reach out freely whenever you need a listening ear.'
                )) ?>
            </p>
            <div class="flex flex-wrap items-center justify-center gap-4">
                <a class="inline-flex items-center gap-2 px-8 py-3.5 bg-primary-container text-on-primary rounded-xl font-title-md text-base font-bold hover:bg-deep-forest transition-all shadow-md" href="<?= e($whatsappUrl) ?>" rel="noopener noreferrer" target="_blank">
                    <span class="material-symbols-outlined text-[20px]" style="font-variation-settings: 'FILL' 1;">chat</span>
                    <span><?= e(ps_text('व्हाट्सएप पर संवाद शुरू करें', 'Start WhatsApp Chat')) ?></span>
                </a>
                <a class="inline-flex items-center gap-2 px-8 py-3.5 bg-pure-white text-deep-forest rounded-xl font-title-md text-base font-bold hover:bg-soft-meadow transition-all shadow-xs border border-border-warm" href="tel:<?= e($phoneClean) ?>">
                    <span class="material-symbols-outlined text-[20px]">call</span>
                    <span><?= e(ps_text($phone . ' पर संपर्क करें', 'Call ' . $phone)) ?></span>
                </a>
            </div>
        </div>
    </section>
</div>

<script>
  function handleGuidanceSubmit(event) {
    event.preventDefault();
    const fullName = document.getElementById('fullName').value.trim();
    const phoneNumber = document.getElementById('phoneNumber').value.trim();
    const consultTopic = document.getElementById('consultTopic').value;
    const timeSlot = document.querySelector('input[name="timeSlot"]:checked')?.value || 'सुविधानुसार';
    const problemNote = document.getElementById('problemNote').value.trim();

    const toast = document.getElementById('formSuccessToast');
    if (toast) {
      toast.classList.remove('hidden');
    }
  }

  function resetGuidanceForm() {
    const form = document.getElementById('guidanceForm');
    const toast = document.getElementById('formSuccessToast');
    if (form) form.reset();
    if (toast) toast.classList.add('hidden');
  }
</script>
