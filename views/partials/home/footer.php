<?php
declare(strict_types=1);
$phone = !empty($contact['phone']) ? $contact['phone'] : '+91 9919007190';
$phoneClean = preg_replace('/[^+0-9]/', '', $phone);
$email = !empty($contact['email']) ? $contact['email'] : 'contact@pradeepsarang.in';
$address = !empty($contact['address']) ? $contact['address'] : ps_text('ग्राम कमरावां, जिला बाराबंकी, उत्तर प्रदेश, भारत', 'Kamrawan, Barabanki, Uttar Pradesh, India');
?>
<footer class="w-full bg-deep-forest text-pure-white">
    <div class="max-w-container-max mx-auto px-4 sm:px-8 pt-space-4xl pb-space-2xl">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-12 gap-10 lg:gap-8">
            <!-- Bio & Contact -->
            <div class="lg:col-span-4 flex flex-col">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-9 h-9 rounded-full bg-primary-container flex items-center justify-center">
                        <span class="material-symbols-outlined text-on-primary text-[20px]">nature_people</span>
                    </div>
                    <div class="flex flex-col">
                        <span class="font-headline-sm text-headline-sm text-pure-white"><?= e(ps_text('प्रदीप सारंग', 'Pradeep Sarang')) ?></span>
                        <span class="font-label-sm text-label-sm text-primary-fixed"><?= e(ps_text('लोकसेवक • पर्यावरणविद् • साहित्यकार', 'Social Worker • Environmentalist • Writer')) ?></span>
                    </div>
                </div>
                <div class="bg-surface-container-low/10 rounded-xl p-4 my-3 border border-white/5">
                    <p class="font-quote-editorial text-body-md text-tertiary-fixed leading-relaxed italic">
                        <?= e(ps_text('"हारना सीखा नहीं है, जीत का मैं गीत हूँ। जुगनुओं का संग है, इंसानियत का मीत हूँ।"', '"I have not learned to lose; I am a song of victory. Accompanied by fireflies, I am a friend to humanity."')) ?>
                    </p>
                </div>
                <div class="mt-4 space-y-2.5 font-body-sm text-body-sm text-surface-container-high">
                    <div class="flex items-start gap-2.5">
                        <span class="material-symbols-outlined text-[18px] text-tertiary-fixed mt-0.5">location_on</span>
                        <span><?= e($address) ?></span>
                    </div>
                    <div class="flex items-center gap-2.5">
                        <span class="material-symbols-outlined text-[18px] text-tertiary-fixed">call</span>
                        <a class="hover:text-tertiary-fixed transition-colors" href="tel:<?= e($phoneClean) ?>"><?= e($phone) ?></a>
                    </div>
                    <div class="flex items-center gap-2.5">
                        <span class="material-symbols-outlined text-[18px] text-tertiary-fixed">mail</span>
                        <a class="hover:text-tertiary-fixed transition-colors" href="mailto:<?= e($email) ?>"><?= e($email) ?></a>
                    </div>
                </div>
            </div>

            <!-- Campaigns & Initiatives -->
            <div class="lg:col-span-2 flex flex-col space-y-3">
                <h4 class="font-title-md text-title-md text-tertiary-fixed font-semibold"><?= e(ps_text('अभियान एवं पहल', 'Initiatives')) ?></h4>
                <ul class="space-y-2 font-body-sm text-body-sm text-surface-container-high">
                    <li class="hover:text-pure-white transition-colors font-bold text-tertiary-fixed">
                        <a href="<?= e(base_url('/campaigns/' . ($patel['slug'] ?? 'patel-campaign'))) ?>"><?= e(ps_text('सरदार पटेल अभियान', 'Sardar Patel Campaign')) ?></a>
                    </li>
                    <li class="hover:text-pure-white transition-colors">
                        <a href="<?= e(base_url('/campaigns/' . ($green['slug'] ?? 'hariyali-campaign'))) ?>"><?= e(ps_text('हरियाली संकल्प', 'Hariyali Initiative')) ?></a>
                    </li>
                    <li class="hover:text-pure-white transition-colors">
                        <a href="<?= e(base_url('/campaigns/' . ($parinda['slug'] ?? 'bird-conservation-campaign'))) ?>"><?= e(ps_text('परिंदा संरक्षण', 'Bird Conservation')) ?></a>
                    </li>
                    <li class="hover:text-pure-white transition-colors">
                        <a href="<?= e(base_url('/campaigns/' . ($awadhi['slug'] ?? 'language-and-literature-promotion-campaign'))) ?>"><?= e(ps_text('अवधी भाषा प्रसार', 'Awadhi Literature')) ?></a>
                    </li>
                    <li class="hover:text-pure-white transition-colors">
                        <a href="<?= e(base_url('/green-gang')) ?>"><?= e(ps_text('ग्रीन गैंग कार्यदल', 'Green Gang Taskforce')) ?></a>
                    </li>
                </ul>
            </div>

            <!-- Resources & Media -->
            <div class="lg:col-span-2 flex flex-col space-y-3">
                <h4 class="font-title-md text-title-md text-tertiary-fixed font-semibold"><?= e(ps_text('संसाधन एवं मीडिया', 'Media & Archive')) ?></h4>
                <ul class="space-y-2 font-body-sm text-body-sm text-surface-container-high">
                    <li class="hover:text-pure-white transition-colors"><a href="<?= e(base_url('/media')) ?>"><?= e(ps_text('अखबार कतरनें', 'Press Clippings')) ?></a></li>
                    <li class="hover:text-pure-white transition-colors"><a href="<?= e(base_url('/portfolio')) ?>"><?= e(ps_text('छायाचित्र दीर्घा', 'Photo Gallery')) ?></a></li>
                    <li class="hover:text-pure-white transition-colors"><a href="<?= e(base_url('/awards')) ?>"><?= e(ps_text('राष्ट्रीय सम्मान', 'Honors & Awards')) ?></a></li>
                    <li class="hover:text-pure-white transition-colors"><a href="<?= e(base_url('/blog')) ?>"><?= e(ps_text('सामाजिक ब्लॉग', 'Journal & Blog')) ?></a></li>
                    <li class="hover:text-pure-white transition-colors"><a href="<?= e(base_url('/journey')) ?>"><?= e(ps_text('आधिकारिक कालक्रम', 'Timeline Archive')) ?></a></li>
                </ul>
            </div>

            <!-- Dialogue & Newsletter -->
            <div class="lg:col-span-4 flex flex-col space-y-3">
                <h4 class="font-title-md text-title-md text-tertiary-fixed font-semibold"><?= e(ps_text('सहभागिता व संवाद', 'Dialogue & Updates')) ?></h4>
                <p class="font-body-sm text-body-sm text-surface-container-high">
                    <?= e(ps_text('हरियाली व सामाजिक मिशन से सीधे जुड़ें। अपनी सहभागिता दर्ज करें।', 'Stay connected directly with our green and social mission.')) ?>
                </p>
                <form method="post" action="<?= e(base_url('/')) ?>" class="flex flex-col space-y-2.5">
                    <?= csrf_field() ?>
                    <input type="hidden" name="form_type" value="newsletter">
                    <input class="w-full px-3.5 py-2.5 rounded-lg bg-surface-container-lowest text-on-surface font-body-sm text-body-sm focus:outline-none focus:ring-2 focus:ring-primary-container" placeholder="<?= e(ps_text('आपका ईमेल या फोन नंबर', 'Your email address')) ?>" name="email" type="email" required/>
                    <button class="w-full bg-primary-container hover:bg-primary text-on-primary font-label-md text-label-md py-2.5 rounded-lg transition-colors flex items-center justify-center gap-2 shadow" type="submit">
                        <span class="material-symbols-outlined text-[16px]">send</span>
                        <span><?= e(ps_text('हरियाली व सामाजिक अपडेट्स पाएं', 'Get Green & Social Updates')) ?></span>
                    </button>
                </form>
                <div class="pt-2 flex flex-wrap gap-3 text-surface-container-high font-label-sm text-label-sm">
                    <a class="hover:text-tertiary-fixed transition-colors" href="<?= e(base_url('/volunteer')) ?>">• <?= e(ps_text('स्वयंसेवक बनें', 'Become a Volunteer')) ?></a>
                    <a class="hover:text-tertiary-fixed transition-colors" href="<?= e(base_url('/#contact')) ?>">• <?= e(ps_text('कार्यक्रम में आमंत्रित करें', 'Invite for Event')) ?></a>
                    <a class="hover:text-tertiary-fixed transition-colors" href="<?= e(base_url('/#contact')) ?>">• <?= e(ps_text('विचार साझा करें', 'Share Thoughts')) ?></a>
                </div>
            </div>
        </div>

        <!-- Site Policy & Guidelines Links Grid -->
        <div class="mt-space-2xl pt-space-xl border-t border-surface-container-high/15 space-y-3 text-center sm:text-left">
            <div class="flex flex-wrap items-center justify-center sm:justify-start gap-x-4 gap-y-2 font-label-md text-label-sm text-surface-container-high">
                <a class="hover:text-pure-white transition-colors" href="<?= e(base_url('/about')) ?>"><?= e(ps_text('परिचय (About)', 'About')) ?></a>
                <span class="opacity-30">•</span>
                <a class="hover:text-pure-white transition-colors" href="<?= e(base_url('/portfolio')) ?>"><?= e(ps_text('दीर्घा (Portfolio)', 'Portfolio')) ?></a>
                <span class="opacity-30">•</span>
                <a class="hover:text-pure-white transition-colors" href="<?= e(base_url('/blog')) ?>"><?= e(ps_text('ब्लॉग (Blog)', 'Blog')) ?></a>
                <span class="opacity-30">•</span>
                <a class="hover:text-pure-white transition-colors" href="<?= e(base_url('/contact')) ?>"><?= e(ps_text('संपर्क (Contact)', 'Contact')) ?></a>
            </div>

            <div class="flex flex-wrap items-center justify-center sm:justify-start gap-x-4 gap-y-2 font-label-sm text-label-sm text-tertiary-fixed/90">
                <a class="hover:text-pure-white transition-colors font-semibold text-tertiary-fixed" href="<?= e(base_url('/privacy-policy')) ?>"><?= e(ps_text('गोपनीयता नीति (Privacy Policy)', 'Privacy Policy')) ?></a>
                <span class="opacity-30">•</span>
                <a class="hover:text-pure-white transition-colors font-semibold text-tertiary-fixed" href="<?= e(base_url('/cookie-policy')) ?>"><?= e(ps_text('कुकी नीति (Cookie Policy)', 'Cookie Policy')) ?></a>
                <span class="opacity-30">•</span>
                <a class="hover:text-pure-white transition-colors font-semibold text-tertiary-fixed" href="<?= e(base_url('/terms-and-conditions')) ?>"><?= e(ps_text('नियम एवं शर्तें (Terms & Conditions)', 'Terms & Conditions')) ?></a>
                <span class="opacity-30">•</span>
                <a class="hover:text-pure-white transition-colors font-semibold text-tertiary-fixed" href="<?= e(base_url('/disclaimer')) ?>"><?= e(ps_text('अस्वीकरण (Disclaimer)', 'Disclaimer')) ?></a>
            </div>

            <div class="flex flex-wrap items-center justify-center sm:justify-start gap-x-4 gap-y-2 font-label-sm text-label-sm text-surface-container-high/80">
                <a class="hover:text-pure-white transition-colors font-semibold text-tertiary-fixed" href="<?= e(base_url('/editorial-policy')) ?>"><?= e(ps_text('संपादकीय नीति (Editorial Policy)', 'Editorial Policy')) ?></a>
                <span class="opacity-30">•</span>
                <a class="hover:text-pure-white transition-colors font-semibold text-tertiary-fixed" href="<?= e(base_url('/author-guidelines')) ?>"><?= e(ps_text('लेखक दिशा-निर्देश (Author Guidelines)', 'Author Guidelines')) ?></a>
                <span class="opacity-30">•</span>
                <a class="hover:text-pure-white transition-colors" href="<?= e(base_url('/disclaimer#copyright')) ?>"><?= e(ps_text('कॉपीराइट व DMCA', 'Copyright/DMCA')) ?></a>
                <span class="opacity-30">•</span>
                <a class="hover:text-pure-white transition-colors" href="<?= e(base_url('/contact')) ?>"><?= e(ps_text('विज्ञापन एवं सहभागिता', 'Advertise With Us')) ?></a>
            </div>
        </div>

        <!-- Bottom Line -->
        <div class="mt-space-md pt-space-md border-t border-surface-container-high/15 flex flex-col sm:flex-row items-center justify-between gap-4 font-label-sm text-label-sm text-surface-container-high">
            <p>© <?= date('Y') ?> <?= e(app_config('name', 'प्रदीप सारंग')) ?>. <?= e(ps_text('सर्वाधिकार सुरक्षित।', 'All rights reserved.')) ?></p>
            <div class="flex items-center gap-6">
                <a class="hover:text-tertiary-fixed text-surface-container-high/70 transition-colors flex items-center gap-1" href="<?= e(base_url('/admin')) ?>">
                    <span class="material-symbols-outlined text-[13px]">lock</span>
                    <span><?= e(ps_text('प्रशासनिक लॉगिन', 'Admin Portal')) ?></span>
                </a>
            </div>
        </div>
    </div>
</footer>
