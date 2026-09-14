<?php
declare(strict_types=1);
$phone = !empty($contact['phone']) ? $contact['phone'] : '+91 9919007190';
$phoneClean = preg_replace('/[^+0-9]/', '', $phone);
$email = !empty($contact['email']) ? $contact['email'] : 'contact@pradeepsarang.in';
$address = !empty($contact['address']) ? $contact['address'] : ps_text('ग्राम कमरावां, जिला बाराबंकी, उत्तर प्रदेश, भारत', 'Kamrawan, Barabanki, Uttar Pradesh, India');
?>
<footer class="w-full bg-[#111827] text-[#F9FAFB]">
    <div class="max-w-container-max mx-auto px-4 sm:px-8 pt-space-4xl pb-space-2xl">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-12 gap-10 lg:gap-8">
            <!-- Bio & Contact -->
            <div class="lg:col-span-4 flex flex-col">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-9 h-9 rounded-full bg-[#14532D] flex items-center justify-center border border-[#B28A42]/40">
                        <span class="material-symbols-outlined text-[#F0B45C] text-[20px]">nature_people</span>
                    </div>
                    <div class="flex flex-col">
                        <span class="font-headline-sm text-headline-sm text-[#F9FAFB] font-bold"><?= e(ps_text('प्रदीप सारंग', 'Pradeep Sarang')) ?></span>
                        <span class="font-label-sm text-label-sm text-[#F0B45C]"><?= e(ps_text('लोकसेवक • पर्यावरणविद् • साहित्यकार', 'Social Worker • Environmentalist • Writer')) ?></span>
                    </div>
                </div>
                <div class="bg-white/5 rounded-xl p-4 my-3 border border-white/10">
                    <p class="font-quote-editorial text-body-md text-[#F0B45C] leading-relaxed italic">
                        <?= e(ps_text('"हारना सीखा नहीं है, जीत का मैं गीत हूँ। जुगनुओं का संग है, इंसानियत का मीत हूँ।"', '"I have not learned to lose; I am a song of victory. Accompanied by fireflies, I am a friend to humanity."')) ?>
                    </p>
                </div>
                <div class="mt-4 space-y-2.5 font-body-sm text-body-sm text-[#CBD5E1]">
                    <div class="flex items-start gap-2.5">
                        <span class="material-symbols-outlined text-[18px] text-[#F0B45C] mt-0.5">location_on</span>
                        <span><?= e($address) ?></span>
                    </div>
                    <div class="flex items-center gap-2.5">
                        <span class="material-symbols-outlined text-[18px] text-[#F0B45C]">call</span>
                        <a class="hover:text-[#F0B45C] transition-colors" href="tel:<?= e($phoneClean) ?>"><?= e($phone) ?></a>
                    </div>
                    <div class="flex items-center gap-2.5">
                        <span class="material-symbols-outlined text-[18px] text-[#F0B45C]">mail</span>
                        <a class="hover:text-[#F0B45C] transition-colors" href="mailto:<?= e($email) ?>"><?= e($email) ?></a>
                    </div>
                </div>
            </div>

            <!-- Campaigns & Initiatives -->
            <div class="lg:col-span-2 flex flex-col space-y-3">
                <h4 class="font-title-md text-title-md text-[#F0B45C] font-bold flex items-center gap-1.5">
                    <span class="material-symbols-outlined text-[18px]">campaign</span>
                    <span><?= e(ps_text('अभियान एवं पहल', 'Initiatives')) ?></span>
                </h4>
                <ul class="space-y-2 font-body-sm text-body-sm text-[#CBD5E1]">
                    <li class="hover:text-[#F0B45C] transition-colors font-bold text-[#F0B45C]">
                        <a class="flex items-center gap-1.5" href="<?= e(base_url('/campaigns/' . ($patel['slug'] ?? 'patel-campaign'))) ?>">
                            <span class="material-symbols-outlined text-[15px] text-[#C05632]">flag</span>
                            <span><?= e(ps_text('सरदार पटेल अभियान', 'Sardar Patel Campaign')) ?></span>
                        </a>
                    </li>
                    <li class="hover:text-[#F0B45C] transition-colors">
                        <a class="flex items-center gap-1.5" href="<?= e(base_url('/campaigns/' . ($green['slug'] ?? 'hariyali-campaign'))) ?>">
                            <span class="material-symbols-outlined text-[15px] text-[#6FD08C]">eco</span>
                            <span><?= e(ps_text('हरियाली संकल्प', 'Hariyali Initiative')) ?></span>
                        </a>
                    </li>
                    <li class="hover:text-[#F0B45C] transition-colors">
                        <a class="flex items-center gap-1.5" href="<?= e(base_url('/campaigns/' . ($parinda['slug'] ?? 'bird-conservation-campaign'))) ?>">
                            <span class="material-symbols-outlined text-[15px] text-[#76B7D8]">flutter</span>
                            <span><?= e(ps_text('परिंदा संरक्षण', 'Bird Conservation')) ?></span>
                        </a>
                    </li>
                    <li class="hover:text-[#F0B45C] transition-colors">
                        <a class="flex items-center gap-1.5" href="<?= e(base_url('/campaigns/' . ($awadhi['slug'] ?? 'language-and-literature-promotion-campaign'))) ?>">
                            <span class="material-symbols-outlined text-[15px] text-[#7C5C96]">menu_book</span>
                            <span><?= e(ps_text('अवधी भाषा प्रसार', 'Awadhi Literature')) ?></span>
                        </a>
                    </li>
                    <li class="hover:text-[#F0B45C] transition-colors">
                        <a class="flex items-center gap-1.5" href="<?= e(base_url('/green-gang')) ?>">
                            <span class="material-symbols-outlined text-[15px] text-[#6FD08C]">groups</span>
                            <span><?= e(ps_text('ग्रीन गैंग कार्यदल', 'Green Gang Taskforce')) ?></span>
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Resources & Media -->
            <div class="lg:col-span-2 flex flex-col space-y-3">
                <h4 class="font-title-md text-title-md text-[#F0B45C] font-bold flex items-center gap-1.5">
                    <span class="material-symbols-outlined text-[18px]">collections_bookmark</span>
                    <span><?= e(ps_text('संसाधन एवं मीडिया', 'Media & Archive')) ?></span>
                </h4>
                <ul class="space-y-2 font-body-sm text-body-sm text-[#CBD5E1]">
                    <li class="hover:text-[#F0B45C] transition-colors">
                        <a class="flex items-center gap-1.5" href="<?= e(base_url('/media')) ?>">
                            <span class="material-symbols-outlined text-[15px]">newspaper</span>
                            <span><?= e(ps_text('अखबार कतरनें', 'Press Clippings')) ?></span>
                        </a>
                    </li>
                    <li class="hover:text-[#F0B45C] transition-colors">
                        <a class="flex items-center gap-1.5" href="<?= e(base_url('/portfolio')) ?>">
                            <span class="material-symbols-outlined text-[15px]">photo_library</span>
                            <span><?= e(ps_text('छायाचित्र दीर्घा', 'Photo Gallery')) ?></span>
                        </a>
                    </li>
                    <li class="hover:text-[#F0B45C] transition-colors">
                        <a class="flex items-center gap-1.5" href="<?= e(base_url('/awards')) ?>">
                            <span class="material-symbols-outlined text-[15px] text-[#F0B45C]">military_tech</span>
                            <span><?= e(ps_text('राष्ट्रीय सम्मान', 'Honors & Awards')) ?></span>
                        </a>
                    </li>
                    <li class="hover:text-[#F0B45C] transition-colors">
                        <a class="flex items-center gap-1.5" href="<?= e(base_url('/blog')) ?>">
                            <span class="material-symbols-outlined text-[15px]">edit_note</span>
                            <span><?= e(ps_text('सामाजिक ब्लॉग', 'Journal & Blog')) ?></span>
                        </a>
                    </li>
                    <li class="hover:text-[#F0B45C] transition-colors">
                        <a class="flex items-center gap-1.5" href="<?= e(base_url('/journey')) ?>">
                            <span class="material-symbols-outlined text-[15px]">history_edu</span>
                            <span><?= e(ps_text('आधिकारिक कालक्रम', 'Timeline Archive')) ?></span>
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Dialogue & Newsletter -->
            <div class="lg:col-span-4 flex flex-col space-y-3">
                <h4 class="font-title-md text-title-md text-[#F0B45C] font-bold flex items-center gap-1.5">
                    <span class="material-symbols-outlined text-[18px]">forum</span>
                    <span><?= e(ps_text('सहभागिता व संवाद', 'Dialogue & Updates')) ?></span>
                </h4>
                <p class="font-body-sm text-body-sm text-[#CBD5E1]">
                    <?= e(ps_text('हरियाली व सामाजिक मिशन से सीधे जुड़ें। अपनी सहभागिता दर्ज करें।', 'Stay connected directly with our green and social mission.')) ?>
                </p>
                <form method="post" action="<?= e(base_url('/')) ?>" class="flex flex-col space-y-2.5">
                    <?= csrf_field() ?>
                    <input type="hidden" name="form_type" value="newsletter">
                    <input class="w-full px-3.5 py-2.5 rounded-lg bg-white/10 text-white placeholder-gray-400 border border-white/10 font-body-sm text-body-sm focus:outline-none focus:ring-2 focus:ring-[#F0B45C]" placeholder="<?= e(ps_text('आपका ईमेल या फोन नंबर', 'Your email address')) ?>" name="email" type="email" required/>
                    <button class="w-full bg-[#C05632] hover:bg-[#A9472B] text-white font-label-md text-label-md py-2.5 rounded-lg transition-colors flex items-center justify-center gap-2 shadow font-bold" type="submit">
                        <span class="material-symbols-outlined text-[16px]">send</span>
                        <span><?= e(ps_text('हरियाली व सामाजिक अपडेट्स पाएं', 'Get Green & Social Updates')) ?></span>
                    </button>
                </form>
                <div class="pt-2 flex flex-wrap items-center gap-x-3 gap-y-2 text-[#CBD5E1] text-xs">
                    <a class="hover:text-[#F0B45C] transition-colors flex items-center gap-1 whitespace-nowrap" href="<?= e(base_url('/volunteer')) ?>">
                        <span class="material-symbols-outlined text-[14px] text-[#6FD08C]">volunteer_activism</span>
                        <span><?= e(ps_text('स्वयंसेवक बनें', 'Become a Volunteer')) ?></span>
                    </a>
                    <span class="opacity-30">•</span>
                    <a class="hover:text-[#F0B45C] transition-colors flex items-center gap-1 whitespace-nowrap" href="<?= e(base_url('/#contact')) ?>">
                        <span class="material-symbols-outlined text-[14px] text-[#F0B45C]">event</span>
                        <span><?= e(ps_text('कार्यक्रम में आमंत्रित करें', 'Invite for Event')) ?></span>
                    </a>
                    <span class="opacity-30">•</span>
                    <a class="hover:text-[#F0B45C] transition-colors flex items-center gap-1 whitespace-nowrap" href="<?= e(base_url('/#contact')) ?>">
                        <span class="material-symbols-outlined text-[14px] text-[#76B7D8]">chat</span>
                        <span><?= e(ps_text('विचार साझा करें', 'Share Thoughts')) ?></span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Site Policy & Guidelines Links Grid -->
        <div class="mt-10 pt-6 border-t border-white/10 space-y-3 text-center sm:text-left">
            <div class="flex flex-wrap items-center justify-center sm:justify-start gap-x-4 gap-y-2 text-xs text-[#CBD5E1]">
                <a class="hover:text-[#F0B45C] transition-colors" href="<?= e(base_url('/about')) ?>"><?= e(ps_text('परिचय (About)', 'About')) ?></a>
                <span class="opacity-30">•</span>
                <a class="hover:text-[#F0B45C] transition-colors" href="<?= e(base_url('/portfolio')) ?>"><?= e(ps_text('दीर्घा (Portfolio)', 'Portfolio')) ?></a>
                <span class="opacity-30">•</span>
                <a class="hover:text-[#F0B45C] transition-colors" href="<?= e(base_url('/blog')) ?>"><?= e(ps_text('ब्लॉग (Blog)', 'Blog')) ?></a>
                <span class="opacity-30">•</span>
                <a class="hover:text-[#F0B45C] transition-colors" href="<?= e(base_url('/contact')) ?>"><?= e(ps_text('संपर्क (Contact)', 'Contact')) ?></a>
            </div>

            <div class="flex flex-wrap items-center justify-center sm:justify-start gap-x-4 gap-y-2 text-xs text-[#94A3B8]">
                <a class="hover:text-[#F0B45C] transition-colors font-medium" href="<?= e(base_url('/privacy-policy')) ?>"><?= e(ps_text('गोपनीयता नीति (Privacy Policy)', 'Privacy Policy')) ?></a>
                <span class="opacity-30">•</span>
                <a class="hover:text-[#F0B45C] transition-colors font-medium" href="<?= e(base_url('/cookie-policy')) ?>"><?= e(ps_text('कुकी नीति (Cookie Policy)', 'Cookie Policy')) ?></a>
                <span class="opacity-30">•</span>
                <a class="hover:text-[#F0B45C] transition-colors font-medium" href="<?= e(base_url('/terms-and-conditions')) ?>"><?= e(ps_text('नियम एवं शर्तें (Terms & Conditions)', 'Terms & Conditions')) ?></a>
                <span class="opacity-30">•</span>
                <a class="hover:text-[#F0B45C] transition-colors font-medium" href="<?= e(base_url('/disclaimer')) ?>"><?= e(ps_text('अस्वीकरण (Disclaimer)', 'Disclaimer')) ?></a>
            </div>

            <div class="flex flex-wrap items-center justify-center sm:justify-start gap-x-4 gap-y-2 text-xs text-[#94A3B8]">
                <a class="hover:text-[#F0B45C] transition-colors font-medium" href="<?= e(base_url('/editorial-policy')) ?>"><?= e(ps_text('संपादकीय नीति (Editorial Policy)', 'Editorial Policy')) ?></a>
                <span class="opacity-30">•</span>
                <a class="hover:text-[#F0B45C] transition-colors font-medium" href="<?= e(base_url('/author-guidelines')) ?>"><?= e(ps_text('लेखक दिशा-निर्देश (Author Guidelines)', 'Author Guidelines')) ?></a>
                <span class="opacity-30">•</span>
                <a class="hover:text-[#F0B45C] transition-colors" href="<?= e(base_url('/disclaimer#copyright')) ?>"><?= e(ps_text('कॉपीराइट व DMCA', 'Copyright/DMCA')) ?></a>
                <span class="opacity-30">•</span>
                <a class="hover:text-[#F0B45C] transition-colors" href="<?= e(base_url('/contact')) ?>"><?= e(ps_text('विज्ञापन एवं सहभागिता', 'Advertise With Us')) ?></a>
            </div>
        </div>

        <!-- Bottom Line -->
        <div class="mt-6 pt-4 border-t border-white/10 flex flex-col sm:flex-row items-center justify-between gap-4 text-xs text-[#94A3B8]">
            <p>© <?= date('Y') ?> <?= e(app_config('name', 'प्रदीप सारंग')) ?>. <?= e(ps_text('सर्वाधिकार सुरक्षित।', 'All rights reserved.')) ?></p>
            <div class="flex items-center gap-4">
                <?php $visitorCount = (new ContentModel())->trackVisitorSession(); ?>
                <div class="flex items-center gap-1.5 px-3 py-1 rounded-full bg-white/5 border border-white/10 text-xs text-[#CBD5E1]" title="<?= e(ps_text('प्रामाणिक अद्वितीय आगंतुक संख्या', 'Authenticated Unique Visitors')) ?>">
                    <span class="material-symbols-outlined text-[15px] text-[#6FD08C]">visibility</span>
                    <span><?= e(ps_text('कुल आगंतुक: ', 'Total Visitors: ')) ?><strong class="text-white font-mono"><?= number_format($visitorCount) ?></strong></span>
                </div>
                <a class="hover:text-[#F0B45C] text-[#94A3B8] transition-colors flex items-center gap-1" href="<?= e(base_url('/admin')) ?>">
                    <span class="material-symbols-outlined text-[13px]">lock</span>
                    <span><?= e(ps_text('प्रशासनिक लॉगिन', 'Admin Portal')) ?></span>
                </a>
            </div>
        </div>
    </div>
</footer>
