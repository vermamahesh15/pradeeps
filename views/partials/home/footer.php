<?php
declare(strict_types=1);
$phone = !empty($contact['phone']) ? $contact['phone'] : '+91 9919007190';
$phoneClean = preg_replace('/[^+0-9]/', '', $phone);
$email = !empty($contact['email']) ? $contact['email'] : 'contact@pradeepsarang.in';
$address = !empty($contact['address']) ? $contact['address'] : ps_text('ग्राम कमरावां, जिला बाराबंकी, उत्तर प्रदेश, भारत', 'Kamrawan, Barabanki, Uttar Pradesh, India');

$siteLogo = setting('logo', 'assets/images/logo.webp');
$rootDir = dirname(__DIR__, 3);
$hasLogo = !empty($siteLogo) && (file_exists($rootDir . '/' . ltrim($siteLogo, '/')) || preg_match('#^https?://#i', $siteLogo));
?>
<footer class="w-full bg-[#111827] text-[#F9FAFB] border-t border-white/10">
    <div class="max-w-container-max mx-auto px-4 sm:px-8 pt-10 pb-8">
        
        <!-- 1. Top Newsletter & Engagement Banner (Full-Width Responsive Strip) -->
        <div class="bg-white/[0.04] border border-white/10 rounded-2xl p-6 lg:p-8 mb-10 shadow-xl backdrop-blur-sm">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-center">
                <div class="lg:col-span-5 flex flex-col">
                    <div class="inline-flex items-center gap-2 text-[#6FD08C] text-xs font-semibold uppercase tracking-wider mb-2">
                        <span class="material-symbols-outlined text-[18px]">eco</span>
                        <span><?= e(ps_text('मिशन हरियाली व सामाजिक चेतना', 'Green Mission & Community Updates')) ?></span>
                    </div>
                    <h3 class="font-title-lg text-xl sm:text-2xl font-bold text-white leading-snug">
                        <?= e(ps_text('हरियाली व सामाजिक संवाद से सीधे जुड़ें', 'Connect Directly with Our Green & Social Mission')) ?>
                    </h3>
                    <p class="font-body-sm text-sm text-[#94A3B8] mt-1.5 leading-relaxed">
                        <?= e(ps_text('पर्यावरण संरक्षण, अवधी साहित्य और समाजसेवा की प्रेरक पहलों के नियमित अपडेट्स पाएं।', 'Receive regular updates on tree planting, bird conservation, Awadhi literature, and rural service.')) ?>
                    </p>
                </div>

                <div class="lg:col-span-7 flex flex-col">
                    <form method="post" action="<?= e(base_url('/')) ?>" class="flex flex-col sm:flex-row gap-3">
                        <?= csrf_field() ?>
                        <input type="hidden" name="form_type" value="newsletter">
                        <label for="footer-newsletter-email" class="sr-only"><?= e(ps_text('ईमेल पता दर्ज करें', 'Enter email address')) ?></label>
                        <div class="relative flex-1">
                            <span class="material-symbols-outlined absolute left-3.5 top-1/2 -translate-y-1/2 text-[#94A3B8] text-[20px]">mail</span>
                            <input id="footer-newsletter-email" class="w-full pl-11 pr-4 py-3 rounded-xl bg-white/10 text-white placeholder-slate-400 border border-white/15 text-sm focus:outline-none focus:ring-2 focus:ring-[#6FD08C] focus:bg-white/15 transition-all" name="email" type="email" placeholder="<?= e(ps_text('अपना ईमेल पता दर्ज करें...', 'Enter your email address...')) ?>" required/>
                        </div>
                        <button class="bg-[#C05632] hover:bg-[#A9472B] text-white font-semibold text-sm px-6 py-3 rounded-xl transition-all flex items-center justify-center gap-2 shadow-md shrink-0 cursor-pointer" type="submit">
                            <span class="material-symbols-outlined text-[18px]">send</span>
                            <span><?= e(ps_text('अपडेट्स पाएं', 'Subscribe')) ?></span>
                        </button>
                    </form>
                    <div class="mt-3 flex flex-wrap items-center gap-2.5 text-xs text-[#94A3B8]">
                        <span class="text-slate-400 font-medium"><?= e(ps_text('त्वरित सहभागिता:', 'Quick Actions:')) ?></span>
                        <a class="hover:text-[#6FD08C] transition-colors flex items-center gap-1 bg-white/5 px-2.5 py-1 rounded-md border border-white/10" href="<?= e(base_url('/volunteer')) ?>">
                            <span class="material-symbols-outlined text-[14px] text-[#6FD08C]">volunteer_activism</span>
                            <span><?= e(ps_text('स्वयंसेवक बनें', 'Join as Volunteer')) ?></span>
                        </a>
                        <a class="hover:text-[#F0B45C] transition-colors flex items-center gap-1 bg-white/5 px-2.5 py-1 rounded-md border border-white/10" href="<?= e(base_url('/donation')) ?>">
                            <span class="material-symbols-outlined text-[14px] text-[#F0B45C]">favorite</span>
                            <span><?= e(ps_text('सहयोग करें', 'Support Cause')) ?></span>
                        </a>
                        <a class="hover:text-[#76B7D8] transition-colors flex items-center gap-1 bg-white/5 px-2.5 py-1 rounded-md border border-white/10" href="<?= e(base_url('/contact')) ?>">
                            <span class="material-symbols-outlined text-[14px] text-[#76B7D8]">chat</span>
                            <span><?= e(ps_text('विचार साझा करें', 'Share Thoughts')) ?></span>
                        </a>
                        <a class="hover:text-[#C084FC] transition-colors flex items-center gap-1 bg-white/5 px-2.5 py-1 rounded-md border border-white/10" href="<?= e(base_url('/salahkaar')) ?>">
                            <span class="material-symbols-outlined text-[14px] text-[#C084FC]">support_agent</span>
                            <span><?= e(ps_text('सलाहकार मार्गदर्शन', 'Guidance')) ?></span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- 2. Main 4-Column Balanced Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-12 gap-8 lg:gap-8 mb-10">
            <!-- Col 1: Bio & Contact (4 cols) -->
            <div class="lg:col-span-4 flex flex-col">
                <div class="flex items-center gap-3 mb-4">
                    <?php if ($hasLogo): ?>
                        <div class="bg-white/95 p-2 rounded-xl border border-white/20 shadow-sm inline-block">
                            <img src="<?= e(base_url($siteLogo)) ?>" alt="Pradeep Sarang Logo" class="h-10 w-auto object-contain" style="max-height: 40px; width: auto; object-fit: contain;">
                        </div>
                    <?php else: ?>
                        <div class="w-10 h-10 rounded-xl bg-[#14532D] flex items-center justify-center border border-[#B28A42]/40 text-white font-bold text-lg">
                            PS
                        </div>
                    <?php endif; ?>
                </div>

                <div class="bg-white/[0.03] rounded-xl p-3.5 mb-4 border border-white/10">
                    <p class="font-quote-editorial text-sm text-[#F0B45C] leading-relaxed italic">
                        <?= e(ps_text('"हारना सीखा नहीं है, जीत का मैं गीत हूँ। जुगनुओं का संग है, इंसानियत का मीत हूँ।"', '"I have not learned to lose; I am a song of victory. Accompanied by fireflies, I am a friend to humanity."')) ?>
                    </p>
                </div>

                <div class="space-y-2.5 font-body-sm text-xs text-[#CBD5E1]">
                    <div class="flex items-start gap-2.5">
                        <span class="material-symbols-outlined text-[18px] text-[#F0B45C] shrink-0 mt-0.5">location_on</span>
                        <span><?= e($address) ?></span>
                    </div>
                    <div class="flex items-center gap-2.5">
                        <span class="material-symbols-outlined text-[18px] text-[#F0B45C] shrink-0">call</span>
                        <a class="hover:text-[#F0B45C] transition-colors" href="tel:<?= e($phoneClean) ?>"><?= e($phone) ?></a>
                    </div>
                    <div class="flex items-center gap-2.5">
                        <svg class="w-[18px] h-[18px] fill-[#25D366] shrink-0" viewBox="0 0 24 24"><path d="M12.031 0C5.394 0 0 5.392 0 12.029c0 2.122.553 4.195 1.604 6.015L.03 24l6.096-1.599c1.761.96 3.75 1.464 5.905 1.464 6.637 0 12.031-5.393 12.031-12.031C24.062 5.392 18.668 0 12.031 0zm6.654 17.002c-.276.776-1.365 1.424-2.235 1.611-.595.127-1.372.228-3.987-.856-3.346-1.386-5.502-4.786-5.669-5.008-.166-.222-1.36-1.808-1.36-3.448 0-1.64 0.858-2.449 1.162-2.781.304-.333.664-.416.885-.416.221 0 .443.002.637.011.206.01.482-.078.753.573.277.665.941 2.296 1.024 2.463.083.167.139.36.028.582-.11.222-.166.36-.332.554-.166.194-.349.433-.498.582-.166.166-.339.347-.146.679.194.332.862 1.414 1.848 2.292 1.267 1.129 2.336 1.479 2.668 1.645.332.166.526.139.72-.083.194-.222.831-.97 1.052-1.302.221-.332.443-.277.747-.166.304.111 1.936.914 2.268 1.08.332.166.554.249.637.388.083.139.083.804-.193 1.58z"/></svg>
                        <a class="hover:text-[#25D366] transition-colors text-[#25D366] font-semibold" href="https://api.whatsapp.com/send?phone=<?= urlencode(preg_replace('/[^0-9]/', '', $phoneClean)) ?>&amp;text=<?= urlencode(ps_text('नमस्ते श्री सारंग जी, मैं आपसे संपर्क करना चाहता हूँ।', 'Hello Shri Sarang ji, I would like to connect with you.')) ?>" target="_blank" rel="noopener noreferrer">
                            <span>WhatsApp: <?= e($phone) ?></span>
                        </a>
                    </div>
                    <div class="flex items-center gap-2.5">
                        <span class="material-symbols-outlined text-[18px] text-[#F0B45C] shrink-0">mail</span>
                        <a class="hover:text-[#F0B45C] transition-colors" href="mailto:<?= e($email) ?>"><?= e($email) ?></a>
                    </div>
                </div>
            </div>

            <!-- Col 2: Campaigns & Initiatives (3 cols) -->
            <div class="lg:col-span-3 flex flex-col space-y-3">
                <h4 class="font-title-md text-sm font-bold text-[#F0B45C] uppercase tracking-wider flex items-center gap-1.5 border-b border-white/10 pb-2">
                    <span class="material-symbols-outlined text-[18px]">campaign</span>
                    <span><?= e(ps_text('अभियान एवं जन-पहल', 'Initiatives & Drives')) ?></span>
                </h4>
                <ul class="space-y-2.5 font-body-sm text-xs text-[#CBD5E1]">
                    <li class="hover:text-[#F0B45C] transition-colors">
                        <a class="flex items-center gap-2" href="<?= e(base_url('/campaigns/' . ($patel['slug'] ?? 'patel-campaign'))) ?>">
                            <span class="material-symbols-outlined text-[15px] text-[#C05632]">flag</span>
                            <span><?= e(ps_text('सरदार पटेल राष्ट्रीय एकता अभियान', 'Sardar Patel Campaign')) ?></span>
                        </a>
                    </li>
                    <li class="hover:text-[#F0B45C] transition-colors">
                        <a class="flex items-center gap-2" href="<?= e(base_url('/campaigns/' . ($green['slug'] ?? 'hariyali-campaign'))) ?>">
                            <span class="material-symbols-outlined text-[15px] text-[#6FD08C]">eco</span>
                            <span><?= e(ps_text('हरियाली संकल्प एवं पौधरोपण', 'Hariyali Initiative')) ?></span>
                        </a>
                    </li>
                    <li class="hover:text-[#F0B45C] transition-colors">
                        <a class="flex items-center gap-2" href="<?= e(base_url('/campaigns/' . ($parinda['slug'] ?? 'bird-conservation-campaign'))) ?>">
                            <span class="material-symbols-outlined text-[15px] text-[#76B7D8]">flutter</span>
                            <span><?= e(ps_text('परिंदा संरक्षण व जल-सकोरा अभियान', 'Bird Conservation')) ?></span>
                        </a>
                    </li>
                    <li class="hover:text-[#F0B45C] transition-colors">
                        <a class="flex items-center gap-2" href="<?= e(base_url('/campaigns/' . ($awadhi['slug'] ?? 'language-and-literature-promotion-campaign'))) ?>">
                            <span class="material-symbols-outlined text-[15px] text-[#C084FC]">menu_book</span>
                            <span><?= e(ps_text('अवधी भाषा एवं साहित्य संवर्धन', 'Awadhi Literature')) ?></span>
                        </a>
                    </li>
                    <li class="hover:text-[#F0B45C] transition-colors">
                        <a class="flex items-center gap-2" href="<?= e(base_url('/green-gang')) ?>">
                            <span class="material-symbols-outlined text-[15px] text-[#6FD08C]">groups</span>
                            <span><?= e(ps_text('ग्रीन गैंग पर्यावरण सेना कार्यदल', 'Green Gang Taskforce')) ?></span>
                        </a>
                    </li>
                    <li class="hover:text-[#F0B45C] transition-colors">
                        <a class="flex items-center gap-2" href="<?= e(base_url('/salahkaar')) ?>">
                            <span class="material-symbols-outlined text-[15px] text-[#F0B45C]">support_agent</span>
                            <span><?= e(ps_text('सलाहकार एवं सामाजिक चिंतन', 'Counselling & Guidance')) ?></span>
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Col 3: Resources & Media (2 cols) -->
            <div class="lg:col-span-2 flex flex-col space-y-3">
                <h4 class="font-title-md text-sm font-bold text-[#F0B45C] uppercase tracking-wider flex items-center gap-1.5 border-b border-white/10 pb-2">
                    <span class="material-symbols-outlined text-[18px]">collections_bookmark</span>
                    <span><?= e(ps_text('संसाधन व मीडिया', 'Media & Archive')) ?></span>
                </h4>
                <ul class="space-y-2.5 font-body-sm text-xs text-[#CBD5E1]">
                    <li class="hover:text-[#F0B45C] transition-colors">
                        <a class="flex items-center gap-2" href="<?= e(base_url('/media')) ?>">
                            <span class="material-symbols-outlined text-[15px] text-slate-400">newspaper</span>
                            <span><?= e(ps_text('अखबार कतरनें (Press)', 'Press Clippings')) ?></span>
                        </a>
                    </li>
                    <li class="hover:text-[#F0B45C] transition-colors">
                        <a class="flex items-center gap-2" href="<?= e(base_url('/portfolio')) ?>">
                            <span class="material-symbols-outlined text-[15px] text-slate-400">photo_library</span>
                            <span><?= e(ps_text('छायाचित्र दीर्घा', 'Photo Gallery')) ?></span>
                        </a>
                    </li>
                    <li class="hover:text-[#F0B45C] transition-colors">
                        <a class="flex items-center gap-2" href="<?= e(base_url('/videos')) ?>">
                            <span class="material-symbols-outlined text-[15px] text-slate-400">play_circle</span>
                            <span><?= e(ps_text('वीडियो दीर्घा', 'Video Gallery')) ?></span>
                        </a>
                    </li>
                    <li class="hover:text-[#F0B45C] transition-colors">
                        <a class="flex items-center gap-2" href="<?= e(base_url('/awards')) ?>">
                            <span class="material-symbols-outlined text-[15px] text-[#F0B45C]">military_tech</span>
                            <span><?= e(ps_text('राष्ट्रीय सम्मान', 'Honors & Awards')) ?></span>
                        </a>
                    </li>
                    <li class="hover:text-[#F0B45C] transition-colors">
                        <a class="flex items-center gap-2" href="<?= e(base_url('/blog')) ?>">
                            <span class="material-symbols-outlined text-[15px] text-slate-400">edit_note</span>
                            <span><?= e(ps_text('सामाजिक ब्लॉग', 'Journal & Blog')) ?></span>
                        </a>
                    </li>
                    <li class="hover:text-[#F0B45C] transition-colors">
                        <a class="flex items-center gap-2" href="<?= e(base_url('/journey')) ?>">
                            <span class="material-symbols-outlined text-[15px] text-slate-400">history_edu</span>
                            <span><?= e(ps_text('आधिकारिक कालक्रम', 'Timeline Archive')) ?></span>
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Col 4: Governance, Policies & Ethics (3 cols - Fills right side!) -->
            <div class="lg:col-span-3 flex flex-col space-y-3">
                <h4 class="font-title-md text-sm font-bold text-[#F0B45C] uppercase tracking-wider flex items-center gap-1.5 border-b border-white/10 pb-2">
                    <span class="material-symbols-outlined text-[18px]">policy</span>
                    <span><?= e(ps_text('नीतियां एवं शुचिता', 'Policies & Ethics')) ?></span>
                </h4>
                <ul class="space-y-2.5 font-body-sm text-xs text-[#CBD5E1]">
                    <li class="hover:text-[#F0B45C] transition-colors">
                        <a class="flex items-center gap-2" href="<?= e(base_url('/privacy-policy')) ?>">
                            <span class="material-symbols-outlined text-[15px] text-slate-400">shield</span>
                            <span><?= e(ps_text('गोपनीयता नीति (Privacy Policy)', 'Privacy Policy')) ?></span>
                        </a>
                    </li>
                    <li class="hover:text-[#F0B45C] transition-colors">
                        <a class="flex items-center gap-2" href="<?= e(base_url('/terms-and-conditions')) ?>">
                            <span class="material-symbols-outlined text-[15px] text-slate-400">gavel</span>
                            <span><?= e(ps_text('नियम एवं शर्तें (Terms & Conditions)', 'Terms & Conditions')) ?></span>
                        </a>
                    </li>
                    <li class="hover:text-[#F0B45C] transition-colors">
                        <a class="flex items-center gap-2" href="<?= e(base_url('/cookie-policy')) ?>">
                            <span class="material-symbols-outlined text-[15px] text-slate-400">cookie</span>
                            <span><?= e(ps_text('कुकी नीति (Cookie Policy)', 'Cookie Policy')) ?></span>
                        </a>
                    </li>
                    <li class="hover:text-[#F0B45C] transition-colors">
                        <a class="flex items-center gap-2" href="<?= e(base_url('/editorial-policy')) ?>">
                            <span class="material-symbols-outlined text-[15px] text-slate-400">fact_check</span>
                            <span><?= e(ps_text('संपादकीय नीति (Editorial Policy)', 'Editorial Policy')) ?></span>
                        </a>
                    </li>
                    <li class="hover:text-[#F0B45C] transition-colors">
                        <a class="flex items-center gap-2" href="<?= e(base_url('/author-guidelines')) ?>">
                            <span class="material-symbols-outlined text-[15px] text-slate-400">rate_review</span>
                            <span><?= e(ps_text('लेखक दिशा-निर्देश (Author Guidelines)', 'Author Guidelines')) ?></span>
                        </a>
                    </li>
                    <li class="hover:text-[#F0B45C] transition-colors">
                        <a class="flex items-center gap-2" href="<?= e(base_url('/disclaimer')) ?>">
                            <span class="material-symbols-outlined text-[15px] text-slate-400">info</span>
                            <span><?= e(ps_text('अस्वीकरण व DMCA (Disclaimer)', 'Disclaimer & DMCA')) ?></span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <!-- 3. Bottom Bar: Copyright, Stats & Admin Login -->
        <div class="pt-6 border-t border-white/10 flex flex-col sm:flex-row items-center justify-between gap-4 text-xs text-[#94A3B8]">
            <div class="flex flex-col sm:flex-row sm:items-center gap-1 sm:gap-3 text-center sm:text-left">
                <p>© <?= date('Y') ?> <?= e(app_config('name', 'प्रदीप सारंग')) ?>. <?= e(ps_text('सर्वाधिकार सुरक्षित।', 'All rights reserved.')) ?></p>
                <span class="hidden sm:inline opacity-30">•</span>
                <span class="text-slate-400"><?= e(ps_text('माटी, समाज व अवधी संस्कृति को समर्पित जीवन', 'Dedicated to Nature, Society & Awadhi Culture')) ?></span>
            </div>
            <div class="flex items-center gap-3 shrink-0">
                <?php $visitorCount = (new ContentModel())->trackVisitorSession(); ?>
                <div class="flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-white/5 border border-white/10 text-xs text-[#CBD5E1]" title="<?= e(ps_text('प्रामाणिक अद्वितीय आगंतुक संख्या', 'Authenticated Unique Visitors')) ?>">
                    <span class="material-symbols-outlined text-[15px] text-[#6FD08C]">visibility</span>
                    <span><?= e(ps_text('कुल आगंतुक: ', 'Total Visitors: ')) ?><strong class="text-white font-mono"><?= number_format($visitorCount) ?></strong></span>
                </div>
                <a class="hover:text-[#F0B45C] text-[#94A3B8] transition-colors flex items-center gap-1 bg-white/5 px-3 py-1.5 rounded-lg border border-white/10" href="<?= e(base_url('/admin')) ?>">
                    <span class="material-symbols-outlined text-[14px]">lock</span>
                    <span><?= e(ps_text('प्रशासनिक लॉगिन', 'Admin Login')) ?></span>
                </a>
            </div>
        </div>

    </div>
</footer>
